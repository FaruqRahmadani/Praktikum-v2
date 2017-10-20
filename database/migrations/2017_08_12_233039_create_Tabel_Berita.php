<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelBerita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Tabel_Berita', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_admin');
          $table->string('judul', 50);
          $table->text('konten', 255);
          $table->string('gambar', 255);
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
      Schema::dropIfExists('Tabel_Berita');
    }
}
