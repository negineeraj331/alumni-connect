@extends('layouts.app')

@section('title', $job->title)

@section('content')
<div class="mb-8">
    <a href="{{ route('jobs.index') }}" class="text-sm font-semibold text-secondary hover:text-on-surface dark:text-gray-400 dark:hover:text-white flex items-center gap-1 mb-4">
        <span class="material-symbols-outlined text-[16px]">arrow_back</span> Back to Jobs
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Job Details --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="card p-8 bg-surface-container-lowest dark:bg-[#1a1c21] border-outline-variant dark:border-[#444934] shadow-md dark:shadow-[0_0_20px_rgba(212,255,62,0.1)]">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-16 h-16 bg-primary-container rounded-2xl flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-3xl text-primary-dark">work</span>
                </div>
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-on-surface dark:text-white mb-2">{{ $job->title }}</h1>
                    <div class="flex flex-wrap items-center gap-4 text-secondary dark:text-gray-400 text-sm">
                        <span class="flex items-center gap-1 font-semibold text-primary"><span class="material-symbols-outlined text-[16px]">business</span> {{ $job->company }}</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">location_on</span> {{ $job->location }}</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> Posted {{ $job->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <div class="border-t border-outline-variant dark:border-[#444934] pt-6 mt-6">
                <h3 class="text-lg font-bold text-on-surface dark:text-white mb-4">Job Description</h3>
                <div class="prose dark:prose-invert max-w-none text-on-surface dark:text-gray-300 whitespace-pre-line">
                    {{ $job->description }}
                </div>
            </div>
        </div>
    </div>

    {{-- Application Section --}}
    <div class="space-y-6">
        <div class="card p-6 bg-surface-container-lowest dark:bg-[#1a1c21] border-outline-variant dark:border-[#444934] shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
            <h3 class="font-bold text-lg text-on-surface dark:text-white mb-4">Posted By</h3>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-primary font-bold text-lg shrink-0">
                    {{ substr($job->user->name, 0, 1) }}
                </div>
                <div>
                    <p class="font-bold text-on-surface dark:text-white">{{ $job->user->name }}</p>
                    <p class="text-xs text-secondary dark:text-gray-400">{{ ucfirst($job->user->roles->first()->name ?? 'User') }}</p>
                </div>
            </div>
        </div>

        <div class="card p-6 bg-surface-container-lowest dark:bg-[#1a1c21] border-outline-variant dark:border-[#444934] shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
            @if(Auth::id() === $job->user_id)
                <div class="text-center py-4">
                    <span class="material-symbols-outlined text-4xl text-primary mb-2">stars</span>
                    <p class="font-bold text-on-surface dark:text-white">You posted this job</p>
                    <p class="text-sm text-secondary dark:text-gray-400 mt-1">Check your dashboard for applicants.</p>
                </div>
            @elseif($hasApplied)
                <div class="text-center py-4">
                    <span class="material-symbols-outlined text-4xl text-green-500 mb-2">task_alt</span>
                    <p class="font-bold text-on-surface dark:text-white">Application Submitted</p>
                    <p class="text-sm text-secondary dark:text-gray-400 mt-1">You have already applied for this position.</p>
                </div>
            @else
                <h3 class="font-bold text-lg text-on-surface dark:text-white mb-4">Apply Now</h3>
                <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-on-surface dark:text-white mb-2">Upload CV/Resume *</label>
                            <input type="file" name="cv" accept=".pdf,.doc,.docx" required
                                   class="block w-full text-sm text-secondary dark:text-gray-400
                                   file:mr-4 file:py-2.5 file:px-4
                                   file:rounded-xl file:border-0
                                   file:text-sm file:font-bold
                                   file:bg-primary-container file:text-primary-dark
                                   hover:file:bg-[#cbf731] transition-colors">
                            <p class="text-xs text-secondary dark:text-gray-400 mt-1">Accepted formats: PDF, DOC, DOCX. Max: 5MB.</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-on-surface dark:text-white mb-2">Cover Letter (Optional)</label>
                            <textarea name="cover_letter" rows="4" 
                                      class="input-field bg-white dark:bg-[#12140e] border-outline-variant dark:border-[#444934] text-on-surface dark:text-white focus:ring-primary focus:border-primary w-full px-4 py-3 rounded-xl border transition-all duration-200"
                                      placeholder="Briefly introduce yourself..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn-primary w-full">Submit Application</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
