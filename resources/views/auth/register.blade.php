<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - SHOWTIX</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|poppins:600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-blue: #0047FF;
            --accent-orange: #FF5C00;
            --dark-bg: #050816;
        }
        body {
            background-color: var(--dark-bg);
            color: #F8FAFC;
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-[#050816] text-gray-100 flex flex-col min-h-screen justify-between selection:bg-[#0047FF] selection:text-white">
    <!-- Navigation Logo -->
    <nav class="bg-transparent border-b border-white/5 py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
            <a href="{{ route('home') }}" class="font-display font-extrabold text-3xl tracking-wider hover:opacity-90 transition">
                <span class="bg-gradient-to-r from-[#0047FF] to-[#FF5C00] bg-clip-text text-transparent">SHOWTIX</span>
            </a>
        </div>
    </nav>

    <!-- Register Container -->
    <div class="flex-1 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md space-y-6">
            <!-- Register Card -->
            <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-8 shadow-[0_20px_60px_rgba(0,71,255,0.15)] backdrop-blur-md">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="font-display font-extrabold text-3xl text-white mb-2">Daftar Akun</h1>
                    <p class="text-[#94A3B8] text-sm">Sudah punya akun? <a href="{{ route('login') }}" class="text-[#FF5C00] hover:underline font-semibold">Login di sini</a></p>
                </div>

                <!-- Social Sign Up -->
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <button class="border border-[#0047FF]/20 bg-[#0B1730]/60 hover:bg-[#0B1730] text-[#D1D5DB] font-semibold py-2.5 px-4 rounded-xl transition flex items-center justify-center gap-2 text-xs">
                        <svg class="w-4 h-4 text-red-400" viewBox="0 0 24 24" fill="currentColor"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                        Google
                    </button>
                    <button class="border border-[#0047FF]/20 bg-[#0B1730]/60 hover:bg-[#0B1730] text-[#D1D5DB] font-semibold py-2.5 px-4 rounded-xl transition flex items-center justify-center gap-2 text-xs">
                        <svg class="w-4 h-4 text-blue-400" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        Facebook
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative mb-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/5"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="px-3 bg-[#081224] text-[#94A3B8]">Atau mendaftar dengan email</span>
                    </div>
                </div>

                <!-- Register Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-xs font-semibold text-[#94A3B8] uppercase mb-2">Nama Lengkap</label>
                        <input 
                            type="text" 
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] focus:shadow-[0_0_10px_rgba(255,92,0,0.15)] text-sm transition"
                            placeholder="Nama lengkap Anda"
                            required
                        >
                        @error('name')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-semibold text-[#94A3B8] uppercase mb-2">Email</label>
                        <input 
                            type="email" 
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] focus:shadow-[0_0_10px_rgba(255,92,0,0.15)] text-sm transition"
                            placeholder="nama@email.com"
                            required
                        >
                        @error('email')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-xs font-semibold text-[#94A3B8] uppercase mb-2">Password</label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password"
                                name="password"
                                class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] focus:shadow-[0_0_10px_rgba(255,92,0,0.15)] text-sm transition"
                                placeholder="Minimal 8 karakter"
                                required
                            >
                            <button type="button" onclick="togglePassword('password', 'eyeOpen1', 'eyeClosed1')" class="absolute right-3.5 top-1/2 transform -translate-y-1/2 text-[#94A3B8] hover:text-white transition focus:outline-none">
                                <svg class="w-4 h-4" id="eyeOpen1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg class="w-4 h-4 hidden" id="eyeClosed1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-[#94A3B8] uppercase mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password_confirmation"
                                name="password_confirmation"
                                class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] focus:shadow-[0_0_10px_rgba(255,92,0,0.15)] text-sm transition"
                                placeholder="Ulangi password Anda"
                                required
                            >
                            <button type="button" onclick="togglePassword('password_confirmation', 'eyeOpen2', 'eyeClosed2')" class="absolute right-3.5 top-1/2 transform -translate-y-1/2 text-[#94A3B8] hover:text-white transition focus:outline-none">
                                <svg class="w-4 h-4" id="eyeOpen2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg class="w-4 h-4 hidden" id="eyeClosed2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Agree T&C -->
                    <label class="flex items-start gap-3 cursor-pointer pt-1">
                        <input type="checkbox" name="agree_terms" required class="accent-[#0047FF] rounded w-4 h-4 mt-0.5">
                        <span class="text-xs text-[#D1D5DB] leading-normal">
                            Saya setuju dengan <a href="#" class="text-[#FF5C00] hover:underline font-semibold">Syarat & Ketentuan</a> dan <a href="#" class="text-[#FF5C00] hover:underline font-semibold">Kebijakan Privasi</a> SHOWTIX.
                        </span>
                    </label>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3.5 mt-2 bg-gradient-to-r from-[#0047FF] to-[#FF5C00] hover:from-[#0B57FF] hover:to-[#FF6B00] text-white font-bold rounded-xl transition duration-300 shadow-[0_0_20px_rgba(255,92,0,0.2)] text-sm flex items-center justify-center gap-2 hover:shadow-[0_0_30px_rgba(255,92,0,0.4)]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Daftar Sekarang
                    </button>
                </form>
            </div>

            <!-- Trust Badges -->
            <div class="grid grid-cols-3 gap-4 text-center text-xs text-[#94A3B8]">
                <div class="bg-[#081224]/60 border border-[#0047FF]/10 rounded-2xl p-3 shadow-sm">
                    <svg class="w-5 h-5 mx-auto text-[#0047FF] mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <p class="font-bold text-white">100% Aman</p>
                </div>
                <div class="bg-[#081224]/60 border border-[#FF5C00]/10 rounded-2xl p-3 shadow-sm">
                    <svg class="w-5 h-5 mx-auto text-[#FF5C00] mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <p class="font-bold text-white">Instan</p>
                </div>
                <div class="bg-[#081224]/60 border border-emerald-500/10 rounded-2xl p-3 shadow-sm">
                    <svg class="w-5 h-5 mx-auto text-emerald-400 mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="font-bold text-white">Mudah</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Copyright Only -->
    <footer class="py-6 border-t border-white/5 text-center text-xs text-[#94A3B8]">
        <p>&copy; 2026 SHOWTIX. All rights reserved.</p>
    </footer>

    <script>
        function togglePassword(fieldId, openId, closedId) {
            const field = document.getElementById(fieldId);
            const eyeOpen = document.getElementById(openId);
            const eyeClosed = document.getElementById(closedId);
            
            if (field.type === 'password') {
                field.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                field.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
