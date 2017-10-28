@extends('mahasiswa.Layouts.Master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Materi
        <small>{{$NamaMateri}}</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        @foreach ($JadwalDosen as $DataJadwalDosen)
          {!! Form::open(['url'=>Request::url().'/'.$DataUser->id,'files'=>true,'class'=>'register-form', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}

          <div class="form-group">
            <label class="col-lg-3 control-label">Materi</label>
            <div class="col-lg-8">
              <label class="control-label">{{$DataJadwalDosen->Materi->materi_praktikum}}</label>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Dosen</label>
            <div class="col-lg-8">
              <label class="control-label">{{$DataJadwalDosen->Dosen->nama}}</label>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Semester Minimal</label>
            <div class="col-lg-8">
              <label class="control-label">{{$DataJadwalDosen->Materi->semester}}</label>
            </div>
          </div>

          @php
            $JumlahPertemuan = $DataJadwalDosen->JadwalPraktikum->max('pertemuan');
          @endphp

          <div class="form-group">
            <label class="col-lg-3 control-label">Jumlah Pertemuan</label>
            <div class="col-lg-8">
              <label class="control-label">{{$JumlahPertemuan}} Pertemuan</label>
            </div>
          </div>

          @for ($i=1; $i <= $JumlahPertemuan ; $i++)
            <div class="form-group">
              <label class="col-lg-3 control-label">Pertemuan {{$i}}</label>
              <div class="col-lg-8">
                <div class="input-group">
                  <!-- /btn-group -->
                  <input type="text" class="form-control" id="DumpPertemuan{{$i}}" required readonly style="background-color : white;" data-toggle="modal" data-target="#modal-pertemuan-{{$i}}">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-pertemuan-{{$i}}"><b>Pilih Jadwal</b></button>
                  </div>
                </div>
                <input type="hidden" name="Pertemuan{{$i}}" id="IDpertemuan{{$i}}" class="form-control" required>
              </div>
            </div>
          @endfor

        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="row">
            <div class="col-md-3">
              <button type="reset" class="btn btn-block btn-danger btn">
                <i class="fa fa-times"></i> <b>Reset</b>
              </button>
            </div>
            <div class="col-md-3">
              <button type="submit" class="btn btn-block btn-info btn">
                <i class="fa fa-save"></i> <b>Simpan</b>
              </button>
            </div>
          </div>
        </div>

      </form>
        @for ($i=1; $i <= $JumlahPertemuan ; $i++)
          <div class="modal fade" id="modal-pertemuan-{{$i}}">
            <div class="modal-dialog" style="min-width: 75%;">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Jadwal Pertemuan Ke-{{$i}}</h4>
                </div>
                <div class="modal-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nama Kelas</th>
                      <th>Ruangan</th>
                      <th>Tanggal</th>
                      <th>Waktu Mulai</th>
                      <th>Waktu Selesai</th>
                      <th>Jumlah Mahasiswa</th>
                      <th><center> Pilih </center></th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($DataJadwalDosen->JadwalPraktikum as $DataJadwalPraktikum)
                        @if ($DataJadwalPraktikum->pertemuan == $i)
                          <tr>
                            <td> {{ $DataJadwalPraktikum->nama_kelas }} </td>
                            <td> {{ $DataJadwalPraktikum->ruangan }} </td>
                            <td> {{ Carbon\Carbon::parse($DataJadwalPraktikum->tanggal)->format('d F Y') }} </td>
                            <td> {{ Carbon\Carbon::parse($DataJadwalPraktikum->waktu_mulai)->format('H:i A') }} </td>
                            <td> {{ Carbon\Carbon::parse($DataJadwalPraktikum->waktu_selesai)->format('H:i A') }} </td>
                            @php
                              $JumlahMahasiswa = count(App\AbsensiMahasiswa::where('id_jadwal_praktikum', $DataJadwalPraktikum->id)->get());
                            @endphp
                            <td>
                              <center>
                                {{ $JumlahMahasiswa }} Orang
                              </center>
                            </td>
                            <td>
                              <center>
                                <button type="button" class="btn btn-info" data-dismiss="modal" onclick="pilihJadwal('{{$i}}','{{$DataJadwalPraktikum->id}}','{{$DataJadwalPraktikum->nama_kelas}}','{{Carbon\Carbon::parse($DataJadwalPraktikum->tanggal)->format('d F Y')}}','{{Carbon\Carbon::parse($DataJadwalPraktikum->waktu_mulai)->format('H:i A')}}','{{Carbon\Carbon::parse($DataJadwalPraktikum->waktu_mulai)->format('H:i A')}}')"> <i class="fa fa-check-circle"></i> <b>Pilih</b></button>
                              </center>
                            </td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
        @endfor

        @endforeach
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
</div>
</body>

<script>
  function pilihJadwal(pertemuan,id,NamaKelas,Tanggal,WaktuMulai,WaktuSelesai)
  {
    document.getElementById('IDpertemuan'+pertemuan).value = id;
    document.getElementById('DumpPertemuan'+pertemuan).value = NamaKelas+' | '+Tanggal+' | '+WaktuMulai+' - '+WaktuSelesai;
  }
</script>
@endsection
