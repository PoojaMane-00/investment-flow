@extends('layouts.portal')

@section('content')
<div class="w-full max-w-4xl mx-auto space-y-8">
    <div class="flex items-center space-x-4">
        <a href="{{ route('audit_logs.index') }}" class="p-3 bg-white/5 border border-white/10 rounded-xl text-slate-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h2 class="text-3xl font-extrabold text-white tracking-tight">Audit Event Detail</h2>
            <p class="text-slate-400 mt-1 uppercase text-[10px] font-black tracking-[0.2em]">Security Tracking</p>
        </div>
    </div>

    <div class="glass-card rounded-3xl overflow-hidden border border-white/5">
        <div class="p-10 border-b border-white/5 bg-slate-900/50 flex justify-between items-center">
            <div class="flex items-center">
                <div class="p-4 {{ $auditLog->status == 'success' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-rose-500/10 text-rose-400' }} rounded-2xl mr-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-white tracking-tight">{{ $auditLog->action }}</h3>
                    <p class="text-slate-500 text-sm mt-1 uppercase tracking-widest font-black text-[10px]">Reference #{{ $auditLog->id }}</p>
                </div>
            </div>
            <div class="text-right">
                <span class="px-5 py-2 rounded-full {{ $auditLog->status == 'success' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/20' : 'bg-rose-500/20 text-rose-400 border border-rose-500/20' }} text-[10px] font-black tracking-widest uppercase">
                    {{ $auditLog->status }}
                </span>
            </div>
        </div>

        <div class="p-10 space-y-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2">Event Description</p>
                    <p class="text-white font-medium leading-relaxed">
                        A security-relevant event was triggered by the system for the action "{{ $auditLog->action }}". 
                        This event has been logged for regulatory compliance and user security audit trails.
                    </p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2">Verification Timestamp</p>
                    <p class="text-white font-bold text-lg">{{ $auditLog->timestamp ? $auditLog->timestamp->format('F d, Y \a\t h:i:s A') : 'N/A' }}</p>
                    <p class="text-slate-500 text-xs mt-1 uppercase font-bold tracking-tighter">UTC Synchronization Active</p>
                </div>
            </div>

            <div class="p-8 rounded-2xl bg-white/[0.02] border border-white/5">
                <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-4">Metadata Payload</p>
                <div class="font-mono text-xs text-indigo-300 space-y-2">
                    <p><span class="text-slate-500">USER_ID:</span> {{ $auditLog->user_id }}</p>
                    <p><span class="text-slate-500">ACTION_KEY:</span> {{ strtoupper(str_replace(' ', '_', $auditLog->action)) }}</p>
                    <p><span class="text-slate-500">INTEGRITY_HASH:</span> {{ hash('sha256', $auditLog->id . $auditLog->timestamp) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
