<?php

namespace App\Http\Controllers;

use App\Models\DetailPemesanan;
use App\Models\KursiPlane;
use App\Models\Pemesanan;
use App\Models\Transaction;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order(Request $request, $tanggal, $id_jadwal, $id_kelas)
    {
        $jadwal = DB::table('jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('harga', 'harga.id_rute', '=', 'plane_rute.id_rute') // Keep only one join for 'harga'
            ->join('kelas', 'harga.id_kelas', '=', 'kelas.id_kelas')
            ->where('id_jadwal', '=', $id_jadwal)
            ->where('harga.id_kelas', '=', $id_kelas)
            ->where('jadwal.tanggal', '=', $tanggal)
            ->first();

        $checkKelasKursi = KursiPlane::join('kelas', 'kelas.id_kelas', '=', 'kursi_plane.id_kelas')
            ->where('kursi_plane.id_kelas', $id_kelas)->first();

        if (!$checkKelasKursi) {
            return redirect()->route('ticket')->with('error', 'Mohon Maaf Kursi yang anda pilih belum tersedia');
        }

        $pemesanan = Pemesanan::create([
            'id_pengguna' => auth()->id(),
            'id_jadwal' => $id_jadwal,
        ]);

        if (!$pemesanan) {
            throw new \Exception('Pemesanan gagal dibuat.');
        }

        $id_pemesanan = $pemesanan->id_pemesanan;
        session(['last_order_id' => $pemesanan->id_pemesanan]);

        $kursiplane = DB::table('kursi_plane')
            ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
            ->where('id_plane', '=', $jadwal->id_plane)
            ->get();

        $transaction_notif = Transaction::where('status_pembayaran', '=', 'Pending')
            ->where('id_pengguna', '=', auth()->id())->get();

        return view('order', compact('jadwal', 'id_pemesanan', 'kursiplane', 'transaction_notif'));
    }

    public function orderdetail(Request $request)
    {
        try {

            $request->validate([
                'pemesanan.*.id_pemesanan' => 'required|numeric',
                'pemesanan.*.nama_penumpang' => 'required|string',
                'pemesanan.*.id_kursi_plane' => 'required|numeric',
                'pemesanan.*.nomor_identitas' => 'required|string',
                'pemesanan.*.harga_kursi' => 'required|numeric|min:0',
                'total_harga' => 'required|numeric|min:0',
            ]);

            $total_harga = $request->total_harga;

            foreach ($request->pemesanan as $data) {
                $detailpemesanan = DetailPemesanan::create([
                    'id_pemesanan' => $data['id_pemesanan'],
                    'nama_penumpang' => $data['nama_penumpang'],
                    'id_kursi_plane' => $data['id_kursi_plane'],
                    'nomor_identitas' => $data['nomor_identitas'],
                    'harga_kursi' => $data['harga_kursi'],
                    'total_harga' => $total_harga,
                ]);

                if (!$detailpemesanan) {
                    throw new \Exception('Ticket yang dipesan gagal dipesan');
                }
            }

            return redirect()->route('transaction.viewCustomer', $detailpemesanan->id_pemesanan)->with('success', 'Ticket Penumpang berhasil dipesan');
        } catch (\Exception $e) {
            return redirect()->route('transaction.viewCustomer')->with('error', 'Gagal memesan tiket penumpang anda!!!');
        }
    }

    public function ordercancel($id)
    {
        try {

            $pemesanan = Pemesanan::findOrFail($id);
            $details = DetailPemesanan::where('id_pemesanan', $id)->get();

            foreach ($details as $detail) {
                $kursiplane = KursiPlane::findOrFail($detail->id_kursi_plane);
                $kursiplane->status = 'Available';
                $kursiplane->save();
            }

            DetailPemesanan::where('id_pemesanan', $id)->delete();
            $pemesanan->delete();

            return redirect()->route('ticket')->with('success', 'Pemesanan berhasil dibatalkan.');
        } catch (\Exception $e) {
            return redirect()->route('ticket')->with('error', 'Pemesanan gagal dibatalkan: ' . $e->getMessage());
        }
    }
    public function ordercancelload($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $details = DetailPemesanan::where('id_pemesanan', $id)->get();

        foreach ($details as $detail) {
            $kursiplane = KursiPlane::findOrFail($detail->id_kursi_plane);
            $kursiplane->status = 'Available';
            $kursiplane->save();
        }

        DetailPemesanan::where('id_pemesanan', $id)->delete();
        $pemesanan->delete();
        return redirect()->back();
    }
}
