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
        Schema::create('review_items', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('user_id', 10);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('review_id', 10);
            $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
            $table->string('item_id', 10);
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

            $table->integer('item_rating');
            $table->integer('quantity_rating')->nullable();
            $table->integer('quality_rating')->nullable();

            $table->text('comment')->nullable();

            $table->unique(['id', 'review_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_items');
    }
};
