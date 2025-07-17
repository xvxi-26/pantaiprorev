<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class PengunjungController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengunjung::with('wisata');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('notelp', 'like', "%$search%");
            });
        }

        $pengunjung = $query->latest()->paginate(10);
        return view('dashboard.pengunjung.index', compact('pengunjung'));
    }

    public function create()
    {
        return view('dashboard.pengunjung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'notelp' => 'required|string|max:20|unique:pengunjung,notelp',
        ]);

        Pengunjung::create($request->only('nama', 'alamat', 'notelp'));

        return redirect()->route('pengunjung.index')->with('success', 'Data pengunjung berhasil ditambahkan.');
    }

    public function tambahKunjunganForm($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        $wisata = Wisata::all();
        return view('dashboard.pengunjung.kunjungan', compact('pengunjung', 'wisata'));
    }

    public function simpanKunjungan(Request $request, $id)
    {
        $request->validate([
            'wisata_id' => 'required|exists:wisata,id',
            'waktu_kunjungan' => 'required|date',
        ]);

        $pengunjung = Pengunjung::findOrFail($id);
        $pengunjung->wisata()->attach($request->wisata_id, [
            'waktu_kunjungan' => Carbon::parse($request->waktu_kunjungan),
        ]);

        return redirect()->route('pengunjung.show', $id)->with('success', 'Kunjungan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pengunjung = Pengunjung::with(['wisata' => function ($q) {
            $q->withPivot('waktu_kunjungan');
        }])->findOrFail($id);

        return view('dashboard.pengunjung.show', compact('pengunjung'));
    }

    public function edit($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        return view('dashboard.pengunjung.edit', compact('pengunjung'));
    }

    public function update(Request $request, $id)
    {
        $pengunjung = Pengunjung::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'notelp' => [
                'required',
                'string',
                'max:20',
                Rule::unique('pengunjung', 'notelp')->ignore($pengunjung->id),
            ],
        ]);

        $pengunjung->update($request->only('nama', 'alamat', 'notelp'));

        return redirect()->route('pengunjung.index')->with('success', 'Data pengunjung berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        $pengunjung->wisata()->detach();
        $pengunjung->delete();

        return redirect()->route('pengunjung.index')->with('success', 'Data pengunjung berhasil dihapus.');
    }
}
