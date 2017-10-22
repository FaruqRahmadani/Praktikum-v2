@extends('dosen.Layouts.Master')
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
                  <th>Semester</>
                  <th>Nomor HP</th>
                  <th>E-Mail</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($Mahasiswa as $DataMahasiswa)
                    @php
                      $Angkatan = substr($DataMahasiswa->NPM,0,2);
                      (date('n') > 8) ? $TambahanSemester = 1 : $TambahanSemester = 0 ;
                      $Semester = ((date('y')-$Angkatan)*2)+$TambahanSemester;
                    @endphp
                    <tr>
                      <td>{{ $no+=1 }}</td>
                      <td> {{ $DataMahasiswa->NPM }} </td>
                      <td> {{ $DataMahasiswa->nama }} </td>
                      <td> Semester {{ $Semester }} </td>
                      <td> {{ $DataMahasiswa->no_hp }} </td>
                      <td> {{ $DataMahasiswa->email }} </td>
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
