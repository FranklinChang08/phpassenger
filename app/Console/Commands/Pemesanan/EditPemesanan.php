<?php

namespace App\Console\Commands;

use App\Models\Pemesanan;
use Illuminate\Console\Command;

class EditPemesanan extends Command
{
    protected $signature = 'pemesanan:edit {id}';
    protected $description = 'Edit data pemesanan berdasarkan id';

    public function handle()
    {
        $id = $this->argument('id');
        $pemesanan = Pemesanan::find($id);

        if (!$pemesanan) {
            $this->error('Pemesanan dengan ID tersebut tidak ditemukan');
            return Command::FAILURE;
        }

        $this->info("Data pemesanan saat ini dengan ID $id");
        $this->info("ID: $pemesanan->id");
        $this->info("ID Pengguna: $pemesanan->id_pengguna");
        $this->info("ID Jadwal: $pemesanan->id_jadwal");
        $this->info("Tanggal Pemesanan: $pemesanan->tanggal_pemesanan");
        $this->info("Status: $pemesanan->status");

        $id_pengguna = $this->ask("ID Pengguna", $pemesanan->id_pengguna);
        $id_jadwal = $this->ask("ID Jadwal", $pemesanan->id_jadwal);
        $tanggal_pemesanan = $this->ask("Tanggal Pemesanan", $pemesanan->tanggal_pemesanan);
        $status = $this->ask("Status", $pemesanan->status);

        $pemesanan->update([
            'id_pengguna' => $id_pengguna,
            'id_jadwal' => $id_jadwal,
            'tanggal_pemesanan' => $tanggal_pemesanan,
            'status' => $status
        ]);

        $this->info("Data pemesanan dengan ID $id berhasil di edit");
        return Command::SUCCESS;
    }
}
