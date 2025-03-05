<?php

namespace App\Console\Commands\KursiBus;

use App\Models\KursiBus;
use Illuminate\Console\Command;

class HapusKursiBus extends Command
{
    protected $signature = 'kursibus:hapus {id}';
    protected $description = 'Menghapus data kursi bus berdasarkan id';

    public function handle()
    {
        $id = $this->argument('id');
        $kursiBus = KursiBus::find($id);

        if ($kursiBus) {
            $kursiBus->delete();
            $this->info("Kursi bus dengan ID $id berhasil dihapus.");
        } else {
            $this->error("Kursi bus dengan ID $id tidak ditemukan");
        }
    }
}
