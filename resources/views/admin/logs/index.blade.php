@extends('admin.layouts.app')

@section('title', 'Log Aktivitas Sistem')

@section('content')
    <div class="max-w-7xl mx-auto space-y-8 animate-fade-in">

        {{-- HEADER ACTION BAR --}}
        <div class="bg-white/80 backdrop-blur-md p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Log Aktivitas Sistem</h1>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide mt-1">
                    Rekam Jejak Operasional & Pembaruan Konten Cikasda
                </p>
            </div>
            <div>
                <a href="{{ route('admin.dashboard') }}"
                    class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase tracking-widest rounded-xl transition border border-slate-200/60 text-center block">
                    Kembali Ke Dashboard
                </a>
            </div>
        </div>

        {{-- DAFTAR LOG --}}
        <div class="bg-white/90 backdrop-blur-md rounded-3xl border border-slate-200/80 shadow-md overflow-hidden">
            <div class="p-5 border-b border-slate-100 bg-gradient-to-r from-slate-50 via-white to-slate-50 flex items-center space-x-2.5">
                <span class="h-3.5 w-1 bg-blue-600 rounded-full shadow-xs"></span>
                <h4 class="text-xs font-black text-slate-800 uppercase tracking-wider">Arsip Riwayat Aktivitas (Total: {{ $allLogs->total() }})</h4>
            </div>

            <div class="divide-y divide-slate-100 bg-white/50">
                @forelse($allLogs as $log)
                    <div class="p-5 flex items-center justify-between gap-4 hover:bg-slate-50/60 transition-colors duration-200">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-50 to-slate-100 border border-slate-200 text-slate-700 font-black text-xs uppercase flex items-center justify-center shrink-0 shadow-3xs">
                                {{ substr($log->user->name ?? 'A', 0, 2) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-800 leading-tight">
                                    {{ $log->user->name ?? 'System Officer' }}
                                    <span class="font-semibold text-slate-500 pl-0.5">{{ $log->description ?? 'telah memperbarui data' }}</span>
                                </p>
                                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mt-1.5 flex items-center gap-1.5">
                                    <span>📅 {{ $log->created_at->format('d M Y, H:i') }} WITA</span>
                                    <span class="text-slate-300">•</span>
                                    <span>⏰ {{ $log->created_at->diffForHumans() }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="shrink-0 flex items-center gap-2">
                            @if($log->ip_address)
                                <span class="text-[9px] bg-blue-50 border border-blue-100 text-blue-600 font-extrabold px-2.5 py-1 rounded-md uppercase tracking-wider">
                                    {{ $log->ip_address }}
                                </span>
                            @endif
                            <span class="text-[9px] bg-slate-50 border border-slate-200 text-slate-500 font-extrabold px-2.5 py-1 rounded-md uppercase tracking-wider hidden sm:inline-block">
                                Verified
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="p-16 text-center space-y-3 bg-white/50">
                        <div class="w-12 h-12 bg-slate-50 border border-slate-200 rounded-2xl flex items-center justify-center mx-auto text-slate-400 shadow-inner">
                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Belum ada aktivitas tercatat</p>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION LINK --}}
            @if($allLogs->hasPages())
                <div class="p-6 border-t border-slate-100 bg-slate-50/50">
                    {{ $allLogs->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection
