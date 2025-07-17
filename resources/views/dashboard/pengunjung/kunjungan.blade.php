@extends('dashboard.layouts.admin')

@section('title', 'Tambah Kunjungan Wisata')

@section('content')
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Tambah Kunjungan untuk <span class="text-blue-600">{{ $pengunjung->nama }}</span></h2>

        <form action="{{ route('pengunjung.kunjungan.store', $pengunjung->id) }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="wisata_id" class="block font-semibold mb-1">Wisata Tujuan</label>
                <select name="wisata_id" id="wisata_id"
                        class="w-full px-4 py-2 border rounded dark:bg-gray-900 dark:border-gray-700" required>
                    <option value="">-- Pilih Wisata --</option>
                    @foreach ($wisata as $w)
                        <option value="{{ $w->id }}" {{ old('wisata_id') == $w->id ? 'selected' : '' }}>
                            {{ $w->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="waktu_kunjungan" class="block font-semibold mb-1">Waktu Kunjungan</label>
                <input type="datetime-local" name="waktu_kunjungan" id="waktu_kunjungan"
                       value="{{ old('waktu_kunjungan') }}"
                       class="w-full px-4 py-2 border rounded dark:bg-gray-900 dark:border-gray-700" required>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Simpan Kunjungan
                </button>
                <a href="{{ route('pengunjung.show', $pengunjung->id) }}"
                   class="px-6 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
