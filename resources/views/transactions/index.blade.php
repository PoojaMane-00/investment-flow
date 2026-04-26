@extends('layouts.portal')

@section('content')
<div class="w-full max-w-7xl mx-auto space-y-10">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Investments</h2>
        <p class="text-slate-400 mt-1">Deploy capital and track your global investment history.</p>
    </div>

    <!-- Quick Invest Card (Glass) -->
    <div class="glass-card p-10 rounded-3xl relative overflow-hidden">
        <div class="absolute top-0 right-0 p-8 text-indigo-500/20">
            <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
        </div>
        
        <h3 class="text-lg font-bold text-white mb-8 tracking-tight">Execute New Investment</h3>

        @if (auth()->user()->kyc_status !== 'success' || auth()->user()->accreditation_status !== 'success')
            <div class="p-10 bg-indigo-500/5 border border-indigo-500/20 rounded-3xl text-center relative z-10">
                <div class="w-16 h-16 bg-indigo-500/10 text-indigo-400 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h4 class="text-xl font-bold text-white mb-3 tracking-tight">Investment Access Restricted</h4>
                <p class="text-slate-400 max-w-md mx-auto mb-8">To maintain regulatory compliance, please complete the following steps before you can deploy capital:</p>
                
                <div class="flex flex-wrap justify-center gap-4">
                    @if(auth()->user()->kyc_status !== 'success')
                        <a href="{{ route('kyc.index') }}" class="px-6 py-2.5 bg-rose-500/10 text-rose-400 text-xs font-black uppercase tracking-widest rounded-full border border-rose-500/20 hover:bg-rose-500/20 transition">Complete KYC</a>
                    @endif
                    @if(auth()->user()->accreditation_status !== 'success')
                        <a href="{{ route('accreditation.index') }}" class="px-6 py-2.5 bg-amber-500/10 text-amber-400 text-xs font-black uppercase tracking-widest rounded-full border border-amber-500/20 hover:bg-amber-500/20 transition">Verify Accreditation</a>
                    @endif
                </div>
            </div>
        @else
            @if ($errors->has('error'))
                <div class="mb-8 p-5 bg-rose-500/10 border border-rose-500/20 rounded-2xl flex items-center text-rose-400">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <p class="text-sm font-bold">{{ $errors->first('error') }}</p>
                </div>
            @endif
            
            <form action="{{ route('transactions.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-end relative z-10">
                @csrf
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Funding Source</label>
                    <select name="bank_account_id" class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition appearance-none" required>
                        <option value="" class="bg-slate-900">Choose a bank account...</option>
                        @foreach(auth()->user()->bankAccounts as $account)
                            <option value="{{ $account->id }}" class="bg-slate-900">
                                {{ $account->bank_name }} ({{ $account->masked_account }}) - ${{ number_format($account->balance, 2) }}
                            </option>
                        @endforeach
                    </select>
                    @error('bank_account_id') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Amount (USD)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-5 flex items-center text-slate-500 font-bold">$</span>
                        <input type="number" name="amount" step="0.01" min="0.01" placeholder="0.00" 
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-10 py-4 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition" required>
                    </div>
                    @error('amount') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition shadow-lg shadow-indigo-500/20 active:scale-[0.98]">
                    Confirm & Transact
                </button>
            </form>
        @endif
    </div>

    <!-- Transaction History Table -->
    <div class="space-y-6">
        <div class="flex justify-between items-center px-2">
            <h3 class="text-lg font-bold text-white tracking-tight">Recent Activity</h3>
            <button class="text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-indigo-400 transition">Export Statement</button>
        </div>

        <div class="glass-card rounded-3xl overflow-hidden border border-white/5">
            <table class="w-full text-left">
                <thead class="bg-white/[0.02] border-b border-white/5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">
                    <tr>
                        <th class="px-8 py-5">Reference ID</th>
                        <th class="px-8 py-5">Asset / Destination</th>
                        <th class="px-8 py-5 text-right">Amount</th>
                        <th class="px-8 py-5">Date</th>
                        <th class="px-8 py-5">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($transactions as $transaction)
                    <tr class="hover:bg-white/[0.02] transition group">
                        <td class="px-8 py-6">
                            <span class="text-xs font-mono text-slate-500">#TRX-{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex flex-col">
                                <span class="font-bold text-white text-sm">Escrow Pooling Account</span>
                                <span class="text-[10px] text-slate-500 font-bold uppercase tracking-tighter">Law Firm Escrow Account</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <span class="text-white font-bold tracking-tight">${{ number_format($transaction->amount, 2) }}</span>
                        </td>
                        <td class="px-8 py-6 text-xs text-slate-500 font-medium">{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                        <td class="px-8 py-6">
                            @if ($transaction->status == 'success')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                    Settled
                                </span>
                            @elseif ($transaction->status == 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                    Processing
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                    Rejected
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-white/[0.02] rounded-3xl flex items-center justify-center mb-4 border border-white/5">
                                    <svg class="w-8 h-8 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <p class="text-slate-600 font-bold tracking-widest uppercase text-xs">No transactions recorded</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
