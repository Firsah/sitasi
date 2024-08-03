<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class jenis_pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'jenis_pertanyaan';

    protected $fillable = [
        'jenis'
    ];

    public function pertanyaan()
    {
        return $this->hasMany(pertanyaan::class, 'jenis_pertanyaan_id');
    }

    public  function jawaban()
    {
        return  $this->hasMany(jawaban::class);
    }
}
