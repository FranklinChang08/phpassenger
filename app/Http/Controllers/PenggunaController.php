<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Hash;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $pengguna = Pengguna::where("nama", "LIKE", "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('id_pengguna', 'LIKE', "%$search%")
                ->get();
        } else {
            $pengguna = Pengguna::all();
        }

        if (app()->runningInConsole()) {
            if ($pengguna->isEmpty()) {
                echo "Pengguna is not found";
            } else {
                foreach ($pengguna as $user) {
                    echo "\n";
                    echo "ID: " . $user->id_pengguna . "\n";
                    echo "Nama: " . $user->nama . "\n";
                    echo "Email: " . $user->email . "\n";
                    echo "Nomor Telepon: " . $user->nomor_telepon . "\n";
                    echo "Role: " . $user->role . "\n";
                    echo "----------------------------------------\n";
                }

            }
        }

        return view('admin.pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        return view('admin.pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|max:100|email|unique:Pengguna',
            'nomor_telepon' => 'required|string|max:15',
            'role' => 'required|in:Admin,Penumpang',
            'password' => 'required|string|min:8',
        ]);

        $validateData['password'] = Hash::make($validateData['password']);

        Pengguna::create($validateData);
        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengguna = Pengguna::findOrFail($id);

        return view('admin.pengguna.edit', compact('pengguna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:Pengguna,email,' . $id . ',id_pengguna',
            'nomor_telepon' => 'required|string|max:15',
            'role' => 'required|in:Admin,Penumpang',
            'password' => 'required|string|min:8',
        ]);

        $pengguna = Pengguna::findOrFail($id);

        $pengguna->nama = $validateData['nama'];
        $pengguna->email = $validateData['email'];
        $pengguna->nomor_telepon = $validateData['nomor_telepon'] ?? $pengguna->nomor_telepon;
        $pengguna->role = $validateData['role'];

        if (!empty($validateData['password'])) {
            $pengguna->password = Hash::make($validateData['password']);
        }

        $pengguna->save();

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);


        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'data berhasil dihapus');
    }
    public function updateprofile(Request $request, $id)
    {
        $validateData = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:Pengguna,email,' . $id . ',id_pengguna',
            'nomor_telepon' => 'required|string|min:11|max:15',
        ]);

        $pengguna = Pengguna::findOrFail($id);

        if ($request->hasFile('photo_profile')) {
            if ($pengguna->photo_profile && file_exists(public_path($pengguna->photo_profile))) {
                unlink(public_path($pengguna->photo_profile));
            }

            $file = $request->file('photo_profile');
            $destinationPath = 'static/img/data_pengguna';
            $fileName = $file->getClientOriginalName();

            $file->move(public_path($destinationPath), $fileName);

            $pengguna->nama = $validateData['nama'];
            $pengguna->email = $validateData['email'];
            $pengguna->nomor_telepon = $validateData['nomor_telepon'] ?? $pengguna->nomor_telepon;
            $pengguna->photo_profile = $destinationPath . '/' . $fileName;

            $pengguna->save();
        } else {
            $pengguna->nama = $validateData['nama'];
            $pengguna->email = $validateData['email'];
            $pengguna->nomor_telepon = $validateData['nomor_telepon'] ?? $pengguna->nomor_telepon;
        }


        return redirect()->route('login')->with('success', 'Data Profile anda berhasil diperbaharui');
    }

    public function updateprofilepassword(Request $request, $id)
    {
        $validateData = $request->validate([
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
        ]);

        if ($validateData['password'] == $validateData['confirm_password']) {
            $pengguna = Pengguna::findOrFail($id);
            $validateData['confirm_password'] = Hash::make($validateData['confirm_password']);
            $pengguna->password = $validateData['confirm_password'];
            $pengguna->save();
            return redirect()->route('login')->with('success', 'Data diperbaharui, silahkan login ulang');
        } else {
            return redirect()->route('profile', $id)->with('error', 'Data gagal diperbaharui, password tidak sesuai');
        }

    }
}
