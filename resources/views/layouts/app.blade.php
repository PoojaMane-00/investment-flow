<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="InvestFlow - Premium Cross-Border Investment Platform. Simplified onboarding, KYC, and secure bank transactions.">
    <meta name="keywords" content="investment, cross-border, fintech, kyc, aml, banking, finance">
    <meta name="author" content="InvestFlow Team">
    
    <title>{{ config('app.name', 'InvestFlow') }} - Premium Investment Journey</title>
    
    <!-- Favicon placeholder -->
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2853/2853361.png">
    
    <!-- Fonts: Inter for professional look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS for modern styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 selection:bg-indigo-500 selection:text-white min-h-screen flex flex-col">
    <!-- Dark Header for Onboarding/Auth -->
    <header class="w-full bg-slate-950/80 backdrop-blur-md border-b border-white/5 py-5 px-6">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="/" class="flex items-center space-x-2 group">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center group-hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <span class="text-2xl font-bold tracking-tight text-white transition">InvestFlow</span>
            </a>
            <div class="text-xs font-bold uppercase tracking-widest text-slate-500 hidden sm:block">
                Secure Onboarding Environment
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">
            @yield('content')
        </div>
    </main>
    
    <footer class="py-8 text-center text-slate-600 text-xs tracking-widest uppercase">
        &copy; {{ date('Y') }} InvestFlow Technologies. All rights reserved.
    </footer>
</body>


</html>

