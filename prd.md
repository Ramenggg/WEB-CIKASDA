Tentu, saya telah memperbarui Dokumen Persyaratan Produk (PRD) dengan memasukkan detail konfigurasi _font_ (Figtree dan Fraunces) ke dalam spesifikasi Arsitektur Frontend.

Berikut adalah **PRD Terbaru** yang sudah disempurnakan:

---

**DOKUMEN PERSYARATAN PRODUK (PRD) TERBARU**
**Proyek:** Pengembangan Website Dinas Cipta Karya dan Sumber Daya Air (CIKASDA) Provinsi Sulawesi Tengah
**Pendekatan Pengembangan:** _Frontend-First_ (Prototyping & UI/UX diselesaikan sepenuhnya sebelum integrasi _database_).

### **I. Ringkasan Eksekutif & Strategi Pengembangan**

Proyek ini bertujuan untuk membangun portal informasi CIKASDA yang modern, responsif, dan dinamis untuk memfasilitasi transparansi dokumen publik (PPID), publikasi berita, dan pelayanan masyarakat (seperti form aduan dan permohonan informasi).

Untuk memastikan efisiensi, pengembangan mengikuti alur eksekusi **Frontend-First**:

1.  **Fase 1: Fokus Frontend (Saat Ini).** Membangun seluruh antarmuka visual (UI) dan pengalaman pengguna (UX) menggunakan data statis dan rute dinamis.
2.  **Fase 2: Perancangan Database.** Membuat skema _migration_ tabel setelah seluruh desain visual disetujui.
3.  **Fase 3: Integrasi Backend (Fase Akhir).** Membangun Panel Admin (CMS) agar data di _frontend_ dapat diperbarui secara dinamis oleh admin.

### **II. Tumpukan Teknologi (Tech Stack)**

- **Fokus Frontend (Fase 1):** Menggunakan **Laravel Blade** (kerangka HTML), **Tailwind CSS** (kustomisasi gaya responsif), dan **Alpine.js** (komponen interaktif seperti animasi _slider_).
- **Fokus Backend (Fase 3):** Framework utama **Laravel** yang dikombinasikan dengan sistem _Dynamic Content Management_ (sangat direkomendasikan menggunakan **Filament PHP** atau pembuatan **CRUD Manual**) agar pembaruan data tidak menyentuh kode.

### **III. Arsitektur Frontend & Konsep Desain (Fokus Utama)**

- **Filosofi Desain ("The Fluid Infrastructure"):** Memadukan wibawa instansi dengan elemen air. Palet warna menggunakan **Biru Air (Water Blue), Cyan, dan Emerald** untuk representasi air dan lingkungan, dipadukan dengan **Kuning Emas/Amber** sebagai simbol infrastruktur.
- **Pengaturan Tipografi (Font Configuration):** File konfigurasi `tailwind.config.js` dirancang khusus untuk membagi dua peran tipografi. **Dengan konfigurasi ini, setiap kali kamu menggunakan class `font-sans` di Tailwind, teksnya akan otomatis menggunakan Figtree, dan jika kamu menggunakan class `font-heading`, teksnya akan menggunakan Fraunces**.
- **Pemisahan Komponen Visual:** Agar kode tetap rapi dan modular, _layout_ dipecah menjadi file spesifik. Contohnya, `welcome.blade.php` (pengatur halaman utama), `hero-section.blade.php` (komponen _slider_ visual), dan `hero-data.blade.php` (penyimpan teks statis).
- **Routing "Sapu Jagat" (Dynamic View Routing):** Untuk mempercepat _prototyping_ frontend, pengembangan menggunakan _catch-all route_ (`Route::get('/profil/{slug}')`) agar halaman bisa diakses otomatis tanpa mendaftarkan rute berulang kali di `web.php`.
- **Template Profil (Sidebar Layout):** Desain halaman profil menggunakan model layar terbelah (menu navigasi di sisi kiri dan area konten berbasis _Rich Text/Prose_ di sisi kanan).

### **IV. Struktur Navigasi Utama (Sitemap)**

Menu _header dropdown_ di _frontend_ harus dirancang presisi sesuai struktur asli website CIKASDA:

1.  **BERANDA**
2.  **PROFIL:** Struktur Organisasi, Visi dan Misi, Tugas dan Fungsi, Sejarah Singkat, Pejabat, Maklumat Informasi Publik, LHKPN, Keuangan.
3.  **GALERI:** FOTO, VIDEO, BOOKLET.
4.  **INFORMASI PUBLIK:**
    - **DAFTAR INFORMASI:** (_Nested Dropdown_: SETIAP SAAT, SERTA MERTA, BERKALA, DIKECUALIKAN).
    - PUBLIKASI INFORMASI PUBLIK, BERITA, DOKUMEN, PERJANJIAN KERJA SAMA (MOU), FORM PERMOHONAN INFORMASI, SK GUB Bangunan Gedung Untuk Kepentingan Strategis Prov Sulteng 2025.
5.  **PPID:** Surat Keputusan, Visi dan Misi PPID, Pelayanan, PENGHARGAAN, Permohonan Informasi, Dokumen-dokumen elektronik berkaitan program dan kegiatan Tahun 2022 – 2024, SOP & SPM PPID.
6.  **LAYANAN:** e-PADUNGKU, IRIGASIKU, e-Bantekbgn, Lapor, JDIH PROVINSI SULTENG, Form Aduan Masyarakat, Data Base Infrastruktur Schisto, e-larismanis, Lirik Wilda, SISDA UPT PSDA WIL.II, SO CAIR MISI, Simonev, SIH3.

### **V. Standar Informasi Footer Frontend**

Bagian bawah (_footer_) pada setiap halaman wajib memuat data statis berikut:

- **Alamat:** Jalan Prof. Dr. Moh. Yamin No.33 Palu 94114.
- **Kontak:** `cikasda@sultengprov.go.id` | Telp: `(0451) 4015509`.
- **Media Sosial:** Instagram `@cikasda.sulteng`, Facebook `cikasda sultengprov`, Youtube `cikasda sulteng`.
- **Hak Cipta:** "© 2026 - | Dinas Cipta Karya dan Sumber Daya Air Provinsi Sulawesi Tengah".

### **VI. Kebutuhan Fitur Backend & Database (Dikerjakan di Fase Akhir)**

Setelah _layout_ Frontend disetujui, modul _database_ (CMS) berikut akan dibangun agar web menjadi dinamis:

- **Manajemen Profil Universal (`profiles`):** Tabel dinamis untuk menampung teks dari _Rich Text Editor_ atau _upload_ gambar/file khusus halaman profil.
- **Portal Berita (`artikel`):** Mengelola konten CIKASDA NEWS dengan kategori spesifik: **FAKTUAL** dan **PPID CIKASDA**.
- **Manajemen Dokumen & Galeri:** Modul _upload_ untuk aset visual dan dokumen publik (SK, MoU, LHKPN) yang dapat diunduh.
- **Interaksi Pelayanan Publik (`aduan_masyarakat` & `permohonan_informasi`):** Sistem _database_ khusus untuk menampung masukan formulir dari masyarakat umum.
