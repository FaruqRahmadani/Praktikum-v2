<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DepanController extends Controller
{
    //
    Public function formDaftarMahasiswa()
    {
      return view('depan.DaftarMahasiswa');
    }

    Public function formDaftarDosen()
    {
      return view('depan.DaftarDosen');
    }

    public function Dashboard()
    {
      $TipeUser = Auth::user()->tipe;
      if ($TipeUser == 1) {
        dd('Dosen');
      } else {
        dd('Mahasiswa');
      }

    }

    Public function LupaPassword()
    {
      dd('Belum Di Olah');
    }
}
