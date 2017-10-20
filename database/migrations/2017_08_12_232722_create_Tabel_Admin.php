<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Tabel_Admin', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nama', 25);
          $table->string('username', 11);
          $table->string('password', 100);
          $table->string('foto', 255);
          $table->string('email', 50);
          $table->rememberToken();
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
      Schema::dropIfExists('Tabel_Admin');
    }
}
