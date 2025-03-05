<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Kelas;
use App\Models\Rute;
use DB;
use Exception;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $kelas = Kelas::where('nama_kelas', 'LIKE', "%$search%")->get();
            $harga = DB::table('harga')
                ->join('kelas', 'harga.id_kelas', '=', 'kelas.id_kelas')
                ->join('rute', 'harga.id_rute', '=', 'rute.id_rute')
                ->select('harga.*', 'kelas.nama_kelas', 'rute.asal', 'rute.tujuan', 'rute.jarak_km')
                ->where('harga', 'LIKE', "%$search%")
                ->get();
        } else {
            $harga = DB::table('harga')
                ->join('kelas', 'harga.id_kelas', '=', 'kelas.id_kelas')
                ->join('rute', 'harga.id_rute', '=', 'rute.id_rute')
                ->select('harga.*', 'kelas.nama_kelas', 'rute.asal', 'rute.tujuan', 'rute.jarak_km')
                ->get();
        }

        $kelas = Kelas::all();
        $rute = Rute::all();
        return view('admin.harga.index', compact('harga', 'rute', 'kelas'));
    }
    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'id_kelas' => 'required|numeric',
                'id_rute' => 'required|numeric',
                'harga' => 'required|numeric|min:0',
            ]);

            $checkData = Harga::where('id_rute', $validateData['id_rute'])
                ->where('id_kelas', $validateData['id_kelas'])
                ->first();

            if ($checkData) {
                return redirect()->route('harga.index')->with('error', 'Data harga dengan rute dan kelas sama sudah ada');
            } else {
                Harga::create($validateData);
                return redirect()->route('harga.index')->with('success', 'Data harga berhasil dimasukkan');
            }
        } catch (Exception $e) {
            return redirect()->route('harga.index')->with('error', 'Data harga gagal dimasukkan');
        }
    }
    public function show($id)
    {
        $harga = harga::findOrFail($id);
        $kelas = Kelas::all();
        $rute = Rute::all();

        return view('admin.harga.edit', compact('harga', 'rute', 'kelas'));
    }
    public function update(Request $request, $id)
    {
        try {
            $harga = Harga::findOrFail($id);

            $validateData = $request->validate([
                'id_kelas' => 'required|numeric',
                'id_rute' => 'required|numeric',
                'harga' => 'required|numeric|min:0',
            ]);

            $checkDuplicate = Harga::where('id_rute', $validateData['id_rute'])
                ->where('id_kelas', $validateData['id_kelas'])
                ->where('id_harga', '!=', $id)
                ->exists();

            if ($checkDuplicate) {
                return redirect()->route('harga.index')->with('error', 'Data dengan rute dan kelas yang sama sudah ada.');
            }

            $harga->id_kelas = $validateData['id_kelas'];
            $harga->id_rute = $validateData['id_rute'];
            $harga->harga = $validateData['harga'];
            $harga->save();

            return redirect()->route('harga.index')->with('success', 'Data harga berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->route('harga.index')->with('error', 'Data harga gagal diperbaharui');
        }

    }
    public function destroy($id)
    {
        try {
            $harga = Harga::findOrFail($id);

            $harga->delete();

            return redirect()->route('harga.index')->with('success', 'Data harga berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('harga.index')->with('error', 'Data harga gagal dihapus');
        }
    }
}
