@extends('admin.Layouts.Master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Mahasiswa
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
                  <th>NPM</th>
                  <th>Nama</th>
                  <th>Nomor HP</th>
                  <th>E-Mail</th>
                  <th>Username</th>
                  <th><center> Aksi </center></th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($Mahasiswa as $DataMahasiswa)
                    <tr>
                      <td>{{ $no+=1 }}</td>
                      <td> {{ $DataMahasiswa->NPM }} </td>
                      <td> {{ $DataMahasiswa->nama }} </td>
                      <td> {{ $DataMahasiswa->no_hp }} </td>
                      <td> {{ $DataMahasiswa->email }} </td>
                      <td> {{ App\User::find($DataMahasiswa->id_user)->username }} </td>
                      <td>
                        <center>
                          <a href="/admin/datamahasiswa/{{ Crypt::encryptString($DataMahasiswa->id) }}/edit">
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
@endsection
