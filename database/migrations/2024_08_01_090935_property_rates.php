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
        Schema::create('property_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('max_rate');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('user_id');
            $table->string('comment', 100);
            $table->timestamps();

            // Adding foreign key constraints
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_rates');
    }
};
