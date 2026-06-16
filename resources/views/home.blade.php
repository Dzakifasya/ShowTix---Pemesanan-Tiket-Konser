@extends('layouts.app')

@section('title', 'SHOWTIX - Pesan Tiket Konser Favoritmu')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[calc(100vh-5rem)] flex items-center justify-center overflow-hidden bg-[#050816] px-4 pt-16 pb-36 md:pb-40">
    <!-- Background Image with Overlay and Spotlight / Particles -->
    <div class="absolute inset-0 z-0 bg-gradient-to-b from-[#050816] via-[#081224] to-[#0B1730]">
        <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=1600&auto=format&fit=crop"
             alt="Concert Crowd"
             class="w-full h-full object-cover opacity-35 scale-105 [filter:saturate(0.9)_contrast(1.08)_brightness(0.70)]">
        <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(5,8,22,0.72)_0%,rgba(5,8,22,0.56)_46%,rgba(5,8,22,0.94)_100%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_24%_18%,rgba(0,71,255,0.24),transparent_30rem),radial-gradient(circle_at_78%_62%,rgba(255,92,0,0.18),transparent_26rem)]"></div>
        
        <!-- Spotlight & Light Glows -->
        <div class="absolute top-[-20%] left-[-10%] w-[60%] h-[60%] rounded-full bg-[#0047FF]/15 blur-[150px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[60%] h-[60%] rounded-full bg-[#FF5C00]/10 blur-[150px] animate-pulse" style="animation-delay: 3s;"></div>
        
        <!-- Spotlight beam effect -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[220px] h-[360px] bg-gradient-to-b from-[#0047FF]/14 to-transparent rounded-full blur-[50px]"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[2px] h-[360px] bg-gradient-to-b from-[#1E63FF]/35 to-transparent blur-[2px]"></div>
        <div class="absolute bottom-0 left-0 right-0 h-52 bg-gradient-to-t from-[#050816] via-[#050816]/80 to-transparent"></div>
        
        <!-- Floating Particles -->
        <div class="absolute inset-0 opacity-40 pointer-events-none">
            <div class="absolute w-2 h-2 bg-[#0047FF] rounded-full top-1/4 left-1/4 animate-ping blur-[0.5px]"></div>
            <div class="absolute w-1.5 h-1.5 bg-[#FF5C00] rounded-full top-1/2 left-3/4 animate-bounce blur-[0.5px]" style="animation-delay: 1s;"></div>
            <div class="absolute w-1 h-1 bg-white rounded-full top-1/3 left-2/3 animate-pulse blur-[0.5px]" style="animation-delay: 2s;"></div>
            <div class="absolute w-2 h-2 bg-[#0047FF] rounded-full top-2/3 left-1/3 animate-bounce blur-[0.5px]" style="animation-delay: 3s;"></div>
        </div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 max-w-5xl mx-auto px-0 sm:px-6 lg:px-8 text-center py-6">
        <span class="inline-flex items-center gap-2 py-2 px-4 rounded-full text-[11px] font-extrabold tracking-wider bg-[#081224]/65 text-[#FF6B00] border border-[#FF6B00]/25 mb-6 backdrop-blur-md uppercase shadow-[0_0_18px_rgba(255,92,0,0.16)]">
            <span class="w-2 h-2 rounded-full bg-[#FF5C00] shadow-[0_0_14px_rgba(255,92,0,0.8)]"></span> Platform Pemesanan Tiket #1
        </span>
        <h1 class="font-display text-5xl md:text-7xl font-extrabold text-white tracking-normal mb-6 leading-[1.05] drop-shadow-[0_12px_38px_rgba(0,0,0,0.45)]">
            <span class="block">SHOWTIX</span>
            <span class="block bg-gradient-to-r from-[#0047FF] via-[#1E63FF] to-[#FF6B00] bg-clip-text text-transparent">
                Pesan Tiket Konser Favoritmu
            </span>
        </h1>
        <p class="text-lg md:text-xl text-[#D1D5DB] max-w-2xl mx-auto mb-9 font-normal leading-relaxed drop-shadow-[0_8px_24px_rgba(0,0,0,0.42)]">
            Nikmati pengalaman membeli tiket konser dengan cepat, aman dan mudah secara online tanpa antre.
        </p>
        <div class="relative z-20 flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="#concerts" 
               class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-gradient-to-r from-[#0047FF] to-[#FF6B00] hover:from-[#0B57FF] hover:to-[#FF7A00] text-white px-8 py-4 rounded-full font-bold text-base transition-all duration-300 transform hover:scale-105 hover:shadow-[0_0_30px_rgba(0,71,255,0.4),0_0_26px_rgba(255,92,0,0.25)]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Explore Concert
            </a>
            <a href="#why-us" 
               class="w-full sm:w-auto inline-flex justify-center items-center bg-[#081224]/55 border border-white/15 hover:border-[#0047FF]/45 hover:bg-[#0B1730]/80 text-white px-8 py-4 rounded-full font-bold text-base transition-all duration-300 backdrop-blur-md">
                Learn More
            </a>
        </div>
    </div>
</section>

<!-- Search & Filter Section -->
<section class="relative z-30 -mt-14 md:-mt-16 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-[#081224]/90 backdrop-blur-xl rounded-3xl p-6 sm:p-8 shadow-[0_24px_70px_rgba(0,0,0,0.35),0_0_30px_rgba(0,71,255,0.12)] hover:border-[#0047FF]/45 transition duration-300">
        <form method="GET" action="{{ route('search') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search input -->
            <div class="relative">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Cari Konser</label>
                <div class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Nama konser atau artis..." 
                        class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-slate-700 focus:outline-none focus:border-[#FF5C00] focus:ring-1 focus:ring-[#FF5C00] text-sm transition"
                    >
                    <svg class="w-4 h-4 absolute right-3.5 top-1/2 transform -translate-y-1/2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
            </div>

            <!-- Location -->
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Lokasi</label>
                <select name="location" class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-slate-700 focus:outline-none focus:border-[#FF5C00] focus:ring-1 focus:ring-[#FF5C00] text-sm transition">
                    <option value="">Semua Lokasi</option>
                    @foreach($destinations ?? [] as $dest)
                        <option value="{{ $dest['name'] }}">{{ $dest['name'] }}</option>
                    @endforeach
                    <option value="Jakarta">Jakarta</option>
                    <option value="Bandung">Bandung</option>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Bali">Bali</option>
                </select>
            </div>

            <!-- Tanggal -->
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Tanggal</label>
                <input 
                    type="date" 
                    name="tanggal" 
                    class="w-full px-4 py-3 bg-[#0B1730] text-white rounded-xl border border-slate-700 focus:outline-none focus:border-[#FF5C00] focus:ring-1 focus:ring-[#FF5C00] text-sm transition"
                >
            </div>

            <!-- Submit Button -->
            <div class="flex items-end">
                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-[#0047FF] to-[#FF6B00] hover:from-[#0B57FF] hover:to-[#FF7A00] text-white font-bold rounded-xl text-sm transition-all duration-300 flex items-center justify-center gap-2 hover:shadow-[0_0_20px_rgba(0,71,255,0.3)]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                    Cari Tiket
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Concert Grid Section -->
<section id="concerts" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-4">
        <div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3 tracking-tight">Upcoming Concerts</h2>
            <p class="text-gray-400">Temukan konser-konser spektakuler terdekat dan segera pesan tiketmu!</p>
        </div>
        <a href="{{ route('search') }}" class="text-[#FF5C00] hover:text-[#FF6B00] font-semibold text-sm transition-colors flex items-center gap-1">
            Lihat Semua Konser <svg class="w-3.5 h-3.5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
        </a>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($konserMendatang ?? [] as $konser)
            @php
                $sisaTiket = $konser->kategoriTiket->sum('sisa_kuota');
                $hargaMin = $konser->kategoriTiket->min('harga') ?? 0;
            @endphp
            <div class="bg-[#0B1730] border border-white/5 rounded-[24px] overflow-hidden hover:border-[#0047FF]/40 transition-all duration-500 hover:-translate-y-2 group flex flex-col justify-between hover:shadow-[0_10px_30px_rgba(0,71,255,0.15)]">
                <!-- Poster -->
                <div class="relative overflow-hidden aspect-[3/4] bg-[#050816]">
                    @if($konser->poster)
                        <img src="{{ asset('storage/' . $konser->poster) }}" 
                             alt="{{ $konser->nama_konser }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-[#94A3B8] p-4">
                            <svg class="w-12 h-12 mb-2 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-xs font-semibold uppercase tracking-wider text-[#94A3B8] text-center">No Image Available</span>
                        </div>
                    @endif
                    
                    <!-- Availability Badge -->
                    <div class="absolute top-4 right-4 z-10">
                        @if($sisaTiket > 0)
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-[#0047FF] text-white border border-[#0047FF]/30 backdrop-blur-sm">
                                Available
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-[#FF5C00] text-white border border-[#FF5C00]/30 backdrop-blur-sm">
                                Sold Out
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Info -->
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <!-- Title & Artist -->
                        <h3 class="font-bold text-lg text-white group-hover:text-[#FF6B00] transition line-clamp-1 mb-1">
                            {{ $konser->nama_konser }}
                        </h3>
                        <p class="text-[#FF5C00] font-semibold text-xs mb-4">
                            @if(isset($konser->artis) && $konser->artis->count() > 0)
                                {{ $konser->artis->pluck('nama_artis')->implode(', ') }}
                            @else
                                {{ $konser->nama_konser }}
                            @endif
                        </p>

                        <!-- Details -->
                        <div class="space-y-2 text-xs text-[#94A3B8] mb-6">
                            <div class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-[#0047FF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                <span>{{ $konser->lokasi }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-[#0047FF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <span>{{ \Carbon\Carbon::parse($konser->tanggal_konser)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Price & Buy Button -->
                    <div class="pt-4 border-t border-white/5 flex items-center justify-between gap-2">
                        <div>
                            <p class="text-[10px] text-[#94A3B8] uppercase tracking-wider">Mulai dari</p>
                            <p class="font-extrabold text-sm text-[#FF6B00]">
                                Rp {{ number_format($hargaMin, 0, ',', '.') }}
                            </p>
                        </div>
                        
                        @if($sisaTiket > 0)
                            <a href="{{ route('concert.detail', $konser->id) }}" 
                               class="bg-gradient-to-r from-[#0047FF] to-[#FF6B00] hover:from-[#0B57FF] hover:to-[#FF7A00] text-white px-4 py-2.5 rounded-xl text-xs font-bold transition duration-300 hover:shadow-[0_0_15px_rgba(0,71,255,0.3)]">
                                Pesan Sekarang
                            </a>
                        @else
                            <button disabled 
                                    class="bg-slate-800 text-slate-500 px-4 py-2.5 rounded-xl text-xs font-bold cursor-not-allowed">
                                Habis
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16">
                <svg class="w-16 h-16 text-[#94A3B8]/30 mb-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" /></svg>
                <h3 class="text-xl font-bold text-white mb-2">Belum Ada Konser</h3>
                <p class="text-gray-400">Silakan kembali lagi nanti untuk info konser terbaru.</p>
            </div>
        @endforelse
    </div>
</section>

<!-- Why Choose Us Section -->
<section id="why-us" class="py-24 bg-[#081224]/50 border-t border-[#0047FF]/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4 tracking-tight">Mengapa Memilih SHOWTIX?</h2>
            <p class="text-gray-400">Kami menyediakan layanan pemesanan tiket konser dengan standar kenyamanan dan keamanan terbaik.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Item 1 -->
            <div class="bg-[#081224]/80 border border-slate-800 rounded-3xl p-8 hover:border-[#0047FF]/30 transition duration-300">
                <div class="w-12 h-12 rounded-2xl bg-[#0047FF]/10 text-[#0047FF] flex items-center justify-center text-xl mb-6 border border-[#0047FF]/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-3">Transaksi Aman & Terpercaya</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Sistem enkripsi tingkat tinggi memastikan seluruh transaksi keuangan dan data pribadi Anda aman.
                </p>
            </div>

            <!-- Item 2 -->
            <div class="bg-[#081224]/80 border border-slate-800 rounded-3xl p-8 hover:border-[#FF5C00]/30 transition duration-300">
                <div class="w-12 h-12 rounded-2xl bg-[#FF5C00]/10 text-[#FF5C00] flex items-center justify-center text-xl mb-6 border border-[#FF5C00]/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-3">Pemesanan Mudah & Instan</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Cukup pilih konser, pilih kategori, selesaikan pembayaran, dan e-ticket langsung terbit seketika.
                </p>
            </div>

            <!-- Item 3 -->
            <div class="bg-[#081224]/80 border border-slate-800 rounded-3xl p-8 hover:border-[#0047FF]/30 transition duration-300">
                <div class="w-12 h-12 rounded-2xl bg-[#0047FF]/10 text-[#0047FF] flex items-center justify-center text-xl mb-6 border border-[#0047FF]/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-3">Customer Support 24/7</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Tim dukungan pelanggan kami siap membantu kendala transaksi Anda kapan saja, siang maupun malam.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
