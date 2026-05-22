@extends('layouts.app')

@section('content')
    {{-- JUMBOTRON HEADER --}}
    <div class="relative w-full bg-slate-900 flex flex-col pt-32 pb-16 lg:pt-36 lg:pb-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/slider/slide1.png') }}" class="w-full h-full object-cover object-center grayscale-20"
                alt="Background Cikasda">
            <div class="absolute inset-0 bg-slate-900/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/50 via-slate-900/90 to-slate-950"></div>
        </div>

        <div class="relative z-10 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 flex flex-col justify-end min-h-[140px]">
            <div class="flex items-center space-x-2 text-[10px] sm:text-xs font-black tracking-widest uppercase">
                <span class="text-slate-400">PROFIL</span> <span class="text-slate-500 font-medium">›</span> <span
                    class="text-blue-400">MAKLUMAT</span>
            </div>
            <h1
                class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight mt-3 mb-4 drop-shadow-md text-uppercase">
                Maklumat Informasi Publik</h1>
            <p class="text-slate-300 text-xs sm:text-sm md:text-base font-medium max-w-4xl leading-relaxed opacity-90">
                Pernyataan tertulis kesanggupan dan janji resmi Dinas Cikasda dalam memberikan pelayanan informasi publik
                dengan transparansi penuh sesuai standar prosedur.</p>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="bg-slate-950 min-h-screen py-12 lg:py-20 -mt-1 relative z-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="w-full bg-white rounded-3xl shadow-[0_25px_60px_-15px_rgba(0,0,0,0.5)] border border-slate-800/20 overflow-hidden">

                {{-- TOP BAR --}}
                <div class="px-6 py-4 bg-white border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center space-x-2 shrink-0">
                        <span class="w-3 h-3 rounded-full bg-red-400 block"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-400 block"></span>
                        <span class="w-3 h-3 rounded-full bg-green-400 block"></span>
                        <span
                            class="text-[11px] text-slate-400 font-bold uppercase tracking-wider pl-4 border-l border-slate-100 ml-2">PERNYATAAN
                            RESMI</span>
                    </div>
                </div>

                {{-- CORE JUDUL --}}
                <div class="text-center pt-12 pb-4">
                    <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight inline-block relative">
                        MAKLUMAT PELAYANAN PPID
                        <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 h-1 w-10 bg-blue-600 rounded-full"></div>
                    </h2>
                </div>

                {{-- ADAPTIVE CONTENT --}}
                <div class="p-8 sm:p-12 lg:p-16 pt-6 space-y-12">

                    {{-- BLOK UTAMA KONTEN FORMAT TEXT (DIKUNCI KETat UNTUK RAW HTML RENDER) --}}
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

                    @if ($item->gambar_path && \Storage::disk('public')->exists($item->gambar_path))
                        <div class="w-full bg-slate-50 border border-slate-200/80 rounded-2xl p-4 sm:p-6 shadow-inner">
                            <img src="{{ asset('storage/' . $item->gambar_path) }}"
                                class="w-full h-auto max-h-[850px] object-contain mx-auto rounded-xl shadow-xl">
                        </div>
                    @endif

                    @if ($item->pdf_path && \Storage::disk('public')->exists($item->pdf_path))
                        <div
                            class="w-full bg-linear-to-r from-red-50 to-slate-50 border border-slate-200 rounded-2xl p-6 flex items-center justify-between shadow-xs">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="h-14 w-14 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-red-600">
                                    PDF</div>
                                <h5 class="text-base font-black text-slate-900">Berkas SK Maklumat Informasi Publik Resmi
                                </h5>
                            </div>
                            <a href="{{ asset('storage/' . $item->pdf_path) }}" target="_blank"
                                class="bg-red-600 text-white px-6 py-4 rounded-xl font-black text-xs uppercase tracking-widest shadow-md">Download</a>
                        </div>
                    @endif

                    @if (
                        (!isset($item->konten) || empty(trim($item->konten)) || $item->konten === '<p><br></p>') &&
                            !$item->gambar_path &&
                            !$item->pdf_path)
                        <p class="text-center text-slate-400 font-bold py-12">Pernyataan maklumat belum di-update oleh
                            admin.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
