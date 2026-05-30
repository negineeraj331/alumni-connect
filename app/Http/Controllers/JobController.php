<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('student')) {
            // Students can only see jobs from connected mentors
            $mentorIds = $user->menteeships()->active()->pluck('mentor_id');
            $jobs = JobPosting::with('user.profile')->whereIn('user_id', $mentorIds)->where('is_active', true)->latest()->paginate(10);
        } else {
            // Alumni/Mentors/Admin can see all jobs
            $jobs = JobPosting::with('user.profile')->where('is_active', true)->latest()->paginate(10);
        }

        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        if (Auth::user()->hasRole('student')) {
            abort(403, 'Students cannot post jobs.');
        }
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->hasRole('student')) {
            abort(403, 'Students cannot post jobs.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['is_active'] = true;

        JobPosting::create($validated);

        return redirect()->route('jobs.index')->with('success', 'Job posted successfully.');
    }

    public function show($id)
    {
        $job = JobPosting::with('user.profile')->findOrFail($id);
        
        // Visibility check for students
        $user = Auth::user();
        if ($user->hasRole('student')) {
            $mentorIds = $user->menteeships()->active()->pluck('mentor_id')->toArray();
            if (!in_array($job->user_id, $mentorIds)) {
                abort(403, 'You are not connected to the poster of this job.');
            }
        }

        $hasApplied = JobApplication::where('job_posting_id', $job->id)
                        ->where('user_id', $user->id)
                        ->exists();

        return view('jobs.show', compact('job', 'hasApplied'));
    }

    public function apply(Request $request, $id)
    {
        $job = JobPosting::findOrFail($id);
        $user = Auth::user();

        // Check visibility
        if ($user->hasRole('student')) {
            $mentorIds = $user->menteeships()->active()->pluck('mentor_id')->toArray();
            if (!in_array($job->user_id, $mentorIds)) {
                abort(403, 'Unauthorized.');
            }
        }

        $existing = JobApplication::where('job_posting_id', $job->id)->where('user_id', $user->id)->exists();
        if ($existing) {
            return back()->with('error', 'You have already applied for this job.');
        }

        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'cover_letter' => 'nullable|string'
        ]);

        $path = $request->file('cv')->store('cvs', 'public');

        JobApplication::create([
            'job_posting_id' => $job->id,
            'user_id' => $user->id,
            'cv_path' => $path,
            'cover_letter' => $request->cover_letter,
        ]);

        return redirect()->route('jobs.show', $job->id)->with('success', 'Your application has been submitted successfully.');
    }
}
