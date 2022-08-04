@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Mata Kuliah</h1>
    </div>

    <div class="col-lg-5">
        <form action="/dashboard/subject/{{ $subject->subject_code }}" method="post">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="subject_code" class="form-label">Kode Mata Kuliah</label>
                <input type="text" class="form-control @error('subject_code') is-invalid @enderror" id="subject_code" name="subject_code" placeholder="Kode Mata Kuliah" value="{{ old('subject_code', $subject->subject_code) }}">
                @error('subject_code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Mata Kuliah</label>
                <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Mata Kuliah" value="{{ old('name', $subject->name) }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">Dosen</label>
                @error('user_id')
                <small class="d-block text-danger">{{ $message }}</small>
                @enderror
                <select id="user_id" class="form-select" name="user_id">
                    <option value="0" selected>Pilih Dosen</option>
                    @foreach ($users as $user)                        
                        @if (old('user_id', $subject->user_id) == $user->id)
                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                        @else
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            

            <button type="submit" id="button" class="btn btn-sm btn-primary mt-3">Edit Mata Kuliah</button>
        </form>
    </div>
@endsection