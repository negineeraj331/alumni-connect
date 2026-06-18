<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed roles and sample users so role-based access can be exercised.
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    private function getRoleUser($roleName)
    {
        return User::whereHas('roles', function($q) use ($roleName) {
            $q->where('name', $roleName);
        })->first();
    }

    public function test_admin_access()
    {
        $admin = $this->getRoleUser('admin');
        if (!$admin) { $this->markTestSkipped(); }

        $this->actingAs($admin)->get('/dashboard')->assertStatus(200);
        $this->actingAs($admin)->get('/admin')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/users')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/moderation')->assertStatus(200);
        
        $this->actingAs($admin)->get('/profiles')->assertStatus(200);
        $this->actingAs($admin)->get('/events')->assertStatus(200);
        $this->actingAs($admin)->get('/feed')->assertStatus(200);
    }

    public function test_alumni_access()
    {
        $alumni = $this->getRoleUser('alumni');
        if (!$alumni) { $this->markTestSkipped(); }

        $this->actingAs($alumni)->get('/dashboard')->assertStatus(200);
        $this->actingAs($alumni)->get('/admin')->assertStatus(403);
        
        $this->actingAs($alumni)->get('/profiles')->assertStatus(200);
        $this->actingAs($alumni)->get('/events')->assertStatus(200);
        $this->actingAs($alumni)->get('/feed')->assertStatus(200);
        $this->actingAs($alumni)->get('/mentorships')->assertStatus(200);
        $this->actingAs($alumni)->get('/messages')->assertStatus(200);
    }

    public function test_student_access()
    {
        $student = $this->getRoleUser('student');
        if (!$student) { $this->markTestSkipped(); }

        $this->actingAs($student)->get('/dashboard')->assertStatus(200);
        $this->actingAs($student)->get('/admin')->assertStatus(403);
        
        $this->actingAs($student)->get('/profiles')->assertStatus(200);
        $this->actingAs($student)->get('/events')->assertStatus(200);
        $this->actingAs($student)->get('/feed')->assertStatus(200);
        $this->actingAs($student)->get('/mentorships')->assertStatus(200);
        $this->actingAs($student)->get('/messages')->assertStatus(200);
    }

    public function test_mentor_access()
    {
        $mentor = $this->getRoleUser('mentor');
        if (!$mentor) { $this->markTestSkipped(); }

        $this->actingAs($mentor)->get('/dashboard')->assertStatus(200);
        $this->actingAs($mentor)->get('/mentorships')->assertStatus(200);
        $this->actingAs($mentor)->get('/profiles')->assertStatus(200);
    }

    public function test_organizer_access()
    {
        $organizer = $this->getRoleUser('organizer');
        if (!$organizer) { $this->markTestSkipped(); }

        $this->actingAs($organizer)->get('/dashboard')->assertStatus(200);
        $this->actingAs($organizer)->get('/events')->assertStatus(200);
        $this->actingAs($organizer)->get('/events/create')->assertStatus(200);
    }
}
