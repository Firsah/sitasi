<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';

    protected $fillable = [
        'alumni_id',
        'jenis_pertanyaan_id',
        'pertanyaan_id',
        'jawaban',
        'alasan'
    ];

    public function alumni()
    {
        return $this->belongsTo(alumni::class);
    }

    public  function pertanyaan()
    {
        return $this->belongsTo(pertanyaan::class);
    }

    public  function jenis_pertanyaan()
    {
        return $this->belongTo(jenis_pertanyaan::class);
    }
}
