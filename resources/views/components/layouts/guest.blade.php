<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPAN MAS - Pengaduan Masyarakat</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS (v4.6) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Custom Styles -->
    @yield('styles')

    <style>
        .footer-logos img {
            width: 100px;
            height: auto;
            margin: 0 5px;
        }
    </style>
</head>

<body class="bg-light">

    {{-- Header Navigation --}}
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="flex">
                    <a class="navbar-brand navbar-brand-custom font-weight-bold" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" class="w-12 h-12" alt="Logo">
                    </a>
                    <div class="flex flex-col">
                        <span class="text-lg font-bold text-gray-800">Pemerintah Kabupaten Simalungun</span>
                        <span class="text-sm text-gray-600">Inspektorat</span>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-black font-bold" href="{{ route('login') }}">LOGIN</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- This is where your Livewire component will be rendered -->
    {{ $slot }}

    {{-- Footer --}}

    <!-- ========== NEW FOOTER SECTION ========== -->
    <footer class="bg-gray-900 text-gray-400">
        <div class="container mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Column 1: Agency Info -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-12">
                        <h2 class="text-lg font-bold text-white">Inspektorat Daerah<br>Kabupaten Simalungun</h2>
                    </div>
                    <p class="text-sm">Komplek Perkantoran Pemerintah Kabupaten Simalungun</p>
                    <ul class="space-y-2 text-sm">
                        <li><span class="font-semibold text-white">Phone:</span> 062341182</li>
                        <li><span class="font-semibold text-white">Fax:</span> 062341182</li>
                        <li><span class="font-semibold text-white">Email:</span> Email</li>
                    </ul>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Buat Pengaduan</a>
                        </li>
                        {{-- <li><a href="#" class="hover:text-white transition-colors">INFORMASI</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">DOWNLOAD</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">STAFF</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">VIDEO</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">GALERI</a></li> --}}
                    </ul>
                </div>

                <div class="grid grid-cols-3 items-center gap-2 footer-logos">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo 1">
                    <img src="{{ asset('images/bpkp-logo.png') }}" alt="Logo 2">
                    <img src="{{ asset('images/kpk-logo.png') }}" alt="Logo 3">
                    <img src="{{ asset('images/logo-bangga-melayani-bangsa.png') }}" alt="Logo 4">
                    <img src="{{ asset('images/logo-berakhlak.png') }}" alt="Logo 5">
                    <img src="{{ asset('images/logo-berani-jujur-hebat.png') }}" alt="Logo 6">
                </div>
                <!-- Column 3: Categories -->
                {{-- <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Categories</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Berita</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Video</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Kegiatan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Informasi</a></li>
                    </ul>
                </div> --}}

                <!-- Column 4: Recent Post -->
                {{-- <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Recent Post</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center space-x-3">
                            <img src="https://placehold.co/70x70/333/fff?text=Post" alt="Recent Post 1"
                                class="w-16 h-16 rounded-md object-cover">
                            <div>
                                <p class="text-xs text-gray-500">UNCATEGORIZED</p>
                                <a href="#" class="text-sm text-white hover:underline">DLH Hadiri Pertemuan
                                    dengan...</a>
                            </div>
                        </li>
                        <li class="flex items-center space-x-3">
                            <img src="https://placehold.co/70x70/333/fff?text=Post" alt="Recent Post 2"
                                class="w-16 h-16 rounded-md object-cover">
                            <div>
                                <p class="text-xs text-gray-500">UNCATEGORIZED</p>
                                <a href="#" class="text-sm text-white hover:underline">DLH Hadiri Review
                                    Renstra.</a>
                            </div>
                        </li>
                        <li class="flex items-center space-x-3">
                            <img src="https://placehold.co/70x70/333/fff?text=Post" alt="Recent Post 3"
                                class="w-16 h-16 rounded-md object-cover">
                            <div>
                                <p class="text-xs text-gray-500">KEGIATAN</p>
                                <a href="#" class="text-sm text-white hover:underline">DLH Hadiri Rapat
                                    Persiapan.</a>
                            </div>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>

        {{-- footer logos --}}
        {{-- <div class="container mx-auto flex justify-center gap-2 footer-logos">
            <img src="{{ asset('images/logo.png') }}" alt="Logo 1">
            <img src="{{ asset('images/bpkp-logo.png') }}" alt="Logo 2">
            <img src="{{ asset('images/kpk-logo.png') }}" alt="Logo 3">
            <img src="{{ asset('images/logo-bangga-melayani-bangsa.png') }}" alt="Logo 4">
            <img src="{{ asset('images/logo-berakhlak.png') }}" alt="Logo 5">
            <img src="{{ asset('images/logo-berani-jujur-hebat.png') }}" alt="Logo 6">
        </div> --}}

        <!-- Sub-footer -->
        <div class="border-t border-gray-800">
            <div class="container mx-auto px-6 py-6 flex flex-col md:flex-row justify-between items-center text-sm">
                <div class="flex space-x-4 mb-4 md:mb-0">
                    <a href="https://www.instagram.com/inspektorat_simalungun/"
                        class="text-gray-400 hover:text-white"><svg class="w-5 h-5" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.689-.073-4.948-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44 1.441-.645 1.441-1.44-.645-1.44-1.441-1.44z" />
                        </svg>
                    </a>
                </div>
                <div class="flex space-x-4">
                    <p class="mb-0">&copy; {{ date('Y') }} Inspektorat Daerah Kabupaten Simalungun.</p>
                </div>
            </div>
        </div>
    </footer>

    {{-- <footer class="bg-white text-center text-muted p-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Inspektorat Kabupaten Simalungun.</p>
        </div>
    </footer> --}}

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>

</html>
