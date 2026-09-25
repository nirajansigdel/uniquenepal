<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userdetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            
            // Personal Information (matching frontend form)
            $table->string('name'); // Changed from full_name to match form
            $table->string('phone_no');
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('whatsapp_no')->nullable(); // Added to match form
            
            // Document Upload (matching frontend form)
            $table->string('document_proof')->nullable(); // Citizenship ID, License, etc.
            
            // Additional fields for comprehensive user details
            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport_number')->nullable();
            $table->date('passport_expiry')->nullable();
            
            // Emergency Contact
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            
            // Medical Information
            $table->text('medical_conditions')->nullable();
            $table->text('allergies')->nullable();
            $table->text('medications')->nullable();
            
            // Travel Preferences
            $table->text('dietary_restrictions')->nullable();
            $table->text('special_requirements')->nullable();
            $table->string('preferred_accommodation')->nullable();
            
            // Additional Document Upload
            $table->string('passport_copy')->nullable();
            
            // Application Status
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->text('admin_notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userdetails');
    }
};
