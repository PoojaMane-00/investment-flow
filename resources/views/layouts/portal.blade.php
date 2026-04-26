<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Portal' }} - InvestFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-sidebar { background: rgba(15, 23, 42, 0.95); border-right: 1px solid rgba(255, 255, 255, 0.05); }
        .glass-header { background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        .glass-card { background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.05); backdrop-filter: blur(8px); }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 selection:bg-indigo-500 selection:text-white antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-72 glass-sidebar flex-shrink-0 hidden md:flex flex-col z-20">
            <div class="p-8">
                <a href="/" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-white">InvestFlow</span>
                </a>
            </div>

            <nav class="flex-grow px-6 py-4 space-y-2">
                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-[0.2em] px-4 mb-4">Dashboard</p>
                
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white transition' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-medium">Overview</span>
                </a>

                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-[0.2em] px-4 pt-6 mb-4">Compliance</p>
                <a href="{{ route('kyc.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl {{ request()->routeIs('kyc.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white transition' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <span class="font-medium">KYC / AML</span>
                    </div>
                    @if(auth()->user()->kyc_status == 'success')
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    @endif
                </a>
                <a href="{{ route('accreditation.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl {{ request()->routeIs('accreditation.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white transition' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z"></path></svg>
                        <span class="font-medium">Accreditation</span>
                    </div>
                    @if(auth()->user()->accreditation_status == 'success')
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    @elseif(auth()->user()->kyc_status !== 'success')
                        <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    @endif
                </a>

                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-[0.2em] px-4 pt-6 mb-4">Investments</p>

                <a href="{{ route('bank_accounts.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl {{ request()->routeIs('bank_accounts.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white transition' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        <span class="font-medium">Bank Accounts</span>
                    </div>
                    @if(auth()->user()->bankAccounts()->exists())
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    @elseif(auth()->user()->accreditation_status !== 'success')
                        <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    @endif
                </a>

                <a href="{{ route('transactions.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl {{ request()->routeIs('transactions.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white transition' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-medium">Activity</span>
                    </div>
                    @if(auth()->user()->accreditation_status !== 'success')
                        <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    @endif
                </a>

                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-[0.2em] px-4 pt-6 mb-4">Security</p>
                <a href="{{ route('audit_logs.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('audit_logs.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white transition' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="font-medium">Audit Logs</span>
                </a>
            </nav>

            <div class="p-6 border-t border-white/5 bg-slate-950/50">
                <div class="flex items-center space-x-3 mb-6 px-2">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-emerald-500 flex items-center justify-center font-bold text-white text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-2.5 border border-white/10 hover:bg-white/5 rounded-xl text-xs font-bold text-slate-400 hover:text-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden relative bg-slate-950">
            <!-- Global Decorations -->
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-500/5 blur-[120px] rounded-full pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-emerald-500/5 blur-[120px] rounded-full pointer-events-none"></div>

            <header class="glass-header h-20 flex items-center justify-between px-8 flex-shrink-0 sticky top-0 z-10">
                <div class="flex items-center lg:hidden">
                    <span class="text-xl font-bold tracking-tight text-white">InvestFlow</span>
                </div>
                
                <div class="hidden lg:block">
                    <h1 class="text-lg font-bold text-white tracking-tight">{{ $title ?? 'Portal' }}</h1>
                </div>

                <div class="flex items-center space-x-6">
                    <div class="flex items-center space-x-2 px-4 py-1.5 bg-emerald-500/10 border border-emerald-500/20 rounded-full">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-400">Trading Live</span>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8 relative z-1">
                @if (session('status'))
                    <div class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl flex items-center space-x-3 text-emerald-400 animate-in fade-in slide-in-from-top-4 duration-500">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-sm font-medium">{{ session('status') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
