@extends('layouts.app')

@section('title', 'Jobs Board')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold tracking-tight text-on-surface dark:text-white mb-2">Job Opportunities</h1>
        <p class="text-secondary dark:text-gray-400">
            @if(Auth::user()->hasRole('student'))
                Explore jobs posted by your mentors and connected alumni.
            @else
                Discover career opportunities within the Alumni Connect network.
            @endif
        </p>
    </div>
    @if(!Auth::user()->hasRole('student'))
        <a href="{{ route('jobs.create') }}" class="btn-accent flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span> Post a Job
        </a>
    @endif
</div>

@if($jobs->isEmpty())
    <div class="text-center py-16 bg-surface-container-lowest dark:bg-[#1a1c21] rounded-card border border-outline-variant dark:border-[#444934]">
        <div class="bg-surface-container-low dark:bg-[#1a1c16] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="material-symbols-outlined text-3xl text-secondary dark:text-gray-400">work_off</span>
        </div>
        <h3 class="text-lg font-bold text-on-surface dark:text-white mb-2">No Jobs Available</h3>
        <p class="text-secondary dark:text-gray-400">
            @if(Auth::user()->hasRole('student'))
                There are currently no jobs posted by your connected mentors. Connect with more alumni to see their job postings!
            @else
                Be the first to post a career opportunity for the community.
            @endif
        </p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($jobs as $job)
            <div class="card p-6 reveal-card bg-surface-container-lowest dark:bg-[#1a1c21] border-outline-variant dark:border-[#444934] shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] hover:shadow-md hover:dark:shadow-[0_0_20px_rgba(212,255,62,0.1)] transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-primary-container p-3 rounded-xl">
                        <span class="material-symbols-outlined text-primary-dark">work</span>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 bg-surface-container-high dark:bg-[#20241b] text-secondary dark:text-gray-400 rounded-full">
                        {{ $job->created_at->diffForHumans() }}
                    </span>
                </div>
                
                <h3 class="text-xl font-bold text-on-surface dark:text-white mb-1 line-clamp-1">{{ $job->title }}</h3>
                <p class="text-primary font-semibold mb-4">{{ $job->company }}</p>
                
                <div class="space-y-2 mb-6">
                    <div class="flex items-center gap-2 text-sm text-secondary dark:text-gray-400">
                        <span class="material-symbols-outlined text-[16px]">location_on</span>
                        {{ $job->location }}
                    </div>
                    <div class="flex items-center gap-2 text-sm text-secondary dark:text-gray-400">
                        <span class="material-symbols-outlined text-[16px]">person</span>
                        Posted by {{ $job->user->name }}
                    </div>
                </div>
                
                <p class="text-secondary dark:text-gray-400 text-sm line-clamp-3 mb-6">
                    {{ $job->description }}
                </p>
                
                <a href="{{ route('jobs.show', $job->id) }}" class="block w-full text-center bg-surface-container-low dark:bg-[#1a1c16] text-on-surface dark:text-white font-bold py-2 rounded-lg hover:bg-surface-container-highest dark:hover:bg-[#20241b] transition-colors border border-outline-variant dark:border-[#444934]">
                    View Details
                </a>
            </div>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $jobs->links() }}
    </div>
@endif
@endsection
