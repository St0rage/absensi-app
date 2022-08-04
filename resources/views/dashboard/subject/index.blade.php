@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Mata Kuliah</h1>
    </div>

    @if (session()->has('success'))  
    <div class="alert alert-success col-lg-8" role="alert">
      {{ session('success') }}
    </div>
    @endif
    <a href="/dashboard/subject/create" class="btn btn-sm btn-primary my-2">Tambah Mata Kuliah</a>
    <div class="table-responsive col-lg-8 mb-4">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Kode Mata Kuliah</th>
              <th scope="col">Nama Mata Kulliah</th>
              <th scope="col">Dosen</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($subjects as $subject)    
            <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td>{{ $subject->subject_code }}</td>
              <td>{{ $subject->name }}</td>
              <td>{{ $subject->user->name }}</td>
              <td>
                  <a href="/dashboard/subject/{{ $subject->subject_code }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                  <form action="/dashboard/subject/{{ $subject->subject_code }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Yakin ingin ingin menghapus user ini')" ><span data-feather="x-circle"></span></button>
                  </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection