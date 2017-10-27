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
      $User = Auth::user();

      if ($User) {
        if ($User->tipe == 1) {
          return redirect('/dosen');
        } else {
          return redirect('/mahasiswa');
        }
      } else {
        abort('404');
      }

    }

    Public function LupaPassword()
    {
      dd('Belum Di Olah');
    }
}
