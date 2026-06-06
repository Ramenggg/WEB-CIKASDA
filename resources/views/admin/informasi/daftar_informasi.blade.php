@extends('admin.layouts.app')

@section('title', 'Kelola Daftar Informasi')

@section('content')
    <div class="w-full pb-12 space-y-8 animate-fade-in" x-data="{
        activeTab: 'berkala',
        groupModalOpen: false,
        groupModalMode: 'create',
        groupData: { id: '', category: 'berkala', num: '', title: '' },

        itemModalOpen: false,
        itemModalMode: 'create',
        itemData: { id: '', information_group_id: '', title: '', detail: '', link: '', type: 'internal', status: '', dasar_hukum: '' },

        deleteConfirmOpen: false,
        deleteConfirmType: 'group',
        deleteConfirmId: '',
        deleteConfirmTitle: '',
        deleteConfirmAction: '',

        showAddGroupModal(category) {
            this.groupModalMode = 'create';
            this.groupData = { id: '', category: category, num: '', title: '' };
            this.groupModalOpen = true;
        },
        showEditGroupModal(group) {
            this.groupModalMode = 'edit';
            this.groupData = { id: group.id, category: group.category, num: group.num, title: group.title };
            this.groupModalOpen = true;
        },
        showAddItemModal(groupId) {
            this.itemModalMode = 'create';
            this.itemData = { id: '', information_group_id: groupId, title: '', detail: '', link: '', type: 'internal', status: '', dasar_hukum: '' };
            this.itemModalOpen = true;
        },
        showEditItemModal(item, groupId) {
            this.itemModalMode = 'edit';
            this.itemData = {
                id: item.id,
                information_group_id: groupId,
                title: item.title,
                detail: item.detail,
                link: item.link || '',
                type: item.type,
                status: item.status || '',
                dasar_hukum: item.dasar_hukum || ''
            };
            this.itemModalOpen = true;
        },
        showDeleteConfirm(type, id, title, actionUrl) {
            this.deleteConfirmType = type;
            this.deleteConfirmId = id;
            this.deleteConfirmTitle = title;
            this.deleteConfirmAction = actionUrl;
            this.deleteConfirmOpen = true;
        }
    }">

        {{-- CARD 1: HERO DESCRIPTION --}}
        <div class="w-full bg-white/90 backdrop-blur-md rounded-3xl shadow-[0_4px_30px_rgba(15,23,42,0.04)] border border-slate-200/80 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-linear-to-r from-slate-50 via-white to-slate-50 flex justify-between items-center">
                <div class="flex items-center space-x-3.5">
                    <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 uppercase tracking-tight text-sm">Manajemen Halaman Daftar Informasi</h4>
                        <p class="text-[11px] text-slate-500 font-medium mt-0.5">Konfigurasi teks deskripsi hero untuk klasifikasi informasi publik.</p>
                    </div>
                </div>
                <span class="text-[10px] bg-blue-50 border border-blue-200 text-blue-700 font-black px-3 py-1 rounded-full uppercase tracking-wider">
                    Control Center
                </span>
            </div>

            {{-- Notifikasi Sukses / Gagal --}}
            @if (session('success'))
                <div class="mx-8 mt-6 px-5 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-800 text-sm font-bold shadow-2xs flex items-center space-x-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mx-8 mt-6 px-5 py-4 bg-red-50 border border-red-100 rounded-2xl text-red-800 text-sm font-bold shadow-2xs">
                    <div class="flex items-center space-x-2 mb-2 text-red-900 font-extrabold uppercase tracking-wide text-xs">
                        ⚠️ Gagal Menyimpan:
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.informasi.daftar.update') }}" method="POST" enctype="multipart/form-data" class="divide-y divide-slate-100">
                @csrf

                {{-- HERO DESCRIPTION --}}
                <div class="p-8 space-y-4 bg-white hover:bg-slate-50/30 transition-all duration-300">
                    <div class="flex items-center space-x-3">
                        <div class="h-7 w-7 rounded-lg bg-indigo-50 border border-indigo-200 text-indigo-600 flex items-center justify-center font-black text-xs shadow-2xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-900 uppercase tracking-[0.15em]">Deskripsi Singkat Banner (Hero)</label>
                            <span class="text-[10px] text-slate-400 font-semibold">Teks deskripsi utama yang tampil di area hero halaman publik Daftar Informasi publik.</span>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 shadow-2xs bg-white overflow-hidden">
                        <div id="editor-hero" class="min-h-[120px]">{!! old('hero_description', $item->hero_description ?? '') !!}</div>
                    </div>
                    <input type="hidden" name="hero_description" id="hidden-hero" value="{{ old('hero_description', $item->hero_description ?? '') }}">
                </div>

                <div class="p-6 bg-slate-50/50 flex items-center justify-end border-t border-slate-100">
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-14 py-3.5 rounded-xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 shadow-md shadow-blue-600/20 active:scale-98 cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- CARD 2: DOCUMENT & CLASSIFICATION MANAGEMENT --}}
        <div class="w-full bg-white/90 backdrop-blur-md rounded-3xl shadow-[0_4px_30px_rgba(15,23,42,0.04)] border border-slate-200/80 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-linear-to-r from-slate-50 via-white to-slate-50 flex justify-between items-center">
                <div class="flex items-center space-x-3.5">
                    <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-600 flex items-center justify-center text-white shadow-md shadow-emerald-500/20">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18V6a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 6v3.75m-9.75-3h.008v.008H12V6.75z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 uppercase tracking-tight text-sm">Kelola Dokumen & Klasifikasi Informasi</h4>
                        <p class="text-[11px] text-slate-500 font-medium mt-0.5">Tambah, ubah, atau hapus dokumen klasifikasi pada accordion halaman publik.</p>
                    </div>
                </div>
            </div>

            {{-- CATEGORY TABS --}}
            <div class="flex border-b border-slate-100 bg-slate-50/50 p-2 gap-2">
                <button @click="activeTab = 'berkala'"
                    class="px-6 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition cursor-pointer"
                    :class="activeTab === 'berkala' ? 'bg-blue-600 text-white shadow-md shadow-blue-500/10' : 'text-slate-600 hover:bg-slate-200/50'">
                    Secara Berkala
                </button>
                <button @click="activeTab = 'sertamerta'"
                    class="px-6 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition cursor-pointer"
                    :class="activeTab === 'sertamerta' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/10' : 'text-slate-600 hover:bg-slate-200/50'">
                    Serta Merta
                </button>
                <button @click="activeTab = 'setiapsaat'"
                    class="px-6 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition cursor-pointer"
                    :class="activeTab === 'setiapsaat' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/10' : 'text-slate-600 hover:bg-slate-200/50'">
                    Setiap Saat
                </button>
                <button @click="activeTab = 'dikecualikan'"
                    class="px-6 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition cursor-pointer"
                    :class="activeTab === 'dikecualikan' ? 'bg-rose-600 text-white shadow-md shadow-rose-500/10' : 'text-slate-600 hover:bg-slate-200/50'">
                    Dikecualikan
                </button>
            </div>

            <div class="p-6 bg-white space-y-6">
                {{-- Category Container --}}
                <div class="flex justify-between items-center pb-2">
                    <h5 class="text-xs font-black uppercase tracking-widest text-slate-400">
                        Kelompok Klasifikasi Aktif: <span class="text-slate-700" x-text="activeTab.toUpperCase()"></span>
                    </h5>
                    <button @click="showAddGroupModal(activeTab)"
                        class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-black text-xs uppercase tracking-wider rounded-xl transition cursor-pointer flex items-center gap-1.5 shadow-2xs">
                        <span>+ Tambah Kelompok</span>
                    </button>
                </div>

                {{-- LOOP GROUPS --}}
                <div class="space-y-6">
                    @foreach (['berkala', 'sertamerta', 'setiapsaat', 'dikecualikan'] as $cat)
                        <div x-show="activeTab === '{{ $cat }}'" class="space-y-6">
                            @php
                                $groups = $informationGroups->where('category', $cat);
                            @endphp

                            @if ($groups->isEmpty())
                                <div class="p-12 border border-dashed border-slate-200 rounded-3xl text-center space-y-2">
                                    <span class="text-3xl block">📁</span>
                                    <h6 class="text-xs font-black text-slate-800 uppercase tracking-wider">Belum Ada Kelompok</h6>
                                    <p class="text-[11px] text-slate-400 font-semibold max-w-sm mx-auto">Silakan tambahkan kelompok klasifikasi informasi baru untuk kategori ini.</p>
                                </div>
                            @else
                                @foreach ($groups as $group)
                                    <div class="border border-slate-200/60 rounded-2xl overflow-hidden shadow-2xs">
                                        {{-- Group Header --}}
                                        <div class="p-4 bg-slate-50 border-b border-slate-200/60 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                                            <div class="flex items-center space-x-3">
                                                <div class="px-2.5 py-1 bg-slate-200 text-slate-700 text-[10px] font-black rounded-lg">
                                                    No. {{ $group->num }}
                                                </div>
                                                <h6 class="text-xs font-black text-slate-800 uppercase tracking-wide">{{ $group->title }}</h6>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <button @click="showEditGroupModal(@js($group))"
                                                    class="px-3 py-1.5 bg-white border border-slate-200 hover:bg-slate-100 text-slate-600 hover:text-slate-800 rounded-lg text-[10px] font-bold uppercase tracking-wider transition cursor-pointer">
                                                    Edit Kelompok
                                                </button>
                                                <button type="button" @click="showDeleteConfirm('group', {{ $group->id }}, @js($group->title), '{{ route('admin.informasi.daftar.group.destroy', $group->id) }}')"
                                                    class="px-3 py-1.5 bg-rose-50 border border-rose-100 hover:bg-rose-100 text-rose-600 rounded-lg text-[10px] font-bold uppercase tracking-wider transition cursor-pointer">
                                                    Hapus
                                                </button>
                                                <button @click="showAddItemModal({{ $group->id }})"
                                                    class="px-3.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-[10px] font-black uppercase tracking-wider transition cursor-pointer">
                                                    + Tambah Dokumen
                                                </button>
                                            </div>
                                        </div>

                                        {{-- Items/Documents Table --}}
                                        <div class="overflow-x-auto">
                                            <table class="w-full text-left border-collapse">
                                                <thead>
                                                    <tr class="bg-white border-b border-slate-100">
                                                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Judul Dokumen</th>
                                                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Detail / Deskripsi</th>
                                                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Tipe</th>
                                                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Tautan</th>
                                                        @if ($cat === 'dikecualikan')
                                                            <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Sifat / Dasar Hukum</th>
                                                        @endif
                                                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-slate-100 bg-white">
                                                    @if ($group->items->isEmpty())
                                                        <tr>
                                                            <td colspan="{{ $cat === 'dikecualikan' ? 6 : 5 }}" class="p-6 text-center text-slate-400 text-[11px] font-semibold">
                                                                Belum ada dokumen di dalam kelompok ini.
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($group->items as $subitem)
                                                            <tr class="hover:bg-slate-50/40 transition">
                                                                <td class="p-4 text-xs font-black text-slate-800">{{ $subitem->title }}</td>
                                                                <td class="p-4 text-[11px] text-slate-500 font-medium max-w-xs leading-relaxed">{{ $subitem->detail }}</td>
                                                                <td class="p-4">
                                                                    <span class="px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider
                                                                        {{ $subitem->type === 'internal' ? 'bg-blue-50 text-blue-700 border border-blue-100' : '' }}
                                                                        {{ $subitem->type === 'external' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : '' }}
                                                                        {{ $subitem->type === 'dikecualikan' ? 'bg-rose-50 text-rose-700 border border-rose-100' : '' }}">
                                                                        {{ $subitem->type }}
                                                                    </span>
                                                                </td>
                                                                <td class="p-4 text-[11px] font-mono text-slate-400 truncate max-w-[120px]">
                                                                    @if ($subitem->link)
                                                                        <a href="{{ $subitem->link }}" target="_blank" class="text-blue-600 hover:underline font-bold">{{ $subitem->link }}</a>
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </td>
                                                                @if ($cat === 'dikecualikan')
                                                                    <td class="p-4 text-[10px] font-semibold text-rose-700">
                                                                        <div>Sifat: <span class="font-bold">{{ $subitem->status ?? '-' }}</span></div>
                                                                        <div class="mt-0.5">Hukum: <span class="italic font-normal">{{ $subitem->dasar_hukum ?? '-' }}</span></div>
                                                                    </td>
                                                                @endif
                                                                <td class="p-4 text-right space-x-1.5 whitespace-nowrap">
                                                                    <button @click="showEditItemModal(@js($subitem), {{ $group->id }})"
                                                                        class="px-2.5 py-1 bg-white border border-slate-200 hover:bg-slate-100 text-slate-600 hover:text-slate-800 rounded-lg text-[10px] font-bold uppercase transition cursor-pointer">
                                                                        Ubah
                                                                    </button>
                                                                    <button type="button" @click="showDeleteConfirm('item', {{ $subitem->id }}, @js($subitem->title), '{{ route('admin.informasi.daftar.item.destroy', $subitem->id) }}')"
                                                                        class="px-2.5 py-1 bg-rose-50 border border-rose-100 hover:bg-rose-100 text-rose-600 rounded-lg text-[10px] font-bold uppercase transition cursor-pointer">
                                                                        Hapus
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- MODAL 1: ADD/EDIT GROUP --}}
        <div x-show="groupModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-xs" @click="groupModalOpen = false"></div>
            {{-- Modal Body --}}
            <div class="relative bg-white rounded-3xl w-full max-w-md p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in-95 duration-200">
                <div class="flex justify-between items-center pb-4 border-b border-slate-100">
                    <h5 class="text-xs font-black uppercase tracking-wider text-slate-800" x-text="groupModalMode === 'create' ? 'Tambah Kelompok Baru' : 'Ubah Kelompok Klasifikasi'"></h5>
                    <button @click="groupModalOpen = false" class="text-slate-400 hover:text-slate-600 text-lg cursor-pointer">&times;</button>
                </div>

                <form :action="groupModalMode === 'create' ? '{{ route('admin.informasi.daftar.group.store') }}' : '/admin/informasi/daftar/kelompok/' + groupData.id" method="POST" class="mt-4 space-y-4">
                    @csrf
                    <template x-if="groupModalMode === 'edit'">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <input type="hidden" name="category" :value="groupData.category">

                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-500 tracking-wider mb-1">Nomor Urut / Index (contoh: 01)</label>
                        <input type="text" name="num" x-model="groupData.num" required placeholder="01"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-500 tracking-wider mb-1">Nama Kelompok Klasifikasi</label>
                        <input type="text" name="title" x-model="groupData.title" required placeholder="Contoh: Keuangan & Realisasi Anggaran"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="pt-4 flex justify-end space-x-2 border-t border-slate-100">
                        <button type="button" @click="groupModalOpen = false"
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-[10px] font-black uppercase tracking-wider rounded-lg transition cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-[10px] font-black uppercase tracking-wider rounded-lg transition cursor-pointer">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- MODAL 2: ADD/EDIT ITEM / DOCUMENT --}}
        <div x-show="itemModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-xs" @click="itemModalOpen = false"></div>
            {{-- Modal Body --}}
            <div class="relative bg-white rounded-3xl w-full max-w-lg p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in-95 duration-200">
                <div class="flex justify-between items-center pb-4 border-b border-slate-100">
                    <h5 class="text-xs font-black uppercase tracking-wider text-slate-800" x-text="itemModalMode === 'create' ? 'Tambah Dokumen Klasifikasi' : 'Ubah Dokumen Klasifikasi'"></h5>
                    <button @click="itemModalOpen = false" class="text-slate-400 hover:text-slate-600 text-lg cursor-pointer">&times;</button>
                </div>

                <form :action="itemModalMode === 'create' ? '{{ route('admin.informasi.daftar.item.store') }}' : '/admin/informasi/daftar/dokumen/' + itemData.id" method="POST" class="mt-4 space-y-4">
                    @csrf
                    <template x-if="itemModalMode === 'edit'">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <input type="hidden" name="information_group_id" :value="itemData.information_group_id">

                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-500 tracking-wider mb-1">Judul Dokumen / Informasi</label>
                        <input type="text" name="title" x-model="itemData.title" required placeholder="Contoh: Laporan Keuangan DPA-SKPD"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-500 tracking-wider mb-1">Detail / Deskripsi Singkat</label>
                        <textarea name="detail" x-model="itemData.detail" required placeholder="Tuliskan keterangan detail mengenai dokumen..." rows="3"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold focus:outline-none focus:border-blue-500"></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase text-slate-500 tracking-wider mb-1">Tipe Tautan / File</label>
                            <select name="type" x-model="itemData.type" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold focus:outline-none focus:border-blue-500">
                                <option value="internal">Internal (Halaman Website)</option>
                                <option value="external">External (Google Drive / Link Luar)</option>
                                <option value="dikecualikan">Dikecualikan (Rahasia / Terkunci)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase text-slate-500 tracking-wider mb-1">Tautan URL (Link)</label>
                            <input type="text" name="link" x-model="itemData.link" placeholder="Contoh: /profil/keuangan atau https://..."
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold focus:outline-none focus:border-blue-500"
                                :disabled="itemData.type === 'dikecualikan'"
                                :class="itemData.type === 'dikecualikan' ? 'bg-slate-100 text-slate-400' : ''">
                        </div>
                    </div>

                    {{-- Khusus Dikecualikan --}}
                    <div x-show="itemData.type === 'dikecualikan'" class="p-4 bg-rose-50/60 border border-rose-100 rounded-2xl space-y-3">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-rose-800">Atribut Khusus Informasi Dikecualikan</span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[9px] font-black uppercase text-rose-700 tracking-wider mb-1">Sifat / Jangka Waktu</label>
                                <input type="text" name="status" x-model="itemData.status" placeholder="Contoh: Ketat/Terbatas"
                                    class="w-full px-4 py-2.5 bg-white border border-rose-200 text-xs font-semibold focus:outline-none focus:border-rose-400 text-rose-800">
                            </div>
                            <div>
                                <label class="block text-[9px] font-black uppercase text-rose-700 tracking-wider mb-1">Dasar Hukum</label>
                                <input type="text" name="dasar_hukum" x-model="itemData.dasar_hukum" placeholder="Contoh: Pasal 17 Huruf g UU KIP"
                                    class="w-full px-4 py-2.5 bg-white border border-rose-200 text-xs font-semibold focus:outline-none focus:border-rose-400 text-rose-800">
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end space-x-2 border-t border-slate-100">
                        <button type="button" @click="itemModalOpen = false"
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-[10px] font-black uppercase tracking-wider rounded-lg transition cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-[10px] font-black uppercase tracking-wider rounded-lg transition cursor-pointer">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- MODAL 3: CONFIRM DELETE --}}
        <div x-show="deleteConfirmOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-xs" @click="deleteConfirmOpen = false"></div>
            {{-- Modal Body --}}
            <div class="relative bg-white rounded-3xl w-full max-w-md p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in-95 duration-200">
                <div class="flex items-center space-x-3 text-rose-600 pb-3 border-b border-slate-100">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h5 class="text-xs font-black uppercase tracking-wider text-rose-700">Konfirmasi Hapus</h5>
                </div>

                <div class="mt-4 space-y-3">
                    <p class="text-[11px] text-slate-500 font-semibold leading-relaxed">
                        Apakah Anda yakin ingin menghapus <span class="font-extrabold text-slate-800" x-text="deleteConfirmType === 'group' ? 'kelompok klasifikasi' : 'dokumen'"></span> berikut?
                    </p>
                    <div class="p-3 bg-rose-50/50 border border-rose-100/50 rounded-2xl">
                        <p class="text-xs font-black text-rose-700 uppercase tracking-wide break-words" x-text="deleteConfirmTitle"></p>
                    </div>
                    <p x-show="deleteConfirmType === 'group'" class="text-[9px] text-rose-500 font-bold italic leading-tight">
                        * Peringatan: Menghapus kelompok klasifikasi ini juga akan menghapus seluruh dokumen yang ada di dalamnya secara permanen.
                    </p>
                </div>

                <form :action="deleteConfirmAction" method="POST" class="mt-6">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="pt-4 flex justify-end space-x-2 border-t border-slate-100">
                        <button type="button" @click="deleteConfirmOpen = false"
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-[10px] font-black uppercase tracking-wider rounded-lg transition cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2 bg-rose-600 hover:bg-rose-700 text-white text-[10px] font-black uppercase tracking-wider rounded-lg transition cursor-pointer">
                            Ya, Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        var quillHero = new Quill('#editor-hero', {
            theme: 'snow',
            placeholder: 'Ketik deskripsi singkat untuk banner hero halaman publik...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });
        quillHero.on('text-change', function() {
            document.getElementById('hidden-hero').value = quillHero.root.innerHTML;
        });
    </script>
@endsection
