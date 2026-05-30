<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        // Get latest message per conversation
        $conversations = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($msg) use ($userId) {
                return $msg->sender_id === $userId ? $msg->receiver_id : $msg->sender_id;
            })
            ->map(function($msgs) {
                return $msgs->first();
            });

        return view('messages.index', compact('conversations'));
    }

    public function show($id)
    {
        $otherUser = User::findOrFail($id);
        $userId = Auth::id();

        // Mark unread as read
        Message::where('sender_id', $id)
            ->where('receiver_id', $userId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $messages = Message::between($userId, $id)
            ->orderBy('created_at', 'asc')
            ->get();

        // Get latest message per conversation for the sidebar
        $conversations = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($msg) use ($userId) {
                return $msg->sender_id === $userId ? $msg->receiver_id : $msg->sender_id;
            })
            ->map(function($msgs) {
                return $msgs->first();
            });

        return view('messages.show', compact('messages', 'otherUser', 'conversations'));
    }

    public function store(Request $request, $id)
    {
        $request->validate(['body' => 'required|string|max:1000']);
        
        $receiver = User::findOrFail($id);
        $sender = Auth::user();

        // Permission check
        if ($sender->hasRole('student')) {
            // Check if student has active mentorship with this mentor
            $hasMentorship = $sender->menteeships()
                ->where('mentor_id', $id)
                ->where('status', 'active')
                ->exists();
                
            if (!$hasMentorship && !$receiver->hasRole('admin')) {
                abort(403, 'Students can only message their active mentors or admins.');
            }
        }

        Message::create([
            'sender_id' => $sender->id,
            'receiver_id' => $id,
            'body' => $request->body,
        ]);

        return redirect()->route('messages.show', $id);
    }
}
