<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3><?= isset($berita->judul_berita) ? esc($berita->judul_berita) : 'Halaman' ?></h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= isset($berita->judul_berita) ? esc($berita->judul_berita) : 'Halaman' ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Page Content Section Start Here <================== -->
<div class="service padding--top padding--bottom bg-light">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-0">
                        <!-- Featured Image -->
                        <?php if (isset($berita->gambar) && $berita->gambar && $berita->gambar != 'default.png'): ?>
                            <div class="featured-image">
                                <img src="<?= base_url('public/img/informasi/profil/' . esc($berita->gambar)) ?>"
                                    alt="<?= isset($berita->judul_berita) ? esc($berita->judul_berita) : '' ?>"
                                    class="img-fluid w-100"
                                    style="border-radius: 0.375rem 0.375rem 0 0; max-height: 450px; object-fit: cover;">
                                <?php if (isset($berita->ket_foto) && !empty($berita->ket_foto)): ?>
                                    <div class="image-caption text-center py-2 px-3 bg-light small text-muted">
                                        <i class="fas fa-camera me-1"></i> <?= esc($berita->ket_foto) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Content -->
                        <div class="p-4 p-md-5">
                            <!-- Meta Info -->
                            <div class="meta-info mb-4 pb-3 border-bottom">
                                <div class="d-flex flex-wrap gap-3 text-muted small">
                                    <span>
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <?= isset($berita->tgl_berita) ? date_indo($berita->tgl_berita) : '' ?>
                                    </span>
                                    <span>
                                        <i class="far fa-eye me-1"></i>
                                        <?= isset($berita->hits) ? $berita->hits : 0 ?> views
                                    </span>
                                </div>
                            </div>

                            <!-- Page Title -->
                            <h1 class="fw-bold mb-4">
                                <?= isset($berita->judul_berita) ? esc($berita->judul_berita) : '' ?></h1>

                            <!-- PDF Download if available -->
                            <?php if (isset($berita->filepdf) && !empty($berita->filepdf)): ?>
                                <div class="alert alert-info d-flex align-items-center mb-4">
                                    <i class="far fa-file-pdf fa-2x text-danger me-3"></i>
                                    <div class="flex-grow-1">
                                        <strong>Dokumen PDF Tersedia</strong>
                                        <p class="mb-0 small">Anda dapat mengunduh dokumen ini dalam format PDF</p>
                                    </div>
                                    <a href="<?= base_url('public/img/informasi/pdf/' . $berita->filepdf) ?>"
                                        class="btn btn-danger" target="_blank" download>
                                        <i class="fas fa-download me-2"></i> Download PDF
                                    </a>
                                </div>
                            <?php endif; ?>

                            <!-- Main Content -->
                            <div class="content-body">
                                <?= isset($berita->isi) ? $berita->isi : '' ?>
                            </div>

                            <!-- Share Buttons -->
                            <hr class="my-5">
                            <div class="share-section">
                                <h6 class="fw-bold mb-3">Bagikan Halaman Ini:</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>"
                                        target="_blank" class="btn btn-primary btn-sm">
                                        <i class="fab fa-facebook-f me-2"></i> Facebook
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=<?= current_url() ?>&text=<?= isset($berita->judul_berita) ? urlencode($berita->judul_berita) : '' ?>"
                                        target="_blank" class="btn btn-info btn-sm text-white">
                                        <i class="fab fa-twitter me-2"></i> Twitter
                                    </a>
                                    <a href="https://wa.me/?text=<?= isset($berita->judul_berita) ? urlencode($berita->judul_berita . ' - ' . current_url()) : current_url() ?>"
                                        target="_blank" class="btn btn-success btn-sm">
                                        <i class="fab fa-whatsapp me-2"></i> WhatsApp
                                    </a>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="copyToClipboard()">
                                        <i class="far fa-copy me-2"></i> Salin Link
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Popular Posts -->
                <?php if (!empty($beritapopuler) && count($beritapopuler) > 0): ?>
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">Berita Populer</h5>
                        </div>
                        <div class="card-body p-0">
                            <?php foreach ($beritapopuler as $index => $popular): ?>
                                <a href="<?= base_url('news/' . (isset($popular['slug_berita']) ? $popular['slug_berita'] : '')) ?>"
                                    class="d-flex p-3 text-decoration-none text-dark hover-bg-light <?= $index < count($beritapopuler) - 1 ? 'border-bottom' : '' ?>">
                                    <?php if (isset($popular['gambar']) && $popular['gambar'] && $popular['gambar'] != 'default.png'): ?>
                                        <img src="<?= base_url('public/img/informasi/' . $popular['gambar']) ?>"
                                            alt="<?= isset($popular['judul_berita']) ? esc($popular['judul_berita']) : '' ?>"
                                            class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                    <?php endif; ?>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">
                                            <?= isset($popular['judul_berita']) ? character_limiter(esc($popular['judul_berita']), 50) : '' ?>
                                        </h6>
                                        <small class="text-muted">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            <?= isset($popular['tgl_berita']) ? date_indo($popular['tgl_berita']) : '' ?>
                                        </small>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Upcoming Events -->
                <?php if (!empty($agenda) && count($agenda) > 0): ?>
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">Agenda Terbaru</h5>
                        </div>
                        <div class="card-body p-0">
                            <?php foreach ($agenda as $index => $event): ?>
                                <div class="p-3 <?= $index < count($agenda) - 1 ? 'border-bottom' : '' ?>">
                                    <h6 class="mb-2"><?= esc($event['tema']) ?></h6>
                                    <small class="text-muted d-block">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <?= date_indo($event['tgl_mulai']) ?>
                                    </small>
                                    <?php if (!empty($event['tempat'])): ?>
                                        <small class="text-muted d-block">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <?= esc($event['tempat']) ?>
                                        </small>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Contact Card -->
                <div class="card border-0 bg-primary text-white rounded-3">
                    <div class="card-body p-4 text-center">
                        <i class="fas fa-envelope fa-3x mb-3"></i>
                        <h5 class="fw-bold mb-2">Butuh Bantuan?</h5>
                        <p class="small mb-3">Hubungi kami untuk informasi lebih lanjut</p>
                        <a href="<?= base_url('contact') ?>" class="btn btn-light">
                            <i class="fas fa-paper-plane me-2"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================> Page Content Section End Here <================== -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function copyToClipboard() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Link berhasil disalin ke clipboard',
                showConfirmButton: false,
                timer: 1500
            });
        }, function () {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal menyalin link'
            });
        });
    }
</script>

<style>
    .content-body {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #333;
    }

    .content-body img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 1.5rem auto;
        border-radius: 0.375rem;
    }

    .content-body p {
        margin-bottom: 1.2rem;
    }

    .content-body h1,
    .content-body h2,
    .content-body h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: bold;
    }

    .content-body ul,
    .content-body ol {
        margin-bottom: 1.2rem;
        padding-left: 2rem;
    }

    .content-body blockquote {
        border-left: 4px solid var(--primary-yellow, #ffc107);
        padding-left: 1rem;
        margin: 1.5rem 0;
        color: #666;
        font-style: italic;
    }

    .hover-bg-light:hover {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }

    .share-section .btn {
        flex: 0 1 auto;
    }
</style>

<?= $this->endSection() ?>