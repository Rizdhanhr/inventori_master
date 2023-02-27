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
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('no_trx');
            $table->unsignedBigInteger('id_pelanggan')->nullable();
            $table->dateTime('tgl_keluar');
            $table->foreign('id_pelanggan')->references('id')->on('pelanggan');
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->string('keterangan');
            $table->integer('surat')->default(0);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};
