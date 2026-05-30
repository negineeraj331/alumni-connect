<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_assignments')
            ->withPivot('assigned_at', 'assigned_by');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function mentorships()
    {
        return $this->hasMany(Mentorship::class, 'mentor_id');
    }

    public function menteeships()
    {
        return $this->hasMany(Mentorship::class, 'mentee_id');
    }

    public function organizedEvents()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function activityPosts()
    {
        return $this->hasMany(ActivityPost::class);
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    public function postedJobs()
    {
        return $this->hasMany(JobPosting::class, 'user_id');
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    // Many-to-many: events user is registered for
    public function registeredEvents()
    {
        return $this->belongsToMany(Event::class, 'event_registrations')
            ->withPivot('status')
            ->withTimestamps();
    }

    // Role helpers
    public function hasRole(string $role): bool
    {
        return $this->roles->contains('name', $role);
    }

    public function hasAnyRole(array $roles): bool
    {
        return $this->roles->whereIn('name', $roles)->isNotEmpty();
    }

    public function primaryRole(): string
    {
        return $this->roles->first()?->name ?? 'alumni';
    }
}
