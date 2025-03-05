<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaneKelas extends Model
{
    protected $table = 'plane_kelas';
    protected $fillable = [
        'id_plane',
        'id_kelas',
    ];
    public $timestamps = false;
    public function kelas()
    {
        $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function plane()
    {
        $this->belongsTo(plane::class, 'id_plane');
    }
}
