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

  public function EditDataAdmin($id)
  {
    $ids   = Crypt::decryptString($id);
    $Admin = Admin::find($ids);
    dd($Admin);
  }
}
