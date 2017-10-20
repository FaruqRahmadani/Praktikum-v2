<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelPeriode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Tabel_Periode', function (Blueprint $table) {
          $table->increments('id');
          $table->string('periode', 20);
          $table->date('tanggal_tutup');
          $table->tinyInteger('status');
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
      Schema::dropIfExists('Tabel_Periode');
        //
    }
}
