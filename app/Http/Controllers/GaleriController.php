<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\Wisata;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GaleriController extends Controller
{
    /**
     * Form upload media.
     */
    public function create($wisataId)
    {
        $wisata = Wisata::findOrFail($wisataId);
        return view('dashboard.wisata.galeri.create', compact('wisata'));
    }

    /**
     * Simpan gambar/video yang diunggah.
     */
    public function store(Request $request, $wisataId)
    {
        $request->validate([
            'gambar.*' => 'nullable|image|max:2048',
            'video.*'  => 'nullable|mimetypes:video/mp4,video/quicktime|max:102400',
        ]);

        // Simpan semua gambar
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $gambar) {
                $path = $gambar->store('galeri/gambar', 'public');
                Galeri::create([
                    'wisata_id' => $wisataId,
                    'url_gambar' => Storage::url($path),
                    'url_video' => null,
                    'admin_id' => Auth::guard('admin')->id(),
                ]);
            }
        }

        // Simpan semua video
        if ($request->hasFile('video')) {
            foreach ($request->file('video') as $video) {
                $path = $video->store('galeri/video', 'public');
                Galeri::create([
                    'wisata_id' => $wisataId,
                    'url_gambar' => null,
                    'url_video' => Storage::url($path),
                ]);
            }
        }

        return redirect()->route('wisata.show', $wisataId)->with('success', 'Media berhasil ditambahkan.');
    }


    /**
     * Tampilkan form edit media.
     */
    public function edit($wisataId, $galeriId)
    {
        $wisata = Wisata::findOrFail($wisataId);
        $galeri = Galeri::where('wisata_id', $wisataId)->findOrFail($galeriId);

        return view('dashboard.wisata.galeri.edit', compact('wisata', 'galeri'));
    }

    /**
     * Update media galeri.
     */
    public function update(Request $request, $wisataId, $galeriId)
    {
        $galeri = Galeri::where('wisata_id', $wisataId)->findOrFail($galeriId);

        $request->validate([
            'gambar' => 'nullable|image|max:2048',
            'video' => 'nullable|mimetypes:video/mp4,video/quicktime|max:10240',
        ]);

        // Hapus gambar lama jika diganti
        if ($request->hasFile('gambar')) {
            if ($galeri->url_gambar) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $galeri->url_gambar));
            }

            $path = $request->file('gambar')->store('galeri/gambar', 'public');
            $galeri->url_gambar = Storage::url($path);
        }

        // Hapus video lama jika diganti
        if ($request->hasFile('video')) {
            if ($galeri->url_video) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $galeri->url_video));
            }

            $path = $request->file('video')->store('galeri/video', 'public');
            $galeri->url_video = Storage::url($path);
        }

        $galeri->save();

        return redirect()->route('wisata.show', $wisataId)->with('success', 'Galeri berhasil diperbarui.');
    }

    /**
     * Hapus media.
     */
    public function destroy($wisataId, $galeriId)
    {
        $galeri = Galeri::where('wisata_id', $wisataId)->findOrFail($galeriId);

        if ($galeri->url_gambar) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $galeri->url_gambar));
        }

        if ($galeri->url_video) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $galeri->url_video));
        }

        $galeri->delete();

        return redirect()->back()->with('success', 'Media berhasil dihapus.');
    }
}
