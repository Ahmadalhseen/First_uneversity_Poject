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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->double('lot_rea', 15, 8);
            $table->integer('overall_qual');
            $table->double('sale_price', 15, 8);
            $table->integer('totrms_abvgrd');
            $table->integer('full_bath');
            $table->date('year_built');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {


        Schema::dropIfExists('properties');

    }
};
