@extends('admin.layouts.app')

@section('title', 'Kelola Pejabat')

@section('content')
    <div class="w-full bg-[#f8fafc] pb-12 animate-fade-in">

        <div
            class="w-full bg-white rounded-3xl shadow-[0_4px_30px_rgba(15,23,42,0.04)] border border-slate-200/80 overflow-hidden">

            {{-- Header Panel --}}
            <div
                class="p-6 border-b border-slate-100 bg-linear-to-r from-slate-50 via-white to-slate-50 flex justify-between items-center">
                <div class="flex items-center space-x-3.5">
                    <div
                        class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 uppercase tracking-tight text-sm">Manajemen Profil Pejabat</h4>
                        <p class="text-[11px] text-slate-500 font-medium mt-0.5">Kelola daftar pimpinan, foto unsur pejabat,
                            dan SK penetapan jabatan resmi.</p>
                    </div>
                </div>
                <span
                    class="text-[10px] bg-blue-50 border border-blue-200 text-blue-700 font-black px-3 py-1 rounded-full uppercase tracking-wider">
                    Control Center
                </span>
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div
                    class="mx-8 mt-6 px-5 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-800 text-sm font-bold shadow-2xs flex items-center space-x-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.profil.update', 'pejabat') }}" method="POST" enctype="multipart/form-data"
                class="divide-y divide-slate-100">
                @csrf

                {{-- 01. TEKS --}}
                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div
                                class="h-7 w-7 rounded-lg bg-blue-50 border border-blue-200 text-blue-600 flex items-center justify-center font-black text-xs shadow-2xs">
                                01</div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">Daftar Nama &
                                Bio Pejabat (Teks)</label>
                        </div>
                        @if (isset($item->konten) && !empty(trim($item->konten)) && $item->konten !== '<p><br></p>')
                            <button type="button" onclick="confirmDeleteSection('text')"
                                class="text-[11px] bg-red-50 border border-red-200 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-md transition-all cursor-pointer">🗑️
                                Hapus Teks</button>
                        @endif
                    </div>
                    <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-2xs bg-white">
                        <div id="editor-cikasda">{!! old('konten', $item->konten ?? '') !!}</div>
                    </div>
                    <input type="hidden" name="konten" id="hidden-konten"
                        value="{{ old('konten', $item->konten ?? '') }}">
                </div>

                {{-- 02. GAMBAR --}}
                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div
                                class="h-7 w-7 rounded-lg bg-cyan-50 border border-cyan-200 text-cyan-600 flex items-center justify-center font-black text-xs shadow-2xs">
                                02</div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">Foto Unsur
                                Pimpinan / Struktur Pejabat</label>
                        </div>
                        @if (isset($item->gambar_path) && $item->gambar_path)
                            <button type="button" onclick="confirmDeleteSection('image')"
                                class="text-[11px] bg-red-50 border border-red-200 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-md transition-all cursor-pointer">🗑️
                                Hapus Gambar</button>
                        @endif
                    </div>
                    <div
                        class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-slate-50/40 p-5 rounded-2xl border border-slate-200/50">
                        <div
                            class="lg:col-span-4 w-full aspect-video bg-white rounded-xl border border-slate-200 flex items-center justify-center overflow-hidden shadow-2xs group relative">
                            <img id="preview-gambar"
                                src="{{ $item->gambar_path ? Storage::url($item->gambar_path) : 'https://via.placeholder.com/400x250?text=Foto+Unsur+Pimpinan' }}"
                                class="w-full h-full object-contain {{ $item->gambar_path ? '' : 'opacity-20' }}">
                        </div>
                        <div class="lg:col-span-8 w-full space-y-3.5">
                            <input type="file" name="gambar" onchange="previewImage(event)" accept="image/*"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-slate-900 file:text-white hover:file:bg-blue-600 file:transition-all file:cursor-pointer">
                            <div
                                class="bg-white p-4 rounded-xl border border-slate-200 text-[11px] text-slate-600 font-semibold leading-relaxed shadow-3xs text-blue-700 font-bold uppercase">
                                PNG, JPG, JPEG, WEBP • MAKS 2MB</div>
                        </div>
                    </div>
                </div>

                {{-- 03. PDF --}}
                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div
                                class="h-7 w-7 rounded-lg bg-red-50 border border-red-200 text-red-600 flex items-center justify-center font-black text-xs shadow-2xs">
                                03</div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">SK Penetapan
                                Pejabat (PDF)</label>
                        </div>
                        @if (isset($item->pdf_path) && $item->pdf_path)
                            <button type="button" onclick="confirmDeleteSection('pdf')"
                                class="text-[11px] bg-red-50 border border-red-200 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-md transition-all cursor-pointer">🗑️
                                Hapus PDF</button>
                        @endif
                    </div>
                    <div
                        class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center bg-slate-50/40 p-5 rounded-2xl border border-slate-200/50">
                        <div
                            class="lg:col-span-1 h-12 w-12 bg-white border border-slate-200 rounded-xl flex items-center justify-center mx-auto shadow-2xs text-red-600 font-bold">
                            PDF</div>
                        <div class="lg:col-span-11 w-full space-y-3">
                            <input type="file" name="pdf_file" accept=".pdf"
                                class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-red-600 file:text-white hover:file:bg-red-700 file:transition-all file:cursor-pointer">
                            @if (isset($item->pdf_path) && $item->pdf_path)
                                <div
                                    class="bg-white border border-emerald-200 p-3 rounded-xl flex items-center space-x-2.5 shadow-3xs text-emerald-700 font-bold text-xs underline decoration-emerald-300 underline-offset-4">
                                    <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <a href="{{ Storage::url($item->pdf_path) }}" target="_blank">Lihat Berkas SK Pejabat
                                        Aktif</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-slate-50/50 flex items-center justify-end border-t border-slate-100">
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-14 py-3.5 rounded-xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 shadow-md shadow-blue-600/20 active:scale-98 cursor-pointer">Simpan
                        Perubahan</button>
                </div>
            </form>

            {{-- Form Hapus Bayangan --}}
            <form id="form-hapus-komponen" action="{{ route('admin.profil.update', 'pejabat') }}" method="POST"
                class="hidden">
                @csrf
                <input type="hidden" name="target_hapus" id="input-target-hapus">
                <input type="hidden" name="konten" id="hidden-konten-backup">
            </form>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <style>
        .ql-toolbar.ql-snow {
            @apply flex flex-row flex-nowrap items-center justify-start bg-slate-50 border border-slate-200 p-3 !important;
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
            scrollbar-width: none;
        }

        .ql-container.ql-snow {
            @apply border border-slate-200 bg-white !important;
            border-bottom-left-radius: 1rem !important;
            border-bottom-right-radius: 1rem !important;
        }

        #editor-cikasda {
            @apply min-h-[250px] text-base leading-relaxed text-slate-900 p-6 !important;
            font-family: ui-sans-serif, system-ui, sans-serif !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        var quill = new Quill('#editor-cikasda', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'blockquote'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    ['link'],
                    ['clean']
                ]
            }
        });
        quill.on('text-change', function() {
            document.getElementById('hidden-konten').value = quill.root.innerHTML;
        });

        function previewImage(event) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById('preview-gambar');
                preview.src = e.target.result;
                preview.classList.remove('opacity-20');
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function confirmDeleteSection(type) {
            if (confirm("Yakin hapus komponen ini?") && confirm(
                    "⚠️ TINDAKAN PERMANEN!\nBerkas di Supabase akan dihapus. Lanjutkan?")) {
                document.getElementById('input-target-hapus').value = type;
                document.getElementById('hidden-konten-backup').value = quill.root.innerHTML;
                document.getElementById('form-hapus-komponen').submit();
            }
        }
    </script>
@endsection
