@extends('admin.layouts.app')

@section('title', 'Tulis Berita Baru')

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.css" rel="stylesheet">

<style>
    /* CSS Tambahan agar Toolbar Modul Tampil Cantik */
    .ql-image-resize-toolbar {
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .ql-image-resize-toolbar button {
        border: none;
        background: #f8fafc;
    }
    .ql-image-resize-toolbar button:hover {
        background: #e2e8f0;
    }

    /* ==================================================================
   ROMBAK TOTAL TOOLBAR QUILL MENJADI MODERN & EMPUK (ANTI-KUNO)
   ================================================================== */

/* 1. Desain Ulang Wadah Utama Toolbar */
.ql-toolbar.ql-snow {
    border: 1px solid #e2e8f0 !important; /* Warna border abu-abu halus ala Tailwind slate-200 */
    background-color: #f8fafc !important; /* Background bersih slate-50 */
    padding: 12px 16px !important; /* Ruang dalam lebih longgar agar nyaman */
    border-top-left-radius: 1.5rem !important; /* Membuat sudut atas melengkung halus */
    border-top-right-radius: 1.5rem !important;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px !important; /* Memberikan jarak antar kelompok tombol */
}

/* 2. Desain Ulang Tombol-Tombol Aksi */
.ql-snow .ql-toolbar button, 
.ql-snow.ql-toolbar button {
    border-radius: 0.75rem !important; /* Mengubah tombol kaku jadi bulat melayang (rounded-xl) */
    width: 36px !important; /* Memperbesar area tombol agar mudah ditekan jari */
    height: 36px !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    color: #475569 !important; /* Warna ikon lebih tegas (slate-600) */
}

/* Effect Hover & Aktif Pada Tombol */
.ql-snow .ql-toolbar button:hover, 
.ql-snow.ql-toolbar button:hover {
    background-color: #e2e8f0 !important; /* Efek hover abu-abu lembut */
    color: #1e40af !important; /* Ikon berubah biru saat diarahkan */
    transform: translateY(-1px); /* Sedikit efek terangkat ke atas */
}

.ql-snow .ql-toolbar button.ql-active, 
.ql-snow.ql-toolbar button.ql-active {
    background-color: #eff6ff !important; /* Background biru muda cerah saat tombol aktif */
    color: #2563eb !important; /* Warna ikon menjadi biru tegas */
    border: 1px solid #bfdbfe !important;
}

/* 3. Mempertebal Grafis Garis Ikon Dalam Tombol */
.ql-snow .ql-toolbar stroke,
.ql-snow .ql-toolbar .ql-stroke {
    stroke: currentColor !important;
    stroke-width: 2.2 !important; /* Menambah ketebalan garis ikon agar lebih jelas dan modern */
}
.ql-snow .ql-toolbar fill,
.ql-snow .ql-toolbar .ql-fill {
    fill: currentColor !important;
}

/* 4. Desain Ulang Kotak Pilihan Dropdown (Font & Ukuran Teks) */
.ql-snow .ql-picker {
    color: #334155 !important;
    font-weight: 700 !important;
    font-size: 13px !important;
    background-color: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 0.75rem !important; /* Dropdown picker jadi rounded */
    height: 36px !important;
    display: inline-flex;
    align-items: center;
    padding-left: 12px !important;
    padding-right: 24px !important;
    transition: all 0.2s ease;
}

.ql-snow .ql-picker:hover {
    border-color: #cbd5e1 !important;
    background-color: #f1f5f9 !important;
}

/* Lebar Khusus untuk Dropdown Pilihan Font Word */
.ql-snow .ql-picker.ql-font {
    width: 150px !important;
}

/* Menata List Pilihan di Dalam Dropdown */
.ql-snow .ql-picker-options {
    border-radius: 1rem !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05) !important; /* Shadow mewah */
    padding: 6px !important;
    background-color: #ffffff !important;
}

.ql-snow .ql-picker-options .ql-picker-item {
    padding: 8px 12px !important;
    border-radius: 0.5rem !important;
    transition: background 0.15s ease;
}

.ql-snow .ql-picker-options .ql-picker-item:hover {
    background-color: #f1f5f9 !important;
    color: #2563eb !important;
}

/* Separator Pembatas Kelompok Menu */
.ql-snow .ql-formats {
    display: inline-flex;
    align-items: center;
    background-color: #ffffff;
    padding: 2px 6px !important;
    border-radius: 12px;
    border: 1px solid #f1f5f9;
    margin-right: 4px !important;
}

/* Wadah Utama Kotak Ketik Di Bawah Toolbar */
.ql-container.ql-snow {
    border: 1px solid #e2e8f0 !important;
    border-top: none !important; /* Menyatu mulus dengan toolbar atas */
    border-bottom-left-radius: 1.5rem !important; /* Membuat sudut bawah melengkung melingkar */
    border-bottom-right-radius: 1.5rem !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.01), 0 2px 4px -1px rgba(0, 0, 0, 0.01);
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
    .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="arial"]::before { content: 'Arial'; font-family: 'Arial', sans-serif; }
    .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="times-new-roman"]::before,
    .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="times-new-roman"]::before { content: 'Times New Roman'; font-family: 'Times New Roman', serif; }
    .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="courier-new"]::before,
    .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="courier-new"]::before { content: 'Courier New'; font-family: 'Courier New', monospace; }
    .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="georgia"]::before,
    .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="georgia"]::before { content: 'Georgia'; font-family: 'Georgia', serif; }
    .ql-snow .ql-picker.ql-font .ql-picker-label[data-value="comic-sans"]::before,
    .ql-snow .ql-picker.ql-font .ql-picker-item[data-value="comic-sans"]::before { content: 'Comic Sans'; font-family: 'Comic Sans MS', cursive; }

    /* RENDER STYLE FONT */
    .ql-font-arial { font-family: 'Arial', sans-serif !important; }
    .ql-font-times-new-roman { font-family: 'Times New Roman', serif !important; }
    .ql-font-courier-new { font-family: 'Courier New', monospace !important; }
    .ql-font-georgia { font-family: 'Georgia', serif !important; }
    .ql-font-comic-sans { font-family: 'Comic Sans MS', cursive !important; }
</style>

<div class="max-w-7xl mx-auto pb-16">

    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-slate-200 pb-6 mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Buat Artikel Berita</h1>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wide mt-1">Sistem Input Media Terintegrasi</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.dashboard') }}" class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase tracking-widest rounded-xl transition border border-slate-200/60">
                Batal
            </a>
            <button type="submit" form="form-tambah-berita" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase tracking-[0.15em] rounded-xl transition shadow-lg shadow-blue-600/20">
                Terbitkan Berita
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
        
        {{-- ==========================================
             KOLOM KIRI: FORM ENTRI DATA (7 Kolom)
             ========================================== --}}
        <div class="xl:col-span-7 space-y-6">
            <form id="form-tambah-berita" action="{{ route('admin.berita.simpan') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Input Hidden untuk Konten Quill --}}
                <input type="hidden" id="hidden-konten" name="konten">

                {{-- Input Teks Berita --}}
                <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-6">
                    {{-- Judul Berita --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Judul Artikel / Berita</label>
                        <input type="text" id="input-judul" name="judul" required placeholder="Masukkan judul berita yang menarik..." 
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

                {{-- Blok Kategori & Status --}}
                <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-wider">Kategori Berita</label>
                        <select id="select-kategori" name="kategori" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 font-bold text-slate-700 text-xs uppercase tracking-wide cursor-pointer bg-white" onchange="updateKategoriPreview(this.value)">
                            <option value="Infrastruktur">Infrastruktur</option>
                            <option value="Sumber Daya Air">Sumber Daya Air</option>
                            <option value="Cipta Karya">Cipta Karya</option>
                            <option value="Kegiatan Dinas">Kegiatan Dinas</option>
                            <option value="Pengumuman">Pengumuman</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-wider">Status Tampilan</label>
                        <select id="select-status" name="status" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 font-bold text-slate-700 text-xs uppercase tracking-wide cursor-pointer bg-white" onchange="updateStatusPreview(this.value)">
                            <option value="Publish">Langsung Terbitkan</option>
                            <option value="Draft">Simpan Sebagai Draft</option>
                        </select>
                    </div>
                </div>

                {{-- INPUT GAMBAR SAMPUL MURNI HTML --}}
                <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-4">
                    <div>
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Foto Sampul Utama</label>
                        <p class="text-[11px] text-slate-500 font-bold mt-0.5">Pilih foto terbaik untuk cover depan berita (Maks. 3MB).</p>
                    </div>

                    <label for="file-input-cikasda" class="relative block border-2 border-dashed border-slate-200 hover:border-blue-500 rounded-2xl p-8 text-center cursor-pointer bg-slate-50/50 group">
                        <input type="file" id="file-input-cikasda" name="images[]" accept="image/*" class="hidden" onchange="previewSampulUser(event)">
                        <div class="space-y-2 flex flex-col items-center">
                            <div class="p-4 bg-white rounded-2xl shadow-sm text-slate-400 group-hover:text-blue-600 border border-slate-100 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
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

            <div class="bg-white rounded-[2rem] border border-slate-200/90 shadow-xl overflow-hidden flex flex-col transition-all duration-300">
                
                {{-- AREA GAMBAR PREVIEW UTAMA --}}
                <div class="aspect-video w-full bg-slate-100 overflow-hidden relative border-b border-slate-100 flex items-center justify-center">
                    {{-- Element Image Rekayasa DOM --}}
                    <img id="preview-gambar-user" src="" class="w-full h-full object-cover hidden">
                    
                    {{-- Placeholder Awal --}}
                    <div id="preview-gambar-placeholder" class="w-full h-full flex flex-col items-center justify-center text-slate-300 gap-1.5 bg-slate-50/50">
                        <svg class="w-8 h-8 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">Pratinjau Foto Sampul</span>
                    </div>

                    {{-- Badge Kategori --}}
                    <span id="preview-kategori-user" class="absolute bottom-4 left-4 bg-slate-900/80 backdrop-blur-md text-white font-black text-[9px] uppercase tracking-widest px-3 py-1.5 rounded-xl shadow-sm">
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
                        <h2 id="preview-judul-user" class="text-xl font-normal italic text-slate-300 leading-snug tracking-tight break-words min-h-[3.5rem]">
                            Judul berita Anda...
                        </h2>
                        
                        {{-- Isi Konten Preview --}}
                        <div id="preview-konten-cikasda" class="text-sm font-normal italic text-slate-300 leading-relaxed overflow-hidden min-h-[6rem] prose prose-slate max-w-none break-words prose-img:rounded-xl prose-img:max-h-48 prose-img:object-cover prose-img:my-2">
                            Isi teks dan gambar yang Anda susun di editor sebelah kiri akan dirender di sini...
                        </div>
                    </div>

                    {{-- Footer Preview --}}
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="font-black text-blue-600 uppercase tracking-widest">
                            Baca Selengkapnya &rarr;
                        </span>
                        <span id="preview-status-user" class="text-[9px] font-bold uppercase px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">
                            Publish
                        </span>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

{{-- ==========================================
     LOGIKA SAKTI MURNI JAVASCRIPT (ANTI GAGAL)
     ========================================== --}}
{{-- 
    1. LOAD SCRIPT TAMBAHAN UNTUK FITUR RESIZE & ALIGNMENT GAMBAR ALA WORD
    Taruh kedua script ini tepat di bawah script Quill Core kamu
--}}
{{-- 
    KUNCI UTAMA: Kita ganti cdn quill ke versi 1.3.6 yang stabil 
    agar sinkron dengan modul image resize di bawahnya
--}}
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>

<script>
    // --- REGISTER FONT WORD ---
    var Font = Quill.import('formats/font');
    Font.whitelist = ['sans-serif', 'arial', 'times-new-roman', 'courier-new', 'georgia', 'garamond', 'comic-sans'];
    Quill.register(Font, true);

    // --- INITIALIZE QUILL DENGAN MODUL IMAGE RESIZE LENGKAP ---
    var quill = new Quill('#editor-cikasda', {
        theme: 'snow',
        placeholder: 'Tulis isi artikel berita di sini. Klik gambar yang sudah diunggah untuk mengatur ukuran dan posisinya seperti di Word...',
        modules: {
            toolbar: [
                [{ 'font': ['sans-serif', 'arial', 'times-new-roman', 'courier-new', 'georgia', 'garamond', 'comic-sans'] }],
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'blockquote'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ],
            // PENGATURAN MEDIATOR GAMBAR ALA WORD
            imageResize: {
                modules: [ 'Resize', 'DisplaySize', 'Toolbar' ],
                toolbar: {
                    // Mengaktifkan ikon melayang (Rata Kiri, Tengah, Rata Kanan) di atas gambar
                    alignIcons: true
                }
            }
        }
    });

    // --- ENGINE SINKRONISASI LIVE PREVIEW JAVASCRIPT ---
    quill.on('text-change', function() {
        let htmlKonten = quill.root.innerHTML;
        
        // Simpan ke input hidden untuk form submit Laravel
        document.getElementById('hidden-konten').value = htmlKonten;

        // Tembak langsung ke kotak preview kanan
        let pBox = document.getElementById('preview-konten-cikasda');
        if (htmlKonten && htmlKonten !== '<p><br></p>') {
            pBox.innerHTML = htmlKonten;
            
            // Kita ubah styling preview agar mendukung wrap text (float-left / float-right) dari Quill
            pBox.className = "text-sm font-medium text-slate-600 leading-relaxed overflow-hidden min-h-[6rem] prose prose-slate max-w-none break-words prose-img:rounded-xl prose-img:my-2";
        } else {
            pBox.innerHTML = 'Isi teks dan gambar yang Anda susun di editor sebelah kiri akan dirender di sini...';
            pBox.className = "text-sm font-normal italic text-slate-300 leading-relaxed overflow-hidden min-h-[6rem]";
        }
    });

    // Sinkronisasi Judul Berita
    function updateJudulPreview(val) {
        let jBox = document.getElementById('preview-judul-user');
        if(val.trim() !== "") {
            jBox.innerText = val;
            jBox.className = "text-xl font-black text-slate-900 leading-snug tracking-tight break-words min-h-[3.5rem]";
        } else {
            jBox.innerText = "Judul berita Anda...";
            jBox.className = "text-xl font-normal italic text-slate-300 leading-snug tracking-tight break-words min-h-[3.5rem]";
        }
    }

    // Sinkronisasi Dropdown Kategori
    function updateKategoriPreview(val) {
        document.getElementById('preview-kategori-user').innerText = val;
    }

    // Sinkronisasi Dropdown Status
    function updateStatusPreview(val) {
        let sBox = document.getElementById('preview-status-user');
        sBox.innerText = val;
        if(val === 'Publish') {
            sBox.className = "text-[9px] font-bold uppercase px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200";
        } else {
            sBox.className = "text-[9px] font-bold uppercase px-2 py-0.5 rounded bg-amber-50 text-amber-700 border border-amber-200";
        }
    }

    // Sinkronisasi Upload Gambar Sampul Depan
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