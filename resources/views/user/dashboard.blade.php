@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('images/school-background.jpg') }}') no-repeat center center fixed;
        background-size: cover;
    }
    .sidebar {
        position: fixed;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 20px;
        border-radius: 0 10px 10px 0;
    }
    .sidebar a {
        display: block;
        color: white;
        padding: 10px;
        text-decoration: none;
        transition: 0.3s;
    }
    .sidebar a:hover {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 5px;
    }
    .welcome-text {
        text-align: center;
        color: white;
        font-size: 2rem;
        font-weight: bold;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
    }
</style>

<div class="sidebar">
    <a href="{{ route('user.dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('user.search') }}">🔍 Cari Siswa</a>
    @if(Auth::user() && Auth::user()->role == 'admin')
        <a href="{{ route('admin.manage') }}">⚙️ Kelola Data</a>
    @endif
    <a href="{{ route('logout') }}">🚪 Logout</a>
</div>

<div class="container py-5">
    <div class="welcome-text">Selamat Datang di SMKN 2 Sukabumi!</div>
    
    <div class="row justify-content-center mt-4">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-dark text-white text-center py-4">
                    <h3 class="font-weight-bold mb-0">📌 Dashboard</h3>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-center mb-4">
                        <form action="{{ route('user.search') }}" method="get" class="w-50">
                            <div class="input-group">
                                <input class="form-control rounded-left px-3" name="cari" type="search" placeholder="Cari siswa..." aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary rounded-right" type="submit">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="row">
                        @foreach ($data as $row)
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm border-0 rounded-lg h-100 siswa-card">
                                    <img src="{{ asset('uploads/' . $row->foto) }}" class="card-img-top rounded-top" alt="Foto Siswa">
                                    <div class="card-body text-center">
                                        <h5 class="card-title font-weight-bold">
                                            <a href="{{ route('user.show', $row->id) }}" class="siswa-link text-decoration-none text-dark">
                                                {{ $row->nama_siswa }}
                                            </a>
                                        </h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><i class="fas fa-id-card-alt text-primary"></i> <strong>NIS:</strong> {{ $row->nis }}</li>
                                        <li class="list-group-item"><i class="fas fa-graduation-cap text-success"></i> <strong>Jurusan:</strong> {{ $row->jurusan }}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
