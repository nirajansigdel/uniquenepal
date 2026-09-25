<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seo_settings', function (Blueprint $table) {
    $table->id();
    $table->string('meta_title')->nullable();
    $table->string('meta_description')->nullable();
    $table->string('meta_keywords')->nullable();

    $table->string('canonical_url')->nullable();
    $table->json('schema_json')->nullable(); 

    $table->string('heading_h1')->nullable(); 
    $table->text('image_description')->nullable();

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('se0_setting');
    }
};
