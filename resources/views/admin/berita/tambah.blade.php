@extends('admin.layouts.app')

@section('title', 'Tulis Berita Baru')

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.css" rel="stylesheet">

<style>
    /* ==================================================================
       ROMBAK QUILL TOOLBAR MENGGUNAKAN UTILITY TAILWIND CSS (1 BARIS LURUS)
       ================================================================== */

    /* 1. Wadah Utama Toolbar Atas */
    .ql-toolbar.ql-snow {
        @apply flex flex-row flex-nowrap items-center justify-start bg-slate-50 border border-slate-200 gap-0.5 overflow-x-auto rounded-t-3xl p-2 !important;
        scrollbar-width: none;
    }

    .ql-toolbar.ql-snow::-webkit-scrollbar {
        @apply hidden w-0 h-0 !important;
    }

    /* 2. Kapsul Kelompok Tombol Menu */
    .ql-snow .ql-formats {
        @apply inline-flex items-center bg-white border border-slate-100 rounded-xl px-1 py-0.5 mr-0.5 shrink-0 !important;
    }

    /* 3. Tombol Aksi Kapsul Bulat */
    .ql-snow .ql-toolbar button,
    .ql-snow.ql-toolbar button {
        @apply inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-600 transition-all duration-200 !important;
    }

    /* Efek Hover & Aktif Tombol */
    .ql-snow .ql-toolbar button:hover,
    .ql-snow.ql-toolbar button:hover {
        @apply bg-slate-100 text-blue-600 -translate-y-0.5 !important;
    }

    .ql-snow .ql-toolbar button.ql-active,
    .ql-snow.ql-toolbar button.ql-active {
        @apply bg-blue-50 text-blue-600 border border-blue-200 !important;
    }

    /* Ketebalan Garis Grid Ikon */
    .ql-snow .ql-toolbar .ql-stroke {
        @apply text-current !important;
        stroke-width: 2.4 !important;
    }

    .ql-snow .ql-toolbar .ql-fill {
        @apply fill-current !important;
    }

    /* 4. Dropdown Pilihan Ukuran Teks (Header) */
    .ql-snow .ql-picker {
        @apply inline-flex items-center h-8 bg-white border border-slate-200 rounded-lg text-slate-700 text-xs font-bold pl-2 pr-4 transition-all duration-200 !important;
    }

    .ql-snow .ql-picker:hover {
        @apply bg-slate-50 border-slate-300 !important;
    }

    .ql-snow .ql-picker.ql-header {
        @apply w-24 !important;
    }

    .ql-snow .ql-picker-options {
        @apply bg-white border border-slate-200 rounded-xl shadow-lg p-1 z-[9999] !important;
    }

    /* ==================================================================
       MURNI KOTAK KETIK EDITOR (SANS-SERIF KUNCI & TINGGI LEGA)
       ================================================================== */
    .ql-container.ql-snow {
        @apply border border-slate-200 border-t-0 rounded-b-3xl !important;
    }

    #editor-cikasda {
        @apply min-h-[500px] text-base leading-relaxed text-slate-700 !important;
        /* KUNCI: Menggunakan tumpukan font Sans-Serif bawaan Tailwind */
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
    }

    /* ==================================================================
       STYLE PREMIUM INPUT JUDUL BERITA (SINKRON SANS-SERIF DENGAN ISI)
       ================================================================== */
    #input-judul {
        @apply font-extrabold tracking-tight text-slate-900 border border-slate-200 bg-white transition-all duration-300 !important;
        /* KUNCI: Font judul disamakan persis dengan sistem font Sans-Serif isi berita */
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    }

    #input-judul:focus {
        @apply border-blue-600 ring-4 ring-blue-600/10 bg-white !important;
    }

    /* ==================================================================
       PERBAIKAN SELEKTOR UTAMANYA (MENEMBUS FORMAT INTERNAL QUILL)
       ================================================================== */

    /* 1. Mengatur Gambar di Dalam Editor Ketik (Sisi Kiri) */
    /* KUNCI: Kita tembak langsung ke class .ql-editor bawaan Quill */
    .ql-container .ql-editor img {
        @apply rounded-2xl mt-5 mb-4 mx-auto block object-cover transition-all duration-300 shadow-sm !important;
        max-width: 100% !important;
        height: auto !important;
    }

    /* 2. Mengatur Gambar di Dalam Panel Live Preview (Sisi Kanan) */
    /* KUNCI: Kita tambahkan 'block' agar mx-auto (rata tengah)-nya bekerja */
    #preview-konten-cikasda img {
        @apply rounded-2xl mt-5 mb-4 mx-auto block object-cover max-w-full h-auto shadow-sm !important;
    }
</style>

@section('content')
    {{-- Load CSS Quill Word Editor --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

    <style>
        /* ATURAN TINGGI KOTAK EDITOR */
        #editor-cikasda {
            min-height: 500px !important;
            font-size: 16px;
        }

        /* FORMAT FONT DI TOOLBAR DROPDOWN */
        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="arial"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="arial"]::before {
            content: 'Arial';
            font-family: 'Arial', sans-serif;
        }

        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="times-new-roman"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="times-new-roman"]::before {
            content: 'Times New Roman';
            font-family: 'Times New Roman', serif;
        }

        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="courier-new"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="courier-new"]::before {
            content: 'Courier New';
            font-family: 'Courier New', monospace;
        }

        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="georgia"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="georgia"]::before {
            content: 'Georgia';
            font-family: 'Georgia', serif;
        }

        .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="comic-sans"]::before,
        .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="comic-sans"]::before {
            content: 'Comic Sans';
            font-family: 'Comic Sans MS', cursive;
        }

        /* RENDER STYLE FONT */
        .ql-font-arial {
            font-family: 'Arial', sans-serif !important;
        }

        .ql-font-times-new-roman {
            font-family: 'Times New Roman', serif !important;
        }

        .ql-font-courier-new {
            font-family: 'Courier New', monospace !important;
        }

        .ql-font-georgia {
            font-family: 'Georgia', serif !important;
        }

        .ql-font-comic-sans {
            font-family: 'Comic Sans MS', cursive !important;
        }
    </style>

    <div class="max-w-7xl mx-auto pb-16">

        {{-- HEADER HALAMAN --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-slate-200 pb-6 mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Buat Artikel Berita</h1>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide mt-1">Sistem Input Media Terintegrasi</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.dashboard') }}"
                    class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase tracking-widest rounded-xl transition border border-slate-200/60">
                    Batal
                </a>
                <button type="submit" form="form-tambah-berita"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase tracking-[0.15em] rounded-xl transition shadow-lg shadow-blue-600/20">
                    Terbitkan Berita
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">

            {{-- ==========================================
             KOLOM KIRI: FORM ENTRI DATA (7 Kolom)
             ========================================== --}}
            <div class="xl:col-span-7 space-y-6">
                <form id="form-tambah-berita" action="{{ route('admin.berita.simpan') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- Input Hidden untuk Konten Quill --}}
                    <input type="hidden" id="hidden-konten" name="konten">

                    {{-- Input Teks Berita --}}
                    <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-6">
                        {{-- Judul Berita --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Judul Artikel /
                                Berita</label>
                            <input type="text" id="input-judul" name="judul" required
                                placeholder="Masukkan judul berita yang menarik..."
                                class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-bold text-slate-800 text-lg placeholder:font-normal placeholder:text-slate-400"
                                oninput="updateJudulPreview(this.value)">
                        </div>

                        {{-- Isi Berita Menggunakan Quill --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Isi Berita (Bisa
                                Sisip Gambar & Atur Paragraf)</label>
                            <div class="rounded-2xl border border-slate-200 overflow-hidden shadow-inner">
                                <div id="editor-cikasda" class="text-slate-700 bg-white"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Blok Kategori & Status --}}
                    <div
                        class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[11px] font-black text-slate-500 uppercase tracking-wider">Kategori
                                Berita</label>
                            <select id="select-kategori" name="kategori" required
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 font-bold text-slate-700 text-xs uppercase tracking-wide cursor-pointer bg-white"
                                onchange="updateKategoriPreview(this.value)">
                                <option value="Infrastruktur">Infrastruktur</option>
                                <option value="Sumber Daya Air">Sumber Daya Air</option>
                                <option value="Cipta Karya">Cipta Karya</option>
                                <option value="Kegiatan Dinas">Kegiatan Dinas</option>
                                <option value="Pengumuman">Pengumuman</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[11px] font-black text-slate-500 uppercase tracking-wider">Status
                                Tampilan</label>
                            <select id="select-status" name="status"
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 font-bold text-slate-700 text-xs uppercase tracking-wide cursor-pointer bg-white"
                                onchange="updateStatusPreview(this.value)">
                                <option value="Publish">Langsung Terbitkan</option>
                                <option value="Draft">Simpan Sebagai Draft</option>
                            </select>
                        </div>
                    </div>

                    {{-- INPUT GAMBAR SAMPUL MURNI HTML --}}
                    <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-4">
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Foto Sampul
                                Utama</label>
                            <p class="text-[11px] text-slate-500 font-bold mt-0.5">Pilih foto terbaik untuk cover depan
                                berita (Maks. 3MB).</p>
                        </div>

                        <label for="file-input-cikasda"
                            class="relative block border-2 border-dashed border-slate-200 hover:border-blue-500 rounded-2xl p-8 text-center cursor-pointer bg-slate-50/50 group">
                            <input type="file" id="file-input-cikasda" name="images[]" accept="image/*" class="hidden"
                                onchange="previewSampulUser(event)">
                            <div class="space-y-2 flex flex-col items-center">
                                <div
                                    class="p-4 bg-white rounded-2xl shadow-sm text-slate-400 group-hover:text-blue-600 border border-slate-100 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-sm font-bold text-slate-700">Klik di sini untuk memilih foto sampul</p>
                            </div>
                        </label>
                    </div>
                </form>
            </div>

            {{-- ==========================================
             KOLOM KANAN: LIVE PRATINJAU USER (5 Kolom)
             ========================================== --}}
            <div class="xl:col-span-5 space-y-4 xl:sticky xl:top-6">
                <div class="flex items-center gap-2 px-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <h4 class="text-xs font-black text-slate-500 uppercase tracking-widest">Live Preview Tampilan User</h4>
                </div>

                <div
                    class="bg-white rounded-[2rem] border border-slate-200/90 shadow-xl overflow-hidden flex flex-col transition-all duration-300">

                    {{-- AREA GAMBAR PREVIEW UTAMA --}}
                    <div
                        class="aspect-video w-full bg-slate-100 overflow-hidden relative border-b border-slate-100 flex items-center justify-center">
                        {{-- Element Image Rekayasa DOM --}}
                        <img id="preview-gambar-user" src="" class="w-full h-full object-cover hidden">

                        {{-- Placeholder Awal --}}
                        <div id="preview-gambar-placeholder"
                            class="w-full h-full flex flex-col items-center justify-center text-slate-300 gap-1.5 bg-slate-50/50">
                            <svg class="w-8 h-8 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">Pratinjau Foto
                                Sampul</span>
                        </div>

                        {{-- Badge Kategori --}}
                        <span id="preview-kategori-user"
                            class="absolute bottom-4 left-4 bg-slate-900/80 backdrop-blur-md text-white font-black text-[9px] uppercase tracking-widest px-3 py-1.5 rounded-xl shadow-sm">
                            Infrastruktur
                        </span>
                    </div>

                    {{-- AREA KONTEN PREVIEW UTAMA --}}
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-white">
                        <div class="space-y-2.5">
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                                19 May 2026
                            </div>

                            {{-- Judul Preview --}}
                            <h2 id="preview-judul-user"
                                class="text-xl font-normal italic text-slate-300 leading-snug tracking-tight break-words min-h-[3.5rem]">
                                Judul berita Anda...
                            </h2>

                            {{-- Isi Konten Preview --}}
                            <div id="preview-konten-cikasda"
                                class="text-sm font-normal italic text-slate-300 leading-relaxed overflow-hidden min-h-[6rem] prose prose-slate max-w-none break-words prose-img:rounded-xl prose-img:max-h-48 prose-img:object-cover prose-img:my-2">
                                Isi teks dan gambar yang Anda susun di editor sebelah kiri akan dirender di sini...
                            </div>
                        </div>

                        {{-- Footer Preview --}}
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="font-black text-blue-600 uppercase tracking-widest">
                                Baca Selengkapnya &rarr;
                            </span>
                            <span id="preview-status-user"
                                class="text-[9px] font-bold uppercase px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Publish
                            </span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>

    <script>
        // ==================================================================
        // 1. KUNCI PERMANEN: OVERRIDE IMAGE BLOT UNTUK OTOMATIS TAILWIND
        // ==================================================================
        const ImageBlot = Quill.import('formats/image');

        class CustomImageBlot extends ImageBlot {
            static create(value) {
                const node = super.create(value);

                // KUNCI UTAMA: Menyisipkan class Tailwind secara permanen ke dalam tag <img>
                // Aturan melengkung, rata tengah (block mx-auto), dan jarak (mt-5 mb-4) ini akan ikut tersimpan ke database
                node.setAttribute('class', 'rounded-2xl mt-5 mb-4 mx-auto block object-cover shadow-sm');

                return node;
            }
        }
        // Daftarkan Blot kustom ke dalam mesin Quill
        Quill.register(CustomImageBlot, true);


        // ==================================================================
        // 2. INITIALIZE QUILL ARTIKEL (MURNI SANS-SERIF & RESIZE WORD-STYLE)
        // ==================================================================
        var quill = new Quill('#editor-cikasda', {
            theme: 'snow',
            placeholder: 'Tulis isi artikel berita di sini. Gambar yang diunggah otomatis melengkung rapi dan bisa diatur ukurannya...',
            modules: {
                toolbar: [
                    // Dropdown font dihapus agar murni default Sans-Serif Tailwind
                    [{
                        'header': [1, 2, 3, false]
                    }],
                    ['bold', 'italic', 'underline', 'blockquote'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    ['link', 'image'],
                    ['clean']
                ],
                // Mengaktifkan fitur geser teks (wrap text) dan handle penarik ukuran gambar ala Word
                imageResize: {
                    modules: ['Resize', 'DisplaySize', 'Toolbar'],
                    toolbar: {
                        alignIcons: true
                    }
                }
            }
        });


        // ==================================================================
        // 3. ENGINE SINKRONISASI LIVE PREVIEW JAVASCRIPT
        // ==================================================================
        quill.on('text-change', function() {
            let htmlKonten = quill.root.innerHTML;

            // Simpan html mentah ke input hidden untuk kebutuhan Form Submit Laravel
            document.getElementById('hidden-konten').value = htmlKonten;

            // Tembak konten secara live ke sisi kanan (Live Preview)
            let pBox = document.getElementById('preview-konten-cikasda');
            if (htmlKonten && htmlKonten !== '<p><br></p>') {
                pBox.innerHTML = htmlKonten;

                // Pastikan styling preview mendukung rendering modifikasi gambar kita
                pBox.className =
                    "text-sm font-medium text-slate-600 leading-relaxed overflow-hidden min-h-[6rem] prose prose-slate max-w-none break-words";
            } else {
                pBox.innerHTML =
                    'Isi teks dan gambar yang Anda susun di editor sebelah kiri akan dirender di sini...';
                pBox.className =
                    "text-sm font-normal italic text-slate-300 leading-relaxed overflow-hidden min-h-[6rem]";
            }
        });

        // Sinkronisasi Live Preview Judul Berita
        function updateJudulPreview(val) {
            let jBox = document.getElementById('preview-judul-user');
            if (val.trim() !== "") {
                jBox.innerText = val;
                jBox.className = "text-xl font-black text-slate-900 leading-snug tracking-tight break-words min-h-[3.5rem]";
            } else {
                jBox.innerText = "Judul berita Anda...";
                jBox.className =
                    "text-xl font-normal italic text-slate-300 leading-snug tracking-tight break-words min-h-[3.5rem]";
            }
        }

        // Sinkronisasi Live Preview Dropdown Kategori
        function updateKategoriPreview(val) {
            document.getElementById('preview-kategori-user').innerText = val;
        }

        // Sinkronisasi Live Preview Dropdown Status (Publish / Draft)
        function updateStatusPreview(val) {
            let sBox = document.getElementById('preview-status-user');
            sBox.innerText = val;
            if (val === 'Publish') {
                sBox.className =
                    "text-[9px] font-bold uppercase px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200";
            } else {
                sBox.className =
                    "text-[9px] font-bold uppercase px-2 py-0.5 rounded bg-amber-50 text-amber-700 border border-amber-200";
            }
        }

        // Sinkronisasi Live Preview Upload Gambar Sampul Utama
        function previewSampulUser(event) {
            let input = event.target;
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-gambar-user').src = e.target.result;
                    document.getElementById('preview-gambar-user').classList.remove('hidden');
                    document.getElementById('preview-gambar-placeholder').classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
