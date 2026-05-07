@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-200 relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-3xl font-black text-slate-900">Halo, Admin CIKASDA!</h2>
            <p class="text-slate-500 mt-2 max-w-md leading-relaxed font-medium">
                Selamat datang di pusat kendali website Dinas Cikasda. Silakan pilih menu di samping untuk memperbarui
                konten.
            </p>
        </div>
        <div class="absolute -right-16 -bottom-16 opacity-[0.03] rotate-12">
            <svg class="w-80 h-80" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V5h2v4z"></path>
            </svg>
        </div>
    </div>
@endsection
