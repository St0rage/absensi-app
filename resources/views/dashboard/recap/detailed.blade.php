@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $attendance->classroomSubject->subject->name }} | {{ $attendance->classroomSubject->classroom->name }}</h1>
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

    <h6 class="mt-4">Daftar Kehadiran Mahasiswa | Pertemuan Ke-{{ $attendance->meeting }} | Materi Perkuliahan {{ $attendance->subject_matter }}</h6>
    <div class="table-responsive col-lg-10 mb-4 mt-3">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">NIM</th>
              <th scope="col">Status Kehadiran</th>
              <th scope="col">Tanda Tangan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($attendance->attendances as $userAttendance)    
            <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td>{{ $userAttendance->user->name }}</td>
              <td>{{ $userAttendance->user->nim }}</td>
              <td>{{ $userAttendance->attendanceStatus->name }}</td>
              <td>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#signatureModal{{ $loop->iteration }}">
                  Tampilkan
                </button>
              </td>
            </tr>

            <div class="modal fade" id="signatureModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="label" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="label">{{ $userAttendance->user->name }}</h5>
                  </div>
                  <div class="modal-body">
                    <img class="img-fluid" src="{{ $userAttendance->signature ? asset('storage/' . $userAttendance->signature ) : '' }}" alt="">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection