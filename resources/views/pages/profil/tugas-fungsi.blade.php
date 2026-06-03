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
                        Tugas dan Fungsi
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-blue-600 rounded-full"></span>
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-slate-100 rounded-full -z-10"></span>
                    </h2>
                </div>

                {{-- Content is rendered in the Hero section --}}
                


                {{-- Chart Area / Infografis --}}
                <div class="relative w-full bg-slate-50/50 flex-1 min-h-[400px] flex items-center justify-center overflow-x-auto border border-slate-100 rounded-xl p-4">
                    @if (isset($item) && $item->primary_image_path && \Storage::disk('public')->exists($item->primary_image_path))
                        <img src="{{ Storage::url($item->primary_image_path) }}" alt="Infografis Tugas dan Fungsi CIKASDA"
                            class="w-full h-auto object-contain transition-transform duration-700 cursor-zoom-in rounded-2xl shadow-md">
                    @else
                        <div class="relative z-10 w-full flex flex-col items-center justify-center py-12">
                            <div class="w-24 h-24 mb-6 bg-white rounded-full border border-slate-200 flex items-center justify-center mx-auto shadow-sm">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-700 mb-2">Infografis Belum Tersedia</h3>
                            <p class="text-slate-500 text-sm leading-relaxed max-w-md text-center">Infografis visual uraian Tugas & Fungsi akan ditampilkan setelah diunggah oleh administrator.</p>
                        </div>
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
