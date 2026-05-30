@extends('layouts.app')
@section('title', 'Events — Alumni Connect')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-on-surface dark:text-white dark:text-white">Events</h1>
        <p class="text-secondary dark:text-gray-400 mt-1 text-sm">Discover exclusive alumni workshops, seminars, and networking events</p>
    </div>
    @if(Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin'))
    <a href="{{ route('events.create') }}" class="btn-accent flex items-center gap-1.5">
        <span class="material-symbols-outlined text-sm">add</span> Create Event
    </a>
    @endif
</div>

{{-- Category Filter Chips --}}
<div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ route('events.index') }}"
       class="px-4 py-1.5 rounded-full text-sm font-semibold border-2 transition-colors {{ !request('category') ? 'bg-on-surface text-surface border-on-surface' : 'border-outline-variant dark:border-[#444934] text-secondary dark:text-gray-400 hover:border-on-surface hover:text-on-surface' }}">
        All Events
    </a>
    @foreach(['networking','workshop','seminar','social'] as $cat)
    <a href="{{ route('events.index', ['category' => $cat]) }}"
       class="px-4 py-1.5 rounded-full text-sm font-semibold border-2 transition-colors {{ request('category') === $cat ? 'bg-on-surface text-surface border-on-surface' : 'border-outline-variant dark:border-[#444934] text-secondary dark:text-gray-400 hover:border-on-surface hover:text-on-surface' }}">
        {{ ucfirst($cat) }}
    </a>
    @endforeach
</div>

@if($events->isEmpty())
<div class="text-center py-20 bg-surface-white rounded-card border border-outline-variant dark:border-[#444934]">
    <span class="material-symbols-outlined text-6xl text-outline-variant">event_busy</span>
    <h3 class="text-xl font-bold text-on-surface dark:text-white mt-4">No upcoming events</h3>
    <p class="text-secondary dark:text-gray-400 text-sm mt-2">Check back soon or try a different category.</p>
</div>
@else
<div class="space-y-4 mb-6">
    @foreach($events as $event)
    @php $isRegistered = in_array($event->id, $myRegistrations); @endphp
    <div class="reveal-card bg-surface-white rounded-card border border-outline-variant dark:border-[#444934] overflow-hidden">
        <div class="flex items-stretch">
            {{-- Date Block --}}
            <div class="flex flex-col items-center justify-center bg-on-surface text-surface px-6 py-5 min-w-[90px] flex-shrink-0">
                <span class="text-xs font-bold uppercase tracking-widest opacity-60">{{ $event->event_date->format('M') }}</span>
                <span class="text-4xl font-black leading-none">{{ $event->event_date->format('d') }}</span>
                <span class="text-xs font-semibold opacity-60">{{ $event->event_date->format('Y') }}</span>
            </div>

            {{-- Content --}}
            <div class="flex-1 p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="bg-primary-container text-primary-dark text-xs px-3 py-0.5 rounded-full font-semibold">{{ ucfirst($event->category) }}</span>
                            @if($isRegistered)
                            <span class="bg-green-100 text-green-700 text-xs px-3 py-0.5 rounded-full font-semibold flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs">check_circle</span> RSVP'd
                            </span>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold text-on-surface dark:text-white dark:text-white">{{ $event->title }}</h3>
                        <div class="flex items-center gap-4 mt-2 text-sm text-secondary dark:text-gray-400">
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">schedule</span> {{ $event->event_date->format('g:i A') }}</span>
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">location_on</span> {{ Str::limit($event->location, 30) }}</span>
                            @if($event->capacity)
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">group</span> {{ $event->spotsLeft() }} spots left</span>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('events.show', $event->id) }}"
                       class="flex-shrink-0 btn-outline text-sm px-5 py-2 flex items-center gap-1.5">
                        Details <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="flex justify-center">
    {{ $events->withQueryString()->links('pagination::simple-tailwind') }}
</div>
@endif
@endsection
