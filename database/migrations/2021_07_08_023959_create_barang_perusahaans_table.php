<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangPerusahaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('stok_barang');
            $table->enum('jenis_barang',['Bahan Habis Pakai', 'Peralatan', 'Kendaraan']);
            $table->enum('status_barang',['baik', 'rusak']);
            $table->string('picture_path');
            $table->unsignedBigInteger('perusahaan_id');
            $table->foreign('perusahaan_id')->references('id')->on('perusahaans')->onDelete('cascade');
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
        Schema::dropIfExists('barang_perusahaans');
    }
}
