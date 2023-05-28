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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->string('unique_id', 25)->primary();
            $table->string('name', 191);
            $table->string('no_of_tables')->nullable(true);
            $table->string('location');

            $table->string('village');
            $table->string('commune');
            $table->string('district');
            $table->string('province');

            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('unique_id')->on('users')->onDelete('cascade');

            $table->unique(['name', 'user_id']);

            $table->string('address')->virtualAs("CONCAT(COALESCE(village, ''), ', ', COALESCE(commune, ''), ', ', COALESCE(district, ''), ', ', COALESCE(province, ''))")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
