<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = [
        'nama_kelas',
    ];
    public function plane_kelas()
    {
        return $this->belongsToMany(Plane::class, 'plane_kelas', 'id_plane', 'id_kelas');
    }
    public function kursi_plane()
    {
        return $this->hasMany(KursiPlane::class);
    }

    public function harga()
    {
        return $this->hasMany(Harga::class);
    }
}
