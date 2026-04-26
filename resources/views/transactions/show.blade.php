@extends('layouts.portal')

@section('content')
<div class="w-full max-w-4xl mx-auto space-y-8">
    <div class="flex items-center space-x-4">
        <a href="{{ route('transactions.index') }}" class="p-3 bg-white/5 border border-white/10 rounded-xl text-slate-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h2 class="text-3xl font-extrabold text-white tracking-tight">Investment Receipt</h2>
            <p class="text-slate-400 mt-1 uppercase text-[10px] font-black tracking-[0.2em]">Transaction #TRX-{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>

    <div class="glass-card rounded-3xl overflow-hidden border border-white/5">
        <div class="p-10 border-b border-white/5 bg-indigo-600/10 flex justify-between items-center">
            <div>
                <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-2">Amount Transferred</p>
                <h3 class="text-5xl font-black text-white tracking-tighter">${{ number_format($transaction->amount, 2) }}</h3>
            </div>
            <div class="text-right">
                <span class="px-5 py-2 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/20 text-[10px] font-black tracking-widest uppercase">
                    {{ $transaction->status }}
                </span>
            </div>
        </div>

        <div class="p-10 grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="space-y-6">
                <div>
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2">Investor Details</p>
                    <p class="text-white font-bold">{{ auth()->user()->name }}</p>
                    <p class="text-slate-500 text-sm">{{ auth()->user()->email }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2">Funding Source</p>
                    <p class="text-white font-bold">{{ $transaction->bankAccount->bank_name ?? 'Primary Bank' }}</p>
                    <p class="text-slate-500 text-sm">Account Ending in {{ substr($transaction->bankAccount->masked_account ?? '****', -4) }}</p>
                </div>
            </div>
            <div class="space-y-6">
                <div>
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2">Asset Destination</p>
                    <p class="text-white font-bold">Law Firm Escrow Account</p>
                    <p class="text-slate-500 text-sm leading-relaxed">Funds are pooled securely until compliance and legal conditions for the investment round are satisfied.</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2">Timestamp</p>
                    <p class="text-white font-bold">{{ $transaction->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
            </div>
        </div>

        <div class="p-8 bg-white/[0.02] border-t border-white/5 flex justify-center">
            <button onclick="window.print()" class="flex items-center space-x-2 text-xs font-bold text-slate-500 hover:text-indigo-400 transition uppercase tracking-widest">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                <span>Download PDF Receipt</span>
            </button>
        </div>
    </div>
</div>
@endsection
