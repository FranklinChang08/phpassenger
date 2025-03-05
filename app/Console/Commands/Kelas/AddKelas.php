<?php

namespace App\Console\Commands\Kelas;

use App\Models\Kelas;
use Illuminate\Console\Command;

class AddKelas extends Command
{
    protected $signature = 'kelas:add';

    protected $description = 'Menambahkan kelas baru';
    public function handle()
    {
        $nama_kelas = $this->ask('Nama Kelas');
        Kelas::create([
            'nama_kelas' => $nama_kelas,
        ]);

        $this->info('Kelas berhasil ditambahkan');
    }
}
