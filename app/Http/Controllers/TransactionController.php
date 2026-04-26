<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of the user's transactions.
     */
    public function index(Request $request): View
    {
        $query = Auth::user()->transactions();

        // Filter by status if provided
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        return view('transactions.index', [
            'transactions' => $transactions,
        ]);
    }

    /**
     * Store a new transaction for the user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'bank_account_id' => 'required|exists:bank_accounts,id,user_id,' . Auth::id(),
        ]);

        $user = Auth::user();

        // Compliance Gate
        if ($user->kyc_status !== 'success' || $user->accreditation_status !== 'success') {
            return redirect()->back()->withErrors(['error' => 'Compliance Required: You must complete both KYC verification and Investor Accreditation before making an investment.']);
        }

        $bankAccount = $user->bankAccounts()->find($validated['bank_account_id']);

        if ($bankAccount->balance < $validated['amount']) {
            // Log failure
            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'Investment',
                'status' => 'failure',
                'details' => 'Insufficient balance in ' . $bankAccount->bank_name . '. Requested: $' . number_format($validated['amount'], 2),
                'timestamp' => now(),
            ]);

            return redirect()->back()->withErrors(['amount' => 'Insufficient balance in the selected bank account.']);
        }

        // Deduct balance
        $bankAccount->decrement('balance', $validated['amount']);

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'bank_account_id' => $validated['bank_account_id'],
            'amount' => $validated['amount'],
            'status' => 'success',
        ]);

        // Log the investment action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Investment',
            'status' => 'success',
            'details' => 'Investment of $' . number_format($validated['amount'], 2) . ' from ' . $bankAccount->bank_name . ' to Law Firm Escrow.',
            'timestamp' => now(),
        ]);

        return redirect()->route('transactions.index')
            ->with('status', 'Investment of $' . number_format($validated['amount'], 2) . ' initiated successfully to Law Firm Escrow Account.');

    }

    /**
     * Display the specified transaction.
     */
    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);

        return view('transactions.show', [
            'transaction' => $transaction,
        ]);
    }
}