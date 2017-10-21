<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    //
    protected $table = 'tabel_periode';

    public function JadwalDosen()
    {
      return $this->hasMany('App\JadwalDosen', 'id_periode');
    }
}
