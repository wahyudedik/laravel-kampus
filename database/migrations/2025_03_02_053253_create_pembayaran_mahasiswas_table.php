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
        Schema::create('pembayaran_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_mahasiswa');
            $table->string('nim');
            $table->string('jenis_pembayaran');
            $table->date('tanggal_pembayaran');
            $table->decimal('jumlah_pembayaran', 10, 2);
            $table->string('bukti_pembayaran');
            $table->boolean('status_pembayaran')->default(true);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_mahasiswas');
    }
};
