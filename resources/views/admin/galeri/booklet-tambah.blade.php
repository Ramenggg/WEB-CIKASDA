@extends('admin.layouts.app')

@section('title', 'Kelola Booklet Digital')

@section('content')
    {{-- KONTAINER GLOBAL --}}
    <div
        class="relative w-full min-h-screen rounded-[2rem] p-6 md:p-8 overflow-hidden isolate shadow-[0_20px_50px_rgba(30,41,59,0.15)] border border-slate-200">

        {{-- BACKGROUND IMAGE GEDUNG UTAMA CERAH JELAS --}}
        <div class="absolute inset-0 -z-20 bg-slate-50">
            <img src="{{ asset('images/slider/slide1.png') }}" alt="Background CIKASDA"
                class="w-full h-full object-cover object-center brightness-[0.88] contrast-[1.03]">
            <div class="absolute inset-0 bg-gradient-to-tr from-white/70 via-blue-50/75 to-blue-100/40 mix-blend-overlay">
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/60 to-[#f8fafc]"></div>
        </div>

        <div class="max-w-7xl mx-auto space-y-10">

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

                        <div class="space-y-2">
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Judul Booklet /
                                Brosur Informasi Dinas</label>
                            <input type="text" name="judul_booklet" required id="judul_booklet"
                                value="{{ old('judul_booklet') }}"
                                placeholder="Masukkan judul dokumen booklet, renstra, atau info grafis dinas..."
                                class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-extrabold text-slate-900 text-base placeholder:font-normal placeholder:text-slate-400">
                        </div>

                        {{-- SELEKTOR PILIHAN METODE UPLOAD HIBRIDA (FILE PDF LOKAL / LINK EXTERNAL) --}}
                        <div x-data="{ mode: 'file' }" class="space-y-4">
                            <div
                                class="flex items-center gap-4 bg-slate-100 p-1.5 rounded-xl border border-slate-200 w-fit">
                                <button type="button" @click="mode = 'file'"
                                    :class="mode === 'file' ? 'bg-white text-blue-600 font-black shadow-3xs' :
                                        'text-slate-500 font-bold'"
                                    class="px-4 py-2 text-xs uppercase tracking-wider rounded-lg transition-all cursor-pointer">Unggah
                                    File PDF</button>
                                <button type="button" @click="mode = 'link'"
                                    :class="mode === 'link' ? 'bg-white text-blue-600 font-black shadow-3xs' :
                                        'text-slate-500 font-bold'"
                                    class="px-4 py-2 text-xs uppercase tracking-wider rounded-lg transition-all cursor-pointer">Link
                                    Google Drive / Tautan External</button>
                            </div>

                            {{-- MODE A: FILE PDF LOKAL --}}
                            <div x-show="mode === 'file'" x-transition class="space-y-2">
                                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Pilih Berkas
                                    Dokumen PDF (Maks: 50MB)</label>
                                <div
                                    class="w-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl p-6 flex flex-col items-center justify-center text-slate-400 hover:text-blue-600 hover:border-blue-500 transition-colors relative cursor-pointer">
                                    <svg class="w-8 h-8 stroke-[1.8]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <span id="pdf-chosen-text"
                                        class="text-xs font-black uppercase tracking-wider mt-2 text-center">Klik Untuk
                                        Menyisipkan Dokumen PDF Resmi</span>
                                    <input type="file" name="file_pdf" id="file_pdf" accept="application/pdf"
                                        class="absolute inset-0 opacity-0 cursor-pointer"
                                        onchange="document.getElementById('pdf-chosen-text').innerText = this.files[0] ? 'Terpilih: ' + this.files[0].name : 'Klik Untuk Menyisipkan Dokumen PDF Resmi'">
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
             PART B: GRID FILTER DATA ARSIP BOOKLET YANG SUDAH TERBIT
             ================================================================== --}}
            <div class="space-y-4">
                <div class="flex items-center space-x-2.5 px-1">
                    <span class="h-4 w-1 bg-blue-600 rounded-full shadow-xs"></span>
                    <h2 class="text-sm font-black text-slate-800 uppercase tracking-wider">Arsip Booklet & Brosur Terbit
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($booklets ?? [] as $booklet)
                        <div
                            class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-[0_4px_20px_rgba(15,23,42,0.02)] flex flex-col justify-between group hover:shadow-md transition-all duration-300">

                            {{-- Cover Simbolik Dokumen PDF Premium --}}
                            <div
                                class="aspect-video w-full bg-slate-100 relative overflow-hidden border-b border-slate-100 flex flex-col items-center justify-center p-4 text-center group/card">
                                <div
                                    class="w-12 h-12 rounded-xl bg-red-50 border border-red-100 flex items-center justify-center text-red-500 text-xl font-bold shadow-3xs group-hover/card:scale-110 transition-transform">
                                    📕
                                </div>
                                <span class="text-[10px] font-black tracking-widest uppercase text-slate-400 mt-3 block">
                                    {{ $booklet->file_pdf ? 'PDF Document' : 'External Link Link' }}
                                </span>
                            </div>

                            {{-- Metadata Dokumen --}}
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                                <div class="space-y-1">
                                    <h4
                                        class="text-sm font-black text-slate-900 uppercase tracking-tight break-words leading-tight line-clamp-2">
                                        {{ $booklet->judul_booklet }}
                                    </h4>
                                    <p class="text-xs text-slate-400 font-medium line-clamp-2 leading-relaxed">
                                        {{ $booklet->deskripsi_booklet ?? 'Tidak ada rincian ringkasan deskripsi tambahan untuk buklet digital ini.' }}
                                    </p>
                                </div>

                                {{-- ACTION BUTTON HAPUS BOOKLET --}}
                                <div class="pt-3 border-t border-slate-100 flex items-center justify-end">
                                    <form action="{{ route('admin.galeri.booklet.hapus', $booklet->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus dokumen booklet ini dari server arsip?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white border border-red-100 font-black text-[10px] uppercase tracking-wider rounded-xl transition-all cursor-pointer">
                                            🗑️ Hapus Dokumen
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full bg-white rounded-2xl p-12 border border-slate-200 text-center text-xs font-black text-slate-400 uppercase tracking-widest">
                            Belum ada dokumen booklet atau brosur informasi terdaftar
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    {{-- INTERACTIVE PROGRESS BAR ENGINE --}}
    <script>
        function submitFormBookletDenganProgress() {
            let form = document.getElementById('form-tambah-booklet');
            let judul = document.getElementById('judul_booklet').value;

            if (!judul.trim()) {
                form.reportValidity();
                return;
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

            xhr.addEventListener("load", function() {
                window.location.reload();
            });

            xhr.open("POST", form.action, true);
            xhr.send(formData);
        }
    </script>
@endsection
