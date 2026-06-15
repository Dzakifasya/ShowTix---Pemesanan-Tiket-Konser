@extends('layouts.app')

@section('title')
Checkout - ShowTix
@endsection

@section('content')
<div class="py-8 bg-background min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-primary-900 mb-8">Checkout</h1>

        @if($summary)
            <form id="checkoutForm" class="space-y-8">
                @csrf

                <!-- Order Summary -->
                <div class="bg-white rounded-2xl shadow-soft p-6">
                    <h2 class="text-xl font-bold text-primary-900 mb-4">Ringkasan Pesanan</h2>
                    <div class="space-y-3 pb-4 border-b border-gray-200">
                        @foreach($summary['items'] as $item)
                            <div class="flex justify-between">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $item['jumlah_tiket'] }}x {{ $item['kategori_nama'] }}</p>
                                    <p class="text-sm text-gray-600">{{ $item['konser_nama'] }}</p>
                                </div>
                                <p class="font-semibold text-gray-900">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between pt-4 text-lg font-bold text-primary-900">
                        <span>Total:</span>
                        <span>Rp {{ number_format($summary['total_price'], 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Customer Information Form -->
                <div class="bg-white rounded-2xl shadow-soft p-6">
                    <h2 class="text-xl font-bold text-primary-900 mb-6">Data Diri Pembeli</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div class="md:col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" name="nama_lengkap" required value="{{ old('nama_lengkap', Auth::user()->name) }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-secondary-900 focus:ring-2 focus:ring-secondary-900 focus:ring-opacity-20 @error('nama_lengkap') border-red-500 @enderror"
                                   placeholder="Nama lengkap Anda">
                            @error('nama_lengkap')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" required value="{{ old('email', Auth::user()->email) }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-secondary-900 focus:ring-2 focus:ring-secondary-900 focus:ring-opacity-20 @error('email') border-red-500 @enderror"
                                   placeholder="email@example.com">
                            @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Email Confirmation -->
                        <div class="md:col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Email *</label>
                            <input type="email" name="email_confirmation" required value="{{ old('email_confirmation') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-secondary-900 focus:ring-2 focus:ring-secondary-900 focus:ring-opacity-20 @error('email_confirmation') border-red-500 @enderror"
                                   placeholder="Konfirmasi email Anda">
                            @error('email_confirmation')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- WhatsApp Number -->
                        <div class="md:col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp *</label>
                            <input type="tel" name="no_whatsapp" required value="{{ old('no_whatsapp') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-secondary-900 focus:ring-2 focus:ring-secondary-900 focus:ring-opacity-20 @error('no_whatsapp') border-red-500 @enderror"
                                   placeholder="08xxxxxxxxx atau +628xxxxxxxxx">
                            @error('no_whatsapp')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Gender -->
                        <div class="md:col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin *</label>
                            <select name="jenis_kelamin" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-secondary-900 focus:ring-2 focus:ring-secondary-900 focus:ring-opacity-20 @error('jenis_kelamin') border-red-500 @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="laki-laki" {{ old('jenis_kelamin') === 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('jenis_kelamin') === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                <option value="other" {{ old('jenis_kelamin') === 'other' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis_kelamin')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Province -->
                        <div class="md:col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Provinsi *</label>
                            <select name="provinsi" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-secondary-900 focus:ring-2 focus:ring-secondary-900 focus:ring-opacity-20 @error('provinsi') border-red-500 @enderror">
                                <option value="">Pilih Provinsi</option>
                                @foreach($provinces as $key => $value)
                                    <option value="{{ $key }}" {{ old('provinsi') === $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('provinsi')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Birth Date -->
                        <div class="md:col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir *</label>
                            <input type="date" name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-secondary-900 focus:ring-2 focus:ring-secondary-900 focus:ring-opacity-20 @error('tanggal_lahir') border-red-500 @enderror">
                            @error('tanggal_lahir')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <input type="checkbox" name="agree_terms" required class="mt-1"
                                   {{ old('agree_terms') ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">
                                Saya telah membaca dan menyetujui 
                                <a href="#" class="text-secondary-900 hover:underline font-semibold">Syarat dan Ketentuan</a>
                                serta 
                                <a href="#" class="text-secondary-900 hover:underline font-semibold">Kebijakan Privasi</a>
                            </span>
                        </label>
                        @error('agree_terms')<p class="text-red-600 text-sm mt-2">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex space-x-4">
                    <a href="{{ route('home') }}" class="flex-1 px-6 py-4 border-2 border-primary-900 text-primary-900 rounded-lg hover:bg-gray-50 transition-colors font-semibold text-center">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 px-6 py-4 bg-secondary-900 text-white rounded-lg hover:bg-secondary-800 transition-colors font-semibold">
                        Lanjut ke Pembayaran
                    </button>
                </div>
            </form>
        @else
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                <p class="text-yellow-800 font-semibold mb-4">Keranjang Anda kosong</p>
                <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-secondary-900 text-white rounded-lg hover:bg-secondary-800 transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>
</div>

<script>
document.getElementById('checkoutForm')?.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);

    try {
        const response = await fetch('{{ route("checkout.process") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            window.location.href = result.redirect_url;
        } else {
            alert('Error: ' + result.message);
        }
    } catch (err) {
        alert('Terjadi kesalahan: ' + err.message);
    }
});
</script>
@endsection
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Checkout Form -->
        <div class="lg:col-span-2">
            <h1 class="font-display font-bold text-3xl text-gray-800 mb-8">Masukkan Data Pribadi</h1>

            <form id="checkoutForm" method="POST" action="{{ route('checkout.process') }}" class="space-y-8">
                @csrf

                <!-- Personal Information -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-[#003D82]">
                    <h2 class="font-bold text-xl text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-user-circle text-[#003D82]"></i>
                        Informasi Pemesan
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Full Name -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap *</label>
                            <input 
                                type="text" 
                                name="nama_lengkap" 
                                value="{{ old('nama_lengkap', auth()->user()->name) }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20 @error('nama_lengkap') border-red-500 @enderror"
                                required
                            >
                            @error('nama_lengkap')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                            <input 
                                type="email" 
                                name="email" 
                                value="{{ old('email', auth()->user()->email) }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20 @error('email') border-red-500 @enderror"
                                required
                            >
                            @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Email Confirmation -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Email *</label>
                            <input 
                                type="email" 
                                name="email_confirmation" 
                                value="{{ old('email_confirmation') }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20 @error('email_confirmation') border-red-500 @enderror"
                                required
                            >
                            @error('email_confirmation')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- WhatsApp Number -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">No. WhatsApp *</label>
                            <input 
                                type="tel" 
                                name="no_whatsapp" 
                                placeholder="08xxxxxxxxxx"
                                value="{{ old('no_whatsapp') }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20 @error('no_whatsapp') border-red-500 @enderror"
                                required
                            >
                            @error('no_whatsapp')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin *</label>
                            <select 
                                name="jenis_kelamin" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20 @error('jenis_kelamin') border-red-500 @enderror"
                                required
                            >
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="laki-laki" {{ old('jenis_kelamin') === 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('jenis_kelamin') === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                <option value="other" {{ old('jenis_kelamin') === 'other' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis_kelamin')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Province -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Provinsi *</label>
                            <select 
                                name="provinsi" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20 @error('provinsi') border-red-500 @enderror"
                                required
                            >
                                <option value="">Pilih Provinsi</option>
                                @foreach($provinces ?? [] as $key => $value)
                                    <option value="{{ $key }}" {{ old('provinsi') === $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('provinsi')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Birth Date -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir *</label>
                            <input 
                                type="date" 
                                name="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20 @error('tanggal_lahir') border-red-500 @enderror"
                                required
                            >
                            @error('tanggal_lahir')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                    <label class="flex items-start space-x-3 cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="agree_terms" 
                            value="on"
                            {{ old('agree_terms') ? 'checked' : '' }}
                            required
                            class="mt-1"
                        >
                        <span class="text-sm text-gray-700">
                            Saya telah membaca dan menyetujui 
                            <a href="#" class="text-[#003D82] hover:underline font-semibold">Syarat dan Ketentuan</a>
                            serta 
                            <a href="#" class="text-[#003D82] hover:underline font-semibold">Kebijakan Privasi</a>
                        </span>
                    </label>
                    @error('agree_terms')<p class="text-red-600 text-sm mt-2">{{ $message }}</p>@enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex gap-4">
                    <a href="{{ route('cart.index') }}" class="flex-1 px-6 py-4 border-2 border-[#003D82] text-[#003D82] rounded-lg hover:bg-gray-50 transition-colors font-semibold text-center">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Keranjang
                    </a>
                    <button type="submit" class="flex-1 px-6 py-4 bg-[#FF6600] text-white rounded-lg hover:bg-orange-600 transition-colors font-semibold">
                        <i class="fas fa-arrow-right mr-2"></i> Lanjut ke Pembayaran
                    </button>
                </div>
            </form>
        </div>

        <!-- Order Summary Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-xl p-6 sticky top-32 border-2 border-[#FF6600]">
                <h2 class="font-display font-bold text-2xl text-gray-800 mb-6">Ringkasan Pesanan</h2>

                <div class="space-y-4 mb-6 pb-6 border-b-2 border-gray-200">
                    @php
                        $total = 0;
                    @endphp

                    @foreach($cartItems ?? [] as $item)
                        @php
                            $subtotal = $item['harga_satuan'] * $item['jumlah_tiket'];
                            $total += $subtotal;
                        @endphp
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-700">
                                <strong>{{ $item['konser_nama'] }}</strong><br>
                                <span class="text-xs text-gray-500">{{ $item['kategori_nama'] }} × {{ $item['jumlah_tiket'] }}</span>
                            </span>
                            <span class="font-semibold text-gray-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Cost Breakdown -->
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-gray-700 text-sm">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700 text-sm">
                        <span>Biaya Layanan</span>
                        @php $serviceFee = 3000; @endphp
                        <span>Rp {{ number_format($serviceFee, 0, ',', '.') }}</span>
                    </div>

                    <div class="border-t-2 border-gray-200 pt-3 flex justify-between font-bold text-lg">
                        <span>Total</span>
                        @php $grandTotal = $total + $serviceFee; @endphp
                        <span class="text-[#FF6600]">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Payment Guarantee -->
                <div class="space-y-2 text-xs text-gray-600 bg-blue-50 p-3 rounded-lg">
                    <p class="flex items-start gap-2"><i class="fas fa-shield-alt text-[#003D82] flex-shrink-0 mt-0.5"></i> Pembayaran 100% aman</p>
                    <p class="flex items-start gap-2"><i class="fas fa-clock text-[#003D82] flex-shrink-0 mt-0.5"></i> Berlaku 15 menit</p>
                    <p class="flex items-start gap-2"><i class="fas fa-check-circle text-[#003D82] flex-shrink-0 mt-0.5"></i> Data terverifikasi</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
