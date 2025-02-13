@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Navbar di atas -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-warning btn-sm me-2">Kembali</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('user.search') }}" method="get" class="d-flex">
                            <input class="form-control me-2" name="cari" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten utama -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Menampilkan Pesan jika Tidak Ada Data -->
                    @if(isset($cari) && $data->isEmpty())
                        <p>Data tidak ditemukan untuk pencarian: "{{ $cari }}"</p>
                    @endif

                    <div class="row justify-content-center">
                        @if($data->isNotEmpty())
                            @foreach ($data as $row)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="{{ asset('uploads/' . $row->foto) }}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">{{ $row->nama_siswa }}</h5>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Nis: {{ $row->nis }}</li>
                                            <li class="list-group-item">Jurusan: {{ $row->jurusan }}</li>                            
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <p>Data tidak ditemukan.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Paginasi -->
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
