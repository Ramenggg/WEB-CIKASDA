@extends('admin.layouts.app')

@section('title', 'Kelola Transparansi Keuangan')

@section('content')
    <div class="w-full bg-[#f8fafc] pb-12 animate-fade-in">

        <div
            class="w-full bg-white rounded-3xl shadow-[0_4px_30px_rgba(15,23,42,0.04)] border border-slate-200/80 overflow-hidden">

            {{-- Header Panel Premium --}}
            <div
                class="p-6 border-b border-slate-100 bg-linear-to-r from-slate-50 via-white to-slate-50 flex justify-between items-center">
                <div class="flex items-center space-x-3.5">
                    <div
                        class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 uppercase tracking-tight text-sm">Manajemen Dokumen DPPA & Realisasi Anggaran</h4>
                        <p class="text-[11px] text-slate-500 font-medium mt-0.5">Kelola dokumen PDF keuangan untuk setiap accordion di halaman publik.</p>
                    </div>
                </div>
                <span
                    class="text-[10px] bg-blue-50 border border-blue-200 text-blue-700 font-black px-3 py-1 rounded-full uppercase tracking-wider">
                    5 Accordion
                </span>
            </div>

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div
                    class="mx-8 mt-6 px-5 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-800 text-sm font-bold shadow-2xs flex items-center space-x-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Panduan --}}
            <div class="mx-8 mt-6 px-5 py-4 bg-blue-50/50 border border-blue-100 rounded-2xl text-blue-800 text-xs font-semibold leading-relaxed">
                <span class="font-black uppercase tracking-wider">ℹ️ Panduan:</span> Upload file PDF untuk masing-masing accordion DPPA yang tampil di halaman publik Transparansi Keuangan.
            </div>

            <form action="{{ route('admin.profil.update', 'keuangan') }}" method="POST" enctype="multipart/form-data"
                class="divide-y divide-slate-100">
                @csrf

                {{-- HERO DESCRIPTION --}}
                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex items-center space-x-3">
                        <div class="h-7 w-7 rounded-lg bg-indigo-50 border border-indigo-200 text-indigo-600 flex items-center justify-center font-black text-xs shadow-2xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">Deskripsi Singkat Banner (Hero)</label>
                            <span class="text-[10px] text-slate-400 font-semibold">Teks ini tampil di area hero/banner halaman publik</span>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 shadow-2xs bg-white overflow-hidden">
                        <div id="editor-hero">{{ old('hero_description', $item->hero_description ?? '') }}</div>
                    </div>
                    <input type="hidden" name="hero_description" id="hidden-hero"
                        value="{{ old('hero_description', $item->hero_description ?? '') }}">
                </div>

                {{-- ============================================================ --}}
                {{-- PDF 1: DPPA OPD 1 Sekretariat --}}
                {{-- ============================================================ --}}
                @php
                    $accordions = [
                        ['num' => '01', 'label' => 'DPPA OPD 1 Sekretariat dan 4 Bidang Teknis', 'field' => 'primary_image_path', 'input' => 'gambar', 'delete' => 'image', 'color' => 'red'],
                        ['num' => '02', 'label' => 'DPPA OPD UPT Pengelolaan SDA Wilayah I', 'field' => 'secondary_image_path', 'input' => 'gambar_2', 'delete' => 'image_2', 'color' => 'red'],
                        ['num' => '03', 'label' => 'DPPA OPD UPT Pengelolaan SDA Wilayah II', 'field' => 'primary_document_path', 'input' => 'pdf_file', 'delete' => 'pdf', 'color' => 'red'],
                        ['num' => '04', 'label' => 'DPPA OPD Unit Pengelolaan SPAM', 'field' => 'secondary_document_path', 'input' => 'pdf_file_2', 'delete' => 'pdf_2', 'color' => 'red'],
                        ['num' => '05', 'label' => 'Realisasi Anggaran', 'field' => 'extra_document_path', 'input' => 'pdf_file_3', 'delete' => 'pdf_3', 'color' => 'red'],
                    ];
                @endphp

                @foreach ($accordions as $acc)
                    <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-3">
                                <div class="h-7 w-7 rounded-lg bg-{{ $acc['color'] }}-50 border border-{{ $acc['color'] }}-200 text-{{ $acc['color'] }}-600 flex items-center justify-center font-black text-xs shadow-2xs">●</div>
                                <div>
                                    <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">{{ $acc['label'] }}</label>
                                    <span class="text-[10px] text-slate-400 font-semibold">Accordion #{{ $acc['num'] }} di halaman publik → PDF</span>
                                </div>
                            </div>
                            @if (isset($item->{$acc['field']}) && $item->{$acc['field']})
                                <button type="button" onclick="confirmDeleteSection('{{ $acc['delete'] }}')"
                                    class="text-[11px] bg-red-50 border border-red-200 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-md transition-all cursor-pointer">Hapus PDF</button>
                            @endif
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center bg-slate-50/40 p-5 rounded-2xl border border-slate-200/50">
                            <div class="lg:col-span-1 h-12 w-12 bg-white border border-slate-200 rounded-xl flex items-center justify-center mx-auto shadow-2xs text-red-600 font-bold text-xs">PDF</div>
                            <div class="lg:col-span-11 w-full space-y-3">
                                <input type="file" name="{{ $acc['input'] }}" accept=".pdf"
                                    class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-red-600 file:text-white hover:file:bg-red-700 file:transition-all file:cursor-pointer">
                                @if (isset($item->{$acc['field']}) && $item->{$acc['field']})
                                    <div class="bg-white border border-emerald-200 p-3 rounded-xl flex items-center space-x-2.5 shadow-3xs text-emerald-700 font-bold text-xs underline decoration-emerald-300 underline-offset-4">
                                        <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <a href="{{ Storage::url($item->{$acc['field']}) }}" target="_blank">Lihat Berkas PDF Aktif — {{ $acc['label'] }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="p-6 bg-slate-50/50 flex items-center justify-end border-t border-slate-100">
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-14 py-3.5 rounded-xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 shadow-md shadow-blue-600/20 active:scale-98 cursor-pointer">Simpan
                        Perubahan</button>
                </div>
            </form>

            {{-- Form Hapus Komponen Tersembunyi --}}
            <form id="form-hapus-komponen" action="{{ route('admin.profil.update', 'keuangan') }}" method="POST"
                class="hidden">
                @csrf
                <input type="hidden" name="target_hapus" id="input-target-hapus">
            </form>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        var quillHero = new Quill('#editor-hero', {
            theme: 'snow',
            placeholder: 'Ketik deskripsi singkat untuk banner hero halaman publik...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });
        quillHero.on('text-change', function() {
            document.getElementById('hidden-hero').value = quillHero.root.innerHTML;
        });

        function confirmDeleteSection(type) {
            const names = {
                'image': 'DPPA OPD 1 Sekretariat (PDF)',
                'image_2': 'DPPA UPT SDA Wilayah I (PDF)',
                'pdf': 'DPPA UPT SDA Wilayah II (PDF)',
                'pdf_2': 'DPPA Unit SPAM (PDF)',
                'pdf_3': 'Realisasi Anggaran (PDF)'
            };
            let namaKomponen = names[type] || type;
            let check1 = confirm("Apakah Anda yakin ingin menghapus dokumen " + namaKomponen + "?");
            if (check1) {
                let check2 = confirm(
                    "⚠️ PERINGATAN KEDUA:\nTindakan ini bersifat PERMANEN dan akan langsung menghapus berkas di server Supabase.\n\nApakah Anda benar-benar serius?"
                );
                if (check2) {
                    document.getElementById('input-target-hapus').value = type;
                    document.getElementById('form-hapus-komponen').submit();
                }
            }
        }
    </script>
@endsection
