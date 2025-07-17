@extends('home.layouts.app')

@section('title', 'Beranda')

@section('content')

<!-- Hero Section with Parallax Video -->
<section class="relative h-screen w-full overflow-hidden bg-black parallax-hero">
    <div class="absolute inset-0 z-0" id="video-container">
        @php
            $videoList = $wisata->flatMap(function ($w) {
                return $w->galeri->whereNotNull('url_video')->pluck('url_video');
            })->take(5);
        @endphp

        @foreach($videoList as $i => $video)
            <video
                class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}"
                autoplay muted loop playsinline data-index="{{ $i }}" style="pointer-events: none;">
                <source src="{{ $video }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @endforeach
    </div>

    <div class="absolute inset-0 bg-black bg-opacity-50 z-10 flex flex-col items-center justify-center text-center px-6 text-white">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Pengalaman Wisata Terbaik</h1>
        <p class="text-lg max-w-xl">Eksplorasi keindahan Wisata Alam Dan Budaya, Experience Like Never Before</p>
    </div>
</section>

<!-- Profile Section -->
@if($profiles->count())
<section class="bg-[#2f2f2f] text-white font-sans px-6 md:px-16 py-20">
    @foreach($profiles as $index => $profile)
    <div class="grid md:grid-cols-2 gap-10 items-center">
        <!-- Gambar -->
        <div data-aos="fade-right" class="w-full h-[400px] md:h-[500px] overflow-hidden rounded-lg shadow-lg">
            <img src="{{ asset($profile->url_gambar) }}" alt="{{ $profile->nama }}" class="w-full h-full object-cover" />
        </div>

        <!-- Deskripsi -->
        <div data-aos="fade-left" class="space-y-6 md:pr-8">
            <h2 class="text-3xl md:text-5xl tracking-widest font-light uppercase">{{ $profile->nama }}</h2>
            <p class="text-sm md:text-base text-gray-300 leading-relaxed">
                {!! nl2br(e($profile->deskripsi)) !!}
            </p>
        </div>
    </div>
    @break {{-- Tampilkan hanya satu profile jika hanya satu --}}
    @endforeach
</section>
@endif


<!-- Wisata Section -->
<section class="bg-[#e5ddd5] py-20 px-6 md:px-16 font-sans" id="wisata">
    @forelse($wisata as $index => $item)
    <div class="grid md:grid-cols-3 gap-10 items-center mb-24">
        @if($index % 2 == 0)
            <div class="md:col-span-1" data-aos="fade-right">
                <h2 class="text-4xl uppercase tracking-widest font-light text-gray-800 leading-snug mb-8">
                    {{ $item->nama }} <br><span class="font-semibold">Experience</span>
                </h2>
                <p class="text-base text-gray-700 mb-4 leading-relaxed">{{ $item->deskripsi }}</p>
                <p class="text-base text-gray-700 mb-2">
                    <span class="font-semibold">Buka:</span> {{ \Carbon\Carbon::parse($item->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jam_tutup)->format('H:i') }}                </p>
                <p class="text-base font-semibold text-gray-800 mb-6">Tarif: Rp {{ number_format($item->tarif, 0, ',', '.') }}/Orang</p>
                <a href="{{ route('wisata.detail', $item->id) }}" class="uppercase underline tracking-wide text-gray-800 text-sm hover:text-black">
                    Check Now
                </a>
            </div>
            <div class="md:col-span-2 grid md:grid-cols-2 gap-6" data-aos="fade-left">
                @foreach($item->galeri->take(2) as $media)
                    <div class="w-full aspect-[3/4] overflow-hidden rounded-lg shadow-lg bg-gray-300">
                        <img src="{{ $media->url_gambar }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
                    </div>
                @endforeach
            </div>
        @else
            <div class="md:col-span-2 grid md:grid-cols-2 gap-6 order-2 md:order-1" data-aos="fade-right">
                @foreach($item->galeri->take(2) as $media)
                    <div class="w-full aspect-[3/4] overflow-hidden rounded-lg shadow-lg bg-gray-300">
                        <img src="{{ $media->url_gambar }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
                    </div>
                @endforeach
            </div>
            <div class="md:col-span-1 order-1 md:order-2" data-aos="fade-left">
                <h2 class="text-4xl uppercase tracking-widest font-light text-gray-800 leading-snug mb-8">
                    {{ $item->nama }} <br><span class="font-semibold">Experience</span>
                </h2>
                <p class="text-base text-gray-700 mb-4 leading-relaxed">{{ $item->deskripsi }}</p>
                <p class="text-base text-gray-700 mb-2">
                    <span class="font-semibold">Buka:</span> {{ \Carbon\Carbon::parse($item->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jam_tutup)->format('H:i') }}
                </p>
                <p class="text-base font-semibold text-gray-800 mb-6">Tarif: Rp {{ number_format($item->tarif, 0, ',', '.') }}/Orang</p>
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

<!-- Budaya Section -->
<section class="relative z-[50] bg-[#e5ddd5] py-16 px-4 md:px-16 font-sans">
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-light uppercase tracking-widest text-gray-800">Budaya</h2>
    </div>

    @if($budaya->count() > 2)
    <div class="swiper budayaSwiper relative z-10">
        <div class="swiper-wrapper">
            @foreach($budaya as $item)
            <div class="swiper-slide">
                <div class="max-w-sm mx-auto bg-white rounded overflow-hidden shadow-sm">
                    <div class="aspect-[3/4] overflow-hidden">
                        <img src="{{ $item->url_gambar }}" alt="{{ $item->nama }}" class="w-full h-full object-cover transition duration-300 hover:scale-105" />
                    </div>
                    <div class="px-3 py-4 text-left text-[13px] text-gray-700">
                        <h3 class="uppercase font-medium tracking-widest text-gray-800 mb-1">{{ $item->nama }}</h3>
                        <p class="text-xs text-gray-600 leading-relaxed mb-3">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 100) }}
                        </p>
                        <a href="{{ route('budayafront.show', $item->id) }}" class="text-[11px] uppercase tracking-widest text-gray-700 hover:underline">Learn More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="swiper-pagination mt-6"></div>
    @else
    <div class="grid md:grid-cols-3 gap-6">
        @foreach($budaya as $item)
        <div class="max-w-sm mx-auto bg-white rounded overflow-hidden shadow-sm">
            <div class="aspect-[3/4] overflow-hidden">
                <img src="{{ $item->url_gambar }}" alt="{{ $item->nama }}" class="w-full h-full object-cover transition duration-300 hover:scale-105" />
            </div>
            <div class="px-3 py-4 text-left text-[13px] text-gray-700">
                <h3 class="uppercase font-medium tracking-widest text-gray-800 mb-1">{{ $item->nama }}</h3>
                <p class="text-xs text-gray-600 leading-relaxed mb-3">
                    {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 100) }}
                </p>
                <a href="{{ route('budaya.show', $item->id) }}" class="text-[11px] uppercase tracking-widest text-gray-700 hover:underline">Learn More</a>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</section>

<!-- Styles & Scripts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Hero Video Carousel
        const videos = document.querySelectorAll('#video-container video');
        let current = 0;
        setInterval(() => {
            videos[current].classList.remove('opacity-100');
            videos[current].classList.add('opacity-0');
            current = (current + 1) % videos.length;
            videos[current].classList.remove('opacity-0');
            videos[current].classList.add('opacity-100');
        }, 5000);

        // Swiper for Budaya
        new Swiper('.budayaSwiper', {
            loop: true,
            grabCursor: true,
            spaceBetween: 24,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: { delay: 6000 },
            breakpoints: {
                640: { slidesPerView: 1 },
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            },
        });

        // AOS animation
        AOS.init();

        // Parallax effect for Hero
        window.addEventListener('scroll', () => {
            const scrolled = window.scrollY;
            document.querySelector('.parallax-hero').style.backgroundPositionY = `${scrolled * 0.4}px`;
        });
    });
</script>

@endsection
