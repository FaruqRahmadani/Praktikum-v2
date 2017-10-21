<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route Logout !!!
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route Halaman Depan
Route::get('/DaftarMahasiswa', 'DepanController@formDaftarMahasiswa');
Route::get('/DaftarDosen', 'DepanController@formDaftarDosen');
Route::get('/dashboard', 'DepanController@Dashboard');
Route::get('/LupaPassword', 'DepanController@LupaPassword');

// Route Halaman Admin
Route::group(['middleware' => 'admin'], function(){
  Route::get('/admin', 'AdminController@Dashboard');
  // Bagian Data Admin
  Route::get('/admin/dataadmin', 'AdminController@DataAdmin');
  Route::get('/admin/dataadmin/tambah', 'AdminController@TambahDataAdmin');
  Route::POST('/admin/dataadmin/tambah', 'AdminController@storeTambahDataAdmin');
  Route::get('/admin/dataadmin/{id}/edit', 'AdminController@EditDataAdmin');
  Route::POST('/admin/dataadmin/{id}/edit', 'AdminController@storeEditDataAdmin');
  Route::get('/admin/dataadmin/{id}/hapus', 'AdminController@HapusDataAdmin');
  // Bagian Data Mahasiswa
  Route::get('/admin/datamahasiswa', 'AdminController@DataMahasiswa');
  Route::get('/admin/datamahasiswa/{id}/edit', 'AdminController@EditDataMahasiswa');
  Route::POST('/admin/datamahasiswa/{id}/edit', 'AdminController@storeEditDataMahasiswa');
  // Bagian Data Dosen
  Route::get('/admin/datadosen', 'AdminController@DataDosen');
  Route::get('/admin/datadosen/{id}/edit', 'AdminController@EditDataDosen');
  Route::POST('/admin/datadosen/{id}/edit', 'AdminController@storeEditDataDosen');
  // Bagian Data Periode
  Route::get('/admin/periode', 'AdminController@Periode');
  Route::get('/admin/periode/tambah', 'AdminController@TambahPeriode');
  Route::POST('/admin/periode/tambah', 'AdminController@storeTambahPeriode');
  Route::get('/admin/periode/{id}/edit', 'AdminController@EditPeriode');
  Route::POST('/admin/periode/{id}/edit', 'AdminController@storeEditPeriode');
  Route::get('/admin/periode/{id}/hapus', 'AdminController@HapusPeriode');

});

//Route Admin Rahasia
Route::get('/login/{code1}/{code2}/{code3}/{code4}', 'Auth\AdminLoginController@LoginForm');
Route::POST('/login/login/login/login/login/login/login/login/login/login/login/login/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
