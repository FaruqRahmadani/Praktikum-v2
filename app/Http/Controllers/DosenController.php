<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use File;
use Crypt;
use App\User;
use App\Dosen;
use App\Materi;
use App\Periode;
use App\Mahasiswa;
use App\JadwalDosen;
use App\JadwalPraktikum;

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
    $ids      = Crypt::decryptString($id);
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

  public function DataJadwal()
  {
    $Auth     = Auth::user();
    $DataUser = Dosen::where('id_user', $Auth->id)
                     ->first();

    // Data Periode
    $Periode = Periode::all()->last();

    $JadwalDosen = JadwalDosen::with('Materi')
                              ->with('JadwalPraktikum')
                              ->where('id_dosen', $DataUser->id)
                              ->where('id_periode', $Periode->id)
                              ->get();

    return view('dosen.DataJadwal', ['DataUser' => $DataUser, 'Periode' => $Periode, 'JadwalDosen' => $JadwalDosen]);
  }

  public function TambahDataJadwal()
  {
    $Auth     = Auth::user();
    $DataUser = Dosen::where('id_user', $Auth->id)
                     ->first();

    // Data Periode
    $Periode = Periode::all()->last();

    //JadwalDosen
    $JadwalDosen = JadwalDosen::with('Materi')
                              ->where('id_dosen', $DataUser->id)
                              ->where('id_periode', $Periode->id)
                              ->get();

    return view('dosen.TambahDataJadwal', ['DataUser' => $DataUser, 'JadwalDosen' => $JadwalDosen]);
  }

  public function storeTambahDataJadwal(Request $request)
  {
    $JadwalPraktikum = JadwalPraktikum::where('id_jadwal_dosen', $request->idJadwalDosen)
                                      ->get();
    $MaxPertemuan    = $JadwalPraktikum->max('pertemuan');
    // Melihat Apakah Pertemuan Sebelumnya Telah di Input atau Belum
    if (($request->Pertemuan > 1) && ($request->Pertemuan-1 > $MaxPertemuan )) {
      return redirect('/dosen/jadwal/tambah')->with('warning', 'Pertemuan '.($MaxPertemuan+1).' Belum di Tambahkan')
                                             ->withInput();
    }

    $JadwalPraktikum = new JadwalPraktikum;
    $JadwalPraktikum->id_jadwal_dosen = $request->idJadwalDosen;
    $JadwalPraktikum->pertemuan       = $request->Pertemuan;
    $JadwalPraktikum->nama_kelas      = $request->NamaKelas;
    $JadwalPraktikum->ruangan         = $request->Ruangan;
    $JadwalPraktikum->tanggal         = $request->Tanggal;
    $JadwalPraktikum->waktu_mulai     = $request->WaktuMulai;
    $JadwalPraktikum->waktu_selesai   = $request->WaktuSelesai;

    $JadwalPraktikum->save();

    return redirect('/dosen/jadwal/tambah')->with('success', 'Jadwal Praktikum Pertemuan '.($request->Pertemuan).' Berhasil Di Tambahkan')
                                           ->withInput();
  }

  public function EditDataJadwal($id)
  {
    $Auth     = Auth::user();
    $DataUser = Dosen::where('id_user', $Auth->id)
                     ->first();

    // Data Periode
    $Periode = Periode::all()->last();

    //JadwalDosen
    $JadwalDosen = JadwalDosen::with('Materi')
                              ->where('id_dosen', $DataUser->id)
                              ->where('id_periode', $Periode->id)
                              ->get();

    $ids             = Crypt::decryptString($id);
    $JadwalPraktikum = JadwalPraktikum::find($ids);

    return view('dosen.EditDataJadwal', ['DataUser' => $DataUser, 'JadwalDosen' => $JadwalDosen, 'JadwalPraktikum' => $JadwalPraktikum]);
  }

  public function storeEditDataJadwal(Request $request, $id)
  {
    // Melihat Apakah Pertemuan Sebelumnya Telah di Input atau Belum
    // VALIDASI PERTEMUAN
    $JadwalPraktikum = JadwalPraktikum::where('id_jadwal_dosen', $request->idJadwalDosen)
                                      ->get();
    $MaxPertemuan    = $JadwalPraktikum->max('pertemuan');
    if (($request->Pertemuan > 1)) {
      if ($request->Pertemuan-1 > $MaxPertemuan) {
        return back()->with('warning', 'Pertemuan '.($MaxPertemuan+1).' Belum di Tambahkan')
        ->withInput();
      }
      if ((count($JadwalPraktikum->where('pertemuan', $MaxPertemuan)) == 1) && ($MaxPertemuan != $request->Pertemuan) && ($MaxPertemuan < $request->Pertemuan)) {
        return back()->with('warning', 'Ini Merupakan Pertemuan Ke - '.($MaxPertemuan).' Satu-satunya')
                     ->withInput();
      }
    }

    $ids             = Crypt::decryptString($id);
    $JadwalPraktikum = JadwalPraktikum::find($ids);
    $JadwalDosen = JadwalDosen::with('Materi')
                              ->where('id', $JadwalPraktikum->id_jadwal_dosen)
                              ->first();

    $JadwalPraktikum->pertemuan       = $request->Pertemuan;
    $JadwalPraktikum->nama_kelas      = $request->NamaKelas;
    $JadwalPraktikum->ruangan         = $request->Ruangan;
    $JadwalPraktikum->tanggal         = $request->Tanggal;
    $JadwalPraktikum->waktu_mulai     = $request->WaktuMulai;
    $JadwalPraktikum->waktu_selesai   = $request->WaktuSelesai;

    $JadwalPraktikum->save();


    return redirect('/dosen/jadwal')->with('success', 'Jadwal Praktikum '.$JadwalDosen->Materi->materi_praktikum.' Pertemuan '.($request->Pertemuan).' Berhasil Di Edit');
  }

  public function UbahStatusDataJadwal($id, $status)
  {
    $ids             = Crypt::decryptString($id);
    $JadwalPraktikum = JadwalPraktikum::find($ids);
    $JadwalDosen = JadwalDosen::with('Materi')
                              ->where('id', $JadwalPraktikum->id_jadwal_dosen)
                              ->first();

    // Untuk Tipe
    $DumpStatus = ($status == 'Aktif' ? '1' : '0');

    $JadwalPraktikum->tipe = $DumpStatus;
    $JadwalPraktikum->save();

    return redirect('/dosen/jadwal')->with('success', 'Jadwal Praktikum '.$JadwalDosen->Materi->materi_praktikum.' Pertemuan '.($JadwalPraktikum->Pertemuan).' Berhasil Berubah Status Menjadi '.$status);
  }

  public function EditProfile()
  {
    $Auth     = Auth::user();
    $DataUser = Dosen::where('id_user', $Auth->id)
                     ->first();

    return view('dosen.EditProfile', ['DataUser' => $DataUser, 'Auth' => $Auth]);
  }

  public function storeEditProfile(Request $request, $iduser)
  {
    $User  = User::find($iduser);
    $Dosen = Dosen::where('id_user', $iduser)
                  ->first();

    // Dosen
    $Dosen->NIDN  = $request->nidn;
    $Dosen->nama  = $request->nama;
    $Dosen->no_hp = $request->nohp;
    $Dosen->email = $request->email;

    // User
    $User->username = $request->username;
    // Jika Ada Inputan Ganti Password
    if ($request->password_lama != null) {
      // Konfirmasi Password dan Re-Password Sama / Tidak
      $this->validate($request, [
        'password'      => 'confirmed',
      ]);

      if (Hash::check($request->password_lama, $User->password)) {
        $User->password = $request->password;
      }
    }

    if ($request->foto != null) {
      if ($Dosen->foto != 'default.png') {
        File::delete('image/dosen/'.$Dosen->foto);
      }
      // Menentukan Nama Gambar
      $namaGambar = $iduser.'.'.$request->foto->getClientOriginalExtension();
      // Menyimpan Gambar
      $request->foto->move(public_path('image/dosen'), $namaGambar);
      // Menyimpan Nama Gambar ke Database
      $Dosen->foto = $namaGambar;
    }

    $Dosen->save();
    $User->save();

    return redirect('/dosen')->with('success', 'Data Anda Telah di Ubah');
  }

}
