<?php

namespace App\Console\Commands\Pengguna;

use App\Models\Pengguna;
use Hash;
use Illuminate\Console\Command;

class AddPengguna extends Command
{
    protected $signature = 'pengguna:add';

    protected $description = 'Menambahkan Pengguna baru';
    public function handle()
    {
        $nama = $this->ask('Nama');
        $email = $this->ask('Email');
        $nomorTelepon = $this->ask('Nomor Telephone (optional)');
        $role = $this->choice('Role', ['Admin', 'Penumpang']);
        $password = $this->secret('Masukkan password (minimal 8 karakter):');

        while (empty($password) || strlen($password < 8)) {
            $this->error('Password Minimal 8 karakter');
            $password = $this->secret('Masukkan password (minimal 8 karakter)');
        }
        Pengguna::create([
            'nama' => $nama,
            'email' => $email,
            'password' => Hash::make($password),
            'nomor_telepon' => $nomorTelepon,
            'role' => $role,
        ]);

        $this->info('Pengguna berhasil ditambahkan');
    }
}
