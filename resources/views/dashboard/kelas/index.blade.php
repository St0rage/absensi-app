@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kelas</h1>
    </div>

    @if (session()->has('success'))  
    <div class="alert alert-success col-lg-8" role="alert">
      {{ session('success') }}
    </div>
    @endif
    <a href="/dashboard/classroom/create" class="btn btn-sm btn-primary my-2">Tambah Kelas</a>
    <div class="table-responsive col-lg-8 mb-4">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Kelas</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($classrooms as $classroom)    
            <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td>{{ $classroom->name }}</td>
              <td>
                  <a href="/dashboard/classroom/{{ $classroom->slug }}" class="badge bg-primary"><span data-feather="eye"></span></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection