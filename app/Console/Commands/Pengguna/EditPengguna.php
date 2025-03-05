<?php

namespace App\Console\Commands\Pengguna;

use App\Models\Pengguna;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class EditPengguna extends Command
{
    protected $signature = 'pengguna:edit {id}';
    protected $description = 'Mengubah data pengguna';
    public function handle()
    {
        $id = $this->argument('id');
        $pengguna = Pengguna::find($id);

        if (!$pengguna) {
            $this->error('Pengguna tidak ditemukan');
            return Command::FAILURE;
        }

        $this->info('Data pengguna saat ini: ');
        $this->info("Nama: {$pengguna->nama}");
        $this->info("Email: {$pengguna->email}");
        $this->info("Nomor Telepon: {$pengguna->nomor_telepon}");
        $this->info("Role: {$pengguna->role}");

        $nama = $this->ask('Nama baru (kosongkan untuk tetap sama)', $pengguna->nama);
        $email = $this->ask('Email baru (kosongkan untuk tetap sama)', $pengguna->email);
        $nomorTelepon = $this->ask('Nomor Telephone baru (kosongkan untuk tetap sama)', $pengguna->nomor_telepon);
        $role = $this->choice('Role', ['Admin', 'Penumpang'], $pengguna->role);
        $password = $this->secret('Masukkan password baru (kosongkan untuk tetap sama):' . $pengguna->password);

        $pengguna->nama = $nama;
        $pengguna->email = $email;
        $pengguna->nomor_telepon = $nomorTelepon;
        $pengguna->role = $role;
        $pengguna->password = $password;

        if (!empty($password)) {
            $pengguna->password = Hash::make($password);
        }

        $pengguna->save();

        $this->info("Data berhasil diperbaharui!!");
        return Command::SUCCESS;
    }
}
