@extends('layouts.app')

@section('title', 'Galeri Foto Kegiatan')

@section('content')
    <div class="bg-slate-50 min-h-screen pb-16 font-sans">

        <div class="relative w-full overflow-hidden pt-32 pb-48 lg:pt-40 lg:pb-64 bg-blue-900">
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/slider/slide1.png') }}" alt="Background CIKASDA"
                    class="w-full h-full object-cover object-center scale-105 transform">
                <div class="absolute inset-0 bg-blue-950/80 mix-blend-multiply"></div>
                <div class="absolute inset-0 bg-linear-to-b from-blue-900/60 to-transparent"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="w-full flex flex-col items-start text-left">
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-4 py-2 text-blue-100 text-xs md:text-sm mb-8 font-medium shadow-sm">
                        <a href="{{ url('/') }}" class="hover:text-white transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            Beranda
                        </a>
                        <svg class="w-3.5 h-3.5 text-blue-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="hover:text-white transition-colors cursor-pointer">Galeri</span>
                        <svg class="w-3.5 h-3.5 text-blue-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-white font-semibold">Foto Kegiatan</span>
                    </div>

                    <div class="border-l-4 border-blue-500/50 pl-4 md:pl-6 mb-8 mt-4">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold font-heading text-white mb-4 tracking-tight relative">
                            Galeri Foto Kegiatan
                        </h1>

                        <div class="text-blue-100 text-sm md:text-base leading-relaxed max-w-2xl">
                            Arsip dokumentasi fisik pembangunan infrastruktur, pengelolaan sumber daya air, dan kegiatan dinas
                            resmi CIKASDA Provinsi Sulawesi Tengah.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 md:-mt-32 relative z-20">
            <div class="bg-white rounded-[2rem] p-6 sm:p-8 md:p-12 shadow-[0_15px_50px_rgba(15,23,42,0.04)] border border-slate-200/60 min-h-[50vh]">

                {{-- Navigation Tabs --}}
                <div class="flex flex-wrap items-center gap-3 mb-8 border-b border-slate-100 pb-6">
                    <a href="{{ route('galeri.foto') }}"
                        class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl shadow-md shadow-blue-600/20 transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Foto Kegiatan
                    </a>
                    <a href="{{ route('galeri.video') }}"
                        class="inline-flex items-center px-5 py-2.5 bg-slate-50 text-slate-500 hover:text-slate-800 hover:bg-slate-100 text-sm font-bold rounded-xl border border-slate-200 transition-all">
                        <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        Video Dokumentasi
                    </a>
                    <a href="{{ route('galeri.booklet') }}"
                        class="inline-flex items-center px-5 py-2.5 bg-slate-50 text-slate-500 hover:text-slate-800 hover:bg-slate-100 text-sm font-bold rounded-xl border border-slate-200 transition-all">
                        <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Booklet Digital
                    </a>
                </div>

                {{-- Toolbar: Statistik & Search --}}
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div class="flex items-center gap-4 bg-slate-50 border border-slate-200/60 rounded-xl px-4 py-3 w-fit">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-wider">Total Album</p>
                                <p class="text-sm font-bold text-slate-800 leading-none">{{ $albums->count() }}</p>
                            </div>
                        </div>
                        <div class="w-px h-8 bg-slate-200"></div>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-wider">Total Foto</p>
                                <p class="text-sm font-bold text-slate-800 leading-none">{{ collect($albums)->sum(fn($a) => $a->fotos->count()) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative w-full md:w-72">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" id="searchInput" placeholder="Cari album foto..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-xl leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-shadow">
                    </div>
                </div>

                {{-- Filter Kategori --}}
                <div class="flex flex-wrap items-center gap-2 mb-8" id="categoryFilterContainer">
                    <button class="kategori-btn active px-4 py-2 rounded-xl text-xs font-bold transition-all bg-blue-600 text-white shadow-md shadow-blue-600/20" data-kategori="all">Semua</button>
                    @foreach($kategoriList as $kat)
                        <button class="kategori-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-slate-50 text-slate-500 hover:text-slate-800 hover:bg-slate-100 border border-slate-200" data-kategori="{{ strtolower($kat) }}">{{ $kat }}</button>
                    @endforeach
                </div>

                {{-- Empty Search Result State --}}
                <div id="noResultState" class="hidden py-12 text-center w-full col-span-full">
                    <p class="text-slate-500 text-sm">Tidak ditemukan album yang cocok dengan pencarian "<span id="searchKeyword" class="font-bold text-slate-800"></span>".</p>
                </div>

                {{-- Grid Tampilan Album --}}
                <div id="albumGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($albums ?? [] as $album)
                        <div data-fotos="{{ json_encode($album->fotos) }}"
                             data-judul="{{ $album->judul_album }}"
                             data-deskripsi="{{ $album->deskripsi_album }}"
                             onclick="bukaModalGaleri(JSON.parse(this.dataset.fotos), this.dataset.judul, this.dataset.deskripsi)"
                            class="album-card bg-white rounded-3xl overflow-hidden border border-slate-200/60 shadow-[0_4px_20px_rgba(15,23,42,0.03)] hover:shadow-[0_12px_30px_rgba(15,23,42,0.07)] group hover:-translate-y-1 transition-all duration-300 cursor-pointer flex flex-col justify-between"
                            data-title="{{ strtolower($album->judul_album) }}"
                            data-desc="{{ strtolower($album->deskripsi_album) }}"
                            data-kategori="{{ strtolower($album->kategori ?: 'tanpa kategori') }}">

                            <div class="aspect-video w-full bg-slate-100 relative overflow-hidden">
                                @if ($album->fotos && $album->fotos->count() >= 4)
                                    <div class="grid grid-cols-2 grid-rows-2 h-full w-full gap-0.5 bg-white">
                                        @foreach($album->fotos->take(4) as $foto)
                                            <div class="w-full h-full overflow-hidden">
                                                <img src="{{ asset('storage/' . $foto->path_foto) }}"
                                                    alt="Cover {{ $album->judul_album }}" loading="lazy"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif ($album->fotos && $album->fotos->count() > 0)
                                    <img src="{{ asset('storage/' . $album->fotos[0]->path_foto) }}"
                                        alt="Cover {{ $album->judul_album }}" loading="lazy"
                                        class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-100 text-xs font-bold">
                                        No Image
                                    </div>
                                @endif

                                <div class="absolute bottom-4 right-4 bg-slate-900/80 backdrop-blur-md px-3 py-1 rounded-xl border border-white/10 text-white text-[10px] font-black tracking-wider flex items-center gap-1.5 shadow-xs">
                                    <svg class="w-3 h-3 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 002.25 1.5zm10.5-11.25h.008v.008h-.008V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    {{ $album->fotos->count() }} DOKUMENTASI
                                </div>
                            </div>

                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-white relative z-10">
                                <div class="space-y-2">
                                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest block">
                                        Terbit: {{ $album->created_at->format('d M Y') }}
                                    </span>
                                    <div class="flex items-start justify-between gap-2">
                                        <h3 class="text-base font-black text-slate-800 uppercase tracking-tight leading-snug break-words line-clamp-2 group-hover:text-blue-600 transition-colors">
                                            {{ $album->judul_album }}
                                        </h3>
                                    </div>
                                    <div class="inline-block">
                                        <span class="px-2.5 py-1 rounded-md bg-blue-50 text-blue-600 border border-blue-100 text-[9px] font-black uppercase tracking-widest inline-flex items-center gap-1 shadow-sm">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                            {{ $album->kategori ?: 'Tanpa Kategori' }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-400 font-medium leading-relaxed line-clamp-2">
                                        {{ $album->deskripsi_album ?? 'Tidak ada rincian deskripsi tambahan mengenai album kegiatan dinas ini.' }}
                                    </p>
                                </div>

                                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-black text-blue-600 uppercase tracking-wider group-hover:text-blue-700 transition-colors">
                                    <span>Buka Dokumentasi Visual</span>
                                    <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center space-y-5 max-w-xl mx-auto w-full">
                            <div class="w-32 h-32 mx-auto mb-4 opacity-80 animate-[bounce_3s_infinite]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full text-slate-300">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <polyline points="21 15 16 10 5 21" />
                                </svg>
                            </div>
                            <h3 class="text-sm md:text-lg font-black text-slate-800 uppercase tracking-widest leading-snug">
                                Belum Ada Album Foto
                            </h3>
                            <p class="text-xs md:text-sm text-slate-500 font-medium max-w-md mx-auto leading-relaxed">
                                Dokumentasi visual publikasi saat ini belum tersedia atau sedang diperbarui oleh administrator sistem CIKASDA.
                            </p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

        {{-- Modal Galeri --}}
        <div id="modal-galeri"
            class="fixed inset-0 z-[9999] invisible opacity-0 transition-all duration-300 ease-out bg-slate-950/95 backdrop-blur-xl flex items-center justify-center p-3 sm:p-4 md:p-8">
            <div class="absolute inset-0 cursor-pointer" onclick="tutupModalGaleri()"></div>

            <div id="modal-galeri-content"
                class="relative bg-white w-full max-w-6xl rounded-[2rem] sm:rounded-[2.5rem] overflow-hidden shadow-[0_25px_70px_rgba(0,0,0,0.5)] z-10 flex flex-col md:flex-row h-[90vh] md:h-[80vh] border border-white/10 transform scale-95 opacity-0 transition-all duration-300 ease-out delay-75">

                <div class="flex-1 bg-slate-950 flex items-center justify-center relative overflow-hidden group/frame min-h-[40vh] md:min-h-0">
                    <img id="modal-img-active" src="" alt="Active Visual" loading="lazy"
                        class="max-w-full max-h-full object-contain p-4 select-none drop-shadow-[0_10px_20px_rgba(0,0,0,0.3)] transition-all duration-500">

                    <div class="absolute bottom-4 inset-x-4 bg-slate-950/40 backdrop-blur-md px-5 py-3.5 rounded-2xl border border-white/10 text-center shadow-lg transform transition-transform duration-300">
                        <p id="modal-img-caption" class="text-white text-xs md:text-sm font-black uppercase tracking-widest drop-shadow-xs"></p>
                    </div>

                    <button onclick="sliderNavigasi(-1)"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 bg-slate-900/60 hover:bg-blue-600 text-white rounded-full flex items-center justify-center text-base border border-white/10 shadow-lg transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer group/btn">
                        <svg class="w-5 h-5 group-hover/btn:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <button onclick="sliderNavigasi(1)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 bg-slate-900/60 hover:bg-blue-600 text-white rounded-full flex items-center justify-center text-base border border-white/10 shadow-lg transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer group/btn">
                        <svg class="w-5 h-5 group-hover/btn:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>

                <div class="w-full md:w-[360px] bg-slate-50 p-6 sm:p-8 flex flex-col justify-between overflow-y-auto border-t md:border-t-0 md:border-l border-slate-200/60 h-[50vh] md:h-full">
                    <div class="space-y-5">
                        <div class="flex justify-between items-start gap-4">
                            <div class="space-y-1">
                                <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest bg-blue-50 border border-blue-200/60 px-2.5 py-1 rounded-md block w-fit shadow-3xs">
                                    Album Kegiatan
                                </span>
                                <h2 id="modal-title" class="text-lg font-black text-slate-900 uppercase tracking-tight leading-tight mt-1"></h2>
                            </div>
                            <button onclick="tutupModalGaleri()"
                                class="w-8 h-8 rounded-xl bg-white hover:bg-red-500 border border-slate-200 text-slate-400 hover:text-white flex items-center justify-center text-lg font-bold transition-all shadow-3xs active:scale-95 cursor-pointer">
                                &times;
                            </button>
                        </div>

                        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-3xs">
                            <p id="modal-desc" class="text-xs text-slate-500 font-semibold leading-relaxed max-h-36 overflow-y-auto pr-1 scrollbar-thin"></p>
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t border-slate-200/80 space-y-3">
                        <div class="flex justify-between items-center px-0.5">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Daftar Koleksi Foto</p>
                            <span id="modal-counter-badge" class="text-[10px] font-black text-blue-600 bg-white px-2 py-0.5 rounded-md border border-slate-200 shadow-3xs"></span>
                        </div>
                        <div id="modal-thumb-container" class="grid grid-cols-4 gap-2.5 max-h-36 overflow-y-auto p-0.5 scrollbar-thin"></div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        let koleksiFotoAktif = [];
        let indexAktif = 0;

        function bukaModalGaleri(fotos, judul, deskripsi) {
            if (!fotos || fotos.length === 0) return;

            koleksiFotoAktif = fotos;
            indexAktif = 0;

            document.getElementById('modal-title').innerText = judul;
            document.getElementById('modal-desc').innerText = deskripsi ? deskripsi :
                'Tidak ada rincian deskripsi tambahan mengenai album kegiatan ini.';

            let thumbContainer = document.getElementById('modal-thumb-container');
            thumbContainer.innerHTML = '';

            koleksiFotoAktif.forEach((foto, index) => {
                let thumb = document.createElement('div');
                thumb.className = `aspect-square bg-white border rounded-xl overflow-hidden cursor-pointer shadow-3xs transition-all duration-300 hover:scale-105 ${index === 0 ? 'border-blue-600 ring-4 ring-blue-600/10 scale-102' : 'border-slate-200'}`;
                thumb.id = `thumb-item-${index}`;
                thumb.onclick = () => gantiFotoAktif(index);
                thumb.innerHTML = `<img src="/storage/${foto.path_foto}" loading="lazy" class="w-full h-full object-cover select-none">`;
                thumbContainer.appendChild(thumb);
            });

            gantiFotoAktif(0);

            let modal = document.getElementById('modal-galeri');
            let modalContent = document.getElementById('modal-galeri-content');

            modal.classList.remove('invisible', 'opacity-0');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');

            document.body.style.overflow = 'hidden';
        }

        function gantiFotoAktif(index) {
            let oldThumb = document.getElementById(`thumb-item-${indexAktif}`);
            if (oldThumb) {
                oldThumb.className = "aspect-square bg-white border border-slate-200 rounded-xl overflow-hidden cursor-pointer shadow-3xs transition-all duration-300 hover:scale-105";
            }

            indexAktif = index;

            let newThumb = document.getElementById(`thumb-item-${indexAktif}`);
            if (newThumb) {
                newThumb.className = "aspect-square bg-white border border-blue-600 rounded-xl overflow-hidden cursor-pointer shadow-3xs transition-all duration-300 scale-105 ring-4 ring-blue-600/10";
                newThumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
            }

            let dataFoto = koleksiFotoAktif[indexAktif];
            document.getElementById('modal-img-active').src = `/storage/${dataFoto.path_foto}`;
            document.getElementById('modal-img-caption').innerText = dataFoto.keterangan_foto ? dataFoto.keterangan_foto : 'Dokumentasi Kegiatan';
            document.getElementById('modal-counter-badge').innerText = `${indexAktif + 1} / ${koleksiFotoAktif.length}`;
        }

        function sliderNavigasi(arah) {
            let indexBaru = indexAktif + arah;
            if (indexBaru >= 0 && indexBaru < koleksiFotoAktif.length) {
                gantiFotoAktif(indexBaru);
            } else if (indexBaru < 0) {
                gantiFotoAktif(koleksiFotoAktif.length - 1);
            } else {
                gantiFotoAktif(0);
            }
        }

        function tutupModalGaleri() {
            let modal = document.getElementById('modal-galeri');
            let modalContent = document.getElementById('modal-galeri-content');

            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('invisible');
                document.body.style.overflow = '';
            }, 300);
        }

        const searchInput = document.getElementById('searchInput');
        const categoryBtns = document.querySelectorAll('.kategori-btn');
        let activeCategory = 'all';

        function filterAlbums() {
            const keyword = searchInput ? searchInput.value.toLowerCase() : '';
            const cards = document.querySelectorAll('.album-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const title = card.getAttribute('data-title') || '';
                const desc = card.getAttribute('data-desc') || '';
                const kategori = card.getAttribute('data-kategori') || '';

                const matchesKeyword = title.includes(keyword) || desc.includes(keyword);
                const matchesCategory = activeCategory === 'all' || kategori === activeCategory;

                if (matchesKeyword && matchesCategory) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const noResult = document.getElementById('noResultState');
            const searchKeyword = document.getElementById('searchKeyword');

            if (visibleCount === 0 && (keyword !== '' || activeCategory !== 'all')) {
                noResult.classList.remove('hidden');
                if(keyword !== '') {
                    searchKeyword.textContent = keyword;
                } else {
                    searchKeyword.textContent = "Kategori ini";
                }
            } else {
                noResult.classList.add('hidden');
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', filterAlbums);
        }

        categoryBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active styling from all buttons
                categoryBtns.forEach(b => {
                    b.classList.remove('bg-blue-600', 'text-white', 'shadow-md', 'shadow-blue-600/20');
                    b.classList.add('bg-slate-50', 'text-slate-500', 'border', 'border-slate-200');
                });

                // Add active styling to clicked button
                this.classList.remove('bg-slate-50', 'text-slate-500', 'border', 'border-slate-200');
                this.classList.add('bg-blue-600', 'text-white', 'shadow-md', 'shadow-blue-600/20');

                activeCategory = this.getAttribute('data-kategori');
                filterAlbums();
            });
        });

        document.addEventListener('keydown', function(e) {
            let modal = document.getElementById('modal-galeri');
            if (modal && !modal.classList.contains('invisible')) {
                if (e.key === 'ArrowLeft') sliderNavigasi(-1);
                if (e.key === 'ArrowRight') sliderNavigasi(1);
                if (e.key === 'Escape') tutupModalGaleri();
            }
        });
    </script>
@endsection