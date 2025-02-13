@extends('layouts.app')

@section('content')
<div class="container py-5" style="background-color: #f4f6f9;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-dark text-white text-center py-4">
                    <h3 class="font-weight-bold mb-0" style="color: #ffffff;">📌 Detail Siswa</h3>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('uploads/' . $siswa->foto) }}" class="img-fluid rounded-circle" alt="Foto Siswa">
                        </div>
                        <div class="col-md-8">
                            <h4 class="font-weight-bold">{{ $siswa->nama_siswa }}</h4>
                            <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
                            <p><strong>Jurusan:</strong> {{ $siswa->jurusan }}</p>
                            <p><strong>Nomor Telepon:</strong> {{ $siswa->no_telepon }}</p>
                            
                            <!-- Instagram Link dengan Hover -->
                            <div class="d-flex align-items-center mt-2">
                                <a href="https://instagram.com/{{ $siswa->instagram }}" target="_blank" class="text-decoration-none">
                                    <img src="{{ asset('images/instagram-logo.png') }}" alt="Instagram" width="30" class="me-2">
                                    <span class="d-none d-md-inline" style="font-weight: bold; color: #bc2a8d;">@{{ $siswa->instagram }}</span>
                                </a>
                            </div>

                            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection