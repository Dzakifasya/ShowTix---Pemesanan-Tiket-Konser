<!-- Navbar Component -->
<nav class="bg-white shadow-soft sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-900 to-secondary-900 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">ST</span>
                    </div>
                    <span class="text-xl font-bold text-primary-900">ShowTix</span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-secondary-900 transition-colors">Beranda</a>
                <a href="#" class="text-gray-700 hover:text-secondary-900 transition-colors">Event</a>
                <a href="#" class="text-gray-700 hover:text-secondary-900 transition-colors">Tentang</a>
                <a href="#" class="text-gray-700 hover:text-secondary-900 transition-colors">Kontak</a>
            </div>

            <!-- Right Menu -->
            <div class="flex items-center space-x-4">
                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    @if(session('cart_count', 0) > 0)
                        <span class="absolute -top-2 -right-2 bg-secondary-900 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            {{ session('cart_count', 0) }}
                        </span>
                    @endif
                </a>

                <!-- Auth Links -->
                @if(Auth::check())
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" 
                                 alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full">
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-primary-900 font-semibold hover:text-secondary-900 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-secondary-900 text-white rounded-lg hover:bg-secondary-800 transition-colors">Daftar</a>
                @endif
            </div>
        </div>
    </div>
</nav>
