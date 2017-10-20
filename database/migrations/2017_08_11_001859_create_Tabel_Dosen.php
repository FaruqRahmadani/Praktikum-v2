<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelDosen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Tabel_Dosen', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_user');
          $table->string('NIDN', 25);
          $table->string('nama', 75);
          $table->string('no_hp', 12);
          $table->string('foto', 255);
          $table->string('email', 50);
          $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('Tabel_Dosen');
    }
}
