<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Mahasiswa;

class MahasiswaController extends Controller
{
    //
    public function Dashboard()
    {
      $Auth     = Auth::user();
      $DataUser = Mahasiswa::where('id_user', $Auth->id)
                           ->first();

      return view('mahasiswa.Dashboard', ['DataUser' => $DataUser]);
    }
}
