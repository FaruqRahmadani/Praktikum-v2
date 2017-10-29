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
        <div class="col-sm-12">
          @if (count($JadwalDosen) == 0)
          <div class="callout callout-warning">
            <h4><i class="fa fa-info"></i> Materi</h4>

            <p> Materi Praktikum Belum Tersedia </p>
          </div>
          @elseif ($JumlahMateridiAmbil < 2)
            <div class="callout callout-info">
              <h4><i class="fa fa-info-circle"></i> Jumlah Materi</h4>

              <p> Pada Periode <b>{{ $Periode->periode }}</b> Ini, Anda Telah Mengambil <b>{{$JumlahMateridiAmbil}}</b> Materi </p>
            </div>
          @elseif ($Periode->status == 0)
            <div class="callout callout-danger">
              <h4><i class="fa fa-info"></i> Periode</h4>

              <p> Periode {{$Periode->periode}} Telah di Tutup</p>
            </div>
          @else
            <div class="callout callout-warning">
              <h4><i class="fa fa-info"></i> Jumlah Materi</h4>

              <p> Anda Telah Mengambil Jumlah Materi Maksimal Untuk Periode Ini </p>
            </div>
          @endif


          @if (session('success'))
            <div class="callout callout-success">
              <h4><i class="fa fa-warning"></i> Berhasil</h4>

              <p> {{ session('success') }} </p>
            </div>
          @endif
        </div>

        @foreach ($JadwalDosen as $DataJadwalDosen)
          <div class="col-xs-4">
            <div class="box box-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-aqua-active" style="background: url('/image/materi/{{ $DataJadwalDosen->Materi->gambar }}') center center no-repeat; background-size: cover;">
                <h3 class="widget-user-username"><b style="background-color: rgba(0, 0, 0, 0.65);">{{ $DataJadwalDosen->Materi->materi_praktikum }}</b></h3>
                <h5 class="widget-user-desc"><b style="background-color: rgba(0, 0, 0, 0.65);">{{ $DataJadwalDosen->Dosen->nama }}</b></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="/image/dosen/{{ $DataJadwalDosen->Dosen->foto }}" alt="{{ $DataJadwalDosen->Materi->materi_praktikum }}" style="height: 90px;">
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
                      @if (($JumlahMateridiAmbil >= 2) || ($Periode->status == 0))
                        <button class="btn btn-info btn-block btn-circle" disabled><b>Dikunci</b></button>
                      @else
                        <a href="/mahasiswa/materi/{{Crypt::encryptString($DataJadwalDosen->id)}}">
                          <button class="btn btn-success btn-block btn-circle"><b>Informasi</b></button>
                        </a>
                      @endif
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
@endsection
