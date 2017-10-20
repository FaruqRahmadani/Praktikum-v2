<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelJadwalDosen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Tabel_Jadwal_Dosen', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_praktikum');
          $table->integer('id_dosen');
          $table->integer('id_periode');
          $table->tinyInteger('tipe')->default('0');
          $table->timestamps();
        //
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('Tabel_Jadwal_Dosen');
        //
    }
}
