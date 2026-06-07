{{-- WEATHER WIDGET COMPONENT --}}
@if (isset($weatherData) && $weatherData)
    <div x-data="{ expanded: false }" class="relative">
        
        {{-- COMPACT MODE (RIGHT TAB) --}}
        <div x-show="!expanded" 
             x-on:click="expanded = true"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-10"
             x-transition:enter-end="opacity-100 translate-x-0"
             class="fixed right-0 top-[15%] z-[9999] pointer-events-auto cursor-pointer flex flex-col items-center bg-[#1a1a1a]/95 backdrop-blur-xl border border-white/10 border-r-0 rounded-l-[20px] shadow-[0_10px_30px_rgba(0,0,0,0.5)] w-16 overflow-hidden">
            
            <div class="pt-5 pb-3 flex flex-col items-center gap-1 w-full text-center">
                <span class="text-white font-bold text-2xl leading-none">{{ $weatherData['current']['temp'] }}<span class="text-[#e6a817] text-sm ml-0.5">°C</span></span>
                <span class="text-white/80 text-[10px] mt-1 tracking-wide">{{ $weatherData['current']['description'] }}</span>
            </div>
            
            <div class="p-2 w-full mb-1">
                <div class="bg-[#1e88e5] w-full aspect-square flex items-center justify-center rounded-[10px] hover:bg-blue-500 transition-colors shadow-lg">
                    <span class="material-symbols-outlined text-white font-bold text-xl">chevron_left</span>
                </div>
            </div>
        </div>

        {{-- FULL MODE (EXPANDED CARD) --}}
        <div x-show="expanded" 
             class="fixed inset-0 z-[10000] flex items-center justify-center sm:justify-end sm:pr-6 p-4 pointer-events-none"
             x-cloak>
             
            {{-- Backdrop --}}
            <div x-show="expanded" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-black/40 pointer-events-auto"
                 x-on:click="expanded = false"></div>

            {{-- Main Card --}}
            <div x-show="expanded" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-x-12"
                 x-transition:enter-end="opacity-100 scale-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-x-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-x-12"
                 class="relative w-full max-w-[340px] bg-[#1a1a1a] rounded-[28px] shadow-[0_30px_60px_rgba(0,0,0,0.6)] overflow-hidden flex flex-col pointer-events-auto select-none border border-white/10">
                
                {{-- Header --}}
                <div class="p-6 pb-2 flex justify-between items-center">
                    <span class="text-white font-bold text-sm tracking-wide">Hari Ini</span>
                    <span class="text-white/70 text-xs">{{ $weatherData['date'] }}</span>
                </div>

                {{-- Temp & Icon --}}
                <div class="px-6 mt-4 flex justify-between items-start">
                    <div class="flex flex-col">
                        <div class="flex items-start">
                            <span class="text-[76px] font-bold text-white tracking-tighter leading-none">{{ $weatherData['current']['temp'] }}</span>
                            <span class="text-[#e6a817] text-2xl font-bold ml-1 mt-2">°C</span>
                        </div>
                        <span class="text-white/90 text-[15px] mt-2">{{ $weatherData['current']['description'] }}</span>
                    </div>
                    <div class="relative w-20 h-20 mr-2 flex items-center justify-center">
                        @if(stripos($weatherData['current']['description'], 'cerah') !== false)
                            <div class="w-16 h-16 bg-[#fde047] rounded-full shadow-[0_0_40px_rgba(250,204,21,0.25)]"></div>
                        @else
                            <span class="material-symbols-outlined text-[72px] text-yellow-400 drop-shadow-[0_0_20px_rgba(250,204,21,0.3)]">
                                {{ $weatherData['current']['icon'] }}
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Location & Source --}}
                <div class="px-6 mt-5 flex items-center justify-between mb-5">
                    <div class="flex items-center gap-1.5 text-white/70">
                        <span class="material-symbols-outlined text-[18px]">location_on</span>
                        <span class="text-[13px]">{{ $weatherData['location'] }}</span>
                    </div>
                    <div class="flex items-center gap-1.5 px-3 py-1 bg-white/5 rounded-full border border-white/10">
                        <span class="text-[10px] font-bold text-white/40 uppercase tracking-widest">Sumber</span>
                        <span class="text-[11px] font-black text-[#e6a817] tracking-tight">BMKG</span>
                    </div>
                </div>

                {{-- Middle Stats Bar --}}
                <div class="mx-5 mb-5 p-3 bg-[#262626] rounded-2xl flex items-center justify-between border border-white/5 shadow-inner">
                    <div class="flex items-center gap-2.5 flex-1 pl-1">
                        <span class="material-symbols-outlined text-white/50 text-xl">cloud</span>
                        <div class="flex flex-col">
                            <span class="text-[10px] text-white/50 tracking-wide">Kelembapan</span>
                            <span class="text-xs font-semibold text-white mt-0.5">{{ $weatherData['current']['humidity'] }}%</span>
                        </div>
                    </div>
                    <div class="w-px h-8 bg-white/10"></div>
                    <div class="flex items-center gap-2.5 flex-1 justify-center">
                        <span class="material-symbols-outlined text-white/50 text-xl">air</span>
                        <div class="flex flex-col">
                            <span class="text-[10px] text-white/50 tracking-wide">Kecepatan</span>
                            <span class="text-xs font-semibold text-white mt-0.5">{{ $weatherData['current']['wind_speed'] }}</span>
                        </div>
                    </div>
                    <div class="w-px h-8 bg-white/10"></div>
                    <div class="flex items-center gap-2 flex-1 justify-end pr-1">
                        <span class="material-symbols-outlined text-white/50 text-lg">swap_horiz</span>
                        <div class="flex flex-col">
                            <span class="text-[10px] text-white/50 tracking-wide">Arah Angin</span>
                            <span class="text-[11px] font-semibold text-white mt-0.5 leading-tight whitespace-nowrap">{{ $weatherData['current']['wind_dir'] ?? 'Barat Daya' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Hourly List Section --}}
                <div class="px-5 pb-6 space-y-2.5">
                    @foreach ($weatherData['hourly'] as $hour)
                        <div class="bg-transparent border border-white/10 rounded-2xl p-3 flex items-center justify-between hover:bg-white/5 transition-colors">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-xl bg-[#262626] flex items-center justify-center shadow-inner border border-white/5">
                                    @if(stripos($hour['desc'], 'cerah') !== false)
                                        <div class="w-[18px] h-[18px] bg-[#fde047] rounded-full"></div>
                                    @else
                                        <span class="material-symbols-outlined text-lg text-[#fde047]">{{ $hour['icon'] }}</span>
                                    @endif
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[13px] font-bold text-white">{{ $hour['time'] }} WIB</span>
                                    <span class="text-[11px] text-white/70 mt-0.5">{{ $hour['desc'] }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 pr-1">
                                <span class="text-sm font-bold text-white">{{ $hour['temp'] }}°</span>
                                <span class="text-white/30 font-light text-lg">/</span>
                                <span class="text-sm font-bold text-white">{{ $hour['hu'] }}%</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
@endif
