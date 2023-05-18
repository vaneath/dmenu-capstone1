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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_visible')->default(true);
            $table->string('img_url');
            $table->string('name');
            $table->integer('sort_number');
            $table->unsignedBigInteger('section_id');
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');

            $table->unique(['name', 'section_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
