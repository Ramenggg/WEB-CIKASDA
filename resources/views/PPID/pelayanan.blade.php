@extends('layouts.app')

@section('content')
    <x-profil-hero title="Pelayanan PPID" :item="$item" />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-24">
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- Bagian Kiri: Konten Area (Sekitar 75%) --}}
            <div class="lg:w-3/4 flex flex-col gap-8">
                
                {{-- CARD 1: KONTEN PELAYANAN --}}
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 border border-slate-100">
                    <div class="text-center mb-8 relative">
                        <h2 class="text-lg md:text-xl font-bold text-slate-800 inline-block relative pb-3">
                            Standar Pelayanan PPID
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-blue-600 rounded-full"></span>
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-slate-100 rounded-full -z-10"></span>
                        </h2>
                    </div>

                    @if (isset($item) && $item->content_data)
                        <div class="prose prose-slate max-w-none prose-headings:font-bold prose-headings:text-slate-800 prose-p:text-slate-600 prose-p:leading-relaxed">
                            {!! $item->content_data !!}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-20 h-20 mb-6 bg-slate-50 rounded-full border border-slate-100 flex items-center justify-center mx-auto shadow-sm">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-700 mb-2">Informasi Pelayanan Belum Tersedia</h3>
                            <p class="text-slate-500 text-sm leading-relaxed max-w-md mx-auto">Informasi standar pelayanan PPID akan ditampilkan di sini setelah diperbarui oleh administrator.</p>
                        </div>
                    @endif
                </div>

                {{-- CARD 2: INFOGRAFIS / GAMBAR --}}
                @if (isset($item) && ($item->primary_image_path || $item->secondary_image_path))
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 border border-slate-100 space-y-8">
                        @if ($item->primary_image_path)
                            <div class="relative w-full bg-slate-50/50 flex items-center justify-center overflow-x-auto border border-slate-100 rounded-xl p-4">
                                <img src="{{ Storage::url($item->primary_image_path) }}" alt="Infografis Pelayanan PPID"
                                    class="w-full h-auto object-contain rounded-2xl shadow-md">
                            </div>
                        @endif

                        @if ($item->secondary_image_path)
                            <div class="relative w-full bg-slate-50/50 flex items-center justify-center overflow-x-auto border border-slate-100 rounded-xl p-4">
                                <img src="{{ Storage::url($item->secondary_image_path) }}" alt="Infografis Pelayanan PPID 2"
                                    class="w-full h-auto object-contain rounded-2xl shadow-md">
                            </div>
                        @endif
                    </div>
                @endif

                {{-- PDF Lampiran --}}
                @if (isset($item) && $item->primary_document_path)
                    <div class="w-full bg-gradient-to-r from-red-50/50 via-slate-50 to-red-50/20 border border-slate-200 rounded-3xl p-6 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xl">
                        <div class="flex items-center space-x-4 text-center sm:text-left flex-col sm:flex-row gap-4 sm:gap-0">
                            <div class="h-14 w-14 bg-white border border-slate-200 rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="text-base font-black text-slate-900 tracking-tight">Dokumen Lampiran Pelayanan PPID</h5>
                                <p class="text-xs text-slate-500 font-semibold mt-0.5">Unduh dokumen PDF standar pelayanan PPID resmi (Format PDF).</p>
                            </div>
                        </div>
                        <a href="{{ Storage::url($item->primary_document_path) }}" target="_blank"
                            class="shrink-0 w-full sm:w-auto text-center bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-widest px-6 py-4 rounded-xl shadow-md transition-all duration-200 hover:-translate-y-0.5">Download PDF</a>
                    </div>
                @endif

            </div>

            {{-- Bagian Kanan: Sekilas Dinas Sidebar (Sekitar 25%) --}}
            <div class="lg:w-1/4">
                <x-sekilas-dinas-sidebar />
            </div>
        </div>
    </div>
@endsection
