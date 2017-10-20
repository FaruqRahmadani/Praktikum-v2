<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    Public function LupaPassword()
    {
      dd('Belum Di Olah');
    }
}
