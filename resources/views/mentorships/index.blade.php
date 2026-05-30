@extends('layouts.app')
@section('title', 'Mentorship Hub — Alumni Connect')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-on-surface">Mentorship Hub</h1>
        <p class="text-secondary mt-1 text-sm">
            @if(Auth::user()->hasRole('mentor')) Manage your mentees and incoming requests
            @else Find expert mentors and track your growth
            @endif
        </p>
    </div>
    @if(Auth::user()->hasRole('alumni') || Auth::user()->hasRole('student'))
    <a href="{{ route('profiles.index') }}?role=mentor" class="btn-accent flex items-center gap-1.5">
        <span class="material-symbols-outlined text-sm">search</span> Find a Mentor
    </a>
    @endif
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Main: Mentorship List --}}
    <div class="lg:col-span-2 space-y-4">

        {{-- Active --}}
        @php $active = $mentorships->where('status', 'active'); @endphp
        @if($active->count())
        <div>
            <h2 class="text-sm font-bold uppercase tracking-widest text-on-surface mb-3 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-green-500 inline-block"></span> Active ({{ $active->count() }})
            </h2>
            <div class="space-y-3">
                @foreach($active as $m)
                @php $partner = Auth::id() === $m->mentor_id ? $m->mentee : $m->mentor; @endphp
                <a href="{{ route('mentorship.show', $m->id) }}" class="reveal-card flex items-center gap-4 bg-surface-white rounded-card border border-outline-variant p-5 hover:border-primary transition-colors group">
                    <div class="w-12 h-12 rounded-2xl bg-primary-container flex items-center justify-center text-primary font-bold text-lg flex-shrink-0">
                        {{ substr($partner->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-bold text-on-surface">{{ $partner->name }}</div>
                        <div class="text-sm text-secondary">{{ Auth::id() === $m->mentor_id ? 'Mentee' : 'Mentor' }} · Since {{ $m->created_at->format('M Y') }}</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-semibold">Active</span>
                        <span class="material-symbols-outlined text-outline-variant group-hover:text-primary transition-colors">chevron_right</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Pending --}}
        @php $pending = $mentorships->where('status', 'pending'); @endphp
        @if($pending->count())
        <div>
            <h2 class="text-sm font-bold uppercase tracking-widest text-on-surface mb-3 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-amber-400 inline-block"></span> Pending Requests ({{ $pending->count() }})
            </h2>
            <div class="space-y-3">
                @foreach($pending as $m)
                @php $partner = Auth::id() === $m->mentor_id ? $m->mentee : $m->mentor; @endphp
                <div class="bg-amber-50 border border-amber-200 rounded-card p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center text-amber-700 font-bold text-lg flex-shrink-0">
                        {{ substr($partner->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-bold text-on-surface">{{ $partner->name }}</div>
                        <div class="text-sm text-secondary">{{ Auth::id() === $m->mentor_id ? 'Wants you as a mentor' : 'You requested mentorship' }}</div>
                    </div>
                    @if(Auth::id() === $m->mentor_id)
                    <div class="flex gap-2">
                        <form action="{{ route('mentorship.status', $m->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="active">
                            <button class="bg-green-600 text-white text-xs px-4 py-2 rounded-full font-bold hover:bg-green-700 transition-colors">Accept</button>
                        </form>
                        <form action="{{ route('mentorship.status', $m->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="declined">
                            <button class="bg-red-100 text-red-700 text-xs px-4 py-2 rounded-full font-bold hover:bg-red-200 transition-colors">Decline</button>
                        </form>
                    </div>
                    @else
                    <span class="text-xs text-amber-700 font-semibold bg-amber-100 px-3 py-1 rounded-full">Awaiting response</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($mentorships->isEmpty())
        <div class="bg-surface-white rounded-card border border-outline-variant p-16 text-center">
            <span class="material-symbols-outlined text-6xl text-outline-variant">handshake</span>
            <h3 class="text-xl font-bold text-on-surface mt-4">No mentorships yet</h3>
            <p class="text-secondary text-sm mt-2 max-w-sm mx-auto">Browse the alumni directory to find experienced mentors and request a mentorship.</p>
            <a href="{{ route('profiles.index') }}" class="btn-accent mt-6 inline-flex">Browse Directory</a>
        </div>
        @endif
    </div>

    {{-- Sidebar --}}
    <div class="space-y-5">
        {{-- Suggested Mentors --}}
        @if(isset($suggestedMentors) && $suggestedMentors->count())
        <div class="bg-surface-white rounded-card border border-outline-variant p-5">
            <h3 class="font-bold text-on-surface mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-base">auto_awesome</span>
                Suggested Mentors
            </h3>
            <div class="space-y-3">
                @foreach($suggestedMentors as $mentor)
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-primary-container flex items-center justify-center text-primary font-bold text-sm flex-shrink-0">
                        {{ substr($mentor->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-on-surface text-sm truncate">{{ $mentor->name }}</div>
                        <div class="text-xs text-secondary truncate">{{ $mentor->profile?->industry }}</div>
                    </div>
                    <form action="{{ route('mentorship.request') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">
                        <button class="text-xs text-primary font-bold hover:underline">Request</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Info Card --}}
        <div class="bg-on-surface rounded-card p-6">
            <span class="material-symbols-outlined text-primary-container text-3xl mb-3 block">psychology</span>
            <h3 class="font-bold text-surface mb-2">How Mentorship Works</h3>
            <ul class="space-y-2 text-surface/60 text-sm">
                <li class="flex items-start gap-2"><span class="text-primary-container font-bold">1.</span> Find a mentor in the directory</li>
                <li class="flex items-start gap-2"><span class="text-primary-container font-bold">2.</span> Send a mentorship request</li>
                <li class="flex items-start gap-2"><span class="text-primary-container font-bold">3.</span> Set goals and track progress</li>
                <li class="flex items-start gap-2"><span class="text-primary-container font-bold">4.</span> Grow together!</li>
            </ul>
        </div>
    </div>
</div>
@endsection
