@extends('admin.layouts.app')

@section('title', 'Kelola Booklet Digital')

@section('content')
    <div class="max-w-7xl mx-auto space-y-10 animate-fade-in">

            {{-- ==================================================================
             PART A: FORM INPUT TAMBAH DATA BOOKLET / BROSUR
             ================================================================== --}}
            <div class="space-y-6">
                {{-- HEADER ACTION BAR --}}
                <div
                    class="bg-white/80 backdrop-blur-md p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-black text-slate-900 tracking-tight">Kelola Booklet Digital</h1>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wide mt-1">Sistem Publikasi Dokumen &
                            Brosur Cikasda</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase tracking-widest rounded-xl transition border border-slate-200/60 text-center">
                            Batal
                        </a>
                        <button type="button" onclick="submitFormBookletDenganProgress()"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase tracking-[0.15em] rounded-xl transition shadow-lg shadow-blue-600/20 text-center cursor-pointer">
                            Terbitkan Booklet
                        </button>
                    </div>
                </div>

                {{-- NOTIFIKASI INFORMASI --}}
                @if (session('success'))
                    <div
                        class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-800 text-xs font-bold shadow-sm">
                        🎉 {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-800 text-xs font-bold shadow-sm">
                        ⚠️ {{ session('error') }}
                    </div>
                @endif

                {{-- LIVE PROGRESS BAR COMPONENT --}}
                <div id="box-progress-booklet"
                    class="hidden bg-white p-6 rounded-2xl border border-blue-100 shadow-sm space-y-3 animate-pulse">
                    <div
                        class="flex justify-between items-center text-xs font-black text-blue-900 uppercase tracking-wider">
                        <span id="status-booklet-text">Sedang Memproses Unggahan Dokumen PDF Dinas...</span>
                        <span id="persen-booklet-text">0%</span>
                    </div>
                    <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden border border-slate-200/60">
                        <div id="bar-progress-booklet"
                            class="bg-gradient-to-r from-blue-500 to-indigo-600 h-full w-[0%] transition-all duration-150">
                        </div>
                    </div>
                </div>

                {{-- FORM UTAMA --}}
                <form id="form-tambah-booklet" action="{{ route('admin.galeri.booklet.simpan') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Kelompok Booklet</label>
                                <select name="kelompok" required
                                    class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-extrabold text-slate-900 text-base bg-white shadow-sm">
                                    <option value="Sungai Pantai Danau dan Air Baku" {{ old('kelompok') == 'Sungai Pantai Danau dan Air Baku' ? 'selected' : '' }}>Sungai Pantai Danau dan Air Baku</option>
                                    <option value="Irigasi dan Rawa" {{ old('kelompok') == 'Irigasi dan Rawa' ? 'selected' : '' }}>Irigasi dan Rawa</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Judul Booklet /
                                    Brosur Informasi Dinas</label>
                                <input type="text" name="judul_booklet" required id="judul_booklet"
                                    value="{{ old('judul_booklet') }}"
                                    placeholder="Masukkan judul dokumen booklet, renstra, atau info grafis dinas..."
                                    class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-extrabold text-slate-900 text-base placeholder:font-normal placeholder:text-slate-400">
                            </div>
                        </div>

                        <div class="space-y-2"
                            x-data="{ mode: 'input', kategori: @js(old('kategori', 'Umum')) }">
                            <div class="flex justify-between items-center">
                                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Kategori / Daerah (Khusus Irigasi)</label>
                                <div class="flex items-center gap-4 bg-slate-100 p-1.5 rounded-xl border border-slate-200 w-fit">
                                    <button type="button" @click="mode = 'input'"
                                        :class="mode === 'input' ? 'bg-white text-blue-600 font-black shadow-3xs' : 'text-slate-500 font-bold'"
                                        class="px-4 py-1 text-[10px] uppercase tracking-wider rounded-lg transition-all cursor-pointer">Input Manual</button>
                                    <button type="button" @click="mode = 'select'"
                                        :class="mode === 'select' ? 'bg-white text-blue-600 font-black shadow-3xs' : 'text-slate-500 font-bold'"
                                        class="px-4 py-1 text-[10px] uppercase tracking-wider rounded-lg transition-all cursor-pointer">Pilih Yang Ada</button>
                                </div>
                            </div>
                            
                            <div x-show="mode === 'input'" class="animate-fade-in mt-2">
                                <input type="text" name="kategori" x-model="kategori"
                                    placeholder="Ketik kategori/daerah (Contoh: DI Toili)..."
                                    class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-extrabold text-slate-900 text-base placeholder:font-normal placeholder:text-slate-400 bg-white">
                            </div>

                            <div x-show="mode === 'select'" style="display: none;" class="animate-fade-in mt-2">
                                <select @change="kategori = $event.target.value"
                                    class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-extrabold text-slate-900 text-base bg-white shadow-sm">
                                    <option value="Umum">Umum</option>
                                    @php
                                        $existingKats = \App\Models\BookletDigital::distinct()->pluck('kategori');
                                    @endphp
                                    @foreach($existingKats as $ek)
                                        @if($ek && $ek !== 'Umum')
                                            <option value="{{ $ek }}">{{ $ek }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- SELEKTOR PILIHAN METODE UPLOAD HIBRIDA (FILE PDF/GAMBAR LOKAL / LINK EXTERNAL) --}}
                        <div x-data="{ mode: 'file' }" class="space-y-6">
                            <div
                                class="flex items-center gap-4 bg-slate-100 p-1.5 rounded-xl border border-slate-200 w-fit">
                                <button type="button" @click="mode = 'file'"
                                    :class="mode === 'file' ? 'bg-white text-blue-600 font-black shadow-3xs' :
                                        'text-slate-500 font-bold'"
                                    class="px-4 py-2 text-xs uppercase tracking-wider rounded-lg transition-all cursor-pointer">Unggah
                                    Berkas (PDF/Gambar)</button>
                                <button type="button" @click="mode = 'link'"
                                    :class="mode === 'link' ? 'bg-white text-blue-600 font-black shadow-3xs' :
                                        'text-slate-500 font-bold'"
                                    class="px-4 py-2 text-xs uppercase tracking-wider rounded-lg transition-all cursor-pointer">Link
                                    External</button>
                            </div>

                            {{-- GRID INPUT FILE & SAMPUL --}}
                            <div x-show="mode === 'file'" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                {{-- 1. INPUT SAMPUL (GAMBAR) --}}
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Gambar Sampul / Thumbnail (Opsional)</label>
                                    <div class="relative group">
                                        <div class="w-full aspect-video bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center text-slate-400 group-hover:text-blue-600 group-hover:border-blue-500 transition-all overflow-hidden relative">
                                            <img id="sampul-preview" class="hidden absolute inset-0 w-full h-full object-cover">
                                            <div id="sampul-placeholder" class="flex flex-col items-center">
                                                <svg class="w-8 h-8 stroke-[1.8]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6.75a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6.75v10.5a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path></svg>
                                                <span class="text-[10px] font-black uppercase mt-2">Klik Pilih Sampul</span>
                                            </div>
                                            <input type="file" name="file_sampul" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" 
                                                onchange="previewImage(this, 'sampul-preview', 'sampul-placeholder')">
                                        </div>
                                    </div>
                                </div>

                                {{-- 2. INPUT BERKAS UTAMA (PDF/IMAGE) --}}
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Berkas Utama (PDF atau Gambar)</label>
                                    <div class="relative group">
                                        <div class="w-full aspect-video bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center text-slate-400 group-hover:text-emerald-600 group-hover:border-emerald-500 transition-all overflow-hidden relative">
                                            <div id="file-main-preview-container" class="hidden absolute inset-0 w-full h-full bg-white flex items-center justify-center">
                                                <img id="file-main-img-preview" class="hidden w-full h-full object-contain">
                                                <div id="file-main-pdf-preview" class="hidden flex flex-col items-center text-red-500">
                                                    <span class="text-4xl">📕</span>
                                                    <span id="pdf-name-text" class="text-[10px] font-bold mt-1 px-4 text-center line-clamp-1"></span>
                                                </div>
                                            </div>
                                            <div id="file-main-placeholder" class="flex flex-col items-center">
                                                <svg class="w-8 h-8 stroke-[1.8]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path></svg>
                                                <span class="text-[10px] font-black uppercase mt-2">Pilih PDF / Gambar</span>
                                            </div>
                                            <input type="file" name="file_pdf" id="file_pdf" accept="application/pdf,image/*" class="absolute inset-0 opacity-0 cursor-pointer"
                                                onchange="handleMainFileChange(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- MODE B: LINK EXTERNAL --}}
                            <div x-show="mode === 'link'" x-transition class="space-y-2" style="display: none;">
                                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Tautan URL
                                    Berkas Online (Google Drive / FlipHTML5)</label>
                                <input type="url" name="url_external"
                                    placeholder="Contoh: https://drive.google.com/file/d/.../view"
                                    class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-bold text-blue-600 text-sm placeholder:font-normal placeholder:text-slate-400 bg-slate-50/50">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Ringkasan /
                                    Deskripsi Isi Booklet</label>
                                <span
                                    class="text-[10px] bg-slate-100 border border-slate-200 text-slate-500 font-extrabold px-2.5 py-0.5 rounded-md uppercase tracking-wider">Opsional</span>
                            </div>
                            <textarea name="deskripsi_booklet" rows="3"
                                placeholder="Masukkan ringkasan materi atau maksud informasi dari buklet digital ini..."
                                class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-medium text-slate-700 text-sm placeholder:font-normal placeholder:text-slate-400">{{ old('deskripsi_booklet') }}</textarea>
                        </div>

                    </div>
                </form>
            </div>

            <hr class="border-slate-200/60 my-6">

            {{-- ==================================================================
             PART B: ARSIP BERDASARKAN KELOMPOK
             ================================================================== --}}
            
            {{-- --- SEKSI 1: SUNGAI PANTAI DANAU DAN AIR BAKU --- --}}
            <div class="space-y-4">
                <div class="flex items-center space-x-2.5 px-1">
                    <span class="h-4 w-1 bg-blue-600 rounded-full shadow-xs"></span>
                    <h2 class="text-sm font-black text-slate-800 uppercase tracking-wider">Sungai Pantai Danau dan Air Baku</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($bookletsSungai ?? [] as $booklet)
                        @include('admin.galeri.partials.booklet-admin-card', ['booklet' => $booklet])
                    @empty
                        <div class="col-span-full bg-white rounded-2xl p-8 border border-slate-200 text-center text-xs font-black text-slate-400 uppercase tracking-widest">
                            Belum ada dokumen di kelompok ini
                        </div>
                    @endforelse
                </div>
            </div>

            <hr class="border-slate-200/60 my-6">

            {{-- --- SEKSI 2: IRIGASI DAN RAWA --- --}}
            <div class="space-y-4">
                <div class="flex items-center space-x-2.5 px-1">
                    <span class="h-4 w-1 bg-emerald-500 rounded-full shadow-xs"></span>
                    <h2 class="text-sm font-black text-slate-800 uppercase tracking-wider">Irigasi dan Rawa</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($bookletsIrigasi ?? [] as $booklet)
                        @include('admin.galeri.partials.booklet-admin-card', ['booklet' => $booklet])
                    @empty
                        <div class="col-span-full bg-white rounded-2xl p-8 border border-slate-200 text-center text-xs font-black text-slate-400 uppercase tracking-widest">
                            Belum ada dokumen di kelompok ini
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    {{-- INTERACTIVE PROGRESS BAR ENGINE --}}
    <script>
        function previewImage(input, previewId, placeholderId) {
            const preview = document.getElementById(previewId);
            const placeholder = document.getElementById(placeholderId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function handleMainFileChange(input) {
            const container = document.getElementById('file-main-preview-container');
            const imgPreview = document.getElementById('file-main-img-preview');
            const pdfPreview = document.getElementById('file-main-pdf-preview');
            const placeholder = document.getElementById('file-main-placeholder');
            const pdfNameText = document.getElementById('pdf-name-text');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();

                container.classList.remove('hidden');
                placeholder.classList.add('hidden');

                if (file.type.startsWith('image/')) {
                    reader.onload = function(e) {
                        imgPreview.src = e.target.result;
                        imgPreview.classList.remove('hidden');
                        pdfPreview.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                } else if (file.type === 'application/pdf') {
                    imgPreview.classList.add('hidden');
                    pdfPreview.classList.remove('hidden');
                    pdfNameText.textContent = file.name;
                }
            }
        }

        function submitFormBookletDenganProgress() {
            let form = document.getElementById('form-tambah-booklet');
            let judul = document.getElementById('judul_booklet').value;

            if (!judul.trim()) {
                form.reportValidity();
                return;
            }

            let fileInput = document.getElementById('file_pdf');
            let urlInput = document.getElementsByName('url_external')[0];

            if (fileInput && fileInput.offsetParent !== null) {
                if (fileInput.files.length === 0) {
                    alert("Silakan pilih/unggah berkas utama (PDF atau Gambar) terlebih dahulu.");
                    return;
                }
            } else if (urlInput && urlInput.offsetParent !== null) {
                if (!urlInput.value.trim()) {
                    alert("Silakan masukkan tautan URL berkas online terlebih dahulu.");
                    return;
                }
            }

            let formData = new FormData(form);
            let xhr = new XMLHttpRequest();

            document.getElementById('box-progress-booklet').classList.remove('hidden');

            xhr.upload.addEventListener("progress", function(e) {
                if (e.lengthComputable) {
                    let persen = Math.round((e.loaded / e.total) * 100);
                    document.getElementById('bar-progress-booklet').style.width = persen + "%";
                    document.getElementById('persen-booklet-text').innerText = persen + "%";

                    if (persen === 100) {
                        document.getElementById('status-booklet-text').innerText =
                            "Mengunci data ke server storage Supabase...";
                    }
                }
            });

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        // SUKSES
                        window.location.reload();
                    } else {
                        // GAGAL (Validation error, etc)
                        document.getElementById('box-progress-booklet').classList.add('hidden');
                        
                        // Coba ambil pesan eror jika ada
                        try {
                            const response = JSON.parse(xhr.responseText);
                            let errorMsg = "Gagal mengunggah dokumen.\n";
                            if(response.errors) {
                                for(let key in response.errors) {
                                    errorMsg += "- " + response.errors[key].join(", ") + "\n";
                                }
                            }
                            alert(errorMsg);
                        } catch(e) {
                            alert("Terjadi kesalahan sistem saat mengunggah berkas. Pastikan ukuran berkas tidak melebihi batas (50MB).");
                        }
                    }
                }
            };

            xhr.open("POST", form.action, true);
            // Tambahkan header X-Requested-With agar Laravel tahu ini request AJAX (untuk response JSON)
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.send(formData);
        }
    </script>
@endsection
