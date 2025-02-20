<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pilihan extends Model
{
    use HasFactory;

    protected $table = 'pilihan';

    protected $fillable = [
        'pertanyaan_id',
        'pilihan',
    ];

    public function pertanyaan()
    {
        return  $this->belongsTo(pertanyaan::class, 'pertanyaan_id');
    }
}
