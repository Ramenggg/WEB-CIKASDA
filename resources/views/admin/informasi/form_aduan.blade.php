@extends('admin.layouts.app')

@section('title', 'Kelola Form Aduan Masyarakat')

@section('content')
    <div class="w-full pb-12 animate-fade-in">

        <div class="w-full bg-white/90 backdrop-blur-md rounded-3xl shadow-[0_4px_30px_rgba(15,23,42,0.04)] border border-slate-200/80 overflow-hidden">

            <div class="p-6 border-b border-slate-100 bg-linear-to-r from-slate-50 via-white to-slate-50 flex justify-between items-center">
                <div class="flex items-center space-x-3.5">
                    <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 uppercase tracking-tight text-sm">Manajemen Halaman Aduan</h4>
                        <p class="text-[11px] text-slate-500 font-medium mt-0.5">Konfigurasi naskah hero dan banner infografis aduan masyarakat.</p>
                    </div>
                </div>
                <span class="text-[10px] bg-blue-50 border border-blue-200 text-blue-700 font-black px-3 py-1 rounded-full uppercase tracking-wider">
                    Aduan
                </span>
            </div>

            @if (session('success'))
                <div class="mx-8 mt-6 px-5 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-800 text-sm font-bold shadow-2xs flex items-center space-x-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mx-8 mt-6 px-5 py-4 bg-red-50 border border-red-100 rounded-2xl text-red-800 text-sm font-bold shadow-2xs">
                    <div class="flex items-center space-x-2 mb-2 text-red-900 font-extrabold uppercase tracking-wide text-xs">
                        ⚠️ Gagal Menyimpan:
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.informasi.update', 'form-aduan') }}" method="POST" enctype="multipart/form-data" class="divide-y divide-slate-100">
                @csrf

                {{-- HERO DESCRIPTION --}}
                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex items-center space-x-3">
                        <div class="h-7 w-7 rounded-lg bg-indigo-50 border border-indigo-200 text-indigo-600 flex items-center justify-center font-black text-xs shadow-2xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">Deskripsi Singkat Banner (Hero)</label>
                            <span class="text-[10px] text-slate-400 font-semibold">Teks ini tampil di area hero/banner halaman publik</span>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 shadow-2xs bg-white overflow-hidden">
                        <div id="editor-hero">{!! old('hero_description', $item->hero_description ?? '') !!}</div>
                    </div>
                    <input type="hidden" name="hero_description" id="hidden-hero" value="{{ old('hero_description', $item->hero_description ?? '') }}">
                </div>

                {{-- BANNER IMAGE --}}
                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div class="h-7 w-7 rounded-lg bg-blue-50 border border-blue-200 text-blue-600 flex items-center justify-center font-black text-xs shadow-2xs">
                                🖼️
                            </div>
                            <div>
                                <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">Gambar / Infografis Banner Aduan</label>
                                <span class="text-[10px] text-slate-400 font-semibold">Gambar ini akan tampil di bagian kanan kartu aduan halaman publik</span>
                            </div>
                        </div>

                        @if (isset($item->primary_image_path) && $item->primary_image_path)
                            <button type="button" onclick="confirmDeleteSection('image')"
                                class="text-[11px] bg-red-50 border border-red-200 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-md transition-all cursor-pointer">
                                Hapus Gambar
                            </button>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-slate-50/40 p-5 rounded-2xl border border-slate-200/50">
                        <div class="lg:col-span-4 w-full aspect-video bg-white rounded-xl border border-slate-200 flex items-center justify-center overflow-hidden shadow-2xs shrink-0 group relative">
                            @if (isset($item->primary_image_path) && $item->primary_image_path)
                                <img id="preview-gambar" src="{{ Storage::url($item->primary_image_path) }}"
                                    class="w-full h-full object-contain">
                            @else
                                <div id="preview-placeholder" class="text-center p-4">
                                    <span class="text-3xl block mb-2">🎨</span>
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">Belum Ada Gambar</span>
                                    <span class="text-[9px] text-slate-400 font-semibold mt-1 block">(Menggunakan default ilustrasi)</span>
                                </div>
                                <img id="preview-gambar" class="w-full h-full object-contain hidden">
                            @endif
                        </div>

                        <div class="lg:col-span-8 w-full space-y-3.5">
                            <input type="file" name="gambar" onchange="previewImage(event)" accept="image/*"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-slate-900 file:text-white hover:file:bg-blue-600 file:transition-all file:cursor-pointer file:shadow-xs">

                            <div class="bg-white p-4 rounded-xl border border-slate-200 text-[11px] text-slate-650 font-semibold leading-relaxed shadow-3xs">
                                <div class="flex items-center space-x-1.5 text-blue-750 font-bold mb-1">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>STANDAR EKSTENSI GAMBAR:</span>
                                </div>
                                Format Gambar Valid: <span class="text-slate-900 font-bold">PNG, JPG, JPEG, WEBP</span> •
                                Batas Maksimal Kapasitas: <span class="text-slate-900 font-bold">5 Megabytes (5MB)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-slate-50/50 flex items-center justify-end border-t border-slate-100">
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-14 py-3.5 rounded-xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 shadow-md shadow-blue-600/20 active:scale-98 cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

            {{-- Form Hapus Komponen Tersembunyi --}}
            <form id="form-hapus-komponen" action="{{ route('admin.informasi.update', 'form-aduan') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="target_hapus" id="input-target-hapus">
            </form>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        var quillHero = new Quill('#editor-hero', {
            theme: 'snow',
            placeholder: 'Ketik deskripsi singkat untuk banner hero halaman publik...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });
        
        // Bersihkan style background dan warna text bawaan saat copy-paste agar tidak merusak tampilan website
        quillHero.clipboard.addMatcher(Node.ELEMENT_NODE, function(node, delta) {
            var ops = delta.ops || delta;
            if (Array.isArray(ops)) {
                ops.forEach(function(op) {
                    if (op.attributes) {
                        delete op.attributes.background;
                        delete op.attributes.color;
                    }
                });
            }
            return delta;
        });

        quillHero.on('text-change', function() {
            document.getElementById('hidden-hero').value = quillHero.root.innerHTML;
        });

        function previewImage(event) {
            let input = event.target;
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.getElementById('preview-gambar');
                    let placeholder = document.getElementById('preview-placeholder');
                    if (img) {
                        img.src = e.target.result;
                        img.classList.remove('hidden');
                    }
                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function confirmDeleteSection(type) {
            let check1 = confirm("Apakah Anda yakin ingin menghapus gambar banner aduan ini?");
            if (check1) {
                let check2 = confirm("⚠️ PERINGATAN KEDUA:\nTindakan ini bersifat PERMANEN.\n\nApakah Anda benar-benar serius?");
                if (check2) {
                    document.getElementById('input-target-hapus').value = type;
                    document.getElementById('form-hapus-komponen').submit();
                }
            }
        }
    </script>
@endsection
