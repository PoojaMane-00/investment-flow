<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the user's audit logs.
     */
    public function index(Request $request): View
    {
        $query = Auth::user()->auditLogs();

        // Filter by action if provided
        if ($request->has('action') && $request->action) {
            $query->where('action', $request->action);
        }

        // Filter by status if provided
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $auditLogs = $query->orderBy('timestamp', 'desc')->get();

        return view('audit_logs.index', [
            'auditLogs' => $auditLogs,
        ]);
    }

    /**
     * Display the specified audit log.
     */
    public function show(AuditLog $auditLog)
    {
        $this->authorize('view', $auditLog);

        return view('audit_logs.show', [
            'auditLog' => $auditLog,
        ]);
    }
}