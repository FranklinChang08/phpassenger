<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model implements AuthenticatableContract
{
    use Authenticatable, HasFactory;
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = [
        'nama',
        'email',
        'password',
        'nomor_telepon',
        'role',
        'password'
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'role' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
