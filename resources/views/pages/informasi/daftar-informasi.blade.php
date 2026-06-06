@extends('layouts.app')

@section('content')
    {{-- HERO HEADER --}}
    <x-profil-hero title="Daftar Informasi" :item="$item" :showContentInHero="false" 
        description="Indeks klasifikasi Informasi Publik Dinas Cipta Karya dan Sumber Daya Air Provinsi Sulawesi Tengah berdasarkan ketentuan UU No. 14 Tahun 2008." />

    {{-- KONTEN UTAMA OVERLAPPING HERO (Di dalam kotak kolom halaman kontainer) --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 pb-24"
         x-data="daftarInformasiComponent()">

        {{-- MAIN WHITE BOX CONTAINER (SEPERTI FOTO LAYOUT ACCORDION DI DALAM KOLOM) --}}
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 md:p-10 lg:p-12 border border-slate-100 space-y-8">
            
            {{-- SEARCH BAR - ULTRA MODERN PILL DESIGN (SCALED UP & ALIGNED LEFT) --}}
            <div class="relative max-w-3xl ml-0 mr-auto">
                {{-- Glow background --}}
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 via-indigo-500/10 to-purple-500/10 rounded-full blur-xl opacity-75 -z-10"></div>
                
                <div class="relative flex items-center bg-slate-50 border border-slate-200 rounded-full p-2.5 pl-8 transition-all duration-300 shadow-[0_12px_35px_rgba(0,0,0,0.03)] focus-within:border-blue-400 focus-within:bg-white focus-within:ring-4 focus-within:ring-blue-100/40">
                    {{-- Search Icon --}}
                    <span class="text-slate-400 mr-4 transition-colors focus-within:text-blue-600">
                        <svg class="w-5.5 h-5.5 stroke-[2.2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>

                    {{-- Search Input --}}
                    <input type="text" x-model="searchQuery" 
                        @focus="isFocused = true" @blur="isFocused = false"
                        placeholder="Cari dokumen atau klasifikasi..." 
                        class="w-full bg-transparent outline-none font-bold text-slate-800 placeholder:font-semibold placeholder:text-slate-400 text-sm md:text-base py-2.5">
                    
                    {{-- Action buttons --}}
                    <div class="flex items-center space-x-2 pr-2">
                        <button x-show="searchQuery" @click="searchQuery = ''" x-transition.opacity
                            class="p-2 hover:bg-rose-50 text-slate-400 hover:text-rose-600 rounded-full transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <button class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-xs md:text-sm uppercase tracking-wider px-8 py-3 rounded-full transition shadow-md shadow-blue-500/10 cursor-pointer">
                            Cari
                        </button>
                    </div>
                </div>
                
                {{-- Quick Tags --}}
                <div class="mt-5 flex flex-wrap items-center justify-start gap-2.5 px-1">
                    <span class="text-[10px] md:text-xs font-black text-slate-400 uppercase tracking-widest mr-1.5">Rekomendasi:</span>
                    <button @click="searchQuery = 'Keuangan'" class="px-5 py-2 bg-slate-100/80 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-full text-xs md:text-sm font-extrabold transition border border-slate-200/40 hover:border-blue-100 cursor-pointer shadow-3xs">Keuangan</button>
                    <button @click="searchQuery = 'Irigasi'" class="px-5 py-2 bg-slate-100/80 hover:bg-emerald-50 text-slate-600 hover:text-emerald-600 rounded-full text-xs md:text-sm font-extrabold transition border border-slate-200/40 hover:border-emerald-100 cursor-pointer shadow-3xs">Irigasi</button>
                    <button @click="searchQuery = 'PPID'" class="px-5 py-2 bg-slate-100/80 hover:bg-indigo-50 text-slate-600 hover:text-indigo-600 rounded-full text-xs md:text-sm font-extrabold transition border border-slate-200/40 hover:border-indigo-100 cursor-pointer shadow-3xs">PPID</button>
                </div>
            </div>

            {{-- GRID LAYOUT: TABS & ACCORDION COLUMNS --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 pt-4">
                
                {{-- LEFT SIDEBAR TABS (3 COLUMNS) - MODERN ACCORDION CLASSIFICATIONS --}}
                <div class="lg:col-span-3 space-y-2.5" x-show="!searchQuery">
                    <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 pl-1">Klasifikasi Utama</span>
                    
                    {{-- Tab 0: Semua --}}
                    <button @click="activeTab = 'semua'; activeAccordion = null;"
                        class="w-full flex items-center space-x-3.5 px-4.5 py-3.5 rounded-2xl text-left transition duration-200 cursor-pointer border-l-4 border-transparent"
                        :class="activeTab === 'semua' ? 'bg-slate-100 border-slate-700 text-slate-800 font-black' : 'text-slate-600 hover:bg-slate-50/60 hover:text-slate-900 font-bold'">
                        <div class="w-8.5 h-8.5 rounded-xl flex items-center justify-center transition shrink-0"
                            :class="activeTab === 'semua' ? 'bg-slate-700 text-white shadow-md shadow-slate-500/10' : 'bg-slate-100 text-slate-500'">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                        </div>
                        <span class="text-xs uppercase tracking-wider">Semua</span>
                    </button>

                    {{-- Tab 1: Secara Berkala --}}
                    <button @click="activeTab = 'berkala'; activeAccordion = null;"
                        class="w-full flex items-center space-x-3.5 px-4.5 py-3.5 rounded-2xl text-left transition duration-200 cursor-pointer border-l-4 border-transparent"
                        :class="activeTab === 'berkala' ? 'bg-blue-50/70 border-blue-600 text-blue-700 font-black' : 'text-slate-600 hover:bg-slate-50/60 hover:text-slate-900 font-bold'">
                        <div class="w-8.5 h-8.5 rounded-xl flex items-center justify-center transition shrink-0"
                            :class="activeTab === 'berkala' ? 'bg-blue-600 text-white shadow-md shadow-blue-500/10' : 'bg-slate-100 text-slate-500'">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-xs uppercase tracking-wider">Daftar Informasi Publik Berkala</span>
                    </button>

                    {{-- Tab 2: Serta Merta --}}
                    <button @click="activeTab = 'sertamerta'; activeAccordion = null;"
                        class="w-full flex items-center space-x-3.5 px-4.5 py-3.5 rounded-2xl text-left transition duration-200 cursor-pointer border-l-4 border-transparent"
                        :class="activeTab === 'sertamerta' ? 'bg-emerald-50/70 border-emerald-600 text-emerald-700 font-black' : 'text-slate-600 hover:bg-slate-50/60 hover:text-slate-900 font-bold'">
                        <div class="w-8.5 h-8.5 rounded-xl flex items-center justify-center transition shrink-0"
                            :class="activeTab === 'sertamerta' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/10' : 'bg-slate-100 text-slate-500'">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <span class="text-xs uppercase tracking-wider">Daftar Informasi Publik Serta Merta</span>
                    </button>

                    {{-- Tab 3: Setiap Saat --}}
                    <button @click="activeTab = 'setiapsaat'; activeAccordion = null;"
                        class="w-full flex items-center space-x-3.5 px-4.5 py-3.5 rounded-2xl text-left transition duration-200 cursor-pointer border-l-4 border-transparent"
                        :class="activeTab === 'setiapsaat' ? 'bg-indigo-50/70 border-indigo-600 text-indigo-700 font-black' : 'text-slate-600 hover:bg-slate-50/60 hover:text-slate-900 font-bold'">
                        <div class="w-8.5 h-8.5 rounded-xl flex items-center justify-center transition shrink-0"
                            :class="activeTab === 'setiapsaat' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/10' : 'bg-slate-100 text-slate-500'">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs uppercase tracking-wider">Daftar Informasi Publik Setiap Saat</span>
                    </button>

                    {{-- Tab 4: Dikecualikan --}}
                    <button @click="activeTab = 'dikecualikan'; activeAccordion = null;"
                        class="w-full flex items-center space-x-3.5 px-4.5 py-3.5 rounded-2xl text-left transition duration-200 cursor-pointer border-l-4 border-transparent"
                        :class="activeTab === 'dikecualikan' ? 'bg-rose-50/70 border-rose-600 text-rose-700 font-black' : 'text-slate-600 hover:bg-slate-50/60 hover:text-slate-900 font-bold'">
                        <div class="w-8.5 h-8.5 rounded-xl flex items-center justify-center transition shrink-0"
                            :class="activeTab === 'dikecualikan' ? 'bg-rose-600 text-white shadow-md shadow-rose-500/10' : 'bg-slate-100 text-slate-500'">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <span class="text-xs uppercase tracking-wider">Daftar Informasi Dikecualikan</span>
                    </button>

                    {{-- DOKUMEN UTAMA DIP (Tahun 2024 & Tahun 2025) --}}
                    <div class="mt-6 pt-6 border-t border-slate-200/60 space-y-4" x-show="activeTab !== 'semua'">
                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Unduh Dokumen DIP</span>
                        
                        {{-- Card Tahun 2024 --}}
                        <div class="group relative bg-white border border-slate-200/60 rounded-2xl p-4 text-center transition-all duration-300 hover:shadow-md hover:-translate-y-0.5"
                             :class="{
                                 'hover:border-blue-500/30': activeTab === 'berkala',
                                 'hover:border-emerald-500/30': activeTab === 'sertamerta',
                                 'hover:border-indigo-500/30': activeTab === 'setiapsaat',
                                 'hover:border-rose-500/30': activeTab === 'dikecualikan'
                             }">
                            <div class="absolute inset-x-0 top-0 h-1 rounded-t-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                 :class="{
                                     'bg-blue-600': activeTab === 'berkala',
                                     'bg-emerald-600': activeTab === 'sertamerta',
                                     'bg-indigo-600': activeTab === 'setiapsaat',
                                     'bg-rose-600': activeTab === 'dikecualikan'
                                 }"></div>

                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 bg-slate-50 text-slate-500 border border-slate-100 rounded-xl flex items-center justify-center mb-3 group-hover:text-white transition-colors duration-300 shadow-3xs"
                                     :class="{
                                         'group-hover:bg-blue-600 group-hover:border-blue-700': activeTab === 'berkala',
                                         'group-hover:bg-emerald-600 group-hover:border-emerald-700': activeTab === 'sertamerta',
                                         'group-hover:bg-indigo-600 group-hover:border-indigo-700': activeTab === 'setiapsaat',
                                         'group-hover:bg-rose-600 group-hover:border-rose-700': activeTab === 'dikecualikan'
                                     }">
                                    <svg class="w-5.5 h-5.5 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xs font-black text-slate-800 mb-0.5">DIP Tahun 2024</h4>
                                <p class="text-[10px] text-slate-400 font-bold mb-3">Daftar Informasi Publik</p>
                                <a href="https://drive.google.com/file/d/1J476Y7Zu8GY8iY1Ba0kif4sYGHicdyF0/view?usp=sharing" target="_blank"
                                   class="w-full inline-flex items-center justify-center px-4 py-2 text-[9px] font-black uppercase tracking-widest text-white rounded-xl shadow-3xs transition-all duration-200 gap-1.5"
                                   :class="{
                                       'bg-blue-600 hover:bg-blue-700 shadow-blue-500/10': activeTab === 'berkala',
                                       'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-500/10': activeTab === 'sertamerta',
                                       'bg-indigo-600 hover:bg-indigo-700 shadow-indigo-500/10': activeTab === 'setiapsaat',
                                       'bg-rose-600 hover:bg-rose-700 shadow-rose-500/10': activeTab === 'dikecualikan'
                                   }">
                                    <span>Unduh</span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        {{-- Card Tahun 2025 --}}
                        <div class="group relative bg-white border border-slate-200/60 rounded-2xl p-4 text-center transition-all duration-300 hover:shadow-md hover:-translate-y-0.5"
                             :class="{
                                 'hover:border-blue-500/30': activeTab === 'berkala',
                                 'hover:border-emerald-500/30': activeTab === 'sertamerta',
                                 'hover:border-indigo-500/30': activeTab === 'setiapsaat',
                                 'hover:border-rose-500/30': activeTab === 'dikecualikan'
                             }">
                            <div class="absolute inset-x-0 top-0 h-1 rounded-t-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                 :class="{
                                     'bg-blue-600': activeTab === 'berkala',
                                     'bg-emerald-600': activeTab === 'sertamerta',
                                     'bg-indigo-600': activeTab === 'setiapsaat',
                                     'bg-rose-600': activeTab === 'dikecualikan'
                                 }"></div>

                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 bg-slate-50 text-slate-500 border border-slate-100 rounded-xl flex items-center justify-center mb-3 group-hover:text-white transition-colors duration-300 shadow-3xs"
                                     :class="{
                                         'group-hover:bg-blue-600 group-hover:border-blue-700': activeTab === 'berkala',
                                         'group-hover:bg-emerald-600 group-hover:border-emerald-700': activeTab === 'sertamerta',
                                         'group-hover:bg-indigo-600 group-hover:border-indigo-700': activeTab === 'setiapsaat',
                                         'group-hover:bg-rose-600 group-hover:border-rose-700': activeTab === 'dikecualikan'
                                     }">
                                    <svg class="w-5.5 h-5.5 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xs font-black text-slate-800 mb-0.5">DIP Tahun 2025</h4>
                                <p class="text-[10px] text-slate-400 font-bold mb-3">Daftar Informasi Publik</p>
                                <a href="https://cikasda.sultengprov.go.id/wp-content/uploads/2025/09/DIP-2025.pdf" target="_blank"
                                   class="w-full inline-flex items-center justify-center px-4 py-2 text-[9px] font-black uppercase tracking-widest text-white rounded-xl shadow-3xs transition-all duration-200 gap-1.5"
                                   :class="{
                                       'bg-blue-600 hover:bg-blue-700 shadow-blue-500/10': activeTab === 'berkala',
                                       'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-500/10': activeTab === 'sertamerta',
                                       'bg-indigo-600 hover:bg-indigo-700 shadow-indigo-500/10': activeTab === 'setiapsaat',
                                       'bg-rose-600 hover:bg-rose-700 shadow-rose-500/10': activeTab === 'dikecualikan'
                                   }">
                                    <span>Unduh</span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT CONTENT AREA (9 COLUMNS OR 12 COLUMNS ON SEARCH) --}}
                <div :class="searchQuery ? 'lg:col-span-12' : 'lg:col-span-9'" class="space-y-4">
                    
                    {{-- Section Title --}}
                    <div class="px-1 py-1 flex justify-between items-center border-b border-slate-100 pb-3">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            <span x-show="!searchQuery">
                                Klasifikasi Aktif: 
                                <span x-show="activeTab === 'semua'" class="text-slate-700">Semua Klasifikasi</span>
                                <span x-show="activeTab === 'berkala'" class="text-blue-600">Secara Berkala</span>
                                <span x-show="activeTab === 'sertamerta'" class="text-emerald-600">Serta Merta</span>
                                <span x-show="activeTab === 'setiapsaat'" class="text-indigo-600">Setiap Saat</span>
                                <span x-show="activeTab === 'dikecualikan'" class="text-rose-600">Dikecualikan</span>
                            </span>
                            <span x-show="searchQuery">Hasil Pencarian Untuk &ldquo;<span x-text="searchQuery"></span>&rdquo;</span>
                        </span>
                    </div>


                    {{-- ACCORDION CONTAINER (MENGIKUTI DESAIN DARI FOTO KLIEN) --}}
                    <div class="space-y-4">
                        <template x-for="group in groups" :key="group.id">
                            <div x-show="groupMatches(group)" 
                                 class="bg-white border border-slate-200/50 rounded-2xl overflow-hidden transition-all duration-300 shadow-2xs hover:shadow-xs">
                                
                                {{-- ACCORDION HEADER (PERSIS DESAIN FOTO: KOTAK NOMOR KIRI + JUDUL TEBAL + CHEVRON KANAN) --}}
                                <button @click="activeAccordion = isExpanded(group) ? null : group.id"
                                    class="w-full flex items-center justify-between p-4.5 text-left bg-white hover:bg-slate-50/50 transition cursor-pointer select-none">
                                    
                                    <div class="flex items-center space-x-4">
                                        {{-- Kotak Nomor Kiri --}}
                                        <div class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-[11px] font-black text-slate-500 shadow-3xs"
                                            :class="{
                                                'bg-blue-50/50 text-blue-600 border-blue-100/30': group.category === 'berkala' && isExpanded(group),
                                                'bg-emerald-50/50 text-emerald-600 border-emerald-100/30': group.category === 'sertamerta' && isExpanded(group),
                                                'bg-indigo-50/50 text-indigo-600 border-indigo-100/30': group.category === 'setiapsaat' && isExpanded(group),
                                                'bg-rose-50/50 text-rose-600 border-rose-100/30': group.category === 'dikecualikan' && isExpanded(group)
                                            }">
                                            <span x-text="group.num"></span>
                                        </div>
                                        
                                        {{-- Judul Tebal --}}
                                        <span class="text-sm md:text-base font-black text-slate-800 tracking-tight leading-snug group-hover:text-blue-600 transition-colors"
                                            :class="isExpanded(group) ? 'text-blue-600' : ''"
                                            x-text="group.title">
                                        </span>
                                    </div>

                                    {{-- Chevron Down/Up --}}
                                    <div class="text-slate-400 p-1">
                                        <svg class="w-5 h-5 transition-transform duration-300"
                                            :class="isExpanded(group) ? 'rotate-180 text-blue-500' : ''"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </button>

                                {{-- ACCORDION CONTENT (SLIDE OUT SUB-DOKUMEN DI DALAM KOLOM) --}}
                                <div x-show="isExpanded(group)" 
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 max-h-0"
                                    x-transition:enter-end="opacity-100 max-h-screen"
                                    class="border-t border-slate-100 bg-slate-50/30">
                                    
                                    <div class="divide-y divide-slate-100">
                                        <template x-for="item in group.items" :key="item.title">
                                            <div class="p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:bg-slate-50/40 transition duration-150">
                                                
                                                {{-- Detail Informasi --}}
                                                <div class="flex items-start space-x-3.5">
                                                    <div class="shrink-0 p-2 bg-slate-50 border border-slate-200/60 rounded-xl shadow-3xs text-slate-500">
                                                        <template x-if="item.type !== 'dikecualikan'">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                            </svg>
                                                        </template>
                                                        <template x-if="item.type === 'dikecualikan'">
                                                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                            </svg>
                                                        </template>
                                                    </div>
                                                    <div class="space-y-1">
                                                        <h5 class="text-xs font-black text-slate-800" x-text="item.title"></h5>
                                                        <p class="text-[11px] text-slate-400 font-bold leading-relaxed" x-text="item.detail"></p>
                                                        
                                                        {{-- Detail Khusus Dikecualikan --}}
                                                        <template x-if="item.type === 'dikecualikan'">
                                                            <div class="mt-2 text-[10px] bg-rose-50/60 border border-rose-100/50 rounded-lg p-2.5 max-w-md space-y-0.5 text-rose-800 font-bold">
                                                                <div>Sifat: <span class="font-black" x-text="item.status"></span></div>
                                                                <div>Dasar Hukum: <span class="font-semibold italic text-rose-700" x-text="item.dasar_hukum"></span></div>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>

                                                {{-- Tombol Aksi / Unduh --}}
                                                <div class="shrink-0 text-right">
                                                    <template x-if="item.type !== 'dikecualikan'">
                                                        <a :href="item.link" :target="item.type === 'external' ? '_blank' : '_self'"
                                                            class="inline-flex items-center space-x-1.5 px-4.5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition cursor-pointer border shadow-3xs text-white"
                                                            :class="{
                                                                'bg-blue-600 hover:bg-blue-700 border-blue-700 hover:border-blue-800 shadow-blue-500/10': group.category === 'berkala',
                                                                'bg-emerald-600 hover:bg-emerald-700 border-emerald-700 hover:border-emerald-800 shadow-emerald-500/10': group.category === 'sertamerta',
                                                                'bg-indigo-600 hover:bg-indigo-700 border-indigo-700 hover:border-indigo-800 shadow-indigo-500/10': group.category === 'setiapsaat'
                                                            }">
                                                            <span x-text="item.type === 'external' ? 'Tautan 🔗' : 'Lihat 👁️'"></span>
                                                            <span>➔</span>
                                                        </a>
                                                    </template>
                                                    <template x-if="item.type === 'dikecualikan'">
                                                        <span class="inline-flex items-center space-x-1.5 px-3 py-2 bg-slate-100 border border-slate-200/60 rounded-xl text-[9px] font-black uppercase text-slate-400 tracking-wider">
                                                            <span>🔒 Terkunci / Rahasia</span>
                                                        </span>
                                                    </template>
                                                </div>

                                            </div>
                                        </template>
                                    </div>

                                </div>

                            </div>
                        </template>

                        {{-- Empty State --}}
                        <div x-show="searchQuery !== '' && groups.filter(g => groupMatches(g)).length === 0"
                            class="bg-white rounded-3xl p-16 border border-slate-100 text-center space-y-4 max-w-lg mx-auto">
                            <span class="text-4xl block">🔍</span>
                            <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">Pencarian Tidak Ditemukan</h4>
                            <p class="text-slate-400 text-[11px] font-bold max-w-sm mx-auto leading-relaxed">Kami tidak dapat menemukan hasil untuk kata kunci tersebut. Coba kata kunci lainnya.</p>
                        </div>
                    </div>

                </div>

            </div>

    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('daftarInformasiComponent', () => ({
                activeTab: (new URLSearchParams(window.location.search)).get('tab') || 'semua',
                searchQuery: '',
                isFocused: false,
                activeAccordion: null,
                groups: @json($informationGroups),
                groupMatches(group) {
                    if (this.searchQuery === '') {
                        return this.activeTab === 'semua' || group.category === this.activeTab;
                    }
                    const query = this.searchQuery.toLowerCase();
                    const matchesTitle = group.title.toLowerCase().includes(query);
                    const matchesItems = group.items.some(i => i.title.toLowerCase().includes(query) || i.detail.toLowerCase().includes(query));
                    return matchesTitle || matchesItems;
                },
                isExpanded(group) {
                    if (this.searchQuery !== '') {
                        return true; 
                    }
                    return this.activeAccordion === group.id;
                }
            }));
        });
    </script>
@endsection
