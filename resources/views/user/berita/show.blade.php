@extends('layouts.app')

@section('content')
    <section class="bg-slate-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
            <div class="flex items-center justify-between text-xs font-bold uppercase tracking-widest text-blue-600">
                <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 hover:text-blue-800 transition">
                    <span>&larr;</span>
                    Kembali ke Berita
                </a>
                <span class="bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full">{{ $berita->kategori }}</span>
            </div>

            <div class="space-y-2">
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">{{ $berita->judul }}</h1>
                <p class="text-sm text-slate-500 font-medium">
                    {{ $berita->created_at->translatedFormat('d F Y') }}
                </p>
            </div>

            @php
                $sampul = $berita->gambars->first();
                $galeriLain = $berita->gambars->slice(1);
            @endphp

            @if($sampul)
                <div class="rounded-3xl overflow-hidden border border-slate-200 shadow-sm bg-white">
                    <img src="{{ asset('storage/' . $sampul->file_path) }}"
                        alt="{{ $berita->judul }}"
                        class="w-full h-full object-cover">
                </div>
            @endif

            @if($galeriLain->isNotEmpty())
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($galeriLain as $gambar)
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-sm">
                            <img src="{{ asset('storage/' . $gambar->file_path) }}"
                                alt="{{ $berita->judul }}"
                                class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            @endif

            <article class="prose prose-slate max-w-none text-slate-700 prose-headings:text-slate-900 prose-headings:font-bold prose-img:rounded-2xl prose-img:shadow-md">
                {!! $berita->konten !!}
            </article>
        </div>
    </section>
@endsection
