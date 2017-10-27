<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Crypt;
use Carbon;
use App\Materi;
use App\Periode;
use App\Mahasiswa;
use App\JadwalDosen;

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

    public function DataMateri()
    {
      $Auth     = Auth::user();
      $DataUser = Mahasiswa::where('id_user', $Auth->id)
                           ->first();

      // Menentukan Semester Mahasiswa
      $Angkatan = substr($DataUser->NPM,0,2);
      (date('n') > 8) ? $TambahanSemester = 1 : $TambahanSemester = 0 ;
      $Semester = ((date('y')-$Angkatan)*2)+$TambahanSemester;

      $Periode     = Periode::all()->last();

      $JadwalDosen = JadwalDosen::with('Materi')
                                 ->with('Dosen')
                                 ->with('JadwalPraktikum')
                                 ->where('id_periode', $Periode->id)
                                 ->get()
                                 ->where('Materi.semester', '<=', $Semester);

      return view('mahasiswa.DataMateri', ['DataUser' => $DataUser, 'Periode' => $Periode, 'JadwalDosen' => $JadwalDosen]);
    }

    public function DataMateriDetail($id)
    {
      $Auth     = Auth::user();
      $DataUser = Mahasiswa::where('id_user', $Auth->id)
                           ->first();

      $ids = Crypt::decryptString($id);

      $JadwalDosen = JadwalDosen::where('id', $ids)
                                 ->with('Materi')
                                 ->with('Dosen')
                                 ->with('JadwalPraktikum')
                                 ->get();
      $NamaMateri  = $JadwalDosen->first()->Materi->materi_praktikum;

      return view('mahasiswa.DataMateriDetail', ['DataUser' => $DataUser, 'JadwalDosen' => $JadwalDosen, 'NamaMateri' => $NamaMateri]);
    }
}
