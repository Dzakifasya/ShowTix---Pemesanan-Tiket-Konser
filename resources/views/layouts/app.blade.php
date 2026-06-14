<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ShowTix - Pemesanan Tiket Konser')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|poppins:600,700" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-blue: #003D82;
            --primary-orange: #FF6600;
            --dark-blue: #001f42;
            --light-blue: #0052a3;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        .font-display {
            font-family: 'Poppins', sans-serif;
        }

        .btn-primary {
            @apply bg-gradient-to-r from-[#003D82] to-[#0052a3] text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105;
        }

        .btn-outline-primary {
            @apply border-2 border-[#003D82] text-[#003D82] px-6 py-3 rounded-lg font-semibold hover:bg-[#003D82] hover:text-white transition-all duration-300;
        }

        .btn-orange {
            @apply bg-gradient-to-r from-[#FF6600] to-[#ff8533] text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105;
        }

        .badge-orange {
            @apply inline-block bg-[#FF6600] text-white px-3 py-1 rounded-full text-sm font-semibold;
        }

        .badge-blue {
            @apply inline-block bg-[#003D82] text-white px-3 py-1 rounded-full text-sm font-semibold;
        }

        .card-concert {
            @apply bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2;
        }

        .gradient-text {
            background: linear-gradient(135deg, #003D82 0%, #FF6600 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
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
<body class="bg-[#FAFAFA]">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 font-display font-bold text-2xl">
                        <div class="flex gap-1">
                            <span class="bg-gradient-to-r from-[#003D82] to-[#0052a3] text-white px-2 py-1 rounded-md">Show</span>
                            <span class="bg-gradient-to-r from-[#FF6600] to-[#ff8533] text-white px-2 py-1 rounded-md">Tix</span>
                        </div>
                    </a>
                </div>

                <!-- Search Bar (Hidden on Mobile) -->
                <div class="hidden md:flex flex-1 mx-8">
                    <div class="w-full relative">
                        <input 
                            type="text" 
                            placeholder="Cari konser favorit..." 
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20"
                        >
                        <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center gap-4">
                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-[#003D82] transition">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        @if(session('cart_count', 0) > 0)
                            <span class="absolute -top-2 -right-2 bg-[#FF6600] text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">
                                {{ session('cart_count', 0) }}
                            </span>
                        @endif
                    </a>

                    <!-- User Menu -->
                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-gray-700 hover:text-[#003D82] transition">
                                <i class="fas fa-user-circle text-2xl"></i>
                                <span class="hidden sm:inline font-semibold">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div class="absolute right-0 mt-0 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 py-2">
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-[#003D82] hover:text-white transition">
                                    <i class="fas fa-user mr-2"></i> Profil
                                </a>
                                <a href="{{ route('history') }}" class="block px-4 py-2 text-gray-700 hover:bg-[#003D82] hover:text-white transition">
                                    <i class="fas fa-history mr-2"></i> Riwayat Pembelian
                                </a>
                                <a href="{{ route('tickets') }}" class="block px-4 py-2 text-gray-700 hover:bg-[#003D82] hover:text-white transition">
                                    <i class="fas fa-ticket-alt mr-2"></i> Tiket Saya
                                </a>
                                <hr class="my-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-[#FF6600] hover:text-white transition">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary text-sm">Login</a>
                        <a href="{{ route('register') }}" class="btn-outline-primary text-sm">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Tentang -->
                <div>
                    <h3 class="font-display font-bold text-xl mb-4">
                        <span class="bg-gradient-to-r from-[#003D82] to-[#FF6600] text-transparent bg-clip-text">ShowTix</span>
                    </h3>
                    <p class="text-gray-400">Platform pemesanan tiket konser terpercaya dengan berbagai pilihan event menarik.</p>
                    <div class="flex gap-3 mt-4">
                        <a href="#" class="text-gray-400 hover:text-[#FF6600] transition"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-[#FF6600] transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-[#FF6600] transition"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Links Cepat -->
                <div>
                    <h4 class="font-semibold text-lg mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-[#FF6600] transition">Beranda</a></li>
                        <li><a href="#" class="hover:text-[#FF6600] transition">Konser</a></li>
                        <li><a href="#" class="hover:text-[#FF6600] transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-[#FF6600] transition">Kontak</a></li>
                    </ul>
                </div>

                <!-- Bantuan -->
                <div>
                    <h4 class="font-semibold text-lg mb-4">Bantuan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-[#FF6600] transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-[#FF6600] transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-[#FF6600] transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-[#FF6600] transition">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="font-semibold text-lg mb-4">Newsletter</h4>
                    <p class="text-gray-400 text-sm mb-4">Dapatkan update konser terbaru</p>
                    <form class="flex">
                        <input 
                            type="email" 
                            placeholder="Email Anda" 
                            class="flex-1 px-3 py-2 rounded-l-lg text-gray-800 focus:outline-none"
                        >
                        <button class="btn-orange rounded-l-none">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>

            <hr class="border-gray-700 mb-6">
            <div class="flex justify-between items-center text-gray-400 text-sm">
                <p>&copy; 2026 ShowTix. All rights reserved.</p>
                <p>Made with <span class="text-[#FF6600]">❤</span> for Music Lovers</p>
            </div>
        </div>
    </footer>

    @stack('js')
</body>
</html>
