@extends('admin.layouts.app')

@section('title', $judul ?? 'Kelola Struktur Organisasi')

@section('content')
    {{-- KUNCI 1: Mengubah 'max-w-4xl' menjadi 'w-full' agar form melebar penuh mengikuti layar kanan admin --}}
    <div class="w-full bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
            <h4 class="font-black text-slate-800 uppercase tracking-tight text-xs">Update Bagan Organisasi</h4>
        </div>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div
                class="mx-8 mt-6 px-5 py-4 bg-green-50 border border-green-200 rounded-2xl text-green-700 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.profil.update', 'struktur') }}" method="POST" enctype="multipart/form-data"
            class="p-8 space-y-8">
            @csrf

            <div>
                <label class="block text-xs font-black text-slate-500 mb-4 uppercase tracking-[0.2em]">
                    Upload Bagan (Gambar)
                </label>

                {{-- KUNCI 2: Struktur Flex/Grid disesuaikan agar sisi kanan (input file) mengambil sisa ruang yang luas --}}
                <div class="flex flex-col lg:flex-row gap-8 items-start w-full">

                    {{-- Box Preview Gambar (Dipertahankan ukurannya agar tidak terlalu raksasa, namun tetap kokoh) --}}
                    <div
                        class="w-full lg:w-96 aspect-video bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex items-center justify-center overflow-hidden shadow-inner shrink-0">
                        @if ($item->gambar_path)
                            <img src="{{ Storage::url($item->gambar_path) }}" class="w-full h-full object-contain">
                        @else
                            <img src="https://via.placeholder.com/400x250?text=Preview+Bagan"
                                class="w-full h-full object-contain opacity-30">
                        @endif
                    </div>

                    {{-- Sisi Tombol Upload (Sekarang ditarik w-full agar mengisi penuh area kanan) --}}
                    <div class="w-full flex-1">
                        <input type="file" name="gambar"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-slate-900 file:text-white hover:file:bg-blue-600 transition cursor-pointer shadow-lg shadow-slate-200">
                        <p class="mt-5 text-[11px] text-slate-400 font-bold italic leading-relaxed">
                            * Gunakan format JPG atau PNG.<br>
                            * Ukuran file maksimal 2MB.
                        </p>
                        @error('gambar')
                            <p class="mt-2 text-xs text-red-500 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <hr class="border-slate-100">

            {{-- KUNCI 3: Textarea Penjelasan otomatis melebar penuh 100% mengikuti kontainer luar --}}
            <div class="w-full">
                <label class="block text-xs font-black text-slate-500 mb-4 uppercase tracking-[0.2em]">
                    Narasi Penjelasan
                </label>
                <textarea name="konten" rows="8" {{-- Dipertinggi sedikit dari 6 menjadi 8 baris agar proporsional dengan lebarnya layar --}}
                    class="w-full px-6 py-5 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 outline-none transition text-slate-700 font-medium"
                    placeholder="Tuliskan keterangan struktur di sini...">{{ old('konten', $item->konten) }}</textarea>
                @error('konten')
                    <p class="mt-2 text-xs text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end pt-4">
                <button type="submit"
                    class="bg-blue-600 text-white px-12 py-3.5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-blue-700 transition shadow-xl shadow-blue-100">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
