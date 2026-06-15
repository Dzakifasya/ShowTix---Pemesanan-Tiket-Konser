@extends('layouts.app')

@section('title')
Dashboard - ShowTix
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-[#003D82] to-[#0052a3] rounded-xl shadow-lg p-8 mb-8 text-white">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="font-display font-bold text-4xl mb-2">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
                <p class="text-gray-100">Kelola tiket dan transaksi Anda dengan mudah</p>
            </div>
            <div class="text-5xl opacity-20">
                <i class="fas fa-user-circle"></i>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-md" role="alert">
            <p class="font-bold">Berhasil</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-md" role="alert">
            <p class="font-bold">Terjadi Kesalahan</p>
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <!-- Total Konser -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-[#003D82] hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold mb-1">Konser Ditonton</p>
                    <p class="font-display font-bold text-3xl text-gray-800">{{ $totalKonser }}</p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center text-[#003D82] text-2xl">
                    <i class="fas fa-music"></i>
                </div>
            </div>
        </div>

        <!-- Total Tiket -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-[#FF6600] hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold mb-1">Total Tiket</p>
                    <p class="font-display font-bold text-3xl text-gray-800">{{ $totalTiket }}</p>
                </div>
                <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center text-[#FF6600] text-2xl">
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
        </div>

        <!-- Total Belanja -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-green-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold mb-1">Total Belanja</p>
                    <p class="font-display font-bold text-3xl text-gray-800">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</p>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center text-green-600 text-2xl">
                    <i class="fas fa-wallet"></i>
                </div>
            </div>
        </div>

        <!-- Konser Mendatang -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-purple-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold mb-1">Konser Mendatang</p>
                    <p class="font-display font-bold text-3xl text-gray-800">{{ $upcomingConcertsCount }}</p>
                </div>
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-2xl">
                    <i class="fas fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <div class="flex gap-4 border-b border-gray-200">
            <button onclick="switchTab('upcoming')" class="tab-button pb-4 px-4 border-b-2 border-[#003D82] text-[#003D82] font-semibold active">
                <i class="fas fa-calendar-alt mr-2"></i> Konser Mendatang
            </button>
            <button onclick="switchTab('history')" class="tab-button pb-4 px-4 border-b-2 border-transparent text-gray-600 hover:text-[#003D82] transition font-semibold">
                <i class="fas fa-history mr-2"></i> Riwayat
            </button>
            <button onclick="switchTab('settings')" class="tab-button pb-4 px-4 border-b-2 border-transparent text-gray-600 hover:text-[#003D82] transition font-semibold">
                <i class="fas fa-cog mr-2"></i> Pengaturan
            </button>
        </div>
    </div>

    <!-- Tab Content: Upcoming Concerts -->
    <div id="upcoming-tab" class="tab-content">
        @if($upcomingConcerts->isEmpty())
            <div class="bg-white rounded-xl shadow-md p-8 text-center border border-gray-100">
                <div class="text-gray-400 text-5xl mb-4">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <h3 class="font-bold text-lg text-gray-800 mb-2">Belum Ada Konser Mendatang</h3>
                <p class="text-gray-600 mb-6">Anda belum memesan tiket untuk konser mendatang atau pembayaran Anda belum selesai.</p>
                <a href="{{ route('home') }}" class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-lg text-white font-bold transition shadow hover:shadow-md">
                    <i class="fas fa-search"></i> Cari Konser
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($upcomingConcerts as $konser)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition card-concert">
                        <div class="h-40 bg-[#003D82] relative overflow-hidden flex items-center justify-center">
                            @if($konser->poster)
                                <img src="{{ asset('storage/' . $konser->poster) }}" alt="{{ $konser->nama_konser }}" class="w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-[#003D82] to-[#FF6600] opacity-50"></div>
                                <i class="fas fa-music text-white text-5xl z-10 opacity-30"></i>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $konser->nama_konser }}</h3>
                            <div class="space-y-2 text-sm text-gray-600 mb-4">
                                <p><i class="fas fa-calendar text-[#FF6600] mr-2"></i>{{ \Carbon\Carbon::parse($konser->tanggal_konser)->format('d F Y') }}</p>
                                <p><i class="fas fa-map-marker-alt text-[#FF6600] mr-2"></i>{{ $konser->lokasi }}</p>
                                <p><i class="fas fa-clock text-[#FF6600] mr-2"></i>{{ \Carbon\Carbon::parse($konser->waktu_konser)->format('H:i') }} WIB</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('concert.detail', $konser->id) }}" class="flex-1 text-center btn-primary text-sm py-2">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Tab Content: History -->
    <div id="history-tab" class="tab-content hidden">
        @if($transaksi->isEmpty())
            <div class="bg-white rounded-xl shadow-md p-8 text-center border border-gray-100">
                <div class="text-gray-400 text-5xl mb-4">
                    <i class="fas fa-history"></i>
                </div>
                <h3 class="font-bold text-lg text-gray-800 mb-2">Belum Ada Riwayat Transaksi</h3>
                <p class="text-gray-600 mb-6">Semua transaksi pemesanan tiket Anda akan muncul di sini.</p>
                <a href="{{ route('home') }}" class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-lg text-white font-bold transition shadow hover:shadow-md">
                    <i class="fas fa-ticket-alt"></i> Pesan Tiket Sekarang
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($transaksi as $t)
                    @php
                        $firstPemesanan = $t->pemesanan->first();
                        $konser = $firstPemesanan?->kategoriTiket?->konser;
                        $totalTiketCount = $t->pemesanan->sum('jumlah_tiket');
                        $status = strtolower($t->status_transaksi);
                    @endphp
                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 @if($status == 'completed' || $status == 'berhasil') border-green-500 @elseif($status == 'pending' || $status == 'pending_payment') border-orange-500 @else border-red-500 @endif hover:shadow-lg transition">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="font-bold text-lg text-gray-800">{{ $konser?->nama_konser ?? 'Transaksi #' . $t->kode_transaksi }}</h3>
                                    <span class="text-xs text-gray-500">({{ $t->kode_transaksi }})</span>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm text-gray-600 mb-3">
                                    <p><i class="fas fa-calendar mr-2"></i>{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d M Y') }}</p>
                                    <p><i class="fas fa-map-marker-alt mr-2"></i>{{ $konser?->lokasi ?? '-' }}</p>
                                    <p><i class="fas fa-ticket-alt mr-2"></i>{{ $totalTiketCount }} Tiket</p>
                                    <p><i class="fas fa-credit-card mr-2"></i>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="text-left md:text-right flex flex-col items-start md:items-end gap-2">
                                @if($status == 'completed' || $status == 'berhasil')
                                    <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Selesai</span>
                                @elseif($status == 'pending' || $status == 'pending_payment')
                                    <span class="inline-block bg-orange-100 text-[#FF6600] px-3 py-1 rounded-full text-xs font-semibold">Menunggu Pembayaran</span>
                                @else
                                    <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">Dibatalkan</span>
                                @endif
                                
                                <div class="flex gap-2 mt-2">
                                    @if($status == 'pending')
                                        <a href="{{ route('payment.select-method', ['transaksi_id' => $t->id]) }}" class="bg-[#FF6600] hover:bg-orange-600 text-white text-xs font-bold px-4 py-2 rounded-lg transition flex items-center gap-1 shadow-md">
                                            <i class="fas fa-credit-card"></i> Lanjutkan Pembayaran
                                        </a>
                                    @elseif($status == 'pending_payment')
                                        <a href="{{ route('payment.index', ['transaksi_id' => $t->id]) }}" class="bg-[#FF6600] hover:bg-orange-600 text-white text-xs font-bold px-4 py-2 rounded-lg transition flex items-center gap-1 shadow-md">
                                            <i class="fas fa-credit-card"></i> Lanjutkan Pembayaran
                                        </a>
                                    @elseif($status == 'completed' || $status == 'berhasil')
                                        @php
                                            $firstTicket = $firstPemesanan?->tiket?->first();
                                        @endphp
                                        @if($firstTicket)
                                            <a href="{{ route('ticket.download', $firstTicket->id) }}" class="text-[#003D82] hover:text-[#FF6600] text-sm font-semibold transition flex items-center gap-1">
                                                <i class="fas fa-download"></i> Download Tiket
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <div class="mt-6">
                    {{ $transaksi->links() }}
                </div>
            </div>
        @endif
    </div>

    <!-- Tab Content: Settings -->
    <div id="settings-tab" class="tab-content hidden">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Settings -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h2 class="font-bold text-2xl text-gray-800 mb-6 pb-4 border-b">Profil Anda</h2>
                    
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon</label>
                                <input type="tel" name="no_hp" value="{{ old('no_hp', auth()->user()->pembeli?->no_hp) }}" placeholder="081234567890" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', auth()->user()->pembeli?->tanggal_lahir?->format('Y-m-d')) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                            <textarea name="alamat" rows="3" placeholder="Alamat lengkap Anda" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]" required>{{ old('alamat', auth()->user()->pembeli?->alamat) }}</textarea>
                        </div>

                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>

                <!-- Security Settings -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="font-bold text-2xl text-gray-800 mb-6 pb-4 border-b">Keamanan</h2>
                    
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Saat Ini</label>
                            <input type="password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                            <input type="password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                            <input type="password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82]">
                        </div>

                        <button type="submit" class="btn-outline-primary">
                            <i class="fas fa-lock mr-2"></i> Ubah Password
                        </button>
                    </form>
                </div>
            </div>

            <!-- Preferences -->
            <div class="bg-white rounded-xl shadow-md p-6 h-fit">
                <h2 class="font-bold text-xl text-gray-800 mb-6 pb-4 border-b">Preferensi</h2>
                
                <div class="space-y-4">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" checked class="w-5 h-5">
                        <span class="text-gray-700">Notifikasi Email</span>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" checked class="w-5 h-5">
                        <span class="text-gray-700">Notifikasi SMS</span>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" checked class="w-5 h-5">
                        <span class="text-gray-700">Promo & Penawaran</span>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" class="w-5 h-5">
                        <span class="text-gray-700">Newsletter</span>
                    </label>

                    <hr class="my-4">

                    <button class="w-full text-red-500 hover:bg-red-50 px-4 py-2 rounded-lg transition border border-red-500 font-semibold">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    function switchTab(tabName) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });

        // Remove active state from all buttons
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('border-[#003D82]', 'text-[#003D82]');
            btn.classList.add('border-transparent', 'text-gray-600');
        });

        // Show selected tab
        const targetTab = document.getElementById(tabName + '-tab');
        if (targetTab) {
            targetTab.classList.remove('hidden');
        }

        // Add active state to matching button
        const activeBtn = document.querySelector(`.tab-button[onclick*="'${tabName}'"]`) || document.querySelector(`.tab-button[onclick*='"${tabName}"']`);
        if (activeBtn) {
            activeBtn.classList.add('border-[#003D82]', 'text-[#003D82]');
            activeBtn.classList.remove('border-transparent', 'text-gray-600');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab') || 'upcoming';
        switchTab(tab);
    });
</script>
@endpush
