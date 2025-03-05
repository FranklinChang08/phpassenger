<?php

namespace App\Http\Controllers;

use App\Models\DetailPemesanan;
use App\Models\KursiPlane;
use App\Models\Pemesanan;
use App\Models\Transaction;
use Exception;
use DB;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transaction = Transaction::join('pemesanan', 'pemesanan.id_pemesanan', '=', 'transaction.id_pemesanan')
            ->join('jadwal', 'jadwal.id_jadwal', '=', 'pemesanan.id_jadwal')
            ->join('plane_rute', 'plane_rute.id_plane_rute', '=', 'jadwal.id_plane_rute')
            ->join('plane', 'plane.id_plane', '=', 'plane_rute.id_plane')
            ->join('rute', 'rute.id_rute', '=', 'plane_rute.id_rute')
            ->join('pengguna', 'pengguna.id_pengguna', '=', 'transaction.id_pengguna')
            ->paginate(15);

        return view('admin.transaction.index', compact('transaction'));
    }

    public function create($id_pemesanan, $id_pengguna)
    {
        $pemesanan = Pemesanan::join('pengguna', 'pemesanan.id_pengguna', '=', 'pengguna.id_pengguna')
            ->join('jadwal', 'pemesanan.id_jadwal', '=', 'jadwal.id_jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->where('pemesanan.id_pemesanan', '=', $id_pemesanan)->first();

        $detailpemesanan = DetailPemesanan::join('pemesanan', 'pemesanan.id_pemesanan', '=', 'detail_pemesanan.id_pemesanan')
            ->join('kursi_plane', 'kursi_plane.id_kursi_plane', '=', 'detail_pemesanan.id_kursi_plane')
            ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
            ->where('detail_pemesanan.id_pemesanan', '=', $id_pemesanan)->get();

        $transaksi = Transaction::create([
            'id_pemesanan' => $id_pemesanan,
            'id_pengguna' => $id_pengguna,
        ]);

        $id_pemesanan = $transaksi->id_pemesanan;
        $id_transaction = $transaksi->id_transaction;

        return view('admin.transaction.create', compact('pemesanan', 'detailpemesanan', 'id_transaction', 'id_pemesanan'));
    }
    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png',
                'id_transaction' => 'required|numeric',
            ]);

            $transaction = Transaction::findOrFail($request->id_transaction);

            $detailpemesanan = DetailPemesanan::join('pemesanan', 'pemesanan.id_pemesanan', '=', 'detail_pemesanan.id_pemesanan')
                ->join('kursi_plane', 'kursi_plane.id_kursi_plane', '=', 'detail_pemesanan.id_kursi_plane')
                ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
                ->where('detail_pemesanan.id_pemesanan', '=', $transaction->id_pemesanan)->get();

            $pemesanan = Pemesanan::findOrFail($transaction->id_pemesanan);
            $pemesanan->status = 'Booking';
            $pemesanan->save();

            foreach ($detailpemesanan as $item) {
                $kursiplane = KursiPlane::findOrFail($item->id_kursi_plane);
                $kursiplane->status = 'Booked';
                $kursiplane->save();
            }

            if ($request->hasFile('bukti_pembayaran')) {
                if ($transaction->bukti_pembayaran && file_exists(public_path($transaction->bukti_pembayaran))) {
                    unlink(public_path($transaction->bukti_pembayaran));
                }

                $file = $request->file('bukti_pembayaran');
                $destinationPath = 'static/img/data_transaction';
                $fileName = $file->getClientOriginalName();

                $file->move(public_path($destinationPath), $fileName);

                $transaction->bukti_pembayaran = $destinationPath . '/' . $fileName;
                $transaction->status_pembayaran = 'Completed';
                $transaction->save();
            }

            return redirect()->route('transaction.index')->with('success', 'Pembayaran Berhasil Dibuat');
        } catch (Exception $e) {
            return redirect()->route('transaction.index')->with('eror', 'Pembayaran Gagal Dibuat');
        }
    }
    public function destroy($id_transaction)
    {
        $transaction = Transaction::findOrFail($id_transaction);

        $transaction->delete();

        return redirect()->route('transaction.index')->with('success', 'Pembayaran Berhasil Dihapus');
    }

    public function confirm($id_transaction)
    {
        $transaction = Transaction::findOrFail($id_transaction);
        $pemesanan = Pemesanan::findOrFail($transaction->id_pemesanan);
        $pemesanan->status = 'Confirmed';
        $transaction->status_pembayaran = 'Confirmed';
        $pemesanan->save();
        $transaction->save();

        return redirect()->route('transaction.index')->with('success', 'Pembayaran Berhasil Dikonfirmasi');
    }
    public function transactionViewCustomer($id_pemesanan)
    {
        $pemesanan = Pemesanan::join('pengguna', 'pemesanan.id_pengguna', '=', 'pengguna.id_pengguna')
            ->join('jadwal', 'pemesanan.id_jadwal', '=', 'jadwal.id_jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->where('pemesanan.id_pemesanan', '=', $id_pemesanan)->first();

        $detailpemesanan = DetailPemesanan::join('pemesanan', 'pemesanan.id_pemesanan', '=', 'detail_pemesanan.id_pemesanan')
            ->join('kursi_plane', 'kursi_plane.id_kursi_plane', '=', 'detail_pemesanan.id_kursi_plane')
            ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
            ->where('detail_pemesanan.id_pemesanan', '=', $id_pemesanan)->get();

        $transaksi = Transaction::create([
            'id_pemesanan' => $id_pemesanan,
            'id_pengguna' => auth()->id(),
        ]);

        $id_transaction = $transaksi->id_transaction;
        $id_pemesanan = $transaksi->id_pemesanan;

        $transaction_notif = Transaction::where('status_pembayaran', '=', 'Pending')
            ->where('id_pengguna', '=', auth()->id())->get();

        return view('transactionPending', compact('pemesanan', 'detailpemesanan', 'id_transaction', 'id_pemesanan', 'transaction_notif'));
    }

    public function transactionUpdateCustomer(Request $request)
    {
        $validateData = $request->validate([
            'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png',
            'id_transaction' => 'required|numeric',
        ]);

        $transaction = Transaction::findOrFail($request->id_transaction);

        $detailpemesanan = DetailPemesanan::join('pemesanan', 'pemesanan.id_pemesanan', '=', 'detail_pemesanan.id_pemesanan')
            ->join('kursi_plane', 'kursi_plane.id_kursi_plane', '=', 'detail_pemesanan.id_kursi_plane')
            ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
            ->where('detail_pemesanan.id_pemesanan', '=', $transaction->id_pemesanan)->get();

        $pemesanan = Pemesanan::findOrFail($transaction->id_pemesanan);
        $pemesanan->status = 'Booking';
        $pemesanan->save();

        foreach ($detailpemesanan as $item) {
            $kursiplane = KursiPlane::findOrFail($item->id_kursi_plane);
            $kursiplane->status = 'Booked';
            $kursiplane->save();
        }

        if ($request->hasFile('bukti_pembayaran')) {
            if ($transaction->bukti_pembayaran && file_exists(public_path($transaction->bukti_pembayaran))) {
                unlink(public_path($transaction->bukti_pembayaran));
            }

            $file = $request->file('bukti_pembayaran');
            $destinationPath = 'static/img/data_transaction';
            $fileName = $file->getClientOriginalName();

            $file->move(public_path($destinationPath), $fileName);

            $transaction->bukti_pembayaran = $destinationPath . '/' . $fileName;
            $transaction->status_pembayaran = 'Completed';
            $transaction->save();
        }

        return redirect()->route('profile', auth()->id())->with('success', 'Pembayaran Berhasil Dibuat');

    }

    public function cancelAdmin($id_pemesanan)
    {
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);
        $detailpemesanan = DetailPemesanan::where('id_pemesanan', '=', $id_pemesanan)->get();

        foreach ($detailpemesanan as $detail) {
            $kursiplane = KursiPlane::findOrFail($detail->id_kursi_plane);
            $kursiplane->status = 'Available';
            $kursiplane->save();
        }

        $transaction = Transaction::where('id_pemesanan', '=', $id_pemesanan)->delete();
        $detailpemesanan = DetailPemesanan::where('id_pemesanan', '=', $id_pemesanan)->delete();
        $pemesanan->delete();

        return redirect()->route('transaction.index')->with('success', 'Pembayaran Berhasil Dicancel');
    }

    public function cancelCustomer($id_pemesanan)
    {
        $detailpemesanan = DetailPemesanan::where('id_pemesanan', '=', $id_pemesanan)->get();

        foreach ($detailpemesanan as $detail) {
            $kursiplane = KursiPlane::findOrFail($detail->id_kursi_plane);
            $kursiplane->status = 'Available';
            $kursiplane->save();
        }

        DetailPemesanan::where('id_pemesanan', '=', $id_pemesanan)->delete();
        Transaction::where('id_pemesanan', '=', $id_pemesanan)->delete();
        Pemesanan::where('id_pemesanan', '=', $id_pemesanan)->delete();

        return redirect()->route('ticket')->with('success', 'Pembayaran Berhasil Dicancel');
    }

    public function transactionViewCustomerPending($id_transaction)
    {
        $transaction = Transaction::findOrFail($id_transaction);

        $pemesanan = Pemesanan::join('pengguna', 'pemesanan.id_pengguna', '=', 'pengguna.id_pengguna')
            ->join('jadwal', 'pemesanan.id_jadwal', '=', 'jadwal.id_jadwal')
            ->join('plane_rute', 'jadwal.id_plane_rute', '=', 'plane_rute.id_plane_rute')
            ->join('rute', 'plane_rute.id_rute', '=', 'rute.id_rute')
            ->join('plane', 'plane_rute.id_plane', '=', 'plane.id_plane')
            ->where('pemesanan.id_pemesanan', '=', $transaction->id_pemesanan)->first();

        $detailpemesanan = DetailPemesanan::join('pemesanan', 'pemesanan.id_pemesanan', '=', 'detail_pemesanan.id_pemesanan')
            ->join('kursi_plane', 'kursi_plane.id_kursi_plane', '=', 'detail_pemesanan.id_kursi_plane')
            ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
            ->where('detail_pemesanan.id_pemesanan', '=', $transaction->id_pemesanan)->get();

        $transaction_notif = Transaction::where('status_pembayaran', '=', 'Pending')
            ->where('id_pengguna', '=', auth()->id())->get();

        return view('transactionPending', compact('pemesanan', 'transaction', 'detailpemesanan', 'id_transaction', 'id_transaction', 'transaction_notif'));
    }

    public function transactionUpdateCustomerPending(Request $request, $id_transaction)
    {
        $validateData = $request->validate([
            'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png',
        ]);

        $transaction = Transaction::findOrFail($id_transaction);

        $detailpemesanan = DetailPemesanan::join('pemesanan', 'pemesanan.id_pemesanan', '=', 'detail_pemesanan.id_pemesanan')
            ->join('kursi_plane', 'kursi_plane.id_kursi_plane', '=', 'detail_pemesanan.id_kursi_plane')
            ->join('kelas', 'kursi_plane.id_kelas', '=', 'kelas.id_kelas')
            ->where('detail_pemesanan.id_pemesanan', '=', $transaction->id_pemesanan)->get();

        $pemesanan = Pemesanan::findOrFail($transaction->id_pemesanan);
        $pemesanan->status = 'Booking';
        $pemesanan->save();

        foreach ($detailpemesanan as $item) {
            $kursiplane = KursiPlane::findOrFail($item->id_kursi_plane);
            $kursiplane->status = 'Booked';
            $kursiplane->save();
        }

        if ($request->hasFile('bukti_pembayaran')) {
            if ($transaction->bukti_pembayaran && file_exists(public_path($transaction->bukti_pembayaran))) {
                unlink(public_path($transaction->bukti_pembayaran));
            }

            $file = $request->file('bukti_pembayaran');
            $destinationPath = 'static/img/data_transaction';
            $fileName = $file->getClientOriginalName();

            $file->move(public_path($destinationPath), $fileName);

            $transaction->bukti_pembayaran = $destinationPath . '/' . $fileName;
            $transaction->status_pembayaran = 'Completed';
            $transaction->save();
        }

        return redirect()->route('ticket')->with('success', 'Pembayaran Berhasil Dibuat');

    }

    public function refundPayment(Request $request)
    {
        $request->validate([
            'id_transaction' => 'required|numeric',
        ]);

        $transaction = Transaction::findOrFail($request->id_transaction);
        $pemesanan = Pemesanan::findOrFail($transaction->id_pemesanan);

        $detailPemesanan = DB::table('detail_pemesanan')
            ->where('id_pemesanan', '=', $pemesanan->id_pemesanan)
            ->get();

        foreach ($detailPemesanan as $item) {
            $kursiplane = KursiPlane::findOrFail($item->id_kursi_plane);
            $kursiplane->status = 'Available';
            $kursiplane->save();
        }

        $pemesanan->status = 'Cancelled';
        $transaction->status_pembayaran = 'Refund';
        $pemesanan->save();
        $transaction->save();

        return redirect()->route('profile', auth()->id())->with('success', 'We will refund the payment you have made.');
    }

    public function refundPaymentAdmin(Request $request)
    {
        $request->validate([
            'id_transaction' => 'required|numeric',
        ]);

        $transaction = Transaction::findOrFail($request->id_transaction);
        $pemesanan = Pemesanan::findOrFail($transaction->id_pemesanan);

        $detailPemesanan = DB::table('detail_pemesanan')
            ->where('id_pemesanan', '=', $pemesanan->id_pemesanan)
            ->get();

        foreach ($detailPemesanan as $item) {
            $kursiplane = KursiPlane::findOrFail($item->id_kursi_plane);
            $kursiplane->status = 'Available';
            $kursiplane->save();
        }

        $pemesanan->status = 'Cancelled';
        $transaction->status_pembayaran = 'Refund';
        $pemesanan->save();
        $transaction->save();

        return redirect()->route('transaction.index', )->with('success', 'We will refund the payment you have made.');
    }
}
