@extends('layouts.app')

@section('title', $user->name . "'s Profile | Alumni Connect")

@section('content')


{{-- Hero Profile Section --}}
<div class="flex flex-col md:flex-row gap-12 items-start mb-16">
    {{-- Avatar --}}
    <div class="relative flex-shrink-0">
        @php
            $role = $user->roles->first()?->name ?? 'member';
            $avatarConfig = match($role) {
                'student'   => ['bg' => 'bg-[#cceaf8]', 'text' => 'text-[#0a5c82]'],
                'alumni'    => ['bg' => 'bg-[#d4ff3e]',  'text' => 'text-[#3d4d00]'],
                'faculty', 'mentor' => ['bg' => 'bg-[#fcd8e5]', 'text' => 'text-[#8b1a45]'],
                'organizer' => ['bg' => 'bg-[#fde4b8]', 'text' => 'text-[#8b4a00]'],
                default     => ['bg' => 'bg-surface-container', 'text' => 'text-on-surface dark:text-white'],
            };
        @endphp
        <div class="w-48 h-48 md:w-56 md:h-56 rounded-2xl overflow-hidden flex items-center justify-center border-4 border-white/50 dark:border-white/10 shadow-xl dark:shadow-[0_0_30px_rgba(212,255,62,0.08)] {{ $user->profile?->avatar_path ? '' : $avatarConfig['bg'] . ' ' . $avatarConfig['text'] . ' text-6xl font-black' }}">
            @if($user->profile?->avatar_path)
                <img src="{{ asset('storage/' . $user->profile->avatar_path) }}" class="w-full h-full object-cover">
            @else
                {{ substr($user->name, 0, 1) }}
            @endif
        </div>
        @if($user->roles->contains('name', 'mentor') || $user->roles->contains('name', 'faculty'))
            <div class="absolute -bottom-3 -right-3 bg-primary-container dark:shadow-[0_0_12px_rgba(212,255,62,0.4)] p-2.5 rounded-xl shadow-sm" title="Verified Mentor/Faculty">
                <span class="material-symbols-outlined text-primary-dark" style="font-variation-settings: 'FILL' 1;">verified</span>
            </div>
        @endif
    </div>

    {{-- Info --}}
    <div class="flex-1 space-y-5">
        <div>
            <h1 class="text-4xl font-black tracking-tight text-on-surface dark:text-white mb-1">{{ $user->name }}</h1>
            <p class="text-lg text-secondary dark:text-gray-400">
                {{ $user->profile?->job_title ?? 'Member' }}
                @if($user->profile?->company) <span class="text-on-surface dark:text-white font-semibold">at {{ $user->profile->company }}</span> @endif
                @if($user->profile?->graduation_year) · Class of {{ $user->profile->graduation_year }} @endif
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            @foreach($user->roles as $r)
                <span class="px-4 py-1 bg-primary-container dark:bg-[rgba(212,255,62,0.15)] text-primary-dark dark:text-[#d4ff3e] rounded-full text-xs font-bold uppercase tracking-wide">{{ $r->name }}</span>
            @endforeach
            @if($user->profile?->field_of_study)
                <span class="px-4 py-1 bg-surface-container dark:bg-[#1e2025] text-secondary dark:text-gray-400 rounded-full text-xs font-bold">{{ $user->profile->field_of_study }}</span>
            @endif
        </div>

        <div class="flex flex-col sm:flex-row gap-3 pt-2">
        @if(Auth::id() === $user->id)
            <a href="{{ route('profiles.edit', $user->id) }}"
               class="px-8 py-3 bg-on-surface dark:bg-[#d4ff3e] text-surface dark:text-[#1c1b1b] font-bold rounded-xl hover:opacity-90 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">edit</span> Edit Profile
            </a>
        @else
            <a href="{{ route('messages.index', ['user_id' => $user->id]) }}"
               class="px-8 py-3 bg-primary-container dark:shadow-[0_0_12px_rgba(212,255,62,0.35)] text-primary-dark font-bold rounded-xl hover:opacity-90 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">send</span> Send Message
            </a>
            @if($user->roles->contains('name', 'mentor') && Auth::user()->hasRole('student'))
                <form action="{{ route('mentorship.request') }}" method="POST" class="m-0">
                    @csrf
                    <input type="hidden" name="mentor_id" value="{{ $user->id }}">
                    <input type="hidden" name="message" value="I would love to connect with you for mentorship.">
                    <button type="submit" class="px-8 py-3 border-2 border-on-surface dark:border-[rgba(212,255,62,0.4)] text-on-surface dark:text-[#d4ff3e] font-bold rounded-xl hover:bg-surface-container dark:hover:bg-[#1e2025] transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">handshake</span> Request Mentorship
                    </button>
                </form>
            @endif
        @endif
        </div>
    </div>
</div>

{{-- Bento Grid --}}
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
    {{-- Bio & Skills (left) --}}
    <div class="md:col-span-8 space-y-6">
        <section class="bg-[#f7dcdc] dark:bg-[#2a0d18] border border-[#f0b8ce] dark:border-[rgba(230,100,150,0.2)] p-10 rounded-2xl">
            <h2 class="text-xl font-bold text-on-surface dark:text-white mb-5">Bio</h2>
            <p class="text-secondary dark:text-gray-400 leading-relaxed">
                {{ $user->profile?->bio ?? 'This user has not added a bio yet.' }}
            </p>
        </section>

        <section class="bg-[#ffeaea] dark:bg-[#1f1218] border border-[#f0b8ce] dark:border-[rgba(230,100,150,0.15)] p-10 rounded-2xl">
            <h2 class="text-xl font-bold text-on-surface dark:text-white mb-5">Expertise &amp; Skills</h2>
            @if($user->profile?->skills && count($user->profile->skills) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($user->profile->skills as $skill)
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary dark:text-[#d4ff3e] text-[20px]" style="font-variation-settings:'FILL' 1">verified</span>
                        <span class="font-semibold text-on-surface dark:text-white">{{ $skill }}</span>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-secondary dark:text-gray-400">No specific expertise listed yet.</p>
            @endif
        </section>
    </div>

    {{-- Education & Career (right) --}}
    <div class="md:col-span-4 space-y-6">
        <section class="bg-white dark:bg-[#1a1c21] border border-outline-variant dark:border-[rgba(212,255,62,0.15)] p-8 rounded-2xl dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
            <h2 class="text-xl font-bold text-on-surface dark:text-white mb-5">Education</h2>
            @if($user->profile?->degree || $user->profile?->field_of_study)
                <div class="border-l-2 border-primary-container dark:border-[#d4ff3e] pl-4">
                    <p class="font-bold text-on-surface dark:text-white">{{ $user->profile->degree ?? 'Degree' }} in {{ $user->profile->field_of_study ?? 'General Studies' }}</p>
                    <p class="text-sm text-secondary dark:text-gray-400 mt-1">Class of {{ $user->profile->graduation_year ?? 'N/A' }}</p>
                </div>
            @else
                <p class="text-secondary dark:text-gray-400 text-sm">Education details not provided.</p>
            @endif
        </section>

        <section class="bg-white dark:bg-[#1a1c21] border border-outline-variant dark:border-[rgba(212,255,62,0.15)] p-8 rounded-2xl dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
            <h2 class="text-xl font-bold text-on-surface dark:text-white mb-5">Experience</h2>
            @if($user->profile?->company || $user->profile?->job_title)
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-surface-container dark:bg-[#1e2025] rounded-xl flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-secondary dark:text-gray-400">corporate_fare</span>
                    </div>
                    <div>
                        <p class="font-bold text-on-surface dark:text-white">{{ $user->profile->job_title ?? 'Professional' }}</p>
                        <p class="text-sm text-secondary dark:text-gray-400 mt-0.5">{{ $user->profile->company ?? 'Company' }}</p>
                    </div>
                </div>
            @else
                <p class="text-secondary dark:text-gray-400 text-sm">Work experience not provided.</p>
            @endif
        </section>

        @if($user->profile?->location)
        <a href="https://www.google.com/maps/search/{{ urlencode($user->profile->location) }}"
           target="_blank" rel="noopener noreferrer"
           class="relative overflow-hidden rounded-2xl h-40 group bg-[#eef7fc] dark:bg-[#0d1c2a] border border-[#b3dff0] dark:border-[rgba(100,180,230,0.2)] block
                  hover:border-[#7cc9e8] dark:hover:border-[rgba(100,180,230,0.5)] hover:shadow-lg dark:hover:shadow-[0_0_20px_rgba(100,180,230,0.15)] transition-all duration-300"
           title="Open {{ $user->profile->location }} in Google Maps">

            {{-- Globe watermark --}}
            <div class="absolute inset-0 flex items-center justify-center opacity-10 group-hover:opacity-20 group-hover:scale-110 transition-all duration-500">
                <span class="material-symbols-outlined text-9xl text-[#0a5c82]" style="font-variation-settings:'FILL' 1">public</span>
            </div>

            {{-- Open in new tab icon (top right, visible on hover) --}}
            <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <div class="bg-white/90 dark:bg-[#0d1c2a]/90 backdrop-blur-sm p-1.5 rounded-full border border-[#b3dff0] dark:border-[rgba(100,180,230,0.3)]">
                    <span class="material-symbols-outlined text-[#0a7cb5] dark:text-[#7cc9e8] text-[14px]">open_in_new</span>
                </div>
            </div>

            {{-- Location label --}}
            <div class="absolute bottom-4 left-4 right-4">
                <div class="flex items-center gap-2 bg-white/85 dark:bg-[#0d1c2a]/90 backdrop-blur-sm px-3 py-2 rounded-full border border-[#b3dff0] dark:border-[rgba(100,180,230,0.2)] w-fit max-w-full">
                    <span class="material-symbols-outlined text-[#0a7cb5] dark:text-[#7cc9e8] text-[18px] flex-shrink-0" style="font-variation-settings:'FILL' 1">location_on</span>
                    <span class="text-sm font-bold text-[#0a5c82] dark:text-[#7cc9e8] truncate">{{ $user->profile->location }}</span>
                </div>
                <p class="text-[10px] font-bold text-[#0a7cb5]/70 dark:text-[#7cc9e8]/60 mt-1.5 ml-1 uppercase tracking-wider opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    Click to open in Google Maps ↗
                </p>
            </div>
        </a>
        @endif
    </div>
</div>
@endsection
