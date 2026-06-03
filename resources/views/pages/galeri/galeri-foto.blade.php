@extends('layouts.app') {{-- Menyesuaikan dengan master layout utama user kamu --}}

@section('title', 'Galeri Foto Kegiatan')

@section('content')
    <div class="bg-slate-50 min-h-screen pb-16 font-sans">

        {{-- ==================================================================
         1. HERO SECTION GEDUNG UTAMA (SINKRON TOTAL SESUAI TUGAS & FUNGSI)
         ================================================================== --}}
        <div class="relative w-full overflow-hidden pt-32 pb-48 lg:pt-40 lg:pb-64 bg-blue-900">
            {{-- Background Image --}}
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/slider/slide1.png') }}" alt="Background CIKASDA"
                    class="w-full h-full object-cover object-center scale-105 transform">
                <div class="absolute inset-0 bg-blue-950/80 mix-blend-multiply"></div>
                {{-- Efek Shadow Gradasi Biru Atas ke Bawah --}}
                <div class="absolute inset-0 bg-linear-to-b from-blue-900/60 to-transparent"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="w-full flex flex-col items-start text-left">
                    {{-- Breadcrumb (Beautified) --}}
                    <div
                        class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-4 py-2 text-blue-100 text-xs md:text-sm mb-8 font-medium shadow-sm">
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

                    {{-- Judul Utama Besar Premium --}}
                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold font-heading text-white mb-6 tracking-tight relative uppercase">
                        Galeri Foto Kegiatan
                    </h1>

                    {{-- Deskripsi Rata Kiri Dengan Border-L Khas Dinas --}}
                    <div
                        class="text-blue-100 text-sm md:text-base leading-relaxed mb-8 max-w-2xl mt-2 pl-4 border-l-2 border-blue-500/50">
                        Arsip dokumentasi fisik pembangunan infrastruktur, pengelolaan sumber daya air, dan kegiatan dinas
                        resmi CIKASDA Provinsi Sulawesi Tengah.
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================================================================
         2. GRIDS ALBUM YANG DIINPUT OLEH ADMIN (KOTAK PUTIH LEBIH NAIK UTUH)
         ================================================================== --}}
        {{-- KUNCI PERBAIKAN: Menggunakan -mt-24 md:-mt-32 dan dibungkus bg-white solid agar tidak menggantung kosong --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 md:-mt-32 relative z-20">
            <div
                class="bg-white rounded-[2rem] p-6 sm:p-8 md:p-12 shadow-[0_15px_50px_rgba(15,23,42,0.04)] border border-slate-200/60 min-h-[50vh]">

                {{-- Judul Seksi Kecil Internal --}}
                <div class="flex items-center space-x-2.5 mb-8 px-1">
                    <span class="h-4 w-1 bg-blue-600 rounded-full shadow-xs"></span>
                    <h2 class="text-xs md:text-sm font-black text-slate-800 uppercase tracking-widest">Arsip Dokumentasi
                        Album Foto Terbit</h2>
                </div>

                {{-- Grid Tampilan Album --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($albums ?? [] as $album)
                        {{-- KARD ALBUM MODERN FLUID CARD --}}
                        <div onclick="bukaModalGaleri({{ json_encode($album->fotos) }}, '{{ $album->judul_album }}', '{{ $album->deskripsi_album }}')"
                            class="bg-white rounded-3xl overflow-hidden border border-slate-200/60 shadow-[0_4px_20px_rgba(15,23,42,0.03)] hover:shadow-[0_12px_30px_rgba(15,23,42,0.07)] group hover:-translate-y-1 transition-all duration-300 cursor-pointer flex flex-col justify-between">

                            {{-- Visual Sampul Gambar Pertama --}}
                            <div class="aspect-video w-full bg-slate-100 relative overflow-hidden">
                                @if ($album->fotos && $album->fotos->count() > 0)
                                    <img src="{{ asset('storage/' . $album->fotos[0]->path_foto) }}"
                                        alt="Cover {{ $album->judul_album }}"
                                        class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-500">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-100 text-xs font-bold">
                                        No Image</div>
                                @endif

                                {{-- Badge Total Foto Terupload --}}
                                <div
                                    class="absolute bottom-4 right-4 bg-slate-900/80 backdrop-blur-md px-3 py-1 rounded-xl border border-white/10 text-white text-[10px] font-black tracking-wider flex items-center gap-1.5 shadow-xs">
                                    <svg class="w-3 h-3 text-yellow-400" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 002.25 1.5zm10.5-11.25h.008v.008h-.008V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    {{ $album->fotos->count() }} DOKUMENTASI
                                </div>
                            </div>

                            {{-- Konten Informasi Metadata Album --}}
                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-white">
                                <div class="space-y-2">
                                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest block">
                                        Terbit: {{ $album->created_at->format('d M Y') }}
                                    </span>
                                    <h3
                                        class="text-base font-black text-slate-800 uppercase tracking-tight leading-snug break-words line-clamp-2 group-hover:text-blue-600 transition-colors">
                                        {{ $album->judul_album }}
                                    </h3>
                                    <p class="text-xs text-slate-400 font-medium leading-relaxed line-clamp-2">
                                        {{ $album->deskripsi_album ?? 'Tidak ada rincian deskripsi tambahan mengenai album kegiatan dinas ini.' }}
                                    </p>
                                </div>

                                <div
                                    class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-black text-blue-600 uppercase tracking-wider group-hover:text-blue-700 transition-colors">
                                    <span>Buka Dokumentasi Visual</span>
                                    <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- KOTAK INDEKS KOSONG YANG BESAR LUAS & MODERN --}}
                        <div class="col-span-full py-16 text-center space-y-4 max-w-xl mx-auto w-full">
                            <div
                                class="w-16 h-16 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center mx-auto text-blue-500 shadow-3xs mb-2">
                                <svg class="w-8 h-8 stroke-[1.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                </svg>
                            </div>
                            <h3
                                class="text-sm md:text-base font-black text-slate-700 uppercase tracking-widest leading-snug">
                                Belum Ada Album Foto Kegiatan Dinas
                            </h3>
                            <p class="text-xs text-slate-400 font-medium max-w-md mx-auto leading-relaxed">
                                Dokumentasi visual publikasi saat ini belum tersedia atau sedang diperbarui oleh
                                administrator sistem CIKASDA.
                            </p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

        {{-- ==================================================================
         3. ULTRA-MODERN COCKPIT PHOTO INTERACTIVE MODAL (UPGRADED PREMIUM)
         ================================================================== --}}
        <div id="modal-galeri"
            class="fixed inset-0 z-[9999] hidden bg-slate-950/95 backdrop-blur-xl flex items-center justify-center p-3 sm:p-4 md:p-8 transition-all duration-300">
            {{-- Area overlay klik luar untuk menutup --}}
            <div class="absolute inset-0 cursor-pointer" onclick="tutupModalGaleri()"></div>

            {{-- Main Container Card Modal --}}
            <div
                class="relative bg-white w-full max-w-6xl rounded-[2rem] sm:rounded-[2.5rem] overflow-hidden shadow-[0_25px_70px_rgba(0,0,0,0.5)] z-10 flex flex-col md:flex-row h-[90vh] md:h-[80vh] border border-white/10 animate-scale-up">

                {{-- PANEL KIRI: FRAME VISUAL GAMBAR (DARK GLOSSY MODE) --}}
                <div
                    class="flex-1 bg-slate-950 flex items-center justify-center relative overflow-hidden group/frame min-h-[40vh] md:min-h-0">
                    {{-- Gambar Utama Aktif --}}
                    <img id="modal-img-active" src="" alt="Active Visual"
                        class="max-w-full max-h-full object-contain p-4 select-none drop-shadow-[0_10px_20px_rgba(0,0,0,0.3)] transition-all duration-500">

                    {{-- Floating Glassmorphism Caption (Keterangan Foto) --}}
                    <div
                        class="absolute bottom-4 inset-x-4 bg-slate-950/40 backdrop-blur-md px-5 py-3.5 rounded-2xl border border-white/10 text-center shadow-lg transform transition-transform duration-300">
                        <p id="modal-img-caption"
                            class="text-white text-xs md:text-sm font-black uppercase tracking-widest drop-shadow-xs"></p>
                    </div>

                    {{-- Modern Floating Navigation Arrows --}}
                    <button onclick="sliderNavigasi(-1)"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 bg-slate-900/60 hover:bg-blue-600 text-white rounded-full flex items-center justify-center text-base border border-white/10 shadow-lg transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer group/btn">
                        <svg class="w-5 h-5 group-hover/btn:-translate-x-0.5 transition-transform" fill="none"
                            stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <button onclick="sliderNavigasi(1)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 bg-slate-900/60 hover:bg-blue-600 text-white rounded-full flex items-center justify-center text-base border border-white/10 shadow-lg transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer group/btn">
                        <svg class="w-5 h-5 group-hover/btn:translate-x-0.5 transition-transform" fill="none"
                            stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>

                {{-- PANEL KANAN: DETAIL INFO & THUMBNAILS (CLEAN MODERN) --}}
                <div
                    class="w-full md:w-[360px] bg-slate-50 p-6 sm:p-8 flex flex-col justify-between overflow-y-auto border-t md:border-t-0 md:border-l border-slate-200/60 h-[50vh] md:h-full">
                    <div class="space-y-5">
                        <div class="flex justify-between items-start gap-4">
                            <div class="space-y-1">
                                <span
                                    class="text-[9px] font-black text-blue-600 uppercase tracking-widest bg-blue-50 border border-blue-200/60 px-2.5 py-1 rounded-md block w-fit shadow-3xs">
                                    Album Kegiatan
                                </span>
                                <h2 id="modal-title"
                                    class="text-lg font-black text-slate-900 uppercase tracking-tight leading-tight mt-1">
                                </h2>
                            </div>
                            {{-- Button Close Melayang --}}
                            <button onclick="tutupModalGaleri()"
                                class="w-8 h-8 rounded-xl bg-white hover:bg-red-500 border border-slate-200 text-slate-400 hover:text-white flex items-center justify-center text-lg font-bold transition-all shadow-3xs active:scale-95 cursor-pointer">
                                &times;
                            </button>
                        </div>

                        {{-- Box Deskripsi --}}
                        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-3xs">
                            <p id="modal-desc"
                                class="text-xs text-slate-500 font-semibold leading-relaxed max-h-36 overflow-y-auto pr-1 scrollbar-thin">
                            </p>
                        </div>
                    </div>

                    {{-- Grid Thumbnails Bawah --}}
                    <div class="mt-8 pt-4 border-t border-slate-200/80 space-y-3">
                        <div class="flex justify-between items-center px-0.5">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Daftar Koleksi Foto
                            </p>
                            <span id="modal-counter-badge"
                                class="text-[10px] font-black text-blue-600 bg-white px-2 py-0.5 rounded-md border border-slate-200 shadow-3xs"></span>
                        </div>
                        <div id="modal-thumb-container"
                            class="grid grid-cols-4 gap-2.5 max-h-36 overflow-y-auto p-0.5 scrollbar-thin"></div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- ==================================================================
     4. UPGRADED INTERACTIVE CAROUSEL MOTOR ENGINE
     ================================================================== --}}
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
                thumb.className =
                    `aspect-square bg-white border rounded-xl overflow-hidden cursor-pointer shadow-3xs transition-all duration-300 hover:scale-105 ${index === 0 ? 'border-blue-600 ring-4 ring-blue-600/10 scale-102' : 'border-slate-200'}`;
                thumb.id = `thumb-item-${index}`;
                thumb.onclick = () => gantiFotoAktif(index);
                thumb.innerHTML =
                    `<img src="/storage/${foto.path_foto}" class="w-full h-full object-cover select-none">`;
                thumbContainer.appendChild(thumb);
            });

            gantiFotoAktif(0);

            let modal = document.getElementById('modal-galeri');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function gantiFotoAktif(index) {
            let oldThumb = document.getElementById(`thumb-item-${indexAktif}`);
            if (oldThumb) {
                oldThumb.className =
                    "aspect-square bg-white border border-slate-200 rounded-xl overflow-hidden cursor-pointer shadow-3xs transition-all duration-300 hover:scale-105";
            }

            indexAktif = index;

            let newThumb = document.getElementById(`thumb-item-${indexAktif}`);
            if (newThumb) {
                newThumb.className =
                    "aspect-square bg-white border border-blue-600 rounded-xl overflow-hidden cursor-pointer shadow-3xs transition-all duration-300 scale-105 ring-4 ring-blue-600/10";
                newThumb.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'start'
                });
            }

            let dataFoto = koleksiFotoAktif[indexAktif];
            document.getElementById('modal-img-active').src = `/storage/${dataFoto.path_foto}`;
            document.getElementById('modal-img-caption').innerText = dataFoto.keterangan_foto ? dataFoto.keterangan_foto :
                'Dokumentasi Kegiatan';
            document.getElementById('modal-counter-badge').innerText = `${indexAktif + 1} / ${koleksiFotoAktif.length}`;
        }

        function sliderNavigasi(arah) {
            let indexBaru = indexAktif + arah;
            if (indexBaru >= 0 && indexBaru < koleksiFotoAktif.length) {
                gantiFotoAktif(indexBaru);
            } else if (indexBaru < 0) {
                gantiFotoAktif(koleksiFotoAktif.length - 1);
            } else if (indexBaru >= koleksiFotoAktif.length) {
                gantiFotoAktif(0);
            }
        }

        function tutupModalGaleri() {
            document.getElementById('modal-galeri').classList.add('hidden');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', function(e) {
            let modal = document.getElementById('modal-galeri');
            if (modal && !modal.classList.contains('hidden')) {
                if (e.key === 'ArrowLeft') sliderNavigasi(-1);
                if (e.key === 'ArrowRight') sliderNavigasi(1);
                if (e.key === 'Escape') tutupModalGaleri();
            }
        });
    </script>
@endsection
