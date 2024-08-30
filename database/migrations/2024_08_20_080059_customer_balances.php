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
        // database/migrations/xxxx_xx_xx_create_customer_balances_table.php
Schema::create('customer_balances', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users'); // ربط الرصيد بالمستخدم
    $table->decimal('balance', 10, 2)->default(0); // رصيد الزبون
    $table->string('secret_code')->unique(); // الرقم السري
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_balances');
    }
};
