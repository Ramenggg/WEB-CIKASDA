<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformationGroup;
use App\Models\InformationItem;
use Illuminate\Http\Request;

class AdminInformationDocumentController extends Controller
{
    /**
     * Simpan kelompok klasifikasi baru.
     */
    public function storeGroup(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|in:berkala,sertamerta,setiapsaat,dikecualikan',
            'num'      => 'required|string|max:10',
            'title'    => 'required|string|max:255',
        ]);

        InformationGroup::create($validated);

        return redirect()->back()->with('success', 'Kelompok klasifikasi berhasil ditambahkan!');
    }

    /**
     * Perbarui kelompok klasifikasi.
     */
    public function updateGroup(Request $request, string $id)
    {
        $group = InformationGroup::findOrFail($id);

        $validated = $request->validate([
            'category' => 'required|string|in:berkala,sertamerta,setiapsaat,dikecualikan',
            'num'      => 'required|string|max:10',
            'title'    => 'required|string|max:255',
        ]);

        $group->update($validated);

        return redirect()->back()->with('success', 'Kelompok klasifikasi berhasil diperbarui!');
    }

    /**
     * Hapus kelompok klasifikasi beserta isinya.
     */
    public function destroyGroup(string $id)
    {
        $group = InformationGroup::findOrFail($id);
        $group->delete();

        return redirect()->back()->with('success', 'Kelompok klasifikasi beserta dokumen di dalamnya berhasil dihapus!');
    }

    /**
     * Simpan item dokumen baru di bawah kelompok tertentu.
     */
    public function storeItem(Request $request)
    {
        $validated = $request->validate([
            'information_group_id' => 'required|exists:information_groups,id',
            'title'                => 'required|string|max:255',
            'detail'               => 'required|string',
            'link'                 => 'nullable|string|max:2048',
            'type'                 => 'required|string|in:internal,external,dikecualikan',
            'status'               => 'nullable|string|max:255',
            'dasar_hukum'          => 'nullable|string|max:500',
        ]);

        InformationItem::create($validated);

        return redirect()->back()->with('success', 'Dokumen klasifikasi berhasil ditambahkan!');
    }

    /**
     * Perbarui dokumen klasifikasi.
     */
    public function updateItem(Request $request, string $id)
    {
        $item = InformationItem::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'detail'      => 'required|string',
            'link'        => 'nullable|string|max:2048',
            'type'        => 'required|string|in:internal,external,dikecualikan',
            'status'      => 'nullable|string|max:255',
            'dasar_hukum' => 'nullable|string|max:500',
        ]);

        $item->update($validated);

        return redirect()->back()->with('success', 'Dokumen klasifikasi berhasil diperbarui!');
    }

    /**
     * Hapus dokumen klasifikasi.
     */
    public function destroyItem(string $id)
    {
        $item = InformationItem::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Dokumen klasifikasi berhasil dihapus!');
    }
}
