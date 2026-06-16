@extends('layouts.app')

@section('title')
Detail Konser - SHOWTIX
@endsection

@section('content')
<section class="relative overflow-hidden bg-gradient-to-b from-[#050816] via-[#081224] to-[#0B1730]">
    <div class="absolute inset-0 showtix-particles opacity-20 pointer-events-none"></div>
    <div class="absolute -top-32 left-10 w-96 h-96 rounded-full bg-[#0047FF]/20 blur-[120px] pointer-events-none"></div>
    <div class="absolute top-40 right-0 w-96 h-96 rounded-full bg-[#FF5C00]/14 blur-[130px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="flex items-center text-sm text-[#94A3B8] mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
            <span class="mx-2 text-[#0047FF]">/</span>
            <span class="text-white truncate">{{ $konser->nama_konser ?? 'Detail Konser' }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            <div class="lg:col-span-2 space-y-8">
                <div class="showtix-glass rounded-[2rem] p-4 sm:p-5">
                    <div class="relative overflow-hidden rounded-[24px] bg-[#0B1730] min-h-[24rem]">
                        @if($konser->poster)
                            <img src="{{ asset('storage/' . $konser->poster) }}" alt="{{ $konser->nama_konser }}" class="w-full h-[28rem] md:h-[34rem] object-cover">
                        @else
                            <div class="w-full h-[28rem] md:h-[34rem] showtix-gradient flex items-center justify-center">
                                <i class="fas fa-music text-white text-8xl"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#050816] via-[#050816]/20 to-transparent"></div>
                        <div class="absolute left-6 right-6 bottom-6">
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($konser->artis as $artis)
                                    <span class="inline-flex items-center gap-2 bg-[#081224]/80 border border-[#FF5C00]/30 text-[#FF7A00] px-4 py-2 rounded-full text-xs font-extrabold uppercase tracking-wider backdrop-blur-md">
                                        <i class="fas fa-star text-[10px]"></i>
                                        {{ $artis->nama_artis }}
                                    </span>
                                @endforeach
                            </div>
                            <h1 class="font-display font-extrabold text-3xl md:text-5xl text-white leading-tight">{{ $konser->nama_konser }}</h1>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="showtix-card rounded-3xl p-5 hover:border-[#FF5C00]/50 transition">
                        <p class="text-xs text-[#94A3B8] uppercase font-bold tracking-wider mb-2">Tanggal Konser</p>
                        <p class="font-extrabold text-lg text-white flex items-center gap-3">
                            <i class="fas fa-calendar-alt text-[#0047FF]"></i>
                            {{ \Carbon\Carbon::parse($konser->tanggal_konser)->format('d M Y') }}
                        </p>
                    </div>
                    <div class="showtix-card rounded-3xl p-5 hover:border-[#FF5C00]/50 transition">
                        <p class="text-xs text-[#94A3B8] uppercase font-bold tracking-wider mb-2">Jam Mulai</p>
                        <p class="font-extrabold text-lg text-white flex items-center gap-3">
                            <i class="fas fa-clock text-[#FF5C00]"></i>
                            {{ \Carbon\Carbon::parse($konser->waktu_konser)->format('H:i') }} WIB
                        </p>
                    </div>
                    <div class="showtix-card rounded-3xl p-5 hover:border-[#FF5C00]/50 transition">
                        <p class="text-xs text-[#94A3B8] uppercase font-bold tracking-wider mb-2">Lokasi</p>
                        <p class="font-extrabold text-white flex items-center gap-3">
                            <i class="fas fa-map-marker-alt text-[#0047FF]"></i>
                            {{ $konser->lokasi }}
                        </p>
                    </div>
                    <div class="showtix-card rounded-3xl p-5 hover:border-[#FF5C00]/50 transition">
                        <p class="text-xs text-[#94A3B8] uppercase font-bold tracking-wider mb-2">Status</p>
                        @if($konser->status_konser == 'aktif')
                            <p class="font-extrabold text-[#FF7A00] flex items-center gap-3">
                                <i class="fas fa-check-circle"></i> Penjualan Aktif
                            </p>
                        @else
                            <p class="font-extrabold text-red-500 flex items-center gap-3">
                                <i class="fas fa-ban"></i> Tidak Aktif
                            </p>
                        @endif
                    </div>
                </div>

                <div class="showtix-glass rounded-3xl p-6 sm:p-8">
                    <h2 class="font-display font-extrabold text-2xl text-white mb-4">Tentang Konser</h2>
                    <p class="text-[#D1D5DB] leading-relaxed">{{ $konser->deskripsi }}</p>
                </div>

                <div class="showtix-glass rounded-3xl p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-6">
                        <div>
                            <p class="text-xs text-[#FF5C00] uppercase font-extrabold tracking-widest mb-2">Ticket Category</p>
                            <h2 class="font-display font-extrabold text-2xl text-white">Pilih Kategori Tiket</h2>
                        </div>
                        <span class="text-xs text-[#94A3B8]">VIP, Regular, Festival tersedia mengikuti data event.</span>
                    </div>

                    @if($konser->kategoriTiket->count() > 0)
                        <div class="space-y-4">
                            @foreach($konser->kategoriTiket as $kategori)
                                <label class="ticket-option group block cursor-pointer rounded-3xl border border-[#0047FF]/20 bg-[#081224] p-5 transition duration-300 hover:border-[#FF5C00] hover:shadow-[0_0_28px_rgba(255,92,0,0.14)]"
                                       data-id="{{ $kategori->id }}"
                                       data-name="{{ $kategori->nama_kategori }}"
                                       data-price="{{ $kategori->harga }}"
                                       data-stock="{{ $kategori->sisa_kuota }}">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-2">
                                                <input type="radio" name="kategori_tiket" value="{{ $kategori->id }}" class="w-5 h-5 accent-[#0047FF]" {{ $loop->first ? 'checked' : '' }}>
                                                <h3 class="font-extrabold text-lg text-white group-hover:text-[#FF7A00] transition">{{ $kategori->nama_kategori }}</h3>
                                            </div>
                                            <p class="text-sm text-[#94A3B8] mb-3">{{ $kategori->deskripsi }}</p>
                                            <div class="flex flex-wrap gap-3 text-xs">
                                                <span class="inline-flex items-center gap-2 text-[#FF7A00] font-bold">
                                                    <i class="fas fa-tag"></i>
                                                    Rp {{ number_format($kategori->harga, 0, ',', '.') }} per tiket
                                                </span>
                                                <span class="inline-flex items-center gap-2 text-[#D1D5DB]">
                                                    <i class="fas fa-ticket-alt text-[#0047FF]"></i>
                                                    {{ $kategori->sisa_kuota }} Tiket Tersisa
                                                </span>
                                            </div>
                                        </div>
                                        @if($kategori->sisa_kuota > 0)
                                            <span class="bg-[#0047FF] text-white px-3 py-1 rounded-full text-[10px] font-extrabold uppercase">Available</span>
                                        @else
                                            <span class="bg-[#FF5C00] text-white px-3 py-1 rounded-full text-[10px] font-extrabold uppercase">Sold Out</span>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-10 border border-red-500/20 bg-red-500/10 rounded-3xl">
                            <i class="fas fa-ban text-red-500 text-4xl mb-3"></i>
                            <p class="text-[#D1D5DB]">Tidak ada tiket yang tersedia untuk konser ini.</p>
                        </div>
                    @endif
                </div>
            </div>

            <aside class="lg:col-span-1">
                <div class="showtix-glass rounded-3xl p-6 sticky top-28">
                    <h2 class="font-display font-extrabold text-2xl text-white mb-6">Pesan Tiket</h2>

                    <form id="bookingForm" action="{{ route('cart.add') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="konser_id" value="{{ $konser->id }}">
                        <input type="hidden" name="kategori_tiket_id" id="selectedKategoriId" value="">
                        <input type="hidden" name="harga_satuan" id="selectedHarga" value="">

                        <div>
                            <label class="block text-xs font-bold text-[#94A3B8] uppercase tracking-wider mb-3">Jumlah Tiket</label>
                            <div class="flex items-center bg-[#0B1730] border border-[#0047FF]/30 rounded-2xl overflow-hidden">
                                <button type="button" onclick="decreaseQty()" class="w-14 py-3 text-[#0047FF] hover:bg-[#0047FF]/10 transition">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" id="quantity" name="jumlah_tiket" value="1" min="1" class="flex-1 py-3 text-center bg-transparent border-0 focus:outline-none font-extrabold text-white" onchange="updateTotal()">
                                <button type="button" onclick="increaseQty()" class="w-14 py-3 text-[#FF5C00] hover:bg-[#FF5C00]/10 transition">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="space-y-3 rounded-3xl bg-[#0B1730]/70 border border-white/5 p-5">
                            <div class="flex justify-between text-sm text-[#94A3B8]">
                                <span>Harga per Tiket</span>
                                <span id="unitPrice" class="text-white font-bold">Rp -</span>
                            </div>
                            <div class="flex justify-between text-sm text-[#94A3B8]">
                                <span id="qtyLabel">1 Tiket</span>
                                <span id="totalPrice" class="text-white font-bold">Rp -</span>
                            </div>
                            <div class="border-t border-white/5 pt-3 flex justify-between font-extrabold text-white">
                                <span>Total</span>
                                <span id="grandTotal" class="text-[#FF7A00]">Rp -</span>
                            </div>
                        </div>

                        @auth
                            <button type="submit" class="showtix-button w-full font-extrabold py-4 rounded-2xl text-sm" id="bookBtn">
                                <i class="fas fa-shopping-cart mr-2"></i> Tambah ke Keranjang
                            </button>
                            <button type="button" onclick="likeEvent()" class="w-full border border-[#FF5C00]/40 text-[#FF7A00] font-bold py-3 rounded-2xl transition hover:bg-[#FF5C00]/10 flex items-center justify-center gap-2">
                                <i class="fas fa-heart"></i> Simpan Konser
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="showtix-button w-full block text-center font-extrabold py-4 rounded-2xl text-sm">
                                <i class="fas fa-lock mr-2"></i> Login untuk Memesan
                            </a>
                        @endauth

                        <div class="bg-[#0047FF]/10 border-l-4 border-[#0047FF] p-4 rounded-2xl">
                            <p class="text-sm text-[#D1D5DB]">
                                <i class="fas fa-info-circle text-[#0047FF] mr-2"></i>
                                Tiket digital akan dikirim ke email Anda setelah pembayaran dikonfirmasi.
                            </p>
                        </div>
                    </form>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-3">
                    <div class="showtix-card rounded-2xl p-4 flex items-start gap-3">
                        <i class="fas fa-shield-alt text-[#0047FF] text-xl mt-1"></i>
                        <div>
                            <p class="font-bold text-white">Pembayaran Aman</p>
                            <p class="text-xs text-[#94A3B8]">Semua transaksi terenkripsi</p>
                        </div>
                    </div>
                    <div class="showtix-card rounded-2xl p-4 flex items-start gap-3">
                        <i class="fas fa-headset text-[#FF5C00] text-xl mt-1"></i>
                        <div>
                            <p class="font-bold text-white">Customer Support</p>
                            <p class="text-xs text-[#94A3B8]">Siap membantu transaksi Anda</p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    function formatRupiah(value) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.floor(value || 0));
    }

    function selectedOption() {
        const checked = document.querySelector('input[name="kategori_tiket"]:checked');
        return checked ? checked.closest('.ticket-option') : null;
    }

    function syncSelectedTicket() {
        const option = selectedOption();
        if (!option) return;

        document.getElementById('selectedKategoriId').value = option.dataset.id;
        document.getElementById('selectedHarga').value = option.dataset.price;
        document.getElementById('quantity').max = option.dataset.stock;
        document.querySelectorAll('.ticket-option').forEach(card => card.classList.remove('border-[#FF5C00]', 'shadow-[0_0_28px_rgba(255,92,0,0.14)]'));
        option.classList.add('border-[#FF5C00]', 'shadow-[0_0_28px_rgba(255,92,0,0.14)]');
        updateTotal();
    }

    function decreaseQty() {
        const qty = document.getElementById('quantity');
        if (Number(qty.value) > 1) {
            qty.value = Number(qty.value) - 1;
            updateTotal();
        }
    }

    function increaseQty() {
        const option = selectedOption();
        if (!option) {
            alert('Pilih kategori tiket terlebih dahulu');
            return;
        }

        const maxQty = Number(option.dataset.stock || 1);
        const qty = document.getElementById('quantity');
        if (Number(qty.value) < maxQty) {
            qty.value = Number(qty.value) + 1;
            updateTotal();
        } else {
            alert('Jumlah tiket melebihi kuota yang tersedia');
        }
    }

    function updateTotal() {
        const harga = Number(document.getElementById('selectedHarga').value) || 0;
        const qty = Number(document.getElementById('quantity').value) || 1;
        const total = harga * qty;

        document.getElementById('unitPrice').textContent = harga > 0 ? formatRupiah(harga) : 'Rp -';
        document.getElementById('totalPrice').textContent = formatRupiah(total);
        document.getElementById('qtyLabel').textContent = qty + ' Tiket';
        document.getElementById('grandTotal').textContent = harga > 0 ? formatRupiah(total) : 'Rp -';
    }

    function likeEvent() {
        const btn = event.target.closest('button');
        btn.classList.add('bg-[#FF5C00]/10');
        alert('Konser ditambahkan ke daftar favorit!');
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.ticket-option').forEach(option => {
            option.addEventListener('click', () => {
                const radio = option.querySelector('input[name="kategori_tiket"]');
                radio.checked = true;
                document.getElementById('quantity').value = 1;
                syncSelectedTicket();
            });
        });

        syncSelectedTicket();

        document.getElementById('bookingForm')?.addEventListener('submit', function(e) {
            if (!document.getElementById('selectedKategoriId').value) {
                e.preventDefault();
                alert('Pilih kategori tiket terlebih dahulu');
            }
        });
    });
</script>
@endpush
