@extends('dashboard.layouts.admin')

@section('title', 'Data Budaya')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Daftar Budaya</h2>
        <a href="{{ route('budaya.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 inline-flex items-center gap-1">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Budaya
        </a>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded p-4">
        <table class="w-full text-left table-auto">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Gambar</th>
                    <th class="px-4 py-2">Video</th>
                    <th class="px-4 py-2">Deskripsi</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($budayas as $index => $budaya)
                    <tr class="border-t dark:border-gray-700">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 font-medium">{{ $budaya->nama }}</td>
                        <td class="px-4 py-2">
                            @if ($budaya->url_gambar)
                                <img src="{{ $budaya->url_gambar }}" alt="gambar budaya" class="w-20 h-14 object-cover rounded">
                            @else
                                <span class="text-sm text-gray-500 italic">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            @if ($budaya->url_video)
                                <video src="{{ $budaya->url_video }}" controls class="w-32 h-20 rounded"></video>
                            @else
                                <span class="text-sm text-gray-500 italic">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 font-medium">{{ $budaya->deskripsi }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('budaya.edit', $budaya->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm inline-flex items-center gap-1">
                                <i data-lucide="edit" class="w-4 h-4"></i> Edit
                            </a>
                            <form action="{{ route('budaya.destroy', $budaya->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm inline-flex items-center gap-1">
                                    <i data-lucide="trash" class="w-4 h-4"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">Belum ada data budaya.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
