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

            <form id="checkoutForm" method="POST" action="{{ route('payment') }}" class="space-y-8">
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
                                value="{{ auth()->user()->name }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20"
                                required
                            >
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                            <input 
                                type="email" 
                                name="email" 
                                value="{{ auth()->user()->email }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20"
                                required
                            >
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon *</label>
                            <input 
                                type="tel" 
                                name="no_hp" 
                                placeholder="08xxxxxxxxxx"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20"
                                required
                            >
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-[#FF6600]">
                    <h2 class="font-bold text-xl text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-[#FF6600]"></i>
                        Alamat Pengiriman
                    </h2>

                    <div class="space-y-4">
                        <!-- Address -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap *</label>
                            <textarea 
                                name="alamat" 
                                rows="3"
                                placeholder="Jl. Contoh No. 123, Kelurahan, Kecamatan, Kota, Provinsi"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20"
                                required
                            ></textarea>
                        </div>

                        <!-- Birth Date -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir *</label>
                            <input 
                                type="date" 
                                name="tanggal_lahir"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20"
                                required
                            >
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-[#003D82]">
                    <h2 class="font-bold text-xl text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-credit-card text-[#003D82]"></i>
                        Metode Pembayaran
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Bank Transfer -->
                        <label class="payment-option cursor-pointer">
                            <input type="radio" name="metode_pembayaran" value="bank_transfer" checked class="sr-only">
                            <div class="border-2 border-gray-300 rounded-lg p-4 hover:border-[#003D82] hover:bg-blue-50 transition">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-university text-2xl text-[#003D82]"></i>
                                    <div>
                                        <h3 class="font-bold text-gray-800">Transfer Bank</h3>
                                        <p class="text-xs text-gray-600">BCA, BRI, Mandiri, dll</p>
                                    </div>
                                </div>
                            </div>
                        </label>

                        <!-- E-Wallet -->
                        <label class="payment-option cursor-pointer">
                            <input type="radio" name="metode_pembayaran" value="e_wallet" class="sr-only">
                            <div class="border-2 border-gray-300 rounded-lg p-4 hover:border-[#003D82] hover:bg-blue-50 transition">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-wallet text-2xl text-[#FF6600]"></i>
                                    <div>
                                        <h3 class="font-bold text-gray-800">E-Wallet</h3>
                                        <p class="text-xs text-gray-600">GoPay, OVO, Dana</p>
                                    </div>
                                </div>
                            </div>
                        </label>

                        <!-- Credit Card -->
                        <label class="payment-option cursor-pointer">
                            <input type="radio" name="metode_pembayaran" value="credit_card" class="sr-only">
                            <div class="border-2 border-gray-300 rounded-lg p-4 hover:border-[#003D82] hover:bg-blue-50 transition">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-credit-card text-2xl text-[#003D82]"></i>
                                    <div>
                                        <h3 class="font-bold text-gray-800">Kartu Kredit</h3>
                                        <p class="text-xs text-gray-600">Visa, Mastercard</p>
                                    </div>
                                </div>
                            </div>
                        </label>

                        <!-- Installment -->
                        <label class="payment-option cursor-pointer">
                            <input type="radio" name="metode_pembayaran" value="cicilan" class="sr-only">
                            <div class="border-2 border-gray-300 rounded-lg p-4 hover:border-[#003D82] hover:bg-blue-50 transition">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-chart-line text-2xl text-[#FF6600]"></i>
                                    <div>
                                        <h3 class="font-bold text-gray-800">Cicilan 0%</h3>
                                        <p class="text-xs text-gray-600">Cicilan tanpa bunga</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg">
                    <div class="flex gap-3">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-xl flex-shrink-0 mt-1"></i>
                        <div class="text-sm text-gray-700">
                            <p class="font-semibold mb-2">Perhatian Penting</p>
                            <ul class="space-y-1 text-xs">
                                <li>✓ Tiket digital akan dikirim ke email Anda setelah pembayaran dikonfirmasi</li>
                                <li>✓ Harap masukkan data diri yang benar dan sesuai dengan identitas Anda</li>
                                <li>✓ Pembatalan tiket hanya dapat dilakukan 7 hari sebelum konser</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Terms Checkbox -->
                <label class="flex items-start gap-3 p-4 bg-white rounded-lg border border-gray-200">
                    <input type="checkbox" name="agree_terms" class="mt-1" required>
                    <span class="text-sm text-gray-700">
                        Saya telah membaca dan menyetujui <a href="#" class="text-[#003D82] hover:underline font-semibold">Syarat & Ketentuan</a>, 
                        <a href="#" class="text-[#003D82] hover:underline font-semibold">Kebijakan Privasi</a>, dan 
                        <a href="#" class="text-[#003D82] hover:underline font-semibold">Kebijakan Pembatalan</a> ShowTix
                    </span>
                </label>

                <!-- Submit Button -->
                <button type="submit" class="w-full btn-orange text-white font-bold py-4 rounded-lg text-lg transition-all duration-300">
                    <i class="fas fa-lock mr-2"></i> Lanjut ke Pembayaran
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-xl p-6 sticky top-32 border-2 border-[#FF6600]">
                <h2 class="font-display font-bold text-2xl text-gray-800 mb-6">Ringkasan Pesanan</h2>

                <div class="space-y-4 mb-6 pb-6 border-b-2 border-gray-200">
                    @php
                        $total = 0;
                    @endphp

                    @foreach(session('cart', []) as $item)
                        @php
                            $subtotal = $item['harga_satuan'] * $item['jumlah_tiket'];
                            $total += $subtotal;
                        @endphp
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-700">
                                {{ $item['konser_nama'] }} <br>
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
                        <span>Admin Fee (2.5%)</span>
                        @php $adminFee = $total * 0.025; @endphp
                        <span>Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700 text-sm">
                        <span>Biaya Layanan</span>
                        @php $serviceFee = 10000; @endphp
                        <span>Rp {{ number_format($serviceFee, 0, ',', '.') }}</span>
                    </div>

                    <div class="border-t-2 border-gray-200 pt-3 flex justify-between font-bold text-lg">
                        <span>Total</span>
                        @php $grandTotal = $total + $adminFee + $serviceFee; @endphp
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

@push('js')
<script>
    // Update payment option styles
    document.querySelectorAll('.payment-option input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.payment-option > div').forEach(div => {
                div.classList.remove('border-[#003D82]', 'bg-blue-50', 'border-2');
                div.classList.add('border-gray-300', 'border-2');
            });
            
            if (this.checked) {
                this.nextElementSibling.classList.add('border-[#003D82]', 'bg-blue-50');
                this.nextElementSibling.classList.remove('border-gray-300');
            }
        });
    });

    // Set initial state
    document.querySelector('.payment-option input[type="radio"]:checked').parentElement.querySelector('div').classList.add('border-[#003D82]', 'bg-blue-50');
</script>
@endpush
