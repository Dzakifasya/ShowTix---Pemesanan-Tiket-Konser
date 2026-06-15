@extends('layouts.app')

@section('title')
ShowTix - Platform Tiket Konser Online
@endsection

@section('content')
<!-- Hero Banner Slider -->
@include('components.hero-banner', ['banners' => $banners])

<!-- Search Bar -->
<section class="bg-white py-8 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search Input -->
            <div class="relative">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Konser</label>
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Nama konser atau artis..." 
                           class="w-full px-4 py-3 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:border-secondary-900 focus:ring-2 focus:ring-secondary-900 focus:ring-opacity-20">
                    <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Location Filter -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                <input type="text" id="locationInput" placeholder="Cari berdasarkan kota..." 
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-secondary-900 focus:ring-2 focus:ring-secondary-900 focus:ring-opacity-20">
            </div>

            <!-- Search Button -->
            <div class="flex items-end">
                <button onclick="searchConcerts()" class="w-full px-6 py-3 bg-[#FF6600] text-white rounded-lg hover:bg-orange-600 transition-colors font-semibold">
                    <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Latest Events Section -->
<section class="py-16 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-primary-900">Event Terbaru</h2>
            <a href="#" class="text-secondary-900 font-semibold hover:underline">Lihat Semua →</a>
        </div>

        @if($latestConcerts->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($latestConcerts as $concert)
                    @include('components.event-card', ['concert' => $concert])
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600">Tidak ada event yang tersedia saat ini</p>
            </div>
        @endif
    </div>
</section>

<!-- Recommended Events Section -->
@if($recommendedConcerts->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-primary-900 mb-8">Rekomendasi untuk Anda</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($recommendedConcerts as $concert)
                @include('components.event-card', ['concert' => $concert])
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Destinations Section -->
<section class="py-16 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-primary-900 mb-8">Destinasi Populer</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
            @foreach($destinations as $destination)
                @include('components.destination-card', ['destination' => $destination])
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-primary-900 to-secondary-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-4">Jangan Lewatkan Konser Favorit Anda</h2>
        <p class="text-xl text-gray-200 mb-8">Dapatkan notifikasi untuk event terbaru dan penawaran eksklusif</p>
        <form class="flex max-w-md mx-auto gap-2" method="GET" action="{{ route('search') }}">
            <input type="email" placeholder="Masukkan email Anda..." required
                   class="flex-1 px-4 py-3 rounded-lg text-primary-900 focus:outline-none">
            <button type="submit" class="px-6 py-3 bg-white text-secondary-900 font-semibold rounded-lg hover:bg-gray-100 transition-colors">
                Berlangganan
            </button>
        </form>
    </div>
</section>

<script>
function searchConcerts() {
    const search = document.getElementById('searchInput').value;
    const location = document.getElementById('locationInput').value;
    
    if (search || location) {
        const url = new URL("{{ route('search') }}", window.location.origin);
        if (search) url.searchParams.append('search', search);
        if (location) url.searchParams.append('location', location);
        window.location.href = url.toString();
    }
}

// Allow Enter key to search
document.getElementById('searchInput')?.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') searchConcerts();
});
</script>

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
