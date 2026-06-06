@extends('layouts.app')

@section('content')
    {{-- HERO HEADER --}}
    <x-profil-hero title="Dokumen" :item="$item" :showContentInHero="false" 
        description="Repositori unduhan dokumen resmi, produk hukum, dokumen SSH, dan dokumen administratif Dinas Cipta Karya dan Sumber Daya Air Provinsi Sulawesi Tengah." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 pb-24"
         x-data="dokumenComponent()">

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
                        placeholder="Cari dokumen resmi dinas..." 
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

            {{-- DOCUMENT LIST (CARD GRID) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-4">
                <template x-for="doc in filteredDocs()" :key="doc.id">
                    <div class="group relative bg-white border border-slate-200/60 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 flex flex-col justify-between h-full">
                        <div class="absolute inset-x-0 top-0 h-1.5 rounded-t-2xl bg-gradient-to-r from-blue-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <div class="space-y-4">
                            {{-- Icon & Year --}}
                            <div class="flex justify-between items-center">
                                <div class="w-12 h-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center shadow-3xs group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                                    <svg class="w-6 h-6 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <span class="bg-blue-50 border border-blue-100 text-blue-600 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider" x-text="doc.tahun"></span>
                            </div>

                            {{-- Title --}}
                            <div class="space-y-2">
                                <h4 class="text-sm md:text-base font-black text-slate-800 leading-snug group-hover:text-blue-600 transition-colors duration-300" x-text="doc.nama"></h4>
                                <p class="text-xs text-slate-400 font-bold" x-text="doc.keterangan"></p>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                            <a :href="doc.link" target="_blank"
                               class="flex-1 inline-flex items-center justify-center space-x-2 px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-3xs transition-all duration-200 cursor-pointer">
                                <span>Unduh PDF</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </template>

                {{-- Empty State --}}
                <div x-show="filteredDocs().length === 0" class="col-span-full py-16 text-center space-y-4 max-w-lg mx-auto">
                    <span class="text-5xl block">🔍</span>
                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">Dokumen Tidak Ditemukan</h4>
                    <p class="text-slate-400 text-[11px] font-bold max-w-sm mx-auto leading-relaxed">Kami tidak dapat menemukan berkas dokumen dengan kata kunci tersebut. Coba cari dengan kata kunci lain.</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dokumenComponent', () => ({
                searchQuery: '',
                docs: [
                    {
                        id: 1,
                        nama: 'SSH Pemerintahan Provinsi Sulawesi Tengah 2022',
                        tahun: '2022',
                        keterangan: 'Dokumen Standar Satuan Harga Pemerintah Provinsi Sulawesi Tengah Tahun Anggaran 2022.',
                        link: '{{ $item->primary_document_path ? Storage::url($item->primary_document_path) : "https://drive.google.com/file/d/1B9qHqM8Yk5S1y3Y1-h5y_7NqZ4P9W-Kq/view?usp=sharing" }}'
                    },
                    {
                        id: 2,
                        nama: 'SSH SIPD 2021',
                        tahun: '2021',
                        keterangan: 'Arsip Standar Satuan Harga Sistem Informasi Pemerintahan Daerah Tahun 2021.',
                        link: '{{ $item->secondary_document_path ? Storage::url($item->secondary_document_path) : "https://drive.google.com/file/d/1U4Xo9N9kM8g-k5U1y3Y1-h5y_7NqZ4P9W/view?usp=sharing" }}'
                    },
                    {
                        id: 3,
                        nama: 'Standar Pelayanan CIKASDA 2024',
                        tahun: '2024',
                        keterangan: 'Dokumen Resmi Standar Pelayanan Publik Dinas Cipta Karya dan Sumber Daya Air Tahun 2024.',
                        link: '{{ $item->extra_document_path ? Storage::url($item->extra_document_path) : "https://cikasda.sultengprov.go.id/wp-content/uploads/2024/05/Standar-Pelayanan-Cikasda-2024.pdf" }}'
                    }
                ],
                filteredDocs() {
                    if (this.searchQuery === '') {
                        return this.docs;
                    }
                    const query = this.searchQuery.toLowerCase();
                    return this.docs.filter(d => 
                        d.nama.toLowerCase().includes(query) || 
                        d.keterangan.toLowerCase().includes(query) ||
                        d.tahun.toLowerCase().includes(query)
                    );
                }
            }));
        });
    </script>
@endsection
