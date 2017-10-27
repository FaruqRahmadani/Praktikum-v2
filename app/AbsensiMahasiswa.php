<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsensiMahasiswa extends Model
{
    //
    protected $table = 'tabel_absensi_mahasiswa';
    protected $fillable = [
        'id_mahasiswa', 'id_jadwal_praktikum', 'status',
    ];

    public function JadwalPraktikum(){
      return $this->hasOne('App\JadwalPraktikum', 'id', 'id_jadwal_praktikum');
    }

    public function JadwalDosen(){
      return $this->belongsTo('App\JadwalDosen', 'id', 'id_jadwal_dosen');
    }

    public function Mahasiswa(){
      return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa', 'id');
    }
}
