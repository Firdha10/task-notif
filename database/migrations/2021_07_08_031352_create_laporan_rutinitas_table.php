<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanRutinitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_rutinitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rutinitas_id');
            $table->foreign('rutinitas_id')->references('id')->on('rutinitas')->onDelete('cascade');
            $table->text('keterangan');
            $table->text('picturePath');
            $table->enum('status_laporan',['dikerjakan', 'selesai', 'revisi']);
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
        Schema::dropIfExists('laporan_rutinitas');
    }
}
