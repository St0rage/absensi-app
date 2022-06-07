@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
        <h1 class="h2">{{ $classroom->name }}</h1>
    </div>

    @if (session()->has('success'))  
    <div class="alert alert-success col-lg-8" role="alert">
      {{ session('success') }}
    </div>
    @endif
    <a href="/dashboard/classroom/participant/{{ $classroom->slug }}" class="btn btn-sm btn-primary my-3">Update Peserta</a>
    <h5>Daftar Peserta Kelas</h5>
    <div class="table-responsive col-lg-8 mb-4">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Peserta</th>
              <th scope="col">Nim</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)    
            <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->nim }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection