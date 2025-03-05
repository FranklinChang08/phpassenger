<?php

namespace App\Console\Commands\DetailPemesanan;

use App\Models\DetailPemesanan;
use App\Models\KursiBus;
use Illuminate\Console\Command;

class HapusDetailPemesanan extends Command
{
    protected $signature = 'detailpemesanan:hapus {id}';
    protected $description = 'Menghapus data detail_pemesanan berdasarkan id';

    public function handle()
    {
        $id = $this->argument('id');
        $detail = DetailPemesanan::find($id);

        if ($detail) {
            // Update the related kursi_bus status to available
            KursiBus::where('id_kursi_bus', $detail->id_kursi_bus)->update(['status_kursi' => 'available']);

            // Delete the detail pemesanan
            $detail->delete();
            $this->info("Detail pemesanan dengan ID $id berhasil dihapus dan status kursi diubah menjadi available.");
        } else {
            $this->error("Data tidak ditemukan");
        }
    }
}
