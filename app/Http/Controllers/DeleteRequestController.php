<?php

namespace App\Http\Controllers;

use App\Models\Delete_request;
use App\Models\MiniAdmin;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteRequestController extends Controller
{
    public function index()
    {
        $requests = Delete_request::with(['user' => fn ($query) => $query->withTrashed()])->get();
        $miniAdmin = auth('mini_admins')->user();

        return view('mini-admin.delete-requests.index', compact('requests', 'miniAdmin'));
    }

    public function approve(Delete_request $request)
    {
        /** @var \App\Models\MiniAdmin $miniAdmin */
        $miniAdmin = auth('mini_admins')->user();

        if (!$miniAdmin || !$miniAdmin->hasPermission('manage_delete_requests')) {
            abort(403, 'Unauthorized');
        }
        $request->update(['reponse' => 'approuve']);
        $user = $request->user;
        if ($user) {
            $user->delete();
            $miniAdmin->logAction('account_deleted', "User {$user->email} deleted via request");
        }

        return back()->with('success', 'Account deletion approved and user soft-deleted successfully.');
    }
    public function reject(Delete_request $request)
    {
        /** @var \App\Models\MiniAdmin $miniAdmin */
        $miniAdmin = auth('mini_admins')->user();

        if (!$miniAdmin || !$miniAdmin->hasPermission('manage_delete_requests')) {
            abort(403, 'Unauthorized');
        }
        $request->update(['reponse' => 'rejete']);

        $user = $request->user;
        $email = $user?->email ?? 'unknown';

        $miniAdmin->logAction('account_delete_rejected', "Deletion request rejected for user {$email}");

        return back()->with('success', 'Deletion request rejected.');
    }
}
