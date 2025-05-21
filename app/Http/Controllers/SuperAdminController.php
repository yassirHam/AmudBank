<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use App\Models\MiniAdmin;
class SuperAdminController extends Controller
{

public function createMiniAdmin(Request $request)
{
    $validated = $request->validate([
        'email' => ['required', 'email', 'unique:mini_admins'],
        'password' => ['required'],
    ]);
    MiniAdmin::create([
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);
    return redirect()->back()->with('success', 'MiniAdmin created!');
}
}
