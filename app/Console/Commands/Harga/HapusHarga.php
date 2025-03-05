<?php

namespace App\Console\Commands\Harga;

use App\Models\Harga;
use Illuminate\Console\Command;

class HapusHarga extends Command
{
    protected $signature = 'harga:hapus {id}';
    protected $description = 'Menghapus data harga berdasarkan id';

    public function handle()
    {
        $id = $this->argument('id');
        $harga = Harga::find($id);

        if ($harga) {
            $harga->delete();
            $this->info("Harga dengan ID $id berhasil dihapus.");
        } else {
            $this->error("Harga dengan ID $id tidak ditemukan");
        }
    }
}
