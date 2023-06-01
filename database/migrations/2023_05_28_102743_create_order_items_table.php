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
        Schema::create('order_items', function (Blueprint $table) {
            $table->string('id', 25)->primary();
            $table->string('order_id', 25);
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->string('item_id', 25);
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            
            $table->integer('quantity');

            $table->double('discount_amount')->nullable(true);
            $table->double('tax_deduction')->nullable(true);
            $table->double('amount');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
