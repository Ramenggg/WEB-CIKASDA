@extends('layouts.app') {{-- Menyesuaikan dengan master layout utama user kamu --}}

@section('title', 'Booklet & Brosur Digital')

@section('content')
    <div class="bg-slate-50 min-h-screen pb-16 font-sans">

        {{-- ==================================================================
         1. HERO SECTION DINAMIS (SINKRON DENGAN PROFIL LAIN)
         ================================================================== --}}
        <x-profil-hero title="Booklet Digital" 
            description="Arsip publikasi booklet informasi, brosur layanan masyarakat, dan dokumen teknis infrastruktur Dinas CIKASDA Provinsi Sulawesi Tengah." />

        {{-- ==================================================================
         2. KONTEN UTAMA
         ================================================================== --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 md:-mt-32 relative z-20 space-y-12">

            {{-- --- BAGIAN 1: SUNGAI PANTAI DANAU DAN AIR BAKU (GRID LAYOUT) --- --}}
            <div class="bg-white rounded-4xl p-8 md:p-12 shadow-[0_15px_50px_rgba(15,23,42,0.04)] border border-slate-200/60">
                <div class="text-center mb-12 relative pb-4">
                    <h2 class="text-xl md:text-2xl font-black text-slate-800 uppercase tracking-tight inline-block relative pb-4">
                        Sungai Pantai Danau dan Air Baku
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1.5 bg-blue-600 rounded-full"></span>
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1.5 bg-slate-100 rounded-full -z-10"></span>
                    </h2>
                </div>

                @php
                    $staticSlides = [
                        [
                            'title' => 'Pengelolaan dan Konservasi Danau Sulawesi Tengah',
                            'image' => asset('images/bookletslider/Bslide1.png'),
                            'tag' => 'DANAU'
                        ],
                        [
                            'title' => 'Perlindungan Pesisir & Pembangunan Pengaman Pantai',
                            'image' => asset('images/bookletslider/Bslide2.png'),
                            'tag' => 'PANTAI'
                        ],
                        [
                            'title' => 'Penyediaan Sarana Air Baku Strategis dan Mandiri',
                            'image' => asset('images/bookletslider/Bslide3.png'),
                            'tag' => 'AIR BAKU'
                        ],
                        [
                            'title' => 'Pengelolaan Aliran Wilayah Sungai dan Mitigasi Banjir',
                            'image' => asset('images/bookletslider/Bslide4.png'),
                            'tag' => 'SUNGAI'
                        ],
                    ];
                @endphp

                <div x-data="{ 
                        activeSlide: 0, 
                        slidesCount: {{ count($staticSlides) }},
                        next() {
                            this.activeSlide = (this.activeSlide + 1) % this.slidesCount;
                        },
                        prev() {
                            this.activeSlide = (this.activeSlide - 1 + this.slidesCount) % this.slidesCount;
                        }
                     }" 
                     x-init="setInterval(() => next(), 5000)"
                     class="relative w-full max-w-4xl mx-auto aspect-[2/1] overflow-hidden rounded-[2rem] border border-slate-200/60 shadow-lg bg-slate-50 group">
                    
                    <!-- Slides -->
                    <div class="relative w-full h-full">
                        @foreach($staticSlides as $index => $slide)
                            <div x-show="activeSlide === {{ $index }}" 
                                 x-transition:enter="transition ease-out duration-700"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 x-transition:leave="transition ease-in duration-500"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 class="absolute inset-0 w-full h-full flex items-center justify-center">
                                 
                                 <img src="{{ $slide['image'] }}" alt="Slide" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation Arrows -->
                    <div class="absolute inset-0 flex items-center justify-between p-4 pointer-events-none">
                        <button @click="prev()" class="pointer-events-auto bg-black/30 hover:bg-black/50 text-white p-3 rounded-full transition-all duration-300 opacity-0 group-hover:opacity-100 cursor-pointer shadow-md hover:scale-110">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button @click="next()" class="pointer-events-auto bg-black/30 hover:bg-black/50 text-white p-3 rounded-full transition-all duration-300 opacity-0 group-hover:opacity-100 cursor-pointer shadow-md hover:scale-110">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    <!-- Navigation Dots -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center space-x-2.5 z-20 bg-slate-900/40 backdrop-blur-xs px-3.5 py-2 rounded-full shadow-sm">
                        <template x-for="(slide, index) in slidesCount" :key="index">
                            <button @click="activeSlide = index" 
                                    :class="activeSlide === index ? 'bg-blue-500 w-5' : 'bg-white/60 hover:bg-white w-2'"
                                    class="h-2 rounded-full transition-all duration-300 cursor-pointer"></button>
                        </template>
                    </div>
                </div>
            </div>


            {{-- --- BAGIAN 2: IRIGASI DAN RAWA (DENGAN FILTER) --- --}}
            <div class="bg-white rounded-4xl p-8 md:p-12 shadow-[0_15px_50px_rgba(15,23,42,0.04)] border border-slate-200/60">
                <div class="flex flex-col items-center mb-12 space-y-8">
                    <div class="text-center relative">
                        <h2 class="text-xl md:text-2xl font-black text-slate-800 uppercase tracking-tight inline-block relative pb-4">
                            Irigasi dan Rawa
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1.5 bg-emerald-500 rounded-full"></span>
                            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1.5 bg-slate-100 rounded-full -z-10"></span>
                        </h2>
                    </div>
                    
                    {{-- Search Bar khusus Irigasi --}}
                    <div class="relative w-full md:w-96">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" id="irigasiSearch" placeholder="Cari Daerah Irigasi..."
                            class="block w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-2xl leading-5 bg-slate-50 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 sm:text-sm transition-all shadow-sm">
                    </div>
                </div>

                {{-- Filter Kategori / Daerah (Disesuaikan dengan Gambar) --}}
                <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-4 mb-12 px-4">
                    <button class="irigasi-filter-btn active text-sm font-bold transition-all text-blue-400 border-b-2 border-blue-400 pb-1" data-kategori="semua">Semua</button>
                    @foreach ($kategoriIrigasi as $kat)
                        <button class="irigasi-filter-btn text-sm font-bold transition-all text-slate-500 hover:text-slate-800 border-b-2 border-transparent hover:border-slate-300 pb-1" 
                                data-kategori="{{ strtolower($kat) }}">{{ $kat }}</button>
                    @endforeach
                </div>

                {{-- Grid Card Irigasi --}}
                <div id="irigasiGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($bookletsIrigasi as $booklet)
                        <div class="irigasi-card booklet-card-wrapper bg-white rounded-3xl overflow-hidden border border-slate-200/60 shadow-[0_4px_20px_rgba(15,23,42,0.03)] hover:shadow-[0_12px_30px_rgba(15,23,42,0.07)] group hover:-translate-y-1 transition-all duration-300 cursor-pointer flex flex-col justify-between"
                             data-title="{{ strtolower($booklet->judul_booklet) }}" 
                             data-kategori="{{ strtolower($booklet->kategori ?: 'umum') }}"
                             data-sampul="{{ $booklet->url_sampul ?: ($booklet->file_pdf && preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $booklet->file_pdf) ? $booklet->url_booklet : '') }}"
                             onclick="bukaModalBooklet(this.dataset.sampul)">

                             <div class="aspect-video w-full bg-slate-100 relative overflow-hidden">
                                 @if($booklet->path_sampul)
                                     <img src="{{ $booklet->url_sampul }}" alt="Cover {{ $booklet->judul_booklet }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                 @elseif($booklet->file_pdf && preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $booklet->file_pdf))
                                     <img src="{{ $booklet->url_booklet }}" alt="Cover {{ $booklet->judul_booklet }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                 @else
                                     <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200">
                                         <span class="text-4xl mb-2">📕</span>
                                     </div>
                                 @endif

                                 <div class="absolute bottom-4 right-4 bg-slate-900/80 backdrop-blur-md px-3 py-1 rounded-xl border border-white/10 text-white text-[10px] font-black tracking-wider flex items-center gap-1.5 shadow-xs">
                                     <svg class="w-3 h-3 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 002.25 1.5zm10.5-11.25h.008v.008h-.008V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                     </svg>
                                     1 DOKUMENTASI
                                 </div>
                             </div>

                             <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-white relative z-10">
                                 <div class="space-y-2">
                                     <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest block">
                                         TERBIT: {{ $booklet->created_at->format('d M Y') }}
                                     </span>
                                     <h3 class="text-base font-black text-slate-800 uppercase tracking-tight leading-snug break-words line-clamp-2 group-hover:text-blue-600 transition-colors">
                                         {{ $booklet->judul_booklet }}
                                     </h3>
                                     
                                     <div class="inline-block">
                                         <span class="px-2.5 py-1 rounded-md bg-blue-50 text-blue-600 border border-blue-100 text-[9px] font-black uppercase tracking-widest inline-flex items-center gap-1 shadow-sm">
                                             <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                             </svg>
                                             {{ $booklet->kategori ?: 'Umum' }}
                                         </span>
                                     </div>
                                     <p class="text-xs text-slate-400 font-medium leading-relaxed line-clamp-2">
                                         {{ $booklet->deskripsi_booklet ?? 'Tidak ada rincian ringkasan deskripsi tambahan mengenai dokumen booklet digital ini.' }}
                                     </p>
                                 </div>

                                 @if ($booklet->file_pdf)
                                     <a href="{{ $booklet->url_booklet }}" target="_blank" onclick="event.stopPropagation()" class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-black text-blue-600 uppercase tracking-wider group-hover:text-blue-700 transition-colors">
                                         <span>BUKA DOKUMENTASI VISUAL</span>
                                         <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                                     </a>
                                 @elseif ($booklet->url_external)
                                     <a href="{{ $booklet->url_external }}" target="_blank" onclick="event.stopPropagation()" class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-black text-blue-600 uppercase tracking-wider group-hover:text-blue-700 transition-colors">
                                         <span>BUKA DOKUMENTASI VISUAL</span>
                                         <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                                     </a>
                                 @else
                                     <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-black text-slate-400 uppercase tracking-wider">
                                         <span>DOKUMEN TIDAK TERSEDIA</span>
                                     </div>
                                 @endif
                             </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center space-y-4 max-w-md mx-auto">
                            <div class="w-14 h-14 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center justify-center mx-auto text-emerald-500 shadow-3xs">
                                <svg class="w-7 h-7 stroke-[1.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                            </div>
                            <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest">Belum Ada Dokumen Terbit</h3>
                            <p class="text-xs text-slate-400 font-medium leading-relaxed">Arsip berkas di kelompok ini belum tersedia atau sedang diperbarui oleh administrator.</p>
                        </div>
                    @endforelse
                </div>

                {{-- No Result State Irigasi --}}
                <div id="irigasiNoResult" class="hidden py-20 text-center w-full">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">Tidak ditemukan dokumen yang sesuai dengan filter/pencarian Anda.</p>
                </div>
            </div>

        </div>
    </div>

    {{-- Modal Booklet --}}
    <div id="modal-booklet"
        class="fixed inset-0 z-[9999] invisible opacity-0 transition-all duration-300 ease-out bg-slate-950/60 backdrop-blur-md flex items-center justify-center p-4">
        <div class="absolute inset-0 cursor-pointer" onclick="tutupModalBooklet()"></div>

        <div id="modal-booklet-content"
            class="relative max-w-4xl max-h-[85vh] z-10 transform scale-95 opacity-0 transition-all duration-300 ease-out delay-75 flex items-center justify-center">

            <button onclick="tutupModalBooklet()"
                class="absolute -top-12 right-0 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center text-2xl font-bold transition-all backdrop-blur-md border border-white/10 cursor-pointer z-50">
                &times;
            </button>

            <img id="modal-booklet-img" src="" alt="Cover Booklet" loading="lazy"
                class="max-w-full max-h-[85vh] object-contain rounded-2xl select-none shadow-[0_25px_60px_rgba(0,0,0,0.5)] border border-white/10">
        </div>
    </div>

    {{-- Script Filter Irigasi & Modal --}}
    <script>
        const irigasiSearch = document.getElementById('irigasiSearch');
        const filterBtns = document.querySelectorAll('.irigasi-filter-btn');
        let activeIrigasiKategori = 'semua';

        function performIrigasiFilter() {
            const keyword = irigasiSearch ? irigasiSearch.value.toLowerCase() : '';
            const cards = document.querySelectorAll('.irigasi-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const title = card.getAttribute('data-title') || '';
                const kategori = card.getAttribute('data-kategori') || '';

                const matchesKeyword = title.includes(keyword);
                const matchesCategory = activeIrigasiKategori === 'semua' || kategori === activeIrigasiKategori;

                if (matchesKeyword && matchesCategory) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const noResult = document.getElementById('irigasiNoResult');
            if (visibleCount === 0) {
                noResult.classList.remove('hidden');
            } else {
                noResult.classList.add('hidden');
            }
        }

        if (irigasiSearch) {
            irigasiSearch.addEventListener('input', performIrigasiFilter);
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => {
                    b.classList.remove('active', 'text-blue-400', 'border-blue-400');
                    b.classList.add('text-slate-500', 'border-transparent');
                });

                this.classList.add('active', 'text-blue-400', 'border-blue-400');
                this.classList.remove('text-slate-500', 'border-transparent');

                activeIrigasiKategori = this.getAttribute('data-kategori');
                performIrigasiFilter();
            });
        });

        // Booklet Modal Logic
        function bukaModalBooklet(sampulUrl) {
            const imgEl = document.getElementById('modal-booklet-img');
            if (sampulUrl) {
                imgEl.src = sampulUrl;
                imgEl.style.display = 'block';
            } else {
                imgEl.src = '{{ asset('images/logo/logo-cikasda.png') }}';
                imgEl.style.display = 'block';
            }

            let modal = document.getElementById('modal-booklet');
            let modalContent = document.getElementById('modal-booklet-content');

            modal.classList.remove('invisible', 'opacity-0');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');

            document.body.style.overflow = 'hidden';
        }

        function tutupModalBooklet() {
            let modal = document.getElementById('modal-booklet');
            let modalContent = document.getElementById('modal-booklet-content');

            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('invisible');
                document.body.style.overflow = '';
            }, 300);
        }

        document.addEventListener('keydown', function(e) {
            let modal = document.getElementById('modal-booklet');
            if (modal && !modal.classList.contains('invisible')) {
                if (e.key === 'Escape') tutupModalBooklet();
            }
        });
    </script>
@endsection
