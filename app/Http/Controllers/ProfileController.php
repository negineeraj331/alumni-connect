<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['profile', 'roles'])->where('is_active', true);

        // Apply Search/Filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('profile', function($pq) use ($search) {
                      $pq->where('location', 'like', "%{$search}%")
                         ->orWhere('company', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('graduation_year')) {
            $query->whereHas('profile', function($q) use ($request) {
                $q->where('graduation_year', $request->graduation_year);
            });
        }

        if ($request->filled('field_of_study')) {
            $query->whereHas('profile', function($q) use ($request) {
                $q->where('field_of_study', 'like', "%{$request->field_of_study}%");
            });
        }

        if ($request->filled('role')) {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        $users = $query->paginate(20)->withQueryString();

        return view('profiles.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with(['profile', 'roles'])->findOrFail($id);
        
        if (!$user->is_active) {
            abort(404, 'User not found or inactive.');
        }

        return view('profiles.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('profile')->findOrFail($id);

        if (auth()->id() !== $user->id && !auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        return view('profiles.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if (auth()->id() !== $user->id && !auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|integer',
            'field_of_study' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->update(['name' => $validated['name']]);
        unset($validated['name']);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('profiles/avatars', 'public');
            $validated['avatar_path'] = $path;
        }
        unset($validated['avatar']);

        if ($user->profile) {
            $user->profile->update($validated);
        } else {
            $user->profile()->create($validated);
        }

        return redirect()->route('profiles.show', $user->id)->with('success', 'Profile updated successfully.');
    }
}
