@extends('layouts.app')

@section('content')
    {{-- ==================================================================
         JUMBOTRON HEADER PREMIUM (TEMA GEDUNG KONSISTEN)
         ================================================================== --}}
    <div class="relative w-full bg-slate-900 flex flex-col pt-32 pb-16 lg:pt-36 lg:pb-20 overflow-hidden">

        {{-- Background Image & Overlay Gradasi --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/slider/slide1.png') }}" alt="Background CIKASDA"
                class="w-full h-full object-cover object-center grayscale-20">

            <div class="absolute inset-0 bg-slate-900/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/50 via-slate-900/90 to-slate-950"></div>
        </div>

        {{-- Isi Konten Teks Header --}}
        <div class="relative z-10 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 flex flex-col justify-end min-h-[140px]">
            <div class="flex items-center space-x-2 text-[10px] sm:text-xs font-black tracking-widest uppercase">
                <span class="text-slate-400">PROFIL</span>
                <span class="text-slate-500 font-medium">›</span>
                <span class="text-blue-400">SEJARAH SINGKAT</span>
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight mt-3 mb-4 drop-shadow-md">
                Sejarah Singkat
            </h1>

            <p class="text-slate-300 text-xs sm:text-sm md:text-base font-medium max-w-4xl leading-relaxed opacity-90">
                Lini masa perjalanan, metamorfosis struktur instansi, dan rekam jejak historis Dinas Cipta Karya dan Sumber
                Daya Air Provinsi Sulawesi Tengah dari masa ke masa.
            </p>
        </div>
    </div>


    {{-- ==================================================================
         KONTEN UTAMA DENGAN MAC-STYLE BROWSER WRAPPER KONSISTEN
         ================================================================== --}}
    <div class="bg-slate-950 min-h-screen py-12 lg:py-20 -mt-1 relative z-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- MAC-STYLE BROWSER CONTAINER --}}
            <div
                class="w-full bg-white rounded-3xl shadow-[0_25px_60px_-15px_rgba(0,0,0,0.5)] border border-slate-800/20 overflow-hidden">

                {{-- TOP BAR BROWSER (Tiga Titik Mac & Nama Dinas) --}}
                <div class="px-6 py-4 bg-white border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center space-x-2 shrink-0">
                        <span class="w-3 h-3 rounded-full bg-red-400 block shadow-xs"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-400 block shadow-xs"></span>
                        <span class="w-3 h-3 rounded-full bg-green-400 block shadow-xs"></span>
                        <span
                            class="text-[11px] text-slate-400 font-bold uppercase tracking-wider pl-4 border-l border-slate-100 ml-2">
                            HISTORALIS RESMI
                        </span>
                    </div>
                    <div
                        class="flex items-center space-x-2 text-slate-500 font-extrabold text-[10px] sm:text-xs uppercase tracking-wider">
                        <span>DINAS CIPTA KARYA & SUMBER DAYA AIR</span>
                        <svg class="w-4 h-4 text-blue-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>

                {{-- CORE JUDUL TENGAH --}}
                <div class="text-center pt-12 pb-4">
                    <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight inline-block relative">
                        REKAM JEJAK SEJARAH DINAS
                        <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 h-1 w-10 bg-blue-600 rounded-full"></div>
                    </h2>
                </div>

                {{-- INSIDE CONTAINER DENGAN STRUKTUR ADAPTIF FLUID (HANYA MUNCUL JIKA DIISI ADMIN) --}}
                <div class="p-8 sm:p-12 lg:p-16 pt-6 space-y-12">

                    {{-- ==========================================
                         KOMPONEN 1: DATA NASKAH TEKS
                         ========================================== --}}
                    @if (isset($item->konten) && !empty(trim($item->konten)) && $item->konten !== '<p><br></p>')
                        <div class="w-full">
                            <div
                                class="prose prose-slate max-w-none break-words text-slate-700 leading-relaxed font-medium 
                                        prose-headings:font-black prose-headings:text-slate-900 prose-p:text-base sm:prose-p:text-lg
                                        prose-ol:space-y-4 prose-ul:space-y-4 prose-li:text-base sm:prose-li:text-lg">
                                {!! $item->konten !!}
                            </div>
                        </div>
                    @endif

                    {{-- GARIS PEMBATAS OTOMATIS TEKS & GAMBAR --}}
                    @if (isset($item->konten) &&
                            !empty(trim($item->konten)) &&
                            $item->konten !== '<p><br></p>' &&
                            (($item->gambar_path && \Storage::disk('public')->exists($item->gambar_path)) ||
                                ($item->pdf_path && \Storage::disk('public')->exists($item->pdf_path))))
                        <hr class="border-slate-100 my-8">
                    @endif

                    {{-- ==========================================
                         KOMPONEN 2: DATA GAMBAR ARSIP LAWAS
                         ========================================== --}}
                    @if ($item->gambar_path && \Storage::disk('public')->exists($item->gambar_path))
                        <div class="w-full">
                            <div class="w-full bg-slate-50 border border-slate-200/80 rounded-2xl p-4 sm:p-6 shadow-inner">
                                <div
                                    class="relative group cursor-zoom-in overflow-hidden rounded-xl border border-white w-full flex justify-center bg-white shadow-xs">
                                    <img src="{{ asset('storage/' . $item->gambar_path) }}"
                                        alt="Dokumentasi Sejarah Dinas CIKASDA"
                                        class="w-full h-auto max-h-[850px] object-contain mx-auto transition-transform duration-1000 group-hover:scale-[1.015]">

                                    <div
                                        class="absolute inset-0 bg-blue-950/0 group-hover:bg-blue-950/15 transition-all duration-500 flex items-center justify-center">
                                        <span
                                            class="bg-white/95 backdrop-blur-xs text-blue-900 px-6 py-3 rounded-xl font-black shadow-xl opacity-0 group-hover:opacity-100 translate-y-3 group-hover:translate-y-0 transition-all duration-500 text-xs uppercase tracking-[0.2em] border border-blue-100">
                                            Perbesar Gambar
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- GARIS PEMBATAS OTOMATIS GAMBAR & PDF --}}
                    @if (
                        $item->gambar_path &&
                            \Storage::disk('public')->exists($item->gambar_path) &&
                            ($item->pdf_path && \Storage::disk('public')->exists($item->pdf_path)))
                        <hr class="border-slate-100 my-8">
                    @endif

                    {{-- ==========================================
                         KOMPONEN 3: DATA DOKUMEN PDF REGULASI
                         ========================================== --}}
                    @if ($item->pdf_path && \Storage::disk('public')->exists($item->pdf_path))
                        <div class="w-full">
                            <div
                                class="w-full bg-gradient-to-r from-red-50/50 via-slate-50 to-red-50/20 border border-slate-200 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xs">
                                <div
                                    class="flex items-center space-x-4 text-center sm:text-left flex-col sm:flex-row gap-4 sm:gap-0">
                                    <div
                                        class="h-14 w-14 bg-white border border-slate-200 rounded-xl flex items-center justify-center shrink-0 shadow-2xs">
                                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="text-base font-black text-slate-900 tracking-tight">Peraturan Daerah /
                                            Peraturan Gubernur Terkait Pembentukan Dinas</h5>
                                        <p class="text-xs text-slate-500 font-semibold mt-0.5">Unduh berkas PDF regulasi
                                            untuk melihat berkas hukum sejarah pendirian lengkap.</p>
                                    </div>
                                </div>

                                <a href="{{ asset('storage/' . $item->pdf_path) }}" target="_blank"
                                    class="shrink-0 w-full sm:w-auto text-center bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-widest px-6 py-4 rounded-xl shadow-md shadow-red-600/10 hover:shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                                    Download PDF
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- FALLBACK SAFETY: JIKA DATA KOSONG TOTAL --}}
                    @if (
                        (!isset($item->konten) || empty(trim($item->konten)) || $item->konten === '<p><br></p>') &&
                            (!$item->gambar_path || !\Storage::disk('public')->exists($item->gambar_path)) &&
                            (!$item->pdf_path || !\Storage::disk('public')->exists($item->pdf_path)))
                        <div class="w-full text-center py-12">
                            <div
                                class="h-16 w-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400 shadow-inner">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <h5 class="text-base font-black text-slate-800 tracking-tight">Informasi Belum Tersedia</h5>
                            <p class="text-xs text-slate-400 font-semibold mt-1">Uraian sejarah singkat saat ini sedang
                                dalam proses penyusunan arsip oleh bagian humas dinas.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
