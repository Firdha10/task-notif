<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_perusahaan_id');
            $table->foreign('barang_perusahaan_id')->references('id')->on('barang_perusahaans')->onDelete('cascade');
            $table->unsignedBigInteger('transaksi_barang_id');
            $table->foreign('transaksi_barang_id')->references('id')->on('transaksi_barangs')->onDelete('cascade');
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
        Schema::dropIfExists('barang_projects');
    }
}
