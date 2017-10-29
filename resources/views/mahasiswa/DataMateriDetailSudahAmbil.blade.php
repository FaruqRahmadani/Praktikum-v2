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
        <div class="col-sm-12">
          <div class="callout callout-warning">
            <h4><i class="fa fa-info"></i> Materi Sudah Di Ambil</h4>

            <p> Anda Sudah Mengambil Jadwal Untuk Materi Ini </p>
          </div>
        </div>

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

          <div class="col-lg-12">
            <div class="box">
              <div class="box-body">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>Pertemuan</th>
                    <th>Nama Kelas</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($AbsensiMahasiswa as $DataAbsensiMahasiswa)
                        <tr>
                          <td> {{ $DataAbsensiMahasiswa['JadwalPraktikum']['pertemuan'] }} </td>
                          <td> {{ $DataAbsensiMahasiswa['JadwalPraktikum']['nama_kelas'] }} </td>
                          <td> {{ $DataAbsensiMahasiswa['JadwalPraktikum']['ruangan'] }} </td>
                          <td>
                            {{ Carbon\Carbon::parse($DataAbsensiMahasiswa['JadwalPraktikum']['tanggal'])->format('d F Y') }}
                          </td>
                          <td>
                            {{ Carbon\Carbon::parse($DataAbsensiMahasiswa['JadwalPraktikum']['waktu_mulai'])->format('H:i A') }} - {{ Carbon\Carbon::parse($DataAbsensiMahasiswa['JadwalPraktikum']['waktu_selesai'])->format('H:i A') }}
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

      </form>

        @endforeach
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
  function pilihJadwal(pertemuan,id,NamaKelas,Tanggal,WaktuMulai,WaktuSelesai)
  {
    document.getElementById('IDpertemuan'+pertemuan).value = id;
    document.getElementById('DumpPertemuan'+pertemuan).value = NamaKelas+' | '+Tanggal+' | '+WaktuMulai+' - '+WaktuSelesai;
  }
</script>
@endsection
