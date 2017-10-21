<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
  protected $table = 'tabel_dosen';

  public function User()
  {
    return $this->belongsTo('App\User', 'id_user');
  }
}
