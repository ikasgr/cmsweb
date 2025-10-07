# ⚡ Cara Membuat Tema Baru - Panduan Singkat

## 🎯 Membuat Tema dalam 8 Langkah

### **Langkah 1: Buat Folder (2 menit)**

```bash
# Nama tema: gereja-modern

# Folder Views
mkdir app/Views/frontend/gereja-modern/desktop/content
mkdir app/Views/frontend/gereja-modern/mobile

# Folder Assets
mkdir public/template/frontend/gereja-modern/desktop/css
mkdir public/template/frontend/gereja-modern/desktop/js
mkdir public/template/frontend/gereja-modern/desktop/img
```

### **Langkah 2: Copy Template Dasar (1 menit)**

```bash
# Copy dari tema desaku sebagai template
cp -r app/Views/frontend/desaku/* app/Views/frontend/gereja-modern/
cp -r public/template/frontend/desaku/* public/template/frontend/gereja-modern/
```

### **Langkah 3: Edit Template Utama (5 menit)**

**File:** `app/Views/frontend/gereja-modern/desktop/template-frontend.php`

Minimal yang harus ada:
```php
<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . $folder . '/desktop/css/style.css') ?>">
</head>
<body>
    <?= $this->renderSection('v_menu') ?>
    <main><?= $this->renderSection('content') ?></main>
    <footer>Footer</footer>
</body>
</html>
```

### **Langkah 4: Edit Menu (3 menit)**

**File:** `app/Views/frontend/gereja-modern/desktop/v_menu.php`

```php
<?= $this->section('v_menu'); ?>
<nav>
    <a href="<?= base_url() ?>">Home</a>
    <a href="<?= base_url('jadwal') ?>">Jadwal</a>
    <a href="<?= base_url('toko') ?>">Toko</a>
</nav>
<?= $this->endSection(); ?>
```

### **Langkah 5: Edit Homepage (3 menit)**

**File:** `app/Views/frontend/gereja-modern/desktop/v_home.php`

```php
<?= $this->extend('frontend/' . $folder . '/desktop/template-frontend') ?>
<?= $this->extend('frontend/' . $folder . '/desktop/v_menu') ?>

<?= $this->section('content'); ?>
<h1>Welcome to <?= $konfigurasi->nama ?></h1>
<?= $this->endSection() ?>
```

### **Langkah 6: Buat CSS (5 menit)**

**File:** `public/template/frontend/gereja-modern/desktop/css/style.css`

```css
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

nav {
    background: #333;
    padding: 1rem;
}

nav a {
    color: white;
    margin: 0 1rem;
    text-decoration: none;
}
```

### **Langkah 7: Insert Database (1 menit)**

```sql
INSERT INTO `template` (
    `nama`, `pembuat`, `folder`, `status`, `id`, 
    `ket`, `img`, `jtema`, `hplogo`, `wllogo`, 
    `hpbanner`, `wlbanner`, `verbost`, `duatema`, 
    `warna_topbar`, `sidebar_mode`, `video_bag`
) VALUES (
    'Gereja Modern',      -- nama
    'Your Name',          -- pembuat
    'gereja-modern',      -- folder (PENTING!)
    0,                    -- status (0=inactive)
    1,                    -- id
    'Tema Modern',        -- keterangan
    'default.png',        -- gambar preview
    1,                    -- jtema (1=frontend)
    90, 375,              -- ukuran logo (tinggi, lebar)
    600, 1800,            -- ukuran banner (tinggi, lebar)
    '1', 0, '-', 0, NULL
);
```

### **Langkah 8: Aktifkan Tema (30 detik)**

**Via Admin:**
1. Login admin
2. **Pengaturan** → **Template**
3. Cari "Gereja Modern"
4. Klik **Aktifkan**

**Via Database:**
```sql
-- Reset semua tema
UPDATE template SET status = 0 WHERE jtema = 1;

-- Aktifkan tema baru
UPDATE template SET status = 1 WHERE folder = 'gereja-modern';
```

---

## 📁 Struktur Minimal Tema

```
gereja-modern/
├── app/Views/frontend/gereja-modern/
│   └── desktop/
│       ├── template-frontend.php  ← Template utama
│       ├── v_menu.php             ← Menu
│       ├── v_home.php             ← Homepage
│       └── content/               ← Halaman lain
│           ├── berita_index.php
│           └── jadwal_index.php
└── public/template/frontend/gereja-modern/
    └── desktop/
        ├── css/
        │   └── style.css          ← CSS utama
        └── js/
            └── main.js            ← JavaScript
```

---

## 🎨 Customisasi Cepat

### **Ubah Warna:**
```css
/* style.css */
:root {
    --primary: #007bff;
    --secondary: #6c757d;
}
```

### **Ubah Font:**
```html
<!-- template-frontend.php -->
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
```

```css
/* style.css */
body { font-family: 'Poppins', sans-serif; }
```

### **Tambah Logo:**
```php
<!-- v_menu.php -->
<img src="<?= base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo) ?>" height="50">
```

---

## 🔧 File Penting

| File | Fungsi | Wajib |
|------|--------|-------|
| `template-frontend.php` | Template utama | ✅ Ya |
| `v_menu.php` | Menu navigasi | ✅ Ya |
| `v_home.php` | Halaman home | ✅ Ya |
| `style.css` | CSS utama | ✅ Ya |
| `main.js` | JavaScript | ❌ Opsional |

---

## ⚠️ Yang Harus Diperhatikan

### **1. Nama Folder Harus Sama**

```
Database: folder = 'gereja-modern'
Views:    app/Views/frontend/gereja-modern/
Assets:   public/template/frontend/gereja-modern/
```

### **2. Struktur Folder Harus Benar**

```
✅ BENAR:
app/Views/frontend/gereja-modern/desktop/template-frontend.php

❌ SALAH:
app/Views/frontend/gereja-modern/template-frontend.php
```

### **3. Extend & Section**

```php
<!-- WAJIB ada di setiap halaman -->
<?= $this->extend('frontend/' . $folder . '/desktop/template-frontend') ?>
<?= $this->section('content'); ?>
    <!-- Konten di sini -->
<?= $this->endSection() ?>
```

---

## 🚀 Quick Commands

**Buat struktur folder:**
```bash
mkdir -p app/Views/frontend/gereja-modern/desktop/content
mkdir -p public/template/frontend/gereja-modern/desktop/{css,js,img}
```

**Copy dari tema lain:**
```bash
cp -r app/Views/frontend/desaku/* app/Views/frontend/gereja-modern/
```

**Aktifkan tema:**
```sql
UPDATE template SET status = 0 WHERE jtema = 1;
UPDATE template SET status = 1 WHERE folder = 'gereja-modern';
```

---

## 📋 Checklist

- [ ] Buat folder struktur
- [ ] Copy template dasar
- [ ] Edit template-frontend.php
- [ ] Edit v_menu.php
- [ ] Edit v_home.php
- [ ] Buat style.css
- [ ] Insert ke database
- [ ] Aktifkan tema
- [ ] Test di browser

---

## 🎯 Tips Cepat

### **Cara Tercepat:**
1. Copy tema `desaku`
2. Rename folder
3. Edit CSS saja
4. Insert database
5. Aktifkan

### **Untuk Pemula:**
- Copy tema yang sudah ada
- Edit sedikit-sedikit
- Test setiap perubahan

### **Untuk Advanced:**
- Buat dari scratch
- Gunakan framework CSS (Bootstrap, Tailwind)
- Tambah animasi & interaksi

---

## 🔍 Troubleshooting

| Masalah | Solusi |
|---------|--------|
| Tema tidak muncul | Cek nama folder di database |
| CSS tidak load | Cek path CSS di template |
| Menu tidak muncul | Cek `renderSection('v_menu')` |
| Error 404 | Cek struktur folder |

---

## 📖 Dokumentasi Lengkap

Baca: `PANDUAN_MEMBUAT_TEMA_BARU.md`

---

**Selamat membuat tema! 🎨**

**Waktu:** ~20 menit  
**Tingkat:** Pemula - Menengah
