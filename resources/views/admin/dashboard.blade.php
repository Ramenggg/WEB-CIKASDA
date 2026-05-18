@extends('admin.layouts.app')

@section('title', 'Dashboard Utama')

@section('content')
<div class="space-y-8">
    {{-- 1. Header Welcome dengan Background Gradient & Pattern --}}
    <div class="relative overflow-hidden bg-slate-900 rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-blue-900/20">
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-blue-600/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-72 h-72 bg-cyan-500/10 rounded-full blur-[80px]"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-center md:text-left">
                <h2 class="text-3xl md:text-4xl font-black text-white leading-tight">
                    Halo, <span class="text-cyan-400">Admin CIKASDA!</span>
                </h2>
                <p class="text-slate-400 mt-3 max-w-md font-medium leading-relaxed">
                    Panel kendali ini membantu Anda mengelola informasi publik secara cepat dan efisien.
                </p>
                <div class="mt-6 flex flex-wrap justify-center md:justify-start gap-3">
                    <a href="/admin/berita" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold uppercase tracking-widest rounded-xl transition-all shadow-lg shadow-blue-600/30">Tambah Berita</a>
                    <a href="/" target="_blank" class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold uppercase tracking-widest rounded-xl transition-all border border-slate-700">Lihat Website</a>
                </div>
            </div>
            
            <div class="hidden lg:block bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-3xl w-64 shadow-2xl">
                <p class="text-[10px] font-black text-cyan-400 uppercase tracking-[0.2em] mb-4">Status Sistem</p>
                <div class="space-y-3">
                    <div class="flex justify-between items-center text-xs text-white">
                        <span class="font-medium text-slate-400">Server Status</span>
                        <span class="text-green-400 font-bold">Stable</span>
                    </div>
                    <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-cyan-500 h-full w-[85%]"></div>
                    </div>
                    <p class="text-[10px] text-slate-500 italic uppercase">Update: {{ now()->format('H:i') }} WITA</p>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Statistik Cards (Grid Terkoneksi Database) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Card Berita --}}
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path></svg>
                </div>
                <span class="text-xs font-black text-slate-300 uppercase tracking-widest">Berita</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800">{{ $countBerita ?? 0 }}</h3>
            <p class="text-xs font-bold text-slate-400 mt-1 uppercase">Total Artikel Terbit</p>
        </div>

        {{-- Card Galeri --}}
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-cyan-50 text-cyan-600 rounded-2xl group-hover:bg-cyan-600 group-hover:text-white transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <span class="text-xs font-black text-slate-300 uppercase tracking-widest">Media</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800">{{ $countGaleri ?? 0 }}</h3>
            <p class="text-xs font-bold text-slate-400 mt-1 uppercase">Foto & Video</p>
        </div>

        {{-- Card Pesan --}}
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl group-hover:bg-amber-600 group-hover:text-white transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </div>
                <span class="text-xs font-black text-slate-300 uppercase tracking-widest">Pesan</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800">{{ $countPesan ?? 0 }}</h3>
            <p class="text-xs font-bold text-slate-400 mt-1 uppercase">Belum Dibaca</p>
        </div>

        {{-- Card Pengunjung --}}
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-rose-50 text-rose-600 rounded-2xl group-hover:bg-rose-600 group-hover:text-white transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <span class="text-xs font-black text-slate-300 uppercase tracking-widest">Hits</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800">{{ $countHits ?? '0' }}</h3>
            <p class="text-xs font-bold text-slate-400 mt-1 uppercase">Pengunjung Hari Ini</p>
        </div>
    </div>

    {{-- 3. Area Preview/Log Aktivitas --}}
    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">Aktivitas Terakhir</h4>
            <a href="{{ route('admin.logs') }}" class="text-blue-600 text-[10px] font-black uppercase tracking-widest hover:underline">Lihat Semua Log</a>
        </div>
        <div class="divide-y divide-slate-50">
            @forelse($latestLogs ?? [] as $log)
                <div class="p-4 flex items-center gap-4 hover:bg-slate-50 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-xs uppercase">
                        {{ substr($log->user->name ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-700">
                            {{ $log->user->name ?? 'System' }} 
                            <span class="font-medium text-slate-500">{{ $log->description ?? 'Melakukan aktivitas' }}</span>
                        </p>
                        <p class="text-[10px] text-slate-400 font-medium mt-0.5">{{ $log->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Belum ada aktivitas tercatat</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection