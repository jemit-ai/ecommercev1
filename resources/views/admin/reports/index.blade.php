@extends('layouts.admin')

@section('title', 'Analytical Reports')

@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Analytical Reports</h1>
        <p class="text-slate-500 text-sm">Visualize statistics, transactions, and store performance metrics.</p>
    </div>

    <!-- Quick Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
            <div>
                <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">Completed Orders Ratio</span>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-2">
                    @if($ordersCount > 0)
                        {{ number_format(($completedOrdersCount / $ordersCount) * 100, 1) }}%
                    @else
                        0%
                    @endif
                </h3>
            </div>
            <div class="mt-4">
                <div class="w-full bg-slate-100 rounded-full h-2">
                    <div class="bg-indigo-600 h-2 rounded-full" style="width: @if($ordersCount > 0) {{ ($completedOrdersCount / $ordersCount) * 100 }}% @else 0% @endif"></div>
                </div>
                <span class="text-[10px] text-slate-400 mt-1 block">{{ $completedOrdersCount }} out of {{ $ordersCount }} orders completed</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
            <div>
                <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">Average Order Value</span>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-2">
                    ₹@if($ordersCount > 0)
                        {{ number_format($revenue / $ordersCount, 2) }}
                    @else
                        0.00
                    @endif
                </h3>
            </div>
            <div class="mt-4 flex items-center text-xs text-slate-400">
                <span>Calculated across total platform revenue</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
            <div>
                <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">Platform Partners</span>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-2">
                    {{ $sellerCount + $supplierCount }}
                </h3>
            </div>
            <div class="mt-4 space-y-2">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-slate-500 font-medium">Sellers</span>
                    <span class="font-bold text-slate-800">{{ $sellerCount }}</span>
                </div>
                <div class="flex items-center justify-between text-xs">
                    <span class="text-slate-500 font-medium">Suppliers</span>
                    <span class="font-bold text-slate-800">{{ $supplierCount }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Visual Charts Mockup Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Monthly Revenue Mock Chart -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h3 class="text-base font-bold text-slate-800 mb-4">Revenue Stream Analysis (Weekly)</h3>
            <div class="h-64 flex items-end gap-3 pt-6 border-b border-slate-200">
                <div class="flex-grow flex flex-col items-center gap-2 h-full justify-end">
                    <div class="w-full bg-slate-100 hover:bg-indigo-200 rounded-t-lg transition-all duration-300" style="height: 35%;"></div>
                    <span class="text-[10px] font-semibold text-slate-400">Week 1</span>
                </div>
                <div class="flex-grow flex flex-col items-center gap-2 h-full justify-end">
                    <div class="w-full bg-slate-100 hover:bg-indigo-200 rounded-t-lg transition-all duration-300" style="height: 55%;"></div>
                    <span class="text-[10px] font-semibold text-slate-400">Week 2</span>
                </div>
                <div class="flex-grow flex flex-col items-center gap-2 h-full justify-end">
                    <div class="w-full bg-slate-100 hover:bg-indigo-200 rounded-t-lg transition-all duration-300" style="height: 40%;"></div>
                    <span class="text-[10px] font-semibold text-slate-400">Week 3</span>
                </div>
                <div class="flex-grow flex flex-col items-center gap-2 h-full justify-end">
                    <div class="w-full bg-indigo-600 rounded-t-lg" style="height: 85%;"></div>
                    <span class="text-[10px] font-semibold text-slate-800">Current</span>
                </div>
            </div>
        </div>

        <!-- Inventory Status Distribution Mock -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h3 class="text-base font-bold text-slate-800 mb-4">User Roles Breakdown</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between text-xs font-semibold text-slate-600 mb-1">
                        <span>Customers</span>
                        <span>{{ $customerCount }} users</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-emerald-500 h-2 rounded-full" style="width: @if(($customerCount+$sellerCount+$supplierCount) > 0) {{ ($customerCount / ($customerCount+$sellerCount+$supplierCount)) * 100 }}% @else 0% @endif"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs font-semibold text-slate-600 mb-1">
                        <span>Sellers</span>
                        <span>{{ $sellerCount }} users</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: @if(($customerCount+$sellerCount+$supplierCount) > 0) {{ ($sellerCount / ($customerCount+$sellerCount+$supplierCount)) * 100 }}% @else 0% @endif"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs font-semibold text-slate-600 mb-1">
                        <span>Suppliers</span>
                        <span>{{ $supplierCount }} users</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-purple-500 h-2 rounded-full" style="width: @if(($customerCount+$sellerCount+$supplierCount) > 0) {{ ($supplierCount / ($customerCount+$sellerCount+$supplierCount)) * 100 }}% @else 0% @endif"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
