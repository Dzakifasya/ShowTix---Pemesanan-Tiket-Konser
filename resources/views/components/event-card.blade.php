<!-- Event Card Component -->
<div class="bg-white rounded-2xl shadow-soft overflow-hidden hover:shadow-lg transition-all duration-300 hover:scale-105 cursor-pointer group">
    <!-- Image -->
    <div class="relative overflow-hidden h-48">
        <img src="{{ $concert->poster ? asset('storage/' . $concert->poster) : asset('images/placeholder.jpg') }}" 
             alt="{{ $concert->nama_konser }}" 
             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
        @if($concert->kategoriTiket->sum('sisa_kuota') > 0)
            <div class="absolute top-3 right-3 bg-secondary-900 text-white px-3 py-1 rounded-full text-xs font-semibold">
                {{ $concert->kategoriTiket->sum('sisa_kuota') }} Tersedia
            </div>
        @else
            <div class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                Habis
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="p-4">
        <!-- Title -->
        <h3 class="font-bold text-lg text-primary-900 mb-2 line-clamp-2">{{ $concert->nama_konser }}</h3>

        <!-- Artists -->
        <p class="text-sm text-gray-600 mb-3 line-clamp-1">
            {{ $concert->artis->pluck('nama_artis')->implode(', ') }}
        </p>

        <!-- Location & Date -->
        <div class="space-y-2 text-sm text-gray-700 mb-4">
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ $concert->lokasi }}</span>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v2H4a2 2 0 00-2 2v2h16V7a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v2H7V3a1 1 0 00-1-1zm0 5a2 2 0 002 2h8a2 2 0 002-2H6z" clip-rule="evenodd"/>
                </svg>
                <span>{{ $concert->tanggal_konser->format('d M Y') }}</span>
            </div>
        </div>

        <!-- Price -->
        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
            <div>
                <p class="text-xs text-gray-500">Mulai dari</p>
                <p class="text-lg font-bold text-secondary-900">
                    Rp {{ number_format($concert->kategoriTiket->min('harga'), 0, ',', '.') }}
                </p>
            </div>
            <a href="{{ route('concert.detail', $concert->id) }}" class="px-4 py-2 bg-secondary-900 text-white rounded-lg hover:bg-secondary-800 transition-colors text-sm font-semibold">
                Lihat Detail
            </a>
        </div>
    </div>
</div>
