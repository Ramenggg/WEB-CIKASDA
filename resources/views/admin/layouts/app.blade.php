<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - CIKASDA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.min.js"></script>
</head>

<body class="bg-slate-100 font-sans">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-900 text-white shrink-0 fixed h-full z-50">
            <div class="p-6 border-b border-slate-800">
                <h2 class="text-xl font-bold tracking-tighter text-cyan-400 uppercase">Admin Panel</h2>
                <p class="text-[10px] text-slate-500 uppercase tracking-widest mt-1 font-bold italic">Dinas Cikasda</p>
            </div>

            <nav class="mt-6 px-4 space-y-1">
                <a href="/admin"
                    class="block px-4 py-2.5 rounded-xl {{ request()->is('admin') ? 'bg-blue-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition text-sm">
                    Dashboard
                </a>

                <div class="pt-6 pb-2 text-[10px] font-bold text-slate-500 uppercase px-4 tracking-widest">Menu Profil
                </div>
                <a href="/admin/profil/struktur"
                    class="block px-4 py-2.5 rounded-xl {{ request()->is('admin/profil/struktur') ? 'bg-blue-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition text-sm">
                    Edit Struktur
                </a>
                <a href="/admin/profil/visi-misi"
                    class="block px-4 py-2.5 rounded-xl {{ request()->is('admin/profil/visi-misi') ? 'bg-blue-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition text-sm">
                    Edit Visi Misi
                </a>
                <a href="/admin/profil/tugas-fungsi"
                    class="block px-4 py-2.5 rounded-xl {{ request()->is('admin/profil/tugas-fungsi') ? 'bg-blue-600 text-white font-bold' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition text-sm">
                    Edit Tugas & Fungsi
                </a>
            </nav>
        </aside>

        <div class="flex-1 ml-64 flex flex-col">
            <header
                class="bg-white border-b border-slate-200 px-8 py-5 flex justify-between items-center sticky top-0 z-40">
                <h3 class="font-bold text-slate-800 text-lg">@yield('title')</h3>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-xs font-bold text-slate-900 uppercase">Administrator</p>
                        <p class="text-[10px] text-green-500 font-medium tracking-widest uppercase">Online</p>
                    </div>
                    <div
                        class="h-10 w-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 font-black border border-blue-200 shadow-sm">
                        A</div>
                </div>
            </header>

            <main class="p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
