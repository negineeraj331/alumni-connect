<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flagged_contents', function (Blueprint $table) {
            $table->id();
            $table->string('content_type', 50);
            $table->unsignedBigInteger('content_id');
            $table->foreignId('reported_by')->constrained('users')->cascadeOnDelete();
            $table->text('reason');
            $table->enum('status', ['pending', 'resolved', 'dismissed'])->default('pending')->index();
            $table->foreignId('resolved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
            
            $table->index(['content_type', 'content_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flagged_contents');
    }
};
