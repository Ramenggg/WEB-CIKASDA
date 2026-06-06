@extends('layouts.app')

@section('content')
    {{-- HERO HEADER --}}
    <x-profil-hero title="Formulir Aduan Masyarakat" :item="$item" :showContentInHero="false" 
        description="Hubungi kami dan sampaikan pengaduan, laporan, aspirasi, atau saran Anda demi perbaikan kualitas infrastruktur serta layanan publik Dinas Cipta Karya dan Sumber Daya Air." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 pb-24">

        {{-- MAIN FORM CONTAINER --}}
        <div class="bg-white rounded-3xl shadow-[0_15px_50px_rgba(15,23,42,0.06)] overflow-hidden border border-slate-100 p-8 md:p-12 space-y-6">
            
            {{-- Form Header --}}
            <div class="border-b border-slate-100 pb-5 flex justify-between items-center">
                <div class="space-y-1">
                    <h3 class="text-lg md:text-xl font-black text-slate-800 tracking-tight">Kirim Aduan & Laporan</h3>
                    <p class="text-xs text-slate-400 font-bold">Harap lengkapi detail formulir di bawah dengan benar.</p>
                </div>
                <span class="text-xs bg-rose-50 text-rose-700 font-extrabold px-3.5 py-1.5 rounded-full uppercase border border-rose-100 tracking-wider">
                    Aduan Online
                </span>
            </div>

            @if(session('success'))
                {{-- Success Notification --}}
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl p-5 space-y-2 flex items-start space-x-3.5 shadow-3xs">
                    <div class="shrink-0 p-1.5 bg-emerald-100 text-emerald-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-black uppercase tracking-wider text-emerald-900">Laporan Berhasil Terkirim</h4>
                        <p class="text-xs text-emerald-700 font-semibold leading-relaxed">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Original-styled Banner Card --}}
            <div class="bg-linear-to-r from-blue-500/10 via-indigo-500/5 to-slate-50 border border-slate-200/60 rounded-3xl p-6 md:p-8 flex flex-col lg:flex-row items-center justify-between gap-8 relative overflow-hidden">
                {{-- Background decorative shapes --}}
                <div class="absolute top-8 left-1/3 w-3 h-3 rounded-full bg-amber-400 opacity-60"></div>
                <div class="absolute bottom-8 left-12 w-4 h-4 rounded-full bg-cyan-400 opacity-60"></div>
                <div class="absolute top-1/2 right-1/4 w-3.5 h-3.5 rounded-full bg-rose-400 opacity-60"></div>
                <div class="absolute top-4 right-12 w-2.5 h-2.5 rounded-full bg-emerald-400 opacity-60"></div>

                <div class="space-y-5 lg:max-w-3xl relative z-10">
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('images/logo/sulteng-cikasda.png') }}" alt="Logo Cikasda" class="h-14 w-auto object-contain">
                        <div class="h-8 w-[1.5px] bg-slate-300"></div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] bg-blue-100/80 border border-blue-200 text-blue-800 font-black px-3 py-1 rounded-full uppercase tracking-wider">
                            Dinas Cikasda Sulteng
                        </span>
                    </div>

                    <h3 class="text-xl md:text-2xl font-black text-blue-900 tracking-tight leading-snug uppercase">
                        Laporkan Aduan Anda Pada Form Berikut
                    </h3>
                    <p class="text-xs md:text-sm text-slate-650 font-bold leading-relaxed">
                        Aduan laporan masyarakat adalah bentuk penyampaian informasi, keluhan, saran, maupun aspirasi dari warga terkait pelayanan publik, pembangunan, serta permasalahan yang terjadi di lingkungan sekitar. Laporan ini menjadi sarana partisipasi masyarakat untuk mendorong transparansi, akuntabilitas, serta peningkatan kualitas kinerja instansi pemerintah maupun pihak terkait.
                    </p>
                </div>

                {{-- Dynamic Banner Graphic --}}
                <div class="hidden lg:flex w-64 h-44 shrink-0 relative items-center justify-center overflow-hidden rounded-2xl border border-slate-200/60 bg-white p-2 shadow-2xs">
                    @if (isset($item->primary_image_path) && $item->primary_image_path)
                        <img src="{{ Storage::url($item->primary_image_path) }}" alt="Banner Aduan" class="max-w-full max-h-full object-contain">
                    @else
                        {{-- Fallback SVG Illustration --}}
                        <svg class="w-full h-full text-blue-600" viewBox="0 0 200 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Laptop Base Shadow -->
                            <ellipse cx="100" cy="138" rx="80" ry="12" fill="#E2E8F0"/>
                            
                            <!-- Desktop Monitor -->
                            <rect x="25" y="15" width="130" height="92" rx="10" fill="#64748B" stroke="#475569" stroke-width="4"/>
                            <rect x="32" y="22" width="116" height="70" rx="4" fill="#FFFFFF"/>
                            <!-- Monitor Stand -->
                            <path d="M80 107 L72 135 L108 135 L100 107 Z" fill="#475569"/>
                            <rect x="62" y="132" width="56" height="6" rx="3" fill="#334155"/>
                            
                            <!-- Screen Form Mockup -->
                            <rect x="40" y="32" width="48" height="32" rx="3" fill="#EFF6FF" stroke="#3B82F6" stroke-width="3"/>
                            <line x1="48" y1="42" x2="80" y2="42" stroke="#3B82F6" stroke-width="2.5" stroke-linecap="round"/>
                            <line x1="48" y1="50" x2="72" y2="50" stroke="#3B82F6" stroke-width="2.5" stroke-linecap="round"/>
                            
                            <rect x="98" y="32" width="40" height="5" rx="2.5" fill="#3B82F6"/>
                            <rect x="98" y="42" width="40" height="3" rx="1.5" fill="#94A3B8"/>
                            <rect x="98" y="48" width="28" height="3" rx="1.5" fill="#94A3B8"/>
                            <rect x="98" y="55" width="40" height="7" rx="3.5" fill="#10B981"/> <!-- Green Button Mockup -->
                            
                            <circle cx="90" cy="85" r="2.5" fill="#64748B"/>
                            
                            <!-- Mobile Phone (overlapping foreground) -->
                            <g transform="rotate(-6 148 110)">
                                <rect x="126" y="62" width="38" height="68" rx="7" fill="#334155" stroke="#1E293B" stroke-width="3"/>
                                <rect x="130" y="68" width="30" height="50" rx="3" fill="#FFFFFF"/>
                                <circle cx="145" cy="123" r="2.5" fill="#64748B"/>
                                
                                <!-- Mobile Screen details -->
                                <rect x="134" y="74" width="22" height="12" rx="1.5" fill="#EFF6FF" stroke="#3B82F6" stroke-width="1.5"/>
                                <line x1="134" y1="92" x2="152" y2="92" stroke="#94A3B8" stroke-width="1.5" stroke-linecap="round"/>
                                <line x1="134" y1="97" x2="146" y2="97" stroke="#94A3B8" stroke-width="1.5" stroke-linecap="round"/>
                                <rect x="134" y="103" width="22" height="5" rx="2.5" fill="#10B981"/>
                            </g>
                            
                            <!-- Mini paper airplane / rocket icon -->
                            <path d="M165 42 L180 32 L175 48 L170 45 Z" fill="#3B82F6"/>
                            <path d="M165 42 L172 44 L170 45 Z" fill="#2563EB"/>
                        </svg>
                    @endif
                </div>
            </div>

            {{-- Form Inputs --}}
            <form action="{{ route('form-aduan-masyarakat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nama Lengkap --}}
                    <div class="space-y-2">
                        <label for="nama" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" name="nama" id="nama" required value="{{ old('nama') }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition duration-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50 @error('nama') border-red-500 @enderror"
                                placeholder="Contoh: Nama Lengkap Anda">
                        </div>
                        @error('nama')
                            <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alamat Email --}}
                    <div class="space-y-2">
                        <label for="email" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" required value="{{ old('email') }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition duration-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50 @error('email') border-red-500 @enderror"
                                placeholder="Contoh: nama@domain.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nomor HP / Whatsapp --}}
                    <div class="space-y-2">
                        <label for="no_hp" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Nomor HP / Whatsapp</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <input type="text" name="no_hp" id="no_hp" required value="{{ old('no_hp') }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition duration-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50 @error('no_hp') border-red-500 @enderror"
                                placeholder="Contoh: 081234567890">
                        </div>
                        @error('no_hp')
                            <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Upload KTP / SIM --}}
                    <div class="space-y-2">
                        <label for="ktp" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Upload KTP / SIM</label>
                        <div class="relative">
                            <input type="file" name="ktp" id="ktp" required
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-600 outline-none transition duration-200 file:mr-4 file:py-1.5 file:px-3.5 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 focus:border-blue-500 @error('ktp') border-red-500 @enderror">
                        </div>
                        <p class="text-[10px] text-slate-400 font-bold">Maks. 2MB (Format: JPG, JPEG, PNG, PDF)</p>
                        @error('ktp')
                            <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="space-y-2">
                    <label for="alamat" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Alamat Pelapor</label>
                    <div class="relative">
                        <div class="absolute top-3.5 left-4 flex items-start pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <textarea name="alamat" id="alamat" rows="2" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition duration-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50 @error('alamat') border-red-500 @enderror"
                            placeholder="Tuliskan alamat lengkap Anda..."></textarea>
                    </div>
                    @error('alamat')
                        <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi Aduan --}}
                <div class="space-y-2">
                    <label for="pesan" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Deskripsi Aduan / Isi Laporan</label>
                    <div class="relative">
                        <div class="absolute top-3.5 left-4 flex items-start pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <textarea name="pesan" id="pesan" rows="5" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3.5 text-sm font-semibold text-slate-800 outline-none transition duration-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50 @error('pesan') border-red-500 @enderror"
                            placeholder="Tuliskan perincian aduan Anda secara jelas, meliputi lokasi kejadian, kronologi, serta dampak yang terjadi..."></textarea>
                    </div>
                    @error('pesan')
                        <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Upload Bukti Dukung --}}
                    <div class="space-y-2">
                        <label for="bukti_dukung" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Upload Bukti Dukung (Foto/Dokumen)</label>
                        <div class="relative">
                            <input type="file" name="bukti_dukung" id="bukti_dukung"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-600 outline-none transition duration-200 file:mr-4 file:py-1.5 file:px-3.5 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 focus:border-blue-500 @error('bukti_dukung') border-red-500 @enderror">
                        </div>
                        <p class="text-[10px] text-slate-400 font-bold">Maks. 10MB (Format: JPG, JPEG, PNG, PDF, ZIP, RAR, DOCX, XLSX)</p>
                        @error('bukti_dukung')
                            <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Persetujuan --}}
                    <div class="flex items-center space-x-3 bg-slate-50 p-4.5 rounded-xl border border-slate-150 h-full">
                        <input type="checkbox" name="setuju" id="setuju" required
                            class="h-4.5 w-4.5 rounded border-slate-350 text-blue-600 focus:ring-blue-500 cursor-pointer">
                        <label for="setuju" class="text-xs text-slate-600 font-bold leading-normal select-none cursor-pointer">
                            Saya menyatakan bahwa data yang saya kirimkan adalah benar dan dapat dipertanggungjawabkan.
                        </label>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="pt-4 flex items-center justify-between gap-4">
                    <a href="{{ route('informasi.form-permohonan') }}" 
                       class="inline-flex items-center space-x-2 px-5 py-3.5 bg-slate-100 hover:bg-slate-205 text-slate-650 font-black text-xs uppercase tracking-widest rounded-xl transition duration-200">
                        <span>Kembali</span>
                    </a>
                    
                    <button type="submit"
                        class="inline-flex items-center space-x-2.5 px-8 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-lg shadow-blue-500/10 hover:shadow-xl transition-all duration-200 cursor-pointer">
                        <span>Kirim Laporan</span>
                        <span class="text-sm">➔</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
