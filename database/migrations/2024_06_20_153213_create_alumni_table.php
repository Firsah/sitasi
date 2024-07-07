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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('no_alumni');
            $table->string('nis');
            $table->string('nisn');
            $table->string('nama');
            $table->string('nama_panggilan');
            $table->string('kelas');
            $table->string('tahun_lulus');
            $table->string('tempat');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('alamat')->nullable();
            $table->string('ket')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
