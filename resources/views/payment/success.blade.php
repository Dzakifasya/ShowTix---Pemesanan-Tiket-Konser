@extends('layouts.app')

@section('title', 'Pembayaran Berhasil - SHOWTIX')

@section('content')
<div class="py-16 bg-[#050816] min-h-screen flex items-center justify-center">
    <div class="max-w-xl w-full px-4">
        <!-- Success Animation Wrapper -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-[#0047FF]/10 text-[#0047FF] border-2 border-[#0047FF]/30 mb-6 shadow-[0_0_30px_rgba(0,71,255,0.3),0_0_60px_rgba(255,92,0,0.15)] animate-bounce">
                <svg class="w-12 h-12 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="font-display font-extrabold text-3xl text-white tracking-tight mb-2">Pembayaran Berhasil!</h1>
            <p class="text-[#94A3B8] text-sm">Terima kasih, pembayaran tiket konser Anda telah lunas terverifikasi.</p>
        </div>

        <!-- Ticket Card Voucher (Premium Design) -->
        <div class="relative bg-[#081224]/90 border border-[#0047FF]/20 rounded-3xl overflow-hidden shadow-[0_20px_60px_rgba(0,71,255,0.2)] backdrop-blur-md mb-8">
            <!-- Blue top accent line -->
            <div class="h-1 w-full bg-gradient-to-r from-[#0047FF] via-[#1E63FF] to-[#FF5C00]"></div>

            <!-- Ticket Side Circles (Perforation Cutout Effect) -->
            <div class="absolute left-0 top-[62%] -translate-y-1/2 w-6 h-6 bg-[#050816] rounded-r-full z-10"></div>
            <div class="absolute right-0 top-[62%] -translate-y-1/2 w-6 h-6 bg-[#050816] rounded-l-full z-10"></div>
            
            <!-- Ticket Info Top -->
            <div class="p-6 sm:p-8 space-y-6">
                <!-- Concert Detail Header -->
                @php
                    $firstPemesanan = $transaksi->pemesanan->first();
                    $konser = $firstPemesanan?->kategoriTiket?->konser;
                    $ticketCount = $transaksi->pemesanan->sum('jumlah_tiket');
                    $kategoriName = $firstPemesanan?->kategoriTiket?->nama_kategori ?? 'Regular';
                    $paymentMethod = $transaksi->pembayaran?->metode_pembayaran ?? 'bca_va';
                    if (str_contains($paymentMethod, 'va')) {
                        $paymentIcon = '🏦';
                        $paymentLabel = strtoupper(str_replace('_va', '', $paymentMethod)) . ' Virtual Account';
                    } elseif ($paymentMethod === 'qris') {
                        $paymentIcon = '📱';
                        $paymentLabel = 'QRIS';
                    } else {
                        $paymentIcon = '💳';
                        $paymentLabel = 'E-wallet';
                    }
                    $tiketCodes = $transaksi->pemesanan->flatMap(function($p) {
                        return $p->tiket->pluck('kode_tiket');
                    })->implode(', ');
                @endphp
                <div class="flex items-start gap-4">
                    <div class="w-16 h-20 bg-[#0B1730] rounded-xl overflow-hidden flex-shrink-0 border border-[#0047FF]/20 shadow-[0_0_10px_rgba(0,71,255,0.1)]">
                        @if($konser && $konser->poster)
                            <img src="{{ asset('storage/' . $konser->poster) }}" alt="{{ $konser->nama_konser }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-[#94A3B8] p-2">
                                <svg class="w-7 h-7 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="space-y-1.5 flex-1">
                        <span class="px-2.5 py-0.5 rounded-full text-[9px] font-extrabold uppercase bg-[#0047FF]/10 text-[#0047FF] border border-[#0047FF]/20">LUNAS</span>
                        <h2 class="font-bold text-white text-base leading-snug line-clamp-1">{{ $konser->nama_konser ?? 'Konser Musik' }}</h2>
                        <p class="text-xs text-[#FF5C00] font-semibold">
                            @if($konser && $konser->artis)
                                {{ $konser->artis->pluck('nama_artis')->implode(', ') }}
                            @else
                                Artis Perform
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Detail Meta Grid -->
                <div class="grid grid-cols-2 gap-y-4 gap-x-6 text-xs border-t border-white/5 pt-5">
                    <div>
                        <p class="text-[#94A3B8]/60 uppercase font-semibold text-[9px] tracking-wider mb-1">Nama Pembeli</p>
                        <p class="font-bold text-[#D1D5DB]">{{ $transaksi->pembeli->nama_lengkap }}</p>
                    </div>
                    <div>
                        <p class="text-[#94A3B8]/60 uppercase font-semibold text-[9px] tracking-wider mb-1">Kategori Tiket</p>
                        <p class="font-bold text-[#FF5C00]">{{ $kategoriName }}</p>
                    </div>
                    <div>
                        <p class="text-[#94A3B8]/60 uppercase font-semibold text-[9px] tracking-wider mb-1">Tanggal Konser</p>
                        <p class="font-bold text-[#D1D5DB]">{{ $konser ? \Carbon\Carbon::parse($konser->tanggal_konser)->format('d M Y') : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[#94A3B8]/60 uppercase font-semibold text-[9px] tracking-wider mb-1">Jumlah Tiket</p>
                        <p class="font-bold text-[#D1D5DB]">{{ $ticketCount }} Tiket</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-[#94A3B8]/60 uppercase font-semibold text-[9px] tracking-wider mb-1">Kode Tiket</p>
                        <p class="font-mono font-bold text-[#D1D5DB] tracking-wider text-xs break-all">{{ $tiketCodes ?: '-' }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-[#94A3B8]/60 uppercase font-semibold text-[9px] tracking-wider mb-1">Lokasi Venue</p>
                        <p class="font-bold text-[#D1D5DB] truncate">{{ $konser->lokasi ?? '-' }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-[#94A3B8]/60 uppercase font-semibold text-[9px] tracking-wider mb-1">Metode Pembayaran</p>
                        <p class="font-bold text-[#D1D5DB]"><span class="text-[#FF5C00] mr-2">{{ $paymentIcon }}</span>{{ $paymentLabel }}</p>
                    </div>
                </div>
            </div>

            <!-- Perforation Dotted Line Separator -->
            <div class="border-t-2 border-dashed border-white/5 w-full relative z-0"></div>

            <!-- Ticket Info Bottom (Voucher Details) -->
            <div class="p-6 sm:p-8 bg-[#050816]/40 flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="space-y-1 text-center sm:text-left">
                    <p class="text-[#94A3B8]/60 uppercase font-semibold text-[9px] tracking-wider">Kode Transaksi</p>
                    <p class="font-mono font-extrabold text-lg text-white tracking-widest">{{ $transaksi->kode_transaksi }}</p>
                    <p class="text-[10px] text-[#94A3B8]">Total: <span class="text-[#FF5C00] font-bold">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span></p>
                </div>
                
                <!-- Ticket QR Code -->
                <div class="bg-white p-2.5 rounded-xl border border-[#0047FF]/30 shadow-[0_0_15px_rgba(0,71,255,0.2)]">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $transaksi->kode_transaksi }}" alt="Ticket QR" class="w-20 h-20">
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-3.5">
            <button onclick="downloadEkticket()" 
               class="w-full py-4 bg-gradient-to-r from-[#0047FF] to-[#FF5C00] hover:from-[#0B57FF] hover:to-[#FF6B00] text-white rounded-2xl font-extrabold text-sm text-center transition-all duration-300 shadow-[0_0_20px_rgba(255,92,0,0.3)] block hover:shadow-[0_0_30px_rgba(255,92,0,0.5)]">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Download E-Ticket
            </button>
            <a href="{{ route('history') }}" 
               class="w-full py-3.5 bg-[#0047FF]/10 border border-[#0047FF]/20 hover:bg-[#0047FF]/20 text-white rounded-2xl font-bold text-sm text-center transition block">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Lihat Riwayat
            </a>
            <a href="{{ route('home') }}" 
               class="w-full py-3 bg-transparent text-[#94A3B8] hover:text-white text-xs font-semibold text-center transition block">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<!-- Canvas Confetti CDN Script -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Launch a premium confetti explosion with brand colors!
    if (typeof confetti === 'function') {
        const duration = 2.5 * 1000;
        const animationEnd = Date.now() + duration;
        const defaults = { startVelocity: 25, spread: 360, ticks: 50, zIndex: 9999 };

        function randomInRange(min, max) {
            return Math.random() * (max - min) + min;
        }

        const interval = setInterval(function() {
            const timeLeft = animationEnd - Date.now();

            if (timeLeft <= 0) {
                return clearInterval(interval);
            }

            const particleCount = 40 * (timeLeft / duration);
            // Confetti from both sides using brand colors
            confetti(Object.assign({}, defaults, {
                particleCount,
                origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 },
                colors: ['#0047FF', '#0B57FF', '#1E63FF', '#ffffff']
            }));
            confetti(Object.assign({}, defaults, {
                particleCount,
                origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 },
                colors: ['#FF5C00', '#FF6B00', '#FF7A00', '#ffffff']
            }));
        }, 250);
    }
});

function downloadEkticket() {
    alert('Mengunduh e-tiket PDF Anda... Silakan simpan file PDF di perangkat Anda.');
}
</script>
@endsection
