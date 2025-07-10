<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        [x-cloak] { display: none !important; }
        body, html {
            overflow-x: hidden;
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow fixed top-0 left-0 w-full z-[1000]">
        <div class="container mx-auto flex justify-between items-center px-6 py-4">
            <a href="{{ url('/') }}" class="text-2xl font-light text-blue-gray-900">PantaiPro</a>
            <nav class="space-x-4">
                <a href="{{ url('/') }}" class="hover:text-blue-600">Beranda</a>
                <a href="{{ url('/#wisata') }}" class="hover:text-blue-600">Wisata</a>
                <a href="{{ url('/#kontak') }}" class="hover:text-blue-600">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- Content -->
    <main class="pt-[60px]">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="kontak" class="bg-gray-100 text-gray-700 py-8 mt-0 border-t">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Tentang Kami</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Kontak</h3>
                    <p>Email: support@pantaipro.com</p>
                    <p>Telp: +62 812-3456-7890</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Sosial Media</h3>
                    <p><a href="#" class="hover:underline">Instagram</a></p>
                    <p><a href="#" class="hover:underline">Facebook</a></p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
