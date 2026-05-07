<section x-data="{
    activeSlide: 1,
    slides: [
        { id: 1, img: '{{ asset('images/slider/slide1.png') }}' },
        { id: 2, img: '{{ asset('images/slider/slide2.png') }}' },
        { id: 3, img: '{{ asset('images/slider/slide3.jpg') }}' },
        { id: 4, img: '{{ asset('images/slider/slide4.png') }}' },
        { id: 5, img: '{{ asset('images/slider/slide5.png') }}' }
    ],
    next() { this.activeSlide = this.activeSlide === this.slides.length ? 1 : this.activeSlide + 1 },
    prev() { this.activeSlide = this.activeSlide === 1 ? this.slides.length : this.activeSlide - 1 },
    init() { setInterval(() => this.next(), 7000) }
}" class="relative bg-[#0f172a] h-screen min-h-137.5 max-h-175 overflow-hidden">

    {{-- Layer Background Slider --}}
    <div class="absolute inset-0 z-0">
        <template x-for="slide in slides" :key="slide.id">
            <div x-show="activeSlide === slide.id" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-800" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="absolute inset-0">
                <img :src="slide.img" class="w-full h-full object-cover">
            </div>
        </template>
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <div class="absolute inset-0 bg-linear-to-t from-[#0f172a]/90 via-[#0f172a]/40 to-transparent z-10"></div>
    </div>

    {{-- Layer Konten Utama --}}
    <div class="relative w-full h-full flex flex-col items-center justify-center text-center z-20 px-4 sm:px-6 lg:px-8">
        @include('components.hero-data')
    </div>

    {{-- Navigasi Panah --}}
    <div
        class="absolute inset-y-0 left-0 right-0 flex items-center justify-between px-4 sm:px-8 z-30 pointer-events-none">
        <button @click="prev()"
            class="pointer-events-auto h-12 w-12 sm:h-14 sm:w-14 flex items-center justify-center bg-slate-900/30 hover:bg-yellow-500 text-white hover:text-blue-950 rounded-full border border-white/20 backdrop-blur-md transition-all shadow-xl group">
            <svg class="w-6 h-6 sm:w-7 sm:h-7 group-hover:-translate-x-1 transition-transform" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button @click="next()"
            class="pointer-events-auto h-12 w-12 sm:h-14 sm:w-14 flex items-center justify-center bg-slate-900/30 hover:bg-yellow-500 text-white hover:text-blue-950 rounded-full border border-white/20 backdrop-blur-md transition-all shadow-xl group">
            <svg class="w-6 h-6 sm:w-7 sm:h-7 group-hover:translate-x-1 transition-transform" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    {{-- Indikator Dots --}}
    <div class="absolute bottom-8 sm:bottom-12 left-1/2 -translate-x-1/2 flex items-center space-x-3 z-30">
        <template x-for="slide in slides" :key="slide.id">
            <button @click="activeSlide = slide.id"
                class="transition-all duration-500 rounded-full border border-white/30"
                :class="activeSlide === slide.id ? 'w-12 h-2.5 bg-yellow-400 shadow-[0_0_12px_rgba(250,204,21,0.6)]' :
                    'w-2.5 h-2.5 bg-white/40 hover:bg-white/80'"></button>
        </template>
    </div>

    <x-wave-divider />
</section>
