<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SuperAdminLoginController extends Controller
{
    public function showLoginForm($secret)
    {
        if (!hash_equals(env('SUPER_ADMIN_SECRET'), $secret)) {
            abort(403, 'Unauthorized access');
        }

        return view('super-admin.login', compact('secret'));
    }
    public function login(Request $request, $secret)
    {
        if (!hash_equals(env('SUPER_ADMIN_SECRET'), $secret)) {
            abort(403, 'Unauthorized access');
        }
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::guard('super_admin')->attempt($credentials)) {
            return redirect()->intended('/super-admin/dashboard');
        }
        return redirect()
            ->route('super-admin.login', ['secret' => $secret])
            ->withInput()
            ->withErrors(['email' => 'Invalid credentials']);
    }
}