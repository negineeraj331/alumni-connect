@extends('layouts.app')
@section('title', '{{ $event->title }} — Alumni Connect')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('events.index') }}" class="inline-flex items-center gap-1.5 text-sm text-secondary dark:text-gray-400 hover:text-on-surface dark:text-white font-semibold mb-6 transition-colors">
        <span class="material-symbols-outlined text-base">arrow_back</span> Back to Events
    </a>

    {{-- Event Hero --}}
    <div class="bg-surface-white rounded-card-xl border border-outline-variant dark:border-[#444934] overflow-hidden mb-6">
        <div class="h-40 bg-gradient-to-br from-primary to-primary-dark relative flex items-end p-6">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 80% 20%, #d4ff3e 0%, transparent 50%);"></div>
            <div class="relative z-10 flex items-center gap-3">
                <div class="bg-surface-white rounded-xl px-4 py-2 text-center min-w-[60px]">
                    <div class="text-primary text-xs font-bold uppercase">{{ $event->event_date->format('M') }}</div>
                    <div class="text-on-surface dark:text-white text-3xl font-black leading-tight">{{ $event->event_date->format('d') }}</div>
                </div>
                <div>
                    <span class="bg-primary-container text-primary-dark text-xs px-3 py-0.5 rounded-full font-semibold">{{ ucfirst($event->category) }}</span>
                    <h1 class="text-2xl font-bold text-surface mt-1">{{ $event->title }}</h1>
                </div>
            </div>
        </div>

        <div class="p-6">
            {{-- Meta --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                <div class="flex items-center gap-2 text-sm text-secondary dark:text-gray-400">
                    <div class="w-8 h-8 bg-primary-container rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-primary text-sm">schedule</span>
                    </div>
                    <div>
                        <div class="text-xs text-secondary dark:text-gray-400">Time</div>
                        <div class="font-semibold text-on-surface dark:text-white dark:text-white">{{ $event->event_date->format('g:i A') }}</div>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-sm text-secondary dark:text-gray-400">
                    <div class="w-8 h-8 bg-primary-container rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-primary text-sm">location_on</span>
                    </div>
                    <div>
                        <div class="text-xs text-secondary dark:text-gray-400">Location</div>
                        <div class="font-semibold text-on-surface dark:text-white dark:text-white">{{ $event->location }}</div>
                    </div>
                </div>
                @if($event->capacity)
                <div class="flex items-center gap-2 text-sm text-secondary dark:text-gray-400">
                    <div class="w-8 h-8 bg-primary-container rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-primary text-sm">group</span>
                    </div>
                    <div>
                        <div class="text-xs text-secondary dark:text-gray-400">Capacity</div>
                        <div class="font-semibold text-on-surface dark:text-white dark:text-white">{{ $event->spotsLeft() }} spots left</div>
                    </div>
                </div>
                @endif
            </div>

            <h2 class="font-bold text-on-surface dark:text-white mb-2">About this event</h2>
            <p class="text-secondary dark:text-gray-400 text-sm leading-relaxed whitespace-pre-line">{{ $event->description }}</p>
        </div>
    </div>

    {{-- RSVP Card --}}
    <div class="bg-surface-white rounded-card border border-outline-variant dark:border-[#444934] p-6 mb-6 flex items-center justify-between gap-4">
        <div>
            @if($registration && $registration->status === 'registered')
                <h3 class="font-bold text-green-700 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-base">check_circle</span> You're registered!
                </h3>
                <p class="text-secondary dark:text-gray-400 text-sm mt-0.5">We look forward to seeing you there.</p>
            @else
                <h3 class="font-bold text-on-surface dark:text-white dark:text-white">Join this event</h3>
                <p class="text-secondary dark:text-gray-400 text-sm mt-0.5">Secure your spot before it fills up.</p>
            @endif
        </div>
        <div>
            @if($registration && $registration->status === 'registered')
            <form action="{{ route('events.rsvp', $event->id) }}" method="POST" onsubmit="return confirm('Cancel your RSVP?')">
                @csrf
                <input type="hidden" name="action" value="cancel">
                <button class="border-2 border-red-300 text-red-600 text-sm px-6 py-2.5 rounded-full font-bold hover:bg-red-50 transition-colors">
                    Cancel RSVP
                </button>
            </form>
            @elseif($event->status === 'upcoming')
            <form action="{{ route('events.rsvp', $event->id) }}" method="POST">
                @csrf
                <input type="hidden" name="action" value="register">
                <button class="btn-accent {{ $event->isFull() ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $event->isFull() ? 'disabled' : '' }}>
                    {{ $event->isFull() ? 'Event Full' : 'RSVP Now' }}
                </button>
            </form>
            @endif
        </div>
    </div>

    {{-- Organizer Attendee Table --}}
    @if((Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin')) && count($attendees))
    <div class="bg-surface-white rounded-card border border-outline-variant dark:border-[#444934] overflow-hidden">
        <div class="flex items-center justify-between p-5 border-b border-outline-variant dark:border-[#444934]">
            <h3 class="font-bold text-on-surface dark:text-white dark:text-white">Registered Attendees ({{ count($attendees) }})</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-surface-low text-xs font-bold uppercase tracking-widest text-secondary dark:text-gray-400">
                    <tr>
                        <th class="px-5 py-3 text-left">Name</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-left">RSVP Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @foreach($attendees as $a)
                    <tr class="hover:bg-surface-low transition-colors">
                        <td class="px-5 py-3 font-semibold text-on-surface dark:text-white dark:text-white">
                            <a href="{{ route('profiles.show', $a->user->id) }}" class="hover:text-primary transition-colors">{{ $a->user->name }}</a>
                        </td>
                        <td class="px-5 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $a->status === 'registered' ? 'bg-green-100 text-green-700' : 'bg-surface-container dark:bg-[#20241b] text-secondary' }}">
                                {{ ucfirst($a->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-secondary dark:text-gray-400">{{ $a->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
