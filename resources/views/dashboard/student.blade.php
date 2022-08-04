@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Mata Kuliah Hari Ini</h1>
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
<div class="container mb-3">
    <div class="row">
        <div class="col-lg-12 px-0 d-flex flex-wrap">
            @foreach ($activeAttendances as $activeAttendance)    
            <div class="card mx-3 mb-3" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">{{ $activeAttendance->subject_name }}</h5>
                  <h6 class="card-subtitle text-muted">{{ $activeAttendance->name }}</h6>
                </div>
                <ul class="list-group list-group-flush border-0">
                    <li class="list-group-item">{{ $activeAttendance->classroom_name }}</li>
                    <li class="list-group-item">{{ $activeAttendance->subject_matter }}</li>
                    <li class="list-group-item">Pertemuan ke {{ $activeAttendance->meeting }}</li>
                    <li class="list-group-item">Batas Absensi {{ $activeAttendance->expired }}</li>
                </ul>
                <div class="card-body">
                    <a href="/dashboard/attendance/create/{{ $activeAttendance->id }}" class="btn btn-sm btn-primary">Buka Absensi</a>
                  </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

    
@endsection