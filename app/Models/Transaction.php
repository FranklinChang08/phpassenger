<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id_transaction';
    protected $fillable = [
        'id_pemesanan',
        'id_pengguna',
        'bukti_pemesanan',
        'tanggal_pembayaran',
        'status',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }

    public function pengguna()
    {
        $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
}
