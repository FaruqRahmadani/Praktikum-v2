@extends('admin.Layouts.Master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Dosen
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
                  <th>NIDN</th>
                  <th>Nama</th>
                  <th>Nomor HP</th>
                  <th>E-Mail</th>
                  <th>Username</th>
                  <th>Status</th>
                  <th><center> Aksi </center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($Dosen as $DataDosen)
                    <tr>
                      <td>{{ $no+=1 }}</td>
                      <td> {{ $DataDosen->NIDN }} </td>
                      <td> {{ $DataDosen->nama }} </td>
                      <td> {{ $DataDosen->no_hp }} </td>
                      <td> {{ $DataDosen->email }} </td>
                      <td> {{ $DataDosen->User->username }} </td>
                      <td>
                        @if ($DataDosen->status == 0)
                          Tidak Aktif
                          <span class="pull-right-container">
                            <span class="label label-danger pull-right"><i class="fa fa-times"></i></span>
                          </span>
                        @else
                          Aktif
                          <span class="pull-right-container">
                            <span class="label label-success pull-right"><i class="fa fa-check"></i></span>
                          </span>
                        @endif
                      </td>
                      <td>
                        <center>
                          <button type="button" class="btn btn-success" onclick="UbahStatus('{{Crypt::encryptString($DataDosen->id)}}','{{$DataDosen->nama}}','{{$DataDosen->status == 0 ? 'Aktif' : 'Non-Aktif'}}')"> <i class="fa fa-list"></i> <b>Ubah Status</b></button>
                          <a href="/admin/datadosen/{{ Crypt::encryptString($DataDosen->id) }}/edit">
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

<script>
function UbahStatus(id,namaDosen,status)
{
  swal({
    title   : "Rubah Status Dosen",
    text    : "Apakah Anda Yakin Ingin Merubah Status Dosen '"+namaDosen+"'' menjadi "+status+" ?",
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
        text   : "Status Dosen '"+namaDosen+"' Berhasil di Ubah Menjadi "+status,
        icon   : "success",
        timer  : 5000,
        button : false,
      });
      window.location = "/admin/datadosen/"+id+"/status/"+status;
    } else {
      swal({
        title  : "Batal",
        text   : "Status Dosen '"+namaDosen+"' Tidak Berubah",
        icon   : "info",
        timer  : 2011,
        button : false,
      })
    }
  });
}
</script>

@endsection
