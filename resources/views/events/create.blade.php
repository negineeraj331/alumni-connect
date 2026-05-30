@extends('layouts.app')

@section('title', 'Create Event | Alumni Connect')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <a href="{{ route('events.index') }}" class="text-secondary hover:text-primary transition-colors inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Back to Events
        </a>
        <h1 class="text-3xl font-bold text-on-surface dark:text-white mt-4">Create New Event</h1>
        <p class="text-secondary dark:text-gray-400 mt-2">Host an event, workshop, or networking session for the alumni community.</p>
    </div>

    <div class="bg-surface-container-lowest dark:bg-[#1a1c21] rounded-3xl p-8 border border-outline-variant dark:border-[#444934] shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)]">
        <form action="{{ route('events.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-on-surface dark:text-gray-300">Event Title <span class="text-error">*</span></label>
                <input type="text" name="title" id="title" required value="{{ old('title') }}"
                    class="mt-1 block w-full rounded-xl border-outline-variant dark:border-[#444934] bg-surface dark:bg-[#12140e] text-on-surface dark:text-white shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] focus:border-primary focus:ring-primary sm:text-sm px-4 py-3">
                @error('title') <span class="text-error text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Date & Location Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="event_date" class="block text-sm font-medium text-on-surface dark:text-gray-300">Date & Time <span class="text-error">*</span></label>
                    <input type="datetime-local" name="event_date" id="event_date" required value="{{ old('event_date') }}"
                        class="mt-1 block w-full rounded-xl border-outline-variant dark:border-[#444934] bg-surface dark:bg-[#12140e] text-on-surface dark:text-white shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] focus:border-primary focus:ring-primary sm:text-sm px-4 py-3">
                    @error('event_date') <span class="text-error text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-on-surface dark:text-gray-300">Location / Platform <span class="text-error">*</span></label>
                    <input type="text" name="location" id="location" required value="{{ old('location') }}" placeholder="e.g. Zoom Link or Address"
                        class="mt-1 block w-full rounded-xl border-outline-variant dark:border-[#444934] bg-surface dark:bg-[#12140e] text-on-surface dark:text-white shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] focus:border-primary focus:ring-primary sm:text-sm px-4 py-3">
                    @error('location') <span class="text-error text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-sm font-medium text-on-surface dark:text-gray-300">Category <span class="text-error">*</span></label>
                <select name="category" id="category" required
                    class="mt-1 block w-full rounded-xl border-outline-variant dark:border-[#444934] bg-surface dark:bg-[#12140e] text-on-surface dark:text-white shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] focus:border-primary focus:ring-primary sm:text-sm px-4 py-3">
                    <option value="networking" {{ old('category') == 'networking' ? 'selected' : '' }}>Networking</option>
                    <option value="workshop" {{ old('category') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                    <option value="panel" {{ old('category') == 'panel' ? 'selected' : '' }}>Panel Discussion</option>
                    <option value="social" {{ old('category') == 'social' ? 'selected' : '' }}>Social</option>
                </select>
                @error('category') <span class="text-error text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Capacity & Status Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="capacity" class="block text-sm font-medium text-on-surface dark:text-gray-300">Capacity (Optional)</label>
                    <input type="number" name="capacity" id="capacity" min="1" value="{{ old('capacity') }}" placeholder="Leave blank for unlimited"
                        class="mt-1 block w-full rounded-xl border-outline-variant dark:border-[#444934] bg-surface dark:bg-[#12140e] text-on-surface dark:text-white shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] focus:border-primary focus:ring-primary sm:text-sm px-4 py-3">
                    @error('capacity') <span class="text-error text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-on-surface dark:text-gray-300">Status <span class="text-error">*</span></label>
                    <select name="status" id="status" required
                        class="mt-1 block w-full rounded-xl border-outline-variant dark:border-[#444934] bg-surface dark:bg-[#12140e] text-on-surface dark:text-white shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] focus:border-primary focus:ring-primary sm:text-sm px-4 py-3">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active (Upcoming)</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status') <span class="text-error text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-on-surface dark:text-gray-300">Description <span class="text-error">*</span></label>
                <textarea name="description" id="description" rows="5" required
                    class="mt-1 block w-full rounded-xl border-outline-variant dark:border-[#444934] bg-surface dark:bg-[#12140e] text-on-surface dark:text-white shadow-sm dark:shadow-[0_0_15px_rgba(212,255,62,0.05)] focus:border-primary focus:ring-primary sm:text-sm px-4 py-3">{{ old('description') }}</textarea>
                @error('description') <span class="text-error text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-primary text-on-primary dark:bg-primary-container dark:text-on-primary-container px-8 py-3 rounded-full font-bold hover:shadow-lg dark:shadow-[0_0_25px_rgba(212,255,62,0.15)] hover:-translate-y-0.5 transition-all">
                    Create Event
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
