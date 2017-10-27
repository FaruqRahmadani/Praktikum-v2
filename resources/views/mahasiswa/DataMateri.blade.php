@extends('mahasiswa.Layouts.Master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daftar Materi
        <small>Periode {{$Periode->periode}}</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        @foreach ($JadwalDosen as $DataJadwalDosen)
          <div class="col-xs-4">
            <div class="box box-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username"><b>{{ $DataJadwalDosen->Materi->materi_praktikum }}</b></h3>
                <h5 class="widget-user-desc">{{ $DataJadwalDosen->Dosen->nama }}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="/image/materi/{{ $DataJadwalDosen->Materi->gambar }}" alt="{{ $DataJadwalDosen->Materi->materi_praktikum }}" style="height: 90px;">
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Semester</h5>
                      <span class="description-text">{{ $DataJadwalDosen->Materi->semester }}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Pertemuan</h5>
                      <span class="description-text">{{ $DataJadwalDosen->JadwalPraktikum->max('pertemuan') }}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <a href="/mahasiswa/materi/{{Crypt::encryptString($DataJadwalDosen->id)}}">
                        <button class="btn btn-success btn-block btn-circle"><b>Informasi</b></button>
                      </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
</div>
</body>
@endsection
