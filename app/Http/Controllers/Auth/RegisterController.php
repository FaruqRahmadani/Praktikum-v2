<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Dosen;
use App\Mahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if ($data['tipe']==1) {
          return Validator::make($data, [
            'NIDN'     => 'unique:tabel_dosen,NIDN',
            'username' => 'unique:users,username',
            'password' => 'confirmed',
          ]);
        } else {
          return Validator::make($data, [
            'NPM'      => 'unique:tabel_mahasiswa,NPM',
            'username' => 'unique:users,username',
            'password' => 'confirmed',
          ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      $User      = new User;
      $Dosen     = new Dosen;
      $Mahasiswa = new Mahasiswa;

      //Menentukan Id User
      $JumlahUser = count(User::all());
      $JumlahUser < 1 ? $idUser=1 : $idUser=User::all()->last()->id + 1;

      //Menyimpan Data User Dosen Atau Mahasiswa
      if ($data['tipe'] == 1) {
        // Untuk Dosen
        $Dosen->id_user = $idUser;
        $Dosen->NIDN    = $data['NIDN'];
        $Dosen->nama    = $data['Nama'];
        $Dosen->no_hp   = $data['NomorHP'];
        $Dosen->foto    = 'default.png';
        $Dosen->email   = $data['Email'];

        $Dosen->save();
      } else {
        // Untuk Mahasiswa
        $Mahasiswa->id_user = $idUser;
        $Mahasiswa->NPM     = $data['NPM'];
        $Mahasiswa->nama    = $data['Nama'];
        $Mahasiswa->no_hp   = $data['NomorHP'];
        $Mahasiswa->foto    = 'default.png';
        $Mahasiswa->email   = $data['Email'];

        $Mahasiswa->save();
      }

      return User::create([
        'username' => $data['username'],
        'password' => bcrypt($data['password']),
        'tipe'     => $data['tipe'],
      ]);
    }
}
