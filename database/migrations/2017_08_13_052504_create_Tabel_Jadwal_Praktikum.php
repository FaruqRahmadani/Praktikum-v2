<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelJadwalPraktikum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Tabel_Jadwal_Praktikum', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_jadwal_dosen');
          $table->integer('pertemuan');
          $table->string('nama_kelas', 50);
          $table->string('ruangan', 50);
          $table->date('tanggal');
          $table->time('waktu_mulai');
          $table->time('waktu_selesai');
          $table->tinyInteger('tipe')->default('1');
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
      Schema::dropIfExists('Tabel_Jadwal_Praktikum');
        //
    }
}
