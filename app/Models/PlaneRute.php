<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaneRute extends Model
{
    protected $table = 'plane_rute';
    protected $primaryKey = 'id_plane_rute';

    protected $fillable = [
        'id_plane',
        'id_rute',
    ];

    public function plane()
    {
        $this->belongsTo(Plane::class, 'id_plane');
    }
    public function rute()
    {
        $this->belongsTo(Rute::class, 'id_rute');
    }
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
