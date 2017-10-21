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
  Route::get('/admin/dataadmin', 'AdminController@DataAdmin');
  Route::get('/admin/dataadmin/tambah', 'AdminController@TambahDataAdmin');
  Route::POST('/admin/dataadmin/tambah', 'AdminController@storeTambahDataAdmin');
  Route::get('/admin/dataadmin/{id}/edit', 'AdminController@EditDataAdmin');
  Route::POST('/admin/dataadmin/{id}/edit', 'AdminController@storeEditDataAdmin');
  Route::get('/admin/dataadmin/{id}/hapus', 'AdminController@HapusDataAdmin');
});

//Route Admin Rahasia
Route::get('/login/{code1}/{code2}/{code3}/{code4}', 'Auth\AdminLoginController@LoginForm');
Route::POST('/login/login/login/login/login/login/login/login/login/login/login/login/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
