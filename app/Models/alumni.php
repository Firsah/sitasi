<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alumni extends Model
{
    use HasFactory;

    protected $table = "alumni";
    protected $fillable = [
        'no_alumni',
        'nis',
        'nisn',
        'nama',
        'nama_panggilan',
        'kelas',
        'tahun_lulus',
        'tempat',
        'tanggal_lahir',
        'jenis_kelamin',
        'nama_ayah',
        'nama_ibu',
        'alamat',
        'ket'
    ];

    public function User()
    {
        return $this->hasMany(User::class);
    }

    public function jawaban()
    {
        return $this->hasMany(jawaban::class);
    }
}
