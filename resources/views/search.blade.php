@extends('layouts.app')

@section('title')
Hasil Pencarian - ShowTix
@endsection

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-50 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-[#003D82] transition">Home</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800">Hasil Pencarian</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Search Header -->
    <div class="mb-8">
        <h1 class="font-display font-bold text-4xl text-gray-800 mb-2">
            Hasil Pencarian untuk "{{ request('search', '') }}"
        </h1>
        <p class="text-gray-600">{{ count($konser) }} konser ditemukan</p>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8 sticky top-24 z-40">
        <form method="GET" action="{{ route('search') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Konser</label>
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Nama konser atau artis..." 
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20"
                >
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                <select name="kategori" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20">
                    <option value="">Semua Kategori</option>
                    <option value="musik">Musik</option>
                    <option value="festival">Festival</option>
                    <option value="komedi">Komedi</option>
                </select>
            </div>

            <!-- Location -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                <select name="lokasi" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20">
                    <option value="">Semua Kota</option>
                    <option value="jakarta">Jakarta</option>
                    <option value="surabaya">Surabaya</option>
                    <option value="bandung">Bandung</option>
                </select>
            </div>

            <!-- Date -->
            <div class="flex items-end gap-2">
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                    <input 
                        type="date" 
                        name="tanggal"
                        value="{{ request('tanggal') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20"
                    >
                </div>
                <button type="submit" class="btn-primary text-sm py-2 px-4">
                    <i class="fas fa-search mr-2"></i> Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Concert Grid -->
    @if(count($konser) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @foreach($konser as $concert)
                <div class="card-concert group cursor-pointer">
                    <!-- Image -->
                    <div class="relative overflow-hidden h-48 bg-gray-200">
                        @if($concert->poster)
                            <img src="{{ asset('storage/' . $concert->poster) }}" alt="{{ $concert->nama_konser }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#003D82] to-[#FF6600] flex items-center justify-center">
                                <i class="fas fa-music text-white text-4xl"></i>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        @if($concert->kategoriTiket->sum('sisa_kuota') > 0)
                            <span class="badge-orange absolute top-3 right-3">Tersedia</span>
                        @else
                            <span class="badge absolute top-3 right-3 bg-red-500">Habis</span>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2 text-gray-800 group-hover:text-[#003D82] transition line-clamp-2">{{ $concert->nama_konser }}</h3>
                        
                        <!-- Artists -->
                        <div class="flex flex-wrap gap-1 mb-3">
                            @foreach($concert->artis->take(2) as $artis)
                                <span class="text-xs badge-blue">{{ $artis->nama_artis }}</span>
                            @endforeach
                            @if($concert->artis->count() > 2)
                                <span class="text-xs text-gray-500">+{{ $concert->artis->count() - 2 }} lagi</span>
                            @endif
                        </div>

                        <!-- Date & Location -->
                        <div class="text-sm text-gray-600 space-y-1 mb-3">
                            <p><i class="fas fa-calendar text-[#FF6600] mr-2"></i>{{ \Carbon\Carbon::parse($concert->tanggal_konser)->format('d M Y') }}</p>
                            <p><i class="fas fa-map-marker-alt text-[#FF6600] mr-2"></i>{{ $concert->lokasi }}</p>
                        </div>

                        <!-- Price -->
                        <div class="flex justify-between items-center pt-3 border-t">
                            <div>
                                <p class="text-xs text-gray-500">Mulai dari</p>
                                <p class="font-bold text-lg text-[#003D82]">Rp {{ number_format($concert->kategoriTiket->min('harga') ?? 0, 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('concert.detail', $concert->id) }}" class="btn-primary text-xs py-2 px-3">
                                Pesan
                            </a>
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
        <div class="text-center py-16">
            <i class="fas fa-search text-gray-300 text-8xl mb-4"></i>
            <h2 class="font-display font-bold text-3xl text-gray-800 mb-3">Tidak Ada Hasil</h2>
            <p class="text-gray-600 text-lg mb-8">Coba cari dengan kata kunci yang berbeda</p>
            <a href="{{ route('home') }}" class="btn-primary inline-block">
                <i class="fas fa-home mr-2"></i> Kembali ke Beranda
            </a>
        </div>
    @endif
</div>

@endsection
