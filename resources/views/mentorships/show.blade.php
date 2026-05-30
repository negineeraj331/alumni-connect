@extends('layouts.app')
@section('title', 'Mentorship Goals — Alumni Connect')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('mentorship.index') }}" class="inline-flex items-center gap-1.5 text-sm text-secondary hover:text-on-surface font-semibold mb-6 transition-colors">
        <span class="material-symbols-outlined text-base">arrow_back</span> Back to Mentorship
    </a>

    {{-- Partner Card --}}
    @php $partner = Auth::id() === $mentorship->mentor_id ? $mentorship->mentee : $mentorship->mentor; $isMentor = Auth::id() === $mentorship->mentor_id; @endphp
    <div class="bg-surface-white rounded-card-xl border border-outline-variant p-6 mb-6">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-16 h-16 rounded-2xl bg-primary-container flex items-center justify-center text-primary font-bold text-2xl">
                {{ substr($partner->name, 0, 1) }}
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-secondary mb-0.5">{{ $isMentor ? 'Your Mentee' : 'Your Mentor' }}</p>
                <h1 class="text-2xl font-bold text-on-surface">{{ $partner->name }}</h1>
                <p class="text-secondary text-sm">{{ $partner->profile?->current_position }}</p>
            </div>
            <div class="ml-auto">
                <span class="px-4 py-1.5 rounded-full text-xs font-bold
                    {{ $mentorship->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                    {{ ucfirst($mentorship->status) }}
                </span>
            </div>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('messages.show', $partner->id) }}" class="btn-outline text-sm px-4 py-2 flex items-center gap-1.5">
                <span class="material-symbols-outlined text-sm">chat</span> Message
            </a>
            <a href="{{ route('profiles.show', $partner->id) }}" class="text-sm text-secondary hover:text-on-surface font-semibold flex items-center gap-1 transition-colors">
                <span class="material-symbols-outlined text-sm">person</span> View Profile
            </a>
        </div>
    </div>

    {{-- Goals Section --}}
    <div class="bg-surface-white rounded-card border border-outline-variant overflow-hidden mb-6">
        <div class="flex items-center justify-between p-5 border-b border-outline-variant">
            <h2 class="font-bold text-on-surface flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">flag</span>
                Mentorship Goals
            </h2>
            <span class="text-xs text-secondary">{{ $mentorship->goals->count() }} goals</span>
        </div>

        @if($mentorship->goals->isEmpty())
        <div class="p-10 text-center">
            <span class="material-symbols-outlined text-5xl text-outline-variant">flag</span>
            <p class="text-secondary text-sm mt-3">No goals set yet. Add your first goal below!</p>
        </div>
        @else
        <div class="divide-y divide-outline-variant">
            @foreach($mentorship->goals as $goal)
            <div class="p-5">
                <div class="flex items-start justify-between gap-4 mb-3">
                    <div class="flex-1">
                        <h3 class="font-semibold text-on-surface">{{ $goal->title }}</h3>
                        @if($goal->description)
                        <p class="text-secondary text-sm mt-1">{{ $goal->description }}</p>
                        @endif
                    </div>
                    <div class="text-right flex-shrink-0">
                        <div class="text-lg font-bold {{ $goal->progress == 100 ? 'text-green-600' : 'text-primary' }}">
                            {{ $goal->progress }}%
                        </div>
                        @if($goal->completed_at)
                        <div class="text-xs text-green-600 font-semibold flex items-center gap-0.5 justify-end">
                            <span class="material-symbols-outlined text-xs">check_circle</span>
                            Done!
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Progress Bar --}}
                <div class="relative h-2 bg-surface-container rounded-full mb-3 overflow-hidden">
                    <div class="absolute inset-y-0 left-0 rounded-full transition-all duration-500
                        {{ $goal->progress == 100 ? 'bg-green-500' : 'bg-primary' }}"
                         style="width: {{ $goal->progress }}%"></div>
                </div>

                {{-- Update Progress --}}
                @if($mentorship->status === 'active')
                <form action="{{ route('goals.update', $goal->id) }}" method="POST" class="flex items-center gap-3">
                    @csrf
                    @method('PUT')
                    <input type="range" name="progress" min="0" max="100" step="5"
                           value="{{ $goal->progress }}"
                           class="flex-1 h-1.5 accent-[#516600]"
                           oninput="this.nextElementSibling.textContent = this.value + '%'">
                    <span class="text-xs font-bold text-on-surface w-8 text-right">{{ $goal->progress }}%</span>
                    <button type="submit" class="bg-primary-container text-primary-dark text-xs px-3 py-1.5 rounded-full font-bold hover:opacity-80 transition-opacity">
                        Save
                    </button>
                </form>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Add Goal Form --}}
    @if($mentorship->status === 'active')
    <div class="bg-surface-white rounded-card border border-outline-variant p-6">
        <h3 class="font-bold text-on-surface mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">add_circle</span>
            Add New Goal
        </h3>
        <form action="{{ route('goals.store', $mentorship->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-on-surface uppercase tracking-widest mb-2">Goal Title</label>
                <input type="text" name="title" class="input-field" placeholder="e.g. Land a Product Manager role" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-on-surface uppercase tracking-widest mb-2">Description <span class="text-secondary font-normal normal-case">(optional)</span></label>
                <textarea name="description" rows="2" class="input-field resize-none" placeholder="Add details about this goal..."></textarea>
            </div>
            <button type="submit" class="btn-accent flex items-center gap-1.5">
                <span class="material-symbols-outlined text-sm">add</span> Add Goal
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
