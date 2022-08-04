@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Profil</h1>
    </div>

    @if (session()->has('success'))  
    <div class="alert alert-success col-lg-12" role="alert">
      {{ session('success') }}
    </div>
    @endif

    <div class="container">
        <div class="row d-flex align-items-stretch">
            <div class="col-lg-4 px-0">
                <div class="card rounded-0 border-start border-top border-bottom">
                    <img src="https://gravatar.com/avatar/2cb87083cb43c63309bf626eedd3769c?s=200&d=mp&r=x" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title text-center">{{ $user->name }}</h5>
                      <p class="card-text text-center fs-5">{{ $user->role->name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 d-flex px-0">
                <div class="card flex-fill rounded-0 border-end border-bottom border-top">
                    <h5 class="card-header bg-white px-4">Informasi</h5>
                    <div class="card-body d-flex flex-wrap justify-content-start px-4">
                        <div style="margin-right: 15px" class="mt-3">
                            <div>
                                <h5>Email</h5>
                                <h6 class="text-muted">{{ $user->email }}</h6>
                            </div>
                            <div class="mt-3">
                                <h5>Kelas</h5>
                                <h6 class="text-muted">{{ $user->classroom->name ?? '-' }}</h6>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div>
                                <h5>NIM</h5>
                                <h6 class="text-muted">{{ $user->nim ?? '-' }}</h6>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex">
                                    <h5 class="d-block">Password</h5>
                                    <div class="px-2">
                                        <a class="text-decoration-none text-muted" href="/dashboard/profile/{{ $user->id }}/edit">
                                            <span data-feather="edit-2"></span>
                                        </a>
                                    </div>
                                </div>
                                <h6 class="text-muted">*****</h6>
                            </div>
                        </div>
                    </div>
                    @if (auth()->user()->role_id != 1)    
                    <div class="card-body">
                        <p class="text-center fs-6">Untuk Mengganti Informasi Email Silahkan Hubungi Staff Prodi / Admin</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
   
@endsection