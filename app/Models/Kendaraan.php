<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    // Definisikan konstanta untuk jenis kendaraan
    const JENIS_MOBIL = 'mobil';
    const JENIS_MOTOR = 'motor';
    
    // Definisikan konstanta untuk status
    const STATUS_TERSEDIA = 'tersedia';
    const STATUS_DISEWA = 'disewa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'jenis',
        'plat_nomor',
        'harga_sewa',
        'status'
    ];

    /**
     * Relasi ke tabel penyewaan
     */
    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class);
    }

    /**
     * Get validation rules for Kendaraan
     */
    public static function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:' . self::JENIS_MOBIL . ',' . self::JENIS_MOTOR,
            'plat_nomor' => 'required|string|unique:kendaraans',
            'harga_sewa' => 'required|numeric|min:0',
            'status' => 'sometimes|in:' . self::STATUS_TERSEDIA . ',' . self::STATUS_DISEWA
        ];
    }

    /**
     * Scope query untuk kendaraan tersedia
     */
    public function scopeTersedia($query)
    {
        return $query->where('status', self::STATUS_TERSEDIA);
    }

    /**
     * Scope query untuk jenis kendaraan
     */
    public function scopeJenis($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }
}