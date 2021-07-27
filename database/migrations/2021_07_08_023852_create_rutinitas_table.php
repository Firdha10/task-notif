<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutinitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutinitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_rutinitas');
            $table->integer('stat');
            $table->time('jam');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->unsignedBigInteger('member_perusahaan_id');
            $table->foreign('member_perusahaan_id')->references('id')->on('member_perusahaans')->onDelete('cascade');
            $table->enum('status_rutinitas',['dikerjakan','selesai']);
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
        Schema::dropIfExists('rutinitas');
    }
}
