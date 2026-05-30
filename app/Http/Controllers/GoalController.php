<?php

namespace App\Http\Controllers;

use App\Models\Mentorship;
use App\Models\MentorshipGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function store(Request $request, $mentorshipId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $mentorship = Mentorship::findOrFail($mentorshipId);

        // Ensure user is part of the mentorship
        if (Auth::id() !== $mentorship->mentor_id && Auth::id() !== $mentorship->mentee_id) {
            abort(403);
        }

        MentorshipGoal::create([
            'mentorship_id' => $mentorshipId,
            'title' => $request->title,
            'description' => $request->description,
            'progress' => 0
        ]);

        return back()->with('success', 'Goal added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['progress' => 'required|integer|min:0|max:100']);

        $goal = MentorshipGoal::with('mentorship')->findOrFail($id);

        if (Auth::id() !== $goal->mentorship->mentor_id && Auth::id() !== $goal->mentorship->mentee_id) {
            abort(403);
        }

        $data = ['progress' => $request->progress];
        if ($request->progress == 100) {
            $data['completed_at'] = now();
        } else {
            $data['completed_at'] = null;
        }

        $goal->update($data);

        return back()->with('success', 'Goal progress updated.');
    }
}
