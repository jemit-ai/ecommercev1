@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-8">
    <!-- Top Greeting Section -->
    <div class="bg-gradient-to-r from-slate-900 to-indigo-950 rounded-2xl p-6 md:p-8 text-white shadow-xl relative overflow-hidden">
        <div class="absolute right-0 top-0 opacity-10 pointer-events-none transform translate-x-12 -translate-y-12">
            <svg width="400" height="400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.003 9.003 0 1020.945 13H11V3.055z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
            </svg>
        </div>
        <div class="relative z-10">
            <h1 class="text-3xl font-extrabold tracking-tight">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="mt-2 text-indigo-200 text-sm md:text-base max-w-xl">
                Here's what is happening with your store today. You have new orders to process and status updates to track.
            </p>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Revenue Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Revenue</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-2 transition-colors duration-300 group-hover:text-indigo-600">
                        ₹{{ number_format($revenue, 2) }}
                    </h3>
                </div>
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl transition-all duration-300 group-hover:bg-indigo-600 group-hover:text-white">
                    <!-- Wallet Icon -->
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-emerald-600 font-medium">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-9 9-4-4-6 6" />
                </svg>
                <span>+12.5% from last week</span>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Orders</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-2 transition-colors duration-300 group-hover:text-indigo-600">
                        {{ number_format($orders) }}
                    </h3>
                </div>
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl transition-all duration-300 group-hover:bg-indigo-600 group-hover:text-white">
                    <!-- Shopping Cart Icon -->
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-emerald-600 font-medium">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-9 9-4-4-6 6" />
                </svg>
                <span>+8.2% new sales today</span>
            </div>
        </div>

        <!-- Products Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Active Products</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-2 transition-colors duration-300 group-hover:text-indigo-600">
                        {{ number_format($products) }}
                    </h3>
                </div>
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl transition-all duration-300 group-hover:bg-indigo-600 group-hover:text-white">
                    <!-- Archive Icon -->
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-slate-500 font-medium">
                <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded-full text-[10px] font-bold">Instock</span>
                <span class="ml-2">Items categorized & ready</span>
            </div>
        </div>

        <!-- Customers Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Customers</p>
                    <h3 class="text-3xl font-bold text-slate-800 mt-2 transition-colors duration-300 group-hover:text-indigo-600">
                        {{ number_format($customers) }}
                    </h3>
                </div>
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl transition-all duration-300 group-hover:bg-indigo-600 group-hover:text-white">
                    <!-- Users Icon -->
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-emerald-600 font-medium">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-9 9-4-4-6 6" />
                </svg>
                <span>+4% this month</span>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-slate-800">Recent Orders</h3>
                <p class="text-slate-400 text-xs mt-0.5">The latest transactions completed by your store customers.</p>
            </div>
            <div>
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold text-indigo-600 bg-indigo-50 rounded-xl hover:bg-indigo-100 transition-colors duration-300">
                    View All Orders
                    <svg class="w-3.5 h-3.5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="py-4 px-6">Order ID</th>
                        <th class="py-4 px-6">Customer</th>
                        <th class="py-4 px-6">Date</th>
                        <th class="py-4 px-6 text-right">Total Amount</th>
                        <th class="py-4 px-6 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                            <td class="py-4 px-6 font-semibold text-slate-900">#ORD-{{ sprintf('%05d', $order->id) }}</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs uppercase shadow-inner">
                                        {{ substr($order->user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-slate-900">{{ $order->user->name }}</div>
                                        <div class="text-xs text-slate-400">{{ $order->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-500">
                                {{ $order->created_at->format('M d, Y h:i A') }}
                            </td>
                            <td class="py-4 px-6 text-right font-bold text-slate-900">
                                ₹{{ number_format($order->grand_total, 2) }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if($order->status === 'completed')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        Completed
                                    </span>
                                @elseif($order->status === 'processing')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                        Processing
                                    </span>
                                @elseif($order->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100 animate-pulse">
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-100">
                                        Cancelled
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400 text-sm">
                                No orders have been placed yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection