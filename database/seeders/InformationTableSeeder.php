<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InformationGroup;
use App\Models\InformationItem;

class InformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data to avoid duplication
        InformationItem::truncate();
        // Since information_groups is constraint, disable checks/truncate cascade if needed, or simply truncate cascade
        // Let's do it safely:
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        InformationGroup::truncate();
        InformationItem::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $data = [
            // 1. BERKALA
            [
                'category' => 'berkala',
                'num' => '01',
                'title' => 'Keuangan & Realisasi Anggaran',
                'items' => [
                    [
                        'title' => 'Laporan Keuangan DPA-SKPD & Neraca',
                        'detail' => 'Informasi keuangan dan pertanggungjawaban dinas berkala.',
                        'link' => '/profil/keuangan',
                        'type' => 'internal'
                    ],
                    [
                        'title' => 'Laporan Harta Kekayaan ASN (LHKPN / LHKASN)',
                        'detail' => 'Transparansi pelaporan kekayaan pejabat publik di lingkungan dinas.',
                        'link' => '/profil/lhkpn',
                        'type' => 'internal'
                    ]
                ]
            ],
            [
                'category' => 'berkala',
                'num' => '02',
                'title' => 'Perencanaan Strategis & Kinerja',
                'items' => [
                    [
                        'title' => 'Rencana Strategis (Renstra) & Rencana Kerja',
                        'detail' => 'Dokumen perencanaan jangka panjang dan program kerja operasional tahunan.',
                        'link' => '/profil/visi-misi',
                        'type' => 'internal'
                    ]
                ]
            ],
            [
                'category' => 'berkala',
                'num' => '03',
                'title' => 'Struktur Organisasi & Profil Instansi',
                'items' => [
                    [
                        'title' => 'Struktur Organisasi & Profil Pejabat',
                        'detail' => 'Daftar pejabat struktural beserta tugas pokok dan fungsi jabatan.',
                        'link' => '/profil/struktur-organisasi',
                        'type' => 'internal'
                    ]
                ]
            ],

            // 2. SERTA MERTA
            [
                'category' => 'sertamerta',
                'num' => '01',
                'title' => 'Bidang Irigasi (IRWA)',
                'items' => [
                    [
                        'title' => 'Informasi Daya Rusak Air Terhadap Fasilitas Irigasi (IRWA) - 2022',
                        'detail' => 'Laporan kedaruratan kerusakan fasilitas irigasi dampak daya rusak air.',
                        'link' => '#',
                        'type' => 'external'
                    ],
                    [
                        'title' => 'Informasi Daya Rusak Air Terhadap Fasilitas Irigasi (IRWA) - 2023',
                        'detail' => 'Data penanggulangan darurat kerusakan sistem irigasi di wilayah sungai.',
                        'link' => '#',
                        'type' => 'external'
                    ]
                ]
            ],
            [
                'category' => 'sertamerta',
                'num' => '02',
                'title' => 'Bidang Sungai dan Pantai (SPDAB)',
                'items' => [
                    [
                        'title' => 'Informasi Daya Rusak Air Terhadap Fasilitas Sungai dan Pantai (SPDAB) - 2022',
                        'detail' => 'Monitoring kerusakan pantai, tanggul jebol, dan fasilitas pengaman sungai.',
                        'link' => '#',
                        'type' => 'external'
                    ],
                    [
                        'title' => 'Informasi Daya Rusak Air Terhadap Fasilitas Sungai dan Pantai (SPDAB) - 2023',
                        'detail' => 'Laporan kejadian bencana banjir dan abrasi pantai yang merusak infrastruktur.',
                        'link' => '#',
                        'type' => 'external'
                    ]
                ]
            ],
            [
                'category' => 'sertamerta',
                'num' => '03',
                'title' => 'Bidang Penataan Lingkungan & Bangunan Gedung (PLBG)',
                'items' => [
                    [
                        'title' => 'Informasi Kerusakan Infrastruktur Akibat Bencana (PLBG) - 2022',
                        'detail' => 'Kerusakan gedung pemerintahan dan fasilitas umum pasca bencana alam.',
                        'link' => '#',
                        'type' => 'external'
                    ],
                    [
                        'title' => 'Informasi Kerusakan Infrastruktur Akibat Bencana (PLBG) - 2023',
                        'detail' => 'Laporan teknis rehabilitasi gedung dan lingkungan akibat dampak bencana.',
                        'link' => '#',
                        'type' => 'external'
                    ]
                ]
            ],
            [
                'category' => 'sertamerta',
                'num' => '04',
                'title' => 'Bidang Air Minum & Penyehatan Lingkungan (AMPLP)',
                'items' => [
                    [
                        'title' => 'Informasi Kerusakan Infrastruktur Akibat Bencana (AMPLP) - 2022',
                        'detail' => 'Dampak kerusakan sarana air minum dan penyehatan lingkungan pemukiman.',
                        'link' => '#',
                        'type' => 'external'
                    ],
                    [
                        'title' => 'Informasi Kerusakan Infrastruktur Akibat Bencana (AMPLP) - 2023',
                        'detail' => 'Data tanggap darurat and rekonstruksi sarana penyediaan air bersih.',
                        'link' => '#',
                        'type' => 'external'
                    ]
                ]
            ],

            // 3. SETIAP SAAT
            [
                'category' => 'setiapsaat',
                'num' => '01',
                'title' => 'Standar Pelayanan Layanan Informasi (PPIDP)',
                'items' => [
                    [
                        'title' => 'Standar Pelayanan Layanan Informasi Publik (PPIDP) - 2022',
                        'detail' => 'SOP resmi pelayanan permohonan informasi publik PPID Pembantu.',
                        'link' => '#',
                        'type' => 'external'
                    ],
                    [
                        'title' => 'Standar Pelayanan Layanan Informasi Publik (PPIDP) - 2023',
                        'detail' => 'Pembaruan maklumat pelayanan dan standar operasional informasi.',
                        'link' => '#',
                        'type' => 'external'
                    ]
                ]
            ],
            [
                'category' => 'setiapsaat',
                'num' => '02',
                'title' => 'Regulasi & Keputusan Kepala Dinas',
                'items' => [
                    [
                        'title' => 'Surat Keputusan (SK) Kepala Dinas',
                        'detail' => 'Kumpulan regulasi keputusan dinas dalam hal keorganisasian dan teknis.',
                        'link' => '#',
                        'type' => 'internal'
                    ]
                ]
            ],
            [
                'category' => 'setiapsaat',
                'num' => '03',
                'title' => 'SOP & Maklumat Pelayanan Publik',
                'items' => [
                    [
                        'title' => 'SOP dan SPM PPID Dinas Cikasda',
                        'detail' => 'Standard Operating Procedure dan Standar Pelayanan Minimal informasi publik.',
                        'link' => '/ppid/sop-spm',
                        'type' => 'internal'
                    ]
                ]
            ],

            // 4. DIKECUALIKAN
            [
                'category' => 'dikecualikan',
                'num' => '01',
                'title' => 'Kepegawaian & Disiplin ASN',
                'items' => [
                    [
                        'title' => 'Dokumen Kepegawaian (Arsip Fisik Individu ASN)',
                        'detail' => 'Kategori rahasia jabatan karena menyangkut data riwayat pribadi pegawai.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Pasal 17 Huruf g UU KIP'
                    ],
                    [
                        'title' => 'Daftar Usulan Mutasi Jabatan ASN',
                        'detail' => 'Proses perencanaan penempatan jabatan staf yang belum bersifat final.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Pasal 17 Huruf h UU KIP'
                    ],
                    [
                        'title' => 'Laporan Pengusulan Cerai ASN',
                        'detail' => 'Data privasi keluarga pegawai yang dilindungi undang-undang hak sipil.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Pasal 17 Huruf g UU KIP'
                    ],
                    [
                        'title' => 'Usul Penjatuhan Sanksi Disiplin ASN',
                        'detail' => 'Informasi sanksi disiplin pegawai internal.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Pasal 17 Huruf g UU KIP'
                    ]
                ]
            ],
            [
                'category' => 'dikecualikan',
                'num' => '02',
                'title' => 'Korespondensi Internal & Disposisi',
                'items' => [
                    [
                        'title' => 'Disposisi Surat Pimpinan & Nota Dinas Internal',
                        'detail' => 'Naskah dinas intern yang masih berupa draf kebijakan tertutup.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Pasal 17 Huruf a UU KIP'
                    ]
                ]
            ],
            [
                'category' => 'dikecualikan',
                'num' => '03',
                'title' => 'Pengadaan Barang & Jasa (PBJ)',
                'items' => [
                    [
                        'title' => 'Surat Penawaran Harga Pemenang Lelang',
                        'detail' => 'Dokumen rahasia persaingan usaha sehat pengadaan barang/jasa.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Pasal 17 Huruf b UU KIP'
                    ],
                    [
                        'title' => 'Dokumen Penawaran Pengadaan',
                        'detail' => 'Berkas administrasi penawaran yang memuat data pribadi.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Pasal 17 Huruf g UU KIP'
                    ]
                ]
            ],
            [
                'category' => 'dikecualikan',
                'num' => '04',
                'title' => 'Keuangan Terbatas',
                'items' => [
                    [
                        'title' => 'Dokumen Kelengkapan Surat Perintah Membayar (SPM) Tahun Berjalan',
                        'detail' => 'Berkas keuangan transaksional sebelum audit resmi BPK.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Pasal 17 Huruf j UU KIP'
                    ],
                    [
                        'title' => 'Neraca Keuangan Internal',
                        'detail' => 'Rincian draf neraca kas daerah.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Pasal 17 Huruf j UU KIP'
                    ]
                ]
            ],
            [
                'category' => 'dikecualikan',
                'num' => '05',
                'title' => 'Perencanaan Teknis & Pelaksanaan',
                'items' => [
                    [
                        'title' => 'Daftar Pelaksanaan Perencanaan (IRWA)',
                        'detail' => 'Rencana Detail Teknis (DED) jaringan irigasi yang masih berproses.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Pasal 17 Huruf b UU KIP'
                    ],
                    [
                        'title' => 'Daftar Pelaksanaan Perencanaan (SPDAB)',
                        'detail' => 'Rencana teknis perlindungan sungai dan pantai.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Pasal 17 Huruf b UU KIP'
                    ],
                    [
                        'title' => 'Daftar Pelaksanaan Perencanaan (PLBG)',
                        'detail' => 'Gambar rencana teknis bangunan gedung strategis.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Pasal 17 Huruf b UU KIP'
                    ],
                    [
                        'title' => 'Daftar Pelaksanaan Perencanaan (AMPLP)',
                        'detail' => 'Rencana teknis jaringan penyediaan air minum.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Pasal 17 Huruf b UU KIP'
                    ]
                ]
            ],
            [
                'category' => 'dikecualikan',
                'num' => '06',
                'title' => 'Data Hidrologi Mentah',
                'items' => [
                    [
                        'title' => 'Data Curah Hujan (UPT PSDA Wilayah I & II)',
                        'detail' => 'Kumpulan database hidrometri wilayah sungai sebelum melalui verifikasi.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Peraturan Teknis BMKG/Dinas'
                    ],
                    [
                        'title' => 'Data Klimatologi (UPT PSDA Wilayah I & II)',
                        'detail' => 'Data iklim mentah stasiun meteorologi.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Peraturan Teknis BMKG/Dinas'
                    ],
                    [
                        'title' => 'Data Debit Sungai (UPT PSDA Wilayah I & II)',
                        'detail' => 'Data rekaman AWLR mentah pintu air sungai.',
                        'link' => null,
                        'type' => 'dikecualikan',
                        'status' => 'Ketat/Terbatas',
                        'dasar_hukum' => 'Peraturan Teknis BMKG/Dinas'
                    ]
                ]
            ]
        ];

        foreach ($data as $groupData) {
            $group = InformationGroup::create([
                'category' => $groupData['category'],
                'num' => $groupData['num'],
                'title' => $groupData['title'],
            ]);

            foreach ($groupData['items'] as $itemData) {
                $group->items()->create($itemData);
            }
        }
    }
}
