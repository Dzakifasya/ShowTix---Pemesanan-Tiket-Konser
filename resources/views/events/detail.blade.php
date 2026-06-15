@extends('layouts.app')

@section('title')
{{ $concert->nama_konser }} - ShowTix
@endsection

@section('content')
<!-- Breadcrumb -->
<div class="bg-background border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center space-x-2 text-sm">
            <a href="{{ route('home') }}" class="text-secondary-900 hover:underline">Beranda</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="#" class="text-secondary-900 hover:underline">Event</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-600">{{ $concert->nama_konser }}</span>
        </div>
    </div>
</div>

<div class="py-8 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Event Header -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Poster -->
                    <img src="{{ $concert->poster ? asset('storage/' . $concert->poster) : asset('images/placeholder.jpg') }}" 
                         alt="{{ $concert->nama_konser }}" 
                         class="w-full h-auto rounded-2xl shadow-lg object-cover">
                    
                    <!-- Event Info -->
                    <div class="md:col-span-2 space-y-4">
                        <h1 class="text-4xl font-bold text-primary-900">{{ $concert->nama_konser }}</h1>
                        
                        <!-- Artists -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-600 mb-2">ARTIS PERFORM</h3>
                            <p class="text-lg text-gray-800">{{ $artists->pluck('nama_artis')->implode(', ') }}</p>
                        </div>

                        <!-- Event Details Grid -->
                        <div class="grid grid-cols-2 gap-4 bg-background rounded-xl p-4">
                            <div>
                                <p class="text-xs text-gray-600 font-semibold">TANGGAL</p>
                                <p class="text-lg font-bold text-primary-900">{{ $concert->tanggal_konser->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 font-semibold">WAKTU</p>
                                <p class="text-lg font-bold text-primary-900">{{ $concert->waktu_konser?->format('H:i') ?? 'Belum ditentukan' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 font-semibold">LOKASI</p>
                                <p class="text-lg font-bold text-primary-900">{{ $concert->lokasi }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 font-semibold">HARGA MULAI</p>
                                <p class="text-lg font-bold text-secondary-900">Rp {{ number_format($ticketCategories->min('harga'), 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <button onclick="scrollToTickets()" class="w-full px-6 py-3 bg-[#FF6600] text-white rounded-lg hover:bg-orange-600 transition-colors font-semibold text-lg">
                            Pesan Tiket
                        </button>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <h2 class="text-2xl font-bold text-primary-900 mb-4">Tentang Event</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $concert->deskripsi }}</p>
                </div>

                <!-- Map -->
                <div>
                    <h2 class="text-2xl font-bold text-primary-900 mb-4">Lokasi</h2>
                    <div class="rounded-2xl overflow-hidden shadow-lg h-96">
                        <iframe src="{{ $mapsUrl }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <!-- Ticket Categories -->
                <div id="tickets">
                    <h2 class="text-2xl font-bold text-primary-900 mb-4">Pilih Kategori Tiket</h2>
                    
                    @if($ticketCategories->count() > 0)
                        <div class="space-y-3">
                            @foreach($ticketCategories as $category)
                                <div class="ticket-card bg-background rounded-lg p-6 border-2 border-gray-200 hover:border-secondary-900 transition-colors cursor-pointer"
                                     data-category-id="{{ $category->id }}"
                                     data-category-name="{{ $category->nama_kategori }}"
                                     data-price="{{ $category->harga }}"
                                     data-quota="{{ $category->sisa_kuota }}">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="text-lg font-bold text-primary-900">{{ $category->nama_kategori }}</h3>
                                            @if($category->deskripsi)
                                                <p class="text-sm text-gray-600 mt-1">{{ $category->deskripsi }}</p>
                                            @endif
                                        </div>
                                        <span class="px-3 py-1 bg-secondary-900 text-white rounded-full text-sm font-semibold">
                                            {{ $category->sisa_kuota }} Tersedia
                                        </span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center space-x-2">
                                            <button onclick="decreaseQty(this)" class="w-8 h-8 border border-gray-300 rounded hover:bg-gray-100">−</button>
                                            <input type="number" value="1" min="1" max="{{ $category->sisa_kuota }}" 
                                                   class="w-12 text-center border border-gray-300 rounded py-1" readonly>
                                            <button onclick="increaseQty(this)" class="w-8 h-8 border border-gray-300 rounded hover:bg-gray-100">+</button>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs text-gray-600">Harga satuan</p>
                                            <p class="text-2xl font-bold text-secondary-900">Rp {{ number_format($category->harga, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Add to Cart Button -->
                        <button onclick="addToCart()" class="w-full mt-6 px-6 py-4 bg-[#003D82] text-white rounded-lg hover:bg-blue-800 transition-colors font-semibold text-lg">
                            <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Tambah ke Keranjang
                        </button>
                    @else
                        <div class="bg-red-50 border border-red-200 rounded-lg p-6 text-center">
                            <p class="text-red-800 font-semibold">Tiket untuk event ini telah habis terjual</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar - Price Summary -->
            <div class="lg:col-span-1">
                <div class="bg-background rounded-2xl p-6 sticky top-24 space-y-4">
                    <h3 class="text-lg font-bold text-primary-900">Ringkasan</h3>
                    
                    <div class="space-y-3 pb-4 border-b border-gray-200">
                        <div id="summary-items"></div>
                        <div id="empty-summary" class="text-center py-4 text-gray-600">
                            Pilih tiket untuk melihat ringkasan
                        </div>
                    </div>

                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-semibold text-gray-900" id="subtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Biaya layanan:</span>
                            <span class="font-semibold text-gray-900" id="service-fee">Rp 0</span>
                        </div>
                        <div class="flex justify-between pt-2 border-t border-gray-200 text-base font-bold text-primary-900">
                            <span>Total:</span>
                            <span id="total">Rp 0</span>
                        </div>
                    </div>

                    <button id="checkout-btn" onclick="goToCheckout()" disabled
                            class="w-full mt-4 px-4 py-3 bg-[#FF6600] text-white rounded-lg hover:bg-orange-600 transition-colors font-semibold disabled:opacity-50 disabled:cursor-not-allowed text-center">
                        Lanjutkan Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedItems = [];

function getSelectedCategory() {
    return document.querySelector('.ticket-card');
}

function increaseQty(btn) {
    const input = btn.previousElementSibling;
    const max = input.max;
    if (parseInt(input.value) < parseInt(max)) {
        input.value = parseInt(input.value) + 1;
        updateSummary();
    }
}

function decreaseQty(btn) {
    const input = btn.nextElementSibling;
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        updateSummary();
    }
}

function updateSummary() {
    let subtotal = 0;
    selectedItems = [];

    document.querySelectorAll('.ticket-card').forEach(card => {
        const qty = parseInt(card.querySelector('input[type="number"]').value);
        if (qty > 0) {
            const categoryId = card.dataset.categoryId;
            const categoryName = card.dataset.categoryName;
            const price = parseInt(card.dataset.price);
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
    });

    // Update display
    if (selectedItems.length === 0) {
        document.getElementById('summary-items').innerHTML = '';
        document.getElementById('empty-summary').style.display = 'block';
    } else {
        document.getElementById('empty-summary').style.display = 'none';
        document.getElementById('summary-items').innerHTML = selectedItems.map(item => `
            <div class="flex justify-between text-sm">
                <span>${item.jumlah_tiket}x ${item.kategori_nama}</span>
                <span class="font-semibold">Rp ${item.subtotal.toLocaleString('id-ID')}</span>
            </div>
        `).join('');
    }

    const serviceFee = 3000;
    const total = subtotal + serviceFee;

    document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    document.getElementById('service-fee').textContent = 'Rp ' + serviceFee.toLocaleString('id-ID');
    document.getElementById('total').textContent = 'Rp ' + total.toLocaleString('id-ID');

    document.getElementById('checkout-btn').disabled = selectedItems.length === 0;
}

function addToCart() {
    if (selectedItems.length === 0) {
        alert('Pilih tiket terlebih dahulu');
        return;
    }

    const item = selectedItems[0];
    
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
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
            alert(data.message);
            updateCartCount(data.cart_count);
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(err => alert('Terjadi kesalahan: ' + err.message));
}

function goToCheckout() {
    if (selectedItems.length === 0 || !{{ Auth::check() ? 'true' : 'false' }}) {
        window.location.href = '{{ route("login") }}';
        return;
    }
    window.location.href = '{{ route("checkout") }}';
}

function scrollToTickets() {
    document.getElementById('tickets').scrollIntoView({ behavior: 'smooth' });
}

function updateCartCount(count) {
    const badge = document.querySelector('[data-cart-count]');
    if (badge) badge.textContent = count;
}

// Initialize summary
updateSummary();
</script>
@endsection
