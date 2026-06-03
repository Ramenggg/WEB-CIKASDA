@extends('layouts.app')

@section('content')
    {{-- Render Engine untuk Teks dari Quill Editor --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <style>
        /* Warna bullet/angka khusus untuk tiap pejabat */
        .kadis-content .ql-editor li::before { color: #2563eb !important; font-weight: bold; }
        .sekretaris-content .ql-editor li::before { color: #4f46e5 !important; font-weight: bold; }
        /* Timpa gaya bawaan Quill agar lebih cantik */
        .ql-editor { font-family: inherit !important; font-size: 1rem !important; }
        .ql-editor p { margin-bottom: 1rem; }
        .ql-editor ol { padding-left: 0 !important; }
        .ql-editor li { padding-left: 1.5em !important; margin-bottom: 0.5rem; }
    </style>

    @php
        $dataPejabat = json_decode($item->konten ?? '{}', true);
        $namaKadis = $dataPejabat['nama_kadis'] ?? 'Nama Kepala Dinas';
        $biografiKadis = $dataPejabat['biografi_kadis'] ?? '';
        
        $namaSekretaris = $dataPejabat['nama_sekretaris'] ?? 'Nama Sekretaris Dinas';
        $biografiSekretaris = $dataPejabat['biografi_sekretaris'] ?? '';
        
        $fotoKadis = $item->gambar_path ? Storage::url($item->gambar_path) : asset('images/pejabat/kadis.png');
        $fotoSekretaris = $item->gambar_path_2 ? Storage::url($item->gambar_path_2) : asset('images/pejabat/sekretaris.png');
    @endphp

    {{-- HERO SECTION (Standar CIKASDA) --}}
    <div class="relative w-full overflow-hidden pt-32 pb-48 lg:pt-40 lg:pb-64 bg-blue-900">
        {{-- Background Image --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/slider/slide1.png') }}" alt="Background CIKASDA" class="w-full h-full object-cover object-center scale-105 transform">
            <div class="absolute inset-0 bg-blue-950/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-linear-to-b from-blue-900/60 to-transparent"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="w-full flex flex-col items-start text-left">
                {{-- Breadcrumb --}}
                <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-4 py-2 text-blue-100 text-xs md:text-sm mb-8 font-medium shadow-sm">
                    <a href="{{ url('/') }}" class="hover:text-white transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Beranda
                    </a>
                    <svg class="w-3.5 h-3.5 text-blue-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="hover:text-white transition-colors cursor-pointer">Profil</span>
                    <svg class="w-3.5 h-3.5 text-blue-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="text-white font-semibold">Pejabat Struktural</span>
                </div>
                
                <div class="border-l-4 border-blue-500/50 pl-4 md:pl-6 mb-8 mt-4">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold font-heading text-white mb-4 tracking-tight relative">
                        Pejabat Struktural
                    </h1>
                    
                    <div class="text-blue-100 text-sm md:text-base leading-relaxed max-w-2xl">
                        Profil pemangku kebijakan dan pimpinan teras di lingkungan Dinas Cipta Karya dan Sumber Daya Air Provinsi Sulawesi Tengah.
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 pb-24">
        
        <div class="bg-white rounded-3xl shadow-[0_20px_50px_-15px_rgba(0,0,0,0.1)] border border-slate-100 overflow-hidden">
            <div class="p-8 sm:p-12 lg:p-16 space-y-24">

                {{-- BARIS 1: KEPALA DINAS --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">
                    
                    {{-- KIRI: FOTO & NAMA --}}
                    <div class="lg:col-span-5 flex flex-col items-center">
                        <div class="w-full relative bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 mb-8 flex justify-center group">
                            {{-- Latar Belakang Gradien Halus di belakang foto transparan --}}
                            <div class="absolute inset-0 bg-gradient-to-b from-blue-50 to-transparent opacity-50"></div>
                            
                            <img src="{{ $fotoKadis }}" alt="Kepala Dinas CIKASDA" 
                                class="w-full max-w-[400px] h-auto object-cover object-top relative z-10 drop-shadow-2xl transition-transform duration-700 group-hover:scale-[1.02]">
                            
                            {{-- Badge --}}
                            <div class="absolute top-6 right-6 z-20 bg-blue-600/90 backdrop-blur-md text-white text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-full shadow-lg border border-blue-400/30">
                                Pimpinan
                            </div>
                        </div>
                        <div class="text-center w-full">
                            <h2 class="text-1xl sm:text-2xl font-black text-slate-900 leading-tight tracking-tight">{{ $namaKadis }}</h2>
                            <p class="text-blue-600 font-extrabold text-sm tracking-[0.2em] uppercase mt-3">Kepala Dinas</p>
                        </div>
                    </div>

                    {{-- KANAN: BIOGRAFI / RIWAYAT --}}
                    <div class="lg:col-span-7 kadis-content -mt-12">
                        <div class="ql-snow">
                            <div class="ql-editor p-0 text-slate-600 leading-relaxed
                                        [&_h2]:font-black [&_h2]:text-slate-900 [&_h2]:text-xl [&_h2]:border-b-2 [&_h2]:border-slate-100 [&_h2]:pb-2 [&_h2]:mb-4 [&_h2]:mt-8
                                        [&_h3]:font-black [&_h3]:text-slate-900 [&_h3]:text-lg [&_h3]:border-b-2 [&_h3]:border-slate-100 [&_h3]:pb-2 [&_h3]:mb-4 [&_h3]:mt-8
                                        [&>*:first-child]:mt-0
                                        [&_strong]:font-black [&_strong]:text-slate-900">
                            
                            @if(!empty(trim(strip_tags($biografiKadis))))
                                {!! $biografiKadis !!}
                            @else
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-8 text-center">
                                    <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <p class="text-slate-400 font-semibold m-0">Riwayat atau biografi belum diisi oleh Admin.</p>
                                </div>
                            @endif

                        </div></div>
                    </div>

                </div>

                {{-- GARIS PEMISAH --}}
                <hr class="border-t-2 border-dashed border-slate-200">

                {{-- BARIS 2: SEKRETARIS DINAS --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">
                    
                    {{-- KIRI: FOTO & NAMA --}}
                    <div class="lg:col-span-5 flex flex-col items-center">
                        <div class="w-full relative bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 mb-8 flex justify-center group">
                            {{-- Latar Belakang Gradien Halus --}}
                            <div class="absolute inset-0 bg-gradient-to-b from-indigo-50 to-transparent opacity-50"></div>
                            
                            <img src="{{ $fotoSekretaris }}" alt="Sekretaris Dinas CIKASDA" 
                                class="w-full max-w-[400px] h-auto object-cover object-top relative z-10 drop-shadow-2xl transition-transform duration-700 group-hover:scale-[1.02]">
                            
                            {{-- Badge --}}
                            <div class="absolute top-6 right-6 z-20 bg-indigo-600/90 backdrop-blur-md text-white text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-full shadow-lg border border-indigo-400/30">
                                Sekretariat
                            </div>
                        </div>
                        <div class="text-center w-full">
                            <h2 class="text-1xl sm:text-2xl font-black text-slate-900 leading-tight tracking-tight">{{ $namaSekretaris }}</h2>
                            <p class="text-indigo-600 font-extrabold text-sm tracking-[0.2em] uppercase mt-3">Sekretaris Dinas</p>
                        </div>
                    </div>

                    {{-- KANAN: BIOGRAFI / RIWAYAT --}}
                    <div class="lg:col-span-7 sekretaris-content -mt-12">
                        <div class="ql-snow">
                            <div class="ql-editor p-0 text-slate-600 leading-relaxed
                                        [&_h2]:font-black [&_h2]:text-slate-900 [&_h2]:text-xl [&_h2]:border-b-2 [&_h2]:border-slate-100 [&_h2]:pb-2 [&_h2]:mb-4 [&_h2]:mt-8
                                        [&_h3]:font-black [&_h3]:text-slate-900 [&_h3]:text-lg [&_h3]:border-b-2 [&_h3]:border-slate-100 [&_h3]:pb-2 [&_h3]:mb-4 [&_h3]:mt-8
                                        [&>*:first-child]:mt-0
                                        [&_strong]:font-black [&_strong]:text-slate-900">
                            
                            @if(!empty(trim(strip_tags($biografiSekretaris))))
                                {!! $biografiSekretaris !!}
                            @else
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-8 text-center">
                                    <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <p class="text-slate-400 font-semibold m-0">Riwayat atau biografi belum diisi oleh Admin.</p>
                                </div>
                            @endif

                        </div></div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
