@extends('dashboard.layouts.admin')

@section('title', 'Manajemen Profile')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h2 class="text-xl font-semibold">Data Profile</h2>
    @if ($profiles->count() < 1)
        <a href="{{ route('profile.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Tambah Profile
        </a>
    @endif
</div>


<div class="overflow-x-auto bg-white dark:bg-gray-800 rounded shadow">
    <table class="w-full text-left table-auto">
        <thead class="bg-gray-100 dark:bg-gray-700 text-sm uppercase">
            <tr>
                <th class="p-3">#</th>
                <th class="p-3">Nama</th>
                <th class="p-3">Deskripsi</th>
                <th class="p-3">Gambar</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @forelse ($profiles as $i => $profile)
            <tr class="border-t dark:border-gray-700">
                <td class="p-3">{{ $i + 1 }}</td>
                <td class="p-3">{{ $profile->nama }}</td>
                <td class="p-3 max-w-sm truncate">{{ Str::limit(strip_tags($profile->deskripsi), 100) }}</td>
                <td class="p-3">
                    @if($profile->url_gambar)
                        <img src="{{ asset($profile->url_gambar) }}" alt="Gambar" class="h-12 rounded shadow" />
                    @else
                        <span class="text-gray-500 italic">Tidak ada</span>
                    @endif
                </td>
                <td class="p-3 flex gap-2">
                    <a href="{{ route('profile.edit', $profile->id) }}" class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs">Edit</a>
                    <form action="{{ route('profile.destroy', $profile->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf @method('DELETE')
                        <button class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-gray-500 py-4">Belum ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
