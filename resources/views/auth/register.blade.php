<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - ShowTix</title>

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

    <!-- Register Container -->
    <div class="min-h-[calc(100vh-64px)] flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div class="w-full max-w-md">
            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="font-display font-bold text-3xl text-gray-800 mb-2">Daftar ShowTix</h1>
                    <p class="text-gray-600">Sudah punya akun? <a href="{{ route('login') }}" class="text-[#003D82] hover:underline font-semibold">Login di sini</a></p>
                </div>

                <!-- Social Register -->
                <div class="space-y-3 mb-8">
                    <button class="w-full border-2 border-gray-300 hover:border-[#003D82] hover:bg-blue-50 text-gray-800 font-semibold py-2 px-4 rounded-lg transition flex items-center justify-center gap-2">
                        <i class="fab fa-google"></i> Daftar dengan Google
                    </button>
                    <button class="w-full border-2 border-gray-300 hover:border-[#003D82] hover:bg-blue-50 text-gray-800 font-semibold py-2 px-4 rounded-lg transition flex items-center justify-center gap-2">
                        <i class="fab fa-facebook"></i> Daftar dengan Facebook
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

                <!-- Register Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input 
                            type="text" 
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20 transition"
                            placeholder="Nama lengkap Anda"
                            required
                        >
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

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
                                placeholder="Minimal 8 karakter"
                                required
                            >
                            <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition">
                                <i class="fas fa-eye" id="toggleIcon1"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password_confirmation"
                                name="password_confirmation"
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20 transition"
                                placeholder="Konfirmasi password Anda"
                                required
                            >
                            <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition">
                                <i class="fas fa-eye" id="toggleIcon2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Terms Checkbox -->
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="agree_terms" class="mt-1" required>
                        <span class="text-sm text-gray-700">
                            Saya setuju dengan <a href="#" class="text-[#003D82] hover:underline font-semibold">Syarat & Ketentuan</a> 
                            dan <a href="#" class="text-[#003D82] hover:underline font-semibold">Kebijakan Privasi</a>
                        </span>
                    </label>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full btn-primary text-white font-bold py-3 rounded-lg transition-all duration-300">
                        <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                    </button>
                </form>

                <!-- Info Box -->
                <div class="mt-6 p-4 bg-blue-50 rounded-lg border-l-4 border-[#003D82]">
                    <p class="text-xs text-gray-700">
                        <i class="fas fa-lightbulb text-[#003D82] mr-2"></i>
                        <strong>Tips:</strong> Gunakan email yang masih aktif untuk memudahkan verifikasi akun Anda.
                    </p>
                </div>
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
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const iconId = fieldId === 'password' ? 'toggleIcon1' : 'toggleIcon2';
            const icon = document.getElementById(iconId);
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
