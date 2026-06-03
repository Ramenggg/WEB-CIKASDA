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
                
                <div class="border-l-4 border-blue-500/50 pl-4 md:pl-6 mb-8 mt-4">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold font-heading text-white mb-4 tracking-tight relative">
                        Sejarah Instansi
                    </h1>
                    
                    <div class="text-blue-100 text-sm md:text-base leading-relaxed max-w-3xl">
                        Rekam jejak, transformasi instansi, dan tonggak perkembangan historis Dinas Cipta Karya dan Sumber Daya Air dari masa ke masa.
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- KONTEN UTAMA OVERLAPPING HERO (Single Column Design) --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 pb-24">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-8 md:p-12 lg:p-16 border border-slate-100">
            @if (isset($item->konten) && !empty(trim(strip_tags($item->konten))))
                <div class="prose prose-slate prose-p:mb-6 prose-p:leading-loose text-slate-700 text-sm md:text-base max-w-none [&_*]:!bg-transparent text-justify
                            prose-headings:text-slate-900 prose-headings:font-bold prose-img:rounded-2xl prose-img:shadow-md prose-img:w-full prose-img:mb-6 prose-img:object-cover">
                    {!! $item->konten !!}
                </div>
            @else
                <div class="w-full flex flex-col items-center justify-center py-16">
                    <div class="w-24 h-24 mb-6 bg-slate-50 rounded-full border border-slate-200 flex items-center justify-center mx-auto shadow-sm">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700 mb-2">Sejarah Belum Tersedia</h3>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-md text-center">Informasi mengenai sejarah instansi akan ditampilkan setelah diunggah oleh administrator.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
