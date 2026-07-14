<header class="bg-white/80 backdrop-blur-md border-b border-slate-100 px-8 py-4 flex items-center justify-between sticky top-0 z-40">
    <!-- Left: Title or Search -->
    <div class="flex items-center gap-8">
        <h2 class="text-lg font-bold text-slate-800 tracking-tight">
            @yield('title', 'Admin Dashboard')
        </h2>
    </div>

    <!-- Right: User Actions -->
    <div class="flex items-center gap-6">
        <!-- Notification Icon Mock -->
        <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-xl transition-all duration-300 relative">
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-indigo-500 rounded-full"></span>
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </button>

        <span class="h-5 w-px bg-slate-200"></span>

        <!-- User Details & Logout -->
        <div class="flex items-center gap-4">
            <div class="flex flex-col text-right">
                <span class="text-xs font-bold text-slate-800 leading-none">{{ auth()->user()->name }}</span>
                <span class="text-[10px] text-slate-400 font-semibold leading-none mt-1 uppercase tracking-wider">Super Administrator</span>
            </div>
            
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center justify-center p-2.5 rounded-xl border border-rose-100 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-all duration-300 shadow-sm shadow-rose-500/5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</header>