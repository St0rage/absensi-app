@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $classroomSubject->subject->name }} | {{ $classroomSubject->classroom->name }}</h1>
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

    <h5>Daftar Pertemuan</h5>
    <div class="table-responsive-sm col-lg-9 mb-4">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
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
              <td>{{ $activeAttendance->subject_matter }}</td>
              <td>{{ $activeAttendance->meeting }}</td>
              <td>{{ $activeAttendance->expired }}</td>
              <td>
                <a href="/dashboard/attendance/recap/detail/{{ $activeAttendance->id }}" class="badge bg-primary"><span data-feather="eye"></span></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>

    <h5>Total Kehadiran Mahasiswa</h5>
    <div class="table-responsive-sm col-lg-3 mb-4">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th class="fit" scope="col">#</th>
              <th class="fit" scope="col">Nama</th>
              <th class="fit" scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($percentages as $percentage)    
            <tr>
              <td class="fit" scope="row">{{ $loop->iteration }}</td>
              <td class="fit">{{ $percentage->student_name }}</td>
              <td class="fit">{{ $percentage->attendance_total }}%</td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection