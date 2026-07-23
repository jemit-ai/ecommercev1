@extends('layouts.admin')

@section('title', 'Product Categories')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Categories</h1>
            <p class="text-slate-500 text-sm">Group products into structured collections.</p>
        </div>
        <button class="inline-flex items-center px-4 py-2 text-xs font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors duration-300">
            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add Category
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="py-4 px-6">Name</th>
                        <th class="py-4 px-6">Slug</th>
                        <th class="py-4 px-6">Description</th>
                        <th class="py-4 px-6 text-center">Products Count</th>
                        <th class="py-4 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($categories as $category)
                        <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                            <td class="py-4 px-6 font-semibold text-slate-900">
                                {{ $category->name }}
                            </td>
                            <td class="py-4 px-6 text-slate-500 font-mono text-xs">
                                {{ $category->slug }}
                            </td>
                            <td class="py-4 px-6 text-slate-500 max-w-xs truncate">
                                {{ $category->description ?? 'No description provided.' }}
                            </td>
                            <td class="py-4 px-6 text-center font-bold text-indigo-600">
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button class="text-indigo-600 hover:text-indigo-900 font-semibold text-xs">Edit</button>
                                    <span class="text-slate-300">|</span>
                                    <button class="text-rose-600 hover:text-rose-900 font-semibold text-xs">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($categories->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
