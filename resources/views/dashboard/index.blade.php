@extends('layouts.app')

@section('title', 'Dashboard - SHOWTIX')

@section('content')
<div class="bg-[#050816] min-h-screen">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-[#0047FF] via-[#0B57FF] to-[#081224] rounded-3xl shadow-[0_20px_60px_rgba(0,71,255,0.25)] p-8 mb-12 text-white relative overflow-hidden border border-[#0047FF]/30">
        <!-- Decorative glow -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-[#FF5C00] opacity-10 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-[#0047FF] opacity-20 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2 pointer-events-none"></div>
        <div class="relative z-10 space-y-2">
            <span class="text-xs uppercase font-extrabold tracking-widest text-white/70">User Area</span>
            <h1 class="font-display font-extrabold text-3xl md:text-5xl">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
            <p class="text-white/80 text-sm md:text-base font-normal">Kelola pesanan tiket konser Anda dengan cepat dan mudah.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-400 p-4 mb-8 rounded-2xl shadow-lg" role="alert">
            <p class="font-bold text-sm">Berhasil</p>
            <p class="text-xs mt-1">{{ session('success') }}</p>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-500/10 border-l-4 border-rose-500 text-rose-400 p-4 mb-8 rounded-2xl shadow-lg" role="alert">
            <p class="font-bold text-sm">Terjadi Kesalahan</p>
            <ul class="list-disc pl-5 text-xs mt-1 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Total Konser -->
        <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 shadow-md hover:border-[#0047FF]/50 hover:shadow-[0_10px_30px_rgba(0,71,255,0.1)] transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#94A3B8] text-xs font-semibold uppercase tracking-wider mb-2">Konser Ditonton</p>
                    <p class="font-display font-extrabold text-3xl text-white">{{ $totalKonser }}</p>
                </div>
                <div class="w-12 h-12 bg-[#0047FF]/10 rounded-2xl flex items-center justify-center text-[#0047FF] border border-[#0047FF]/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Tiket -->
        <div class="bg-[#081224]/80 border border-[#FF5C00]/20 rounded-3xl p-6 shadow-md hover:border-[#FF5C00]/50 hover:shadow-[0_10px_30px_rgba(255,92,0,0.1)] transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#94A3B8] text-xs font-semibold uppercase tracking-wider mb-2">Total Tiket</p>
                    <p class="font-display font-extrabold text-3xl text-white">{{ $totalTiket }}</p>
                </div>
                <div class="w-12 h-12 bg-[#FF5C00]/10 rounded-2xl flex items-center justify-center text-[#FF5C00] border border-[#FF5C00]/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Belanja -->
        <div class="bg-[#081224]/80 border border-emerald-500/20 rounded-3xl p-6 shadow-md hover:border-emerald-500/50 hover:shadow-[0_10px_30px_rgba(16,185,129,0.1)] transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#94A3B8] text-xs font-semibold uppercase tracking-wider mb-2">Total Belanja</p>
                    <p class="font-display font-extrabold text-2xl text-white">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-400 border border-emerald-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Konser Mendatang -->
        <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 shadow-md hover:border-[#0047FF]/50 hover:shadow-[0_10px_30px_rgba(0,71,255,0.1)] transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#94A3B8] text-xs font-semibold uppercase tracking-wider mb-2">Konser Mendatang</p>
                    <p class="font-display font-extrabold text-3xl text-white">{{ $upcomingConcertsCount }}</p>
                </div>
                <div class="w-12 h-12 bg-[#0047FF]/10 rounded-2xl flex items-center justify-center text-[#0047FF] border border-[#0047FF]/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="bg-[#081224]/60 border border-[#0047FF]/10 rounded-3xl p-4 mb-8 backdrop-blur-sm">
        <div class="flex flex-wrap gap-2 border-b border-white/5 pb-3">
            <button onclick="switchTab('upcoming')" class="tab-button flex items-center gap-2 py-2.5 px-5 rounded-xl text-sm font-bold transition duration-300 border border-transparent" id="btn-upcoming">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Konser Mendatang
            </button>
            <button onclick="switchTab('history')" class="tab-button flex items-center gap-2 py-2.5 px-5 rounded-xl text-sm font-bold transition duration-300 border border-transparent" id="btn-history">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Riwayat Transaksi
            </button>
            <button onclick="switchTab('settings')" class="tab-button flex items-center gap-2 py-2.5 px-5 rounded-xl text-sm font-bold transition duration-300 border border-transparent" id="btn-settings">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Pengaturan Akun
            </button>
        </div>
    </div>

    <!-- Tab Content: Upcoming Concerts -->
    <div id="upcoming-tab" class="tab-content space-y-6">
        @if($upcomingConcerts->isEmpty())
            <div class="bg-[#081224]/30 border border-[#0047FF]/10 rounded-3xl p-12 text-center max-w-xl mx-auto">
                <svg class="w-16 h-16 mx-auto text-[#94A3B8]/40 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="font-bold text-xl text-white mb-2">Belum Ada Konser Mendatang</h3>
                <p class="text-[#94A3B8] text-sm mb-8">Anda belum memiliki tiket terdaftar untuk konser mendatang.</p>
                <a href="{{ route('home') }}" class="bg-gradient-to-r from-[#0047FF] to-[#FF5C00] text-white px-6 py-3.5 rounded-xl font-bold text-sm transition hover:shadow-[0_0_20px_rgba(255,92,0,0.4)] inline-block">
                    Cari Konser Musik
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($upcomingConcerts as $konser)
                    <div class="bg-[#0B1730]/60 border border-[#0047FF]/20 rounded-3xl overflow-hidden hover:border-[#FF5C00]/40 hover:shadow-[0_10px_30px_rgba(0,71,255,0.1)] transition duration-300 flex flex-col justify-between">
                        <div class="aspect-[16/10] bg-[#0B1730] relative overflow-hidden">
                            @if($konser->poster)
                                <img src="{{ asset('storage/' . $konser->poster) }}" alt="{{ $konser->nama_konser }}" class="w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-[#94A3B8]">
                                    <svg class="w-10 h-10 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 space-y-4">
                            <h3 class="font-bold text-lg text-white leading-snug truncate">{{ $konser->nama_konser }}</h3>
                            <div class="space-y-2 text-xs text-[#94A3B8]">
                                <p class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($konser->tanggal_konser)->format('d F Y') }}
                                </p>
                                <p class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-[#FF5C00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $konser->lokasi }}
                                </p>
                                <p class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($konser->waktu_konser)->format('H:i') }} WIB
                                </p>
                            </div>
                            <div class="pt-4 border-t border-white/5 flex gap-2">
                                <a href="{{ route('concert.detail', $konser->id) }}" class="w-full py-2 bg-[#0047FF] hover:bg-[#0B57FF] text-white text-center rounded-xl text-xs font-bold transition">Detail Konser</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Tab Content: History (My Tickets) -->
    <div id="history-tab" class="tab-content space-y-6 hidden">
        @if($transaksi->isEmpty())
            <div class="bg-[#081224]/30 border border-[#0047FF]/10 rounded-3xl p-12 text-center max-w-xl mx-auto">
                <svg class="w-16 h-16 mx-auto text-[#94A3B8]/40 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="font-bold text-xl text-white mb-2">Belum Ada Riwayat Transaksi</h3>
                <p class="text-[#94A3B8] text-sm mb-8">Semua riwayat pesanan tiket konser Anda akan ditampilkan di sini.</p>
                <a href="{{ route('home') }}" class="bg-gradient-to-r from-[#0047FF] to-[#FF5C00] text-white px-6 py-3.5 rounded-xl font-bold text-sm transition hover:shadow-[0_0_20px_rgba(255,92,0,0.4)] inline-block">
                    Pesan Tiket Konser
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($transaksi as $t)
                    @php
                        $firstPemesanan = $t->pemesanan->first();
                        $konser = $firstPemesanan?->kategoriTiket?->konser;
                        $totalTiketCount = $t->pemesanan->sum('jumlah_tiket');
                        $status = strtolower($t->status_transaksi);
                    @endphp
                    <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 hover:border-[#0047FF]/40 hover:shadow-[0_10px_30px_rgba(0,71,255,0.05)] transition flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <!-- Left Info -->
                        <div class="flex-1 flex gap-4 items-start">
                            <div class="w-12 h-16 bg-[#0B1730] border border-white/5 rounded-lg overflow-hidden flex-shrink-0">
                                @if($konser && $konser->poster)
                                    <img src="{{ asset('storage/' . $konser->poster) }}" alt="Poster" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="flex items-center gap-2 mb-1 flex-wrap">
                                    <h3 class="font-bold text-white text-base leading-tight">{{ $konser?->nama_konser ?? 'Transaksi #' . $t->kode_transaksi }}</h3>
                                    <span class="text-[10px] font-mono text-[#94A3B8]">({{ $t->kode_transaksi }})</span>
                                </div>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-x-6 gap-y-2 text-xs text-[#94A3B8] mt-2">
                                    <p class="flex items-center gap-1.5">
                                        <svg class="w-3 h-3 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d M Y') }}
                                    </p>
                                    <p class="flex items-center gap-1.5 truncate max-w-[150px]">
                                        <svg class="w-3 h-3 text-[#FF5C00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                        {{ $konser?->lokasi ?? '-' }}
                                    </p>
                                    <p class="flex items-center gap-1.5">
                                        <svg class="w-3 h-3 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                        {{ $totalTiketCount }} Tiket
                                    </p>
                                    <p class="flex items-center gap-1.5">
                                        <svg class="w-3 h-3 text-[#FF5C00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Rp {{ number_format($t->total_harga, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Status Badge & Action Buttons -->
                        <div class="flex flex-col items-start md:items-end gap-3 min-w-[160px]">
                            @if($status == 'completed' || $status == 'berhasil')
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase bg-[#0047FF]/10 text-[#0047FF] border border-[#0047FF]/20">Berhasil</span>
                            @elseif($status == 'pending' || $status == 'pending_payment')
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase bg-[#FF5C00]/10 text-[#FF5C00] border border-[#FF5C00]/20">Pending</span>
                            @elseif($status == 'dibatalkan' || $status == 'cancelled' || $status == 'expired')
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase bg-rose-500/10 text-rose-400 border border-rose-500/20">Expired</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase bg-rose-500/10 text-rose-400 border border-rose-500/20">Dibatalkan</span>
                            @endif

                            <div class="flex gap-2 w-full md:w-auto">
                                @if($status == 'pending' || $status == 'pending_payment')
                                    <a href="{{ route('payment.index', ['transaksi_id' => $t->id]) }}" 
                                       class="w-full md:w-auto px-4 py-2 bg-gradient-to-r from-[#0047FF] to-[#FF5C00] text-white text-xs font-bold rounded-xl transition flex items-center justify-center gap-1.5 hover:shadow-[0_0_15px_rgba(255,92,0,0.3)]">
                                        Bayar Sekarang
                                    </a>
                                @elseif($status == 'completed' || $status == 'berhasil')
                                    @php
                                        $firstTicket = $firstPemesanan?->tiket?->first();
                                    @endphp
                                    @if($firstTicket)
                                        <a href="{{ route('ticket.download', $firstTicket->id) }}" 
                                           class="w-full md:w-auto px-4 py-2 bg-[#0047FF]/10 hover:bg-[#0047FF] text-white border border-[#0047FF]/30 text-xs font-bold rounded-xl transition flex items-center justify-center gap-1.5">
                                            Detail Tiket
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <div class="pt-6">
                    {{ $transaksi->links() }}
                </div>
            </div>
        @endif
    </div>

    <!-- Tab Content: Settings -->
    <div id="settings-tab" class="tab-content space-y-6 hidden">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile form panel -->
            <div class="lg:col-span-2">
                <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 sm:p-8 shadow-[0_15px_40px_rgba(0,71,255,0.05)] backdrop-blur-md">
                    <h2 class="text-xl font-bold text-white mb-6 border-b border-white/5 pb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil Pengguna
                    </h2>
                    
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-[#94A3B8] uppercase mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] text-sm" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-[#94A3B8] uppercase mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] text-sm" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-[#94A3B8] uppercase mb-2">No. Handphone</label>
                                <input type="tel" name="no_hp" value="{{ old('no_hp', auth()->user()->pembeli?->no_hp) }}" placeholder="08xxxxxxxx" class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] text-sm" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-[#94A3B8] uppercase mb-2">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', auth()->user()->pembeli?->tanggal_lahir?->format('Y-m-d')) }}" class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] text-sm" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#94A3B8] uppercase mb-2">Alamat Lengkap</label>
                            <textarea name="alamat" rows="3" placeholder="Alamat lengkap Anda" class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] text-sm" required>{{ old('alamat', auth()->user()->pembeli?->alamat) }}</textarea>
                        </div>

                        <button type="submit" class="bg-gradient-to-r from-[#0047FF] to-[#FF5C00] hover:from-[#0B57FF] hover:to-[#FF6B00] text-white px-6 py-3.5 rounded-xl font-bold text-sm transition-all duration-300 hover:shadow-[0_0_15px_rgba(255,92,0,0.4)]">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Security preferences panel -->
            <div class="lg:col-span-1">
                <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 sm:p-8 shadow-[0_15px_40px_rgba(0,71,255,0.05)] backdrop-blur-md space-y-6">
                    <h2 class="text-xl font-bold text-white border-b border-white/5 pb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#FF5C00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Keamanan & Preferensi
                    </h2>
                    
                    <div class="space-y-4">
                        <label class="flex items-center gap-3.5 cursor-pointer">
                            <input type="checkbox" checked class="accent-[#0047FF] rounded w-4 h-4">
                            <span class="text-[#D1D5DB] text-sm">Notifikasi Email Tiket</span>
                        </label>
                        <label class="flex items-center gap-3.5 cursor-pointer">
                            <input type="checkbox" checked class="accent-[#0047FF] rounded w-4 h-4">
                            <span class="text-[#D1D5DB] text-sm">Notifikasi WhatsApp</span>
                        </label>
                        <label class="flex items-center gap-3.5 cursor-pointer">
                            <input type="checkbox" class="accent-[#0047FF] rounded w-4 h-4">
                            <span class="text-[#D1D5DB] text-sm">Promo & Newsletter</span>
                        </label>

                        <hr class="border-white/5 my-4">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full border border-rose-500/30 text-rose-400 hover:bg-rose-500/10 font-bold py-3 rounded-xl transition text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('js')
<script>
    function switchTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });

        // Reset all buttons
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('bg-[#0047FF]', 'text-white', 'border-[#0047FF]');
            btn.classList.add('text-[#94A3B8]', 'hover:text-white', 'border-transparent');
        });

        // Show target tab
        const targetTab = document.getElementById(tabName + '-tab');
        if (targetTab) {
            targetTab.classList.remove('hidden');
        }

        // Active state to button
        const activeBtn = document.getElementById('btn-' + tabName);
        if (activeBtn) {
            activeBtn.classList.remove('text-[#94A3B8]', 'hover:text-white', 'border-transparent');
            activeBtn.classList.add('bg-[#0047FF]', 'text-white', 'border-[#0047FF]');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab') || 'upcoming';
        switchTab(tab);
    });
</script>
@endpush
