@extends('layouts.app')

@section('title')
Pembayaran Berhasil - ShowTix
@endsection

@section('content')
<div class="min-h-[calc(100vh-64px)] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-2xl">
        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Success Header -->
            <div class="bg-gradient-to-r from-green-400 to-green-600 p-12 text-center text-white">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full mb-6">
                    <i class="fas fa-check text-5xl text-green-600"></i>
                </div>
                <h1 class="font-display font-bold text-4xl mb-2">Pembayaran Berhasil!</h1>
                <p class="text-green-100 text-lg">Terima kasih telah berbelanja di ShowTix</p>
            </div>

            <!-- Transaction Details -->
            <div class="p-8">
                <!-- Order Number -->
                <div class="mb-8">
                    <h2 class="font-bold text-lg text-gray-800 mb-4">Nomor Pesanan</h2>
                    <div class="bg-blue-50 border-2 border-[#003D82] rounded-xl p-4">
                        <p class="text-center font-display font-bold text-3xl text-[#003D82]">{{ $transaksi->no_referensi }}</p>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 pb-8 border-b-2 border-gray-200">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold mb-1">Metode Pembayaran</p>
                        <p class="text-lg text-gray-800 font-bold">
                            @switch($transaksi->metode_pembayaran)
                                @case('bank_transfer')
                                    <i class="fas fa-university text-[#003D82] mr-2"></i> Transfer Bank
                                    @break
                                @case('e_wallet')
                                    <i class="fas fa-wallet text-[#FF6600] mr-2"></i> E-Wallet
                                    @break
                                @case('credit_card')
                                    <i class="fas fa-credit-card text-[#003D82] mr-2"></i> Kartu Kredit
                                    @break
                                @case('cicilan')
                                    <i class="fas fa-chart-line text-[#FF6600] mr-2"></i> Cicilan
                                    @break
                            @endswitch
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-semibold mb-1">Total Pembayaran</p>
                        <p class="text-lg text-[#FF6600] font-bold">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Tickets List -->
                <div class="mb-8">
                    <h3 class="font-bold text-lg text-gray-800 mb-4">Tiket Anda</h3>
                    <div class="space-y-3">
                        @forelse($transaksi->pemesanan as $pemesanan)
                            <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-[#003D82]">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-800 mb-1">
                                            {{ $pemesanan->kategoriTiket->konser->nama_konser }}
                                        </h4>
                                        <p class="text-sm text-gray-600 mb-2">
                                            {{ $pemesanan->kategoriTiket->nama_kategori }}
                                        </p>
                                        <div class="grid grid-cols-2 gap-2 text-xs text-gray-600">
                                            <p><i class="fas fa-calendar mr-1"></i> {{ $pemesanan->kategoriTiket->konser->tanggal_konser->format('d M Y') }}</p>
                                            <p><i class="fas fa-map-marker-alt mr-1"></i> {{ $pemesanan->kategoriTiket->konser->lokasi }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-lg text-[#003D82]">{{ $pemesanan->jumlah_tiket }} Tiket</p>
                                        <p class="text-sm text-gray-600">Rp {{ number_format($pemesanan->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-600">Tidak ada tiket</p>
                        @endforelse
                    </div>
                </div>

                <!-- Buyer Info -->
                <div class="bg-blue-50 rounded-lg p-4 mb-8 border border-[#003D82]">
                    <h3 class="font-bold text-gray-800 mb-3">Data Pemesan</h3>
                    <div class="space-y-2 text-sm text-gray-700">
                        <p><strong>Nama:</strong> {{ $transaksi->pembeli->nama_lengkap }}</p>
                        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p><strong>Telepon:</strong> {{ $transaksi->pembeli->no_hp }}</p>
                        <p><strong>Alamat:</strong> {{ $transaksi->pembeli->alamat }}</p>
                    </div>
                </div>

                <!-- What's Next -->
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-8">
                    <h3 class="font-bold text-green-800 mb-3">Langkah Selanjutnya</h3>
                    <ol class="text-sm text-green-700 space-y-2 ml-4 list-decimal">
                        <li>Kami akan memverifikasi pembayaran Anda dalam waktu 1-2 jam</li>
                        <li>Tiket digital akan dikirim ke email Anda</li>
                        <li>Anda dapat mengunduh dan mencetak tiket kapan saja</li>
                        <li>Tunjukkan tiket di pintu masuk konser</li>
                    </ol>
                </div>

                <!-- Important Notes -->
                <div class="bg-orange-50 border-l-4 border-[#FF6600] p-4 rounded-lg mb-8">
                    <h3 class="font-bold text-[#FF6600] mb-3">Penting!</h3>
                    <ul class="text-sm text-gray-700 space-y-1">
                        <li>✓ Cek folder spam jika tiket belum diterima dalam 2 jam</li>
                        <li>✓ Simpan kode pesanan: <strong>{{ $transaksi->no_referensi }}</strong></li>
                        <li>✓ Hadir 30 menit sebelum acara dimulai</li>
                        <li>✓ Batasi pembatalan hanya 7 hari sebelum konser</li>
                    </ul>
                </div>

                <!-- Contact Support -->
                <div class="bg-gray-50 rounded-lg p-4 mb-8 border border-gray-200">
                    <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-headset text-[#003D82]"></i>
                        Butuh Bantuan?
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <a href="https://wa.me/6281234567890" class="text-center p-3 border-2 border-[#003D82] rounded-lg hover:bg-blue-50 transition">
                            <i class="fab fa-whatsapp text-[#003D82] text-2xl mb-2"></i>
                            <p class="text-gray-800 font-semibold">WhatsApp</p>
                        </a>
                        <a href="mailto:support@showtix.com" class="text-center p-3 border-2 border-[#003D82] rounded-lg hover:bg-blue-50 transition">
                            <i class="fas fa-envelope text-[#003D82] text-2xl mb-2"></i>
                            <p class="text-gray-800 font-semibold">Email</p>
                        </a>
                        <a href="tel:+6215555555" class="text-center p-3 border-2 border-[#003D82] rounded-lg hover:bg-blue-50 transition">
                            <i class="fas fa-phone text-[#003D82] text-2xl mb-2"></i>
                            <p class="text-gray-800 font-semibold">Telepon</p>
                        </a>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <a href="{{ route('tickets') }}" class="flex-1 btn-primary text-white text-center py-3 rounded-lg font-bold">
                        <i class="fas fa-ticket-alt mr-2"></i> Lihat Tiket Saya
                    </a>
                    <a href="{{ route('home') }}" class="flex-1 btn-outline-primary text-center py-3 rounded-lg font-bold">
                        <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Download Receipt -->
        <div class="text-center mt-8">
            <a href="#" onclick="window.print()" class="text-[#003D82] hover:text-[#FF6600] transition font-semibold">
                <i class="fas fa-download mr-2"></i> Unduh Struk Pembayaran
            </a>
        </div>
    </div>
</div>

@endsection
