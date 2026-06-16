@extends('layouts.app')

@section('title', 'Pilih Metode Pembayaran - SHOWTIX')

@section('content')
<!-- Countdown Timer Bar -->
<div class="bg-[#0047FF]/10 border-b border-[#0047FF]/20 text-white sticky top-[72px] z-40 shadow-lg backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <span class="w-3 h-3 rounded-full bg-[#FF5C00] animate-ping"></span>
            <div>
                <p class="text-sm font-bold text-white">Selesaikan Pembayaran Anda</p>
                <p class="text-xs text-[#94A3B8]">Kode Transaksi: <span class="font-mono text-[#FF5C00] font-bold">{{ $transactionCode ?? 'TRX-001' }}</span></p>
            </div>
        </div>
        <div class="flex items-center gap-3 bg-[#0047FF]/20 px-4 py-1.5 rounded-full border border-[#0047FF]/30">
            <svg class="w-4 h-4 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-display font-extrabold text-lg text-[#FF5C00] tracking-wider" id="timer">15:00</span>
        </div>
    </div>
</div>

<div class="py-12 bg-[#050816] min-h-[85vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Column: Payment Methods Selection -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 sm:p-8 shadow-[0_15px_40px_rgba(0,71,255,0.05)] backdrop-blur-md">
                    <h2 class="text-2xl font-display font-extrabold text-white mb-2">Metode Pembayaran</h2>
                    <p class="text-[#94A3B8] text-sm mb-8">Pilih salah satu metode pembayaran di bawah ini.</p>

                    <div class="space-y-6">
                        <!-- Category: Transfer Bank -->
                        <div class="space-y-3">
                            <h3 class="text-xs font-bold text-[#94A3B8] uppercase tracking-widest flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Transfer Bank (Virtual Account)
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <!-- BCA -->
                                <button type="button" onclick="selectPaymentMethod('bca_va')" class="payment-method-btn group text-left w-full focus:outline-none">
                                    <div class="p-4 bg-[#0B1730]/60 border-2 border-white/10 rounded-2xl group-hover:border-[#0047FF] transition duration-300 flex items-center justify-between relative overflow-hidden h-20">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-8 bg-white/5 border border-white/10 rounded flex items-center justify-center p-1 flex-shrink-0">
                                                <span class="text-[10px] font-extrabold text-blue-400">BCA</span>
                                            </div>
                                            <span class="font-bold text-sm text-[#D1D5DB]">BCA VA</span>
                                        </div>
                                        <div class="w-4 h-4 rounded-full border-2 border-white/30 flex items-center justify-center radio-dot"></div>
                                    </div>
                                </button>
                                
                                <!-- BNI -->
                                <button type="button" onclick="selectPaymentMethod('bni_va')" class="payment-method-btn group text-left w-full focus:outline-none">
                                    <div class="p-4 bg-[#0B1730]/60 border-2 border-white/10 rounded-2xl group-hover:border-[#0047FF] transition duration-300 flex items-center justify-between relative overflow-hidden h-20">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-8 bg-white/5 border border-white/10 rounded flex items-center justify-center p-1 flex-shrink-0">
                                                <span class="text-[10px] font-extrabold text-orange-400">BNI</span>
                                            </div>
                                            <span class="font-bold text-sm text-[#D1D5DB]">BNI VA</span>
                                        </div>
                                        <div class="w-4 h-4 rounded-full border-2 border-white/30 flex items-center justify-center radio-dot"></div>
                                    </div>
                                </button>
                                
                                <!-- Mandiri -->
                                <button type="button" onclick="selectPaymentMethod('mandiri_va')" class="payment-method-btn group text-left w-full focus:outline-none">
                                    <div class="p-4 bg-[#0B1730]/60 border-2 border-white/10 rounded-2xl group-hover:border-[#0047FF] transition duration-300 flex items-center justify-between relative overflow-hidden h-20">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-8 bg-white/5 border border-white/10 rounded flex items-center justify-center p-1 flex-shrink-0">
                                                <span class="text-[10px] font-extrabold text-yellow-400">Mandiri</span>
                                            </div>
                                            <span class="font-bold text-sm text-[#D1D5DB]">Mandiri VA</span>
                                        </div>
                                        <div class="w-4 h-4 rounded-full border-2 border-white/30 flex items-center justify-center radio-dot"></div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Category: E-Wallet -->
                        <div class="space-y-3">
                            <h3 class="text-xs font-bold text-[#94A3B8] uppercase tracking-widest flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#FF5C00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                E-Wallet / Instant Payment
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <!-- GoPay -->
                                <button type="button" onclick="selectPaymentMethod('qris')" class="payment-method-btn group text-left w-full focus:outline-none">
                                    <div class="p-4 bg-[#0B1730]/60 border-2 border-white/10 rounded-2xl group-hover:border-[#FF5C00] transition duration-300 flex items-center justify-between relative overflow-hidden h-20">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-8 bg-[#00AED6]/10 border border-[#00AED6]/20 rounded flex items-center justify-center p-1 flex-shrink-0">
                                                <span class="text-[10px] font-extrabold text-[#00AED6]">GoPay</span>
                                            </div>
                                            <span class="font-bold text-sm text-[#D1D5DB]">GoPay</span>
                                        </div>
                                        <div class="w-4 h-4 rounded-full border-2 border-white/30 flex items-center justify-center radio-dot"></div>
                                    </div>
                                </button>
                                
                                <!-- OVO -->
                                <button type="button" onclick="selectPaymentMethod('qris')" class="payment-method-btn group text-left w-full focus:outline-none">
                                    <div class="p-4 bg-[#0B1730]/60 border-2 border-white/10 rounded-2xl group-hover:border-[#FF5C00] transition duration-300 flex items-center justify-between relative overflow-hidden h-20">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-8 bg-[#0047FF]/10 border border-[#0047FF]/20 rounded flex items-center justify-center p-1 flex-shrink-0">
                                                <span class="text-[10px] font-extrabold text-[#1E63FF]">OVO</span>
                                            </div>
                                            <span class="font-bold text-sm text-[#D1D5DB]">OVO</span>
                                        </div>
                                        <div class="w-4 h-4 rounded-full border-2 border-white/30 flex items-center justify-center radio-dot"></div>
                                    </div>
                                </button>

                                <!-- Dana -->
                                <button type="button" onclick="selectPaymentMethod('qris')" class="payment-method-btn group text-left w-full focus:outline-none">
                                    <div class="p-4 bg-[#0B1730]/60 border-2 border-white/10 rounded-2xl group-hover:border-[#FF5C00] transition duration-300 flex items-center justify-between relative overflow-hidden h-20">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-8 bg-[#108EE9]/10 border border-[#108EE9]/20 rounded flex items-center justify-center p-1 flex-shrink-0">
                                                <span class="text-[10px] font-extrabold text-[#108EE9]">DANA</span>
                                            </div>
                                            <span class="font-bold text-sm text-[#D1D5DB]">DANA</span>
                                        </div>
                                        <div class="w-4 h-4 rounded-full border-2 border-white/30 flex items-center justify-center radio-dot"></div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Category: QRIS -->
                        <div class="space-y-3">
                            <h3 class="text-xs font-bold text-[#94A3B8] uppercase tracking-widest flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                </svg>
                                QRIS (Scan QR)
                            </h3>
                            <button type="button" onclick="selectPaymentMethod('qris')" class="payment-method-btn group text-left w-full focus:outline-none">
                                <div class="p-6 bg-[#0B1730]/60 border-2 border-white/10 rounded-2xl group-hover:border-[#0047FF] transition duration-300 flex flex-col sm:flex-row items-center justify-between gap-6 relative overflow-hidden">
                                    <div class="flex items-center gap-4">
                                        <!-- Mockup QR Code Frame -->
                                        <div class="w-20 h-20 bg-white rounded-xl p-2 flex items-center justify-center flex-shrink-0 shadow-lg">
                                            <svg class="w-full h-full text-slate-800" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M3 3h7v7H3V3zm2 2v3h3V5H5zm7-2h7v7h-7V3zm2 2v3h3V5h-3zM3 13h7v7H3v-7zm2 2v3h3v-3H5zm10 0h2v2h-2v-2zm2 2h2v2h-2v-2zm-4 0h2v2h-2v-2zm-2 2h2v2h-2v-2zm4 0h2v2h-2v-2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-white text-base">QRIS (QR Code)</h4>
                                            <p class="text-xs text-[#94A3B8] mt-1 max-w-sm">Bayar instan menggunakan ShopeePay, GoPay, OVO, Dana, LinkAja atau Mobile Banking (M-BCA, Livin, dll).</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="text-[10px] font-extrabold uppercase bg-[#0047FF]/10 text-[#0047FF] border border-[#0047FF]/20 px-2.5 py-1 rounded-full">Otomatis</span>
                                        <div class="w-5 h-5 rounded-full border-2 border-white/30 flex items-center justify-center radio-dot"></div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary & Pay Button -->
            <div class="lg:col-span-1">
                <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 sm:p-8 sticky top-28 space-y-6 shadow-[0_15px_40px_rgba(0,71,255,0.1)] backdrop-blur-md">
                    <!-- Order Details -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-bold text-[#94A3B8] uppercase tracking-widest pb-3 border-b border-white/5">Ringkasan Pesanan</h3>
                        
                        @if(isset($cartItems) && count($cartItems) > 0)
                            @foreach($cartItems as $item)
                                <div class="space-y-1">
                                    <p class="font-bold text-white text-sm line-clamp-2">{{ $item['konser_nama'] }}</p>
                                    <p class="text-xs text-[#0047FF] font-semibold">Kategori: {{ $item['kategori_nama'] }} × {{ $item['jumlah_tiket'] }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Price Breakdown -->
                    <div class="space-y-3 text-xs text-[#94A3B8] border-t border-white/5 pt-4">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span class="font-bold text-white text-sm">Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Layanan:</span>
                            <span class="font-bold text-white text-sm">Rp {{ number_format($serviceFee ?? 3000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between pt-3 border-t border-white/5 text-sm font-extrabold text-white">
                            <span>Total Pembayaran:</span>
                            <span class="text-xl font-extrabold text-[#FF5C00]">Rp {{ number_format($grandTotal ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Pay Button -->
                    <div class="pt-4">
                        <button id="payBtn" onclick="processPayment()" type="button" 
                                class="w-full bg-gradient-to-r from-[#0047FF] to-[#FF5C00] hover:from-[#0B57FF] hover:to-[#FF6B00] text-white font-extrabold py-4 rounded-2xl transition-all duration-300 shadow-[0_0_20px_rgba(255,92,0,0.3)] text-base flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Bayar Sekarang
                        </button>
                        
                        <a href="{{ route('home') }}" 
                           class="block w-full py-3 mt-3 bg-white/5 border border-white/10 hover:bg-white/10 text-white rounded-2xl font-bold text-sm text-center transition">
                            Batal
                        </a>
                    </div>

                    <!-- Security badge -->
                    <p class="text-[10px] text-[#94A3B8] text-center flex items-center justify-center gap-1.5 mt-4">
                        <svg class="w-3.5 h-3.5 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Pembayaran 100% aman & terenkripsi oleh SSL
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedMethod = null;

function selectPaymentMethod(method) {
    selectedMethod = method;
    
    // Reset selection indicators
    document.querySelectorAll('.payment-method-btn').forEach(btn => {
        const borderBox = btn.querySelector('div');
        borderBox.classList.remove('border-[#0047FF]', 'bg-[#0047FF]/5', 'border-[#FF5C00]', 'bg-[#FF5C00]/5');
        borderBox.classList.add('border-white/10', 'bg-[#0B1730]/60');
        
        const dot = borderBox.querySelector('.radio-dot');
        if (dot) {
            dot.classList.remove('border-[#0047FF]', 'bg-[#0047FF]', 'border-[#FF5C00]', 'bg-[#FF5C00]');
            dot.classList.add('border-white/30');
            dot.innerHTML = '';
        }
    });
    
    // Set active class to clicked button
    const btn = event.currentTarget;
    const borderBox = btn.querySelector('div');
    borderBox.classList.remove('border-white/10', 'bg-[#0B1730]/60');
    borderBox.classList.add('border-[#0047FF]', 'bg-[#0047FF]/5');
    
    const dot = borderBox.querySelector('.radio-dot');
    if (dot) {
        dot.classList.remove('border-white/30');
        dot.classList.add('border-[#0047FF]', 'bg-[#0047FF]');
        dot.innerHTML = '<svg class="w-2 h-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>';
    }
}

function processPayment() {
    if (!selectedMethod) {
        alert('Silakan pilih salah satu metode pembayaran terlebih dahulu.');
        return;
    }
    
    const payBtn = document.getElementById('payBtn');
    const originalText = payBtn.innerHTML;
    payBtn.innerHTML = '<svg class="w-4 h-4 animate-spin mr-2 inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...';
    payBtn.disabled = true;
    
    // Create form to send POST
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/payment/process/${selectedMethod}`;
    
    const urlParams = new URLSearchParams(window.location.search);
    const transaksiId = urlParams.get('transaksi_id');
    
    if (transaksiId) {
        const transInput = document.createElement('input');
        transInput.type = 'hidden';
        transInput.name = 'transaksi_id';
        transInput.value = transaksiId;
        form.appendChild(transInput);
    }
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (csrfToken) {
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);
    }
    
    setTimeout(() => {
        document.body.appendChild(form);
        form.submit();
    }, 400);
}

// Timer Countdown Functionality
function startTimer() {
    let timeLeft = 15 * 60; // 15 minutes
    
    function updateTimer() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        const display = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
        
        const timerEl = document.getElementById('timer');
        if (timerEl) {
            timerEl.textContent = display;
        }
        
        if (timeLeft > 0) {
            timeLeft--;
            setTimeout(updateTimer, 1000);
        } else {
            alert('Waktu pembayaran telah habis. Silakan pesan kembali.');
            window.location.href = '/cart';
        }
    }
    updateTimer();
}

document.addEventListener('DOMContentLoaded', startTimer);
</script>
@endsection
