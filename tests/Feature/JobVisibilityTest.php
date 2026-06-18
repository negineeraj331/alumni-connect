<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\JobPosting;
use App\Models\Mentorship;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class JobVisibilityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Create basic roles
        Role::create(['name' => 'student', 'display_name' => 'Student', 'description' => 'Student']);
        Role::create(['name' => 'alumni', 'display_name' => 'Alumni', 'description' => 'Alumni']);
    }

    public function test_student_cannot_see_unconnected_jobs()
    {
        $student = User::factory()->create();
        $student->roles()->attach(Role::where('name', 'student')->first());

        $alumni = User::factory()->create();
        $alumni->roles()->attach(Role::where('name', 'alumni')->first());

        $job = JobPosting::create([
            'user_id' => $alumni->id,
            'title' => 'Software Engineer',
            'company' => 'Tech Corp',
            'location' => 'Remote',
            'description' => 'Job desc'
        ]);

        $response = $this->actingAs($student)->get('/jobs');
        $response->assertStatus(200);
        $response->assertDontSee('Software Engineer');
        $response->assertSee('No Jobs Available');

        $response = $this->actingAs($student)->get('/jobs/' . $job->id);
        $response->assertStatus(403);
    }

    public function test_student_can_see_connected_jobs_and_apply()
    {
        Storage::fake('public');

        $student = User::factory()->create();
        $student->roles()->attach(Role::where('name', 'student')->first());

        $alumni = User::factory()->create();
        $alumni->roles()->attach(Role::where('name', 'alumni')->first());

        // Establish connection
        Mentorship::create([
            'mentor_id' => $alumni->id,
            'mentee_id' => $student->id,
            'status' => 'active'
        ]);

        $job = JobPosting::create([
            'user_id' => $alumni->id,
            'title' => 'Frontend Developer',
            'company' => 'Web Inc',
            'location' => 'NY',
            'description' => 'Job desc'
        ]);

        $response = $this->actingAs($student)->get('/jobs');
        $response->assertStatus(200);
        $response->assertSee('Frontend Developer');

        $response = $this->actingAs($student)->get('/jobs/' . $job->id);
        $response->assertStatus(200);
        $response->assertSee('Frontend Developer');

        // Apply for the job
        $file = UploadedFile::fake()->create('resume.pdf', 1000, 'application/pdf');
        $response = $this->actingAs($student)->post('/jobs/' . $job->id . '/apply', [
            'cv' => $file,
            'cover_letter' => 'I would love to work here.'
        ]);

        $response->assertRedirect('/jobs/' . $job->id);
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('job_applications', [
            'job_posting_id' => $job->id,
            'user_id' => $student->id
        ]);
    }

    public function test_alumni_can_post_jobs()
    {
        $alumni = User::factory()->create();
        $alumni->roles()->attach(Role::where('name', 'alumni')->first());

        $response = $this->actingAs($alumni)->post('/jobs', [
            'title' => 'Backend Engineer',
            'company' => 'Server Co',
            'location' => 'SF',
            'description' => 'Backend job desc'
        ]);

        $response->assertRedirect('/jobs');
        $this->assertDatabaseHas('job_postings', [
            'title' => 'Backend Engineer',
            'user_id' => $alumni->id
        ]);
    }
}
