<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $fillable = [
        'nis',
        'kelas',
        'kategori_id',
        'lokasi',
        'ket_aspirasi',
        'gambar',
        'status',
        'feedback',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nis', 'nis');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
