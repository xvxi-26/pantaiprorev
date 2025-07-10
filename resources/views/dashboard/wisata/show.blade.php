@extends('dashboard.layouts.admin')

@section('title', 'Detail Wisata')

@section('content')
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow space-y-6">
    <div>
        <h2 class="text-2xl font-bold mb-2">{{ $wisata->nama }}</h2>
        <p class="text-gray-700 dark:text-gray-300"><strong>Tarif:</strong> Rp{{ number_format($wisata->tarif, 0, ',', '.') }}</p>
        <p class="text-gray-700 dark:text-gray-300 mt-2"><strong>Deskripsi:</strong></p>
        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $wisata->deskripsi }}</p>

        <p class="text-gray-700 dark:text-gray-300 mt-2"><strong>Fasilitas:</strong></p>
        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $wisata->fasilitas }}</p>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('wisata.galeri.create', $wisata->id) }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm flex items-center gap-2">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Media
        </a>
    </div>

    <div>
        <h3 class="text-lg font-semibold mb-3">Galeri Media</h3>

        @if($wisata->galeri->isEmpty())
            <p class="text-gray-500 dark:text-gray-400">Belum ada media.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($wisata->galeri as $item)
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded shadow">
                        <h4 class="font-medium mb-2">{{ $item->nama }}</h4>

                        @if($item->url_gambar)
                            <img src="{{ $item->url_gambar }}" alt="Gambar" class="rounded mb-2">
                        @endif

                        @if($item->url_video)
                            <video controls class="w-full mt-2">
                                <source src="{{ $item->url_video }}" type="video/mp4">
                                Video tidak didukung browser.
                            </video>
                        @endif

                        <div class="flex justify-between items-center mt-4">

                            <form action="{{ route('wisata.galeri.destroy', [$wisata->id, $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus media ini?')" class="text-sm text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('wisata.index') }}" class="px-4 py-2 rounded bg-gray-200 dark:bg-gray-700 text-sm hover:bg-gray-300 dark:hover:bg-gray-600">
            Kembali
        </a>
    </div>
</div>
@endsection
