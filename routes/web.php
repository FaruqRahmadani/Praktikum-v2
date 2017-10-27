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


Route::get('/home', 'HomeController@index')->name('home');

//Route Halaman Depan
Route::get('/DaftarMahasiswa', 'DepanController@formDaftarMahasiswa');
Route::get('/DaftarDosen', 'DepanController@formDaftarDosen');
Route::get('/LupaPassword', 'DepanController@LupaPassword');

// Login Sukses
Route::get('/dashboard', 'DepanController@Dashboard');
Route::get('/home', 'DepanController@Dashboard');

// Route Halaman Admin
Route::group(['middleware' => 'admin'], function(){
  Route::get('/admin', 'AdminController@Dashboard');
  // Edit Profil
  Route::get('/admin/editprofil', 'AdminController@EditProfil');
  Route::POST('/admin/editprofil/{id}', 'AdminController@storeEditProfil');
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
  Route::get('/admin/datadosen/{id}/status/{status}', 'AdminController@EditStatusDosen');
  // Bagian Data Periode
  Route::get('/admin/periode', 'AdminController@Periode');
  Route::get('/admin/periode/tambah', 'AdminController@TambahPeriode');
  Route::POST('/admin/periode/tambah', 'AdminController@storeTambahPeriode');
  Route::get('/admin/periode/{id}/edit', 'AdminController@EditPeriode');
  Route::POST('/admin/periode/{id}/edit', 'AdminController@storeEditPeriode');
  Route::get('/admin/periode/{id}/hapus', 'AdminController@HapusPeriode');
  // Bagian Data Materi
  Route::get('/admin/materi', 'AdminController@Materi');
  Route::get('/admin/materi/tambah', 'AdminController@TambahMateri');
  Route::POST('/admin/materi/tambah', 'AdminController@storeTambahMateri');
  Route::get('/admin/materi/{id}/edit', 'AdminController@EditMateri');
  Route::POST('/admin/materi/{id}/edit', 'AdminController@storeEditMateri');
});

// Route Halaman Dosen
Route::group(['middleware' => 'dosen'], function(){
  Route::get('/dosen', 'DosenController@Dashboard');
  Route::group(['middleware' => 'statusdosen'], function(){
    Route::get('/dosen/datamahasiswa', 'DosenController@DataMahasiswa');
    Route::get('/dosen/datadosen', 'DosenController@DataDosen');
    Route::get('/dosen/datamateri', 'DosenController@DataMateri');
    Route::get('/dosen/datamateri/{id}/hapus', 'DosenController@HapusDataMateri');
    Route::get('/dosen/datamateri/ambil', 'DosenController@AmbilDataMateri');
    Route::get('/dosen/datamateri/ambil/{id}', 'DosenController@storeAmbilDataMateri');
    Route::get('/dosen/datamateri/ambil/{id}/{idDosen}/{idPeriode}/hapus', 'DosenController@HapusAmbilDataMateri');
    Route::get('/dosen/jadwal', 'DosenController@DataJadwal');
    Route::get('/dosen/jadwal/tambah', 'DosenController@TambahDataJadwal');
    Route::POST('/dosen/jadwal/tambah', 'DosenController@storeTambahDataJadwal');
    Route::get('/dosen/jadwal/{id}/edit', 'DosenController@EditDataJadwal');
    Route::POST('/dosen/jadwal/{id}/edit', 'DosenController@storeEditDataJadwal');
    Route::get('/dosen/jadwal/{id}/status/{status}', 'DosenController@UbahStatusDataJadwal');
    Route::get('/dosen/editprofil', 'DosenController@EditProfile');
    Route::POST('/dosen/editprofil/{iduser}', 'DosenController@storeEditProfile');
  });
});

// Route Halaman Mahasiswa
Route::group(['middleware' => 'mahasiswa'], function(){
  route::get('/mahasiswa', 'MahasiswaController@Dashboard');
  route::get('/mahasiswa/materi', 'MahasiswaController@DataMateri');
  route::get('/mahasiswa/materi/{id}', 'MahasiswaController@DataMateriDetail');
});

//Route Admin Rahasia
Route::get('/login/{code1}/{code2}/{code3}/{code4}', 'Auth\AdminLoginController@LoginForm');
Route::POST('/login/login/login/login/login/login/login/login/login/login/login/login/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Auth::routes();
