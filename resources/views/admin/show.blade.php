@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-dark text-white text-center py-4">
            <h3 class="font-weight-bold mb-0">📄 Detail Siswa</h3>
        </div>
        <div class="card-body p-4 text-center">
            <img src="{{ asset('uploads/' . $siswa->foto) }}" class="rounded-circle mb-3" alt="Foto Siswa" style="width: 150px;">
            <h4 class="font-weight-bold">{{ $siswa->nama_siswa }}</h4>
            <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
            <p><strong>Kelas:</strong> {{ $siswa->kelas }}</p>
            <p><strong>Jurusan:</strong> {{ $siswa->jurusan }}</p>
            <p><strong>Deskripsi:</strong> {{ $siswa->deskripsi }}</p>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary rounded-pill">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
