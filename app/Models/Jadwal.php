<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = [
        'id_plane_rute',
        'tanggal',
        'waktu_berangkat',
        'waktu_tiba',
    ];

    public function plane_rute()
    {
        return $this->belongsTo(PlaneRute::class, 'id_plane_rute');
    }
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
