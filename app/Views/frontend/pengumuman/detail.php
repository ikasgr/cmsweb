<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>Detail Pengumuman</h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('pengumuman') ?>">Pengumuman</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> News Detail Section Start Here <================== -->
<div class="blog padding--top padding--bottom bg-light">
    <div class="container">
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <article class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <!-- Featured Image -->
                    <?php if (!empty($gambar) && $gambar != 'default.png'): ?>
                        <img src="<?= base_url('public/img/informasi/pengumuman/' . $gambar) ?>" alt="<?= esc($nama) ?>"
                            class="w-100" style="max-height: 500px; object-fit: cover;">
                    <?php endif; ?>

                    <!-- Content -->
                    <div class="p-4 p-md-5">
                        <!-- Badge -->
                        <div class="mb-3">
                            <span class="badge bg-danger">
                                <i class="fas fa-bullhorn me-1"></i> Pengumuman Penting
                            </span>
                        </div>

                        <!-- Title -->
                        <h1 class="fw-bold mb-4"><?= esc($nama) ?></h1>

                        <!-- Meta Info -->
                        <div class="d-flex flex-wrap gap-3 mb-4 pb-4 border-bottom">
                            <div class="text-muted">
                                <i class="far fa-calendar text-primary me-2"></i>
                                <small><?= esc($tgl_informasi) ?></small>
                            </div>
                            <div class="text-muted">
                                <i class="far fa-user text-primary me-2"></i>
                                <small><?= esc($fullname) ?></small>
                            </div>
                            <div class="text-muted">
                                <i class="far fa-eye text-primary me-2"></i>
                                <small><?= number_format($hits) ?> views</small>
                            </div>
                        </div>

                        <!-- Main Content -->
                        <div class="announcement-content" style="line-height: 1.8;">
                            <?= $isi_informasi ?>
                        </div>

                        <!-- Download Section -->
                        <?php if (!empty($fileunduh)): ?>
                            <div class="mt-4 p-4 bg-light rounded-3">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h6 class="fw-bold mb-2">
                                            <i class="fas fa-file-download text-primary me-2"></i>
                                            File Lampiran
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            Unduh file lampiran terkait pengumuman ini
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                        <a href="<?= base_url('layanan/download_layananlocal/' . $fileunduh) ?>"
                                            class="btn btn-primary" target="_blank">
                                            <i class="fas fa-download me-2"></i> Unduh File
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Share Buttons -->
                        <div class="mt-5 pt-4 border-top">
                            <h6 class="fw-bold mb-3">Bagikan:</h6>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>"
                                    target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?= current_url() ?>&text=<?= urlencode($nama) ?>"
                                    target="_blank" class="btn btn-outline-info btn-sm">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="https://wa.me/?text=<?= urlencode($nama . ' ' . current_url()) ?>"
                                    target="_blank" class="btn btn-outline-success btn-sm">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Related Announcements -->
                <?php if (!empty($pengumumanlain) && count($pengumumanlain) > 0): ?>
                    <div class="mt-5">
                        <h4 class="fw-bold mb-4">Pengumuman Lainnya</h4>
                        <div class="row g-3">
                            <?php foreach (array_slice($pengumumanlain, 0, 3) as $lain): ?>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100 hover-shadow transition">
                                        <?php if (!empty($lain['gambar']) && $lain['gambar'] != 'default.png'): ?>
                                            <img src="<?= base_url('public/img/informasi/pengumuman/' . $lain['gambar']) ?>"
                                                class="card-img-top" alt="<?= esc($lain['nama']) ?>"
                                                style="height: 150px; object-fit: cover;">
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-2">
                                                <a href="<?= base_url('pengumuman/' . ($lain['slug_informasi'] ?: $lain['informasi_id'])) ?>"
                                                    class="text-dark text-decoration-none hover-text-primary">
                                                    <?= character_limiter(esc($lain['nama']), 50) ?>
                                                </a>
                                            </h6>
                                            <small class="text-muted">
                                                <i class="far fa-calendar me-1"></i>
                                                <?= date('d M Y', strtotime($lain['tgl_informasi'])) ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Popular Posts -->
                <?php if (!empty($beritapopuler)): ?>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">Berita Populer</h5>
                        </div>
                        <div class="card-body">
                            <?php foreach (array_slice($beritapopuler, 0, 5) as $berita): ?>
                                <div class="d-flex mb-3 pb-3 border-bottom">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">
                                            <a href="<?= base_url('berita/' . $berita['slug_berita']) ?>"
                                                class="text-dark text-decoration-none hover-text-primary">
                                                <?= character_limiter(esc($berita['judul_berita']), 60) ?>
                                            </a>
                                        </h6>
                                        <small class="text-muted">
                                            <i class="far fa-calendar me-1"></i>
                                            <?= date('d M Y', strtotime($berita['tgl_berita'])) ?>
                                        </small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Upcoming Agenda -->
                <?php if (!empty($agenda)): ?>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">Agenda Mendatang</h5>
                        </div>
                        <div class="card-body">
                            <?php foreach (array_slice($agenda, 0, 3) as $item): ?>
                                <div class="mb-3 pb-3 border-bottom">
                                    <h6 class="mb-2"><?= esc($item['tema']) ?></h6>
                                    <div class="small text-muted mb-1">
                                        <i class="far fa-calendar me-1"></i>
                                        <?= date('d M Y', strtotime($item['tgl_mulai'])) ?>
                                    </div>
                                    <div class="small text-muted">
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        <?= esc($item['tempat']) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- ================> News Detail Section End Here <================== -->

<style>
    .announcement-content {
        font-size: 1.05rem;
        color: #333;
    }

    .announcement-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1rem 0;
    }

    .hover-shadow:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .hover-text-primary:hover {
        color: var(--primary-yellow, #ffc107) !important;
    }

    .transition {
        transition: all 0.3s ease;
    }
</style>

<?= $this->endSection() ?>