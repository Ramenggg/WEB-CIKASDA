@extends('layouts.app')

@section('content')
    <x-profil-hero title="LHKPN & LHKASN" :item="$item" description="Bentuk transparansi dan integritas aparatur melalui laporan berkala kepatuhan LHKPN dan LHKASN bagi jajaran pejabat dan pegawai di lingkup Dinas CIKASDA." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-24">
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- Bagian Kiri: Konten Area (Sekitar 75%) --}}
            <div class="lg:w-3/4 flex flex-col gap-8">
                
                {{-- CARD 1: DOKUMEN LHKPN --}}
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 border border-slate-100">
                    <div class="text-center mb-8 relative">
                        <h2 class="text-lg md:text-xl font-bold text-slate-800 inline-block relative pb-3">
                            Dokumen Laporan Kepatuhan (LHKPN)
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-red-600 rounded-full"></span>
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-slate-100 rounded-full -z-10"></span>
                        </h2>
                    </div>

                    {{-- Konten LHKPN --}}
                    <div class="relative w-full bg-slate-50/50 flex-1 flex flex-col items-center justify-center border border-slate-100 rounded-xl p-8">
                        @if (isset($item) && $item->primary_document_path && \Storage::disk('public')->exists($item->primary_document_path))
                            <div class="w-24 h-24 mb-6 bg-red-50 rounded-full border border-red-100 flex items-center justify-center shadow-sm">
                                <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-2">Dokumen Resmi Tersedia</h3>
                            <p class="text-slate-500 text-sm leading-relaxed max-w-md text-center mb-8">Anda dapat mengunduh dan meninjau rincian tanda terima Laporan Harta Kekayaan Penyelenggara Negara (LHKPN).</p>
                            <a href="{{ Storage::url($item->primary_document_path) }}" target="_blank" class="inline-flex items-center space-x-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                <span>Unduh PDF LHKPN</span>
                            </a>
                        @else
                            <div class="w-24 h-24 mb-6 bg-white rounded-full border border-slate-200 flex items-center justify-center mx-auto shadow-sm">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-700 mb-2">Dokumen Belum Tersedia</h3>
                            <p class="text-slate-500 text-sm leading-relaxed max-w-md text-center">Berkas dokumen LHKPN saat ini belum diunggah oleh administrator.</p>
                        @endif
                    </div>
                </div>
                
                {{-- CARD 2: DOKUMEN LHKASN --}}
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 border border-slate-100">
                    <div class="text-center mb-8 relative">
                        <h2 class="text-lg md:text-xl font-bold text-slate-800 inline-block relative pb-3">
                            Dokumen Laporan Kepatuhan (LHKASN)
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-orange-500 rounded-full"></span>
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-slate-100 rounded-full -z-10"></span>
                        </h2>
                    </div>

                    {{-- Konten LHKASN --}}
                    <div class="relative w-full bg-slate-50/50 flex-1 flex flex-col items-center justify-center border border-slate-100 rounded-xl p-8">
                        @if (isset($item) && $item->secondary_document_path && \Storage::disk('public')->exists($item->secondary_document_path))
                            <div class="w-24 h-24 mb-6 bg-orange-50 rounded-full border border-orange-100 flex items-center justify-center shadow-sm">
                                <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-2">Dokumen Resmi Tersedia</h3>
                            <p class="text-slate-500 text-sm leading-relaxed max-w-md text-center mb-8">Anda dapat mengunduh dan meninjau rincian tanda terima Laporan Harta Kekayaan Aparatur Sipil Negara (LHKASN).</p>
                            <a href="{{ Storage::url($item->secondary_document_path) }}" target="_blank" class="inline-flex items-center space-x-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                <span>Unduh PDF LHKASN</span>
                            </a>
                        @else
                            <div class="w-24 h-24 mb-6 bg-white rounded-full border border-slate-200 flex items-center justify-center mx-auto shadow-sm">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-700 mb-2">Dokumen Belum Tersedia</h3>
                            <p class="text-slate-500 text-sm leading-relaxed max-w-md text-center">Berkas dokumen LHKASN saat ini belum diunggah oleh administrator.</p>
                        @endif
                    </div>
                </div>

            </div>

            {{-- Bagian Kanan: Sekilas Dinas Sidebar (Sekitar 25%) --}}
            <div class="lg:w-1/4">
                <x-sekilas-dinas-sidebar />
        </div>
    </div>
@endsection
