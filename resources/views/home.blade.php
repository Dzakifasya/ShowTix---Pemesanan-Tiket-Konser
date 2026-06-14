@extends('layouts.app')

@section('title', 'Beranda - ShowTix')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-[#003D82] via-[#0052a3] to-[#FF6600] relative overflow-hidden min-h-[500px] flex items-center">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 1200 600">
            <defs>
                <pattern id="pattern" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse">
                    <circle cx="50" cy="50" r="40" stroke="white" stroke-width="2" fill="none"/>
                </pattern>
            </defs>
            <rect width="1200" height="600" fill="url(#pattern)"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Text Content -->
            <div>
                <h1 class="font-display font-bold text-5xl md:text-6xl text-white mb-6 leading-tight">
                    Temukan Konser<br><span class="text-[#FFD700]">Impian Anda</span>
                </h1>
                <p class="text-xl text-gray-100 mb-8">Nikmati pengalaman berbelanja tiket konser yang mudah, aman, dan menyenangkan. Jangan lewatkan artis favorit Anda!</p>
                <div class="flex gap-4 flex-wrap">
                    <a href="#concerts" class="btn-orange">
                        <i class="fas fa-ticket-alt mr-2"></i> Pesan Sekarang
                    </a>
                    <button class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#003D82] transition-all duration-300">
                        <i class="fas fa-play-circle mr-2"></i> Tonton Demo
                    </button>
                </div>
            </div>

            <!-- Illustration -->
            <div class="relative h-96">
                <div class="absolute inset-0 bg-gradient-to-br from-white to-blue-100 rounded-3xl opacity-20"></div>
                <div class="absolute top-10 right-10 w-48 h-48 bg-white rounded-2xl shadow-2xl transform rotate-6 p-4">
                    <div class="bg-gradient-to-br from-[#003D82] to-[#FF6600] rounded-xl h-full w-full flex items-center justify-center">
                        <i class="fas fa-music text-white text-6xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter & Search Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg p-6 -mt-12 relative z-20 mb-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="relative">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Konser</label>
                <input 
                    type="text" 
                    id="search" 
                    placeholder="Nama konser atau artis..." 
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20"
                >
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                <select class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20">
                    <option value="">Semua Kategori</option>
                    <option value="musik">Musik</option>
                    <option value="festival">Festival</option>
                    <option value="komedi">Komedi</option>
                    <option value="olahraga">Olahraga</option>
                </select>
            </div>

            <!-- Lokasi -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                <select class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20">
                    <option value="">Semua Kota</option>
                    <option value="jakarta">Jakarta</option>
                    <option value="surabaya">Surabaya</option>
                    <option value="bandung">Bandung</option>
                    <option value="medan">Medan</option>
                </select>
            </div>

            <!-- Date Range -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                <input 
                    type="date" 
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#003D82] focus:ring-2 focus:ring-[#003D82] focus:ring-opacity-20"
                >
            </div>
        </div>
    </div>
</section>

<!-- Featured Concerts Carousel Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="font-display font-bold text-4xl mb-2">Konser Terpopuler</h2>
            <p class="text-gray-600">Konser-konser dengan penjualan tiket tertinggi</p>
        </div>
        <div class="flex gap-2">
            <button onclick="carouselPrev()" class="btn-primary rounded-full w-12 h-12 flex items-center justify-center" title="Previous">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button onclick="carouselNext()" class="btn-primary rounded-full w-12 h-12 flex items-center justify-center" title="Next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <!-- Carousel Container -->
    <div class="relative overflow-hidden bg-gray-50 rounded-2xl p-4">
        <div id="carousel" class="flex gap-6 transition-transform duration-500 ease-out">
            @forelse($konserTerpopuler ?? [] as $konser)
                <div class="carousel-item flex-shrink-0 w-full md:w-1/2 lg:w-1/4">
                    <div class="card-concert group cursor-pointer h-full flex flex-col">
                        <!-- Image - Portrait Format -->
                        <div class="relative overflow-hidden bg-gray-200 rounded-xl mb-4" style="aspect-ratio: 3/4;">
                            @if($konser->poster)
                                <img src="{{ asset('storage/' . $konser->poster) }}" alt="{{ $konser->nama_konser }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#003D82] to-[#FF6600] flex items-center justify-center">
                                    <i class="fas fa-music text-white text-5xl"></i>
                                </div>
                            @endif
                            
                            <!-- Status Badge -->
                            @php
                                $sisaTiket = $konser->kategoriTiket->sum('sisa_kuota');
                            @endphp
                            @if($sisaTiket > 0)
                                <span class="badge-orange absolute top-3 right-3 text-sm">{{ $sisaTiket }} Tersedia</span>
                            @else
                                <span class="badge absolute top-3 right-3 bg-red-500 text-sm">Habis</span>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="flex-1 flex flex-col">
                            <h3 class="font-bold text-lg mb-2 text-gray-800 group-hover:text-[#003D82] transition line-clamp-2">{{ $konser->nama_konser }}</h3>
                            
                            <!-- Artists -->
                            <div class="flex flex-wrap gap-1 mb-3">
                                @foreach($konser->artis->take(2) as $artis)
                                    <span class="text-xs badge-blue">{{ $artis->nama_artis }}</span>
                                @endforeach
                                @if($konser->artis->count() > 2)
                                    <span class="text-xs text-gray-500">+{{ $konser->artis->count() - 2 }}</span>
                                @endif
                            </div>

                            <!-- Date & Location -->
                            <div class="text-sm text-gray-600 space-y-1 mb-4 flex-1">
                                <p><i class="fas fa-calendar text-[#FF6600] mr-2"></i>{{ \Carbon\Carbon::parse($konser->tanggal_konser)->format('d M Y') }}</p>
                                <p><i class="fas fa-map-marker-alt text-[#FF6600] mr-2"></i>{{ $konser->lokasi }}</p>
                            </div>

                            <!-- Price & Buttons -->
                            <div class="pt-3 border-t space-y-2">
                                <div>
                                    <p class="text-xs text-gray-500">Mulai dari</p>
                                    <p class="font-bold text-lg text-[#003D82]">Rp {{ number_format($konser->kategoriTiket->min('harga') ?? 0, 0, ',', '.') }}</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('concert.detail', $konser->id) }}" class="flex-1 btn-primary text-xs py-2 text-center rounded-lg transition-all hover:shadow-lg">
                                        <i class="fas fa-ticket-alt mr-1"></i> Pesan
                                    </a>
                                    <button onclick="shareEvent({{ $konser->id }})" class="btn-outline-primary text-xs py-2 px-3 rounded-lg transition-all">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Skeleton Loading -->
                @for($i = 0; $i < 4; $i++)
                    <div class="carousel-item flex-shrink-0 w-full md:w-1/2 lg:w-1/4">
                        <div class="card-concert">
                            <div class="bg-gray-200 shimmer rounded-xl mb-4" style="aspect-ratio: 3/4;"></div>
                            <div class="space-y-3">
                                <div class="h-4 bg-gray-200 shimmer rounded"></div>
                                <div class="h-3 bg-gray-200 shimmer rounded w-2/3"></div>
                                <div class="h-3 bg-gray-200 shimmer rounded"></div>
                                <div class="h-10 bg-gray-200 shimmer rounded mt-4"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>

<!-- Upcoming Concerts Grid Section -->
<section id="concerts" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h2 class="font-display font-bold text-4xl mb-2">Konser Mendatang</h2>
        <p class="text-gray-600">Jangan lewatkan konser-konser spesial berikutnya</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($konserMendatang ?? [] as $konser)
            <div class="card-concert group cursor-pointer h-full flex flex-col">
                <!-- Image - Portrait Format -->
                <div class="relative overflow-hidden bg-gray-200 rounded-xl mb-4" style="aspect-ratio: 3/4;">
                    @if($konser->poster)
                        <img src="{{ asset('storage/' . $konser->poster) }}" alt="{{ $konser->nama_konser }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-[#003D82] to-[#FF6600] flex items-center justify-center">
                            <i class="fas fa-music text-white text-5xl"></i>
                        </div>
                    @endif
                    
                    <!-- Status Badge -->
                    @php
                        $sisaTiket = $konser->kategoriTiket->sum('sisa_kuota');
                    @endphp
                    @if($sisaTiket > 0)
                        <span class="badge-orange absolute top-3 right-3 text-sm">{{ $sisaTiket }} Tersedia</span>
                    @else
                        <span class="badge absolute top-3 right-3 bg-red-500 text-sm">Habis</span>
                    @endif
                </div>

                <!-- Content -->
                <div class="flex-1 flex flex-col">
                    <h3 class="font-bold text-lg mb-2 text-gray-800 group-hover:text-[#003D82] transition line-clamp-2">{{ $konser->nama_konser }}</h3>
                    
                    <!-- Artists -->
                    <div class="flex flex-wrap gap-1 mb-3">
                        @foreach($konser->artis->take(2) as $artis)
                            <span class="text-xs badge-blue">{{ $artis->nama_artis }}</span>
                        @endforeach
                        @if($konser->artis->count() > 2)
                            <span class="text-xs text-gray-500">+{{ $konser->artis->count() - 2 }} lagi</span>
                        @endif
                    </div>

                    <!-- Date & Location -->
                    <div class="text-sm text-gray-600 space-y-1 mb-4 flex-1">
                        <p><i class="fas fa-calendar text-[#FF6600] mr-2"></i>{{ \Carbon\Carbon::parse($konser->tanggal_konser)->format('d M Y') }}</p>
                        <p><i class="fas fa-map-marker-alt text-[#FF6600] mr-2"></i>{{ $konser->lokasi }}</p>
                    </div>

                    <!-- Price & Buttons -->
                    <div class="pt-3 border-t space-y-2">
                        <div>
                            <p class="text-xs text-gray-500">Mulai dari</p>
                            <p class="font-bold text-lg text-[#003D82]">Rp {{ number_format($konser->kategoriTiket->min('harga') ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('concert.detail', $konser->id) }}" class="flex-1 btn-primary text-xs py-2 text-center rounded-lg transition-all hover:shadow-lg">
                                <i class="fas fa-ticket-alt mr-1"></i> Pesan
                            </a>
                            <button onclick="shareEvent({{ $konser->id }})" class="btn-outline-primary text-xs py-2 px-3 rounded-lg transition-all">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-600 text-lg">Belum ada konser mendatang</p>
            </div>
        @endforelse
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="bg-gradient-to-r from-[#003D82] to-[#0052a3] py-16 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display font-bold text-4xl text-white text-center mb-12">Mengapa Memilih ShowTix?</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Feature 1 -->
            <div class="text-center text-white">
                <div class="bg-white bg-opacity-20 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-lock text-4xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-2">Aman & Terpercaya</h3>
                <p class="text-gray-100">Transaksi terenkripsi dan terjamin keamanannya</p>
            </div>

            <!-- Feature 2 -->
            <div class="text-center text-white">
                <div class="bg-white bg-opacity-20 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bolt text-4xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-2">Mudah & Cepat</h3>
                <p class="text-gray-100">Proses pemesanan hanya dalam hitungan menit</p>
            </div>

            <!-- Feature 3 -->
            <div class="text-center text-white">
                <div class="bg-white bg-opacity-20 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-4xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-2">Customer Support 24/7</h3>
                <p class="text-gray-100">Tim support siap membantu kapan saja</p>
            </div>

            <!-- Feature 4 -->
            <div class="text-center text-white">
                <div class="bg-white bg-opacity-20 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-ticket-alt text-4xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-2">E-Ticket Instant</h3>
                <p class="text-gray-100">Dapatkan tiket digital langsung setelah pembayaran</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-gradient-to-r from-[#003D82] to-[#FF6600] rounded-2xl p-12 text-center text-white">
        <h2 class="font-display font-bold text-4xl mb-4">Siap Memesan Tiket?</h2>
        <p class="text-xl mb-8 text-gray-100">Bergabunglah dengan ribuan penggemar yang telah merasakan pengalaman berbelanja tiket terbaik bersama ShowTix</p>
        <a href="#concerts" class="btn-white text-lg">
            <i class="fas fa-arrow-down mr-2"></i> Jelajahi Konser Sekarang
        </a>
    </div>
</section>

@endsection

@push('js')
<script>
let currentPosition = 0;
const carousel = document.getElementById('carousel');
const carouselItems = document.querySelectorAll('.carousel-item');

function getItemsPerView() {
    if (window.innerWidth >= 1024) return 4;
    if (window.innerWidth >= 768) return 2;
    return 1;
}

function updateCarousel() {
    const itemsPerView = getItemsPerView();
    const itemWidth = 100 / itemsPerView;
    carousel.style.transform = `translateX(${-currentPosition * itemWidth}%)`;
}

function carouselNext() {
    const itemsPerView = getItemsPerView();
    const maxPosition = carouselItems.length - itemsPerView;
    if (currentPosition < maxPosition) {
        currentPosition++;
        updateCarousel();
    }
}

function carouselPrev() {
    if (currentPosition > 0) {
        currentPosition--;
        updateCarousel();
    }
}

function shareEvent(eventId) {
    const title = 'Cek konser ini di ShowTix!';
    const url = `${window.location.origin}/concert/${eventId}`;
    
    if (navigator.share) {
        navigator.share({
            title: title,
            url: url
        });
    } else {
        const text = `${title}\n${url}`;
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text);
            alert('Link berhasil disalin!');
        }
    }
}

// Handle window resize
window.addEventListener('resize', updateCarousel);

// Initialize carousel
updateCarousel();
</script>
@endpush
