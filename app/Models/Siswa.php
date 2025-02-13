<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);  // Relasi belongsTo, karena siswa milik user
    }

    protected $table = 'siswa';

    protected $fillable = [
        'nama_siswa', 'slug', 'nis', 'jurusan', 'deskripsi', 'foto',
    ];


    protected $hidden = [];
}


