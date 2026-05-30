@extends('layouts.app')

@section('title', 'Student Dashboard | Alumni Connect')

@section('full_content')
<style>
    .bento-grid { display: grid; grid-template-columns: repeat(12, 1fr); gap: 24px; }
    .custom-scroll::-webkit-scrollbar { width: 4px; }
    .custom-scroll::-webkit-scrollbar-thumb { background: rgba(212,255,62,0.3); border-radius: 10px; }
</style>

<main class="max-w-max-width mx-auto px-4 md:px-20 py-12">

{{-- Welcome Section --}}
<section class="mb-16">
    <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-on-surface dark:text-white mb-2">
        Welcome back, {{ explode(' ', Auth::user()->name ?? 'Student')[0] }}.
    </h1>
    <p class="text-lg text-secondary dark:text-gray-400">You're 65% of the way to your first professional role. Keep the momentum going!</p>
</section>

{{-- Main Bento Grid --}}
<div class="bento-grid">

{{-- Quick Action Cards --}}
<div class="col-span-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <a href="{{ route('mentorship.index') }}"
       class="bg-[#ffeaea] dark:bg-[#1f0d10] border border-[#f0b8ce] dark:border-[rgba(230,100,150,0.25)]
              rounded-xl p-8 flex flex-col items-center text-center
              hover:scale-[1.02] transition-transform duration-300 cursor-pointer group">
        <div class="bg-white/70 dark:bg-[rgba(230,100,150,0.15)] p-4 rounded-full mb-6 group-hover:scale-110 transition-transform shadow-sm">
            <span class="material-symbols-outlined text-[#c23b70] dark:text-[#f0b8ce] text-4xl" style="font-variation-settings:'FILL' 1">school</span>
        </div>
        <h3 class="text-xl font-bold text-on-surface dark:text-white mb-2">Find a Mentor</h3>
        <p class="text-sm text-secondary dark:text-gray-400">Connect with experienced professionals in your field.</p>
    </a>
    <a href="{{ route('events.index') }}"
       class="bg-[#fef9c3] dark:bg-[#1a1a00] border border-[#fde047] dark:border-[rgba(250,204,21,0.25)]
              rounded-xl p-8 flex flex-col items-center text-center
              hover:scale-[1.02] transition-transform duration-300 cursor-pointer group">
        <div class="bg-white/70 dark:bg-[rgba(250,204,21,0.15)] p-4 rounded-full mb-6 group-hover:scale-110 transition-transform shadow-sm">
            <span class="material-symbols-outlined text-[#a16207] dark:text-[#fde047] text-4xl" style="font-variation-settings:'FILL' 1">calendar_month</span>
        </div>
        <h3 class="text-xl font-bold text-on-surface dark:text-white mb-2">Browse Events</h3>
        <p class="text-sm text-secondary dark:text-gray-400">Join webinars, local meetups, and networking nights.</p>
    </a>
    <a href="{{ route('messages.index') }}"
       class="bg-[#eef7fc] dark:bg-[#0d1c2a] border border-[#b3dff0] dark:border-[rgba(100,180,230,0.25)]
              rounded-xl p-8 flex flex-col items-center text-center
              hover:scale-[1.02] transition-transform duration-300 cursor-pointer group">
        <div class="bg-white/70 dark:bg-[rgba(100,180,230,0.15)] p-4 rounded-full mb-6 group-hover:scale-110 transition-transform shadow-sm">
            <span class="material-symbols-outlined text-[#0a7cb5] dark:text-[#7cc9e8] text-4xl" style="font-variation-settings:'FILL' 1">mail</span>
        </div>
        <h3 class="text-xl font-bold text-on-surface dark:text-white mb-2">Check Messages</h3>
        <p class="text-sm text-secondary dark:text-gray-400">Stay in touch with your alumni circle and mentors.</p>
    </a>
    <a href="{{ route('jobs.index') }}"
       class="bg-[#f4f7ed] dark:bg-[#141a0a] border border-[#c8e6a0] dark:border-[rgba(180,230,100,0.25)]
              rounded-xl p-8 flex flex-col items-center text-center
              hover:scale-[1.02] transition-transform duration-300 cursor-pointer group">
        <div class="bg-white/70 dark:bg-[rgba(180,230,100,0.15)] p-4 rounded-full mb-6 group-hover:scale-110 transition-transform shadow-sm">
            <span class="material-symbols-outlined text-[#516600] dark:text-[#c8e6a0] text-4xl" style="font-variation-settings:'FILL' 1">work</span>
        </div>
        <h3 class="text-xl font-bold text-on-surface dark:text-white mb-2">View Jobs</h3>
        <p class="text-sm text-secondary dark:text-gray-400">Find roles posted by your mentors and connected alumni.</p>
    </a>
</div>

{{-- Career Progress Tracking --}}
<div class="col-span-12 lg:col-span-8 bg-white dark:bg-[#1a1c21] rounded-xl p-10 border border-outline-variant dark:border-[rgba(212,255,62,0.15)] relative overflow-hidden dark:shadow-[0_0_20px_rgba(212,255,62,0.05)]">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-on-surface dark:text-white mb-1">Career Journey</h2>
            <p class="text-secondary dark:text-gray-400">Path to Junior Software Engineer</p>
        </div>
        <div class="px-4 py-2 bg-primary-container dark:bg-[rgba(212,255,62,0.15)] text-primary-dark dark:text-[#d4ff3e] rounded-full text-sm font-bold border dark:border-[rgba(212,255,62,0.3)]">
            Level 4: Interview Ready
        </div>
    </div>
    <div class="space-y-8">
        <div class="relative pt-1">
            <div class="flex mb-2 items-center justify-between">
                <span class="text-sm font-bold text-primary dark:text-[#d4ff3e] bg-primary-container dark:bg-[rgba(212,255,62,0.15)] px-3 py-1 rounded-full">Progress</span>
                <span class="text-sm font-bold text-primary dark:text-[#d4ff3e]">65%</span>
            </div>
            <div class="overflow-hidden h-3 mb-4 flex rounded-full bg-surface-container dark:bg-[rgba(255,255,255,0.1)]">
                <div class="flex flex-col justify-center bg-primary dark:bg-[#d4ff3e] transition-all duration-1000 rounded-full" style="width:65%"></div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-primary dark:text-[#d4ff3e] bg-primary-container dark:bg-[rgba(212,255,62,0.15)] p-3 rounded-xl" style="font-variation-settings:'FILL' 1">check_circle</span>
                <div>
                    <p class="text-sm font-bold text-on-surface dark:text-white">Resume Polished</p>
                    <p class="text-xs text-secondary dark:text-gray-400">Completed</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-primary dark:text-[#d4ff3e] bg-primary-container dark:bg-[rgba(212,255,62,0.15)] p-3 rounded-xl" style="font-variation-settings:'FILL' 1">check_circle</span>
                <div>
                    <p class="text-sm font-bold text-on-surface dark:text-white">Portfolio Site</p>
                    <p class="text-xs text-secondary dark:text-gray-400">Completed</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-secondary dark:text-gray-500 p-3 rounded-xl border-2 border-dashed border-outline-variant dark:border-[rgba(255,255,255,0.15)]">radio_button_unchecked</span>
                <div>
                    <p class="text-sm font-bold text-on-surface dark:text-white">Mock Interview</p>
                    <p class="text-xs text-secondary dark:text-gray-400">Next Step</p>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-primary-container dark:bg-[rgba(212,255,62,0.05)] opacity-40 rounded-full blur-3xl"></div>
</div>

{{-- Internship Deadlines --}}
<div class="col-span-12 lg:col-span-4 bg-[#fdf4eb] dark:bg-[#2a1a0a] border border-[#f5c98a] dark:border-[rgba(230,170,80,0.3)] rounded-xl p-8 flex flex-col">
    <div class="flex items-center gap-3 mb-6">
        <span class="material-symbols-outlined text-[#c46a00] dark:text-[#f5c98a]" style="font-variation-settings:'FILL' 1">notification_important</span>
        <h2 class="text-2xl font-bold text-on-surface dark:text-white">Deadlines</h2>
    </div>
    <div class="space-y-4 flex-grow">
        <div class="p-4 bg-white/70 dark:bg-[rgba(255,255,255,0.05)] rounded-lg border-l-4 border-red-400 dark:border-red-500">
            <p class="text-sm font-bold text-on-surface dark:text-white">TechCorp Systems</p>
            <p class="text-sm text-secondary dark:text-gray-400">Summer Intern • 2 days left</p>
        </div>
        <div class="p-4 bg-white/70 dark:bg-[rgba(255,255,255,0.05)] rounded-lg border-l-4 border-[#516600] dark:border-[#d4ff3e]">
            <p class="text-sm font-bold text-on-surface dark:text-white">Global Finance Group</p>
            <p class="text-sm text-secondary dark:text-gray-400">Analyst Program • 5 days left</p>
        </div>
        <div class="p-4 bg-white/70 dark:bg-[rgba(255,255,255,0.05)] rounded-lg border-l-4 border-gray-400 dark:border-gray-600">
            <p class="text-sm font-bold text-on-surface dark:text-white">Creative Cloud</p>
            <p class="text-sm text-secondary dark:text-gray-400">Design Fellow • 12 days left</p>
        </div>
    </div>
    <a href="{{ route('events.index') }}" class="mt-8 text-sm font-bold text-[#c46a00] dark:text-[#f5c98a] flex items-center gap-2 hover:underline">
        View Calendar <span class="material-symbols-outlined text-sm">arrow_forward</span>
    </a>
</div>

{{-- Recent Activity --}}
<div class="col-span-12 md:col-span-6 bg-white dark:bg-[#1a1c21] rounded-xl p-10 border border-outline-variant dark:border-[rgba(212,255,62,0.12)]">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-on-surface dark:text-white">Recent Activity</h2>
        <a href="{{ route('feed.index') }}" class="text-sm font-bold text-primary dark:text-[#d4ff3e] hover:underline">View All</a>
    </div>
    <div class="space-y-6">
        <div class="flex gap-4">
            <div class="h-10 w-10 rounded-full bg-[#d4ff3e] flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[#3d4d00] text-sm" style="font-variation-settings:'FILL' 1">person_add</span>
            </div>
            <div>
                <p class="text-sm text-on-surface dark:text-[#e3e3e3]"><strong class="text-on-surface dark:text-white">Sarah Jenkins</strong> (Class of '18) accepted your mentorship request.</p>
                <span class="text-xs text-secondary dark:text-gray-500">2 hours ago</span>
            </div>
        </div>
        <div class="flex gap-4">
            <div class="h-10 w-10 rounded-full bg-[#cceaf8] dark:bg-[rgba(100,180,230,0.3)] flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[#0a7cb5] dark:text-[#7cc9e8] text-sm" style="font-variation-settings:'FILL' 1">event_available</span>
            </div>
            <div>
                <p class="text-sm text-on-surface dark:text-[#e3e3e3]">You registered for <strong class="text-on-surface dark:text-white">'Future of AI in Fintech'</strong> webinar.</p>
                <span class="text-xs text-secondary dark:text-gray-500">Yesterday</span>
            </div>
        </div>
        <div class="flex gap-4">
            <div class="h-10 w-10 rounded-full bg-[#fde4b8] dark:bg-[rgba(230,170,80,0.3)] flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[#c46a00] dark:text-[#f5c98a] text-sm" style="font-variation-settings:'FILL' 1">celebration</span>
            </div>
            <div>
                <p class="text-sm text-on-surface dark:text-[#e3e3e3]"><strong class="text-on-surface dark:text-white">Alumni Connect</strong> celebrated 5 years of heritage today.</p>
                <span class="text-xs text-secondary dark:text-gray-500">2 days ago</span>
            </div>
        </div>
    </div>
</div>

{{-- Upcoming Events --}}
<div class="col-span-12 md:col-span-6 bg-white dark:bg-[#1a1c21] rounded-xl p-10 border border-outline-variant dark:border-[rgba(212,255,62,0.12)]">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-on-surface dark:text-white">Upcoming Events</h2>
        <a href="{{ route('events.index') }}" class="material-symbols-outlined text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-[#d4ff3e] transition-colors">event</a>
    </div>
    <div class="space-y-4 max-h-[250px] overflow-y-auto pr-4 custom-scroll">
        @foreach([
            ['mon' => 'Oct', 'day' => '14', 'title' => 'Engineering Career Fair', 'sub' => 'Main Hall • 2:00 PM'],
            ['mon' => 'Oct', 'day' => '18', 'title' => 'Alumni Panel: FinTech', 'sub' => 'Virtual Event • 6:30 PM'],
            ['mon' => 'Oct', 'day' => '22', 'title' => 'Resume Workshop', 'sub' => 'Career Center • 10:00 AM'],
        ] as $ev)
        <div class="flex gap-4 items-center p-4 hover:bg-surface-container dark:hover:bg-[#1e2025] rounded-lg transition-colors cursor-pointer group">
            <div class="flex-shrink-0 w-12 h-12 bg-surface-container dark:bg-[#0f1115] rounded-lg flex flex-col items-center justify-center border border-outline-variant dark:border-[rgba(212,255,62,0.15)] group-hover:border-primary dark:group-hover:border-[#d4ff3e] transition-colors">
                <span class="text-[10px] uppercase font-bold text-secondary dark:text-gray-500">{{ $ev['mon'] }}</span>
                <span class="text-lg font-bold text-on-surface dark:text-white">{{ $ev['day'] }}</span>
            </div>
            <div>
                <p class="text-sm font-bold text-on-surface dark:text-white">{{ $ev['title'] }}</p>
                <p class="text-sm text-secondary dark:text-gray-400">{{ $ev['sub'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Jobs for You --}}
<div class="col-span-12 bg-white dark:bg-[#1a1c21] rounded-xl p-10 border border-outline-variant dark:border-[rgba(212,255,62,0.12)]">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-on-surface dark:text-white mb-2">Jobs for You</h2>
            <p class="text-secondary dark:text-gray-400">Priority roles posted by your connected mentors and alumni.</p>
        </div>
        <a href="{{ route('jobs.index') }}" class="text-sm font-bold border-2 border-outline-variant dark:border-[rgba(212,255,62,0.3)] text-on-surface dark:text-[#d4ff3e] px-6 py-2 rounded-full hover:bg-surface-container dark:hover:bg-[#1e2025] transition-all">View All Jobs</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach([
            ['abbr'=>'AS','badge'=>'Referral Active','badgeBg'=>'bg-primary-container dark:bg-[rgba(212,255,62,0.15)] text-primary-dark dark:text-[#d4ff3e]','title'=>'Junior UX Designer','company'=>'Airbnb • San Francisco / Remote','ref'=>'SJ','refLabel'=>'Referral by Sarah J. (\'19)'],
            ['abbr'=>'FS','badge'=>'Referral Active','badgeBg'=>'bg-primary-container dark:bg-[rgba(212,255,62,0.15)] text-primary-dark dark:text-[#d4ff3e]','title'=>'Data Analyst','company'=>'Figma • New York / Hybrid','ref'=>'MK','refLabel'=>'Referral by Marcus K. (\'21)'],
            ['abbr'=>'SL','badge'=>'Trending','badgeBg'=>'bg-[#cceaf8] dark:bg-[rgba(100,180,230,0.2)] text-[#0a5c82] dark:text-[#7cc9e8]','title'=>'Product Manager','company'=>'Slack • Remote','ref'=>null,'refLabel'=>'4 Alumni work here'],
        ] as $job)
        <div class="p-6 bg-surface-container dark:bg-[#0f1115] rounded-xl border border-transparent dark:border-[rgba(212,255,62,0.08)] hover:border-primary dark:hover:border-[rgba(212,255,62,0.35)] hover:dark:shadow-[0_0_15px_rgba(212,255,62,0.08)] transition-all cursor-pointer">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-white dark:bg-[#1a1c21] rounded-lg border border-outline-variant dark:border-[rgba(212,255,62,0.2)] flex items-center justify-center text-primary dark:text-[#d4ff3e] font-black text-sm">{{ $job['abbr'] }}</div>
                <span class="text-[10px] font-bold uppercase tracking-wider {{ $job['badgeBg'] }} px-2 py-1 rounded-full">{{ $job['badge'] }}</span>
            </div>
            <h3 class="text-xl font-bold text-on-surface dark:text-white mb-1">{{ $job['title'] }}</h3>
            <p class="text-secondary dark:text-gray-400 text-sm mb-6">{{ $job['company'] }}</p>
            <div class="flex items-center gap-3 pt-4 border-t border-outline-variant dark:border-[rgba(255,255,255,0.08)]">
                @if($job['ref'])
                    <div class="w-8 h-8 rounded-full bg-[#d4ff3e] text-[#3d4d00] flex items-center justify-center font-bold text-xs">{{ $job['ref'] }}</div>
                @else
                    <span class="material-symbols-outlined text-sm text-secondary dark:text-gray-400">groups</span>
                @endif
                <p class="text-sm font-semibold text-secondary dark:text-gray-400">{{ $job['refLabel'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

</div>{{-- end bento-grid --}}
</main>

{{-- FAB --}}
<a href="{{ route('messages.index') }}"
   class="fixed bottom-8 right-8 w-14 h-14 bg-primary dark:bg-[#d4ff3e] text-white dark:text-[#1c1b1b] rounded-full shadow-lg dark:shadow-[0_0_25px_rgba(212,255,62,0.3)] flex items-center justify-center hover:scale-110 active:scale-95 transition-transform group" title="Quick Message">
    <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">chat_bubble</span>
    <span class="absolute right-16 bg-on-surface dark:bg-[#d4ff3e] text-surface dark:text-[#1c1b1b] text-[10px] font-bold px-3 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Message Mentor</span>
</a>
@endsection
