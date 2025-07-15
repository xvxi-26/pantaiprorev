<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengunjungController extends Controller
{
    /**
     * Menampilkan semua data pengunjung.
     */
    public function index()
    {
        $pengunjung = Pengunjung::with('wisata')->latest()->paginate(10);
        return view('dashboard.pengunjung.index', compact('pengunjung'));
    }

    /**
     * Menampilkan form tambah pengunjung.
     */
    public function create()
    {
        $wisata = Wisata::all();
        return view('dashboard.pengunjung.create', compact('wisata'));
    }

    /**
     * Simpan data pengunjung baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'wisata_id' => 'required|exists:wisata,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'notelp' => 'required|string|max:20',
            'waktu_kunjungan' => 'required|date',
        ]);

        Pengunjung::create([
            'wisata_id' => $request->wisata_id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'notelp' => $request->notelp,
            'waktu_kunjungan' => Carbon::parse($request->waktu_kunjungan),
        ]);

        return redirect()->route('pengunjung.index')->with('success', 'Data pengunjung berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pengunjung.
     */
    public function show($id)
    {
        $pengunjung = Pengunjung::with('wisata')->findOrFail($id);
        return view('dashboard.pengunjung.show', compact('pengunjung'));
    }

    /**
     * Menampilkan form edit pengunjung.
     */
    public function edit($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        $wisata = Wisata::all();
        return view('dashboard.pengunjung.edit', compact('pengunjung', 'wisata'));
    }

    /**
     * Simpan perubahan data pengunjung.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'wisata_id' => 'required|exists:wisata,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'notelp' => 'required|string|max:20',
            'waktu_kunjungan' => 'required|date',
        ]);

        $pengunjung = Pengunjung::findOrFail($id);
        $pengunjung->update([
            'wisata_id' => $request->wisata_id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'notelp' => $request->notelp,
            'waktu_kunjungan' => Carbon::parse($request->waktu_kunjungan),
        ]);

        return redirect()->route('pengunjung.index')->with('success', 'Data pengunjung berhasil diperbarui.');
    }

    /**
     * Hapus data pengunjung.
     */
    public function destroy($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        $pengunjung->delete();

        return redirect()->route('pengunjung.index')->with('success', 'Data pengunjung berhasil dihapus.');
    }
}
