@extends('layouts.app')

@section('title', 'Checkout - ShowTix')

@section('content')
<!-- Progress Bar -->
<div class="bg-white border-b sticky top-16 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#003D82] text-white font-bold">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="flex-1 h-1 mx-3 bg-[#003D82]"></div>
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#003D82] text-white font-bold">
                        2
                    </div>
                    <div class="flex-1 h-1 mx-3 bg-gray-300"></div>
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-300 text-gray-600 font-bold">
                        3
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between mt-3 text-xs">
            <span class="font-semibold text-[#003D82]">Keranjang</span>
            <span class="font-semibold text-[#003D82]">Data Pribadi</span>
            <span class="text-gray-500">Pembayaran</span>
        </div>
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
