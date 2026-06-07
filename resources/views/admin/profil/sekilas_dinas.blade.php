@extends('admin.layouts.app')

@section('title', 'Kelola Data Sekilas Dinas')

@section('content')
    <div class="w-full pb-12 animate-fade-in">

        <div class="w-full bg-white/90 backdrop-blur-md rounded-3xl shadow-[0_4px_30px_rgba(15,23,42,0.04)] border border-slate-200/80 overflow-hidden">

            {{-- Header Panel --}}
            <div class="p-6 border-b border-slate-100 bg-linear-to-r from-slate-50 via-white to-slate-50 flex justify-between items-center">
                <div class="flex items-center space-x-3.5">
                    <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 uppercase tracking-tight text-sm">Data Global Sekilas Dinas</h4>
                        <p class="text-[11px] text-slate-500 font-medium mt-0.5">Kelola angka statistik yang akan ditampilkan di sidebar seluruh halaman profil.</p>
                    </div>
                </div>
                <span class="text-[10px] bg-blue-50 border border-blue-200 text-blue-700 font-black px-3 py-1 rounded-full uppercase tracking-wider">
                    Global Data Center
                </span>
            </div>

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="mx-8 mt-6 px-5 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-800 text-sm font-bold shadow-2xs flex items-center space-x-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @php
                $data = $item->content_data ?? [];
            @endphp

            <form action="{{ route('admin.profil.update', 'sekilas-dinas') }}" method="POST" class="divide-y divide-slate-100 p-8 space-y-6 bg-white">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.1em]">Jumlah Bidang</label>
                        <input type="text" name="jumlah_bidang" value="{{ old('jumlah_bidang', $data['jumlah_bidang'] ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: 4 Bidang">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.1em]">Jumlah Subbagian</label>
                        <input type="text" name="jumlah_subbagian" value="{{ old('jumlah_subbagian', $data['jumlah_subbagian'] ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: 3 Subbagian">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.1em]">Jumlah UPT</label>
                        <input type="text" name="jumlah_upt" value="{{ old('jumlah_upt', $data['jumlah_upt'] ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: 2 UPT">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.1em]">Total Pegawai</label>
                        <input type="text" name="total_pegawai" value="{{ old('total_pegawai', $data['total_pegawai'] ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: 150 Orang">
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.1em]">Tahun Dibentuk</label>
                        <input type="text" name="tahun_dibentuk" value="{{ old('tahun_dibentuk', $data['tahun_dibentuk'] ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: 2001">
                    </div>
                </div>

                <div class="pt-6 flex justify-end">
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-10 py-3 rounded-xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 shadow-md shadow-blue-600/20 active:scale-98 cursor-pointer">
                        Simpan Data Global
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
