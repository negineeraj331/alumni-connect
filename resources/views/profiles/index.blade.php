@extends('layouts.app')

@section('title', 'Alumni Directory | Alumni Connect')

@section('full_content')
<main class="pt-12 pb-24 max-w-max-width mx-auto px-4 md:px-20">

{{-- Header --}}
<section class="mb-12">
    <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-on-surface dark:text-white mb-3">Find your community</h1>
    <p class="text-lg text-secondary dark:text-gray-400 max-w-2xl">Connect with thousands of graduates making an impact across industries worldwide.</p>
</section>

{{-- Search & Filter --}}
<section class="mb-12">
    <form action="{{ route('profiles.index') }}" method="GET"
          class="bg-white dark:bg-[#1a1c21] p-8 rounded-2xl border border-outline-variant dark:border-[rgba(212,255,62,0.15)] shadow-sm dark:shadow-[0_0_20px_rgba(212,255,62,0.06)] space-y-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-grow relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-secondary dark:text-gray-400">search</span>
                <input name="search" value="{{ request('search') }}"
                       class="w-full pl-12 pr-4 py-4 bg-white dark:bg-[#12161f] border border-outline-variant dark:border-[rgba(212,255,62,0.2)] rounded-xl focus:ring-2 focus:ring-primary dark:focus:ring-[rgba(212,255,62,0.3)] focus:border-primary dark:focus:border-[#d4ff3e] outline-none transition-all text-on-surface dark:text-[#e3e3e3] placeholder-secondary dark:placeholder-gray-500"
                       placeholder="Search by name, company, or location..." type="text">
            </div>
            <button type="submit"
                    class="bg-primary-container text-primary-dark dark:shadow-[0_0_12px_rgba(212,255,62,0.3)] font-bold px-8 py-4 rounded-xl hover:opacity-90 transition-all whitespace-nowrap">
                Search Directory
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-2">
                <label class="text-xs font-bold text-secondary dark:text-gray-400 uppercase tracking-wider">Role</label>
                <select name="role"
                        class="w-full p-3 bg-white dark:bg-[#12161f] border border-outline-variant dark:border-[rgba(212,255,62,0.2)] rounded-xl outline-none focus:border-primary dark:focus:border-[#d4ff3e] text-on-surface dark:text-[#e3e3e3] transition-all"
                        onchange="this.form.submit()">
                    <option value="">All Roles</option>
                    <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="alumni" {{ request('role') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                    <option value="faculty" {{ request('role') == 'faculty' ? 'selected' : '' }}>Faculty</option>
                    <option value="mentor" {{ request('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                    <option value="organizer" {{ request('role') == 'organizer' ? 'selected' : '' }}>Organizer</option>
                </select>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold text-secondary dark:text-gray-400 uppercase tracking-wider">Field of Study</label>
                <select name="field_of_study"
                        class="w-full p-3 bg-white dark:bg-[#12161f] border border-outline-variant dark:border-[rgba(212,255,62,0.2)] rounded-xl outline-none focus:border-primary dark:focus:border-[#d4ff3e] text-on-surface dark:text-[#e3e3e3] transition-all"
                        onchange="this.form.submit()">
                    <option value="">All Fields</option>
                    <option value="Computer Science" {{ request('field_of_study') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                    <option value="Engineering" {{ request('field_of_study') == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                    <option value="Business" {{ request('field_of_study') == 'Business' ? 'selected' : '' }}>Business</option>
                    <option value="Arts" {{ request('field_of_study') == 'Arts' ? 'selected' : '' }}>Arts</option>
                </select>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold text-secondary dark:text-gray-400 uppercase tracking-wider">Graduation Year</label>
                <select name="graduation_year"
                        class="w-full p-3 bg-white dark:bg-[#12161f] border border-outline-variant dark:border-[rgba(212,255,62,0.2)] rounded-xl outline-none focus:border-primary dark:focus:border-[#d4ff3e] text-on-surface dark:text-[#e3e3e3] transition-all"
                        onchange="this.form.submit()">
                    <option value="">All Years</option>
                    @for($year = date('Y'); $year >= 1990; $year--)
                    <option value="{{ $year }}" {{ request('graduation_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </form>
</section>

{{-- Directory Grid --}}
<section>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($users as $user)
        @php
            $role = $user->roles->first()?->name ?? 'member';

            // Role-based pastel card colors — light and dark variants
            $roleConfig = match($role) {
                'student'   => [
                    'bg'       => 'bg-[#eef7fc]',
                    'darkBg'   => 'dark:bg-[#0d1c2a]',
                    'border'   => 'border-[#b3dff0]',
                    'darkBorder'=> 'dark:border-[rgba(100,180,230,0.3)]',
                    'avatar'   => 'bg-[#cceaf8] text-[#0a5c82]',
                    'badge'    => 'bg-[#b3dff0] text-[#0a5c82]',
                    'label'    => 'Student',
                    'icon'     => 'school',
                    'iconColor'=> 'text-[#0a7cb5]',
                ],
                'alumni'    => [
                    'bg'       => 'bg-[#f4f7ed]',
                    'darkBg'   => 'dark:bg-[#141a0a]',
                    'border'   => 'border-[#c8e6a0]',
                    'darkBorder'=> 'dark:border-[rgba(180,230,100,0.3)]',
                    'avatar'   => 'bg-[#d4ff3e] text-[#3d4d00]',
                    'badge'    => 'bg-[#c8e6a0] text-[#3d4d00]',
                    'label'    => 'Alumni',
                    'icon'     => 'workspace_premium',
                    'iconColor'=> 'text-[#516600]',
                ],
                'faculty', 'mentor' => [
                    'bg'       => 'bg-[#fdf0f4]',
                    'darkBg'   => 'dark:bg-[#2a0d18]',
                    'border'   => 'border-[#f0b8ce]',
                    'darkBorder'=> 'dark:border-[rgba(230,100,150,0.3)]',
                    'avatar'   => 'bg-[#fcd8e5] text-[#8b1a45]',
                    'badge'    => 'bg-[#f0b8ce] text-[#8b1a45]',
                    'label'    => ucfirst($role),
                    'icon'     => 'psychology',
                    'iconColor'=> 'text-[#c23b70]',
                ],
                'organizer' => [
                    'bg'       => 'bg-[#fdf4eb]',
                    'darkBg'   => 'dark:bg-[#2a1a0a]',
                    'border'   => 'border-[#f5c98a]',
                    'darkBorder'=> 'dark:border-[rgba(230,170,80,0.3)]',
                    'avatar'   => 'bg-[#fde4b8] text-[#8b4a00]',
                    'badge'    => 'bg-[#f5c98a] text-[#8b4a00]',
                    'label'    => 'Organizer',
                    'icon'     => 'event',
                    'iconColor'=> 'text-[#c46a00]',
                ],
                default     => [
                    'bg'       => 'bg-[#f5f0fa]',
                    'darkBg'   => 'dark:bg-[#1a1221]',
                    'border'   => 'border-[#d4bff5]',
                    'darkBorder'=> 'dark:border-[rgba(180,130,240,0.3)]',
                    'avatar'   => 'bg-[#e8d8fa] text-[#5a2d8c]',
                    'badge'    => 'bg-[#d4bff5] text-[#5a2d8c]',
                    'label'    => 'Member',
                    'icon'     => 'person',
                    'iconColor'=> 'text-[#7a3dc0]',
                ],
            };
            $profile = $user->profile;
        @endphp

        <div class="{{ $roleConfig['bg'] }} {{ $roleConfig['darkBg'] }} border {{ $roleConfig['border'] }} {{ $roleConfig['darkBorder'] }}
                    rounded-2xl p-8 flex flex-col items-center text-center
                    hover:shadow-lg dark:hover:shadow-[0_0_20px_rgba(212,255,62,0.08)]
                    hover:-translate-y-1 transition-all duration-300 group">

            {{-- Avatar --}}
            <div class="w-20 h-20 rounded-full overflow-hidden flex items-center justify-center {{ $roleConfig['avatar'] }} text-2xl font-black mb-1 shadow-sm border-4 border-white/60 dark:border-white/10 group-hover:scale-105 transition-transform">
                @if($profile?->avatar_path)
                    <img src="{{ asset('storage/' . $profile->avatar_path) }}" class="w-full h-full object-cover">
                @else
                    {{ substr($user->name, 0, 1) }}
                @endif
            </div>

            {{-- Role icon badge --}}
            <div class="{{ $roleConfig['badge'] }} rounded-full p-1.5 mb-4 -mt-4 relative z-10 shadow-sm">
                <span class="material-symbols-outlined text-[14px] {{ $roleConfig['iconColor'] }}" style="font-variation-settings:'FILL' 1">{{ $roleConfig['icon'] }}</span>
            </div>

            {{-- Name & Role --}}
            <h3 class="text-lg font-bold text-on-surface dark:text-white mb-0.5">{{ $user->name }}</h3>
            <span class="{{ $roleConfig['badge'] }} text-xs font-bold px-3 py-1 rounded-full mb-2">{{ $roleConfig['label'] }}</span>
            <p class="text-sm text-secondary dark:text-gray-400 mb-1">
                {{ $profile?->job_title ?? ($role === 'student' ? 'Student' : 'Member') }}
                @if($profile?->company) <span class="font-semibold">at {{ $profile->company }}</span> @endif
            </p>
            @if($profile?->field_of_study)
                <p class="text-xs text-secondary dark:text-gray-500 mb-4">{{ $profile->field_of_study }} @if($profile?->graduation_year) · Class of {{ $profile->graduation_year }} @endif</p>
            @else
                <p class="text-xs text-secondary dark:text-gray-500 mb-4">@if($profile?->graduation_year) Class of {{ $profile->graduation_year }} @else New member @endif</p>
            @endif

            {{-- Actions --}}
            <div class="w-full flex flex-col gap-2 mt-auto">
                <a href="{{ route('messages.index') }}"
                   class="w-full bg-on-surface dark:bg-[#d4ff3e] text-surface dark:text-[#1c1b1b] font-bold py-2.5 rounded-xl hover:opacity-90 dark:hover:shadow-[0_0_10px_rgba(212,255,62,0.4)] transition-all text-sm text-center block">
                    Message
                </a>
                <a href="{{ route('profiles.show', $user->id) }}"
                   class="w-full bg-white/60 dark:bg-white/10 border border-current/20 text-on-surface dark:text-[#e3e3e3] font-semibold py-2.5 rounded-xl hover:bg-white/80 dark:hover:bg-white/20 transition-all text-sm text-center block">
                    View Profile
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-full py-20 text-center">
            <div class="text-secondary dark:text-gray-500 mb-4"><span class="material-symbols-outlined text-6xl">search_off</span></div>
            <h3 class="text-2xl font-bold text-on-surface dark:text-white mb-2">No members found</h3>
            <p class="text-secondary dark:text-gray-400">Try adjusting your search criteria or filters to find more connections.</p>
            <a href="{{ route('profiles.index') }}" class="inline-block mt-6 px-6 py-2 bg-primary-container text-primary-dark rounded-full font-bold">Clear Filters</a>
        </div>
    @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-16">
        {{ $users->links() }}
    </div>
</section>
</main>
@endsection
