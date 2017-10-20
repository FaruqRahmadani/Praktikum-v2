<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelMateriPraktikum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Tabel_Materi_Praktikum', function (Blueprint $table) {
          $table->increments('id');
          $table->string('kode_mk', 10);
          $table->string('materi_praktikum', 50);
          $table->tinyInteger('semester');
          $table->string('gambar', 255);
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
      Schema::dropIfExists('Tabel_Materi_Praktikum');
        //
    }
}
