@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Orders</h1>
        <p class="text-slate-500 text-sm">Track, confirm, and update customer transactions.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="py-4 px-6">Order ID</th>
                        <th class="py-4 px-6">Customer</th>
                        <th class="py-4 px-6">Date</th>
                        <th class="py-4 px-6 text-right">Total Amount</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                            <td class="py-4 px-6 font-semibold text-slate-900">#ORD-{{ sprintf('%05d', $order->id) }}</td>
                            <td class="py-4 px-6">
                                <div class="font-medium text-slate-900">{{ $order->user->name }}</div>
                                <div class="text-xs text-slate-400">{{ $order->user->email }}</div>
                            </td>
                            <td class="py-4 px-6 text-slate-500">
                                {{ $order->created_at->format('M d, Y h:i A') }}
                            </td>
                            <td class="py-4 px-6 text-right font-bold text-slate-950">
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

                            <td class="flex items-center justify-center gap-3">

                                <a href=""
                                class="text-sky-600 hover:text-sky-800 font-semibold">
                                    View
                                </a>

                                <a href=""
                                class="text-amber-600 hover:text-amber-800 font-semibold">
                                    Edit
                                </a>
                                
                            </td>
                            <!--td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button class="text-indigo-600 hover:text-indigo-900 font-semibold text-xs">Update Status</button>
                                </div>
                            </td-->
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">
                                No orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
