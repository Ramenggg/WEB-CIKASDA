@extends('layouts.app')

@section('content')
    {{-- HERO HEADER --}}
    <x-profil-hero title="Perjanjian Kerja Sama (MoU)" :item="$item" :showContentInHero="false" 
        description="Dokumentasi naskah resmi Nota Kesepakatan (MoU) dan Perjanjian Kerja Sama (PKS) antara Dinas Cipta Karya dan Sumber Daya Air dengan mitra sektor publik maupun swasta." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 pb-24"
         x-data="mouComponent()">

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
                        placeholder="Cari perjanjian kerja sama atau pihak terlibat..." 
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

            {{-- MOU LIST (TABLE OR RESPONSIVE CARDS) --}}
            <div class="space-y-4 pt-4">
                <template x-for="mou in filteredMous()" :key="mou.id">
                    <div class="bg-white border border-slate-200/60 rounded-2xl p-6 transition-all duration-300 hover:shadow-md hover:border-blue-200 flex flex-col md:flex-row md:items-center justify-between gap-6">
                        
                        {{-- MoU Details --}}
                        <div class="flex items-start space-x-4 max-w-3xl">
                            {{-- Icon --}}
                            <div class="shrink-0 w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shadow-3xs">
                                <svg class="w-6 h-6 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            
                            {{-- Meta & Description --}}
                            <div class="space-y-1.5">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="bg-blue-600 text-white text-[9px] font-black px-2 py-0.5 rounded uppercase tracking-wider" x-text="mou.tahun"></span>
                                    <span class="text-[10px] text-slate-400 font-bold" x-show="mou.nomor" x-text="'No: ' + mou.nomor"></span>
                                </div>
                                <h4 class="text-sm md:text-base font-black text-slate-800 leading-snug" x-text="mou.judul"></h4>
                                <div class="text-xs text-slate-500 font-bold flex flex-wrap gap-x-1 items-center">
                                    <span>Pihak Terlibat:</span>
                                    <span class="text-blue-600 font-black" x-text="mou.pihak"></span>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="shrink-0">
                            <a :href="mou.link" target="_blank"
                               class="w-full md:w-auto inline-flex items-center justify-center space-x-1.5 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-3xs transition-all duration-200 cursor-pointer">
                                <span>Unduh MoU</span>
                                <span>➔</span>
                            </a>
                        </div>
                    </div>
                </template>

                {{-- Empty State --}}
                <div x-show="filteredMous().length === 0" class="py-16 text-center space-y-4 max-w-lg mx-auto">
                    <span class="text-5xl block">🔍</span>
                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">MoU Tidak Ditemukan</h4>
                    <p class="text-slate-400 text-[11px] font-bold max-w-sm mx-auto leading-relaxed">Kami tidak dapat menemukan perjanjian kerja sama dengan kata kunci tersebut. Coba cari dengan kata kunci lain.</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('mouComponent', () => ({
                searchQuery: '',
                mous: [
                    {
                        id: 1,
                        judul: 'Perjanjian Kerja Sama Penyediaan Sistem Penyediaan Air Minum (SPAM) Lintas Wilayah',
                        pihak: 'Dinas CIKASDA Provinsi Sulteng & Perusahaan Daerah Air Minum (PDAM) Kota Palu',
                        tahun: '2024',
                        nomor: '120/PKS/CIKASDA/2024',
                        link: '{{ $item->primary_document_path ? Storage::url($item->primary_document_path) : "#" }}'
                    },
                    {
                        id: 2,
                        judul: 'Nota Kesepahaman Sinergi Pembangunan Infrastruktur Sanitasi Lingkungan Sehat',
                        pihak: 'Pemerintah Provinsi Sulawesi Tengah & Lembaga Swadaya Masyarakat Sanitasi Lestari',
                        tahun: '2023',
                        nomor: '009/MoU/CIKASDA/VIII/2023',
                        link: '{{ $item->secondary_document_path ? Storage::url($item->secondary_document_path) : "#" }}'
                    }
                ],
                filteredMous() {
                    if (this.searchQuery === '') {
                        return this.mous;
                    }
                    const query = this.searchQuery.toLowerCase();
                    return this.mous.filter(m => 
                        m.judul.toLowerCase().includes(query) || 
                        m.pihak.toLowerCase().includes(query) ||
                        m.tahun.toLowerCase().includes(query) ||
                        (m.nomor && m.nomor.toLowerCase().includes(query))
                    );
                }
            }));
        });
    </script>
@endsection
