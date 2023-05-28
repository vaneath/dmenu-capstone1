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
            $table->string('id', 25)->primary();
            $table->boolean('is_available')->default(true);
            $table->string('img_url');
            $table->string('name', 191);
            $table->string('description');
            $table->double('price');
            $table->double('weight');
            $table->integer('sort_number');
            $table->double('discount_price')->nullable(true);
            $table->string('category_id', 25);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unique(['name', 'category_id']);
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
