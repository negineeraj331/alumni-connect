<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendance extends Model
{
    use HasFactory;

    public $timestamps = false; // only checked_in_at is used

    protected $fillable = ['event_id', 'user_id', 'checked_in_at'];

    protected $casts = [
        'checked_in_at' => 'datetime'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
