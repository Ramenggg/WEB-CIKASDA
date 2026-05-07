@extends('layouts.app')

@section('content')
    {{-- HEADER SUPER MINIMALIS --}}
    <div class="relative bg-blue-900 py-10 overflow-hidden border-b border-white/10 shadow-lg">
        <div class="absolute inset-0 opacity-10 bg-[url('{{ asset('images/water-pattern.png') }}')] bg-repeat"></div>
        <div class="absolute bottom-0 left-0 w-full h-0.75 bg-linear-to-r from-transparent via-yellow-500 to-transparent">
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-black text-white uppercase tracking-tight drop-shadow-md">
                Tugas dan Fungsi
            </h1>
            <div class="flex items-center justify-center mt-2 space-x-2">
                <span class="h-[1.5px] w-4 bg-cyan-400 rounded-full"></span>
                <p class="text-blue-200 text-[10px] sm:text-xs font-bold uppercase tracking-[0.3em] opacity-80">
                    Dinas Cipta Karya & Sumber Daya Air
                </p>
                <span class="h-[1.5px] w-4 bg-cyan-400 rounded-full"></span>
            </div>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="bg-slate-50 min-h-screen py-12 lg:py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-white rounded-3xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-slate-200/60 p-8 sm:p-12 lg:p-16">

                {{-- TUGAS POKOK --}}
                <div class="mb-12">
                    <h3 class="text-blue-900 font-bold mb-4 flex items-center justify-center sm:justify-start">
                        <span class="bg-blue-100 text-blue-700 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                        Tugas Pokok
                    </h3>
                    <p class="text-slate-600 leading-relaxed text-justify sm:text-left font-medium">
                        Dinas Cipta Karya dan Sumber Daya Air mempunyai tugas pokok melaksanakan urusan pemerintahan daerah
                        provinsi di bidang pekerjaan umum dan penataan ruang, khususnya pada sub urusan sumber daya air, air
                        minum, persampahan, air limbah, drainase, permukiman, dan bangunan gedung.
                    </p>
                </div>

                {{-- FUNGSI --}}
                <div>
                    <h3 class="text-blue-900 font-bold mb-6 flex items-center justify-center sm:justify-start">
                        <span class="bg-blue-100 text-blue-700 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                        </span>
                        Fungsi
                    </h3>

                    <div class="grid gap-4">
                        @php
                            $fungsi = [
                                'Perumusan kebijakan teknis di bidang cipta karya dan sumber daya air.',
                                'Pelaksanaan kebijakan dan program pembangunan infrastruktur daerah.',
                                'Pembinaan teknis penataan kawasan permukiman dan bangunan gedung.',
                                'Pemantauan, evaluasi, dan pelaporan pelaksanaan tugas infrastruktur.',
                                'Penyelenggaraan administrasi kesekretariatan dinas.',
                            ];
                        @endphp

                        @foreach ($fungsi as $f)
                            <div
                                class="group flex items-center p-4 bg-slate-50 border border-slate-100 rounded-xl hover:bg-white hover:shadow-sm transition-all">
                                <div
                                    class="w-2 h-2 bg-blue-400 rounded-full mr-4 group-hover:scale-150 transition-transform">
                                </div>
                                <p class="text-slate-700 text-sm font-medium">{{ $f }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
