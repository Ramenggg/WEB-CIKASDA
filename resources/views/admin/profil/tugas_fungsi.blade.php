@extends('admin.layouts.app')

@section('title', 'Kelola Tugas dan Fungsi')

@section('content')
    <div class="w-full pb-12 animate-fade-in">

        <div
            class="w-full bg-white/90 backdrop-blur-md rounded-3xl shadow-[0_4px_30px_rgba(15,23,42,0.04)] border border-slate-200/80 overflow-hidden">

            <div
                class="p-6 border-b border-slate-100 bg-linear-to-r from-slate-50 via-white to-slate-50 flex justify-between items-center">
                <div class="flex items-center space-x-3.5">
                    <div
                        class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M6 16h.01" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 uppercase tracking-tight text-sm">Manajemen Tugas & Fungsi</h4>
                        <p class="text-[11px] text-slate-500 font-medium mt-0.5">Konfigurasi naskah regulasi dan berkas tupoksi resmi.</p>
                    </div>
                </div>
                <span
                    class="text-[10px] bg-blue-50 border border-blue-200 text-blue-700 font-black px-3 py-1 rounded-full uppercase tracking-wider">
                    Control Center
                </span>
            </div>

            {{-- Notifikasi Sukses / Hapus --}}
            @if (session('success'))
                <div
                    class="mx-8 mt-6 px-5 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-800 text-sm font-bold shadow-2xs flex items-center space-x-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mx-8 mt-6 px-5 py-4 bg-red-50 border border-red-100 rounded-2xl text-red-800 text-sm font-bold shadow-2xs">
                    <div class="flex items-center space-x-2 mb-2 text-red-900 font-extrabold uppercase tracking-wide text-xs">
                        ⚠️ Gagal Menyimpan:
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.profil.update', 'tugas-fungsi') }}" method="POST" enctype="multipart/form-data"
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

                {{-- PDF UPLOAD SECTION --}}
                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div
                                class="h-7 w-7 rounded-lg bg-red-50 border border-red-200 text-red-600 flex items-center justify-center font-black text-xs shadow-2xs">
                                ●
                            </div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">
                                Dokumen Tugas & Fungsi (Format PDF)
                            </label>
                        </div>

                        @if (isset($item->primary_document_path) && $item->primary_document_path)
                            <button type="button" onclick="confirmDeleteSection('pdf')"
                                class="text-[11px] bg-red-50 border border-red-200 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-md transition-all cursor-pointer">
                                Hapus PDF
                            </button>
                        @endif
                    </div>

                    <div
                        class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center bg-slate-50/40 p-5 rounded-2xl border border-slate-200/50">
                        <div
                            class="lg:col-span-1 h-12 w-12 bg-white border border-slate-200 rounded-xl flex items-center justify-center mx-auto shadow-2xs">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <div class="lg:col-span-11 w-full space-y-3">
                            <input type="file" name="pdf_file" accept=".pdf"
                                class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-red-600 file:text-white hover:file:bg-red-700 file:transition-all file:cursor-pointer file:shadow-xs">

                            @if (isset($item->primary_document_path) && $item->primary_document_path)
                                <div
                                    class="bg-white border border-emerald-200 p-3 rounded-xl flex items-center space-x-2.5 shadow-3xs">
                                    <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <a href="{{ Storage::url($item->primary_document_path) }}" target="_blank"
                                        class="text-xs font-black text-emerald-700 hover:text-emerald-900 underline underline-offset-2 transition-all">
                                        Berkas Aktif: Lihat / Unduh Dokumen Tugas & Fungsi PDF
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-slate-50/50 flex items-center justify-end border-t border-slate-100">
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-14 py-3.5 rounded-xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 shadow-md shadow-blue-600/20 active:scale-98 cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

            <form id="form-hapus-komponen" action="{{ route('admin.profil.update', 'tugas-fungsi') }}" method="POST"
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
            let namaKomponen = type === 'text' ? 'URAIAN TEKS' : 'BERKAS PDF';
            let check1 = confirm("Apakah Anda yakin ingin menghapus komponen " + namaKomponen + " Tugas Fungsi?");
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
