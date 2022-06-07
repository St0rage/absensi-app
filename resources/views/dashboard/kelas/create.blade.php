@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Tambah Kelas</h1>
    </div>

    <div class="col-lg-5">
        <form action="/dashboard/classroom" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Kelas" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" id="button" class="btn btn-sm btn-primary mb-3">Buat Kelas</button>
        </form>
    </div>
@endsection