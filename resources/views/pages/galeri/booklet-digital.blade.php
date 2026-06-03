@extends('layouts.app') {{-- Menyesuaikan dengan master layout utama user kamu --}}

@section('title', 'Booklet & Brosur Digital')

@section('content')
    <div class="bg-slate-50 min-h-screen pb-16 font-sans">

        {{-- ==================================================================
         1. HERO SECTION GEDUNG UTAMA (SINKRON TOTAL 100% SERASI)
         ================================================================== --}}
        <div class="relative w-full overflow-hidden pt-32 pb-48 lg:pt-40 lg:pb-64 bg-blue-900">
            {{-- Background Image --}}
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/slider/slide1.png') }}" alt="Background CIKASDA"
                    class="w-full h-full object-cover object-center scale-105 transform">
                <div class="absolute inset-0 bg-blue-950/80 mix-blend-multiply"></div>
                {{-- Efek Shadow Gradasi Biru Atas ke Bawah --}}
                <div class="absolute inset-0 bg-linear-to-b from-blue-900/60 to-transparent"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="w-full flex flex-col items-start text-left">
                    {{-- Breadcrumb (Beautified) --}}
                    <div
                        class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-4 py-2 text-blue-100 text-xs md:text-sm mb-8 font-medium shadow-sm">
                        <a href="{{ url('/') }}" class="hover:text-white transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            Beranda
                        </a>
                        <svg class="w-3.5 h-3.5 text-blue-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="hover:text-white transition-colors cursor-pointer">Galeri</span>
                        <svg class="w-3.5 h-3.5 text-blue-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-white font-semibold">Booklet Digital</span>
                    </div>

                    {{-- Judul Utama Besar Premium --}}
                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold font-heading text-white mb-6 tracking-tight relative uppercase">
                        Booklet & Brosur Digital
                    </h1>

                    {{-- Deskripsi Rata Kiri Dengan Border-L Khas Dinas --}}
                    <div
                        class="text-blue-100 text-sm md:text-base leading-relaxed mb-8 max-w-2xl mt-2 pl-4 border-l-2 border-blue-500/50">
                        Pusat unduhan berkas infografis, brosur layanan masyarakat, laporan akuntabilitas, serta booklet
                        digital resmi CIKASDA Provinsi Sulawesi Tengah.
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================================================================
         2. GRIDS BOOKLET RESPONSIVE (CONTAINER PUTIH UTUH MEMBENTANG LUAS)
         ================================================================== --}}
        {{-- KUNCI PERBAIKAN: Dinaikkan -mt-24 md:-mt-32 agar menabrak hero gedung secara konsisten --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 md:-mt-32 relative z-20">
            <div
                class="bg-white rounded-[2rem] p-6 sm:p-8 md:p-12 shadow-[0_15px_50px_rgba(15,23,42,0.04)] border border-slate-200/60 min-h-[50vh]">

                {{-- Judul Seksi Kecil Internal --}}
                <div class="flex items-center space-x-2.5 mb-8 px-1">
                    <span class="h-4 w-1 bg-blue-600 rounded-full shadow-xs"></span>
                    <h2 class="text-xs md:text-sm font-black text-slate-800 uppercase tracking-widest">Arsip Publikasi
                        Dokumen Digital</h2>
                </div>

                {{-- Grid Card Loop --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($booklets ?? [] as $booklet)
                        {{-- CARD CONTAINER MULTIMEDIA BOOKLET --}}
                        <div
                            class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-[0_4px_15px_rgba(15,23,42,0.02)] hover:shadow-[0_12px_25px_rgba(15,23,42,0.06)] group hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">

                            {{-- Visual Cover Dokumen Premium Simbolik --}}
                            <div
                                class="aspect-video w-full bg-gradient-to-br from-slate-50 to-slate-100 relative overflow-hidden flex flex-col items-center justify-center p-6 border-b border-slate-100/80 group-hover:from-blue-50/50 group-hover:to-blue-100/30 transition-colors duration-300">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-white border border-slate-200 shadow-2xs flex items-center justify-center text-2xl transform group-hover:scale-110 transition-transform duration-300">
                                    @if ($booklet->file_pdf)
                                        📕
                                    @else
                                        🌐
                                    @endif
                                </div>
                                <span
                                    class="text-[9px] font-black tracking-widest uppercase text-slate-400 mt-4 bg-slate-200/50 group-hover:bg-blue-600 group-hover:text-white px-2.5 py-0.5 rounded transition-colors">
                                    {{ $booklet->file_pdf ? 'PDF Document' : 'Tautan Publik' }}
                                </span>
                            </div>

                            {{-- Informasi Metadata Judul & Deskripsi --}}
                            <div class="p-6 flex-1 flex flex-col justify-between space-y-5 bg-white">
                                <div class="space-y-2">
                                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest block">
                                        Diperbarui: {{ $booklet->created_at->format('d M Y') }}
                                    </span>
                                    <h3
                                        class="text-base font-black text-slate-800 uppercase tracking-tight leading-snug break-words line-clamp-2 group-hover:text-blue-600 transition-colors">
                                        {{ $booklet->judul_booklet }}
                                    </h3>
                                    <p class="text-xs text-slate-400 font-medium leading-relaxed line-clamp-2">
                                        {{ $booklet->deskripsi_booklet ?? 'Tidak ada rincian ringkasan deskripsi tambahan mengenai dokumen booklet digital ini.' }}
                                    </p>
                                </div>

                                {{-- ACTION INTERAKTIF GANDA BERKELAS --}}
                                <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                                    @if ($booklet->file_pdf)
                                        {{-- Jika PDF: Sediakan Baca Online & Unduh langsung --}}
                                        <a href="{{ asset('storage/' . $booklet->file_pdf) }}" target="_blank"
                                            class="flex-1 text-center px-4 py-2.5 bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-100 font-black text-[11px] uppercase tracking-wider rounded-xl transition-all shadow-3xs">
                                            👀 Baca Online
                                        </a>
                                        <a href="{{ asset('storage/' . $booklet->file_pdf) }}" download
                                            class="px-3 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 border border-slate-200 rounded-xl transition-all"
                                            title="Download File PDF">
                                            📥
                                        </a>
                                    @else
                                        {{-- Jika Tautan External (Google Drive/FlipHTML): Tembak ke link aslinya --}}
                                        <a href="{{ $booklet->url_external }}" target="_blank"
                                            class="w-full text-center px-4 py-2.5 bg-emerald-50 hover:bg-emerald-600 text-emerald-600 hover:text-white border border-emerald-100 font-black text-[11px] uppercase tracking-wider rounded-xl transition-all shadow-3xs">
                                            🔗 Buka Tautan Dokumen
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @empty
                        {{-- TAMPILAN JIKA BELUM ADA DATA BOOKLET --}}
                        <div class="col-span-full py-16 text-center space-y-4 max-w-md mx-auto">
                            <div
                                class="w-14 h-14 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center mx-auto text-blue-500 shadow-3xs">
                                <svg class="w-7 h-7 stroke-[1.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest">Belum Ada Dokumen Terbit
                            </h3>
                            <p class="text-xs text-slate-400 font-medium leading-relaxed">Arsip berkas booklet informasi
                                dinas saat ini belum tersedia atau sedang diperbarui oleh administrator.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

    </div>
@endsection
