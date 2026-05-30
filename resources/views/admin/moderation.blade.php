@extends('layouts.app')
@section('title', 'Content Moderation — Admin — Alumni Connect')

@section('content')
<div class="flex flex-col lg:flex-row gap-8">
    {{-- Admin Sidebar --}}
    <aside class="w-full lg:w-56 flex-shrink-0">
        <div class="bg-surface-white rounded-card border border-outline-variant dark:border-[#444934] p-3 sticky top-24 shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
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
                    @if($flags->where('status','pending')->count() > 0)
                    <span class="ml-auto bg-error text-surface text-xs px-2 py-0.5 rounded-full font-bold">{{ $flags->where('status','pending')->count() }}</span>
                    @endif
                </a>
            </nav>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 min-w-0 space-y-6">
        <!-- Header Section -->
        <header class="mb-10">
            <h1 class="text-4xl font-bold mb-3 text-on-surface dark:text-white dark:text-white">Review Flagged Content</h1>
            <p class="text-lg text-secondary dark:text-gray-400 max-w-2xl">
                Maintain the integrity of the Alumni Connect community. Carefully review reported posts and decide on appropriate actions based on community guidelines.
            </p>
        </header>

        <!-- Moderation Stats / Filters -->
        <div class="flex flex-col md:flex-row gap-4 mb-10 items-start md:items-center justify-between">
            <div class="flex flex-wrap gap-3">
                <button class="px-6 py-2.5 bg-primary-container text-primary-dark font-bold rounded-full text-sm border-2 border-primary-container shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
                    All Reports ({{ $flags->total() }})
                </button>
                <button class="px-6 py-2.5 bg-surface-white text-secondary dark:text-gray-400 border border-outline-variant dark:border-[#444934] rounded-full text-sm font-semibold hover:bg-surface-container dark:bg-[#20241b] transition-colors shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
                    Potential Spam
                </button>
                <button class="px-6 py-2.5 bg-surface-white text-secondary dark:text-gray-400 border border-outline-variant dark:border-[#444934] rounded-full text-sm font-semibold hover:bg-surface-container dark:bg-[#20241b] transition-colors shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
                    Harassment
                </button>
            </div>
            <div class="flex items-center gap-2 text-sm font-semibold text-secondary dark:text-gray-400">
                <span class="material-symbols-outlined text-xl" data-icon="history">history</span>
                Last activity: {{ $flags->first() ? $flags->first()->updated_at->diffForHumans() : 'N/A' }}
            </div>
        </div>

        @if($flags->isEmpty())
            <div class="p-16 text-center bg-surface-low border border-outline-variant dark:border-[#444934] rounded-2xl">
                <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">check_circle</span>
                <h3 class="text-2xl font-bold text-on-surface dark:text-white dark:text-white">All clear!</h3>
                <p class="text-secondary dark:text-gray-400 text-lg mt-2">No flagged content requiring attention.</p>
            </div>
        @else
            <!-- Moderation Grid (Asymmetric) -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-stretch">
                @foreach($flags as $flag)
                    @php
                        // Asymmetric Grid Pattern: 8, 4, 8, 4, 8, 4...
                        $spanClass = ($loop->index % 2 === 0) ? 'md:col-span-8' : 'md:col-span-4';
                        
                        // Alternating backgrounds
                        $bgClasses = [
                            'bg-red-50 border-red-100', // Warning tone
                            'bg-blue-50 border-blue-100', // Info tone
                            'bg-surface-white border-outline-variant dark:border-[#444934]', // Neutral
                        ];
                        $bgClass = $bgClasses[$loop->index % 3];
                    @endphp

                    <!-- Flagged Post Card -->
                    <div class="{{ $spanClass }} {{ $bgClass }} p-8 md:p-10 rounded-2xl flex flex-col justify-between border shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] reveal-card">
                        <div>
                            <div class="flex flex-col xl:flex-row justify-between xl:items-start gap-4 mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-surface-highest flex items-center justify-center text-secondary dark:text-gray-400 font-bold shadow-inner">
                                        {{ substr($flag->reporter->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-on-surface dark:text-white dark:text-white">{{ $flag->reporter->name ?? 'Unknown User' }}</h3>
                                        <p class="text-sm font-semibold text-secondary dark:text-gray-400">Reported {{ $flag->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="px-3 py-1.5 bg-red-100 text-red-800 rounded-full text-xs font-bold self-start uppercase tracking-wider">
                                    Flagged for: {{ $flag->reason ?? 'Policy Violation' }}
                                </div>
                            </div>
                            
                            <div class="text-base md:text-lg text-on-surface dark:text-white mb-8 font-medium italic border-l-4 border-outline-variant dark:border-[#444934] pl-4 py-1">
                                "@if($flag->content)
                                    {{ Str::limit($flag->content->body ?? $flag->content->content ?? 'Content unavailable', 250) }}
                                @else
                                    Content already removed.
                                @endif"
                            </div>
                        </div>

                        @if($flag->status === 'pending')
                            <div class="flex flex-col sm:flex-row gap-4 border-t border-black/10 pt-6 mt-auto">
                                <form action="{{ route('admin.flags.resolve', $flag->id) }}" method="POST" class="flex-1 flex">
                                    @csrf
                                    <input type="hidden" name="action" value="ignore">
                                    <button type="submit" class="w-full px-6 py-3 border-2 border-on-surface text-on-surface dark:text-white font-bold rounded-xl hover:bg-on-surface hover:text-surface transition-all duration-200">
                                        Ignore
                                    </button>
                                </form>
                                <form action="{{ route('admin.flags.resolve', $flag->id) }}" method="POST" class="flex-1 flex">
                                    @csrf
                                    <input type="hidden" name="action" value="delete_content">
                                    <button type="submit" class="w-full px-6 py-3 bg-error text-surface border-2 border-error font-bold rounded-xl hover:bg-red-700 hover:border-red-700 transition-all duration-200">
                                        Delete Content
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="flex items-center gap-2 border-t border-black/10 pt-6 mt-auto text-green-700 font-bold">
                                <span class="material-symbols-outlined">check_circle</span>
                                Resolved ({{ $flag->resolved_at ? \Carbon\Carbon::parse($flag->resolved_at)->diffForHumans() : 'recently' }})
                            </div>
                        @endif
                    </div>

                    @if($loop->iteration === 1)
                        <!-- Small Info Card (Guideline Tip) -->
                        <div class="md:col-span-4 bg-primary-container p-8 md:p-10 rounded-2xl border border-primary flex flex-col gap-6 shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] reveal-card">
                            <span class="material-symbols-outlined text-5xl text-primary-dark" data-icon="policy">policy</span>
                            <h4 class="text-2xl font-bold text-primary-dark">Guideline Tip</h4>
                            <p class="text-base font-semibold text-primary-dark opacity-90 leading-relaxed">
                                Posts promoting "unauthorized access" or phishing links are a direct violation of Section 4.2 of our Community Safety Protocol.
                            </p>
                            <a class="text-primary-dark font-bold hover:underline flex items-center gap-2 mt-auto text-lg" href="#">
                                Read full guidelines <span class="material-symbols-outlined text-base" data-icon="arrow_forward">arrow_forward</span>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Pagination/Load More -->
            <div class="mt-12 mb-8 text-center flex justify-center">
                {{ $flags->links('pagination::tailwind') }}
            </div>
        @endif
        
        {{-- Global Feed Monitor (Secondary Table) --}}
        <div class="bg-surface-white rounded-2xl border border-outline-variant dark:border-[#444934] overflow-hidden shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] mt-12 reveal-card">
            <div class="flex items-center justify-between p-6 border-b border-outline-variant dark:border-[#444934] bg-surface-container dark:bg-[#20241b]">
                <h2 class="font-bold text-xl text-on-surface dark:text-white flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-2xl">dynamic_feed</span>
                    Global Feed Monitor
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-surface-high border-b border-outline-variant dark:border-[#444934]">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400 uppercase tracking-wider">Content Preview</th>
                            <th class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400 uppercase tracking-wider">Visibility</th>
                            <th class="px-6 py-4 text-sm font-semibold text-secondary dark:text-gray-400 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @foreach($posts as $post)
                        <tr class="hover:bg-surface-low transition-colors">
                            <td class="px-6 py-4 font-bold text-base text-on-surface dark:text-white dark:text-white">{{ $post->user->name }}</td>
                            <td class="px-6 py-4 text-secondary dark:text-gray-400 text-sm max-w-sm truncate italic">{{ $post->content }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-secondary-container text-on-secondary-container text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider">{{ $post->visibility }}</span>
                            </td>
                            <td class="px-6 py-4 text-secondary dark:text-gray-400 text-sm font-semibold">{{ $post->created_at->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
