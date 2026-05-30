<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlaggedContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_type', 'content_id', 'reported_by', 
        'reason', 'status', 'resolved_by', 'resolved_at'
    ];

    protected $casts = [
        'resolved_at' => 'datetime'
    ];

    public function content()
    {
        return $this->morphTo();
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function resolver()
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }
}
