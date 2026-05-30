<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorshipGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentorship_id', 'title', 'description', 'progress', 'completed_at'
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'progress' => 'integer'
    ];

    public function mentorship()
    {
        return $this->belongsTo(Mentorship::class);
    }
}
