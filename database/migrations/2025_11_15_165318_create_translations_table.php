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
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->morphs('translatable'); // Creates translatable_id and translatable_type
            $table->string('locale', 10); // Language code (en, es, etc.)
            $table->string('field_name'); // Field name (heading, content, title, etc.)
            $table->text('value')->nullable(); // Translated value
            $table->timestamps();

            // Indexes for better performance (using shorter names to avoid MySQL 64 char limit)
            $table->index(['translatable_type', 'translatable_id', 'locale', 'field_name'], 'trans_idx');
            $table->unique(['translatable_type', 'translatable_id', 'locale', 'field_name'], 'trans_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
