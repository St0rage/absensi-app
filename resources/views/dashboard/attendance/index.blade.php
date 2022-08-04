@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Absensi</h1>
    </div>

    @if (session()->has('success'))  
    <div class="alert alert-success col-lg-8" role="alert">
      {{ session('success') }}
    </div>
    @endif
    @if (session()->has('error'))  
    <div class="alert alert-danger col-lg-8" role="alert">
      {{ session('error') }}
    </div>
    @endif
    <h5>Daftar Mata Kuliah Saya</h5>
    <div class="table-responsive col-lg-5 mb-1">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Kode Mata Kuliah</th>
              <th scope="col">Mata Kuliah</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($subjects as $subject)    
            <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td>{{ $subject->subject_code }}</td>
              <td>{{ $subject->name }}</td>
              <td>
                  <a href="/dashboard/attendance/create?subject={{ $subject->subject_code }}" class="btn btn-primary btn-sm">Buat Absensi</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>

    <h5>Absensi Yang dibuka</h5>
    <div class="table-responsive-sm col-lg-10 mb-4">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Mata Kuliah</th>
              <th scope="col">Kelas</th>
              <th scope="col">Materi Perkuliahan</th>
              <th scope="col">Pertemuan Ke</th>
              <th scope="col">Batas Waktu Absensi</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($activeAttendances as $activeAttendance)    
            <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td>{{ $activeAttendance->subject_name }}</td>
              <td>{{ $activeAttendance->classroom_name }}</td>
              <td>{{ $activeAttendance->subject_matter }}</td>
              <td>{{ $activeAttendance->meeting }}</td>
              <td>{{ $activeAttendance->expired }}</td>
              <td>
                <a href="/dashboard/attendance/{{ $activeAttendance->id }}" class="badge bg-primary"><span data-feather="eye"></span></a>
                <form action="/dashboard/attendance/{{ $activeAttendance->id }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Yakin ingin ingin menghapus kelas absensi ini? jika dihapus maka mahasiswa yang sudah mengisi daftar hadir ini akan ikut terhapus')" ><span data-feather="x-circle"></span></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection