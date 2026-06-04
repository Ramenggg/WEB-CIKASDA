@extends('layouts.app')

@section('content')
    <x-profil-hero title="Maklumat Pelayanan" :item="$item" description="Standar pelayanan publik dan komitmen kami dalam memberikan layanan terbaik bagi masyarakat Sulawesi Tengah." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-24">
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- Bagian Kiri: Konten Area (Sekitar 75%) --}}
            <div class="lg:w-3/4 flex flex-col gap-8">
                
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 border border-slate-100 flex flex-col h-full">
                    <div class="text-center mb-8 relative">
                        <h2 class="text-lg md:text-xl font-bold text-slate-800 inline-block relative pb-3">
                            Pernyataan Maklumat Informasi
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-blue-600 rounded-full"></span>
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-slate-100 rounded-full -z-10"></span>
                        </h2>
                    </div>

                    {{-- Content is rendered in the Hero section --}}

                    {{-- Infografis Area --}}
                    <div class="relative w-full rounded-xl overflow-hidden">
                        @if (isset($item) && $item->primary_image_path)
                            <img src="{{ Storage::url($item->primary_image_path) }}" alt="Piagam Maklumat Pelayanan"
                                class="w-full h-auto object-contain transition-transform duration-700 hover:scale-[1.01] rounded-2xl shadow-md">
                        @else
                            <div class="relative z-10 w-full flex flex-col items-center justify-center py-12 bg-slate-50/50 border border-slate-100 rounded-xl">
                                <div class="w-24 h-24 mb-6 bg-white rounded-full border border-slate-200 flex items-center justify-center mx-auto shadow-sm">
                                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-700 mb-2">Infografis Maklumat Belum Tersedia</h3>
                                <p class="text-slate-500 text-sm leading-relaxed max-w-md text-center">Infografis maklumat pelayanan akan ditampilkan setelah diunggah oleh administrator.</p>
                            </div>
                        @endif
                    </div>

                    {{-- PDF Lampiran (Fitur Tambahan Maklumat) --}}
                    @if (isset($item) && $item->primary_document_path && \Storage::disk('public')->exists($item->primary_document_path))
                        <div class="mt-8 w-full bg-gradient-to-r from-red-50/50 via-slate-50 to-red-50/20 border border-slate-200 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm">
                            <div class="flex items-center space-x-4 text-center sm:text-left flex-col sm:flex-row gap-4 sm:gap-0">
                                <div class="h-14 w-14 bg-white border border-slate-200 rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="text-base font-black text-slate-900 tracking-tight">Surat Keputusan Standar Pelayanan</h5>
                                    <p class="text-xs text-slate-500 font-semibold mt-0.5">Unduh dokumen dasar hukum maklumat pelayanan (PDF).</p>
                                </div>
                            </div>
                            <a href="{{ Storage::url($item->primary_document_path) }}" target="_blank"
                                class="shrink-0 w-full sm:w-auto text-center bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-widest px-6 py-4 rounded-xl shadow-md transition-all duration-200 hover:-translate-y-0.5">Download PDF</a>
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
