@extends('layouts.app')

@section('content')
    <x-profil-hero title="Sejarah Instansi" :item="$item" :showContentInHero="false" description="Menelusuri rekam jejak, sejarah pembentukan, hingga transformasi panjang Dinas Cipta Karya dan Sumber Daya Air Provinsi Sulawesi Tengah." />

    {{-- KONTEN UTAMA OVERLAPPING HERO (Single Column Design) --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 pb-24">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-8 md:p-12 lg:p-16 border border-slate-100">
            @if (isset($item->content_data) && !empty(trim(strip_tags($item->content_data))))
                <div class="prose prose-slate prose-p:mb-6 prose-p:leading-loose text-slate-700 text-sm md:text-base max-w-none [&_*]:!bg-transparent text-justify
                            prose-headings:text-slate-900 prose-headings:font-bold prose-img:rounded-2xl prose-img:shadow-md prose-img:w-full prose-img:mb-6 prose-img:object-cover">
                    {!! $item->content_data !!}
                </div>
            @else
                <div class="w-full flex flex-col items-center justify-center py-16">
                    <div class="w-24 h-24 mb-6 bg-slate-50 rounded-full border border-slate-200 flex items-center justify-center mx-auto shadow-sm">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700 mb-2">Sejarah Belum Tersedia</h3>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-md text-center">Informasi mengenai sejarah instansi akan ditampilkan setelah diunggah oleh administrator.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
