<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\BankAccount;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class OnboardingController extends Controller
{
    /**
     * Show the onboarding form.
     */
    public function showForm(): View
    {
        return view('onboarding.form');
    }

    /**
     * Store a new onboarding record.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nationality' => 'required|string|max:255',
            'domicile' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'nationality' => $validated['nationality'],
            'domicile' => $validated['domicile'],
            'phone' => $validated['phone'],
            'kyc_status' => 'pending',
            'accreditation_status' => 'pending',
        ]);

        // Log the onboarding action
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Onboarding',
            'status' => 'success',
            'timestamp' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('status', 'Welcome! Your account has been created.');
    }
}