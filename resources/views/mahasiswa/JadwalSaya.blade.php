@extends('mahasiswa.Layouts.Master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jadwal Saya
        <small>{{$NamaPeriode}}</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-sm-12">
          <div class="callout callout-info">
            <h4><i class="fa fa-info"></i> Jadwal Materi Praktikum</h4>

            <p> Ini Merupakan Jadwal Praktikum Yang Telah di Ambil Pada Periode {{$NamaPeriode}} </p>
          </div>
        </div>

        {!! Form::open(['url'=>Request::url(),'files'=>true,'class'=>'register-form', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}
        <div class="col-lg-12">
          <div class="form-group">
            <label class="col-lg-1" style="top: 5px;left: 40px;">Periode</label>
            <div class="col-lg-3" style="margin-bottom:10px">
              <select required class="form-control" name="idPeriode">
                  @foreach ($Periode as $DataPeriode)
                    <option value="{{$DataPeriode->id}}" {{isset($idPeriode) ? $idPeriode == $DataPeriode->id ? 'selected' : '' : ''}}>{{$DataPeriode->periode}}</>
                  @endforeach
              </select>
            </div>
            <div class="col-lg-1">
              <button type="submit" class="btn btn-block btn-info btn">
                <i class="fa fa-filter"></i> <b>Filter</b>
              </button>
            </div>
          </div>
        </div>
      </form>

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
