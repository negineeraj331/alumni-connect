@extends('layouts.app')
@section('title', 'User Management — Admin — Alumni Connect')

@section('content')
<div class="flex flex-col lg:flex-row gap-8">
    {{-- Admin Sidebar --}}
    <aside class="w-full lg:w-56 flex-shrink-0">
        <div class="bg-surface-white rounded-card border border-outline-variant dark:border-[#444934] p-3 sticky top-24">
            <p class="text-xs font-bold uppercase tracking-widest text-secondary dark:text-gray-400 px-3 mb-2">Admin Panel</p>
            <nav class="space-y-1">
                <a href="{{ route('admin.index') }}" class="sidebar-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                    <span class="material-symbols-outlined text-base">dashboard</span> Overview
                </a>
                <a href="{{ route('admin.users') }}" class="sidebar-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <span class="material-symbols-outlined text-base">manage_accounts</span> Users
                </a>
                <a href="{{ route('admin.moderation') }}" class="sidebar-link {{ request()->routeIs('admin.moderation') ? 'active' : '' }}">
                    <span class="material-symbols-outlined text-base">shield</span> Moderation
                </a>
            </nav>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 min-w-0">
        <!-- Dashboard Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-on-surface dark:text-white mb-2">User Management</h1>
            <p class="text-lg text-secondary dark:text-gray-400">Oversee your {{ number_format($users->total()) }} community members, manage permissions, and monitor engagement levels.</p>
        </div>

        <!-- Management Shell -->
        <div class="bg-surface-low rounded-2xl border border-outline-variant dark:border-[#444934] p-2 overflow-hidden shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] reveal-card">
            <!-- Toolbar -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-6 gap-4 bg-surface-container dark:bg-[#20241b] border-b border-outline-variant dark:border-[#444934] rounded-t-xl">
                <form action="{{ route('admin.users') }}" method="GET" class="relative w-full md:w-96 flex">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                    <input name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-3 bg-surface dark:bg-[#12140e] border border-outline-variant dark:border-[#444934] rounded-lg focus:border-primary focus:ring-1 focus:ring-primary outline-none text-base" placeholder="Search by name or email..." type="text"/>
                    <button type="submit" class="hidden">Search</button>
                </form>
                <div class="flex gap-4 w-full md:w-auto">
                    <button class="flex items-center gap-2 px-4 py-3 border border-outline-variant dark:border-[#444934] rounded-lg text-sm font-semibold hover:bg-surface dark:bg-[#12140e] transition-colors shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] bg-surface-white">
                        <span class="material-symbols-outlined text-[18px]">filter_list</span>
                        Filters
                    </button>
                    <button class="flex items-center gap-2 px-4 py-3 bg-primary text-white rounded-lg text-sm font-bold hover:opacity-90 transition-opacity shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
                        <span class="material-symbols-outlined text-[18px]">person_add</span>
                        Add User
                    </button>
                </div>
            </div>

            <!-- Bento User Grid / Table -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-left bg-surface-high">
                            <th class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400 uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400 uppercase tracking-wider">Joined</th>
                            <th class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400 uppercase tracking-wider text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse($users as $user)
                        <tr class="hover:bg-surface-container dark:bg-[#20241b] transition-colors group">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-primary-dark font-bold text-sm flex-shrink-0 shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] border border-primary-container">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="text-base font-bold text-on-surface dark:text-white dark:text-white">{{ $user->name }}</div>
                                        <div class="text-sm font-semibold text-secondary dark:text-gray-400">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                @if(Auth::id() !== $user->id)
                                    <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST" onsubmit="return confirm('Toggle access for {{ $user->name }}?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="flex items-center gap-2 group-hover:scale-[1.02] transition-transform">
                                            @if($user->is_active)
                                            <div class="w-10 h-5 bg-primary-container rounded-full relative flex items-center px-1 cursor-pointer transition-colors shadow-inner">
                                                <div class="w-3.5 h-3.5 bg-primary-dark rounded-full ml-auto shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]"></div>
                                            </div>
                                            <span class="text-sm font-semibold text-primary-dark">Active</span>
                                            @else
                                            <div class="w-10 h-5 bg-surface-variant rounded-full relative flex items-center px-1 cursor-pointer transition-colors shadow-inner">
                                                <div class="w-3.5 h-3.5 bg-outline rounded-full shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]"></div>
                                            </div>
                                            <span class="text-sm font-semibold text-secondary dark:text-gray-400">Inactive</span>
                                            @endif
                                        </button>
                                    </form>
                                @else
                                    <div class="flex items-center gap-2">
                                        <div class="w-10 h-5 bg-primary-container opacity-50 rounded-full relative flex items-center px-1">
                                            <div class="w-3.5 h-3.5 bg-primary-dark rounded-full ml-auto"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-primary-dark">Active</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($user->roles as $role)
                                        <span class="px-3 py-1 {{ $role->name === 'admin' ? 'bg-primary-fixed text-primary-dark border-primary-fixed border' : 'bg-secondary-container text-on-secondary-container border border-outline-variant dark:border-[#444934]' }} rounded-full text-xs font-bold uppercase tracking-wider">
                                            {{ $role->display_name }}
                                        </span>
                                    @endforeach
                                    @if($user->roles->isEmpty())
                                        <span class="px-3 py-1 bg-surface-container dark:bg-[#20241b] text-secondary dark:text-gray-400 border border-outline-variant dark:border-[#444934] rounded-full text-xs font-bold uppercase tracking-wider">Member</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-5 text-sm font-semibold text-secondary dark:text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-5 text-right">
                                <button class="material-symbols-outlined p-2 rounded-full text-outline hover:text-on-surface dark:text-white hover:bg-surface-high transition-colors">more_vert</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-secondary dark:text-gray-400 text-lg">No users found matching your search.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 bg-surface-high border-t border-outline-variant dark:border-[#444934] rounded-b-xl">
                {{ $users->withQueryString()->links('pagination::tailwind') }}
            </div>
        </div>

        <!-- Asymmetric Summary Section -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 bg-blue-50 border border-blue-100 p-10 rounded-2xl reveal-card">
                <h3 class="text-2xl font-bold text-blue-900 mb-4">Growth Insights</h3>
                <p class="text-base text-blue-800 opacity-90 mb-8 max-w-2xl">User registration has increased by 14% this month, with the majority of new members joining from the Engineering and Arts faculties. Keep optimizing the onboarding flow for these cohorts.</p>
                <div class="h-40 w-full bg-surface-container-lowest dark:bg-[#1a1c21]/40 rounded-xl flex items-end p-6 gap-3 border border-white/50 shadow-inner">
                    <div class="flex-1 bg-blue-300/60 hover:bg-blue-400/80 transition-colors h-1/2 rounded-t-md"></div>
                    <div class="flex-1 bg-blue-300/60 hover:bg-blue-400/80 transition-colors h-2/3 rounded-t-md"></div>
                    <div class="flex-1 bg-blue-300/60 hover:bg-blue-400/80 transition-colors h-1/3 rounded-t-md"></div>
                    <div class="flex-1 bg-blue-300/60 hover:bg-blue-400/80 transition-colors h-3/4 rounded-t-md"></div>
                    <div class="flex-1 bg-blue-300/60 hover:bg-blue-400/80 transition-colors h-full rounded-t-md"></div>
                    <div class="flex-1 bg-blue-300/60 hover:bg-blue-400/80 transition-colors h-4/5 rounded-t-md"></div>
                    <div class="flex-1 bg-blue-300/60 hover:bg-blue-400/80 transition-colors h-5/6 rounded-t-md"></div>
                </div>
            </div>
            <div class="bg-primary-container border border-primary p-10 rounded-2xl flex flex-col justify-between reveal-card">
                <div>
                    <span class="material-symbols-outlined text-[48px] text-primary-dark mb-4 drop-shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">verified</span>
                    <h3 class="text-2xl font-bold text-primary-dark">Quick Actions</h3>
                </div>
                <div class="space-y-3 mt-6">
                    <button class="w-full text-left p-4 rounded-xl bg-surface-container-lowest dark:bg-[#1a1c21]/60 hover:bg-surface-container-lowest dark:bg-[#1a1c21] border border-white/50 transition-all font-bold text-primary-dark shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] flex items-center justify-between group">
                        Review Applications
                        <span class="material-symbols-outlined text-primary-dark opacity-0 group-hover:opacity-100 transition-opacity transform group-hover:translate-x-1">arrow_forward</span>
                    </button>
                    <button class="w-full text-left p-4 rounded-xl bg-surface-container-lowest dark:bg-[#1a1c21]/60 hover:bg-surface-container-lowest dark:bg-[#1a1c21] border border-white/50 transition-all font-bold text-primary-dark shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] flex items-center justify-between group">
                        Export CSV Data
                        <span class="material-symbols-outlined text-primary-dark opacity-0 group-hover:opacity-100 transition-opacity transform group-hover:translate-x-1">arrow_forward</span>
                    </button>
                    <button class="w-full text-left p-4 rounded-xl bg-surface-container-lowest dark:bg-[#1a1c21]/60 hover:bg-surface-container-lowest dark:bg-[#1a1c21] border border-white/50 transition-all font-bold text-primary-dark shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] flex items-center justify-between group">
                        Email All Mentors
                        <span class="material-symbols-outlined text-primary-dark opacity-0 group-hover:opacity-100 transition-opacity transform group-hover:translate-x-1">arrow_forward</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
