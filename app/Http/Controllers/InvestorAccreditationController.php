<?php
 
namespace App\Http\Controllers;
 
use App\Models\AuditLog;
use Illuminate\Http\Request;

class InvestorAccreditationController extends Controller
{
    public function index()
    {
        return view('accreditation.index', [
            'user' => auth()->user()
        ]);
    }

    public function verify()
    {
        $user = auth()->user();

        // Simulate Accreditation provider (e.g., Accred, Veriff)
        // 60% success, 10% failure, 30% pending (takes 12-48 hours)
        $rand = rand(1, 100);
        if ($rand <= 60) {
            $status = 'success';
        } elseif ($rand <= 70) {
            $status = 'failure';
        } else {
            $status = 'pending';
        }

        // Persist to user
        $user->update(['accreditation_status' => $status]);

        // Log attempt with transition details
        $oldStatus = $user->getOriginal('accreditation_status') ?: 'Incomplete';
        $details = "Accreditation status changed from " . ucfirst($oldStatus) . " to " . ucfirst($status) . ".";
        
        if ($status == 'failure') {
            $details .= " Reason: Income verification documents were non-conforming.";
        }

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Investor Accreditation',
            'status' => $status,
            'details' => $details,
            'timestamp' => now(),
        ]);

        return redirect()->route('accreditation.index')->with('status', "Accreditation status: " . ucfirst($status));
    }
}
