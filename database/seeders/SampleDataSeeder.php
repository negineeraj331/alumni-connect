<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Profile;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');

        // Roles
        $adminRole = Role::where('name', 'admin')->first();
        $alumniRole = Role::where('name', 'alumni')->first();
        $studentRole = Role::where('name', 'student')->first();
        $mentorRole = Role::where('name', 'mentor')->first();
        $facultyRole = Role::where('name', 'faculty')->first();
        $organizerRole = Role::where('name', 'organizer')->first();

        // 1. Admin
        $admin = User::create(['name' => 'Admin User', 'email' => 'admin@alumni.test', 'password' => $password, 'is_active' => true]);
        $admin->roles()->attach($adminRole->id);
        Profile::create(['user_id' => $admin->id, 'location' => 'New York']);

        // 2. Alumni
        $alumni = User::create(['name' => 'Alumni User', 'email' => 'alumni@alumni.test', 'password' => $password, 'is_active' => true]);
        $alumni->roles()->attach($alumniRole->id);
        Profile::create(['user_id' => $alumni->id, 'graduation_year' => 2020, 'degree' => 'B.S.', 'field_of_study' => 'Computer Science', 'location' => 'San Francisco']);

        // 3. Student
        $student = User::create(['name' => 'Student User', 'email' => 'student@alumni.test', 'password' => $password, 'is_active' => true]);
        $student->roles()->attach($studentRole->id);
        Profile::create(['user_id' => $student->id, 'field_of_study' => 'Computer Science', 'location' => 'Chicago']);

        // 4. Mentor
        $mentor = User::create(['name' => 'Mentor User', 'email' => 'mentor@alumni.test', 'password' => $password, 'is_active' => true]);
        $mentor->roles()->attach($mentorRole->id);
        Profile::create(['user_id' => $mentor->id, 'mentor_availability' => true, 'mentor_industries' => ['Tech', 'Education'], 'location' => 'Austin']);

        // 5. Organizer
        $organizer = User::create(['name' => 'Organizer User', 'email' => 'organizer@alumni.test', 'password' => $password, 'is_active' => true]);
        $organizer->roles()->attach($organizerRole->id);
        Profile::create(['user_id' => $organizer->id, 'location' => 'Seattle']);

        // 6. Alumni + Mentor
        $alumniMentor = User::create(['name' => 'Alumni Mentor', 'email' => 'alumnimentor@alumni.test', 'password' => $password, 'is_active' => true]);
        $alumniMentor->roles()->attach([$alumniRole->id, $mentorRole->id]);
        Profile::create(['user_id' => $alumniMentor->id, 'graduation_year' => 2015, 'mentor_availability' => true, 'mentor_industries' => ['Finance', 'Tech'], 'location' => 'Boston']);

        // 7. Alumni + Organizer
        $alumniOrg = User::create(['name' => 'Alumni Org', 'email' => 'alumniorg@alumni.test', 'password' => $password, 'is_active' => true]);
        $alumniOrg->roles()->attach([$alumniRole->id, $organizerRole->id]);
        Profile::create(['user_id' => $alumniOrg->id, 'graduation_year' => 2018, 'location' => 'Denver']);

        // 8. Faculty
        $faculty = User::create(['name' => 'Faculty User', 'email' => 'faculty@alumni.test', 'password' => $password, 'is_active' => true]);
        $faculty->roles()->attach($facultyRole->id);
        Profile::create(['user_id' => $faculty->id, 'location' => 'University Campus', 'mentor_availability' => true, 'mentor_industries' => ['Academia']]);

        // We can add more random users here, but these 7 are enough to test all roles.
    }
}
