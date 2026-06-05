@extends('layouts.app')

@section('content')
    {{-- HERO HEADER --}}
    <x-profil-hero title="Daftar Informasi" :showContentInHero="false" 
        description="Indeks klasifikasi Informasi Publik Dinas Cipta Karya dan Sumber Daya Air Provinsi Sulawesi Tengah berdasarkan ketentuan UU No. 14 Tahun 2008." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 pb-24"
         x-data="{ 
             activeTab: 'berkala',
             searchQuery: '',
             isFocused: false,
             items: [
                 // 1. BERKALA
                 { id: 1, title: 'Laporan Keuangan DPA-SKPD & Neraca', category: 'berkala', icon: '📄', detail: 'Informasi keuangan dan pertanggungjawaban dinas berkala.', link: '/profil/keuangan', type: 'internal' },
                 { id: 2, title: 'Rencana Strategis (Renstra) & Rencana Kerja', category: 'berkala', icon: '📋', detail: 'Dokumen perencanaan jangka panjang dan program kerja operasional tahunan.', link: '/profil/visi-misi', type: 'internal' },
                 { id: 3, title: 'Laporan Harta Kekayaan ASN (LHKPN / LHKASN)', category: 'berkala', icon: '💼', detail: 'Transparansi pelaporan kekayaan pejabat publik di lingkungan dinas.', link: '/profil/lhkpn', type: 'internal' },
                 { id: 4, title: 'Struktur Organisasi & Profil Pejabat', category: 'berkala', icon: '👥', detail: 'Daftar pejabat struktural beserta tugas pokok dan fungsi jabatan.', link: '/profil/struktur-organisasi', type: 'internal' },
                 
                 // 2. SERTA MERTA
                 { id: 5, title: 'Informasi Daya Rusak Air Terhadap Fasilitas Irigasi (IRWA) - 2022', category: 'sertamerta', icon: '🌊', detail: 'Laporan kedaruratan kerusakan fasilitas irigasi dampak daya rusak air.', link: '#', type: 'external' },
                 { id: 6, title: 'Informasi Daya Rusak Air Terhadap Fasilitas Irigasi (IRWA) - 2023', category: 'sertamerta', icon: '🌊', detail: 'Data penanggulangan darurat kerusakan sistem irigasi di wilayah sungai.', link: '#', type: 'external' },
                 { id: 7, title: 'Informasi Daya Rusak Air Terhadap Fasilitas Sungai dan Pantai (SPDAB) - 2022', category: 'sertamerta', icon: '🏖️', detail: 'Monitoring kerusakan pantai, tanggul jebol, dan fasilitas pengaman sungai.', link: '#', type: 'external' },
                 { id: 8, title: 'Informasi Daya Rusak Air Terhadap Fasilitas Sungai dan Pantai (SPDAB) - 2023', category: 'sertamerta', icon: '🏖️', detail: 'Laporan kejadian bencana banjir dan abrasi pantai yang merusak infrastruktur.', link: '#', type: 'external' },
                 { id: 9, title: 'Informasi Kerusakan Infrastruktur Akibat Bencana (PLBG) - 2022', category: 'sertamerta', icon: '🏢', detail: 'Kerusakan gedung pemerintahan dan fasilitas umum pasca bencana alam.', link: '#', type: 'external' },
                 { id: 10, title: 'Informasi Kerusakan Infrastruktur Akibat Bencana (PLBG) - 2023', category: 'sertamerta', icon: '🏢', detail: 'Laporan teknis rehabilitasi gedung dan lingkungan akibat dampak bencana.', link: '#', type: 'external' },
                 { id: 11, title: 'Informasi Kerusakan Infrastruktur Akibat Bencana (AMPLP) - 2022', category: 'sertamerta', icon: '🚰', detail: 'Dampak kerusakan sarana air minum dan penyehatan lingkungan pemukiman.', link: '#', type: 'external' },
                 { id: 12, title: 'Informasi Kerusakan Infrastruktur Akibat Bencana (AMPLP) - 2023', category: 'sertamerta', icon: '🚰', detail: 'Data tanggap darurat dan rekonstruksi sarana penyediaan air bersih.', link: '#', type: 'external' },

                 // 3. SETIAP SAAT
                 { id: 13, title: 'Standar Pelayanan Layanan Informasi Publik (PPIDP) - 2022', category: 'setiapsaat', icon: '⚙️', detail: 'SOP resmi pelayanan permohonan informasi publik PPID Pembantu.', link: '#', type: 'external' },
                 { id: 14, title: 'Standar Pelayanan Layanan Informasi Publik (PPIDP) - 2023', category: 'setiapsaat', icon: '⚙️', detail: 'Pembaruan maklumat pelayanan dan standar operasional informasi.', link: '#', type: 'external' },
                 { id: 15, title: 'Surat Keputusan (SK) Kepala Dinas', category: 'setiapsaat', icon: '📜', detail: 'Kumpulan regulasi keputusan dinas dalam hal keorganisasian dan teknis.', link: '#', type: 'internal' },
                 { id: 16, title: 'SOP dan SPM PPID Dinas Cikasda', category: 'setiapsaat', icon: '📋', detail: 'Standard Operating Procedure dan Standar Pelayanan Minimal informasi publik.', link: '/ppid/sop-spm', type: 'internal' },

                 // 4. DIKECUALIKAN
                 { id: 17, title: 'Dokumen Kepegawaian (Arsip Fisik Individu ASN)', category: 'dikecualikan', icon: '🔒', detail: 'Kategori rahasia jabatan karena menyangkut data riwayat pribadi pegawai.', status: 'Ketat/Terbatas', dasar_hukum: 'Pasal 17 Huruf g UU KIP' },
                 { id: 18, title: 'Daftar Usulan Mutasi Jabatan ASN', category: 'dikecualikan', icon: '🔒', detail: 'Proses perencanaan penempatan jabatan staf yang belum bersifat final.', status: 'Ketat/Terbatas', dasar_hukum: 'Pasal 17 Huruf h UU KIP' },
                 { id: 19, title: 'Laporan Pengusulan Cerai ASN', category: 'dikecualikan', icon: '🔒', detail: 'Data privasi keluarga pegawai yang dilindungi undang-undang hak sipil.', status: 'Ketat/Terbatas', dasar_hukum: 'Pasal 17 Huruf g UU KIP' },
                 { id: 20, title: 'Disposisi Surat Pimpinan & Nota Dinas Internal', category: 'dikecualikan', icon: '🔒', detail: 'Naskah dinas intern yang masih berupa draf kebijakan tertutup.', status: 'Ketat/Terbatas', dasar_hukum: 'Pasal 17 Huruf a UU KIP' },
                 { id: 21, title: 'Dokumen SPJ (Surat Pertanggungjawaban)', category: 'dikecualikan', icon: '🔒', detail: 'Kwitansi, invoice belanja daerah yang memuat rincian data pihak ketiga.', status: 'Ketat/Terbatas', dasar_hukum: 'Pasal 17 Huruf j UU KIP' },
                 { id: 22, title: 'Surat Penawaran Harga Pemenang Lelang', category: 'dikecualikan', icon: '🔒', detail: 'Dokumen rahasia persaingan usaha sehat pengadaan barang/jasa.', status: 'Ketat/Terbatas', dasar_hukum: 'Pasal 17 Huruf b UU KIP' },
                 { id: 23, title: 'Data Hidrologi & Curah Hujan/Debit Sungai Mentah', category: 'dikecualikan', icon: '🔒', detail: 'Kumpulan database hidrometri wilayah sungai sebelum melalui verifikasi.', status: 'Ketat/Terbatas', dasar_hukum: 'Peraturan Teknis BMKG/Dinas' }
             ]
         }">

        {{-- SEARCH BAR - ULTRA MODERN & NOT RIGID --}}
        <div class="relative max-w-4xl mx-auto mb-12">
            {{-- Glowing Background Aura --}}
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 via-indigo-500/10 to-purple-500/10 rounded-3xl blur-2xl opacity-75 -z-10 transition-opacity duration-300"
                :class="isFocused ? 'opacity-100 scale-102' : 'opacity-75'"></div>
            
            <div class="relative bg-white/75 backdrop-blur-2xl rounded-3xl p-5 md:p-6 shadow-[0_20px_50px_rgba(15,23,42,0.08)] border transition-all duration-300"
                :class="isFocused ? 'border-blue-400/60 shadow-[0_20px_50px_rgba(59,130,246,0.12)]' : 'border-slate-200/50'">
                
                <div class="relative flex items-center">
                    {{-- Search Icon with Micro-Animation --}}
                    <span class="absolute left-6 transition-all duration-300"
                        :class="isFocused ? 'text-blue-600 scale-110' : 'text-slate-400'">
                        <svg class="w-6 h-6 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>

                    {{-- Search Input --}}
                    <input type="text" x-model="searchQuery" 
                        @focus="isFocused = true" @blur="isFocused = false"
                        placeholder="Ketik untuk mencari dokumen dinas... (Contoh: Irigasi, Keuangan, LHKPN)" 
                        class="w-full pl-16 pr-16 py-4 rounded-2xl border-none outline-none font-bold text-slate-800 placeholder:font-medium placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] transition-all duration-300 text-sm md:text-base">

                    {{-- Hotkey / Clear Button --}}
                    <div class="absolute right-5 flex items-center">
                        <button x-show="searchQuery" @click="searchQuery = ''" x-transition.opacity
                            class="p-2 bg-slate-100 hover:bg-rose-50 text-slate-400 hover:text-rose-600 rounded-xl transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <span x-show="!searchQuery" class="hidden sm:inline-block px-2.5 py-1 bg-slate-100 text-[10px] text-slate-400 font-extrabold uppercase rounded-lg border border-slate-200/60 tracking-wider">Cari</span>
                    </div>
                </div>

                {{-- Modern Tags --}}
                <div class="mt-4 flex flex-wrap items-center gap-2.5 px-1 pt-1">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mr-1">Rekomendasi:</span>
                    <button @click="searchQuery = 'Keuangan'" class="px-3.5 py-1.5 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-xl text-xs font-bold transition border border-slate-200/40 hover:border-blue-100 cursor-pointer">Keuangan 📊</button>
                    <button @click="searchQuery = 'Irigasi'" class="px-3.5 py-1.5 bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-600 rounded-xl text-xs font-bold transition border border-slate-200/40 hover:border-emerald-100 cursor-pointer">Irigasi 🌊</button>
                    <button @click="searchQuery = 'PPIDP'" class="px-3.5 py-1.5 bg-slate-100 hover:bg-indigo-50 text-slate-600 hover:text-indigo-600 rounded-xl text-xs font-bold transition border border-slate-200/40 hover:border-indigo-100 cursor-pointer">Pelayanan ⚙️</button>
                    <button @click="searchQuery = 'Kepegawaian'" class="px-3.5 py-1.5 bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 rounded-xl text-xs font-bold transition border border-slate-200/40 hover:border-rose-100 cursor-pointer">Dikecualikan 🔒</button>
                </div>
            </div>
        </div>

        {{-- GRID LAYOUT: TABS SIDEBAR (LEFT) + LISTING (RIGHT) --}}
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
            
            {{-- TAB BUTTONS PANEL - MORE MODERN & FLEXIBLE --}}
            <div class="lg:col-span-1 bg-white/90 backdrop-blur-md rounded-3xl shadow-[0_15px_35px_rgba(15,23,42,0.03)] border border-slate-100 p-6 space-y-3 relative lg:sticky lg:top-24" x-show="!searchQuery">
                <div class="pb-2.5 mb-2 px-1">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Klasifikasi Menu</h3>
                </div>

                {{-- Tab 1: Berkala --}}
                <button @click="activeTab = 'berkala'" 
                    :class="activeTab === 'berkala' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/20 translate-x-1.5' : 'text-slate-600 hover:bg-slate-50/80 hover:text-slate-900'"
                    class="w-full text-left px-4.5 py-4 rounded-2xl font-black text-[11px] uppercase tracking-wider transition-all duration-300 flex items-center justify-between cursor-pointer group">
                    <span class="flex items-center space-x-3">
                        <span class="text-sm">📅</span>
                        <span>Secara Berkala</span>
                    </span>
                    <span :class="activeTab === 'berkala' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500'" class="px-2.5 py-0.5 rounded-lg text-[9px] font-black">
                        <span x-text="items.filter(i => i.category === 'berkala').length"></span>
                    </span>
                </button>

                {{-- Tab 2: Serta Merta --}}
                <button @click="activeTab = 'sertamerta'"
                    :class="activeTab === 'sertamerta' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-lg shadow-emerald-500/20 translate-x-1.5' : 'text-slate-600 hover:bg-slate-50/80 hover:text-slate-900'"
                    class="w-full text-left px-4.5 py-4 rounded-2xl font-black text-[11px] uppercase tracking-wider transition-all duration-300 flex items-center justify-between cursor-pointer group">
                    <span class="flex items-center space-x-3">
                        <span class="text-sm">🌊</span>
                        <span>Serta Merta</span>
                    </span>
                    <span :class="activeTab === 'sertamerta' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500'" class="px-2.5 py-0.5 rounded-lg text-[9px] font-black">
                        <span x-text="items.filter(i => i.category === 'sertamerta').length"></span>
                    </span>
                </button>

                {{-- Tab 3: Setiap Saat --}}
                <button @click="activeTab = 'setiapsaat'"
                    :class="activeTab === 'setiapsaat' ? 'bg-gradient-to-r from-indigo-600 to-violet-600 text-white shadow-lg shadow-indigo-500/20 translate-x-1.5' : 'text-slate-600 hover:bg-slate-50/80 hover:text-slate-900'"
                    class="w-full text-left px-4.5 py-4 rounded-2xl font-black text-[11px] uppercase tracking-wider transition-all duration-300 flex items-center justify-between cursor-pointer group">
                    <span class="flex items-center space-x-3">
                        <span class="text-sm">⚡</span>
                        <span>Setiap Saat</span>
                    </span>
                    <span :class="activeTab === 'setiapsaat' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500'" class="px-2.5 py-0.5 rounded-lg text-[9px] font-black">
                        <span x-text="items.filter(i => i.category === 'setiapsaat').length"></span>
                    </span>
                </button>

                {{-- Tab 4: Dikecualikan --}}
                <button @click="activeTab = 'dikecualikan'"
                    :class="activeTab === 'dikecualikan' ? 'bg-gradient-to-r from-rose-600 to-red-600 text-white shadow-lg shadow-rose-500/20 translate-x-1.5' : 'text-slate-600 hover:bg-slate-50/80 hover:text-slate-950'"
                    class="w-full text-left px-4.5 py-4 rounded-2xl font-black text-[11px] uppercase tracking-wider transition-all duration-300 flex items-center justify-between cursor-pointer group">
                    <span class="flex items-center space-x-3">
                        <span class="text-sm">🔒</span>
                        <span>Dikecualikan</span>
                    </span>
                    <span :class="activeTab === 'dikecualikan' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500'" class="px-2.5 py-0.5 rounded-lg text-[9px] font-black">
                        <span x-text="items.filter(i => i.category === 'dikecualikan').length"></span>
                    </span>
                </button>
            </div>

            {{-- LISTING PANEL --}}
            <div :class="searchQuery ? 'lg:col-span-4' : 'lg:col-span-3'" class="space-y-6">

                {{-- Header Status --}}
                <div class="flex items-center justify-between bg-white/70 backdrop-blur-md border border-slate-100 p-5 rounded-3xl shadow-[0_10px_30px_rgba(15,23,42,0.01)]">
                    <div>
                        <h2 class="text-xs font-black text-slate-800 uppercase tracking-widest" x-show="!searchQuery">
                            Kategori Klasifikasi: 
                            <span x-show="activeTab === 'berkala'" class="text-blue-600 bg-blue-50 px-3 py-1 rounded-lg ml-2 font-extrabold">📅 Secara Berkala</span>
                            <span x-show="activeTab === 'sertamerta'" class="text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg ml-2 font-extrabold">🌊 Secara Serta Merta</span>
                            <span x-show="activeTab === 'setiapsaat'" class="text-indigo-600 bg-indigo-50 px-3 py-1 rounded-lg ml-2 font-extrabold">⚡ Setiap Saat</span>
                            <span x-show="activeTab === 'dikecualikan'" class="text-rose-600 bg-rose-50 px-3 py-1 rounded-lg ml-2 font-extrabold">🔒 Dikecualikan</span>
                        </h2>
                        <h2 class="text-xs font-black text-slate-800 uppercase tracking-widest" x-show="searchQuery">
                            Menampilkan hasil pencarian untuk: &ldquo;<span class="text-blue-600 font-extrabold" x-text="searchQuery"></span>&rdquo;
                        </h2>
                    </div>
                </div>

                {{-- List Grid - Modern Cards without stiff frames --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <template x-for="item in items" :key="item.id">
                        <div x-show="(searchQuery === '' && item.category === activeTab) || (searchQuery !== '' && item.title.toLowerCase().includes(searchQuery.toLowerCase()))"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="bg-white rounded-3xl p-6 border border-slate-200/40 hover:border-slate-300/65 shadow-xs hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                            
                            {{-- Decorative Category Glow --}}
                            <div class="absolute -right-6 -bottom-6 w-20 h-20 rounded-full opacity-3 group-hover:opacity-10 group-hover:scale-130 transition-all duration-500"
                                :class="{
                                    'bg-blue-600': item.category === 'berkala',
                                    'bg-emerald-600': item.category === 'sertamerta',
                                    'bg-indigo-600': item.category === 'setiapsaat',
                                    'bg-rose-600': item.category === 'dikecualikan'
                                }">
                            </div>

                            <div class="space-y-4 relative z-10">
                                {{-- Card Header Icon & Category Badge --}}
                                <div class="flex items-center justify-between">
                                    <div class="h-11 w-11 rounded-2xl flex items-center justify-center text-lg font-bold shadow-2xs border transition-colors duration-300"
                                        :class="{
                                            'bg-blue-50/60 border-blue-100/60 group-hover:bg-blue-100/80': item.category === 'berkala',
                                            'bg-emerald-50/60 border-emerald-100/60 group-hover:bg-emerald-100/80': item.category === 'sertamerta',
                                            'bg-indigo-50/60 border-indigo-100/60 group-hover:bg-indigo-100/80': item.category === 'setiapsaat',
                                            'bg-rose-50/60 border-rose-100/60 group-hover:bg-rose-100/80': item.category === 'dikecualikan'
                                        }">
                                        <span x-text="item.icon" class="scale-100 group-hover:scale-110 transition-transform"></span>
                                    </div>
                                    
                                    <span class="text-[9px] font-black uppercase tracking-widest px-3 py-1 rounded-lg"
                                        :class="{
                                            'bg-blue-50 text-blue-700': item.category === 'berkala',
                                            'bg-emerald-50 text-emerald-700': item.category === 'sertamerta',
                                            'bg-indigo-50 text-indigo-700': item.category === 'setiapsaat',
                                            'bg-rose-50 text-rose-700': item.category === 'dikecualikan'
                                        }"
                                        x-text="item.category">
                                    </span>
                                </div>

                                {{-- Title & Detail --}}
                                <div class="space-y-1.5">
                                    <h3 class="text-base font-black text-slate-800 tracking-tight leading-snug group-hover:text-blue-600 transition-colors"
                                        x-text="item.title"></h3>
                                    <p class="text-xs text-slate-400 font-bold leading-relaxed" x-text="item.detail"></p>
                                </div>

                                {{-- Meta Info (Untuk Dikecualikan) --}}
                                <template x-if="item.category === 'dikecualikan'">
                                    <div class="bg-rose-50/30 rounded-2xl p-4 border border-rose-100/50 space-y-2">
                                        <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-wider text-rose-900">
                                            <span>Sifat Dokumen:</span>
                                            <span class="px-2 py-0.5 bg-rose-100 text-rose-800 rounded-md" x-text="item.status"></span>
                                        </div>
                                        <div class="text-[10px] text-rose-600 leading-relaxed font-semibold">
                                            Dasar Hukum: <span class="font-normal italic block mt-0.5 text-rose-800" x-text="item.dasar_hukum"></span>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- Footer Aksi / Tombol --}}
                            <div class="mt-6 pt-4 border-t border-slate-100/60 flex items-center justify-between relative z-10">
                                <template x-if="item.category !== 'dikecualikan'">
                                    <a :href="item.link" 
                                        :target="item.type === 'external' ? '_blank' : '_self'"
                                        class="w-full flex items-center justify-between text-xs font-black uppercase tracking-widest px-4.5 py-3 rounded-2xl transition cursor-pointer shadow-2xs hover:shadow-md"
                                        :class="{
                                            'bg-blue-600 text-white hover:bg-blue-700 shadow-blue-500/10': item.category === 'berkala',
                                            'bg-emerald-600 text-white hover:bg-emerald-700 shadow-emerald-500/10': item.category === 'sertamerta',
                                            'bg-indigo-600 text-white hover:bg-indigo-700 shadow-indigo-500/10': item.category === 'setiapsaat'
                                        }">
                                        <span x-text="item.type === 'external' ? 'Buka Dokumen 🔗' : 'Lihat Detail 👁️'"></span>
                                        <span>➔</span>
                                    </a>
                                </template>
                                <template x-if="item.category === 'dikecualikan'">
                                    <div class="w-full bg-slate-50 text-slate-400 border border-slate-200/50 text-center py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center justify-center space-x-1">
                                        <span>🔒 AKSES TERBATAS / DIKECUALIKAN</span>
                                    </div>
                                </template>
                            </div>

                        </div>
                    </template>
                </div>

                {{-- Empty State --}}
                <div x-show="searchQuery !== '' && items.filter(i => i.title.toLowerCase().includes(searchQuery.toLowerCase())).length === 0"
                    class="bg-white/80 backdrop-blur-md rounded-3xl p-16 border border-slate-100 text-center space-y-4 max-w-lg mx-auto shadow-sm">
                    <div class="text-4xl">🔍</div>
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-wider">Pencarian Tidak Ditemukan</h3>
                    <p class="text-slate-400 text-xs font-bold max-w-sm mx-auto leading-relaxed">Kami tidak dapat menemukan hasil pencarian untuk kata kunci tersebut. Coba kata kunci lain atau pilih klasifikasi secara manual.</p>
                </div>

            </div>

        </div>

    </div>
@endsection
