@extends('layouts.app')

@section('title', 'Mentorship | Alumni Connect')

@section('full_content')
<style>
    .fill-icon { font-variation-settings: 'FILL' 1; }
</style>
<main class="max-w-max-width mx-auto px-4 md:px-20 space-y-20 py-12">

@if(session('success'))
    <div class="bg-primary-container text-primary-dark p-4 rounded-xl font-bold">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 p-4 rounded-xl font-bold">{{ session('error') }}</div>
@endif

{{-- ===== HERO ===== --}}
<section class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
    <div class="lg:col-span-7 space-y-6">
        <h1 class="text-5xl md:text-6xl font-black tracking-tight text-on-surface dark:text-white leading-tight">
            Grow through<br><span class="text-primary dark:text-[#d4ff3e]">shared heritage.</span>
        </h1>
        <p class="text-lg text-secondary dark:text-gray-400 max-w-xl">
            Bridge the gap between your academic roots and professional aspirations. Track your goals, connect with industry leaders, and build lasting legacies.
        </p>
        <div class="flex flex-wrap gap-4 pt-2">
            <a href="#discover"
               class="bg-primary-container text-primary-dark dark:shadow-[0_0_16px_rgba(212,255,62,0.35)] font-bold px-8 py-4 rounded-xl text-sm flex items-center gap-2 hover:opacity-90 transition-all">
                Find a Mentor <span class="material-symbols-outlined">trending_flat</span>
            </a>
            <a href="#active-connections"
               class="border-2 border-on-surface dark:border-[rgba(212,255,62,0.4)] text-on-surface dark:text-[#d4ff3e] px-8 py-4 rounded-xl font-bold text-sm hover:bg-surface-container dark:hover:bg-[#1e2025] transition-all">
                Active Connections
            </a>
        </div>
    </div>

    {{-- Stats Card --}}
    <div class="lg:col-span-5 bg-[#ffeaea] dark:bg-[#1f1218] border border-[#f0b8ce] dark:border-[rgba(230,100,150,0.2)] rounded-3xl p-10 flex flex-col justify-center relative overflow-hidden dark:shadow-[0_0_30px_rgba(212,255,62,0.05)]">
        <div class="relative z-10 space-y-8">
            <div class="space-y-2">
                <span class="text-xs font-bold text-secondary dark:text-gray-400 uppercase tracking-wider">Current Mentorship Goal</span>
                <h3 class="text-2xl font-bold text-on-surface dark:text-white">Expand Professional Network</h3>
            </div>
            <div class="w-full bg-white/50 dark:bg-white/10 h-3 rounded-full overflow-hidden">
                <div class="bg-primary dark:bg-[#d4ff3e] w-1/2 h-full rounded-full"></div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/60 dark:bg-white/10 backdrop-blur-sm p-5 rounded-2xl border border-white/40 dark:border-white/10">
                    <span class="block text-3xl font-black text-on-surface dark:text-white">{{ $asMentee->count() + $asMentor->count() }}</span>
                    <span class="text-xs font-bold text-secondary dark:text-gray-400 uppercase tracking-wide mt-1 block">Active Connections</span>
                </div>
                <div class="bg-white/60 dark:bg-white/10 backdrop-blur-sm p-5 rounded-2xl border border-white/40 dark:border-white/10">
                    <span class="block text-3xl font-black text-on-surface dark:text-white">2</span>
                    <span class="text-xs font-bold text-secondary dark:text-gray-400 uppercase tracking-wide mt-1 block">Milestones Left</span>
                </div>
            </div>
        </div>
        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-primary/10 dark:bg-[rgba(212,255,62,0.05)] rounded-full blur-3xl"></div>
    </div>
</section>

{{-- ===== ACTIVE CONNECTIONS ===== --}}
<section id="active-connections" class="space-y-8">
    <div class="flex justify-between items-end">
        <div class="space-y-1">
            <h2 class="text-3xl font-bold text-on-surface dark:text-white">Active Connections</h2>
            <p class="text-secondary dark:text-gray-400">Individuals you are currently working with.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @forelse($asMentee as $mentorship)
        <a href="{{ route('mentorship.show', $mentorship->id) }}"
           class="bg-[#f4f7ed] dark:bg-[#141a0a] border border-[#c8e6a0] dark:border-[rgba(180,230,100,0.25)] p-8 rounded-2xl flex items-center gap-6 hover:shadow-md dark:hover:shadow-[0_0_20px_rgba(212,255,62,0.08)] hover:-translate-y-0.5 transition-all">
            <div class="w-20 h-20 rounded-full overflow-hidden flex-shrink-0 flex items-center justify-center bg-[#d4ff3e] text-[#3d4d00] font-black text-2xl shadow-sm">
                @if($mentorship->mentor->profile?->avatar_path)
                    <img src="{{ asset('storage/' . $mentorship->mentor->profile->avatar_path) }}" class="w-full h-full object-cover">
                @else
                    {{ substr($mentorship->mentor->name, 0, 1) }}
                @endif
            </div>
            <div class="flex-1 min-w-0 space-y-1">
                <div class="flex justify-between items-start gap-2">
                    <h4 class="text-lg font-bold text-on-surface dark:text-white truncate">{{ $mentorship->mentor->name }}</h4>
                    <span class="text-xs font-bold bg-[#c8e6a0] text-[#3d4d00] px-3 py-1 rounded-full whitespace-nowrap flex-shrink-0">Mentor</span>
                </div>
                <p class="text-sm text-secondary dark:text-gray-400 truncate">
                    {{ $mentorship->mentor->profile?->job_title ?? 'Professional' }}
                    @if($mentorship->mentor->profile?->company) at {{ $mentorship->mentor->profile->company }} @endif
                </p>
                <span class="text-xs font-bold text-primary dark:text-[#d4ff3e] flex items-center gap-1 mt-2">
                    <span class="material-symbols-outlined text-[16px]">calendar_today</span> {{ ucfirst($mentorship->status) }}
                </span>
            </div>
        </a>
    @empty
    @endforelse

    @forelse($asMentor as $mentorship)
        <a href="{{ route('mentorship.show', $mentorship->id) }}"
           class="bg-[#fdf0f4] dark:bg-[#2a0d18] border border-[#f0b8ce] dark:border-[rgba(230,100,150,0.25)] p-8 rounded-2xl flex items-center gap-6 hover:shadow-md dark:hover:shadow-[0_0_20px_rgba(212,255,62,0.08)] hover:-translate-y-0.5 transition-all">
            <div class="w-20 h-20 rounded-full overflow-hidden flex-shrink-0 flex items-center justify-center bg-[#fcd8e5] text-[#8b1a45] font-black text-2xl shadow-sm">
                @if($mentorship->mentee->profile?->avatar_path)
                    <img src="{{ asset('storage/' . $mentorship->mentee->profile->avatar_path) }}" class="w-full h-full object-cover">
                @else
                    {{ substr($mentorship->mentee->name, 0, 1) }}
                @endif
            </div>
            <div class="flex-1 min-w-0 space-y-1">
                <div class="flex justify-between items-start gap-2">
                    <h4 class="text-lg font-bold text-on-surface dark:text-white truncate">{{ $mentorship->mentee->name }}</h4>
                    <span class="text-xs font-bold bg-[#f0b8ce] text-[#8b1a45] px-3 py-1 rounded-full whitespace-nowrap flex-shrink-0">Mentee</span>
                </div>
                <p class="text-sm text-secondary dark:text-gray-400 truncate">{{ $mentorship->mentee->profile?->field_of_study ?? 'Student' }}</p>
                <span class="text-xs font-bold text-primary dark:text-[#d4ff3e] flex items-center gap-1 mt-2">
                    <span class="material-symbols-outlined text-[16px]">calendar_today</span> {{ ucfirst($mentorship->status) }}
                </span>
            </div>
        </a>
    @empty
    @endforelse

    @if($asMentee->isEmpty() && $asMentor->isEmpty())
        <div class="col-span-full py-12 text-center text-secondary dark:text-gray-400 bg-white/50 dark:bg-[#1a1c21] rounded-2xl border-2 border-dashed border-outline-variant dark:border-[rgba(212,255,62,0.15)]">
            <span class="material-symbols-outlined text-4xl mb-2 block opacity-50">person_add</span>
            <p class="font-bold text-on-surface dark:text-white">No active connections yet</p>
            <p class="text-sm mt-1">Request a mentor or accept an invitation to get started.</p>
        </div>
    @endif
    </div>
</section>

{{-- ===== DISCOVER MENTORS ===== --}}
<section id="discover" class="space-y-10">
    <div class="text-center space-y-3 max-w-2xl mx-auto">
        <h2 class="text-3xl font-bold text-on-surface dark:text-white">Discover New Mentors</h2>
        <p class="text-secondary dark:text-gray-400">Connect with specialists across diverse industries within our alumni network.</p>
    </div>

    {{-- Uniform mentor card grid — all cards share the same layout: avatar top-right, info left, CTA bottom --}}
    @php
        $cardPalettes = [
            ['bg'=>'bg-[#f4f7ed] dark:bg-[#141a0a]', 'border'=>'border-[#c8e6a0] dark:border-[rgba(180,230,100,0.28)]', 'avatar'=>'bg-[#d4ff3e] text-[#3d4d00]', 'tag'=>'bg-[#1c1b1b] dark:bg-[#d4ff3e] text-white dark:text-[#1c1b1b]', 'btn'=>'bg-[#516600] dark:bg-[#d4ff3e] text-white dark:text-[#1c1b1b] dark:hover:shadow-[0_0_12px_rgba(212,255,62,0.4)]', 'arrow'=>'bg-[#1c1b1b] dark:bg-[#d4ff3e] text-white dark:text-[#1c1b1b]'],
            ['bg'=>'bg-[#eef7fc] dark:bg-[#0d1c2a]', 'border'=>'border-[#b3dff0] dark:border-[rgba(100,180,230,0.28)]', 'avatar'=>'bg-[#cceaf8] text-[#0a5c82] dark:bg-[rgba(100,180,230,0.3)] dark:text-[#7cc9e8]', 'tag'=>'bg-[#0a5c82] dark:bg-[rgba(100,180,230,0.3)] text-white dark:text-[#7cc9e8]', 'btn'=>'bg-[#0a7cb5] dark:bg-[rgba(100,180,230,0.3)] text-white dark:text-[#7cc9e8] border dark:border-[rgba(100,180,230,0.4)]', 'arrow'=>'bg-[#0a7cb5] dark:bg-[rgba(100,180,230,0.3)] text-white dark:text-[#7cc9e8]'],
            ['bg'=>'bg-[#fdf4eb] dark:bg-[#2a1a0a]', 'border'=>'border-[#f5c98a] dark:border-[rgba(230,170,80,0.28)]', 'avatar'=>'bg-[#fde4b8] text-[#8b4a00] dark:bg-[rgba(230,170,80,0.3)] dark:text-[#f5c98a]', 'tag'=>'bg-[#8b4a00] dark:bg-[rgba(230,170,80,0.3)] text-white dark:text-[#f5c98a]', 'btn'=>'bg-[#c46a00] dark:bg-[rgba(230,170,80,0.3)] text-white dark:text-[#f5c98a] border dark:border-[rgba(230,170,80,0.4)]', 'arrow'=>'bg-[#c46a00] dark:bg-[rgba(230,170,80,0.3)] text-white dark:text-[#f5c98a]'],
            ['bg'=>'bg-[#f5f0fa] dark:bg-[#1a1221]', 'border'=>'border-[#d4bff5] dark:border-[rgba(180,130,240,0.28)]', 'avatar'=>'bg-[#e8d8fa] text-[#5a2d8c] dark:bg-[rgba(180,130,240,0.3)] dark:text-[#c9a8f5]', 'tag'=>'bg-[#5a2d8c] dark:bg-[rgba(180,130,240,0.3)] text-white dark:text-[#c9a8f5]', 'btn'=>'bg-[#7a3dc0] dark:bg-[rgba(180,130,240,0.3)] text-white dark:text-[#c9a8f5] border dark:border-[rgba(180,130,240,0.4)]', 'arrow'=>'bg-[#7a3dc0] dark:bg-[rgba(180,130,240,0.3)] text-white dark:text-[#c9a8f5]'],
        ];
    @endphp

    @if(count($matches) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        @foreach($matches->take(8) as $i => $mentor)
        @php $pal = $cardPalettes[$i % 4]; @endphp
        <div class="{{ $pal['bg'] }} border-2 {{ $pal['border'] }} rounded-3xl p-8 flex flex-col justify-between
                    hover:shadow-xl dark:hover:shadow-[0_0_25px_rgba(212,255,62,0.08)] hover:-translate-y-1
                    transition-all duration-300 cursor-pointer group"
             onclick="window.location='{{ route('profiles.show', $mentor->id) }}'">

            {{-- Top: industry tag + avatar --}}
            <div class="flex items-start justify-between mb-6">
                <span class="{{ $pal['tag'] }} text-[10px] uppercase font-black px-3 py-1.5 rounded-full tracking-wider">
                    {{ $mentor->profile?->industry ?? 'Expert' }}
                </span>
                <div class="w-14 h-14 rounded-2xl overflow-hidden {{ $pal['avatar'] }} flex items-center justify-center text-2xl font-black shadow-md group-hover:scale-110 transition-transform flex-shrink-0">
                    @if($mentor->profile?->avatar_path)
                        <img src="{{ asset('storage/' . $mentor->profile->avatar_path) }}" class="w-full h-full object-cover">
                    @else
                        {{ substr($mentor->name, 0, 1) }}
                    @endif
                </div>
            </div>

            {{-- Info --}}
            <div class="space-y-2 flex-1">
                <h3 class="text-xl font-black text-on-surface dark:text-white leading-tight">{{ $mentor->name }}</h3>
                <p class="text-sm text-secondary dark:text-gray-400 leading-snug">
                    {{ $mentor->profile?->job_title ?? 'Professional' }}
                    @if($mentor->profile?->company)
                        <span class="font-semibold text-on-surface dark:text-[#e3e3e3]"> · {{ $mentor->profile->company }}</span>
                    @endif
                </p>
                @if($mentor->profile?->field_of_study)
                <p class="text-xs font-bold text-secondary dark:text-gray-500 mt-1">{{ $mentor->profile->field_of_study }}</p>
                @endif
            </div>

            {{-- Bottom: CTA + arrow --}}
            <div class="mt-8 flex items-center gap-3">
                <form action="{{ route('mentorship.request') }}" method="POST" class="flex-1" onclick="event.stopPropagation()">
                    @csrf
                    <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">
                    <input type="hidden" name="message" value="I would like to request you as my mentor.">
                    <button type="submit"
                            class="{{ $pal['btn'] }} w-full font-bold py-2.5 px-4 rounded-xl text-sm hover:opacity-90 hover:scale-[1.02] transition-all">
                        Request
                    </button>
                </form>
                <button class="{{ $pal['arrow'] }} p-2.5 rounded-xl flex-shrink-0 hover:scale-110 transition-transform" onclick="event.stopPropagation(); window.location='{{ route('profiles.show', $mentor->id) }}'">
                    <span class="material-symbols-outlined text-[18px]">north_east</span>
                </button>
            </div>
        </div>
        @endforeach
    </div>
    @else
        <div class="py-16 text-center text-secondary dark:text-gray-400 bg-white/50 dark:bg-[#1a1c21] rounded-3xl border-2 border-dashed border-outline-variant dark:border-[rgba(212,255,62,0.15)]">
            <span class="material-symbols-outlined text-5xl mb-3 block opacity-40">search_off</span>
            <p class="font-bold text-on-surface dark:text-white">No mentor recommendations available at this time.</p>
            <p class="text-sm mt-2"><a href="{{ route('profiles.index') }}" class="text-primary dark:text-[#d4ff3e] underline">Browse the full directory</a> to find connections.</p>
        </div>
    @endif
</section>

{{-- ===== CTA (for alumni / faculty only) ===== --}}
@if(Auth::user()->hasRole('alumni') || Auth::user()->hasRole('faculty') || Auth::user()->hasRole('mentor'))
<section class="bg-on-surface dark:bg-[#d4ff3e] text-surface dark:text-[#1c1b1b] rounded-[2.5rem] p-16 text-center space-y-8 overflow-hidden relative dark:shadow-[0_0_40px_rgba(212,255,62,0.2)]">
    <div class="relative z-10 space-y-6">
        <h2 class="text-4xl font-black max-w-xl mx-auto leading-tight">Ready to share your journey?</h2>
        <p class="text-lg opacity-80 max-w-lg mx-auto">
            Join our prestigious list of mentors and help shape the next generation of industry leaders.
        </p>
        <div class="pt-4">
            <a href="{{ route('profiles.edit', Auth::id()) }}"
               class="inline-block bg-surface dark:bg-[#1c1b1b] text-on-surface dark:text-white px-10 py-5 rounded-full font-bold text-sm hover:scale-105 transition-transform">
                Update Mentor Settings
            </a>
        </div>
    </div>
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-black/5 rounded-full translate-x-1/4 translate-y-1/4 blur-3xl"></div>
</section>
@endif

</main>
@endsection
