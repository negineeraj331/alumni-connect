<?php

namespace App\Services;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class MentorMatchingService
{
    /**
     * Find mentors based on mentee's field of study or preferences
     *
     * @param User $mentee
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findMatches(User $mentee)
    {
        $menteeProfile = $mentee->profile;
        $fieldOfStudy = $menteeProfile?->field_of_study;

        // Base query: Active users with mentor role who have mentor_availability = true
        $query = User::with('profile')->where('is_active', true)
            ->whereHas('roles', function (Builder $query) {
                $query->where('name', 'mentor');
            })
            ->whereHas('profile', function (Builder $query) {
                $query->where('mentor_availability', true);
            });

        // If mentee has a field of study, try to match by industry or field
        if ($fieldOfStudy) {
            $query->orderByRaw(
                "CASE 
                    WHEN (SELECT field_of_study FROM profiles WHERE profiles.user_id = users.id) LIKE ? THEN 1 
                    ELSE 2 
                END ASC", 
                ["%{$fieldOfStudy}%"]
            );
        }

        // Limit matches to 10 for performance
        return $query->take(10)->get();
    }
}
