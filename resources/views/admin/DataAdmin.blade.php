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
      <div class="box">
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
                        </center>
                      </td>
                    </tr>
                  @endforeach
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
