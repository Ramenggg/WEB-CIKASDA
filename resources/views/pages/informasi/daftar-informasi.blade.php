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

        {{-- SEARCH BAR --}}
        <div class="bg-white/80 backdrop-blur-md rounded-3xl p-6 md:p-8 shadow-xl border border-slate-100 mb-8 max-w-4xl mx-auto">
            <div class="relative flex items-center">
                <span class="absolute left-6 text-slate-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" x-model="searchQuery" placeholder="Cari klasifikasi informasi publik (Contoh: Irigasi, Keuangan, LHKPN)..." 
                    class="w-full pl-15 pr-6 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 outline-none transition font-semibold text-slate-700 placeholder:font-normal placeholder:text-slate-400 bg-white">
            </div>
            <div class="mt-3 flex justify-between items-center px-2">
                <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Metode Pencarian Real-Time</span>
                <span class="text-xs text-blue-600 font-black" x-show="searchQuery" @click="searchQuery = ''" class="cursor-pointer hover:underline">Hapus Pencarian</span>
            </div>
        </div>

        {{-- GRID LAYOUT: TABS SIDEBAR (LEFT) + LISTING (RIGHT) --}}
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
            
            {{-- TAB BUTTONS PANEL --}}
            <div class="lg:col-span-1 bg-white rounded-3xl shadow-lg border border-slate-100 p-5 space-y-2 relative" x-show="!searchQuery">
                <div class="pb-3 border-b border-slate-100 mb-3 px-2">
                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest">Klasifikasi</h3>
                </div>

                {{-- Tab 1: Berkala --}}
                <button @click="activeTab = 'berkala'" 
                    :class="activeTab === 'berkala' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                    class="w-full text-left px-4 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all flex items-center justify-between cursor-pointer">
                    <span>📅 Secara Berkala</span>
                    <span :class="activeTab === 'berkala' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500'" class="px-2 py-0.5 rounded-md text-[10px] font-black">
                        <span x-text="items.filter(i => i.category === 'berkala').length"></span>
                    </span>
                </button>

                {{-- Tab 2: Serta Merta --}}
                <button @click="activeTab = 'sertamerta'"
                    :class="activeTab === 'sertamerta' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/10' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                    class="w-full text-left px-4 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all flex items-center justify-between cursor-pointer">
                    <span>🌊 Serta Merta</span>
                    <span :class="activeTab === 'sertamerta' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500'" class="px-2 py-0.5 rounded-md text-[10px] font-black">
                        <span x-text="items.filter(i => i.category === 'sertamerta').length"></span>
                    </span>
                </button>

                {{-- Tab 3: Setiap Saat --}}
                <button @click="activeTab = 'setiapsaat'"
                    :class="activeTab === 'setiapsaat' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/10' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                    class="w-full text-left px-4 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all flex items-center justify-between cursor-pointer">
                    <span>⚡ Setiap Saat</span>
                    <span :class="activeTab === 'setiapsaat' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500'" class="px-2 py-0.5 rounded-md text-[10px] font-black">
                        <span x-text="items.filter(i => i.category === 'setiapsaat').length"></span>
                    </span>
                </button>

                {{-- Tab 4: Dikecualikan --}}
                <button @click="activeTab = 'dikecualikan'"
                    :class="activeTab === 'dikecualikan' ? 'bg-rose-600 text-white shadow-md shadow-rose-600/10' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950'"
                    class="w-full text-left px-4 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all flex items-center justify-between cursor-pointer">
                    <span>🔒 Dikecualikan</span>
                    <span :class="activeTab === 'dikecualikan' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500'" class="px-2 py-0.5 rounded-md text-[10px] font-black">
                        <span x-text="items.filter(i => i.category === 'dikecualikan').length"></span>
                    </span>
                </button>
            </div>

            {{-- LISTING PANEL --}}
            <div :class="searchQuery ? 'lg:col-span-4' : 'lg:col-span-3'" class="space-y-6">

                {{-- Header Status --}}
                <div class="flex items-center justify-between bg-slate-50 border border-slate-200/60 p-4 rounded-2xl shadow-2xs">
                    <div>
                        <h2 class="text-sm font-black text-slate-800 uppercase tracking-wider" x-show="!searchQuery">
                            Menampilkan Klasifikasi: 
                            <span x-show="activeTab === 'berkala'" class="text-blue-600">📅 Secara Berkala</span>
                            <span x-show="activeTab === 'sertamerta'" class="text-emerald-600">🌊 Secara Serta Merta</span>
                            <span x-show="activeTab === 'setiapsaat'" class="text-indigo-600">⚡ Setiap Saat</span>
                            <span x-show="activeTab === 'dikecualikan'" class="text-rose-600">🔒 Dikecualikan</span>
                        </h2>
                        <h2 class="text-sm font-black text-slate-800 uppercase tracking-wider" x-show="searchQuery">
                            Hasil Pencarian untuk: <span class="text-blue-600" x-text="'&ldquo;' + searchQuery + '&rdquo;'"></span>
                        </h2>
                    </div>
                </div>

                {{-- List Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <template x-for="item in items" :key="item.id">
                        <div x-show="(searchQuery === '' && item.category === activeTab) || (searchQuery !== '' && item.title.toLowerCase().includes(searchQuery.toLowerCase()))"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group relative overflow-hidden">
                            
                            {{-- Decorative Background Glow --}}
                            <div class="absolute -right-8 -bottom-8 w-24 h-24 rounded-full opacity-5 group-hover:scale-125 transition-transform duration-500"
                                :class="{
                                    'bg-blue-600': item.category === 'berkala',
                                    'bg-emerald-600': item.category === 'sertamerta',
                                    'bg-indigo-600': item.category === 'setiapsaat',
                                    'bg-rose-600': item.category === 'dikecualikan'
                                }">
                            </div>

                            <div class="space-y-4">
                                {{-- Card Header Icon & Category Badge --}}
                                <div class="flex items-center justify-between">
                                    <div class="h-10 w-10 rounded-2xl flex items-center justify-center text-lg font-bold shadow-2xs border"
                                        :class="{
                                            'bg-blue-50 border-blue-100': item.category === 'berkala',
                                            'bg-emerald-50 border-emerald-100': item.category === 'sertamerta',
                                            'bg-indigo-50 border-indigo-100': item.category === 'setiapsaat',
                                            'bg-rose-50 border-rose-100': item.category === 'dikecualikan'
                                        }">
                                        <span x-text="item.icon"></span>
                                    </div>
                                    
                                    <span class="text-[9px] font-black uppercase tracking-widest px-2.5 py-1 rounded-full"
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
                                <div class="space-y-1">
                                    <h3 class="text-base font-black text-slate-800 tracking-tight leading-snug group-hover:text-blue-600 transition-colors"
                                        x-text="item.title"></h3>
                                    <p class="text-xs text-slate-400 font-bold leading-relaxed" x-text="item.detail"></p>
                                </div>

                                {{-- Meta Info (Untuk Dikecualikan) --}}
                                <template x-if="item.category === 'dikecualikan'">
                                    <div class="bg-rose-50/50 rounded-xl p-3 border border-rose-100/50 space-y-1.5">
                                        <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-wider text-rose-800">
                                            <span>Sifat Dokumen:</span>
                                            <span x-text="item.status"></span>
                                        </div>
                                        <div class="text-[10px] text-rose-600 leading-relaxed font-semibold">
                                            Dasar Hukum: <span class="font-normal italic" x-text="item.dasar_hukum"></span>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- Footer Aksi / Tombol --}}
                            <div class="mt-6 pt-4 border-t border-slate-50 flex items-center justify-between z-10">
                                <template x-if="item.category !== 'dikecualikan'">
                                    <a :href="item.link" 
                                        :target="item.type === 'external' ? '_blank' : '_self'"
                                        class="w-full flex items-center justify-between text-xs font-black uppercase tracking-widest px-4 py-2.5 rounded-xl transition cursor-pointer"
                                        :class="{
                                            'bg-blue-50 hover:bg-blue-100 text-blue-600': item.category === 'berkala',
                                            'bg-emerald-50 hover:bg-emerald-100 text-emerald-600': item.category === 'sertamerta',
                                            'bg-indigo-50 hover:bg-indigo-100 text-indigo-600': item.category === 'setiapsaat'
                                        }">
                                        <span x-text="item.type === 'external' ? 'Buka Dokumen 🔗' : 'Lihat Detail 👁️'"></span>
                                        <span>➔</span>
                                    </a>
                                </template>
                                <template x-if="item.category === 'dikecualikan'">
                                    <div class="w-full bg-slate-100 text-slate-500 text-center py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center justify-center space-x-1">
                                        <span>🔒 AKSES TERBATAS / DIKECUALIKAN</span>
                                    </div>
                                </template>
                            </div>

                        </div>
                    </template>
                </div>

                {{-- Empty State --}}
                <div x-show="searchQuery !== '' && items.filter(i => i.title.toLowerCase().includes(searchQuery.toLowerCase())).length === 0"
                    class="bg-white rounded-3xl p-12 border border-slate-100 text-center space-y-4">
                    <div class="text-4xl">🔍</div>
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-wider">Pencarian Tidak Ditemukan</h3>
                    <p class="text-slate-400 text-xs font-bold max-w-md mx-auto leading-relaxed">Kami tidak dapat menemukan hasil pencarian untuk kata kunci tersebut. Coba kata kunci lain atau pilih klasifikasi secara manual.</p>
                </div>

            </div>

        </div>

    </div>
@endsection
