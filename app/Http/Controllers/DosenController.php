<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Crypt;
use App\Dosen;
use App\Materi;
use App\Periode;
use App\Mahasiswa;
use App\JadwalDosen;

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
    $Auth     = Auth::user();
    $DataUser = Dosen::where('id_user', $Auth->id)
                     ->first();

    $Mahasiswa = Mahasiswa::all();
    return view('dosen.DataMahasiswa', ['DataUser' => $DataUser, 'Mahasiswa' => $Mahasiswa]);
  }

  public function DataDosen()
  {
    $Auth     = Auth::user();
    $DataUser = Dosen::where('id_user', $Auth->id)
                     ->first();

    $Dosen    = Dosen::all();
    return view('dosen.DataDosen', ['DataUser' => $DataUser, 'Dosen' => $Dosen]);
  }

  public function DataMateri()
  {
    $Auth        = Auth::user();
    $DataUser    = Dosen::where('id_user', $Auth->id)
                        ->first();

    // Periode Terakhir
    $Periode = Periode::all()->last();

    $JadwalDosen = JadwalDosen::with('Materi')
                              ->where('id_dosen', $DataUser->id)
                              ->where('id_periode', $Periode->id)
                              ->get();

    return view('dosen.DataMateri', ['DataUser' => $DataUser, 'JadwalDosen' => $JadwalDosen, 'Periode' => $Periode]);
  }

  public function HapusDataMateri($id)
  {
    $ids         = Crypt::decryptString($id);
    $JadwalDosen = JadwalDosen::find($ids);

    // Menampilkan Nama Materi
    $Materi     = Materi::find($JadwalDosen->id_praktikum);
    $NamaMateri = $Materi->materi_praktikum;

    $JadwalDosen->delete();

    return redirect('/dosen/datamateri')->with('success', 'Materi "'.$NamaMateri.'" Telah di Hapus');
  }

  public function AmbilDataMateri()
  {
    $Auth     = Auth::user();
    $DataUser = Dosen::where('id_user', $Auth->id)
                     ->first();

    // Data Periode
    $Periode = Periode::all()->last();
    // Data Materi
    $Materi = Materi::all();

    return view('dosen.AmbilDataMateri', ['DataUser' => $DataUser, 'Materi' => $Materi, 'Periode' => $Periode]);
  }

  public function storeAmbilDataMateri($id)
  {
    $ids    = Crypt::decryptString($id);
    $Auth     = Auth::user();
    $DataUser = Dosen::where('id_user', $Auth->id)
                     ->first();

    // Data Periode
    $Periode = Periode::all()->last();

    $JadwalDosen = new JadwalDosen;

    $JadwalDosen->id_praktikum = $ids;
    $JadwalDosen->id_dosen     = $DataUser->id;
    $JadwalDosen->id_periode   = $Periode->id;

    $JadwalDosen->save();

    $Materi = Materi::find($ids);

    return redirect('/dosen/datamateri/ambil')->with('success', 'Materi "'.$Materi->materi_praktikum.'" Berhasil di Ambil');
  }

  public function HapusAmbilDataMateri($id, $idDosen, $idPeriode)
  {
    $ids         = Crypt::decryptString($id);
    $idDosens    = Crypt::decryptString($idDosen);
    $idPeriodes  = Crypt::decryptString($idPeriode);

    $JadwalDosen = JadwalDosen::where('id_praktikum', $ids)
                              ->where('id_dosen', $idDosens)
                              ->where('id_periode', $idPeriodes)
                              ->first();

    // Menampilkan Nama Materi
    $Materi     = Materi::find($JadwalDosen->id_praktikum);
    $NamaMateri = $Materi->materi_praktikum;

    $JadwalDosen->delete();

    return redirect('/dosen/datamateri/ambil')->with('success', 'Materi "'.$NamaMateri.'" Telah di Hapus');
  }
}
