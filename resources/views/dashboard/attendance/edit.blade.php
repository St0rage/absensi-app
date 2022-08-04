@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Data Absensi Mahasiswa | {{ $attendance->activeAttendance->classroomSubject->subject->name }} | Pertemuan-{{ $attendance->activeAttendance->meeting}}</h1>
    </div>


    @error('signature')
    <div class="alert alert-danger col-lg-5" role="alert">
      {{ $message }}
    </div>
    @enderror 
    <div class="col-lg-5 mb-3">
        <form action="/dashboard/attendance/{{ $attendance->id }}" method="post">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="name" value="{{ $attendance->user->name }}" disabled>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" value="{{ $attendance->user->nim }}" disabled>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="nim" value="{{ $attendance->activeAttendance->classroomSubject->classroom->name }}" disabled>
            </div>
            <div class="mb-3">
                <label for="attendance_status_id" class="form-label">Status Kehadiran</label>
                <select id="attendance_status_id" class="form-select" name="attendance_status_id">
                    @foreach ($attendanceStatuses as $status)
                        @if ($status->id == $attendance->attendance_status_id)
                            <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                        @else                    
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanda Tangan Kehadiran</label>
                @if ($attendance->signature != null)    
                <img class="img-fluid border border-1" src="{{ asset('storage/'. $attendance->signature) }}" style="width: 100%; height: 200px">
                @else
                <div class="border border-1" style="width: 100%; height: 200px"></div>
                @endif
            </div>

            <button type="submit" id="button" class="btn btn-primary mt-4">Ubah absensi</button>
        </form>
    </div>
    
@endsection