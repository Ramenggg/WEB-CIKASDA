@extends('layouts.app')

@section('content')
    {{-- JUMBOTRON HEADER PREMIUM --}}
    <div class="relative w-full bg-slate-900 flex flex-col pt-32 pb-16 lg:pt-36 lg:pb-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/slider/slide1.png') }}" alt="Background CIKASDA"
                class="w-full h-full object-cover object-center grayscale-20">
            <div class="absolute inset-0 bg-slate-900/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/50 via-slate-900/90 to-slate-950"></div>
        </div>

        <div class="relative z-10 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 flex flex-col justify-end min-h-[140px]">
            <div class="flex items-center space-x-2 text-[10px] sm:text-xs font-black tracking-widest uppercase">
                <span class="text-slate-400">PROFIL</span> <span class="text-slate-500 font-medium">›</span> <span
                    class="text-blue-400">Kepatuhan LHKPN</span>
            </div>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight mt-3 mb-4 drop-shadow-md">
                Kepatuhan LHKPN</h1>
            <p class="text-slate-300 text-xs sm:text-sm md:text-base font-medium max-w-4xl leading-relaxed opacity-90">
                Bentuk transparansi integritas aparatur melalui laporan berkala kepatuhan LHKPN jajaran pejabat struktural
                wajib lapor KPK di lingkup Dinas CIKASDA.</p>
        </div>
    </div>

    {{-- KONTEN UTAMA MAC-STYLE --}}
    <div class="bg-slate-950 min-h-screen py-12 lg:py-20 -mt-1 relative z-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="w-full bg-white rounded-3xl shadow-[0_25px_60px_-15px_rgba(0,0,0,0.5)] border border-slate-800/20 overflow-hidden">

                <div class="px-6 py-4 bg-white border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center space-x-2 shrink-0">
                        <span class="w-3 h-3 rounded-full bg-red-400 block shadow-xs"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-400 block shadow-xs"></span>
                        <span class="w-3 h-3 rounded-full bg-green-400 block shadow-xs"></span>
                        <span
                            class="text-[11px] text-slate-400 font-bold uppercase tracking-wider pl-4 border-l border-slate-100 ml-2">DATA
                            INTEGRITAS LHKPN</span>
                    </div>
                    <div
                        class="flex items-center space-x-2 text-slate-500 font-extrabold text-[10px] sm:text-xs uppercase tracking-wider">
                        <span>DINAS CIPTA KARYA & SUMBER DAYA AIR</span>
                    </div>
                </div>

                <div class="text-center pt-12 pb-4">
                    <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight inline-block relative">
                        DAFTAR KEPATUHAN & TANDA TERIMA
                        <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 h-1 w-10 bg-blue-600 rounded-full"></div>
                    </h2>
                </div>

                <div class="p-8 sm:p-12 lg:p-16 pt-6 space-y-12">
                    @if (isset($item->konten) && !empty(trim($item->konten)) && $item->konten !== '<p><br></p>')
                        <div class="w-full">
                            <div
                                class="prose prose-slate max-w-none break-words text-slate-700 leading-relaxed font-medium prose-headings:font-black prose-headings:text-slate-900 prose-p:text-base sm:prose-p:text-lg">
                                {!! $item->konten !!}
                            </div>
                        </div>
                    @endif

                    @if (isset($item->konten) &&
                            !empty(trim($item->konten)) &&
                            $item->konten !== '<p><br></p>' &&
                            (($item->gambar_path && \Storage::disk('public')->exists($item->gambar_path)) ||
                                ($item->pdf_path && \Storage::disk('public')->exists($item->pdf_path))))
                        <hr class="border-slate-100 my-8">
                    @endif

                    {{-- GAMBAR FULL BINGKAI --}}
                    @if ($item->gambar_path && \Storage::disk('public')->exists($item->gambar_path))
                        <div class="w-full">
                            <div
                                class="relative group cursor-zoom-in overflow-hidden rounded-xl border-4 border-white shadow-lg w-full flex justify-center bg-white transition-all hover:shadow-xl hover:border-slate-100">
                                <img src="{{ asset('storage/' . $item->gambar_path) }}" alt="Infografis Kepatuhan LHKPN KPK"
                                    class="w-full h-auto max-h-[850px] object-cover mx-auto transition-transform duration-1000 group-hover:scale-[1.015]">
                                <div
                                    class="absolute inset-0 bg-blue-950/0 group-hover:bg-blue-950/15 transition-all duration-500 flex items-center justify-center">
                                    <span
                                        class="bg-white/95 backdrop-blur-xs text-blue-900 px-6 py-3 rounded-xl font-black shadow-xl opacity-0 group-hover:opacity-100 translate-y-3 group-hover:translate-y-0 transition-all duration-500 text-xs uppercase tracking-[0.2em] border border-blue-100">Perbesar
                                        Bukti Kepatuhan</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (
                        $item->gambar_path &&
                            \Storage::disk('public')->exists($item->gambar_path) &&
                            ($item->pdf_path && \Storage::disk('public')->exists($item->pdf_path)))
                        <hr class="border-slate-100 my-8">
                    @endif

                    @if ($item->pdf_path && \Storage::disk('public')->exists($item->pdf_path))
                        <div class="w-full">
                            <div
                                class="w-full bg-gradient-to-r from-red-50/50 via-slate-50 to-red-50/20 border border-slate-200 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xs">
                                <div
                                    class="flex items-center space-x-4 text-center sm:text-left flex-col sm:flex-row gap-4 sm:gap-0">
                                    <div
                                        class="h-14 w-14 bg-white border border-slate-200 rounded-xl flex items-center justify-center shrink-0 shadow-2xs">
                                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="text-base font-black text-slate-900 tracking-tight">Bundel Rekapitulasi
                                            Dokumen Laporan Kekayaan Pejabat</h5>
                                        <p class="text-xs text-slate-500 font-semibold mt-0.5">Unduh ikhtisar tanda terima
                                            LHKPN resmi format PDF.</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $item->pdf_path) }}" target="_blank"
                                    class="shrink-0 w-full sm:w-auto text-center bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-widest px-6 py-4 rounded-xl shadow-md transition-all duration-200 hover:-translate-y-0.5">Download
                                    PDF</a>
                            </div>
                        </div>
                    @endif

                    @if (
                        (!isset($item->konten) || empty(trim($item->konten)) || $item->konten === '<p><br></p>') &&
                            (!$item->gambar_path || !\Storage::disk('public')->exists($item->gambar_path)) &&
                            (!$item->pdf_path || !\Storage::disk('public')->exists($item->pdf_path)))
                        <div class="w-full text-center py-12">
                            <p class="text-slate-400 font-bold">Informasi LHKPN belum tersedia.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
