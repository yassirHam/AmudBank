<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\CreditStatutMail;
use Illuminate\Support\Facades\Mail;

class CreditController extends Controller
{
    public function showCreditForm()
    {
        return view('credit');
    }

    public function submitCreditRequest(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'type' => 'required|string',
            'duration' => 'required|integer',
            'motif_credit' => 'required|string',
            'compte_bancaire' => 'required|string',
            'revenu_mensuel' => 'required|string',
            'Attestation_travail_contrat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'Bulletins_salaire' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        /** @var \App\Models\User $user */
        $user = Auth::user();

        Credit::create([
            'user_id' => $user->id,
            'montant' => $request->montant,
            'type' => $request->type,
            'duree' => $request->duration,
            'motif_credit' => $request->motif_credit,
            'compte_bancaire' => $request->compte_bancaire,
            'revenu_mensuel' => $request->revenu_mensuel,
            'Attestation_travail_contrat' => $request->file('Attestation_travail_contrat')->store('documents'),
            'Bulletins_salaire' => $request->file('Bulletins_salaire')->store('documents'),
            'paiement_mensuel' => $request->paiement_mensuel,
        ]);

        return redirect()->back()->with('success', 'Demande de crédit soumise avec succès.');
    }
    public function index()
    {
        $credits = Credit::with('user')->get();
        $miniAdmin = auth('mini_admins')->user();

        return view('mini-admin.credits.index', compact('credits', 'miniAdmin'));
    }
    public function updateStatus(Request $request, Credit $credit)
    {
        /** @var \App\Models\MiniAdmin $miniAdmin */
        $miniAdmin = auth('mini_admins')->user();
        if (!$miniAdmin || !$miniAdmin->hasPermission('manage_credits')) {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'statut' => 'required|in:approuve,rejete'
        ]);
        $credit->update(['statut' => $request->statut]);
        $user=$credit->user;
        Mail::to($user->email)->send(new CreditStatutMail($user, $request->statut)); 
        
        $miniAdmin->logAction(
            $request->statut === 'approuve' ? 'credit_approved' : 'credit_rejected',
            "Credit #{$credit->id} {$request->statut} "
        );
        return back()->with('success', 'Statut du crédit mis à jour avec succès.');
    }
}