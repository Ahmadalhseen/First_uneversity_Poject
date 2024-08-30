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
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->unsignedBigInteger('user_id'); // ID of the user who made the payment
            $table->string('payment_method')->default("Banck_Account"); // Payment method (e.g., 'credit card', 'paypal')
            $table->decimal('amount', 10, 2); // Payment amount
            $table->timestamp('payment_date'); // Date and time of payment
            $table->string('status')->nullable(); // Status of the payment (e.g., 'completed', 'pending') // Additional remarks or information
            $table->timestamps(); // created_at and updated_at timestamps
            // Foreign key constraint for user_id (optional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_logs');
    }
};
