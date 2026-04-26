<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InvestFlow - Premium Cross-Border Investment Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .hero-gradient { background: radial-gradient(circle at top right, #4f46e5, #065f46, #020617); }
    </style>
</head>
<body class="bg-slate-950 text-white selection:bg-indigo-500 selection:text-white">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-slate-950/80 backdrop-blur-md border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <span class="text-2xl font-bold tracking-tight">InvestFlow</span>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <a href="#features" class="text-sm font-medium text-slate-400 hover:text-white transition">Features</a>
                <a href="#compliance" class="text-sm font-medium text-slate-400 hover:text-white transition">Compliance</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 rounded-full text-sm font-bold transition shadow-lg shadow-indigo-500/20">Portal</a>
                @else
                    <a href="{{ route('onboarding') }}" class="px-6 py-2.5 bg-white text-slate-950 hover:bg-slate-200 rounded-full text-sm font-bold transition">Get Started</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen pt-32 pb-20 hero-gradient overflow-hidden flex items-center">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative z-10 text-center lg:text-left">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-bold uppercase tracking-widest mb-6">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span>Revolutionizing Cross-Border Investing</span>
                </div>
                <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight leading-tight mb-8">
                    Invest Globally, <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-emerald-400">Transact Seamlessly.</span>
                </h1>
                <p class="text-xl text-slate-400 mb-10 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    Join the premier platform for diversified international investments. Smart onboarding, instant KYC, and secure bank linking designed for the modern investor.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 justify-center lg:justify-start">
                    <a href="{{ route('onboarding') }}" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition shadow-xl shadow-indigo-500/20 text-center">
                        Start Your Journey
                    </a>
                    <a href="#features" class="px-10 py-4 glass hover:bg-white/10 rounded-xl font-bold transition text-center">
                        Explore Features
                    </a>
                </div>
            </div>
            <div class="relative lg:h-[600px] hidden lg:block">
                <div class="absolute -top-20 -right-20 w-96 h-96 bg-indigo-500/20 blur-[100px] rounded-full"></div>
                <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-emerald-500/10 blur-[100px] rounded-full"></div>
                <div class="relative z-10 rounded-3xl overflow-hidden shadow-2xl border border-white/10 transform lg:rotate-3 hover:rotate-0 transition duration-700">
                    <img src="/images/hero.png" alt="InvestFlow Hero" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-32 bg-slate-950 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 text-center mb-20">
            <h2 class="text-4xl font-bold mb-4 tracking-tight text-white">Built for Professionals</h2>
            <p class="text-slate-400 max-w-2xl mx-auto">Our platform combines state-of-the-art security with an intuitive user experience to make cross-border investing as simple as local banking.</p>
        </div>
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 rounded-3xl glass hover:border-indigo-500/50 transition group">
                <div class="w-14 h-14 bg-indigo-500/10 text-indigo-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-4">Smart Compliance</h3>
                <p class="text-slate-500">Automated KYC/AML and Investor Accreditation checks simulated against global standards.</p>
            </div>
            <div class="p-8 rounded-3xl glass hover:border-indigo-500/50 transition group">
                <div class="w-14 h-14 bg-indigo-500/10 text-indigo-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-4">Instant Bank Link</h3>
                <p class="text-slate-500">Securely link your global bank accounts with Plaid-like simplicity for fast transactions.</p>
            </div>
            <div class="p-8 rounded-3xl glass hover:border-indigo-500/50 transition group">
                <div class="w-14 h-14 bg-indigo-500/10 text-indigo-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-4">Transparent Audits</h3>
                <p class="text-slate-500">Every sensitive action is logged with precision, ensuring full transparency and security.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 border-t border-white/5 bg-slate-950">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-slate-500">
            <div class="flex items-center space-x-2 mb-6 md:mb-0">
                <div class="w-6 h-6 bg-indigo-600 rounded flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <span class="font-bold text-white tracking-tight">InvestFlow</span>
            </div>
            <div class="flex space-x-8 text-sm">
                <a href="#" class="hover:text-white transition">Privacy</a>
                <a href="#" class="hover:text-white transition">Terms</a>
                <a href="#" class="hover:text-white transition">Security</a>
                <a href="#" class="hover:text-white transition">Contact</a>
            </div>
            <p class="mt-8 md:mt-0 text-xs tracking-wide">&copy; {{ date('Y') }} InvestFlow Technologies. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
