@extends('home.layouts.app')

@section('title', $wisata->nama)

@section('content')
<section class="bg-[#e5ddd5] text-gray-800 font-sans pt-[5px]">
    {{-- HERO SECTION --}}
    <div class="w-full h-[80vh] overflow-hidden relative">
        @if($wisata->galeri->whereNotNull('url_video')->first())
            <video class="w-full h-full object-cover" autoplay loop muted playsinline>
                <source src="{{ $wisata->galeri->whereNotNull('url_video')->first()->url_video }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @elseif($wisata->galeri->first())
            <img src="{{ $wisata->galeri->first()->url_gambar }}" alt="{{ $wisata->nama }}" class="w-full h-full object-cover">
        @endif
    </div>

    {{-- DETAIL SECTION --}}
    <div class="max-w-screen-xl mx-auto grid md:grid-cols-3 gap-10 px-6 md:px-8 py-16">
        {{-- Images --}}
        <div class="md:col-span-2 grid grid-cols-2 gap-4">
            @foreach($wisata->galeri->whereNotNull('url_gambar')->take(2) as $media)
                <div class="w-full h-[500px] overflow-hidden rounded shadow">
                    <img src="{{ $media->url_gambar }}" alt="Galeri" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
            @endforeach
        </div>

        {{-- Text Content --}}
        <div class="space-y-4">
            <h2 class="text-4xl uppercase font-light tracking-widest leading-snug">
                {{ $wisata->nama }}
                <br><span class="font-semibold">Experience</span>
            </h2>

            <p class="text-sm text-gray-700 leading-relaxed">
                {{ $wisata->deskripsi }}
            </p>

            <div class="mt-6">
                <h3 class="uppercase text-sm font-bold tracking-widest mb-2">Amenities</h3>
                <ul class="text-sm space-y-2">
                    @foreach(explode(',', $wisata->fasilitas) as $item)
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ ucfirst(trim($item)) }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <p class="mt-6 font-medium text-gray-800">
                Tarif: Rp {{ number_format($wisata->tarif, 0, ',', '.') }}/Orang
            </p>

            <button class="inline-block mt-4 bg-gray-900 text-white px-6 py-2 uppercase text-sm tracking-wide hover:bg-black transition">
                Book ON: 08123456789
            </button>
        </div>
    </div>

    {{-- REMAINING GALLERY --}}
    @php
        $usedMediaIds = $wisata->galeri->take(3)->pluck('id'); // Hero (1) + 2 gambar
        $remainingMedia = $wisata->galeri->whereNotIn('id', $usedMediaIds);
    @endphp

    @if($remainingMedia->count())
    <div class="max-w-screen-xl mx-auto px-6 md:px-8 pb-20">
        <h3 class="text-xl font-semibold mb-6 uppercase tracking-widest">Gallery</h3>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($remainingMedia as $media)
                <div class="w-full overflow-hidden rounded shadow">
                    @if($media->url_video)
                        <video class="w-full h-[300px] object-cover rounded" autoplay loop muted playsinline>
                            <source src="{{ $media->url_video }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @elseif($media->url_gambar)
                        <img src="{{ $media->url_gambar }}" class="w-full h-[300px] object-cover hover:scale-105 transition-transform duration-300" alt="Galeri Tambahan">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endif
</section>
@endsection
