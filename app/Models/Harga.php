<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    protected $table = 'harga';
    protected $primaryKey = 'id_harga';
    protected $fillable = [
        'id_rute',
        'id_kelas',
        'harga',
    ];

    public function kelas()
    {
        $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function rute()
    {
        $this->belongsTo(Rute::class, 'id_rute');
    }
    
}
