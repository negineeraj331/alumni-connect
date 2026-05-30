@extends('layouts.app')

@section('title', 'Alumni Dashboard | Alumni Connect')

@section('full_content')
<style>
    .bento-grid { display: grid; grid-template-columns: repeat(12, 1fr); gap: 24px; }
    .bento-item { border-radius: 24px; overflow: hidden; transition: all 0.3s ease; }
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #c5c9ae; border-radius: 10px; }
</style>
<main class="max-w-max-width mx-auto px-4 md:px-20 py-12">
{{-- Welcome Section --}}
<section class="mb-16">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
<div>
<h1 class="text-4xl md:text-5xl font-bold tracking-tight text-on-surface dark:text-white mb-2">Welcome back, {{ explode(' ', Auth::user()->name ?? 'Alumni')[0] }}.</h1>
<p class="text-lg text-secondary dark:text-gray-400">Your expertise is shaping the next generation of leaders.</p>
</div>
<div class="flex -space-x-3 overflow-hidden">
<div class="flex items-center justify-center h-12 w-12 rounded-full ring-2 ring-white bg-tertiary-container text-on-tertiary-container font-bold text-sm">A</div>
<div class="flex items-center justify-center h-12 w-12 rounded-full ring-2 ring-white bg-secondary-container text-on-secondary-container font-bold text-sm">B</div>
<div class="flex items-center justify-center h-12 w-12 rounded-full ring-2 ring-white bg-primary-container text-on-primary-container font-bold text-sm">+12</div>
</div>
</div>
</section>
{{-- Bento Grid --}}
<div class="bento-grid">
{{-- Network Impact Card --}}
<div class="col-span-12 md:col-span-8 bento-item bg-[#F9F7D9] p-10 flex flex-col justify-between">
<div>
<span class="px-3 py-1 bg-white/50 rounded-full text-sm font-bold text-primary mb-6 inline-block">Impact Summary</span>
<h2 class="text-2xl font-bold text-on-surface dark:text-white mb-8">You've empowered 14 mentees this semester.</h2>
</div>
<div class="grid grid-cols-2 md:grid-cols-3 gap-8">
<div>
<p class="text-5xl font-black text-primary leading-none">24</p>
<p class="text-sm font-bold text-secondary uppercase tracking-wider mt-2">New Connections</p>
</div>
<div>
<p class="text-5xl font-black text-primary leading-none">12</p>
<p class="text-sm font-bold text-secondary uppercase tracking-wider mt-2">Hours Mentored</p>
</div>
<div class="col-span-2 md:col-span-1">
<p class="text-5xl font-black text-primary leading-none">92%</p>
<p class="text-sm font-bold text-secondary uppercase tracking-wider mt-2">Feedback Score</p>
</div>
</div>
</div>
{{-- Profile Growth Card --}}
<div class="col-span-12 md:col-span-4 bento-item bg-tertiary-container p-8 flex flex-col">
<div class="flex items-start justify-between mb-8">
<div class="w-12 h-12 rounded-full bg-surface-container-lowest dark:bg-[#1a1c21] flex items-center justify-center">
<span class="material-symbols-outlined text-tertiary">trending_up</span>
</div>
<a href="{{ route('profiles.show', Auth::id()) }}" class="text-sm font-bold text-tertiary border-b border-tertiary">View Profile</a>
</div>
<h3 class="text-2xl font-bold text-on-tertiary-container mb-4">Profile Strength</h3>
<p class="text-sm text-on-tertiary-container/80 mb-6">Your profile visibility increased by 40% after the last alumni mixer.</p>
<div class="mt-auto h-24 bg-surface-container-lowest dark:bg-[#1a1c21]/30 rounded-xl flex items-end p-4 gap-2">
<div class="w-full bg-tertiary h-[20%] rounded-t-sm"></div>
<div class="w-full bg-tertiary h-[45%] rounded-t-sm"></div>
<div class="w-full bg-tertiary h-[30%] rounded-t-sm"></div>
<div class="w-full bg-tertiary h-[65%] rounded-t-sm"></div>
<div class="w-full bg-tertiary h-[90%] rounded-t-sm"></div>
</div>
</div>
{{-- Mentee Matches --}}
<div class="col-span-12 md:col-span-4 bento-item bg-surface-container-low dark:bg-[#1a1c16] border border-outline-variant dark:border-[#444934] p-8">
<div class="flex justify-between items-center mb-8">
<h3 class="text-2xl font-bold text-on-surface dark:text-white">Mentee Matches</h3>
<span class="material-symbols-outlined text-secondary dark:text-gray-400">info</span>
</div>
<div class="space-y-6">
<div class="flex items-center gap-4 group cursor-pointer">
<div class="w-14 h-14 rounded-full bg-primary-container flex items-center justify-center font-bold text-lg text-primary">AR</div>
<div>
<p class="font-bold text-on-surface dark:text-white group-hover:text-primary transition-colors">Alex Rivera</p>
<p class="text-sm text-secondary dark:text-gray-400">CS '24 • AI Interest</p>
</div>
</div>
<div class="flex items-center gap-4 group cursor-pointer">
<div class="w-14 h-14 rounded-full bg-secondary-container flex items-center justify-center font-bold text-lg text-secondary">JC</div>
<div>
<p class="font-bold text-on-surface dark:text-white group-hover:text-primary transition-colors">Jordan Chen</p>
<p class="text-sm text-secondary dark:text-gray-400">Design '23 • UX Focus</p>
</div>
</div>
<div class="flex items-center gap-4 group cursor-pointer">
<div class="w-14 h-14 rounded-full bg-tertiary-container flex items-center justify-center font-bold text-lg text-tertiary">MP</div>
<div>
<p class="font-bold text-on-surface dark:text-white group-hover:text-primary transition-colors">Maya Patel</p>
<p class="text-sm text-secondary dark:text-gray-400">Business '24 • Fintech</p>
</div>
</div>
</div>
<a href="{{ route('profiles.index') }}" class="w-full mt-10 py-3 border border-on-surface dark:border-white rounded-full font-bold hover:bg-on-surface dark:hover:bg-white hover:text-surface dark:hover:text-on-surface transition-all text-center block text-on-surface dark:text-white">Browse More</a>
</div>
{{-- Classmate Activity --}}
<div class="col-span-12 md:col-span-5 bento-item bg-surface-container-lowest dark:bg-[#1a1c21] border border-outline-variant dark:border-[#444934] p-8">
<div class="flex justify-between items-center mb-8">
<h3 class="text-2xl font-bold text-on-surface dark:text-white">Classmate Activity</h3>
<button class="material-symbols-outlined text-secondary dark:text-gray-400">more_horiz</button>
</div>
<div class="space-y-8 max-h-[400px] overflow-y-auto custom-scrollbar pr-4">
<div class="flex gap-4">
<div class="w-1 bg-primary/20 rounded-full"></div>
<div>
<p class="text-sm text-on-surface dark:text-white"><span class="font-bold">David King</span> just started a new position as Lead Architect at <span class="text-primary font-bold">Studio Loft</span>.</p>
<p class="text-xs text-secondary dark:text-gray-400 mt-1">2 hours ago</p>
</div>
</div>
<div class="flex gap-4">
<div class="w-1 bg-primary/20 rounded-full"></div>
<div>
<p class="text-sm text-on-surface dark:text-white"><span class="font-bold">Sarah Jenkins</span> published a new article: "The Future of Sustainable Design in 2025".</p>
<p class="text-xs text-secondary dark:text-gray-400 mt-1">5 hours ago</p>
</div>
</div>
<div class="flex gap-4">
<div class="w-1 bg-primary/20 rounded-full"></div>
<div>
<p class="text-sm text-on-surface dark:text-white"><span class="font-bold">Marcus Thorne</span> is attending the <span class="italic">Annual Tech Summit</span>.</p>
<p class="text-xs text-secondary dark:text-gray-400 mt-1">Yesterday</p>
</div>
</div>
</div>
</div>
{{-- Upcoming Mixers --}}
<div class="col-span-12 md:col-span-3 bento-item bg-[#FEE2E2] p-8 flex flex-col">
<h3 class="text-2xl font-bold text-on-surface dark:text-white mb-6">Upcoming Mixers</h3>
<div class="space-y-6 flex-1">
<div class="bg-surface-container-lowest dark:bg-[#1a1c21] rounded-2xl p-4 shadow-sm border border-black/5 hover:-translate-y-1 transition-transform cursor-pointer">
<p class="font-bold text-primary mb-1">Dec 15</p>
<p class="font-bold text-on-surface dark:text-white">Digital Arts Mixer</p>
<p class="text-sm text-secondary dark:text-gray-400">Modern Museum • 7PM</p>
</div>
<div class="bg-surface-container-lowest dark:bg-[#1a1c21] rounded-2xl p-4 shadow-sm border border-black/5 hover:-translate-y-1 transition-transform cursor-pointer">
<p class="font-bold text-primary mb-1">Jan 08</p>
<p class="font-bold text-on-surface dark:text-white">Tech Founders Circle</p>
<p class="text-sm text-secondary dark:text-gray-400">Virtual Event • 6PM</p>
</div>
</div>
<a href="{{ route('events.index') }}" class="mt-8 px-6 py-3 bg-primary text-on-primary rounded-full font-bold text-sm w-full text-center block">Join the Guestlist</a>
</div>
</div>{{-- end bento-grid --}}
</main>

{{-- FAB --}}
<a href="{{ route('feed.index') }}" class="fixed bottom-8 right-8 w-16 h-16 bg-primary-container text-on-primary-container rounded-full shadow-lg dark:shadow-[0_0_25px_rgba(212,255,62,0.15)] flex items-center justify-center hover:scale-105 active:scale-95 transition-all z-50" title="New Post">
<span class="material-symbols-outlined text-[32px]">add</span>
</a>
@endsection
