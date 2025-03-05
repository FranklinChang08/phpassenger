<?php

namespace App\Console\Commands\DetailPemesanan;

use App\Models\DetailPemesanan;
use Illuminate\Console\Command;

class EditDetailPemesanan extends Command
{
    protected $signature = 'detailpemesanan:edit {id}';
    protected $description = 'Edit data detail_pemesanan berdasarkan id';

    public function handle()
    {
        $id = $this->argument('id');
        $detail = DetailPemesanan::find($id);

        if (!$detail) {
            $this->error('Data detail_pemesanan tidak ditemukan');
            return Command::FAILURE;
        }

        $this->info("Data saat ini:");
        $this->info("ID Pemesanan: $detail->id_pemesanan");
        $this->info("ID Kursi Bus: $detail->id_kursi_bus");
        $this->info("Nama Penumpang: $detail->nama_penumpang");
        $this->info("Nomor Identitas: $detail->nomor_identitas");
        $this->info("Harga Kursi: $detail->harga_kursi");
        $this->info("Total Harga: $detail->total_harga");

        $id_pemesanan = $this->ask("ID Pemesanan", $detail->id_pemesanan);
        $id_kursi_bus = $this->ask("ID Kursi Bus", $detail->id_kursi_bus);
        $nama_penumpang = $this->ask("Nama Penumpang", $detail->nama_penumpang);
        $nomor_identitas = $this->ask("Nomor Identitas", $detail->nomor_identitas);
        $harga_kursi = $this->ask("Harga Kursi", $detail->harga_kursi);
        $total_harga = $this->ask("Total Harga", $detail->total_harga);

        $detail->update([
            'id_pemesanan' => $id_pemesanan,
            'id_kursi_bus' => $id_kursi_bus,
            'nama_penumpang' => $nama_penumpang,
            'nomor_identitas' => $nomor_identitas,
            'harga_kursi' => $harga_kursi,
            'total_harga' => $total_harga,
        ]);

        $this->info("Data berhasil diupdate");
    }
}
