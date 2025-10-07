# Dokumentasi Modul Pendaftaran Gereja

## Daftar Isi
1. [Pengenalan](#pengenalan)
2. [Instalasi](#instalasi)
3. [Struktur Modul](#struktur-modul)
4. [Fitur & Fungsi](#fitur--fungsi)
5. [Cara Penggunaan](#cara-penggunaan)
6. [API Endpoints](#api-endpoints)
7. [Database Schema](#database-schema)
8. [Upload Dokumen](#upload-dokumen)

---

## Pengenalan

Modul Pendaftaran Gereja terdiri dari 3 sistem pendaftaran online:

### 1. **Pendaftaran Sidi**
Sistem pendaftaran untuk jemaat yang akan mengikuti Sidi (Pengakuan Iman).

**Dokumen yang diperlukan:**
- KTP
- Kartu Keluarga (KK)
- Sertifikat Baptis
- Foto 3x4

### 2. **Pendaftaran Baptis**
Sistem pendaftaran untuk Baptis Anak dan Baptis Dewasa.

**Dokumen yang diperlukan:**
- KTP (untuk baptis dewasa)
- Kartu Keluarga (KK)
- Akta Kelahiran
- Foto 3x4
- Surat Nikah Orang Tua (untuk baptis anak)

### 3. **Pendaftaran Pernikahan**
Sistem pendaftaran untuk calon pengantin yang akan menikah di gereja.

**Dokumen yang diperlukan:**
- **Calon Suami:**
  - KTP
  - Kartu Keluarga
  - Sertifikat Baptis
  - Sertifikat Sidi
  - Foto 4x6
  
- **Calon Istri:**
  - KTP
  - Kartu Keluarga
  - Sertifikat Baptis
  - Sertifikat Sidi
  - Foto 4x6

- **Dokumen Tambahan:**
  - Surat Izin Orang Tua (jika diperlukan)
  - Surat Keterangan dari Gereja

---

## Instalasi

### Langkah 1: Import Database
```bash
# Import file SQL ke database MySQL
mysql -u username -p database_name < db/pendaftaran_gereja_tables.sql
```

Atau melalui phpMyAdmin:
1. Buka phpMyAdmin
2. Pilih database Anda
3. Klik tab "Import"
4. Pilih file `db/pendaftaran_gereja_tables.sql`
5. Klik "Go"

### Langkah 2: Buat Folder untuk Upload Dokumen
```bash
# Buat folder untuk menyimpan dokumen
mkdir -p public/file/dokumen/sidi
mkdir -p public/file/dokumen/baptis
mkdir -p public/file/dokumen/nikah

# Set permission (Linux/Mac)
chmod 755 public/file/dokumen/sidi
chmod 755 public/file/dokumen/baptis
chmod 755 public/file/dokumen/nikah
```

### Langkah 3: Verifikasi File
Pastikan semua file berikut sudah ada:

**Models:**
- `app/Models/M_PendaftaranSidi.php`
- `app/Models/M_PendaftaranBaptis.php`
- `app/Models/M_PendaftaranNikah.php`

**Controllers:**
- `app/Controllers/PendaftaranSidi.php`
- `app/Controllers/PendaftaranBaptis.php`
- `app/Controllers/PendaftaranNikah.php`

**Routes:** Sudah ditambahkan di `app/Config/Routes.php`

**BaseController:** Sudah diupdate dengan model baru

---

## Struktur Modul

### Arsitektur MVC

```
app/
├── Models/
│   ├── M_PendaftaranSidi.php      # Model untuk Sidi
│   ├── M_PendaftaranBaptis.php    # Model untuk Baptis
│   └── M_PendaftaranNikah.php     # Model untuk Nikah
│
├── Controllers/
│   ├── PendaftaranSidi.php        # Controller Sidi (Frontend + Backend)
│   ├── PendaftaranBaptis.php      # Controller Baptis (Frontend + Backend)
│   └── PendaftaranNikah.php       # Controller Nikah (Frontend + Backend)
│
└── Views/
    ├── frontend/
    │   └── [template]/content/
    │       ├── pendaftaran_sidi.php
    │       ├── pendaftaran_baptis.php
    │       └── pendaftaran_nikah.php
    │
    └── backend/morvin/cmscust/
        ├── pendaftaran_sidi/
        │   ├── index.php
        │   ├── list.php
        │   ├── tambah.php
        │   ├── edit.php
        │   ├── lihat.php
        │   └── upload.php
        │
        ├── pendaftaran_baptis/
        │   └── (sama seperti sidi)
        │
        └── pendaftaran_nikah/
            └── (sama seperti sidi)
```

---

## Fitur & Fungsi

### Frontend (Publik)

#### 1. Form Pendaftaran Online
- Form validasi lengkap
- Google reCAPTCHA (opsional)
- Upload dokumen persyaratan
- Notifikasi sukses/error

#### 2. Akses URL
- **Sidi:** `http://domain.com/pendaftaran-sidi`
- **Baptis:** `http://domain.com/pendaftaran-baptis`
- **Nikah:** `http://domain.com/pendaftaran-nikah`

### Backend (Admin)

#### 1. Manajemen Data
- ✅ Lihat semua pendaftaran
- ✅ Tambah data manual
- ✅ Edit data pendaftaran
- ✅ Hapus data (single/multiple)
- ✅ Lihat detail lengkap

#### 2. Manajemen Status
- **Status 0 (Pending):** Pendaftaran baru masuk
- **Status 1 (Disetujui):** Pendaftaran disetujui
- **Status 2 (Ditolak):** Pendaftaran ditolak

#### 3. Manajemen Dokumen
- Upload dokumen per jenis
- Hapus dokumen
- Download dokumen
- Preview dokumen (PDF/Image)

#### 4. Akses URL Admin
- **Sidi:** `http://domain.com/pendaftaran-sidi/list`
- **Baptis:** `http://domain.com/pendaftaran-baptis/list`
- **Nikah:** `http://domain.com/pendaftaran-nikah/list`

---

## Cara Penggunaan

### Untuk Jemaat (Frontend)

#### Pendaftaran Sidi
1. Buka `http://domain.com/pendaftaran-sidi`
2. Isi form dengan lengkap:
   - Data Pribadi
   - Data Orang Tua
   - Informasi Baptis
3. Lengkapi reCAPTCHA (jika aktif)
4. Klik "Daftar"
5. Tunggu konfirmasi dari admin

#### Pendaftaran Baptis
1. Buka `http://domain.com/pendaftaran-baptis`
2. Pilih jenis baptis (Anak/Dewasa)
3. Isi data lengkap
4. Isi data pendamping (untuk baptis anak)
5. Submit form

#### Pendaftaran Nikah
1. Buka `http://domain.com/pendaftaran-nikah`
2. Isi data calon suami lengkap
3. Isi data calon istri lengkap
4. Tentukan tanggal pernikahan yang diinginkan
5. Submit form

### Untuk Admin (Backend)

#### Login Admin
```
URL: http://domain.com/cms-login
Username: admin
Password: CMS@d4tagoeGen5
```

#### Mengelola Pendaftaran

**1. Melihat Data Baru**
- Masuk ke menu pendaftaran
- Data dengan status "Pending" adalah data baru
- Badge kuning menandakan pending

**2. Menyetujui Pendaftaran**
- Klik tombol "Lihat Detail"
- Periksa data dan dokumen
- Klik tombol "Setujui"
- Status berubah menjadi "Disetujui"

**3. Menolak Pendaftaran**
- Klik tombol "Edit"
- Ubah status menjadi "Ditolak"
- Isi keterangan alasan penolakan
- Simpan perubahan

**4. Upload Dokumen**
- Klik tombol "Upload Dokumen"
- Pilih jenis dokumen
- Pilih file (max 3MB)
- Format: PNG, JPG, JPEG, PDF
- Klik "Upload"

**5. Menghapus Data**
- Centang data yang akan dihapus
- Klik tombol "Hapus Terpilih"
- Konfirmasi penghapusan
- Dokumen terkait akan otomatis terhapus

---

## API Endpoints

### Pendaftaran Sidi

| Method | Endpoint | Fungsi | Akses |
|--------|----------|--------|-------|
| GET | `/pendaftaran-sidi` | Halaman form pendaftaran | Publik |
| POST | `/pendaftaran-sidi/simpanpendaftaran` | Simpan pendaftaran baru | Publik |
| GET | `/pendaftaran-sidi/list` | Halaman admin list | Admin |
| GET | `/pendaftaran-sidi/getdata` | Get data AJAX | Admin |
| POST | `/pendaftaran-sidi/formlihat` | Form lihat detail | Admin |
| POST | `/pendaftaran-sidi/formedit` | Form edit data | Admin |
| POST | `/pendaftaran-sidi/update` | Update data | Admin |
| GET | `/pendaftaran-sidi/formtambah` | Form tambah manual | Admin |
| POST | `/pendaftaran-sidi/simpan` | Simpan data manual | Admin |
| POST | `/pendaftaran-sidi/hapus` | Hapus single data | Admin |
| POST | `/pendaftaran-sidi/hapusall` | Hapus multiple data | Admin |
| POST | `/pendaftaran-sidi/toggle` | Toggle status | Admin |
| POST | `/pendaftaran-sidi/formupload` | Form upload dokumen | Admin |
| POST | `/pendaftaran-sidi/simpanupload` | Simpan upload | Admin |
| POST | `/pendaftaran-sidi/hapusfile` | Hapus file dokumen | Admin |

### Pendaftaran Baptis
*(Sama seperti Sidi, ganti prefix menjadi `/pendaftaran-baptis`)*

### Pendaftaran Nikah
*(Sama seperti Sidi, ganti prefix menjadi `/pendaftaran-nikah`)*

---

## Database Schema

### Tabel: custome__pendaftaran_sidi

| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| id_sidi | int(11) | NO | PRI | NULL | auto_increment |
| nama_lengkap | varchar(255) | NO | | NULL | |
| tempat_lahir | varchar(100) | YES | | NULL | |
| tgl_lahir | date | NO | | NULL | |
| jenis_kelamin | enum | NO | | NULL | |
| alamat | text | NO | | NULL | |
| no_hp | varchar(20) | NO | | NULL | |
| email | varchar(100) | NO | | NULL | |
| nama_ayah | varchar(255) | YES | | NULL | |
| nama_ibu | varchar(255) | YES | | NULL | |
| tgl_baptis | date | NO | | NULL | |
| gereja_baptis | varchar(255) | YES | | NULL | |
| tgl_daftar | date | NO | | NULL | |
| tgl_sidi | date | YES | | NULL | |
| status | enum('0','1','2') | NO | MUL | 0 | |
| keterangan | text | YES | | NULL | |
| dok_ktp | varchar(255) | YES | | NULL | |
| dok_kk | varchar(255) | YES | | NULL | |
| dok_baptis | varchar(255) | YES | | NULL | |
| dok_foto | varchar(255) | YES | | NULL | |

### Tabel: custome__pendaftaran_baptis

| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| id_baptis | int(11) | NO | PRI | NULL | auto_increment |
| nama_lengkap | varchar(255) | NO | | NULL | |
| tempat_lahir | varchar(100) | YES | | NULL | |
| tgl_lahir | date | NO | | NULL | |
| jenis_kelamin | enum | NO | | NULL | |
| alamat | text | NO | | NULL | |
| no_hp | varchar(20) | NO | | NULL | |
| email | varchar(100) | NO | | NULL | |
| nama_ayah | varchar(255) | YES | | NULL | |
| nama_ibu | varchar(255) | YES | | NULL | |
| jenis_baptis | enum | NO | | NULL | |
| nama_pendamping | varchar(255) | YES | | NULL | |
| hubungan_pendamping | varchar(100) | YES | | NULL | |
| tgl_daftar | date | NO | | NULL | |
| tgl_baptis | date | YES | | NULL | |
| status | enum('0','1','2') | NO | MUL | 0 | |
| keterangan | text | YES | | NULL | |
| dok_ktp | varchar(255) | YES | | NULL | |
| dok_kk | varchar(255) | YES | | NULL | |
| dok_akta_lahir | varchar(255) | YES | | NULL | |
| dok_foto | varchar(255) | YES | | NULL | |
| dok_surat_nikah_ortu | varchar(255) | YES | | NULL | |

### Tabel: custome__pendaftaran_nikah

| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| id_nikah | int(11) | NO | PRI | NULL | auto_increment |
| **Data Calon Suami** | | | | | |
| nama_pria | varchar(255) | NO | | NULL | |
| tempat_lahir_pria | varchar(100) | YES | | NULL | |
| tgl_lahir_pria | date | NO | | NULL | |
| alamat_pria | text | YES | | NULL | |
| no_hp_pria | varchar(20) | NO | | NULL | |
| email_pria | varchar(100) | NO | | NULL | |
| pekerjaan_pria | varchar(100) | YES | | NULL | |
| status_baptis_pria | enum | YES | | Sudah | |
| gereja_baptis_pria | varchar(255) | YES | | NULL | |
| nama_ayah_pria | varchar(255) | YES | | NULL | |
| nama_ibu_pria | varchar(255) | YES | | NULL | |
| **Data Calon Istri** | | | | | |
| nama_wanita | varchar(255) | NO | | NULL | |
| tempat_lahir_wanita | varchar(100) | YES | | NULL | |
| tgl_lahir_wanita | date | NO | | NULL | |
| alamat_wanita | text | YES | | NULL | |
| no_hp_wanita | varchar(20) | NO | | NULL | |
| email_wanita | varchar(100) | NO | | NULL | |
| pekerjaan_wanita | varchar(100) | YES | | NULL | |
| status_baptis_wanita | enum | YES | | Sudah | |
| gereja_baptis_wanita | varchar(255) | YES | | NULL | |
| nama_ayah_wanita | varchar(255) | YES | | NULL | |
| nama_ibu_wanita | varchar(255) | YES | | NULL | |
| **Data Pernikahan** | | | | | |
| tgl_daftar | date | NO | | NULL | |
| tgl_nikah_diinginkan | date | NO | | NULL | |
| tempat_nikah | varchar(255) | YES | | NULL | |
| status | enum('0','1','2') | NO | MUL | 0 | |
| keterangan | text | YES | | NULL | |
| **Dokumen** | | | | | |
| dok_ktp_pria | varchar(255) | YES | | NULL | |
| dok_kk_pria | varchar(255) | YES | | NULL | |
| dok_baptis_pria | varchar(255) | YES | | NULL | |
| dok_sidi_pria | varchar(255) | YES | | NULL | |
| dok_foto_pria | varchar(255) | YES | | NULL | |
| dok_ktp_wanita | varchar(255) | YES | | NULL | |
| dok_kk_wanita | varchar(255) | YES | | NULL | |
| dok_baptis_wanita | varchar(255) | YES | | NULL | |
| dok_sidi_wanita | varchar(255) | YES | | NULL | |
| dok_foto_wanita | varchar(255) | YES | | NULL | |
| dok_surat_izin_ortu | varchar(255) | YES | | NULL | |
| dok_surat_keterangan_gereja | varchar(255) | YES | | NULL | |

---

## Upload Dokumen

### Spesifikasi Upload

**Format File yang Diterima:**
- Gambar: PNG, JPG, JPEG
- Dokumen: PDF

**Ukuran Maksimal:**
- 3 MB (3024 KB) per file

**Lokasi Penyimpanan:**
- Sidi: `public/file/dokumen/sidi/`
- Baptis: `public/file/dokumen/baptis/`
- Nikah: `public/file/dokumen/nikah/`

### Contoh Kode Upload (AJAX)

```javascript
// Form upload dokumen
$('#formUpload').submit(function(e) {
    e.preventDefault();
    
    let formData = new FormData(this);
    
    $.ajax({
        url: '<?= site_url('pendaftaran-sidi/simpanupload') ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            let res = JSON.parse(response);
            if (res.sukses) {
                Swal.fire('Berhasil!', res.sukses, 'success');
            }
        }
    });
});
```

### Validasi Upload di Controller

```php
$valid = $this->validate([
    'file_dokumen' => [
        'label' => 'File Dokumen',
        'rules' => 'uploaded[file_dokumen]|max_size[file_dokumen,3024]|mime_in[file_dokumen,image/png,image/jpg,image/jpeg,application/pdf]',
        'errors' => [
            'uploaded' => 'Silahkan pilih file',
            'max_size' => 'Ukuran file maksimal 3 MB',
            'mime_in' => 'Format file harus PNG, JPG, JPEG, atau PDF'
        ]
    ]
]);
```

---

## Keamanan

### 1. Validasi Input
- Semua input divalidasi di server-side
- XSS protection dengan `esc()` function
- CSRF protection aktif

### 2. Upload File
- Validasi tipe file (whitelist)
- Validasi ukuran file
- Random filename untuk keamanan
- File disimpan di folder terpisah

### 3. Akses Control
- Frontend: Publik (dengan reCAPTCHA)
- Backend: Hanya admin yang login
- Hak akses berdasarkan grup user

### 4. Google reCAPTCHA
Untuk mengaktifkan reCAPTCHA:
1. Dapatkan Site Key dan Secret Key dari Google
2. Masuk ke menu Konfigurasi
3. Isi Google Site Key dan Secret Key
4. reCAPTCHA akan otomatis aktif

---

## Troubleshooting

### Error: "Table doesn't exist"
**Solusi:** Import file SQL `db/pendaftaran_gereja_tables.sql`

### Error: "Failed to upload file"
**Solusi:** 
1. Pastikan folder `public/file/dokumen/` ada
2. Set permission 755 untuk folder tersebut
3. Cek ukuran file tidak melebihi 3MB

### Error: "Class not found"
**Solusi:**
1. Pastikan model sudah ditambahkan di `BaseController.php`
2. Clear cache: `php spark cache:clear`

### Data tidak muncul di admin
**Solusi:**
1. Cek hak akses user di menu Modul
2. Pastikan URL modul sudah terdaftar di grup akses

---

## Pengembangan Lebih Lanjut

### Menambah Field Baru

**1. Update Database:**
```sql
ALTER TABLE custome__pendaftaran_sidi 
ADD COLUMN field_baru VARCHAR(255) NULL AFTER keterangan;
```

**2. Update Model:**
```php
protected $allowedFields = [
    'nama_lengkap', ..., 'field_baru'
];
```

**3. Update Controller:**
Tambahkan field di method `simpan()` dan `update()`

**4. Update View:**
Tambahkan input field di form

### Menambah Jenis Dokumen

**1. Update Database:**
```sql
ALTER TABLE custome__pendaftaran_sidi 
ADD COLUMN dok_baru VARCHAR(255) NULL;
```

**2. Update Model:**
Tambahkan ke `$allowedFields`

**3. Update Controller:**
Tambahkan ke array `$dokumen` di method `hapus()`

---

## Support & Kontak

Untuk pertanyaan atau bantuan lebih lanjut:
- Website: https://ikasmedia.net
- WhatsApp: 081 353 967 028

---

## Lisensi

Modul ini adalah bagian dari CMS ikasmedia.
Silakan modifikasi sesuai kebutuhan Anda.

**Catatan:** Jangan lupa untuk menghapus file dokumentasi ini jika website sudah online untuk keamanan.

---

**Dibuat pada:** 7 Oktober 2025
**Versi:** 1.0.0
**Framework:** CodeIgniter 4
