@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Rekapitulasi Absensi</h1>
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
            @foreach ($classroomSubjects as $classroomSubject)    
            <div class="card mx-3 mb-3" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">{{ $classroomSubject->classroom->name }}</h5>
                  <h6 class="card-subtitle text-muted">Angkatan</h6>
                </div>
                <div class="card-body">
                    <a href="/dashboard/recap/detail?classroomsubject={{ $classroomSubject->id }}" class="btn btn-sm btn-primary">Lihat Absensi</a>
                  </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

    
@endsection