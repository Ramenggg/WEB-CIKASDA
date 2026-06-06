@php
    $beritas = \App\Models\Berita::with('sampul')
        ->where('status', 'Publish')
        ->latest()
        ->take(5)
        ->get();

    $utama = $beritas->first();
    $sampingan = $beritas->skip(1);
@endphp

<section class="py-12 bg-slate-50 relative z-10">
    <div class="max-w-7xl mx-auto px-6 sm:px-4 lg:px-8">

        <div class="text-center mb-16">
            <div class="flex items-center justify-center space-x-4 mb-6">
                <div class="w-16 md:w-24 h-px bg-blue-600"></div>
                <span class="text-blue-600 font-medium text-xs md:text-sm tracking-widest uppercase">
                    Berita, Artikel, & Pengumuman
                </span>
                <div class="w-16 md:w-24 h-px bg-blue-600"></div>
            </div>
            <h2 class="text-3xl md:text-3xl font-normal text-slate-800 tracking-tight">
                Berita Terbaru <br> Dinas Sumber Daya Air dan Cipta Karya Provinsi Sulawesi Tengah
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-slate-100 p-6 md:p-8">

            <div
                class="flex flex-col lg:flex-row lg:items-end justify-between mb-10 border-b border-slate-200/60 pb-6 gap-6">

                <div class="flex items-center group shrink-0 mb-1">
                    <div
                        class="w-2.5 h-12 bg-linear-to-b from-blue-600 to-blue-950 rounded-full mr-5 shadow-sm transition-transform duration-500 group-hover:scale-y-110">
                    </div>

                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-slate-800 tracking-tight leading-none uppercase">
                            Berita & Artikel
                        </h2>
                        <p
                            class="text-[9px] md:text-[11px] font-bold text-blue-600 uppercase tracking-[0.2em] mt-2 whitespace-nowrap opacity-70">
                            Dinas Cipta Karya dan Sumber Daya Air
                        </p>
                    </div>
                </div>

                {{-- Kelompok Aksi (Search + Button) --}}
                <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">

                    {{-- Kolom Pencarian Mencolok --}}
                    <form action="{{ route('berita.index') }}" method="GET" class="relative group flex-1 md:flex-none">
                        <input type="text" name="search" placeholder="Cari berita..."
                            class="w-full md:w-70 bg-white border-2 border-blue-100 text-slate-800 text-sm font-bold rounded-2xl py-2.5 pl-12 pr-4 outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 shadow-sm shadow-blue-50 placeholder:text-slate-400 placeholder:font-medium">

                        {{-- Ikon Pencarian --}}
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </form>

                    {{-- Tombol Lihat Semua --}}
                    <a href="{{ route('berita.index') }}"
                        class="group flex items-center px-6 py-3 bg-blue-600 hover:bg-slate-900 text-white text-xs font-black uppercase tracking-widest rounded-2xl transition-all duration-300 shadow-xl shadow-blue-200 hover:shadow-slate-200 active:scale-95 shrink-0">
                        Lihat Semua
                        <svg class="ml-2 w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

            </div>

            @if($beritas->isEmpty())
                <div class="text-center py-20 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 00-2-2m-2 3h.01M5.5 12h.01M9 12h.01M19 16h-4M5.5 16h.01M9 16h.01M13 16h.01"></path>
                    </svg>
                    <h5 class="text-sm font-black text-slate-700 uppercase tracking-wider">Belum Ada Berita</h5>
                    <p class="text-xs text-slate-400 font-semibold mt-1">Dinas CIKASDA belum mempublikasikan artikel berita saat ini.</p>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                    @if($utama)
                        <a href="{{ route('berita.show', $utama->slug) }}"
                            class="lg:col-span-7 group relative rounded-2xl overflow-hidden h-100 lg:h-120 shadow-sm block bg-slate-900">
                            
                            @if($utama->sampul && $utama->sampul->file_path)
                                <img src="{{ Storage::url($utama->sampul->file_path) }}"
                                    alt="{{ $utama->judul }}"
                                    class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-in-out opacity-80 group-hover:opacity-90">
                            @else
                                <div class="absolute inset-0 w-full h-full bg-slate-800 flex items-center justify-center text-slate-500">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/40 to-transparent z-10"></div>

                            <div class="absolute top-5 left-5 z-20">
                                <span class="px-3 py-1.5 bg-blue-600 text-white text-xs font-bold rounded-md shadow-md uppercase tracking-wider">
                                    {{ $utama->kategori }}
                                </span>
                            </div>

                            <div class="absolute bottom-0 left-0 p-6 md:p-8 w-full z-20">
                                <div class="flex items-center gap-2 text-slate-300 text-xs font-semibold mb-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $utama->created_at->translatedFormat('d F Y') }}</span>
                                </div>
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-white leading-tight mb-3 group-hover:text-yellow-400 transition-colors line-clamp-2">
                                    {{ $utama->judul }}
                                </h3>
                                <p class="text-slate-200 text-sm md:text-base leading-relaxed line-clamp-2 mb-4">
                                    {{ strip_tags(html_entity_decode($utama->konten)) }}
                                </p>
                                <span
                                    class="inline-flex items-center text-yellow-400 font-bold text-sm uppercase tracking-wider group-hover:translate-x-2 transition-transform duration-300">
                                    Selengkapnya
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    @endif

                    <div class="lg:col-span-5 flex flex-col justify-start space-y-6">
                        @foreach($sampingan as $item)
                            <a href="{{ route('berita.show', $item->slug) }}"
                                class="group flex items-start pb-4 border-b border-slate-100 last:border-0 last:pb-0 transition-all">
                                <div class="shrink-0 w-28 h-24 rounded-xl overflow-hidden relative shadow-sm bg-slate-100 flex items-center justify-center">
                                    @if($item->sampul && $item->sampul->file_path)
                                        <img src="{{ Storage::url($item->sampul->file_path) }}"
                                            alt="{{ $item->judul }}"
                                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="ml-4 grow flex flex-col justify-center">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span class="bg-blue-600 text-white text-[9px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">
                                            {{ $item->kategori }}
                                        </span>
                                        <span class="text-[10px] text-slate-400 font-bold">
                                            {{ $item->created_at->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                    <h4
                                        class="text-sm md:text-base font-bold text-slate-800 group-hover:text-blue-600 transition-colors leading-snug line-clamp-2 mb-1">
                                        {{ $item->judul }}
                                    </h4>
                                    <span
                                        class="text-blue-600 text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity flex items-center">
                                        Selengkapnya <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
