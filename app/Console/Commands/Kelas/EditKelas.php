<?php

namespace App\Console\Commands\Kelas;

use App\Models\Kelas;
use Illuminate\Console\Command;

class EditKelas extends Command
{

    protected $signature = 'kelas:edit {id}';
    protected $description = 'Mengubah data kelas';
    public function handle()
    {
        $id = $this->argument('id');
        $kelas = Kelas::find($id);

        if (!$kelas) {
            $this->error('kelas tidak ditemukan');
            return Command::FAILURE;
        }

        $this->info('Data kelas saat ini: ');
        $this->info("Nama Kelas: {$kelas->nama_kelas}");

        $nama_kelas = $this->ask('Nama Kelas baru (kosongkan untuk tetap sama)', $kelas->nama_kelas);
 
        $kelas->nama_kelas = $nama_kelas;

        $kelas->save();

        $this->info("Data berhasil diperbaharui!!");
        return Command::SUCCESS;
    }
}
