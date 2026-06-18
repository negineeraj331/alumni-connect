<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityPost;
use App\Models\FlaggedContent;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'active_mentorships' => \App\Models\Mentorship::where('status', 'active')->count(),
            'upcoming_events' => \App\Models\Event::where('status', 'active')->where('event_date', '>=', now())->count(),
            'pending_flags' => FlaggedContent::where('status', 'pending')->count(),
        ];

        $recentLogs = AuditLog::with('user')->orderBy('created_at', 'desc')->take(10)->get();

        return view('admin.index', compact('stats', 'recentLogs'));
    }

    public function users(Request $request)
    {
        $query = User::with('roles');

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
        }

        $users = $query->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->hasRole('admin') && User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->count() <= 1 && $user->is_active) {
            return back()->with('error', 'Cannot deactivate the only active admin.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        AuditLog::record($user->is_active ? 'activated_user' : 'deactivated_user', $user);

        return back()->with('success', 'User status updated successfully.');
    }

    public function moderation()
    {
        // Get all flagged content (posts, messages, etc)
        $flags = FlaggedContent::with(['reporter', 'content'])
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Also get all posts just for simple moderation viewing if needed
        $posts = ActivityPost::with('user')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.moderation', compact('flags', 'posts'));
    }

    public function resolveFlag(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:ignore,delete_content',
        ]);

        $flag = FlaggedContent::findOrFail($id);

        if ($request->action === 'delete_content') {
            if ($flag->content) {
                $flag->content->delete(); // Soft deletes the post/message
            }
        }

        $flag->update([
            'status' => 'resolved',
            'resolved_by' => auth()->id(),
            'resolved_at' => now(),
        ]);

        AuditLog::record('resolved_flag', $flag, [], ['action_taken' => $request->action]);

        return back()->with('success', 'Content moderation applied.');
    }
}
