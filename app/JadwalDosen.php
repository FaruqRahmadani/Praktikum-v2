<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalDosen extends Model
{
    //
    protected $table = 'tabel_jadwal_dosen';

    public function Materi()
    {
      return $this->belongsTo('App\Materi', 'id_praktikum');
    }
}
