<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    protected $table = 'detail_pemesanan';
    protected $primaryKey = 'id_detail_pemesanan';
    protected $fillable = [
        'id_pemesanan',
        'id_kursi_plane',
        'nama_penumpang',
        'nomor_identitas',
        'harga_kursi',
        'total_harga',
    ];

    public function kursiPlane()
    {
        $this->belongsTo(KursiPlane::class, 'id_kursi_plane');
    }
    public function pemesanan()
    {
        $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}
