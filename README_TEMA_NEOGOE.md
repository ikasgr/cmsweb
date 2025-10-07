# 🎨 Tema NeoGoe - README

## ✅ Status Instalasi

**Tema NeoGoe sudah berhasil dibuat!**

### **File yang Dibuat:**

✅ **Views (PHP):**
- `app/Views/frontend/neogoe/desktop/template-frontend.php`
- `app/Views/frontend/neogoe/desktop/v_menu.php`
- `app/Views/frontend/neogoe/desktop/v_home.php`
- `app/Views/frontend/neogoe/desktop/content/` (folder)

✅ **Database:**
- `db/tema_neogoe.sql`

✅ **Dokumentasi:**
- `PANDUAN_INSTALASI_TEMA_NEOGOE.md`
- `README_TEMA_NEOGOE.md` (file ini)

---

## 🚀 Cara Aktifkan Tema

### **LANGKAH 1: Import SQL**

```bash
# Via MySQL Command Line
mysql -u root -p database_name < db/tema_neogoe.sql

# Via phpMyAdmin
1. Buka phpMyAdmin
2. Pilih database
3. Tab "SQL"
4. Copy paste isi file tema_neogoe.sql
5. Klik "Go"
```

### **LANGKAH 2: Aktifkan Tema**

**Via Admin:**
1. Login admin: `http://domain.com/cms-login`
2. Menu **Pengaturan** → **Template**
3. Cari tema **"NeoGoe"**
4. Klik tombol **"Aktifkan"**

**Via Database:**
```sql
-- Reset semua tema
UPDATE template SET status = 0 WHERE jtema = 1;

-- Aktifkan NeoGoe
UPDATE template SET status = 1 WHERE folder = 'neogoe' AND jtema = 1;
```

### **LANGKAH 3: Clear Cache**

```bash
# Via command line
php spark cache:clear

# Via browser
http://domain.com/clearcache
```

### **LANGKAH 4: Test**

Buka website: `http://domain.com`

---

## 📁 Struktur File

```
cmsweb/
├── app/
│   └── Views/
│       └── frontend/
│           └── neogoe/
│               └── desktop/
│                   ├── template-frontend.php  ✅ Sudah dibuat
│                   ├── v_menu.php            ✅ Sudah dibuat
│                   ├── v_home.php            ✅ Sudah dibuat
│                   └── content/              ✅ Folder siap
└── public/
    └── template/
        └── frontend/
            └── neogoe/
                └── desktop/
                    ├── css/                  ✅ Sudah ada
                    ├── js/                   ✅ Sudah ada
                    ├── img/                  ✅ Sudah ada
                    └── library/              ✅ Sudah ada
```

---

## ✨ Fitur Tema NeoGoe

### **Design:**
- ✅ Modern & Professional
- ✅ Responsive (Mobile, Tablet, Desktop)
- ✅ Clean Layout
- ✅ Mega Menu
- ✅ Smooth Animations (AOS)
- ✅ Sticky Navigation

### **Komponen Homepage:**
- ✅ Top Bar (Email, Phone, Social Media)
- ✅ Navigation Menu (Dropdown Support)
- ✅ Hero Slider (Banner Carousel)
- ✅ Berita Terbaru (4 items)
- ✅ Informasi Instansi (Pengumuman, Agenda, E-Book)
- ✅ Data Pegawai (4 items)
- ✅ Galeri Foto (4 items)
- ✅ Hubungi Kami (Contact Info + Map)
- ✅ Footer (3 columns)
- ✅ Back to Top Button

### **Menu Navigasi:**
- ✅ HOME
- ✅ PROFIL (Dropdown)
  - Visi dan Misi
  - Struktur Organisasi
  - Tugas Pokok dan Fungsi
  - Data Pegawai
- ✅ BERITA
- ✅ INFORMASI (Dropdown)
  - Layanan
  - Pengumuman
  - Agenda
  - Bank Data
  - Produk Hukum
  - Infografis
  - Transparansi Anggaran
- ✅ GALERI (Dropdown)
  - Foto
  - Video
- ✅ INTERAKSI (Dropdown)
  - Survei
  - Masukan Saran
  - Buku Tamu
- ✅ E-BOOK

### **Teknologi:**
- Bootstrap 4.6
- Font Awesome 5.15
- jQuery 3.6
- AOS Animation 2.3
- Slick Carousel 1.8

---

## 🎨 Customisasi

### **1. Ubah Warna Tema**

Edit file: `public/template/frontend/neogoe/desktop/css/style.css`

```css
:root {
    --primary-color: #2c3e50;
    --secondary-color: #34495e;
    --accent-color: #3498db;
}

/* Ubah warna sesuai keinginan */
.btn-primary {
    background-color: var(--primary-color);
}
```

### **2. Ubah Ukuran Logo**

```sql
UPDATE template 
SET hplogo = 70,    -- tinggi logo (px)
    wllogo = 250    -- lebar logo (px)
WHERE folder = 'neogoe';
```

### **3. Ubah Warna Top Bar**

Edit di `template-frontend.php`:

```html
<!-- Ganti bg-dark dengan warna lain -->
<div class="top-bar bg-primary text-white py-2">
```

### **4. Tambah Menu Custom**

Edit file: `v_menu.php`

```php
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('custom-page') ?>">
        MENU BARU
    </a>
</li>
```

---

## 🔧 Troubleshooting

### **Tema tidak muncul di admin:**

**Solusi:**
```sql
-- Cek apakah tema sudah ada
SELECT * FROM template WHERE folder = 'neogoe';

-- Jika belum, insert dari file tema_neogoe.sql
```

### **CSS/JS tidak load:**

**Solusi:**
1. Cek folder `public/template/frontend/neogoe/` ada
2. Cek permission folder (755)
3. Clear cache browser (Ctrl + Shift + Delete)

### **Menu tidak muncul:**

**Solusi:**
1. Cek `renderSection('v_menu')` ada di template-frontend.php
2. Cek file v_menu.php ada
3. Clear cache

### **Error 404:**

**Solusi:**
1. Cek struktur folder benar: `desktop/`
2. Cek nama folder sama dengan database: `neogoe`

---

## 📊 Database Info

### **Tabel: template**

```sql
-- Data tema NeoGoe
nama: NeoGoe
pembuat: Datagoe
folder: neogoe
status: 0 (inactive) / 1 (active)
jtema: 1 (frontend)
hplogo: 60 (tinggi logo)
wllogo: 200 (lebar logo)
hpbanner: 600 (tinggi banner)
wlbanner: 1800 (lebar banner)
```

### **Query Berguna:**

```sql
-- Cek tema aktif
SELECT * FROM template WHERE status = 1 AND jtema = 1;

-- Lihat semua tema frontend
SELECT nama, folder, status FROM template WHERE jtema = 1;

-- Aktifkan NeoGoe
UPDATE template SET status = 0 WHERE jtema = 1;
UPDATE template SET status = 1 WHERE folder = 'neogoe';
```

---

## 📋 Checklist

- [x] ✅ Buat folder struktur
- [x] ✅ Buat template-frontend.php
- [x] ✅ Buat v_menu.php
- [x] ✅ Buat v_home.php
- [x] ✅ Buat SQL file
- [ ] ⏳ Import SQL ke database
- [ ] ⏳ Aktifkan tema
- [ ] ⏳ Clear cache
- [ ] ⏳ Test di browser

---

## 🎯 Next Steps

### **Sekarang:**
1. Import file `db/tema_neogoe.sql`
2. Aktifkan tema via admin
3. Clear cache
4. Test website

### **Selanjutnya:**
1. Customisasi warna sesuai brand
2. Upload logo & banner
3. Isi konten (berita, pegawai, dll)
4. Test responsive di mobile

### **Optional:**
1. Tambah halaman custom
2. Integrasi dengan modul lain
3. Optimasi SEO
4. Tambah animasi

---

## 📖 Dokumentasi Lengkap

Baca file:
- `PANDUAN_INSTALASI_TEMA_NEOGOE.md` - Tutorial lengkap
- `PANDUAN_MEMBUAT_TEMA_BARU.md` - Cara membuat tema
- `CARA_MEMBUAT_TEMA_SINGKAT.md` - Quick guide

---

## 📞 Support

**Jika ada kendala:**
1. Cek dokumentasi di atas
2. Cek troubleshooting
3. Hubungi support:
   - Website: https://datagoe.com
   - Website: https://ikasmedia.net
   - WhatsApp: 081 353 967 028

---

## 🎉 Kesimpulan

**Tema NeoGoe sudah siap digunakan!**

### **Yang Sudah Dibuat:**
- ✅ 3 file PHP (template, menu, home)
- ✅ 1 file SQL (database)
- ✅ 2 file dokumentasi

### **Tinggal:**
1. Import SQL
2. Aktifkan tema
3. Done! 🚀

**Demo:** https://neogoe.datagoe.com/

---

**Selamat menggunakan Tema NeoGoe! 🎨**

**Dibuat:** 7 Oktober 2025  
**Versi:** 1.0.0  
**Framework:** CodeIgniter 4
