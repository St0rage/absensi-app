@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ubah Password</h1>
    </div>

    <div class="col-lg-5">
        <form action="/dashboard/profile/{{ $profile->id }}" method="post">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" autofocus>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password">
            </div>
            

            <button type="submit" id="button" class="btn btn-sm btn-primary mt-3">Ubah Password</button>
        </form>
    </div>
@endsection