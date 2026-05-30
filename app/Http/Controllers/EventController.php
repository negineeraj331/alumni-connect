<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\EventAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::where('status', 'active')
            ->orderBy('event_date', 'asc');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $events = $query->paginate(10);
        
        $myRegistrations = Auth::user()->registeredEvents()->pluck('events.id')->toArray();

        return view('events.index', compact('events', 'myRegistrations'));
    }

    public function create()
    {
        if (!Auth::user()->hasRole('organizer') && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }
        return view('events.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('organizer') && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'capacity' => 'nullable|integer|min:1',
            'category' => 'required|in:workshop,networking,panel,social',
            'status' => 'required|in:active,completed,cancelled',
        ]);

        $validated['organizer_id'] = Auth::id();

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        
        if (!Auth::user()->hasRole('admin') && Auth::id() !== $event->organizer_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        if (!Auth::user()->hasRole('admin') && Auth::id() !== $event->organizer_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'capacity' => 'nullable|integer|min:1',
            'category' => 'required|in:workshop,networking,panel,social',
            'status' => 'required|in:active,completed,cancelled',
        ]);

        $event->update($validated);

        return redirect()->route('events.show', $event->id)->with('success', 'Event updated successfully.');
    }

    public function show($id)
    {
        $event = Event::with('organizer')->findOrFail($id);
        $user = Auth::user();
        
        $registration = EventRegistration::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->first();

        $attendees = [];
        if ($user->hasRole('organizer') || $user->hasRole('admin')) {
            $attendees = EventRegistration::with('user')->where('event_id', $event->id)->get();
        }

        return view('events.show', compact('event', 'registration', 'attendees'));
    }

    public function rsvp(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $user = Auth::user();

        if ($event->status !== 'active') {
            return back()->with('error', 'This event is no longer accepting RSVPs.');
        }

        $existing = EventRegistration::where('event_id', $event->id)->where('user_id', $user->id)->first();

        if ($request->action === 'register') {
            if ($existing) {
                return back()->with('error', 'You are already registered.');
            }
            if ($event->isFull()) {
                return back()->with('error', 'Sorry, this event is at full capacity.');
            }
            EventRegistration::create([
                'event_id' => $event->id,
                'user_id' => $user->id,
                'status' => 'registered'
            ]);
            return back()->with('success', 'Successfully RSVP\'d for the event!');
        } elseif ($request->action === 'cancel') {
            if ($existing) {
                $existing->update(['status' => 'cancelled']);
                return back()->with('success', 'Your RSVP has been cancelled.');
            }
        }

        return back();
    }
}
