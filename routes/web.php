<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminLoginController;
use App\Http\Controllers\MiniAdminLoginController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MiniAdminController;
use App\Models\ActivityLog;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Public Routes
Route::get('/', [AdminController::class, 'main'])->name('home');
Route::get('/login', [AdminController::class, 'showinglogin'])->name('login');
Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

// Registration Routes
Route::post('/register/step1', [AdminController::class, 'register_step1'])->name('register_step1');
Route::get('/register/email_verification', [AdminController::class, 'showRegistration'])->name('email_veri');
Route::post('/register/email_verification', [AdminController::class, 'verifyCode'])->name('email_verification');

// Client Route
Route::get('/client', function () {
    return view('client');
})->name('client')->middleware('auth');

Route::patch('/changeProfile', [AdminController::class, 'changeProfile'])->name('changeProfile');

// Logout
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

// Bank Account Route
Route::post('/comptes/creer', [AdminController::class, 'createNewBankAccount'])
    ->name('createNewBankAccount')
    ->middleware('auth:users');

// routes/web.php

// SuperAdmin Public Routes (Login)
Route::prefix('super-admin')->name('super-admin.')->group(function () {
    // 🔓 Public login routes
    Route::get('/login/{secret}', [SuperAdminLoginController::class, 'showLoginForm'])
        ->where('secret', '[A-Za-z0-9]{32}')
        ->name('login');

    Route::post('/login/{secret}', [SuperAdminLoginController::class, 'login'])
        ->where('secret', '[A-Za-z0-9]{32}')
        ->middleware('throttle:5,1');
});

// Protected SuperAdmin Routes (Dashboard, User Management, etc.)
Route::prefix('super-admin')->name('super-admin.')->middleware('auth:super_admin')->group(function () {
    Route::get('/dashboard', function () {
        $recentActivity = ActivityLog::with('miniAdmin')
            ->latest()
            ->take(10)
            ->get();

        return view('super-admin.dashboard', compact('recentActivity'));
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::post('/mini-admin/create', [SuperAdminController::class, 'createMiniAdmin'])->name('mini-admin.create');

    // 🔐 Protected logout
    Route::post('/logout', function () {
        auth('super_admin')->logout();
        return redirect()->route('super-admin.login', ['secret' => env('SUPER_ADMIN_SECRET')]);
    })->name('logout');

    // MiniAdmin Management Routes (protected)
    Route::get('/mini-admins', [MiniAdminController::class, 'index'])->name('mini-admin.index');
    Route::get('/mini-admins/{miniAdmin}/edit', [MiniAdminController::class, 'edit'])->name('mini-admin.edit');
    Route::put('/mini-admins/{miniAdmin}', [MiniAdminController::class, 'update'])->name('mini-admin.update');
    Route::delete('/mini-admins/{miniAdmin}', [MiniAdminController::class, 'destroy'])->name('mini-admin.destroy');
});
// MiniAdmin Public Routes (Login)
Route::prefix('mini-admin')->name('mini-admin.')->group(function () {
    Route::get('/login', [MiniAdminLoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [MiniAdminLoginController::class, 'login'])
        ->name('login.submit');
});
// MiniAdmin Routes
Route::prefix('mini-admin')->name('mini-admin.')->middleware('auth:mini_admins')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth('mini_admins')->user();
        return view('mini-admin.dashboard', compact('user'));
    })->name('dashboard');

    // ✅ Add this route for user management
    Route::get('/users', [UserController::class, 'index2'])->name('user.index');

      // ✅ Dynamic user freeze/unfreeze routes
    Route::post('/user/{user}/freeze', [UserController::class, 'freezeAccount'])->name('user.freeze');
    Route::post('/user/{user}/unfreeze', [UserController::class, 'unfreezeAccount'])->name('user.unfreeze');
    // Logout
    Route::post('/logout', function () {
        auth('mini_admins')->logout();
        return redirect()->route('mini-admin.login');
    })->name('logout');
});