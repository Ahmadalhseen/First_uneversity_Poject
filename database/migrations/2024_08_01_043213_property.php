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
            $table->double('area', 15, 8); // مساحة العقار
            $table->integer('bedroom'); // عدد غرف النوم
            $table->integer('bathroom'); // عدد الحمامات
            $table->string('location', 255); // موقع العقار
            $table->string('direction', 50); // اتجاه العقار (مثل الشمال، الجنوب)
            $table->string('view', 100); // نوع الإطلالة
            $table->string('condition', 100); // حالة العقار (مثل جديد، قديم)
            $table->string('grade', 50); // درجة العقار أو تصنيفه
            $table->string('main_image_url', 255);
            $table->double('sale_price', 8, 2); // رابط الصورة الرئيسية للعقار
            $table->unsignedBigInteger('user_id')->nullable(); // علاقة مع المستخدم

            // إعداد العلاقة الخارجية
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dropping the foreign key constraint first before dropping the column
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('properties');
    }
};
