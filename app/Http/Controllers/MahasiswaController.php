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
use App\JadwalPraktikum;
use App\AbsensiMahasiswa;

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

      // Mencek Jumlah Materi Dalam 1 Periode
      $AbsensiMahasiswa = AbsensiMahasiswa::where('id_mahasiswa', $DataUser->id)
                                          ->get();

      $IndexIdJadwalPraktikum = 0;
      $IdJadwalPraktikum[1]   = 01012011;
      foreach ($AbsensiMahasiswa as $DataAbsensiMahasiswa) {
        $IndexIdJadwalPraktikum += 1;
        $IdJadwalPraktikum[$IndexIdJadwalPraktikum] = $DataAbsensiMahasiswa->id_jadwal_praktikum;
      }

      $JadwalPraktikum = JadwalPraktikum::with('JadwalDosen')
                                        ->whereIn('id', $IdJadwalPraktikum)
                                        ->get()
                                        ->where('JadwalDosen.id_periode', $Periode->id);

      $DumpIdJadwalDosen   = 0;
      $JumlahMateridiAmbil = 0;
      foreach ($JadwalPraktikum as $DataJadwalPraktikum) {
        if ($DumpIdJadwalDosen != $DataJadwalPraktikum->id_jadwal_dosen) {
          $DumpIdJadwalDosen = $DataJadwalPraktikum->id_jadwal_dosen;
          $JumlahMateridiAmbil += 1;
        }
      }
      // Sampai Sini Untuk Mencek Jumlah Materi Dalam 1 Periode

      return view('mahasiswa.DataMateri', ['DataUser' => $DataUser, 'Periode' => $Periode, 'JadwalDosen' => $JadwalDosen, 'JumlahMateridiAmbil' => $JumlahMateridiAmbil]);
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

    public function storeDataMateriDetail(Request $request, $id, $idMahasiswa)
    {
      $idMateri        = Crypt::decryptString($id);
      $JumlahPertemuan = count($request->except(['_token']));

      for ($i=1; $i <= $JumlahPertemuan ; $i++) {
        $this->validate($request, [
          'Pertemuan'.$i => 'required'
        ]);
      }

      // Simpan Ke Database
      for ($i=1; $i <= $JumlahPertemuan ; $i++) {
        $Pertemuan = 'Pertemuan'.$i;
        $store = \App\AbsensiMahasiswa::create([
            'id_mahasiswa'        => $idMahasiswa,
            'id_jadwal_praktikum' => $request->$Pertemuan,
        ]);
      }

      return redirect('/mahasiswa/materi')->with('success', 'Jadwal Materi Telah di Ambil');
    }
}
