<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {}
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        .rotate-icon {
            transition: transform 0.4s ease-in-out;
        }
        .rotate-icon.rotate {
            transform: rotate(180deg);
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false }" class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-300">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside :class="{ '-ml-64': !sidebarOpen }"
               class="fixed md:static z-30 w-64 h-screen bg-white dark:bg-gray-800 shadow-md transition-all duration-300 transform md:translate-x-0">
            <div class="p-6 text-xl font-bold border-b dark:border-gray-700 flex items-center gap-2">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Data Wisata
            </div>
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                            <i data-lucide="Home" class="w-5 h-5"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('wisata.index') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                            <i data-lucide="map" class="w-5 h-5"></i> Wisata
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pengunjung.index') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                            <i data-lucide="user" class="w-5 h-5"></i> Pengunjung
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('budaya.index') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                            <i data-lucide="shirt" class="w-5 h-5"></i> Budaya
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.index') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                            <i data-lucide="map" class="w-5 h-5"></i> Manajemen Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.laporan.form') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
                            <i data-lucide="graph" class="w-5 h-5"></i> Laporan
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Overlay Mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
             class="fixed inset-0 z-20 bg-black bg-opacity-50 md:hidden" x-transition x-cloak></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow p-4 flex justify-between items-center sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 dark:text-gray-300">
                        <i x-show="!sidebarOpen" x-cloak data-lucide="menu" class="w-6 h-6"></i>
                        <i x-show="sidebarOpen" x-cloak data-lucide="x" class="w-6 h-6"></i>
                    </button>
                    <h1 class="text-xl font-semibold flex items-center gap-2">
                        <i data-lucide="list" class="w-5 h-5"></i> @yield('title')
                    </h1>
                </div>

                <div class="flex items-center gap-4">
                    <button id="theme-toggle" class="flex items-center gap-2 text-sm px-3 py-1 border rounded dark:border-gray-600">
                        <i id="theme-icon" data-lucide="sun" class="w-4 h-4 rotate-icon"></i> Mode
                    </button>

                    <!-- User -->
                    <div class="relative">
                        <button onclick="document.getElementById('user-menu').classList.toggle('hidden')"
                                class="flex items-center gap-2 text-sm px-3 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i data-lucide="user" class="w-4 h-4"></i>
                            <span class="hidden md:inline-block">Admin</span>
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </button>
                        <div id="user-menu" class="absolute right-0 mt-2 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded shadow-lg py-2 hidden z-10">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <i data-lucide="log-out" class="w-4 h-4 mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="p-4 md:p-6 max-w-7xl w-full mx-auto">
                @if(session('success'))
                    <div class="bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();

            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');

            if (
                localStorage.theme === 'dark' ||
                (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
            ) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }

            themeToggle?.addEventListener('click', () => {
                document.documentElement.classList.toggle('dark');
                localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
                themeIcon.classList.add('rotate');
                setTimeout(() => themeIcon.classList.remove('rotate'), 400);
            });
        });
    </script>
</body>
</html>
