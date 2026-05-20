<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - CIKASDA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-100 font-sans antialiased selection:bg-blue-500 selection:text-white">
    <div class="flex min-h-screen">

        <aside class="w-64 bg-slate-900 text-white shrink-0 fixed h-full z-50 shadow-2xl border-r border-slate-800">
            <div class="p-6 border-b border-slate-800">
                <h2 class="text-xl font-black tracking-tighter text-cyan-400 uppercase">Admin Panel</h2>
                <p class="text-[10px] text-slate-500 uppercase tracking-widest mt-1 font-extrabold italic">Dinas Cikasda
                </p>
            </div>

            <nav class="mt-6 px-3 space-y-1.5">

                <a href="/admin"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->is('admin') ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <div class="pt-4 pb-1 text-[10px] font-extrabold text-slate-500 uppercase px-4 tracking-widest">Master
                    Konten</div>

                <details class="group [&_summary::-webkit-details-marker]:hidden"
                    {{ request()->is('admin/profil*') ? 'open' : '' }}>

                    <summary
                        class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-semibold text-slate-400 hover:bg-slate-800/60 hover:text-white cursor-pointer transition-all list-none group-open:bg-slate-800/40 group-open:text-white">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-slate-400 group-open:text-cyan-400 transition-colors"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>Menu Profil</span>
                        </div>
                        <svg class="w-4 h-4 text-slate-500 transition-transform duration-300 group-open:rotate-180"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>

                    <div class="mt-1 pl-4 pr-1 space-y-1 border-l-2 border-slate-800 ml-6">

                        <a href="/admin/profil/struktur"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/profil/struktur*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Struktur Organisasi
                        </a>

                        <a href="/admin/profil/visi-misi"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/profil/visi-misi*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Visi dan Misi
                        </a>

                        <a href="/admin/profil/tugas-fungsi"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/profil/tugas-fungsi*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Tugas dan Fungsi
                        </a>

                        <a href="/admin/profil/sejarah"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/profil/sejarah*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Sejarah Singkat
                        </a>

                        <a href="/admin/profil/pejabat"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/profil/pejabat*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Pejabat
                        </a>

                        <a href="/admin/profil/maklumat"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/profil/maklumat*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Maklumat Informasi Publik
                        </a>

                        <a href="/admin/profil/lhkpn"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/profil/lhkpn*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            LHKPN
                        </a>

                        <a href="/admin/profil/keuangan"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/profil/keuangan*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Keuangan
                        </a>

                    </div>
                </details>

                <details class="group [&_summary::-webkit-details-marker]:hidden"
                    {{ request()->is('admin/galeri*') ? 'open' : '' }}>

                    <summary
                        class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-semibold text-slate-400 hover:bg-slate-800/60 hover:text-white cursor-pointer transition-all list-none group-open:bg-slate-800/40 group-open:text-white">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-slate-400 group-open:text-cyan-400 transition-colors"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Menu Galeri</span>
                        </div>
                        <svg class="w-4 h-4 text-slate-500 transition-transform duration-300 group-open:rotate-180"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>

                    <div class="mt-1 pl-4 pr-1 space-y-1 border-l-2 border-slate-800 ml-6">

                        <a href="/admin/galeri/foto"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/galeri/foto*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Foto Kegiatan
                        </a>

                        <a href="/admin/galeri/video"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/galeri/video*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Video Dokumentasi
                        </a>

                        <a href="/admin/galeri/booklet"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/galeri/booklet*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Booklet / Brosur Digital
                        </a>

                    </div>
                </details>
                <details class="group [&_summary::-webkit-details-marker]:hidden"
                    {{ request()->is('admin/informasi*') ? 'open' : '' }}>

                    <summary
                        class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-semibold text-slate-400 hover:bg-slate-800/60 hover:text-white cursor-pointer transition-all list-none group-open:bg-slate-800/40 group-open:text-white">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-slate-400 group-open:text-cyan-400 transition-colors"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 000-6M16.5 5.508a5.5 5.5 0 010 10.984M12 10.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                            </svg>
                            <span>Informasi Publik</span>
                        </div>
                        <svg class="w-4 h-4 text-slate-500 transition-transform duration-300 group-open:rotate-180"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>

                    <div class="mt-1 pl-4 pr-1 space-y-1 border-l-2 border-slate-800 ml-6">

                        <a href="/admin/informasi/daftar"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/informasi/daftar*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Daftar Informasi
                        </a>

                        <a href="/admin/informasi/publikasi"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/informasi/publikasi*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Publikasi Informasi Publik
                        </a>

                        <a href="/admin/informasi/berita"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/informasi/berita*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Berita
                        </a>

                        <a href="/admin/informasi/dokumen"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/informasi/dokumen*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Dokumen
                        </a>

                        <a href="/admin/informasi/mou"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/informasi/mou*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Perjanjian Kerja Sama (MoU)
                        </a>

                        <a href="/admin/informasi/permohonan"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/informasi/permohonan*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Form Permohonan Informasi
                        </a>

                        <a href="/admin/informasi/sk-gub"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/informasi/sk-gub*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }} whitespace-normal break-words leading-tight">
                            SK GUB Bangunan Gedung Untuk Kepentingan Strategis Prov Sulteng 2025
                        </a>

                    </div>
                </details>
                <details class="group [&_summary::-webkit-details-marker]:hidden"
                    {{ request()->is('admin/ppid*') ? 'open' : '' }}>

                    <summary
                        class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-semibold text-slate-400 hover:bg-slate-800/60 hover:text-white cursor-pointer transition-all list-none group-open:bg-slate-800/40 group-open:text-white">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-slate-400 group-open:text-cyan-400 transition-colors"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>Menu PPID</span>
                        </div>
                        <svg class="w-4 h-4 text-slate-500 transition-transform duration-300 group-open:rotate-180"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>

                    <div class="mt-1 pl-4 pr-1 space-y-1 border-l-2 border-slate-800 ml-6">

                        <a href="/admin/ppid/sk"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/ppid/sk*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Surat Keputusan
                        </a>

                        <a href="/admin/ppid/visi-misi"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/ppid/visi-misi*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Visi dan Misi PPID
                        </a>

                        <a href="/admin/ppid/pelayanan"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/ppid/pelayanan*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Pelayanan
                        </a>

                        <a href="/admin/ppid/penghargaan"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/ppid/penghargaan*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Penghargaan
                        </a>

                        <a href="/admin/ppid/permohonan"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/ppid/permohonan*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            Permohonan Informasi
                        </a>

                        <a href="/admin/ppid/dokumen-program"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/ppid/dokumen-program*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }} whitespace-normal break-words leading-tight">
                            Dokumen-dokumen elektronik berkaitan program dan kegiatan Tahun 2022 – 2024
                        </a>

                        <a href="/admin/ppid/sop-spm"
                            class="block py-2 px-3 text-xs font-semibold rounded-lg transition-all {{ request()->is('admin/ppid/sop-spm*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            SOP & SPM PPID
                        </a>

                    </div>
                </details>
            </nav>
        </aside>

        <div class="flex-1 ml-64 flex flex-col">
            <header
                class="bg-white border-b border-slate-200 px-8 py-5 flex justify-between items-center sticky top-0 z-40 shadow-xs">
                <h3 class="font-black text-slate-800 text-lg tracking-tight">@yield('title')</h3>

                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-xs font-black text-slate-900 uppercase tracking-wide">Administrator</p>
                        <p class="text-[10px] text-green-500 font-extrabold tracking-widest uppercase mt-0.5">Online
                        </p>
                    </div>
                    <div
                        class="h-10 w-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 font-black border border-blue-200 shadow-xs text-sm">
                        A
                    </div>
                </div>
            </header>

            <main class="p-8">
                @yield('content')
            </main>
        </div>

    </div>
</body>

</html>
