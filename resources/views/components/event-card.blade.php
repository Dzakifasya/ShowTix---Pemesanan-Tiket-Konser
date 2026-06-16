<!-- Event Card Component -->
<div class="bg-[#0B1730] border border-white/5 rounded-[24px] shadow-soft overflow-hidden hover:shadow-[0_10px_30px_rgba(0,71,255,0.15)] hover:border-[#0047FF]/30 transition-all duration-500 hover:-translate-y-2 cursor-pointer group flex flex-col justify-between">
    <!-- Image -->
    <div class="relative overflow-hidden aspect-[3/4] bg-[#050816]">
        @if($concert->poster)
            <img src="{{ asset('storage/' . $concert->poster) }}" 
                 alt="{{ $concert->nama_konser }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        @else
            <div class="w-full h-full flex flex-col items-center justify-center text-[#94A3B8] p-6">
                <svg class="w-12 h-12 mb-2 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-xs font-semibold uppercase tracking-wider text-[#94A3B8] text-center">No Image Available</span>
            </div>
        @endif

        <!-- Availability Badge -->
        <div class="absolute top-4 right-4 z-10">
            @if($concert->kategoriTiket->sum('sisa_kuota') > 0)
                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-[#0047FF] text-white border border-[#0047FF]/30 backdrop-blur-sm">
                    Available
                </span>
            @else
                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-[#FF5C00] text-white border border-[#FF5C00]/30 backdrop-blur-sm">
                    Sold Out
                </span>
            @endif
        </div>
    </div>

    <!-- Content -->
    <div class="p-6 flex-1 flex flex-col justify-between">
        <div>
            <!-- Title -->
            <h3 class="font-bold text-lg text-white mb-2 line-clamp-2 group-hover:text-[#FF6B00] transition-colors duration-300 leading-snug">{{ $concert->nama_konser }}</h3>

            <!-- Artists -->
            <p class="text-xs font-bold text-[#FF5C00] uppercase tracking-wider mb-4 line-clamp-1">
                {{ $concert->artis->pluck('nama_artis')->implode(', ') }}
            </p>

            <!-- Location & Date -->
            <div class="space-y-2 text-sm text-[#94A3B8] mb-6">
                <div class="flex items-center space-x-2.5">
                    <svg class="w-4 h-4 text-[#0047FF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="truncate">{{ $concert->lokasi }}</span>
                </div>
                <div class="flex items-center space-x-2.5">
                    <svg class="w-4 h-4 text-[#0047FF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ $concert->tanggal_konser->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Price & Action -->
        <div class="flex justify-between items-center pt-4 border-t border-white/5">
            <div>
                <p class="text-[10px] text-[#94A3B8] uppercase tracking-widest font-semibold mb-0.5">Mulai dari</p>
                <p class="text-lg font-extrabold text-[#FF6B00]">
                    Rp {{ number_format($concert->kategoriTiket->min('harga'), 0, ',', '.') }}
                </p>
            </div>
            <a href="{{ route('concert.detail', $concert->id) }}" class="px-4 py-2.5 bg-gradient-to-r from-[#0047FF] to-[#FF6B00] hover:from-[#0B57FF] hover:to-[#FF7A00] text-white rounded-xl hover:shadow-[0_0_20px_rgba(0,71,255,0.4),_0_0_20px_rgba(255,92,0,0.4)] transition-all duration-300 text-xs font-bold uppercase tracking-wider">
                Pesan Sekarang
            </a>
        </div>
    </div>
</div>
