@extends('layouts.app')

@section('content')
    <x-profil-hero title="Berita & Kegiatan" :item="$item"
        description="Ikuti terus perkembangan infrastruktur, pengelolaan sumber daya air, dan pengumuman resmi dari Dinas CIKASDA." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-24">
        {{-- GRID DAFTAR BERITA --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($beritas as $berita)
                <article class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col hover:shadow-xl hover:border-slate-300 transition-all duration-300 group">
                    {{-- AREA GAMBAR SAMPUL --}}
                    <div class="aspect-video w-full bg-slate-100 overflow-hidden relative">
                        @if($berita->sampul && $berita->sampul->file_path)
                            <img src="{{ asset('storage/' . $berita->sampul->file_path) }}"
                                 alt="{{ $berita->judul }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 gap-2">
                                <svg class="w-10 h-10 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-[10px] font-bold uppercase tracking-wider">Cikasda Info</span>
                            </div>
                        @endif

                        <span class="absolute bottom-4 left-4 bg-slate-900/80 backdrop-blur-md text-white font-black text-[9px] uppercase tracking-widest px-3 py-1.5 rounded-xl shadow-sm">
                            {{ $berita->kategori }}
                        </span>
                    </div>

                    {{-- KONTEN TEKS BERITA --}}
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div class="space-y-2">
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                                {{ $berita->created_at->translatedFormat('d F Y') }}
                            </div>
                            <h2 class="text-lg font-black text-slate-900 leading-snug group-hover:text-blue-600 transition-colors line-clamp-2">
                                <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                            </h2>
                            <p class="text-sm font-medium text-slate-600 leading-relaxed line-clamp-3">
                                {{ strip_tags($berita->konten) }}
                            </p>
                        </div>

                        {{-- LINK BACA --}}
                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('berita.show', $berita->slug) }}" class="text-xs font-black text-blue-600 uppercase tracking-widest group-hover:underline">
                                Baca Selengkapnya &rarr;
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-16 text-center space-y-3 bg-white border border-slate-200 rounded-[2rem]">
                    <div class="w-12 h-12 bg-slate-50 border border-slate-200 rounded-2xl flex items-center justify-center mx-auto text-slate-400 shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Belum ada berita yang dipublikasikan</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
