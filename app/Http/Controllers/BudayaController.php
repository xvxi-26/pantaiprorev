<?php

namespace App\Http\Controllers;

use App\Models\Budaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BudayaController extends Controller
{
    /**
     * Tampilkan daftar budaya.
     */
    public function index()
    {
        $budayas = Budaya::all();
        return view('dashboard.budaya.index', compact('budayas'));
    }

    /**
     * Tampilkan form tambah budaya.
     */
    public function create()
    {
        return view('dashboard.budaya.create');
    }

    /**
     * Simpan data budaya baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
            'video' => 'nullable|mimetypes:video/mp4,video/quicktime|max:102400',
        ]);

        $urlGambar = null;
        $urlVideo = null;

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('budaya/gambar', 'public');
            $urlGambar = Storage::url($path);
        }

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('budaya/video', 'public');
            $urlVideo = Storage::url($path);
        }

        Budaya::create([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'],
            'url_gambar' => $urlGambar,
            'url_video' => $urlVideo,
        ]);

        return redirect()->route('budaya.index')->with('success', 'Data budaya berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit budaya.
     */
    public function edit($id)
    {
        $budaya = Budaya::findOrFail($id);
        return view('dashboard.budaya.edit', compact('budaya'));
    }

    /**
     * Update data budaya.
     */
    public function update(Request $request, $id)
    {
        $budaya = Budaya::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'gambar' => 'nullable|image|max:2048',
            'video' => 'nullable|mimetypes:video/mp4,video/quicktime|max:102400',
        ]);

        if ($request->hasFile('gambar')) {
            if ($budaya->url_gambar) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $budaya->url_gambar));
            }
            $path = $request->file('gambar')->store('budaya/gambar', 'public');
            $budaya->url_gambar = Storage::url($path);
        }

        if ($request->hasFile('video')) {
            if ($budaya->url_video) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $budaya->url_video));
            }
            $path = $request->file('video')->store('budaya/video', 'public');
            $budaya->url_video = Storage::url($path);
        }

        $budaya->nama = $validated['nama'];
        $budaya->deskripsi = $validated['deskripsi'];
        $budaya->save();

        return redirect()->route('budaya.index')->with('success', 'Data budaya berhasil diperbarui.');
    }

    /**
     * Hapus data budaya.
     */
    public function destroy($id)
    {
        $budaya = Budaya::findOrFail($id);

        if ($budaya->url_gambar) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $budaya->url_gambar));
        }

        if ($budaya->url_video) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $budaya->url_video));
        }

        $budaya->delete();

        return redirect()->route('budaya.index')->with('success', 'Data budaya berhasil dihapus.');
    }
}
