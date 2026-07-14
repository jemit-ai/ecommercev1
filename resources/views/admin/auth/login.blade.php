<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal Sign In</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 font-sans text-slate-200 antialiased min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Glowing background elements -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-indigo-600 rounded-full filter blur-[120px] opacity-20 pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-emerald-600 rounded-full filter blur-[120px] opacity-20 pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl relative">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-indigo-600/10 text-indigo-400 border border-indigo-500/20 mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-white">Admin Dashboard</h1>
                <p class="text-slate-400 text-xs mt-1.5">Sign in to manage your e-commerce platform.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Email Address</label>
                    <input id="email" 
                           class="w-full bg-slate-950/50 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all duration-300" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username" 
                           placeholder="admin@example.com" />
                    @if($errors->has('email'))
                        <p class="text-xs text-rose-500 font-medium mt-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Password</label>
                    </div>
                    <input id="password" 
                           class="w-full bg-slate-950/50 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all duration-300" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="current-password" 
                           placeholder="••••••••" />
                    @if($errors->has('password'))
                        <p class="text-xs text-rose-500 font-medium mt-1">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                        <input id="remember_me" type="checkbox" class="rounded border-slate-800 bg-slate-950/50 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-0" name="remember">
                        <span class="ms-2 text-slate-400 font-medium">Remember my session</span>
                    </label>
                </div>

                <!-- Sign In Button -->
                <button type="submit" class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm shadow-lg shadow-indigo-600/10 hover:shadow-indigo-600/25 transition-all duration-300 transform active:scale-[0.98]">
                    Sign In to Dashboard
                </button>
            </form>
        </div>
    </div>
</body>
</html>
