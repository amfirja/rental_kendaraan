<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kendaraan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'total_biaya',
        'nama_penyewa',
        'kontak'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}