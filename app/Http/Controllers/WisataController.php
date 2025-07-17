<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini di atas jika belum

class WisataController extends Controller
{
    /**
     * Menampilkan daftar semua wisata.
     */
    public function index()
    {
        $wisatum = Wisata::latest()->paginate(10);
        return view('dashboard.wisata.index', compact('wisatum'));
    }

    /**
     * Menampilkan form untuk membuat wisata baru.
     */
    public function create()
    {
        return view('dashboard.wisata.create');
    }

    /**
     * Menyimpan wisata baru ke database.
     */

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tarif' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'fasilitas' => 'nullable|string',
        ]);

        Wisata::create([
            'nama' => $request->nama,
            'tarif' => $request->tarif,
            'deskripsi' => $request->deskripsi,
            'fasilitas' => $request->fasilitas,
            'admin_id' => Auth::guard('admin')->id(), // ambil ID admin yang login
        ]);

        return redirect()->route('wisata.index')->with('success', 'Data wisata berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail dari wisata tertentu.
     */
    public function show($id)
    {
        $wisata = Wisata::with('galeri')->findOrFail($id);

        return view('dashboard.wisata.show', compact('wisata'));
    }

    /**
     * Menampilkan form edit wisata.
     */
    public function edit(Wisata $wisatum)
    {
        return view('dashboard.wisata.edit', compact('wisatum'));
    }

    /**
     * Memperbarui data wisata.
     */
    public function update(Request $request, Wisata $wisatum)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tarif' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'fasilitas' => 'nullable|string',
        ]);

        $wisatum->update($request->all());

        return redirect()->route('wisata.index')->with('success', 'Data wisata berhasil diperbarui.');
    }

    /**
     * Menghapus data wisata.
     */
    public function destroy(Wisata $wisatum)
    {
        $wisatum->delete();
        return redirect()->route('wisata.index')->with('success', 'Data wisata berhasil dihapus.');
    }
}
