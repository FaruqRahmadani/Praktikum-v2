@extends('mahasiswa.Layouts.Master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Mahasiswa</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Periode Sekarang</span>
              <span class="info-box-number">{{$Periode->first()->periode}}</span>
              @php
                $TanggalTutupPeriode = Carbon\Carbon::parse($Periode->first()->tanggal_tutup);
                $TanggalSekarang     = Carbon\Carbon::now();
                $SisaHariPeriode = $TanggalTutupPeriode->diffInDays($TanggalSekarang);
                if ($TanggalSekarang > $TanggalTutupPeriode) {
                  $SisaHariPeriode = $SisaHariPeriode*(-1);
                } else {
                  $SisaHariPeriode = $SisaHariPeriode*(1);
                }

                if ($SisaHariPeriode > 30) {
                  $Persentase = 0;
                }else {
                  $Persentase = $SisaHariPeriode/30*100;
                }
              @endphp
              <div class="progress">
                <div class="progress-bar progress-bar-aqua" style="width: {{100-$Persentase}}%; background: #00c0ef;"></div>
              </div>
              {{$SisaHariPeriode > 0 ? 'Tersisa '.$SisaHariPeriode.' Hari' : 'Telah Tutup'}}
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-bookmarks-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Materi Tersedia</span>
              <span class="info-box-number">{{count($JadwalDosen)}} Materi</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-book-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Materi Di Ambil</span>
              <span class="info-box-number">{{$JumlahMateridiAmbil}} Materi</span>
              <div class="progress">
                <div class="progress-bar progress-bar-aqua" style="width: {{$JumlahMateridiAmbil/2*100}}%; background: #00a65a;"></div>
              </div>
              Maksimal 2 Materi
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-calendar-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jadwal Akan Datang</span>
              @php
                if (($JadwalPraktikumNext != null)) {
                  $TanggalJadwal   = Carbon\Carbon::parse($JadwalPraktikumNext->tanggal);
                  $TanggalSekarang = Carbon\Carbon::now();
                  $SisaHari        = $TanggalJadwal->diffInDays($TanggalSekarang);
                  if ($TanggalSekarang > $TanggalJadwal) {
                    $SisaHari = $SisaHari*(-1);
                  } else {
                    $SisaHari = $SisaHari*(1);
                  }

                  if ($SisaHari > 30) {
                    $Persentase = 0;
                  }else {
                    $Persentase = $SisaHari/30*100;
                  }
                } else {
                  $SisaHari = -01012011;
                }
              @endphp
              @if ($SisaHari > 0)
                <span class="info-box-number">{{$JadwalPraktikumNext->nama_kelas}}</span>
                <div class="progress">
                  <div class="progress-bar progress-bar-aqua" style="width: {{100-$Persentase}}%; background: #f39c12;"></div>
                </div>
                {{$SisaHari}} hari Akan Datang
              @else
                <span class="info-box-number">Tidak Ada Jadwal Akan Datang</span>
              @endif

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">
                Wellcome Message
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-center">
                    <strong><h1><center>SELAMAT DATANG DI HALAMAN DASHBOARD MAHASISWA</center></h1></strong>
                  </p>

                  <p class="text-center">
                    <strong><h1><center>{{$DataUser->nama}}</center></h1></strong>
                  </p>

                </div>
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
