@extends('admin.layouts.app')

@section('title', 'Aduan & Laporan Masyarakat')

@section('content')
    <div class="w-full pb-12 animate-fade-in" x-data="{ 
        selectedPesan: null,
        formatMessage(text) {
            if (!text) return '';
            let escaped = text.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            return escaped.replace(/(https?:\/\/[^\s]+)/g, '<a href=\'$1\' target=\'_blank\' class=\'text-blue-600 font-black underline hover:text-blue-850 break-all inline-flex items-center gap-1\'>$1 <span class=\'text-[10px]\'>↗</span></a>');
        }
    }">

        <div class="w-full bg-white/90 backdrop-blur-md rounded-3xl shadow-[0_4px_30px_rgba(15,23,42,0.04)] border border-slate-200/80 overflow-hidden">

            {{-- Header Panel Premium --}}
            <div class="p-6 border-b border-slate-100 bg-linear-to-r from-slate-50 via-white to-slate-50 flex justify-between items-center">
                <div class="flex items-center space-x-3.5">
                    <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-amber-500 to-orange-600 flex items-center justify-center text-white shadow-md shadow-amber-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 uppercase tracking-tight text-sm">Aduan & Pengaduan Masyarakat</h4>
                        <p class="text-[11px] text-slate-500 font-medium mt-0.5">Kelola data aspirasi, kritik, saran, dan pengaduan langsung dari masyarakat.</p>
                    </div>
                </div>
                <span class="text-[10px] bg-amber-50 border border-amber-200 text-amber-700 font-black px-3 py-1 rounded-full uppercase tracking-wider">
                    {{ $pesans->total() }} Aduan
                </span>
            </div>

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="mx-8 mt-6 px-5 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-800 text-sm font-bold shadow-2xs flex items-center space-x-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Table / List --}}
            <div class="p-8">
                <div class="overflow-x-auto rounded-2xl border border-slate-150 shadow-3xs">
                    <table class="w-full text-left border-collapse bg-white">
                        <thead>
                            <tr class="bg-slate-55/60 border-b border-slate-200 text-slate-700 text-[10px] font-black uppercase tracking-wider">
                                <th class="p-4.5">Pengirim</th>
                                <th class="p-4.5">Subjek / Perihal</th>
                                <th class="p-4.5">Tanggal</th>
                                <th class="p-4.5 text-center">Status</th>
                                <th class="p-4.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs font-semibold text-slate-750">
                            @forelse ($pesans as $pesan)
                                <tr class="hover:bg-slate-50/50 transition-colors duration-200 {{ !$pesan->is_read ? 'bg-amber-50/20 font-bold' : '' }}">
                                    <td class="p-4.5">
                                        <div class="space-y-0.5">
                                            <p class="text-slate-800 font-bold text-sm">{{ $pesan->nama }}</p>
                                            <p class="text-slate-400 font-medium text-[11px]">{{ $pesan->email }}</p>
                                        </div>
                                    </td>
                                    <td class="p-4.5">
                                        <div class="max-w-xs md:max-w-md truncate">
                                            <p class="text-slate-800 truncate">{{ $pesan->subjek }}</p>
                                        </div>
                                    </td>
                                    <td class="p-4.5 text-slate-400 font-medium text-[11px]">
                                        {{ $pesan->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="p-4.5 text-center">
                                        @if ($pesan->is_read)
                                            <span class="inline-block bg-slate-100 text-slate-500 font-extrabold text-[9px] px-2.5 py-0.5 rounded-full uppercase tracking-wider border border-slate-200/50">
                                                Dibaca
                                            </span>
                                        @else
                                            <span class="inline-block bg-amber-100 text-amber-700 font-extrabold text-[9px] px-2.5 py-0.5 rounded-full uppercase tracking-wider border border-amber-200/50 animate-pulse">
                                                Baru
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4.5 text-right space-x-2">
                                        <button @click="selectedPesan = @js($pesan)"
                                            class="inline-flex items-center justify-center p-2 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl transition duration-150 cursor-pointer"
                                            title="Baca Detail">
                                            🔍
                                        </button>
                                        
                                        @if (!$pesan->is_read)
                                            <form action="{{ route('admin.pesan.read', $pesan->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center justify-center p-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white rounded-xl transition duration-150 cursor-pointer" title="Tandai Dibaca">
                                                    ✓
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aduan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center p-2 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition duration-150 cursor-pointer" title="Hapus">
                                                ✕
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-slate-400 font-medium">
                                        <span class="text-3xl block mb-2">📥</span>
                                        Belum ada pengaduan masyarakat yang masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $pesans->links() }}
                </div>
            </div>

        </div>

        {{-- DETAIL MODAL --}}
        <div x-show="selectedPesan" class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs" x-transition.opacity>
            <div class="relative bg-white rounded-3xl shadow-2xl max-w-2xl w-full border border-slate-100 overflow-hidden transform transition-all duration-300" @click.away="selectedPesan = null">
                
                {{-- Header --}}
                <div class="p-6 border-b border-slate-100 bg-linear-to-r from-slate-50 via-white to-slate-50 flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                        <h4 class="text-sm font-black text-slate-800 uppercase tracking-wider">Detail Aduan Masyarakat</h4>
                    </div>
                    <button @click="selectedPesan = null" class="text-slate-400 hover:text-slate-600 font-bold text-lg p-2.5 cursor-pointer">✕</button>
                </div>

                {{-- Content --}}
                <div class="p-8 space-y-6" x-if="selectedPesan">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4.5 bg-slate-50 p-4.5 rounded-2xl border border-slate-150">
                        <div>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-0.5">Nama Pengirim</span>
                            <span class="text-sm font-black text-slate-800" x-text="selectedPesan.nama"></span>
                        </div>
                        <div>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-0.5">Alamat Email</span>
                            <a :href="'mailto:' + selectedPesan.email" class="text-sm font-bold text-blue-600 underline" x-text="selectedPesan.email"></a>
                        </div>
                        <div>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-0.5">Tanggal Kirim</span>
                            <span class="text-xs font-semibold text-slate-700" x-text="new Date(selectedPesan.created_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })"></span>
                        </div>
                        <div>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-0.5">Status</span>
                            <span x-text="selectedPesan.is_read ? 'SUDAH DIBACA' : 'BELUM DIBACA'"
                                  :class="selectedPesan.is_read ? 'bg-slate-100 text-slate-600' : 'bg-amber-100 text-amber-700'"
                                  class="inline-block font-extrabold text-[9px] px-2.5 py-0.5 rounded-md border border-slate-200/50"></span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block">Subjek / Perihal</span>
                        <p class="text-base font-black text-slate-800 leading-snug" x-text="selectedPesan.subjek"></p>
                    </div>

                    <div class="space-y-2 border-t border-slate-100 pt-4.5">
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block">Isi Pengaduan</span>
                        <div class="bg-slate-50/50 border border-slate-200/50 rounded-2xl p-5 text-sm text-slate-700 leading-relaxed whitespace-pre-line" x-html="formatMessage(selectedPesan.pesan)"></div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="p-6 bg-slate-50/60 border-t border-slate-100 flex justify-end space-x-3">
                    <button @click="selectedPesan = null" class="px-5 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-xs uppercase tracking-wider rounded-xl transition duration-150 cursor-pointer">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection
