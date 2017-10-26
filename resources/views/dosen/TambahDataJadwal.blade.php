@extends('dosen.Layouts.Master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Jadwal Materi
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Info boxes -->
      <div class="box box-primary">
            <div class="box-body">
              @if (session('warning'))
                <div class="callout callout-warning">
                  <h4><i class="fa fa-warning"></i> Perhatian</h4>

                  <p> {{ session('warning') }} </p>
                </div>
              @endif
              @if (session('success'))
                <div class="callout callout-success">
                  <h4><i class="fa fa-warning"></i> Berhasil</h4>

                  <p> {{ session('success') }} </p>
                </div>
              @endif
              {!! Form::open(['url'=>Request::url(),'files'=>true,'class'=>'register-form', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}

              <div class="form-group">
                <label class="col-lg-3 control-label">Materi</label>
                <div class="col-lg-8">
                  <select required class="form-control" name="idJadwalDosen">
                    <option hidden="true" value="">-- Pilih --</>
                    @foreach ($JadwalDosen as $DataJadwalDosen)
                      <option value="{{$DataJadwalDosen->id}}" {{old('idJadwalDosen') == $DataJadwalDosen->id ? 'selected' : ''}}>{{$DataJadwalDosen->Materi->materi_praktikum}}</>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Pertemuan</label>
                <div class="col-lg-8">
                  <select required class="form-control" name="Pertemuan">
                    <option hidden="true" value="">-- Pilih --</>
                    @for ($i=1; $i <= 5; $i++)
                      <option value="{{$i}}" {{old('Pertemuan') == $i ? 'selected' : ''}}>Pertemuan Ke - {{$i}}</>
                    @endfor
                  </select>
                </div>
              </div>


              <div class="form-group">
                <label class="col-lg-3 control-label">Nama Kelas</label>
                <div class="col-lg-8">
                  <input class="form-control" type="text" name="NamaKelas" value="{{old('NamaKelas')}}" required pattern="[a-zA-Z0-9/]+.{3,}" title="Minimal 4 Karakter">
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Ruangan</label>
                <div class="col-lg-8">
                  <input class="form-control" type="text" name="Ruangan" value="{{old('Ruangan')}}" required pattern="[a-zA-Z0-9/]+.{3,}" title="Minimal 4 Karakter">
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Tanggal</label>
                <div class="col-lg-8">
                  <input class="form-control" type="date" name="Tanggal" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required min="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Waktu Mulai</label>
                <div class="col-lg-8">
                  <input class="form-control" type="time" name="WaktuMulai" value="{{Carbon\Carbon::now()->format('H:i')}}" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Waktu Mulai</label>
                <div class="col-lg-8">
                  <input class="form-control" type="time" name="WaktuSelesai" value="{{Carbon\Carbon::now()->addMinutes(45)->format('H:i')}}" required>
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
