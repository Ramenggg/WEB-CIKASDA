@extends('admin.layouts.app')

@section('title', 'Dashboard Utama')

@section('content')
    {{-- KUNCI UTAMA: Kontainer Global Adaptif dengan Background Gedung CIKASDA & Deep Blue Shadow --}}
    <div
        class="relative w-full min-h-screen rounded-[2rem] p-6 md:p-8 overflow-hidden isolate shadow-[inset_0_4px_30px_rgba(15,23,42,0.3)]">

        {{-- BACKGROUND IMAGE GEDUNG UTAMA & OVERLAY GRADASI SINEMATIK --}}
        <div class="absolute inset-0 -z-20">
            <img src="{{ asset('images/slider/slide1.png') }}" alt="Background CIKASDA"
                class="w-full h-full object-cover object-center grayscale-15 brightness-[0.25]">
            {{-- Lapisan Gelap Deep Dark Blue & Midnight Gradasi --}}
            <div
                class="absolute inset-0 bg-gradient-to-tr from-slate-950 via-blue-950/85 to-slate-900/60 mix-blend-multiply">
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/40 via-slate-950/85 to-slate-950"></div>
        </div>

        {{-- Sorot Cahaya Neon Glow Lembut di Sudut Latar Belakang --}}
        <div
            class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-blue-600/15 rounded-full blur-[140px] -z-10 pointer-events-none">
        </div>
        <div
            class="absolute -bottom-20 -left-20 w-[400px] h-[400px] bg-cyan-500/10 rounded-full blur-[100px] -z-10 pointer-events-none">
        </div>

        <div class="space-y-8">

            {{-- ==================================================================
             1. WELCOME BANNER (SEMI-TRANSPARAN GLASSMORPHISM STYLE)
             ================================================================== --}}
            <div
                class="relative overflow-hidden bg-white/5 backdrop-blur-md rounded-2xl p-6 md:p-8 shadow-[0_20px_50px_rgba(0,0,0,0.3)] border border-white/10">
                <div class="relative z-10 flex flex-col lg:flex-row justify-between items-center gap-6">
                    <div class="text-center lg:text-left space-y-3">
                        <div
                            class="inline-flex items-center space-x-2 bg-cyan-400/10 border border-cyan-400/30 px-3 py-1 rounded-full">
                            <span class="flex h-1.5 w-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                            <span class="text-[9px] font-black text-cyan-400 uppercase tracking-widest">Pusat Kendali
                                Portal</span>
                        </div>
                        <h2 class="text-2xl md:text-4xl font-black text-white leading-tight tracking-tight">
                            Halo, <span
                                class="bg-gradient-to-r from-cyan-400 via-blue-400 to-indigo-400 bg-clip-text text-transparent drop-shadow-xs">Admin
                                CIKASDA!</span>
                        </h2>
                        <p class="text-slate-300 max-w-lg font-semibold leading-relaxed text-xs opacity-85">
                            Kelola seluruh muatan naskah informasi publik, infografis berkas gambar, arsip peraturan daerah,
                            dan rilis warta berita kedinasan secara terpadu.
                        </p>
                        <div class="pt-2 flex flex-wrap justify-center lg:justify-start gap-3">
                            <a href="{{ route('admin.berita.tambah') }}"
                                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-[11px] font-black uppercase tracking-widest rounded-xl transition-all duration-300 shadow-md shadow-blue-600/20 active:scale-98 cursor-pointer">
                                Tambah Berita
                            </a>
                            <a href="/" target="_blank"
                                class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white text-[11px] font-black uppercase tracking-widest rounded-xl transition-all duration-300 border border-white/10 backdrop-blur-xs active:scale-98 cursor-pointer">
                                Lihat Website
                            </a>
                        </div>
                    </div>

                    {{-- Widget Status Sistem Kanan --}}
                    <div
                        class="bg-slate-950/60 backdrop-blur-lg border border-white/5 p-5 rounded-xl w-full lg:w-64 shadow-xl">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2.5 mb-3">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status Sistem</p>
                            <span
                                class="text-emerald-400 font-black tracking-wide text-[9px] bg-emerald-500/10 px-2 py-0.5 border border-emerald-500/20 rounded-md">Stable</span>
                        </div>
                        <div class="space-y-3">
                            <div class="w-full bg-white/5 h-1.5 rounded-full overflow-hidden p-0.5 border border-white/5">
                                <div class="bg-gradient-to-r from-blue-500 to-cyan-400 h-full rounded-full"
                                    style="width: 85%"></div>
                            </div>
                            <div
                                class="flex items-center justify-between text-[9px] text-slate-400 font-black uppercase tracking-wider">
                                <span>Waktu server:</span>
                                <span class="text-slate-200">{{ now()->format('H:i') }} WITA</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==================================================================
             2. STATISTIK CARDS (HIGH CONTRAST PREMIUM GLASS FLOATING)
             ================================================================== --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10">
                {{-- Berita --}}
                <div
                    class="bg-white/95 backdrop-blur-md p-5 rounded-2xl border border-white/10 shadow-[0_15px_35px_rgba(0,0,0,0.2)] hover:shadow-[0_25px_50px_rgba(37,99,235,0.15)] hover:border-blue-500/40 transition-all duration-300 group hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="p-2.5 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-3xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <span
                            class="text-[9px] font-black text-slate-400 uppercase tracking-widest bg-slate-100 border border-slate-200/40 rounded-md px-2 py-0.5">Warta</span>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $countBerita ?? 0 }}</h3>
                    <p class="text-[11px] font-bold text-slate-500 mt-1 uppercase tracking-wide">Total Artikel Terbit</p>
                </div>

                {{-- Galeri --}}
                <div
                    class="bg-white/95 backdrop-blur-md p-5 rounded-2xl border border-white/10 shadow-[0_15px_35px_rgba(0,0,0,0.2)] hover:shadow-[0_25px_50px_rgba(6,182,212,0.15)] hover:border-cyan-500/40 transition-all duration-300 group hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="p-2.5 bg-cyan-50 text-cyan-600 rounded-xl group-hover:bg-cyan-600 group-hover:text-white transition-all duration-300 shadow-3xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span
                            class="text-[9px] font-black text-slate-400 uppercase tracking-widest bg-slate-100 border border-slate-200/40 rounded-md px-2 py-0.5">Media</span>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $countGaleri ?? 0 }}</h3>
                    <p class="text-[11px] font-bold text-slate-500 mt-1 uppercase tracking-wide">Foto & Video Dokumentasi
                    </p>
                </div>

                {{-- Pesan --}}
                <div
                    class="bg-white/95 backdrop-blur-md p-5 rounded-2xl border border-white/10 shadow-[0_15px_35px_rgba(0,0,0,0.2)] hover:shadow-[0_25px_50px_rgba(245,158,11,0.15)] hover:border-amber-500/40 transition-all duration-300 group hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="p-2.5 bg-amber-50 text-amber-600 rounded-xl group-hover:bg-amber-600 group-hover:text-white transition-all duration-300 shadow-3xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <span
                            class="text-[9px] font-black text-slate-400 uppercase tracking-widest bg-slate-100 border border-slate-200/40 rounded-md px-2 py-0.5">Aspirasi</span>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $countPesan ?? 0 }}</h3>
                    <p class="text-[11px] font-bold text-slate-500 mt-1 uppercase tracking-wide">Aduan Belum Dibaca</p>
                </div>

                {{-- Pengunjung --}}
                <div
                    class="bg-white/95 backdrop-blur-md p-5 rounded-2xl border border-white/10 shadow-[0_15px_35px_rgba(0,0,0,0.2)] hover:shadow-[0_25px_50px_rgba(225,29,72,0.15)] hover:border-rose-500/40 transition-all duration-300 group hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="p-2.5 bg-rose-50 text-rose-600 rounded-xl group-hover:bg-rose-600 group-hover:text-white transition-all duration-300 shadow-3xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <span
                            class="text-[9px] font-black text-slate-400 uppercase tracking-widest bg-slate-100 border border-slate-200/40 rounded-md px-2 py-0.5">Trafik</span>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $countHits ?? '0' }}</h3>
                    <p class="text-[11px] font-bold text-slate-500 mt-1 uppercase tracking-wide">Pengunjung Hari Ini</p>
                </div>
            </div>

            {{-- ==================================================================
             3. AREA LOG AKTIVITAS (SOLID PUTIH DENGAN ELEVASI MENGAPUNG)
             ================================================================== --}}
            <div
                class="bg-white/95 backdrop-blur-md rounded-2xl border border-white/20 shadow-[0_20px_50px_rgba(0,0,0,0.25)] overflow-hidden relative z-10">
                <div
                    class="p-5 border-b border-slate-100 flex justify-between items-center bg-gradient-to-r from-slate-50 via-white to-slate-50">
                    <div class="flex items-center space-x-2.5">
                        <span class="h-3.5 w-1 bg-blue-600 rounded-full shadow-xs"></span>
                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-wider">Aktivitas Sistem Terkini</h4>
                    </div>
                    <a href="{{ route('admin.logs') }}"
                        class="inline-flex items-center text-blue-600 text-xs font-black uppercase tracking-wider hover:text-blue-800 transition-colors group">
                        <span>Lihat Semua Log</span>
                        <svg class="w-3 h-3 ml-1 transition-transform group-hover:translate-x-0.5" fill="none"
                            stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="divide-y divide-slate-100 bg-white">
                    @forelse($latestLogs ?? [] as $log)
                        <div
                            class="p-4 flex items-center justify-between gap-4 hover:bg-slate-50/60 transition-colors duration-200">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-gradient-to-br from-slate-50 to-slate-100 border border-slate-200 text-slate-700 font-black text-[11px] uppercase flex items-center justify-center shrink-0 shadow-3xs">
                                    {{ substr($log->user->name ?? 'A', 0, 2) }}
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-800 leading-tight">
                                        {{ $log->user->name ?? 'System Officer' }}
                                        <span
                                            class="font-semibold text-slate-500 pl-0.5">{{ $log->description ?? 'telah memperbarui data' }}</span>
                                    </p>
                                    <p
                                        class="text-[10px] text-slate-400 font-black uppercase tracking-wider mt-1 flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-slate-300" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $log->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <span
                                class="text-[9px] bg-slate-50 border border-slate-200 text-slate-500 font-extrabold px-2 py-0.5 rounded-md uppercase tracking-wider hidden sm:inline-block">Verified</span>
                        </div>
                    @empty
                        <div class="p-12 text-center space-y-3 bg-white">
                            <div
                                class="w-10 h-10 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-center mx-auto text-slate-400 shadow-inner">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Belum ada aktivitas
                                    tercatat</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
