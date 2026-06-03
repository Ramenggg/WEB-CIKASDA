@extends('admin.layouts.app')

@section('title', 'Kelola Foto Kegiatan')

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

        <div class="max-w-7xl mx-auto space-y-10">

            {{-- ==================================================================
             PART A: FORM INPUT TAMBAH DATA (BAGIAN ATAS)
             ================================================================== --}}
            <div class="space-y-6">
                {{-- HEADER ACTION BAR --}}
                <div
                    class="bg-white/80 backdrop-blur-md p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-black text-slate-900 tracking-tight">Kelola Foto Kegiatan</h1>
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

                {{-- NOTIFIKASI SUKSES --}}
                @if (session('success'))
                    <div
                        class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-800 text-xs font-bold shadow-sm">
                        🎉 {{ session('success') }}
                    </div>
                @endif

                {{-- FORM UTAMA --}}
                <form id="form-tambah-galeri" action="{{ route('admin.galeri.foto.simpan') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- DATA INDUK ALBUM --}}
                    <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-6">
                        <div class="space-y-2">
                            <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Judul Album
                                Kegiatan (Contoh: BENDUNG IRIGASI)</label>
                            <input type="text" name="judul_album" required
                                placeholder="Masukkan judul album foto kegiatan resmi..."
                                class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-extrabold text-slate-900 text-base placeholder:font-normal placeholder:text-slate-400">
                        </div>

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

                    {{-- INPUT DYNAMIC MULTI-UPLOAD FOTO MASSAL (FIX MULTI-SELECT) --}}
                    <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-6">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
                            <div>
                                <label class="block text-sm font-black text-slate-800 tracking-tight uppercase">Daftar
                                    Unggahan Foto & Keterangan</label>
                                <p class="text-xs text-slate-500 font-medium mt-0.5">Kamu bisa langsung memilih banyak foto
                                    sekaligus dari komputermu. Keterangan foto bersifat opsional.</p>
                            </div>

                            {{-- Tombol Pemicu File Input Massal --}}
                            <label for="file-input-massal"
                                class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-wider rounded-xl transition shadow-md shadow-emerald-600/10 flex items-center gap-2 cursor-pointer">
                                <svg class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Banyak Foto
                            </label>
                            {{-- Input File Multiple Tersembunyi --}}
                            <input type="file" id="file-input-massal" name="foto_kegiatan[]" accept="image/*" multiple
                                class="hidden" onchange="generatePreviewMassal(this)">
                        </div>

                        {{-- Wadah Grid Tempat Menampung Semua Preview Gambar Terpilih --}}
                        <div id="wrapper-baris-foto"
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            {{-- Placeholder default saat admin belum memilih file --}}
                            <div id="placeholder-kosong"
                                class="col-span-full py-12 text-center border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Belum ada foto yang
                                    dipilih. Silakan klik tombol di atas.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <hr class="border-slate-200/60 my-6">

            {{-- ==================================================================
             PART B: TABEL/GRID DAFTAR YANG SUDAH TERUPLOAD
             ================================================================== --}}
            <div class="space-y-4">
                <div class="flex items-center space-x-2.5 px-1">
                    <span class="h-4 w-1 bg-blue-600 rounded-full shadow-xs"></span>
                    <h2 class="text-sm font-black text-slate-800 uppercase tracking-wider">Daftar Album Terunggah Aktif</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($albums ?? [] as $album)
                        <div
                            class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs flex flex-col justify-between group hover:shadow-md transition-all duration-300">

                            {{-- Preview Cover Gambar Pertama --}}
                            <div
                                class="aspect-video w-full bg-slate-100 relative overflow-hidden border-b border-slate-100 flex items-center justify-center">
                                @if ($album->fotos && $album->fotos->count() > 0)
                                    <img src="{{ asset('storage/' . $album->fotos[0]->path_foto) }}"
                                        alt="Preview {{ $album->judul_album }}" class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full flex flex-col items-center justify-center text-slate-300 bg-slate-50 text-[10px] font-black uppercase tracking-wider gap-1">
                                        <svg class="w-6 h-6 stroke-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>Gambar Tidak Terbaca</span>
                                    </div>
                                @endif
                                <span
                                    class="absolute top-3 right-3 bg-slate-900/70 backdrop-blur-xs text-white text-[9px] font-black px-2 py-0.5 rounded">
                                    {{ $album->fotos ? $album->fotos->count() : 0 }} FOTO
                                </span>
                            </div>

                            {{-- Metadata Album --}}
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                                <div class="space-y-1">
                                    <h4
                                        class="text-sm font-black text-slate-900 uppercase tracking-tight break-words leading-tight">
                                        {{ $album->judul_album }}
                                    </h4>
                                    <p class="text-xs text-slate-400 font-medium line-clamp-2 leading-relaxed">
                                        {{ $album->deskripsi_album ?? 'Tidak ada deskripsi.' }}
                                    </p>
                                </div>

                                {{-- PANEL BUTTONS (HAPUS DIRECT PERMANEN) --}}
                                <div class="pt-3 border-t border-slate-100 flex items-center justify-end">
                                    <form action="{{ route('admin.galeri.foto.hapus', $album->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus permanen album beserta semua berkas fisiknya?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white border border-red-100 font-black text-[10px] uppercase tracking-wider rounded-xl transition-all cursor-pointer">
                                            🗑️ Hapus Album
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full bg-white rounded-2xl p-12 border border-slate-200 text-center text-xs font-black text-slate-400 uppercase tracking-widest">
                            Belum ada arsip album foto kegiatan tercatat
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    {{-- JAVASCRIPT ENGINE DYNAMIC MASSAL GENERATOR (KETERANGAN OPSIONAL) --}}
    {{-- JAVASCRIPT ENGINE DYNAMIC MASSAL GENERATOR + FITUR HAPUS INDIVIDUAL --}}
    <script>
        // Variabel global untuk menyimpan array file yang sedang aktif di antrean
        let fileCollection = [];

        function generatePreviewMassal(input) {
            let wrapper = document.getElementById('wrapper-baris-foto');

            // Masukkan file terpilih baru ke dalam array koleksi kita
            if (input.files && input.files.length > 0) {
                fileCollection = Array.from(input.files);
                renderUlangPreview();
            }
        }

        // Fungsi pusat untuk menggambar ulang kotak-kotak preview sesuai isi array terbaru
        function renderUlangPreview() {
            let wrapper = document.getElementById('wrapper-baris-foto');
            wrapper.innerHTML = ''; // Bersihkan layar lama

            if (fileCollection.length > 0) {
                fileCollection.forEach((file, index) => {
                    let reader = new FileReader();

                    let nodeBaru = document.createElement('div');
                    nodeBaru.id = `antrean-foto-${index}`;
                    nodeBaru.className =
                        "group bg-slate-50/50 p-4 rounded-2xl border border-slate-200 flex flex-col space-y-4 relative transition-all hover:bg-white hover:shadow-md hover:border-slate-300 animate-fade-in";

                    let namaFileTanpaEkstensi = file.name.split('.').slice(0, -1).join('.');

                    nodeBaru.innerHTML = `
                        <button type="button" onclick="hapusSatuFotoAntrean(${index})" 
                            class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-100 hover:bg-red-600 text-red-600 hover:text-white rounded-full border border-red-200 flex items-center justify-center text-xs transition-colors shadow-xs cursor-pointer z-20 font-black">
                            &times;
                        </button>

                        <div class="aspect-video w-full bg-white border border-slate-200 rounded-xl overflow-hidden relative flex items-center justify-center shadow-3xs">
                            <img id="mass-preview-${index}" class="w-full h-full object-cover">
                        </div>
                        
                        <div class="space-y-1">
                            <div class="flex justify-between items-center px-1 mb-0.5">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-wider">Keterangan Foto</span>
                                <span class="text-[8px] text-slate-400 font-bold uppercase tracking-wider italic">Opsional</span>
                            </div>
                            <input type="text" name="keterangan_foto[]" placeholder="Contoh: ${namaFileTanpaEkstensi}" 
                                class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-500 outline-none text-xs font-bold text-slate-800 text-center bg-white shadow-3xs placeholder:font-normal placeholder:text-slate-300">
                        </div>
                    `;

                    wrapper.appendChild(nodeBaru);

                    // Render gambar secara visual ke tag img terkait
                    reader.onload = function(e) {
                        document.getElementById(`mass-preview-${index}`).src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                });

                // Sinkronisasikan array memory Javascript kita ke dalam input file HTML asli
                syncFileAntreanToDOM();

            } else {
                // Jika semua foto habis dihapus, munculkan teks kosong kembali
                wrapper.innerHTML = `
                    <div id="placeholder-kosong" class="col-span-full py-12 text-center border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Belum ada foto yang dipilih. Silakan klik tombol di atas.</p>
                    </div>
                `;
                document.getElementById('file-input-massal').value = "";
            }
        }

        // Fungsi eksekusi tombol silang merah untuk membuang item dari antrean array
        function hapusSatuFotoAntrean(indexTarget) {
            // Buang 1 item berdasarkan urutan index-nya
            fileCollection.splice(indexTarget, 1);

            // Gambar ulang semua kotak agar urutan id-nya tertata kembali dengan benar
            renderUlangPreview();
        }

        // Fungsi sakti untuk memaksa memori input file HTML menuruti isi array Javascript terbaru
        function syncFileAntreanToDOM() {
            let inputMassal = document.getElementById('file-input-massal');
            let dataTransfer = new DataTransfer();

            fileCollection.forEach(file => {
                dataTransfer.items.add(file);
            });

            // Daftarkan file yang tersisa ke DOM input file Laravel
            inputMassal.files = dataTransfer.files;
        }
    </script>
@endsection
