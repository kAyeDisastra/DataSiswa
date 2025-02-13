@extends('layouts.app')

@section('content')
<div class="container py-5" style="background-color: #f4f6f9;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-dark text-white text-center py-4">
                    <h3 class="font-weight-bold mb-0" style="color: #ffffff;">📌 Dashboard</h3>
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

                    @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

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
                                    <!-- Admin-specific buttons like Edit and Delete are not shown to regular users -->
                                    <div class="card-footer bg-light text-center">
                                        <!-- No Edit or Delete for regular users -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const siswaLinks = document.querySelectorAll('.siswa-link');

    siswaLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();  // Hapus baris ini jika ingin menggunakan tautan standar
            const card = this.closest('.siswa-card');

            // Tambahkan efek perubahan warna
            card.style.backgroundColor = "#d1ecf1";  // Warna biru muda
            card.style.transition = "background-color 0.3s ease-in-out";

            // Redirect ke halaman detail setelah delay
            setTimeout(() => {
                window.location.href = this.href;
            }, 200);
        });
    });
});
</script>

@endsection
