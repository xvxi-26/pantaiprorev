<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman beranda dengan daftar wisata dan galeri.
     */
    public function index()
    {
        $wisata = Wisata::with('galeri')->latest()->get();
        return view('home.index', compact('wisata'));
    }

    /**
     * Tampilkan detail wisata berdasarkan ID.
     */
    public function show($id)
    {
        $wisata = Wisata::with('galeri')->findOrFail($id);
        return view('home.show', compact('wisata'));
    }
}
