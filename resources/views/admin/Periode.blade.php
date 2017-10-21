@extends('admin.Layouts.Master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Periode
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
                  <a href="/admin/periode/tambah">
                    <button type="button" class="btn btn-block btn-info btn"> <i class="fa fa-plus"></i> <b>Tambah Periode Baru</b></button>
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
                  <th>Periode</th>
                  <th>Tanggal Tutup</th>
                  <th>Status</th>
                  <th><center> Aksi </center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($Periode as $DataPeriode)
                    <tr>
                      <td> {{ $no+=1 }} </td>
                      <td> {{ $DataPeriode->periode }} </td>
                      <td> {{ $DataPeriode->tanggal_tutup }} </td>
                      <td>
                        <center>
                          @if ($DataPeriode->status == 1)
                            <span class="pull-right-container">
                              <small class="label pull-center bg-green"><b>AKTIF</b></small>
                            </span>
                          @else
                            <span class="pull-right-container">
                              <small class="label pull-center bg-red"><b>TIDAK AKTIF</b></small>
                            </span>
                          @endif
                        </center>
                      </td>
                      <td>
                        <center>
                          <a href="/admin/periode/{{ Crypt::encryptString($DataPeriode->id) }}/edit">
                            <button type="button" class="btn btn-info"> <i class="fa fa-pencil"></i> <b>Edit</b></button>
                          </a>
                            <button type="button" class="btn btn-danger" onclick="{{ count($DataPeriode->JadwalDosen) > 0 ? 'CantHapus' : 'hapus' }}('{{ Crypt::encryptString($DataPeriode->id) }}','{{$DataPeriode->periode}}')"> <i class="fa fa-trash-o"></i> <b>Hapus</b></button>
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
