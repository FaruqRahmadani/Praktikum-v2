@extends('admin.Layouts.Master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Periode Baru
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Info boxes -->
      <div class="box box-primary">
            <div class="box-body">
              {!! Form::open(['url'=>Request::url(),'files'=>true,'class'=>'register-form', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}

            <div class="form-group">
              <label class="col-lg-3 control-label">Nama Periode</label>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="NamaPeriode" value="{{old('NamaPeriode')}}" required pattern="[a-zA-Z0-9/]+.{3,}" title="Minimal 4 Karakter">
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">Tanggal Tutup</label>
              <div class="col-lg-8">
                <input class="form-control" type="date" name="TanggalTutup" value="{{Carbon\Carbon::now()->addWeek()->format('Y-m-d')}}" required min="{{Carbon\Carbon::now()->format('Y-m-d')}}">
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
