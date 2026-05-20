@extends('admin.layouts.app')

@section('title', 'Kelola Visi dan Misi')

@section('content')
    <div class="w-full bg-[#f8fafc] pb-12 animate-fade-in">

        <div
            class="w-full bg-white rounded-3xl shadow-[0_4px_30px_rgba(15,23,42,0.04)] border border-slate-200/80 overflow-hidden">

            <div
                class="p-6 border-b border-slate-100 bg-linear-to-r from-slate-50 via-white to-slate-50 flex justify-between items-center">
                <div class="flex items-center space-x-3.5">
                    <div
                        class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.813 15.904L9 21l8.944-8.944M18 10V4a2 2 0 00-2-2H4a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2v-5m-6-6h.01M6 6h.01M6 10h.01M6 14h.01" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 uppercase tracking-tight text-sm">Manajemen Visi & Misi</h4>
                        <p class="text-[11px] text-slate-500 font-medium mt-0.5">Konfigurasi naskah publik, infografis
                            gambar, dan berkas regulasi resmi.</p>
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

            <form action="{{ route('admin.profil.update', 'visi-misi') }}" method="POST" enctype="multipart/form-data"
                class="divide-y divide-slate-100">
                @csrf

                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div
                                class="h-7 w-7 rounded-lg bg-blue-50 border border-blue-200 text-blue-600 flex items-center justify-center font-black text-xs shadow-2xs">
                                01
                            </div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">
                                Narasi Visi & Misi (Format Teks)
                            </label>
                        </div>

                        <div class="flex items-center space-x-2">
                            @if (isset($item->konten) && !empty(trim($item->konten)) && $item->konten !== '<p><br></p>')
                                <button type="button" onclick="confirmDeleteSection('text')"
                                    class="text-[11px] bg-red-50 border border-red-200 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-md transition-all cursor-pointer">
                                    🗑️ Hapus Teks
                                </button>
                            @endif
                            <span
                                class="text-[10px] text-slate-400 font-extrabold uppercase tracking-wider bg-slate-100 rounded-md px-2 py-0.5 border border-slate-200/40">Opsional</span>
                        </div>
                    </div>

                    <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-2xs bg-white">
                        <div id="editor-cikasda">{!! old('konten', $item->konten ?? '') !!}</div>
                    </div>

                    <input type="hidden" name="konten" id="hidden-konten"
                        value="{{ old('konten', $item->konten ?? '') }}">
                </div>

                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div
                                class="h-7 w-7 rounded-lg bg-cyan-50 border border-cyan-200 text-cyan-600 flex items-center justify-center font-black text-xs shadow-2xs">
                                02
                            </div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">
                                Gambar / Infografis Visi Misi
                            </label>
                        </div>

                        <div class="flex items-center space-x-2">
                            @if (isset($item->gambar_path) && $item->gambar_path)
                                <button type="button" onclick="confirmDeleteSection('image')"
                                    class="text-[11px] bg-red-50 border border-red-200 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-md transition-all cursor-pointer">
                                    🗑️ Hapus Gambar
                                </button>
                            @endif
                            <span
                                class="text-[10px] text-slate-400 font-extrabold uppercase tracking-wider bg-slate-100 rounded-md px-2 py-0.5 border border-slate-200/40">Opsional</span>
                        </div>
                    </div>

                    <div
                        class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-slate-50/40 p-5 rounded-2xl border border-slate-200/50">
                        <div
                            class="lg:col-span-4 w-full aspect-video bg-white rounded-xl border border-slate-200 flex items-center justify-center overflow-hidden shadow-2xs shrink-0 group relative">
                            @if (isset($item->gambar_path) && $item->gambar_path)
                                <img id="preview-gambar" src="{{ Storage::url($item->gambar_path) }}"
                                    class="w-full h-full object-contain">
                            @else
                                <img id="preview-gambar" src="https://via.placeholder.com/400x250?text=Format+Infografis"
                                    class="w-full h-full object-contain opacity-20">
                            @endif
                        </div>

                        <div class="lg:col-span-8 w-full space-y-3.5">
                            <input type="file" name="gambar" onchange="previewImage(event)" accept="image/*"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-slate-900 file:text-white hover:file:bg-blue-600 file:transition-all file:cursor-pointer file:shadow-xs">

                            <div
                                class="bg-white p-4 rounded-xl border border-slate-200 text-[11px] text-slate-600 font-semibold leading-relaxed shadow-3xs">
                                <div class="flex items-center space-x-1.5 text-blue-700 font-bold mb-1">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span>STANDAR EKSTENSI BERKAS:</span>
                                </div>
                                Format Gambar Valid: <span class="text-slate-900 font-bold">PNG, JPG, JPEG, WEBP</span> •
                                Batas Maksimal Kapasitas: <span class="text-slate-900 font-bold">2 Megabytes (2MB)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div
                                class="h-7 w-7 rounded-lg bg-red-50 border border-red-200 text-red-600 flex items-center justify-center font-black text-xs shadow-2xs">
                                03
                            </div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">
                                Dokumen Lampiran (Format PDF Resmi)
                            </label>
                        </div>

                        <div class="flex items-center space-x-2">
                            @if (isset($item->pdf_path) && $item->pdf_path)
                                <button type="button" onclick="confirmDeleteSection('pdf')"
                                    class="text-[11px] bg-red-50 border border-red-200 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-md transition-all cursor-pointer">
                                    🗑️ Hapus Dokumen PDF
                                </button>
                            @endif
                            <span
                                class="text-[10px] text-slate-400 font-extrabold uppercase tracking-wider bg-slate-100 rounded-md px-2 py-0.5 border border-slate-200/40">Opsional</span>
                        </div>
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

                            @if (isset($item->pdf_path) && $item->pdf_path)
                                <div
                                    class="bg-white border border-emerald-200 p-3 rounded-xl flex items-center space-x-2.5 shadow-3xs">
                                    <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <a href="{{ Storage::url($item->pdf_path) }}" target="_blank"
                                        class="text-xs font-black text-emerald-700 hover:text-emerald-900 underline underline-offset-2 transition-all">
                                        Berkas Aktif: Lihat / Unduh Dokumen Lampiran PDF Visi Misi
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

            <form id="form-hapus-komponen" action="{{ route('admin.profil.update', 'visi-misi') }}" method="POST"
                class="hidden">
                @csrf
                <input type="hidden" name="target_hapus" id="input-target-hapus">
                {{-- Kita oper juga konten lama agar data lain tidak ter-reset saat tombol hapus ditekan --}}
                <input type="hidden" name="konten" id="hidden-konten-backup">
            </form>

        </div>
    </div>

    {{-- LEAVE STYLESHEET QUILL LAMA KAMU DI SINI --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <style>
        .ql-toolbar.ql-snow {
            @apply flex flex-row flex-nowrap items-center justify-start bg-slate-50 border border-slate-200 p-3 !important;
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
            scrollbar-width: none;
        }

        .ql-toolbar.ql-snow::-webkit-scrollbar {
            @apply hidden w-0 h-0 !important;
        }

        .ql-snow .ql-formats {
            @apply inline-flex items-center bg-white border border-slate-200/60 rounded-xl px-1.5 py-0.5 mr-1 shrink-0 !important;
        }

        .ql-snow .ql-toolbar button,
        .ql-snow.ql-toolbar button {
            @apply inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-800 transition-all duration-150 !important;
        }

        .ql-snow .ql-toolbar button:hover,
        .ql-snow.ql-toolbar button:hover {
            @apply bg-slate-100 text-blue-600 !important;
        }

        .ql-snow .ql-toolbar button.ql-active,
        .ql-snow.ql-toolbar button.ql-active {
            @apply bg-blue-50 text-blue-600 border border-blue-200/80 !important;
        }

        .ql-snow .ql-toolbar .ql-stroke {
            @apply text-slate-800 !important;
            stroke-width: 2.5 !important;
        }

        .ql-snow .ql-toolbar .ql-fill {
            @apply fill-slate-800 !important;
        }

        .ql-snow .ql-picker {
            @apply inline-flex items-center h-8 bg-white border border-slate-200 rounded-lg text-slate-900 text-xs font-black pl-2 pr-4 transition-all !important;
        }

        .ql-snow .ql-picker.ql-header {
            @apply w-24 !important;
        }

        .ql-snow .ql-picker-options {
            @apply bg-white border border-slate-200 rounded-xl shadow-xl p-1 z-[9999] !important;
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
            placeholder: 'Ketik dokumen naskah Visi & Misi Dinas di sini...',
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
            let input = event.target;
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-gambar').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // ==================================================================
        // ENGINE DOUBLE VERIFICATION DELETE HANDLER (MURNI JS SAKTI)
        // ==================================================================
        function confirmDeleteSection(type) {
            let namaKomponen = type === 'text' ? 'NARASI TEKS' : (type === 'image' ? 'GAMBAR INFOGRAFIS' :
                'DOKUMEN DOKUMEN PDF');

            // VERIFIKASI 1: Pertanyaan Dasar
            let check1 = confirm("Apakah Anda yakin ingin menghapus komponen " + namaKomponen + " Visi Misi?");

            if (check1) {
                // VERIFIKASI 2: Konfirmasi Serius Konkrit
                let check2 = confirm(
                    "⚠️ PERINGATAN KEDUA:\nTindakan ini bersifat PERMANEN dan akan langsung menghapus berkas di server Supabase.\n\nApakah Anda benar-benar serius?"
                    );

                if (check2) {
                    // Jalankan jembatan form bayangan
                    document.getElementById('input-target-hapus').value = type;
                    document.getElementById('hidden-konten-backup').value = quill.root.innerHTML;
                    document.getElementById('form-hapus-komponen').submit();
                }
            }
        }
    </script>
@endsection
