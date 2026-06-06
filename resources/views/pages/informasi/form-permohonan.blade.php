@extends('layouts.app')

@section('content')
    {{-- HERO HEADER --}}
    <x-profil-hero title="Form Permohonan Informasi" :item="$item" :showContentInHero="false" 
        description="Layanan satu pintu permohonan informasi publik PPID serta wadah penyampaian pengaduan masyarakat untuk mewujudkan transparansi dan pelayanan berkualitas." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 pb-24">

        {{-- MAIN BOX CONTAINER --}}
        <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-[0_20px_50px_rgba(15,23,42,0.06)] overflow-hidden p-8 md:p-12 border border-slate-100 space-y-10">
            
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <span class="inline-flex items-center gap-1.5 text-[10px] bg-blue-50 border border-blue-200 text-blue-700 font-black px-4 py-1.5 rounded-full uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                    Portal Layanan Publik
                </span>
                <h3 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight leading-snug">
                    Pilih Saluran Layanan Informasi Anda
                </h3>
                <p class="text-xs md:text-sm text-slate-400 font-bold leading-relaxed max-w-2xl mx-auto">
                    Kami berkomitmen menyediakan akses informasi publik yang akurat serta memproses setiap aduan masyarakat secara profesional demi mewujudkan keterbukaan informasi.
                </p>
            </div>

            {{-- SERVICE OPTIONS (TWO DISTINCT CARDS) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
                
                {{-- Card 1: Google Form Permohonan Informasi --}}
                <div class="group relative bg-white border border-slate-200/60 rounded-3xl p-8 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/5 hover:-translate-y-1.5 flex flex-col justify-between h-full">
                    <div class="absolute inset-x-0 top-0 h-2.5 rounded-t-3xl bg-gradient-to-r from-blue-600 to-indigo-600"></div>
                    
                    <div class="space-y-6">
                        <div class="w-14 h-14 bg-gradient-to-tr from-blue-600 to-indigo-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:scale-105 transition-all duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>

                        <div class="space-y-2.5">
                            <h4 class="text-lg md:text-xl font-black text-slate-800 tracking-tight leading-snug group-hover:text-blue-600 transition-colors">Formulir Permohonan Informasi</h4>
                            <p class="text-xs md:text-sm text-slate-400 font-medium leading-relaxed">
                                Ajukan permohonan data, dokumen administrasi, atau informasi publik resmi lainnya yang diproduksi atau dikelola oleh Dinas CIKASDA Sulawesi Tengah sesuai UU Keterbukaan Informasi Publik (KIP).
                            </p>
                        </div>

                        <div class="bg-slate-50/50 rounded-2xl p-5 border border-slate-150 space-y-3">
                            <div class="flex items-center space-x-3 text-xs font-bold text-slate-650">
                                <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 3" />
                                </svg>
                                <span>Platform: Google Forms Resmi</span>
                            </div>
                            <div class="flex items-center space-x-3 text-xs font-bold text-slate-650">
                                <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <span>Estimasi Respon: Maks. 10 Hari Kerja</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLScV-9WxQTrPBMYkH0bg7tzy7M0wJOfWD2eW50dGdf9T3okh8A/viewform" target="_blank"
                           class="w-full inline-flex items-center justify-center space-x-2.5 px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-lg shadow-blue-500/10 hover:shadow-xl transition-all duration-200 cursor-pointer">
                            <span>Isi Formulir Permohonan</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Card 2: Formulir Aduan Masyarakat --}}
                <div class="group relative bg-white border border-slate-200/60 rounded-3xl p-8 transition-all duration-300 hover:shadow-2xl hover:shadow-rose-500/5 hover:-translate-y-1.5 flex flex-col justify-between h-full">
                    <div class="absolute inset-x-0 top-0 h-2.5 rounded-t-3xl bg-gradient-to-r from-rose-600 to-red-600"></div>
                    
                    <div class="space-y-6">
                        <div class="w-14 h-14 bg-gradient-to-tr from-rose-600 to-red-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-rose-500/20 group-hover:scale-105 transition-all duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>

                        <div class="space-y-2.5">
                            <h4 class="text-lg md:text-xl font-black text-slate-800 tracking-tight leading-snug group-hover:text-rose-600 transition-colors">Formulir Aduan Masyarakat</h4>
                            <p class="text-xs md:text-sm text-slate-400 font-medium leading-relaxed">
                                Laporkan pelanggaran, kinerja staf, kerusakan fasilitas umum ke-PU-an, penyimpangan regulasi, atau sampaikan saran membangun seputar wilayah kerja dinas CIKASDA Sulawesi Tengah.
                            </p>
                        </div>

                        <div class="bg-slate-50/50 rounded-2xl p-5 border border-slate-150 space-y-3">
                            <div class="flex items-center space-x-3 text-xs font-bold text-slate-650">
                                <svg class="w-4 h-4 text-rose-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <span>Platform: Sistem Portal Internal</span>
                            </div>
                            <div class="flex items-center space-x-3 text-xs font-bold text-slate-650">
                                <svg class="w-4 h-4 text-rose-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <span>Privasi: Kerahasiaan Terjamin</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <a href="{{ route('form-aduan-masyarakat') }}"
                           class="w-full inline-flex items-center justify-center space-x-2.5 px-6 py-4 bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-700 hover:to-red-700 text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-md shadow-rose-500/10 hover:shadow-lg transition-all duration-200 cursor-pointer">
                            <span>Kirim Aduan & Laporan</span>
                            <span class="text-sm">➔</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
