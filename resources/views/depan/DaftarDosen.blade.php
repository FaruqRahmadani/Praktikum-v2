@extends('depan.layouts.master')
@section('content')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url()->current() }}"><b>Daftar Dosen</b><br>Praktikum UNISKA</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    {{-- Pemberitahuan / Message Box --}}
    <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-info"></i> Daftar Dosen</h4>
      Ini Merupakan Halaman Daftar Bagi Dosen
    </div>

    @if(count($errors) > 0)
      <div class="alert alert-info">
        <ul>
          @if ($errors->first() == 'These credentials do not match our records.')
            Username dan Password Tidak Ditemukan
          @else
            @foreach ($errors->all() as $error)
              <li> {{$error}} </li>
            @endforeach
          @endif
        </ul>
      </div>
    @endif

    <form action="{{ route('register') }}" method="post">
      {{ csrf_field() }}
      <input name="tipe" type="hidden" class="form-control" placeholder="tipe" value="1" readonly>

      <div class="form-group has-feedback">
        <input name="NIDN" value="{{old('NIDN')}}" type="text" class="form-control" placeholder="NIDN" autofocus required title="Input NIDN Tanpa Titik" pattern="[0-9]{5,}">
        <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input name="Nama" value="{{old('Nama')}}" type="text" class="form-control" placeholder="Nama" required title="Input Nama Sesuai Absen" pattern="[a-zA-Z.,].{3,}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input name="NomorHP" value="{{old('NomorHP')}}" type="text" class="form-control" placeholder="Nomor HP" required title="Input Nomor HP diawali dengan 0" pattern="[0][0-9]{11,15}">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input name="Email" value="{{old('Email')}}" type="email" class="form-control" placeholder="E-mail" required title="Input E-Mail Aktif">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <hr>
      <div class="form-group has-feedback">
        <input name="username" value="{{old('username')}}" type="text" class="form-control" placeholder="Username" required title="Input Username Minimal 5 Karakter" pattern="[a-zA-Z0-9]{5,}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password" required title="Input Password Minimal 5 Karakter" pattern="[a-zA-Z0-9]{5,}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input name="password_confirmation" type="password" class="form-control" placeholder="Re-Password" required title="Ulangi Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-12" style="margin-bottom: 10px;">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><b>Daftar Sebagai Dosen</b></button>
        </div>
      </div>
      </form>
      <div class="row">
        <div class="col-xs-12">
          <a href="/register"> <button class="btn btn-danger btn-block btn-flat"><b>Sudah Punya Akun? Login</b></button> </a>
        </div>
      </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>
@endsection
