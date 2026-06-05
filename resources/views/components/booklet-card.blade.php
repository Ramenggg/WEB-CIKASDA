@props(['booklet', 'mode' => 'vertical'])

@if($mode === 'horizontal')
    {{-- LAYOUT HORIZONTAL (Untuk Carousel Lebar) --}}
    <div class="bg-white rounded-[2.5rem] overflow-hidden border border-slate-200/80 shadow-[0_10px_40px_rgba(15,23,42,0.05)] group hover:shadow-[0_20px_60px_rgba(15,23,42,0.1)] transition-all duration-500 flex flex-col md:flex-row h-full min-h-[320px]">
        {{-- Sisi Kiri: Visual/Sampul --}}
        <div class="w-full md:w-2/5 relative overflow-hidden bg-slate-100 flex-shrink-0">
            @if($booklet->path_sampul)
                <img src="{{ $booklet->url_sampul }}" alt="Sampul" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            @elseif($booklet->file_pdf && preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $booklet->file_pdf))
                <img src="{{ $booklet->url_booklet }}" alt="Preview" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            @else
                <div class="absolute inset-0 flex flex-col items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200">
                    <span class="text-5xl">📕</span>
                </div>
            @endif

            <div class="absolute top-4 left-4 z-10">
                <span class="text-[9px] font-black tracking-widest uppercase bg-blue-600 text-white px-3 py-1.5 rounded-xl shadow-lg border border-white/20">
                    {{ $booklet->file_pdf ? (preg_match('/\.(pdf)$/i', $booklet->file_pdf) ? 'PDF DOCUMENT' : 'INFOGRAFIS') : 'EXTERNAL LINK' }}
                </span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        </div>

        {{-- Sisi Kanan: Konten --}}
        <div class="p-8 md:p-10 flex-1 flex flex-col justify-between space-y-6">
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 border border-blue-100 text-[10px] font-black uppercase tracking-widest shadow-3xs">
                        {{ $booklet->kategori ?: 'Umum' }}
                    </span>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest italic">
                        Diterbitkan: {{ $booklet->created_at->format('d M Y') }}
                    </span>
                </div>
                <h3 class="text-2xl md:text-3xl font-black text-slate-900 leading-tight group-hover:text-blue-600 transition-colors">
                    {{ $booklet->judul_booklet }}
                </h3>
                <p class="text-sm md:text-base text-slate-500 font-medium leading-relaxed line-clamp-3">
                    {{ $booklet->deskripsi_booklet ?? 'Tidak ada rincian ringkasan deskripsi tambahan mengenai dokumen booklet digital resmi ini.' }}
                </p>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center gap-4">
                @if ($booklet->file_pdf)
                    <a href="{{ $booklet->url_booklet }}" target="_blank"
                        class="flex-1 text-center px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase tracking-[0.15em] rounded-2xl transition-all shadow-xl shadow-blue-600/20 active:scale-95">
                        Lihat Berkas Lengkap
                    </a>
                    <a href="{{ $booklet->url_booklet }}" download
                        class="w-12 h-12 flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-600 border border-slate-200 rounded-2xl transition-all shadow-3xs"
                        title="Unduh PDF">
                        📥
                    </a>
                @else
                    <a href="{{ $booklet->url_external }}" target="_blank"
                        class="w-full text-center px-6 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-[0.15em] rounded-2xl transition-all shadow-xl shadow-emerald-600/20 active:scale-95">
                        Buka Tautan Eksternal
                    </a>
                @endif
            </div>
        </div>
    </div>
@else
    {{-- LAYOUT VERTICAL (Default) --}}
    <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-[0_4px_15px_rgba(15,23,42,0.02)] hover:shadow-[0_12px_25px_rgba(15,23,42,0.06)] group hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full">

        {{-- Visual Cover Dokumen Premium --}}
        <div class="aspect-video w-full relative overflow-hidden flex flex-col items-center justify-center p-0 border-b border-slate-100/80 bg-slate-100">
            
            @if($booklet->path_sampul)
                <img src="{{ $booklet->url_sampul }}" alt="Sampul" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @elseif($booklet->file_pdf && preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $booklet->file_pdf))
                <img src="{{ $booklet->url_booklet }}" alt="Preview" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @else
                <div class="flex flex-col items-center justify-center space-y-3">
                    <div class="w-14 h-14 rounded-2xl bg-white border border-slate-200 shadow-2xs flex items-center justify-center text-2xl transform group-hover:scale-110 transition-transform duration-300">
                        📕
                    </div>
                </div>
            @endif

            {{-- Overlay Label Tipe File --}}
            <div class="absolute top-3 left-3 z-10">
                <span class="text-[8px] font-black tracking-widest uppercase bg-slate-900/80 backdrop-blur-md text-white px-2 py-1 rounded-lg shadow-sm border border-white/10">
                    @if($booklet->file_pdf)
                        {{ preg_match('/\.(pdf)$/i', $booklet->file_pdf) ? 'PDF DOC' : 'INFOGRAFIS' }}
                    @else
                        TAUTAN
                    @endif
                </span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </div>

        {{-- Informasi Metadata Judul & Deskripsi --}}
        <div class="p-6 flex-1 flex flex-col justify-between space-y-5 bg-white">
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest">
                        {{ $booklet->created_at->format('d M Y') }}
                    </span>
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest px-2 py-0.5 bg-slate-50 border border-slate-100 rounded-md">
                        {{ $booklet->kategori ?: 'Umum' }}
                    </span>
                </div>
                <h3 class="text-base font-black text-slate-800 uppercase tracking-tight leading-snug break-words line-clamp-2 group-hover:text-blue-600 transition-colors">
                    {{ $booklet->judul_booklet }}
                </h3>
                <p class="text-xs text-slate-400 font-medium leading-relaxed line-clamp-2">
                    {{ $booklet->deskripsi_booklet ?? 'Tidak ada rincian ringkasan deskripsi tambahan mengenai dokumen booklet digital ini.' }}
                </p>
            </div>

            {{-- ACTION INTERAKTIF --}}
            <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                @if ($booklet->file_pdf)
                    <a href="{{ $booklet->url_booklet }}" target="_blank"
                        class="flex-1 text-center px-4 py-2.5 bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-100 font-black text-[10px] uppercase tracking-wider rounded-xl transition-all shadow-3xs">
                        👀 Lihat Berkas
                    </a>
                    <a href="{{ $booklet->url_booklet }}" download
                        class="px-3 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 border border-slate-200 rounded-xl transition-all"
                        title="Download">
                        📥
                    </a>
                @else
                    <a href="{{ $booklet->url_external }}" target="_blank"
                        class="w-full text-center px-4 py-2.5 bg-emerald-50 hover:bg-emerald-600 text-emerald-600 hover:text-white border border-emerald-100 font-black text-[10px] uppercase tracking-wider rounded-xl transition-all shadow-3xs">
                        🔗 Buka Tautan
                    </a>
                @endif
            </div>
        </div>
    </div>
@endif
