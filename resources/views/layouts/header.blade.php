{{-- 
    Header Transparan Dinamis 
    - Transparan di Beranda (/) sebelum scroll
    - Solid di Beranda setelah scroll > 10px
    - Selalu Solid di halaman selain Beranda
--}}
<header x-data="{
    isHome: {{ request()->is('/') ? 'true' : 'false' }},
    scrolled: false
}" x-init="{{-- Inisialisasi status saat halaman dimuat --}}
if (!isHome) {
    scrolled = true;
} else {
    scrolled = window.pageYOffset > 10;
}" @scroll.window="if (isHome) scrolled = (window.pageYOffset > 10)"
    :class="scrolled ? 'bg-blue-900 border-blue-800 shadow-lg py-0' : 'bg-transparent border-transparent shadow-none py-2'"
    class="fixed top-0 z-50 w-full border-b transition-all duration-500 ease-in-out">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ open: false }">

        <div class="flex justify-between items-center h-20">

            {{-- LOGO & NAMA DINAS --}}
            <div class="flex items-center shrink-0 group cursor-pointer py-1">
                <a href="/" class="flex items-center gap-4 relative">
                    {{-- Efek Glow saat Hover --}}
                    <div
                        class="absolute -inset-2 bg-blue-400/10 blur-lg rounded-full opacity-0 group-hover:opacity-100 transition duration-500 pointer-events-none">
                    </div>

                    <img src="{{ asset('images/logo/sulteng-cikasda.png') }}" alt="Logo Sulteng"
                        class="relative h-18 sm:h-20 w-auto object-contain transition-transform duration-300 group-hover:scale-105 drop-shadow-md z-10">

                    <div class="h-8 sm:h-10 w-[1.5px] bg-slate-500/50 rounded-full z-10"></div>

                    <div class="flex flex-col justify-center z-10">
                        <h1 class="font-black leading-[1.1] tracking-wide uppercase drop-shadow-sm">
                            <span class="text-white text-xs sm:text-[15px] block uppercase">Dinas Cipta Karya dan Sumber
                                Daya Air</span>
                        </h1>
                        <div
                            class="flex items-center mt-1 space-x-1.5 opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                            <span
                                class="text-yellow-400 text-[10px] sm:text-[12px] font-bold uppercase tracking-[0.25em]">Provinsi
                                Sulawesi Tengah</span>
                        </div>
                    </div>
                </a>
            </div>

            {{-- MENU DESKTOP (File terpisah) --}}
            @include('layouts.dropdown-menu')

            {{-- TOMBOL MOBILE --}}
            <div class="lg:hidden flex items-center">
                <button @click="open = !open"
                    class="p-2 rounded-lg text-white hover:bg-blue-800 focus:outline-none transition">
                    <svg class="h-6 w-6" x-show="!open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="h-6 w-6" x-show="open" style="display: none;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

        </div>
    </nav>

    {{-- MENU MOBILE DROPDOWN --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4" style="display: none;"
        class="lg:hidden bg-blue-900 border-t border-blue-800 shadow-inner overflow-hidden">
        <div class="px-4 py-4 space-y-2">
            <a href="/"
                class="block px-4 py-3 rounded-xl text-sm font-black uppercase tracking-widest {{ request()->is('/') ? 'text-yellow-400 bg-blue-950 shadow-inner' : 'text-white hover:bg-blue-800' }} transition-all">Beranda</a>
            <a href="/profil/struktur-organisasi"
                class="block px-4 py-3 rounded-xl text-sm font-bold uppercase tracking-widest {{ request()->is('profil*') ? 'text-yellow-400 bg-blue-950 shadow-inner' : 'text-white hover:bg-blue-800' }} transition-all">Profil</a>
            <a href="/galeri/foto"
                class="block px-4 py-3 rounded-xl text-sm font-bold uppercase tracking-widest {{ request()->is('galeri*') ? 'text-yellow-400 bg-blue-950 shadow-inner' : 'text-white hover:bg-blue-800' }} transition-all">Galeri</a>
            <a href="/informasi/publikasi"
                class="block px-4 py-3 rounded-xl text-sm font-bold uppercase tracking-widest {{ request()->is('informasi*') ? 'text-yellow-400 bg-blue-950 shadow-inner' : 'text-white hover:bg-blue-800' }} transition-all">Informasi
                Publik</a>
            <a href="/ppid/surat-keputusan"
                class="block px-4 py-3 rounded-xl text-sm font-bold uppercase tracking-widest {{ request()->is('ppid*') ? 'text-yellow-400 bg-blue-950 shadow-inner' : 'text-white hover:bg-blue-800' }} transition-all">PPID</a>
            <a href="#"
                class="block px-4 py-3 rounded-xl text-sm font-bold uppercase tracking-widest {{ request()->is('layanan*') ? 'text-yellow-400 bg-blue-950 shadow-inner' : 'text-white hover:bg-blue-800' }} transition-all">Layanan</a>
        </div>
    </div>
</header>
