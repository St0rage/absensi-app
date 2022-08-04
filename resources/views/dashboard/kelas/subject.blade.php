@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
        <h1 class="h2">Daftar Mata Kuliah Kelas {{ $classroom->name }}</h1>
    </div>

    @error('subject_id')
    <div class="alert alert-warning mt-3 col-lg-6" role="alert">
      {{ $message }}
    </div>
    @enderror
    @if (session()->has('success'))  
    <div class="alert alert-success col-lg-8" role="alert">
      {{ session('success') }}
    </div>
    @endif
    
    <div class="mb-3 mt-3 col-lg-6">
      <form class="d-flex align-items-center justify-content-between" action="/dashboard/classroom/subject" method="post">
        @csrf
        <div>
          <select id="subject_id" class="form-select" name="subject_id">
              <option value="0" selected>Pilih Mata Kuliah</option>
              @foreach ($subjects as $subject)                        
                  <option value="{{ $subject->id }}">{{ $subject->subject_code }}  {{ $subject->name }}</option>
              @endforeach
          </select>
        </div>
        <input type="text" value="{{ $classroom->id }}" name="classroom_id" hidden />
        <button type="submit" id="button" class="btn btn-sm btn-primary">Tambah Mata Kuliah</button>
      </form>
    </div>

    <div class="table-responsive col-lg-8 mb-4">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Kode Mata Kuliah</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Dosen</th>
                  <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classroom->subjects as $subject)
                <tr>
                  <td scope="row">{{ $loop->iteration }}</td>
                  <td>{{ $subject->subject_code }}</td>
                  <td>{{ $subject->name }}</td>
                  <td>{{ $subject->user->name }}</td>
                  <td>
                    <form action="/dashboard/classroom/subject/{{ $classroom->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <input type="text" value="{{ $subject->id }}" name="subject_id" hidden />
                        <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Yakin ingin ingin menghapus mata kuliah ini')" ><span data-feather="x-circle"></span></button>
                    </form>
                  </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection