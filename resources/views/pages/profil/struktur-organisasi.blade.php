@extends('layouts.app')

@section('content')
    {{-- CONTAINER UTAMA: Full Screen Vertical Layout --}}
    <div class="relative w-full min-h-screen bg-slate-900 flex flex-col pt-32 pb-20 lg:pt-36 lg:pb-28 overflow-hidden">

        {{-- Background Image & Overlay --}}
        <div class="absolute inset-0 z-0">
            {{-- Sesuaikan dengan foto asli gedung CIKASDA milikmu --}}
            <img src="{{ asset('images/slider/slide1.png') }}" alt="Background CIKASDA"
                class="w-full h-full object-cover object-center grayscale-20">

            {{-- Overlay Gelap: Gradasi dari atas ke bawah --}}
            <div class="absolute inset-0 bg-slate-900/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-linear-to-b from-slate-950/50 via-slate-900/90 to-slate-950"></div>
        </div>

        {{-- Grid Konten (Atas Teks, Bawah Bagan) --}}
        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col">

            {{-- BAGIAN ATAS: Teks & Deskripsi --}}
            <div class="w-full max-w-3xl mb-12 lg:mb-16">

                {{-- Breadcrumb Navigasi --}}
                <nav class="flex items-center space-x-3 mb-6" aria-label="Breadcrumb">
                    <span class="text-[10px] sm:text-xs font-bold text-slate-300 uppercase tracking-widest cursor-default">
                        Profil
                    </span>
                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-[10px] sm:text-xs font-bold text-blue-400 uppercase tracking-widest cursor-default">
                        Struktur Organisasi
                    </span>
                </nav>

                {{-- Judul --}}
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight mb-6 leading-[1.1]">
                    Struktur Organisasi
                </h1>

                {{-- Deskripsi dari Database --}}
                <div class="text-sm md:text-base lg:text-lg text-slate-300 leading-relaxed font-medium">
                    {{ $item->konten ?? 'Struktur Organisasi Dinas Cipta Karya dan Sumber Daya Air Provinsi Sulawesi Tengah ditetapkan berdasarkan peraturan daerah yang berlaku, guna menjamin terciptanya tata kelola instansi yang responsif dan akuntabel dalam pembangunan infrastruktur daerah.' }}
                </div>
            </div>

            {{-- BAGIAN BAWAH: Jendela Bagan ala macOS (Membentang Lebar) --}}
            <div class="w-full">
                <div
                    class="bg-white rounded-4xl shadow-[0_30px_60px_-15px_rgba(0,0,0,0.6)] overflow-hidden border border-slate-100 ring-1 ring-white/10">

                    {{-- Top Bar Frame (Titik macOS & Label) --}}
                    <div
                        class="bg-slate-50/80 backdrop-blur-md border-b border-slate-200 px-6 py-4 flex items-center justify-between z-10">
                        <div class="flex items-center space-x-4">
                            {{-- Titik Aksen --}}
                            <div class="flex space-x-1.5">
                                <div class="w-3 h-3 rounded-full bg-slate-300"></div>
                                <div class="w-3 h-3 rounded-full bg-blue-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                            </div>
                            <div class="h-4 w-px bg-slate-300"></div>
                            <span class="text-[10px] font-bold text-slate-500 tracking-[0.2em] uppercase">Bagan Resmi</span>
                        </div>
                        <div class="hidden sm:flex items-center space-x-2">
                            <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest">
                                Dinas Cipta Karya & Sumber Daya Air
                            </span>
                            {{-- Ikon kecil pemanis --}}
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                    </div>

                    {{-- Area Konten Jendela --}}
                    <div class="p-6 lg:p-12">
                        {{-- Judul Dalam Kartu --}}
                        <div class="text-center mb-8 lg:mb-12">
                            <h2 class="text-2xl font-black text-slate-900 uppercase tracking-widest relative inline-block">
                                Bagan Organisasi
                                <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 h-1 w-12 bg-blue-600 rounded-full">
                                </div>
                            </h2>
                        </div>

                        {{-- Gambar Bagan dengan Zoom --}}
                        <div
                            class="relative group cursor-zoom-in w-full bg-slate-50 border border-slate-100 rounded-2xl p-4 sm:p-8 overflow-hidden shadow-inner">

                            @if (isset($item) && $item->gambar_path)
                                <img src="{{ Storage::url($item->gambar_path) }}" alt="Bagan Struktur Organisasi CIKASDA"
                                    class="w-full h-auto object-contain transition-transform duration-1000 group-hover:scale-[1.02] relative z-10">
                            @else
                                <img src="https://via.placeholder.com/1600x800.png?text=Bagan+belum+tersedia"
                                    alt="Bagan Struktur Organisasi CIKASDA" class="w-full h-auto opacity-40 relative z-10">
                            @endif

                            {{-- Efek Hover untuk Zoom --}}
                            <div
                                class="absolute inset-0 bg-blue-950/0 group-hover:bg-blue-950/10 transition-all duration-500 flex items-center justify-center z-20 backdrop-blur-[1px] opacity-0 group-hover:opacity-100">
                                <span
                                    class="bg-white/95 text-blue-900 px-6 py-3 rounded-xl font-black shadow-2xl text-xs uppercase tracking-[0.2em] border border-blue-100 flex items-center translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7">
                                        </path>
                                    </svg>
                                    Perbesar Bagan
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
