@extends('layouts.app')

@section('title', 'Organizer Dashboard | Alumni Connect')

@section('full_content')
<style>
    .bento-grid { display: grid; grid-template-columns: repeat(12, 1fr); gap: 24px; }
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #c5c9ae; border-radius: 10px; }
</style>
<main class="max-w-max-width mx-auto px-4 md:px-20 py-10 space-y-12">
{{-- Header --}}
<section class="flex flex-col md:flex-row justify-between items-end gap-6">
<div class="space-y-2">
<span class="text-sm font-bold text-primary uppercase tracking-widest">Organizer Dashboard</span>
<h1 class="text-4xl md:text-5xl font-bold tracking-tight text-on-surface dark:text-white">Event Analytics &amp; Insights</h1>
</div>
<div class="flex gap-4">
<a href="{{ route('events.create') }}" class="flex items-center gap-2 border-2 border-on-surface dark:border-white px-6 py-3 rounded-lg font-bold text-sm hover:bg-surface-container-low dark:hover:bg-[#1a1c16] transition-colors text-on-surface dark:text-white">
<span class="material-symbols-outlined">calendar_today</span> Schedule New
</a>
<a href="{{ route('events.create') }}" class="bg-primary text-on-primary px-6 py-3 rounded-lg font-bold text-sm shadow-lg dark:shadow-[0_0_25px_rgba(212,255,62,0.15)] active:scale-95 transition-transform">Create Workshop</a>
</div>
</section>
<div class="bento-grid">
{{-- Key Stats --}}
<div class="col-span-12 md:col-span-8 grid grid-cols-1 md:grid-cols-3 gap-6">
<div class="bg-primary-container p-10 rounded-xl flex flex-col justify-between">
<span class="material-symbols-outlined text-on-primary-container">groups</span>
<div class="mt-8">
<div class="text-6xl font-black text-on-primary-container">1.2k</div>
<div class="text-xs font-bold text-on-primary-container opacity-70 uppercase mt-2">Total RSVPs</div>
</div>
</div>
<div class="bg-[#ffeaea] p-10 rounded-xl flex flex-col justify-between">
<span class="material-symbols-outlined text-on-tertiary-container">how_to_reg</span>
<div class="mt-8">
<div class="text-6xl font-black text-on-tertiary-container">84%</div>
<div class="text-xs font-bold text-on-tertiary-container opacity-70 uppercase mt-2">Attendance Rate</div>
</div>
</div>
<div class="bg-secondary-container p-10 rounded-xl flex flex-col justify-between">
<span class="material-symbols-outlined text-on-secondary-container">trending_up</span>
<div class="mt-8">
<div class="text-6xl font-black text-on-secondary-container">+12%</div>
<div class="text-xs font-bold text-on-secondary-container opacity-70 uppercase mt-2">Engagement</div>
</div>
</div>
</div>
{{-- Task List --}}
<div class="col-span-12 md:col-span-4 bg-surface-container-low dark:bg-[#1a1c16] border border-outline-variant dark:border-[#444934] p-8 rounded-xl flex flex-col h-full">
<div class="flex justify-between items-center mb-6">
<h3 class="text-2xl font-bold text-on-surface dark:text-white">Task List</h3>
<span class="bg-primary text-on-primary text-[10px] px-2 py-1 rounded-full">4 Pending</span>
</div>
<div class="space-y-4 flex-grow overflow-y-auto custom-scrollbar pr-2">
<label class="flex items-center gap-4 p-4 bg-surface dark:bg-[#12140e] rounded-lg cursor-pointer group hover:border-primary border border-transparent transition-all">
<input class="w-5 h-5 rounded text-primary focus:ring-primary" type="checkbox">
<span class="text-sm group-hover:text-primary transition-colors">Finalize Speaker List for Tech Mixer</span>
</label>
<label class="flex items-center gap-4 p-4 bg-surface dark:bg-[#12140e] rounded-lg cursor-pointer group hover:border-primary border border-transparent transition-all">
<input checked class="w-5 h-5 rounded text-primary focus:ring-primary" type="checkbox">
<span class="text-sm line-through opacity-50">Draft Event Email Sequence</span>
</label>
<label class="flex items-center gap-4 p-4 bg-surface dark:bg-[#12140e] rounded-lg cursor-pointer group hover:border-primary border border-transparent transition-all">
<input class="w-5 h-5 rounded text-primary focus:ring-primary" type="checkbox">
<span class="text-sm group-hover:text-primary transition-colors">Confirm Catering for Workshop</span>
</label>
<label class="flex items-center gap-4 p-4 bg-surface dark:bg-[#12140e] rounded-lg cursor-pointer group hover:border-primary border border-transparent transition-all">
<input class="w-5 h-5 rounded text-primary focus:ring-primary" type="checkbox">
<span class="text-sm group-hover:text-primary transition-colors">Update RSVP Tracking Sheet</span>
</label>
</div>
</div>
{{-- Management Console --}}
<div class="col-span-12 lg:col-span-7 bg-surface-container-lowest dark:bg-[#1a1c21] border border-outline-variant dark:border-[#444934] rounded-xl p-8">
<div class="flex justify-between items-center mb-8">
<h3 class="text-2xl font-bold text-on-surface dark:text-white">Management Console</h3>
<a class="text-sm font-bold text-primary hover:underline" href="{{ route('events.index') }}">View All Schedule</a>
</div>
<div class="space-y-6">
<div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 p-4 rounded-xl border border-outline-variant dark:border-[#444934] hover:shadow-md transition-shadow">
<div class="w-20 h-20 bg-primary-container rounded-lg flex flex-col items-center justify-center text-on-primary-container font-bold">
<span class="text-xs font-bold">OCT</span>
<span class="text-2xl font-bold">24</span>
</div>
<div class="flex-grow">
<h4 class="text-xl font-bold text-on-surface dark:text-white">Product Design Masterclass</h4>
<p class="text-sm text-secondary dark:text-gray-400">Interactive Workshop • 45 Registered</p>
</div>
<div class="flex gap-2">
<button class="p-2 rounded-full hover:bg-surface-container dark:hover:bg-[#20241b] transition-colors"><span class="material-symbols-outlined">edit</span></button>
<button class="p-2 rounded-full hover:bg-surface-container dark:hover:bg-[#20241b] transition-colors"><span class="material-symbols-outlined">share</span></button>
</div>
</div>
<div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 p-4 rounded-xl border border-outline-variant dark:border-[#444934] hover:shadow-md transition-shadow">
<div class="w-20 h-20 bg-tertiary-fixed rounded-lg flex flex-col items-center justify-center text-on-tertiary-container font-bold">
<span class="text-xs font-bold">NOV</span>
<span class="text-2xl font-bold">02</span>
</div>
<div class="flex-grow">
<h4 class="text-xl font-bold text-on-surface dark:text-white">Alumni Networking Mixer</h4>
<p class="text-sm text-secondary dark:text-gray-400">Professional Social • 120 Registered</p>
</div>
<div class="flex gap-2">
<button class="p-2 rounded-full hover:bg-surface-container dark:hover:bg-[#20241b] transition-colors"><span class="material-symbols-outlined">edit</span></button>
<button class="p-2 rounded-full hover:bg-surface-container dark:hover:bg-[#20241b] transition-colors"><span class="material-symbols-outlined">share</span></button>
</div>
</div>
</div>
</div>
{{-- Potential Speakers --}}
<div class="col-span-12 lg:col-span-5 bg-surface-container dark:bg-[#20241b] p-8 rounded-xl">
<h3 class="text-2xl font-bold text-on-surface dark:text-white mb-6">Potential Speakers</h3>
<p class="text-sm text-secondary dark:text-gray-400 mb-8">Top community contributors based on engagement and professional experience.</p>
<div class="space-y-6">
<div class="flex items-center gap-4">
<div class="w-14 h-14 rounded-full border-2 border-white bg-primary-container flex items-center justify-center font-bold text-lg text-primary">SC</div>
<div class="flex-grow">
<p class="font-bold text-on-surface dark:text-white">Dr. Sarah Chen</p>
<p class="text-sm text-secondary dark:text-gray-400">AI Ethics Specialist • Google</p>
</div>
<button class="text-primary font-bold text-sm hover:underline">Invite</button>
</div>
<div class="flex items-center gap-4">
<div class="w-14 h-14 rounded-full border-2 border-white bg-secondary-container flex items-center justify-center font-bold text-lg text-secondary">MT</div>
<div class="flex-grow">
<p class="font-bold text-on-surface dark:text-white">Marcus Thorne</p>
<p class="text-sm text-secondary dark:text-gray-400">Founder of EcoStream • Series B</p>
</div>
<button class="text-primary font-bold text-sm hover:underline">Invite</button>
</div>
<div class="flex items-center gap-4">
<div class="w-14 h-14 rounded-full border-2 border-white bg-tertiary-container flex items-center justify-center font-bold text-lg text-tertiary">ER</div>
<div class="flex-grow">
<p class="font-bold text-on-surface dark:text-white">Elena Rodriguez</p>
<p class="text-sm text-secondary dark:text-gray-400">Lead UX Researcher • Spotify</p>
</div>
<button class="text-primary font-bold text-sm hover:underline">Invite</button>
</div>
</div>
</div>
</div>{{-- end bento-grid --}}

{{-- Featured Banner --}}
<section class="bg-primary p-12 rounded-2xl text-on-primary flex flex-col md:flex-row items-center gap-10 overflow-hidden relative mt-12">
<div class="relative z-10 space-y-6 max-w-xl">
<h2 class="text-3xl font-bold">Optimizing Your Hybrid Events</h2>
<p class="text-lg opacity-90">Discover our latest guide on how to balance in-person networking with global digital accessibility for your next alumni mixer.</p>
<button class="bg-primary-container text-on-primary-container px-8 py-3 rounded-full font-bold text-sm hover:bg-primary-fixed-dim transition-colors">Read Best Practices</button>
</div>
<div class="absolute -bottom-20 -right-20 w-80 h-80 bg-primary-container rounded-full opacity-10"></div>
</section>
</main>

<script>
    // Micro-interaction for the task list
    const tasks = document.querySelectorAll('input[type="checkbox"]');
    tasks.forEach(task => {
        task.addEventListener('change', function() {
            const text = this.nextElementSibling;
            if (this.checked) { text.classList.add('line-through', 'opacity-50'); }
            else { text.classList.remove('line-through', 'opacity-50'); }
        });
    });
</script>
@endsection
