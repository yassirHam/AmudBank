<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MiniAdmin;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
         $user = auth('super_admin')->user();
        return view('super-admin.user.index', compact('users'));
    }
    public function index2()
    {
        $users = User::all();
        $user = auth('mini_admins')->user();
        $miniAdmin = auth('mini_admins')->user();
        return view('mini-admin.user.index', compact('users', 'miniAdmin'));
    }
    public function freezeAccount(User $user)
{
    /** @var \App\Models\MiniAdmin $miniAdmin */
    $miniAdmin = auth('mini_admins')->user();

    if (!$miniAdmin || !$miniAdmin->hasPermission('freeze_accounts')) {
        abort(403, 'Unauthorized');
    }

    $user->update(['status' => 'frozen']);
    $miniAdmin->logAction('account_frozen', "Account {$user->name} {$user->Cin} frozen by {$miniAdmin->email}");
    
    return back()->with('success', 'Account frozen successfully!');
}
    public function unfreezeAccount(User $user)
    {
        /** @var \App\Models\MiniAdmin $miniAdmin */
        $miniAdmin = auth('mini_admins')->user();

        if (!$miniAdmin || !method_exists($miniAdmin, 'hasPermission') || !$miniAdmin->hasPermission('unfreeze_accounts')) {
            abort(403, 'Unauthorized');
        }

        $user->update(['status' => 'active']);
        $miniAdmin->logAction('account_unfrozen', "Account {$user->name} {$user->Cin} frozen by {$miniAdmin->email}");
        
        return back()->with('success', 'Account unfrozen successfully!');
    }
    public function destroy(User $user)
{
    /** @var \App\Models\MiniAdmin $miniAdmin */
    $miniAdmin = auth('mini_admins')->user();
    if (!$miniAdmin || !in_array('delete_users', $miniAdmin->permissions ?? [])) {
        abort(403, 'You do not have permission to delete users');
    }
    $miniAdmin->logAction('user_deleted', "User {$user->email} deleted by {$miniAdmin->email}");
    $user->delete();
    return back()->with('success', 'User deleted successfully!');
}
}