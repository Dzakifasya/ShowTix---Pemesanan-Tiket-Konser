// Slider component for hero banners
export default function sliderComponent() {
    return {
        currentSlide: 0,
        slides: [],
        autoPlayInterval: null,
        autoPlayDelay: 5000,

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
                slide.classList.toggle('animate-fade-in', idx === this.currentSlide);
            });

            // Update pagination
            const dots = this.$el.querySelectorAll('[data-dot]');
            dots.forEach((dot, idx) => {
                dot.classList.toggle('bg-secondary-900', idx === this.currentSlide);
                dot.classList.toggle('bg-gray-300', idx !== this.currentSlide);
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
            }, this.autoPlayDelay);
        },

        resetAutoPlay() {
            clearInterval(this.autoPlayInterval);
            this.startAutoPlay();
        },

        destroy() {
            clearInterval(this.autoPlayInterval);
        }
    };
}
