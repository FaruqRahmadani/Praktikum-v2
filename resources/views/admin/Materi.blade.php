@extends('admin.Layouts.Master')
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
              @if (session('warning'))
                <div class="callout callout-warning">
                  <h4><i class="fa fa-warning"></i> Berhasil Hapus</h4>

                  <p> {{ session('warning') }} </p>
                </div>
              @endif

              <div class="row">
                <div class="col-sm-2">
                  <a href="/admin/materi/tambah">
                    <button type="button" class="btn btn-block btn-info btn"> <i class="fa fa-plus"></i> <b>Tambah Materi Baru</b></button>
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
                          {{ $DataMateri->semester }}
                        </center>
                      </td>
                      <td>
                        <center>
                          <a href="/admin/materi/{{ Crypt::encryptString($DataMateri->id) }}/edit">
                            <button type="button" class="btn btn-info"> <i class="fa fa-pencil"></i> <b>Edit</b></button>
                          </a>
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
      text  : "Data Periode '"+nama+"' Tidak Dapat di Hapus Karena Ada Jadwal Dosen Yang Menggunakan Periode Tersebut",
      icon  : "warning",
    });
  }

  function hapus(id,nama)
  {
    swal({
      title   : "Hapus",
      text    : "Yakin Ingin Menghapus Data Periode '"+nama+"'?",
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
          text   : "Data Periode '"+nama+"' Berhasil di Hapus",
          icon   : "success",
          timer  : 5000,
          button : false,
        });
        window.location = "/admin/periode/"+id+"/hapus";
      } else {
        swal({
          title  : "Batal Hapus",
          text   : "Data Periode '"+nama+"' Batal di Hapus",
          icon   : "info",
          timer  : 2011,
          button : false,
        })
      }
    });
  }
</script>
@endsection
