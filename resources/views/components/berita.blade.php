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
            </h2>,
        </div>

        <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-slate-100 p-6 md:p-8">

            <div
                class="flex flex-col lg:flex-row lg:items-end justify-between mb-10 border-b border-slate-200/60 pb-6 gap-6">

                <div class="flex items-center group shrink-0 mb-1"> {{-- Tambah mb-10 untuk gap ke bawah --}}
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
                    <form action="/informasi-publik/berita" method="GET" class="relative group flex-1 md:flex-none">
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
                    <a href="/informasi-publik/berita"
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

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <a href="/berita/rapat-koordinasi"
                    class="lg:col-span-7 group relative rounded-2xl overflow-hidden h-100 lg:h-120 shadow-sm block">
                    <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                        alt="Rapat CIKASDA"
                        class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-in-out">

                    <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/40 to-transparent"></div>

                    <div class="absolute top-5 left-5 z-20">
                        <span class="px-3 py-1.5 bg-blue-600 text-white text-xs font-bold rounded-md shadow-md">
                            Berita & Artikel
                        </span>
                    </div>

                    <div class="absolute bottom-0 left-0 p-6 md:p-8 w-full z-20">
                        <h3
                            class="text-2xl md:text-3xl font-bold text-white leading-tight mb-3 group-hover:text-yellow-400 transition-colors line-clamp-2">
                            Sinergitas Infrastruktur: CIKASDA Gelar Rapat Koordinasi Bersama Perwakilan Daerah
                        </h3>
                        <p class="text-slate-200 text-sm md:text-base leading-relaxed line-clamp-2 mb-4">
                            Rapat koordinasi strategis guna memantapkan langkah dan sinergi program pembangunan
                            infrastruktur daerah yang terintegrasi di seluruh kabupaten dan kota Sulawesi Tengah.
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

                <div class="lg:col-span-5 flex flex-col justify-between space-y-6 lg:space-y-0">

                    <a href="/berita/irigasi"
                        class="group flex items-start pb-4 border-b border-slate-100 last:border-0 last:pb-0 transition-all">
                        <div class="shrink-0 w-28 h-24 rounded-xl overflow-hidden relative shadow-sm">
                            <img src="https://images.unsplash.com/photo-1589939705384-5185137a7f0f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="ml-4 grow flex flex-col justify-center">
                            <span
                                class="bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded w-max mb-2 uppercase tracking-tighter">Berita
                                & Artikel</span>
                            <h4
                                class="text-sm md:text-base font-bold text-slate-800 group-hover:text-blue-600 transition-colors leading-snug line-clamp-2 mb-1">
                                Rehabilitasi Jaringan Irigasi D.I. Gumbasa Tahap II Resmi Dimulai
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

                    <a href="/berita/tata-ruang"
                        class="group flex items-start pb-4 border-b border-slate-100 last:border-0 last:pb-0 transition-all">
                        <div class="shrink-0 w-28 h-24 rounded-xl overflow-hidden relative shadow-sm">
                            <img src="https://images.unsplash.com/photo-1541888087545-21d7010f3c05?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="ml-4 grow flex flex-col justify-center">
                            <span
                                class="bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded w-max mb-2 uppercase tracking-tighter">Berita
                                & Artikel</span>
                            <h4
                                class="text-sm md:text-base font-bold text-slate-800 group-hover:text-blue-600 transition-colors leading-snug line-clamp-2 mb-1">
                                Sosialisasi Sistem Informasi Tata Ruang Berbasis Digital untuk Masyarakat
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

                    <a href="/berita/air-bersih"
                        class="group flex items-start pb-4 border-b border-slate-100 last:border-0 last:pb-0 transition-all">
                        <div class="shrink-0 w-28 h-24 rounded-xl overflow-hidden relative shadow-sm">
                            <img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="ml-4 grow flex flex-col justify-center">
                            <span
                                class="bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded w-max mb-2 uppercase tracking-tighter">Berita
                                & Artikel</span>
                            <h4
                                class="text-sm md:text-base font-bold text-slate-800 group-hover:text-blue-600 transition-colors leading-snug line-clamp-2 mb-1">
                                Pembangunan SPAM Regional Pasigala Terus Dikebut Capai Target
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

                    <a href="/berita/normalisasi" class="group flex items-start transition-all">
                        <div class="shrink-0 w-28 h-24 rounded-xl overflow-hidden relative shadow-sm">
                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="ml-4 grow flex flex-col justify-center">
                            <span
                                class="bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded w-max mb-2 uppercase tracking-tighter">Berita
                                & Artikel</span>
                            <h4
                                class="text-sm md:text-base font-bold text-slate-800 group-hover:text-blue-600 transition-colors leading-snug line-clamp-2 mb-1">
                                Percepat Normalisasi Sungai Palu, CIKASDA Terjunkan Alat Berat
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

                </div>
            </div>
        </div>
    </div>
</section>
