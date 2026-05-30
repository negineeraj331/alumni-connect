@extends('layouts.app')
@section('title', 'Admin Overview — Alumni Connect')

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
                    @if($stats['pending_flags'] > 0)
                    <span class="ml-auto bg-error text-surface text-xs px-2 py-0.5 rounded-full font-bold">{{ $stats['pending_flags'] }}</span>
                    @endif
                </a>
            </nav>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 min-w-0 space-y-12">
        <!-- Dashboard Header -->
        <section class="space-y-4">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <span class="text-sm font-semibold text-primary uppercase tracking-wider">Internal Admin Console</span>
                    <h1 class="text-3xl md:text-5xl font-bold mt-2 text-on-surface dark:text-white dark:text-white">Platform Overview</h1>
                    <p class="text-lg text-secondary dark:text-gray-400 max-w-2xl mt-4">Monitor growth, active engagements, and system health in real-time. Academic heritage meets professional oversight.</p>
                </div>
                <div class="flex gap-4">
                    <button class="flex items-center gap-2 px-4 py-3 bg-surface-container dark:bg-[#20241b] text-on-surface dark:text-white text-sm font-semibold rounded-lg border border-outline-variant dark:border-[#444934] hover:border-outline dark:border-[#757962] transition-colors shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
                        <span class="material-symbols-outlined text-[20px]">file_download</span>
                        Export Data
                    </button>
                    <button class="flex items-center gap-2 px-4 py-3 bg-primary-container text-primary-dark text-sm font-bold rounded-lg hover:opacity-90 transition-opacity shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
                        <span class="material-symbols-outlined text-[20px]">refresh</span>
                        Sync Nodes
                    </button>
                </div>
            </div>
        </section>

        <!-- High-Level Stats Bento Grid -->
        <section class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Total Users -->
            <div class="md:col-span-2 bg-primary-container p-8 md:p-10 rounded-2xl space-y-6 flex flex-col justify-between min-h-[240px] reveal-card border border-outline-variant dark:border-[#444934] shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-semibold text-primary-dark uppercase">Network Expansion</p>
                        <h2 class="text-5xl md:text-6xl font-extrabold text-primary-dark mt-2">{{ number_format($stats['total_users']) }}</h2>
                    </div>
                    <div class="bg-surface-white p-3 rounded-full shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] text-primary">
                        <span class="material-symbols-outlined text-[32px]">group</span>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-primary-dark text-sm font-semibold">
                    <span class="material-symbols-outlined text-[18px]">trending_up</span>
                    <span>14% increase vs last month</span>
                </div>
            </div>

            <!-- Active Mentorships -->
            <div class="bg-blue-50 p-8 md:p-10 rounded-2xl space-y-6 flex flex-col justify-between reveal-card border border-blue-100 shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
                <div>
                    <p class="text-sm font-semibold text-blue-900 uppercase">Mentorships</p>
                    <h2 class="text-4xl md:text-5xl font-bold text-blue-900 mt-2">{{ number_format($stats['active_mentorships']) }}</h2>
                </div>
                <div class="flex items-center gap-2 text-blue-800 text-sm font-semibold">
                    <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">favorite</span>
                    <span>98% match rate</span>
                </div>
            </div>

            <!-- Pending Flags -->
            <div class="bg-red-50 p-8 md:p-10 rounded-2xl space-y-6 flex flex-col justify-between reveal-card border border-red-100 shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
                <div>
                    <p class="text-sm font-semibold text-red-900 uppercase">Security Alerts</p>
                    <h2 class="text-4xl md:text-5xl font-bold text-red-900 mt-2">{{ str_pad($stats['pending_flags'], 2, '0', STR_PAD_LEFT) }}</h2>
                </div>
                <div class="flex items-center gap-2 text-red-800 text-sm font-semibold">
                    <span class="material-symbols-outlined text-[18px]">warning</span>
                    <span>Requires immediate review</span>
                </div>
            </div>
        </section>

        <!-- Main Content Cluster -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <!-- Security Audit Log (2 Cols) -->
            <section class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-bold text-on-surface dark:text-white dark:text-white">Live Security Audit</h3>
                    <a class="text-sm font-semibold text-primary hover:underline" href="#">View All Logs</a>
                </div>
                <div class="bg-surface-low rounded-2xl border border-outline-variant dark:border-[#444934] overflow-hidden shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] reveal-card">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-surface-high border-b border-outline-variant dark:border-[#444934]">
                                <tr>
                                    <th class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400 uppercase tracking-wider">Event</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400 uppercase tracking-wider">Actor</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400 uppercase tracking-wider">Timestamp</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400 uppercase tracking-wider text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @forelse($recentLogs as $log)
                                <tr class="hover:bg-surface-container dark:bg-[#20241b] transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @if(str_contains($log->action, 'auth') || str_contains($log->action, 'login'))
                                                <span class="material-symbols-outlined text-secondary dark:text-gray-400">login</span>
                                            @elseif(str_contains($log->action, 'flag'))
                                                <span class="material-symbols-outlined text-error">gpp_maybe</span>
                                            @elseif(str_contains($log->action, 'password'))
                                                <span class="material-symbols-outlined text-primary">key</span>
                                            @else
                                                <span class="material-symbols-outlined text-secondary dark:text-gray-400">edit_note</span>
                                            @endif
                                            <span class="text-base font-semibold">{{ ucfirst(str_replace('_', ' ', $log->action)) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-base font-medium">{{ $log->user->email ?? 'System' }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400">{{ $log->created_at->diffForHumans() }}</td>
                                    <td class="px-6 py-4 text-right">
                                        @if(str_contains($log->action, 'deactivated') || str_contains($log->action, 'failed'))
                                            <span class="inline-block px-3 py-1 bg-red-100 text-red-800 text-[12px] font-bold rounded-full uppercase">Blocked</span>
                                        @elseif(str_contains($log->action, 'system'))
                                            <span class="inline-block px-3 py-1 bg-primary-container text-primary-dark text-[12px] font-bold rounded-full uppercase">System</span>
                                        @else
                                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-[12px] font-bold rounded-full uppercase">Verified</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-secondary dark:text-gray-400">No recent logs found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Data Visualization Mockup (1 Col) -->
            <section class="space-y-6">
                <h3 class="text-2xl font-bold text-on-surface dark:text-white dark:text-white">Traffic Density</h3>
                <div class="bg-surface-low p-8 rounded-2xl border border-outline-variant dark:border-[#444934] h-full space-y-8 shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] reveal-card">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-secondary dark:text-gray-400 uppercase">Regional Usage</span>
                        <span class="text-sm font-semibold text-primary">Global</span>
                    </div>
                    <!-- Visualization SVG Placeholder -->
                    <div class="relative aspect-square flex items-center justify-center bg-surface-container-lowest dark:bg-[#1a1c21] rounded-full border-[12px] border-surface-container overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <p class="text-5xl font-extrabold text-primary leading-none tracking-tight">64%</p>
                                <p class="text-sm font-semibold text-secondary dark:text-gray-400 mt-1">Active Nodes</p>
                            </div>
                        </div>
                        <svg class="w-full h-full -rotate-90 transform" viewBox="0 0 100 100">
                            <circle class="text-primary-container" cx="50" cy="50" fill="transparent" r="45" stroke="currentColor" stroke-dasharray="282.7" stroke-dashoffset="100" stroke-width="10"></circle>
                        </svg>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-primary"></div>
                                <span class="text-base font-semibold">North America</span>
                            </div>
                            <span class="text-sm font-bold">42%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-secondary"></div>
                                <span class="text-base font-semibold">Europe</span>
                            </div>
                            <span class="text-sm font-bold">28%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-outline-variant"></div>
                                <span class="text-base font-semibold">Asia Pacific</span>
                            </div>
                            <span class="text-sm font-bold">30%</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Featured Resource / Map Section -->
        <section class="bg-surface-highest rounded-2xl overflow-hidden relative min-h-[400px] flex items-center border border-outline-variant dark:border-[#444934] shadow-inner reveal-card">
            <div class="absolute inset-0 z-0 bg-black">
                <img alt="Global Network Map" class="w-full h-full object-cover opacity-40 grayscale brightness-50" data-alt="A high-altitude, wide-angle cinematic shot of a modern urban landscape at dusk with illuminated city lights and a subtle network mesh overlay." src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&q=80&w=1200"/>
            </div>
            <div class="relative z-10 p-8 md:p-12 max-w-2xl space-y-6">
                <h3 class="text-4xl font-extrabold text-white">Global Engagement Map</h3>
                <p class="text-lg text-gray-200">Identify and connect with alumni hubs across the globe. Our intelligent mapping system tracks professional density to help you plan regional events and mentorship drives.</p>
                <div class="flex flex-wrap gap-4 pt-2">
                    <button class="px-8 py-3 bg-primary text-white font-bold rounded-lg hover:opacity-90 transition-opacity">Explore Hubs</button>
                    <button class="px-8 py-3 bg-surface-container-lowest dark:bg-[#1a1c21]/10 backdrop-blur-md text-white border border-white/20 font-bold rounded-lg hover:bg-surface-container-lowest dark:bg-[#1a1c21]/20 transition-all">View Regional Stats</button>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
