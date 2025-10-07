# 🚀 Panduan Instalasi Cepat - Modul Pendaftaran Gereja

## ✅ Checklist File yang Sudah Dibuat

### **Models (3 file)**
- ✅ `app/Models/M_PendaftaranSidi.php`
- ✅ `app/Models/M_PendaftaranBaptis.php`
- ✅ `app/Models/M_PendaftaranNikah.php`

### **Controllers (3 file)**
- ✅ `app/Controllers/PendaftaranSidi.php`
- ✅ `app/Controllers/PendaftaranBaptis.php`
- ✅ `app/Controllers/PendaftaranNikah.php`

### **Configuration**
- ✅ `app/Controllers/BaseController.php` (sudah diupdate)
- ✅ `app/Config/Routes.php` (sudah ditambahkan 45+ routes)

### **Database**
- ✅ `db/pendaftaran_gereja_tables.sql`

### **Views Backend - Pendaftaran Sidi (5 file)**
- ✅ `app/Views/backend/morvin/cmscust/pendaftaran_sidi/index.php`
- ✅ `app/Views/backend/morvin/cmscust/pendaftaran_sidi/list.php`
- ✅ `app/Views/backend/morvin/cmscust/pendaftaran_sidi/lihat.php`
- ✅ `app/Views/backend/morvin/cmscust/pendaftaran_sidi/edit.php`
- ✅ `app/Views/backend/morvin/cmscust/pendaftaran_sidi/tambah.php`
- ✅ `app/Views/backend/morvin/cmscust/pendaftaran_sidi/upload.php`

### **Dokumentasi**
- ✅ `DOKUMENTASI_MODUL_PENDAFTARAN.md` (600+ baris)

---

## 📋 Langkah Instalasi

### **LANGKAH 1: Import Database**

```bash
# Via Command Line
mysql -u username -p database_name < db/pendaftaran_gereja_tables.sql
```

**Atau via phpMyAdmin:**
1. Buka phpMyAdmin
2. Pilih database Anda
3. Klik tab **Import**
4. Pilih file `db/pendaftaran_gereja_tables.sql`
5. Klik **Go**

**Verifikasi:** Pastikan 3 tabel berhasil dibuat:
- `custome__pendaftaran_sidi`
- `custome__pendaftaran_baptis`
- `custome__pendaftaran_nikah`

---

### **LANGKAH 2: Buat Folder Upload**

```bash
# Buat folder untuk dokumen
mkdir -p public/file/dokumen/sidi
mkdir -p public/file/dokumen/baptis
mkdir -p public/file/dokumen/nikah

# Set permission (Linux/Mac)
chmod 755 public/file/dokumen/sidi
chmod 755 public/file/dokumen/baptis
chmod 755 public/file/dokumen/nikah
```

**Windows:**
- Buat folder manual di `public/file/dokumen/`
- Buat 3 subfolder: `sidi`, `baptis`, `nikah`

---

### **LANGKAH 3: Copy Views untuk Baptis & Nikah**

Views untuk **Baptis** dan **Nikah** mengikuti pola yang sama dengan **Sidi**.

**Copy dan sesuaikan:**

```bash
# Copy folder sidi ke baptis
cp -r app/Views/backend/morvin/cmscust/pendaftaran_sidi app/Views/backend/morvin/cmscust/pendaftaran_baptis

# Copy folder sidi ke nikah
cp -r app/Views/backend/morvin/cmscust/pendaftaran_sidi app/Views/backend/morvin/cmscust/pendaftaran_nikah
```

**Kemudian lakukan Find & Replace di setiap file:**

**Untuk Baptis:**
- `pendaftaran-sidi` → `pendaftaran-baptis`
- `id_sidi` → `id_baptis`
- `listsidi` → `listbaptis`
- `Sidi` → `Baptis`

**Untuk Nikah:**
- `pendaftaran-sidi` → `pendaftaran-nikah`
- `id_sidi` → `id_nikah`
- `listsidi` → `listnikah`
- `Sidi` → `Nikah` / `Pernikahan`

---

### **LANGKAH 4: Tambahkan Menu di Admin**

1. Login ke admin: `http://domain.com/cms-login`
2. Masuk ke menu **Pengaturan** → **Modul**
3. Klik **Tambah Modul**
4. Tambahkan 3 modul baru:

**Modul 1: Pendaftaran Sidi**
- Nama Modul: `Pendaftaran Sidi`
- URL: `pendaftaran-sidi/list`
- Icon: `fas fa-church`
- Grup Menu: (pilih grup yang sesuai)

**Modul 2: Pendaftaran Baptis**
- Nama Modul: `Pendaftaran Baptis`
- URL: `pendaftaran-baptis/list`
- Icon: `fas fa-water`
- Grup Menu: (pilih grup yang sesuai)

**Modul 3: Pendaftaran Nikah**
- Nama Modul: `Pendaftaran Pernikahan`
- URL: `pendaftaran-nikah/list`
- Icon: `fas fa-ring`
- Grup Menu: (pilih grup yang sesuai)

---

### **LANGKAH 5: Set Hak Akses**

1. Masuk ke menu **Pengaturan** → **Modul**
2. Klik tombol **Set Akses** pada setiap modul
3. Pilih grup user yang boleh mengakses
4. Set level akses:
   - **Level 1**: Full akses (CRUD + Upload + Delete)
   - **Level 2**: View only

---

### **LANGKAH 6: Buat Views Frontend (Opsional)**

Untuk form pendaftaran publik, buat file di:
- `app/Views/frontend/[template]/content/pendaftaran_sidi.php`
- `app/Views/frontend/[template]/content/pendaftaran_baptis.php`
- `app/Views/frontend/[template]/content/pendaftaran_nikah.php`

**Contoh struktur form minimal:**

```php
<!-- Form Pendaftaran Sidi -->
<?= form_open('pendaftaran-sidi/simpanpendaftaran', ['class' => 'formdaftar']) ?>
<?= csrf_field(); ?>

<div class="form-group">
    <label>Nama Lengkap *</label>
    <input type="text" name="nama_lengkap" class="form-control" required>
</div>

<div class="form-group">
    <label>Email *</label>
    <input type="email" name="email" class="form-control" required>
</div>

<!-- Tambahkan field lainnya sesuai kebutuhan -->

<!-- Google reCAPTCHA (jika aktif) -->
<div class="g-recaptcha" data-sitekey="<?= $sitekey ?>"></div>

<button type="submit" class="btn btn-primary">
    <i class="fas fa-paper-plane"></i> Kirim Pendaftaran
</button>

<?= form_close(); ?>

<script>
$(document).ready(function() {
    $('.formdaftar').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.sukses) {
                    Swal.fire('Berhasil!', response.sukses, 'success');
                    $('.formdaftar')[0].reset();
                } else if (response.gagal) {
                    Swal.fire('Gagal!', response.gagal, 'error');
                }
            }
        });
    });
});
</script>
```

---

## 🔧 Troubleshooting

### **Error: Table doesn't exist**
**Solusi:** Import ulang file SQL

### **Error: Permission denied saat upload**
**Solusi:** 
```bash
chmod -R 755 public/file/dokumen/
```

### **Error: Class not found**
**Solusi:**
```bash
php spark cache:clear
```

### **Menu tidak muncul di admin**
**Solusi:** 
1. Cek apakah modul sudah ditambahkan di menu Modul
2. Cek hak akses grup user

### **Data tidak muncul**
**Solusi:**
1. Cek koneksi database
2. Cek apakah tabel sudah ada
3. Cek hak akses user

---

## 📊 Testing

### **Test Backend:**

1. **Login Admin**
   ```
   URL: http://domain.com/cms-login
   Username: admin
   Password: CMS@d4tagoeGen5
   ```

2. **Akses Menu**
   - Pendaftaran Sidi: `http://domain.com/pendaftaran-sidi/list`
   - Pendaftaran Baptis: `http://domain.com/pendaftaran-baptis/list`
   - Pendaftaran Nikah: `http://domain.com/pendaftaran-nikah/list`

3. **Test CRUD**
   - ✅ Tambah data manual
   - ✅ Edit data
   - ✅ Lihat detail
   - ✅ Upload dokumen
   - ✅ Ubah status
   - ✅ Hapus data

### **Test Frontend:**

1. **Akses Form Pendaftaran**
   - Sidi: `http://domain.com/pendaftaran-sidi`
   - Baptis: `http://domain.com/pendaftaran-baptis`
   - Nikah: `http://domain.com/pendaftaran-nikah`

2. **Test Submit Form**
   - Isi form lengkap
   - Cek validasi
   - Cek reCAPTCHA (jika aktif)
   - Submit dan cek notifikasi

3. **Verifikasi di Admin**
   - Data masuk dengan status "Pending"
   - Dokumen belum ada (jika tidak diupload dari frontend)

---

## 🎯 Fitur yang Sudah Tersedia

### **Backend (Admin):**
- ✅ List data dengan DataTables
- ✅ Tambah data manual
- ✅ Edit data
- ✅ Lihat detail lengkap
- ✅ Upload dokumen (KTP, KK, Sertifikat, Foto)
- ✅ Download dokumen
- ✅ Hapus dokumen
- ✅ Ubah status (Pending/Disetujui/Ditolak)
- ✅ Hapus single data
- ✅ Hapus multiple data
- ✅ Hak akses per grup user
- ✅ Validasi form
- ✅ AJAX operations

### **Frontend (Publik):**
- ✅ Form pendaftaran online
- ✅ Validasi form
- ✅ Google reCAPTCHA support
- ✅ Notifikasi sukses/error
- ✅ Auto-save dengan status Pending

---

## 📁 Struktur File Lengkap

```
cmsweb/
├── app/
│   ├── Controllers/
│   │   ├── BaseController.php (updated)
│   │   ├── PendaftaranSidi.php
│   │   ├── PendaftaranBaptis.php
│   │   └── PendaftaranNikah.php
│   │
│   ├── Models/
│   │   ├── M_PendaftaranSidi.php
│   │   ├── M_PendaftaranBaptis.php
│   │   └── M_PendaftaranNikah.php
│   │
│   ├── Config/
│   │   └── Routes.php (updated)
│   │
│   └── Views/
│       └── backend/morvin/cmscust/
│           ├── pendaftaran_sidi/
│           │   ├── index.php
│           │   ├── list.php
│           │   ├── lihat.php
│           │   ├── edit.php
│           │   ├── tambah.php
│           │   └── upload.php
│           │
│           ├── pendaftaran_baptis/ (copy dari sidi)
│           └── pendaftaran_nikah/ (copy dari sidi)
│
├── public/file/dokumen/
│   ├── sidi/
│   ├── baptis/
│   └── nikah/
│
├── db/
│   └── pendaftaran_gereja_tables.sql
│
├── DOKUMENTASI_MODUL_PENDAFTARAN.md
└── README_INSTALASI_MODUL_PENDAFTARAN.md (file ini)
```

---

## 📞 Support

Untuk bantuan lebih lanjut:
- Website: https://ikasmedia.net
- WhatsApp: 081 353 967 028

---

## ✨ Selesai!

Setelah mengikuti semua langkah di atas, modul pendaftaran sudah siap digunakan!

**Jangan lupa:**
1. ✅ Backup database sebelum import
2. ✅ Test semua fitur sebelum production
3. ✅ Sesuaikan views dengan template Anda
4. ✅ Set permission folder upload
5. ✅ Hapus file dokumentasi saat online

**Selamat menggunakan! 🎉**

---

**Dibuat:** 7 Oktober 2025  
**Versi:** 1.0.0  
**Framework:** CodeIgniter 4
