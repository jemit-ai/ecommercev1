@extends('layouts.admin')

@section('title', 'System Users')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Users Directory</h1>
            <p class="text-slate-500 text-sm">Manage administrative roles and user accounts across the system.</p>
        </div>
        <button class="inline-flex items-center px-4 py-2 text-xs font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors duration-300">
            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Invite User
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="py-4 px-6">User</th>
                        <th class="py-4 px-6">Roles</th>
                        <th class="py-4 px-6">Joined Date</th>
                        <th class="py-4 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                            <td class="py-4 px-6 font-semibold text-slate-900">
                                <div class="font-medium text-slate-900">{{ $user->name }}</div>
                                <div class="text-xs text-slate-400 font-normal">{{ $user->email }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse($user->roles as $role)
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border 
                                            @if($role->name === 'Admin') bg-red-50 text-red-700 border-red-200
                                            @elseif($role->name === 'Seller') bg-blue-50 text-blue-700 border-blue-200
                                            @elseif($role->name === 'Supplier') bg-purple-50 text-purple-700 border-purple-200
                                            @else bg-slate-50 text-slate-700 border-slate-200 @endif">
                                            {{ $role->name }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-slate-400 font-normal italic">No Roles</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-500">
                                {{ $user->created_at->format('d M, Y') }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button class="text-indigo-600 hover:text-indigo-900 font-semibold text-xs">Assign Role</button>
                                    <span class="text-slate-300">|</span>
                                    <button class="text-rose-600 hover:text-rose-900 font-semibold text-xs">Deactivate</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-400">
                                No users registered.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
