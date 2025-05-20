<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class MiniAdminLoginController extends Controller
{
    /**
     * Show the login form for mini-admins.
     *
     * @return \Illuminate\View\View
     */
public function showLoginForm()
{
    return view('mini-admin.login');
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
    if (Auth::guard('mini_admins')->attempt($credentials)) {
        return redirect()->intended('/mini-admin/dashboard');
    }
    return back()->withErrors(['email' => 'Invalid credentials']);
}
}