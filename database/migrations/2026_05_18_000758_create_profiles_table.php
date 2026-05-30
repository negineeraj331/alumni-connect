<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->year('graduation_year')->nullable()->index();
            $table->string('degree', 100)->nullable();
            $table->string('field_of_study')->nullable()->index();
            $table->text('bio')->nullable();
            $table->string('location')->nullable()->index();
            $table->string('phone', 20)->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('company')->nullable();
            $table->string('job_title')->nullable();
            $table->json('work_history')->nullable();
            $table->json('skills')->nullable();
            $table->boolean('mentor_availability')->default(false);
            $table->unsignedTinyInteger('mentor_capacity')->default(5);
            $table->json('mentor_industries')->nullable();
            $table->string('career_stage', 50)->nullable();
            $table->string('avatar_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
