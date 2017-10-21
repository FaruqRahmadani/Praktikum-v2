@extends('admin.Layouts.Master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Admin
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
                  <a href="/admin/dataadmin/tambah">
                    <button type="button" class="btn btn-block btn-info btn"> <i class="fa fa-plus"></i> <b>Tambah Data Admin</b></button>
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
                  <th>Nama</th>
                  <th>E-Mail</th>
                  <th>Username</th>
                  <th><center> Aksi </center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($Admin as $DataAdmin)
                    <tr>
                      <td>{{ $no+=1 }}</td>
                      <td> {{ $DataAdmin->nama }} </td>
                      <td> {{ $DataAdmin->email }} </td>
                      <td> {{ $DataAdmin->username }} </td>
                      <td>
                        <center>
                          <a href="/admin/dataadmin/{{ Crypt::encryptString($DataAdmin->id) }}/edit">
                            <button type="button" class="btn btn-info"> <i class="fa fa-pencil"></i> <b>Edit</b></button>
                          </a>
                            <button type="button" class="btn btn-danger"  onclick=" {{ $DataAdmin->username == Auth::guard('admin')->user()->username ? 'CantHapus' : 'hapus' }}('{{ Crypt::encryptString($DataAdmin->id) }}','{{$DataAdmin->nama}}')"> <i class="fa fa-trash-o"></i> <b>Hapus</b></button>
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
      text  : "Tidak Dapat Mehapus Data Sendiri",
      icon  : "warning",
    });
}

  function hapus(id,nama)
  {
    swal({
      title   : "Hapus",
      text    : "Yakin Ingin Menghapus Data Admin '"+nama+"'?",
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
          text   : "Data Admin '"+nama+"' Berhasil di Hapus",
          icon   : "success",
          timer  : 5000,
          button : false,
        });
        window.location = "/admin/dataadmin/"+id+"/hapus";
      } else {
        swal({
          title  : "Batal Hapus",
          text   : "Data Admin '"+nama+"' Batal di Hapus",
          icon   : "info",
          timer  : 2011,
          button : false,
        })
      }
    });
  }
</script>
@endsection
