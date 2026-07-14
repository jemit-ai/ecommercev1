@extends('layouts.admin')

@section('title', 'Manage Suppliers')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Suppliers</h1>
            <p class="text-slate-500 text-sm">Monitor system suppliers and inventory source logs.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="py-4 px-6">Name</th>
                        <th class="py-4 px-6">Email</th>
                        <th class="py-4 px-6">Registered On</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($suppliers as $supplier)
                        <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                            <td class="py-4 px-6 font-semibold text-slate-900">{{ $supplier->name }}</td>
                            <td class="py-4 px-6 text-slate-600">{{ $supplier->email }}</td>
                            <td class="py-4 px-6 text-slate-500">{{ $supplier->created_at->format('d M, Y') }}</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                    Active
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-indigo-600 hover:text-indigo-900 font-semibold text-xs">View Details</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">
                                No suppliers found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($suppliers->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $suppliers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
