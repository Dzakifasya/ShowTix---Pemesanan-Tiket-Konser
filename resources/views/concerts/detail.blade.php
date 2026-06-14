@extends('layouts.app')

@section('title', 'Detail Konser - ShowTix')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-50 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-[#003D82] transition">Home</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800">{{ $konser->nama_konser ?? 'Detail Konser' }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Image Section -->
            <div class="mb-8">
                @if($konser->poster)
                    <img src="{{ asset('storage/' . $konser->poster) }}" alt="{{ $konser->nama_konser }}" class="w-full h-96 object-cover rounded-2xl shadow-xl">
                @else
                    <div class="w-full h-96 bg-gradient-to-br from-[#003D82] to-[#FF6600] rounded-2xl flex items-center justify-center">
                        <i class="fas fa-music text-white text-8xl"></i>
                    </div>
                @endif
            </div>

            <!-- Concert Details -->
            <div class="mb-8">
                <h1 class="font-display font-bold text-4xl text-gray-800 mb-4">{{ $konser->nama_konser }}</h1>
                
                <!-- Artists -->
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-700 mb-2">Artis Penampil:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($konser->artis as $artis)
                            <div class="flex items-center gap-2 bg-gradient-to-r from-[#003D82] to-[#0052a3] text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-star"></i>
                                <span class="font-semibold">{{ $artis->nama_artis }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                    <!-- Date -->
                    <div class="bg-blue-50 border-2 border-[#003D82] rounded-xl p-4">
                        <h4 class="text-sm text-gray-600 mb-1">Tanggal Konser</h4>
                        <p class="font-bold text-lg text-[#003D82] flex items-center gap-2">
                            <i class="fas fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($konser->tanggal_konser)->format('d M Y') }}
                        </p>
                    </div>

                    <!-- Time -->
                    <div class="bg-orange-50 border-2 border-[#FF6600] rounded-xl p-4">
                        <h4 class="text-sm text-gray-600 mb-1">Jam Mulai</h4>
                        <p class="font-bold text-lg text-[#FF6600] flex items-center gap-2">
                            <i class="fas fa-clock"></i>
                            {{ \Carbon\Carbon::parse($konser->waktu_konser)->format('H:i') }} WIB
                        </p>
                    </div>

                    <!-- Location -->
                    <div class="bg-blue-50 border-2 border-[#003D82] rounded-xl p-4">
                        <h4 class="text-sm text-gray-600 mb-1">Lokasi</h4>
                        <p class="font-bold text-[#003D82] flex items-center gap-2">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $konser->lokasi }}
                        </p>
                    </div>

                    <!-- Status -->
                    <div class="bg-orange-50 border-2 border-[#FF6600] rounded-xl p-4">
                        <h4 class="text-sm text-gray-600 mb-1">Status</h4>
                        @if($konser->status_konser == 'aktif')
                            <p class="font-bold text-lg text-[#FF6600] flex items-center gap-2">
                                <i class="fas fa-check-circle"></i> Penjualan Aktif
                            </p>
                        @else
                            <p class="font-bold text-lg text-red-500 flex items-center gap-2">
                                <i class="fas fa-ban"></i> Tidak Aktif
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
                    <h3 class="font-semibold text-lg text-gray-800 mb-4">Tentang Konser</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $konser->deskripsi }}</p>
                </div>

                <!-- Ticket Categories -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="font-semibold text-lg text-gray-800 mb-6">Pilih Kategori Tiket</h3>

                    @if($konser->kategoriTiket->count() > 0)
                        <div class="space-y-4">
                            @foreach($konser->kategoriTiket as $kategori)
                                <div class="ticket-option border-2 border-gray-200 hover:border-[#003D82] rounded-xl p-4 cursor-pointer transition-all duration-300 flex items-center justify-between hover:shadow-lg" onclick="selectTicket('{{ $kategori->id }}', '{{ $kategori->nama_kategori }}', '{{ $kategori->harga }}', '{{ $kategori->sisa_kuota }}')">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-lg text-gray-800 mb-1">{{ $kategori->nama_kategori }}</h4>
                                        <p class="text-sm text-gray-600 mb-2">{{ $kategori->deskripsi }}</p>
                                        <div class="flex gap-4 text-sm">
                                            <span class="text-gray-600">
                                                <i class="fas fa-tag text-[#FF6600] mr-1"></i>
                                                Rp {{ number_format($kategori->harga, 0, ',', '.') }} per tiket
                                            </span>
                                            <span class="font-semibold" :class="{ 'text-green-600': {{ $kategori->sisa_kuota }} > 0, 'text-red-600': {{ $kategori->sisa_kuota }} == 0 }">
                                                <i class="fas fa-ticket-alt text-[#003D82] mr-1"></i>
                                                {{ $kategori->sisa_kuota }} Tiket Tersisa
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <input 
                                            type="radio" 
                                            name="kategori_tiket" 
                                            value="{{ $kategori->id }}" 
                                            class="w-6 h-6 text-[#003D82] cursor-pointer"
                                            {{ $loop->first ? 'checked' : '' }}
                                        >
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-ban text-gray-300 text-4xl mb-3"></i>
                            <p class="text-gray-600">Tidak ada tiket yang tersedia untuk konser ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar - Booking Form -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-xl p-6 sticky top-24 border-2 border-[#003D82]">
                <h3 class="font-display font-bold text-2xl text-gray-800 mb-6">Pesan Tiket</h3>

                <form id="bookingForm" action="{{ route('cart.add') }}" method="POST" class="space-y-6">
                    @csrf

                    <input type="hidden" name="konser_id" value="{{ $konser->id }}">
                    <input type="hidden" name="kategori_tiket_id" id="selectedKategoriId" value="">
                    <input type="hidden" name="harga_satuan" id="selectedHarga" value="">

                    <!-- Quantity Input -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Jumlah Tiket</label>
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button type="button" onclick="decreaseQty()" class="px-4 py-2 text-[#003D82] hover:bg-blue-50 transition">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input 
                                type="number" 
                                id="quantity" 
                                name="jumlah_tiket" 
                                value="1" 
                                min="1" 
                                class="flex-1 px-4 py-2 text-center border-0 focus:outline-none font-semibold text-lg"
                                onchange="updateTotal()"
                            >
                            <button type="button" onclick="increaseQty()" class="px-4 py-2 text-[#003D82] hover:bg-blue-50 transition">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200"></div>

                    <!-- Price Summary -->
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Harga per Tiket</span>
                            <span id="unitPrice">Rp -</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span id="qtyLabel">1 Tiket</span>
                            <span id="totalPrice">Rp -</span>
                        </div>
                        <div class="border-t border-gray-200"></div>
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total</span>
                            <span id="grandTotal" class="text-[#FF6600]">Rp -</span>
                        </div>
                    </div>

                    <!-- Booking Buttons -->
                    @auth
                        <button type="submit" class="w-full bg-gradient-to-r from-[#FF6600] to-[#ff8533] text-white font-bold py-3 rounded-lg transition-all duration-300 hover:shadow-lg hover:scale-105" id="bookBtn">
                            <i class="fas fa-shopping-cart mr-2"></i> Tambah ke Keranjang
                        </button>
                        <button type="button" onclick="likeEvent()" class="w-full border-2 border-[#FF6600] text-[#FF6600] font-bold py-2 rounded-lg transition-all duration-300 hover:bg-orange-50 flex items-center justify-center gap-2">
                            <i class="fas fa-heart"></i> Simpan Konser
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="w-full block text-center bg-gradient-to-r from-[#003D82] to-[#0052a3] text-white font-bold py-3 rounded-lg transition-all duration-300 hover:shadow-lg">
                            <i class="fas fa-lock mr-2"></i> Login untuk Memesan
                        </a>
                    @endauth

                    <!-- Important Info -->
                    <div class="bg-blue-50 border-l-4 border-[#003D82] p-4 rounded">
                        <p class="text-sm text-gray-700">
                            <i class="fas fa-info-circle text-[#003D82] mr-2"></i>
                            <strong>Informasi Penting:</strong><br>
                            Tiket digital akan dikirim ke email Anda setelah pembayaran dikonfirmasi.
                        </p>
                    </div>
                </form>
            </div>

            <!-- Trust Badges -->
            <div class="mt-6 space-y-3">
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded flex items-start gap-3">
                    <i class="fas fa-shield-alt text-green-500 text-xl flex-shrink-0 mt-1"></i>
                    <div>
                        <p class="font-semibold text-green-700">Pembayaran Aman</p>
                        <p class="text-xs text-gray-600">Semua transaksi terenkripsi</p>
                    </div>
                </div>
                <div class="bg-blue-50 border-l-4 border-[#003D82] p-4 rounded flex items-start gap-3">
                    <i class="fas fa-check-circle text-[#003D82] text-xl flex-shrink-0 mt-1"></i>
                    <div>
                        <p class="font-semibold text-[#003D82]">Tiket Resmi</p>
                        <p class="text-xs text-gray-600">Dijamin keasliannya</p>
                    </div>
                </div>
                <div class="bg-orange-50 border-l-4 border-[#FF6600] p-4 rounded flex items-start gap-3">
                    <i class="fas fa-headset text-[#FF6600] text-xl flex-shrink-0 mt-1"></i>
                    <div>
                        <p class="font-semibold text-[#FF6600]">Customer Support</p>
                        <p class="text-xs text-gray-600">24/7 siap membantu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    function decreaseQty() {
        const qty = document.getElementById('quantity');
        if (qty.value > 1) {
            qty.value = parseInt(qty.value) - 1;
            updateTotal();
        }
    }

    function increaseQty() {
        const selectedKategori = document.querySelector('input[name="kategori_tiket"]:checked');
        if (!selectedKategori) {
            alert('Pilih kategori tiket terlebih dahulu');
            return;
        }

        const maxQty = parseInt(selectedKategori.parentElement.parentElement.querySelector('span').textContent.match(/\d+/)[0]);
        const qty = document.getElementById('quantity');
        
        if (qty.value < maxQty) {
            qty.value = parseInt(qty.value) + 1;
            updateTotal();
        } else {
            alert('Jumlah tiket melebihi kuota yang tersedia');
        }
    }

    function selectTicket(kategoriId, kategoriNama, harga, sisaKuota) {
        document.getElementById('selectedKategoriId').value = kategoriId;
        document.getElementById('selectedHarga').value = harga;
        document.getElementById('quantity').value = 1;
        document.getElementById('quantity').max = sisaKuota;
        
        // Uncheck all and check the selected one
        document.querySelectorAll('input[name="kategori_tiket"]').forEach(radio => {
            radio.checked = false;
        });
        document.querySelector(`input[value="${kategoriId}"]`).checked = true;

        updateTotal();
    }

    function updateTotal() {
        const harga = parseFloat(document.getElementById('selectedHarga').value) || 0;
        const qty = parseInt(document.getElementById('quantity').value) || 1;
        const total = harga * qty;

        document.getElementById('unitPrice').textContent = 'Rp ' + (harga > 0 ? new Intl.NumberFormat('id-ID').format(Math.floor(harga)) : '-');
        document.getElementById('totalPrice').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.floor(total));
        document.getElementById('qtyLabel').textContent = qty + ' Tiket';
        document.getElementById('grandTotal').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.floor(total));
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const firstRadio = document.querySelector('input[name="kategori_tiket"]:checked');
        if (firstRadio) {
            // Extract info from the parent card
            const card = firstRadio.closest('.ticket-option');
            const harga = firstRadio.value; // We need to extract harga differently
            // For now, just update the total
            updateTotal();
        }
    });

    // Like/Save event
    function likeEvent() {
        const btn = event.target.closest('button');
        const icon = btn.querySelector('i');
        
        if (icon.classList.contains('fa-heart')) {
            // Already liked
            icon.classList.remove('fa-heart');
            icon.classList.add('fa-heart');
            btn.classList.add('bg-red-100');
            btn.classList.remove('text-[#FF6600]');
            btn.classList.add('text-red-600');
            btn.style.borderColor = '#dc2626';
            alert('Konser ditambahkan ke daftar favorit!');
        }
    }

    // Form submission
    document.getElementById('bookingForm')?.addEventListener('submit', function(e) {
        if (!document.getElementById('selectedKategoriId').value) {
            e.preventDefault();
            alert('Pilih kategori tiket terlebih dahulu');
            return;
        }
    });
</script>
@endpush
