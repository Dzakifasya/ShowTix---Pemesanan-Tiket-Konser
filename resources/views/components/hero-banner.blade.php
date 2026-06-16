<!-- Hero Banner Slider Component -->
<section class="relative h-screen max-h-96 md:max-h-[500px] bg-gradient-to-r from-primary-900 to-secondary-900 overflow-hidden"
         x-data="sliderData()"
         @init="init()">
    <!-- Slides -->
    <div class="relative w-full h-full">
        @forelse($banners as $banner)
            <div data-slide class="absolute inset-0 hidden" x-transition>
                <!-- Background Image -->
                @if($banner->poster)
                    <img src="{{ asset('storage/' . $banner->poster) }}" 
                         alt="{{ $banner->nama_konser }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-[#050816] flex flex-col items-center justify-center text-[#94A3B8] p-8">
                        <svg class="w-16 h-16 mb-2 text-[#0047FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm font-semibold uppercase tracking-wider text-[#94A3B8]">No Image Available</span>
                    </div>
                @endif
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-40"></div>

                <!-- Content -->
                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="max-w-2xl">
                            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $banner->nama_konser }}</h1>
                            <p class="text-xl text-gray-200 mb-6">
                                {{ $banner->artis->pluck('nama_artis')->implode(', ') }}
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('concert.detail', $banner->id) }}" 
                                   class="px-6 py-3 bg-gradient-to-r from-[#0047FF] to-[#FF6B00] text-white rounded-lg hover:shadow-[0_0_20px_rgba(0,71,255,0.4)] transition-all duration-300 font-semibold">
                                    Pesan Tiket
                                </a>
                                <button class="px-6 py-3 border-2 border-white text-white rounded-lg hover:bg-white hover:text-primary-900 transition-colors font-semibold">
                                    Info Selengkapnya
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                <p class="text-gray-600">Tidak ada event</p>
            </div>
        @endforelse
    </div>

    <!-- Navigation -->
    <button @click="prevSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 bg-white bg-opacity-50 hover:bg-opacity-75 text-primary-900 p-2 rounded-full transition-all">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    <button @click="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 bg-white bg-opacity-50 hover:bg-opacity-75 text-primary-900 p-2 rounded-full transition-all">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>

    <!-- Pagination Dots -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-10 flex space-x-2">
        @for($i = 0; $i < count($banners); $i++)
            <button data-dot @click="goToSlideByDot({{ $i }})" 
                    class="w-3 h-3 rounded-full transition-all {{ $i === 0 ? 'bg-[#FF5C00] w-8' : 'bg-gray-600' }}">
            </button>
        @endfor
    </div>
</section>

<script>
function sliderData() {
    return {
        currentSlide: 0,
        slides: [],
        autoPlayInterval: null,

        init() {
            this.slides = this.$el.querySelectorAll('[data-slide]');
            if (this.slides.length > 0) {
                this.goToSlide(0);
                this.startAutoPlay();
            }
        },

        goToSlide(index) {
            if (!this.slides.length) return;
            this.currentSlide = (index + this.slides.length) % this.slides.length;
            
            this.slides.forEach((slide, idx) => {
                slide.classList.toggle('hidden', idx !== this.currentSlide);
            });

            const dots = this.$el.querySelectorAll('[data-dot]');
            dots.forEach((dot, idx) => {
                dot.classList.toggle('bg-[#FF5C00]', idx === this.currentSlide);
                dot.classList.toggle('w-8', idx === this.currentSlide);
                dot.classList.toggle('bg-gray-600', idx !== this.currentSlide);
            });
        },

        nextSlide() {
            this.goToSlide(this.currentSlide + 1);
            this.resetAutoPlay();
        },

        prevSlide() {
            this.goToSlide(this.currentSlide - 1);
            this.resetAutoPlay();
        },

        goToSlideByDot(index) {
            this.goToSlide(index);
            this.resetAutoPlay();
        },

        startAutoPlay() {
            this.autoPlayInterval = setInterval(() => {
                this.nextSlide();
            }, 5000);
        },

        resetAutoPlay() {
            clearInterval(this.autoPlayInterval);
            this.startAutoPlay();
        }
    };
}
</script>
