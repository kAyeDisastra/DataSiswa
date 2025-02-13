@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <!-- Teks Dashboard di sebelah kiri -->
                    <h4>Dashboard</h4>
                    <!-- Tombol Create di sebelah kanan -->
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm">Kembali</a>
                    <form action="{{ route('admin.search') }}" method="get" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" nama="cari" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Menampilkan Pesan jika Tidak Ada Data -->
                    @if(isset($cari) && collect($data)->isEmpty())
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
                                        <div class="card-body text-center">
                                            <a href="{{ route('admin.edit', $row->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('admin.delete', $row->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE') 
                                                <button type="submit" class="btn btn-danger btn-sm float-right">Hapus</button>
                                            </form>
                                        </div>
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
                    
