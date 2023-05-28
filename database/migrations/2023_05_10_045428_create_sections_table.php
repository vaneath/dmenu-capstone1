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
        Schema::create('sections', function (Blueprint $table) {
            $table->string('unique_id', 25)->primary();
            $table->boolean('is_visible')->default(true);
            $table->string('name', 191);
            $table->integer('sort_number');
            $table->string('restaurant_id', 25);
            $table->timestamps();

            $table->foreign('restaurant_id')->references('unique_id')->on('restaurants')->onDelete('cascade');

            $table->unique(['name', 'restaurant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
