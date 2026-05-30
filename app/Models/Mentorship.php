<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mentorship extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'mentor_id', 'mentee_id', 'status', 'request_message', 
        'responded_at', 'ended_at'
    ];

    protected $casts = [
        'responded_at' => 'datetime',
        'ended_at' => 'datetime'
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_id');
    }

    public function goals()
    {
        return $this->hasMany(MentorshipGoal::class);
    }

    public function interactions()
    {
        return $this->hasMany(MentorshipInteraction::class);
    }

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function scopePending($q)
    {
        return $q->where('status', 'pending');
    }
}
