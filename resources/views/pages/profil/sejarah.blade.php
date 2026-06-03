@extends('layouts.app')

@section('content')
    {{-- HERO SECTION --}}
    <div class="relative w-full overflow-hidden pt-32 pb-48 lg:pt-40 lg:pb-64 bg-blue-900">
        {{-- Background Image --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/slider/slide1.png') }}" alt="Background CIKASDA" class="w-full h-full object-cover object-center scale-105 transform">
            <div class="absolute inset-0 bg-blue-950/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-linear-to-b from-blue-900/60 to-transparent"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="w-full flex flex-col items-start text-left">
                {{-- Breadcrumb (Beautified) --}}
                <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-4 py-2 text-blue-100 text-xs md:text-sm mb-8 font-medium shadow-sm">
                    <a href="{{ url('/') }}" class="hover:text-white transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Beranda
                    </a>
                    <svg class="w-3.5 h-3.5 text-blue-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="hover:text-white transition-colors cursor-pointer">Profil</span>
                    <svg class="w-3.5 h-3.5 text-blue-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="text-white font-semibold">Sejarah Instansi</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold font-heading text-white mb-6 tracking-tight relative">
                    Sejarah Instansi
                </h1>
                
                <div class="text-blue-100 text-sm md:text-base leading-relaxed mb-8 max-w-2xl mt-2 pl-4 border-l-2 border-blue-500/50">
                    Rekam jejak, transformasi instansi, dan tonggak perkembangan historis Dinas Cipta Karya dan Sumber Daya Air dari masa ke masa.
                </div>
            </div>
        </div>
    </div>

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-[98%] xl:max-w-7xl mx-auto -mt-24 pb-24">
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- Bagian Kiri: Konten Area (Sekitar 75%) --}}
            <div class="lg:w-3/4 flex flex-col gap-8">
                
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 border border-slate-100 flex flex-col h-full">
                <div class="text-center mb-8 relative">
                    <h2 class="text-lg md:text-xl font-bold text-slate-800 inline-block relative pb-3">
                        Kilas Balik Historis
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-blue-600 rounded-full"></span>
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-slate-100 rounded-full -z-10"></span>
                    </h2>
                </div>

                {{-- Header Tools Bar (Download PDF) --}}
                @if (isset($item) && $item->pdf_path && \Storage::disk('public')->exists($item->pdf_path))
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <div>
                        <a href="{{ Storage::url($item->pdf_path) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-lg hover:bg-slate-50 transition-colors text-sm font-medium shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Unduh Arsip Dokumen Sejarah (PDF)
                        </a>
                    </div>
                </div>
                @endif

                {{-- Chart Area (Menampilkan Deskripsi Teks, bukan Gambar) --}}
                <div class="relative w-full bg-slate-50/50 flex-1 min-h-[400px] flex flex-col overflow-x-auto border border-slate-100 rounded-xl p-6 md:p-10">
                    @if (isset($item->konten) && !empty(trim($item->konten)) && $item->konten !== '<p><br></p>')
                        <div class="prose prose-slate max-w-none break-words text-slate-700 leading-relaxed font-medium
                                    prose-headings:font-bold prose-headings:text-slate-900 
                                    prose-ol:space-y-2 prose-ul:space-y-2 w-full">
                            {!! $item->konten !!}
                        </div>
                    @else
                        <div class="relative z-10 w-full flex-1 flex flex-col items-center justify-center py-12">
                            <div class="w-24 h-24 mb-6 bg-white rounded-full border border-slate-200 flex items-center justify-center mx-auto shadow-sm">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-700 mb-2">Sejarah Belum Tersedia</h3>
                            <p class="text-slate-500 text-sm leading-relaxed max-w-md text-center">Informasi mengenai sejarah instansi akan ditampilkan setelah diunggah oleh administrator.</p>
                        </div>
                    @endif
                </div>
                </div>
            </div>

            {{-- Bagian Kanan: Sekilas Dinas Sidebar (Sekitar 25%) --}}
            <div class="lg:w-1/4">
                <div class="sticky top-24 bg-slate-50 rounded-2xl p-6 border border-slate-100 shadow-sm">
                    
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider flex items-center mb-6">
                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Sekilas Dinas
                    </h3>

                    <div class="space-y-4">
                        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-xs flex items-start space-x-3 hover:shadow-md transition-shadow">
                            <div class="bg-blue-50 text-blue-600 p-2 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium mb-0.5">Jumlah Bidang</p>
                                <p class="text-sm font-bold text-slate-800">{{ $item->jumlah_bidang ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-xs flex items-start space-x-3 hover:shadow-md transition-shadow">
                            <div class="bg-indigo-50 text-indigo-600 p-2 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium mb-0.5">Jumlah Subbagian</p>
                                <p class="text-sm font-bold text-slate-800">{{ $item->jumlah_subbagian ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-xs flex items-start space-x-3 hover:shadow-md transition-shadow">
                            <div class="bg-teal-50 text-teal-600 p-2 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium mb-0.5">Jumlah UPT</p>
                                <p class="text-sm font-bold text-slate-800">{{ $item->jumlah_upt ?? '-' }}</p>
                            </div>
                        </div>
                        
                        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-xs flex items-start space-x-3 hover:shadow-md transition-shadow">
                            <div class="bg-violet-50 text-violet-600 p-2 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium mb-0.5">Total Pegawai</p>
                                <p class="text-sm font-bold text-slate-800">{{ $item->total_pegawai ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-xs flex items-start space-x-3 hover:shadow-md transition-shadow">
                            <div class="bg-cyan-50 text-cyan-600 p-2 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium mb-0.5">Tahun Dibentuk</p>
                                <p class="text-sm font-bold text-slate-800">{{ $item->tahun_dibentuk ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-slate-200">
                        <a href="{{ url('/') }}" class="w-full flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-3 px-4 rounded-xl transition-colors shadow-sm cursor-pointer">
                            <span>Kembali ke Beranda</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
