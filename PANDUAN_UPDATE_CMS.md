# 🔄 Panduan Update CMS Datagoe/Ikasmedia

## 📋 Daftar Isi
1. [Pengenalan Sistem Update](#pengenalan-sistem-update)
2. [Cara Kerja Update](#cara-kerja-update)
3. [Jenis-Jenis Update](#jenis-jenis-update)
4. [Cara Update CMS](#cara-update-cms)
5. [Troubleshooting](#troubleshooting)
6. [Best Practices](#best-practices)

---

## 🎯 Pengenalan Sistem Update

CMS ini memiliki **sistem update otomatis** yang terintegrasi dengan server pusat (datagoe.com/ikasmedia.net).

### **Komponen Update:**
- **Controller**: `Updatecms.php` - Menangani proses update
- **API**: `Apiupdate.php` - Endpoint untuk cek versi
- **Server**: `datagoe.com` - Server pusat update
- **Database**: Tabel `tbl_setaplikasi` - Menyimpan versi

### **Versi yang Ditrack:**
1. **vercms** - Versi CMS (file aplikasi)
2. **verdb** - Versi Database (struktur tabel)

---

## ⚙️ Cara Kerja Update

### **Alur Update:**

```
┌─────────────────────────────────────────────────────┐
│ 1. CMS Lokal cek versi ke Server Pusat             │
│    GET: https://datagoe.com/fileakses.txt          │
└─────────────────────────────────────────────────────┘
                        ↓
┌─────────────────────────────────────────────────────┐
│ 2. Server mengirim info versi terbaru:             │
│    - verdb (versi database)                         │
│    - vercms (versi CMS)                             │
│    - URL download database update                   │
│    - URL download CMS update                        │
└─────────────────────────────────────────────────────┘
                        ↓
┌─────────────────────────────────────────────────────┐
│ 3. CMS membandingkan versi:                        │
│    IF versi_server > versi_lokal                    │
│    THEN tampilkan tombol update                     │
└─────────────────────────────────────────────────────┘
                        ↓
┌─────────────────────────────────────────────────────┐
│ 4. User klik tombol update:                        │
│    a. Download file update (ZIP)                    │
│    b. Extract ke folder root                        │
│    c. Jalankan SQL update (jika ada)                │
│    d. Update versi di database                      │
└─────────────────────────────────────────────────────┘
```

---

## 📦 Jenis-Jenis Update

### **1. Update Database Only**
- Hanya update struktur database
- File: `fileupdate.zip` berisi SQL
- Endpoint: `Startupdatedb()`
- Tidak mengubah file aplikasi

**Contoh perubahan:**
- Tambah kolom baru
- Ubah tipe data
- Rename kolom
- Alter table

### **2. Update CMS (Full)**
- Update file aplikasi + database
- File: `fileupdate.zip` berisi semua file
- Endpoint: `startUpdate()`
- Menimpa file lama dengan file baru

**Contoh perubahan:**
- Fitur baru
- Bug fix
- Security patch
- UI/UX improvement

### **3. Update Manual**
- Download file dari website
- Extract manual
- Import SQL manual
- Untuk update besar/custom

---

## 🚀 Cara Update CMS

### **A. Update Otomatis (Recommended)**

#### **Langkah 1: Akses Halaman Update**

1. Login ke **Dashboard Admin**
   ```
   http://domain.com/cms-login
   Username: admin
   Password: CMS@d4tagoeGen5
   ```

2. Buka menu **"Pengaturan"** → **"Upgrade CMS"**
   ```
   URL: http://domain.com/updatecms
   ```

#### **Langkah 2: Cek Versi**

Sistem akan otomatis cek versi ke server:

```
┌─────────────────────────────────────────┐
│ INFORMASI VERSI                         │
├─────────────────────────────────────────┤
│ Versi CMS Lokal:    1.0.0               │
│ Versi DB Lokal:     1.0.0               │
│                                         │
│ Versi CMS Server:   1.1.0  ⬆️ (Baru!)  │
│ Versi DB Server:    1.1.0  ⬆️ (Baru!)  │
│                                         │
│ [Update Database] [Update CMS]          │
└─────────────────────────────────────────┘
```

#### **Langkah 3: Update Database (Jika Ada)**

Jika ada update database:

1. Klik tombol **"Update Database"**
2. Tunggu proses download & extract
3. SQL akan dijalankan otomatis
4. Versi database akan diupdate

**Progress:**
```
Downloading... 25%
Extracting... 50%
Running SQL... 75%
Done! ✅ 100%
```

#### **Langkah 4: Update CMS**

Setelah database diupdate (atau jika tidak ada update DB):

1. Klik tombol **"Update CMS"**
2. Tunggu proses download file ZIP
3. File akan di-extract otomatis
4. Versi CMS akan diupdate

**Progress:**
```
Downloading fileupdate.zip... 30%
Extracting files... 60%
Updating version... 90%
Done! ✅ 100%
```

#### **Langkah 5: Verifikasi**

Setelah update selesai:

1. **Refresh halaman** (Ctrl + F5)
2. **Cek versi** di halaman update
3. **Test fitur** yang diupdate
4. **Logout & login** kembali

---

### **B. Update Manual**

Jika update otomatis gagal, lakukan manual:

#### **Langkah 1: Backup**

**WAJIB backup sebelum update!**

```bash
# Backup database
mysqldump -u username -p database_name > backup_$(date +%Y%m%d).sql

# Backup files
zip -r backup_files_$(date +%Y%m%d).zip app/ public/ writable/
```

#### **Langkah 2: Download File Update**

1. Buka website: `https://ikasmedia.net` atau `https://datagoe.com`
2. Login ke akun Anda
3. Download file update terbaru
4. Extract file ZIP

#### **Langkah 3: Upload File**

Via FTP/cPanel File Manager:

1. Upload file ke folder root
2. **Jangan timpa file:**
   - `.env`
   - `app/Config/Database.php`
   - `public/img/` (folder upload)
   - `writable/` (folder cache/logs)

3. **Timpa file:**
   - `app/Controllers/`
   - `app/Models/`
   - `app/Views/`
   - `public/template/`
   - `system/`

#### **Langkah 4: Import SQL (Jika Ada)**

Jika ada file SQL update:

```bash
# Via command line
mysql -u username -p database_name < update_v1.1.0.sql

# Via phpMyAdmin
1. Buka phpMyAdmin
2. Pilih database
3. Tab "Import"
4. Upload file SQL
5. Klik "Go"
```

#### **Langkah 5: Update Versi Manual**

Jalankan query ini di database:

```sql
UPDATE tbl_setaplikasi 
SET vercms = '1.1.0', verdb = '1.1.0' 
WHERE id_setaplikasi = 1;
```

#### **Langkah 6: Clear Cache**

```bash
# Via command line
php spark cache:clear

# Via browser
http://domain.com/clearcache
```

---

## 🔧 Troubleshooting

### **1. Error: "File tidak dapat diakses"**

**Penyebab:**
- Tidak ada koneksi internet
- Server pusat down
- Firewall memblokir

**Solusi:**
```php
// Cek koneksi
ping datagoe.com

// Cek cURL
php -m | grep curl

// Test manual
curl https://datagoe.com/fileakses.txt
```

### **2. Error: "Gagal mengubah permission folder"**

**Penyebab:**
- Folder tidak writable
- Permission tidak cukup

**Solusi:**
```bash
# Set permission
chmod 755 writable/uploads/
chmod 755 app/

# Atau via cPanel File Manager
# Klik kanan folder → Change Permissions → 755
```

### **3. Error: "Gagal membuka file ZIP"**

**Penyebab:**
- File corrupt
- Extension ZIP tidak aktif
- File tidak lengkap download

**Solusi:**
```php
// Cek extension ZIP
php -m | grep zip

// Jika tidak ada, install:
sudo apt-get install php-zip
sudo systemctl restart apache2

// Download ulang file
```

### **4. Error: "Download failed"**

**Penyebab:**
- Timeout
- File terlalu besar
- Koneksi lambat

**Solusi:**
```php
// Increase timeout di Updatecms.php baris 382
curl_setopt($ch, CURLOPT_TIMEOUT, 600); // 10 menit

// Atau download manual
```

### **5. Error SQL saat update database**

**Penyebab:**
- Syntax SQL error
- Tabel sudah ada
- Kolom sudah ada

**Solusi:**
```sql
-- Cek error detail
SHOW ERRORS;

-- Skip error dengan IF EXISTS/IF NOT EXISTS
ALTER TABLE users ADD COLUMN IF NOT EXISTS new_column VARCHAR(255);

-- Atau restore backup dan coba lagi
```

---

## ✅ Best Practices

### **Sebelum Update:**

1. **✅ Backup Database**
   ```bash
   mysqldump -u root -p cmsweb > backup_$(date +%Y%m%d).sql
   ```

2. **✅ Backup Files**
   ```bash
   zip -r backup_files.zip app/ public/ writable/
   ```

3. **✅ Catat Versi Sekarang**
   ```sql
   SELECT vercms, verdb FROM tbl_setaplikasi;
   ```

4. **✅ Test di Localhost Dulu**
   - Jangan langsung update di production
   - Test di development environment

5. **✅ Maintenance Mode**
   ```php
   // Set di .env
   CI_ENVIRONMENT = maintenance
   ```

### **Saat Update:**

1. **✅ Pastikan Koneksi Stabil**
   - Jangan update saat koneksi lambat
   - Gunakan koneksi kabel (bukan WiFi)

2. **✅ Jangan Close Browser**
   - Tunggu sampai selesai 100%
   - Jangan refresh halaman

3. **✅ Monitor Progress**
   - Perhatikan pesan error
   - Catat jika ada masalah

### **Setelah Update:**

1. **✅ Clear Cache**
   ```bash
   php spark cache:clear
   ```

2. **✅ Test Semua Fitur**
   - Login/logout
   - CRUD data
   - Upload file
   - Fitur baru

3. **✅ Cek Error Log**
   ```bash
   tail -f writable/logs/log-*.php
   ```

4. **✅ Update Permission**
   ```bash
   chmod 755 writable/
   chmod 644 .env
   ```

5. **✅ Disable Maintenance Mode**
   ```php
   // Set di .env
   CI_ENVIRONMENT = production
   ```

---

## 📊 Struktur File Update

### **File Update ZIP:**

```
fileupdate.zip
├── app/
│   ├── Controllers/
│   │   ├── NewController.php
│   │   └── UpdatedController.php
│   ├── Models/
│   │   └── NewModel.php
│   └── Views/
│       └── new_view.php
├── public/
│   └── template/
│       └── new_template/
├── db/
│   └── update_v1.1.0.sql
└── README_UPDATE.txt
```

### **File SQL Update:**

```sql
-- Update v1.1.0
-- Date: 2025-10-07

-- 1. Alter existing table
ALTER TABLE users 
ADD COLUMN last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

-- 2. Create new table
CREATE TABLE IF NOT EXISTS new_table (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

-- 3. Update version
UPDATE tbl_setaplikasi 
SET verdb = '1.1.0', vercms = '1.1.0' 
WHERE id_setaplikasi = 1;
```

---

## 🔐 Keamanan Update

### **Verifikasi File:**

1. **Cek Source**
   - Hanya download dari sumber resmi
   - `datagoe.com` atau `ikasmedia.net`

2. **Cek Signature** (jika ada)
   ```bash
   # Verify checksum
   md5sum fileupdate.zip
   ```

3. **Scan Malware**
   ```bash
   clamscan -r fileupdate.zip
   ```

### **Permission yang Aman:**

```bash
# Folder
chmod 755 app/
chmod 755 public/
chmod 755 writable/

# File
chmod 644 .env
chmod 644 app/Config/Database.php
```

---

## 📞 Support

### **Jika Ada Masalah:**

1. **Cek Dokumentasi**
   - Baca file README
   - Cek error log

2. **Restore Backup**
   ```bash
   # Restore database
   mysql -u root -p cmsweb < backup_20251007.sql
   
   # Restore files
   unzip backup_files.zip
   ```

3. **Hubungi Support**
   - Website: https://ikasmedia.net
   - WhatsApp: 081 353 967 028
   - Email: support@ikasmedia.net

---

## 📝 Changelog

### **Cara Melihat Changelog:**

1. **Di Dashboard Admin**
   - Menu: Pengaturan → Upgrade CMS
   - Lihat "What's New"

2. **Di Website**
   - https://ikasmedia.net/changelog
   - https://datagoe.com/updates

3. **Di File**
   - `CHANGELOG.md` (jika ada)

---

## 🎯 Tips Update

### **Update Berkala:**

- ✅ Cek update **setiap bulan**
- ✅ Update **minor version** segera (bug fix)
- ✅ Update **major version** setelah test
- ✅ Baca **changelog** sebelum update

### **Update Aman:**

- ✅ **Backup** sebelum update
- ✅ **Test** di localhost dulu
- ✅ **Schedule** saat traffic rendah
- ✅ **Monitor** setelah update

### **Jangan Update Jika:**

- ❌ Tidak ada backup
- ❌ Koneksi tidak stabil
- ❌ Sedang traffic tinggi
- ❌ Belum baca changelog

---

## 🔄 Rollback Update

Jika update bermasalah:

### **Langkah 1: Stop Website**

```php
// .env
CI_ENVIRONMENT = maintenance
```

### **Langkah 2: Restore Database**

```bash
mysql -u root -p cmsweb < backup_before_update.sql
```

### **Langkah 3: Restore Files**

```bash
# Hapus file baru
rm -rf app/ public/ system/

# Extract backup
unzip backup_files.zip
```

### **Langkah 4: Clear Cache**

```bash
php spark cache:clear
rm -rf writable/cache/*
```

### **Langkah 5: Test**

- Login admin
- Test fitur utama
- Cek error log

### **Langkah 6: Online Kembali**

```php
// .env
CI_ENVIRONMENT = production
```

---

## 📖 Kesimpulan

**Update CMS ini mudah dengan sistem otomatis!**

### **Ringkasan:**
1. ✅ Backup dulu
2. ✅ Akses menu Upgrade CMS
3. ✅ Klik tombol Update
4. ✅ Tunggu selesai
5. ✅ Test fitur

### **Jangan Lupa:**
- Backup sebelum update
- Test di localhost dulu
- Baca changelog
- Clear cache setelah update

---

**Dibuat:** 7 Oktober 2025  
**CMS:** Datagoe/Ikasmedia  
**Framework:** CodeIgniter 4  
**Versi:** 1.0.0+

---

**Selamat mengupdate! 🚀**
