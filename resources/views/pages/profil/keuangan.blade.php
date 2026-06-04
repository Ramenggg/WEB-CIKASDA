@extends('layouts.app')

@section('content')
    <x-profil-hero title="Transparansi Keuangan" :item="$item" :showContentInHero="false" description="Transparansi penuh pengelolaan Anggaran Pendapatan dan Belanja Daerah (APBD) serta realisasi keuangan makro lingkup Dinas Cipta Karya dan Sumber Daya Air." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-24">
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- Bagian Kiri: Konten Area (Sekitar 75%) --}}
            <div class="lg:w-3/4 flex flex-col gap-8">
                
                {{-- CARD UTAMA --}}
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 md:p-10 border border-slate-100">
                    <div class="text-center mb-8 relative">
                        <h2 class="text-xl md:text-2xl font-black text-slate-900 uppercase tracking-tight inline-block relative pb-3">
                            REALISASI ANGGARAN & DPA RESMI
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-blue-600 rounded-full"></span>
                        </h2>
                    </div>

                    {{-- Konten Dinamis --}}
                    @if (isset($item->content_data) && !empty(trim(strip_tags($item->content_data))))
                        <div class="prose prose-slate max-w-none break-words text-slate-700 leading-relaxed font-medium prose-headings:font-black prose-headings:text-slate-900 mb-10">
                            {!! $item->content_data !!}
                        </div>
                    @endif

                    {{-- Gambar Keuangan --}}
                    @if ($item && $item->primary_image_path)
                        <div class="mb-10 w-full relative group cursor-zoom-in overflow-hidden rounded-xl border-4 border-white shadow-lg flex justify-center bg-white transition-all hover:shadow-xl hover:border-slate-100">
                            <img src="{{ asset('storage/' . $item->primary_image_path) }}" alt="Infografis Keuangan Dinas"
                                class="w-full h-auto max-h-[850px] object-cover mx-auto transition-transform duration-1000 group-hover:scale-[1.015] rounded-2xl shadow-md">
                        </div>
                    @endif

                    {{-- Dokumen PDF --}}
                    @if ($item && $item->primary_document_path && \Storage::disk('public')->exists($item->primary_document_path))
                        <div class="w-full bg-gradient-to-r from-red-50/50 via-slate-50 to-red-50/20 border border-slate-200 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xs mt-6">
                            <div class="flex items-center space-x-4 text-center sm:text-left flex-col sm:flex-row gap-4 sm:gap-0">
                                <div class="h-14 w-14 bg-white border border-slate-200 rounded-xl flex items-center justify-center shrink-0 shadow-2xs">
                                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="text-base font-black text-slate-900 tracking-tight">Dokumen Neraca / Laporan Realisasi</h5>
                                    <p class="text-xs text-slate-500 font-semibold mt-0.5">Unduh berkas laporan pertanggungjawaban penyerapan kas (PDF).</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $item->primary_document_path) }}" target="_blank" class="shrink-0 w-full sm:w-auto text-center bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-widest px-6 py-4 rounded-xl shadow-md transition-all duration-200 hover:-translate-y-0.5">
                                Download PDF
                            </a>
                        </div>
                    @endif

                    {{-- Fallback Kosong --}}
                    @if (
                        (!isset($item->content_data) || empty(trim(strip_tags($item->content_data)))) &&
                        (!$item || !$item->primary_image_path || !\Storage::disk('public')->exists($item->primary_image_path)) &&
                        (!$item || !$item->primary_document_path || !\Storage::disk('public')->exists($item->primary_document_path))
                    )
                        <div class="w-full bg-slate-50 border border-slate-100 rounded-2xl p-12 text-center">
                            <div class="w-20 h-20 bg-white rounded-full mx-auto flex items-center justify-center mb-4 shadow-sm border border-slate-100">
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <p class="text-slate-500 font-medium">Informasi Data Transparansi Keuangan saat ini belum diunggah.</p>
                        </div>
                    @endif

                </div>
            </div>

            {{-- Bagian Kanan: Sekilas Dinas Sidebar (Sekitar 25%) --}}
            <div class="lg:w-1/4">
                <x-sekilas-dinas-sidebar />
            </div>

        </div>
    </div>
@endsection
