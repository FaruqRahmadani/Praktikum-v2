<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
  protected $table = 'tabel_mahasiswa';

  public function User()
  {
    return $this->belongsTo('App\User', 'id_user');
  }
}
