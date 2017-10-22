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
              @endif
              <hr>
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
                  <th><center> Aksi </center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($Materi as $DataMateri)
                    <tr>
                      <td> {{ $no+=1 }} </td>
                      <td> {{ $DataMateri->kode_mk }} </td>
                      <td> {{ $DataMateri->materi_praktikum }} </td>
                      <td>
                        <center>
                          Semester {{ $DataMateri->semester }}
                        </center>
                      </td>
                      <td>
                        <center>
                          @php
                            // Menentukan Apakah Sudah di Ambil / Belum
                            $JadwalDosen = App\JadwalDosen::where('id_dosen', $DataUser->id)
                                                          ->where('id_periode', $Periode->id)
                                                          ->where('id_praktikum', $DataMateri->id)
                                                          ->first();
                            $JumlahDiAmbil = count($JadwalDosen);
                            $JadwalPraktikum = App\JadwalPraktikum::where('id_jadwal_dosen', $JadwalDosen['id'])
                                                                  ->first();
                            $JumlahJadwalPraktikum = count($JadwalPraktikum);
                          @endphp
                          @if ($JumlahDiAmbil > 0)
                            <button type="button" class="btn btn-danger" onclick="{{$JumlahJadwalPraktikum > 0 ? 'CantHapus' : 'hapus'}}('{{Crypt::encryptString($DataMateri->id)}}','{{$DataMateri->materi_praktikum}}','{{Crypt::encryptString($DataUser->id)}}','{{Crypt::encryptString($Periode->id)}}')"> <i class="fa fa-trash-o"></i> <b>Hapus</b></button>
                          @else
                            <button type="button" class="btn btn-success" onclick="ambil('{{Crypt::encryptString($DataMateri->id)}}','{{$DataMateri->materi_praktikum}}')"> <i class="fa fa-plus-square"></i> <b>Tambah</b></button>
                          @endif
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
  function ambil(id,nama)
  {
    swal({
      title : "Ambil Materi",
      text  : "Data Materi '"+nama+"' Berhasil di Ambil",
      icon  : "success",
      timer  : 5000,
    });
    window.location = "/dosen/datamateri/ambil/"+id;
  }

  function CantHapus(id,nama,idDosen,idPeriode)
  {
    swal({
      title : "Hapus",
      text  : "Data Materi '"+nama+"' Tidak Dapat di Hapus Karena Ada Jadwal Didalam Materi Tersebut",
      icon  : "warning",
    });
  }

  function hapus(id,nama,idDosen,idPeriode)
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
        window.location = "/dosen/datamateri/ambil/"+id+"/"+idDosen+"/"+idPeriode+"/hapus";
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
