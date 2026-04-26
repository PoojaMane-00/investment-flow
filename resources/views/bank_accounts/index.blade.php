@extends('layouts.portal')

@section('content')
<div class="w-full max-w-7xl mx-auto space-y-8">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-extrabold text-white tracking-tight">Bank Accounts</h2>
            <p class="text-slate-400 mt-1">Manage your linked funding sources and global accounts.</p>
        </div>
        @if(auth()->user()->kyc_status == 'success' && auth()->user()->accreditation_status == 'success')
        <form action="{{ route('bank_accounts.store') }}" method="POST">
            @csrf
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold transition flex items-center shadow-lg shadow-indigo-500/20">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Link New Bank
            </button>
        </form>
        @else
        <div class="px-6 py-3 bg-white/5 rounded-xl border border-white/10 text-slate-500 text-xs font-black uppercase tracking-widest flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            Cleared Status Required
        </div>
        @endif
    </div>

    <div class="glass-card rounded-3xl overflow-hidden border border-white/5">
        <table class="w-full text-left">
            <thead class="bg-white/[0.02] border-b border-white/5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">
                <tr>
                    <th class="px-8 py-5">Institution</th>
                    <th class="px-8 py-5">Account Number</th>
                    <th class="px-8 py-5 text-right">Balance</th>
                    <th class="px-8 py-5">Status</th>
                    <th class="px-8 py-5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse ($bankAccounts as $account)
                <tr class="hover:bg-white/[0.02] transition group">
                    <td class="px-8 py-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center font-bold">
                                {{ substr($account->bank_name, 0, 1) }}
                            </div>
                            <span class="font-bold text-white tracking-tight">{{ $account->bank_name ?: 'Global Bank' }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-sm font-medium text-slate-400 font-mono">{{ $account->masked_account }}</td>
                    <td class="px-8 py-6 text-right">
                        <span class="text-emerald-400 font-bold text-lg tracking-tighter">${{ number_format($account->balance, 2) }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                            Active
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <form action="{{ route('bank_accounts.destroy', $account) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-slate-600 hover:text-rose-500 transition rounded-lg hover:bg-rose-500/10">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-white/[0.02] rounded-3xl flex items-center justify-center mb-4 border border-white/5">
                                <svg class="w-8 h-8 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-slate-600 font-bold tracking-widest uppercase text-xs">No accounts linked</p>
                            @if(auth()->user()->kyc_status !== 'success' || auth()->user()->accreditation_status !== 'success')
                                <p class="text-[10px] text-slate-700 mt-4 max-w-xs mx-auto">Please complete <span class="text-indigo-500">Identity Verification</span> and <span class="text-indigo-500">Investor Accreditation</span> to unlock asset linking.</p>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
