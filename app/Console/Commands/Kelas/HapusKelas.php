<?php

namespace App\Console\Commands\Kelas;

use App\Models\Kelas;
use Illuminate\Console\Command;

class HapusKelas extends Command
{
    protected $signature = 'kelas:hapus {id}';
    protected $description = 'Menghapus data kelas berdasarkan ID';
    public function handle()
    {
        $id = $this->argument('id');
        $kelas = Kelas::findOrFail($id);

        if ($kelas) {
            $kelas->delete();
            $this->info("kelas dengan id $id berhasil dihapus");
        } else {

            $this->info("kelas dengan id $id tidak ditemukan");
        }
    }
}
