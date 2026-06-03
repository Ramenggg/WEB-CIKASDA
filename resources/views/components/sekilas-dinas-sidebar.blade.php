{{-- SEKILAS DINAS SIDEBAR COMPONENT --}}
<div class="sticky top-24 bg-slate-50 rounded-2xl p-6 border border-slate-100 shadow-sm">
    
    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider flex items-center mb-6">
        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        Sekilas Dinas
    </h3>

    <div class="space-y-4">
        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-xs flex items-start space-x-3 hover:shadow-md transition-shadow">
            <div class="bg-blue-50 text-blue-600 p-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-medium mb-0.5">Jumlah Bidang</p>
                <p class="text-sm font-bold text-slate-800">{{ $sekilasDinas['jumlah_bidang'] ?? '-' }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-xs flex items-start space-x-3 hover:shadow-md transition-shadow">
            <div class="bg-indigo-50 text-indigo-600 p-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-medium mb-0.5">Jumlah Subbagian</p>
                <p class="text-sm font-bold text-slate-800">{{ $sekilasDinas['jumlah_subbagian'] ?? '-' }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-xs flex items-start space-x-3 hover:shadow-md transition-shadow">
            <div class="bg-teal-50 text-teal-600 p-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-medium mb-0.5">Jumlah UPT</p>
                <p class="text-sm font-bold text-slate-800">{{ $sekilasDinas['jumlah_upt'] ?? '-' }}</p>
            </div>
        </div>
        
        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-xs flex items-start space-x-3 hover:shadow-md transition-shadow">
            <div class="bg-violet-50 text-violet-600 p-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-medium mb-0.5">Total Pegawai</p>
                <p class="text-sm font-bold text-slate-800">{{ $sekilasDinas['total_pegawai'] ?? '-' }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-xs flex items-start space-x-3 hover:shadow-md transition-shadow">
            <div class="bg-cyan-50 text-cyan-600 p-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-medium mb-0.5">Tahun Dibentuk</p>
                <p class="text-sm font-bold text-slate-800">{{ $sekilasDinas['tahun_dibentuk'] ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="mt-6 pt-6 border-t border-slate-200">
        <a href="{{ url('/') }}" class="w-full flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-3 px-4 rounded-xl transition-colors shadow-sm cursor-pointer">
            <span>Kembali ke Beranda</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
    </div>
</div>
