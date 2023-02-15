<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode');
            $table->unsignedBigInteger('id_kategori');
            $table->unsignedBigInteger('id_satuan');
            $table->unsignedBigInteger('id_brand');
            $table->foreign('id_kategori')->references('id')->on('kategori');
            $table->foreign('id_satuan')->references('id')->on('satuan');
            $table->foreign('id_brand')->references('id')->on('brand');
            $table->integer('stok');
            $table->integer('stok_minimal');
            $table->bigInteger('harga_beli');
            $table->bigInteger('harga_jual');
            $table->string('keterangan')->nullable();
            $table->string('lokasi')->nullable();
            $table->longText('gambar')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
};
