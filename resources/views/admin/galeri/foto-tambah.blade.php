@extends('admin.layouts.app')

@section('title', 'Tambah Foto Kegiatan')

@section('content')
    {{-- KONTAINER GLOBAL: Cerah, jernih, menggunakan slide1.png dengan shadow lembut konsisten --}}
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

        <div class="max-w-7xl mx-auto space-y-6">

            {{-- HEADER ACTION BAR --}}
            <div
                class="bg-white/80 backdrop-blur-md p-4 rounded-2xl border border-slate-200 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">Tambah Galeri Foto Kegiatan</h1>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide mt-1">Sistem Dokumentasi Album
                        Cikasda</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.dashboard') }}"
                        class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase tracking-widest rounded-xl transition border border-slate-200/60 text-center">
                        Batal
                    </a>
                    <button type="submit" form="form-tambah-galeri"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase tracking-[0.15em] rounded-xl transition shadow-lg shadow-blue-600/20 text-center cursor-pointer">
                        Simpan Album Foto
                    </button>
                </div>
            </div>

            {{-- FORM UTAMA --}}
            <form id="form-tambah-galeri" action="{{ route('admin.galeri.foto.simpan') }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- BLOK 1: DATA UTAMA ALBUM (JUDUL & DESKRIPSI OPSIONAL) --}}
                <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-6">
                    {{-- Judul Album / Kegiatan --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Judul Album Kegiatan
                            (Contoh: BENDUNG IRIGASI)</label>
                        <input type="text" name="judul_album" required
                            placeholder="Masukkan judul album foto kegiatan resmi..."
                            class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-extrabold text-slate-900 text-base placeholder:font-normal placeholder:text-slate-400">
                    </div>

                    {{-- Deskripsi Album (Opsional) --}}
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Deskripsi
                                Kegiatan</label>
                            <span
                                class="text-[10px] bg-slate-100 border border-slate-200 text-slate-500 font-extrabold px-2.5 py-0.5 rounded-md uppercase tracking-wider">Opsional</span>
                        </div>
                        <textarea name="deskripsi_album" rows="3"
                            placeholder="Masukkan keterangan tambahan mengenai rincian kegiatan ini jika ada..."
                            class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-medium text-slate-700 text-sm placeholder:font-normal placeholder:text-slate-400"></textarea>
                    </div>
                </div>

                {{-- BLOK 2: MULTI-UPLOAD FOTO DENGAN KETERANGAN INDIVIDUAL (MENGIKUTI image_a98845.jpg) --}}
                <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-6">
                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
                        <div>
                            <label class="block text-sm font-black text-slate-800 tracking-tight uppercase">Daftar Unggahan
                                Foto & Keterangan</label>
                            <p class="text-xs text-slate-500 font-medium mt-0.5">Unggah foto dokumentasi fisik lapangan
                                beserta label keterangannya.</p>
                        </div>
                        {{-- Tombol Tambah Baris Dinamis --}}
                        <button type="button" onclick="tambahBarisFoto()"
                            class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-wider rounded-xl transition shadow-md shadow-emerald-600/10 flex items-center gap-2 cursor-pointer">
                            <svg class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Foto
                        </button>
                    </div>

                    {{-- Wadah Generator Baris Dynamic Fields --}}
                    <div id="wrapper-baris-foto"
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                        {{-- BARIS ITEM PERTAMA (DEFAULT AWAL) --}}
                        <div
                            class="group bg-slate-50/50 p-4 rounded-2xl border border-slate-200 flex flex-col space-y-4 relative transition-all hover:bg-white hover:shadow-md hover:border-slate-300">
                            {{-- Drop Area Gambar --}}
                            <div
                                class="aspect-video w-full bg-white border border-slate-200 rounded-xl overflow-hidden relative flex items-center justify-center shadow-3xs">
                                <img id="raw-preview-1" class="w-full h-full object-cover hidden">
                                <label id="label-drop-1" for="input-file-1"
                                    class="w-full h-full flex flex-col items-center justify-center p-4 cursor-pointer text-slate-400 hover:text-blue-600 transition-colors">
                                    <svg class="w-6 h-6 stroke-[1.8]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-[9px] font-black uppercase tracking-wider mt-1.5 text-center">Pilih
                                        Gambar</span>
                                </label>
                                <input type="file" id="input-file-1" name="foto_kegiatan[]" required accept="image/*"
                                    class="hidden" onchange="bacaPreviewLokal(this, 1)">
                            </div>
                            {{-- Input Teks Keterangan Foto --}}
                            <div class="space-y-1">
                                <input type="text" name="keterangan_foto[]" required
                                    placeholder="Contoh: Bendung Moilong"
                                    class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-500 outline-none text-xs font-bold text-slate-800 text-center bg-white shadow-3xs placeholder:font-normal placeholder:text-slate-300">
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- JAVASCRIPT LOGIC GENERATOR SAKTI --}}
    <script>
        let counterFoto = 1;

        // Fungsi membaca gambar secara real-time lokal untuk preview kotak
        function bacaPreviewLokal(input, id) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let imgEl = document.getElementById('raw-preview-' + id);
                    let labelEl = document.getElementById('label-drop-' + id);

                    imgEl.src = e.target.result;
                    imgEl.classList.remove('hidden');
                    labelEl.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Fungsi menambah baris kartu foto dan keterangan secara unlimited
        function tambahBarisFoto() {
            counterFoto++;
            let wrapper = document.getElementById('wrapper-baris-foto');

            let nodeBaru = document.createElement('div');
            nodeBaru.id = 'kapsul-foto-' + counterFoto;
            nodeBaru.className =
                "group bg-slate-50/50 p-4 rounded-2xl border border-slate-200 flex flex-col space-y-4 relative transition-all hover:bg-white hover:shadow-md hover:border-slate-300 animate-fade-in";

            nodeBaru.innerHTML = `
            <!-- Tombol Hapus Baris Individual -->
            <button type="button" onclick="hapusBarisFoto(${counterFoto})" class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-100 hover:bg-red-600 text-red-600 hover:text-white rounded-full border border-red-200 flex items-center justify-center text-xs transition-colors shadow-sm cursor-pointer z-20 font-black">
                &times;
            </button>
            
            <!-- Drop Area Gambar -->
            <div class="aspect-video w-full bg-white border border-slate-200 rounded-xl overflow-hidden relative flex items-center justify-center shadow-3xs">
                <img id="raw-preview-${counterFoto}" class="w-full h-full object-cover hidden">
                <label id="label-drop-${counterFoto}" for="input-file-${counterFoto}" class="w-full h-full flex flex-col items-center justify-center p-4 cursor-pointer text-slate-400 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6 stroke-[1.8]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-[9px] font-black uppercase tracking-wider mt-1.5 text-center">Pilih Gambar</span>
                </label>
                <input type="file" id="input-file-${counterFoto}" name="foto_kegiatan[]" required accept="image/*" class="hidden" onchange="bacaPreviewLokal(this, ${counterFoto})">
            </div>

            <!-- Input Teks Keterangan Foto -->
            <div class="space-y-1">
                <input type="text" name="keterangan_foto[]" required placeholder="Contoh Keterangan..." class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-500 outline-none text-xs font-bold text-slate-800 text-center bg-white shadow-3xs placeholder:font-normal placeholder:text-slate-300">
            </div>
        `;

            wrapper.appendChild(nodeBaru);
        }

        // Fungsi menghapus baris kartu dinamis jika batal input
        function hapusBarisFoto(id) {
            let el = document.getElementById('kapsul-foto-' + id);
            if (el) {
                el.remove();
            }
        }
    </script>
@endsection
