<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\User;
use App\Admin;
use App\Dosen;
use App\Periode;
use App\Mahasiswa;

class AdminController extends Controller
{
  public function Dashboard()
  {
    return view('admin.Dashboard');
  }

  public function DataAdmin()
  {
    $Admin = Admin::all();
    return view('admin.DataAdmin', ['Admin' => $Admin]);
  }

  public function TambahDataAdmin()
  {
    return view('admin.TambahDataAdmin');
  }

  public function storeTambahDataAdmin(Request $request)
  {
    $Admin = new Admin;

    $Admin->nama     = $request->nama;
    $Admin->username = $request->username;
    $Admin->password = bcrypt($request->password);
    $Admin->foto     = 'default.png';
    $Admin->email    = $request->email;
    $Admin->save();

    return redirect('/admin/dataadmin')->with('success', 'Data Admin " '.$request->nama.' " Telah di Tambahkan');
  }

  public function EditDataAdmin($id)
  {
    $ids   = Crypt::decryptString($id);
    $Admin = Admin::find($ids);

    return view('admin.EditDataAdmin', ['Admin' => $Admin]);
  }

  public function storeEditDataAdmin(Request $request, $id)
  {
    $ids   = Crypt::decryptString($id);
    $Admin = Admin::find($ids);

    $Admin->nama     = $request->nama;
    $Admin->username = $request->username;
    $Admin->email    = $request->email;
    if ($request->password != null) {
      $Admin->password = bcrypt($request->password);
    }
    $Admin->save();

    return redirect('/admin/dataadmin')->with('success', 'Data Admin " '.$request->nama.' " Telah di Dirubah');
  }

  public function HapusDataAdmin($id)
  {
    $ids   = Crypt::decryptString($id);
    $Admin = Admin::find($ids);
    $Admin->delete();

    return redirect('/admin/dataadmin')->with('warning', 'Data Admin " '.$Admin->nama.' " Telah di Hapus');
  }

  public function DataMahasiswa()
  {
    $Mahasiswa = Mahasiswa::with('User')
                          ->get();

    return view('admin.DataMahasiswa', ['Mahasiswa' => $Mahasiswa]);
  }

  public function EditDataMahasiswa($id)
  {
    $ids       = Crypt::decryptString($id);
    $Mahasiswa = Mahasiswa::find($ids);
    $User      = User::find($Mahasiswa->id_user);

    return view('admin.EditDataMahasiswa', ['Mahasiswa' => $Mahasiswa, 'User' => $User]);
  }

  public function storeEditDataMahasiswa(Request $request, $id)
  {
    $ids       = Crypt::decryptString($id);
    $Mahasiswa = Mahasiswa::find($ids);
    $User      = User::find($Mahasiswa->id_user);

    $Mahasiswa->NPM   = $request->NPM;
    $Mahasiswa->nama  = $request->nama;
    $Mahasiswa->no_hp = $request->NomorHP;
    $Mahasiswa->email = $request->email;
    $User->username   = $request->username;
    if ($request->password != null) {
      $User->password = bcrypt($request->password);
    }

    $Mahasiswa->save();
    $User->save();

    return redirect('/admin/datamahasiswa')->with('success', 'Data Mahasiswa " '.$request->nama.' " Telah di Dirubah');
  }

  public function DataDosen()
  {
    $Dosen = Dosen::with('User')
                  ->get();

    return view('admin.DataDosen', ['Dosen' => $Dosen]);
  }

  public function EditDataDosen($id)
  {
    $ids   = Crypt::decryptString($id);
    $Dosen = Dosen::find($ids);
    $User  = User::find($Dosen->id_user);

    return view('admin.EditDataDosen', ['Dosen' => $Dosen, 'User' => $User]);
  }

  public function storeEditDataDosen(Request $request, $id)
  {
    $ids   = Crypt::decryptString($id);
    $Dosen = Dosen::find($ids);
    $User  = User::find($Dosen->id_user);

    $Dosen->NIDN    = $request->NIDN;
    $Dosen->nama    = $request->nama;
    $Dosen->no_hp   = $request->NomorHP;
    $Dosen->email   = $request->email;
    $User->username = $request->username;
    if ($request->password != null) {
      $User->password = bcrypt($request->password);
    }

    $Dosen->save();
    $User->save();

    return redirect('/admin/datadosen')->with('success', 'Data Dosen " '.$request->nama.' " Telah di Dirubah');
  }

  public function Periode()
  {
    $Periode = Periode::all();

    return view('admin.Periode', ['Periode' => $Periode]);
  }

  public function TambahPeriode()
  {
    return view('admin.TambahPeriode');
  }

  public function storeTambahPeriode(Request $request)
  {
    $Periode = new Periode;

    $Periode->periode       = $request->NamaPeriode;
    $Periode->tanggal_tutup = $request->TanggalTutup;
    $Periode->status        = 1;

    $Periode->save();

    return redirect('/admin/periode')->with('success', 'Data Periode " '.$request->NamaPeriode.' " Telah di Tambahkan');
  }

  public function EditPeriode($id)
  {
    $ids     = Crypt::decryptString($id);
    $Periode = Periode::find($ids);

    return view('admin.EditPeriode', ['Periode' => $Periode]);
  }

  public function storeEditPeriode(Request $request, $id)
  {
    $ids     = Crypt::decryptString($id);
    $Periode = Periode::find($ids);

    $Periode->periode       = $request->NamaPeriode;
    $Periode->tanggal_tutup = $request->TanggalTutup;
    $Periode->status        = $request->status;

    $Periode->save();

    return redirect('/admin/periode')->with('success', 'Data Periode " '.$request->NamaPeriode.' " Telah di Rubah');
  }

  public function HapusPeriode($id)
  {
    $ids     = Crypt::decryptString($id);
    $Periode = Periode::find($ids);

    $Periode->delete();

    return redirect('/admin/periode')->with('warning', 'Data Periode Telah di Hapus');
  }
}
