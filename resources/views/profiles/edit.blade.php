@extends('layouts.app')

@section('title', 'Edit Profile | Alumni Connect')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    {{-- Back navigation --}}
    <div class="mb-8">
        <a href="{{ route('profiles.show', $user->id) }}" 
           class="inline-flex items-center gap-2 text-sm font-bold text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-[#d4ff3e] transition-colors group">
            <span class="material-symbols-outlined text-[18px] transition-transform group-hover:-translate-x-1">arrow_back</span>
            Back to Profile
        </a>
    </div>

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-on-surface dark:text-white">Edit Profile</h1>
        <p class="text-sm text-secondary dark:text-gray-400 mt-1">Update your personal information, profile picture, and professional experience.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-950/20 border border-red-200 dark:border-red-900/30 rounded-2xl text-red-600 dark:text-red-400 text-sm">
            <div class="flex items-center gap-2 mb-2 font-bold">
                <span class="material-symbols-outlined text-[18px]">error</span>
                Please correct the errors below:
            </div>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Profile Form --}}
    <form action="{{ route('profiles.update', $user->id) }}" method="POST" enctype="multipart/form-data" 
          class="bg-white dark:bg-[#1a1c21] border border-outline-variant dark:border-[rgba(212,255,62,0.18)] p-6 md:p-8 rounded-3xl shadow-xl dark:shadow-[0_8px_32px_rgba(0,0,0,0.2)] space-y-8">
        @csrf
        @method('PUT')

        {{-- Profile Photo Upload Section --}}
        <div>
            <h3 class="text-lg font-bold border-b border-outline-variant dark:border-[rgba(212,255,62,0.1)] pb-3 mb-6 text-on-surface dark:text-white">Profile Photo</h3>
            
            <div class="flex flex-col sm:flex-row gap-6 items-center">
                {{-- Preview Container --}}
                <div class="relative w-28 h-28 rounded-2xl overflow-hidden bg-surface-container dark:bg-[#1e2025] border border-outline-variant dark:border-[rgba(212,255,62,0.15)] flex-shrink-0 flex items-center justify-center">
                    <img id="avatar-preview" 
                         src="{{ $user->profile?->avatar_path ? asset('storage/' . $user->profile->avatar_path) : '' }}" 
                         class="w-full h-full object-cover {{ $user->profile?->avatar_path ? '' : 'hidden' }}">
                    
                    {{-- Placeholder --}}
                    <div id="avatar-placeholder" 
                         class="w-full h-full flex flex-col items-center justify-center text-center p-2 {{ $user->profile?->avatar_path ? 'hidden' : '' }}">
                        <span class="material-symbols-outlined text-3xl text-secondary dark:text-gray-400">person</span>
                        <span class="text-[10px] font-bold text-secondary dark:text-gray-500 uppercase tracking-widest mt-1">No Image</span>
                    </div>
                </div>

                {{-- Upload Area --}}
                <div class="flex-grow w-full">
                    <label class="block text-sm font-semibold text-secondary dark:text-gray-300 mb-2">Upload New Photo</label>
                    <div class="relative border-2 border-dashed border-outline-variant dark:border-[rgba(212,255,62,0.2)] hover:border-primary dark:hover:border-[#d4ff3e] rounded-xl p-4 transition-colors text-center group cursor-pointer">
                        <input type="file" name="avatar" id="avatar-input" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="flex flex-col items-center gap-1.5 pointer-events-none">
                            <span class="material-symbols-outlined text-2xl text-secondary dark:text-gray-400 group-hover:text-primary dark:group-hover:text-[#d4ff3e] transition-colors">cloud_upload</span>
                            <p class="text-xs font-bold text-on-surface dark:text-gray-200">Drag &amp; drop or click to upload</p>
                            <p class="text-[10px] text-secondary dark:text-gray-400">Supports JPG, PNG, GIF, SVG (Max 2MB)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Basic Information --}}
        <div>
            <h3 class="text-lg font-bold border-b border-outline-variant dark:border-[rgba(212,255,62,0.1)] pb-3 mb-6 text-on-surface dark:text-white">Basic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black text-secondary dark:text-gray-400 uppercase tracking-wider mb-2" for="name">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                           class="w-full rounded-xl border border-outline-variant dark:border-[rgba(212,255,62,0.2)] bg-white dark:bg-[#1a1c21] text-on-surface dark:text-white focus:border-primary dark:focus:border-[#d4ff3e] focus:ring-0 px-4 py-3 text-sm transition-all" required>
                </div>
                <div>
                    <label class="block text-xs font-black text-secondary dark:text-gray-400 uppercase tracking-wider mb-2" for="location">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $user->profile?->location) }}" 
                           class="w-full rounded-xl border border-outline-variant dark:border-[rgba(212,255,62,0.2)] bg-white dark:bg-[#1a1c21] text-on-surface dark:text-white focus:border-primary dark:focus:border-[#d4ff3e] focus:ring-0 px-4 py-3 text-sm transition-all" placeholder="e.g. San Francisco, CA">
                </div>
            </div>
        </div>

        {{-- Professional Details --}}
        <div>
            <h3 class="text-lg font-bold border-b border-outline-variant dark:border-[rgba(212,255,62,0.1)] pb-3 mb-6 text-on-surface dark:text-white">Professional Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black text-secondary dark:text-gray-400 uppercase tracking-wider mb-2" for="job_title">Job Title</label>
                    <input type="text" name="job_title" id="job_title" value="{{ old('job_title', $user->profile?->job_title) }}" 
                           class="w-full rounded-xl border border-outline-variant dark:border-[rgba(212,255,62,0.2)] bg-white dark:bg-[#1a1c21] text-on-surface dark:text-white focus:border-primary dark:focus:border-[#d4ff3e] focus:ring-0 px-4 py-3 text-sm transition-all" placeholder="e.g. Software Engineer">
                </div>
                <div>
                    <label class="block text-xs font-black text-secondary dark:text-gray-400 uppercase tracking-wider mb-2" for="company">Company</label>
                    <input type="text" name="company" id="company" value="{{ old('company', $user->profile?->company) }}" 
                           class="w-full rounded-xl border border-outline-variant dark:border-[rgba(212,255,62,0.2)] bg-white dark:bg-[#1a1c21] text-on-surface dark:text-white focus:border-primary dark:focus:border-[#d4ff3e] focus:ring-0 px-4 py-3 text-sm transition-all" placeholder="e.g. Google">
                </div>
            </div>
        </div>

        {{-- Academic Background --}}
        <div>
            <h3 class="text-lg font-bold border-b border-outline-variant dark:border-[rgba(212,255,62,0.1)] pb-3 mb-6 text-on-surface dark:text-white">Academic Background</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black text-secondary dark:text-gray-400 uppercase tracking-wider mb-2" for="field_of_study">Field of Study</label>
                    <input type="text" name="field_of_study" id="field_of_study" value="{{ old('field_of_study', $user->profile?->field_of_study) }}" 
                           class="w-full rounded-xl border border-outline-variant dark:border-[rgba(212,255,62,0.2)] bg-white dark:bg-[#1a1c21] text-on-surface dark:text-white focus:border-primary dark:focus:border-[#d4ff3e] focus:ring-0 px-4 py-3 text-sm transition-all" placeholder="e.g. Computer Science">
                </div>
                <div>
                    <label class="block text-xs font-black text-secondary dark:text-gray-400 uppercase tracking-wider mb-2" for="graduation_year">Graduation Year</label>
                    <input type="number" name="graduation_year" id="graduation_year" value="{{ old('graduation_year', $user->profile?->graduation_year) }}" min="1950" max="2035" 
                           class="w-full rounded-xl border border-outline-variant dark:border-[rgba(212,255,62,0.2)] bg-white dark:bg-[#1a1c21] text-on-surface dark:text-white focus:border-primary dark:focus:border-[#d4ff3e] focus:ring-0 px-4 py-3 text-sm transition-all">
                </div>
            </div>
        </div>

        {{-- Bio Section --}}
        <div>
            <h3 class="text-lg font-bold border-b border-outline-variant dark:border-[rgba(212,255,62,0.1)] pb-3 mb-6 text-on-surface dark:text-white">About You</h3>
            <div>
                <label class="block text-xs font-black text-secondary dark:text-gray-400 uppercase tracking-wider mb-2" for="bio">Bio</label>
                <textarea name="bio" id="bio" rows="5" 
                          class="w-full rounded-xl border border-outline-variant dark:border-[rgba(212,255,62,0.2)] bg-white dark:bg-[#1a1c21] text-on-surface dark:text-white focus:border-primary dark:focus:border-[#d4ff3e] focus:ring-0 px-4 py-3 text-sm transition-all" 
                          placeholder="Write a short summary about yourself...">{{ old('bio', $user->profile?->bio) }}</textarea>
            </div>
        </div>

        {{-- Submit actions --}}
        <div class="flex justify-end gap-4 pt-6 border-t border-outline-variant dark:border-[rgba(212,255,62,0.1)]">
            <a href="{{ route('profiles.show', $user->id) }}" 
               class="px-6 py-3 text-sm font-bold text-secondary dark:text-gray-400 hover:bg-surface-container dark:hover:bg-[#1e2025] rounded-xl transition-all">
                Cancel
            </a>
            <button type="submit" 
                    class="px-8 py-3 text-sm font-bold bg-primary text-white dark:bg-[#d4ff3e] dark:text-[#3d4d00] rounded-xl hover:opacity-90 active:scale-[0.98] transition-all dark:shadow-[0_0_15px_rgba(212,255,62,0.25)]">
                Save Changes
            </button>
        </div>
    </form>
</div>

<script>
    // Live image upload preview
    const avatarInput = document.getElementById('avatar-input');
    const avatarPreview = document.getElementById('avatar-preview');
    const avatarPlaceholder = document.getElementById('avatar-placeholder');

    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                    avatarPreview.classList.remove('hidden');
                    avatarPlaceholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
