@extends('layouts.app') {{-- Menyesuaikan dengan master layout utama user kamu --}}

@section('title', 'Galeri Video Dokumentasi')

@section('content')
    <div class="bg-slate-50 min-h-screen pb-16 font-sans">

        {{-- ==================================================================
         1. HERO SECTION DINAMIS (SINKRON DENGAN PROFIL LAIN)
         ================================================================== --}}
        <x-profil-hero title="Video Dokumentasi" 
            description="Arsip liputan video eksklusif pembangunan infrastruktur, pemantauan fisik lapangan, dan dokumentasi proyek dinas resmi CIKASDA Provinsi Sulawesi Tengah." />

        {{-- ==================================================================
         2. GRIDS VIDEO RESPONSIVE (CONTAINER PUTIH UTUH MEMBENTANG LUAS)
         ================================================================== --}}
        {{-- KUNCI UTAMA: Menaikkan kontainer utama dan memberikan background putih solid agar tidak menggantung --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 md:-mt-32 relative z-20">
            <div
                class="bg-white rounded-4xl p-6 sm:p-8 md:p-12 shadow-[0_15px_50px_rgba(15,23,42,0.04)] border border-slate-200/60 min-h-[50vh]">

                {{-- Toolbar: Statistik & Search --}}
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div class="flex items-center gap-4 bg-slate-50 border border-slate-200/60 rounded-xl px-4 py-3 w-fit">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-wider">Total Unggahan</p>
                                <p class="text-sm font-bold text-slate-800 leading-none">
                                    {{ $totalUnggahan ?? $videos->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative w-full md:w-72">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="searchInput" placeholder="Cari video dokumentasi..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-xl leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-shadow">
                    </div>
                </div>

                {{-- Empty Search Result State --}}
                <div id="noResultState" class="hidden py-12 text-center w-full col-span-full">
                    <p class="text-slate-500 text-sm">Tidak ditemukan video yang cocok dengan pencarian "<span
                            id="searchKeyword" class="font-bold text-slate-800"></span>".</p>
                </div>

                {{-- Grid Card Loop --}}
                <div id="videoGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($videos ?? [] as $video)
                        {{-- CARD CONTAINER MULTIMEDIA VIDEO --}}
                        <div onclick="bukaModalVideo('{{ $video->url_youtube }}', '{{ $video->url_video ?? '' }}', '{{ addslashes($video->judul_video) }}', '{{ addslashes($video->deskripsi_video) }}')"
                            class="video-card bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-[0_4px_15px_rgba(15,23,42,0.02)] hover:shadow-[0_12px_25px_rgba(15,23,42,0.06)] group hover:-translate-y-1 transition-all duration-300 cursor-pointer flex flex-col justify-between"
                            data-title="{{ strtolower($video->judul_video) }}"
                            data-desc="{{ strtolower($video->deskripsi_video) }}">

                            {{-- Box Media Cover/Thumbnail Player --}}
                            <div
                                class="aspect-video w-full bg-slate-900 relative overflow-hidden flex items-center justify-center">
                                @if ($video->file_video)
                                    <video src="{{ $video->url_video }}"
                                        class="w-full h-full object-cover" preload="metadata" muted></video>
                                    <div
                                        class="absolute inset-0 bg-slate-950/40 flex items-center justify-center group-hover:bg-slate-950/50 transition-colors">
                                        <span
                                            class="text-[9px] font-black text-white bg-blue-600/90 border border-blue-400/50 px-2 py-0.5 rounded shadow-sm uppercase tracking-wider absolute top-3 left-3">Video
                                            Dinas</span>
                                        <div
                                            class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm shadow-md transform group-hover:scale-110 transition-transform duration-300">
                                            ▶</div>
                                    </div>
                                @else
                                    <img src="https://img.youtube.com/vi/{{ $video->url_youtube }}/hqdefault.jpg"
                                        alt="Cover"
                                        class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-500">
                                    <div
                                        class="absolute inset-0 bg-slate-950/30 flex items-center justify-center group-hover:bg-slate-950/40 transition-colors">
                                        <span
                                            class="text-[9px] font-black text-white bg-red-600/90 border border-red-400/50 px-2 py-0.5 rounded shadow-sm uppercase tracking-wider absolute top-3 left-3">YouTube</span>
                                        <div
                                            class="w-12 h-12 rounded-full bg-red-600 text-white flex items-center justify-center text-sm shadow-md transform group-hover:scale-110 transition-transform duration-300">
                                            ▶</div>
                                    </div>
                                @endif
                            </div>

                            {{-- Informasi Metadata Judul & Rincian --}}
                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-white">
                                <div class="space-y-2">
                                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest block">
                                        Diterbitkan: {{ $video->created_at->format('d M Y') }}
                                    </span>
                                    <h3
                                        class="text-base font-black text-slate-800 uppercase tracking-tight leading-snug break-words line-clamp-2 group-hover:text-blue-600 transition-colors">
                                        {{ $video->judul_video }}
                                    </h3>
                                    <p class="text-xs text-slate-400 font-medium leading-relaxed line-clamp-2">
                                        {{ $video->deskripsi_video ?? 'Tidak ada rincian ringkasan deskripsi tambahan mengenai video liputan dinas ini.' }}
                                    </p>
                                </div>

                                <div
                                    class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-black text-blue-600 uppercase tracking-wider group-hover:text-blue-700 transition-colors">
                                    <span>Putar Video Liputan</span>
                                    <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- TAMPILAN JIKA BELUM ADA DATA VIDEO --}}
                        <div class="col-span-full py-16 text-center space-y-4 max-w-md mx-auto">
                            <div
                                class="w-14 h-14 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center mx-auto text-blue-500 shadow-3xs">
                                <svg class="w-7 h-7 stroke-[1.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l-4.5 3v-6l4.5 3z" />
                                </svg>
                            </div>
                            <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest">Belum Ada Video
                                Dokumentasi</h3>
                            <p class="text-xs text-slate-400 font-medium leading-relaxed">Arsip video kegiatan dinas saat
                                ini belum tersedia atau sedang diperbarui oleh pihak administrator.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
        {{-- ==================================================================
         3. CINEMATIC INTERACTIVE THEATRE LIGHTBOX MODAL (MID-SIZE COMPACT FIXED)
         ================================================================== --}}
        <div id="modal-video-theater"
            class="fixed inset-0 z-[9999] hidden bg-slate-950/60 backdrop-blur-md flex items-center justify-center p-4 transition-all duration-300">
            {{-- Klik area luar untuk menutup player --}}
            <div class="absolute inset-0 cursor-pointer" onclick="tutupModalVideo()"></div>

            {{-- Main Container Card - KUNCI: max-w-3xl agar ukuran video tidak raksasa, tetap manis & proporsional --}}
            <div
                class="relative bg-slate-900 w-full max-w-3xl rounded-[2rem] overflow-hidden shadow-[0_25px_60px_rgba(0,0,0,0.5)] z-10 flex flex-col md:flex-row max-h-[80vh] border border-white/10 animate-scale-up">

                {{-- LAYAR UTAMA PEMUTAR VIDEO (SISI KIRI - COMPACT VALUE 65%) --}}
                <div
                    class="w-full md:w-[65%] bg-black flex items-center justify-center relative overflow-hidden aspect-video md:aspect-auto min-h-[25vh] md:min-h-[380px] flex-shrink-0">

                    {{-- SLOT 1: Pemutar YouTube Player --}}
                    <div id="container-yt-player" class="w-full h-full hidden relative">
                        <iframe id="frame-yt-active" class="w-full h-full absolute inset-0" src="" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>

                    {{-- SLOT 2: Pemutar File Video Lokal Native HTML5 --}}
                    <video id="tag-video-active" class="w-full h-full object-contain bg-black" controls
                        controlsList="nodownload"></video>
                </div>

                {{-- DESKRIPSI & INFO DETAIL VIDEO (SISI KANAN - RAMPING IDEAL 35%) --}}
                <div
                    class="w-full md:w-[35%] bg-slate-950/50 backdrop-blur-md p-5 flex flex-col justify-between border-t md:border-t-0 md:border-l border-white/10 text-left overflow-y-auto">
                    <div class="space-y-4">
                        {{-- Header Title Row --}}
                        <div class="flex justify-between items-start gap-2">
                            <div class="space-y-1 flex-1">
                                <span
                                    class="text-[9px] font-black text-blue-400 uppercase tracking-widest bg-blue-500/10 border border-blue-400/30 px-2 py-0.5 rounded block w-fit shadow-sm">
                                    Dinas Cikasda
                                </span>
                                <h2 id="modal-video-title"
                                    class="text-xs font-black text-white uppercase tracking-tight leading-tight mt-1 break-words line-clamp-2">
                                </h2>
                            </div>

                            {{-- Button Close Modern Melayang --}}
                            <button onclick="tutupModalVideo()"
                                class="w-6 h-6 flex-shrink-0 rounded-md bg-white/10 hover:bg-red-600 text-white flex items-center justify-center text-xs font-bold transition-all border border-white/10 active:scale-95 cursor-pointer">
                                &times;
                            </button>
                        </div>

                        {{-- Box Teks Deskripsi Video Premium Kontras Tinggi --}}
                        <div class="bg-white/5 p-3 rounded-xl border border-white/5 shadow-inner">
                            <p id="modal-video-desc"
                                class="text-[11px] text-slate-300 font-medium leading-relaxed max-h-36 md:max-h-48 overflow-y-auto pr-1 scrollbar-thin">
                            </p>
                        </div>
                    </div>

                    {{-- Footer Label --}}
                    <div class="pt-3 border-t border-white/5 text-center mt-4">
                        <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Dokumentasi Visual Resmi
                        </p>
                    </div>
                </div>

            </div>
        </div>

        {{-- ==================================================================
     4. LIGHTBOX MULTIMEDIA THEATRE ENGINE (JAVASCRIPT AUTOMATION)
     ================================================================== --}}
        <script>
            function bukaModalVideo(idYoutube, pathLokal, judul, deskripsi) {
                let modal = document.getElementById('modal-video-theater');
                let ytContainer = document.getElementById('container-yt-player');
                let ytFrame = document.getElementById('frame-yt-active');
                let videoTag = document.getElementById('tag-video-active');

                // Set judul dan deskripsi teks kanan
                document.getElementById('modal-video-title').innerText = judul;
                document.getElementById('modal-video-desc').innerText = deskripsi ? deskripsi :
                    'Tidak ada catatan deskripsi tambahan mengenai publikasi video ini.';

                // Sembunyikan kedua slot pemutar terlebih dahulu untuk sterilisasi data
                ytContainer.classList.add('hidden');
                videoTag.classList.add('hidden');
                ytFrame.src = "";
                videoTag.src = "";

                // LOGIC PILIHAN PEMUTAR MEDIA HIBRIDA
                if (pathLokal && pathLokal.trim() !== "") {
                    // Mainkan File Video Lokal
                    videoTag.src = pathLokal;
                    videoTag.classList.remove('hidden');
                    videoTag.play(); // Auto-play video fisik lokal
                } else if (idYoutube && idYoutube.trim() !== "") {
                    // Mainkan Video YouTube Embed dengan mode Autoplay aman
                    ytFrame.src = `https://www.youtube.com/embed/${idYoutube}?autoplay=1&rel=0`;
                    ytContainer.classList.remove('hidden');
                }

                // Tampilkan Modal popup ke layar depan
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Kunci scroll layar luar publik
            }

            function tutupModalVideo() {
                let modal = document.getElementById('modal-video-theater');
                let ytFrame = document.getElementById('frame-yt-active');
                let videoTag = document.getElementById('tag-video-active');

                // Hentikan paksa semua audio & video yang sedang diputar agar tidak bocor keluar suara
                ytFrame.src = "";
                videoTag.pause();
                videoTag.src = "";

                modal.classList.add('hidden');
                document.body.style.overflow = ''; // Lepas kunci scroll layar luar publik
            }

            // Jalur pintas tombol fisik Keyboard escape
            document.addEventListener('keydown', function(e) {
                let modal = document.getElementById('modal-video-theater');
                if (modal && !modal.classList.contains('hidden')) {
                    if (e.key === 'Escape') tutupModalVideo();
                }
            });

            // LOGIKA PENCARIAN VIDEO
            const searchInput = document.getElementById('searchInput');
            function filterVideos() {
                const keyword = searchInput ? searchInput.value.toLowerCase() : '';
                const cards = document.querySelectorAll('.video-card');
                let visibleCount = 0;

                cards.forEach(card => {
                    const title = card.getAttribute('data-title') || '';
                    const desc = card.getAttribute('data-desc') || '';

                    const matchesKeyword = title.includes(keyword) || desc.includes(keyword);

                    if (matchesKeyword) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                const noResult = document.getElementById('noResultState');
                const searchKeyword = document.getElementById('searchKeyword');

                if (visibleCount === 0 && keyword !== '') {
                    noResult.classList.remove('hidden');
                    searchKeyword.textContent = keyword;
                } else {
                    noResult.classList.add('hidden');
                }
            }

            if (searchInput) {
                searchInput.addEventListener('input', filterVideos);
            }
        </script>
    @endsection
