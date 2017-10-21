<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\Admin;

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
}
