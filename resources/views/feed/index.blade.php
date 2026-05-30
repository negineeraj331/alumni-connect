@extends('layouts.app')
@section('title', 'Activity Feed — Alumni Connect')

@section('content')
<div class="max-w-max-width mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- ===== LEFT SIDEBAR ===== --}}
        <aside class="lg:col-span-3 space-y-6 hidden lg:block">
            {{-- Profile card --}}
            <div class="bg-white dark:bg-[#1a1c21] p-8 rounded-2xl border border-outline-variant dark:border-[rgba(212,255,62,0.15)] shadow-sm dark:shadow-[0_0_18px_rgba(212,255,62,0.06)] reveal-card">
                <div class="flex flex-col items-center text-center">
                    {{-- Role-based avatar color --}}
                    @php
                        $role = Auth::user()->roles->first()?->name ?? 'member';
                        $avatarBg = match($role) {
                            'student'   => 'bg-[#cceaf8] text-[#0a5c82] shadow-[0_0_14px_rgba(100,180,230,0.5)]',
                            'alumni'    => 'bg-[#d4ff3e] text-[#3d4d00] shadow-[0_0_14px_rgba(212,255,62,0.5)]',
                            'faculty','mentor' => 'bg-[#fcd8e5] text-[#8b1a45] shadow-[0_0_14px_rgba(230,100,150,0.5)]',
                            'organizer' => 'bg-[#fde4b8] text-[#8b4a00] shadow-[0_0_14px_rgba(230,170,80,0.5)]',
                            default     => 'bg-[#e8d8fa] text-[#5a2d8c] shadow-[0_0_14px_rgba(180,130,240,0.5)]',
                        };
                        $roleLabel = match($role) {
                            'student' => 'Student', 'alumni' => 'Alumni Member',
                            'faculty' => 'Faculty', 'mentor' => 'Mentor',
                            'organizer' => 'Event Organizer', default => 'Member'
                        };
                    @endphp
                    <div class="w-24 h-24 rounded-full overflow-hidden mb-4 border-4 border-white/60 dark:border-white/10 {{ $avatarBg }} flex items-center justify-center font-black text-3xl">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <h2 class="text-2xl font-bold text-on-surface dark:text-white">{{ Auth::user()->name }}</h2>
                    <p class="text-base font-semibold text-secondary dark:text-gray-400 mb-6">{{ $roleLabel }}</p>
                    <div class="w-full grid grid-cols-2 gap-4 border-t border-outline-variant dark:border-[rgba(212,255,62,0.12)] pt-6">
                        <div>
                            <p class="text-xs font-bold text-secondary dark:text-gray-500 uppercase tracking-wide mb-1">Connections</p>
                            <p class="text-2xl font-black text-primary dark:text-[#d4ff3e]">124</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-secondary dark:text-gray-500 uppercase tracking-wide mb-1">Posts</p>
                            <p class="text-2xl font-black text-primary dark:text-[#d4ff3e]">{{ Auth::user()->activityPosts()->count() ?? '0' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Milestones card --}}
            <div class="bg-[#f4f7ed] dark:bg-[#141a0a] border border-[#c8e6a0] dark:border-[rgba(180,230,100,0.25)] p-6 rounded-2xl shadow-sm dark:shadow-[0_0_16px_rgba(212,255,62,0.06)] reveal-card">
                <h3 class="text-xs font-black text-[#516600] dark:text-[#d4ff3e] mb-4 uppercase tracking-widest">Your Milestones</h3>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-[#3d4d00] dark:text-[#c8e6a0] font-semibold">
                        <span class="material-symbols-outlined text-[#516600] dark:text-[#d4ff3e]" style="font-variation-settings:'FILL' 1">workspace_premium</span>
                        <span class="text-sm">Verified Profile</span>
                    </li>
                    <li class="flex items-center gap-3 text-[#3d4d00] dark:text-[#c8e6a0] font-semibold">
                        <span class="material-symbols-outlined text-[#516600] dark:text-[#d4ff3e]" style="font-variation-settings:'FILL' 1">school</span>
                        <span class="text-sm">Network Active</span>
                    </li>
                </ul>
            </div>
        </aside>

        {{-- ===== MAIN FEED CANVAS ===== --}}
        <section class="lg:col-span-6 space-y-6">
            {{-- Create Post --}}
            <div class="bg-white dark:bg-[#1a1c21] p-6 rounded-2xl border-2 border-outline-variant dark:border-[rgba(212,255,62,0.18)] shadow-sm dark:shadow-[0_0_18px_rgba(212,255,62,0.06)] reveal-card">
                <form action="{{ route('feed.store') }}" method="POST">
                    @csrf
                    <div class="flex gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0 {{ Auth::user()->profile?->avatar_path ? '' : $avatarBg }} flex items-center justify-center font-black text-lg">
                            @if(Auth::user()->profile?->avatar_path)
                                <img src="{{ asset('storage/' . Auth::user()->profile->avatar_path) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr(Auth::user()->name, 0, 1) }}
                            @endif
                        </div>
                        <textarea name="content" required
                                  class="w-full bg-transparent border-none focus:ring-0 text-lg font-medium resize-none pt-2 text-on-surface dark:text-[#e3e3e3] placeholder:text-secondary dark:placeholder:text-gray-600 focus:outline-none"
                                  placeholder="Share an update or opportunity with the community..." rows="2"></textarea>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between items-center pt-4 border-t border-outline-variant dark:border-[rgba(212,255,62,0.12)] gap-4">
                        <div class="flex gap-2">
                            <button type="button" class="flex items-center gap-2 px-3 py-2 hover:bg-surface-container dark:hover:bg-[#1e2025] rounded-lg transition-colors text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-[#d4ff3e] font-semibold text-sm">
                                <span class="material-symbols-outlined text-[18px]">image</span>
                                <span class="hidden sm:inline">Media</span>
                            </button>
                            <button type="button" class="flex items-center gap-2 px-3 py-2 hover:bg-surface-container dark:hover:bg-[#1e2025] rounded-lg transition-colors text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-[#d4ff3e] font-semibold text-sm">
                                <span class="material-symbols-outlined text-[18px]">event</span>
                                <span class="hidden sm:inline">Event</span>
                            </button>
                            <div class="relative">
                                <select name="visibility" class="appearance-none pl-8 pr-8 py-2 bg-surface-container dark:bg-[#0f1115] rounded-lg border border-outline-variant dark:border-[rgba(212,255,62,0.2)] text-sm font-semibold text-on-surface dark:text-[#e3e3e3] cursor-pointer focus:outline-none focus:border-primary dark:focus:border-[#d4ff3e] hover:bg-surface-container dark:hover:bg-[#1e2025] transition-colors">
                                    <option value="all">All Members</option>
                                    @if(Auth::user()->hasRole('alumni') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('mentor'))
                                    <option value="alumni_only">Alumni Only</option>
                                    @endif
                                </select>
                                <span class="material-symbols-outlined absolute left-2 top-1/2 -translate-y-1/2 text-secondary dark:text-gray-400 text-[16px] pointer-events-none">public</span>
                                <span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-secondary dark:text-gray-400 text-[16px] pointer-events-none">expand_more</span>
                            </div>
                        </div>
                        <button type="submit" class="w-full md:w-auto bg-primary dark:bg-[#d4ff3e] text-white dark:text-[#1c1b1b] px-8 py-2.5 rounded-full font-bold hover:opacity-90 active:scale-95 transition-all shadow-sm dark:shadow-[0_0_12px_rgba(212,255,62,0.3)]">
                            Post Update
                        </button>
                    </div>
                </form>
            </div>

            {{-- Feed Items --}}
            @if($posts->isEmpty())
                <div class="text-center py-16 bg-white dark:bg-[#1a1c21] rounded-2xl border border-outline-variant dark:border-[rgba(212,255,62,0.15)] shadow-sm dark:shadow-[0_0_18px_rgba(212,255,62,0.06)] reveal-card">
                    <span class="material-symbols-outlined text-6xl text-secondary dark:text-gray-600 mb-4">dynamic_feed</span>
                    <h3 class="text-2xl font-bold text-on-surface dark:text-white">No posts yet</h3>
                    <p class="text-secondary dark:text-gray-400 text-lg mt-2">Be the first to share something with the community!</p>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($posts as $post)
                    @php
                        $posterRole = $post->user->roles->first()?->name ?? 'member';
                        $posterAvatar = match($posterRole) {
                            'student'   => 'bg-[#cceaf8] text-[#0a5c82]',
                            'alumni'    => 'bg-[#d4ff3e] text-[#3d4d00]',
                            'faculty','mentor' => 'bg-[#fcd8e5] text-[#8b1a45]',
                            'organizer' => 'bg-[#fde4b8] text-[#8b4a00]',
                            default     => 'bg-[#e8d8fa] text-[#5a2d8c]',
                        };
                    @endphp
                    <article class="bg-white dark:bg-[#1a1c21] rounded-2xl overflow-hidden border border-outline-variant dark:border-[rgba(212,255,62,0.15)] shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] reveal-card">
                        <div class="p-6 md:p-8">
                            {{-- Post Header --}}
                            <div class="flex justify-between items-start mb-6">
                                <div class="flex gap-4">
                                    <a href="{{ route('profiles.show', $post->user->id) }}"
                                       class="w-12 h-12 rounded-full overflow-hidden {{ $post->user->profile?->avatar_path ? '' : $posterAvatar }} flex items-center justify-center font-black text-lg hover:opacity-80 transition-opacity">
                                        @if($post->user->profile?->avatar_path)
                                            <img src="{{ asset('storage/' . $post->user->profile->avatar_path) }}" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($post->user->name, 0, 1) }}
                                        @endif
                                    </a>
                                    <div>
                                        <a href="{{ route('profiles.show', $post->user->id) }}"
                                           class="text-lg font-bold text-on-surface dark:text-white hover:text-primary dark:hover:text-[#d4ff3e] transition-colors">
                                            {{ $post->user->name }}
                                        </a>
                                        <p class="text-sm font-semibold text-secondary dark:text-gray-400">
                                            {{ $post->user->roles->first()?->display_name ?? 'Member' }} • {{ $post->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <span class="{{ $post->visibility === 'alumni_only'
                                    ? 'bg-[#f4f7ed] dark:bg-[rgba(180,230,100,0.15)] text-[#516600] dark:text-[#c8e6a0] border-[#c8e6a0] dark:border-[rgba(180,230,100,0.3)]'
                                    : 'bg-green-50 dark:bg-[rgba(34,197,94,0.1)] text-green-700 dark:text-green-400 border-green-200 dark:border-green-800' }} border px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider">
                                    {{ $post->visibility === 'alumni_only' ? 'Alumni Only' : 'All Members' }}
                                </span>
                            </div>

                            {{-- Post Content --}}
                            <p class="text-base font-medium text-on-surface dark:text-[#d4d4d4] mb-6 leading-relaxed whitespace-pre-line">{{ $post->content }}</p>

                            {{-- Image (every 3rd post) --}}
                            @if($loop->iteration % 3 === 0)
                            <div class="aspect-video rounded-xl overflow-hidden bg-surface-container dark:bg-[#1e2025] mb-6 border border-outline-variant dark:border-[rgba(212,255,62,0.1)]">
                                <img class="w-full h-full object-cover opacity-80" src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&q=80&w=1200" alt="Community workshop"/>
                            </div>
                            @endif

                            {{-- Post Actions --}}
                            <div class="flex items-center justify-between border-t border-outline-variant dark:border-[rgba(212,255,62,0.1)] pt-4 mt-2">
                                <div class="flex gap-4 md:gap-6">
                                    <button class="flex items-center gap-2 group">
                                        <span class="material-symbols-outlined text-secondary dark:text-gray-500 group-hover:text-red-500 transition-colors">favorite</span>
                                        <span class="text-sm font-semibold text-secondary dark:text-gray-500 group-hover:text-red-500 hidden sm:inline">{{ rand(10, 150) }}</span>
                                    </button>
                                    <button class="flex items-center gap-2 group">
                                        <span class="material-symbols-outlined text-secondary dark:text-gray-500 group-hover:text-primary dark:group-hover:text-[#d4ff3e] transition-colors">chat_bubble</span>
                                        <span class="text-sm font-semibold text-secondary dark:text-gray-500 group-hover:text-primary dark:group-hover:text-[#d4ff3e] hidden sm:inline">{{ rand(2, 30) }}</span>
                                    </button>
                                    <button class="flex items-center gap-2 group">
                                        <span class="material-symbols-outlined text-secondary dark:text-gray-500 group-hover:text-primary dark:group-hover:text-[#d4ff3e] transition-colors">share</span>
                                        <span class="text-sm font-semibold text-secondary dark:text-gray-500 group-hover:text-primary dark:group-hover:text-[#d4ff3e] hidden sm:inline">Share</span>
                                    </button>
                                </div>
                                <button class="material-symbols-outlined text-secondary dark:text-gray-500 hover:text-on-surface dark:hover:text-[#d4ff3e] transition-colors p-2 rounded-full hover:bg-surface-container dark:hover:bg-[#1e2025]">bookmark</button>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
                <div class="mt-8 flex justify-center">
                    {{ $posts->links('pagination::tailwind') }}
                </div>
            @endif
        </section>

        {{-- ===== RIGHT SIDEBAR ===== --}}
        <aside class="lg:col-span-3 space-y-6 hidden lg:block">
            {{-- Trending Now --}}
            <div class="bg-white dark:bg-[#1a1c21] p-6 md:p-8 rounded-2xl border border-outline-variant dark:border-[rgba(212,255,62,0.15)] shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] reveal-card">
                <h3 class="text-xs font-black text-secondary dark:text-gray-400 mb-6 uppercase tracking-widest">Trending Now</h3>
                <ul class="space-y-6">
                    @foreach([
                        ['tag' => '#AlumniMeetup2024', 'text' => 'Global Networking Gala in New York this weekend.'],
                        ['tag' => '#TechCareers',      'text' => 'New job postings from top alumni companies.'],
                        ['tag' => '#MentorshipMatters','text' => '50+ new mentors joined the platform today.'],
                    ] as $trend)
                    <li>
                        <a class="group block" href="#">
                            <p class="text-sm font-black text-primary dark:text-[#d4ff3e] mb-1">{{ $trend['tag'] }}</p>
                            <p class="text-sm font-semibold text-on-surface dark:text-[#d4d4d4] group-hover:text-primary dark:group-hover:text-[#d4ff3e] transition-colors leading-snug">{{ $trend['text'] }}</p>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Suggested Connections --}}
            <div class="bg-white dark:bg-[#1a1c21] p-6 md:p-8 rounded-2xl border border-outline-variant dark:border-[rgba(212,255,62,0.15)] shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] reveal-card">
                <h3 class="text-xs font-black text-secondary dark:text-gray-400 mb-6 uppercase tracking-widest">Suggested Connections</h3>
                <div class="space-y-5">
                    @foreach([
                        ['initials' => 'MT', 'name' => 'Mark Thompson',   'sub' => "Google · Class of '15",  'bg' => 'bg-[#cceaf8] text-[#0a5c82]'],
                        ['initials' => 'ER', 'name' => 'Elena Rodriguez', 'sub' => "Tesla · Class of '19",   'bg' => 'bg-[#e8d8fa] text-[#5a2d8c]'],
                        ['initials' => 'AS', 'name' => 'Arun Sharma',     'sub' => "Microsoft · Class of '20",'bg' => 'bg-[#fde4b8] text-[#8b4a00]'],
                    ] as $conn)
                    <div class="flex items-center justify-between group cursor-pointer">
                        <div class="flex gap-3 items-center">
                            <div class="w-10 h-10 rounded-full {{ $conn['bg'] }} flex items-center justify-center font-black text-sm">{{ $conn['initials'] }}</div>
                            <div>
                                <p class="text-sm font-bold text-on-surface dark:text-white group-hover:text-primary dark:group-hover:text-[#d4ff3e] transition-colors">{{ $conn['name'] }}</p>
                                <p class="text-xs font-semibold text-secondary dark:text-gray-500">{{ $conn['sub'] }}</p>
                            </div>
                        </div>
                        <button class="material-symbols-outlined text-primary dark:text-[#d4ff3e] p-2 hover:bg-primary-container dark:hover:bg-[rgba(212,255,62,0.15)] rounded-full transition-colors text-[20px]">person_add</button>
                    </div>
                    @endforeach
                </div>
                <button class="w-full mt-6 pt-4 border-t border-outline-variant dark:border-[rgba(212,255,62,0.1)] text-sm font-bold text-primary dark:text-[#d4ff3e] hover:underline transition-all">
                    View All Suggestions
                </button>
            </div>
        </aside>

    </div>
</div>
@endsection
