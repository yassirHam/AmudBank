<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Delete_request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperationController extends Controller
{
    public function showTransactions()
    {
        return view('transactions');
    }

    public function test()
    {
        return view('test');
    }

    public function showCredit()
    {
        return view('credit');
    }

    public function showCardInfo(Request $request)
    {
        $compte = Compte::find($request->query('id'));
        return view('cardinfo', compact('compte'));
    }

    public function showTransactionsHistory(Request $request)
    {
        $type_compte = $request->type_compte
            ?? ['courant', 'epargne', 'professionnel'];

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Now that $user is known, your IDE will pick up ->transactions()
        $transactions = $user
            ->transactions()
            ->whereIn('type_compte', $type_compte)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('transactionsHistory', compact('transactions'));
    }

    public function showOverview()
    {
        // Use Auth::id() so the helper isn’t underlined
        $comptes = Compte::where('user_id', Auth::id())->get();

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $transactions = $user
            ->transactions()
            ->whereIn('type_compte', ['courant', 'epargne', 'professionnel'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('Overview', compact('transactions', 'comptes'));
    }

    public function showAccounts()
    {
        $comptes = Compte::where('user_id', Auth::id())->get();
        return view('accounts', compact('comptes'));
    }

    public function showSettings()
    {
        return view('Settings');
    }

    public function requestDelete(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        Delete_request::create([
            'user_id'      => $user->id,
            'motif'        => $request->motif,
            'type_compte'  => $request->type_compte,
            'reponse'      => 'en_attente',
        ]);

        return redirect()->back()
            ->with('success', 'Delete request submitted successfully.');
    }
}
