<?= $this->extend('frontend/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/desktop' . '/v_menu') ?>

<?= $this->section('content'); ?>

<?php
$db = \Config\Database::connect();
?>

<!-- ================================================== -->
<!-- CUSTOM STYLES FOR CHURCH THEME -->
<!-- ================================================== -->
<style>
    /* Hero Section */
    .hero-section {
        position: relative;
        height: 85vh;
        min-height: 500px;
        background-color: #000;
        overflow: hidden;
    }

    .hero-slide {
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.6));
    }

    .hero-content {
        position: absolute;
        bottom: 20%;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        color: #fff;
        width: 80%;
        z-index: 2;
    }

    .hero-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 800;
        font-size: 3.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .hero-subtitle {
        font-family: 'Open Sans', sans-serif;
        font-size: 1.2rem;
        margin-bottom: 2rem;
        font-weight: 300;
    }

    /* Section Styling */
    .section-padding {
        padding: 5rem 0;
    }

    .section-header-church {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-header-church h2 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        color: #101820;
        text-transform: uppercase;
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .section-header-church .separator {
        width: 80px;
        height: 4px;
        background-color: #D4AF37;
        /* Church Gold */
        margin: 0 auto;
        border-radius: 2px;
    }

    /* Welcome Section */
    .welcome-text {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
    }

    /* Cards */
    .church-card {
        background: #fff;
        border: none;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        height: 100%;
    }

    .church-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* Ministries */
    .ministry-icon-box {
        text-align: center;
        padding: 2rem;
    }

    .ministry-icon {
        width: 70px;
        height: 70px;
        margin-bottom: 1.5rem;
        object-fit: contain;
    }

    /* Schedule */
    .schedule-item {
        border-left: 4px solid #D4AF37;
        background: #f8f9fa;
        margin-bottom: 1rem;
        transition: 0.2s;
    }

    .schedule-item:hover {
        background: #fff;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .date-box {
        background: #101820;
        color: #D4AF37;
        width: 70px;
        text-align: center;
        padding: 10px;
        font-weight: bold;
    }

    /* Buttons */
    .btn-gold {
        background-color: #D4AF37;
        color: #fff;
        border: none;
        padding: 12px 30px;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 1px;
        border-radius: 50px;
        transition: 0.3s;
    }

    .btn-gold:hover {
        background-color: #b5952f;
        color: #fff;
        transform: translateY(-2px);
    }

    .btn-dark-church {
        background-color: #101820;
        color: #fff;
        border: none;
        padding: 12px 30px;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 1px;
        border-radius: 50px;
        transition: 0.3s;
    }

    .btn-dark-church:hover {
        background-color: #2c3e50;
        color: #fff;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }

        .hero-section {
            height: 60vh;
        }
    }
</style>

<!-- ================================================== -->
<!-- HERO SECTION -->
<!-- ================================================== -->
<section class="p-0">
    <?php if ($banner) { ?>
        <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000">
            <div class="carousel-inner">
                <?php $no = 0;
                foreach ($banner as $key => $value) {
                    $active = ($no == 0) ? 'active' : '';
                    $img_src = base_url('/public/img/banner/' . esc($value['banner_image']));
                    ?>
                    <div class="carousel-item <?= $active ?> hero-section">
                        <div class="hero-slide" style="background-image: url('<?= $img_src ?>');"></div>
                        <div class="hero-overlay"></div>
                        <div class="hero-content">
                            <h1 class="hero-title animate__animated animate__fadeInDown">
                                <?= esc($konfigurasi->nama_web ?? 'Selamat Datang') ?>
                            </h1>
                            <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                                Melayani dengan Kasih, Membangun iman.
                            </p>
                            <div class="animate__animated animate__fadeInUp animate__delay-1s">
                                <a href="<?= base_url('jadwal') ?>" class="btn btn-gold mr-3">Jadwal Ibadah</a>
                                <a href="<?= base_url('profil') ?>"
                                    class="btn btn-outline-light rounded-pill px-4 py-2 font-weight-bold text-uppercase">Tentang
                                    Kami</a>
                            </div>
                        </div>
                    </div>
                    <?php $no++;
                } ?>
            </div>
            <?php if (count($banner) > 1): ?>
                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
            <?php endif; ?>
        </div>
    <?php } else { ?>
        <!-- Fallback Hero -->
        <div class="hero-section">
            <div class="hero-slide" style="background-color: #101820;"></div>
            <div class="hero-content">
                <h1 class="hero-title">Selamat Datang</h1>
                <p class="hero-subtitle">Gereja Kami</p>
            </div>
        </div>
    <?php } ?>
</section>

<!-- ================================================== -->
<!-- RUNNING TEXT / PENGUMUMAN -->
<!-- ================================================== -->
<?php if ($konfigurasi->sts_rt == '1') { ?>
    <div style="background-color: #101820; color: #fff; padding: 10px 0;">
        <div class="container d-flex align-items-center">
            <div class="badge badge-warning text-dark mr-3 px-3 py-2 text-uppercase font-weight-bold">Pengumuman</div>
            <div class="flex-grow-1 overflow-hidden">
                <marquee onMouseOver="this.stop()" onMouseOut="this.start()" scrollamount="6">
                    <?php if ($pengumuman) {
                        foreach ($pengumuman as $data) { ?>
                            <span class="mr-5"><i class="fas fa-bullhorn text-warning"></i> &nbsp;
                                <?= date_indo($data['tgl_informasi']) ?> -
                                <a href="#" onclick="lihatpengumuman('<?= $data['informasi_id'] ?>')"
                                    class="text-white text-decoration-none"><?= esc($data['nama']) ?></a>
                            </span>
                        <?php }
                    } else {
                        echo "Selamat Datang di Website Resmi Kami.";
                    } ?>
                </marquee>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ================================================== -->
<!-- WELCOME & INTRO -->
<!-- ================================================== -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h4 class="text-warning text-uppercase font-weight-bold mb-2"
                    style="font-size: 0.9rem; letter-spacing: 2px;">Shalom!</h4>
                <h2 class="font-weight-bold mb-4" style="font-family: 'Montserrat'; color: #101820; font-size: 2.5rem;">
                    Selamat Datang di <br><span style="color: #D4AF37;"><?= esc($konfigurasi->nama_web) ?></span>
                </h2>
                <div class="welcome-text">
                    <p>
                        <?= $konfigurasi->deskripsi ?? 'Merupakan sukacita bagi kami untuk menyambut Anda. Kami adalah komunitas yang percaya akan kuasa kasih Tuhan dan berkomitmen untuk melayani sesama. Mari bertumbuh bersama dalam iman.' ?>
                    </p>
                </div>
                <div class="mt-4">
                    <a href="<?= base_url('profil') ?>" class="btn btn-dark-church">Selengkapnya</a>
                </div>

                <!-- Bible Verse Quote -->
                <div class="mt-5 p-3" style="border-left: 4px solid #D4AF37; background: #f9f9f9;">
                    <i class="fas fa-quote-left text-muted mb-2"></i>
                    <p class="font-italic mb-0 text-dark font-weight-bold">
                        "<?= strip_tags($konfigurasi->katamutiara ?? 'Sebab di mana dua atau tiga orang berkumpul dalam Nama-Ku, di situ Aku ada di tengah-tengah mereka.') ?>"
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Video/Image Feature -->
                <div class="position-relative p-3" style="border: 2px solid #D4AF37; border-radius: 8px;">
                    <img src="<?= base_url('public/img/banner/' . ($banner[0]['banner_image'] ?? 'banner1.png')) ?>"
                        class="img-fluid rounded shadow w-100" style="object-fit: cover; min-height: 400px;"
                        alt="Gereja">
                    <?php if (!empty($konfigurasi->banner_video)): ?>
                        <div class="position-absolute" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <a href="<?= $konfigurasi->banner_video ?>" class="video-popup">
                                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                    style="width: 80px; height: 80px;">
                                    <i class="fas fa-play text-warning fa-2x"></i>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================================================== -->
<!-- JADWAL IBADAH / UPCOMING EVENTS -->
<!-- ================================================== -->
<section class="section-padding" style="background-color: #f4f6f9;">
    <div class="container">
        <div class="row">
            <!-- Left: Upcoming Schedule -->
            <div class="col-lg-7 mb-4">
                <div class="section-header-church text-left">
                    <h2 style="font-size: 1.8rem;">Jadwal Ibadah & Kegiatan</h2>
                    <div class="separator ml-0"></div>
                </div>

                <?php if (!empty($jadwal_upcoming)): ?>
                    <div class="list-group">
                        <?php foreach ($jadwal_upcoming as $jadwal): ?>
                            <div class="schedule-item d-flex align-items-center p-3 rounded">
                                <div class="date-box rounded mr-4">
                                    <div style="font-size: 1.5rem; line-height: 1;">
                                        <?= date('d', strtotime($jadwal['tanggal'])) ?>
                                    </div>
                                    <div style="font-size: 0.8rem; text-transform: uppercase;">
                                        <?= strftime('%b', strtotime($jadwal['tanggal'])) ?>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-md-flex justify-content-between">
                                        <h5 class="font-weight-bold mb-1 text-dark"><?= esc($jadwal['judul_jadwal']) ?></h5>
                                        <span
                                            class="badge badge-primary px-2 py-1 align-self-start"><?= esc($jadwal['jenis_pelayanan']) ?></span>
                                    </div>
                                    <p class="mb-0 text-muted small">
                                        <i class="far fa-clock text-warning"></i>
                                        <?= date('H:i', strtotime($jadwal['waktu_mulai'])) ?> WIB &nbsp;
                                        <i class="fas fa-map-marker-alt text-danger ml-2"></i> <?= esc($jadwal['tempat']) ?>
                                    </p>
                                    <?php if ($jadwal['pengkhotbah']): ?>
                                        <small class="text-dark font-italic"><i class="fas fa-user-tie text-muted"></i>
                                            <?= esc($jadwal['pengkhotbah']) ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-light">Belum ada jadwal ibadah terdekat.</div>
                <?php endif; ?>

                <div class="mt-4">
                    <a href="<?= base_url('jadwal') ?>" class="btn btn-outline-dark rounded-pill">Lihat Semua Jadwal <i
                            class="fas fa-arrow-right ml-1"></i></a>
                </div>
            </div>

            <!-- Right: Featured Content / Renungan / Information -->
            <div class="col-lg-5">
                <div class="card church-card p-4 h-100 bg-white" style="border-top: 5px solid #101820;">
                    <h4 class="font-weight-bold mb-3" style="font-family: 'Montserrat';">Warta & Renungan</h4>
                    <hr>
                    <?php if ($beritautama): ?>
                        <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php $n = 0;
                                foreach ($beritautama as $berita):
                                    $n++;
                                    $active = ($n == 1) ? 'active' : '';
                                    $img_berita = base_url('/public/img/informasi/berita/' . esc($berita['gambar']));
                                    ?>
                                    <div class="carousel-item <?= $active ?>">
                                        <div class="position-relative mb-3">
                                            <img src="<?= $img_berita ?>" class="img-fluid rounded w-100"
                                                style="height: 200px; object-fit: cover;"
                                                alt="<?= esc($berita['judul_berita']) ?>">
                                            <div class="badge badge-warning position-absolute" style="top: 10px; right: 10px;">
                                                <?= esc($berita['nama_kategori']) ?>
                                            </div>
                                        </div>
                                        <h5 class="font-weight-bold mb-2">
                                            <a href="<?= base_url($berita['slug_berita']) ?>"
                                                class="text-dark text-decoration-none"><?= esc($berita['judul_berita']) ?></a>
                                        </h5>
                                        <small class="text-muted d-block mb-3"><i class="far fa-calendar"></i>
                                            <?= date_indo($berita['tgl_berita']) ?></small>
                                        <p class="text-secondary small">
                                            <?= substr(strip_tags($berita['ringkasan']), 0, 100) ?>...
                                        </p>
                                        <a href="<?= base_url($berita['slug_berita']) ?>"
                                            class="btn btn-sm btn-link pl-0 text-warning font-weight-bold">BACA SELENGKAPNYA</a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="mt-2 text-right">
                                <a class="btn btn-sm btn-dark rounded-circle" href="#newsCarousel" role="button"
                                    data-slide="prev"><i class="fas fa-chevron-left"></i></a>
                                <a class="btn btn-sm btn-dark rounded-circle" href="#newsCarousel" role="button"
                                    data-slide="next"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Belum ada warta terbaru.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================================================== -->
<!-- MINISTRIES / LAYANAN -->
<!-- ================================================== -->
<?php if ($konfigurasi->sts_section == '1' && $section) { ?>
    <section class="section-padding bg-white">
        <div class="container">
            <div class="section-header-church">
                <h2>Pelayanan Kami</h2>
                <div class="separator"></div>
                <p class="text-muted mt-2">Bergabung dan bertumbuh dalam berbagai wadah pelayanan</p>
            </div>

            <div class="row justify-content-center">
                <?php foreach ($section as $data) {
                    $link = ($data['linksumber'] == 'N') ? base_url(esc($data['link'])) : esc($data['link']);
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <a href="<?= $link ?>" class="text-decoration-none">
                            <div class="church-card ministry-icon-box h-100">
                                <img src="<?= base_url('/public/img/section/' . esc($data['gambar'])) ?>" class="ministry-icon"
                                    alt="<?= esc($data['nama_section']) ?>">
                                <h5 class="font-weight-bold text-dark"><?= esc($data['nama_section']) ?></h5>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<!-- ================================================== -->
<!-- BERITA TERBARU GRID -->
<!-- ================================================== -->
<?php if ($berita4): ?>
    <section class="section-padding" style="background: #fff; border-top: 1px solid #eee;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h2 class="font-weight-bold text-dark mb-0" style="font-family: 'Montserrat';">Kabar Gereja</h2>
                    <div style="width: 60px; height: 3px; background: #D4AF37; margin-top: 10px;"></div>
                </div>
                <a href="<?= base_url('berita') ?>" class="text-muted font-weight-bold small">LIHAT SEMUA <i
                        class="fas fa-long-arrow-alt-right ml-1"></i></a>
            </div>

            <div class="row">
                <?php foreach ($berita4 as $data) { ?>
                    <div class="col-md-3 mb-4">
                        <div class="card church-card h-100 p-0">
                            <div class="overflow-hidden">
                                <a href="<?= base_url($data['slug_berita']) ?>">
                                    <img src="<?= base_url('/public/img/informasi/berita/' . esc($data['gambar'])) ?>"
                                        class="card-img-top"
                                        style="height: 180px; object-fit: cover; transition: transform 0.5s;"
                                        alt="<?= esc($data['judul_berita']) ?>">
                                </a>
                            </div>
                            <div class="card-body">
                                <small
                                    class="text-warning font-weight-bold text-uppercase"><?= esc($data['nama_kategori']) ?></small>
                                <h6 class="card-title font-weight-bold mt-2 mb-2"
                                    style="font-family: 'Montserrat'; font-size: 1rem; line-height: 1.4;">
                                    <a href="<?= base_url($data['slug_berita']) ?>"
                                        class="text-dark text-decoration-none"><?= esc($data['judul_berita']) ?></a>
                                </h6>
                                <small class="text-muted"><i class="far fa-clock"></i>
                                    <?= date_indo($data['tgl_berita']) ?></small>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- ================================================== -->
<!-- COUNTER STATS -->
<!-- ================================================== -->
<?php if ($konfigurasi->sts_count == '1' && $counter) { ?>
    <section class="py-5 bg-dark text-white" style="position: relative;">
        <div class="container">
            <div class="row text-center">
                <?php foreach ($counter as $value) { ?>
                    <div class="col-md-3 col-6 mb-4 mb-md-0">
                        <div class="py-3">
                            <h2 class="display-4 font-weight-bold text-warning mb-0" data-purecounter-start="0"
                                data-purecounter-end="<?= $value['jm'] ?>" data-purecounter-duration="2"><?= $value['jm'] ?>
                            </h2>
                            <h6 class="text-uppercase letter-spacing-2 mt-2" style="letter-spacing: 1px;">
                                <?= esc($value['nm']) ?>
                            </h6>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<!-- ================================================== -->
<!-- MAJELIS / LEADERSHIP SLIDER -->
<!-- ================================================== -->
<?php if ($majelis): ?>
    <section class="section-padding bg-light">
        <div class="container">
            <div class="section-header-church">
                <h2>Majelis Jemaat</h2>
                <div class="separator"></div>
            </div>

            <div class="owl-carousel owl-theme" id="majelisSlider">
                <?php foreach ($majelis as $data):
                    $img_majelis = !empty($data['gambar']) ? base_url('/public/img/informasi/majelis/' . esc($data['gambar'])) : base_url('/public/img/user/default.png');
                    ?>
                    <div class="item p-3">
                        <div class="bg-white rounded shadow-sm p-4 text-center h-100 border-bottom-warning">
                            <img src="<?= $img_majelis ?>" class="rounded-circle mx-auto mb-3 shadow"
                                style="width: 100px; height: 100px; object-fit: cover;" alt="<?= esc($data['nama']) ?>">
                            <h6 class="font-weight-bold text-dark"><?= esc($data['nama']) ?></h6>
                            <small class="text-muted text-uppercase"><?= esc($data['jenis_jabatan']) ?></small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('#majelisSlider').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                responsive: {
                    0: { items: 1 },
                    600: { items: 2 },
                    1000: { items: 4 }
                }
            })
        });
    </script>
<?php endif; ?>

<?= $this->endSection() ?>