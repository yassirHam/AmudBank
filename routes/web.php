<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminLoginController;
use App\Http\Controllers\MiniAdminLoginController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MiniAdminController;
use App\Models\ActivityLog;
use App\Models\Credit;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CreditController;

Route::get('/', [AdminController::class, 'main'])->name('home');
Route::get('/login', [AdminController::class, 'showinglogin'])->name('login');
Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

Route::post('/register/Informations_personnelles', [AdminController::class, 'register_step1'])->name('register_step1');
Route::get('/register/Informations_personnelles', [AdminController::class, 'showregister'])->name('register_step1');
Route::get('/register/email_verification', [AdminController::class, 'showRegistration'])->name('email_veri');
Route::Post('/register/email_verification',[AdminController::class, 'verifyCode'])->name('email_verification');


Route::PATCH('/changeProfile',[AdminController::class,'changeProfile'])->name('changeProfile');

Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::post('/comptes/creer',[AdminController::class,'createNewBankAccount'])->name('createNewBankAccount')->middleware('auth');

Route::get('/client/transactionshistory', [operationController::class, 'showtransactionsHistory'])->name('transactionsHistory')->middleware('auth');
Route::get('/client', [operationController::class, 'showoverview'])->name('client')->middleware('auth');
Route::get('/client/accounts', [operationController::class, 'showaccounts'])->name('accounts')->middleware('auth');
Route::get('/client/settings', [operationController::class, 'showsettings'])->name('settings');
Route::get('client/transactions', [operationController::class, 'showtransactions'])->name('transactions')->middleware('auth');
Route::post('/client/transactions', [TransactionController::class, 'faireTransactions'])->name('faireTransactions')->middleware('auth');
Route::get('/client/test', [operationController::class, 'test'])->name('test');
Route::post('/internal-transfer', [TransactionController::class, 'internalTransfer'])->name('internal_transfer');
Route::get('/client/cardinfo', [operationController::class, 'showcardinfo'])->name('cardinfo')->middleware('auth');
Route::get('client/credit', [operationController::class, 'showcredit'])->name('credit')->middleware('auth');
Route::post('/client/requestdelete', [operationController::class, 'requestdelete'])->name('requestdelete')->middleware('auth');
Route::post('/client/credit', [CreditController::class, 'submitCreditRequest'])->name('submitCreditRequest')->middleware('auth');

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
        $miniAdmin = auth('mini_admins')->user();
        $credits = Credit::with('user')->latest()->take(5)->get();
        return view('mini-admin.dashboard', compact('miniAdmin', 'credits'));
    })->name('dashboard');

    // ✅ Add this route for user management
    Route::get('/users', [UserController::class, 'index2'])->name('user.index');

      // ✅ Dynamic user freeze/unfreeze routes
    Route::post('/user/{user}/freeze', [UserController::class, 'freezeAccount'])->name('user.freeze');
    Route::post('/user/{user}/unfreeze', [UserController::class, 'unfreezeAccount'])->name('user.unfreeze');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('/credits', [CreditController::class, 'index'])->name('credit.index');
    Route::post('/credit/{credit}/update-status', [CreditController::class, 'updateStatus'])->name('credit.update.status');
    // Logout
    Route::post('/logout', function () {
        auth('mini_admins')->logout();
        return redirect()->route('mini-admin.login');
    })->name('logout');
});