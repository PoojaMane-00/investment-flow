@extends('layouts.portal')

@section('content')
    <div class="w-full max-w-5xl mx-auto space-y-6">

        <div class="glass-card rounded-3xl overflow-hidden border border-white/5">
            <div class="bg-indigo-600/10 p-4 md:p-6 border-b border-white/5">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                    <div>
                        <h3 class="text-xl font-bold text-white tracking-tight">Verification Status</h3>
                        <p class="text-slate-500 text-sm mt-1 uppercase tracking-widest font-black">Regulation D Compliance
                        </p>
                    </div>
                    <div>
                        @if($user->accreditation_status == 'success')
                            <div
                                class="bg-emerald-500/10 px-8 py-3.5 rounded-2xl border border-emerald-500/20 font-black text-emerald-400 text-xs tracking-widest flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                ACCREDITED
                            </div>
                        @elseif($user->accreditation_status == 'pending')
                            <div
                                class="bg-amber-500/10 px-8 py-3.5 rounded-2xl border border-amber-500/20 font-black text-amber-400 text-xs tracking-widest flex items-center">
                                <svg class="w-5 h-5 mr-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                IN REVIEW
                            </div>
                        @else
                            <div
                                class="bg-white/5 px-8 py-3.5 rounded-2xl border border-white/10 font-black text-slate-500 text-xs tracking-widest">
                                {{ strtoupper($user->accreditation_status ?: 'UNVERIFIED') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-10">
                @if($user->accreditation_status != 'success')
                    <div class="mb-6">
                        <h4 class="text-sm font-bold text-slate-400 mb-4 tracking-widest uppercase">Verification Protocol</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="flex items-start space-x-3">
                                <span
                                    class="w-7 h-7 rounded-lg bg-white/5 border border-white/10 text-indigo-400 flex items-center justify-center font-black text-[10px] flex-shrink-0">01</span>
                                <p class="text-[11px] text-slate-500 leading-tight">Proof of income (>$200k) or net worth
                                    (>$1M).</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <span
                                    class="w-7 h-7 rounded-lg bg-white/5 border border-white/10 text-indigo-400 flex items-center justify-center font-black text-[10px] flex-shrink-0">02</span>
                                <p class="text-[11px] text-slate-500 leading-tight">Review by compliance officers.</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <span
                                    class="w-7 h-7 rounded-lg bg-white/5 border border-white/10 text-indigo-400 flex items-center justify-center font-black text-[10px] flex-shrink-0">03</span>
                                <p class="text-[11px] text-slate-500 leading-tight">Finalized within 12-48h.</p>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->kyc_status !== 'success')
                        <div class="text-center py-4">
                            <div
                                class="w-12 h-12 bg-rose-500/10 text-rose-400 rounded-xl flex items-center justify-center mx-auto mb-4 border border-rose-500/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2 tracking-tight">Identity Verification Required</h3>
                            <p class="text-xs text-slate-500 max-w-sm mx-auto mb-6 leading-relaxed">Please verify your identity
                                (KYC) first.</p>
                            <a href="{{ route('kyc.index') }}"
                                class="group relative inline-flex items-center justify-center px-10 py-4 font-bold text-white transition-all bg-indigo-600 rounded-2xl hover:bg-indigo-700 shadow-xl shadow-indigo-500/20 active:scale-95 disabled:opacity-70 disabled:cursor-wait">
                                Start Identity Check
                                <svg class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    @else
                        <form action="{{ route('accreditation.verify') }}" method="POST"
                            onsubmit="this.querySelector('button').disabled = true; this.querySelector('.button-text').classList.add('hidden'); this.querySelector('.spinner').classList.remove('hidden');">
                            @csrf
                            <button type="submit"
                                class="w-full py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl transition shadow-xl shadow-indigo-500/20 active:scale-95 disabled:opacity-70 disabled:cursor-wait">
                                <span class="button-text">
                                    {{ $user->accreditation_status == 'failure' ? 'Retry Verification' : 'Submit Verification Payload' }}
                                </span>
                                <span class="spinner hidden flex items-center justify-center">
                                    <svg class="animate-spin h-5 w-5 mr-3 text-white" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"
                                            fill="none"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Verifying Assets...
                                </span>
                            </button>
                        </form>
                    @endif
                @else
                    <div class="text-center py-10">
                        <div
                            class="w-24 h-24 bg-emerald-500/10 text-emerald-400 rounded-3xl flex items-center justify-center mx-auto mb-8 border border-emerald-500/20">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-extrabold text-white mb-3 tracking-tight">Institutional Access Granted</h3>
                        <p class="text-slate-500 font-medium">Your accreditation is active and valid through
                            {{ now()->addYear()->format('M Y') }}.</p>
                        <div class="mt-12">
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center text-indigo-400 font-bold hover:text-indigo-300 transition uppercase tracking-widest text-xs">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Return to Portal
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection