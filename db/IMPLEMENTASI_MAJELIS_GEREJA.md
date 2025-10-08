# 🚀 Panduan Implementasi Modul Majelis Gereja

## ✅ Status: FULLY IMPLEMENTED

Modul Majelis Gereja telah selesai diimplementasikan dan siap digunakan!

---

## 📦 Komponen yang Telah Dibuat

### 1. Database Schema ✅
- **File**: `db/custome__majelis_gereja.sql`
- **Tables**: 7 tabel dengan relasi lengkap
  - `custome__majelis_gereja` (tabel utama)
  - `custome__jabatan_majelis` (master jabatan)
  - `custome__masa_jabatan_majelis` (periode jabatan)
  - `custome__penahbisan_majelis` (rekord penahbisan)
  - `custome__komisi_majelis` (master komisi)
  - `custome__majelis_komisi` (junction table)
  - `custome__absensi_majelis` (absensi rapat)

### 2. Models ✅
- **M_MajelisGereja.php** - 15+ methods
- **M_JabatanMajelis.php** - 5 methods
- **M_MasaJabatanMajelis.php** - 6 methods
- **M_KomisiMajelis.php** - 5 methods

### 3. Controller ✅
- **MajelisGereja.php** - 17 methods
  - CRUD lengkap
  - File upload handling
  - Status management
  - Dashboard analytics

### 4. Views ✅
- `index.php` - Main page dengan AJAX
- `list.php` - DataTable dengan statistik
- `tambah.php` - Form tambah dengan multi-upload
- `edit.php` - Form edit dengan preview
- `lihat.php` - Detail view lengkap

### 5. Routes ✅
- 12 route endpoints terintegrasi

### 6. BaseController ✅
- 4 models terintegrasi

---

## 🔧 Langkah Instalasi

### Step 1: Import Database Schema
```bash
# Jalankan SQL file di database Anda
mysql -u username -p database_name < db/custome__majelis_gereja.sql
```

Atau melalui phpMyAdmin:
1. Buka phpMyAdmin
2. Pilih database Anda
3. Klik tab "Import"
4. Upload file `custome__majelis_gereja.sql`
5. Klik "Go"

### Step 2: Verifikasi File
Pastikan semua file sudah ada:

**Models:**
- ✅ `app/Models/M_MajelisGereja.php`
- ✅ `app/Models/M_JabatanMajelis.php`
- ✅ `app/Models/M_MasaJabatanMajelis.php`
- ✅ `app/Models/M_KomisiMajelis.php`

**Controller:**
- ✅ `app/Controllers/MajelisGereja.php`

**Views:**
- ✅ `app/Views/backend/morvin/cmscust/majelis_gereja/index.php`
- ✅ `app/Views/backend/morvin/cmscust/majelis_gereja/list.php`
- ✅ `app/Views/backend/morvin/cmscust/majelis_gereja/tambah.php`
- ✅ `app/Views/backend/morvin/cmscust/majelis_gereja/edit.php`
- ✅ `app/Views/backend/morvin/cmscust/majelis_gereja/lihat.php`

**Config:**
- ✅ Routes sudah ditambahkan di `app/Config/Routes.php`
- ✅ Models sudah ditambahkan di `app/Controllers/BaseController.php`

### Step 3: Buat Folder Upload
```bash
# Pastikan folder upload ada dan writable
mkdir -p public/img/informasi/pegawai
chmod 755 public/img/informasi/pegawai
```

### Step 4: Daftarkan Modul di Sistem

#### A. Tambahkan ke Menu Navigasi
Edit file menu navigasi Anda dan tambahkan:
```php
[
    'title' => 'Majelis Gereja',
    'icon' => 'fas fa-user-tie',
    'url' => 'majelis-gereja/list',
    'submenu' => []
]
```

#### B. Daftarkan di Grup Akses
1. Login sebagai Admin
2. Buka menu **Pengaturan > Grup Akses**
3. Tambahkan modul baru:
   - **Nama Modul**: Majelis Gereja
   - **URL**: `majelis-gereja/list`
   - **Icon**: `fas fa-user-tie`
4. Set permission untuk setiap grup user

### Step 5: Insert Data Master (Optional)

#### Jabatan Default:
```sql
INSERT INTO custome__jabatan_majelis (nama_jabatan, deskripsi, tingkatan, status) VALUES
('Ketua Majelis', 'Ketua Majelis Gereja', 'Lokal', 'Aktif'),
('Wakil Ketua Majelis', 'Wakil Ketua Majelis Gereja', 'Lokal', 'Aktif'),
('Sekretaris Majelis', 'Sekretaris Majelis Gereja', 'Lokal', 'Aktif'),
('Bendahara Majelis', 'Bendahara Majelis Gereja', 'Lokal', 'Aktif'),
('Anggota Majelis', 'Anggota Majelis Gereja', 'Lokal', 'Aktif'),
('Pendeta', 'Pendeta Jemaat', 'Lokal', 'Aktif'),
('Pendeta Pembantu', 'Pendeta Pembantu', 'Lokal', 'Aktif'),
('Diakon', 'Diakon Gereja', 'Lokal', 'Aktif'),
('Pelayan Firman', 'Pelayan Firman', 'Lokal', 'Aktif'),
('Pemusik', 'Pemusik Gereja', 'Lokal', 'Aktif'),
('Pelayan Multimedia', 'Pelayan Multimedia', 'Lokal', 'Aktif');
```

#### Komisi Default:
```sql
INSERT INTO custome__komisi_majelis (nama_komisi, deskripsi, status) VALUES
('Komisi Pembangunan', 'Komisi Pembangunan Gereja', 'Aktif'),
('Komisi Diakonia', 'Komisi Diakonia dan Pelayanan', 'Aktif'),
('Komisi Musik', 'Komisi Musik dan Pujian', 'Aktif'),
('Komisi Pendidikan', 'Komisi Pendidikan Kristen', 'Aktif'),
('Komisi Pemuda', 'Komisi Pemuda dan Remaja', 'Aktif'),
('Komisi Wanita', 'Komisi Wanita Gereja', 'Aktif');
```

---

## 🎯 Cara Menggunakan

### Akses Modul
1. Login ke backend CMS
2. Buka menu **Majelis Gereja**
3. Anda akan melihat halaman list dengan statistik

### Tambah Majelis Baru
1. Klik tombol **"Tambah Majelis"**
2. Isi form:
   - Data Pribadi (nama, tempat/tanggal lahir, kontak)
   - Jabatan & Pelayanan (jenis jabatan, status, tanggal penahbisan)
   - Upload file (foto, SK, sertifikat)
3. Klik **"Simpan"**

### Edit Data Majelis
1. Klik tombol **Edit** (icon pensil) pada data yang ingin diubah
2. Update data yang diperlukan
3. Upload file baru jika diperlukan (file lama akan diganti)
4. Klik **"Update"**

### Lihat Detail
1. Klik tombol **Lihat** (icon mata) untuk melihat detail lengkap
2. Detail mencakup:
   - Foto profil
   - Data pribadi lengkap
   - Informasi jabatan
   - Pendidikan & sertifikasi
   - File dokumen (SK, sertifikat)

### Ubah Status Jabatan
1. Klik tombol **Toggle** (icon toggle)
2. Pilih status baru:
   - Aktif
   - Non-Aktif
   - Masa Percobaan
   - Habis Masa Jabatan
3. Status akan langsung diupdate

### Hapus Data
**Single Delete:**
1. Klik tombol **Hapus** (icon trash)
2. Konfirmasi penghapusan
3. Data dan file akan terhapus permanen

**Bulk Delete:**
1. Centang checkbox pada data yang ingin dihapus
2. Klik tombol **"Hapus Terpilih"**
3. Konfirmasi penghapusan
4. Semua data terpilih akan terhapus

---

## 📊 Fitur Utama

### 1. Dashboard Statistik
- Total Majelis
- Total Pendeta
- Total Diakon
- Total Anggota Majelis
- Breakdown per jenis jabatan

### 2. DataTables
- Sorting otomatis
- Pencarian real-time
- Pagination
- Export data (optional)

### 3. File Management
- Upload foto profil (max 2MB)
- Upload SK Pengangkatan
- Upload Sertifikat Penahbisan
- Preview file sebelum download
- Auto-delete file saat hapus data

### 4. Validasi
- Client-side validation (JavaScript)
- Server-side validation (PHP)
- File type validation
- File size validation
- Required field validation

### 5. Security
- CSRF protection
- XSS prevention
- SQL injection prevention
- Access control per grup user
- Session management

---

## 🔐 Permission & Access Control

### Level Akses:
- **Admin (Level 1)**: Full CRUD + Delete
- **Editor (Level 2)**: Create, Read, Update
- **Viewer (Level 3+)**: Read Only

### Konfigurasi:
1. Buka **Pengaturan > Grup User**
2. Pilih grup yang ingin dikonfigurasi
3. Set permission untuk modul "Majelis Gereja"
4. Simpan perubahan

---

## 🧪 Testing Checklist

Setelah instalasi, test fitur-fitur berikut:

- [ ] Akses halaman list berhasil
- [ ] Statistik tampil dengan benar
- [ ] Form tambah dapat dibuka
- [ ] Simpan data baru berhasil
- [ ] Upload foto berhasil
- [ ] Upload SK berhasil
- [ ] Upload sertifikat berhasil
- [ ] Edit data berhasil
- [ ] Lihat detail berhasil
- [ ] Toggle status berhasil
- [ ] Hapus single data berhasil
- [ ] Hapus multiple data berhasil
- [ ] DataTables berfungsi (sort, search, pagination)
- [ ] Validasi form berfungsi
- [ ] Access control berfungsi per grup

---

## 🐛 Troubleshooting

### Error: "Modul belum terdaftar di Grup akses"
**Solusi**: Daftarkan modul di menu Grup Akses dengan URL `majelis-gereja/list`

### Error: "Failed to upload file"
**Solusi**: 
1. Cek folder `public/img/informasi/pegawai/` ada dan writable
2. Cek permission folder: `chmod 755 public/img/informasi/pegawai`
3. Cek php.ini: `upload_max_filesize` dan `post_max_size`

### Error: "Class 'M_MajelisGereja' not found"
**Solusi**: 
1. Cek file model ada di `app/Models/M_MajelisGereja.php`
2. Cek namespace: `namespace App\Models;`
3. Clear cache: `php spark cache:clear`

### DataTables tidak muncul
**Solusi**:
1. Cek koneksi internet (DataTables CDN)
2. Cek console browser untuk error JavaScript
3. Cek jQuery sudah diload

### Foto tidak tampil
**Solusi**:
1. Cek path foto: `public/img/informasi/pegawai/`
2. Cek permission file: `chmod 644 namafile.jpg`
3. Cek base_url() di config

---

## 📞 Support

Jika menemui masalah:
1. Cek dokumentasi lengkap: `DOKUMENTASI_MAJELIS_GEREJA.md`
2. Cek log error: `writable/logs/`
3. Hubungi tim development

---

## 🎉 Selamat!

Modul Majelis Gereja siap digunakan. Selamat mengelola data majelis gereja Anda!

**Version**: 1.0.0  
**Date**: 2025-10-08  
**Status**: ✅ Production Ready
