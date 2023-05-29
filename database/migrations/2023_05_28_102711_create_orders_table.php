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
            $table->string('id', 25)->primary();
            $table->string('restaurant_id');

            $table->string('passphrase', 191)->nullable(true);
            $table->string('email', 191)->nullable(true);
            $table->string('phone', 191)->nullable(true);

            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->integer('table_no')->nullable(true);
            $table->boolean('is_paid')->default(false);
            try{
                $table->enum('status', ['pending', 'accepted', 'rejected', 'cooking', 'ready',  'delivered']);  
            } catch (\Exception $e) {
                $table->string('status')->default('pending');
                Log::error('Error creating enum column: ' . $e->getMessage());
            }
            $table->timestamp('order_at')->default(now());
            $table->timestamp('paid_at')->nullable(true);
            $table->double('tax')->nullable(true);

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
};
