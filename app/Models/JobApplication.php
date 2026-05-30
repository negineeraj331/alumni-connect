<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'job_posting_id',
        'user_id',
        'cv_path',
        'cover_letter',
        'status',
    ];

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
