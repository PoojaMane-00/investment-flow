@extends('layouts.app')

@section('content')
<div class="glass p-8 rounded-3xl border border-white/10 shadow-2xl w-full">
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Join Investment Flow</h2>
        <p class="text-slate-400 mt-2 font-medium">Start your cross-border investment journey today.</p>
    </div>

    @if ($errors->any())
    <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 rounded-xl text-rose-400 text-sm">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('onboarding.store') }}" method="POST" class="space-y-5">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition @error('name') border-rose-500/50 @enderror">
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" required
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition @error('email') border-rose-500/50 @enderror">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">Nationality</label>
                <input type="text" name="nationality" value="{{ old('nationality') }}" placeholder="e.g. American" required
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition @error('nationality') border-rose-500/50 @enderror">
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">Domicile</label>
                <input type="text" name="domicile" value="{{ old('domicile') }}" maxlength="14" placeholder="e.g. United Kingdom" required
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition @error('domicile') border-rose-500/50 @enderror">
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">Phone Number</label>
            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000" required
                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition @error('phone') border-rose-500/50 @enderror">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition @error('password') border-rose-500/50 @enderror">
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">Confirm</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition">
            </div>
        </div>

        <button type="submit"
            class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 rounded-xl text-white font-bold tracking-tight transition shadow-lg shadow-indigo-500/20 mt-4">
            Create Free Account
        </button>

        <p class="text-center text-xs text-slate-500 mt-6 tracking-wide">
            By signing up, you agree to our <a href="#" class="text-indigo-400 font-bold hover:underline">Terms of Service</a>.
        </p>
    </form>
</div>

<style>
    .glass {
        background: rgba(15, 23, 42, 0.4);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }
</style>
@endsection