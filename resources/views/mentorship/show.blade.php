@extends('layouts.app')

@section('content')
<!-- Back button -->
<div class="mb-6">
    <a href="{{ route('mentorship.index') }}" class="text-primary font-semibold hover:underline flex items-center gap-1 w-max">
        <span class="material-symbols-outlined">arrow_back</span> Back to Mentorships
    </a>
</div>

<!-- Hero Section: Relationship Identity -->
<section class="mb-12">
    <div class="bg-surface-low rounded-card-lg p-8 md:p-12 flex flex-col md:flex-row items-center gap-8 border border-outline-variant reveal-card">
        <div class="flex -space-x-4">
            <!-- Mentor and Mentee avatars -->
            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-surface-white bg-primary text-surface-white flex items-center justify-center text-3xl md:text-5xl font-bold shadow-sm z-10" title="Mentor: {{ $mentorship->mentor->name }}">
                {{ strtoupper(substr($mentorship->mentor->name, 0, 1)) }}
            </div>
            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-surface-white bg-secondary text-surface-white flex items-center justify-center text-3xl md:text-5xl font-bold shadow-sm z-0" title="Mentee: {{ $mentorship->mentee->name }}">
                {{ strtoupper(substr($mentorship->mentee->name, 0, 1)) }}
            </div>
        </div>
        
        <div class="text-center md:text-left flex-1">
            <div class="inline-block bg-primary-container text-primary-dark text-sm px-4 py-1 rounded-full font-bold mb-4">
                {{ ucfirst($mentorship->status) }} Relationship 
                @if($mentorship->responded_at)
                    • Established {{ \Carbon\Carbon::parse($mentorship->responded_at)->format('F Y') }}
                @endif
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2 text-on-surface tracking-tight">
                Mentorship with {{ Auth::id() === $mentorship->mentee_id ? $mentorship->mentor->name : $mentorship->mentee->name }}
            </h1>
            <p class="text-lg text-secondary max-w-2xl">
                Collaborating on professional growth, strategic milestones, and continuous learning.
            </p>
        </div>
        
        <div class="flex flex-col gap-3 min-w-[200px]">
            @if($mentorship->status === 'pending' && Auth::id() === $mentorship->mentor_id)
                <form action="{{ route('mentorship.status', $mentorship->id) }}" method="POST" class="w-full">
                    @csrf
                    <input type="hidden" name="status" value="active">
                    <button type="submit" class="btn-primary w-full shadow-md">Accept Request</button>
                </form>
                <form action="{{ route('mentorship.status', $mentorship->id) }}" method="POST" class="w-full">
                    @csrf
                    <input type="hidden" name="status" value="declined">
                    <button type="submit" class="btn-outline w-full text-error border-error hover:bg-red-50">Decline</button>
                </form>
            @endif

            @if($mentorship->status === 'active')
                <a href="{{ route('messages.show', Auth::id() === $mentorship->mentee_id ? $mentorship->mentor_id : $mentorship->mentee_id) }}" class="btn-primary text-center shadow-md">Message</a>
                
                <form action="{{ route('mentorship.status', $mentorship->id) }}" method="POST" class="w-full" onsubmit="return confirm('Are you sure you want to mark this mentorship as completed?');">
                    @csrf
                    <input type="hidden" name="status" value="completed">
                    <button type="submit" class="btn-outline w-full hover:bg-green-50 text-green-700 border-green-700">Mark Completed</button>
                </form>
            @endif
        </div>
    </div>
</section>

@if(in_array($mentorship->status, ['active', 'completed']))
@php
    $totalGoals = $mentorship->goals->count();
    $completedGoals = $mentorship->goals->where('progress', 100)->count();
    $overallProgress = $totalGoals > 0 ? round(($completedGoals / $totalGoals) * 100) : 0;
@endphp

<!-- Bento Grid: Goals & Progress -->
<div class="grid grid-cols-12 gap-6">
    <!-- Overall Progress Card -->
    <div class="col-span-12 lg:col-span-4 bg-blue-50 border border-blue-100 rounded-card-lg p-8 flex flex-col justify-between reveal-card h-full">
        <div>
            <h3 class="text-2xl font-bold text-blue-900 mb-2">Journey Progress</h3>
            <p class="text-base text-blue-800 opacity-90">You've completed {{ $completedGoals }} out of {{ $totalGoals }} planned milestones.</p>
        </div>
        <div class="mt-12">
            <div class="flex justify-between items-end mb-2">
                <span class="text-6xl font-extrabold text-blue-900 tracking-tighter">{{ $overallProgress }}%</span>
                <span class="text-sm font-bold text-blue-800 mb-3 uppercase tracking-wider">Overall Goal Completion</span>
            </div>
            <div class="w-full bg-white h-4 rounded-full overflow-hidden border border-blue-200">
                <div class="bg-blue-600 h-full rounded-full transition-all duration-1000 ease-out" style="width: {{ $overallProgress }}%"></div>
            </div>
        </div>
    </div>

    <!-- Main Goals Section -->
    <div class="col-span-12 lg:col-span-8 space-y-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-on-surface">Active Goals</h2>
            @if($mentorship->status === 'active')
                <button onclick="document.getElementById('newGoalForm').classList.toggle('hidden')" class="flex items-center gap-2 text-primary font-bold hover:underline transition-colors">
                    <span class="material-symbols-outlined">add_circle</span>
                    Add New Goal
                </button>
            @endif
        </div>

        <!-- New Goal Form -->
        <div id="newGoalForm" class="hidden bg-surface-low border border-outline-variant rounded-card p-6 mb-6 reveal-card shadow-sm">
            <form action="{{ route('goals.store', $mentorship->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold mb-1 text-on-surface">Goal Title</label>
                    <input type="text" name="title" class="input-field shadow-sm" placeholder="E.g. Executive Presence Coaching" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1 text-on-surface">Description (optional)</label>
                    <textarea name="description" class="input-field shadow-sm" placeholder="What does achieving this goal look like?" rows="2"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn-primary shadow-sm">Save Goal</button>
                </div>
            </form>
        </div>

        @if($mentorship->goals->isEmpty())
            <div class="bg-surface-white border border-outline-variant rounded-card p-10 text-center text-secondary reveal-card shadow-sm">
                <span class="material-symbols-outlined text-5xl mb-3 opacity-40">flag</span>
                <p class="text-lg">No goals have been set yet. Establish milestones to track your progress together.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($mentorship->goals as $goal)
                <!-- Goal Card -->
                <div class="bg-surface-white border border-outline-variant rounded-card p-6 hover:shadow-md transition-shadow duration-300 reveal-card">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-lg {{ $loop->even ? 'bg-indigo-100 text-indigo-700' : 'bg-primary-container text-primary-dark' }} flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined">{{ $loop->even ? 'architecture' : 'leaderboard' }}</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-1 text-on-surface {{ $goal->progress == 100 ? 'line-through opacity-60' : '' }}">{{ $goal->title }}</h4>
                                @if($goal->description)
                                    <p class="text-base text-secondary">{{ $goal->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-secondary font-semibold">Progress</span>
                            <div class="flex items-center gap-3">
                                <span class="font-bold text-lg text-on-surface">{{ $goal->progress }}%</span>
                                @if($mentorship->status === 'active' && $goal->progress < 100)
                                    <form action="{{ route('goals.update', $goal->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="progress" class="bg-surface-low border border-outline-variant rounded-lg px-2 py-1 text-sm font-semibold focus:outline-none focus:border-primary cursor-pointer transition-colors" onchange="this.form.submit()">
                                            <option value="0" {{ $goal->progress == 0 ? 'selected' : '' }}>0%</option>
                                            <option value="25" {{ $goal->progress == 25 ? 'selected' : '' }}>25%</option>
                                            <option value="50" {{ $goal->progress == 50 ? 'selected' : '' }}>50%</option>
                                            <option value="75" {{ $goal->progress == 75 ? 'selected' : '' }}>75%</option>
                                            <option value="100" {{ $goal->progress == 100 ? 'selected' : '' }}>100%</option>
                                        </select>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="w-full bg-surface-container h-2.5 rounded-full overflow-hidden">
                            <div class="{{ $goal->progress == 100 ? 'bg-green-500' : 'bg-primary' }} h-full rounded-full transition-all duration-700 ease-out" style="width: {{ $goal->progress }}%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Mentor Insight / Tips -->
    <div class="col-span-12 bg-surface-highest rounded-card-lg p-8 flex flex-col md:flex-row items-center gap-8 reveal-card mt-2 shadow-inner border border-outline-variant/50">
        <div class="w-full md:w-1/3">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800" alt="Strategy Planning" class="rounded-2xl aspect-video object-cover shadow-sm"/>
        </div>
        <div class="flex-1">
            <div class="flex items-center gap-2 text-primary mb-3">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">lightbulb</span>
                <span class="text-sm font-bold uppercase tracking-widest">Guidance Spotlight</span>
            </div>
            <h3 class="text-2xl font-bold mb-4 text-on-surface tracking-tight">Focus on Consistent Growth</h3>
            <p class="text-lg text-secondary italic leading-relaxed">
                "The most successful mentorships are built on transparency and regular updates. Keep communicating your progress, and don't hesitate to ask the hard questions during your sessions."
            </p>
            <div class="mt-6 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary-container text-primary-dark flex items-center justify-center font-bold shadow-sm">
                    {{ strtoupper(substr($mentorship->mentor->name, 0, 1)) }}
                </div>
                <span class="text-sm font-bold text-on-surface">— {{ $mentorship->mentor->name }}</span>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
