<?php

namespace App\Console\Commands\Pengguna;

use Illuminate\Console\Command;
use App\Models\Pengguna;

class HapusPengguna extends Command
{
    protected $signature = 'pengguna:hapus {id}';
    protected $description = 'Menghapus data pengguna berdasarkan ID';
    public function handle()
    {
        $id = $this->argument('id');
        $pengguna = Pengguna::findOrFail($id);

        if ($pengguna) {
            $pengguna->delete();
            $this->info("Pengguna dengan id $id berhasil dihapus");
        } else {

            $this->info("Pengguna dengan id $id tidak ditemukan");
        }
    }
}
