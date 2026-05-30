<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'student',
                'display_name' => 'Student',
                'description' => 'Current student at the institution.',
            ],
            [
                'name' => 'alumni',
                'display_name' => 'Alumni',
                'description' => 'Graduated from the institution.',
            ],
            [
                'name' => 'mentor',
                'display_name' => 'Mentor',
                'description' => 'Provides mentorship to students and alumni.',
            ],
            [
                'name' => 'faculty',
                'display_name' => 'Faculty',
                'description' => 'Institutional staff providing mentorship and teaching.',
            ],
            [
                'name' => 'organizer',
                'display_name' => 'Event Organizer',
                'description' => 'Can create and manage events.',
            ],
            [
                'name' => 'admin',
                'display_name' => 'Super Admin',
                'description' => 'Full access to all platform features and moderation.',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
