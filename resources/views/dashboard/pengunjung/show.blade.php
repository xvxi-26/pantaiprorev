@extends('dashboard.layouts.admin')

@section('title', 'Detail Pengunjung')

@section('content')
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow space-y-4">
        <div><strong>Nama:</strong> {{ $pengunjung->nama }}</div>
        <div><strong>Alamat:</strong> {{ $pengunjung->alamat }}</div>
        <div><strong>No Telepon:</strong> {{ $pengunjung->notelp }}</div>

        <div>
            <strong>Daftar Kunjungan Wisata:</strong>
            @if ($pengunjung->wisata->isEmpty())
                <div class="text-gray-500 mt-1">Belum ada kunjungan.</div>
            @else
                <ul class="list-disc ml-6 mt-2 space-y-1 text-sm">
                    @foreach ($pengunjung->wisata as $w)
                        <li>
                            {{ $w->nama }} -
                            <span class="text-gray-500">
                                {{ \Carbon\Carbon::parse($w->pivot->waktu_kunjungan)->translatedFormat('d F Y H:i') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="mt-4 flex gap-2">
            <a href="{{ route('pengunjung.kunjungan', $pengunjung->id) }}"
               class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Tambah Kunjungan
            </a>
            <a href="{{ route('pengunjung.edit', $pengunjung->id) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                Edit Data
            </a>
            <a href="{{ route('pengunjung.index') }}"
               class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                Kembali
            </a>
        </div>
    </div>
@endsection
