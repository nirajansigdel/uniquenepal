<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('navigate_items', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->boolean('show_everest')->default(false);
            $table->boolean('show_annapurna')->default(false);
            $table->boolean('show_langtang')->default(false);
            $table->boolean('show_poonhill')->default(false);
            $table->boolean('show_adventure')->default(false);
            $table->boolean('show_activities')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigate_items');
    }
};


