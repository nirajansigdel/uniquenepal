<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // Make existing columns fully optional (nullable)
            $table->foreignId('country_id')->nullable()->change();

            $table->string('heading')->nullable()->change();
            $table->string('subtitle')->nullable()->change();
            $table->date('date')->nullable()->change();
            $table->string('duration')->nullable()->change();
            $table->integer('people')->nullable()->change();
            $table->string('package')->nullable()->change();

            $table->decimal('original_price', 10, 2)->nullable()->change();
            $table->decimal('discounted_price', 10, 2)->nullable()->change();

            $table->string('location')->nullable()->change();
            $table->string('transportation')->nullable()->change();
            $table->text('content')->nullable()->change();

            $table->json('includes')->nullable()->change();        // unlimited
            $table->string('image')->nullable()->change();
            $table->json('images')->nullable()->change();
            $table->json('product_types')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // Revert back if needed
            $table->foreignId('country_id')->nullable(false)->change();

            $table->string('heading')->nullable(false)->change();
            $table->string('subtitle')->nullable(false)->change();
            $table->date('date')->nullable(false)->change();
            $table->string('duration')->nullable(false)->change();
            $table->integer('people')->nullable(false)->change();
            $table->string('package')->nullable(false)->change();

            $table->decimal('original_price', 10, 2)->nullable(false)->change();
            $table->decimal('discounted_price', 10, 2)->nullable(false)->change();

            $table->string('location')->nullable(false)->change();
            $table->string('transportation')->nullable(false)->change();
            $table->text('content')->nullable(false)->change();

            $table->json('includes')->nullable(false)->change();
            $table->string('image')->nullable(false)->change();
            $table->json('images')->nullable(false)->change();
            $table->json('product_types')->nullable(false)->change();
        });
    }
};
