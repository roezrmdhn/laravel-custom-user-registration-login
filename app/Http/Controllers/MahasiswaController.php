<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{

    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswas'));
    }
    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'nama' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->file('foto')) {
            $fotoPath = $request->file('foto')->store('mahasiswa', 'public');
        }

        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('mahasiswa.create')->with('success', 'Mahasiswa created successfully.');
    }
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('mahasiswa', 'public');
            $mahasiswa->foto = $path;
        }

        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa updated successfully');
    }
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Hapus file foto dari storage jika ada
        if ($mahasiswa->foto) {
            Storage::disk('public')->delete($mahasiswa->foto);
        }

        // Hapus data mahasiswa dari database
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa deleted successfully');
    }
}
