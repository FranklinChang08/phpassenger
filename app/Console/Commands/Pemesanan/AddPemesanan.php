<?php

namespace App\Console\Commands\Pemesanan;

use App\Models\Pemesanan;
use Illuminate\Console\Command;

class AddPemesanan extends Command
{
    protected $signature = 'pemesanan:add';
    protected $description = 'Tambah data pemesanan';

    public function handle()
    {
        $id_pengguna = $this->ask("ID Pengguna");
        $id_jadwal = $this->ask("ID Jadwal");
        $status = $this->ask("Status Pemesanan (pending, confirmed, cancelled, booking)", "pending");

        Pemesanan::create([
            'id_pengguna' => $id_pengguna,
            'id_jadwal' => $id_jadwal,
            'status' => $status
        ]);

        $this->info("Pemesanan berhasil ditambah");
    }
}
