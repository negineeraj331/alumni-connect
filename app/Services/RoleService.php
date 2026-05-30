<?php

namespace App\Services;

class RoleService
{
    private const ALLOWED_COMBINATIONS = [
        ['student'],
        ['alumni'],
        ['mentor'],
        ['organizer'],
        ['admin'],
        ['alumni', 'mentor'],
        ['alumni', 'organizer'],
        ['mentor', 'organizer'],
        ['alumni', 'mentor', 'organizer'],
        ['faculty'],
    ];

    /**
     * Validate if the given array of role names is a permitted combination.
     *
     * @param array $roles
     * @return bool
     */
    public function validateCombination(array $roles): bool
    {
        if (empty($roles)) {
            return false;
        }

        // Students cannot hold any other roles simultaneously
        if (in_array('student', $roles) && count($roles) > 1) {
            return false;
        }

        // Admins shouldn't be stacked with regular roles for security clarity
        if (in_array('admin', $roles) && count($roles) > 1) {
            return false;
        }

        sort($roles);

        foreach (self::ALLOWED_COMBINATIONS as $combo) {
            sort($combo);
            if ($combo === $roles) {
                return true;
            }
        }

        return false;
    }
}
