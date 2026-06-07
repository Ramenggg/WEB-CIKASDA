@extends('admin.layouts.app')

@section('title', 'Kelola Sejarah Singkat')

@section('content')
    <div class="w-full pb-12 animate-fade-in">

        <div
            class="w-full bg-white/90 backdrop-blur-md rounded-3xl shadow-[0_4px_30px_rgba(15,23,42,0.04)] border border-slate-200/80 overflow-hidden">

            <div
                class="p-6 border-b border-slate-100 bg-linear-to-r from-slate-50 via-white to-slate-50 flex justify-between items-center">
                <div class="flex items-center space-x-3.5">
                    <div
                        class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 uppercase tracking-tight text-sm">Manajemen Sejarah Singkat
                        </h4>
                        <p class="text-[11px] text-slate-500 font-medium mt-0.5">Konfigurasi naskah lini masa dan sejarah pembentukan dinas.</p>
                    </div>
                </div>
                <span
                    class="text-[10px] bg-blue-50 border border-blue-200 text-blue-700 font-black px-3 py-1 rounded-full uppercase tracking-wider">
                    Control Center
                </span>
            </div>

            {{-- Notifikasi Sukses / Hapus --}}
            @if (session('success'))
                <div
                    class="mx-8 mt-6 px-5 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-800 text-sm font-bold shadow-2xs flex items-center space-x-2">
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

            <form action="{{ route('admin.profil.update', 'sejarah') }}" method="POST" enctype="multipart/form-data"
                class="divide-y divide-slate-100">
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
                    <input type="hidden" name="hero_description" id="hidden-hero"
                        value="{{ old('hero_description', $item->hero_description ?? '') }}">
                </div>

                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div
                                class="h-7 w-7 rounded-lg bg-blue-50 border border-blue-200 text-blue-600 flex items-center justify-center font-black text-xs shadow-2xs">
                                ●
                            </div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">
                                Uraian Naskah Sejarah (Format Teks)
                            </label>
                        </div>

                        @if (isset($item->content_data) && !empty(trim($item->content_data)) && $item->content_data !== '<p><br></p>')
                            <button type="button" onclick="confirmDeleteSection('text')"
                                class="text-[11px] bg-red-50 border border-red-200 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-md transition-all cursor-pointer">
                                Hapus Teks
                            </button>
                        @endif
                    </div>

                    <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-2xs bg-white">
                        <div id="editor-cikasda">{!! old('konten', $item->content_data ?? '') !!}</div>
                    </div>

                    <input type="hidden" name="konten" id="hidden-konten"
                        value="{{ old('konten', $item->content_data ?? '') }}">
                </div>

                {{-- Upload Gambar & PDF telah dihapus sesuai permintaan --}}

                <div class="p-6 bg-slate-50/50 flex items-center justify-end border-t border-slate-100">
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-14 py-3.5 rounded-xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 shadow-md shadow-blue-600/20 active:scale-98 cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

            <form id="form-hapus-komponen" action="{{ route('admin.profil.update', 'sejarah') }}" method="POST"
                class="hidden">
                @csrf
                <input type="hidden" name="target_hapus" id="input-target-hapus">
                <input type="hidden" name="konten" id="hidden-konten-backup">
            </form>

        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        var quill = new Quill('#editor-cikasda', {
            theme: 'snow',
            placeholder: 'Ketik jajaran sejarah panjang, transformasi, dan lini masa berdirinya Dinas di sini...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'blockquote'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    ['link'],
                    ['clean']
                ]
            }
        });

        
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
        quillHero.on('text-change', function() {
            document.getElementById('hidden-hero').value = quillHero.root.innerHTML;
        });
quill.on('text-change', function() {
            document.getElementById('hidden-konten').value = quill.root.innerHTML;
        });

        // Fitur preview gambar dihapus

        function confirmDeleteSection(type) {
            let namaKomponen = type === 'text' ? 'NASKA_TEKS' : (type === 'image' ? 'FOTO ARSIP' : 'BERKAS PDF');
            let check1 = confirm("Apakah Anda yakin ingin menghapus komponen " + namaKomponen + " Sejarah Singkat?");
            if (check1) {
                let check2 = confirm(
                    "⚠️ PERINGATAN KEDUA:\nTindakan ini bersifat PERMANEN dan akan langsung menghapus berkas di server Supabase.\n\nApakah Anda benar-benar serius?"
                    );
                if (check2) {
                    document.getElementById('input-target-hapus').value = type;
                    document.getElementById('hidden-konten-backup').value = quill.root.innerHTML;
                    document.getElementById('form-hapus-komponen').submit();
                }
            }
        }
    </script>
@endsection
