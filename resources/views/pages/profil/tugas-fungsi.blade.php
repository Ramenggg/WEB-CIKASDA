@extends('layouts.app')

@section('content')
    <x-profil-hero title="Tugas dan Fungsi" :item="$item" description="Penjabaran mengenai peranan, tugas pokok, serta fungsi strategis operasional dari masing-masing unit kerja di bawah naungan Dinas CIKASDA." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-24">
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- Bagian Kiri: Konten Area (Sekitar 75%) --}}
            <div class="lg:w-3/4 flex flex-col gap-8">
                
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 border border-slate-100 flex flex-col h-full">
                    <div class="text-center mb-8 relative">
                        <h2 class="text-lg md:text-xl font-bold text-slate-800 inline-block relative pb-3">
                            Dokumen Tugas Pokok & Fungsi
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-blue-600 rounded-full"></span>
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-slate-100 rounded-full -z-10"></span>
                        </h2>
                    </div>

                    {{-- Embed PDF Reader --}}
                    <div class="relative w-full bg-slate-50/50 flex-1 flex flex-col items-center justify-center border border-slate-100 rounded-xl p-8">
                        @if (isset($item) && $item->primary_document_path)
                            <div class="w-full space-y-4">
                                <div class="w-full h-[500px] md:h-[600px] rounded-xl border border-slate-200 shadow-inner overflow-hidden bg-slate-100">
                                    <iframe src="{{ Storage::url($item->primary_document_path) }}" class="w-full h-full" title="Dokumen Tugas & Fungsi"></iframe>
                                </div>
                                <div class="flex justify-end">
                                    <a href="{{ Storage::url($item->primary_document_path) }}" target="_blank"
                                        class="shrink-0 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold text-xs uppercase tracking-wider px-5 py-3 rounded-xl shadow-md transition-all duration-200 hover:-translate-y-0.5 flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        <span>Buka Dokumen di Tab Baru</span>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="w-24 h-24 mb-6 bg-white rounded-full border border-slate-200 flex items-center justify-center mx-auto shadow-sm">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-700 mb-2">Dokumen Belum Tersedia</h3>
                            <p class="text-slate-500 text-sm leading-relaxed max-w-md text-center">Dokumen keputusan/peraturan mengenai Tugas Pokok & Fungsi Dinas CIKASDA saat ini belum tersedia.</p>
                        @endif
                    </div>
                </div>

            </div>

            {{-- Bagian Kanan: Sekilas Dinas Sidebar (Sekitar 25%) --}}
            <div class="lg:w-1/4">
                <x-sekilas-dinas-sidebar />
            </div>

        </div>
    </div>
@endsection
