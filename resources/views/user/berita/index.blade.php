@extends('layouts.app')

@section('content')
    <x-profil-hero title="Berita & Kegiatan" :item="$item"
        description="Ikuti terus perkembangan infrastruktur, pengelolaan sumber daya air, dan pengumuman resmi dari Dinas CIKASDA." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-6 md:px-8 -mt-28 pb-32">
        <div class="bg-white rounded-t-[2.5rem] border border-slate-100 shadow-[0_15px_50px_-15px_rgba(15,23,42,0.08)] p-6 md:p-10 space-y-10">
            
            {{-- FORM PENCARIAN & FILTER KATEGORI --}}
            <form action="{{ route('berita.index') }}" method="GET" class="space-y-6 pb-6 border-b border-slate-100">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    {{-- Search Input (Pill Style) --}}
                    <div class="relative flex-1 w-full">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        
                        {{-- Hidden Category Input --}}
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari item"
                            class="w-full pl-12 pr-28 py-3.5 bg-slate-50 border border-slate-100 focus:border-slate-200 outline-none rounded-full text-xs font-bold text-slate-700 placeholder:font-normal placeholder:text-slate-400 transition shadow-inner">
                        
                        <button type="submit" class="absolute right-1.5 top-1/2 -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-[10px] uppercase tracking-widest px-6 py-2 rounded-full transition shadow-xs cursor-pointer">
                            Cari
                        </button>
                    </div>
                </div>

                {{-- Category Pills --}}
                <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest mr-2 shrink-0">Kategori:</span>
                    @php
                        $selectedCat = request('category', 'Semua');
                        $categories = ['Semua', 'Infrastruktur', 'Sumber Daya Air', 'Cipta Karya', 'Kegiatan Dinas', 'Pengumuman'];
                    @endphp
                    @foreach($categories as $cat)
                        <button type="submit" name="category" value="{{ $cat }}"
                            class="px-4 py-1.5 text-[10px] font-bold rounded-full transition duration-150 cursor-pointer shrink-0 border uppercase tracking-wider
                            {{ $selectedCat === $cat 
                                ? 'bg-blue-600 border-blue-600 text-white shadow-xs' 
                                : 'bg-slate-50 border-slate-200/60 text-slate-500 hover:bg-slate-100 hover:text-slate-800' }}">
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>
            </form>

            {{-- 2 COLUMN GRID (LEFT: LIST, RIGHT: SIDEBAR) --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                {{-- LEFT COLUMN: LIST BERITA --}}
                <div class="lg:col-span-8 space-y-2">
                    @forelse($beritas as $berita)
                        @php
                            $badgeColors = [
                                'Infrastruktur' => 'text-blue-600',
                                'Sumber Daya Air' => 'text-emerald-600',
                                'Cipta Karya' => 'text-indigo-600',
                                'Kegiatan Dinas' => 'text-amber-600',
                                'Pengumuman' => 'text-rose-600',
                            ];
                            $colorClass = $badgeColors[$berita->kategori] ?? 'text-slate-600';
                        @endphp
                        
                        <article class="flex flex-col sm:flex-row gap-6 items-start py-6 border-b border-slate-100/80 last:border-0 group">
                            {{-- Thumbnail Image --}}
                            <div class="w-full sm:w-48 aspect-video rounded-xl overflow-hidden bg-slate-50 border border-slate-200/50 shrink-0 relative">
                                @if($berita->sampul && $berita->sampul->file_path)
                                    <img src="{{ Storage::url($berita->sampul->file_path) }}" 
                                         alt="{{ $berita->judul }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-555">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[8px] font-black uppercase text-slate-400">
                                        No Image
                                    </div>
                                @endif
                            </div>

                            {{-- Text Content --}}
                            <div class="space-y-2 flex-1">
                                {{-- Kategori --}}
                                <span class="text-[9px] font-black uppercase tracking-widest {{ $colorClass }}">
                                    {{ $berita->kategori }}
                                </span>
                                
                                {{-- Judul --}}
                                <h3 class="text-sm sm:text-base font-black text-slate-900 group-hover:text-blue-600 leading-snug transition duration-150">
                                    <a href="{{ route('berita.show', $berita->slug) }}" class="hover:underline">
                                        {{ $berita->judul }}
                                    </a>
                                </h3>
                                
                                {{-- Metadata (Tanggal & Tombol Bagikan) --}}
                                <div class="flex items-center justify-between pt-1">
                                    <div class="flex items-center space-x-1.5 text-[10px] font-bold text-slate-400">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"/>
                                        </svg>
                                        <span>{{ $berita->created_at->translatedFormat('l, d F Y') }}</span>
                                    </div>

                                    {{-- Share Icon Button --}}
                                    <button onclick="navigator.clipboard.writeText('{{ route('berita.show', $berita->slug) }}'); alert('Tautan berita berhasil disalin ke papan klip!')"
                                            class="text-slate-400 hover:text-blue-600 transition p-1 hover:bg-slate-50 rounded-lg cursor-pointer"
                                            title="Salin Tautan">
                                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 10.742l5.263-2.63M8.684 13.258l5.263 2.63m-1.049-7.01c.44-.762.307-1.748-.4-2.434a1.954 1.954 0 00-2.76 0c-.707.686-.84 1.672-.4 2.434.44.762 1.42 1.05 2.16.716.74-.334 1.04-1.385.4-2.434zm7.64 4.887c.44-.762.307-1.748-.4-2.434a1.954 1.954 0 00-2.76 0c-.707.686-.84 1.672-.4 2.434.44.762 1.42 1.05 2.16.716.74-.334 1.04-1.385.4-2.434zm-15.28 4.887c.44-.762.307-1.748-.4-2.434a1.954 1.954 0 00-2.76 0c-.707.686-.84 1.672-.4 2.434.44.762 1.42 1.05 2.16.716.74-.334 1.04-1.385.4-2.434z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="py-16 text-center space-y-4 bg-slate-50/50 border border-dashed border-slate-200 rounded-2xl">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mx-auto text-slate-400 shadow-inner">
                                📰
                            </div>
                            <div class="space-y-0.5">
                                <h6 class="text-xs font-black text-slate-800 uppercase tracking-wider">Berita Tidak Ditemukan</h6>
                                <p class="text-[10px] text-slate-400 font-semibold max-w-xs mx-auto">Tidak ada artikel berita yang cocok dengan kata kunci pencarian atau filter kategori saat ini.</p>
                            </div>
                        </div>
                    @endforelse

                    {{-- CUSTOM DSDA JABAR STYLE PAGINATION --}}
                    @if($beritas->hasPages())
                        <div class="pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                            {{-- Dropdown / Total Info --}}
                            <div class="text-[11px] text-slate-500 font-semibold flex items-center gap-1.5">
                                <span>Tampilkan</span>
                                <div class="px-2.5 py-1 bg-slate-100 border border-slate-200/50 rounded-lg text-slate-700 font-bold">
                                    {{ $beritas->count() }}
                                </div>
                                <span>Item dari total {{ $beritas->total() }}</span>
                            </div>

                            {{-- Navigation Info & Arrows --}}
                            <div class="flex items-center space-x-4">
                                <span class="text-[11px] text-slate-500 font-semibold">
                                    Halaman <strong class="text-slate-800">{{ $beritas->currentPage() }}</strong> dari {{ $beritas->lastPage() }}
                                </span>

                                <div class="flex items-center gap-1">
                                    @if($beritas->onFirstPage())
                                        <span class="w-8 h-8 rounded-lg bg-slate-50 border border-slate-200/30 text-slate-300 flex items-center justify-center text-xs cursor-not-allowed">
                                            &lsaquo;
                                        </span>
                                    @else
                                        <a href="{{ $beritas->previousPageUrl() }}" 
                                           class="w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 flex items-center justify-center text-xs font-bold transition">
                                            &lsaquo;
                                        </a>
                                    @endif

                                    @if($beritas->hasMorePages())
                                        <a href="{{ $beritas->nextPageUrl() }}" 
                                           class="w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 flex items-center justify-center text-xs font-bold transition">
                                            &rsaquo;
                                        </a>
                                    @else
                                        <span class="w-8 h-8 rounded-lg bg-slate-50 border border-slate-200/30 text-slate-300 flex items-center justify-center text-xs cursor-not-allowed">
                                            &rsaquo;
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- RIGHT COLUMN: SIDEBAR WIDGETS --}}
                <div class="lg:col-span-4 space-y-10 lg:sticky lg:top-32">
                    
                    {{-- WIDGET 1: PIN POST --}}
                    @if($pinned->isNotEmpty())
                        <div class="space-y-4">
                            <div class="border-b-2 border-blue-600 pb-2">
                                <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">Pin Post</h4>
                            </div>
                            <div class="space-y-4">
                                @foreach($pinned as $item)
                                    <div class="flex gap-4 items-start group">
                                        <div class="w-20 h-14 rounded-lg overflow-hidden bg-slate-50 border border-slate-200/50 shrink-0 relative">
                                            @if($item->sampul && $item->sampul->file_path)
                                                <img src="{{ Storage::url($item->sampul->file_path) }}" 
                                                     alt="{{ $item->judul }}" 
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-[7px] font-black uppercase text-slate-400">
                                                    No img
                                                </div>
                                            @endif
                                        </div>
                                        <div class="space-y-1 min-w-0">
                                            <h5 class="text-xs font-bold text-slate-800 line-clamp-2 group-hover:text-blue-600 transition leading-snug">
                                                <a href="{{ route('berita.show', $item->slug) }}">{{ $item->judul }}</a>
                                            </h5>
                                            <span class="block text-[9px] font-bold text-slate-400">
                                                {{ $item->created_at->translatedFormat('d F Y') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- WIDGET 2: ARTIKEL TERPOPULER --}}
                    @if($popular->isNotEmpty())
                        <div class="space-y-4">
                            <div class="border-b-2 border-blue-600 pb-2">
                                <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">Artikel Terpopuler</h4>
                            </div>
                            <div class="space-y-4">
                                @foreach($popular as $item)
                                    <div class="flex gap-4 items-start group">
                                        <div class="w-20 h-14 rounded-lg overflow-hidden bg-slate-50 border border-slate-200/50 shrink-0 relative">
                                            @if($item->sampul && $item->sampul->file_path)
                                                <img src="{{ Storage::url($item->sampul->file_path) }}" 
                                                     alt="{{ $item->judul }}" 
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-[7px] font-black uppercase text-slate-400">
                                                    No img
                                                </div>
                                            @endif
                                        </div>
                                        <div class="space-y-1 min-w-0">
                                            <h5 class="text-xs font-bold text-slate-800 line-clamp-2 group-hover:text-blue-600 transition leading-snug">
                                                <a href="{{ route('berita.show', $item->slug) }}">{{ $item->judul }}</a>
                                            </h5>
                                            <span class="block text-[9px] font-bold text-slate-400">
                                                {{ $item->created_at->translatedFormat('d F Y') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
                
            </div>

        </div>
    </div>
@endsection
