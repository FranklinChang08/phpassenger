<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    protected $table = 'plane';
    protected $primaryKey = 'id_plane';

    protected $fillable = [
        'nama_maskapai',
        'nomor_regis',
        'nomor_penerbangan',
        'kapasitas',
    ];

    public function plane_rute()
    {
        return $this->hasMany(PlaneRute::class);
    }
    public function kursi_plane()
    {
        return $this->hasMany(KursiPlane::class);
    }
    public function plane_kelas()
    {
        return $this->belongsToMany(Kelas::class, 'plane_kelas', 'id_plane', 'id_kelas');
    }
}
