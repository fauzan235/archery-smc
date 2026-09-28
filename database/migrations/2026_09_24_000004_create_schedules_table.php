<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day_code'); // Sel, Kam, Sab, Min
            $table->string('day_name'); // Selasa, Kamis, Sabtu, Minggu
            $table->string('date_num'); // 24, 26, 28
            $table->date('date');
            $table->string('time'); // e.g. 15:30 - 17:30 WIB
            $table->string('title');
            $table->string('category')->default('all'); // recurve, compound, all
            $table->string('category_label')->default('Semua Kategori');
            $table->string('location');
            $table->string('coach');
            $table->text('description')->nullable();
            $table->string('status')->default('Mendatang'); // Berlangsung, Mendatang, Selesai
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
