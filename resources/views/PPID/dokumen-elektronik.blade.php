@extends('layouts.app')

@section('content')
    <x-profil-hero title="Dokumen Elektronik PPID" :item="$item" />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-24">
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- Bagian Kiri: Konten Area (Sekitar 75%) --}}
            <div class="lg:w-3/4 flex flex-col gap-8">
                
                {{-- CARD 1: KONTEN DOKUMEN --}}
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 border border-slate-100">
                    <div class="text-center mb-8 relative">
                        <h2 class="text-lg md:text-xl font-bold text-slate-800 inline-block relative pb-3">
                            Dokumen Program & Kegiatan (2022 - 2024)
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
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-700 mb-2">Dokumen Belum Tersedia</h3>
                            <p class="text-slate-500 text-sm leading-relaxed max-w-md mx-auto">Kumpulan dokumen elektronik program dan kegiatan akan ditampilkan di sini setelah diperbarui oleh administrator.</p>
                        </div>
                    @endif
                </div>

                {{-- CARD 2: INFOGRAFIS / GAMBAR --}}
                @if (isset($item) && ($item->primary_image_path || $item->secondary_image_path))
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 border border-slate-100 space-y-8">
                        @if ($item->primary_image_path)
                            <div class="relative w-full bg-slate-50/50 flex items-center justify-center overflow-x-auto border border-slate-100 rounded-xl p-4">
                                <img src="{{ Storage::url($item->primary_image_path) }}" alt="Infografis Dokumen PPID"
                                    class="w-full h-auto object-contain rounded-2xl shadow-md">
                            </div>
                        @endif

                        @if ($item->secondary_image_path)
                            <div class="relative w-full bg-slate-50/50 flex items-center justify-center overflow-x-auto border border-slate-100 rounded-xl p-4">
                                <img src="{{ Storage::url($item->secondary_image_path) }}" alt="Infografis Dokumen PPID 2"
                                    class="w-full h-auto object-contain rounded-2xl shadow-md">
                            </div>
                        @endif
                    </div>
                @endif

                {{-- PDF Lampiran Multi-slots --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if (isset($item) && $item->primary_document_path)
                        <div class="w-full bg-white border border-slate-200 rounded-3xl p-6 flex flex-col items-center text-center gap-4 shadow-xl">
                            <div class="h-14 w-14 bg-red-50 border border-red-100 rounded-xl flex items-center justify-center shadow-sm">
                                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="text-sm font-black text-slate-900 tracking-tight">Dokumen Utama</h5>
                                <p class="text-[10px] text-slate-500 font-semibold mt-0.5 uppercase tracking-wider">Berkas PDF Utama</p>
                            </div>
                            <a href="{{ Storage::url($item->primary_document_path) }}" target="_blank"
                                class="w-full bg-slate-900 hover:bg-blue-600 text-white font-black text-[10px] uppercase tracking-widest py-3 rounded-xl transition-all duration-200">Unduh Berkas</a>
                        </div>
                    @endif

                    @if (isset($item) && $item->secondary_document_path)
                        <div class="w-full bg-white border border-slate-200 rounded-3xl p-6 flex flex-col items-center text-center gap-4 shadow-xl">
                            <div class="h-14 w-14 bg-blue-50 border border-blue-100 rounded-xl flex items-center justify-center shadow-sm">
                                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="text-sm font-black text-slate-900 tracking-tight">Dokumen Pendukung</h5>
                                <p class="text-[10px] text-slate-500 font-semibold mt-0.5 uppercase tracking-wider">Berkas PDF Tambahan</p>
                            </div>
                            <a href="{{ Storage::url($item->secondary_document_path) }}" target="_blank"
                                class="w-full bg-slate-900 hover:bg-blue-600 text-white font-black text-[10px] uppercase tracking-widest py-3 rounded-xl transition-all duration-200">Unduh Berkas</a>
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
