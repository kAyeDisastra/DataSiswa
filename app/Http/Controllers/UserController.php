<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Ekskul;  // Pastikan Anda mengimpor model yang relevan. Jika menggunakan model lain, sesuaikan nama model di sini.
use App\Models\User;  // Pastikan Anda mengimpor model yang relevan

class UserController extends Controller
{
    public function index()
    {
        // Ambil data yang ingin ditampilkan (misalnya data siswa)
        $data = Siswa::all();  // Ambil semua data siswa, sesuaikan jika menggunakan model lain

        // Kirim data ke view user.dashboard
        return view('user.dashboard', compact('data'));
    }

    public function search(Request $request)
    {
        $cari = $request->input('cari'); // Menangkap nilai input pencarian
    
        // Jika ada pencarian, lakukan query berdasarkan nama_siswa atau nis
        $data = Siswa::where('nama_siswa', 'like', '%' . $cari . '%')
                     ->orWhere('nis', 'like', '%' . $cari . '%')
                     ->paginate(12);
    
        // Kembalikan data pencarian dan request ke view
        return view('user.search', compact('data', 'cari'));
    }

    public function show($id)
    {
      // Cari siswa berdasarkan ID
            $siswa = Siswa::findOrFail($id);  // Pastikan ID siswa yang sesuai diambil
        
            // Periksa jika siswa memiliki relasi user
            if ($siswa->user) {
                $user = $siswa->user;
            } else {
                // Jika tidak ada user terkait, tangani kasus ini
                $user = null;
            }
        
            // Kirim data siswa dan user ke view
            return view('user.show', compact('siswa', 'user'));
}

public function dashboard()
{
    $data = Siswa::paginate(12); // Ambil data siswa
    $kelas = \App\Models\Kelas::all(); // Ambil semua kelas dari database
    $ekskul = \App\Models\Ekskul::all(); // Ambil semua ekskul dari database

    return view('user.dashboard', compact('data', 'kelas', 'ekskul'));
}



}
