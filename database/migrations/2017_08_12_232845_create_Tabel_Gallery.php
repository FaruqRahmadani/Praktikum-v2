<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelGallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Tabel_Gallery', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_admin');
          $table->string('judul', 100);
          $table->string('gambar', 255);
          $table->string('slide', 255)->default('0');
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
      Schema::dropIfExists('Tabel_Gallery');
    }
}
