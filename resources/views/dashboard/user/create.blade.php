@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Tambah User</h1>
    </div>

    <div class="col-lg-8">
        <form action="/dashboard/user" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama User" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="nama@user.com" value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                @error('role_id')
                <small class="d-block text-danger">{{ $message }}</small>
                @enderror
                <select id="role" class="form-select" name="role_id" onchange="showHidden()">
                    <option value="0" selected>Pilih Role</option>
                    @foreach ($roles as $role)                        
                        @if (old('role_id') == $role->id)
                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                        @else
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
                {{-- CONDITIONAL --}}
            <div class="mb-3 nim" style="display: none">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="231xxxxx" value="{{ old('nim') }}">
                @error('nim')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" id="button" style="display: none" class="btn btn-sm btn-primary mb-3">Buat User</button>
        </form>
    </div>

    <script>
        const selected = document.querySelector('#role');
        const nim = document.querySelector('.nim');
        const submit = document.querySelector('#button');

        if (selected.value != 0) {
            submit.style.display = 'block';
        }

        if (selected.value != 0 && selected.value == 2) {
            submit.style.display = 'block';
            nim.style.display = 'block';
        }

        function showHidden() {
    
            if (selected.value == 0) {
                submit.style.display = 'none';
            } else {
                submit.style.display = 'block';
            }

            if (selected.value == 2) {
                nim.style.display = 'block';
            } else {
                nim.style.display = 'none';
            }
        }
        </script>
@endsection