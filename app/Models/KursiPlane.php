<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KursiPlane extends Model
{
    protected $table = 'kursi_plane';
    protected $primaryKey = 'id_kursi_plane';
    protected $fillable = [
        'id_plane',
        'id_kelas',
        'nomor_kursi',
        'status',
    ];

    public function plane()
    {
        $this->belongsTo(Plane::class, 'id_plane');
    }

    public function kelas()
    {
        $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function detail_pemesanan()
    {
        return $this->hasMany(DetailPemesanan::class);
    }
}
