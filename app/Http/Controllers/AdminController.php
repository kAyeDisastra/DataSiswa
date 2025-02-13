<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $biodata = Siswa::all();
        return view('admin.dashboard',[
            'data' => $biodata
        ]);
    }

    public function create()
    {
        return view('admin.create');  // Ganti dengan nama view yang sesuai
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nis' => 'required|digits:8',  // Validasi untuk NIS, hanya 8 digit
            'jurusan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Tambahkan slug
        $validatedData['slug'] = Str::slug($request->nama_siswa);
    
        // Cek apakah ada foto yang diupload
        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('siswa');
        }
    
        // Simpan data hanya sekali
        Siswa::create($validatedData);
    
        return redirect()->route('admin.dashboard')->with('status', 'Data berhasil disimpan');
    }
    

// Di Controller
public function edit($id)
{
    $siswa = Siswa::findOrFail($id); // Ambil data siswa berdasarkan ID
    $jurusanOptions = [
        10 => ['TJKT 1', 'TJKT 2', 'PPLG 1', 'PPLG 2', 'MPLB 1', 'MPLB 2', 'Pemasaran 1', 'Pemasaran 2', 'Pemasaran 3', 'Pemasaran 4', 'AKL 1', 'AKL 2', 'AKL 3'],
        11 => ['AKT 1', 'AKT 2', 'AKT 3', 'RPL 1', 'RPL 2', 'TKJ 1', 'MPK 1', 'MPK 2', 'Ritel 1', 'Ritel 2', 'DIGI', 'Alfaclass'],
        12 => ['AKT 1', 'AKT 2', 'AKT 3', 'RPL 1', 'RPL 2', 'TKJ 1', 'MPK 1', 'MPK 2', 'Ritel 1', 'Ritel 2', 'DIGI', 'Alfaclass'],
    ];

    return view('admin.edit', compact('siswa', 'jurusanOptions')); // Kirim data ke view
}

public function update(Request $request, $id)
{

    

        $biodata = Siswa::findOrFail($id);
    
        // Mengisi data siswa
        $biodata->fill($request->all());
    
        // Jika foto diubah
        if ($request->hasFile('foto')) {
            // Menghapus foto lama
            if ($biodata->foto && file_exists(public_path('uploads/' . $biodata->foto))) {
                unlink(public_path('uploads/' . $biodata->foto)); 
            }
            
            // Menyimpan foto baru
            $biodata->foto = $request->file('foto')->store('siswa');
        }
    
        // Menyimpan perubahan ke database
        $biodata->save();
    
        return redirect()->route('admin.dashboard')->with('status', 'Data berhasil diperbarui');
    }

    // menghapus data
    public function destroy($id)
    {
        // Menemukan data berdasarkan ID
        $data = Siswa::findOrFail($id);
    
        // Menghapus file foto yang ter-upload
        if ($data->foto && file_exists(public_path('uploads/' . $data->foto))) {
            Storage::delete($data->foto);  // Menghapus file foto
        }
    
        // Menghapus data siswa dari database
        $data->delete();
    
        // Redirect dengan status berhasil
        return redirect()->route('admin.dashboard')->with('status', 'Data berhasil dihapus');
    }

    public function search(Request $request)
    {
        $cari = $request->input('cari'); // Menangkap nilai input pencarian
    
        // Jika ada pencarian, lakukan query berdasarkan nama_siswa atau nis
        $data = Siswa::where('nama_siswa', 'like', '%' . $cari . '%')
                     ->orWhere('nis', 'like', '%' . $cari . '%')
                     ->paginate(12);
    
        // Jika tidak ada data, set $data menjadi array kosong
        if ($data->isEmpty()) {
            $data = []; // Untuk menghindari null pada $data
        }
    
        // Kembalikan data pencarian dan request ke view
        return view('admin.search', compact('data', 'cari'));
    }
    
    public function show($id)
{
    $siswa = Siswa::findOrFail($id);
    return view('admin.show', compact('siswa'));
}

    
}

