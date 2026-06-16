@extends('layouts.app')

@section('title')
{{ $concert->nama_konser }} - SHOWTIX
@endsection

@section('content')
<!-- Breadcrumb -->
<div class="bg-[#081224]/60 border-b border-white/5 backdrop-blur-md sticky top-[72px] z-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center text-sm text-[#94A3B8]">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors duration-300">Home</a>
            <span class="mx-2 text-white/20">/</span>
            <a href="{{ route('home') }}#concerts" class="hover:text-white transition-colors duration-300">Concerts</a>
            <span class="mx-2 text-white/20">/</span>
            <span class="text-white font-medium truncate">{{ $concert->nama_konser }}</span>
        </nav>
    </div>
</div>

<div class="py-12 bg-[#050816] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-12">
                <!-- Event Header & Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                    <!-- Poster -->
                    <div class="relative rounded-[24px] overflow-hidden aspect-[3/4] bg-[#081224] border border-white/5 shadow-[0_0_30px_rgba(0,71,255,0.1)]">
                        @if($concert->poster)
                            <img src="{{ asset('storage/' . $concert->poster) }}" 
                                 alt="{{ $concert->nama_konser }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-[#94A3B8] p-6">
                                <svg class="w-16 h-16 mb-3 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs font-semibold uppercase tracking-wider text-[#94A3B8] text-center">No Image Available</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Event Info -->
                    <div class="md:col-span-2 space-y-6">
                        <span class="inline-flex items-center px-3.5 py-1 rounded-full text-xs font-semibold bg-[#0047FF]/10 text-[#0047FF] border border-[#0047FF]/20">
                            Live Concert
                        </span>
                        <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight leading-tight">
                            {{ $concert->nama_konser }}
                        </h1>
                        
                        <!-- Artists -->
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#FF5C00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                            <div>
                                <p class="text-xs text-[#94A3B8] uppercase tracking-wider">Lineup Artis</p>
                                <p class="text-lg font-bold text-[#FF5C00]">
                                    {{ $artists->pluck('nama_artis')->implode(', ') }}
                                </p>
                            </div>
                        </div>

                        <!-- Event Details Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-[#081224]/60 border border-[#0047FF]/20 rounded-2xl p-5 backdrop-blur-sm shadow-[0_0_15px_rgba(0,71,255,0.05)]">
                            <div class="space-y-1">
                                <p class="text-[10px] text-[#94A3B8] uppercase font-semibold">TANGGAL</p>
                                <p class="text-sm font-bold text-white flex items-center">
                                    <svg class="w-4 h-4 text-[#0047FF] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $concert->tanggal_konser->format('d M Y') }}
                                </p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] text-[#94A3B8] uppercase font-semibold">WAKTU</p>
                                <p class="text-sm font-bold text-white flex items-center">
                                    <svg class="w-4 h-4 text-[#0047FF] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $concert->waktu_konser?->format('H:i') ?? '19:00' }} WIB
                                </p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] text-[#94A3B8] uppercase font-semibold">LOKASI</p>
                                <p class="text-sm font-bold text-white truncate flex items-center">
                                    <svg class="w-4 h-4 text-[#FF5C00] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $concert->lokasi }}
                                </p>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <button onclick="scrollToTickets()" 
                                class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-[#0047FF] to-[#FF5C00] hover:from-[#0B57FF] hover:to-[#FF6B00] text-white rounded-2xl font-bold text-base transition-all duration-300 transform hover:scale-[1.02] shadow-[0_0_20px_rgba(0,71,255,0.3)] hover:shadow-[0_0_30px_rgba(255,92,0,0.5)]">
                            Pesan Tiket Sekarang
                        </button>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-[#081224]/40 border border-[#0047FF]/10 rounded-[24px] p-6 sm:p-8 backdrop-blur-sm shadow-[0_10px_30px_rgba(0,0,0,0.2)]">
                    <h2 class="text-xl md:text-2xl font-bold text-white mb-4">Tentang Konser</h2>
                    <p class="text-[#D1D5DB] leading-relaxed text-sm md:text-base font-normal">
                        {{ $concert->deskripsi }}
                    </p>
                </div>

                <!-- Ticket Categories Selection -->
                <div id="tickets" class="space-y-6">
                    <h2 class="text-2xl font-bold text-white">Pilih Kategori Tiket</h2>
                    
                    @if($ticketCategories->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($ticketCategories as $category)
                                @php
                                    $isVip = str_contains(strtolower($category->nama_kategori), 'vip');
                                    $isFestival = str_contains(strtolower($category->nama_kategori), 'festival');
                                @endphp
                                <div class="ticket-card bg-[#0B1730]/60 border border-[#0047FF]/20 hover:border-[#FF5C00] rounded-3xl p-6 transition-all duration-300 relative group flex flex-col justify-between hover:shadow-[0_10px_30px_rgba(0,71,255,0.15)] cursor-pointer"
                                     data-category-id="{{ $category->id }}"
                                     data-category-name="{{ $category->nama_kategori }}"
                                     data-price="{{ $category->harga }}"
                                     data-quota="{{ $category->sisa_kuota }}"
                                     onclick="selectCategoryCard(this)">
                                    
                                    <!-- Glow Accent -->
                                    <div class="absolute inset-0 bg-gradient-to-br @if($isVip) from-[#FF5C00]/10 to-transparent @elseif($isFestival) from-[#0047FF]/10 to-transparent @else from-[#0047FF]/5 to-transparent @endif rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                                    
                                    <div>
                                        <!-- Header -->
                                        <div class="flex justify-between items-start mb-4 relative z-10">
                                            <h3 class="text-xl font-bold text-white">{{ $category->nama_kategori }}</h3>
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider @if($category->sisa_kuota < 30) bg-rose-500/10 text-rose-400 border border-rose-500/20 @else bg-[#0047FF]/10 text-[#0047FF] border border-[#0047FF]/20 @endif">
                                                {{ $category->sisa_kuota }} Tiket Tersisa
                                            </span>
                                        </div>

                                        <!-- Price -->
                                        <p class="text-2xl font-extrabold @if($isVip) text-[#FF5C00] @else text-[#0047FF] @endif mb-4 relative z-10">
                                            Rp {{ number_format($category->harga, 0, ',', '.') }}
                                        </p>

                                        <!-- Facilities -->
                                        <ul class="space-y-2.5 text-xs text-[#94A3B8] mb-8 border-t border-white/5 pt-4 relative z-10">
                                            @if($isVip)
                                                <li class="flex items-center gap-2 text-[#D1D5DB]">
                                                    <svg class="w-4 h-4 text-[#FF5C00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>Free Merchandise</span>
                                                </li>
                                                <li class="flex items-center gap-2 text-[#D1D5DB]">
                                                    <svg class="w-4 h-4 text-[#FF5C00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>Fast Track Entry</span>
                                                </li>
                                                <li class="flex items-center gap-2 text-[#D1D5DB]">
                                                    <svg class="w-4 h-4 text-[#FF5C00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>Exclusive VIP Seat</span>
                                                </li>
                                            @elseif($isFestival)
                                                <li class="flex items-center gap-2 text-[#D1D5DB]">
                                                    <svg class="w-4 h-4 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>Festival Standing Area</span>
                                                </li>
                                                <li class="flex items-center gap-2 text-[#D1D5DB]">
                                                    <svg class="w-4 h-4 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>Free Drink Voucher</span>
                                                </li>
                                                <li class="flex items-center gap-2 text-[#94A3B8] pl-1">
                                                    <div class="w-1.5 h-1.5 rounded-full bg-white/20 mr-1.5"></div>
                                                    <span>Standard Entry</span>
                                                </li>
                                            @else
                                                <li class="flex items-center gap-2 text-[#D1D5DB]">
                                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>General Admission</span>
                                                </li>
                                                <li class="flex items-center gap-2 text-[#94A3B8] pl-1">
                                                    <div class="w-1.5 h-1.5 rounded-full bg-white/20 mr-1.5"></div>
                                                    <span>Standing/Seating Pass</span>
                                                </li>
                                                <li class="flex items-center gap-2 text-[#94A3B8] pl-1">
                                                    <div class="w-1.5 h-1.5 rounded-full bg-white/20 mr-1.5"></div>
                                                    <span>Standard Entry</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                    <!-- Action / Quantity Controls -->
                                    <div class="mt-auto border-t border-white/5 pt-4 flex items-center justify-between relative z-10" onclick="event.stopPropagation()">
                                        <div class="flex items-center gap-2">
                                            <button onclick="decreaseQty(this)" class="w-8 h-8 rounded-lg bg-[#0B1730] border border-white/10 hover:border-[#0047FF] text-white font-bold transition flex items-center justify-center text-sm">−</button>
                                            <input type="number" value="1" min="1" max="{{ $category->sisa_kuota }}" 
                                                   class="w-10 text-center bg-[#050816] border border-white/10 text-white text-xs py-1.5 rounded-lg focus:outline-none" readonly>
                                            <button onclick="increaseQty(this)" class="w-8 h-8 rounded-lg bg-[#0B1730] border border-white/10 hover:border-[#0047FF] text-white font-bold transition flex items-center justify-center text-sm">+</button>
                                        </div>
                                        
                                        <button onclick="selectAndAddToCart(this)" 
                                                class="px-3 py-2 bg-[#0047FF]/10 text-[#0047FF] hover:bg-[#0047FF] hover:text-white border border-[#0047FF]/30 rounded-xl text-xs font-bold transition duration-300">
                                            Pilih Kategori
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-rose-500/10 border border-rose-500/20 rounded-2xl p-6 text-center">
                            <p class="text-rose-400 font-semibold text-base">Tiket untuk konser ini telah habis terjual.</p>
                        </div>
                    @endif
                </div>

                <!-- Event Gallery -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-white">Event Gallery</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div class="rounded-[24px] overflow-hidden aspect-[16/10] bg-[#0B1730] border border-white/5 shadow-soft">
                            <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=600&auto=format&fit=crop" alt="Gallery 1" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                        </div>
                        <div class="rounded-[24px] overflow-hidden aspect-[16/10] bg-[#0B1730] border border-white/5 shadow-soft">
                            <img src="https://images.unsplash.com/photo-1459749411175-04bf5292ceea?q=80&w=600&auto=format&fit=crop" alt="Gallery 2" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                        </div>
                        <div class="rounded-[24px] overflow-hidden aspect-[16/10] bg-[#0B1730] border border-white/5 shadow-soft">
                            <img src="https://images.unsplash.com/photo-1484807352052-23338990c6c6?q=80&w=600&auto=format&fit=crop" alt="Gallery 3" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                        </div>
                    </div>
                </div>

                <!-- Venue Map Location -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-white">Lokasi Venue</h2>
                    <div class="rounded-[24px] overflow-hidden shadow-[0_0_30px_rgba(0,71,255,0.1)] h-80 border border-[#0047FF]/20">
                        <iframe src="{{ $mapsUrl }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Price Summary -->
            <div class="lg:col-span-1">
                <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 sm:p-8 sticky top-28 space-y-6 shadow-[0_15px_40px_rgba(0,71,255,0.1)] backdrop-blur-md">
                    <h3 class="text-lg font-bold text-white border-b border-white/5 pb-4">Ringkasan Pemesanan</h3>
                    
                    <div class="space-y-4">
                        <div id="summary-items" class="space-y-3"></div>
                        <div id="empty-summary" class="text-center py-6 text-[#94A3B8] text-sm">
                            Pilih salah satu kategori tiket di sebelah kiri.
                        </div>
                    </div>

                    <div class="space-y-3 text-xs text-[#94A3B8] border-t border-white/5 pt-4">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span class="font-bold text-white text-sm" id="subtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Layanan:</span>
                            <span class="font-bold text-white text-sm" id="service-fee">Rp 0</span>
                        </div>
                        <div class="flex justify-between pt-3 border-t border-white/5 text-sm font-extrabold text-white">
                            <span>Total Pembayaran:</span>
                            <span class="text-xl font-extrabold text-[#FF5C00]" id="total">Rp 0</span>
                        </div>
                    </div>

                    <!-- Cart button & Checkout button -->
                    <div class="space-y-3 pt-4">
                        <button id="add-to-cart-btn" onclick="addToCart()" disabled
                                class="w-full px-4 py-3 bg-[#0047FF] hover:bg-[#0B57FF] text-white rounded-xl font-bold text-sm transition-all duration-300 disabled:opacity-30 disabled:cursor-not-allowed text-center flex items-center justify-center gap-2 shadow-[0_0_15px_rgba(0,71,255,0.2)]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Tambah ke Keranjang
                        </button>
                        
                        <button id="checkout-btn" onclick="goToCheckout()" disabled
                                class="w-full px-4 py-3.5 bg-gradient-to-r from-[#0047FF] to-[#FF5C00] hover:from-[#0B57FF] hover:to-[#FF6B00] text-white rounded-xl font-bold text-sm transition-all duration-300 disabled:opacity-30 disabled:cursor-not-allowed text-center hover:shadow-[0_0_20px_rgba(255,92,0,0.4)]">
                            Lanjutkan Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedItems = [];

function selectCategoryCard(card) {
    // Remove active style from all ticket cards
    document.querySelectorAll('.ticket-card').forEach(c => {
        c.classList.remove('border-[#0047FF]', 'bg-[#0047FF]/5', 'border-[#FF5C00]', 'bg-[#FF5C00]/5');
        c.classList.add('border-[#0047FF]/20', 'bg-[#0B1730]/60');
        const selectBtn = c.querySelector('button[onclick*="selectAndAddToCart"]');
        if (selectBtn) {
            selectBtn.textContent = 'Pilih Kategori';
            selectBtn.classList.remove('bg-[#FF5C00]', 'bg-[#0047FF]', 'text-white');
            selectBtn.classList.add('bg-[#0047FF]/10', 'text-[#0047FF]');
        }
    });

    // Add active style to selected card
    card.classList.remove('border-[#0047FF]/20', 'bg-[#0B1730]/60');
    card.classList.add('border-[#0047FF]', 'bg-[#0047FF]/5');
    
    const selectBtn = card.querySelector('button[onclick*="selectAndAddToCart"]');
    if (selectBtn) {
        selectBtn.textContent = 'Terpilih';
        selectBtn.classList.remove('bg-[#0047FF]/10', 'text-[#0047FF]');
        selectBtn.classList.add('bg-[#0047FF]', 'text-white');
    }

    updateSummary();
}

function selectAndAddToCart(btn) {
    const card = btn.closest('.ticket-card');
    selectCategoryCard(card);
}

function increaseQty(btn) {
    const input = btn.previousElementSibling;
    const max = input.max;
    if (parseInt(input.value) < parseInt(max)) {
        input.value = parseInt(input.value) + 1;
        
        // Auto-select card when altering quantity
        const card = btn.closest('.ticket-card');
        selectCategoryCard(card);
    }
}

function decreaseQty(btn) {
    const input = btn.nextElementSibling;
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        
        // Auto-select card when altering quantity
        const card = btn.closest('.ticket-card');
        selectCategoryCard(card);
    }
}

function updateSummary() {
    let subtotal = 0;
    selectedItems = [];

    // Find the active selected card (which has border-[#0047FF])
    const activeCard = document.querySelector('.ticket-card.border-\\[\\#0047FF\\]');
    
    if (activeCard) {
        const qty = parseInt(activeCard.querySelector('input[type="number"]').value);
        if (qty > 0) {
            const categoryId = activeCard.dataset.categoryId;
            const categoryName = activeCard.dataset.categoryName;
            const price = parseInt(activeCard.dataset.price);
            const subtotal_item = price * qty;

            selectedItems.push({
                kategori_tiket_id: categoryId,
                kategori_nama: categoryName,
                harga_satuan: price,
                jumlah_tiket: qty,
                subtotal: subtotal_item
            });

            subtotal += subtotal_item;
        }
    }

    // Update display
    if (selectedItems.length === 0) {
        document.getElementById('summary-items').innerHTML = '';
        document.getElementById('empty-summary').style.display = 'block';
        
        document.getElementById('subtotal').textContent = 'Rp 0';
        document.getElementById('service-fee').textContent = 'Rp 0';
        document.getElementById('total').textContent = 'Rp 0';

        document.getElementById('add-to-cart-btn').disabled = true;
        document.getElementById('checkout-btn').disabled = true;
    } else {
        document.getElementById('empty-summary').style.display = 'none';
        document.getElementById('summary-items').innerHTML = selectedItems.map(item => `
            <div class="flex justify-between text-sm items-center bg-[#0B1730]/80 p-3.5 border border-white/5 rounded-2xl">
                <div>
                    <p class="font-bold text-white">${item.kategori_nama}</p>
                    <p class="text-xs text-[#94A3B8]">${item.jumlah_tiket} tiket × Rp ${item.harga_satuan.toLocaleString('id-ID')}</p>
                </div>
                <span class="font-bold text-white text-sm">Rp ${item.subtotal.toLocaleString('id-ID')}</span>
            </div>
        `).join('');

        const serviceFee = 3000;
        const total = subtotal + serviceFee;

        document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
        document.getElementById('service-fee').textContent = 'Rp ' + serviceFee.toLocaleString('id-ID');
        document.getElementById('total').textContent = 'Rp ' + total.toLocaleString('id-ID');

        document.getElementById('add-to-cart-btn').disabled = false;
        document.getElementById('checkout-btn').disabled = false;
    }
}

function addToCart() {
    if (selectedItems.length === 0) {
        alert('Pilih tiket terlebih dahulu');
        return;
    }

    const item = selectedItems[0];
    const cartBtn = document.getElementById('add-to-cart-btn');
    cartBtn.disabled = true;
    cartBtn.innerHTML = '<svg class="w-4 h-4 animate-spin mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Menambahkan...';
    
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            konser_id: {{ $concert->id }},
            kategori_tiket_id: item.kategori_tiket_id,
            jumlah_tiket: item.jumlah_tiket
        })
    })
    .then(res => res.json())
    .then(data => {
        cartBtn.disabled = false;
        cartBtn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>Tambah ke Keranjang';
        
        if (data.success) {
            alert(data.message);
            window.location.reload();
        } else {
            alert('Gagal: ' + data.message);
        }
    })
    .catch(err => {
        cartBtn.disabled = false;
        cartBtn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>Tambah ke Keranjang';
        alert('Terjadi kesalahan: ' + err.message);
    });
}

function goToCheckout() {
    if (selectedItems.length === 0) {
        alert('Pilih tiket terlebih dahulu');
        return;
    }
    
    if (!{{ Auth::check() ? 'true' : 'false' }}) {
        window.location.href = '{{ route("login") }}';
        return;
    }

    const item = selectedItems[0];
    
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            konser_id: {{ $concert->id }},
            kategori_tiket_id: item.kategori_tiket_id,
            jumlah_tiket: item.jumlah_tiket
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.href = '{{ route("checkout") }}';
        } else {
            alert('Gagal memproses checkout: ' + data.message);
        }
    })
    .catch(err => alert('Terjadi kesalahan: ' + err.message));
}

function scrollToTickets() {
    document.getElementById('tickets').scrollIntoView({ behavior: 'smooth' });
}

// Initialize summary
updateSummary();
</script>
@endsection
