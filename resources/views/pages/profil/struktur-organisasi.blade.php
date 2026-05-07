@extends('layouts.app')

@section('content')
    {{-- 
        PENYESUAIAN: Menambah pt-20 atau pt-24 agar konten tidak tertutup header fixed.
        Bagian Header Profil juga diberikan padding lebih luas (py-16) supaya terlihat proporsional.
    --}}
    <div class="relative bg-blue-900 pt-32 pb-16 overflow-hidden border-b border-white/10 shadow-lg">
        {{-- Background Pattern Air Halus --}}
        <div class="absolute inset-0 opacity-10 bg-[url('{{ asset('images/water-pattern.png') }}')] bg-repeat"></div>
        <div class="absolute bottom-0 left-0 w-full h-1 bg-linear-to-r from-transparent via-yellow-500 to-transparent">
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tight drop-shadow-md">
                Struktur Organisasi
            </h1>
            <div class="flex items-center justify-center mt-3 space-x-3">
                <span class="h-[1.5px] w-6 bg-cyan-400 rounded-full"></span>
                <p class="text-blue-200 text-[10px] sm:text-xs font-bold uppercase tracking-[0.3em] opacity-80">
                    Dinas Cipta Karya & Sumber Daya Air
                </p>
                <span class="h-[1.5px] w-6 bg-cyan-400 rounded-full"></span>
            </div>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="bg-slate-50 min-h-screen py-12 lg:py-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_-20px_rgba(0,0,0,0.08)] border border-slate-200/60 p-8 sm:p-16">

                <div class="text-center mb-16">
                    <h2
                        class="text-2xl md:text-3xl font-black text-slate-900 uppercase tracking-tight inline-block relative">
                        Bagan Organisasi
                        <div class="absolute -bottom-5 left-1/2 -translate-x-1/2 h-1.5 w-12 bg-blue-600 rounded-full"></div>
                    </h2>
                </div>

                <div class="w-full bg-slate-50 border border-slate-200 rounded-4xl p-4 sm:p-10 mb-12 shadow-inner">
                    <div class="relative group cursor-zoom-in overflow-hidden rounded-2xl shadow-2xl border border-white">
                        @if($item->gambar_path)
                            <img src="{{ Storage::url($item->gambar_path) }}"
                                alt="Bagan Struktur Organisasi"
                                class="w-full h-auto transition-transform duration-1000 group-hover:scale-105">
                        @else
                            <img src="https://via.placeholder.com/1200x800.png?text=Bagan+belum+tersedia"
                                alt="Bagan Struktur Organisasi"
                                class="w-full h-auto opacity-40">
                        @endif

                        <div
                            class="absolute inset-0 bg-blue-950/0 group-hover:bg-blue-950/30 transition-all duration-500 flex items-center justify-center">
                            <span
                                class="bg-white text-blue-900 px-8 py-4 rounded-2xl font-black shadow-2xl opacity-0 group-hover:opacity-100 translate-y-8 group-hover:translate-y-0 transition-all duration-500 text-xs uppercase tracking-[0.2em] border border-blue-100">
                                Perbesar Bagan
                            </span>
                        </div>
                    </div>
                </div>

                <div class="prose prose-blue max-w-3xl mx-auto text-slate-600 text-center leading-relaxed font-semibold">
                    <p class="text-lg">
                        {{ $item->konten ?? 'Struktur Organisasi Dinas Cipta Karya dan Sumber Daya Air Provinsi Sulawesi Tengah ditetapkan berdasarkan peraturan daerah yang berlaku, guna menjamin terciptanya tata kelola instansi yang responsif dan akuntabel dalam pembangunan infrastruktur daerah.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
