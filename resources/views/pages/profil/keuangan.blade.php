@extends('layouts.app')

@section('content')
    <x-profil-hero title="Transparansi Keuangan" :item="$item" :showContentInHero="false" description="Transparansi penuh pengelolaan Anggaran Pendapatan dan Belanja Daerah (APBD) serta realisasi keuangan makro lingkup Dinas Cipta Karya dan Sumber Daya Air." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-24">
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- Bagian Kiri: Konten Area (Sekitar 75%) --}}
            <div class="lg:w-3/4 flex flex-col gap-8">

                {{-- CARD: DOKUMEN DPPA & REALISASI ANGGARAN (ACCORDION) --}}
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
                    <div class="p-6 md:p-8 border-b border-slate-100 bg-gradient-to-r from-blue-50/50 via-white to-indigo-50/30">
                        <div class="flex items-center space-x-3">
                            <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg md:text-xl font-black text-slate-900 tracking-tight">Dokumen DPPA & Realisasi Anggaran</h2>
                                <p class="text-xs text-slate-500 font-medium mt-0.5">Daftar Pelaksanaan Perubahan Anggaran OPD</p>
                            </div>
                        </div>
                    </div>

                    {{-- Accordion Items --}}
                    @php
                        $accordionItems = [
                            ['num' => '01', 'label' => 'DPPA OPD 1 Sekretariat dan 4 Bidang Teknis', 'field' => 'primary_image_path', 'color' => 'blue'],
                            ['num' => '02', 'label' => 'DPPA OPD UPT Pengelolaan Sumber Daya Air Wilayah I', 'field' => 'secondary_image_path', 'color' => 'blue'],
                            ['num' => '03', 'label' => 'DPPA OPD UPT Pengelolaan Sumber Daya Air Wilayah II', 'field' => 'primary_document_path', 'color' => 'blue'],
                            ['num' => '04', 'label' => 'DPPA OPD Unit Pengelolaan Sistem Penyediaan Air Minum (SPAM)', 'field' => 'secondary_document_path', 'color' => 'blue'],
                            ['num' => '05', 'label' => 'Realisasi Anggaran', 'field' => 'extra_document_path', 'color' => 'emerald'],
                        ];
                    @endphp

                    <div class="divide-y divide-slate-100" x-data="{ openItem: null }">
                        @foreach ($accordionItems as $index => $acc)
                            @php $idx = $index + 1; @endphp
                            <div class="group">
                                <button type="button" @click="openItem = openItem === {{ $idx }} ? null : {{ $idx }}"
                                    class="w-full flex items-center justify-between px-6 md:px-8 py-5 text-left hover:bg-{{ $acc['color'] }}-50/30 transition-all duration-300 cursor-pointer">
                                    <div class="flex items-center space-x-4">
                                        <div class="h-8 w-8 rounded-lg flex items-center justify-center text-xs font-black shrink-0 transition-all duration-300"
                                            :class="openItem === {{ $idx }} ? 'bg-{{ $acc['color'] }}-600 text-white shadow-md shadow-{{ $acc['color'] }}-500/30' : 'bg-slate-100 text-slate-500 border border-slate-200'">
                                            {{ $acc['num'] }}
                                        </div>
                                        <h3 class="text-sm font-bold text-slate-800 group-hover:text-{{ $acc['color'] }}-700 transition-colors">{{ $acc['label'] }}</h3>
                                    </div>
                                    <svg class="w-5 h-5 text-slate-400 transition-transform duration-300 shrink-0 ml-4"
                                        :class="openItem === {{ $idx }} ? 'rotate-180 text-{{ $acc['color'] }}-600' : ''"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div x-show="openItem === {{ $idx }}" x-collapse x-cloak
                                    class="px-6 md:px-8 pb-6">
                                    <div class="bg-slate-50/80 border border-slate-100 rounded-2xl p-6">
                                        @if ($item && $item->{$acc['field']})
                                            <div class="space-y-4">
                                                <div class="w-full h-[500px] md:h-[600px] rounded-xl border border-slate-200 shadow-inner overflow-hidden bg-slate-100">
                                                    <iframe src="{{ Storage::url($item->{$acc['field']}) }}" class="w-full h-full" title="{{ $acc['label'] }}"></iframe>
                                                </div>
                                                <div class="flex justify-end">
                                                    <a href="{{ Storage::url($item->{$acc['field']}) }}" target="_blank"
                                                        class="shrink-0 bg-red-600 hover:bg-red-700 text-white font-bold text-xs uppercase tracking-wider px-5 py-3 rounded-xl shadow-md transition-all duration-200 hover:-translate-y-0.5 flex items-center space-x-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                        </svg>
                                                        <span>Buka di Tab Baru</span>
                                                    </a>
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-center py-8">
                                                <div class="w-16 h-16 bg-white rounded-full mx-auto flex items-center justify-center mb-3 border border-slate-200 shadow-sm">
                                                    <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                </div>
                                                <p class="text-slate-500 text-sm font-medium">Dokumen belum diunggah oleh administrator.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- CARD 2: KONTEN TAMBAHAN (Rich Text dari Admin, jika ada) --}}
                @if (isset($item->content_data) && !empty(trim(strip_tags($item->content_data))))
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 md:p-10 border border-slate-100">
                        <div class="text-center mb-8 relative">
                            <h2 class="text-lg md:text-xl font-black text-slate-900 uppercase tracking-tight inline-block relative pb-3">
                                Informasi Tambahan
                                <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-blue-600 rounded-full"></span>
                            </h2>
                        </div>
                        <div class="prose prose-slate max-w-none break-words text-slate-700 leading-relaxed font-medium prose-headings:font-black prose-headings:text-slate-900">
                            {!! $item->content_data !!}
                        </div>
                    </div>
                @endif

            </div>

            {{-- Bagian Kanan: Sekilas Dinas Sidebar (Sekitar 25%) --}}
            <div class="lg:w-1/4">
                <x-sekilas-dinas-sidebar />
            </div>

        </div>
    </div>
@endsection
