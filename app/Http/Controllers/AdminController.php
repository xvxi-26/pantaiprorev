<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;
use Illuminate\Support\Facades\Auth;
use App\Models\Wisata;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengunjungExport;
use Carbon\Carbon;
use App\Models\Kunjungan;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect(route('admin.login'));
        }

        $jumlahPengunjung = Pengunjung::count();
        return view('dashboard.index', compact('jumlahPengunjung'));
    }

    public function laporanForm()
    {
        $wisatas = Wisata::all();
        return view('dashboard.laporan.form', compact('wisatas'));
    }

    public function cetakLaporan(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            'wisata_id' => 'nullable|exists:wisata,id',
            'format' => 'required|in:pdf,excel',
        ]);

        $from = Carbon::parse($request->tanggal_awal)->startOfDay();
        $to = Carbon::parse($request->tanggal_akhir)->endOfDay();

        $query = Kunjungan::with(['wisata', 'pengunjung'])
                    ->whereBetween('waktu_kunjungan', [$from, $to]);

        if ($request->wisata_id) {
            $query->where('wisata_id', $request->wisata_id);
        }

        $kunjungan = $query->get();

        $data = [
            'judul' => 'Laporan Kunjungan Wisata',
            'periode' => 'Periode: ' . $from->format('d M Y') . ' - ' . $to->format('d M Y'),
            'tanggal' => now()->translatedFormat('l, d F Y'),
            'pengunjung' => $kunjungan,
            'request' => $request
        ];

        if ($request->format === 'pdf') {
            $pdf = Pdf::loadView('dashboard.laporan.pdf', $data);
            return $pdf->download('laporan_pengunjung_' . now()->format('Ymd_His') . '.pdf');
        }

        if ($request->format === 'excel') {
            return Excel::download(new PengunjungExport($kunjungan), 'laporan_pengunjung_' . now()->format('Ymd_His') . '.xlsx');
        }

        return back()->with('error', 'Format ekspor tidak dikenali.');
    }

}
