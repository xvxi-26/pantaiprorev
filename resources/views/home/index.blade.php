@extends('home.layouts.app')

@section('title', 'Beranda')

@section('content')

<!-- Hero Section dengan Video Carousel -->
<section class="relative h-screen w-full overflow-hidden bg-black">
    <div class="absolute inset-0 z-0" id="video-container">
        @php
            $videoList = $wisata->flatMap(function ($w) {
                return $w->galeri->whereNotNull('url_video')->pluck('url_video');
            })->take(5);
        @endphp

        @foreach($videoList as $i => $video)
            <video
                class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}"
                autoplay muted loop playsinline data-index="{{ $i }}">
                <source src="{{ $video }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @endforeach
    </div>

    <div class="absolute inset-0 bg-black bg-opacity-50 z-10 flex flex-col items-center justify-center text-center px-6 text-white">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Kunjungi Pantai Pantai Terbaik</h1>
        <p class="text-lg max-w-xl">Eksplorasi keindahan Pantai-Pantai Yang Tersedia, Dengan Pengalaman Yang Memuaskan.</p>
    </div>
</section>

<!-- Konten Wisata -->
<section class="bg-[#e5ddd5] py-20 px-6 md:px-16 font-sans" id="wisata">
    @forelse($wisata as $index => $item)
    <div class="grid md:grid-cols-3 gap-10 items-center mb-24">
        {{-- Jika index genap: teks kiri, gambar kanan --}}
        @if($index % 2 == 0)
            {{-- Text kiri --}}
            <div class="md:col-span-1" data-aos="fade-right">
                <h2 class="text-4xl uppercase tracking-widest font-light text-gray-800 leading-snug mb-8">
                    {{ $item->nama }}
                    <br><span class="font-semibold">Experience</span>
                </h2>

                <p class="text-base text-gray-700 mb-4 leading-relaxed">{{ $item->deskripsi }}</p>
                <p class="text-base font-semibold text-gray-800 mb-6">Tarif: Rp {{ number_format($item->tarif, 0, ',', '.') }}</p>

                <a href="{{ route('wisata.detail', $item->id) }}" class="uppercase underline tracking-wide text-gray-800 text-sm hover:text-black">
                    Check Now
                </a>
            </div>

            {{-- Gambar kanan --}}
            <div class="md:col-span-2 grid md:grid-cols-2 gap-6" data-aos="fade-left">
                @foreach($item->galeri->take(2) as $media)
                    <div class="w-full aspect-[3/4] overflow-hidden rounded-lg shadow-lg bg-gray-300">
                        <img src="{{ $media->url_gambar }}" alt="{{ $item->id }}"
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
                    </div>
                @endforeach
            </div>
        @else
            {{-- Gambar kiri --}}
            <div class="md:col-span-2 grid md:grid-cols-2 gap-6 order-2 md:order-1" data-aos="fade-right">
                @foreach($item->galeri->take(2) as $media)
                    <div class="w-full aspect-[3/4] overflow-hidden rounded-lg shadow-lg bg-gray-300">
                        <img src="{{ $media->url_gambar }}" alt="{{ $item->id }}"
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
                    </div>
                @endforeach
            </div>

            {{-- Text kanan --}}
            <div class="md:col-span-1 order-1 md:order-2" data-aos="fade-left">
                <h2 class="text-4xl uppercase tracking-widest font-light text-gray-800 leading-snug mb-8">
                    {{ $item->nama }}
                    <br><span class="font-semibold">Experience</span>
                </h2>

                <p class="text-base text-gray-700 mb-4 leading-relaxed">{{ $item->deskripsi }}</p>
                <p class="text-base font-semibold text-gray-800 mb-6">Tarif: Rp {{ number_format($item->tarif, 0, ',', '.') }}</p>

                <a href="{{ route('wisata.detail', $item->id) }}" class="uppercase underline tracking-wide text-gray-800 text-sm hover:text-black">
                    Check Now
                </a>
            </div>
        @endif
    </div>
    @empty
        <div class="text-center text-gray-700">Belum ada data wisata.</div>
    @endforelse
</section>

{{-- Script carousel --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const videos = document.querySelectorAll('#video-container video');
        let current = 0;

        setInterval(() => {
            videos[current].classList.remove('opacity-100');
            videos[current].classList.add('opacity-0');

            current = (current + 1) % videos.length;

            videos[current].classList.remove('opacity-0');
            videos[current].classList.add('opacity-100');
        }, 5000); // Ganti video setiap 5 detik
    });
</script>

@endsection
