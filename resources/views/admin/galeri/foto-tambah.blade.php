@extends('admin.layouts.app')

@section('title', 'Kelola Foto')

@section('content')
    <div class="max-w-7xl mx-auto space-y-10 animate-fade-in">

            {{-- ==================================================================
             PART A: FORM INPUT TAMBAH DATA (BAGIAN ATAS)
             ================================================================== --}}
            <div class="space-y-6">
                {{-- HEADER ACTION BAR --}}
                <div
                    class="bg-white/80 backdrop-blur-md p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-black text-slate-900 tracking-tight">Kelola Foto</h1>
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

                @if (session('error'))
                    <div
                        class="p-4 bg-amber-50 border border-amber-200 rounded-xl text-amber-800 text-xs font-bold shadow-sm">
                        ⚠️ {{ session('error') }}
                    </div>
                @endif

                {{-- NOTIFIKASI ERROR (VALIDASI) --}}
                @if ($errors->any())
                    <div class="p-5 bg-red-50 border border-red-200 rounded-xl shadow-sm space-y-2">
                        <div class="flex items-center gap-2 text-red-800 font-bold text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            Mohon periksa kembali isian Anda:
                        </div>
                        <ul class="list-disc list-inside text-xs text-red-600 font-medium ml-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM UTAMA --}}
                <form id="form-tambah-galeri" action="{{ route('admin.galeri.foto.simpan') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- DATA INDUK ALBUM --}}
                    <div class="bg-white p-6 sm:p-8 rounded-[2rem] border border-slate-200/80 shadow-sm space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Judul Album
                                    Foto (Contoh: BENDUNG IRIGASI)</label>
                                <input type="text" name="judul_album" required value="{{ old('judul_album') }}"
                                    placeholder="Masukkan judul album foto..."
                                    class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-extrabold text-slate-900 text-base placeholder:font-normal placeholder:text-slate-400">
                            </div>

                            <div class="space-y-2"
                                x-data="{ mode: 'select', kategori: @js(old('kategori', $kategoriList->first() ?? 'Umum')), open: false }">
                                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Kategori Album</label>
                                
                                <input type="hidden" name="kategori" x-model="kategori">

                                {{-- Mode 1: Custom Dropdown Select --}}
                                <div x-show="mode === 'select'" class="relative">
                                    <button type="button" @click="open = !open" @click.away="open = false"
                                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 outline-none transition-all font-extrabold text-slate-900 text-base bg-white flex justify-between items-center shadow-sm hover:border-slate-300">
                                        <span x-text="kategori || 'Pilih Kategori...'" :class="!kategori ? 'text-slate-400 font-normal' : ''"></span>
                                        <svg class="w-5 h-5 text-slate-400 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>

                                    <div x-show="open" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                         x-transition:leave="transition ease-in duration-100"
                                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                         x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                                         style="display: none;"
                                         class="absolute z-50 w-full mt-2 bg-white/95 backdrop-blur-xl border border-slate-200/80 rounded-2xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] overflow-hidden py-2">
                                         
                                        <div class="max-h-52 overflow-y-auto scrollbar-thin">
                                            @foreach($kategoriList as $kat)
                                                <div class="flex items-center justify-between w-full hover:bg-blue-50/80 group transition-colors">
                                                    <button type="button" @click="kategori = @js($kat); open = false"
                                                        class="flex-1 text-left px-5 py-3 text-sm font-bold text-slate-700 group-hover:text-blue-600 transition-colors flex items-center justify-between">
                                                        {{ $kat }}
                                                        <svg x-show="kategori === @js($kat)" style="display: none;" class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                    </button>
                                                    
                                                    <div class="pr-4 pl-2">
                                                        <button type="button" @click.stop="window.hapusKategoriAlbum(@js($kat))"
                                                            class="w-7 h-7 flex items-center justify-center rounded-lg text-slate-300 hover:text-red-500 hover:bg-red-50 transition-colors cursor-pointer"
                                                            title="Hapus Kategori">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="px-3 pt-2 pb-1 border-t border-slate-100/80 mt-1">
                                            <button type="button" @click="mode = 'input'; kategori = ''; open = false; $nextTick(() => $refs.kategoriInput.focus());"
                                                class="w-full text-left px-4 py-3 text-xs font-black text-blue-600 bg-blue-50/50 hover:bg-blue-600 hover:text-white rounded-xl transition-all flex items-center gap-2 group shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                                Tambah Kategori Baru...
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Mode 2: Input Text --}}
                                <div x-show="mode === 'input'" style="display: none;" class="relative animate-fade-in">
                                    <input type="text" x-ref="kategoriInput" x-model="kategori"
                                        placeholder="Ketik nama kategori baru (contoh: Inspeksi)..."
                                        class="w-full px-5 py-4 rounded-2xl border border-blue-400 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 outline-none transition-all font-extrabold text-slate-900 text-base placeholder:font-normal placeholder:text-slate-400 pr-24 shadow-sm bg-white">
                                    
                                    <button type="button" @click="mode = 'select'; kategori = @js($kategoriList->first() ?? 'Umum')" 
                                        class="absolute right-3 top-1/2 -translate-y-1/2 px-4 py-2 bg-slate-100 hover:bg-red-50 text-slate-500 hover:text-red-600 text-xs font-bold rounded-xl transition-all cursor-pointer shadow-sm">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">Deskripsi
                                    Foto</label>
                                <span
                                    class="text-[10px] bg-slate-100 border border-slate-200 text-slate-500 font-extrabold px-2.5 py-0.5 rounded-md uppercase tracking-wider">Opsional</span>
                            </div>
                            <textarea name="deskripsi_album" rows="3"
                                placeholder="Masukkan keterangan tambahan mengenai rincian foto ini jika ada..."
                                class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-600 outline-none transition font-medium text-slate-700 text-sm placeholder:font-normal placeholder:text-slate-400">{{ old('deskripsi_album') }}</textarea>
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

            <form id="form-hapus-kategori-album" action="{{ route('admin.galeri.foto.kategori.hapus') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="kategori" id="hapus-kategori-album-input">
            </form>

            <hr class="border-slate-200/60 my-6">

            {{-- ==================================================================
             PART B: TABEL/GRID DAFTAR YANG SUDAH TERUPLOAD
             ================================================================== --}}
            <div class="space-y-4">
                <div class="flex items-center space-x-2.5 px-1">
                    <span class="h-4 w-1 bg-blue-600 rounded-full shadow-xs"></span>
                    <h2 class="text-sm font-black text-slate-800 uppercase tracking-wider">Daftar Album Foto Terunggah Aktif</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($albums ?? [] as $album)
                        <div data-fotos="{{ json_encode($album->fotos) }}"
                             data-judul="{{ $album->judul_album }}"
                             data-deskripsi="{{ $album->deskripsi_album }}"
                             onclick="if(!event.target.closest('form')) { bukaModalGaleri(JSON.parse(this.dataset.fotos), this.dataset.judul, this.dataset.deskripsi); }"
                            class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs flex flex-col justify-between group hover:shadow-md transition-all duration-300 cursor-pointer">

                            {{-- Preview Cover Gambar Pertama --}}
                            <div
                                class="aspect-video w-full bg-slate-100 relative overflow-hidden border-b border-slate-100 flex items-center justify-center">
                                @if ($album->fotos && $album->fotos->count() > 0)
                                    <img src="{{ $album->fotos[0]->url_foto }}"
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
                                    <div class="flex items-start justify-between gap-2">
                                        <h4
                                            class="text-sm font-black text-slate-900 uppercase tracking-tight break-words leading-tight">
                                            {{ $album->judul_album }}
                                        </h4>
                                    </div>
                                    <div class="inline-block">
                                        <span class="px-2.5 py-1 rounded-md bg-blue-50 text-blue-600 border border-blue-100 text-[9px] font-black uppercase tracking-widest inline-flex items-center gap-1 shadow-sm">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                            {{ $album->kategori ?: 'Tanpa Kategori' }}
                                        </span>
                                    </div>
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
                            Belum ada arsip album foto tercatat
                        </div>
                    @endforelse
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

        function hapusKategoriAlbum(namaKategori) {
            if (!confirm(`Yakin ingin menghapus kategori "${namaKategori}"? Semua album terkait akan dipindahkan ke kategori Umum.`)) {
                return;
            }

            document.getElementById('hapus-kategori-album-input').value = namaKategori;
            document.getElementById('form-hapus-kategori-album').submit();
        }
    </script>
    {{-- Modal Galeri (Admin Preview) --}}
    <div id="modal-galeri"
        class="fixed inset-0 z-[9999] invisible opacity-0 transition-all duration-300 ease-out bg-slate-950/95 backdrop-blur-xl flex items-center justify-center p-3 sm:p-4 md:p-8">
        <div class="absolute inset-0 cursor-pointer" onclick="tutupModalGaleri()"></div>

        <div id="modal-galeri-content"
            class="relative bg-white w-full max-w-6xl rounded-[2rem] sm:rounded-[2.5rem] overflow-hidden shadow-[0_25px_70px_rgba(0,0,0,0.5)] z-10 flex flex-col md:flex-row h-[90vh] md:h-[80vh] border border-white/10 transform scale-95 opacity-0 transition-all duration-300 ease-out delay-75">

            <div class="flex-1 bg-slate-950 flex items-center justify-center relative overflow-hidden group/frame min-h-[40vh] md:min-h-0">
                <img id="modal-img-active" src="" alt="Active Visual" loading="lazy"
                    class="max-w-full max-h-full object-contain p-4 select-none drop-shadow-[0_10px_20px_rgba(0,0,0,0.3)] transition-all duration-500">

                <div class="absolute bottom-4 inset-x-4 bg-slate-950/40 backdrop-blur-md px-5 py-3.5 rounded-2xl border border-white/10 text-center shadow-lg transform transition-transform duration-300">
                    <p id="modal-img-caption" class="text-white text-xs md:text-sm font-black uppercase tracking-widest drop-shadow-xs"></p>
                </div>

                <button onclick="sliderNavigasi(-1)"
                    class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 bg-slate-900/60 hover:bg-blue-600 text-white rounded-full flex items-center justify-center text-base border border-white/10 shadow-lg transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer group/btn">
                    <svg class="w-5 h-5 group-hover/btn:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <button onclick="sliderNavigasi(1)"
                    class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 bg-slate-900/60 hover:bg-blue-600 text-white rounded-full flex items-center justify-center text-base border border-white/10 shadow-lg transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer group/btn">
                    <svg class="w-5 h-5 group-hover/btn:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>

            <div class="w-full md:w-[360px] bg-slate-50 p-6 sm:p-8 flex flex-col justify-between overflow-y-auto border-t md:border-t-0 md:border-l border-slate-200/60 h-[50vh] md:h-full">
                <div class="space-y-5">
                    <div class="flex justify-between items-start gap-4">
                        <div class="space-y-1">
                            <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest bg-blue-50 border border-blue-200/60 px-2.5 py-1 rounded-md block w-fit shadow-3xs">
                                Preview Album
                            </span>
                            <h2 id="modal-title" class="text-lg font-black text-slate-900 uppercase tracking-tight leading-tight mt-1"></h2>
                        </div>
                        <button onclick="tutupModalGaleri()"
                            class="w-8 h-8 rounded-xl bg-white hover:bg-red-500 border border-slate-200 text-slate-400 hover:text-white flex items-center justify-center text-lg font-bold transition-all shadow-3xs active:scale-95 cursor-pointer">
                            &times;
                        </button>
                    </div>

                    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-3xs">
                        <p id="modal-desc" class="text-xs text-slate-500 font-semibold leading-relaxed max-h-36 overflow-y-auto pr-1 scrollbar-thin"></p>
                    </div>
                </div>

                <div class="mt-8 pt-4 border-t border-slate-200/80 space-y-3">
                    <div class="flex justify-between items-center px-0.5">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Daftar Koleksi Foto</p>
                        <span id="modal-counter-badge" class="text-[10px] font-black text-blue-600 bg-white px-2 py-0.5 rounded-md border border-slate-200 shadow-3xs"></span>
                    </div>
                    <div id="modal-thumb-container" class="grid grid-cols-4 gap-2.5 max-h-36 overflow-y-auto p-0.5 scrollbar-thin"></div>
                </div>
            </div>

        </div>
    </div>

    <script>
        let koleksiFotoAktif = [];
        let indexAktif = 0;

        function bukaModalGaleri(fotos, judul, deskripsi) {
            if (!fotos || fotos.length === 0) return;

            koleksiFotoAktif = fotos;
            indexAktif = 0;

            document.getElementById('modal-title').innerText = judul;
            document.getElementById('modal-desc').innerText = deskripsi ? deskripsi :
                'Tidak ada rincian deskripsi tambahan mengenai album foto ini.';

            let thumbContainer = document.getElementById('modal-thumb-container');
            thumbContainer.innerHTML = '';

            koleksiFotoAktif.forEach((foto, index) => {
                let thumb = document.createElement('div');
                thumb.className = `aspect-square bg-white border rounded-xl overflow-hidden cursor-pointer shadow-3xs transition-all duration-300 hover:scale-105 ${index === 0 ? 'border-blue-600 ring-4 ring-blue-600/10 scale-102' : 'border-slate-200'}`;
                thumb.id = `thumb-item-${index}`;
                thumb.onclick = (e) => { e.stopPropagation(); gantiFotoAktif(index); };
                thumb.innerHTML = `<img src="${foto.url_foto || '/storage/' + foto.path_foto}" loading="lazy" class="w-full h-full object-cover select-none">`;
                thumbContainer.appendChild(thumb);
            });

            gantiFotoAktif(0);

            let modal = document.getElementById('modal-galeri');
            let modalContent = document.getElementById('modal-galeri-content');

            modal.classList.remove('invisible', 'opacity-0');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');

            document.body.style.overflow = 'hidden';
        }

        function gantiFotoAktif(index) {
            let oldThumb = document.getElementById(`thumb-item-${indexAktif}`);
            if (oldThumb) {
                oldThumb.className = "aspect-square bg-white border border-slate-200 rounded-xl overflow-hidden cursor-pointer shadow-3xs transition-all duration-300 hover:scale-105";
            }

            indexAktif = index;

            let newThumb = document.getElementById(`thumb-item-${indexAktif}`);
            if (newThumb) {
                newThumb.className = "aspect-square bg-white border border-blue-600 rounded-xl overflow-hidden cursor-pointer shadow-3xs transition-all duration-300 scale-105 ring-4 ring-blue-600/10";
                newThumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
            }

            let dataFoto = koleksiFotoAktif[indexAktif];
            document.getElementById('modal-img-active').src = dataFoto.url_foto || `/storage/${dataFoto.path_foto}`;
            document.getElementById('modal-img-caption').innerText = dataFoto.keterangan_foto ? dataFoto.keterangan_foto : 'Dokumentasi Foto';
            document.getElementById('modal-counter-badge').innerText = `${indexAktif + 1} / ${koleksiFotoAktif.length}`;
        }

        function sliderNavigasi(arah) {
            let indexBaru = indexAktif + arah;
            if (indexBaru >= 0 && indexBaru < koleksiFotoAktif.length) {
                gantiFotoAktif(indexBaru);
            } else if (indexBaru < 0) {
                gantiFotoAktif(koleksiFotoAktif.length - 1);
            } else {
                gantiFotoAktif(0);
            }
        }

        function tutupModalGaleri() {
            let modal = document.getElementById('modal-galeri');
            let modalContent = document.getElementById('modal-galeri-content');

            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('invisible');
                document.body.style.overflow = '';
            }, 300);
        }

        document.addEventListener('keydown', function(e) {
            let modal = document.getElementById('modal-galeri');
            if (modal && !modal.classList.contains('invisible')) {
                if (e.key === 'ArrowLeft') sliderNavigasi(-1);
                if (e.key === 'ArrowRight') sliderNavigasi(1);
                if (e.key === 'Escape') tutupModalGaleri();
            }
        });
    </script>
@endsection
