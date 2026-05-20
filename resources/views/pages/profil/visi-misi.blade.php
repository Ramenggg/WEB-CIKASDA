@extends('layouts.app')

@section('content')
    {{-- HEADER PROFIL DINAS (KONSISTEN & PREMIUM) --}}
    <div class="relative bg-blue-900 pt-32 pb-16 overflow-hidden border-b border-white/10 shadow-lg">
        <div class="absolute inset-0 opacity-10 bg-[url('{{ asset('images/water-pattern.png') }}')] bg-repeat"></div>
        <div class="absolute bottom-0 left-0 w-full h-1 bg-linear-to-r from-transparent via-yellow-500 to-transparent"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tight drop-shadow-md">
                Visi dan Misi
            </h1>
            <div class="flex items-center justify-center mt-3 space-x-3">
                <span class="h-[1.5px] w-6 bg-cyan-400 rounded-full"></span>
                <p class="text-blue-200 text-[10px] sm:text-xs font-bold uppercase tracking-[0.3em] opacity-80">
                    Dinas Cipta Karya & Sumber Daya Air
                </p>
                <span class="h-[1.5px] w-6 bg-cyan-400 rounded-full"></span>
            </div>
        </div>
    </div>

    {{-- KONTEN UTAMA DENGAN ENGINE ADAPTIF PINTAR (ANTI-BROKEN IMAGE) --}}
    <div class="bg-slate-50 min-h-screen py-12 lg:py-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Box Card Putih Melayang Utama --}}
            <div
                class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_-20px_rgba(0,0,0,0.05)] border border-slate-200/60 p-6 sm:p-12 lg:p-16 space-y-12">

                {{-- ==================================================================
                     KONDISI 1: JIKA ADMIN MENGISI NARASI TEKS
                     ================================================================== --}}
                @if (isset($item->konten) && !empty(trim($item->konten)) && $item->konten !== '<p><br></p>')
                    <div class="w-full">
                        <div class="text-center mb-8">
                            <h2
                                class="text-xl md:text-2xl font-black text-slate-900 uppercase tracking-tight inline-block relative">
                                Dokumen Visi & Misi
                                <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 h-1 w-8 bg-blue-600 rounded-full">
                                </div>
                            </h2>
                        </div>

                        <div
                            class="prose prose-slate max-w-none break-words text-slate-700 leading-relaxed font-medium 
                                    prose-headings:font-black prose-headings:text-slate-900 prose-p:text-base sm:prose-p:text-lg
                                    prose-ol:space-y-3 prose-ul:space-y-3 prose-li:text-base sm:prose-li:text-lg">
                            {!! $item->konten !!}
                        </div>
                    </div>
                @endif


                {{-- PEMBATAS HALUS TEKS & GAMBAR --}}
                @if (isset($item->konten) &&
                        !empty(trim($item->konten)) &&
                        $item->konten !== '<p><br></p>' &&
                        (($item->gambar_path && \Storage::disk('public')->exists($item->gambar_path)) ||
                            ($item->pdf_path && \Storage::disk('public')->exists($item->pdf_path))))
                    <hr class="border-slate-100">
                @endif


                {{-- ==================================================================
                     KONDISI 2: JIKA ADMIN MENGUNGGAH GAMBAR (DIVERIFIKASI OLEH FILE EXIST)
                     ================================================================== --}}
                @if ($item->gambar_path && \Storage::disk('public')->exists($item->gambar_path))
                    <div class="w-full space-y-6">
                        <div class="text-center">
                            <h2
                                class="text-xl md:text-2xl font-black text-slate-900 uppercase tracking-tight inline-block relative">
                                Infografis Visi Misi
                                <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 h-1 w-8 bg-cyan-500 rounded-full">
                                </div>
                            </h2>
                        </div>

                        {{-- Frame Gambar Premium Full Width Real-Time --}}
                        <div class="w-full bg-slate-50 border border-slate-200 rounded-4xl p-4 sm:p-6 shadow-inner">
                            <div
                                class="relative group cursor-zoom-in overflow-hidden rounded-2xl shadow-xl border border-white w-full flex justify-center">
                                <img src="{{ asset('storage/' . $item->gambar_path) }}"
                                    alt="Infografis Visi Misi Dinas CIKASDA"
                                    class="w-full h-auto max-h-[800px] object-contain mx-auto transition-transform duration-1000 group-hover:scale-[1.02]">

                                <div
                                    class="absolute inset-0 bg-blue-950/0 group-hover:bg-blue-950/20 transition-all duration-500 flex items-center justify-center">
                                    <span
                                        class="bg-white text-blue-900 px-6 py-3 rounded-xl font-black shadow-2xl opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500 text-xs uppercase tracking-[0.2em] border border-blue-100">
                                        Perbesar Infografis
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                {{-- PEMBATAS HALUS GAMBAR & PDF --}}
                @if (
                    $item->gambar_path &&
                        \Storage::disk('public')->exists($item->gambar_path) &&
                        ($item->pdf_path && \Storage::disk('public')->exists($item->pdf_path)))
                    <hr class="border-slate-100">
                @endif


                {{-- ==================================================================
                     KONDISI 3: JIKA ADMIN MENGUNGGAH DOKUMEN LAMPIRAN PDF RESMI
                     ================================================================== --}}
                @if ($item->pdf_path && \Storage::disk('public')->exists($item->pdf_path))
                    <div class="w-full space-y-6">
                        <div class="text-center">
                            <h2
                                class="text-xl md:text-2xl font-black text-slate-900 uppercase tracking-tight inline-block relative">
                                Dokumen SK & Regulasi
                                <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 h-1 w-8 bg-red-500 rounded-full">
                                </div>
                            </h2>
                        </div>

                        <div
                            class="w-full bg-linear-to-r from-red-50/50 via-slate-50 to-red-50/20 border border-slate-200/80 rounded-3xl p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xs">
                            <div
                                class="flex items-center space-x-4 text-center sm:text-left flex-col sm:flex-row gap-4 sm:gap-0">
                                <div
                                    class="h-14 w-14 bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-2xl flex items-center justify-center shrink-0 shadow-xs">
                                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="text-base font-black text-slate-900 tracking-tight">Keputusan Kepala Dinas
                                        Cipta Karya & Sumber Daya Air</h5>
                                    <p class="text-xs text-slate-500 font-semibold mt-0.5">Unduh dokumen PDF asli untuk
                                        melihat ketetapan legalitas hukum Visi & Misi.</p>
                                </div>
                            </div>

                            <a href="{{ asset('storage/' . $item->pdf_path) }}" target="_blank"
                                class="shrink-0 w-full sm:w-auto text-center bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-widest px-6 py-4 rounded-xl shadow-md shadow-red-600/10 hover:shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                                Download PDF
                            </a>
                        </div>
                    </div>
                @endif


                {{-- ==================================================================
                     FALLBACK DEFENSE: JIKA DATABASE BENAR-BENAR KOSONG TOTAL
                     ================================================================== --}}
                @if (
                    (!isset($item->konten) || empty(trim($item->konten)) || $item->konten === '<p><br></p>') &&
                        (!$item->gambar_path || !\Storage::disk('public')->exists($item->gambar_path)) &&
                        (!$item->pdf_path || !\Storage::disk('public')->exists($item->pdf_path)))
                    <div class="w-full text-center py-12">
                        <div
                            class="h-16 w-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <h5 class="text-base font-bold text-slate-800">Data Belum Tersedia</h5>
                        <p class="text-xs text-slate-400 font-semibold mt-1">Informasi Visi & Misi Dinas CIKASDA saat ini
                            sedang dalam proses pembaruan oleh admin.</p>
                    </div>
                @endif

            </div>

        </div>
    </div>
@endsection
