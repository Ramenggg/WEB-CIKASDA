@extends('admin.layouts.app')

@section('title', 'Tulis Berita Baru')

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.css" rel="stylesheet">

<style>
    /* ==================================================================
       ROMBAK QUILL TOOLBAR MENGGUNAKAN STANDAR CSS (1 BARIS LURUS)
       ================================================================== */

    /* 1. Wadah Utama Toolbar Atas */
    .ql-toolbar.ql-snow {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: wrap !important;
        align-items: center !important;
        justify-content: flex-start !important;
        background-color: #f8fafc !important; /* bg-slate-50 */
        border: 1px solid #e2e8f0 !important; /* border-slate-200 */
        gap: 0.125rem !important; /* gap-0.5 */
        overflow: visible !important;
        border-top-left-radius: 1.5rem !important; /* rounded-t-3xl */
        border-top-right-radius: 1.5rem !important;
        padding: 0.5rem !important; /* p-2 */
    }

    /* 2. Kapsul Kelompok Tombol Menu */
    .ql-snow .ql-formats {
        display: inline-flex !important;
        align-items: center !important;
        background-color: #ffffff !important;
        border: 1px solid #f1f5f9 !important; /* border-slate-100 */
        border-radius: 0.75rem !important; /* rounded-xl */
        padding: 0.125rem 0.25rem !important; /* py-0.5 px-1 */
        margin-right: 0.125rem !important; /* mr-0.5 */
        flex-shrink: 0 !important;
    }

    /* 3. Tombol Aksi Kapsul Bulat */
    .ql-snow .ql-toolbar button,
    .ql-snow.ql-toolbar button {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 2rem !important; /* w-8 */
        height: 2rem !important; /* h-8 */
        border-radius: 0.5rem !important; /* rounded-lg */
        color: #475569 !important; /* text-slate-600 */
        transition: all 0.2s duration-200 !important;
    }

    /* Efek Hover & Aktif Tombol */
    .ql-snow .ql-toolbar button:hover,
    .ql-snow.ql-toolbar button:hover {
        background-color: #f1f5f9 !important; /* bg-slate-100 */
        color: #2563eb !important; /* text-blue-600 */
        transform: translateY(-0.125rem) !important; /* -translate-y-0.5 */
    }

    .ql-snow .ql-toolbar button.ql-active,
    .ql-snow.ql-toolbar button.ql-active {
        background-color: #eff6ff !important; /* bg-blue-50 */
        color: #2563eb !important;
        border: 1px solid #bfdbfe !important; /* border-blue-200 */
    }

    /* Ketebalan Garis Grid Ikon */
    .ql-snow .ql-toolbar .ql-stroke {
        color: currentColor !important;
        stroke-width: 2.4 !important;
    }

    .ql-snow .ql-toolbar .ql-fill {
        fill: currentColor !important;
    }

    /* 4. Dropdown Pilihan Ukuran Teks (Header) */
    .ql-snow .ql-picker.ql-header {
        display: inline-flex !important;
        align-items: center !important;
        height: 2rem !important; /* h-8 */
        background-color: #ffffff !important;
        border: 1px solid #e2e8f0 !important; /* border-slate-200 */
        border-radius: 0.5rem !important; /* rounded-lg */
        color: #334155 !important; /* text-slate-700 */
        font-size: 0.75rem !important; /* text-xs */
        font-weight: 700 !important;
        padding-left: 0.5rem !important; /* pl-2 */
        padding-right: 1rem !important; /* pr-4 */
        transition: all 0.2s !important;
    }

    .ql-snow .ql-picker.ql-header:hover {
        background-color: #f8fafc !important;
        border-color: #cbd5e1 !important; /* border-slate-300 */
    }

    .ql-snow .ql-picker.ql-header {
        width: 6rem !important; /* w-24 */
    }

    .ql-snow .ql-picker-options {
        background-color: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 0.75rem !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
        padding: 0.25rem !important;
        z-index: 9999 !important;
    }

    /* Style Align Picker to look like a standard round button */
    .ql-snow .ql-toolbar .ql-picker.ql-align {
        width: 2rem !important; /* h-8 */
        height: 2rem !important; /* w-8 */
        border: none !important;
        background: transparent !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 0.5rem !important; /* rounded-lg */
        transition: all 0.2s !important;
        padding: 0 !important;
    }

    .ql-snow .ql-toolbar .ql-picker.ql-align .ql-picker-label {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        height: 100% !important;
        border: none !important;
        padding: 0 !important;
    }

    .ql-snow .ql-toolbar .ql-picker.ql-align:hover {
        background-color: #f1f5f9 !important; /* bg-slate-100 */
        color: #2563eb !important; /* text-blue-600 */
    }

    /* Horizontal layout for align dropdown options */
    .ql-snow .ql-picker.ql-align .ql-picker-options {
        display: none !important;
        width: auto !important;
        min-width: 7.5rem !important;
        flex-direction: row !important;
        gap: 0.25rem !important;
        padding: 0.25rem !important;
        border-radius: 0.5rem !important;
    }

    .ql-snow .ql-picker.ql-align.ql-expanded .ql-picker-options {
        display: flex !important;
    }

    .ql-snow .ql-picker.ql-align .ql-picker-options .ql-picker-item {
        width: 1.5rem !important;
        height: 1.5rem !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 0.25rem !important;
        padding: 0 !important;
    }

    /* ==================================================================
       MURNI KOTAK KETIK EDITOR (SANS-SERIF KUNCI & TINGGI LEGA)
       ================================================================== */
    .ql-container.ql-snow {
        border: 1px solid #e2e8f0 !important;
        border-top: 0 !important;
        border-bottom-left-radius: 1.5rem !important; /* rounded-b-3xl */
        border-bottom-right-radius: 1.5rem !important;
    }

    #editor-cikasda {
        min-height: 500px !important;
        font-size: 1rem !important; /* text-base */
        line-height: 1.625 !important; /* leading-relaxed */
        color: #334155 !important;
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
    }

    /* ==================================================================
       STYLE PREMIUM INPUT JUDUL BERITA (SINKRON SANS-SERIF DENGAN ISI)
       ================================================================== */
    #input-judul {
        font-weight: 800 !important; /* font-extrabold */
        letter-spacing: -0.025em !important; /* tracking-tight */
        color: #0f172a !important; /* text-slate-900 */
        border: 1px solid #e2e8f0 !important;
        background-color: #ffffff !important; /* bg-white */
        transition: all 0.3s !important;
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    }

    #input-judul:focus {
        border-color: #2563eb !important; /* border-blue-600 */
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1) !important; /* ring-4 ring-blue-600/10 */
        background-color: #ffffff !important;
    }

    /* ==================================================================
       PERBAIKAN SELEKTOR UTAMANYA (MENEMBUS FORMAT INTERNAL QUILL)
       ================================================================== */

    /* 1. Mengatur Gambar di Dalam Editor Ketik (Sisi Kiri) */
    .ql-container .ql-editor img {
        border-radius: 1rem !important; /* rounded-2xl */
        margin-top: 1.25rem !important; /* mt-5 */
        margin-bottom: 1rem !important; /* mb-4 */
        margin-left: auto !important;
        margin-right: auto !important;
        display: block !important;
        object-fit: cover !important;
        transition: all 0.3s !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
        max-width: 100% !important;
        height: auto !important;
    }

    /* 2. Mengatur Gambar di Dalam Panel Live Preview (Sisi Kanan) */
    #preview-konten-cikasda img {
        border-radius: 1rem !important;
        margin-top: 1.25rem !important;
        margin-bottom: 1rem !important;
        margin-left: auto !important;
        margin-right: auto !important;
        display: block !important;
        object-fit: cover !important;
        max-width: 100% !important;
        height: auto !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
    }

    /* Alignment utilities for Quill content in Live Preview */
    .ql-align-center {
        text-align: center !important;
    }
    .ql-align-right {
        text-align: right !important;
    }
    .ql-align-justify {
        text-align: justify !important;
    }
    .ql-align-left {
        text-align: left !important;
    }
</style>

@section('content')

    <style type="text/tailwindcss">
        /* ATURAN TINGGI KOTAK EDITOR */
        #editor-cikasda {
            min-height: 500px !important;
            font-size: 16px;
        }
    </style>

    <div class="max-w-7xl mx-auto pb-16 animate-fade-in">

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

                    {{-- INPUT GAMBAR SAMPUL MURNI HTML --}}
                    <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-4">
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Foto Sampul
                                Utama</label>
                            <p class="text-[11px] text-slate-500 font-bold mt-0.5">Pilih foto terbaik untuk cover depan
                                berita (Maks. 3MB).</p>
                        </div>

                        <label for="file-input-cikasda"
                            class="relative block border-2 border-dashed border-slate-200 hover:border-blue-500 rounded-2xl p-4 text-center cursor-pointer bg-slate-50/50 group overflow-hidden transition-all duration-300">
                            <input type="file" id="file-input-cikasda" name="images[]" accept="image/*" class="hidden"
                                onchange="previewSampulUser(event)">
                            
                            {{-- State 1: Belum Ada Foto --}}
                            <div id="upload-placeholder-cikasda" class="space-y-2 flex flex-col items-center py-4">
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

                            {{-- State 2: Sudah Ada Foto --}}
                            <div id="upload-preview-container-cikasda" class="hidden relative w-full flex flex-col items-center">
                                <div class="relative w-full max-h-72 rounded-xl overflow-hidden border border-slate-200 bg-slate-100 flex items-center justify-center">
                                    <img id="upload-preview-img-cikasda" src="" class="w-full h-full object-cover max-h-72">
                                    
                                    {{-- Overlay hover --}}
                                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex flex-col items-center justify-center text-white gap-2">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span class="text-xs font-black uppercase tracking-wider">Ganti Sampul</span>
                                    </div>
                                </div>
                                <div class="mt-3 flex items-center gap-1.5 text-xs text-blue-600 font-extrabold uppercase tracking-wide group-hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                    <span>Ganti Sampul</span>
                                </div>
                            </div>
                        </label>
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
                    [{
                        'align': []
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
                    // Update Live Preview Kanan
                    document.getElementById('preview-gambar-user').src = e.target.result;
                    document.getElementById('preview-gambar-user').classList.remove('hidden');
                    document.getElementById('preview-gambar-placeholder').classList.add('hidden');

                    // Update Preview Di Dalam Form Box Kiri
                    document.getElementById('upload-preview-img-cikasda').src = e.target.result;
                    document.getElementById('upload-preview-container-cikasda').classList.remove('hidden');
                    document.getElementById('upload-placeholder-cikasda').classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
