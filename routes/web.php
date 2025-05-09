<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\SuperAdminLoginController;
use App\Http\Controllers\MiniAdminLoginController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MiniAdminController;
use App\Models\MiniAdmin;
use App\Models\ActivityLog;


=======
>>>>>>> cc89429808b39ce16bc0351bda686962c624473e
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

<<<<<<< HEAD
Route::post('/comptes/creer',[AdminController::class,'createNewBankAccount'])->name('createNewBankAccount')->middleware('auth');
// SuperAdmin Routes
Route::prefix('super-admin')->name('super-admin.')->group(function () {
    // GET login with secret in URL
    Route::get('/login/{secret}', [SuperAdminLoginController::class, 'showLoginForm'])
        ->where('secret', '[A-Za-z0-9]{32}')
        ->name('login');
    Route::post('/login/{secret}', [SuperAdminLoginController::class, 'login'])
        ->where('secret', '[A-Za-z0-9]{32}')
        ->middleware('throttle:5,1');

    Route::middleware('auth:super_admin')->group(function () {
        Route::get('/dashboard', function () {
            $recentActivity = ActivityLog::with('miniAdmin')
                ->latest()
                ->take(10)
                ->get();

            return view('super-admin.dashboard', compact('recentActivity'));
        })->name('dashboard');

        Route::post('/mini-admin/create', [SuperAdminController::class, 'createMiniAdmin'])->name('mini-admin.create');

        Route::post('/logout', function () {
            auth('super_admin')->logout();
            return redirect()->route('super-admin.login', ['secret' => env('SUPER_ADMIN_SECRET')]);
        })->name('logout');

        Route::get('/mini-admins', [MiniAdminController::class, 'index'])->name('mini-admin.index');
        Route::get('/mini-admins/{miniAdmin}/edit', [MiniAdminController::class, 'edit'])->name('mini-admin.edit');
        Route::put('/mini-admins/{miniAdmin}', [MiniAdminController::class, 'update'])->name('mini-admin.update');
        Route::delete('/mini-admins/{miniAdmin}', [MiniAdminController::class, 'destroy'])->name('mini-admin.destroy');
    });
});

// MiniAdmin Routes (unchanged)
Route::prefix('mini-admin')->name('mini-admin.')->group(function () {
    Route::get('/login', [MiniAdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [MiniAdminLoginController::class, 'login']);
    Route::middleware('auth:mini_admins')->group(function () {
        // ✅ Fixed: Pass $user to dashboard view
        Route::get('/dashboard', function () {
            $user = auth('mini_admins')->user(); // 👈 Fetch current MiniAdmin
            return view('mini-admin.dashboard', compact('user')); // 👈 Pass to view
        })->name('dashboard');

        Route::post('/logout', function () {
            auth('mini_admins')->logout();
            return redirect()->route('mini-admin.login');
        })->name('logout');
    });
});
=======
Route::post('/comptes/creer',[AdminController::class,'createNewBankAccount'])->name('createNewBankAccount')->middleware('auth');
>>>>>>> cc89429808b39ce16bc0351bda686962c624473e
