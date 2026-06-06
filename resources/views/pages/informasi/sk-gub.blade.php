@extends('layouts.app')

@section('content')
    {{-- HERO HEADER --}}
    <x-profil-hero title="SK GUB Bangunan Gedung 2025" :item="$item" :showContentInHero="false" 
        description="Publikasi Surat Keputusan (SK) Gubernur Sulawesi Tengah terkait penetapan gedung, prasarana, dan bangunan gedung untuk kepentingan strategis Provinsi Sulawesi Tengah Tahun 2025." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 pb-24"
         x-data="skComponent()">

        {{-- MAIN BOX CONTAINER --}}
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 md:p-10 border border-slate-100 space-y-8">
            
            {{-- SEARCH BAR - ULTRA MODERN PILL DESIGN --}}
            <div class="relative max-w-3xl ml-0 mr-auto">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 via-indigo-500/10 to-purple-500/10 rounded-full blur-xl opacity-75 -z-10"></div>
                
                <div class="relative flex items-center bg-slate-50 border border-slate-200 rounded-full p-2.5 pl-8 transition-all duration-300 shadow-[0_12px_35px_rgba(0,0,0,0.03)] focus-within:border-blue-400 focus-within:bg-white focus-within:ring-4 focus-within:ring-blue-100/40">
                    <span class="text-slate-400 mr-4 transition-colors">
                        <svg class="w-5.5 h-5.5 stroke-[2.2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>

                    <input type="text" x-model="searchQuery" 
                        placeholder="Cari keputusan gubernur, gedung, atau nomor SK..." 
                        class="w-full bg-transparent outline-none font-bold text-slate-800 placeholder:font-semibold placeholder:text-slate-400 text-sm md:text-base py-2.5">
                    
                    <div class="flex items-center space-x-2 pr-2">
                        <button x-show="searchQuery" @click="searchQuery = ''" x-transition.opacity
                            class="p-2 hover:bg-rose-50 text-slate-400 hover:text-rose-600 rounded-full transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- SK LIST --}}
            <div class="space-y-4 pt-4">
                <template x-for="sk in filteredSks()" :key="sk.id">
                    <div class="bg-white border border-slate-200/60 rounded-2xl p-6 transition-all duration-300 hover:shadow-md hover:border-red-200 flex flex-col md:flex-row md:items-center justify-between gap-6">
                        
                        {{-- SK Details --}}
                        <div class="flex items-start space-x-4 max-w-3xl">
                            {{-- Icon --}}
                            <div class="shrink-0 w-12 h-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center shadow-3xs">
                                <svg class="w-6 h-6 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            
                            {{-- Description --}}
                            <div class="space-y-1.5">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="bg-red-600 text-white text-[9px] font-black px-2.5 py-0.5 rounded uppercase tracking-wider">SK GUBERNUR</span>
                                    <span class="text-[10px] text-slate-400 font-bold" x-text="'No: ' + sk.nomor_sk"></span>
                                    <span class="text-[10px] text-slate-400 font-bold">•</span>
                                    <span class="text-[10px] text-slate-400 font-bold" x-text="'Ditetapkan: ' + sk.tanggal_penetapan"></span>
                                </div>
                                <h4 class="text-sm md:text-base font-black text-slate-800 leading-snug" x-text="sk.judul"></h4>
                                <div class="text-xs text-slate-500 font-bold flex flex-wrap gap-x-1 items-center">
                                    <span>Lokasi / Gedung:</span>
                                    <span class="text-red-600 font-black" x-text="sk.nama_gedung_lokasi"></span>
                                </div>
                            </div>
                        </div>

                        {{-- Action Button --}}
                        <div class="shrink-0">
                            <a :href="sk.link" target="_blank"
                               class="w-full md:w-auto inline-flex items-center justify-center space-x-1.5 px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-3xs transition-all duration-200 cursor-pointer">
                                <span>Unduh SK PDF</span>
                                <span>➔</span>
                            </a>
                        </div>
                    </div>
                </template>

                {{-- Empty State --}}
                <div x-show="filteredSks().length === 0" class="py-16 text-center space-y-4 max-w-lg mx-auto">
                    <span class="text-5xl block">🔍</span>
                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">SK Tidak Ditemukan</h4>
                    <p class="text-slate-400 text-[11px] font-bold max-w-sm mx-auto leading-relaxed">Kami tidak dapat menemukan Surat Keputusan Gubernur dengan kata kunci tersebut. Coba cari dengan kata kunci lain.</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('skComponent', () => ({
                searchQuery: '',
                sks: [
                    {
                        id: 1,
                        nomor_sk: '188.44/05/CIKASDA-G.ST/2025',
                        judul: 'SK Gubernur Penetapan Gedung Kantor Wilayah Strategis Kepentingan Provinsi Sulawesi Tengah',
                        tanggal_penetapan: '15 Januari 2025',
                        nama_gedung_lokasi: 'Gedung Kantor Gubernur & Kompleks Perkantoran Provinsi',
                        link: '{{ $item->primary_document_path ? Storage::url($item->primary_document_path) : "#" }}'
                    }
                ],
                filteredSks() {
                    if (this.searchQuery === '') {
                        return this.sks;
                    }
                    const query = this.searchQuery.toLowerCase();
                    return this.sks.filter(s => 
                        s.judul.toLowerCase().includes(query) || 
                        s.nomor_sk.toLowerCase().includes(query) ||
                        s.nama_gedung_lokasi.toLowerCase().includes(query) ||
                        s.tanggal_penetapan.toLowerCase().includes(query)
                    );
                }
            }));
        });
    </script>
@endsection
