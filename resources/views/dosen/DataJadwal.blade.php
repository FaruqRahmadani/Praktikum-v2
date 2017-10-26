@extends('dosen.Layouts.Master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jadwal
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Info boxes -->
      <div class="box box-primary">
            <div class="box-header">
              @if (session('success'))
                <div class="callout callout-success">
                  <h4><i class="fa fa-check"></i> Berhasil</h4>

                  <p> {{ session('success') }} </p>
                </div>
              @else
                <div class="callout callout-info">
                  <h4><i class="fa fa-info-circle"></i> Info Periode</h4>

                  <p> Ini Merupakan Data Jadwal Anda Pada Periode <b>{{ $Periode->periode }}</b> </p>
                </div>
              @endif
              <hr>
              <div class="row">
                <div class="col-sm-2">
                  <a href="/dosen/jadwal/tambah">
                    <button type="button" class="btn btn-block btn-info btn"> <i class="fa fa-plus"></i> <b>Tambah Jadwal</b></button>
                  </a>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  @php
                    // Meninialisasi Nomor
                    $no = 0;
                  @endphp
                <tr>
                  <th>#</th>
                  <th>Materi Praktikum</th>
                  <th>Nama Kelas</th>
                  <th>Ruangan</th>
                  <th>Pertemuan</th>
                  <th>Tanggal</th>
                  <th>Waktu</th>
                  <th>Status</th>
                  <th><center> Aksi </center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($JadwalDosen as $DataJadwalDosen)
                    @foreach ($DataJadwalDosen->JadwalPraktikum as $DataJadwalPraktikum)
                      <tr>
                        <td> {{ $no+=1 }} </td>
                        <td> {{ $DataJadwalDosen->Materi->materi_praktikum }} </td>
                        <td> {{ $DataJadwalPraktikum->nama_kelas }} </td>
                        <td> {{ $DataJadwalPraktikum->ruangan }} </td>
                        <td> {{ $DataJadwalPraktikum->pertemuan }} </td>
                        <td> {{ Carbon\Carbon::parse($DataJadwalPraktikum->tanggal)->format('d F Y') }} </td>
                        <td> {{ Carbon\Carbon::parse($DataJadwalPraktikum->waktu_mulai)->format('h:i A') }} - {{ Carbon\Carbon::parse($DataJadwalPraktikum->waktu_selesai)->format('h:i A') }} </td>
                        <td>
                          <center>
                            @if (Carbon\Carbon::parse($DataJadwalPraktikum->tanggal) < Carbon\Carbon::now())
                              @php
                                $Status = 3;
                              @endphp
                              Sudah Berakhir
                              <span class="pull-right-container">
                                <span class="label label-warning pull-right"><i class="fa fa-warning"></i></span>
                              </span>
                            @else
                              @php
                                $Status = $DataJadwalPraktikum->status;
                              @endphp
                              @if ($DataJadwalPraktikum->tipe == 1)
                                Aktif
                                <span class="pull-right-container">
                                  <span class="label label-success pull-right"><i class="fa fa-check"></i></span>
                                </span>
                              @else
                                Tidak Aktif
                                <span class="pull-right-container">
                                  <span class="label label-danger pull-right"><i class="fa fa-times"></i></span>
                                </span>
                              @endif
                            @endif
                          </center>
                        </td>
                        <td>
                          <center>
                            <button type="button" class="btn btn-info" onclick="{{$Status == 3 ? 'CantUbahStatus' : 'UbahStatus'}}('{{Crypt::encryptString($DataJadwalPraktikum->id)}}','{{$DataJadwalDosen->Materi->materi_praktikum}}','{{$DataJadwalPraktikum->tipe == 1 ? 'NonAktif' : 'Aktif'}}')"> <i class="fa fa-pencil"></i> <b>Ubah Status</b></button>
                            <a href="/dosen/jadwal/{{Crypt::encryptString($DataJadwalPraktikum->id)}}/edit">
                              <button type="button" class="btn btn-warning"> <i class="fa fa-pencil"></i> <b>Edit</b></button>
                            </a>
                          </center>
                        </td>
                      </tr>
                    @endforeach
                  @endforeach
                </tbody>
              </table>
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

<script>
function CantUbahStatus(id,namaPraktikum,status)
{
  swal({
    title  : "Warning",
    text   : "Jadwal Praktikum '"+namaPraktikum+"' Telah Berakhir, Tidak Dapat Dirubah Status",
    icon   : "info",
    button : true,
  })
}
function UbahStatus(id,namaPraktikum,status)
{
  swal({
    title   : "Rubah Status Jadwal Praktikum",
    text    : "Apakah Anda Yakin Ingin Merubah Status Praktikum '"+namaPraktikum+"'' menjadi "+status+" ?",
    icon    : "warning",
    buttons : [
      "Batal",
      "Lanjut",
    ],
  })
  .then((Yes) => {
    if (Yes) {
      swal({
        title  : "Berhasil",
        text   : "Jadwal Praktikum '"+namaPraktikum+"' Berhasil di Ubah Menjadi "+status,
        icon   : "success",
        timer  : 5000,
        button : false,
      });
      window.location = "/dosen/jadwal/"+id+"/status/"+status;
    } else {
      swal({
        title  : "Batal",
        text   : "Jadwal Praktikum '"+namaPraktikum+"' Tidak Berubah",
        icon   : "info",
        timer  : 2011,
        button : false,
      })
    }
  });
}
</script>
@endsection
