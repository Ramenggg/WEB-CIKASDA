@extends('admin.layouts.app')

@section('title', 'Kelola Video Dokumentasi')

@section('content')
    <div class="max-w-7xl mx-auto space-y-10 animate-fade-in">

            {{-- ==================================================================
             PART A: FORM INPUT TAMBAH DATA VIDEO HIBRIDA
             ================================================================== --}}
            <div class="space-y-6">
                {{-- HEADER ACTION BAR --}}
                <div
                    class="bg-white/80 backdrop-blur-md p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-black text-slate-900 tracking-tight">Kelola Video Dokumentasi</h1>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wide mt-1">Sistem Dokumentasi Video
                            Hibrida Cikasda</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase tracking-widest rounded-xl transition border border-slate-200/60 text-center">Batal</a>
                        <button type="button" onclick="submitFormDenganProgress()"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase tracking-[0.15em] rounded-xl transition shadow-lg shadow-blue-600/20 text-center cursor-pointer">Simpan
                            Konten Video</button>
                    </div>
                </div>

                {{-- NOTIFIKASI INFORMASI --}}
                @if (session('success'))
                    <div
                        class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-800 text-xs font-bold shadow-sm">
                        🎉 {{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-800 text-xs font-bold shadow-sm">
                        ⚠️ {{ session('error') }}</div>
                @endif

                {{-- LIVE PROGRESS BAR COMPONENT (TERSEMBUNYI NYALA SAAT SUBMIT) --}}
                <div id="box-progress-upload"
                    class="hidden bg-white p-6 rounded-2xl border border-blue-100 shadow-sm space-y-3 animate-pulse">
                    <div
                        class="flex justify-between items-center text-xs font-black text-blue-900 uppercase tracking-wider">
                        <span id="status-text">Sedang Mengirim & Memproses File Video Lapangan...</span>
                        <span id="persen-text">0%</span>
                    </div>
                    <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden border border-slate-200/60">
                        <div id="bar-progress-upload"
                            class="bg-gradient-to-r from-blue-500 to-indigo-600 h-full w-[0%] transition-all duration-150">
                        </div>
                    </div>
                </div>

                {{-- FORM UTAMA (DITAMBAHKAN MULTIPART/FORM-DATA) --}}
                <form id="form-tambah-video" action="{{ route('admin.galeri.video.simpan') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-6">
                        <div class="space-y-2">
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Judul
                                Dokumentasi Video Kegiatan</label>
                            <input type="text" name="judul_video" required id="judul_video"
                                placeholder="Masukkan judul liputan video resmi..."
                                class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-extrabold text-slate-900 text-base placeholder:font-normal placeholder:text-slate-400">
                        </div>

                        {{-- SELEKTOR PILIHAN METODE UPLOAD (YOUTUBE / FILE FISIK) --}}
                        <div x-data="{ mode: 'youtube' }" class="space-y-4">
                            <div
                                class="flex items-center gap-4 bg-slate-100 p-1.5 rounded-xl border border-slate-200 w-fit">
                                <button type="button" @click="mode = 'youtube'"
                                    :class="mode === 'youtube' ? 'bg-white text-blue-600 font-black shadow-3xs' :
                                        'text-slate-500 font-bold'"
                                    class="px-4 py-2 text-xs uppercase tracking-wider rounded-lg transition-all cursor-pointer">Tautan
                                    YouTube</button>
                                <button type="button" @click="mode = 'file'"
                                    :class="mode === 'file' ? 'bg-white text-blue-600 font-black shadow-3xs' :
                                        'text-slate-500 font-bold'"
                                    class="px-4 py-2 text-xs uppercase tracking-wider rounded-lg transition-all cursor-pointer">File
                                    Video Fisik</button>
                            </div>

                            {{-- KANVAS 1: TAUTAN LINK YOUTUBE --}}
                            <div x-show="mode === 'youtube'" x-transition class="space-y-2">
                                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Tautan Link
                                    URL YouTube</label>
                                <input type="url" name="url_youtube" id="url_youtube"
                                    placeholder="Contoh: https://www.youtube.com/watch?v=XXXXXX"
                                    class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-bold text-blue-600 text-sm placeholder:font-normal placeholder:text-slate-400 bg-slate-50/50">
                            </div>

                            {{-- KANVAS 2: UNGHAH BERKAS FILE VIDEO LOKAL --}}
                            <div x-show="mode === 'file'" x-transition class="space-y-2" style="display: none;">
                                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Unggah File
                                    Video (Format: .mp4, .mkv / Maks: 100MB)</label>
                                <div
                                    class="w-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl p-6 flex flex-col items-center justify-center text-slate-400 hover:text-blue-600 hover:border-blue-500 transition-colors relative cursor-pointer">
                                    <svg class="w-8 h-8 stroke-[1.8]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                    </svg>
                                    <span id="file-chosen-text"
                                        class="text-xs font-black uppercase tracking-wider mt-2 text-center">Klik Untuk
                                        Memilih Berkas Video Lapangan</span>
                                    <input type="file" name="file_video" id="file_video" accept="video/*"
                                        class="absolute inset-0 opacity-0 cursor-pointer"
                                        onchange="document.getElementById('file-chosen-text').innerText = this.files[0] ? 'Terpilih: ' + this.files[0].name : 'Klik Untuk Memilih Berkas Video Lapangan'">
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Deskripsi /
                                    Rincian Video</label>
                                <span
                                    class="text-[10px] bg-slate-100 border border-slate-200 text-slate-500 font-extrabold px-2.5 py-0.5 rounded-md uppercase tracking-wider">Opsional</span>
                            </div>
                            <textarea name="deskripsi_video" rows="3" placeholder="Masukkan ringkasan liputan video ini..."
                                class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-medium text-slate-700 text-sm placeholder:font-normal placeholder:text-slate-400"></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <hr class="border-slate-200/60 my-6">

            {{-- ==================================================================
             PART B: GRID DAFTAR VIDEO AKTIF (MENDUKUNG PREVIEW DUAL-MODE)
             ================================================================== --}}
            <div class="space-y-4">
                <div class="flex items-center space-x-2.5 px-1">
                    <span class="h-4 w-1 bg-blue-600 rounded-full shadow-xs"></span>
                    <h2 class="text-sm font-black text-slate-800 uppercase tracking-wider">Arsip Video Dokumentasi Terbit
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($videos ?? [] as $video)
                        <div
                            class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-[0_4px_20px_rgba(15,23,42,0.02)] flex flex-col justify-between group hover:shadow-md transition-all duration-300">

                            {{-- DETEKSI MEDIA PREVIEW COVER --}}
                            <div
                                class="aspect-video w-full bg-slate-900 relative overflow-hidden border-b border-slate-100 group/video flex items-center justify-center">
                                @if ($video->file_video)
                                    {{-- Jika Video Fisik: Gunakan HTML5 Native Video Tag --}}
                                    <video src="{{ $video->url_video }}"
                                        class="w-full h-full object-cover" preload="metadata" muted></video>
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                        <div
                                            class="text-[10px] bg-blue-600 text-white font-black px-2.5 py-1 rounded-md uppercase tracking-widest absolute top-3 left-3 shadow-sm border border-blue-400">
                                            Berkas Video</div>
                                        <div
                                            class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-md transform group-hover/video:scale-110 transition-transform">
                                            ▶</div>
                                    </div>
                                @else
                                    {{-- Jika Video Youtube: Tarik API Thumbnail Image YouTube --}}
                                    <img src="https://img.youtube.com/vi/{{ $video->url_youtube }}/hqdefault.jpg"
                                        alt="Thumbnail" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                        <div
                                            class="text-[10px] bg-red-600 text-white font-black px-2.5 py-1 rounded-md uppercase tracking-widest absolute top-3 left-3 shadow-sm border border-red-400">
                                            YouTube</div>
                                        <div
                                            class="w-12 h-12 rounded-full bg-red-600 text-white flex items-center justify-center shadow-md transform group-hover/video:scale-110 transition-transform">
                                            ▶</div>
                                    </div>
                                @endif
                            </div>

                            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                                <div class="space-y-1">
                                    <h4
                                        class="text-sm font-black text-slate-900 uppercase tracking-tight line-clamp-2 leading-tight">
                                        {{ $video->judul_video }}</h4>
                                    <p class="text-xs text-slate-400 font-medium line-clamp-2 leading-relaxed">
                                        {{ $video->deskripsi_video ?? 'Tidak ada rincian deskripsi tambahan.' }}</p>
                                </div>
                                {{-- PANEL BUTTON HAPUS VIDEO (SINKRONISASI ROUTE GABUNGAN) --}}
                                <div class="pt-3 border-t border-slate-100 flex items-center justify-end">
                                    {{-- FIX KUNCI: Ubah admin.adminVideoDestroy menjadi admin.galeri.video.hapus --}}
                                    <form action="{{ route('admin.galeri.video.hapus', $video->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus video dokumentasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white border border-red-100 font-black text-[10px] uppercase tracking-wider rounded-xl transition-all cursor-pointer">
                                            🗑️ Hapus Video
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full bg-white rounded-2xl p-12 border border-slate-200 text-center text-xs font-black text-slate-400 uppercase tracking-widest">
                            Belum ada arsip video dokumentasi kegiatan dinas tercatat</div>
                    @endforelse
                </div>
            </div>

        </div>

    {{-- ==================================================================
     5. ENGINE JAVASCRIPT AJAX LIVE UPLOAD PROGRESS INDICATOR
     ================================================================== --}}
    <script>
        function submitFormDenganProgress() {
            let form = document.getElementById('form-tambah-video');
            let judul = document.getElementById('judul_video').value;

            if (!judul.trim()) {
                form.reportValidity();
                return;
            }

            let formData = new FormData(form);
            let xhr = new XMLHttpRequest();

            // Trigger buka visual container progress bar loading
            document.getElementById('box-progress-upload').classList.remove('hidden');

            xhr.upload.addEventListener("progress", function(e) {
                if (e.lengthComputable) {
                    let persen = Math.round((e.loaded / e.total) * 100);
                    document.getElementById('bar-progress-upload').style.width = persen + "%";
                    document.getElementById('persen-text').innerText = persen + "%";

                    if (persen === 100) {
                        document.getElementById('status-text').innerText =
                            "Menyimpan ke Server & Mengunci Database Supabase...";
                    }
                }
            });

            xhr.addEventListener("load", function() {
                // Ketika selesai, muat ulang halaman agar notifikasi sukses Laravel menyala
                window.location.reload();
            });

            xhr.open("POST", form.action, true);
            xhr.send(formData);
        }
    </script>
@endsection
