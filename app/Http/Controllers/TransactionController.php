<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Delete_request;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function faireTransactions(Request $request)
    {
        $request->validate([
            'montant'                => 'required|numeric|min:0',
            'source'                 => 'required|string|max:255',
            'description'            => 'required|string|max:255',
            'nom_complete'           => 'required|string|max:255',
            'num_compte_destinataire'=> 'required|digits:6',
            'banque_destinataire'    => 'required|string|max:255',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Vérifie que le compte existe dans "Amud Bnak"
        $compteDest = Compte::where('numero_compte', $request->num_compte_destinataire)
                            ->first();

        if ($request->banque_destinataire === 'Amud Bnak' && $compteDest) {
            // Now IDE knows $user is a User, so ->comptes() is recognized
            $compteSource = $user->comptes()
                                 ->where('type_compte', $request->source)
                                 ->first();

            if (! $compteSource) {
                return back()->withErrors(['compte_source' => 'Compte source introuvable.']);
            }

            if ($compteSource->solde < $request->montant) {
                return back()->withErrors(['fonds_insuffisants' => 'Fonds insuffisants.']);
            }

            // Mise à jour des soldes
            $compteSource->solde -= $request->montant;
            $compteSource->save();

            // Création de la transaction
            Transaction::create([
                'compte_id'                    => $compteSource->id,
                'numero_compte'                => $compteSource->numero_compte,
                'montant'                      => $request->montant,
                'compte_source'                => $request->source,
                'description'                  => $request->description,
                'nom_complete'                 => $request->nom_complete,
                'numero_compte_destination'    => $request->num_compte_destinataire,
                'status'                       => 'terminée',
                'transaction_type'             => 'externe',
            ]);

            return redirect()->route('transactions')
                             ->with('success', 'Transaction effectuée avec succès.');
        }

        return back()->withErrors(['banque_destinataire' => 'Ce compte n\'existe pas.']);
    }


    public function internalTransfer(Request $request)
    {
        $request->validate([
            'montant'              => 'required|numeric|min:0.01',
            'source'               => 'required|string|max:255',
            'compte_destinataire'  => 'required|string|max:255',
            'description'          => 'nullable|string|max:255',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($request->source === $request->compte_destinataire) {
            return back()->withErrors([
                'same_account' => 'Vous ne pouvez pas transférer vers le même compte.'
            ]);
        }

        $src = $user->comptes()
                    ->where('type_compte', $request->source)
                    ->first();
        if (! $src) {
            return back()->withErrors(['source' => 'Compte source introuvable.']);
        }
        if ($src->solde < $request->montant) {
            return back()->withErrors(['montant' => 'Fonds insuffisants.']);
        }

        $dest = $user->comptes()
                     ->where('type_compte', $request->compte_destinataire)
                     ->first();
        if (! $dest) {
            return back()->withErrors(['compte_destinataire' => 'Compte destinataire introuvable.']);
        }

        DB::transaction(function () use ($request, $src, $dest, $user) {
            $src->solde  -= $request->montant;
            $src->save();
            $dest->solde += $request->montant;
            $dest->save();

            Transaction::create([
                'compte_id'                    => $src->id,
                'numero_compte'                => $src->numero_compte,
                'montant'                      => $request->montant,
                'compte_source'                => $request->source,
                'status'                       => 'terminée',
                'transaction_type'             => 'virement',
                'description'                  => $request->description,
                'nom_complete'                 => $user->Nom . ' ' . $user->Prenom,
                'numero_compte_destination'    => $dest->numero_compte,
            ]);
        });

        return redirect()->route('transactions')
                         ->with('success', 'Virement interne effectué avec succès.');
    }
}
