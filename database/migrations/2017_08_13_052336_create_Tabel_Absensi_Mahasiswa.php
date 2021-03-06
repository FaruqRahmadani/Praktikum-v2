<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelAbsensiMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Tabel_Absensi_Mahasiswa', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_mahasiswa');
          $table->integer('id_jadwal_praktikum');
          $table->tinyInteger('status')->default(1);
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
      Schema::dropIfExists('Tabel_Absensi_Mahasiswa');
        //
    }
}
