<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('member_code')->unique(); // e.g. SAC-001
            $table->string('name');
            $table->string('nisn')->nullable();
            $table->string('class'); // X, XI, XII
            $table->string('major')->nullable(); // RPL, TKJ, AKL, OTKP, BDP, dll
            $table->string('division'); // Recurve, Compound, Standard Bow, Barebow
            $table->string('role')->default('Anggota'); // Ketua Klub, Wakil Ketua, Sekretaris, Bendahara, Anggota, Alumni
            $table->string('phone')->nullable();
            $table->string('status')->default('Aktif'); // Aktif, Non-Aktif, Alumni
            $table->string('dues_status')->default('Belum Lunas'); // Lunas, Belum Lunas
            $table->integer('attendance_rate')->default(100);
            $table->string('avatar')->nullable();
            $table->date('join_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
