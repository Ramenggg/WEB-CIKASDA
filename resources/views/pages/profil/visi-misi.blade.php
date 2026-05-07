@extends('layouts.app')

@section('content')
    {{-- HEADER SUPER MINIMALIS --}}
    <div class="relative bg-blue-900 py-10 overflow-hidden border-b border-white/10 shadow-lg">
        <div class="absolute inset-0 opacity-10 bg-[url('{{ asset('images/water-pattern.png') }}')] bg-repeat"></div>
        <div class="absolute bottom-0 left-0 w-full h-0.75 bg-linear-to-r from-transparent via-yellow-500 to-transparent">
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-black text-white uppercase tracking-tight drop-shadow-md">
                Visi dan Misi
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

                {{-- VISI --}}
                <div class="text-center mb-16">
                    <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight mb-8">Visi</h2>
                    <div
                        class="relative p-8 bg-linear-to-br from-blue-700 to-blue-900 rounded-3xl shadow-xl overflow-hidden group">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16 transition-transform duration-700 group-hover:scale-150">
                        </div>
                        <p class="relative z-10 text-xl md:text-2xl font-bold italic text-white leading-relaxed m-0">
                            "Terwujudnya infrastruktur Sulawesi Tengah yang maju, mandiri, dan berdaya saing melalui
                            pengelolaan Cipta Karya dan Sumber Daya Air yang berkelanjutan."
                        </p>
                    </div>
                </div>

                {{-- MISI --}}
                <div>
                    <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight text-center mb-10">Misi</h2>
                    <div class="space-y-4">
                        @php
                            $misi = [
                                'Meningkatkan kualitas infrastruktur dasar permukiman dan akses air minum layak.',
                                'Mewujudkan pengelolaan sumber daya air yang terpadu untuk mendukung ketahanan pangan dan air.',
                                'Meningkatkan kualitas penataan bangunan gedung dan lingkungan yang aman serta estetis.',
                                'Mendorong efektivitas birokrasi yang profesional dan berbasis teknologi informasi.',
                                'Mengoptimalkan peran serta masyarakat dalam pemeliharaan infrastruktur publik.',
                            ];
                        @endphp

                        @foreach ($misi as $index => $item)
                            <div
                                class="flex items-start p-5 bg-slate-50 border border-slate-100 rounded-2xl hover:border-blue-300 hover:bg-white hover:shadow-md transition-all duration-300">
                                <div
                                    class="shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-black text-sm shadow-md mr-4">
                                    {{ $index + 1 }}
                                </div>
                                <p class="text-base text-slate-700 font-medium m-0 leading-relaxed pt-1">
                                    {{ $item }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
