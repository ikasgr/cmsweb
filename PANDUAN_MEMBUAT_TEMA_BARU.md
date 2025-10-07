# 🎨 Panduan Membuat Tema Baru CMS Datagoe/Ikasmedia

## 📋 Daftar Isi
1. [Pengenalan Sistem Tema](#pengenalan-sistem-tema)
2. [Struktur Tema](#struktur-tema)
3. [Cara Membuat Tema Baru](#cara-membuat-tema-baru)
4. [Konfigurasi Tema](#konfigurasi-tema)
5. [Customisasi](#customisasi)
6. [Best Practices](#best-practices)

---

## 🎯 Pengenalan Sistem Tema

CMS ini mendukung **multiple themes** yang bisa diganti dengan mudah dari dashboard admin.

### **Jenis Tema:**
1. **Frontend Theme** (`jtema = 1`) - Untuk tampilan website publik
2. **Backend Theme** (`jtema = 0`) - Untuk dashboard admin

### **Tema yang Tersedia:**

| Nama Tema | Folder | Jenis | Status |
|-----------|--------|-------|--------|
| Tema Desa | `desaku` | Frontend | ✅ Aktif |
| Web PLUS 1 | `plus1` | Frontend | Inactive |
| Web PLUS 2 | `plus2` | Frontend | Inactive |
| Company Profile | `company` | Frontend | Inactive |
| Dashboard Standar | `standar` | Backend | Inactive |
| Morvin | `morvin` | Backend | ✅ Aktif |

---

## 📁 Struktur Tema

### **Lokasi File Tema:**

```
cmsweb/
├── app/
│   └── Views/
│       └── frontend/
│           └── [nama-tema]/
│               ├── desktop/
│               │   ├── template-frontend.php  ← Template utama
│               │   ├── v_menu.php            ← Menu navigasi
│               │   ├── v_home.php            ← Halaman home
│               │   └── content/              ← Halaman konten
│               │       ├── berita_index.php
│               │       ├── berita_detail.php
│               │       ├── jadwal_index.php
│               │       └── ...
│               └── mobile/
│                   └── (struktur sama)
└── public/
    └── template/
        └── frontend/
            └── [nama-tema]/
                └── desktop/
                    ├── css/
                    │   ├── style.css
                    │   └── custom.css
                    ├── js/
                    │   ├── main.js
                    │   └── custom.js
                    ├── img/
                    │   └── (gambar tema)
                    └── library/
                        └── (library eksternal)
```

---

## 🚀 Cara Membuat Tema Baru

### **LANGKAH 1: Persiapan**

#### **A. Tentukan Nama Tema**

Contoh: `gereja-modern`

#### **B. Buat Folder Struktur**

```bash
# Folder Views (PHP)
mkdir -p app/Views/frontend/gereja-modern/desktop/content
mkdir -p app/Views/frontend/gereja-modern/mobile

# Folder Assets (CSS/JS/IMG)
mkdir -p public/template/frontend/gereja-modern/desktop/css
mkdir -p public/template/frontend/gereja-modern/desktop/js
mkdir -p public/template/frontend/gereja-modern/desktop/img
mkdir -p public/template/frontend/gereja-modern/desktop/library
```

---

### **LANGKAH 2: Buat File Template Utama**

#### **File: `app/Views/frontend/gereja-modern/desktop/template-frontend.php`**

```php
<?php
$konfigurasi = $this->konfigurasi->vkonfig();
$template = $this->template->tempaktif();
$folder = $template['folder'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= isset($deskripsi) ? esc($deskripsi) : esc($konfigurasi->deskripsi) ?>">
    <meta name="keywords" content="<?= esc($konfigurasi->nama) ?>">
    <meta name="author" content="<?= esc($konfigurasi->nama) ?>">
    
    <!-- Title -->
    <title><?= isset($title) ? esc($title) : esc($konfigurasi->nama) ?></title>
    
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url('/public/img/konfigurasi/icon/' . esc($konfigurasi->icon)) ?>">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . $folder . '/desktop/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . $folder . '/desktop/css/custom.css') ?>">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <img src="<?= base_url('/public/img/konfigurasi/icon/' . esc($konfigurasi->icon)) ?>" alt="Loading">
        </div>
    </div>
    
    <!-- Menu -->
    <?= $this->renderSection('v_menu') ?>
    
    <!-- Main Content -->
    <main id="main">
        <?= $this->renderSection('content') ?>
    </main>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4><?= esc($konfigurasi->nama) ?></h4>
                    <p><?= esc($konfigurasi->deskripsi) ?></p>
                </div>
                <div class="col-md-4">
                    <h4>Kontak</h4>
                    <p>
                        <i class="fas fa-map-marker-alt"></i> <?= esc($konfigurasi->alamat) ?><br>
                        <i class="fas fa-phone"></i> <?= esc($konfigurasi->no_telp) ?><br>
                        <i class="fas fa-envelope"></i> <?= esc($konfigurasi->email) ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <h4>Sosial Media</h4>
                    <div class="social-links">
                        <?php if ($konfigurasi->facebook) : ?>
                            <a href="<?= esc($konfigurasi->facebook) ?>" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($konfigurasi->instagram) : ?>
                            <a href="<?= esc($konfigurasi->instagram) ?>" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($konfigurasi->youtube) : ?>
                            <a href="<?= esc($konfigurasi->youtube) ?>" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 text-center">
                    <p>&copy; <?= date('Y') ?> <?= esc($konfigurasi->nama) ?>. All Rights Reserved.</p>
                    <p><small>Powered by <a href="https://ikasmedia.net" target="_blank">Ikasmedia</a></small></p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('/public/template/frontend/' . $folder . '/desktop/js/main.js') ?>"></script>
    <script src="<?= base_url('/public/template/frontend/' . $folder . '/desktop/js/custom.js') ?>"></script>
    
    <script>
        $(document).ready(function() {
            // Hide preloader
            $(".preloader").fadeOut();
        });
    </script>
</body>
</html>
```

---

### **LANGKAH 3: Buat File Menu**

#### **File: `app/Views/frontend/gereja-modern/desktop/v_menu.php`**

```php
<?= $this->section('v_menu'); ?>

<?php
$konfigurasi = $this->konfigurasi->vkonfig();
$template = $this->template->tempaktif();
$mainmenu = $this->menu->mainmenu();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="<?= base_url() ?>">
            <img src="<?= base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)) ?>" 
                 alt="<?= esc($konfigurasi->nama) ?>" 
                 height="50">
        </a>
        
        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                
                <?php if ($mainmenu) : ?>
                    <?php foreach ($mainmenu as $menu) : ?>
                        <?php if ($menu['link'] == '#') : ?>
                            <!-- Menu dengan Submenu -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                    <?= esc($menu['nama_menu']) ?>
                                </a>
                                <div class="dropdown-menu">
                                    <?php 
                                    $submenu = $this->menu->submenu($menu['menu_id']);
                                    if ($submenu) :
                                        foreach ($submenu as $sub) : ?>
                                            <a class="dropdown-item" href="<?= base_url($sub['link']) ?>">
                                                <?= esc($sub['nama_menu']) ?>
                                            </a>
                                        <?php endforeach;
                                    endif; ?>
                                </div>
                            </li>
                        <?php else : ?>
                            <!-- Menu Biasa -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url($menu['link']) ?>">
                                    <?= esc($menu['nama_menu']) ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <!-- Menu Tambahan -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('jadwal') ?>">
                        <i class="fas fa-calendar-check"></i> Jadwal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('toko') ?>">
                        <i class="fas fa-shopping-bag"></i> Toko
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?= $this->endSection(); ?>
```

---

### **LANGKAH 4: Buat Halaman Home**

#### **File: `app/Views/frontend/gereja-modern/desktop/v_home.php`**

```php
<?= $this->extend('frontend/' . esc($folder) . '/desktop/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop/v_menu') ?>

<?= $this->section('content'); ?>

<!-- Hero Section -->
<section class="hero-section" style="background-image: url('<?= base_url('/public/img/banner/' . esc($banner[0]['banner_image'])) ?>');">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center text-white">
                <h1 class="display-4"><?= esc($konfigurasi->nama) ?></h1>
                <p class="lead"><?= esc($konfigurasi->deskripsi) ?></p>
                <a href="<?= base_url('tentang') ?>" class="btn btn-primary btn-lg">
                    Selengkapnya <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terbaru -->
<section class="berita-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">Berita Terbaru</h2>
        <div class="row">
            <?php foreach ($berita4 as $berita) : ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="<?= base_url('/public/img/informasi/berita/' . esc($berita['gambar'])) ?>" 
                             class="card-img-top" alt="<?= esc($berita['judul_berita']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($berita['judul_berita']) ?></h5>
                            <p class="card-text"><?= substr(esc($berita['ringkasan']), 0, 100) ?>...</p>
                            <a href="<?= base_url($berita['slug_berita']) ?>" class="btn btn-sm btn-primary">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Jadwal Pelayanan -->
<?php 
use App\Models\M_JadwalPelayanan;
$jadwal_model = new M_JadwalPelayanan();
$jadwal_upcoming = $jadwal_model->upcoming(4);

if ($jadwal_upcoming) : ?>
<section class="jadwal-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Jadwal Pelayanan</h2>
        <div class="row">
            <?php foreach ($jadwal_upcoming as $jadwal) : ?>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 text-center">
                                    <div class="date-box">
                                        <h2><?= date('d', strtotime($jadwal['tanggal'])) ?></h2>
                                        <small><?= strftime('%b', strtotime($jadwal['tanggal'])) ?></small>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h5><?= esc($jadwal['judul_jadwal']) ?></h5>
                                    <p class="mb-1">
                                        <i class="fas fa-clock"></i> <?= date('H:i', strtotime($jadwal['waktu_mulai'])) ?>
                                    </p>
                                    <p class="mb-0">
                                        <i class="fas fa-map-marker-alt"></i> <?= esc($jadwal['tempat']) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-3">
            <a href="<?= base_url('jadwal') ?>" class="btn btn-primary">
                Lihat Semua Jadwal <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<?= $this->endSection() ?>
```

---

### **LANGKAH 5: Buat CSS**

#### **File: `public/template/frontend/gereja-modern/desktop/css/style.css`**

```css
/* ========================================
   GEREJA MODERN THEME
   ======================================== */

/* General */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}

/* Preloader */
.preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #fff;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.loader img {
    width: 100px;
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Navbar */
.navbar {
    padding: 1rem 0;
}

.navbar-brand img {
    max-height: 50px;
}

.nav-link {
    font-weight: 500;
    padding: 0.5rem 1rem !important;
    transition: all 0.3s ease;
}

.nav-link:hover {
    color: #007bff !important;
}

/* Hero Section */
.hero-section {
    background-size: cover;
    background-position: center;
    padding: 150px 0;
    position: relative;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
}

.hero-section .container {
    position: relative;
    z-index: 1;
}

/* Berita Section */
.berita-section .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.berita-section .card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.berita-section .card-img-top {
    height: 200px;
    object-fit: cover;
}

/* Jadwal Section */
.jadwal-section {
    background: #f8f9fa;
}

.date-box {
    background: #007bff;
    color: #fff;
    padding: 15px;
    border-radius: 10px;
    text-align: center;
}

.date-box h2 {
    margin: 0;
    font-size: 2rem;
    font-weight: bold;
}

/* Footer */
.footer {
    background: #333;
    color: #fff;
    padding: 50px 0 20px;
    margin-top: 50px;
}

.footer h4 {
    color: #fff;
    margin-bottom: 20px;
}

.footer .social-links a {
    display: inline-block;
    width: 40px;
    height: 40px;
    background: #007bff;
    color: #fff;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    margin-right: 10px;
    transition: all 0.3s ease;
}

.footer .social-links a:hover {
    background: #0056b3;
    transform: translateY(-5px);
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section {
        padding: 100px 0;
    }
    
    .hero-section h1 {
        font-size: 2rem;
    }
}
```

---

### **LANGKAH 6: Buat JavaScript**

#### **File: `public/template/frontend/gereja-modern/desktop/js/main.js`**

```javascript
/**
 * GEREJA MODERN THEME
 * Main JavaScript File
 */

(function($) {
    'use strict';

    // Preloader
    $(window).on('load', function() {
        $('.preloader').fadeOut('slow');
    });

    // Smooth Scroll
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        var target = $(this.hash);
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 70
            }, 1000);
        }
    });

    // Navbar Scroll
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.navbar').addClass('navbar-scrolled');
        } else {
            $('.navbar').removeClass('navbar-scrolled');
        }
    });

    // Back to Top Button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });

    $('.back-to-top').click(function() {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });

})(jQuery);
```

---

### **LANGKAH 7: Insert ke Database**

```sql
INSERT INTO `template` (
    `nama`, 
    `pembuat`, 
    `folder`, 
    `status`, 
    `id`, 
    `ket`, 
    `img`, 
    `jtema`, 
    `hplogo`, 
    `wllogo`, 
    `hpbanner`, 
    `wlbanner`, 
    `verbost`, 
    `duatema`, 
    `warna_topbar`, 
    `sidebar_mode`, 
    `video_bag`
) VALUES (
    'Gereja Modern',           -- nama
    'Your Name',               -- pembuat
    'gereja-modern',           -- folder
    0,                         -- status (0=inactive, 1=active)
    1,                         -- id
    'Tema Modern untuk Gereja', -- ket
    'default.png',             -- img
    1,                         -- jtema (1=frontend, 0=backend)
    90,                        -- hplogo (tinggi logo)
    375,                       -- wllogo (lebar logo)
    600,                       -- hpbanner (tinggi banner)
    1800,                      -- wlbanner (lebar banner)
    '1',                       -- verbost
    0,                         -- duatema
    '-',                       -- warna_topbar
    0,                         -- sidebar_mode
    NULL                       -- video_bag
);
```

---

### **LANGKAH 8: Aktifkan Tema**

#### **Via Dashboard Admin:**

1. Login ke admin
2. Menu **Pengaturan** → **Template**
3. Cari tema **"Gereja Modern"**
4. Klik tombol **"Aktifkan"**
5. Refresh website

#### **Via Database:**

```sql
-- Reset semua tema frontend ke inactive
UPDATE template SET status = 0 WHERE jtema = 1;

-- Aktifkan tema baru
UPDATE template SET status = 1 WHERE folder = 'gereja-modern' AND jtema = 1;
```

---

## 🎨 Customisasi Tema

### **1. Ubah Warna Utama**

Edit `style.css`:

```css
:root {
    --primary-color: #007bff;
    --secondary-color: #6c757d;
    --success-color: #28a745;
    --danger-color: #dc3545;
}

/* Gunakan variabel */
.btn-primary {
    background-color: var(--primary-color);
}
```

### **2. Tambah Font Custom**

Tambahkan di `template-frontend.php`:

```html
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
```

Edit `style.css`:

```css
body {
    font-family: 'Poppins', sans-serif;
}
```

### **3. Tambah Halaman Custom**

Buat file baru: `app/Views/frontend/gereja-modern/desktop/content/tentang.php`

```php
<?= $this->extend('frontend/' . esc($folder) . '/desktop/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop/v_menu') ?>

<?= $this->section('content'); ?>

<section class="tentang-section py-5">
    <div class="container">
        <h1>Tentang Kami</h1>
        <p>Konten tentang gereja...</p>
    </div>
</section>

<?= $this->endSection() ?>
```

---

## ✅ Checklist Membuat Tema

- [ ] Buat folder struktur
- [ ] Buat `template-frontend.php`
- [ ] Buat `v_menu.php`
- [ ] Buat `v_home.php`
- [ ] Buat `style.css`
- [ ] Buat `main.js`
- [ ] Insert ke database
- [ ] Upload screenshot tema
- [ ] Test di berbagai browser
- [ ] Test responsive
- [ ] Aktifkan tema

---

## 📞 Support

**Dokumentasi Lengkap:**
- Website: https://ikasmedia.net
- WhatsApp: 081 353 967 028

---

**Selamat membuat tema! 🎨**

**Update:** 7 Oktober 2025
