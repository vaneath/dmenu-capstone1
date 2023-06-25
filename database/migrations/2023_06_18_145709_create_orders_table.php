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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('user_id');
            $table->string('restaurant_id');
            $table->string('payment_status')->default('pending');
            $table->string('invoice_qr');
            $table->integer('table_no')->nullable();
            $table->double('total');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');

            $table->timestamp('order_at')->nullable()->default(null);

            $table->timestamp('review_expires_at')->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }

    /**
     * Belong to a restaurant.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
};
