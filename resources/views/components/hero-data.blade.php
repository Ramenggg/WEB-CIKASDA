<div class="w-full flex flex-col items-center text-center px-4">

    {{-- ── Province badge ── --}}
    <div
        class="inline-flex items-center gap-2.5 px-5 py-2 rounded-full bg-cyan-500/10 border border-cyan-400/20 backdrop-blur-md mb-6">
        <div class="flex items-center gap-1">
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-bounce [animation-delay:0s]"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-bounce [animation-delay:-0.15s]"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-200 animate-bounce [animation-delay:-0.3s]"></span>
        </div>
        <span class="text-cyan-100 text-[10px] sm:text-xs font-bold tracking-[0.25em] uppercase">
            Provinsi Sulawesi Tengah
        </span>
    </div>

    {{-- ── Main headline ── --}}
    <h1
        class="font-heading font-black leading-[1.05] tracking-tight drop-shadow-2xl mb-4
               text-4xl sm:text-5xl md:text-6xl lg:text-7xl">
        <span class="text-white block">Dinas Cipta Karya dan</span>
        <span class="block text-transparent bg-clip-text bg-linear-to-r from-cyan-400 via-sky-400 to-emerald-400">
            Sumber Daya Air
        </span>
    </h1>

    {{-- ── Accent divider ── --}}
    <div class="w-12 h-0.5 bg-linear-to-r from-cyan-400/70 to-emerald-400/25 rounded-full my-5"></div>

    {{-- ── Description ── --}}
    <p
        class="font-sans text-sm sm:text-base md:text-lg text-blue-50/80 mb-10 leading-relaxed font-light max-w-xl mx-auto tracking-wide">
        Mengalirkan inovasi, membangun peradaban. Mewujudkan infrastruktur Sulawesi Tengah yang mandiri melalui
        pengelolaan sumber daya air yang berkelanjutan.
    </p>

    {{-- ── CTA buttons ── --}}
    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full sm:w-auto">

        {{-- Primary --}}
        <a href="/ppid/pelayanan"
            class="group relative w-full sm:w-auto inline-flex items-center justify-center gap-2
                   px-8 py-3.5 rounded-2xl overflow-hidden
                   bg-linear-to-br from-blue-600 to-cyan-500
                 text-white font-sans text-[11px] font-bold tracking-[0.2em] uppercase
                   shadow-[0_10px_28px_-6px_rgba(8,145,178,0.5)]
                   hover:shadow-[0_16px_36px_-6px_rgba(34,211,238,0.55)]s
                   hover:-translate-y-0.5 transition-all duration-300">
            <span
                class="absolute inset-0 bg-white/15 translate-y-full group-hover:translate-y-0 transition-transform duration-400"></span>
            <span class="relative z-10">Akses PPID</span>
            <svg class="relative z-10 w-4 h-4 group-hover:translate-x-1 transition-transform duration-200"
                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round"
                stroke-linejoin="round" aria-hidden="true">
                <path d="M14 5l7 7-7 7M21 12H3" />
            </svg>
        </a>

        {{-- Secondary --}}
        <a href="/#layanan"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2
                   px-8 py-3.5 rounded-2xl
                   bg-white/4 text-cyan-200
                   font-sans text-[11px] font-bold tracking-[0.2em] uppercase
                   border border-cyan-400/25 backdrop-blur-md
                   hover:bg-cyan-400/10 hover:border-cyan-400/50
                   hover:-translate-y-0.5 transition-all duration-300">
            <svg class="w-4 h-4 text-cyan-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path
                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
            </svg>
            <span>Lihat Layanan</span>
        </a>

    </div>

</div>
