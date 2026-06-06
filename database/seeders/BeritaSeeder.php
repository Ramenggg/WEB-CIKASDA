<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\BeritaGambar;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        Berita::truncate();
        BeritaGambar::truncate();

        $b1 = Berita::create([
            'judul' => 'Pembangunan Bendungan Gumbasa Masuk Tahap Finalisasi',
            'slug' => 'pembangunan-bendungan-gumbasa-masuk-tahap-finalisasi-' . time(),
            'konten' => '<p>Proyek rehabilitasi dan pembangunan jaringan irigasi Bendungan Gumbasa kini resmi memasuki tahap finalisasi. Diharapkan infrastruktur ini dapat mengairi lahan pertanian seluas ribuan hektar di Kabupaten Sigi dan Kota Palu secara merata.</p><blockquote>Infrastruktur irigasi yang kuat adalah tulang punggung kedaulatan pangan daerah.</blockquote><p>Melalui koordinasi intensif bersama Balai Wilayah Sungai (BWS) Sulawesi III, pembangunan fisik pintu air dan normalisasi saluran primer telah mencapai 95%. Pihak dinas optimis penyaluran air perdana dapat berjalan lancar sebelum musim tanam berikutnya dimulai.</p>',
            'kategori' => 'Sumber Daya Air',
            'status' => 'Publish'
        ]);
        BeritaGambar::create(['berita_id' => $b1->id, 'file_path' => 'berita/slide4.png', 'urutan' => 0]);
        BeritaGambar::create(['berita_id' => $b1->id, 'file_path' => 'berita/slide3.jpg', 'urutan' => 1]);

        $b2 = Berita::create([
            'judul' => 'Dinas CIKASDA Resmikan Sistem Pengolahan Air Minum (SPAM) Baru',
            'slug' => 'dinas-cikasda-resmikan-spam-baru-' . time(),
            'konten' => '<p>Dinas CIKASDA Sulawesi Tengah meresmikan instalasi SPAM baru untuk melayani kebutuhan air bersih warga. Langkah ini adalah bagian dari komitmen dinas untuk meningkatkan kualitas pelayanan publik di sektor sanitasi.</p><p>Pembangunan infrastruktur ini terfokus pada penyaluran pipa transmisi utama sepanjang 4 kilometer menuju pemukiman warga terdampak krisis air bersih musiman. Kualitas air hasil olahan dipastikan memenuhi baku mutu kesehatan kementerian terkait.</p>',
            'kategori' => 'Infrastruktur',
            'status' => 'Publish'
        ]);
        BeritaGambar::create(['berita_id' => $b2->id, 'file_path' => 'berita/slide5.png', 'urutan' => 0]);

        $b3 = Berita::create([
            'judul' => 'Sosialisasi Pengelolaan Irigasi Partisipatif untuk Kelompok Tani',
            'slug' => 'sosialisasi-pengelolaan-irigasi-partisipatif-' . time(),
            'konten' => '<p>CIKASDA mengadakan sosialisasi terpadu mengenai pengelolaan air irigasi berbasis peran serta masyarakat tani di wilayah irigasi setempat guna menjaga kelestarian debit air.</p><p>Edukasi difokuskan pada pembagian air yang adil dan pemeliharaan tanggul secara gotong royong agar usia pakai jaringan irigasi dapat bertahan lama.</p>',
            'kategori' => 'Sumber Daya Air',
            'status' => 'Publish'
        ]);
        BeritaGambar::create(['berita_id' => $b3->id, 'file_path' => 'berita/slide3.jpg', 'urutan' => 0]);

        $b4 = Berita::create([
            'judul' => 'Kegiatan Dinas: Rapat Kerja Evaluasi Kinerja Semester I Tahun 2026',
            'slug' => 'kegiatan-dinas-rapat-kerja-evaluasi-kinerja-' . time(),
            'konten' => '<p>Seluruh jajaran pimpinan dan staf Dinas CIKASDA berkumpul untuk melakukan evaluasi capaian kinerja pembangunan fisik dan penyerapan anggaran semester pertama tahun ini.</p><p>Rapat ini bertujuan untuk merumuskan langkah taktis guna mempercepat proyek-proyek strategis di sisa tahun anggaran berjalan.</p>',
            'kategori' => 'Kegiatan Dinas',
            'status' => 'Publish'
        ]);
        BeritaGambar::create(['berita_id' => $b4->id, 'file_path' => 'berita/slide4.png', 'urutan' => 0]);

        $b5 = Berita::create([
            'judul' => 'Pengumuman Resmi: Pendaftaran Program Magang Mahasiswa CIKASDA 2026',
            'slug' => 'pengumuman-resmi-pendaftaran-program-magang-' . time(),
            'konten' => '<p>Dinas CIKASDA membuka kesempatan emas bagi mahasiswa tingkat akhir untuk bergabung dalam program magang praktisi di bidang pengelolaan sumber daya air dan tata bangunan.</p><p>Pendaftaran dibuka mulai pertengahan bulan ini melalui portal resmi CIKASDA.</p>',
            'kategori' => 'Pengumuman',
            'status' => 'Publish'
        ]);
        BeritaGambar::create(['berita_id' => $b5->id, 'file_path' => 'berita/slide5.png', 'urutan' => 0]);
    }
}
