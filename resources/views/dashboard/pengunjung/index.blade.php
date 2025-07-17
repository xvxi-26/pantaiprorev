@extends('dashboard.layouts.admin')

@section('title', 'Daftar Pengunjung')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Data Pengunjung</h2>
        <a href="{{ route('pengunjung.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Tambah Pengunjung
        </a>
    </div>

    {{-- FORM PENCARIAN --}}
    <form method="GET" action="{{ route('pengunjung.index') }}" class="mb-4">
        <div class="flex items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama atau no telp..."
                   class="px-3 py-2 w-full border rounded dark:bg-gray-800 dark:text-white" />
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Cari
            </button>
        </div>
    </form>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 dark:bg-green-700 dark:text-white">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-700 text-sm text-gray-700 dark:text-gray-200">
                <tr>
                    <th class="p-3 text-left w-12">No</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Alamat</th>
                    <th class="p-3 text-left">No Telp</th>
                    <th class="p-3 text-left">Wisata</th>
                    <th class="p-3 text-left">Waktu Kunjungan</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                @forelse ($pengunjung as $index => $item)
                    <tr>
                        <td class="p-3">{{ ($pengunjung->currentPage() - 1) * $pengunjung->perPage() + $index + 1 }}</td>
                        <td class="p-3">{{ $item->nama }}</td>
                        <td class="p-3">{{ $item->alamat }}</td>
                        <td class="p-3">{{ $item->notelp }}</td>
                        <td class="p-3">
                            @foreach ($item->wisata as $w)
                                <div>{{ $w->nama }}</div>
                            @endforeach
                        </td>
                        <td class="p-3">
                            @foreach ($item->wisata as $w)
                                <div>{{ \Carbon\Carbon::parse($w->pivot->waktu_kunjungan)->translatedFormat('d F Y') }}</div>
                            @endforeach
                        </td>
                        <td class="p-3 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('pengunjung.show', $item->id) }}"
                                title="Lihat detail pengunjung"
                                class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Detail
                                </a>
                                <a href="{{ route('pengunjung.kunjungan', $item->id) }}"
                                title="Tambah data kunjungan"
                                class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Tambah Kunjungan
                                </a>
                                <a href="{{ route('pengunjung.edit', $item->id) }}"
                                title="Edit data pengunjung"
                                class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                    Edit
                                </a>
                                <form action="{{ route('pengunjung.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            title="Hapus data pengunjung"
                                            class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="p-4 text-center">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pengunjung->appends(['search' => request('search')])->links() }}
    </div>
@endsection
