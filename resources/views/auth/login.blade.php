<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - ShowTix</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|poppins:600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-blue: #003D82;
            --primary-orange: #FF6600;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        .font-display {
            font-family: 'Poppins', sans-serif;
        }

        .btn-primary {
            @apply bg-gradient-to-r from-[#003D82] to-[#0052a3] text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300;
        }

        .btn-orange {
            @apply bg-gradient-to-r from-[#FF6600] to-[#ff8533] text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2 font-display font-bold text-2xl">
                    <div class="flex gap-1">
                        <span class="bg-gradient-to-r from-[#003D82] to-[#0052a3] text-white px-2 py-1 rounded-md">Show</span>
                        <span class="bg-gradient-to-r from-[#FF6600] to-[#ff8533] text-white px-2 py-1 rounded-md">Tix</span>
                    </div>
                </a>
            </div>
        </div>
    </nav>

    <!-- Login Container -->
    <div class="min-h-[calc(100vh-64px)] flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div class="w-full max-w-md">
            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="font-display font-bold text-3xl text-gray-800 mb-2">Masuk ke ShowTix</h1>
                    <p class="text-gray-600">Belum punya akun? <a href="{{ route('register') }}" class="text-[#003D82] hover:underline font-semibold">Daftar di sini</a></p>
                </div>

                <!-- Social Login -->
                <div class="space-y-3 mb-8">
                    <button class="w-full border-2 border-gray-300 hover:border-[#003D82] hover:bg-blue-50 text-gray-800 font-semibold py-2 px-4 rounded-lg transition flex items-center justify-center gap-2">
                        <i class="fab fa-google"></i> Login dengan Google
                    </button>
                    <button class="w-full border-2 border-gray-300 hover:border-[#003D82] hover:bg-blue-50 text-gray-800 font-semibold py-2 px-4 rounded-lg transition flex items-center justify-center gap-2">
                        <i class="fab fa-facebook"></i> Login dengan Facebook
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative mb-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t-2 border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-600">Atau dengan email</span>
                    </div>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input 
                            type="email" 
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20 transition"
                            placeholder="nama@email.com"
                            required
                        >
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password"
                                name="password"
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20 transition"
                                placeholder="Masukkan password Anda"
                                required
                            >
                            <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember & Forgot Password -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4">
                            <span class="text-gray-700">Ingat saya</span>
                        </label>
                        <a href="#" class="text-[#003D82] hover:underline font-semibold">Lupa password?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full btn-primary text-white font-bold py-3 rounded-lg transition-all duration-300">
                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                    </button>
                </form>

                <!-- Terms -->
                <p class="text-xs text-gray-600 text-center mt-6">
                    Dengan masuk, Anda setuju dengan <a href="#" class="text-[#003D82] hover:underline">Syarat & Ketentuan</a> 
                    dan <a href="#" class="text-[#003D82] hover:underline">Kebijakan Privasi</a>
                </p>
            </div>

            <!-- Trust Badges -->
            <div class="grid grid-cols-3 gap-4 text-center text-sm">
                <div class="bg-white rounded-lg p-3 shadow-md">
                    <i class="fas fa-lock text-[#003D82] text-2xl mb-2"></i>
                    <p class="text-gray-700 font-semibold">Aman</p>
                </div>
                <div class="bg-white rounded-lg p-3 shadow-md">
                    <i class="fas fa-bolt text-[#FF6600] text-2xl mb-2"></i>
                    <p class="text-gray-700 font-semibold">Cepat</p>
                </div>
                <div class="bg-white rounded-lg p-3 shadow-md">
                    <i class="fas fa-check text-green-500 text-2xl mb-2"></i>
                    <p class="text-gray-700 font-semibold">Mudah</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (password.type === 'password') {
                password.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
