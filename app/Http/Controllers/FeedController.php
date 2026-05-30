<?php

namespace App\Http\Controllers;

use App\Models\ActivityPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get posts based on visibility rules
        $query = ActivityPost::with('user.roles')
            ->where('is_flagged', false)
            ->orderBy('created_at', 'desc');

        if (!$user->hasRole('admin')) {
            $isAlumni = $user->hasRole('alumni');
            $query->where(function($q) use ($user, $isAlumni) {
                // All / public posts
                $q->where('visibility', 'all');
                // Alumni only posts (if user is alumni or mentor)
                if ($isAlumni || $user->hasRole('mentor')) {
                    $q->orWhere('visibility', 'alumni_only');
                }
                // Author's own posts
                $q->orWhere('user_id', $user->id);
            });
        }

        $posts = $query->paginate(15);

        return view('feed.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:2000',
            'visibility' => 'required|in:all,alumni_only,mentors_only'
        ]);

        ActivityPost::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'visibility' => $request->visibility
        ]);

        return back()->with('success', 'Post published successfully!');
    }
}
