<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carte;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileMail;
use Illuminate\Support\Facades\Session;
use App\Models\Compte;

class AdminController extends Controller
{
    public function showinglogin()
    {
        return view('login');
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
            return response()->json([
                'success' => false,
                'errors' => ['cin_image' => 'Vos informations saisies ne correspondent pas aux informations de votre carte']
            ], 422);
        }

        $user = User::create([
            "Nom" => $request->Nom,
            "Prenom" => $request->Prenom,
            "Cin" =>$request->Cin,
            "Role" => "client",
            "email" =>$request->email,
            "telephone" => $request->telephone,
            "password" => Hash::make($request->password),
            'rip' => User::generateRib(),
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
    public function createNewBankAccount(Request $request){
        $user = Auth::user();
        $compte=Compte::create([
            'user_id' => $user->id,
            'type_compte' => $request->type_compte,
            'solde' => 0,
            'statut' => 'actif',
            'date_ouverture' => now(),
        ]);
        $this->createCard($compte);
        return redirect()->route('client')->with('success', 'Compte bancaire créé avec succès.');
    }
    protected function createBankAccount(User $user)
{
    return Compte::create([
        'user_id' => $user->id,
        'type_compte' => 'courant', 
        'solde' => 0, 
        'statut' => 'actif',
        'date_ouverture' => now(),
    ]);
}
protected function createCard(Compte $compte)
{
    $typeCarte = in_array($compte->type_compte, ['courant', 'epargne']) ? 'mastercard' : 'visa';

    if ($compte->type_compte == 'courant') {
        $plafond = 5000.00;
    } elseif ($compte->type_compte == 'epargne') {
        $plafond = 1000.00;
    } else {
        $plafond = 10000.00;
    }

    return Carte::create([
        'compte_id' => $compte->id,
        'numero_compte' => rand(1000000, 9999999),
        'numero_carte' => rand(1000000000000000, 9999999999999999),
        'type_carte' => $typeCarte,
        'date_expiration' => now()->addYears(5)->endOfMonth()->format('Y-m-d'),
        'etat' => 'active',
        'date_creation' => now(),
        // 'plafond_journalier' => $plafond,
        'code_securite' => bcrypt(rand(1000, 9999)),
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
    

        // Mark as verified
        $user->update([
            'email_verified_at' => now(),
        ]);
        $compte=$this->createBankAccount($user);
        $this->createCard($compte);

        Auth::login($user);
    
        return redirect()->route('client')// ->with('success', 'Vérification réussie !') ;
    ;}
        


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
            
            return match (Auth::user()->Role) {
                'client' => redirect()->route('client'),
                'admin' => redirect()->route('admin'),
                default => redirect()->route('main'),
            };
        }

        return back()->withErrors([
            'Cin' => 'Invalid CIN or password'
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
        $user = Auth::user();
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

        return redirect()->route('client')->with('success', 'Profile updated successfully.');
        
    }
    public function cartesBancaires(Request $request)
    {
        $user = Auth::user();
        

    }
    public function compte($user)
    {
        


    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}