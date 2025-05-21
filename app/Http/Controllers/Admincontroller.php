<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileMail;
use App\Mail\CodePin;
use Illuminate\Support\Facades\Session;
use App\Models\Compte;

class AdminController extends Controller
{
    public function showinglogin()
    {
        return view('login');
    }
    public function showregister()
    {
        return view('register');
    }

    public function showRegistration(Request $request)
    {    $email = session('email', 'votre@email.com');
        return view("email_veri", ['email' => $email]);
    }

    public function main()
    {
        return view('main');
    }

    public function register_step1(Request $request)
    {
        // Validate form data
        $request->validate([
            "Nom" => 'required|string',
            "Prenom" => 'required|string',
            'Cin' => 'required|string|alpha_num|unique:users',
            "email" => 'required|email|unique:users',
            "telephone" => 'required|alpha_num|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'cin_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'birthday' => 'required|date',
            'adresse' => 'required|string|max:255'
            ]);
    
        // Save the image
        $imageName = time() . '.' . $request->file('cin_image')->extension();
        $request->file('cin_image')->move(public_path('images'), $imageName);
        $path = public_path('images/' . $imageName);
    
        // Verify image exists
        if (!file_exists($path)) {
            return response()->json([
                'success' => false,
                'errors' => ['cin_image' => 'Image file not found.']
            ], 422);
        }
    
        // Execute Python OCR script
        $pythonScript = base_path('resources/python/ocr_extract.py');
        $command = escapeshellcmd("python \"$pythonScript\" \"$path\" 2>&1");
        $output = shell_exec($command);
        $result = json_decode($output, true);
    
        
        // Check for errors
        if (json_last_error() !== JSON_ERROR_NONE || !isset($result['success'])) {
            unlink($path);
            return response()->json([
                'success' => false,
                'errors' => ['cin_image' => 'OCR processing failed. ' . ($output ?? 'No output from script')]
            ], 422);
        }
    
        if (!$result['success']) {
            unlink($path);
            return response()->json([
                'success' => false,
                'errors' => ['cin_image' => 'OCR Error: ' . ($result['error'] ?? 'Unknown error')]
            ], 422);
        }
    
        $text = $result['text'] ?? '';
        $nom = $request->Nom;
        $prenom = $request->Prenom;
        $cin = $request->Cin;
    
        // Verify extracted text contains the required information
        $nomFound = stripos($text, $nom) !== false;
        $prenomFound = stripos($text, $prenom) !== false;
        $cinFound = stripos($text, $cin) !== false;
    
        if (!$nomFound || !$prenomFound || !$cinFound) {
            unlink($path);

            // return response()->json([
            //     'success' => false,
            //     // 'text' => $text,
            //     'errors' => ['cin_image' => 'Vos informations saisies ne correspondent pas aux informations de votre carte']
            // ], 422);
         return redirect()->back()->withErrors(['cin_image' => 'Vos informations saisies ne correspondent pas aux informations de votre carte.']);

        }

        $user = User::create([
            "Nom" => $request->Nom,
            "Prenom" => $request->Prenom,
            "Cin" =>$request->Cin,
            "Role" => "client",
            "email" =>$request->email,
            "telephone" => $request->telephone,
            "password" => Hash::make($request->password),
            'cin_image' => $imageName,
            'adresse' =>$request->adresse,
            'birthday' =>$request->birthday,
        ]);

        $generatedCode=$this->generateAndSendCode($user);
        return redirect()->route('email_veri')->with([
            'email' => $request->email,
            'code' => $generatedCode 
        ]);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|numeric',
        ]);
    
        $verification_code=Session::get('verification_code');
        $verification_code_expires_at= Session::get('verification_code_expires_at');
        $email = Session::get('verification_email'); 
    
        if (now()->gt($verification_code_expires_at)) {
            return redirect()->route('email_veri')->with('error', 'Code expiré.');
        }

        if ($verification_code != $request->verification_code) {
            return redirect()->route('email_veri')
            ->withErrors(['code' => 'Code incorrect.'])
            ->withInput();       
        }
        $user = User::where('email', $email)->first();
    
        $user->update([
            'email_verified_at' => now(),
        ]);
        $code_securite = (rand(1000, 9999));
        $compte= Compte::create([
        'user_id' => $user->id,
        'type_compte' => 'courant', 
        'solde' => 0, 
        'statut' => 'actif',
        'numero_compte' => rand(1000000, 9999999),
        'numero_carte' => implode(' ', str_split(rand(1000000000000000, 9999999999999999), 4)),
        'type_carte' => 'mastercard',
        'rip' => Compte::generateRib(),
        'CVV_CVC'=> rand(100, 999),
        'date_expiration' => now()->addYears(5)->format('m/y'),
        'etat' => 'active',
        'plafond_journalier' => 5000.00,
        'code_securite' => bcrypt($code_securite),
    ]); 
        $carte = $compte->numero_carte;
        Mail::to($user->email)->send(new CodePin($user, $code_securite, $carte));

        Auth::login($user);

        return redirect()->route('client')// ->with('success', 'Vérification réussie !') ;
    ;}
        public function createNewBankAccount(Request $request){
        $user = Auth::user();
        $typeCarte = in_array($request->type_compte, ['courant', 'epargne']) ? 'mastercard' : 'visa';
        if ($request->type_compte == 'courant') {
            $plafond = 5000.00;
        } elseif ($request->type_compte == 'epargne') {
            $plafond = 1000.00;
        } else {
            $plafond = 10000.00;
        }
        $code_securite = (rand(1000, 9999));

        $compte=Compte::create([
            'user_id' => $user->id,
            'type_compte' => $request->type_compte,
            'solde' => 0,
            'statut' => 'actif',
            'numero_compte' => rand(1000000, 9999999),
            'numero_carte' => implode(' ', str_split(rand(1000000000000000, 9999999999999999), 4)),
            'type_carte' => $typeCarte,
            'rip' => Compte::generateRib(),
            'CVV_CVC'=> rand(100, 999),
            'date_expiration' => now()->addYears(5)->format('m/y'),
            'etat' => 'active',
            'plafond_journalier' => $plafond,
            'code_securite' => bcrypt($code_securite),
            ]);
        $carte = $compte->numero_carte;
        Mail::to($user->email)->send(new CodePin($user, $code_securite, $carte));

        session(['compteAddionelle' => $request->type_compte]);

        return redirect()->route('accounts')->with('success', 'Compte bancaire créé avec succès.');
    }


    public function generateAndSendCode(User $user)
    {
        // Générer un code (6 chiffres)
        $code = mt_rand(100000, 999999);

        // Sauvegarder le code + expiration (5 min)
        Session::put('verification_code', $code);
        Session::put('verification_code_expires_at', now()->addMinutes(5));
        Session::put('verification_email', $user->email);

        // Envoyer l'email
        Mail::to($user->email)->send(new ProfileMail($user, $code));
        return $code; 
    }


    public function login(Request $request)
{
    $request->validate([
        'Cin' => 'required|string|alpha_num',
        'password' => 'required|string',
    ]);

    if (Auth::attempt(['Cin' => $request->Cin, 'password' => $request->password])) {
        $request->session()->regenerate();

        return redirect()->route('client'); 
    }

    return back()->withErrors([
        'Cin' => 'CIN ou mot de passe invalide.'
    ])->onlyInput('Cin');
}


    public function changeProfile(Request $request){
        $request->validate([
            'telephone' => 'required|alpha_num',
            'adresse' => 'required|string|max:255',
            'current_password' => 'required|string|min:8',
            'email' => 'required|email',
            'new_password' => 'nullable|string|confirmed|min:8',
            'new_password_confirmation' => 'nullable|string|min:8',
        ]);
        $user = User::find(Auth::id());
        if(!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Le mot de passe actuel est incorrect.'
            ])->onlyInput('current_password');
        }
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->adresse = $request->adresse;
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }
        $user->save();
        return redirect()->route('settings')->with('success', 'Profile updated successfully.');
        
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function test1(Request $request){
        $request->validate([
            'modpass'=> 'required',
        ]);
    }
    public function test2(Request $request){
        return view('test1');
    }

}