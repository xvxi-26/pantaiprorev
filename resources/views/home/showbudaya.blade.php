@extends('home.layouts.app')

@section('title', $budaya->nama)

@section('content')
<section class="w-full">
    <!-- Gambar Hero -->
    <div class="h-[60vh] w-full bg-cover bg-center" style="background-image: url('{{ $budaya->url_gambar }}')">
        <div class="w-full h-full bg-black/30 flex items-center justify-center">
            <h1 class="text-3xl md:text-5xl font-light text-white tracking-widest text-center">{{ strtoupper($budaya->nama) }}</h1>
        </div>
    </div>

    <!-- Deskripsi -->
    <div class="bg-[#dcd2c7] text-center px-6 md:px-24 py-14">
        <h2 class="text-2xl md:text-3xl font-light tracking-wider uppercase text-gray-800 mb-6">{{ $budaya->nama }}</h2>
        <div class="text-sm md:text-base text-gray-700 max-w-4xl mx-auto leading-relaxed">
            {!! nl2br(e($budaya->deskripsi)) !!}
        </div>
    </div>

    <!-- Fullscreen Video (tanpa kontrol) -->
    @if($budaya->url_video)
    <div class="w-full h-[80vh] relative bg-black">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ $budaya->url_video }}" type="video/mp4">
            Browser tidak mendukung video.
        </video>
    </div>
    @endif
</section>
@endsection
