# 🎨 Panduan Instalasi Tema NeoGoe

## 📋 Tentang Tema NeoGoe

**NeoGoe** adalah tema modern dan profesional untuk CMS Datagoe/Ikasmedia yang cocok untuk:
- Website Pemerintahan
- Instansi/Dinas
- Company Profile
- Organisasi
- Yayasan

**Demo:** https://neogoe.datagoe.com/

---

## ✨ Fitur Tema NeoGoe

### **Design:**
- ✅ Modern & Clean
- ✅ Responsive (Mobile, Tablet, Desktop)
- ✅ Professional Layout
- ✅ Mega Menu Support
- ✅ Smooth Animations

### **Komponen:**
- ✅ Hero Slider
- ✅ Berita Grid/List
- ✅ Galeri Foto & Video
- ✅ Infografis Slider
- ✅ Transparansi Anggaran
- ✅ Data Pegawai
- ✅ E-book Section
- ✅ Survei & Interaksi
- ✅ Social Media Integration

### **Teknologi:**
- Bootstrap 4.6
- Font Awesome 5
- jQuery 3.6
- Slick Carousel
- AOS Animation
- Lightbox Gallery

---

## 🚀 Instalasi

### **LANGKAH 1: Cek Folder Assets**

Pastikan folder ini sudah ada:
```
public/template/frontend/neogoe/desktop/
```

Jika belum ada, download dari:
- https://datagoe.com/themes/neogoe.zip
- https://ikasmedia.net/themes/neogoe.zip

### **LANGKAH 2: Buat Folder Views**

```bash
mkdir -p app/Views/frontend/neogoe/desktop/content
mkdir -p app/Views/frontend/neogoe/mobile
```

### **LANGKAH 3: Buat File Template Utama**

Buat file: `app/Views/frontend/neogoe/desktop/template-frontend.php`

(Kode lengkap ada di bagian bawah)

### **LANGKAH 4: Buat File Menu**

Buat file: `app/Views/frontend/neogoe/desktop/v_menu.php`

(Kode lengkap ada di bagian bawah)

### **LANGKAH 5: Buat File Homepage**

Buat file: `app/Views/frontend/neogoe/desktop/v_home.php`

(Kode lengkap ada di bagian bawah)

### **LANGKAH 6: Insert/Update Database**

```sql
-- Cek apakah tema neogoe sudah ada
SELECT * FROM template WHERE folder = 'neogoe';

-- Jika belum ada, insert:
INSERT INTO `template` (
    `nama`, `pembuat`, `folder`, `status`, `id`, 
    `ket`, `img`, `jtema`, 
    `hplogo`, `wllogo`, `hpbanner`, `wlbanner`, 
    `verbost`, `duatema`, `warna_topbar`, `sidebar_mode`, `video_bag`
) VALUES (
    'NeoGoe',                  -- nama
    'Datagoe',                 -- pembuat
    'neogoe',                  -- folder
    0,                         -- status (0=inactive, 1=active)
    1,                         -- id
    'Tema Modern NeoGoe',      -- keterangan
    'neogoe.jpg',              -- screenshot
    1,                         -- jtema (1=frontend)
    60, 200,                   -- ukuran logo (tinggi, lebar)
    600, 1800,                 -- ukuran banner (tinggi, lebar)
    '1', 0, '#2c3e50', 0, NULL
);

-- Jika sudah ada, update:
UPDATE template 
SET nama = 'NeoGoe', 
    pembuat = 'Datagoe',
    ket = 'Tema Modern NeoGoe',
    hplogo = 60,
    wllogo = 200
WHERE folder = 'neogoe' AND jtema = 1;
```

### **LANGKAH 7: Aktifkan Tema**

**Via Admin:**
1. Login admin
2. Menu **Pengaturan** → **Template**
3. Cari tema **"NeoGoe"**
4. Klik tombol **"Aktifkan"**

**Via Database:**
```sql
-- Reset semua tema frontend
UPDATE template SET status = 0 WHERE jtema = 1;

-- Aktifkan NeoGoe
UPDATE template SET status = 1 WHERE folder = 'neogoe' AND jtema = 1;
```

### **LANGKAH 8: Clear Cache**

```bash
# Via command line
php spark cache:clear

# Via browser
http://domain.com/clearcache
```

---

## 📄 Kode File Template

### **File 1: template-frontend.php**

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?= isset($deskripsi) ? esc($deskripsi) : esc($konfigurasi->deskripsi) ?>">
    <meta name="keywords" content="<?= esc($konfigurasi->nama) ?>">
    <meta name="author" content="<?= esc($konfigurasi->nama) ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= isset($title) ? esc($title) : esc($konfigurasi->nama) ?>">
    <meta property="og:description" content="<?= isset($deskripsi) ? esc($deskripsi) : esc($konfigurasi->deskripsi) ?>">
    <meta property="og:image" content="<?= isset($img) ? $img : base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)) ?>">
    <meta property="og:url" content="<?= isset($url) ? $url : base_url() ?>">
    
    <!-- Title -->
    <title><?= isset($title) ? esc($title) : esc($konfigurasi->nama) ?></title>
    
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url('/public/img/konfigurasi/icon/' . esc($konfigurasi->icon)) ?>">
    
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    
    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . $folder . '/desktop/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . $folder . '/desktop/css/custom.css') ?>">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
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
        .preloader .loader {
            width: 80px;
            height: 80px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #2c3e50;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    
    <!-- Top Bar -->
    <div class="top-bar bg-dark text-white py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <small>
                        <i class="fas fa-envelope"></i> <?= esc($konfigurasi->email) ?>
                        <span class="mx-2">|</span>
                        <i class="fas fa-phone"></i> <?= esc($konfigurasi->no_telp) ?>
                    </small>
                </div>
                <div class="col-md-6 text-right">
                    <small>
                        <?php if ($konfigurasi->facebook) : ?>
                            <a href="<?= esc($konfigurasi->facebook) ?>" target="_blank" class="text-white mx-1">
                                <i class="fab fa-facebook"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($konfigurasi->instagram) : ?>
                            <a href="<?= esc($konfigurasi->instagram) ?>" target="_blank" class="text-white mx-1">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($konfigurasi->youtube) : ?>
                            <a href="<?= esc($konfigurasi->youtube) ?>" target="_blank" class="text-white mx-1">
                                <i class="fab fa-youtube"></i>
                            </a>
                        <?php endif; ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Menu -->
    <?= $this->renderSection('v_menu') ?>
    
    <!-- Main Content -->
    <main id="main">
        <?= $this->renderSection('content') ?>
    </main>
    
    <!-- Footer -->
    <footer class="footer bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3"><?= esc($konfigurasi->nama) ?></h5>
                    <p><?= esc($konfigurasi->deskripsi) ?></p>
                    <div class="social-links mt-3">
                        <?php if ($konfigurasi->facebook) : ?>
                            <a href="<?= esc($konfigurasi->facebook) ?>" target="_blank" class="btn btn-sm btn-outline-light mr-2">
                                <i class="fab fa-facebook"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($konfigurasi->instagram) : ?>
                            <a href="<?= esc($konfigurasi->instagram) ?>" target="_blank" class="btn btn-sm btn-outline-light mr-2">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($konfigurasi->youtube) : ?>
                            <a href="<?= esc($konfigurasi->youtube) ?>" target="_blank" class="btn btn-sm btn-outline-light mr-2">
                                <i class="fab fa-youtube"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Kontak</h5>
                    <p>
                        <i class="fas fa-map-marker-alt"></i> <?= esc($konfigurasi->alamat) ?><br>
                        <i class="fas fa-phone mt-2"></i> <?= esc($konfigurasi->no_telp) ?><br>
                        <i class="fas fa-envelope mt-2"></i> <?= esc($konfigurasi->email) ?>
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Link Terkait</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('berita') ?>" class="text-white-50">Berita</a></li>
                        <li><a href="<?= base_url('pengumuman') ?>" class="text-white-50">Pengumuman</a></li>
                        <li><a href="<?= base_url('agenda') ?>" class="text-white-50">Agenda</a></li>
                        <li><a href="<?= base_url('foto') ?>" class="text-white-50">Galeri Foto</a></li>
                    </ul>
                </div>
            </div>
            <hr class="bg-secondary">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="mb-0">&copy; <?= date('Y') ?> <?= esc($konfigurasi->nama) ?>. All Rights Reserved.</p>
                    <p class="mb-0"><small>Powered by <a href="https://datagoe.com" target="_blank" class="text-white-50">Datagoe</a> | <a href="https://ikasmedia.net" target="_blank" class="text-white-50">Ikasmedia</a></small></p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top -->
    <a href="#" class="back-to-top">
        <i class="fas fa-chevron-up"></i>
    </a>
    
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    
    <!-- Theme JS -->
    <script src="<?= base_url('/public/template/frontend/' . $folder . '/desktop/js/main.js') ?>"></script>
    
    <script>
        $(document).ready(function() {
            // Hide preloader
            $(".preloader").fadeOut("slow");
            
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true
            });
            
            // Back to top
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('.back-to-top').fadeIn();
                } else {
                    $('.back-to-top').fadeOut();
                }
            });
            
            $('.back-to-top').click(function(e) {
                e.preventDefault();
                $('html, body').animate({scrollTop: 0}, 800);
            });
        });
    </script>
</body>
</html>
```

### **File 2: v_menu.php**

```php
<?= $this->section('v_menu'); ?>

<?php
$konfigurasi = $this->konfigurasi->vkonfig();
$template = $this->template->tempaktif();
$mainmenu = $this->menu->mainmenu();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
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
                        <i class="fas fa-home"></i> HOME
                    </a>
                </li>
                
                <!-- Menu Profil -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        PROFIL
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url('page/visi-dan-misi') ?>">Visi dan Misi</a>
                        <a class="dropdown-item" href="<?= base_url('page/struktur-organisasi') ?>">Struktur Organisasi</a>
                        <a class="dropdown-item" href="<?= base_url('page/tugas-pokok-dan-fungsi') ?>">Tugas Pokok dan Fungsi</a>
                        <a class="dropdown-item" href="<?= base_url('pegawai') ?>">Data Pegawai</a>
                    </div>
                </li>
                
                <!-- Menu Berita -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('berita') ?>">BERITA</a>
                </li>
                
                <!-- Menu Informasi -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        INFORMASI
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url('layanan') ?>">Layanan</a>
                        <a class="dropdown-item" href="<?= base_url('pengumuman') ?>">Pengumuman</a>
                        <a class="dropdown-item" href="<?= base_url('agenda') ?>">Agenda</a>
                        <a class="dropdown-item" href="<?= base_url('bankdata') ?>">Bank Data</a>
                        <a class="dropdown-item" href="<?= base_url('produkhukum') ?>">Produk Hukum</a>
                        <a class="dropdown-item" href="<?= base_url('infografis') ?>">Infografis</a>
                        <a class="dropdown-item" href="<?= base_url('transparansi') ?>">Transparansi Anggaran</a>
                    </div>
                </li>
                
                <!-- Menu Galeri -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        GALERI
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url('foto') ?>">Foto</a>
                        <a class="dropdown-item" href="<?= base_url('video') ?>">Video</a>
                    </div>
                </li>
                
                <!-- Menu Interaksi -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        INTERAKSI
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url('survey') ?>">Survei</a>
                        <a class="dropdown-item" href="<?= base_url('masukansaran') ?>">Masukan Saran</a>
                        <a class="dropdown-item" href="<?= base_url('bukutamu') ?>">Buku Tamu</a>
                    </div>
                </li>
                
                <!-- Menu E-Book -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('ebook') ?>">E-BOOK</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
.navbar {
    transition: all 0.3s ease;
}

.navbar-brand img {
    transition: all 0.3s ease;
}

.nav-link {
    font-weight: 500;
    font-size: 14px;
    padding: 0.5rem 1rem !important;
    transition: all 0.3s ease;
}

.nav-link:hover {
    color: #2c3e50 !important;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.dropdown-item {
    padding: 0.5rem 1.5rem;
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background-color: #2c3e50;
    color: #fff;
}

.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: #2c3e50;
    color: #fff;
    text-align: center;
    line-height: 50px;
    border-radius: 50%;
    display: none;
    z-index: 999;
    transition: all 0.3s ease;
}

.back-to-top:hover {
    background: #1a252f;
    color: #fff;
    text-decoration: none;
    transform: translateY(-5px);
}
</style>

<?= $this->endSection(); ?>
```

### **File 3: v_home.php**

```php
<?= $this->extend('frontend/' . esc($folder) . '/desktop/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop/v_menu') ?>

<?= $this->section('content'); ?>

<!-- Hero Slider -->
<?php if ($banner) : ?>
<section class="hero-slider">
    <div id="heroCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php foreach ($banner as $key => $value) : ?>
                <li data-target="#heroCarousel" data-slide-to="<?= $key ?>" class="<?= ($key == 0) ? 'active' : '' ?>"></li>
            <?php endforeach; ?>
        </ol>
        <div class="carousel-inner">
            <?php foreach ($banner as $key => $value) : ?>
                <div class="carousel-item <?= ($key == 0) ? 'active' : '' ?>">
                    <img src="<?= base_url('/public/img/banner/' . esc($value['banner_image'])) ?>" 
                         class="d-block w-100" alt="Banner">
                    <div class="carousel-caption">
                        <h2 data-aos="fade-up"><?= esc($konfigurasi->nama) ?></h2>
                        <p data-aos="fade-up" data-aos-delay="200"><?= esc($konfigurasi->deskripsi) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</section>
<?php endif; ?>

<!-- Berita Terbaru -->
<section class="berita-section py-5">
    <div class="container">
        <div class="section-title text-center mb-4" data-aos="fade-up">
            <h2>Berita Terbaru</h2>
            <div class="title-divider"></div>
        </div>
        <div class="row">
            <?php if ($berita4) : ?>
                <?php foreach ($berita4 as $berita) : ?>
                    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card h-100 shadow-sm">
                            <img src="<?= base_url('/public/img/informasi/berita/' . esc($berita['gambar'])) ?>" 
                                 class="card-img-top" alt="<?= esc($berita['judul_berita']) ?>"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <small class="text-muted">
                                    <i class="fas fa-calendar"></i> <?= date_indo($berita['tgl_berita']) ?>
                                </small>
                                <h5 class="card-title mt-2"><?= esc($berita['judul_berita']) ?></h5>
                                <p class="card-text"><?= substr(esc($berita['ringkasan']), 0, 100) ?>...</p>
                                <a href="<?= base_url($berita['slug_berita']) ?>" class="btn btn-sm btn-primary">
                                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?= base_url('berita') ?>" class="btn btn-primary">
                Lihat Semua Berita <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<style>
.hero-slider {
    position: relative;
}

.hero-slider .carousel-item {
    height: 500px;
}

.hero-slider .carousel-item img {
    height: 100%;
    object-fit: cover;
}

.hero-slider .carousel-caption {
    background: rgba(0,0,0,0.5);
    padding: 30px;
    border-radius: 10px;
}

.section-title h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
}

.title-divider {
    width: 60px;
    height: 3px;
    background: #2c3e50;
    margin: 10px auto;
}

.berita-section .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.berita-section .card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
}

@media (max-width: 768px) {
    .hero-slider .carousel-item {
        height: 300px;
    }
}
</style>

<?= $this->endSection() ?>
```

---

## 🎨 Customisasi

### **Ubah Warna Tema:**

Edit file CSS atau tambahkan di `custom.css`:

```css
:root {
    --primary-color: #2c3e50;
    --secondary-color: #34495e;
    --accent-color: #3498db;
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.navbar {
    background-color: var(--primary-color) !important;
}
```

### **Ubah Ukuran Logo:**

```sql
UPDATE template 
SET hplogo = 70,    -- tinggi logo (px)
    wllogo = 250    -- lebar logo (px)
WHERE folder = 'neogoe';
```

---

## 📋 Checklist Instalasi

- [ ] Cek folder assets ada
- [ ] Buat folder Views
- [ ] Buat template-frontend.php
- [ ] Buat v_menu.php
- [ ] Buat v_home.php
- [ ] Insert/update database
- [ ] Aktifkan tema
- [ ] Clear cache
- [ ] Test di browser
- [ ] Test responsive

---

## 🔧 Troubleshooting

| Masalah | Solusi |
|---------|--------|
| CSS tidak load | Cek folder `public/template/frontend/neogoe/` |
| Menu tidak muncul | Cek `renderSection('v_menu')` |
| Error 404 | Cek struktur folder `desktop/` |
| Tema tidak aktif | Update status = 1 di database |

---

## 📞 Support

**Dokumentasi:**
- Website: https://datagoe.com
- Website: https://ikasmedia.net
- WhatsApp: 081 353 967 028

---

**Selamat menggunakan Tema NeoGoe! 🎨**

**Update:** 7 Oktober 2025  
**Versi:** 1.0.0
