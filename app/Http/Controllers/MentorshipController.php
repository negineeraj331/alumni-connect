<?php

namespace App\Http\Controllers;

use App\Models\Mentorship;
use App\Models\User;
use App\Services\MentorMatchingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorshipController extends Controller
{
    protected MentorMatchingService $matchingService;

    public function __construct(MentorMatchingService $matchingService)
    {
        $this->matchingService = $matchingService;
    }

    public function index()
    {
        $user = Auth::user();
        
        $asMentee = $user->menteeships()->with(['mentor.profile'])->get();
        $asMentor = $user->mentorships()->with(['mentee.profile'])->get();
        
        $matches = [];
        if ($user->hasRole('student') || $user->hasRole('alumni')) {
            $matches = $this->matchingService->findMatches($user);
        }

        return view('mentorship.index', compact('asMentee', 'asMentor', 'matches'));
    }

    public function requestMentorship(Request $request)
    {
        $request->validate([
            'mentor_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000'
        ]);

        $user = Auth::user();
        
        // Prevent duplicate active/pending requests
        $existing = Mentorship::where('mentee_id', $user->id)
            ->where('mentor_id', $request->mentor_id)
            ->whereIn('status', ['pending', 'active'])
            ->first();

        if ($existing) {
            return back()->with('error', 'You already have an active or pending mentorship with this mentor.');
        }

        Mentorship::create([
            'mentor_id' => $request->mentor_id,
            'mentee_id' => $user->id,
            'status' => 'pending',
            'request_message' => $request->message,
        ]);

        // Also send the first message in the chat thread
        \App\Models\Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->mentor_id,
            'body' => "Mentorship Request: " . $request->message,
        ]);

        return redirect()->route('mentorship.index')->with('success', 'Mentorship request sent!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:active,completed,declined']);
        
        $mentorship = Mentorship::findOrFail($id);
        
        // Only the mentor can accept/decline. Either party can complete.
        if (Auth::id() !== $mentorship->mentor_id && $request->status !== 'completed') {
            abort(403);
        }

        if ($request->status === 'completed') {
            $mentorship->update(['status' => 'completed', 'ended_at' => now()]);
        } elseif ($request->status === 'active') {
            $mentorship->update(['status' => 'active', 'responded_at' => now()]);
        } else {
            $mentorship->update(['status' => $request->status]);
        }

        return back()->with('success', 'Mentorship status updated.');
    }

    public function show($id)
    {
        $mentorship = Mentorship::with(['mentor', 'mentee', 'goals'])->findOrFail($id);

        if (Auth::id() !== $mentorship->mentor_id && Auth::id() !== $mentorship->mentee_id && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        return view('mentorship.show', compact('mentorship'));
    }
}
