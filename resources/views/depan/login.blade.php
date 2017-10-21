@extends('depan.layouts.master')
@section('content')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url()->current() }}"><b>Login</b><br>Praktikum UNISKA</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    {{-- Pemberitahuan / Message Box --}}
    <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-info"></i> Login</h4>
      Silahkan Login
    </div>

    <form action="{{ route('login') }}" method="post">
      {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input name="username" type="text" class="form-control" placeholder="Username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12" style="margin-bottom: 10px;">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><b>Login</b></button>
        </div>
      </div>
      </form>
      <div class="row">
        <div class="col-xs-6">
          <a href="/DaftarMahasiswa"> <button class="btn btn-danger btn-block btn-flat"><b>Daftar Mahasiswa</b></button> </a>
        </div>
        <div class="col-xs-6">
          <a href="/DaftarDosen"> <button class="btn btn-danger btn-block btn-flat"><b>Daftar Dosen</b></button> </a>
        </div>
        <div class="col-xs-12" style="margin-top: 10px;">
          <a href="/LupaPassword"> <button class="btn btn-warning btn-block btn-flat"><b>Lupa Password</b></button> </a>
        </div>
      </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>
@endsection
