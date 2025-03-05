<?php

namespace App\Console\Commands\DetailPemesanan;

use App\Models\DetailPemesanan;
use Illuminate\Console\Command;

class CariDetailPemesanan extends Command
{
    protected $signature = 'detailpemesanan:cari {search}';
    protected $description = 'Mencari data detail_pemesanan berdasarkan Nama Penumpang atau Nomor Identitas';

    public function handle()
    {
        $search = $this->argument('search');
        $details = DetailPemesanan::where('nama_penumpang', 'LIKE', "%$search%")
            ->orWhere('nomor_identitas', 'LIKE', "%$search%")
            ->get();

        if ($details->isEmpty()) {
            $this->error("Data tidak ditemukan");
        } else {
            $this->table(
                ["ID", "ID Pemesanan", "ID Kursi Bus", "Nama Penumpang", "Nomor Identitas", "Harga Kursi", "Total Harga", "Created At", "Updated At"],
                $details->toArray()
            );
        }
    }
}
