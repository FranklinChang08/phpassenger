<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    protected $table = 'rute';
    protected $primaryKey = 'id_rute';
    protected $fillable = [
        'asal',
        'tujuan',
        'jarak_km',
    ];

    public function harga()
    {
        return $this->hasMany(Harga::class);
    }

    public function plane_rute()
    {
        return $this->hasMany(PlaneRute::class);
    }
}
