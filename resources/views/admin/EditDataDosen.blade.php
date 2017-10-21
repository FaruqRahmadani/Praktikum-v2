@extends('admin.Layouts.Master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Data Dosen
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Info boxes -->
      <div class="box box-primary">
            <div class="box-body">
              {!! Form::open(['url'=>Request::url(),'files'=>true,'class'=>'register-form', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}

            <div class="form-group">
              <label class="col-lg-3 control-label">NPM</label>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="NIDN" value="{{ $Dosen->NIDN }}" required pattern="[0-9]{5,}" title="Input NIDN Tanpa">
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">Nama</label>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="nama" value="{{ $Dosen->nama }}" required pattern="[a-zA-Z.,].{3,}" title="Minimal 4 Karakter">
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">Nomor HP</label>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="NomorHP" value="{{ $Dosen->no_hp }}" required pattern="[0][0-9]{11,15}" title="Input Nomor HP diawali dengan 0">
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">E-Mail</label>
              <div class="col-lg-8">
                <input class="form-control" type="email" name="email" value="{{ $Dosen->email }}" required>
              </div>
            </div>

            <hr>

		        <div class="form-group">
              <label class="col-lg-3 control-label">Username</label>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="username" value="{{ $User->username }}" required pattern=".{6,}" title="Minimal 6 Karakter">
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">Password</label>
              <div class="col-lg-8">
                <input class="form-control" type="password" name="password" value="{{old('password')}}" placeholder="Isi Jika Ingin Mengganti Password" pattern=".{6,}" title="Minimal 6 Karakter">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"></label>
              <div class="row">
                <div class="col-md-3">
                  <button type="reset" class="btn btn-block btn-danger btn">
                    <i class="fa fa-times"></i> <b>Reset</b>
                  </button>
                </div>
                <div class="col-md-3">
                  <button type="submit" class="btn btn-block btn-info btn">
                    <i class="fa fa-save"></i> <b>Simpan</b>
                  </button>
                </div>
              </div>
            </div>

          </form>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.0.0
    </div>
    <strong>Copyright &copy; 2017.</strong> All rights
    reserved.
  </footer>

</div>
</body>
@endsection
