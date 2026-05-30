<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'content', 'visibility', 'is_flagged'];

    protected $casts = [
        'is_flagged' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
