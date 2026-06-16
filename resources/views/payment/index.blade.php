@extends('layouts.app')

@section('title', 'Petunjuk Pembayaran - SHOWTIX')

@section('content')
<!-- Progress Bar -->
<div class="bg-[#081224]/60 border-b border-white/5 sticky top-[72px] z-40 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center justify-between text-xs sm:text-sm">
            <div class="flex items-center gap-2 text-[#0047FF]">
                <div class="w-6 h-6 rounded-full bg-[#0B1730] text-[#0047FF] border border-[#0047FF]/30 flex items-center justify-center font-bold text-xs">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span>Keranjang</span>
            </div>
            <div class="w-12 h-0.5 bg-[#0047FF]/20"></div>
            <div class="flex items-center gap-2 text-[#0047FF]">
                <div class="w-6 h-6 rounded-full bg-[#0B1730] text-[#0047FF] border border-[#0047FF]/30 flex items-center justify-center font-bold text-xs">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span>Data Pembeli</span>
            </div>
            <div class="w-12 h-0.5 bg-[#0047FF]/20"></div>
            <div class="flex items-center gap-2 text-[#FF5C00] font-bold">
                <div class="w-6 h-6 rounded-full bg-gradient-to-r from-[#0047FF] to-[#FF5C00] text-white flex items-center justify-center font-bold text-xs">3</div>
                <span>Pembayaran</span>
            </div>
        </div>
    </div>
</div>

<div class="py-12 bg-[#050816] min-h-[85vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Column: Payment Info & Instructions -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Status Pembayaran Card -->
                @php
                    $method = $transaksi->pembayaran?->metode_pembayaran ?? 'bca_va';
                    $totalBayar = $transaksi->total_harga + ($transaksi->pembayaran?->biaya_layanan ?? 3000);
                    $paymentCodeVal = $transaksi->pembayaran?->kode_pembayaran ?? '12345678901';
                @endphp
                <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 sm:p-8 shadow-[0_15px_40px_rgba(0,71,255,0.05)] backdrop-blur-md space-y-6">
                    <h2 class="text-xl font-bold text-white flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Status Pembayaran
                    </h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                        <div>
                            <p class="text-[#94A3B8] text-xs font-semibold uppercase tracking-wider mb-1">Kode Transaksi</p>
                            <p class="font-mono font-extrabold text-white text-base">{{ $transaksi->kode_transaksi }}</p>
                        </div>
                        <div>
                            <p class="text-[#94A3B8] text-xs font-semibold uppercase tracking-wider mb-1">Metode Pembayaran</p>
                            @php
                                $methodLabel = 'Transfer Bank';
                                switch($method) {
                                    case 'bca_va': $methodLabel = 'BCA Virtual Account'; break;
                                    case 'mandiri_va': $methodLabel = 'Mandiri Virtual Account'; break;
                                    case 'bni_va': $methodLabel = 'BNI Virtual Account'; break;
                                    case 'bri_va': $methodLabel = 'BRI Virtual Account'; break;
                                    case 'qris': $methodLabel = 'QRIS'; break;
                                }
                            @endphp
                            <p class="font-bold text-gray-200 text-base">{{ $methodLabel }}</p>
                        </div>
                        <div>
                            <p class="text-[#94A3B8] text-xs font-semibold uppercase tracking-wider mb-1">Status</p>
                            <div id="statusBadgeContainer">
                                @if($transaksi->status_transaksi === 'Dibatalkan')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold uppercase bg-rose-500/10 text-rose-400 border border-rose-500/20">🔴 Transaksi Dibatalkan</span>
                                @elseif($transaksi->status_transaksi === 'Berhasil' || $transaksi->status_transaksi === 'completed')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold uppercase bg-[#0047FF]/10 text-[#0047FF] border border-[#0047FF]/20">🟢 Pembayaran Berhasil</span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold uppercase bg-[#FF5C00]/10 text-[#FF5C00] border border-[#FF5C00]/20">🟡 Pending Pembayaran</span>
                                @endif
                            </div>
                        </div>
                        
                        @php
                            $months = [
                                1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            $tgl = $transaksi->tanggal_transaksi;
                            $tglFormat = $tgl->format('d') . ' ' . $months[(int)$tgl->format('m')] . ' ' . $tgl->format('Y');
                            $waktuFormat = $tgl->format('H:i') . ' WIB';
                            
                            $exp = $transaksi->expired_at;
                            $expTime = $exp ? $exp->format('H:i') . ' WIB' : '-';
                        @endphp
                        
                        <div>
                            <p class="text-[#94A3B8] text-xs font-semibold uppercase tracking-wider mb-1">Tanggal</p>
                            <p class="font-bold text-gray-200 text-base">{{ $tglFormat }}</p>
                        </div>
                        
                        <div>
                            <p class="text-[#94A3B8] text-xs font-semibold uppercase tracking-wider mb-1">Jam</p>
                            <p class="font-bold text-gray-200 text-base">{{ $waktuFormat }}</p>
                        </div>
                        
                        <div>
                            <p class="text-[#94A3B8] text-xs font-semibold uppercase tracking-wider mb-1">Batas Pembayaran</p>
                            <p class="font-bold text-rose-400 text-base">{{ $expTime }}</p>
                        </div>

                        <div>
                            <p class="text-[#94A3B8] text-xs font-semibold uppercase tracking-wider mb-1">Sisa Waktu</p>
                            <p class="font-mono font-extrabold text-[#FF5C00] text-lg" id="timerCardText">
                                @if($transaksi->status_transaksi === 'Dibatalkan')
                                    Expired
                                @elseif(in_array($transaksi->status_transaksi, ['Berhasil', 'completed']))
                                    Lunas
                                @else
                                    15:00
                                @endif
                            </p>
                        </div>

                        <div class="sm:col-span-2 border-t border-white/5 pt-4 flex items-center justify-end">
                            <button type="button" id="payBtn" onclick="payNow()" 
                                    @if(in_array($transaksi->status_transaksi, ['Dibatalkan', 'Berhasil', 'completed'])) disabled style="display:none;" @endif
                                    class="px-6 py-3 bg-gradient-to-r from-[#0047FF] to-[#FF5C00] hover:from-[#0B57FF] hover:to-[#FF6B00] text-white font-bold rounded-xl text-sm transition-all duration-300 transform hover:scale-[1.02] flex items-center gap-2 shadow-[0_0_20px_rgba(255,92,0,0.3)]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg> 
                                Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Cara Pembayaran Section -->
                <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 sm:p-8 shadow-[0_15px_40px_rgba(0,71,255,0.05)] backdrop-blur-md">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Cara Pembayaran
                    </h2>

                    <div class="space-y-6 @if($transaksi->status_transaksi === 'Dibatalkan') opacity-50 pointer-events-none @endif" id="paymentMethodsContainer">
                        @if(str_contains($method, 'va'))
                            <!-- Virtual Account Instructions -->
                            <div class="bg-[#0B1730]/60 border border-white/5 rounded-2xl p-6 space-y-6">
                                <div class="flex justify-between items-center pb-4 border-b border-white/5">
                                    <div>
                                        <p class="text-xs text-[#94A3B8] uppercase font-semibold">Virtual Account</p>
                                        <p class="text-base font-bold text-white uppercase">{{ str_replace('_va', '', $method) }} VA</p>
                                    </div>
                                    <svg class="w-8 h-8 text-[#94A3B8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>

                                <div class="bg-[#050816] p-4 rounded-xl border border-white/5 space-y-2">
                                    <p class="text-xs text-[#94A3B8]">Nomor Rekening Virtual Account:</p>
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="font-mono font-extrabold text-2xl text-white tracking-wider" id="vaNumber">{{ $paymentCodeVal }}</p>
                                        <button onclick="copyToClipboard('vaNumber')" class="px-3 py-1.5 bg-[#FF5C00]/20 hover:bg-[#FF5C00] text-white border border-[#FF5C00]/30 rounded-lg text-xs font-bold transition">
                                            Salin
                                        </button>
                                    </div>
                                    <p class="text-[10px] text-[#94A3B8]/60">Atas Nama: PT ShowTix Indonesia</p>
                                </div>

                                <div class="bg-[#050816]/40 rounded-xl p-4 border border-white/5 space-y-3">
                                    <h4 class="text-xs font-bold text-[#D1D5DB] uppercase tracking-wider">Langkah Transfer:</h4>
                                    <ol class="text-xs text-[#94A3B8] space-y-2 list-decimal pl-4">
                                        <li>Buka aplikasi Mobile Banking atau kunjungi ATM terdekat.</li>
                                        <li>Pilih menu <strong class="text-white">Transfer</strong> &gt; <strong class="text-white">Virtual Account</strong>.</li>
                                        <li>Masukkan nomor Virtual Account <span class="font-bold text-white">{{ $paymentCodeVal }}</span>.</li>
                                        <li>Pastikan nominal transfer tepat sebesar <strong class="text-[#FF5C00] font-bold">Rp {{ number_format($totalBayar, 0, ',', '.') }}</strong>.</li>
                                        <li>Selesaikan transaksi dan simpan struk pembayaran.</li>
                                    </ol>
                                </div>
                            </div>
                        @elseif($method === 'qris')
                            <!-- QRIS Instructions -->
                            <div class="bg-[#0B1730]/60 border border-white/5 rounded-2xl p-6 text-center space-y-6">
                                <div>
                                    <p class="text-xs text-[#94A3B8] uppercase font-semibold">Scan QRIS</p>
                                    <p class="text-base font-bold text-white">QR Code Indonesia Standar</p>
                                </div>

                                <div class="bg-white p-6 w-52 h-52 mx-auto rounded-2xl flex items-center justify-center shadow-lg border border-white/10">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=STX-PAYMENT-{{ $transaksi->kode_transaksi }}" alt="QRIS Code" class="w-full h-full object-contain">
                                </div>

                                <div class="max-w-xs mx-auto">
                                    <p class="text-xs text-[#94A3B8]">Scan QR Code di atas menggunakan aplikasi E-Wallet (OVO, Dana, GoPay, LinkAja) atau Mobile Banking Anda.</p>
                                </div>
                            </div>
                        @else
                            <!-- Generic Instructions -->
                            <div class="bg-[#0B1730]/60 border border-white/5 rounded-2xl p-6 space-y-6">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-bold text-white">Metode: {{ strtoupper($method) }}</h3>
                                    <svg class="w-6 h-6 text-[#94A3B8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                                <div class="bg-[#050816] p-4 rounded-xl border border-white/5 space-y-2">
                                    <p class="text-xs text-[#94A3B8]">Kode Pembayaran:</p>
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="font-mono font-extrabold text-2xl text-white tracking-wider" id="genericCode">{{ $paymentCodeVal }}</p>
                                        <button onclick="copyToClipboard('genericCode')" class="px-3 py-1.5 bg-[#FF5C00]/20 hover:bg-[#FF5C00] text-white border border-[#FF5C00]/30 rounded-lg text-xs font-bold transition">
                                            Salin
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Timer & Order Summary -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Countdown Timer Card -->
                <div id="timerCardContainer" class="backdrop-blur-md rounded-3xl p-6 shadow-xl border text-center transition-all duration-300 flex flex-col items-center justify-center
                    @if($transaksi->status_transaksi === 'Dibatalkan')
                        bg-rose-500/10 border-rose-500/20 text-rose-400
                    @elseif(in_array($transaksi->status_transaksi, ['Berhasil', 'completed']))
                        bg-emerald-500/10 border-emerald-500/20 text-emerald-400
                    @else
                        bg-[#081224]/80 border-[#0047FF]/20 text-[#D1D5DB]
                    @endif">
                    
                    @if($transaksi->status_transaksi === 'Dibatalkan')
                        <!-- Expired State -->
                        <div class="space-y-4">
                            <div class="text-4xl">❌</div>
                            <h3 class="text-lg font-bold text-white">Waktu Pembayaran Habis</h3>
                            <p class="text-xs text-[#94A3B8] leading-relaxed">
                                Transaksi Anda telah dibatalkan secara otomatis. Silakan lakukan pemesanan kembali.
                            </p>
                            <div class="space-y-2 pt-2 w-full">
                                <a href="{{ route('home') }}" class="block w-full py-2.5 bg-white/5 border border-white/10 hover:bg-white/10 text-white rounded-xl text-xs font-bold transition">
                                    Kembali ke Beranda
                                </a>
                                <a href="{{ route('home') }}" class="block w-full py-2.5 bg-gradient-to-r from-[#0047FF] to-[#FF5C00] text-white rounded-xl text-xs font-bold transition">
                                    Pesan Tiket Lagi
                                </a>
                            </div>
                        </div>
                    @elseif(in_array($transaksi->status_transaksi, ['Berhasil', 'completed']))
                        <!-- Success State -->
                        <div class="space-y-4">
                            <div class="text-4xl">✅</div>
                            <h3 class="text-lg font-bold text-white">Pembayaran Berhasil</h3>
                            <p class="text-xs text-[#94A3B8] leading-relaxed">
                                Terima kasih telah melakukan pembayaran.
                            </p>
                            <div class="bg-[#0047FF]/10 p-2.5 rounded-xl border border-[#0047FF]/20 text-xs font-extrabold uppercase text-[#0047FF]">
                                Status: Lunas
                            </div>
                        </div>
                    @else
                        <!-- Active Pending State -->
                        <div class="space-y-4 w-full flex flex-col items-center" id="activeTimerBlock">
                            <p class="text-xs text-[#94A3B8] font-bold uppercase tracking-wider">Batas Waktu Transaksi</p>
                            
                            <!-- Circular countdown display -->
                            <div class="relative w-36 h-36 flex items-center justify-center rounded-full border-4 border-[#0047FF] shadow-[0_0_20px_rgba(0,71,255,0.2)] bg-[#050816]">
                                <span class="text-3xl font-mono font-extrabold text-[#FF5C00]" id="timerSidebar">15:00</span>
                            </div>

                            <p class="text-[10px] text-[#94A3B8] leading-normal">
                                Pesanan ini akan hangus secara otomatis jika pembayaran tidak terdeteksi dalam jangka waktu tersebut.
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Order Summary Breakdown -->
                <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 sm:p-8 shadow-[0_15px_40px_rgba(0,71,255,0.05)] backdrop-blur-md space-y-6">
                    <h3 class="text-sm font-bold text-[#94A3B8] uppercase tracking-widest pb-3 border-b border-white/5">Detail Pembayaran</h3>
                    
                    <div class="space-y-4">
                        @foreach($transaksi->pemesanan as $pemesanan)
                            <div class="space-y-1">
                                <p class="font-bold text-white text-sm line-clamp-2">{{ $pemesanan->kategoriTiket->konser->nama_konser }}</p>
                                <p class="text-xs text-[#0047FF] font-semibold">Kategori: {{ $pemesanan->kategoriTiket->nama_kategori }} × {{ $pemesanan->jumlah_tiket }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-3 text-xs text-[#94A3B8] border-t border-white/5 pt-4">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span class="font-bold text-white text-sm">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Layanan:</span>
                            <span class="font-bold text-white text-sm">Rp {{ number_format($transaksi->pembayaran?->biaya_layanan ?? 3000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between pt-3 border-t border-white/5 text-sm font-extrabold text-white">
                            <span>Total Tagihan:</span>
                            <span class="text-lg text-[#FF5C00] font-extrabold">Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Customer Support -->
                    <div class="pt-4 border-t border-white/5 text-center">
                        <p class="text-xs text-[#94A3B8] flex items-center justify-center gap-1.5 mb-3">
                            <svg class="w-3.5 h-3.5 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Mengalami kendala pembayaran?
                        </p>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="https://wa.me/6281234567890" target="_blank" class="py-2.5 bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 border border-emerald-500/20 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5">
                                WhatsApp
                            </a>
                            <a href="mailto:support@showtix.com" class="py-2.5 bg-[#0047FF]/10 hover:bg-[#0047FF]/20 text-[#0047FF] border border-[#0047FF]/20 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5">
                                Email
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Expiry seconds calculation
let expirySeconds = {{ $expirySeconds }};
let timerInterval = null;
let statusInterval = null;
const transaksiId = "{{ $transaksi->id }}";
const statusUrl = "{{ route('payment.status', ['transaksi_id' => $transaksi->id]) }}";

function startTimer() {
    const timerSidebar = document.getElementById('timerSidebar');
    const timerCardText = document.getElementById('timerCardText');

    function update() {
        if (expirySeconds <= 0) {
            clearInterval(timerInterval);
            if (timerSidebar) timerSidebar.textContent = "00:00";
            if (timerCardText) timerCardText.textContent = "Expired";
            handleExpiration();
            return;
        }

        const minutes = Math.floor(expirySeconds / 60);
        const seconds = expirySeconds % 60;
        const formatted = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');

        if (timerSidebar) timerSidebar.textContent = formatted;
        if (timerCardText) timerCardText.textContent = formatted;

        expirySeconds--;
    }
    
    update();
    timerInterval = setInterval(update, 1000);
}

function handleExpiration() {
    // Call server to expire the transaction
    fetch(statusUrl)
        .then(response => response.json())
        .then(data => {
            showExpiredUI();
        })
        .catch(err => {
            showExpiredUI();
        });
}

function showExpiredUI() {
    // 1. Disable payBtn and hide it
    const payBtn = document.getElementById('payBtn');
    if (payBtn) {
        payBtn.setAttribute('disabled', 'true');
        payBtn.style.display = 'none';
    }

    // 2. Add opacity-50 and pointer-events-none to payment methods
    const container = document.getElementById('paymentMethodsContainer');
    if (container) {
        container.classList.add('opacity-50', 'pointer-events-none');
    }

    // 3. Update status badge to Dibatalkan
    const statusBadge = document.getElementById('statusBadgeContainer');
    if (statusBadge) {
        statusBadge.innerHTML = '<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold uppercase bg-rose-500/10 text-rose-400 border border-rose-500/20">🔴 Transaksi Dibatalkan</span>';
    }

    // 4. Update timer card to expired state
    const timerCard = document.getElementById('timerCardContainer');
    if (timerCard) {
        timerCard.className = "backdrop-blur-md rounded-3xl p-6 shadow-xl border text-center transition-all duration-300 bg-rose-500/10 border-rose-500/20 text-rose-400 flex flex-col items-center justify-center";
        timerCard.innerHTML = `
            <div class="space-y-4">
                <div class="text-4xl">❌</div>
                <h3 class="text-lg font-bold text-white">Waktu Pembayaran Habis</h3>
                <p class="text-xs text-[#94A3B8] leading-relaxed">
                    Transaksi Anda telah dibatalkan secara otomatis. Silakan lakukan pemesanan kembali.
                </p>
                <div class="space-y-2 pt-2 w-full">
                    <a href="{{ route('home') }}" class="block w-full py-2.5 bg-white/5 border border-white/10 hover:bg-white/10 text-white rounded-xl text-xs font-bold transition">
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('home') }}" class="block w-full py-2.5 bg-gradient-to-r from-[#0047FF] to-[#FF5C00] text-white rounded-xl text-xs font-bold transition">
                        Pesan Tiket Lagi
                    </a>
                </div>
            </div>
        `;
    }

    const timerCardText = document.getElementById('timerCardText');
    if (timerCardText) timerCardText.textContent = "Expired";
    
    // Stop intervals
    clearInterval(timerInterval);
    clearInterval(statusInterval);
}

function showSuccessUI() {
    // 1. Hide payBtn
    const payBtn = document.getElementById('payBtn');
    if (payBtn) payBtn.style.display = 'none';

    // 2. Update status badge to Berhasil
    const statusBadge = document.getElementById('statusBadgeContainer');
    if (statusBadge) {
        statusBadge.innerHTML = '<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold uppercase bg-[#0047FF]/10 text-[#0047FF] border border-[#0047FF]/20">🟢 Pembayaran Berhasil</span>';
    }

    // 3. Update timer card to success state
    const timerCard = document.getElementById('timerCardContainer');
    if (timerCard) {
        timerCard.className = "backdrop-blur-md rounded-3xl p-6 shadow-xl border text-center transition-all duration-300 bg-[#0047FF]/10 border-[#0047FF]/20 text-[#0047FF] flex flex-col items-center justify-center";
        timerCard.innerHTML = `
            <div class="space-y-4">
                <div class="text-4xl">✅</div>
                <h3 class="text-lg font-bold text-white">Pembayaran Berhasil</h3>
                <p class="text-xs text-[#94A3B8] leading-relaxed">
                    Terima kasih telah melakukan pembayaran.
                </p>
                <div class="bg-[#0047FF]/10 p-2.5 rounded-xl border border-[#0047FF]/20 text-xs font-extrabold uppercase">
                    Status: Lunas
                </div>
            </div>
        `;
    }

    const timerCardText = document.getElementById('timerCardText');
    if (timerCardText) timerCardText.textContent = "Lunas";

    clearInterval(timerInterval);
    clearInterval(statusInterval);

    // Redirect to success page after a short delay
    setTimeout(() => {
        window.location.href = "{{ route('payment.success', ['transaksi_id' => $transaksi->id]) }}";
    }, 2000);
}

// Function to check transaction status from server
function checkStatus() {
    fetch(statusUrl)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.status === 'Berhasil' || data.status === 'completed') {
                    showSuccessUI();
                } else if (data.status === 'Dibatalkan') {
                    showExpiredUI();
                }
            }
        })
        .catch(err => console.error('Status check error:', err));
}

// Function to process payment immediately
async function payNow() {
    const payBtn = document.getElementById('payBtn');
    if (!payBtn) return;
    
    const originalText = payBtn.innerHTML;
    payBtn.disabled = true;
    payBtn.innerHTML = '<svg class="w-4 h-4 animate-spin mr-2 inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...';

    try {
        const response = await fetch("{{ route('payment.pay') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                transaksi_id: transaksiId,
                metode_pembayaran: "{{ $method }}"
            })
        });

        const result = await response.json();
        if (result.success) {
            showSuccessUI();
        } else {
            payBtn.disabled = false;
            payBtn.innerHTML = originalText;
            alert('Gagal memproses pembayaran: ' + result.message);
        }
    } catch(err) {
        payBtn.disabled = false;
        payBtn.innerHTML = originalText;
        alert('Terjadi kesalahan koneksi: ' + err.message);
    }
}

function copyToClipboard(elementId) {
    const text = document.getElementById(elementId).innerText;
    navigator.clipboard.writeText(text).then(() => {
        alert('Disalin ke clipboard!');
    }).catch(err => {
        alert('Gagal menyalin text: ' + err);
    });
}

// Start timer and polling on load
document.addEventListener('DOMContentLoaded', () => {
    const status = "{{ $transaksi->status_transaksi }}";
    if (status === 'Dibatalkan') {
        showExpiredUI();
    } else if (status === 'Berhasil' || status === 'completed') {
        showSuccessUI();
    } else {
        startTimer();
        statusInterval = setInterval(checkStatus, 3000);
    }
});
</script>
@endsection
