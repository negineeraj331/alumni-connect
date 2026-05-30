<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'graduation_year', 'degree', 'field_of_study', 'bio',
        'location', 'phone', 'linkedin_url', 'company', 'job_title',
        'work_history', 'skills', 'mentor_availability', 'mentor_capacity',
        'mentor_industries', 'career_stage', 'avatar_path',
    ];

    protected $casts = [
        'work_history' => 'array',
        'skills' => 'array',
        'mentor_industries' => 'array',
        'mentor_availability' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
