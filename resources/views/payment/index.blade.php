@extends('layouts.app')

@section('title')
Pembayaran - ShowTix
@endsection

@section('content')
<!-- Progress Bar -->
<div class="bg-white border-b sticky top-16 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#003D82] text-white font-bold">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="flex-1 h-1 mx-3 bg-[#003D82]"></div>
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#003D82] text-white font-bold">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="flex-1 h-1 mx-3 bg-[#003D82]"></div>
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#003D82] text-white font-bold">
                        3
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between mt-3 text-xs">
            <span class="font-semibold text-[#003D82]">Keranjang</span>
            <span class="font-semibold text-[#003D82]">Data Pribadi</span>
            <span class="font-semibold text-[#003D82]">Pembayaran</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Payment Instructions -->
        <div class="lg:col-span-2">
            <!-- Status Card -->
            <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-xl shadow-lg p-8 mb-8 border-2 border-[#FF6600]">
                <div class="flex items-start gap-4">
                    <div class="bg-[#FF6600] text-white rounded-full w-16 h-16 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="font-display font-bold text-3xl text-gray-800 mb-2">Menunggu Pembayaran</h1>
                        <p class="text-gray-700 mb-3">Kode Pesanan: <span class="font-bold text-[#FF6600]">#TXN{{ str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT) }}</span></p>
                        <p class="text-sm text-gray-600">Selesaikan pembayaran dalam waktu <span class="font-bold text-red-600">15 menit</span> agar pesanan tidak dibatalkan</p>
                    </div>
                </div>
            </div>

            <!-- Payment Method Instructions -->
            <div class="bg-white rounded-xl shadow-md p-8 border-l-4 border-[#003D82] mb-8">
                <h2 class="font-display font-bold text-2xl text-gray-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-info-circle text-[#003D82]"></i>
                    Cara Pembayaran
                </h2>

                <!-- Bank Transfer -->
                <div class="space-y-8">
                    <!-- Bank Transfer Method -->
                    <div class="bg-blue-50 rounded-xl p-6 border-2 border-[#003D82]">
                        <h3 class="font-bold text-xl text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-university text-[#003D82]"></i>
                            Transfer Bank
                        </h3>

                        <div class="space-y-4">
                            <div class="bg-white p-4 rounded-lg">
                                <p class="text-sm text-gray-600 mb-2">Nomor Rekening:</p>
                                <div class="flex items-center gap-3">
                                    <p class="font-bold text-2xl text-gray-800">1234567890</p>
                                    <button onclick="copyToClipboard('1234567890')" class="bg-[#003D82] text-white px-3 py-2 rounded text-sm hover:bg-[#0052a3] transition">
                                        <i class="fas fa-copy mr-2"></i> Salin
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Atas Nama: PT ShowTix Indonesia</p>
                            </div>

                            <div class="bg-white p-4 rounded-lg">
                                <p class="text-sm text-gray-600 mb-2">Bank:</p>
                                <p class="font-bold text-gray-800">BCA (Bank Central Asia)</p>
                            </div>

                            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
                                <p class="text-sm text-gray-700">
                                    <strong>Instruksi:</strong><br>
                                    1. Buka aplikasi/website bank Anda<br>
                                    2. Pilih "Transfer" atau "Pembayaran"<br>
                                    3. Masukkan nomor rekening di atas<br>
                                    4. Masukkan jumlah Rp <span class="text-[#FF6600] font-bold" id="paymentAmount">-</span><br>
                                    5. Konfirmasi dan selesaikan transaksi<br>
                                    6. Tiket akan otomatis dikirim ke email Anda
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- E-Wallet Method -->
                    <div class="bg-orange-50 rounded-xl p-6 border-2 border-[#FF6600]">
                        <h3 class="font-bold text-xl text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-wallet text-[#FF6600]"></i>
                            E-Wallet (GoPay, OVO, Dana)
                        </h3>

                        <div class="space-y-4">
                            <div class="bg-white p-4 rounded-lg">
                                <p class="text-sm text-gray-600 mb-3">Pilih E-Wallet Anda:</p>
                                <div class="flex gap-3">
                                    <button class="flex-1 border-2 border-gray-300 hover:border-[#FF6600] rounded-lg p-3 font-semibold transition">
                                        <i class="fab fa-google text-2xl text-green-500 mb-2"></i><br>GoPay
                                    </button>
                                    <button class="flex-1 border-2 border-gray-300 hover:border-[#FF6600] rounded-lg p-3 font-semibold transition">
                                        <i class="fas fa-square text-2xl text-purple-500 mb-2"></i><br>OVO
                                    </button>
                                    <button class="flex-1 border-2 border-gray-300 hover:border-[#FF6600] rounded-lg p-3 font-semibold transition">
                                        <i class="fas fa-wallet text-2xl text-blue-500 mb-2"></i><br>Dana
                                    </button>
                                </div>
                            </div>

                            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
                                <p class="text-sm text-gray-700">
                                    <strong>Instruksi:</strong><br>
                                    1. Klik tombol E-Wallet pilihan Anda<br>
                                    2. Verifikasi nomor telepon<br>
                                    3. Masukkan PIN atau password<br>
                                    4. Pembayaran akan langsung diproses<br>
                                    5. Tiket akan dikirim ke email Anda
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- QR Code Payment -->
                    <div class="bg-white rounded-xl p-6 border-2 border-gray-300 text-center">
                        <h3 class="font-bold text-xl text-gray-800 mb-4">Bayar dengan QRIS</h3>
                        <p class="text-gray-600 mb-4">Scan QR code di bawah ini menggunakan aplikasi mobile banking atau e-wallet Anda</p>
                        <div class="bg-gray-200 w-64 h-64 mx-auto rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-qrcode text-6xl text-gray-400"></i>
                        </div>
                        <p class="text-xs text-gray-500">QR Code berlaku hingga 15 menit</p>
                    </div>
                </div>
            </div>

            <!-- Verification Section -->
            <div class="bg-white rounded-xl shadow-md p-8 border-l-4 border-green-500">
                <h2 class="font-display font-bold text-2xl text-gray-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-check-circle text-green-500"></i>
                    Verifikasi Manual Pembayaran
                </h2>

                <p class="text-gray-700 mb-4">Jika pembayaran Anda belum terdaftar dalam 5 menit, silakan verifikasi secara manual:</p>

                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu Transaksi</label>
                        <input 
                            type="datetime-local" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Referensi Bank</label>
                        <input 
                            type="text" 
                            placeholder="Contoh: BANK1234567890"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]"
                        >
                    </div>

                    <button type="submit" class="w-full btn-primary text-white font-bold py-3 rounded-lg">
                        <i class="fas fa-upload mr-2"></i> Verifikasi Pembayaran
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Summary & Timer -->
        <div class="lg:col-span-1">
            <!-- Timer -->
            <div class="bg-red-50 rounded-xl shadow-xl p-6 border-2 border-red-500 mb-6 sticky top-32">
                <h3 class="font-bold text-lg text-gray-800 mb-2">Sisa Waktu</h3>
                <div class="text-5xl font-display font-bold text-red-600 mb-2" id="timer">15:00</div>
                <p class="text-sm text-gray-700">Selesaikan pembayaran sebelum waktu habis</p>
                <div class="mt-4 bg-red-100 rounded-lg p-3">
                    <p class="text-xs text-red-800">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Pesanan akan dibatalkan otomatis jika waktu habis
                    </p>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-white rounded-xl shadow-xl p-6 border-2 border-[#003D82]">
                <h2 class="font-bold text-xl text-gray-800 mb-4">Ringkasan Pesanan</h2>

                <div class="space-y-3 mb-4 pb-4 border-b-2 border-gray-200">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-700">Konser Tiket</span>
                        <span class="font-semibold">2 Tiket</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-700">Harga Satuan</span>
                        <span class="font-semibold">Rp 250.000</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-700">Subtotal</span>
                        <span class="font-semibold">Rp 500.000</span>
                    </div>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-700">Admin Fee</span>
                        <span>Rp 12.500</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-700">Biaya Layanan</span>
                        <span>Rp 10.000</span>
                    </div>
                </div>

                <div class="border-t-2 border-gray-200 pt-3">
                    <div class="flex justify-between font-bold text-lg">
                        <span>Total Pembayaran</span>
                        <span class="text-[#FF6600]" id="totalPayment">Rp 522.500</span>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-[#003D82]">
                    <p class="text-sm font-semibold text-gray-800 mb-2 flex items-center gap-2">
                        <i class="fas fa-question-circle text-[#003D82]"></i>
                        Butuh Bantuan?
                    </p>
                    <p class="text-xs text-gray-700 mb-3">Hubungi customer support kami 24/7</p>
                    <div class="space-y-2 text-xs">
                        <a href="https://wa.me/6281234567890" class="block text-[#003D82] hover:underline">
                            <i class="fab fa-whatsapp mr-2"></i> WhatsApp Support
                        </a>
                        <a href="mailto:support@showtix.com" class="block text-[#003D82] hover:underline">
                            <i class="fas fa-envelope mr-2"></i> Email Support
                        </a>
                        <a href="tel:+6215555555" class="block text-[#003D82] hover:underline">
                            <i class="fas fa-phone mr-2"></i> Telepon: 1500-1234
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    // Timer countdown
    let timeRemaining = 15 * 60; // 15 minutes in seconds
    const timerElement = document.getElementById('timer');

    setInterval(() => {
        timeRemaining--;
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

        if (timeRemaining <= 0) {
            timerElement.closest('.bg-red-50').innerHTML = '<p class="text-red-600 font-bold">Waktu telah habis. Pesanan dibatalkan.</p>';
        }

        // Change color to orange when 5 minutes left
        if (timeRemaining === 5 * 60) {
            timerElement.closest('.bg-red-50').classList.remove('border-red-500');
            timerElement.closest('.bg-red-50').classList.add('border-orange-500');
        }
    }, 1000);

    // Copy to clipboard function
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Nomor rekening berhasil disalin!');
        });
    }

    // Payment verification form
    document.querySelector('form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Terima kasih! Pembayaran Anda sedang diverifikasi. Anda akan menerima konfirmasi melalui email.');
    });
</script>
@endpush
