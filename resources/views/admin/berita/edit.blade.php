@extends('admin.layouts.app')

@section('title', 'Ubah Artikel Berita')

@section('content')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.css" rel="stylesheet">

<style>
    /* ==================================================================
       ROMBAK QUILL TOOLBAR MENGGUNAKAN STANDAR CSS (1 BARIS LURUS)
       ================================================================== */
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
        border-top-left-radius: 1rem !important; /* rounded-t-3xl */
        border-top-right-radius: 1rem !important;
        padding: 0.5rem !important; /* p-2 */
    }
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
    .ql-snow .ql-toolbar .ql-stroke {
        color: currentColor !important;
        stroke-width: 2.4 !important;
    }
    .ql-snow .ql-toolbar .ql-fill {
        fill: currentColor !important;
    }
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

<div class="w-full pb-20 animate-fade-in">
    {{-- TOMBOL KEMBALI & INFORMASI --}}
    <div class="mb-6 flex items-center justify-between text-xs font-bold uppercase tracking-wider">
        <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-600 transition group cursor-pointer">
            <span class="inline-block translate-x-0 group-hover:-translate-x-1 transition-transform duration-200">&larr;</span>
            <span>Kembali ke Daftar Berita</span>
        </a>
    </div>

    {{-- DUA KOLOM SIDE-BY-SIDE --}}
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
        {{-- KOLOM KIRI: FORM EDIT DATA (7 Kolom) --}}
        <div class="xl:col-span-7 space-y-6">
            <form id="form-edit-berita" action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Input Hidden untuk Konten Quill --}}
                <input type="hidden" id="hidden-konten" name="konten" value="{{ old('konten', $berita->konten) }}">

                {{-- Blok Kategori & Status --}}
                <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-wider">Kategori Berita</label>
                        <select id="select-kategori" name="kategori" required
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 font-bold text-slate-700 text-xs uppercase tracking-wide cursor-pointer bg-white"
                            onchange="updateKategoriPreview(this.value)">
                            @foreach(['Infrastruktur', 'Sumber Daya Air', 'Cipta Karya', 'Kegiatan Dinas', 'Pengumuman'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori', $berita->kategori) === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-wider">Status Tampilan</label>
                        <select id="select-status" name="status"
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 font-bold text-slate-700 text-xs uppercase tracking-wide cursor-pointer bg-white"
                            onchange="updateStatusPreview(this.value)">
                            <option value="Publish" {{ old('status', $berita->status) === 'Publish' ? 'selected' : '' }}>Langsung Terbitkan</option>
                            <option value="Draft" {{ old('status', $berita->status) === 'Draft' ? 'selected' : '' }}>Simpan Sebagai Draft</option>
                        </select>
                    </div>
                </div>

                {{-- Input Teks Berita --}}
                <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-6">
                    {{-- Judul Berita --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Judul Artikel / Berita</label>
                        <input type="text" id="input-judul" name="judul" required value="{{ old('judul', $berita->judul) }}"
                            placeholder="Masukkan judul berita yang menarik..."
                            class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-bold text-slate-800 text-lg placeholder:font-normal placeholder:text-slate-400"
                            oninput="updateJudulPreview(this.value)">
                    </div>

                    {{-- Isi Berita Menggunakan Quill --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Isi Berita (Bisa Sisip Gambar & Atur Paragraf)</label>
                        <div class="rounded-2xl border border-slate-200 overflow-hidden shadow-inner">
                            <div id="editor-cikasda" class="text-slate-700 bg-white"></div>
                        </div>
                    </div>
                </div>

                {{-- FOTO UTAMA DAN FOTO DOKUMENTASI SAAT INI --}}
                @if($berita->gambars->isNotEmpty())
                    <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-4">
                        <div>
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Foto Dokumentasi Saat Ini</label>
                            <p class="text-[11px] text-slate-500 font-bold mt-0.5">Centang foto yang ingin dihapus dari galeri berita ini.</p>
                        </div>
                        
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach($berita->gambars as $gambar)
                                <div class="relative rounded-xl overflow-hidden border border-slate-200 aspect-video group">
                                    <img src="{{ Storage::url($gambar->file_path) }}" alt="Foto" class="w-full h-full object-cover">
                                    
                                    {{-- CHECKBOX HAPUS --}}
                                    <label class="absolute top-2 right-2 bg-white/95 backdrop-blur-xs rounded-lg px-2 py-1.5 flex items-center gap-1.5 shadow-md cursor-pointer border border-slate-100 hover:bg-slate-50">
                                        <input type="checkbox" name="delete_images[]" value="{{ $gambar->id }}" class="rounded text-rose-600 focus:ring-rose-500">
                                        <span class="text-[9px] font-black uppercase text-rose-600 tracking-wider">Hapus</span>
                                    </label>

                                    @if($gambar->urutan === 0)
                                        <span class="absolute bottom-2 left-2 px-2 py-1 bg-blue-600 text-white rounded text-[8px] font-black uppercase tracking-wider">
                                            Sampul
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- UNGGAH FOTO BARU --}}
                <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-4">
                    <div>
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Unggah Foto Baru (Bisa Banyak File)</label>
                        <p class="text-[11px] text-slate-500 font-bold mt-0.5">Pilih satu atau beberapa foto untuk ditambahkan ke galeri berita (Maks. 3MB per file).</p>
                    </div>

                    <label for="file-input-cikasda"
                        class="relative block border-2 border-dashed border-slate-200 hover:border-blue-500 rounded-2xl p-8 text-center cursor-pointer bg-slate-50/50 group">
                        <input type="file" id="file-input-cikasda" name="images[]" accept="image/*" multiple class="hidden"
                            onchange="previewMultipleSampulUser(event)">
                        <div class="space-y-2 flex flex-col items-center">
                            <div class="p-4 bg-white rounded-2xl shadow-sm text-slate-400 group-hover:text-blue-600 border border-slate-100 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-slate-700">Klik di sini untuk menambah foto</p>
                        </div>
                    </label>

                    {{-- PREVIEW FOTO BARU --}}
                    <div id="new-images-preview" class="grid grid-cols-3 gap-3 pt-4 hidden">
                        {{-- preview images go here --}}
                    </div>
                </div>

                {{-- TOMBOL SUBMIT --}}
                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-14 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all duration-300 shadow-md shadow-blue-600/10 active:scale-98 cursor-pointer">
                        Perbarui Berita
                    </button>
                </div>
            </form>
        </div>

        {{-- KOLOM KANAN: LIVE PRATINJAU USER (5 Kolom) --}}
        <div class="xl:col-span-5 space-y-4 xl:sticky xl:top-6">
            <div class="flex items-center gap-2 px-1">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <h4 class="text-xs font-black text-slate-500 uppercase tracking-widest">Live Preview Tampilan User</h4>
            </div>

            <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-lg overflow-hidden flex flex-col group max-w-sm mx-auto">
                {{-- AREA GAMBAR SAMPUL --}}
                <div class="aspect-video w-full bg-slate-100 overflow-hidden relative">
                    @php
                        $sampul = $berita->sampul ?? $berita->gambars->first();
                    @endphp
                    <img id="preview-gambar-user" 
                         src="{{ $sampul ? Storage::url($sampul->file_path) : '' }}"
                         alt="Pratinjau Sampul"
                         class="w-full h-full object-cover {{ $sampul ? '' : 'hidden' }}">

                    <div id="preview-gambar-placeholder" class="w-full h-full flex flex-col items-center justify-center text-slate-400 gap-2 {{ $sampul ? 'hidden' : '' }}">
                        <svg class="w-10 h-10 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Pratinjau Sampul</span>
                    </div>

                    <span id="preview-kategori-user" class="absolute bottom-4 left-4 font-black text-[9px] uppercase tracking-widest px-3 py-1.5 rounded-xl shadow-xs border bg-slate-50 text-slate-700 border-slate-100">
                        {{ $berita->kategori }}
                    </span>
                </div>

                {{-- KONTEN TEKS BERITA --}}
                <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between">
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                                {{ $berita->created_at->translatedFormat('d F Y') }}
                            </div>
                            <span id="preview-status-user" class="text-[9px] font-bold uppercase px-2 py-0.5 rounded {{ $berita->status === 'Publish' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                {{ $berita->status }}
                            </span>
                        </div>
                        <h2 id="preview-judul-user" class="text-base font-black text-slate-900 leading-snug break-words">
                            {{ $berita->judul }}
                        </h2>
                        <div id="preview-konten-cikasda" class="text-xs font-semibold text-slate-500 leading-relaxed line-clamp-3 prose prose-slate max-w-none">
                            {!! $berita->konten !!}
                        </div>
                    </div>

                    {{-- LINK BACA --}}
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <a href="#" class="text-xs font-black text-blue-600 uppercase tracking-widest flex items-center gap-1.5 cursor-not-allowed pointer-events-none">
                            <span>Baca Selengkapnya</span>
                            <span class="inline-block">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>

<script>
    // ==================================================================
    // 1. INIASILISASI EDITOR QUILL DENGAN INTEGRASI LENGKAP
    // ==================================================================
    var quill = new Quill('#editor-cikasda', {
        theme: 'snow',
        placeholder: 'Silakan ubah konten detail berita ciamik Anda di sini...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'blockquote'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ],
            imageResize: {
                modules: ['Resize', 'DisplaySize', 'Toolbar'],
                toolbar: { alignIcons: true }
            }
        }
    });

    // Load initial content
    quill.root.innerHTML = `{!! old('konten', $berita->konten) !!}`;

    // ==================================================================
    // 2. ENGINE SINKRONISASI LIVE PREVIEW JAVASCRIPT
    // ==================================================================
    quill.on('text-change', function() {
        let htmlKonten = quill.root.innerHTML;
        document.getElementById('hidden-konten').value = htmlKonten;

        let pBox = document.getElementById('preview-konten-cikasda');
        if (htmlKonten && htmlKonten !== '<p><br></p>') {
            pBox.innerHTML = htmlKonten;
            pBox.className = "text-xs font-semibold text-slate-500 leading-relaxed overflow-hidden line-clamp-3 prose prose-slate max-w-none";
        } else {
            pBox.innerHTML = 'Isi teks dan gambar yang Anda susun di editor sebelah kiri akan dirender di sini...';
            pBox.className = "text-xs font-normal italic text-slate-300 leading-relaxed overflow-hidden line-clamp-3";
        }
    });

    function updateJudulPreview(val) {
        let jBox = document.getElementById('preview-judul-user');
        if (val.trim() !== "") {
            jBox.innerText = val;
            jBox.className = "text-base font-black text-slate-900 leading-snug break-words";
        } else {
            jBox.innerText = "Judul berita Anda...";
            jBox.className = "text-base font-normal italic text-slate-300 leading-snug break-words";
        }
    }

    function updateKategoriPreview(val) {
        document.getElementById('preview-kategori-user').innerText = val;
    }

    function updateStatusPreview(val) {
        let sBox = document.getElementById('preview-status-user');
        sBox.innerText = val;
        if (val === 'Publish') {
            sBox.className = "text-[9px] font-bold uppercase px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200";
        } else {
            sBox.className = "text-[9px] font-bold uppercase px-2 py-0.5 rounded bg-amber-50 text-amber-700 border border-amber-200";
        }
    }

    function previewMultipleSampulUser(event) {
        let input = event.target;
        let previewContainer = document.getElementById('new-images-preview');
        previewContainer.innerHTML = '';
        
        if (input.files && input.files.length > 0) {
            previewContainer.classList.remove('hidden');
            
            // Set the first uploaded image as the cover preview on the right
            let firstReader = new FileReader();
            firstReader.onload = function(e) {
                document.getElementById('preview-gambar-user').src = e.target.result;
                document.getElementById('preview-gambar-user').classList.remove('hidden');
                document.getElementById('preview-gambar-placeholder').classList.add('hidden');
            }
            firstReader.readAsDataURL(input.files[0]);

            Array.from(input.files).forEach(file => {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let div = document.createElement('div');
                    div.className = "relative rounded-lg overflow-hidden border border-slate-200 aspect-video";
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    previewContainer.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        } else {
            previewContainer.classList.add('hidden');
        }
    }
</script>
@endsection
