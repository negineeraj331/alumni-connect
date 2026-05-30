<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organizer_id', 'title', 'description', 'category', 'location',
        'event_date', 'end_date', 'capacity', 'status'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function attendances()
    {
        return $this->hasMany(EventAttendance::class);
    }

    // Many-to-many: registered users
    public function registeredUsers()
    {
        return $this->belongsToMany(User::class, 'event_registrations')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function isFull(): bool
    {
        return $this->capacity && $this->registrations()->where('status', 'registered')->count() >= $this->capacity;
    }

    public function spotsLeft(): ?int
    {
        return $this->capacity ? max(0, $this->capacity - $this->registrations()->where('status', 'registered')->count()) : null;
    }
}
