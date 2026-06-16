@extends('layouts.app')

@section('title', 'Checkout - SHOWTIX')

@section('content')
<div class="py-12 bg-[#050816] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Title -->
        <div class="mb-12">
            <h1 class="font-display font-extrabold text-3xl md:text-4xl text-white tracking-tight">Checkout</h1>
            <p class="text-[#94A3B8] mt-2 text-sm">Selesaikan pengisian data diri Anda untuk memesan tiket.</p>
        </div>

        @if(session('error'))
            <div class="mb-8 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-2xl text-sm flex items-center gap-3">
                <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif
        
        @if($errors->any())
            <div class="mb-8 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-2xl text-sm space-y-1">
                <div class="flex items-center gap-3 font-bold mb-1">
                    <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Terdapat kesalahan input:</span>
                </div>
                <ul class="list-disc pl-8 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($summary && count($summary['items']) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                <!-- Left Column: Form Data Diri -->
                <div class="lg:col-span-2">
                    <form id="checkoutForm" action="{{ route('checkout.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <!-- Personal Data Card -->
                        <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 sm:p-8 shadow-[0_15px_40px_rgba(0,71,255,0.05)] backdrop-blur-md">
                            <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                                <svg class="w-5 h-5 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Data Diri Pembeli
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nama Lengkap -->
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-semibold text-[#94A3B8] uppercase tracking-wider mb-2">Nama Lengkap *</label>
                                    <input type="text" name="nama_lengkap" required value="{{ old('nama_lengkap', Auth::user()->name) }}"
                                           class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] focus:ring-1 focus:ring-[#FF5C00]/30 text-sm"
                                           placeholder="Nama lengkap sesuai kartu identitas">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-xs font-semibold text-[#94A3B8] uppercase tracking-wider mb-2">Email *</label>
                                    <input type="email" name="email" id="email" required value="{{ old('email', Auth::user()->email) }}"
                                           class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] focus:ring-1 focus:ring-[#FF5C00]/30 text-sm"
                                           placeholder="email@example.com">
                                </div>

                                <!-- Konfirmasi Email -->
                                <div>
                                    <label class="block text-xs font-semibold text-[#94A3B8] uppercase tracking-wider mb-2">Konfirmasi Email *</label>
                                    <input type="email" name="email_confirmation" id="email_confirmation" required value="{{ old('email_confirmation', Auth::user()->email) }}"
                                           class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] focus:ring-1 focus:ring-[#FF5C00]/30 text-sm"
                                           placeholder="Ulangi alamat email Anda">
                                </div>

                                <!-- WhatsApp/HP -->
                                <div>
                                    <label class="block text-xs font-semibold text-[#94A3B8] uppercase tracking-wider mb-2">Nomor HP / WhatsApp *</label>
                                    <input type="tel" name="no_whatsapp" required value="{{ old('no_whatsapp', Auth::user()->pembeli?->no_hp ?? '') }}"
                                           class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] focus:ring-1 focus:ring-[#FF5C00]/30 text-sm"
                                           placeholder="Contoh: 08123456789">
                                </div>

                                <!-- Jenis Kelamin -->
                                <div>
                                    <label class="block text-xs font-semibold text-[#94A3B8] uppercase tracking-wider mb-2">Jenis Kelamin *</label>
                                    <select name="jenis_kelamin" required
                                            class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] text-sm">
                                        <option value="" class="bg-[#0B1730]">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki" class="bg-[#0B1730]" {{ old('jenis_kelamin', Auth::user()->pembeli?->jenis_kelamin) === 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="perempuan" class="bg-[#0B1730]" {{ old('jenis_kelamin', Auth::user()->pembeli?->jenis_kelamin) === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        <option value="other" class="bg-[#0B1730]" {{ old('jenis_kelamin', Auth::user()->pembeli?->jenis_kelamin) === 'other' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>

                                <!-- Provinsi -->
                                <div>
                                    <label class="block text-xs font-semibold text-[#94A3B8] uppercase tracking-wider mb-2">Provinsi *</label>
                                    <select name="provinsi" required
                                            class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] text-sm">
                                        <option value="" class="bg-[#0B1730]">Pilih Provinsi</option>
                                        @foreach($provinces ?? [] as $key => $value)
                                            <option value="{{ $key }}" class="bg-[#0B1730]" {{ old('provinsi', Auth::user()->pembeli?->provinsi) === $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tanggal Lahir -->
                                <div>
                                    <label class="block text-xs font-semibold text-[#94A3B8] uppercase tracking-wider mb-2">Tanggal Lahir *</label>
                                    <input type="date" name="tanggal_lahir" required 
                                           value="{{ old('tanggal_lahir', Auth::user()->pembeli?->tanggal_lahir?->format('Y-m-d') ?? '') }}"
                                           class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] focus:ring-1 focus:ring-[#FF5C00]/30 text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Terms & Conditions Card -->
                        <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 sm:p-8 shadow-[0_15px_40px_rgba(0,71,255,0.05)] backdrop-blur-md">
                            <label class="flex items-start gap-3.5 cursor-pointer">
                                <input type="checkbox" name="agree_terms" required class="mt-1 accent-[#0047FF] rounded w-4 h-4">
                                <span class="text-sm text-[#D1D5DB] leading-relaxed">
                                    Saya menyatakan bahwa seluruh data yang diisi adalah benar, dan saya menyetujui 
                                    <a href="#" class="text-[#FF5C00] hover:underline font-semibold transition-colors">Syarat & Ketentuan</a> 
                                    serta 
                                    <a href="#" class="text-[#FF5C00] hover:underline font-semibold transition-colors">Kebijakan Privasi</a> SHOWTIX.
                                </span>
                            </label>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Ringkasan Pesanan -->
                <div class="lg:col-span-1">
                    <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 sm:p-8 shadow-[0_15px_40px_rgba(0,71,255,0.1)] backdrop-blur-md space-y-6">
                        <h2 class="text-xl font-bold text-white border-b border-white/5 pb-4">Ringkasan Pesanan</h2>

                        <!-- Cart Items List -->
                        <div class="space-y-4">
                            @foreach($summary['items'] as $item)
                                <div class="bg-[#0B1730]/60 border border-white/5 rounded-2xl p-4 flex gap-4 items-start shadow-inner">
                                    <!-- Poster -->
                                    <div class="w-12 h-16 bg-[#050816] rounded-lg overflow-hidden flex-shrink-0 relative border border-white/5">
                                        @if($item['poster'])
                                            <img src="{{ asset('storage/' . $item['poster']) }}" alt="{{ $item['konser_nama'] }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[#94A3B8]">
                                                <svg class="w-5 h-5 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Detail info -->
                                    <div class="flex-grow min-w-0">
                                        <h3 class="font-bold text-white text-sm truncate" title="{{ $item['konser_nama'] }}">{{ $item['konser_nama'] }}</h3>
                                        <p class="text-xs text-[#0047FF] font-semibold mt-0.5">Kategori: {{ $item['kategori_nama'] }}</p>
                                        
                                        <!-- Quantity Adjustment [-] N [+] -->
                                        <div class="flex justify-between items-center mt-2.5 pt-2 border-t border-white/5">
                                            <span class="text-[10px] text-[#94A3B8] uppercase">Jumlah Tiket:</span>
                                            <div class="flex items-center gap-2">
                                                <button type="button" onclick="updateQuantity('{{ $item['id'] }}', {{ $item['jumlah_tiket'] - 1 }})" 
                                                        class="w-6 h-6 rounded bg-[#0B1730] border border-white/10 hover:border-[#0047FF] text-white font-bold transition flex items-center justify-center text-xs">−</button>
                                                <span class="text-xs font-bold text-white w-4 text-center">{{ $item['jumlah_tiket'] }}</span>
                                                <button type="button" onclick="updateQuantity('{{ $item['id'] }}', {{ $item['jumlah_tiket'] + 1 }})" 
                                                        class="w-6 h-6 rounded bg-[#0B1730] border border-white/10 hover:border-[#0047FF] text-white font-bold transition flex items-center justify-center text-xs">+</button>
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-between items-center mt-2 text-xs">
                                            <span class="text-[#94A3B8]">Subtotal:</span>
                                            <span class="font-bold text-white">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Cost Summary -->
                        <div class="space-y-3 text-xs text-[#94A3B8] border-t border-white/5 pt-4">
                            <div class="flex justify-between">
                                <span>Subtotal:</span>
                                <span class="font-bold text-white text-sm">Rp {{ number_format($summary['total_price'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Biaya Layanan:</span>
                                @php $serviceFee = 3000; @endphp
                                <span class="font-bold text-white text-sm">Rp {{ number_format($serviceFee, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between pt-3 border-t border-white/5 text-sm font-extrabold text-white">
                                <span>Total Pembayaran:</span>
                                @php $totalPayment = $summary['total_price'] + $serviceFee; @endphp
                                <span class="text-lg font-extrabold text-[#FF5C00]">Rp {{ number_format($totalPayment, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3 pt-4">
                            <button type="submit" id="submitBtn" form="checkoutForm" disabled
                                    class="w-full py-3.5 text-white rounded-xl font-bold text-sm transition-all duration-300 transform text-center shadow-lg bg-[#0047FF]/50 border border-white/5 opacity-50 cursor-not-allowed pointer-events-none">
                                Lanjut Pembayaran
                            </button>
                            
                            <a href="{{ route('home') }}" 
                               class="block w-full py-3 bg-white/5 border border-white/10 hover:bg-white/10 text-white rounded-xl font-bold text-sm text-center transition">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20 bg-[#081224]/30 border border-[#0047FF]/10 rounded-3xl p-12 max-w-xl mx-auto shadow-2xl">
                <svg class="w-16 h-16 mx-auto text-[#94A3B8]/60 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <h2 class="font-display font-bold text-2xl text-white mb-2">Keranjang Anda Kosong</h2>
                <p class="text-[#94A3B8] text-base mb-8">Silakan cari konser menarik dan pilih kategori tiket Anda terlebih dahulu.</p>
                <a href="{{ route('home') }}" class="bg-gradient-to-r from-[#0047FF] to-[#FF5C00] hover:from-[#0B57FF] hover:to-[#FF6B00] text-white px-6 py-3 rounded-xl font-bold text-sm transition-all duration-300 hover:shadow-[0_0_20px_rgba(255,92,0,0.4)] inline-block">
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>
</div>

<script>
async function updateQuantity(itemId, newQty) {
    if (newQty < 1) {
        if (!confirm('Apakah Anda ingin menghapus tiket ini dari keranjang?')) return;
        
        try {
            const response = await fetch(`/cart/remove/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });
            const result = await response.json();
            if (result.success) {
                window.location.reload();
            } else {
                alert('Gagal menghapus tiket: ' + result.message);
            }
        } catch (err) {
            alert('Terjadi kesalahan: ' + err.message);
        }
        return;
    }
    
    try {
        const response = await fetch(`/cart/update/${itemId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ jumlah_tiket: newQty })
        });
        const result = await response.json();
        if (result.success) {
            window.location.reload();
        } else {
            alert('Gagal memperbarui jumlah: ' + result.message);
        }
    } catch (err) {
        alert('Terjadi kesalahan: ' + err.message);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('checkoutForm');
    const agreeCheckbox = document.querySelector('input[name="agree_terms"]');
    const submitBtn = document.getElementById('submitBtn');

    if (!form || !agreeCheckbox || !submitBtn) return;

    // Inputs to check for validity
    const inputs = [
        document.querySelector('input[name="nama_lengkap"]'),
        document.querySelector('input[name="email"]'),
        document.querySelector('input[name="email_confirmation"]'),
        document.querySelector('input[name="no_whatsapp"]'),
        document.querySelector('select[name="jenis_kelamin"]'),
        document.querySelector('select[name="provinsi"]'),
        document.querySelector('input[name="tanggal_lahir"]')
    ];

    function checkFormValidity() {
        const isChecked = agreeCheckbox.checked;
        let allFilled = true;

        inputs.forEach(input => {
            if (!input) return;
            if (!input.value.trim()) {
                allFilled = false;
            }
        });

        if (isChecked && allFilled) {
            submitBtn.removeAttribute('disabled');
            submitBtn.className = "w-full py-3.5 bg-gradient-to-r from-[#0047FF] to-[#FF5C00] hover:from-[#0B57FF] hover:to-[#FF6B00] text-white rounded-xl font-bold text-sm transition-all duration-300 transform hover:scale-[1.02] text-center shadow-[0_0_20px_rgba(255,92,0,0.4)] cursor-pointer";
        } else {
            submitBtn.setAttribute('disabled', 'true');
            submitBtn.className = "w-full py-3.5 text-white rounded-xl font-bold text-sm transition-all duration-300 transform text-center shadow-lg bg-[#0047FF]/50 border border-white/5 opacity-50 cursor-not-allowed pointer-events-none";
        }
    }

    // Attach event listeners to all inputs and the checkbox
    inputs.forEach(input => {
        if (input) {
            input.addEventListener('input', checkFormValidity);
            input.addEventListener('change', checkFormValidity);
        }
    });
    agreeCheckbox.addEventListener('change', checkFormValidity);

    // Initial check
    checkFormValidity();

    // Normal Form submit handling for custom validation (email match) and showing spinner
    form.addEventListener('submit', function(e) {
        const emailInput = document.querySelector('input[name="email"]');
        const emailConfInput = document.querySelector('input[name="email_confirmation"]');

        if (emailInput && emailConfInput && emailInput.value !== emailConfInput.value) {
            e.preventDefault();
            alert('Konfirmasi email tidak sesuai!');
            emailConfInput.focus();
            return;
        }

        // Add loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="w-4 h-4 animate-spin mr-2 inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...';
    });
});
</script>
@endsection
