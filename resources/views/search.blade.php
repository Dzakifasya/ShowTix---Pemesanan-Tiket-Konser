@extends('layouts.app')

@section('title', 'Hasil Pencarian - SHOWTIX')

@section('content')
<div class="bg-[#050816] min-h-screen">
<!-- Breadcrumb -->
<div class="bg-[#081224]/60 border-b border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center text-sm text-[#94A3B8]">
            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
            <span class="mx-2 text-[#0047FF]">/</span>
            <span class="text-white">Hasil Pencarian</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Search Header -->
    <div class="mb-12">
        <h1 class="font-display font-extrabold text-3xl md:text-4xl text-white mb-2 tracking-tight">
            Hasil Pencarian untuk <span class="bg-gradient-to-r from-[#0047FF] to-[#FF5C00] bg-clip-text text-transparent">"{{ $searchTerm }}"</span>
        </h1>
        <p class="text-[#94A3B8]">{{ count($konser) }} konser ditemukan</p>
    </div>

    <!-- Filters Panel -->
    <div class="bg-[#081224]/80 border border-[#0047FF]/20 rounded-3xl p-6 mb-12 shadow-[0_15px_40px_rgba(0,71,255,0.08)] backdrop-blur-xl">
        <form method="GET" action="{{ route('search') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Keyword search -->
            <div>
                <label class="block text-xs font-semibold text-[#94A3B8] uppercase tracking-wider mb-2">Kata Kunci</label>
                <div class="relative">
                    <input 
                        type="text" 
                        name="search"
                        value="{{ $searchTerm }}"
                        placeholder="Nama konser atau artis..." 
                        class="w-full px-4 py-2.5 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] text-sm pr-10"
                    >
                    <svg class="w-4 h-4 absolute right-3.5 top-1/2 transform -translate-y-1/2 text-[#94A3B8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Location filter -->
            <div>
                <label class="block text-xs font-semibold text-[#94A3B8] uppercase tracking-wider mb-2">Lokasi</label>
                <select name="location" class="w-full px-4 py-2.5 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] text-sm">
                    <option value="">Semua Lokasi</option>
                    <option value="Jakarta" {{ $location === 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                    <option value="Bandung" {{ $location === 'Bandung' ? 'selected' : '' }}>Bandung</option>
                    <option value="Surabaya" {{ $location === 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                    <option value="Bali" {{ $location === 'Bali' ? 'selected' : '' }}>Bali</option>
                </select>
            </div>

            <!-- Date filter -->
            <div>
                <label class="block text-xs font-semibold text-[#94A3B8] uppercase tracking-wider mb-2">Tanggal</label>
                <input 
                    type="date" 
                    name="tanggal"
                    value="{{ request('tanggal') }}"
                    class="w-full px-4 py-2.5 bg-[#0B1730] text-white rounded-xl border border-[#0047FF]/20 focus:outline-none focus:border-[#FF5C00] text-sm"
                >
            </div>

            <!-- Submit buttons -->
            <div class="flex items-end">
                <button type="submit" class="w-full py-2.5 bg-gradient-to-r from-[#0047FF] to-[#FF5C00] hover:from-[#0B57FF] hover:to-[#FF6B00] text-white font-bold rounded-xl text-sm transition duration-300 flex items-center justify-center gap-2 hover:shadow-[0_0_15px_rgba(255,92,0,0.3)]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Concert Grid -->
    @if(count($konser) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            @foreach($konser as $concert)
                @php
                    $sisaTiket = $concert->kategoriTiket->sum('sisa_kuota');
                    $hargaMin = $concert->kategoriTiket->min('harga') ?? 0;
                @endphp
                <div class="bg-[#0B1730]/60 border border-[#0047FF]/20 rounded-3xl overflow-hidden hover:border-[#FF5C00]/50 transition-all duration-500 hover:-translate-y-2 group flex flex-col justify-between hover:shadow-[0_10px_40px_rgba(255,92,0,0.12)]">
                    <!-- Image -->
                    <div class="relative overflow-hidden aspect-[3/4] bg-[#081224]">
                        @if($concert->poster)
                            <img src="{{ asset('storage/' . $concert->poster) }}" 
                                 alt="{{ $concert->nama_konser }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center gap-3 text-[#94A3B8]">
                                <svg class="w-14 h-14 text-[#0047FF]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1730] via-transparent to-transparent opacity-60 pointer-events-none"></div>

                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4 z-10">
                            @if($sisaTiket > 0)
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-[#0047FF]/90 text-white backdrop-blur-sm border border-[#0047FF]/30">
                                    Available
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-500/90 text-white backdrop-blur-sm border border-red-400/30">
                                    Sold Out
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-lg text-white group-hover:text-[#FF5C00] transition line-clamp-1 mb-1">{{ $concert->nama_konser }}</h3>
                            
                            <!-- Artists -->
                            <p class="text-[#0047FF] font-semibold text-xs mb-4">
                                @if(isset($concert->artis) && $concert->artis->count() > 0)
                                    {{ $concert->artis->pluck('nama_artis')->implode(', ') }}
                                @else
                                    {{ $concert->nama_konser }}
                                @endif
                            </p>

                            <!-- Date & Location -->
                            <div class="space-y-2 text-xs text-[#94A3B8] mb-6">
                                <div class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-[#FF5C00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ $concert->lokasi }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($concert->tanggal_konser)->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Price & Buy Button -->
                        <div class="pt-4 border-t border-white/5 flex items-center justify-between gap-2">
                            <div>
                                <p class="text-[10px] text-[#94A3B8] uppercase tracking-wider">Mulai dari</p>
                                <p class="font-bold text-sm text-[#FF5C00]">Rp {{ number_format($hargaMin, 0, ',', '.') }}</p>
                            </div>
                            
                            @if($sisaTiket > 0)
                                <a href="{{ route('concert.detail', $concert->id) }}" class="bg-[#0047FF] hover:bg-[#0B57FF] text-white px-4 py-2 rounded-xl text-xs font-bold transition duration-300 hover:shadow-[0_0_10px_rgba(0,71,255,0.5)]">
                                    Pesan
                                </a>
                            @else
                                <button disabled class="bg-[#0B1730] text-[#94A3B8]/50 border border-white/5 px-4 py-2 rounded-xl text-xs font-bold cursor-not-allowed">
                                    Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            {{ $konser->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-24 bg-[#081224]/30 border border-[#0047FF]/10 rounded-3xl p-12">
            <svg class="w-20 h-20 mx-auto text-[#94A3B8]/30 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <h2 class="font-display font-bold text-2xl text-white mb-2">Konser Tidak Ditemukan</h2>
            <p class="text-[#94A3B8] text-base mb-8 max-w-md mx-auto">Coba cari dengan kata kunci yang berbeda atau gunakan filter kota lainnya.</p>
            <a href="{{ route('home') }}" class="bg-gradient-to-r from-[#0047FF] to-[#FF5C00] hover:from-[#0B57FF] hover:to-[#FF6B00] text-white px-6 py-3 rounded-xl font-bold text-sm transition duration-300 hover:shadow-[0_0_20px_rgba(255,92,0,0.4)] inline-block">
                Kembali ke Beranda
            </a>
        </div>
    @endif
</div>
</div>
@endsection
