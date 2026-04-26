<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\BankAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the user's bank accounts.
     */
    public function index(): View
    {
        $bankAccounts = Auth::user()->bankAccounts()->get();
        
        return view('bank_accounts.index', [
            'bankAccounts' => $bankAccounts,
        ]);
    }

    /**
     * Store a new bank account for the user.
     */
    public function store(Request $request): RedirectResponse
    {
        // Simulate bank API (Plaid-like)
        $banks = ['Chase', 'Bank of America', 'Wells Fargo', 'CitiBank', 'Capital One'];
        $bankName = $banks[array_rand($banks)];
        $maskedAccount = '**** **** **** ' . rand(1000, 9999);

        $bankAccount = Auth::user()->bankAccounts()->create([
            'bank_name' => $bankName,
            'masked_account' => $maskedAccount,
            'balance' => rand(10000, 100000), // Random initial balance
        ]);

        // Log the bank linking action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Bank Linking',
            'status' => 'success',
            'details' => "Linked $bankName account ending in " . substr($maskedAccount, -4),
            'timestamp' => now(),
        ]);

        return redirect()->route('bank_accounts.index')
            ->with('status', "Bank account linked successfully: $bankName ($maskedAccount)");
    }

    /**
     * Remove a bank account from the user.
     */
    public function destroy(BankAccount $bankAccount): RedirectResponse
    {
        // Ensure the user owns this bank account
        $this->authorize('delete', $bankAccount);

        $bankAccount->delete();

        return redirect()->route('bank_accounts.index')
            ->with('status', 'Bank account removed.');
    }
}