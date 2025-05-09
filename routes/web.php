<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Mail\ProfileMail;

Route::get('/', [AdminController::class, 'main'])->name('home');
Route::get('/login', [AdminController::class, 'showinglogin'])->name('login');
Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

// Registration routes
Route::post('/register/step1', [AdminController::class, 'register_step1'])->name('register_step1');
Route::get('/register/email_verification', [AdminController::class, 'showRegistration'])->name('email_veri');
Route::Post('/register/email_verification',[AdminController::class, 'verifyCode'])->name('email_verification');

// Client route
Route::get('/client', function () {
    return view('client');
})->name('client')->middleware('auth');

Route::PATCH('/changeProfile',[AdminController::class,'changeProfile'])->name('changeProfile');

// Logout
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::post('/comptes/creer',[AdminController::class,'createNewBankAccount'])->name('createNewBankAccount')->middleware('auth');