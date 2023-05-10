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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_visible')->default(true);
            $table->boolean('is_available')->default(true);
            $table->string('img_url');
            $table->string('name')->unique();
            $table->string('description');
            $table->double('price');
            $table->double('old_price')->nullable(true);
            $table->double('weight');
            $table->integer('sort_number');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
