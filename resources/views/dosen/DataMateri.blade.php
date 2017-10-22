@extends('dosen.Layouts.Master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Materi
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

                  <p> Ini Merupakan Data Materi Anda Pada Periode <b>{{ $Periode->periode }}</b> </p>
                </div>
              @endif
              <hr>
              <div class="row">
                <div class="col-sm-2">
                  <a href="/dosen/datamateri/ambil">
                    <button type="button" class="btn btn-block btn-info btn"> <i class="fa fa-plus"></i> <b>Ambil Materi Baru</b></button>
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
                  <th>Kode Materi</th>
                  <th>Materi Praktikum</th>
                  <th>Semester Minimal</th>
                  <th>Jumlah Jadwal Pertemuan</th>
                  <th><center> Aksi </center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($JadwalDosen as $DataJadwalDosen)
                    <tr>
                      <td> {{ $no+=1 }} </td>
                      <td> {{ $DataJadwalDosen['Materi']['kode_mk'] }} </td>
                      <td> {{ $DataJadwalDosen['Materi']['materi_praktikum'] }} </td>
                      <td>
                        <center>
                          Semester {{ $DataJadwalDosen['Materi']['semester'] }}
                        </center>
                      </td>
                      @php
                        $JumlahJadwalPraktikum = count(App\JadwalPraktikum::where('id_jadwal_dosen', $DataJadwalDosen->id)->get());
                      @endphp
                      <td>
                        <center>
                          {{ $JumlahJadwalPraktikum }} Pertemuan
                        </center>
                      </td>
                      <td>
                        <center>
                          <button type="button" class="btn btn-danger" onclick="{{$JumlahJadwalPraktikum > 0 ? 'CantHapus' : 'hapus'}}('{{Crypt::encryptString($DataJadwalDosen->id)}}','{{$DataJadwalDosen['Materi']['materi_praktikum']}}')"> <i class="fa fa-trash-o"></i> <b>Hapus</b></button>
                        </center>
                      </td>
                    </tr>
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

{{-- Validasi Hapus Data  --}}
<script>
  function CantHapus(id,nama)
  {
    swal({
      title : "Hapus",
      text  : "Data Materi '"+nama+"' Tidak Dapat di Hapus Karena Ada Jadwal Didalam Materi Tersebut",
      icon  : "warning",
    });
  }

  function hapus(id,nama)
  {
    swal({
      title   : "Hapus",
      text    : "Yakin Ingin Menghapus Data Materi '"+nama+"'?",
      icon    : "error",
      buttons : [
        "Batal",
        "Hapus",
      ],
    })
    .then((hapus) => {
      if (hapus) {
        swal({
          title  : "Berhasil",
          text   : "Data Materi '"+nama+"' Berhasil di Hapus",
          icon   : "success",
          timer  : 5000,
          button : false,
        });
        window.location = "/dosen/datamateri/"+id+"/hapus";
      } else {
        swal({
          title  : "Batal Hapus",
          text   : "Data Materi '"+nama+"' Batal di Hapus",
          icon   : "info",
          timer  : 2011,
          button : false,
        })
      }
    });
  }
</script>
@endsection
