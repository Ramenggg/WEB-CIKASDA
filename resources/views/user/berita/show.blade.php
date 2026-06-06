@extends('layouts.app')

@section('content')
    <style>
        /* Quill alignment classes for frontend article content */
        .prose .ql-align-center {
            text-align: center !important;
        }
        .prose .ql-align-right {
            text-align: right !important;
        }
        .prose .ql-align-justify {
            text-align: justify !important;
        }
        .prose .ql-align-left {
            text-align: left !important;
        }
    </style>
    {{-- HERO BANNER DETAIL BERITA (MATCHING STUKTUR ORGANISASI DESIGN & FONTS) --}}
    <div class="relative w-full overflow-hidden pt-20 pb-20 lg:pt-24 lg:pb-24 bg-blue-900">
        {{-- Background Image --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/slider/slide1.png') }}" alt="Background CIKASDA" class="w-full h-full object-cover object-center scale-105 transform">
            <div class="absolute inset-0 bg-blue-950/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-linear-to-b from-blue-900/60 to-transparent"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="w-full flex flex-col items-start text-left">
                {{-- Breadcrumb Capsule --}}
                <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-3 py-1.5 text-blue-100 text-xs mb-4 font-medium shadow-xs">
                    <a href="{{ url('/') }}" class="hover:text-white transition-colors flex items-center">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Beranda
                    </a>
                    <svg class="w-3 h-3 text-blue-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <a href="{{ route('berita.index') }}" class="hover:text-white transition-colors">Berita</a>
                    <svg class="w-3 h-3 text-blue-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="text-white font-semibold">Detail Berita & Artikel</span>
                </div>
                
                {{-- Title with left blue border and font-heading --}}
                <div class="border-l-4 border-blue-500/50 pl-4 md:pl-5 mt-2">
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold font-heading text-white tracking-tight relative">
                        Detail Berita & Artikel
                    </h1>
                </div>
            </div>
        </div>
    </div>

    {{-- KONTEN UTAMA TWO-COLUMN GRID (BELOW HERO) --}}
    <div class="bg-white min-h-screen pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                {{-- LEFT COLUMN: DETAIL ARTIKEL (8/12) --}}
                <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-100 shadow-[0_15px_50px_-15px_rgba(15,23,42,0.06)] p-6 sm:p-10 space-y-6">
                    
                    {{-- Judul Artikel --}}
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 leading-tight">
                        {{ $berita->judul }}
                    </h2>

                    {{-- Metadata Row --}}
                    <div class="flex flex-wrap items-center gap-y-2 gap-x-4 text-[11px] font-bold text-slate-400 border-b border-slate-100 pb-4">
                        {{-- Kategori --}}
                        <span class="text-blue-600 font-extrabold uppercase tracking-wider">
                            {{ $berita->kategori }}
                        </span>
                        
                        <span class="text-slate-300 hidden sm:inline">•</span>

                        {{-- Tanggal --}}
                        <div class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $berita->created_at->translatedFormat('d F Y H:i') }}</span>
                        </div>

                        <span class="text-slate-300 hidden sm:inline">•</span>

                        {{-- Penerbit --}}
                        <div class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>admin</span>
                        </div>

                        <span class="text-slate-300 hidden sm:inline">•</span>

                        {{-- Komentar --}}
                        <div class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <span>0 Komentar</span>
                        </div>
                    </div>

                    @php
                        $sampul = $berita->gambars->first();
                        $galeriLain = $berita->gambars->slice(1);
                    @endphp

                    {{-- Gambar Sampul Utama --}}
                    @if($sampul)
                        <div class="rounded-3xl overflow-hidden border border-slate-200/50 shadow-xs bg-slate-50 aspect-video relative group">
                            <img src="{{ Storage::url($sampul->file_path) }}"
                                alt="{{ $berita->judul }}"
                                class="w-full h-full object-cover">
                        </div>
                    @endif

                    {{-- Konten Artikel --}}
                    <article class="prose prose-slate max-w-none text-slate-700 font-medium leading-relaxed 
                        prose-headings:text-slate-900 prose-headings:font-black prose-headings:tracking-tight 
                        prose-p:leading-relaxed prose-strong:font-black prose-strong:text-slate-900
                        prose-a:text-blue-600 hover:prose-a:text-blue-700 prose-a:font-bold prose-a:no-underline hover:prose-a:underline
                        prose-img:rounded-2xl prose-img:shadow-sm prose-blockquote:border-l-4 prose-blockquote:border-blue-600 
                        prose-blockquote:bg-blue-50/30 prose-blockquote:px-6 prose-blockquote:py-4 prose-blockquote:rounded-r-xl prose-blockquote:text-slate-700">
                        {!! $berita->konten !!}
                    </article>

                    {{-- Galeri Foto Dokumentasi --}}
                    @if($galeriLain->isNotEmpty())
                        <div class="pt-8 border-t border-slate-100 space-y-4">
                            <h3 class="text-xs font-black uppercase text-slate-500 tracking-wider">Galeri Foto Dokumentasi</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                @foreach($galeriLain as $gambar)
                                    <div class="rounded-2xl overflow-hidden border border-slate-200/50 bg-slate-50 shadow-2xs group aspect-4/3 relative cursor-zoom-in">
                                        <img src="{{ Storage::url($gambar->file_path) }}"
                                            alt="Dokumentasi - {{ $berita->judul }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Tombol Kembali --}}
                    <div class="pt-6 border-t border-slate-100">
                        <a href="{{ route('berita.index') }}" 
                           class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-slate-500 hover:text-blue-600 transition group cursor-pointer">
                            <span class="inline-block translate-x-0 group-hover:-translate-x-1 transition-duration-200">&larr;</span>
                            <span>Kembali ke Indeks Berita</span>
                        </a>
                    </div>

                </div>

                {{-- RIGHT COLUMN: SIDEBAR WIDGETS (4/12) --}}
                <div class="lg:col-span-4 space-y-8 lg:sticky lg:top-32">
                    
                    {{-- WIDGET 1: PENCARIAN --}}
                    <div class="bg-sky-50/50 border border-sky-100/50 rounded-3xl p-6 space-y-4 shadow-xs">
                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest border-b border-sky-100 pb-2">
                            Pencarian
                        </h4>
                        <form action="{{ route('berita.index') }}" method="GET" class="relative">
                            <input type="text" name="search" placeholder="Search..." 
                                   class="w-full bg-white border border-slate-200 rounded-xl pl-4 pr-10 py-2.5 text-xs font-bold text-slate-700 placeholder:font-normal outline-none focus:border-blue-500 transition shadow-inner">
                            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-600 transition cursor-pointer">
                                <svg class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                    {{-- WIDGET 2: KATEGORI --}}
                    <div class="bg-sky-50/50 border border-sky-100/50 rounded-3xl p-6 space-y-4 shadow-xs">
                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest border-b border-sky-100 pb-2">
                            Kategori
                        </h4>
                        <ul class="space-y-2.5">
                            @foreach(['Infrastruktur', 'Sumber Daya Air', 'Cipta Karya', 'Kegiatan Dinas', 'Pengumuman'] as $cat)
                                <li>
                                    <a href="{{ route('berita.index') }}?category={{ $cat }}" 
                                       class="flex items-center justify-between text-xs font-bold text-slate-600 hover:text-blue-600 transition">
                                        <span>{{ $cat }}</span>
                                        <span class="px-2 py-0.5 bg-white border border-slate-200/50 rounded-md text-[9px] text-slate-400 font-extrabold shadow-2xs">
                                            {{ \App\Models\Berita::where('status', 'Publish')->where('kategori', $cat)->count() }}
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- WIDGET 3: BERITA TERBARU --}}
                    <div class="bg-sky-50/50 border border-sky-100/50 rounded-3xl p-6 space-y-4 shadow-xs">
                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest border-b border-sky-100 pb-2">
                            Berita Terbaru
                        </h4>
                        <div class="space-y-4">
                            @foreach(\App\Models\Berita::where('status', 'Publish')->latest()->take(3)->get() as $item)
                                <div class="flex gap-3 items-start group">
                                    <div class="w-16 h-12 rounded-lg overflow-hidden bg-slate-50 border border-slate-200/50 shrink-0 relative">
                                        @if($item->sampul && $item->sampul->file_path)
                                            <img src="{{ Storage::url($item->sampul->file_path) }}" 
                                                 alt="{{ $item->judul }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[7px] font-black uppercase text-slate-400">
                                                No img
                                            </div>
                                        @endif
                                    </div>
                                    <div class="space-y-0.5 min-w-0">
                                        <h5 class="text-[11px] font-bold text-slate-800 line-clamp-2 group-hover:text-blue-600 transition leading-snug">
                                            <a href="{{ route('berita.show', $item->slug) }}">{{ $item->judul }}</a>
                                        </h5>
                                        <span class="block text-[9px] font-semibold text-slate-400">
                                            {{ $item->created_at->translatedFormat('d F Y') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
