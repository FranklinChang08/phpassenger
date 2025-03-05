<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use Illuminate\Http\Request;

class RuteController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $rute = Rute::where('asal', 'LIKE', "%$search%")->get();
        } else {
            $rute = Rute::all();
        }

        return view('admin.rute.index', compact('rute'));
    }

    public function create()
    {
        return view('admin.rute.create');
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'asal' => 'required|string|max:100',
            'tujuan' => 'required|string|max:100',
            'jarak_km' => 'required|numeric|min:0'
        ]);

        $checkData = Rute::where('asal', $validateData['asal'])
            ->where('tujuan', $validateData['tujuan'])
            ->first();

        if ($checkData) {
            return redirect()->route('rute.index')->with('error', 'Data rute sudah ada');
        } else {
            Rute::create($validateData);
            return redirect()->route('rute.index')->with('success', 'Data rute berhasil ditambahkan');
        }
    }
    public function show($id)
    {
        $rute = Rute::findOrFail($id);

        return view('admin.rute.edit', compact('rute'));
    }
    public function update(Request $request, $id)
    {
        $rute = Rute::findOrFail($id);
        $validateData = $request->validate([
            'asal' => 'required|string|max:100',
            'tujuan' => 'required|string|max:100',
            'jarak_km' => 'required|numeric|min:0'
        ]);

        $checkData = Rute::where('asal', $validateData['asal'])
            ->where('tujuan', $validateData['tujuan'])
            ->where('id_rute', '!=', $id)
            ->exists();


        if ($checkData) {
            return redirect()->route('rute.index')->with('error', 'Data rute sudah ada');
        } else {
            $rute->asal = $validateData['asal'];
            $rute->tujuan = $validateData['tujuan'];
            $rute->jarak_km = $validateData['jarak_km'];

            $rute->save();
            return redirect()->route('rute.index')->with('success', 'Data rute berhasil ditambahkan');
        }
    }
    public function destroy($id)
    {
        $rute = Rute::findOrFail($id);
        $rute->delete();

        return redirect()->route('rute.index')->with('success', 'Data rute berhasil dihapus');
    }
}
