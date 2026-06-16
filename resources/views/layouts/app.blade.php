<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title', 'SHOWTIX - Pemesanan Tiket Konser')@show</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|poppins:600,700" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-blue: #0047FF;
            --primary-blue-2: #0B57FF;
            --primary-blue-3: #1E63FF;
            --accent-orange: #FF5C00;
            --accent-orange-2: #FF6B00;
            --accent-orange-3: #FF7A00;
            --dark-navy: #050816;
            --slate-card: #081224;
            --deep-card: #0B1730;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        .font-display {
            font-family: 'Poppins', sans-serif;
        }

        .btn-primary {
            @apply bg-gradient-to-r from-[#0047FF] to-[#FF6B00] text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-[0_0_28px_rgba(0,71,255,0.36),0_0_24px_rgba(255,92,0,0.26)];
        }

        .btn-outline-primary {
            @apply border-2 border-[#0047FF] text-white px-6 py-3 rounded-xl font-semibold hover:bg-gradient-to-r hover:from-[#0047FF] hover:to-[#FF6B00] hover:border-transparent transition-all duration-300;
        }

        .btn-orange {
            @apply bg-gradient-to-r from-[#FF5C00] to-[#FF7A00] text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:shadow-orange-500/20 transition-all duration-300 transform hover:scale-105;
        }

        .badge-orange {
            @apply inline-block bg-gradient-to-r from-[#FF5C00] to-[#FF7A00] text-white px-3 py-1 rounded-full text-xs font-semibold;
        }

        .badge-blue {
            @apply inline-block bg-gradient-to-r from-[#0047FF] to-[#0B57FF] text-white px-3 py-1 rounded-full text-xs font-semibold;
        }

        .card-concert {
            @apply bg-[#081224] border border-[#0047FF]/20 rounded-2xl shadow-xl hover:shadow-blue-500/5 transition-all duration-300 overflow-hidden transform hover:-translate-y-2;
        }

        .gradient-text {
            background: linear-gradient(135deg, #0047FF 0%, #FF6B00 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .shimmer {
            background: linear-gradient(90deg, #081224 25%, #0B1730 50%, #081224 75%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>

    @stack('css')
</head>
<body class="showtix-shell text-gray-100 min-h-screen flex flex-col justify-between selection:bg-[#FF5C00] selection:text-white">
    <!-- Navbar -->
    <nav id="mainNavbar" class="bg-[#050816]/80 backdrop-blur-[20px] border-b border-white/5 sticky top-0 z-50 transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="flex items-center hover:opacity-95 transition">
                        <img src="{{ asset('images/showtix-logo.png') }}" alt="SHOWTIX" class="showtix-logo h-12 w-auto max-w-[170px]">
                    </a>
                    
                    <!-- Navigation Links (Desktop) -->
                    <div class="hidden md:flex items-center gap-6">
                        <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-300 hover:text-white hover:drop-shadow-[0_0_10px_rgba(0,71,255,0.6)] transition">Home</a>
                        <a href="{{ route('home') }}#concerts" class="text-sm font-semibold text-gray-300 hover:text-white hover:drop-shadow-[0_0_10px_rgba(0,71,255,0.6)] transition">Concert</a>
                        <a href="{{ Auth::check() ? route('tickets') : route('login') }}" class="text-sm font-semibold text-gray-300 hover:text-white hover:drop-shadow-[0_0_10px_rgba(0,71,255,0.6)] transition">My Ticket</a>
                    </div>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center gap-6">
                    <!-- Search Icon/Bar (Compact) -->
                    <form action="{{ route('search') }}" method="GET" class="hidden sm:block relative">
                        <input 
                            type="text" 
                            name="search"
                            placeholder="Cari konser..." 
                            class="showtix-input w-48 lg:w-64 px-4 py-2 text-sm rounded-full hover:shadow-[0_0_18px_rgba(0,71,255,0.32)]"
                        >
                        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </button>
                    </form>

                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="relative text-gray-300 hover:text-[#FF5C00] transition p-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" /></svg>
                        @if(session('cart_count', 0) > 0)
                            <span class="absolute -top-1 -right-1 bg-gradient-to-r from-[#0047FF] to-[#FF5C00] text-white rounded-full w-5 h-5 flex items-center justify-center text-[10px] font-bold shadow-lg animate-pulse">
                                {{ session('cart_count', 0) }}
                            </span>
                        @endif
                    </a>

                    <!-- User Menu / Login -->
                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-gray-300 hover:text-white transition focus:outline-none py-2">
                                <svg class="w-5 h-5 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <span class="hidden sm:inline font-semibold text-sm">{{ auth()->user()->name }}</span>
                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div class="absolute right-0 mt-0 w-48 bg-[#081224] border border-slate-800 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 py-2 z-50">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#0047FF] hover:text-white transition">
                                    <svg class="w-3.5 h-3.5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg> Profil
                                </a>
                                <a href="{{ route('history') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#0047FF] hover:text-white transition">
                                    <svg class="w-3.5 h-3.5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Riwayat Pembelian
                                </a>
                                <a href="{{ route('tickets') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#0047FF] hover:text-white transition">
                                    <svg class="w-3.5 h-3.5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg> Tiket Saya
                                </a>
                                <hr class="my-2 border-slate-800">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-red-500/10 transition">
                                        <svg class="w-3.5 h-3.5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-300 hover:text-white transition">Login</a>
                            <a href="{{ route('register') }}" class="showtix-button text-white text-xs font-semibold px-4 py-2 rounded-full">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <script>
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                nav.classList.add('bg-[#050816]/95', 'backdrop-blur-[20px]', 'border-white/10');
                nav.classList.remove('bg-[#050816]/80', 'border-white/5');
            } else {
                nav.classList.remove('bg-[#050816]/95', 'backdrop-blur-[20px]', 'border-white/10');
                nav.classList.add('bg-[#050816]/80', 'border-white/5');
            }
        });
    </script>

    <!-- Main Content -->
    <main class="min-h-screen">
        @section('content')@show
    </main>

    <!-- Footer -->
    <footer class="bg-[#050816]/90 text-gray-400 mt-16 border-t border-[#0047FF]/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Tentang -->
                <div>
                    <img src="{{ asset('images/showtix-logo.png') }}" alt="SHOWTIX" class="showtix-logo h-12 w-auto mb-4">
                    <p class="text-gray-400 text-sm">Platform pemesanan tiket konser terpercaya dengan berbagai pilihan event menarik.</p>
                    <div class="flex gap-3 mt-4">
                        <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-[#FF5C00] hover:text-white transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-[#FF5C00] hover:text-white transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-[#FF5C00] hover:text-white transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
                    </div>
                </div>

                <!-- Links Cepat -->
                <div>
                    <h4 class="font-semibold text-lg text-white mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-[#FF5C00] transition">Beranda</a></li>
                        <li><a href="#" class="hover:text-[#FF5C00] transition">Konser</a></li>
                        <li><a href="#" class="hover:text-[#FF5C00] transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-[#FF5C00] transition">Kontak</a></li>
                    </ul>
                </div>

                <!-- Bantuan -->
                <div>
                    <h4 class="font-semibold text-lg text-white mb-4">Bantuan</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-[#FF5C00] transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-[#FF5C00] transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-[#FF5C00] transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-[#FF5C00] transition">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="font-semibold text-lg text-white mb-4">Newsletter</h4>
                    <p class="text-gray-400 text-sm mb-4">Dapatkan update konser terbaru</p>
                    <form class="flex">
                        <input 
                            type="email" 
                            placeholder="Email Anda" 
                            class="flex-1 px-3 py-2 bg-gray-800 border border-gray-700 rounded-l-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:border-[#0047FF] text-sm"
                        >
                        <button class="btn-orange rounded-l-none text-sm px-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                        </button>
                    </form>
                </div>
            </div>

            <hr class="border-gray-800 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-center text-gray-500 text-sm gap-4">
                <p>&copy; 2026 SHOWTIX. All rights reserved.</p>
                <p>Made for Music Lovers</p>
            </div>
        </div>
    </footer>

    @stack('js')
</body>
</html>
