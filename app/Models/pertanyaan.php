<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan';

    protected $fillable = [
        'jenis_pertanyaan_id',
        'pertanyaan',
        'is_alasan',
        'publish'
    ];

    public function jenis_pertanyaan()
    {
        return $this->belongsTo(jenis_pertanyaan::class, 'jenis_pertanyaan_id');
    }

    public function pilihan()
    {
        return  $this->hasMany(pilihan::class, 'pertanyaan_id');
    }

    public function jawaban()
    {
        return $this->hasMany(jawaban::class);
    }
}
