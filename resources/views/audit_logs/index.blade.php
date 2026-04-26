@extends('layouts.portal')

@section('content')
<div class="w-full max-w-7xl mx-auto space-y-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Security & Audit Logs</h2>
        <p class="text-slate-400 mt-1">A verifiable and immutable record of your platform activity.</p>
    </div>

    <div class="space-y-4">
        @forelse ($auditLogs as $log)
        <div class="glass-card p-6 rounded-3xl border border-white/5 flex items-start justify-between hover:bg-white/[0.02] transition group">
            <div class="flex items-start">
                <div class="mt-1 p-4 {{ $log->status == 'success' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-amber-500/10 text-amber-400' }} rounded-2xl mr-6 transition group-hover:scale-110">
                    @if ($log->action == 'Onboarding')
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    @elseif ($log->action == 'Bank Linking')
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    @else
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    @endif
                </div>
                <div>
                    <h4 class="font-bold text-white text-xl tracking-tight">{{ $log->action }}</h4>
                    <p class="text-slate-400 text-sm mt-1">{{ $log->details ?: 'Transaction verified with status: ' . ucfirst($log->status) }}</p>
                    <div class="flex items-center mt-4 text-[10px] text-slate-600 font-bold uppercase tracking-widest">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $log->timestamp ? $log->timestamp->format('F d, Y \a\t h:i A') : 'N/A' }}
                    </div>
                </div>
            </div>
            <div class="hidden sm:block">
                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $log->status == 'success' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20' }}">
                    {{ $log->status }}
                </span>
            </div>
        </div>
        @empty
        <div class="glass-card p-20 rounded-3xl text-center border border-white/5">
            <div class="flex flex-col items-center">
                <div class="w-16 h-16 bg-white/[0.02] rounded-3xl flex items-center justify-center mb-4 border border-white/5">
                    <svg class="w-8 h-8 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <p class="text-slate-600 font-bold tracking-widest uppercase text-xs">Security vault empty</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
