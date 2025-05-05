<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminLoginController;
use App\Http\Controllers\MiniAdminLoginController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MiniAdminController;
use App\Models\MiniAdmin;
use App\Models\ActivityLog;

Route::get('/', function () {
    return view('welcome');
});

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