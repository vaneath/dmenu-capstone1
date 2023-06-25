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
        Schema::create('reviews', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('order_id', 10);
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->string('restaurant_id', 10);
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->string('user_id', 10);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('nickname')->nullable();

            $table->double('overall_rating');
            $table->double('overall_food_rating')->nullable();
            $table->double('overall_service_rating')->nullable();
            $table->double('overall_ambience_rating')->nullable();
            $table->double('overall_price_rating')->nullable();

            $table->text('comment')->nullable();

            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();

            $table->timestamp('expires_at')->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
