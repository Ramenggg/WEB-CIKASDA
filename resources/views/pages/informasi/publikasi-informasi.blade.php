@extends('layouts.app')

@section('content')
    {{-- HERO HEADER --}}
    <x-profil-hero title="Publikasi Informasi" :showContentInHero="false" 
        description="Pusat data publikasi dokumen resmi, laporan keuangan, kepegawaian, perencanaan, serta kinerja layanan PPID Dinas Cipta Karya dan Sumber Daya Air Provinsi Sulawesi Tengah." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 pb-24"
         x-data="{ 
             activeTab: (new URLSearchParams(window.location.search)).get('tab') || 'semua',
             searchQuery: '',
             isFocused: false,
             activeAccordion: null,
             groups: [
                 // 1. AKSES LAYANAN & KINERJA (layanan)
                 {
                     id: 'layanan-01',
                     category: 'layanan',
                     num: '01',
                     title: 'Data Akses Layanan Informasi Publik',
                     items: [
                         { title: 'WEB site resmi berdomain (go.id atau sultengprov.go.id)', y2022: '#', y2023: '#', y2024: '#', y2025: '#' },
                         { title: 'Aplikasi yang berbasis android/IOS/LINUX dan dapat diakses secara umum', y2022: '#', y2023: '#', y2024: '#', y2025: '#' },
                         { title: 'Media sosial resmi (Youtube) identik dengan nama badan Publik', y2022: '#', y2023: '#', y2024: '#', y2025: '#' },
                         { title: 'Media sosial resmi (Facebook) identik dengan nama badan Publik', y2022: '#', y2023: '#', y2024: '#', y2025: '#' },
                         { title: 'Media sosial resmi (Instagram) identik dengan nama badan Publik', y2022: '#', y2023: '#', y2024: '#', y2025: '#' },
                         { title: 'WEB resmi memuat MENU khusus untuk layanan INFORMASI PUBLIK / DAFTAR INFORMASI PUBLIK', y2022: '#', y2023: '#', y2024: '#', y2025: '#' }
                     ]
                 },
                 {
                     id: 'layanan-02',
                     category: 'layanan',
                     num: '02',
                     title: 'Dokumen Tentang Kinerja Badan Publik',
                     items: [
                         { title: 'Survey Kepuasan Masyarakat (SKM)', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Permohonan Informasi Online Unduh', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Sudah mempublikasi data sektoral dibuktikan dengan Surat Keterangan dari Kadis DKIPS', y2022: null, y2023: null, y2024: null, y2025: null },
                         { title: 'Sudah menerapkan Tanda Tangan Elektronik (TTE) dibuktikan dengan Surat Keterangan dari Kadis DKIPS', y2022: null, y2023: null, y2024: null, y2025: null },
                         { title: 'Penghargaan yang diperoleh Badan Publik atas layanan publik (Piagam penghargaan skala nasional) perolehan 2022/2023', y2022: null, y2023: null, y2024: '#', y2025: null },
                         { title: 'Memperoleh akreditas layananpublik dari Lembaga akreditasi (akreditasi/ISO)', y2022: null, y2023: null, y2024: null, y2025: null }
                     ]
                 },
                 {
                     id: 'layanan-03',
                     category: 'layanan',
                     num: '03',
                     title: 'Dokumen Tentang Produk Informasi Publik',
                     items: [
                         { title: 'Statistik Sektoral', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Jurnal/Buletin/Majalah', y2022: null, y2023: null, y2024: null, y2025: null },
                         { title: 'Informasi tentang Pengadaan Barang dan Jasa OPD yang diumumkan oleh LPSE', y2022: null, y2023: null, y2024: null, y2025: '#' }
                     ]
                 },
                 // 2. KEPEGAWAIAN & TATA USAHA (kepegawaian)
                 {
                     id: 'kepegawaian-01',
                     category: 'kepegawaian',
                     num: '01',
                     title: 'Dokumen Tentang Kepegawaian',
                     items: [
                         { title: 'Daftar urut kepangkatan ASN', y2022: null, y2023: null, y2024: '#', y2025: null },
                         { title: 'Profil Pejabat Struktural (minimal memuat foto, data profil pribadi, riwayat kepangkatan, riwayat pendidikan, dan riwayat jabatan)', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Statistik ASN (minimal memuat data statistik berdasarkan pendidikan, golongan ruang, jenis kelamin)', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Laporan Harta Kekayaan LHKASN/LHKPN khusus pejabat struktural (eselon 2) yang telah diverifikasi oleh KPK RI', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Laporan Harta Kekayaan LHKASN/LHKPN khusus pejabat struktural (eselon 3) yang telah diverifikasi oleh KPK RI', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Laporan Harta Kekayaan LHKASN/LHKPN khusus pejabat struktural (eselon 4) yang telah diverifikasi oleh KPK RI', y2022: null, y2023: null, y2024: '#', y2025: '#' }
                     ]
                 },
                 {
                     id: 'kepegawaian-02',
                     category: 'kepegawaian',
                     num: '02',
                     title: 'Dokumen Tentang Ketatausahaan',
                     items: [
                         { title: 'Agenda Pimpinan OPD / Buku Tamu ( Januari - September )', y2022: null, y2023: null, y2024: '#', y2025: '#' }
                     ]
                 },
                 // 3. KEUANGAN & ASET (keuangan)
                 {
                     id: 'keuangan-01',
                     category: 'keuangan',
                     num: '01',
                     title: 'Dokumen Tentang Keuangan dan Aset',
                     items: [
                         { title: 'Rencana Kerja Anggaran (RKA)', y2022: null, y2023: null, y2024: '#', y2025: null },
                         { title: 'Dokumen Pelaksanaan Anggaran (DPA)', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Laporan Realisasi Anggaran (LRA)', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Catatan Atas Laporan Keuangan (CALK)', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Anggaran kas', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Daftar asset', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Kebijakan Umum Anggaran (KUA) Prioritas Pagu Anggaran Sementara (PPAS)', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Dokumen Rencana Umum Pengadaan (RUP)', y2022: null, y2023: null, y2024: '#', y2025: '#' }
                     ]
                 },
                 {
                     id: 'keuangan-02',
                     category: 'keuangan',
                     num: '02',
                     title: 'Dokumen Tentang Pengadaan Barang dan Jasa (PBJ)',
                     items: [
                         { title: 'Anggaran < 200 JT', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Anggaran > 200 JT', y2022: null, y2023: null, y2024: '#', y2025: '#' }
                     ]
                 },
                 // 4. PERENCANAAN & PPID (perencanaan)
                 {
                     id: 'perencanaan-01',
                     category: 'perencanaan',
                     num: '01',
                     title: 'Dokumen Tentang Perencanaan',
                     items: [
                         { title: 'Indikator Kinerja Utama (IKU)', y2022: '#', y2023: '#', y2024: '#', y2025: '#' },
                         { title: 'Renstra (Rencana strategis)', y2022: '#', y2023: '#', y2024: '#', y2025: '#' },
                         { title: 'Renja (Rencana kerja awal)', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'LAKIP (Laporan Kinerja Instansi Pemerintah)', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'LPPD (Laporan Pertanggung jawaban Pemerintah Daerah)', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Perjanjian Kinerja (internal OPD)', y2022: null, y2023: null, y2024: '#', y2025: '#' }
                     ]
                 },
                 {
                     id: 'perencanaan-02',
                     category: 'perencanaan',
                     num: '02',
                     title: 'Dokumen Tentang Keterbukaan Informasi Publik',
                     items: [
                         { title: 'Daftar Informasi Publik (DIP)', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Daftar Informasi Dikecualikan dari PPID Utama (SK) Atau Surat Usul Informasi Dikecualikan Oleh PPID Pelaksana', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'SK Pimpinan Badan Publik Tentang Struktur PPID Pelaksana', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'SK Tim Petugas Informasi', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'SK Tim Petugas Aduan Masyarakat', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'SK Tim Petugas Kehumasan', y2022: null, y2023: null, y2024: '#', y2025: '#' }
                     ]
                 },
                 // 5. KEGIATAN & HUMAS (kegiatan)
                 {
                     id: 'kegiatan-01',
                     category: 'kegiatan',
                     num: '01',
                     title: 'Informasi Tentang Layanan Informasi',
                     items: [
                         { title: 'Mengikuti Rakor tentang PPID/LIKP', y2022: null, y2023: '#', y2024: '#', y2025: null },
                         { title: 'Mengikuti BIMTEK/WORKSHOP/SOSIALISASI tentang PPID/LIKP yang dilaksanakan oleh PPID Utama Provinsi (DKIPS)', y2022: null, y2023: '#', y2024: '#', y2025: null },
                         { title: 'Mengikuti Studi Banding tentang PPID/LIKP, mendampingi Tim Publikasi PPID Utama Provinsi (DKIPS)', y2022: null, y2023: null, y2024: '#', y2025: null }
                     ]
                 },
                 {
                     id: 'kegiatan-02',
                     category: 'kegiatan',
                     num: '02',
                     title: 'Tim Kegiatan Kehumasan dan Layanan Informasi Publik',
                     items: [
                         { title: 'Foto Kopi SK Tim Penugasan Kehumasan', y2022: null, y2023: '#', y2024: '#', y2025: null },
                         { title: 'Foto Kopi SK Tim Petugas Layanan Informasi', y2022: null, y2023: '#', y2024: '#', y2025: null },
                         { title: 'Foto seragam/rompi Tim Petugas Kehumasan', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Foto seragam/rompi Tim Petugas Layanan Informasi', y2022: null, y2023: null, y2024: '#', y2025: null }
                     ]
                 },
                 {
                     id: 'kegiatan-03',
                     category: 'kegiatan',
                     num: '03',
                     title: 'Honorarium Tim Kegiatan Kehumasan dan Layanan Informasi Publik',
                     items: [
                         { title: 'Foto kopi tanda terima (SPM) Honorarium/SPPD Tim Petugas Kehumasan', y2022: null, y2023: null, y2024: '#', y2025: null },
                         { title: 'Foto kopi tanda terima (SPM) Honorarium/SPPD Tim Petugas Layanan Informasi Publik', y2022: null, y2023: null, y2024: '#', y2025: null }
                     ]
                 },
                 {
                     id: 'kegiatan-04',
                     category: 'kegiatan',
                     num: '04',
                     title: 'Keikutsertaan Join Program & Integrasi PPID',
                     items: [
                         { title: 'Wawancara dengan GPR TV Kementerian Kominfo RI', y2022: null, y2023: null, y2024: '#', y2025: '#' },
                         { title: 'Dokumen Yang Dipublikasi di Web PPID Utama Juga Diupload di Web PPID OPD (Tahun)', y2022: null, y2023: '#', y2024: '#', y2025: '#' }
                     ]
                 }
             ],
             groupMatches(group) {
                 if (this.searchQuery === '') {
                     return this.activeTab === 'semua' || group.category === this.activeTab;
                 }
                 const query = this.searchQuery.toLowerCase();
                 const matchesTitle = group.title.toLowerCase().includes(query);
                 const matchesItems = group.items.some(i => i.title.toLowerCase().includes(query));
                 return matchesTitle || matchesItems;
             },
             isExpanded(group) {
                 if (this.searchQuery !== '') {
                     return true; 
                 }
                 return this.activeAccordion === group.id;
             }
         }">

        {{-- MAIN WHITE BOX CONTAINER --}}
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 md:p-10 lg:p-12 border border-slate-100 space-y-8">
            
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
                        @focus="isFocused = true" @blur="isFocused = false"
                        placeholder="Cari berkas atau publikasi informasi..." 
                        class="w-full bg-transparent outline-none font-bold text-slate-800 placeholder:font-semibold placeholder:text-slate-400 text-sm md:text-base py-2.5">
                    
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
                    <button @click="searchQuery = 'LHKPN'" class="px-5 py-2 bg-slate-100/80 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-full text-xs md:text-sm font-extrabold transition border border-slate-200/40 hover:border-blue-100 cursor-pointer shadow-3xs">LHKPN</button>
                    <button @click="searchQuery = 'DPA'" class="px-5 py-2 bg-slate-100/80 hover:bg-emerald-50 text-slate-600 hover:text-emerald-600 rounded-full text-xs md:text-sm font-extrabold transition border border-slate-200/40 hover:border-emerald-100 cursor-pointer shadow-3xs">DPA</button>
                    <button @click="searchQuery = 'Renstra'" class="px-5 py-2 bg-slate-100/80 hover:bg-indigo-50 text-slate-600 hover:text-indigo-600 rounded-full text-xs md:text-sm font-extrabold transition border border-slate-200/40 hover:border-indigo-100 cursor-pointer shadow-3xs">Renstra</button>
                </div>
            </div>

            {{-- GRID LAYOUT: TABS & ACCORDION COLUMNS --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 pt-4">
                
                {{-- LEFT SIDEBAR TABS (3 COLUMNS) --}}
                <div class="lg:col-span-3 space-y-2.5" x-show="!searchQuery">
                    <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 pl-1">Klasifikasi Dokumen</span>
                    
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

                    {{-- Tab 1: Akses & Kinerja --}}
                    <button @click="activeTab = 'layanan'; activeAccordion = null;"
                        class="w-full flex items-center space-x-3.5 px-4.5 py-3.5 rounded-2xl text-left transition duration-200 cursor-pointer border-l-4 border-transparent"
                        :class="activeTab === 'layanan' ? 'bg-blue-50/70 border-blue-600 text-blue-700 font-black' : 'text-slate-600 hover:bg-slate-50/60 hover:text-slate-900 font-bold'">
                        <div class="w-8.5 h-8.5 rounded-xl flex items-center justify-center transition shrink-0"
                            :class="activeTab === 'layanan' ? 'bg-blue-600 text-white shadow-md shadow-blue-500/10' : 'bg-slate-100 text-slate-500'">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                            </svg>
                        </div>
                        <span class="text-xs uppercase tracking-wider">Akses & Kinerja</span>
                    </button>

                    {{-- Tab 2: Kepegawaian & TU --}}
                    <button @click="activeTab = 'kepegawaian'; activeAccordion = null;"
                        class="w-full flex items-center space-x-3.5 px-4.5 py-3.5 rounded-2xl text-left transition duration-200 cursor-pointer border-l-4 border-transparent"
                        :class="activeTab === 'kepegawaian' ? 'bg-emerald-50/70 border-emerald-600 text-emerald-700 font-black' : 'text-slate-600 hover:bg-slate-50/60 hover:text-slate-900 font-bold'">
                        <div class="w-8.5 h-8.5 rounded-xl flex items-center justify-center transition shrink-0"
                            :class="activeTab === 'kepegawaian' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/10' : 'bg-slate-100 text-slate-500'">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs uppercase tracking-wider">Kepegawaian & TU</span>
                    </button>

                    {{-- Tab 3: Keuangan, Aset & PBJ --}}
                    <button @click="activeTab = 'keuangan'; activeAccordion = null;"
                        class="w-full flex items-center space-x-3.5 px-4.5 py-3.5 rounded-2xl text-left transition duration-200 cursor-pointer border-l-4 border-transparent"
                        :class="activeTab === 'keuangan' ? 'bg-indigo-50/70 border-indigo-600 text-indigo-700 font-black' : 'text-slate-600 hover:bg-slate-50/60 hover:text-slate-900 font-bold'">
                        <div class="w-8.5 h-8.5 rounded-xl flex items-center justify-center transition shrink-0"
                            :class="activeTab === 'keuangan' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/10' : 'bg-slate-100 text-slate-500'">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs uppercase tracking-wider">Keuangan & PBJ</span>
                    </button>

                    {{-- Tab 4: Perencanaan & PPID --}}
                    <button @click="activeTab = 'perencanaan'; activeAccordion = null;"
                        class="w-full flex items-center space-x-3.5 px-4.5 py-3.5 rounded-2xl text-left transition duration-200 cursor-pointer border-l-4 border-transparent"
                        :class="activeTab === 'perencanaan' ? 'bg-rose-50/70 border-rose-600 text-rose-700 font-black' : 'text-slate-600 hover:bg-slate-50/60 hover:text-slate-900 font-bold'">
                        <div class="w-8.5 h-8.5 rounded-xl flex items-center justify-center transition shrink-0"
                            :class="activeTab === 'perencanaan' ? 'bg-rose-600 text-white shadow-md shadow-rose-500/10' : 'bg-slate-100 text-slate-500'">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <span class="text-xs uppercase tracking-wider">Perencanaan & PPID</span>
                    </button>

                    {{-- Tab 5: Kegiatan & Humas --}}
                    <button @click="activeTab = 'kegiatan'; activeAccordion = null;"
                        class="w-full flex items-center space-x-3.5 px-4.5 py-3.5 rounded-2xl text-left transition duration-200 cursor-pointer border-l-4 border-transparent"
                        :class="activeTab === 'kegiatan' ? 'bg-amber-50/70 border-amber-600 text-amber-700 font-black' : 'text-slate-600 hover:bg-slate-50/60 hover:text-slate-900 font-bold'">
                        <div class="w-8.5 h-8.5 rounded-xl flex items-center justify-center transition shrink-0"
                            :class="activeTab === 'kegiatan' ? 'bg-amber-600 text-white shadow-md shadow-amber-500/10' : 'bg-slate-100 text-slate-500'">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                            </svg>
                        </div>
                        <span class="text-xs uppercase tracking-wider">Kegiatan & Humas</span>
                    </button>
                </div>

                {{-- RIGHT CONTENT AREA --}}
                <div :class="searchQuery ? 'lg:col-span-12' : 'lg:col-span-9'" class="space-y-4">
                    
                    {{-- Section Title --}}
                    <div class="px-1 py-1 flex justify-between items-center border-b border-slate-100 pb-3">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            <span x-show="!searchQuery">
                                Klasifikasi Aktif: 
                                <span x-show="activeTab === 'semua'" class="text-slate-700">Semua Dokumen</span>
                                <span x-show="activeTab === 'layanan'" class="text-blue-600">Akses & Kinerja</span>
                                <span x-show="activeTab === 'kepegawaian'" class="text-emerald-600">Kepegawaian & TU</span>
                                <span x-show="activeTab === 'keuangan'" class="text-indigo-600">Keuangan & PBJ</span>
                                <span x-show="activeTab === 'perencanaan'" class="text-rose-600">Perencanaan & PPID</span>
                                <span x-show="activeTab === 'kegiatan'" class="text-amber-600">Kegiatan & Humas</span>
                            </span>
                            <span x-show="searchQuery">Hasil Pencarian Untuk &ldquo;<span x-text="searchQuery"></span>&rdquo;</span>
                        </span>
                    </div>

                    {{-- ACCORDION CONTAINER --}}
                    <div class="space-y-4">
                        <template x-for="group in groups" :key="group.id">
                            <div x-show="groupMatches(group)" 
                                 class="bg-white border border-slate-200/50 rounded-2xl overflow-hidden transition-all duration-300 shadow-2xs hover:shadow-xs">
                                
                                {{-- ACCORDION HEADER --}}
                                <button @click="activeAccordion = isExpanded(group) ? null : group.id"
                                    class="w-full flex items-center justify-between p-4.5 text-left bg-white hover:bg-slate-50/50 transition cursor-pointer select-none">
                                    
                                    <div class="flex items-center space-x-4">
                                        {{-- Kotak Nomor Kiri --}}
                                        <div class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-[11px] font-black text-slate-500 shadow-3xs"
                                            :class="{
                                                'bg-blue-50/50 text-blue-600 border-blue-100/30': group.category === 'layanan' && isExpanded(group),
                                                'bg-emerald-50/50 text-emerald-600 border-emerald-100/30': group.category === 'kepegawaian' && isExpanded(group),
                                                'bg-indigo-50/50 text-indigo-600 border-indigo-100/30': group.category === 'keuangan' && isExpanded(group),
                                                'bg-rose-50/50 text-rose-600 border-rose-100/30': group.category === 'perencanaan' && isExpanded(group),
                                                'bg-amber-50/50 text-amber-600 border-amber-100/30': group.category === 'kegiatan' && isExpanded(group)
                                            }">
                                            <span x-text="group.num"></span>
                                        </div>
                                        
                                        {{-- Judul Tebal --}}
                                        <span class="text-sm md:text-base font-black text-slate-800 tracking-tight leading-snug group-hover:text-blue-600 transition-colors"
                                            :class="isExpanded(group) ? (
                                                group.category === 'layanan' ? 'text-blue-600' :
                                                group.category === 'kepegawaian' ? 'text-emerald-600' :
                                                group.category === 'keuangan' ? 'text-indigo-600' :
                                                group.category === 'perencanaan' ? 'text-rose-600' : 'text-amber-600'
                                            ) : ''"
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

                                {{-- ACCORDION CONTENT --}}
                                <div x-show="isExpanded(group)" 
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 max-h-0"
                                    x-transition:enter-end="opacity-100 max-h-screen"
                                    class="border-t border-slate-100 bg-slate-50/30">
                                    
                                    <div class="divide-y divide-slate-100">
                                        <template x-for="item in group.items" :key="item.title">
                                            <div class="p-6 flex flex-col xl:flex-row xl:items-center justify-between gap-5 hover:bg-slate-50/40 transition duration-150">
                                                
                                                {{-- Detail Informasi --}}
                                                <div class="flex items-start space-x-3.5 max-w-xl">
                                                    <div class="shrink-0 p-2.5 bg-white border border-slate-200/60 rounded-xl shadow-3xs text-slate-500">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                    </div>
                                                    <div class="space-y-1">
                                                        <h5 class="text-xs md:text-sm font-black text-slate-800 tracking-tight leading-snug" x-text="item.title"></h5>
                                                        <p class="text-[10px] text-slate-400 font-bold leading-relaxed">Pilih tahun rilis di samping untuk melihat atau mengunduh berkas resmi.</p>
                                                    </div>
                                                </div>

                                                {{-- Tombol Aksi Tahun (2022 - 2025) --}}
                                                <div class="flex items-center gap-2 flex-wrap sm:flex-nowrap">
                                                    
                                                    <!-- 2022 -->
                                                    <template x-if="item.y2022">
                                                        <a :href="item.y2022" target="_blank"
                                                            class="flex-1 sm:flex-initial flex items-center justify-center space-x-1 px-4 py-2.5 rounded-xl text-xs font-black shadow-3xs transition border cursor-pointer text-white"
                                                            :class="{
                                                                'bg-blue-600 hover:bg-blue-700 border-blue-700 shadow-blue-500/10': group.category === 'layanan',
                                                                'bg-emerald-600 hover:bg-emerald-700 border-emerald-700 shadow-emerald-500/10': group.category === 'kepegawaian',
                                                                'bg-indigo-600 hover:bg-indigo-700 border-indigo-700 shadow-indigo-500/10': group.category === 'keuangan',
                                                                'bg-rose-600 hover:bg-rose-700 border-rose-700 shadow-rose-500/10': group.category === 'perencanaan',
                                                                'bg-amber-600 hover:bg-amber-700 border-amber-700 shadow-amber-500/10': group.category === 'kegiatan'
                                                            }">
                                                            <span>2022</span>
                                                            <span class="text-[10px]">➔</span>
                                                        </a>
                                                    </template>
                                                    <template x-if="!item.y2022">
                                                        <div class="flex-1 sm:flex-initial flex items-center justify-center px-4 py-2.5 bg-slate-100/70 border border-slate-200/50 text-slate-350 rounded-xl text-xs font-black select-none">
                                                            <span>2022</span>
                                                        </div>
                                                    </template>

                                                    <!-- 2023 -->
                                                    <template x-if="item.y2023">
                                                        <a :href="item.y2023" target="_blank"
                                                            class="flex-1 sm:flex-initial flex items-center justify-center space-x-1 px-4 py-2.5 rounded-xl text-xs font-black shadow-3xs transition border cursor-pointer text-white"
                                                            :class="{
                                                                'bg-blue-600 hover:bg-blue-700 border-blue-700 shadow-blue-500/10': group.category === 'layanan',
                                                                'bg-emerald-600 hover:bg-emerald-700 border-emerald-700 shadow-emerald-500/10': group.category === 'kepegawaian',
                                                                'bg-indigo-600 hover:bg-indigo-700 border-indigo-700 shadow-indigo-500/10': group.category === 'keuangan',
                                                                'bg-rose-600 hover:bg-rose-700 border-rose-700 shadow-rose-500/10': group.category === 'perencanaan',
                                                                'bg-amber-600 hover:bg-amber-700 border-amber-700 shadow-amber-500/10': group.category === 'kegiatan'
                                                            }">
                                                            <span>2023</span>
                                                            <span class="text-[10px]">➔</span>
                                                        </a>
                                                    </template>
                                                    <template x-if="!item.y2023">
                                                        <div class="flex-1 sm:flex-initial flex items-center justify-center px-4 py-2.5 bg-slate-100/70 border border-slate-200/50 text-slate-355 rounded-xl text-xs font-black select-none">
                                                            <span>2023</span>
                                                        </div>
                                                    </template>

                                                    <!-- 2024 -->
                                                    <template x-if="item.y2024">
                                                        <a :href="item.y2024" target="_blank"
                                                            class="flex-1 sm:flex-initial flex items-center justify-center space-x-1 px-4 py-2.5 rounded-xl text-xs font-black shadow-3xs transition border cursor-pointer text-white"
                                                            :class="{
                                                                'bg-blue-600 hover:bg-blue-700 border-blue-700 shadow-blue-500/10': group.category === 'layanan',
                                                                'bg-emerald-600 hover:bg-emerald-700 border-emerald-700 shadow-emerald-500/10': group.category === 'kepegawaian',
                                                                'bg-indigo-600 hover:bg-indigo-700 border-indigo-700 shadow-indigo-500/10': group.category === 'keuangan',
                                                                'bg-rose-600 hover:bg-rose-700 border-rose-700 shadow-rose-500/10': group.category === 'perencanaan',
                                                                'bg-amber-600 hover:bg-amber-700 border-amber-700 shadow-amber-500/10': group.category === 'kegiatan'
                                                            }">
                                                            <span>2024</span>
                                                            <span class="text-[10px]">➔</span>
                                                        </a>
                                                    </template>
                                                    <template x-if="!item.y2024">
                                                        <div class="flex-1 sm:flex-initial flex items-center justify-center px-4 py-2.5 bg-slate-100/70 border border-slate-200/50 text-slate-355 rounded-xl text-xs font-black select-none">
                                                            <span>2024</span>
                                                        </div>
                                                    </template>

                                                    <!-- 2025 -->
                                                    <template x-if="item.y2025">
                                                        <a :href="item.y2025" target="_blank"
                                                            class="flex-1 sm:flex-initial flex items-center justify-center space-x-1 px-4 py-2.5 rounded-xl text-xs font-black shadow-3xs transition border cursor-pointer text-white"
                                                            :class="{
                                                                'bg-blue-600 hover:bg-blue-700 border-blue-700 shadow-blue-500/10': group.category === 'layanan',
                                                                'bg-emerald-600 hover:bg-emerald-700 border-emerald-700 shadow-emerald-500/10': group.category === 'kepegawaian',
                                                                'bg-indigo-600 hover:bg-indigo-700 border-indigo-700 shadow-indigo-500/10': group.category === 'keuangan',
                                                                'bg-rose-600 hover:bg-rose-700 border-rose-700 shadow-rose-500/10': group.category === 'perencanaan',
                                                                'bg-amber-600 hover:bg-amber-700 border-amber-700 shadow-amber-500/10': group.category === 'kegiatan'
                                                            }">
                                                            <span>2025</span>
                                                            <span class="text-[10px]">➔</span>
                                                        </a>
                                                    </template>
                                                    <template x-if="!item.y2025">
                                                        <div class="flex-1 sm:flex-initial flex items-center justify-center px-4 py-2.5 bg-slate-100/70 border border-slate-200/50 text-slate-355 rounded-xl text-xs font-black select-none">
                                                            <span>2025</span>
                                                        </div>
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

    </div>
@endsection
