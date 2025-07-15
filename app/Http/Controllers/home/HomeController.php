<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use App\Models\Budaya;
use App\Models\Profile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman beranda dengan daftar wisata dan galeri.
     */
    public function index()
    {
        $profiles = Profile::all();
        $budaya = Budaya::all();
        $wisata = Wisata::with('galeri')->latest()->get();
        return view('home.index', compact('wisata', 'budaya', 'profiles'));
    }

    /**
     * Tampilkan detail wisata berdasarkan ID.
     */
    public function show($id)
    {
        $wisata = Wisata::with('galeri')->findOrFail($id);
        return view('home.show', compact('wisata'));
    }
    public function showBudaya($id)
    {
        $budaya = Budaya::findOrFail($id);
        return view('home.showbudaya', compact('budaya'));
    }
}
