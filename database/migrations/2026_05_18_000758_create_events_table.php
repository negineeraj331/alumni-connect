<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizer_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category', 100)->nullable()->index();
            $table->string('location')->nullable();
            $table->dateTime('event_date')->index();
            $table->dateTime('end_date')->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->enum('status', ['active', 'cancelled', 'completed'])->default('active')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
