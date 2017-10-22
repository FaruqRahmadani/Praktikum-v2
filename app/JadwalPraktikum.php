<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalPraktikum extends Model
{
    //
    protected $table = 'tabel_jadwal_praktikum';

    public function JadwalDosen(){
      return $this->belongsTo('App\JadwalDosen', 'id_jadwal_dosen');
    }
}
