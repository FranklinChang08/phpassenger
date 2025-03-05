<?php

namespace App\Console\Commands\DetailPemesanan;

use App\Models\DetailPemesanan;
use App\Models\Kelas;
use App\Models\KursiBus;
use App\Models\Pemesanan;
use DB;
use Illuminate\Console\Command;

class AddDetailPemesanan extends Command
{
    protected $signature = 'detailpemesanan:add';
    protected $description = 'Tambah data detail_pemesanan';

    public function handle()
    {

        $pemesanan = Pemesanan::all();

        if ($pemesanan->isNotEmpty()) {
            $this->table(
                ['ID Pemesanan', 'ID Jadwal', 'ID Pengguna'],
                $pemesanan->map(function ($item) {
                    return [
                        $item->id_pemesanan,
                        $item->id_jadwal,
                        $item->id_pengguna,
                    ];
                })->toArray()
            );
        } else {
            $this->error("Data Pemesanan tidak ditemukan.");
        }

        $id_pemesanan = $this->ask("ID Pemesanan");

        $kelas = Kelas::all();

        if ($kelas->isNotEmpty()) {
            $this->table(
                ['ID Kelas', 'Nama Kelas'],
                $kelas->map(function ($item) {
                    return [
                        $item->id_kelas,
                        $item->nama_kelas ?? 'N/A',
                    ];
                })->toArray()
            );
        } else {
            $this->error("Data Kelas tidak ditemukan.");
        }

        $id_kelas = $this->ask("ID Kelas");

        $kursi_bus = DB::table('kursi_bus')->join('kelas', 'kelas.id_kelas', '=', 'kursi_bus.id_kelas')->where('kelas.id_kelas', $id_kelas)->get();

        if ($kursi_bus->isNotEmpty()) {
            $this->table(
                ['ID Kursi Bus', 'Nomor Kursi'],
                $kursi_bus->map(function ($item) {
                    return [
                        $item->id_kursi_bus,
                        $item->nomor_kursi ?? 'N/A',
                    ];
                })->toArray()
            );
        } else {
            $this->error("Data Kursi Bus tidak ditemukan.");
        }

        $id_kursi_bus = $this->ask("ID Kursi Bus");
        $nama_penumpang = $this->ask("Nama Penumpang");
        $nomor_identitas = $this->ask("Nomor Identitas");

        $pemesanan = DB::table('pemesanan')->join('jadwal', 'jadwal.id_jadwal', '=', 'pemesanan.id_jadwal')->where('id_pemesanan', $id_pemesanan)->first();
        $kursi_bus = DB::table('kursi_bus')->join('kelas', 'kelas.id_kelas', '=', 'kursi_bus.id_kelas')->where('kursi_bus.id_kursi_bus', $id_kursi_bus)->where('kelas.id_kelas', $id_kelas)->first();

        if (!$pemesanan || !$kursi_bus) {
            $this->error("Pemesanan atau Kursi tidak ditemukan.");
            return;
        }

        $jadwal = DB::table('jadwal')
            ->join('bus_rute', 'jadwal.id_bus_rute', '=', 'bus_rute.id_bus_rute')
            ->join('harga', 'harga.id_rute', '=', 'bus_rute.id_rute')
            ->join('kelas', 'kelas.id_kelas', '=', 'harga.id_kelas')
            ->where('jadwal.id_jadwal', $pemesanan->id_jadwal)
            ->where('harga.id_kelas', $id_kelas)
            ->where('jadwal.tanggal', $pemesanan->tanggal)
            ->select('harga.harga as harga_kursi', 'kelas.nama_kelas as nama_kelas')
            ->first();

        if (!$jadwal) {
            $this->error("Harga untuk jadwal dan kelas kursi tidak ditemukan.");
            return;
        }
        if ($jadwal->nama_kelas != $kursi_bus->nama_kelas) {
            $this->error("Kelas yang dipilih berbeda.");
            return;
        }
        if ($kursi_bus->status == 'Booked') {
            $this->error("Kursi sudah dipilih");
            return;
        }

        $harga_kursi = $jadwal->harga_kursi;

        DB::table('kursi_bus')
            ->where('id_kursi_bus', $id_kursi_bus)
            ->update(['status' => 'Booked']);

        DetailPemesanan::create([
            'id_pemesanan' => $id_pemesanan,
            'id_kursi_bus' => $id_kursi_bus,
            'nama_penumpang' => $nama_penumpang,
            'nomor_identitas' => $nomor_identitas,
            'harga_kursi' => $harga_kursi,
            'total_harga' => $harga_kursi,
        ]);

        $totalHarga = DetailPemesanan::where('id_pemesanan', $id_pemesanan)->sum('harga_kursi');
        DB::table('detail_pemesanan')->where('id_pemesanan', $id_pemesanan)->update(['total_harga' => $totalHarga]);

        $this->info("Total harga diperbarui: Rp. " . number_format($totalHarga, 0, ',', '.'));
        $this->info("Detail pemesanan berhasil ditambahkan.");


    }
}
