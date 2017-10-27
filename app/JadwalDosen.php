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

    public function JadwalPraktikum()
    {
      return $this->hasMany('App\JadwalPraktikum', 'id_jadwal_dosen');
    }

    public function Dosen()
    {
      return $this->belongsTo('App\Dosen', 'id_dosen');
    }
}
