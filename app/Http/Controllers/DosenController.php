<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Dosen;
use App\Mahasiswa;

class DosenController extends Controller
{
  //
  public function Dashboard()
  {
    $Auth     = Auth::user();
    $DataUser = Dosen::where('id_user', $Auth->id)
                     ->first();

    return view('dosen.Dashboard', ['DataUser' => $DataUser]);
  }

  public function DataMahasiswa()
  {
    $Auth      = Auth::user();
    $DataUser  = Dosen::where('id_user', $Auth->id)
                     ->first();

    $Mahasiswa = Mahasiswa::all();
    return view('dosen.DataMahasiswa', ['DataUser' => $DataUser, 'Mahasiswa' => $Mahasiswa]);
  }

  public function DataDosen()
  {
    $Auth      = Auth::user();
    $DataUser  = Dosen::where('id_user', $Auth->id)
                     ->first();

    $Dosen = Dosen::all();
    return view('dosen.DataDosen', ['DataUser' => $DataUser, 'Dosen' => $Dosen]);
  }
}
