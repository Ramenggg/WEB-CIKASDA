@extends('admin.layouts.app')

@section('title', 'Kelola Pejabat Struktural')

@section('content')
    @php
        $dataPejabat = $item->content_data ?? [];
        $namaKadis = $dataPejabat['nama_kadis'] ?? '';
        $biografiKadis = $dataPejabat['biografi_kadis'] ?? '';
        $namaSekretaris = $dataPejabat['nama_sekretaris'] ?? '';
        $biografiSekretaris = $dataPejabat['biografi_sekretaris'] ?? '';
    @endphp

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
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 uppercase tracking-tight text-sm">Manajemen Pejabat Struktural</h4>
                        <p class="text-[11px] text-slate-500 font-medium mt-0.5">Konfigurasi profil komprehensif Kepala Dinas dan Sekretaris Dinas.</p>
                    </div>
                </div>
                <span
                    class="text-[10px] bg-blue-50 border border-blue-200 text-blue-700 font-black px-3 py-1 rounded-full uppercase tracking-wider">
                    Control Center
                </span>
            </div>

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

            <form id="form-pejabat" action="{{ route('admin.profil.update', 'pejabat') }}" method="POST" enctype="multipart/form-data"
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

                {{-- KEPALA DINAS --}}
                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center space-x-3">
                            <div
                                class="h-7 w-7 rounded-lg bg-blue-50 border border-blue-200 text-blue-600 flex items-center justify-center font-black text-xs shadow-2xs">
                                ●
                            </div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">
                                Profil Kepala Dinas
                            </label>
                        </div>
                        @if (isset($item->primary_image_path) && $item->primary_image_path)
                            <button type="button" onclick="confirmDeleteSection('image')"
                                class="text-[11px] bg-red-50 border border-red-200 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-md transition-all cursor-pointer">
                                Hapus Gambar
                            </button>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start bg-slate-50/40 p-5 rounded-2xl border border-slate-200/50">
                        <div class="lg:col-span-4 w-full aspect-[3/4] bg-white rounded-xl border border-slate-200 flex items-center justify-center overflow-hidden shadow-2xs">
                            <img id="preview-kadis"
                                src="{{ $item->primary_image_path ? Storage::url($item->primary_image_path) : asset('images/pejabat/kadis.png') }}"
                                class="w-full h-full object-cover {{ !$item->primary_image_path ? 'opacity-80' : '' }}">
                        </div>
                        <div class="lg:col-span-8 w-full space-y-5">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Nama Lengkap & Gelar</label>
                                <input type="text" name="nama_kadis" value="{{ old('nama_kadis', $namaKadis) }}" placeholder="Contoh: Dr. Ir. H. Fulan, S.T., M.T." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-2xs placeholder-slate-300">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Unggah Foto Resmi (Gambar 1)</label>
                                <input type="file" name="gambar" onchange="previewImage(event, 'preview-kadis')" accept="image/*"
                                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-slate-900 file:text-white hover:file:bg-blue-600 file:transition-all file:cursor-pointer file:shadow-xs">
                                <div class="mt-3 bg-white p-3 rounded-lg border border-slate-200 text-[10px] text-slate-500 font-semibold shadow-3xs uppercase tracking-wider">
                                    Disarankan rasio 3:4 latar putih/transparan. PNG/JPG Maks 2MB.
                                </div>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Riwayat Pendidikan & Karier (Biografi)</label>
                                <div class="rounded-xl overflow-hidden border border-slate-200 shadow-2xs bg-white">
                                    <div id="editor-kadis">{!! old('biografi_kadis', $biografiKadis) !!}</div>
                                </div>
                                <input type="hidden" name="biografi_kadis" id="hidden-biografi-kadis">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SEKRETARIS DINAS --}}
                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center space-x-3">
                            <div
                                class="h-7 w-7 rounded-lg bg-blue-50 border border-blue-200 text-blue-600 flex items-center justify-center font-black text-xs shadow-2xs">
                                ●
                            </div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">
                                Profil Sekretaris Dinas
                            </label>
                        </div>
                        @if (isset($item->secondary_image_path) && $item->secondary_image_path)
                            <button type="button" onclick="confirmDeleteSection('image_2')"
                                class="text-[11px] bg-red-50 border border-red-200 hover:bg-red-100 text-red-600 font-bold px-3 py-1 rounded-md transition-all cursor-pointer">
                                Hapus Gambar
                            </button>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start bg-slate-50/40 p-5 rounded-2xl border border-slate-200/50">
                        <div class="lg:col-span-4 w-full aspect-[3/4] bg-white rounded-xl border border-slate-200 flex items-center justify-center overflow-hidden shadow-2xs">
                            <img id="preview-sekretaris"
                                src="{{ $item->secondary_image_path ? Storage::url($item->secondary_image_path) : asset('images/pejabat/sekretaris.png') }}"
                                class="w-full h-full object-cover {{ !$item->secondary_image_path ? 'opacity-80' : '' }}">
                        </div>
                        <div class="lg:col-span-8 w-full space-y-5">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Nama Lengkap & Gelar</label>
                                <input type="text" name="nama_sekretaris" value="{{ old('nama_sekretaris', $namaSekretaris) }}" placeholder="Contoh: Fulanah, S.Sos., M.Si." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-2xs placeholder-slate-300">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Unggah Foto Resmi (Gambar 2)</label>
                                <input type="file" name="gambar_2" onchange="previewImage(event, 'preview-sekretaris')" accept="image/*"
                                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-slate-900 file:text-white hover:file:bg-blue-600 file:transition-all file:cursor-pointer file:shadow-xs">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Riwayat Pendidikan & Karier (Biografi)</label>
                                <div class="rounded-xl overflow-hidden border border-slate-200 shadow-2xs bg-white">
                                    <div id="editor-sekretaris">{!! old('biografi_sekretaris', $biografiSekretaris) !!}</div>
                                </div>
                                <input type="hidden" name="biografi_sekretaris" id="hidden-biografi-sekretaris">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-slate-50/50 flex items-center justify-end border-t border-slate-100">
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-14 py-3.5 rounded-xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 shadow-md shadow-blue-600/20 active:scale-98 cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

            {{-- Form Hapus Komponen Tersembunyi --}}
            <form id="form-hapus-komponen" action="{{ route('admin.profil.update', 'pejabat') }}" method="POST"
                class="hidden">
                @csrf
                <input type="hidden" name="target_hapus" id="input-target-hapus">
            </form>

        </div>
    </div>

    {{-- Quill Editor Asset --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <script>
        // Setup Quill for Hero Banner
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

        // Setup Quill for Kadis
        var quillKadis = new Quill('#editor-kadis', {
            theme: 'snow',
            placeholder: 'Tuliskan riwayat pendidikan, karier, atau pengalaman... (Gunakan format list untuk merapikan)',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });

        // Setup Quill for Sekretaris
        var quillSekretaris = new Quill('#editor-sekretaris', {
            theme: 'snow',
            placeholder: 'Tuliskan riwayat pendidikan, karier, atau pengalaman... (Gunakan format list untuk merapikan)',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });

        // Sync Quill to hidden inputs on form submit
        document.getElementById('form-pejabat').addEventListener('submit', function() {
            document.getElementById('hidden-hero').value = quillHero.root.innerHTML;
            document.getElementById('hidden-biografi-kadis').value = quillKadis.root.innerHTML;
            document.getElementById('hidden-biografi-sekretaris').value = quillSekretaris.root.innerHTML;
        });

        // Image Preview Handler
        function previewImage(event, targetId) {
            let input = event.target;
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.getElementById(targetId);
                    img.src = e.target.result;
                    img.classList.remove('opacity-80');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function confirmDeleteSection(type) {
            let namaKomponen = type === 'image' ? 'FOTO KEPALA DINAS' : 'FOTO SEKRETARIS DINAS';
            let check1 = confirm("Apakah Anda yakin ingin menghapus " + namaKomponen + "?");
            if (check1) {
                let check2 = confirm(
                    "⚠️ PERINGATAN KEDUA:\nTindakan ini bersifat PERMANEN dan akan langsung menghapus berkas di server Supabase.\n\nApakah Anda benar-benar serius?"
                );
                if (check2) {
                    document.getElementById('input-target-hapus').value = type;
                    document.getElementById('form-hapus-komponen').submit();
                }
            }
        }
    </script>
@endsection
