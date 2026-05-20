<footer class="bg-[#0f172a] text-white pt-20 pb-10 border-t border-slate-800 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 mb-16">

            <div class="space-y-8 relative lg:col-span-4 md:pr-6">
                <div
                    class="absolute -top-10 -left-10 w-40 h-40 bg-blue-600/10 rounded-full blur-3xl pointer-events-none">
                </div>

                <div class="relative flex w-full items-center justify-center z-10">
                <div class="relative shrink-0 group">
                    {{-- Efek Glow Putih di Belakang Logo --}}
                    <div class="absolute inset-0 bg-white/5 blur-md rounded-full transform group-hover:scale-110 transition-transform duration-500">
                    </div>
                    
                    {{-- File Asset Logo Cikasda --}}
                    <img src="{{ asset('images/logo/logo-cikasda.png') }}" alt="Logo Cikasda"
                        class="relative h-20 sm:h-22 w-auto drop-shadow-2xl brightness-110 transition-transform duration-500 group-hover:-translate-y-1">
                </div>
            </div>

                <div class="relative z-10 pl-4 border-l-2 border-slate-700/50">
                    <p class="text-sm text-slate-400 leading-relaxed font-light">
                        Mengelola sumber daya air dan infrastruktur cipta karya untuk mewujudkan Sulawesi Tengah yang
                        maju, mandiri, dan berkelanjutan.
                    </p>
                </div>
            </div>

            <div class="lg:col-span-3">
                <h3
                    class="text-xs font-black uppercase tracking-[0.2em] text-white mb-8 border-l-4 border-blue-500 pl-4">
                    Hubungi Kami
                </h3>
                <div class="space-y-6 text-[13px] text-slate-400">
                    <div class="flex items-start space-x-3">
                        <div class="p-2.5 bg-blue-500/10 rounded-xl text-blue-500 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="leading-relaxed pt-0.5">Jl. Moh. Yamin 80, Palu, <br>Sulteng 94111</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="p-2.5 bg-blue-500/10 rounded-xl text-blue-500 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                        </div>
                        <span class="font-medium tracking-wide">(0451) 421631</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="p-2.5 bg-blue-500/10 rounded-xl text-blue-500 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="truncate font-medium hover:text-blue-400 transition-colors cursor-pointer">cikasda@sultengprov.go.id</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <h3
                    class="text-xs font-black uppercase tracking-[0.2em] text-white mb-8 border-l-4 border-blue-500 pl-4">
                    Media Sosial
                </h3>
                <div class="flex flex-col space-y-4">
                    <a href="#"
                        class="group flex items-center w-fit transition-all duration-300 hover:translate-x-1">
                        <div
                            class="flex items-center justify-center w-12 h-12 bg-slate-800/50 rounded-2xl border border-slate-700/50 transition-all duration-300 drop-shadow-md group-hover:shadow-lg group-hover:shadow-blue-500/20 group-hover:border-blue-500/50">
                            <img src="{{ asset('images/sosmed/logo-facebook.png') }}" alt="Facebook Cikasda"
                                class="w-7 h-7 object-contain transition-transform duration-300 group-hover:scale-110">
                        </div>
                        <span
                            class="ml-4 text-sm font-medium text-slate-400 group-hover:text-blue-400 transition-colors duration-300">Facebook</span>
                    </a>
                    <a href="#"
                        class="group flex items-center w-fit transition-all duration-300 hover:translate-x-1">
                        <div
                            class="flex items-center justify-center w-12 h-12 bg-slate-800/50 rounded-2xl border border-slate-700/50 transition-all duration-300 drop-shadow-md group-hover:shadow-lg group-hover:shadow-pink-500/20 group-hover:border-pink-500/50">
                            <img src="{{ asset('images/sosmed/logo-instagram.png') }}" alt="Instagram Cikasda"
                                class="w-7 h-7 object-contain transition-transform duration-300 group-hover:scale-110">
                        </div>
                        <span
                            class="ml-4 text-sm font-medium text-slate-400 group-hover:text-pink-400 transition-colors duration-300">Instagram</span>
                    </a>
                    <a href="#"
                        class="group flex items-center w-fit transition-all duration-300 hover:translate-x-1">
                        <div
                            class="flex items-center justify-center w-12 h-12 bg-slate-800/50 rounded-2xl border border-slate-700/50 transition-all duration-300 drop-shadow-md group-hover:shadow-lg group-hover:shadow-red-500/20 group-hover:border-red-500/50">
                            <img src="{{ asset('images/sosmed/logo-youtube.png') }}" alt="YouTube Cikasda"
                                class="w-7 h-7 object-contain transition-transform duration-300 group-hover:scale-110">
                        </div>
                        <span
                            class="ml-4 text-sm font-medium text-slate-400 group-hover:text-red-400 transition-colors duration-300">YouTube</span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-3">
                <h3
                    class="text-xs font-black uppercase tracking-[0.2em] text-white mb-8 border-l-4 border-blue-500 pl-4">
                    Pimpinan Cikasda
                </h3>
                <div class="grid grid-cols-2 gap-5">
                    <div class="flex flex-col items-center space-y-3">
                        <span
                            class="text-[11px] font-bold text-white uppercase tracking-widest text-center leading-tight drop-shadow-md">Kepala
                            Dinas</span>
                        <a href="/profil"
                            class="block w-full overflow-hidden rounded-xl shadow-xl border border-slate-700/80 transition-all duration-300 hover:-translate-y-1 hover:border-blue-500 hover:shadow-blue-500/40">
                            <img src="{{ asset('images/pejabat/kadis.png') }}" alt="Kepala Dinas"
                                class="w-full aspect-4/5 object-cover bg-slate-200 transition-transform duration-500 hover:scale-105">
                        </a>
                    </div>
                    <div class="flex flex-col items-center space-y-3">
                        <span
                            class="text-[11px] font-bold text-white uppercase tracking-widest text-center leading-tight drop-shadow-md">Sekretaris
                            Dinas</span>
                        <a href="/profil"
                            class="block w-full overflow-hidden rounded-xl shadow-xl border border-slate-700/80 transition-all duration-300 hover:-translate-y-1 hover:border-blue-500 hover:shadow-blue-500/40">
                            <img src="{{ asset('images/pejabat/sekretaris.png') }}" alt="Sekretaris Dinas"
                                class="w-full aspect-4/5 object-cover bg-slate-200 transition-transform duration-500 hover:scale-105">
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div
            class="pt-8 border-t border-slate-800/80 flex flex-col md:flex-row justify-between items-center text-[11px] text-slate-500 uppercase tracking-widest font-semibold">
            <p>&copy; 2026 Pemerintah Provinsi Sulawesi Tengah. All Rights Reserved.</p>
            <div class="mt-4 md:mt-0 flex items-center space-x-1.5">
                <span class="text-slate-600">Developed by</span>
                <span class="text-blue-500 font-black italic hover:text-blue-400 transition-colors cursor-pointer">PPID
                    CIKASDA</span>
            </div>
        </div>

    </div>
</footer>
