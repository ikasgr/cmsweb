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

<!-- Informasi Instansi -->
<section class="info-section py-5 bg-light">
    <div class="container">
        <div class="section-title text-center mb-4" data-aos="fade-up">
            <h2>Informasi Instansi</h2>
            <div class="title-divider"></div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="fas fa-bullhorn fa-3x text-primary mb-3"></i>
                        <h5>Pengumuman</h5>
                        <p>Informasi pengumuman terbaru</p>
                        <a href="<?= base_url('pengumuman') ?>" class="btn btn-sm btn-primary">Lihat</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="fas fa-calendar-alt fa-3x text-success mb-3"></i>
                        <h5>Agenda</h5>
                        <p>Jadwal kegiatan dan acara</p>
                        <a href="<?= base_url('agenda') ?>" class="btn btn-sm btn-success">Lihat</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="fas fa-book fa-3x text-info mb-3"></i>
                        <h5>E-Book</h5>
                        <p>Koleksi buku digital</p>
                        <a href="<?= base_url('ebook') ?>" class="btn btn-sm btn-info">Lihat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Majelis Gereja -->
<?php if ($majelis) : ?>
<section class="majelis-section py-5">
    <div class="container">
        <div class="section-title text-center mb-4" data-aos="fade-up">
            <h2>Majelis Gereja</h2>
            <div class="title-divider"></div>
        </div>
        <div class="row">
            <?php foreach (array_slice($majelis, 0, 4) as $peg) : ?>
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card text-center h-100">
                        <img src="<?= base_url('/public/img/informasi/majelis/' . esc($peg['gambar'])) ?>" 
                             class="card-img-top" alt="<?= esc($peg['nama']) ?>"
                             style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h6><?= esc($peg['nama']) ?></h6>
                            <small class="text-muted"><?= esc($peg['jenis_jabatan']) ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?= base_url('majelis-gereja') ?>" class="btn btn-primary">
                Lihat Semua Majelis <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Galeri Foto -->
<?php if ($foto8) : ?>
<section class="galeri-section py-5 bg-light">
    <div class="container">
        <div class="section-title text-center mb-4" data-aos="fade-up">
            <h2>Galeri Foto</h2>
            <div class="title-divider"></div>
        </div>
        <div class="row">
            <?php foreach (array_slice($foto8, 0, 4) as $foto) : ?>
                <div class="col-md-3 mb-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <img src="<?= base_url('/public/img/galeri/foto/thumb/thumb_' . esc($foto['gambar'])) ?>" 
                             class="card-img-top" alt="<?= esc($foto['judul']) ?>"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <small><?= esc($foto['judul']) ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?= base_url('foto') ?>" class="btn btn-primary">
                Lihat Semua Foto <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Hubungi Kami -->
<section class="contact-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6" data-aos="fade-right">
                <h3>Hubungi Kami</h3>
                <p><?= esc($konfigurasi->deskripsi) ?></p>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-map-marker-alt text-primary"></i>
                        <strong>Alamat:</strong> <?= esc($konfigurasi->alamat) ?>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-phone text-primary"></i>
                        <strong>Telepon:</strong> <?= esc($konfigurasi->no_telp) ?>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-envelope text-primary"></i>
                        <strong>Email:</strong> <?= esc($konfigurasi->email) ?>
                    </li>
                </ul>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <?php if ($konfigurasi->google_map) : ?>
                    <div class="map-container">
                        <?= $konfigurasi->google_map ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
/* Hero Slider */
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

/* Section Title */
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

/* Cards */
.berita-section .card,
.info-section .card,
.majelis-section .card,
.galeri-section .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.berita-section .card:hover,
.info-section .card:hover,
.majelis-section .card:hover,
.galeri-section .card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
}

/* Map Container */
.map-container iframe {
    width: 100%;
    height: 300px;
    border-radius: 10px;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-slider .carousel-item {
        height: 300px;
    }
    
    .section-title h2 {
        font-size: 1.5rem;
    }
}
</style>

<?= $this->endSection() ?>
