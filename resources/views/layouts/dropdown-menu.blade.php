<div class="hidden lg:flex lg:items-center lg:space-x-2 xl:space-x-6">

    {{-- MENU BERANDA --}}
    <a href="/"
        class="px-2 py-2 text-sm font-medium transition tracking-normal {{ request()->is('/') ? 'text-yellow-400' : 'text-white hover:text-yellow-300' }}">
        Beranda
    </a>

    {{-- MENU PROFIL --}}
    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
        <button
            class="flex items-center px-2 py-2 transition outline-none text-sm font-medium tracking-normal {{ request()->is('profil*') ? 'text-yellow-400' : 'text-white hover:text-yellow-400' }}">
            Profil
            <svg class="ml-1.5 w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="open" x-transition.opacity.duration.200ms
            class="absolute left-0 top-full mt-1 w-64 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50">
            <a href="/profil/struktur-organisasi"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Struktur
                Organisasi</a>
            <a href="/profil/visi-misi"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Visi
                dan Misi</a>
            <a href="/profil/tugas-fungsi"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Tugas
                dan Fungsi</a>
            <a href="/profil/sejarah"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Sejarah
                Singkat</a>
            <a href="/profil/pejabat"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Pejabat</a>
            <a href="/profil/maklumat"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Maklumat
                Informasi Publik</a>
            <a href="/profil/lhkpn"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">LHKPN & LHKASN</a>
            <a href="/profil/keuangan"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Keuangan</a>
        </div>
    </div>

    {{-- MENU GALERI (FIX SINKRONISASI ROUTE USER) --}}
    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
        <button
            class="flex items-center px-2 py-2 transition outline-none text-sm font-medium tracking-normal {{ request()->is('profil/galeri*') ? 'text-yellow-400' : 'text-white hover:text-yellow-400' }}">
            Galeri
            <svg class="ml-1.5 w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="open" x-transition.opacity.duration.200ms
            class="absolute left-0 top-full mt-1 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50">

            {{-- FIX KUNCI: Menembak ke name rute resmi Laravel agar terhindar dari eror 404 --}}
            <a href="{{ route('profil.galeri-foto') }}"
                class="block px-5 py-2.5 {{ request()->routeIs('profil.galeri-foto') ? 'bg-slate-50 text-blue-600 font-bold' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }} transition text-sm font-medium">
                Foto
            </a>

            <a href="{{ route('profil.galeri-video') }}"
                class="block px-5 py-2.5 {{ request()->routeIs('profil.galeri-video') ? 'bg-slate-50 text-blue-600 font-bold' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }} transition text-sm font-medium">
                Video
            </a>

            <a href="{{ route('profil.booklet') }}"
                class="block px-5 py-2.5 {{ request()->routeIs('profil.booklet') ? 'bg-slate-50 text-blue-600 font-bold' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }} transition text-sm font-medium">
                Booklet
            </a>
        </div>
    </div>

    {{-- MENU INFORMASI PUBLIK --}}
    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
        <button
            class="flex items-center px-2 py-2 transition outline-none text-sm font-medium tracking-normal {{ request()->is('informasi*') ? 'text-yellow-400' : 'text-white hover:text-yellow-400' }}">
            Informasi Publik
            <svg class="ml-1.5 w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="open" x-transition.opacity.duration.200ms
            class="absolute left-0 top-full mt-1 w-80 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50">

            <div x-data="{ subOpen: false }" @mouseenter="subOpen = true" @mouseleave="subOpen = false"
                class="relative group">
                <button
                    class="w-full text-left flex items-center justify-between px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium outline-none">
                    Daftar Informasi
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <div x-show="subOpen" x-transition.opacity.duration.200ms
                    class="absolute left-full top-0 ml-1 w-80 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50">
                    <a href="/informasi/setiap-saat"
                        class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Daftar
                        Informasi Publik Setiap Saat</a>
                    <a href="/informasi/serta-merta"
                        class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Daftar
                        Informasi Publik Serta Merta</a>
                    <a href="/informasi/berkala"
                        class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Daftar
                        Informasi Publik Berkala</a>
                    <a href="/informasi/dikecualikan"
                        class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Daftar
                        Informasi Dikecualikan</a>
                </div>
            </div>

            <a href="/informasi/publikasi"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Publikasi
                Informasi Publik</a>
            <a href="/informasi/berita"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Berita</a>
            <a href="/informasi/dokumen"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Dokumen</a>
            <a href="/informasi/mou"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Perjanjian
                Kerja Sama (MoU)</a>
            <a href="/informasi/form-permohonan"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Form
                Permohonan Informasi</a>
            <a href="/informasi/sk-gub"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium leading-relaxed">SK
                GUB Bangunan Gedung Untuk Kepentingan Strategis Prov Sulteng 2025</a>
        </div>
    </div>

    {{-- MENU PPID --}}
    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
        <button
            class="flex items-center px-2 py-2 transition outline-none text-sm font-medium tracking-normal {{ request()->is('ppid*') ? 'text-yellow-400' : 'text-white hover:text-yellow-400' }}">
            PPID
            <svg class="ml-1.5 w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="open" x-transition.opacity.duration.200ms
            class="absolute left-0 top-full mt-1 w-80 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50">
            <a href="/ppid/surat-keputusan"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Surat
                Keputusan</a>
            <a href="/ppid/visi-misi"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Visi
                dan Misi PPID</a>
            <a href="/ppid/pelayanan"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Pelayanan</a>
            <a href="/ppid/pengargaan"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Penghargaan</a>
            <a href="/ppid/permohonan-informasi"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Permohonan
                Informasi</a>
            <a href="/ppid/dokumen-elektronik"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium leading-relaxed">Dokumen-dokumen
                elektronik berkaitan program dan kegiatan Tahun 2022 – 2024</a>
            <a href="/ppid/sop-spm"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">SOP
                & SPM PPID</a>
        </div>
    </div>

    {{-- MENU LAYANAN (Direct Links External) --}}
    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
        <button
            class="flex items-center px-2 py-2 transition outline-none text-sm font-medium tracking-normal {{ request()->is('layanan*') ? 'text-yellow-400' : 'text-white hover:text-yellow-400' }}">
            Layanan
            <svg class="ml-1.5 w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="open" x-transition.opacity.duration.200ms
            class="absolute right-0 top-full mt-1 w-64 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50 max-h-[70vh] overflow-y-auto custom-scrollbar">

            <a href="https://padungku.sultengprov.go.id/" target="_blank"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">e-PADUNGKU</a>
            <a href="https://irigasiku.pu.go.id/" target="_blank"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">IRIGASIKU</a>
            <a href="https://simbg.pu.go.id/" target="_blank"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">e-Bantekbgn</a>
            <a href="https://www.lapor.go.id/" target="_blank"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Lapor</a>
            <a href="https://jdih.sultengprov.go.id/" target="_blank"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">JDIH
                PROVINSI SULTENG</a>
            <a href="https://cikasda.sultengprov.go.id/form-aduan-masyarakat/" target="_blank"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Form
                Aduan Masyarakat</a>
            <a href="http://dbinfrastruktur.sultengprov.go.id/" target="_blank"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium leading-snug">Data
                Base Infrastruktur Schisto</a>
            <a href="https://e-larismanis.sultengprov.go.id/" target="_blank"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">e-larismanis</a>
            <a href="https://lirikwilda.sultengprov.go.id/" target="_blank"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Lirik
                Wilda</a>
            <a href="https://psdawil2.cikasda.sultengprov.go.id/" target="_blank"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">SISDA
                UPT PSDA WIL.II</a>
            <a href="https://socairmisi.cikasda.sultengprov.go.id/" target="_blank"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">SO
                CAIR MISI</a>
            <a href="https://simonev.cikasda.sultengprov.go.id/" target="_blank"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">Simonev</a>
            <a href="https://sih3.sultengprov.go.id/" target="_blank"
                class="block px-5 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition text-sm font-medium">SIH3</a>
        </div>
    </div>

</div>
