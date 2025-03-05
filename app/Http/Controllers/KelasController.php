<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Exception;
use Illuminate\Http\Request;

class KelasController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $kelas = Kelas::where('nama_kelas', 'LIKE', "%$search%")->get();
        } else {
            $kelas = Kelas::all();
        }

        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        try {
            $validationData = $request->validate([
                'nama_kelas' => 'required|string|max:100',
            ]);
            $checkData = Kelas::where('nama_kelas', '=', $validationData['nama_kelas'])->first();

            if (!$checkData) {
                Kelas::create($validationData);
                return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dimasukkan');
            } else {
                return redirect()->route('kelas.index')->with('error', 'Nama Kelas sudah ada');
            }
        } catch (Exception $e) {
            return redirect()->route('kelas.index')->with('error', 'Data kelas gagal dimasukkan');
        }
    }

    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);

        return view('admin.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        try {
            $kelas = Kelas::findOrFail($id);
            $validationData = $request->validate([
                'nama_kelas' => 'required|string|max:100',
            ]);
            if ($kelas->nama_kelas != $validationData['nama_kelas']) {

                $checkData = Kelas::where('nama_kelas', '=', $validationData['nama_kelas'])->first();

                if (!$checkData) {
                    $kelas->nama_kelas = $validationData['nama_kelas'];
                    $kelas->save();
                    return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diupdate');
                } else {
                    return redirect()->route('kelas.index')->with('error', 'Nama Kelas sudah ada');
                }
            } else {
                return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diupdate, dengan data yang sama');
            }
        } catch (Exception $e) {
            return redirect()->route('kelas.index')->with('error', 'Data kelas gagal diupdate');
        }
    }

    public function destroy($id)
    {
        try {
            $kelas = Kelas::findOrFail($id);

            $kelas->delete();

            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('kelas.index')->with('error', 'Data kelas gagal dihapus');
        }
    }
}
