<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Tampilkan semua profile.
     */
    public function index()
    {
        $profiles = Profile::all();
        return view('dashboard.profile.index', compact('profiles'));
    }

    /**
     * Tampilkan form tambah profile.
     */
    public function create()
    {
        return view('dashboard.profile.create');
    }

    /**
     * Simpan profile baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'url_gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $urlGambar = null;

        if ($request->hasFile('url_gambar')) {
            $path = $request->file('url_gambar')->store('profile', 'public');
            $urlGambar = Storage::url($path);
        }

        Profile::create([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'],
            'url_gambar' => $urlGambar,
            'admin_id' => Auth::guard('admin')->id(), // ambil ID admin login
        ]);

        return redirect()->route('profile.index')->with('success', 'Profile berhasil ditambahkan');
    }

    /**
     * Tampilkan form edit profile.
     */
    public function edit(Profile $profile)
    {
        return view('dashboard.profile.edit', compact('profile'));
    }

    /**
     * Update profile.
     */
    public function update(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'url_gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('url_gambar')) {
            if ($profile->url_gambar) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $profile->url_gambar));
            }

            $path = $request->file('url_gambar')->store('profile', 'public');
            $profile->url_gambar = Storage::url($path);
        }

        $profile->nama = $validated['nama'];
        $profile->deskripsi = $validated['deskripsi'];
        $profile->save();

        return redirect()->route('profile.index')->with('success', 'Profile berhasil diperbarui');
    }

    /**
     * Hapus profile.
     */
    public function destroy(Profile $profile)
    {
        if ($profile->url_gambar) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $profile->url_gambar));
        }

        $profile->delete();

        return redirect()->route('profile.index')->with('success', 'Profile berhasil dihapus');
    }
}
