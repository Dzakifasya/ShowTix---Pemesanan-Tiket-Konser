@extends('layouts.app')

@section('title')
Pilih Metode Pembayaran - ShowTix
@endsection

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Timer & Status Header -->
    <div class="bg-gradient-to-r from-red-600 to-red-700 text-white sticky top-16 z-40 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-bold text-lg mb-1">Sisa Waktu Proses Transaksi</h2>
                    <p class="text-sm opacity-90">Kode Pesanan: <span class="font-mono font-bold">#{{ $transactionCode ?? 'TXN-000000' }}</span></p>
                </div>
                <div class="text-center">
                    <div class="font-display font-bold text-4xl" id="timer">15:00</div>
                    <p class="text-sm opacity-90">Waktu Tersisa</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Payment Methods -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
                    <h2 class="font-display font-bold text-3xl text-gray-900 mb-1">Metode Pembayaran</h2>
                    <p class="text-gray-600 mb-8">Pilih salah satu metode pembayaran di bawah ini</p>

                    <div class="space-y-3">
                        <!-- BNC -->
                        <button type="button" onclick="selectPaymentMethod('bnc')" class="payment-method-btn w-full group">
                            <div class="flex items-center justify-between p-4 border-2 border-gray-300 rounded-xl hover:border-[#003D82] hover:bg-blue-50 transition duration-300">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center flex-shrink-0 border border-gray-200 p-1 overflow-hidden">
                                        <img src="https://bankneocommerce.co.id/wp-content/uploads/2022/06/logo-bnc-new.png" alt="BNC" class="w-full h-full object-contain" onerror="this.onerror=null;this.parentElement.innerHTML='<span class=\'font-bold text-blue-700 text-xs\'>BNC</span>'">
                                    </div>
                                    <div class="text-left">
                                        <h3 class="font-bold text-gray-900 group-hover:text-[#003D82]">BNC</h3>
                                        <p class="text-sm text-gray-500">Bank Neo Commerce</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 group-hover:border-[#003D82] transition-all duration-300 flex items-center justify-center radio-indicator"></div>
                            </div>
                        </button>

                        <!-- Sinarmas -->
                        <button type="button" onclick="selectPaymentMethod('sinarmas')" class="payment-method-btn w-full group">
                            <div class="flex items-center justify-between p-4 border-2 border-gray-300 rounded-xl hover:border-[#003D82] hover:bg-blue-50 transition duration-300">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center flex-shrink-0 border border-gray-200 p-1 overflow-hidden">
                                        <img src="https://upload.wikimedia.org/wikipedia/id/thumb/f/fa/Bank_Sinarmas_logo.svg/1200px-Bank_Sinarmas_logo.svg.png" alt="Sinarmas" class="w-full h-full object-contain" onerror="this.onerror=null;this.parentElement.innerHTML='<span class=\'font-bold text-red-700 text-xs\'>Sinarmas</span>'">
                                    </div>
                                    <div class="text-left">
                                        <h3 class="font-bold text-gray-900 group-hover:text-[#003D82]">Sinarmas</h3>
                                        <p class="text-sm text-gray-500">Bank Sinarmas</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 group-hover:border-[#003D82] transition-all duration-300 flex items-center justify-center radio-indicator"></div>
                            </div>
                        </button>

                        <!-- QRIS Payment -->
                        <button type="button" onclick="selectPaymentMethod('qr')" class="payment-method-btn w-full group">
                            <div class="flex items-center justify-between p-4 border-2 border-gray-300 rounded-xl hover:border-[#003D82] hover:bg-blue-50 transition duration-300">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center flex-shrink-0 border border-gray-200 p-1 overflow-hidden">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/QRIS_logo.svg/1200px-QRIS_logo.svg.png" alt="QRIS" class="w-full h-full object-contain" onerror="this.onerror=null;this.parentElement.innerHTML='<span class=\'font-bold text-purple-700 text-xs\'>QRIS</span>'">
                                    </div>
                                    <div class="text-left">
                                        <h3 class="font-bold text-gray-900 group-hover:text-[#003D82]">QRIS</h3>
                                        <p class="text-sm text-gray-500">Scan QRIS dari smartphone</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 group-hover:border-[#003D82] transition-all duration-300 flex items-center justify-center radio-indicator"></div>
                            </div>
                        </button>

                        <!-- Mandiri -->
                        <button type="button" onclick="selectPaymentMethod('mandiri')" class="payment-method-btn w-full group">
                            <div class="flex items-center justify-between p-4 border-2 border-gray-300 rounded-xl hover:border-[#003D82] hover:bg-blue-50 transition duration-300">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center flex-shrink-0 border border-gray-200 p-1 overflow-hidden">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/1200px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri" class="w-full h-full object-contain" onerror="this.onerror=null;this.parentElement.innerHTML='<span class=\'font-bold text-blue-800 text-xs\'>Mandiri</span>'">
                                    </div>
                                    <div class="text-left">
                                        <h3 class="font-bold text-gray-900 group-hover:text-[#003D82]">Mandiri</h3>
                                        <p class="text-sm text-gray-500">Bank Mandiri - Virtual Account</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 group-hover:border-[#003D82] transition-all duration-300 flex items-center justify-center radio-indicator"></div>
                            </div>
                        </button>

                        <!-- BRI Virtual Account -->
                        <button type="button" onclick="selectPaymentMethod('bri_va')" class="payment-method-btn w-full group">
                            <div class="flex items-center justify-between p-4 border-2 border-gray-300 rounded-xl hover:border-[#003D82] hover:bg-blue-50 transition duration-300">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center flex-shrink-0 border border-gray-200 p-1 overflow-hidden">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/BANK_BRI_logo.svg/1200px-BANK_BRI_logo.svg.png" alt="BRI" class="w-full h-full object-contain" onerror="this.onerror=null;this.parentElement.innerHTML='<span class=\'font-bold text-blue-600 text-xs\'>BRI</span>'">
                                    </div>
                                    <div class="text-left">
                                        <h3 class="font-bold text-gray-900 group-hover:text-[#003D82]">BRI Virtual Account</h3>
                                        <p class="text-sm text-gray-500">Bank BRI - Virtual Account</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 group-hover:border-[#003D82] transition-all duration-300 flex items-center justify-center radio-indicator"></div>
                            </div>
                        </button>

                        <!-- Permata -->
                        <button type="button" onclick="selectPaymentMethod('permata')" class="payment-method-btn w-full group">
                            <div class="flex items-center justify-between p-4 border-2 border-gray-300 rounded-xl hover:border-[#003D82] hover:bg-blue-50 transition duration-300">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center flex-shrink-0 border border-gray-200 p-1 overflow-hidden">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/PermataBank_logo.svg/1200px-PermataBank_logo.svg.png" alt="Permata" class="w-full h-full object-contain" onerror="this.onerror=null;this.parentElement.innerHTML='<span class=\'font-bold text-indigo-700 text-xs\'>Permata</span>'">
                                    </div>
                                    <div class="text-left">
                                        <h3 class="font-bold text-gray-900 group-hover:text-[#003D82]">Permata</h3>
                                        <p class="text-sm text-gray-500">Bank Permata - Virtual Account</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 group-hover:border-[#003D82] transition-all duration-300 flex items-center justify-center radio-indicator"></div>
                            </div>
                        </button>

                        <!-- BNI -->
                        <button type="button" onclick="selectPaymentMethod('bni')" class="payment-method-btn w-full group">
                            <div class="flex items-center justify-between p-4 border-2 border-gray-300 rounded-xl hover:border-[#003D82] hover:bg-blue-50 transition duration-300">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center flex-shrink-0 border border-gray-200 p-1 overflow-hidden">
                                        <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/1200px-BNI_logo.svg.png" alt="BNI" class="w-full h-full object-contain" onerror="this.onerror=null;this.parentElement.innerHTML='<span class=\'font-bold text-orange-600 text-xs\'>BNI</span>'">
                                    </div>
                                    <div class="text-left">
                                        <h3 class="font-bold text-gray-900 group-hover:text-[#003D82]">BNI</h3>
                                        <p class="text-sm text-gray-500">Bank Negara Indonesia</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 group-hover:border-[#003D82] transition-all duration-300 flex items-center justify-center radio-indicator"></div>
                            </div>
                        </button>

                        <!-- Muamalat -->
                        <button type="button" onclick="selectPaymentMethod('muamalat')" class="payment-method-btn w-full group">
                            <div class="flex items-center justify-between p-4 border-2 border-gray-300 rounded-xl hover:border-[#003D82] hover:bg-blue-50 transition duration-300">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center flex-shrink-0 border border-gray-200 p-1 overflow-hidden">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Bank_Muamalat_Logo.svg/1200px-Bank_Muamalat_Logo.svg.png" alt="Muamalat" class="w-full h-full object-contain" onerror="this.onerror=null;this.parentElement.innerHTML='<span class=\'font-bold text-green-700 text-xs\'>Muamalat</span>'">
                                    </div>
                                    <div class="text-left">
                                        <h3 class="font-bold text-gray-900 group-hover:text-[#003D82]">Muamalat</h3>
                                        <p class="text-sm text-gray-500">Bank Muamalat Indonesia</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 group-hover:border-[#003D82] transition-all duration-300 flex items-center justify-center radio-indicator"></div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Summary Card -->
            <div class="lg:col-span-1">
                <!-- Customer Info Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200 mb-6 sticky top-32">
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <h3 class="font-bold text-sm text-gray-600 mb-3">PEMESAN</h3>
                        <div class="space-y-2">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Nama</p>
                                <p class="font-bold text-gray-900">{{ auth()->user()->name ?? 'Nama Pembeli' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Email</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ auth()->user()->email ?? 'email@example.com' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Telepon</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $phone ?? '+62 8XX-XXXX-XXXX' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Order Details -->
                    <div class="space-y-4 mb-6 pb-6 border-b border-gray-200">
                        <h3 class="font-bold text-sm text-gray-600 mb-3">DETAIL PESANAN</h3>
                        @if(isset($cartItems) && count($cartItems) > 0)
                            @foreach($cartItems as $item)
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 text-sm">{{ $item['konser_nama'] }}</p>
                                        <p class="text-xs text-gray-600">{{ $item['kategori_nama'] }} x {{ $item['jumlah_tiket'] }}</p>
                                    </div>
                                    <p class="font-bold text-gray-900 text-right text-sm">Rp {{ number_format($item['subtotal'] ?? 0, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Price Breakdown -->
                    <div class="space-y-2 mb-6 pb-6 border-b border-gray-200">
                        <div class="flex justify-between text-sm text-gray-700">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-700">
                            <span>Biaya Layanan</span>
                            <span>Rp {{ number_format($serviceFee ?? 3000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-700">
                            <span>Biaya Transaksi</span>
                            <span>Rp 0</span>
                        </div>
                    </div>

                    <!-- Grand Total -->
                    <div class="mb-6">
                        <div class="flex justify-between items-baseline">
                            <span class="text-gray-700 font-semibold">Total:</span>
                            <span class="text-4xl font-display font-bold text-[#FF6600]">Rp {{ number_format($grandTotal ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Pay Button -->
                    <button id="payBtn" onclick="processPayment()" type="button" class="w-full bg-gradient-to-r from-[#FF6600] to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-4 rounded-xl transition duration-300 shadow-lg hover:shadow-xl text-lg flex items-center justify-center gap-2">
                        <i class="fas fa-arrow-right"></i>
                        Bayar Sekarang
                    </button>

                    <!-- Info -->
                    <p class="text-xs text-gray-600 text-center mt-4">
                        <i class="fas fa-lock text-green-600 mr-1"></i>
                        Transaksi Anda aman dan terenkripsi
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
    
    // Remove previous selection styling
    document.querySelectorAll('.payment-method-btn').forEach(btn => {
        btn.querySelector('div').classList.remove('border-[#003D82]', 'bg-blue-50', 'border-2');
        btn.querySelector('div').classList.add('border-gray-300', 'border-2');
        btn.querySelector('.rounded-full').classList.remove('border-[#003D82]', 'bg-[#003D82]');
        btn.querySelector('.rounded-full').classList.add('border-gray-300');
    });
    
    // Add selection styling to clicked button
    const btn = event.currentTarget;
    btn.querySelector('div').classList.remove('border-gray-300');
    btn.querySelector('div').classList.add('border-[#003D82]', 'bg-blue-50');
    btn.querySelector('.rounded-full').classList.remove('border-gray-300');
    btn.querySelector('.rounded-full').classList.add('border-[#003D82]', 'bg-[#003D82]');
    
    console.log('Selected payment method:', selectedMethod);
}

function processPayment() {
    if (!selectedMethod) {
        alert('Silakan pilih metode pembayaran terlebih dahulu');
        return;
    }
    
    // Here you can add the payment processing logic
    const payBtn = document.getElementById('payBtn');
    payBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
    payBtn.disabled = true;
    
    // Create hidden form for POST request
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/payment/process/${selectedMethod}`;
    
    // Add transaksi_id as hidden input from URL query parameter
    const urlParams = new URLSearchParams(window.location.search);
    const transaksiId = urlParams.get('transaksi_id');
    if (transaksiId) {
        const transaksiInput = document.createElement('input');
        transaksiInput.type = 'hidden';
        transaksiInput.name = 'transaksi_id';
        transaksiInput.value = transaksiId;
        form.appendChild(transaksiInput);
    }
    
    // Add CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (csrfToken) {
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);
    }
    
    // Submit form after a brief delay
    setTimeout(() => {
        document.body.appendChild(form);
        form.submit();
    }, 500);
}

// Timer function
function startTimer() {
    let timeLeft = 15 * 60; // 15 minutes in seconds
    
    function updateTimer() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        document.getElementById('timer').textContent = 
            String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
        
        if (timeLeft > 0) {
            timeLeft--;
            setTimeout(updateTimer, 1000);
        } else {
            // Timer finished - handle expiration
            alert('Waktu pembayaran telah habis. Silakan mulai dari awal.');
            window.location.href = '/cart';
        }
    }
    
    updateTimer();
}

// Start timer on page load
document.addEventListener('DOMContentLoaded', startTimer);
</script>

<style>
    .payment-method-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
    }
    
    .payment-method-btn:focus {
        outline: none;
    }
</style>

@endsection
