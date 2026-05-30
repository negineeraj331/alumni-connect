@extends('layouts.app')

@section('title', 'Faculty Dashboard | Alumni Connect')

@section('full_content')
<style>
    .bento-grid { display: grid; grid-template-columns: repeat(12, 1fr); gap: 24px; }
</style>
<main class="max-w-max-width mx-auto px-4 md:px-20 py-12">
<section class="mb-16">
<h1 class="text-4xl md:text-5xl font-bold tracking-tight text-on-surface dark:text-white mb-4">Welcome back, {{ explode(' ', Auth::user()->name ?? 'Faculty')[0] }}.</h1>
<p class="text-lg text-secondary dark:text-gray-400 max-w-2xl">Your central hub for academic excellence, alumni engagement, and inter-departmental research synergy.</p>
</section>
<div class="bento-grid">
{{-- Research Collaborations --}}
<div class="col-span-12 lg:col-span-8 bg-tertiary-container p-10 rounded-xl flex flex-col justify-between min-h-[400px]">
<div>
<div class="flex items-center gap-2 mb-6">
<span class="material-symbols-outlined text-tertiary">hub</span>
<span class="text-sm font-bold text-on-tertiary-container uppercase tracking-widest">Global Research Network</span>
</div>
<h2 class="text-2xl font-bold text-on-tertiary-container mb-4">Active Collaboration Calls</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="bg-surface-container-lowest dark:bg-[#1a1c21]/50 p-6 rounded-lg border border-tertiary-fixed-dim">
<h3 class="font-bold text-on-surface dark:text-white mb-2">Sustainable Urban Design</h3>
<p class="text-sm text-on-tertiary-container/80 mb-4">Seeking faculty co-lead for the upcoming cross-continental urban ethics study.</p>
<span class="text-xs font-bold bg-tertiary text-white px-3 py-1 rounded-full">New Proposal</span>
</div>
<div class="bg-surface-container-lowest dark:bg-[#1a1c21]/50 p-6 rounded-lg border border-tertiary-fixed-dim">
<h3 class="font-bold text-on-surface dark:text-white mb-2">Neural Link Ethics</h3>
<p class="text-sm text-on-tertiary-container/80 mb-4">Informatics dept. looking for Philosophical advisory on AI bias benchmarks.</p>
<span class="text-xs font-bold bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full">3 Partners Found</span>
</div>
</div>
</div>
<button class="mt-8 flex items-center gap-2 font-bold text-tertiary hover:gap-4 transition-all">
View all 14 opportunities <span class="material-symbols-outlined">arrow_forward</span>
</button>
</div>
{{-- Department Updates --}}
<div class="col-span-12 lg:col-span-4 bg-surface-container dark:bg-[#20241b] p-8 rounded-xl flex flex-col border border-outline-variant dark:border-[#444934]">
<div class="flex items-center gap-2 mb-6">
<span class="material-symbols-outlined text-primary">campaign</span>
<h2 class="text-2xl font-bold text-on-surface dark:text-white">Department Updates</h2>
</div>
<div class="space-y-6">
<div class="pb-4 border-b border-outline-variant dark:border-[#444934]">
<p class="text-xs font-semibold text-secondary dark:text-gray-400 mb-1">2 hours ago</p>
<p class="font-bold text-on-surface dark:text-white">New Lab Equipment Arrival</p>
<p class="text-sm text-secondary dark:text-gray-400">The Quantum Computing lab is now fully stocked with the 2024 series processors.</p>
</div>
<div class="pb-4 border-b border-outline-variant dark:border-[#444934]">
<p class="text-xs font-semibold text-secondary dark:text-gray-400 mb-1">Yesterday</p>
<p class="font-bold text-on-surface dark:text-white">Grant Deadline Reminder</p>
<p class="text-sm text-secondary dark:text-gray-400">Applications for the 'Future Scholars' grant close this Friday at 5:00 PM.</p>
</div>
<div>
<p class="text-xs font-semibold text-secondary dark:text-gray-400 mb-1">Oct 12</p>
<p class="font-bold text-on-surface dark:text-white">Guest Lecturer: Sarah Chen</p>
<p class="text-sm text-secondary dark:text-gray-400">Alumni Sarah Chen (Class of '18) will be visiting for a fireside chat.</p>
</div>
</div>
</div>
{{-- Reconnect with Alumni --}}
<div class="col-span-12 lg:col-span-5 bg-primary-container p-10 rounded-xl relative overflow-hidden">
<div class="relative z-10">
<h2 class="text-2xl font-bold text-on-primary-container mb-6">Reconnect with Alumni</h2>
<div class="space-y-4">
<div class="flex items-center gap-4 bg-surface-container-lowest dark:bg-[#1a1c21]/40 p-4 rounded-xl">
<div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center font-bold text-lg">JB</div>
<div>
<p class="font-bold text-on-surface dark:text-white">Jameson Blake</p>
<p class="text-sm text-on-primary-container">Senior Architect at OMA • Class of '15</p>
</div>
<a href="{{ route('messages.index') }}" class="ml-auto material-symbols-outlined text-primary hover:text-primary-dark transition-colors">chat_bubble_outline</a>
</div>
<div class="flex items-center gap-4 bg-surface-container-lowest dark:bg-[#1a1c21]/40 p-4 rounded-xl">
<div class="w-12 h-12 rounded-full bg-tertiary-container flex items-center justify-center font-bold text-lg">ER</div>
<div>
<p class="font-bold text-on-surface dark:text-white">Elena Rodriguez</p>
<p class="text-sm text-on-primary-container">Founder, TechSafe • Class of '19</p>
</div>
<a href="{{ route('messages.index') }}" class="ml-auto material-symbols-outlined text-primary hover:text-primary-dark transition-colors">chat_bubble_outline</a>
</div>
</div>
<a href="{{ route('profiles.index') }}" class="mt-6 font-bold underline text-on-primary-container hover:opacity-80 transition-opacity inline-block">View Full Student Directory</a>
</div>
<div class="absolute -right-12 -bottom-12 opacity-10">
<span class="material-symbols-outlined text-[200px]">school</span>
</div>
</div>
{{-- Upcoming Seminars --}}
<div class="col-span-12 lg:col-span-7 bg-surface-container-lowest dark:bg-[#1a1c21] p-10 rounded-xl border-2 border-primary">
<div class="flex justify-between items-center mb-8">
<h2 class="text-2xl font-bold text-on-surface dark:text-white">Upcoming Seminars</h2>
<a href="{{ route('events.index') }}" class="text-xs font-bold text-secondary dark:text-gray-400 bg-surface-container dark:bg-[#20241b] px-3 py-1 rounded-full">Calendar View</a>
</div>
<div class="space-y-6">
<div class="flex gap-6 group cursor-pointer">
<div class="flex-shrink-0 w-16 h-16 bg-surface-container dark:bg-[#20241b] flex flex-col items-center justify-center rounded-lg group-hover:bg-primary group-hover:text-white transition-colors">
<span class="text-xs font-bold">OCT</span>
<span class="text-2xl font-bold">24</span>
</div>
<div>
<h3 class="font-bold text-lg text-on-surface dark:text-white">The Future of Bio-Digital Convergence</h3>
<p class="text-secondary dark:text-gray-400">Main Hall • 10:30 AM — 12:00 PM</p>
<p class="text-primary font-semibold text-sm mt-1">Guest: Dr. Marcus Thorne</p>
</div>
</div>
<div class="flex gap-6 group cursor-pointer">
<div class="flex-shrink-0 w-16 h-16 bg-surface-container dark:bg-[#20241b] flex flex-col items-center justify-center rounded-lg group-hover:bg-primary group-hover:text-white transition-colors">
<span class="text-xs font-bold">NOV</span>
<span class="text-2xl font-bold">02</span>
</div>
<div>
<h3 class="font-bold text-lg text-on-surface dark:text-white">Ethics in Distributed Ledger Technology</h3>
<p class="text-secondary dark:text-gray-400">Zoom Interactive • 02:00 PM — 03:30 PM</p>
<p class="text-primary font-semibold text-sm mt-1">Panel Discussion</p>
</div>
</div>
</div>
</div>
{{-- Lecture Invitations --}}
<div class="col-span-12 bg-secondary-fixed p-12 rounded-xl flex flex-col md:flex-row items-center gap-12">
<div class="flex-1">
<h2 class="text-4xl font-black leading-tight mb-4 text-on-secondary-fixed">Manage Alumni Invitations</h2>
<p class="text-lg text-on-secondary-fixed-variant mb-6">You have <span class="font-bold text-primary">3 pending invitations</span> to guest lecture or mentor workshops from former students now in industry leadership.</p>
<div class="flex gap-4">
<button class="px-8 py-3 bg-primary text-white font-bold rounded-full hover:opacity-90 transition-all">Review Requests</button>
<button class="px-8 py-3 border-2 border-on-secondary-fixed text-on-secondary-fixed font-bold rounded-full hover:bg-on-secondary-fixed hover:text-white transition-all">Update Preferences</button>
</div>
</div>
<div class="flex-1 grid grid-cols-2 gap-4">
<div class="bg-surface-container-lowest dark:bg-[#1a1c21]/50 p-4 rounded-xl border border-white">
<p class="font-bold text-on-surface dark:text-white">Next-Gen UX Seminar</p>
<p class="text-xs text-secondary dark:text-gray-400">Host: Design Collective</p>
<div class="flex gap-2 mt-3">
<button class="text-primary font-bold text-sm">Accept</button>
<button class="text-error font-bold text-sm">Decline</button>
</div>
</div>
<div class="bg-surface-container-lowest dark:bg-[#1a1c21]/50 p-4 rounded-xl border border-white">
<p class="font-bold text-on-surface dark:text-white">AI for Good Workshop</p>
<p class="text-xs text-secondary dark:text-gray-400">Host: NGO Global</p>
<div class="flex gap-2 mt-3">
<button class="text-primary font-bold text-sm">Accept</button>
<button class="text-error font-bold text-sm">Decline</button>
</div>
</div>
</div>
</div>
</div>
</main>
@endsection
