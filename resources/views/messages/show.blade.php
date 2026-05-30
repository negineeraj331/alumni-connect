@extends('layouts.app')

@section('title', 'Chat with ' . $otherUser->name . ' | Alumni Connect')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
{{-- Sidebar: Conversations List --}}
<section class="lg:col-span-4 bg-surface-container-lowest dark:bg-[#1a1c21] rounded-xl border-2 border-outline-variant dark:border-[#444934] overflow-hidden hidden lg:block">
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
    $chatUser = $conversation->sender_id === Auth::id() ? $conversation->receiver : $conversation->sender;
    $isUnread = $conversation->receiver_id === Auth::id() && is_null($conversation->read_at);
    $isActive = $chatUser->id === $otherUser->id;
    $bgClass = $isActive ? "bg-surface-container dark:bg-[#20241b] border-l-4 border-secondary" : ($isUnread ? "bg-primary-container/10 border-l-4 border-primary" : "bg-surface-container-lowest dark:bg-[#1a1c21] hover:bg-surface-container dark:hover:bg-[#20241b]");
@endphp
<a href="{{ route('messages.show', $chatUser->id) }}" class="p-4 flex gap-4 {{ $bgClass }} cursor-pointer transition-colors block">
    <div class="relative flex-shrink-0">
        <div class="w-14 h-14 rounded-full flex items-center justify-center bg-surface-variant text-on-surface dark:text-white font-bold text-2xl border border-outline-variant dark:border-[#444934]">
            {{ substr($chatUser->name, 0, 1) }}
        </div>
        @if($isUnread && !$isActive)
            <div class="absolute bottom-0 right-0 w-4 h-4 bg-primary rounded-full border-2 border-white"></div>
        @endif
    </div>
    <div class="flex-1 min-w-0">
        <div class="flex justify-between items-baseline">
            <h3 class="text-sm font-bold {{ ($isUnread && !$isActive) ? 'text-on-surface dark:text-white' : 'text-on-surface dark:text-gray-300' }} truncate">{{ $chatUser->name }}</h3>
            <span class="text-[12px] {{ ($isUnread && !$isActive) ? 'font-bold text-primary' : 'text-secondary dark:text-gray-400' }}">{{ $conversation->created_at->diffForHumans(null, true, true) }}</span>
        </div>
        <p class="text-sm {{ ($isUnread && !$isActive) ? 'font-bold text-on-surface' : 'text-secondary dark:text-gray-400' }} truncate">{{ $conversation->sender_id === Auth::id() ? 'You: ' : '' }}{{ $conversation->body }}</p>
    </div>
</a>
@empty
<div class="p-8 text-center text-secondary dark:text-gray-400"><p>No conversations yet.</p></div>
@endforelse
</div>
</section>

{{-- Main Content: Active Chat --}}
<section class="lg:col-span-8 bg-surface-container-lowest dark:bg-[#1a1c21] rounded-xl border-2 border-outline-variant dark:border-[#444934] flex flex-col h-[700px]">
{{-- Chat Header --}}
<div class="p-6 border-b border-outline-variant dark:border-[#444934] flex justify-between items-center bg-surface-container-low dark:bg-[#1a1c16]">
<div class="flex items-center gap-4">
    <a href="{{ route('messages.index') }}" class="lg:hidden material-symbols-outlined text-secondary dark:text-gray-400 hover:text-on-surface dark:hover:text-white">arrow_back</a>
    <div class="relative">
        <div class="w-12 h-12 rounded-full flex items-center justify-center bg-surface-variant text-on-surface dark:text-white font-bold text-xl border border-outline-variant dark:border-[#444934]">
            {{ substr($otherUser->name, 0, 1) }}
        </div>
        @if($otherUser->is_active)
            <div class="absolute bottom-0 right-0 w-3 h-3 bg-primary rounded-full border-2 border-white"></div>
        @endif
    </div>
    <div>
        <h2 class="text-base font-bold text-on-surface dark:text-white">{{ $otherUser->name }}</h2>
        <p class="text-xs text-primary font-bold">{{ ucfirst($otherUser->roles->first()->name ?? 'Member') }}</p>
    </div>
</div>
<div class="flex gap-2">
    <button type="button" onclick="startVideoCall()" class="flex items-center gap-1 px-3 py-1.5 bg-primary-container text-primary-dark font-bold text-sm rounded-lg hover:opacity-90 transition-opacity">
        <span class="material-symbols-outlined text-[18px]">video_camera_front</span> <span class="hidden sm:inline">Video Call</span>
    </button>
    <a href="{{ route('profiles.show', $otherUser->id) }}" class="material-symbols-outlined p-2 hover:bg-surface-container dark:hover:bg-[#20241b] rounded-full text-secondary dark:text-gray-400">info</a>
</div>
</div>

{{-- Chat Canvas --}}
<div class="flex-1 p-8 overflow-y-auto bg-surface-container-low dark:bg-[#1a1c16] space-y-6 flex flex-col" id="chat-container">
@php $lastDate = null; @endphp
@foreach($messages as $msg)
@php $currentDate = $msg->created_at->format('Y-m-d'); @endphp

@if($lastDate !== $currentDate)
    <div class="flex justify-center my-4">
        <span class="bg-outline-variant/30 text-on-surface-variant px-4 py-1 rounded-full text-[12px] font-bold">
            {{ $msg->created_at->isToday() ? 'TODAY' : strtoupper($msg->created_at->format('M j, Y')) }}
        </span>
    </div>
    @php $lastDate = $currentDate; @endphp
@endif

@if($msg->sender_id === Auth::id())
    <div class="flex items-start gap-3 flex-row-reverse ml-auto max-w-[80%]">
        <div class="bg-primary-container p-4 rounded-xl rounded-tr-none">
            <p class="text-sm text-on-primary-container">{{ $msg->body }}</p>
            <div class="flex items-center justify-end gap-1 mt-2">
                <span class="text-[10px] text-on-primary-container/70 block text-right">{{ $msg->created_at->format('h:i A') }}</span>
                @if($msg->read_at)
                    <span class="material-symbols-outlined text-[12px] text-primary">done_all</span>
                @else
                    <span class="material-symbols-outlined text-[12px] text-on-primary-container/50">check</span>
                @endif
            </div>
        </div>
    </div>
@else
    <div class="flex items-start gap-3 max-w-[80%]">
        <div class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center bg-surface-variant text-on-surface dark:text-white font-bold text-sm border border-outline-variant dark:border-[#444934] mt-1">
            {{ substr($otherUser->name, 0, 1) }}
        </div>
        <div class="bg-surface-container-lowest dark:bg-[#1a1c21] border border-outline-variant dark:border-[#444934] p-4 rounded-xl rounded-tl-none shadow-sm">
            <p class="text-sm text-on-surface dark:text-white">{{ $msg->body }}</p>
            <span class="text-[10px] text-secondary dark:text-gray-400 mt-2 block">{{ $msg->created_at->format('h:i A') }}</span>
        </div>
    </div>
@endif
@endforeach

@if($messages->isEmpty())
    <div class="flex-1 flex flex-col items-center justify-center text-secondary dark:text-gray-400 h-full my-auto">
        <span class="material-symbols-outlined text-4xl mb-2 opacity-50">waving_hand</span>
        <p>Say hello to {{ $otherUser->name }}!</p>
    </div>
@endif
</div>

{{-- Input Area --}}
<form action="{{ route('messages.store', $otherUser->id) }}" method="POST" class="p-6 border-t border-outline-variant dark:border-[#444934] bg-surface-container-lowest dark:bg-[#1a1c21]">
@csrf
<div class="flex items-center gap-4 bg-surface-container-low dark:bg-[#1a1c16] p-2 border-2 border-outline-variant dark:border-[#444934] rounded-xl focus-within:border-primary transition-colors">
    <input id="message-input" name="body" class="flex-1 bg-transparent border-none focus:ring-0 text-sm text-on-surface dark:text-white px-4 py-2" placeholder="Type a message..." type="text" autocomplete="off" required>
    <button id="send-btn" type="submit" class="bg-primary-fixed text-on-primary-fixed p-2 rounded-lg material-symbols-outlined hover:scale-95 transition-transform">send</button>
</div>
</form>
</section>
</div>

<script>
    // Scroll chat to bottom
    const chatContainer = document.getElementById('chat-container');
    if (chatContainer) { chatContainer.scrollTop = chatContainer.scrollHeight; }

    // Video Call Logic
    function startVideoCall() {
        const roomId = 'AlumniConnect_' + Math.random().toString(36).substring(2, 12);
        const meetingUrl = `https://meet.jit.si/${roomId}`;
        window.open(meetingUrl, '_blank');
        const input = document.getElementById('message-input');
        if(input) {
            input.value = `I've started a video call. Join here: ${meetingUrl}`;
            document.getElementById('send-btn').click();
        }
    }
</script>
@endsection
