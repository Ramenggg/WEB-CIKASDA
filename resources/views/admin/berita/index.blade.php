@extends('admin.layouts.app')

@section('title', 'Kelola Berita & Kegiatan')

@section('content')
    <div class="w-full pb-12 space-y-8 animate-fade-in" x-data="{
        deleteConfirmOpen: false,
        deleteConfirmTitle: '',
        deleteConfirmAction: '',

        showDeleteConfirm(title, actionUrl) {
            this.deleteConfirmTitle = title;
            this.deleteConfirmAction = actionUrl;
            this.deleteConfirmOpen = true;
        }
    }">

        {{-- HEADER CARD DENGAN STATISTIK --}}
        <div class="w-full bg-white/90 backdrop-blur-md rounded-3xl shadow-[0_4px_30px_rgba(15,23,42,0.04)] border border-slate-200/80 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-linear-to-r from-slate-50 via-white to-slate-50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center space-x-3.5">
                    <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 uppercase tracking-tight text-sm">Kelola Berita & Kegiatan</h4>
                        <p class="text-[11px] text-slate-500 font-medium mt-0.5">Tulis, ubah, atau hapus artikel berita dinas yang tampil pada portal publik.</p>
                    </div>
                </div>
                
                <a href="{{ route('admin.berita.tambah') }}"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase tracking-widest rounded-xl transition cursor-pointer flex items-center gap-2 shadow-md shadow-blue-600/10">
                    <span>+ Tulis Berita Baru</span>
                </a>
            </div>

            {{-- PANEL STATISTIK --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-slate-100 border-b border-slate-100 bg-slate-50/30">
                <div class="p-6 flex items-center space-x-4">
                    <div class="h-10 w-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-black shadow-2xs">
                        {{ $beritas->count() }}
                    </div>
                    <div>
                        <span class="block text-[10px] font-black uppercase text-slate-400 tracking-wider">Total Artikel</span>
                        <span class="text-xs font-bold text-slate-700">Diterbitkan & Draf</span>
                    </div>
                </div>
                <div class="p-6 flex items-center space-x-4">
                    <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-black shadow-2xs">
                        {{ $beritas->where('status', 'Publish')->count() }}
                    </div>
                    <div>
                        <span class="block text-[10px] font-black uppercase text-slate-400 tracking-wider">Terpublikasi</span>
                        <span class="text-xs font-bold text-slate-700">Aktif di Halaman Publik</span>
                    </div>
                </div>
                <div class="p-6 flex items-center space-x-4">
                    <div class="h-10 w-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center text-sm font-black shadow-2xs">
                        {{ $beritas->where('status', 'Draft')->count() }}
                    </div>
                    <div>
                        <span class="block text-[10px] font-black uppercase text-slate-400 tracking-wider">Arsip Draft</span>
                        <span class="text-xs font-bold text-slate-700">Belum Ditayangkan</span>
                    </div>
                </div>
            </div>

            {{-- Notifikasi Sukses / Gagal --}}
            @if (session('success'))
                <div class="mx-8 mt-6 px-5 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-800 text-sm font-bold shadow-2xs flex items-center space-x-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- TABEL DAFTAR BERITA --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="p-4 pl-8 text-[10px] font-black text-slate-400 uppercase tracking-wider">Sampul</th>
                            <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Judul & Kategori</th>
                            <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Status</th>
                            <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Tanggal Dibuat</th>
                            <th class="p-4 pr-8 text-[10px] font-black text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($beritas as $berita)
                            <tr class="hover:bg-slate-50/30 transition duration-150">
                                {{-- SAMPUL THUMBNAIL --}}
                                <td class="p-4 pl-8">
                                    <div class="w-16 h-10 rounded-lg overflow-hidden border border-slate-200/60 bg-slate-100">
                                        @if($berita->sampul && $berita->sampul->file_path)
                                            <img src="{{ Storage::url($berita->sampul->file_path) }}" 
                                                 alt="Sampul" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[8px] font-black uppercase text-slate-400">
                                                No image
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                {{-- JUDUL & KATEGORI --}}
                                <td class="p-4">
                                    <div class="space-y-1">
                                        <h6 class="text-xs font-black text-slate-800 leading-snug line-clamp-1">{{ $berita->judul }}</h6>
                                        <span class="inline-block px-2 py-0.5 rounded-md text-[8px] font-black uppercase tracking-wider bg-slate-100 text-slate-600 border border-slate-200">
                                            {{ $berita->kategori }}
                                        </span>
                                    </div>
                                </td>

                                {{-- STATUS --}}
                                <td class="p-4">
                                    <div class="flex items-center space-x-1.5">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $berita->status === 'Publish' ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                        <span class="text-[10px] font-black uppercase tracking-wider {{ $berita->status === 'Publish' ? 'text-emerald-700' : 'text-slate-500' }}">
                                            {{ $berita->status }}
                                        </span>
                                    </div>
                                </td>

                                {{-- TANGGAL --}}
                                <td class="p-4 text-[10px] font-bold text-slate-500">
                                    {{ $berita->created_at->translatedFormat('d F Y') }}
                                </td>

                                {{-- AKSI --}}
                                <td class="p-4 pr-8 text-right space-x-1.5 whitespace-nowrap">
                                    <a href="{{ route('admin.berita.edit', $berita->id) }}"
                                        class="inline-block px-3 py-1.5 bg-white border border-slate-200 hover:bg-slate-100 text-slate-600 hover:text-slate-800 rounded-lg text-[10px] font-black uppercase tracking-wider transition cursor-pointer">
                                        Edit
                                    </a>
                                    <button type="button" 
                                        @click="showDeleteConfirm(@js($berita->judul), '{{ route('admin.berita.hapus', $berita->id) }}')"
                                        class="px-3 py-1.5 bg-rose-50 border border-rose-100 hover:bg-rose-100 text-rose-600 rounded-lg text-[10px] font-black uppercase tracking-wider transition cursor-pointer">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center space-y-3">
                                    <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200/60 flex items-center justify-center text-slate-400 shadow-inner mx-auto">
                                        📰
                                    </div>
                                    <div class="space-y-0.5">
                                        <h6 class="text-xs font-black text-slate-800 uppercase tracking-wider">Belum Ada Berita</h6>
                                        <p class="text-[10px] text-slate-400 font-semibold max-w-xs mx-auto">Silakan klik tombol di kanan atas untuk menulis berita perdana Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- CONFIRM DELETE MODAL --}}
        <div x-show="deleteConfirmOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-xs" @click="deleteConfirmOpen = false"></div>
            {{-- Modal Body --}}
            <div class="relative bg-white rounded-3xl w-full max-w-md p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in-95 duration-200">
                <div class="flex items-center space-x-3 text-rose-600 pb-3 border-b border-slate-100">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h5 class="text-xs font-black uppercase tracking-wider text-rose-700">Konfirmasi Hapus Berita</h5>
                </div>

                <div class="mt-4 space-y-3">
                    <p class="text-[11px] text-slate-500 font-semibold leading-relaxed">
                        Apakah Anda yakin ingin menghapus artikel berita berikut beserta seluruh foto dokumentasinya?
                    </p>
                    <div class="p-3 bg-rose-50/50 border border-rose-100/50 rounded-2xl">
                        <p class="text-xs font-black text-rose-700 uppercase tracking-wide break-words" x-text="deleteConfirmTitle"></p>
                    </div>
                </div>

                <form :action="deleteConfirmAction" method="POST" class="mt-6">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="pt-4 flex justify-end space-x-2 border-t border-slate-100">
                        <button type="button" @click="deleteConfirmOpen = false"
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-[10px] font-black uppercase tracking-wider rounded-lg transition cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2 bg-rose-600 hover:bg-rose-700 text-white text-[10px] font-black uppercase tracking-wider rounded-lg transition cursor-pointer">
                            Ya, Hapus Permanen
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
