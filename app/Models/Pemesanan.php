<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    protected $fillable = [
        'id_pengguna',
        'id_jadwal',
        'tanggal_pemesanan',
        'status',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
    public function detailPemesanan()
    {
        return $this->hasMany(DetailPemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }
}