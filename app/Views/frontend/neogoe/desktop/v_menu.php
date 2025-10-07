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
</style>

<?= $this->endSection(); ?>
