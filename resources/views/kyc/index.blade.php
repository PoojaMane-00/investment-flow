@extends('layouts.portal')

@section('content')
<div class="w-full max-w-5xl mx-auto space-y-10">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">KYC Verification</h2>
        <p class="text-slate-400 mt-2">Compliance with international regulations (AML/CFT) to protect your assets.</p>
    </div>

    <div class="glass-card rounded-3xl overflow-hidden border border-white/5">
        <div class="p-10 md:p-16">
            <div class="flex flex-col md:flex-row items-center justify-between mb-16 gap-8">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">Current Verification Status</span>
                    <div class="mt-4 flex items-center">
                        @if($user->kyc_status == 'success')
                            <span class="px-6 py-2.5 bg-emerald-500/10 text-emerald-400 rounded-full text-xs font-black tracking-widest border border-emerald-500/20 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                VERIFIED
                            </span>
                        @elseif($user->kyc_status == 'failure')
                            <span class="px-6 py-2.5 bg-rose-500/10 text-rose-400 rounded-full text-xs font-black tracking-widest border border-rose-500/20 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                FAILED
                            </span>
                        @elseif($user->kyc_status == 'pending')
                            <span class="px-6 py-2.5 bg-amber-500/10 text-amber-400 rounded-full text-xs font-black tracking-widest border border-amber-500/20 flex items-center">
                                <svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                PENDING
                            </span>
                        @else
                            <span class="px-6 py-2.5 bg-white/5 text-slate-500 rounded-full text-xs font-black tracking-widest border border-white/10">NOT STARTED</span>
                        @endif
                    </div>
                </div>

                @if($user->kyc_status != 'success')
                <form action="{{ route('kyc.start') }}" method="POST" onsubmit="this.querySelector('button').disabled = true; this.querySelector('.button-text').classList.add('hidden'); this.querySelector('.spinner').classList.remove('hidden');">
                    @csrf
                    <button type="submit" class="group relative inline-flex items-center justify-center px-10 py-4 font-bold text-white transition-all bg-indigo-600 rounded-2xl hover:bg-indigo-700 shadow-xl shadow-indigo-500/20 active:scale-95 disabled:opacity-70 disabled:cursor-wait">
                        <span class="button-text flex items-center">
                            {{ $user->kyc_status == 'failure' ? 'Retry Verification' : 'Initialize Check' }}
                            <svg class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                        <span class="spinner hidden flex items-center">
                            <svg class="animate-spin h-5 w-5 mr-3 text-white" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Processing...
                        </span>
                    </button>
                </form>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 bg-white/[0.02] rounded-3xl border border-white/5 hover:bg-white/[0.04] transition group">
                    <div class="w-14 h-14 bg-indigo-500/10 text-indigo-400 rounded-2xl flex items-center justify-center mb-6 transition group-hover:scale-110">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h4 class="font-bold text-white mb-3 tracking-tight">Biometric Scan</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">Advanced 3D facial recognition to prevent spoofing and identity theft.</p>
                </div>
                <div class="p-8 bg-white/[0.02] rounded-3xl border border-white/5 hover:bg-white/[0.04] transition group">
                    <div class="w-14 h-14 bg-indigo-500/10 text-indigo-400 rounded-2xl flex items-center justify-center mb-6 transition group-hover:scale-110">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 014 0m-5 8a2 2 0 100-4 2 2 0 000 4zm5 3h-3a2 2 0 01-2-2V8a2 2 0 012-2h3"></path></svg>
                    </div>
                    <h4 class="font-bold text-white mb-3 tracking-tight">OCR Validation</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">Automated passport and ID extraction with global database cross-referencing.</p>
                </div>
                <div class="p-8 bg-white/[0.02] rounded-3xl border border-white/5 hover:bg-white/[0.04] transition group">
                    <div class="w-14 h-14 bg-indigo-500/10 text-indigo-400 rounded-2xl flex items-center justify-center mb-6 transition group-hover:scale-110">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h4 class="font-bold text-white mb-3 tracking-tight">AML Screening</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">Real-time check against global sanctions, PEP, and adverse media lists.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
