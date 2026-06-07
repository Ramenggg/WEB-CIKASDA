@props(['title', 'description' => null, 'item' => null, 'showContentInHero' => true])

{{-- HERO SECTION COMPONENT --}}
<div class="relative w-full overflow-hidden pt-32 pb-48 lg:pt-40 lg:pb-64 bg-blue-900">
    {{-- Background Image --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/slider/slide1.png') }}" alt="Background CIKASDA" class="w-full h-full object-cover object-center scale-105 transform">
        <div class="absolute inset-0 bg-blue-950/80 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-linear-to-b from-blue-900/60 to-transparent"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="w-full flex flex-col items-start text-left">
            {{-- Breadcrumb (Beautified) --}}
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-4 py-2 text-blue-100 text-xs md:text-sm mb-8 font-medium shadow-sm">
                <a href="{{ url('/') }}" class="hover:text-white transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Beranda
                </a>
                <svg class="w-3.5 h-3.5 text-blue-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="hover:text-white transition-colors cursor-pointer">Profil</span>
                <svg class="w-3.5 h-3.5 text-blue-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-white font-semibold">{{ $title }}</span>
            </div>
            
            <div class="border-l-4 border-blue-500/50 pl-4 md:pl-6 mb-8 mt-4">
                <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold font-heading text-white mb-4 tracking-tight relative">
                    {{ $title }}
                </h1>
                
                <div class="text-blue-100 text-sm md:text-base leading-relaxed max-w-2xl">
                    @if (!empty(trim(strip_tags($item->hero_description ?? ''))))
                        <div class="prose prose-invert prose-p:text-blue-100 prose-p:mb-4 last:prose-p:mb-0 prose-p:leading-relaxed prose-strong:text-white prose-em:text-blue-200 max-w-none text-sm md:text-base [&_ul]:list-disc [&_ul]:pl-4 [&_ul]:mb-4 [&_ol]:list-decimal [&_ol]:pl-4 [&_ol]:mb-4 [&_*]:!bg-transparent [&_*]:!text-inherit">{!! $item->hero_description !!}</div>
                    @elseif ($showContentInHero && isset($item) && isset($item->content_data) && !empty(trim(strip_tags($item->content_data))))
                        <div class="prose prose-invert prose-p:text-blue-100 prose-p:mb-4 last:prose-p:mb-0 prose-p:leading-relaxed max-w-none text-sm md:text-base [&_*]:!bg-transparent [&_*]:!text-inherit">
                            {!! $item->content_data !!}
                        </div>
                    @else
                        {{ $description ?? 'Informasi selengkapnya mengenai profil Dinas Cipta Karya dan Sumber Daya Air.' }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
