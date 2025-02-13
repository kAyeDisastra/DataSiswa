@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-gradient-dark text-white text-center py-4">
                <h3 class="font-weight-bold mb-0">✏️ Tambah Data Siswa</h3>
            </div>
            <div class="card-body p-4" style="background-color: #f8f9fa;">

                <a href="{{ route('admin.dashboard') }}" class="btn btn-danger btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                @if(session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" class="form-control" name="nama_siswa" required placeholder="Masukkan Nama Siswa">
                    </div>

                    <div class="form-group">
                        <label for="nis">No. Induk Siswa</label>
                        <input type="text" class="form-control" name="nis" required maxlength="8" pattern="\d{8}" title="NIS harus terdiri dari 8 digit angka" placeholder="Masukkan NIS Siswa">
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" name="kelas" id="kelas" required>
                            <option value="">Pilih Kelas</option>
                            <option value="10">Kelas 10</option>
                            <option value="11">Kelas 11</option>
                            <option value="12">Kelas 12</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select class="form-control" name="jurusan" id="jurusan" required>
                            <!-- Options for jurusan will be filled dynamically -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" required placeholder="Masukkan Deskripsi Siswa">
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Siswa</label>
                        <input type="file" class="form-control" name="foto" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <button type="reset" class="btn btn-danger btn-lg rounded-pill px-4">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add this JavaScript section -->
    <script>
        // Jurusan yang akan ditampilkan berdasarkan kelas
        const jurusanOptions = {
            10: ['X TJKT 1', 'X TJKT 2', 'X PPLG 1', 'X PPLG 2', 'X MPLB 1', 'X MPLB 2', 'X Pemasaran 1', 'X Pemasaran 2', 'X Pemasaran 3', 'X Pemasaran 4', 'X AKL 1', 'X AKL 2', 'X AKL 3'],
            11: ['XI AKT 1', 'XI AKT 2', 'XI AKT 3', 'XI RPL 1', 'XI RPL 2', 'XI TKJ 1', 'XI MPK 1', 'XI MPK 2', 'XI RITEL 1', 'XI RITEL 2', 'XI DIGI', 'XI RITEL 1'],
            12: ['XII AKT 1', 'XII AKT 2', 'XII AKT 3', 'XII RPL 1', 'XII RPL 2', 'XII TKJ 1', 'XII MPK 1', 'XII MPK 2', 'XII BRTL 1', 'XII BRTL 2', 'XII BDP', 'XII BRTL 1'],
        };

        // Event listener untuk kelas
        document.getElementById('kelas').addEventListener('change', function () {
            const kelas = this.value;
            const jurusanSelect = document.getElementById('jurusan');
            jurusanSelect.innerHTML = ''; // Clear previous options

            if (kelas) {
                // Menambahkan option "Pilih Jurusan"
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Pilih Jurusan';
                jurusanSelect.appendChild(defaultOption);

                // Menambahkan jurusan sesuai kelas
                jurusanOptions[kelas].forEach(jurusan => {
                    const option = document.createElement('option');
                    option.value = jurusan;
                    option.textContent = jurusan;
                    jurusanSelect.appendChild(option);
                });
            }
        });

        // Validasi input NIS (membatasi hanya 8 digit dan angka)
        document.querySelector('[name="nis"]').addEventListener('input', function(event) {
            let nisValue = event.target.value;
            
            // Hanya biarkan angka dan batasi panjangnya hingga 8 karakter
            nisValue = nisValue.replace(/[^0-9]/g, '').slice(0, 8);
            
            event.target.value = nisValue;
        });
    </script>
@endsection
