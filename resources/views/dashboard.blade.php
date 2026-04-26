@extends('layouts.portal')

@section('content')
<div class="w-full max-w-7xl mx-auto space-y-10">
    <!-- Hero / Welcome -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-3xl font-extrabold text-white tracking-tight">Financial Overview</h2>
            <p class="text-slate-400 mt-1">Monitor your global investment portfolio and compliance status.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('transactions.index') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold transition shadow-lg shadow-indigo-500/20">
                New Investment
            </a>
        </div>
    </div>

    <!-- Investment Journey Flowchart (Dark) -->
    <div class="glass-card p-10 rounded-3xl overflow-x-auto">
        <h3 class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em] mb-10">Your Investment Journey</h3>
        <div class="flex items-center justify-between min-w-[800px] relative">
            <!-- Connection Lines -->
            <div class="absolute top-6 left-0 w-full h-[2px] bg-white/5 -z-0"></div>
            
            <!-- Step 1: Onboarding -->
            <div class="flex flex-col items-center group relative flex-1">
                <div class="w-14 h-14 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shadow-lg shadow-emerald-500/20 z-10 transition-all group-hover:scale-110">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div class="absolute top-6 left-1/2 w-full h-[2px] bg-emerald-500 -z-0"></div>
                <p class="mt-5 text-sm font-bold text-white tracking-tight">Onboarding</p>
                <p class="text-[10px] text-emerald-400 font-black uppercase tracking-widest mt-1.5">Complete</p>
            </div>

            <!-- Step 2: KYC -->
            <div class="flex flex-col items-center group relative flex-1">
                <div class="w-14 h-14 rounded-2xl {{ auth()->user()->kyc_status == 'success' ? 'bg-emerald-500 shadow-emerald-500/20' : (auth()->user()->kyc_status == 'failure' ? 'bg-rose-500 shadow-rose-500/20' : 'bg-slate-800 border border-white/10') }} text-white flex items-center justify-center shadow-lg z-10 transition-all group-hover:scale-110">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 014 0m-5 8a2 2 0 100-4 2 2 0 000 4zm5 3h-3a2 2 0 01-2-2V8a2 2 0 012-2h3"></path></svg>
                </div>
                <div class="absolute top-6 left-1/2 w-full h-[2px] {{ auth()->user()->kyc_status == 'success' ? 'bg-emerald-500' : 'bg-white/5' }} -z-0"></div>
                <p class="mt-5 text-sm font-bold text-white tracking-tight">Identity (KYC)</p>
                <p class="text-[10px] {{ auth()->user()->kyc_status == 'success' ? 'text-emerald-400' : (auth()->user()->kyc_status == 'failure' ? 'text-rose-400' : 'text-slate-500') }} font-black uppercase tracking-widest mt-1.5">{{ auth()->user()->kyc_status ?: 'Pending' }}</p>
            </div>

            <!-- Step 3: Accreditation -->
            <div class="flex flex-col items-center group relative flex-1">
                <div class="w-14 h-14 rounded-2xl {{ auth()->user()->accreditation_status == 'success' ? 'bg-emerald-500 shadow-emerald-500/20' : 'bg-slate-800 border border-white/10' }} {{ auth()->user()->accreditation_status == 'success' ? 'text-white' : 'text-slate-500' }} flex items-center justify-center shadow-lg z-10 transition-all group-hover:scale-110">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                </div>
                <div class="absolute top-6 left-1/2 w-full h-[2px] {{ auth()->user()->accreditation_status == 'success' ? 'bg-emerald-500' : 'bg-white/5' }} -z-0"></div>
                <p class="mt-5 text-sm font-bold text-white tracking-tight">Accreditation</p>
                <p class="text-[10px] {{ auth()->user()->accreditation_status == 'success' ? 'text-emerald-400' : (auth()->user()->accreditation_status == 'failure' ? 'text-rose-400' : 'text-slate-500') }} font-black uppercase tracking-widest mt-1.5">{{ auth()->user()->accreditation_status ?: 'Pending' }}</p>
            </div>

            <!-- Step 4: Bank Linking -->
            <div class="flex flex-col items-center group relative flex-1">
                <div class="w-14 h-14 rounded-2xl {{ auth()->user()->bankAccounts()->exists() ? 'bg-emerald-500 shadow-emerald-500/20' : 'bg-slate-800 border border-white/10' }} {{ auth()->user()->bankAccounts()->exists() ? 'text-white' : 'text-slate-500' }} flex items-center justify-center shadow-lg z-10 transition-all group-hover:scale-110">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div class="absolute top-6 left-1/2 w-full h-[2px] {{ auth()->user()->bankAccounts()->exists() ? 'bg-emerald-500' : 'bg-white/5' }} -z-0"></div>
                <p class="mt-5 text-sm font-bold text-white tracking-tight">Bank Linking</p>
                <p class="text-[10px] {{ auth()->user()->bankAccounts()->exists() ? 'text-emerald-400' : 'text-slate-500' }} font-black uppercase tracking-widest mt-1.5">{{ auth()->user()->bankAccounts()->exists() ? 'Linked' : 'Incomplete' }}</p>
            </div>

            <!-- Step 5: Investment -->
            <div class="flex flex-col items-center group relative">
                <div class="w-14 h-14 rounded-2xl {{ auth()->user()->transactions()->exists() ? 'bg-indigo-600 shadow-indigo-500/20 text-white' : 'bg-slate-800 border border-white/10 text-slate-500' }} flex items-center justify-center shadow-lg z-10 transition-all group-hover:scale-110">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="mt-5 text-sm font-bold text-white tracking-tight">Investment</p>
                <p class="text-[10px] {{ auth()->user()->transactions()->exists() ? 'text-indigo-400' : 'text-slate-500' }} font-black uppercase tracking-widest mt-1.5">{{ auth()->user()->transactions()->exists() ? 'Active' : 'Pending' }}</p>
            </div>
        </div>
    </div>

    <!-- Compliance Actions (Moved Up) -->
    <div class="glass-card rounded-3xl p-10 border border-indigo-500/10">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="font-bold text-white text-xl tracking-tight">Required Compliance Steps</h3>
                <p class="text-slate-500 text-sm mt-1">Complete these actions to unlock global investment capabilities.</p>
            </div>
            <span class="px-4 py-1.5 bg-indigo-500/10 text-indigo-400 text-[10px] font-black uppercase tracking-widest rounded-full border border-indigo-500/20">High Priority</span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('kyc.index') }}" class="flex items-center p-6 rounded-2xl border border-white/5 hover:border-indigo-500/50 bg-white/[0.02] hover:bg-white/[0.05] transition group">
                <div class="w-14 h-14 rounded-xl {{ auth()->user()->kyc_status == 'success' ? 'bg-emerald-500/10 text-emerald-400' : (auth()->user()->kyc_status == 'failure' ? 'bg-rose-500/10 text-rose-400' : 'bg-indigo-500/10 text-indigo-400') }} flex items-center justify-center mr-6 transition group-hover:scale-110">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 014 0m-5 8a2 2 0 100-4 2 2 0 000 4zm5 3h-3a2 2 0 01-2-2V8a2 2 0 012-2h3"></path></svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-white tracking-tight">Identity Verification</h4>
                    <p class="text-xs text-slate-500 mt-1">Status: <span class="font-bold {{ auth()->user()->kyc_status == 'success' ? 'text-emerald-400' : (auth()->user()->kyc_status == 'failure' ? 'text-rose-400' : 'text-amber-400') }}">{{ auth()->user()->kyc_status ?: 'Incomplete' }}</span></p>
                    @if(auth()->user()->kyc_status == 'failure')
                        <p class="text-[10px] font-black text-rose-400 uppercase mt-2">Action Required: Retry Now</p>
                    @endif
                </div>
                <svg class="w-5 h-5 text-slate-700 group-hover:text-white transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>

            <a href="{{ route('accreditation.index') }}" class="flex items-center p-6 rounded-2xl border border-white/5 hover:border-amber-500/50 bg-white/[0.02] hover:bg-white/[0.05] transition group">
                <div class="w-14 h-14 rounded-xl {{ auth()->user()->accreditation_status == 'success' ? 'bg-emerald-500/10 text-emerald-400' : (auth()->user()->accreditation_status == 'failure' ? 'bg-rose-500/10 text-rose-400' : 'bg-amber-500/10 text-amber-400') }} flex items-center justify-center mr-6 transition group-hover:scale-110">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z"></path></svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-white tracking-tight">Investor Accreditation</h4>
                    <p class="text-xs text-slate-500 mt-1">Status: <span class="font-bold {{ auth()->user()->accreditation_status == 'success' ? 'text-emerald-400' : (auth()->user()->accreditation_status == 'failure' ? 'text-rose-400' : 'text-amber-400') }}">{{ auth()->user()->accreditation_status ?: 'Incomplete' }}</span></p>
                    @if(auth()->user()->accreditation_status == 'failure')
                        <p class="text-[10px] font-black text-rose-400 uppercase mt-2">Action Required: Retry Now</p>
                    @endif
                </div>
                <svg class="w-5 h-5 text-slate-700 group-hover:text-white transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>

        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Stat Cards (Glass) -->
        <div class="glass-card p-8 rounded-3xl relative overflow-hidden group">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-indigo-600/10 rounded-full blur-2xl group-hover:scale-150 transition duration-700"></div>
            <div class="flex items-center justify-between mb-6">
                <p class="text-xs font-black uppercase tracking-widest text-slate-500">Total Portfolio</p>
                <div class="w-10 h-10 bg-indigo-600/10 text-indigo-400 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <h4 class="text-3xl font-bold text-white tracking-tighter">${{ number_format(auth()->user()->transactions()->sum('amount'), 2) }}</h4>
            <div class="flex items-center mt-3 text-emerald-400 text-xs font-bold">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                <span>Active Growth</span>
            </div>
        </div>

        <div class="glass-card p-8 rounded-3xl relative overflow-hidden group">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-600/10 rounded-full blur-2xl group-hover:scale-150 transition duration-700"></div>
            <div class="flex items-center justify-between mb-6">
                <p class="text-xs font-black uppercase tracking-widest text-slate-500">Connected Assets</p>
                <div class="w-10 h-10 bg-emerald-600/10 text-emerald-400 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <h4 class="text-3xl font-bold text-white tracking-tighter">{{ auth()->user()->bankAccounts()->count() }}</h4>
            <p class="text-slate-500 text-xs font-bold mt-3">Verified Banking Channels</p>
        </div>

        <div class="glass-card p-8 rounded-3xl relative overflow-hidden group">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-amber-600/10 rounded-full blur-2xl group-hover:scale-150 transition duration-700"></div>
            <div class="flex items-center justify-between mb-6">
                <p class="text-xs font-black uppercase tracking-widest text-slate-500">Compliance Health</p>
                <div class="w-10 h-10 bg-amber-600/10 text-amber-400 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">KYC/AML</span>
                    <span class="text-[10px] font-black uppercase {{ auth()->user()->kyc_status == 'success' ? 'text-emerald-400' : 'text-amber-400' }}">
                        {{ auth()->user()->kyc_status ?: 'PENDING' }}
                    </span>
                </div>
                <div class="w-full h-1 bg-white/5 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 transition-all duration-1000" style="width: {{ auth()->user()->kyc_status == 'success' ? '100%' : '20%' }}"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Security Audit (Now Full Width below stats) -->
    <div class="glass-card rounded-3xl overflow-hidden">
        <div class="p-8 border-b border-white/5 flex justify-between items-center">
            <h3 class="font-bold text-white tracking-tight">Security & Activity Audit</h3>
            <a href="{{ route('audit_logs.index') }}" class="text-xs font-bold text-indigo-400 hover:text-indigo-300 transition uppercase tracking-widest">Full Log</a>
        </div>
        <div class="divide-y divide-white/5">
            @forelse($auditLogs as $log)
            <div class="p-6 flex items-center hover:bg-white/[0.02] transition group">
                <div class="w-12 h-12 rounded-xl {{ $log->status == 'success' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-rose-500/10 text-rose-400' }} flex items-center justify-center mr-5 transition group-hover:scale-110">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-white">{{ $log->action }}</p>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $log->details ?: $log->timestamp->diffForHumans() }}</p>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-black uppercase tracking-widest {{ $log->status == 'success' ? 'text-emerald-400' : 'text-rose-400' }}">{{ $log->status }}</span>
                </div>
            </div>
            @empty
            <div class="p-20 text-center">
                <p class="text-slate-600 font-bold tracking-widest uppercase text-xs">No activity detected</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
