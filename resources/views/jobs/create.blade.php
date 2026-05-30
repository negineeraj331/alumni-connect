@extends('layouts.app')

@section('title', 'Post a Job')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('jobs.index') }}" class="text-sm font-semibold text-secondary hover:text-on-surface dark:text-gray-400 dark:hover:text-white flex items-center gap-1 mb-4">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span> Back to Jobs
        </a>
        <h1 class="text-3xl font-bold tracking-tight text-on-surface dark:text-white">Post a Job</h1>
        <p class="text-secondary dark:text-gray-400 mt-2">Share career opportunities with the Alumni Connect network.</p>
    </div>

    <div class="card p-8 bg-surface-container-lowest dark:bg-[#1a1c21] border-outline-variant dark:border-[#444934] shadow-md dark:shadow-[0_0_20px_rgba(212,255,62,0.1)]">
        <form action="{{ route('jobs.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-bold text-on-surface dark:text-white mb-2">Job Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="input-field bg-white dark:bg-[#12140e] border-outline-variant dark:border-[#444934] text-on-surface dark:text-white focus:ring-primary focus:border-primary w-full px-4 py-3 rounded-xl border transition-all duration-200">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="company" class="block text-sm font-bold text-on-surface dark:text-white mb-2">Company Name *</label>
                        <input type="text" id="company" name="company" value="{{ old('company') }}" required
                               class="input-field bg-white dark:bg-[#12140e] border-outline-variant dark:border-[#444934] text-on-surface dark:text-white focus:ring-primary focus:border-primary w-full px-4 py-3 rounded-xl border transition-all duration-200">
                    </div>
                    
                    <div>
                        <label for="location" class="block text-sm font-bold text-on-surface dark:text-white mb-2">Location (or Remote) *</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" required
                               class="input-field bg-white dark:bg-[#12140e] border-outline-variant dark:border-[#444934] text-on-surface dark:text-white focus:ring-primary focus:border-primary w-full px-4 py-3 rounded-xl border transition-all duration-200">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-bold text-on-surface dark:text-white mb-2">Job Description *</label>
                    <textarea id="description" name="description" rows="6" required
                              class="input-field bg-white dark:bg-[#12140e] border-outline-variant dark:border-[#444934] text-on-surface dark:text-white focus:ring-primary focus:border-primary w-full px-4 py-3 rounded-xl border transition-all duration-200">{{ old('description') }}</textarea>
                    <p class="text-xs text-secondary dark:text-gray-400 mt-2">Include responsibilities, requirements, and benefits.</p>
                </div>

                <div class="pt-4 border-t border-outline-variant dark:border-[#444934] flex justify-end">
                    <button type="submit" class="btn-primary">Post Job</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
