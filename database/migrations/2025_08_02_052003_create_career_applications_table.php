<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('career_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('availability')->nullable();
            $table->text('why_volunteer')->nullable();
            $table->string('cv_resume')->nullable();
            $table->string('academic_certificates')->nullable();
            $table->string('additional_documents')->nullable();
            $table->enum('status', ['pending', 'reviewed', 'accepted', 'rejected', 'completed'])->default('completed');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_applications');
    }
};
