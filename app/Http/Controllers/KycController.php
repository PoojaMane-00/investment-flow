<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AuditLog;

class KycController extends Controller
{
    public function index()
    {
        return view('kyc.index', [
            'user' => auth()->user()
        ]);
    }

    public function start()
    {
        $user = auth()->user();

        // Randomized KYC result to simulate provider
        // 70% success, 20% failure, 10% pending
        $rand = rand(1, 100);
        if ($rand <= 70) {
            $status = 'success';
        } elseif ($rand <= 90) {
            $status = 'failure';
        } else {
            $status = 'pending';
        }

        // Persist to user
        $user->update(['kyc_status' => $status]);

        // Log attempt with details
        $details = match($status) {
            'success' => 'Identity verification completed successfully via biometric scan.',
            'failure' => 'Identity verification failed: Document clarity insufficient.',
            'pending' => 'Identity verification is being processed by the compliance team.',
            default => null
        };

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'KYC',
            'status' => $status,
            'details' => $details,
            'timestamp' => now(),
        ]);

        return redirect()->route('kyc.index')->with('status', "KYC verification result: " . ucfirst($status));
    }
}
