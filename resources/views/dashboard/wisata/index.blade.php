@extends('dashboard.layouts.admin')

@section('title', 'Data Wisata')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h2 class="text-xl font-semibold">Daftar Wisata</h2>
    <a href="{{ route('wisata.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
        + Tambah Wisata
    </a>
</div>

<div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase">
            <tr>
                <th class="px-6 py-3">Nama</th>
                <th class="px-6 py-3">Tarif</th>
                <th class="px-6 py-3">Fasilitas</th>
                <th class="px-6 py-3">Jam Buka</th>
                <th class="px-6 py-3">Jam Tutup</th>
                <th class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y dark:divide-gray-700">
            @forelse ($wisatum as $item)
            <tr>
                <td class="px-6 py-4">{{ $item->nama }}</td>
                <td class="px-6 py-4">Rp {{ number_format($item->tarif, 0, ',', '.') }}</td>
                <td class="px-6 py-4">{{ $item->fasilitas }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->jam_buka)->format('H:i') }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->jam_tutup)->format('H:i') }}</td>
                <td class="px-6 py-4 flex flex-wrap gap-2 justify-center">
                    <a href="{{ route('wisata.show', $item) }}" class="px-3 py-1 bg-gray-500 hover:bg-gray-600 text-white rounded text-xs">
                        Detail
                    </a>
                    <a href="{{ route('wisata.edit', $item) }}" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-xs">
                        Edit
                    </a>
                    <form action="{{ route('wisata.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus wisata ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center px-6 py-4">Belum ada data wisata.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $wisatum->links() }}
</div>
@endsection
