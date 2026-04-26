<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\InvestorAccreditationController;
use App\Http\Controllers\KycController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Onboarding routes
Route::get('/onboarding', [OnboardingController::class, 'showForm'])->name('onboarding');
Route::get('/login', fn() => redirect()->route('onboarding'))->name('login');
Route::post('/onboarding', [OnboardingController::class, 'store'])->name('onboarding.store');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $auditLogs = $user->auditLogs()->orderBy('timestamp', 'desc')->take(5)->get();
        return view('dashboard', compact('auditLogs'));
    })->name('dashboard');


    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    // Bank Account routes
    Route::get('/bank-accounts', [BankAccountController::class, 'index'])->name('bank_accounts.index');
    Route::post('/bank-accounts', [BankAccountController::class, 'store'])->name('bank_accounts.store');
    Route::delete('/bank-accounts/{bankAccount}', [BankAccountController::class, 'destroy'])->name('bank_accounts.destroy');

    // Transaction routes
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

    // Audit Log routes
    Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit_logs.index');
    Route::get('/audit-logs/{auditLog}', [AuditLogController::class, 'show'])->name('audit_logs.show');

    // KYC routes
    Route::get('/kyc', [KycController::class, 'index'])->name('kyc.index');
    Route::post('/kyc/start', [KycController::class, 'start'])->name('kyc.start');

    // Investor Accreditation routes
    Route::get('/accreditation', [InvestorAccreditationController::class, 'index'])->name('accreditation.index');
    Route::post('/accreditation/verify', [InvestorAccreditationController::class, 'verify'])->name('accreditation.verify');
});
