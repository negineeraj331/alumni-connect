@extends('layouts.app')

@section('title', 'Messages | Alumni Connect')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
{{-- Sidebar: Conversations List --}}
<section class="lg:col-span-4 bg-surface-container-lowest dark:bg-[#1a1c21] rounded-xl border-2 border-outline-variant dark:border-[#444934] overflow-hidden">
<div class="p-6 border-b border-outline-variant dark:border-[#444934] flex justify-between items-center bg-surface-container-low dark:bg-[#1a1c16]">
<h1 class="text-2xl font-bold text-on-surface dark:text-white">Messages</h1>
<button class="material-symbols-outlined text-primary p-2 bg-primary-container rounded-lg">edit_square</button>
</div>
<div class="p-4 bg-surface-bright dark:bg-[#12140e]">
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary dark:text-gray-400">search</span>
<input class="w-full pl-10 pr-4 py-3 bg-surface-container-lowest dark:bg-[#1a1c21] border border-outline-variant dark:border-[#444934] rounded-lg focus:outline-none focus:border-primary transition-colors text-sm" placeholder="Search conversations..." type="text">
</div>
</div>
<div class="divide-y divide-outline-variant dark:divide-[#444934] max-h-[600px] overflow-y-auto">
@forelse($conversations as $conversation)
@php
    $otherUser = $conversation->sender_id === Auth::id() ? $conversation->receiver : $conversation->sender;
    $isUnread = $conversation->receiver_id === Auth::id() && is_null($conversation->read_at);
    $bgClass = $isUnread ? "bg-primary-container/10 border-l-4 border-primary" : "bg-surface-container-lowest dark:bg-[#1a1c21] hover:bg-surface-container dark:hover:bg-[#20241b]";
@endphp
<a href="{{ route('messages.show', $otherUser->id) }}" class="p-4 flex gap-4 {{ $bgClass }} cursor-pointer transition-colors block">
    <div class="relative flex-shrink-0">
        <div class="w-14 h-14 rounded-full flex items-center justify-center bg-surface-variant text-on-surface dark:text-white font-bold text-2xl border border-outline-variant dark:border-[#444934]">
            {{ substr($otherUser->name, 0, 1) }}
        </div>
        @if($isUnread)
            <div class="absolute bottom-0 right-0 w-4 h-4 bg-primary rounded-full border-2 border-white"></div>
        @endif
    </div>
    <div class="flex-1 min-w-0">
        <div class="flex justify-between items-baseline">
            <h3 class="text-sm font-bold {{ $isUnread ? 'text-on-surface dark:text-white' : 'text-on-surface dark:text-gray-300' }} truncate">{{ $otherUser->name }}</h3>
            <span class="text-[12px] {{ $isUnread ? 'font-bold text-primary' : 'text-secondary dark:text-gray-400' }}">{{ $conversation->created_at->diffForHumans(null, true, true) }}</span>
        </div>
        <p class="text-sm {{ $isUnread ? 'font-bold text-on-surface dark:text-white' : 'text-secondary dark:text-gray-400' }} truncate">{{ $conversation->sender_id === Auth::id() ? 'You: ' : '' }}{{ $conversation->body }}</p>
    </div>
</a>
@empty
<div class="p-8 text-center text-secondary dark:text-gray-400">
    <span class="material-symbols-outlined text-5xl mb-3 block opacity-40">forum</span>
    <p>No conversations yet. Find a mentor or peer to start chatting!</p>
</div>
@endforelse
</div>
</section>

{{-- Main Content: Prompt to select conversation --}}
<section class="lg:col-span-8 bg-surface-container-lowest dark:bg-[#1a1c21] rounded-xl border-2 border-outline-variant dark:border-[#444934] flex flex-col h-[700px]">
<div class="flex-1 flex flex-col items-center justify-center text-secondary dark:text-gray-400 p-8 text-center">
    <span class="material-symbols-outlined text-6xl mb-4 opacity-50">forum</span>
    <h2 class="text-2xl font-bold text-on-surface dark:text-white mb-2">Your Messages</h2>
    <p class="text-sm">Select a conversation from the sidebar or start a new one to connect with peers and mentors.</p>
</div>
</section>
</div>
@endsection
