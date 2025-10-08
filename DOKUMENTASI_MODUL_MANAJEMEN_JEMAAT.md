# 📋 Dokumentasi Modul Manajemen Jemaat

## 🎯 **Deskripsi Modul**
Modul Manajemen Jemaat adalah sistem informasi lengkap untuk mengelola data anggota jemaat gereja. Modul ini menyediakan fitur CRUD (Create, Read, Update, Delete) yang komprehensif dengan berbagai fitur tambahan.

---

## 📊 **Fitur Utama**

### ✅ **CRUD Operations**
- **Create**: Tambah data jemaat baru dengan form lengkap
- **Read**: Lihat daftar jemaat dengan statistik dan detail lengkap
- **Update**: Edit data jemaat dengan validasi
- **Delete**: Hapus data tunggal atau multiple (bulk delete)

### ✅ **Manajemen Data**
- **Data Pribadi**: Nama, tempat/tanggal lahir, jenis kelamin, alamat lengkap
- **Data Kontak**: No HP, email, pekerjaan, pendidikan
- **Data Keluarga**: Nama ayah, ibu, pasangan
- **Data Rohani**: Riwayat baptis, sidi, pernikahan
- **Data Keanggotaan**: Status, tanggal bergabung, gereja asal/tujuan

### ✅ **Fitur Khusus**
- **Upload Foto**: Upload dan manajemen foto jemaat
- **Status Management**: Aktif, Pindah, Meninggal, Non-Aktif
- **Search & Filter**: Pencarian berdasarkan nama atau nomor anggota
- **Statistik Dashboard**: Grafik dan data statistik jemaat
- **Auto Generate**: Nomor anggota otomatis (JMT001, JMT002, dst)

---

## 🗂️ **Struktur File**

### **Database**
```
db/custome__jemaat.sql - Schema database dan data sample
```

### **Model**
```
app/Models/M_Jemaat.php - Model untuk operasi database
```

### **Controller**
```
app/Controllers/ManajemenJemaat.php - Controller utama
```

### **Views**
```
app/Views/backend/morvin/cmscust/manajemen_jemaat/
├── index.php    - Halaman utama
├── list.php     - Tampilan daftar jemaat
├── tambah.php   - Form tambah jemaat
├── edit.php     - Form edit jemaat
├── lihat.php    - Detail jemaat
└── upload.php   - Form upload foto
```

---

## 🗄️ **Database Schema**

### **Tabel Utama: `custome__jemaat`**

| Field | Type | Description |
|-------|------|-------------|
| `id_jemaat` | INT(11) PK | ID unik jemaat |
| `no_anggota` | VARCHAR(20) UNIQUE | Nomor anggota (JMT001) |
| `nama_lengkap` | VARCHAR(255) | Nama lengkap jemaat |
| `nama_panggilan` | VARCHAR(100) | Nama panggilan |
| `tempat_lahir` | VARCHAR(100) | Tempat lahir |
| `tgl_lahir` | DATE | Tanggal lahir |
| `jenis_kelamin` | ENUM('L','P') | Jenis kelamin |
| `alamat_lengkap` | TEXT | Alamat lengkap |
| `rt_rw` | VARCHAR(20) | RT/RW |
| `kelurahan` | VARCHAR(100) | Kelurahan |
| `kecamatan` | VARCHAR(100) | Kecamatan |
| `kota` | VARCHAR(100) | Kota |
| `kode_pos` | VARCHAR(10) | Kode pos |
| `no_hp` | VARCHAR(20) | Nomor HP |
| `email` | VARCHAR(100) | Email |
| `pekerjaan` | VARCHAR(100) | Pekerjaan |
| `pendidikan` | ENUM | Tingkat pendidikan |
| `status_pernikahan` | ENUM | Status pernikahan |
| `nama_ayah` | VARCHAR(255) | Nama ayah |
| `nama_ibu` | VARCHAR(255) | Nama ibu |
| `nama_pasangan` | VARCHAR(255) | Nama pasangan |
| `tgl_baptis` | DATE | Tanggal baptis |
| `tempat_baptis` | VARCHAR(255) | Tempat baptis |
| `pendeta_baptis` | VARCHAR(255) | Pendeta baptis |
| `tgl_sidi` | DATE | Tanggal sidi |
| `tempat_sidi` | VARCHAR(255) | Tempat sidi |
| `pendeta_sidi` | VARCHAR(255) | Pendeta sidi |
| `tgl_nikah` | DATE | Tanggal nikah |
| `tempat_nikah` | VARCHAR(255) | Tempat nikah |
| `pendeta_nikah` | VARCHAR(255) | Pendeta nikah |
| `status_keanggotaan` | ENUM | Status keanggotaan |
| `tgl_bergabung` | DATE | Tanggal bergabung |
| `tgl_pindah` | DATE | Tanggal pindah |
| `tgl_meninggal` | DATE | Tanggal meninggal |
| `gereja_asal` | VARCHAR(255) | Gereja asal |
| `gereja_tujuan` | VARCHAR(255) | Gereja tujuan |
| `keterangan` | TEXT | Keterangan |
| `foto` | VARCHAR(255) | Nama file foto |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diupdate |

### **Tabel Pendukung**
- `custome__keluarga_jemaat` - Data keluarga
- `custome__anggota_keluarga` - Relasi anggota keluarga
- `custome__riwayat_pelayanan` - Riwayat pelayanan jemaat

---

## 🔧 **Instalasi**

### **1. Import Database**
```sql
-- Import file SQL
mysql -u username -p database_name < db/custome__jemaat.sql
```

### **2. Buat Folder Upload**
```bash
# Buat folder untuk foto jemaat
mkdir -p public/file/foto/jemaat

# Set permission (Linux/Mac)
chmod 755 public/file/foto/jemaat
```

### **3. Update BaseController**
Model `M_Jemaat` sudah ditambahkan ke `BaseController.php`

### **4. Tambah Route**
```php
// Tambahkan ke app/Config/Routes.php
$routes->group('manajemen-jemaat', function($routes) {
    $routes->get('list', 'ManajemenJemaat::list');
    $routes->post('getdata', 'ManajemenJemaat::getdata');
    $routes->post('formlihat', 'ManajemenJemaat::formlihat');
    $routes->post('formedit', 'ManajemenJemaat::formedit');
    $routes->post('update', 'ManajemenJemaat::update');
    $routes->get('formtambah', 'ManajemenJemaat::formtambah');
    $routes->post('simpan', 'ManajemenJemaat::simpan');
    $routes->post('hapus', 'ManajemenJemaat::hapus');
    $routes->post('hapusall', 'ManajemenJemaat::hapusall');
    $routes->post('toggle', 'ManajemenJemaat::toggle');
    $routes->post('formupload', 'ManajemenJemaat::formupload');
    $routes->post('simpanupload', 'ManajemenJemaat::simpanupload');
    $routes->post('hapusfoto', 'ManajemenJemaat::hapusfoto');
    $routes->post('cari', 'ManajemenJemaat::cari');
    $routes->get('dashboard', 'ManajemenJemaat::dashboard');
});
```

---

## 🎮 **Cara Penggunaan**

### **Akses Modul**
```
URL: http://domain.com/manajemen-jemaat/list
```

### **Tambah Jemaat Baru**
1. Klik tombol "Tambah Jemaat"
2. Isi form data pribadi (wajib: nama, tanggal lahir, jenis kelamin, alamat)
3. Isi data kontak dan keluarga (opsional)
4. Isi data rohani (opsional)
5. Set status keanggotaan dan tanggal bergabung
6. Klik "Simpan"

### **Edit Data Jemaat**
1. Klik tombol "Edit" pada data jemaat
2. Ubah data yang diperlukan
3. Klik "Update"

### **Upload Foto**
1. Klik tombol "Upload Foto" pada data jemaat
2. Pilih file foto (PNG, JPG, JPEG, max 2MB)
3. Preview foto akan muncul
4. Klik "Upload Foto"

### **Ubah Status Keanggotaan**
1. Klik tombol "Ubah Status" pada data jemaat
2. Pilih status baru (Aktif, Pindah, Meninggal, Non-Aktif)
3. Jika status Pindah/Meninggal, masukkan tanggal
4. Konfirmasi perubahan

### **Pencarian Jemaat**
1. Masukkan nama atau nomor anggota di kotak pencarian
2. Klik "Cari" atau tekan Enter
3. Hasil pencarian akan ditampilkan
4. Klik "Reset" untuk kembali ke daftar lengkap

---

## 📊 **Fitur Statistik**

### **Dashboard Cards**
- **Total Jemaat**: Jumlah seluruh jemaat
- **Jemaat Aktif**: Jemaat dengan status aktif
- **Pindah**: Jemaat yang pindah gereja
- **Meninggal**: Jemaat yang sudah meninggal

### **Analisis Data**
- Statistik berdasarkan jenis kelamin
- Kelompok umur (Anak, Remaja, Pemuda, Dewasa, Lansia)
- Jemaat yang berulang tahun bulan ini
- Jemaat baru (bergabung dalam 30 hari terakhir)

---

## 🔐 **Keamanan & Validasi**

### **Validasi Input**
- Server-side validation untuk semua field wajib
- Validasi format email dan tanggal
- Validasi nomor anggota unik
- XSS protection dengan `esc()` function

### **Upload File**
- Validasi tipe file (PNG, JPG, JPEG)
- Validasi ukuran file (maksimal 2MB)
- Random filename untuk keamanan
- Preview sebelum upload

### **Access Control**
- Hanya admin yang login dapat mengakses
- Kontrol hak akses berdasarkan grup user
- CSRF protection aktif

---

## 🚀 **Fitur Lanjutan**

### **Auto Generate Nomor Anggota**
```php
// Format: JMT001, JMT002, JMT003, dst
$no_anggota = $this->jemaat->generateNoAnggota();
```

### **Bulk Operations**
- Hapus multiple data sekaligus
- Checkbox untuk select all
- Konfirmasi sebelum menghapus

### **DataTables Integration**
- Sorting dan pagination otomatis
- Search dalam tabel
- Responsive design
- Export data (bisa dikembangkan)

---

## 🔧 **Pengembangan Lebih Lanjut**

### **Fitur yang Bisa Ditambahkan**
1. **Export Data**: Excel, PDF, CSV
2. **Import Data**: Upload file Excel
3. **Kartu Anggota**: Generate kartu anggota digital
4. **Laporan**: Laporan statistik lengkap
5. **Notifikasi**: Reminder ulang tahun, dll
6. **Barcode/QR Code**: Untuk kartu anggota
7. **Integration**: Dengan modul lain (jadwal, keuangan)

### **Optimisasi**
1. **Caching**: Cache data statistik
2. **Indexing**: Optimasi database index
3. **Pagination**: Server-side pagination untuk data besar
4. **Image Optimization**: Compress foto otomatis

---

## 🐛 **Troubleshooting**

### **Error: Table doesn't exist**
```bash
# Import database schema
mysql -u username -p database_name < db/custome__jemaat.sql
```

### **Error: Upload folder not found**
```bash
# Buat folder upload
mkdir -p public/file/foto/jemaat
chmod 755 public/file/foto/jemaat
```

### **Error: Class M_Jemaat not found**
```php
// Pastikan model sudah ditambahkan di BaseController.php
$this->jemaat = new M_Jemaat();
```

### **Data tidak muncul**
1. Cek hak akses user di menu Modul
2. Pastikan URL sudah terdaftar di grup akses
3. Clear cache: `php spark cache:clear`

---

## 📝 **Changelog**

### **Version 1.0.0** - 8 Oktober 2025
- ✅ Implementasi CRUD lengkap
- ✅ Upload dan manajemen foto
- ✅ Statistik dashboard
- ✅ Search dan filter
- ✅ Status management
- ✅ Bulk operations
- ✅ Responsive design
- ✅ Validasi lengkap

---

## 👨‍💻 **Developer Notes**

### **Pola Kode**
Modul ini mengikuti pola yang sama dengan modul pendaftaran yang sudah ada:
- Controller menggunakan AJAX untuk semua operasi
- View terpisah untuk setiap fungsi
- Model dengan method yang spesifik
- Validasi server-side yang ketat

### **Konsistensi**
- Naming convention sesuai CodeIgniter 4
- Database prefix `custome__`
- Template Morvin untuk UI
- Bootstrap 5 untuk styling

---

**Dibuat:** 8 Oktober 2025  
**Framework:** CodeIgniter 4  
**Template:** Morvin  
**Status:** ✅ READY TO USE
