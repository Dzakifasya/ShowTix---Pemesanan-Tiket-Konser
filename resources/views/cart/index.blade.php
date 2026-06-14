@extends('layouts.app')

@section('title', 'Keranjang Belanja - ShowTix')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-50 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-[#003D82] transition">Home</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800">Keranjang Belanja</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if(count($cartItems ?? []) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <h1 class="font-display font-bold text-3xl text-gray-800 mb-6">Keranjang Belanja</h1>

                <div class="space-y-4">
                    @foreach($cartItems ?? [] as $item)
                        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-[#003D82] hover:shadow-lg transition">
                            <div class="flex gap-6">
                                <!-- Poster -->
                                <div class="w-24 h-24 flex-shrink-0">
                                    @if($item['poster'])
                                        <img src="{{ asset('storage/' . $item['poster']) }}" alt="{{ $item['konser_nama'] }}" class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-[#003D82] to-[#FF6600] rounded-lg flex items-center justify-center">
                                            <i class="fas fa-music text-white text-2xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Details -->
                                <div class="flex-1">
                                    <h3 class="font-bold text-xl text-gray-800 mb-2">{{ $item['konser_nama'] }}</h3>
                                    <div class="space-y-1 text-sm text-gray-600 mb-3">
                                        <p><i class="fas fa-calendar text-[#FF6600] mr-2 w-4"></i>{{ $item['tanggal_konser'] }}</p>
                                        <p><i class="fas fa-map-marker-alt text-[#FF6600] mr-2 w-4"></i>{{ $item['lokasi'] }}</p>
                                        <p><i class="fas fa-ticket-alt text-[#FF6600] mr-2 w-4"></i><strong>{{ $item['kategori_nama'] }}</strong> - Rp {{ number_format($item['harga_satuan'], 0, ',', '.') }}/tiket</p>
                                    </div>
                                    
                                    <!-- Quantity Adjuster -->
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center border border-gray-300 rounded-lg">
                                            <form method="POST" action="{{ route('cart.update', $item['id']) }}" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="jumlah_tiket" value="{{ max(1, $item['jumlah_tiket'] - 1) }}">
                                                <button type="submit" class="px-3 py-2 text-[#003D82] hover:bg-blue-50 transition">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </form>
                                            <span class="px-4 py-2 border-0 font-semibold text-center min-w-12">{{ $item['jumlah_tiket'] }}</span>
                                            <form method="POST" action="{{ route('cart.update', $item['id']) }}" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="jumlah_tiket" value="{{ $item['jumlah_tiket'] + 1 }}">
                                                <button type="submit" class="px-3 py-2 text-[#003D82] hover:bg-blue-50 transition">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Remove Button -->
                                        <form method="POST" action="{{ route('cart.remove', $item['id']) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 transition font-semibold">
                                                <i class="fas fa-trash mr-2"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="text-right flex-shrink-0">
                                    <p class="text-sm text-gray-600 mb-2">Subtotal</p>
                                    <p class="font-bold text-2xl text-[#003D82]">
                                        Rp {{ number_format($item['subtotal'] ?? ($item['harga_satuan'] * $item['jumlah_tiket']), 0, ',', '.') }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-2">{{ $item['jumlah_tiket'] }} × Rp {{ number_format($item['harga_satuan'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Continue Shopping -->
                <a href="{{ route('home') }}" class="mt-8 inline-flex items-center text-[#003D82] hover:text-[#FF6600] transition font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Lanjutkan Belanja
                </a>
            </div>

            <!-- Summary & Checkout -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-xl p-6 sticky top-24 border-2 border-[#FF6600]">
                    <h2 class="font-display font-bold text-2xl text-gray-800 mb-6">Ringkasan Pesanan</h2>

                    <div class="space-y-4 mb-6 pb-6 border-b-2 border-gray-200">
                        @php
                            $total = 0;
                            $itemCount = 0;
                        @endphp

                        @foreach($cartItems ?? [] as $item)
                            @php
                                $subtotal = $item['subtotal'] ?? ($item['harga_satuan'] * $item['jumlah_tiket']);
                                $total += $subtotal;
                                $itemCount += $item['jumlah_tiket'];
                            @endphp
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-700">{{ $item['konser_nama'] }} ({{ $item['jumlah_tiket'] }}×)</span>
                                <span class="font-semibold text-gray-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Cost Breakdown -->
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-700">
                            <span>Subtotal ({{ $itemCount }} tiket)</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Admin Fee</span>
                            @php $adminFee = $total * 0.025; @endphp
                            <span>Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Biaya Layanan</span>
                            @php $serviceFee = 10000; @endphp
                            <span>Rp {{ number_format($serviceFee, 0, ',', '.') }}</span>
                        </div>

                        <div class="border-t-2 border-gray-200 pt-3 flex justify-between font-bold text-lg">
                            <span>Total Pembayaran</span>
                            @php $grandTotal = $total + $adminFee + $serviceFee; @endphp
                            <span class="text-[#FF6600]">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Promo Code -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Kode Promo</label>
                        <div class="flex gap-2">
                            <input 
                                type="text" 
                                placeholder="Masukkan kode promo" 
                                class="flex-1 px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] text-sm"
                            >
                            <button class="btn-primary text-sm py-2 px-4">Terapkan</button>
                        </div>
                    </div>

                    <!-- Payment Methods Info -->
                    <div class="bg-blue-50 border-l-4 border-[#003D82] p-3 rounded mb-6">
                        <p class="text-xs text-gray-600">
                            <i class="fas fa-credit-card text-[#003D82] mr-2"></i>
                            <strong>Metode Pembayaran:</strong><br>
                            Transfer Bank, E-wallet, Kartu Kredit
                        </p>
                    </div>

                    <!-- Checkout Button -->
                    <a href="{{ route('checkout') }}" class="w-full btn-orange text-white font-bold py-3 rounded-lg text-center transition-all duration-300 block">
                        <i class="fas fa-arrow-right mr-2"></i> Lanjut ke Pembayaran
                    </a>

                    <!-- Terms Checkbox -->
                    <label class="flex items-start gap-2 mt-4 text-xs text-gray-600 cursor-pointer">
                        <input type="checkbox" class="mt-1" required>
                        <span>Saya setuju dengan <a href="#" class="text-[#003D82] hover:underline">Syarat & Ketentuan</a> dan <a href="#" class="text-[#003D82] hover:underline">Kebijakan Privasi</a></span>
                    </label>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="text-center py-16">
            <div class="mb-6">
                <i class="fas fa-shopping-cart text-gray-300 text-8xl mb-4"></i>
            </div>
            <h2 class="font-display font-bold text-3xl text-gray-800 mb-3">Keranjang Anda Kosong</h2>
            <p class="text-gray-600 text-lg mb-8">Mulai cari dan pesan tiket konser favorit Anda sekarang</p>
            <a href="{{ route('home') }}" class="btn-primary inline-block">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
            </a>
        </div>
    @endif
</div>

@endsection
