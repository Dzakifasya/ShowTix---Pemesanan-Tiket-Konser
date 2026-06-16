@extends('layouts.app')

@section('title', 'Keranjang Belanja - SHOWTIX')

@section('content')
<!-- Progress Bar -->
<div class="bg-[#081224]/60 border-b border-white/5 sticky top-[72px] z-40 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center justify-between text-xs sm:text-sm">
            <div class="flex items-center gap-2 text-[#0047FF] font-bold">
                <div class="w-6 h-6 rounded-full bg-gradient-to-r from-[#0047FF] to-[#FF5C00] text-white flex items-center justify-center font-bold text-xs">1</div>
                <span>Keranjang</span>
            </div>
            <div class="w-12 h-0.5 bg-white/10"></div>
            <div class="flex items-center gap-2 text-[#94A3B8]">
                <div class="w-6 h-6 rounded-full bg-[#0B1730] text-white/50 flex items-center justify-center font-bold text-xs">2</div>
                <span>Data Pembeli</span>
            </div>
            <div class="w-12 h-0.5 bg-white/10"></div>
            <div class="flex items-center gap-2 text-[#94A3B8]">
                <div class="w-6 h-6 rounded-full bg-[#0B1730] text-white/50 flex items-center justify-center font-bold text-xs">3</div>
                <span>Pembayaran</span>
            </div>
        </div>
    </div>
</div>

<div class="py-12 bg-[#050816] min-h-[85vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(count($cartItems ?? []) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                <!-- Cart Items List -->
                <div class="lg:col-span-2 space-y-6">
                    <h1 class="font-display font-extrabold text-2xl md:text-3xl text-white tracking-tight">Keranjang Belanja</h1>
                    
                    <div class="space-y-4">
                        @foreach($cartItems ?? [] as $item)
                            <div class="bg-[#081224]/50 border border-[#0047FF]/20 rounded-3xl p-6 shadow-xl backdrop-blur-md flex flex-col sm:flex-row gap-6 items-start hover:border-[#FF5C00]/30 transition duration-300">
                                <!-- Poster -->
                                <div class="w-20 h-28 bg-[#0B1730] border border-white/5 rounded-2xl overflow-hidden flex-shrink-0 relative shadow-[0_0_15px_rgba(0,71,255,0.05)]">
                                    @if($item['poster'])
                                        <img src="{{ asset('storage/' . $item['poster']) }}" alt="{{ $item['konser_nama'] }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-[#94A3B8] p-2">
                                            <svg class="w-8 h-8 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Detail Info -->
                                <div class="flex-grow space-y-3">
                                    <div>
                                        <h3 class="font-bold text-white text-base leading-tight">{{ $item['konser_nama'] }}</h3>
                                        <p class="text-xs text-[#0047FF] font-semibold mt-1">Kategori: {{ $item['kategori_nama'] }}</p>
                                    </div>
                                    
                                    <div class="space-y-1 text-xs text-[#94A3B8]">
                                        <p class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($item['tanggal_konser'])->format('d M Y') }}
                                        </p>
                                        <p class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-[#FF5C00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $item['lokasi'] }}
                                        </p>
                                    </div>
                                    
                                    <!-- Quantity Adjustment Controls -->
                                    <div class="flex items-center gap-4 pt-1">
                                        <div class="flex items-center bg-[#0B1730] border border-white/10 rounded-xl p-1">
                                            <!-- Minus -->
                                            <form method="POST" action="{{ route('cart.update', $item['id']) }}" class="inline">
                                                @csrf
                                                <input type="hidden" name="jumlah_tiket" value="{{ max(1, $item['jumlah_tiket'] - 1) }}">
                                                <button type="submit" class="w-8 h-8 hover:bg-[#0047FF]/10 text-[#94A3B8] hover:text-white rounded-lg transition flex items-center justify-center text-xs">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <span class="text-xs font-bold text-white w-8 text-center">{{ $item['jumlah_tiket'] }}</span>
                                            <!-- Plus -->
                                            <form method="POST" action="{{ route('cart.update', $item['id']) }}" class="inline">
                                                @csrf
                                                <input type="hidden" name="jumlah_tiket" value="{{ $item['jumlah_tiket'] + 1 }}">
                                                <button type="submit" class="w-8 h-8 hover:bg-[#0047FF]/10 text-[#94A3B8] hover:text-white rounded-lg transition flex items-center justify-center text-xs">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Remove -->
                                        <form method="POST" action="{{ route('cart.remove', $item['id']) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-400 hover:text-rose-500 font-semibold text-xs transition flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Subtotal Price -->
                                <div class="text-left sm:text-right flex-shrink-0 space-y-1">
                                    <p class="text-[10px] text-[#94A3B8] uppercase tracking-wider font-semibold">Subtotal</p>
                                    <p class="font-extrabold text-lg text-white">
                                        Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                    </p>
                                    <p class="text-[10px] text-[#94A3B8] font-normal">
                                        {{ $item['jumlah_tiket'] }} × Rp {{ number_format($item['harga_satuan'], 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-[#0047FF] hover:text-[#0B57FF] font-semibold transition-colors duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Lanjutkan Belanja
                    </a>
                </div>

                <!-- Right Column: Summary Panel -->
                <div class="lg:col-span-1">
                    <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 sm:p-8 shadow-[0_15px_40px_rgba(0,71,255,0.1)] backdrop-blur-md space-y-6">
                        <h2 class="text-xl font-bold text-white border-b border-white/5 pb-4">Ringkasan Pesanan</h2>

                        @php
                            $total = array_sum(array_column($cartItems, 'subtotal'));
                            $ticketCount = array_sum(array_column($cartItems, 'jumlah_tiket'));
                            $adminFee = $total * 0.025;
                            $serviceFee = 10000;
                            $grandTotal = $total + $adminFee + $serviceFee;
                        @endphp

                        <div class="space-y-4">
                            @foreach($cartItems as $item)
                                <div class="flex justify-between text-xs">
                                    <span class="text-[#94A3B8] line-clamp-1 max-w-[150px]">{{ $item['konser_nama'] }} ({{ $item['jumlah_tiket'] }}×)</span>
                                    <span class="font-bold text-white">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Cost Breakdown -->
                        <div class="space-y-3 text-xs text-[#94A3B8] border-t border-white/5 pt-4">
                            <div class="flex justify-between">
                                <span>Subtotal ({{ $ticketCount }} tiket):</span>
                                <span class="font-bold text-white text-sm">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Biaya Admin (2.5%):</span>
                                <span class="font-bold text-white text-sm">Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Biaya Layanan:</span>
                                <span class="font-bold text-white text-sm">Rp {{ number_format($serviceFee, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between pt-3 border-t border-white/5 text-sm font-extrabold text-white">
                                <span>Total Tagihan:</span>
                                <span class="text-lg font-extrabold text-[#FF5C00]">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Promo Code Box -->
                        <div class="bg-[#050816] border border-[#0047FF]/20 p-4 rounded-2xl">
                            <label class="text-xs font-semibold text-[#94A3B8] uppercase tracking-wider block mb-2">Kode Promo</label>
                            <div class="flex gap-2">
                                <input type="text" placeholder="Masukkan kode promo" 
                                       class="flex-grow px-3 py-2 bg-[#081224] text-white border border-[#0047FF]/20 rounded-xl focus:outline-none focus:border-[#FF5C00] text-xs">
                                <button class="px-3.5 py-2 bg-[#0047FF] hover:bg-[#0B57FF] text-white rounded-xl text-xs font-bold transition-colors duration-300">Terapkan</button>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="pt-2">
                            <a href="{{ route('checkout') }}" 
                                class="block w-full py-3.5 bg-gradient-to-r from-[#0047FF] to-[#FF5C00] hover:from-[#0B57FF] hover:to-[#FF6B00] text-white rounded-xl font-extrabold text-sm text-center transition-all duration-300 hover:shadow-[0_0_20px_rgba(255,92,0,0.4)]">
                                <svg class="w-4 h-4 mr-1.5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg> Lanjut Ke Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-20 bg-[#081224]/30 border border-[#0047FF]/10 rounded-3xl p-12 max-w-xl mx-auto shadow-2xl">
                <svg class="w-16 h-16 mx-auto text-[#94A3B8]/60 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <h2 class="font-display font-bold text-2xl text-white mb-2">Keranjang Belanja Kosong</h2>
                <p class="text-[#94A3B8] text-sm mb-8">Anda belum menambahkan tiket konser apapun ke dalam keranjang belanja.</p>
                <a href="{{ route('home') }}" class="bg-gradient-to-r from-[#0047FF] to-[#FF5C00] hover:from-[#0B57FF] hover:to-[#FF6B00] text-white px-6 py-3.5 rounded-xl font-bold text-sm transition-all duration-300 hover:shadow-[0_0_20px_rgba(255,92,0,0.4)] inline-block">
                    Jelajahi Konser
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
