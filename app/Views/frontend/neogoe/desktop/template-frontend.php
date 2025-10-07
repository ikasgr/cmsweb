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
        
        /* Top Bar */
        .top-bar {
            font-size: 13px;
        }
        .top-bar a {
            color: #fff;
            text-decoration: none;
        }
        .top-bar a:hover {
            color: #ddd;
        }
        
        /* Back to Top */
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
