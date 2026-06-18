<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Profile;

class SampleDataSeeder extends Seeder
{
    /**
     * Idempotent: safe to run on every deploy. Creates one demo account per role
     * (and a couple of multi-role accounts) so every role can be exercised.
     * Password for all demo accounts is "password".
     */
    public function run(): void
    {
        $password = Hash::make('password');

        $roleId = fn (string $name) => Role::where('name', $name)->value('id');

        $accounts = [
            ['name' => 'Admin User',     'email' => 'admin@alumni.test',       'roles' => ['admin'],               'profile' => ['location' => 'New York']],
            ['name' => 'Alumni User',    'email' => 'alumni@alumni.test',      'roles' => ['alumni'],              'profile' => ['graduation_year' => 2020, 'degree' => 'B.S.', 'field_of_study' => 'Computer Science', 'location' => 'San Francisco']],
            ['name' => 'Student User',   'email' => 'student@alumni.test',     'roles' => ['student'],             'profile' => ['field_of_study' => 'Computer Science', 'location' => 'Chicago']],
            ['name' => 'Mentor User',    'email' => 'mentor@alumni.test',      'roles' => ['mentor'],              'profile' => ['mentor_availability' => true, 'mentor_industries' => ['Tech', 'Education'], 'location' => 'Austin']],
            ['name' => 'Organizer User', 'email' => 'organizer@alumni.test',   'roles' => ['organizer'],           'profile' => ['location' => 'Seattle']],
            ['name' => 'Faculty User',   'email' => 'faculty@alumni.test',     'roles' => ['faculty'],             'profile' => ['location' => 'University Campus', 'mentor_availability' => true, 'mentor_industries' => ['Academia']]],
            ['name' => 'Alumni Mentor',  'email' => 'alumnimentor@alumni.test', 'roles' => ['alumni', 'mentor'],   'profile' => ['graduation_year' => 2015, 'mentor_availability' => true, 'mentor_industries' => ['Finance', 'Tech'], 'location' => 'Boston']],
            ['name' => 'Alumni Org',     'email' => 'alumniorg@alumni.test',   'roles' => ['alumni', 'organizer'], 'profile' => ['graduation_year' => 2018, 'location' => 'Denver']],
        ];

        foreach ($accounts as $account) {
            $user = User::firstOrCreate(
                ['email' => $account['email']],
                ['name' => $account['name'], 'password' => $password, 'is_active' => true]
            );

            // Only wire up roles/profile on first creation so re-runs don't
            // duplicate pivot rows or hit the unique profile constraint.
            if ($user->wasRecentlyCreated) {
                $roleIds = array_filter(array_map($roleId, $account['roles']));
                if ($roleIds) {
                    $user->roles()->attach($roleIds);
                }
                Profile::create(array_merge(['user_id' => $user->id], $account['profile']));
            }
        }
    }
}
