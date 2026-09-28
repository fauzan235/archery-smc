<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->string('trx_code')->unique(); // e.g. TRX-001
            $table->foreignId('member_id')->nullable()->constrained()->nullOnDelete();
            $table->string('member_name')->nullable();
            $table->enum('type', ['masuk', 'keluar'])->default('masuk');
            $table->string('category')->default('Iuran Bulanan');
            $table->bigInteger('amount'); // in IDR
            $table->string('period')->default('September 2026');
            $table->string('payment_method')->default('Tunai'); // Tunai, QRIS, Transfer
            $table->string('status')->default('Lunas'); // Lunas, Pending, Selesai
            $table->date('date');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
