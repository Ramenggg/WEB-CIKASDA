<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-[0_4px_20px_rgba(15,23,42,0.02)] flex flex-col justify-between group hover:shadow-md transition-all duration-300">

    {{-- Cover Simbolik Dokumen Premium --}}
    <div class="aspect-video w-full bg-slate-100 relative overflow-hidden border-b border-slate-100 flex flex-col items-center justify-center p-4 text-center group/card">
        @if($booklet->path_sampul)
            <img src="{{ $booklet->url_sampul }}" alt="Sampul" class="absolute inset-0 w-full h-full object-cover group-hover/card:scale-110 transition-transform duration-500">
        @elseif($booklet->file_pdf && preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $booklet->file_pdf))
            <img src="{{ $booklet->url_booklet }}" alt="Preview" class="absolute inset-0 w-full h-full object-cover group-hover/card:scale-110 transition-transform duration-500">
        @else
            <div class="w-12 h-12 rounded-xl bg-red-50 border border-red-100 flex items-center justify-center text-red-500 text-xl font-bold shadow-3xs group-hover/card:scale-110 transition-transform">
                @if($booklet->file_pdf) 📕 @else 🌐 @endif
            </div>
        @endif
        
        <div class="absolute top-2 left-2 z-10">
            <span class="text-[7px] font-black tracking-widest uppercase bg-slate-900/80 backdrop-blur-md text-white px-2 py-0.5 rounded shadow-sm">
                {{ $booklet->file_pdf ? (preg_match('/\.(pdf)$/i', $booklet->file_pdf) ? 'PDF DOC' : 'IMAGE') : 'LINK' }}
            </span>
        </div>
    </div>

    {{-- Metadata Dokumen --}}
    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
        <div class="space-y-2">
            <div class="flex flex-wrap gap-1.5">
                <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-600 border border-emerald-100 text-[8px] font-black uppercase tracking-widest shadow-3xs">
                    {{ $booklet->kategori ?: 'Umum' }}
                </span>
            </div>
            <h4 class="text-sm font-black text-slate-900 uppercase tracking-tight break-words leading-tight line-clamp-2 mt-2">
                {{ $booklet->judul_booklet }}
            </h4>
            <p class="text-xs text-slate-400 font-medium line-clamp-2 leading-relaxed">
                {{ $booklet->deskripsi_booklet ?? 'Tidak ada rincian deskripsi tambahan.' }}
            </p>
        </div>

        {{-- ACTION BUTTON HAPUS BOOKLET --}}
        <div class="pt-3 border-t border-slate-100 flex items-center justify-end">
            <form action="{{ route('admin.galeri.booklet.hapus', $booklet->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus dokumen booklet ini dari server arsip?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white border border-red-100 font-black text-[10px] uppercase tracking-wider rounded-xl transition-all cursor-pointer">
                    🗑️ Hapus Dokumen
                </button>
            </form>
        </div>
    </div>
</div>
