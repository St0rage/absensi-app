@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">User</h1>
    </div>

    @if (session()->has('success'))  
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
    @endif
    <a href="/dashboard/user/create" class="btn btn-sm btn-primary my-2">Tambah User</a>
    <div class="table-responsive col-lg-10 mb-4">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">NIM</th>
              <th scope="col">Role</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)    
            <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->nim }}</td>
              <td>{{ $user->role->name }}</td>
              <td>
                  <a href="/dashboard/user/{{ $user->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                  <form action="/dashboard/user/{{ $user->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Yakin ingin ingin menghapus user ini')" ><span data-feather="user-x"></span></button>
                  </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection