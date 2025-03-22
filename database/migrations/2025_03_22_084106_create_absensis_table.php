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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->string('mata_kuliah');
            $table->string('kode_kelas');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruangan');
            $table->string('dosen_pengajar');
            $table->string('pertemuan');
            $table->text('materi_perkuliahan')->nullable();
            $table->timestamps();
        });

        // Tabel pivot untuk menyimpan kehadiran mahasiswa
        Schema::create('absensi_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('absensi_id')->constrained()->onDelete('cascade');
            $table->string('nim');
            $table->string('nama_mahasiswa');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpa']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_mahasiswa');
        Schema::dropIfExists('absensis');
    }
};
