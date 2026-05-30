<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorshipInteraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentorship_id', 'user_id', 'type', 'content'
    ];

    public function mentorship()
    {
        return $this->belongsTo(Mentorship::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
