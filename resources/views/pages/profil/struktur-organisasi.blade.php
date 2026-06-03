@extends('layouts.app')

@section('content')
    <x-profil-hero title="Struktur Organisasi" :item="$item" description="Bagan susunan hierarki dan tata kerja resmi yang membentuk sistem koordinasi serta pelaksanaan tugas di lingkungan Dinas CIKASDA." />

    {{-- KONTEN UTAMA OVERLAPPING HERO --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-24">
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- Bagian Kiri: Chart Area (Sekitar 75%) --}}
            <div class="lg:w-3/4 flex flex-col gap-8">
                
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 border border-slate-100 flex flex-col h-full">
                <div class="text-center mb-8 relative">
                    <h2 class="text-lg md:text-xl font-bold text-slate-800 inline-block relative pb-3">
                        Bagan Struktur Organisasi
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-blue-600 rounded-full"></span>
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-slate-100 rounded-full -z-10"></span>
                    </h2>
                </div>
                


                {{-- Zoom Controls --}}
                @if (isset($item) && $item->primary_image_path)
                <div class="flex justify-end mb-4">
                    <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden bg-white shadow-sm">
                        <button type="button" onclick="zoomOut()" class="px-3 py-2 text-slate-500 hover:bg-slate-50 border-r border-slate-200 transition-colors" title="Perkecil">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                        </button>
                        <span id="zoom-level" class="px-3 py-2 text-sm font-bold text-slate-700 w-16 text-center select-none">100%</span>
                        <button type="button" onclick="zoomIn()" class="px-3 py-2 text-slate-500 hover:bg-slate-50 border-l border-slate-200 transition-colors" title="Perbesar">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                        <button type="button" onclick="resetZoom()" class="px-3 py-2 text-blue-600 hover:bg-blue-50 border-l border-slate-200 transition-colors" title="Kembalikan Ukuran Asli">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </button>
                    </div>
                </div>
                @endif

                {{-- Chart Area --}}
                <div id="zoom-container" class="relative w-full bg-slate-50/50 flex-1 min-h-[500px] overflow-auto border border-slate-100 rounded-xl p-4 cursor-grab">
                    @if (isset($item) && $item->primary_image_path)
                        <div id="zoom-wrapper" class="flex items-center justify-center transition-all duration-300 mx-auto" style="width: 100%;">
                            <img src="{{ Storage::url($item->primary_image_path) }}" alt="Bagan Struktur Organisasi CIKASDA"
                                class="w-full h-auto object-contain shadow-md rounded-2xl pointer-events-none">
                        </div>
                    @else
                        <div class="relative z-10 w-full flex flex-col items-center justify-center py-12">
                            <div class="w-24 h-24 mb-6 bg-slate-50 rounded-full border border-slate-100 flex items-center justify-center mx-auto shadow-sm">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-700 mb-2">Bagan Belum Tersedia</h3>
                            <p class="text-slate-500 text-sm leading-relaxed max-w-md text-center">Struktur organisasi akan ditampilkan setelah gambar bagan diunggah oleh administrator ke dalam sistem.</p>
                        </div>
                    @endif
                </div>
                </div>
            </div>

            {{-- Bagian Kanan: Sekilas Dinas Sidebar (Sekitar 25%) --}}
            <div class="lg:w-1/4">
                <x-sekilas-dinas-sidebar />
            </div>

        </div>
    </div>

    @if (isset($item) && $item->primary_image_path)
    <script>
        let currentZoom = 100;
        const zoomStep = 25;
        const maxZoom = 300;
        const minZoom = 50;

        function updateZoom() {
            const wrapper = document.getElementById('zoom-wrapper');
            const zoomLabel = document.getElementById('zoom-level');
            
            if(wrapper && zoomLabel) {
                wrapper.style.width = currentZoom + '%';
                zoomLabel.innerText = currentZoom + '%';
            }
        }

        function zoomIn() {
            if (currentZoom < maxZoom) {
                currentZoom += zoomStep;
                updateZoom();
            }
        }

        function zoomOut() {
            if (currentZoom > minZoom) {
                currentZoom -= zoomStep;
                updateZoom();
            }
        }

        function resetZoom() {
            currentZoom = 100;
            updateZoom();
        }

        // Drag to Pan & Wheel to Zoom
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('zoom-container');
            if(!container) return;

            let isDown = false;
            let startX, startY, scrollLeft, scrollTop;

            container.addEventListener('mousedown', (e) => {
                isDown = true;
                container.style.cursor = 'grabbing';
                startX = e.pageX - container.offsetLeft;
                startY = e.pageY - container.offsetTop;
                scrollLeft = container.scrollLeft;
                scrollTop = container.scrollTop;
            });
            
            const stopDragging = () => {
                isDown = false;
                container.style.cursor = 'grab';
            };
            
            container.addEventListener('mouseleave', stopDragging);
            container.addEventListener('mouseup', stopDragging);
            
            container.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - container.offsetLeft;
                const y = e.pageY - container.offsetTop;
                container.scrollLeft = scrollLeft - (x - startX) * 1.5;
                container.scrollTop = scrollTop - (y - startY) * 1.5;
            });

            container.addEventListener('wheel', (e) => {
                // Gunakan kombinasi Ctrl/Command + Scroll untuk zoom (standar Trackpad Pinch)
                if(e.ctrlKey || e.metaKey) { 
                    e.preventDefault(); 
                    if(e.deltaY < 0) {
                        zoomIn();
                    } else {
                        zoomOut();
                    }
                }
            }, { passive: false });
        });
    </script>
    @endif
@endsection
