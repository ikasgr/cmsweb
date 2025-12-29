<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>Pengumuman</h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Announcement Section Start Here <================== -->
<div class="service padding--top padding--bottom bg-light">
    <div class="container">
        <div class="section__header text-center mb-5">
            <h2 class="fw-bold">Pengumuman Terbaru</h2>
            <p class="text-muted">Informasi dan pengumuman penting untuk Anda</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($pengumuman)): ?>
                <?php foreach ($pengumuman as $item): ?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div
                            class="announcement-card h-100 border-0 shadow-sm rounded-3 overflow-hidden hover-shadow-lg transition">
                            <?php if (!empty($item['gambar']) && $item['gambar'] != 'default.png'): ?>
                                <div class="announcement-card__image position-relative">
                                    <img src="<?= base_url('public/img/informasi/pengumuman/' . $item['gambar']) ?>"
                                        alt="<?= esc($item['nama']) ?>" class="w-100" style="height: 200px; object-fit: cover;">
                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge bg-danger">
                                            <i class="fas fa-bullhorn me-1"></i> Pengumuman
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="announcement-card__content p-4">
                                <h5 class="fw-bold mb-3">
                                    <a href="<?= base_url('pengumuman/' . ($item['slug_informasi'] ?: $item['informasi_id'])) ?>"
                                        class="text-dark text-decoration-none hover-text-primary">
                                        <?= esc($item['nama']) ?>
                                    </a>
                                </h5>

                                <div class="announcement-excerpt text-muted mb-4" style="line-height: 1.7;">
                                    <?= character_limiter(strip_tags($item['isi_informasi']), 150) ?>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="<?= base_url('pengumuman/' . ($item['slug_informasi'] ?: $item['informasi_id'])) ?>"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-arrow-right me-1"></i> Selengkapnya
                                    </a>

                                    <?php if (!empty($item['fileunduh'])): ?>
                                        <a href="<?= base_url('layanan/download_layananlocal/' . $item['fileunduh']) ?>"
                                            class="btn btn-sm btn-success" target="_blank">
                                            <i class="fas fa-download me-1"></i> Unduh
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="announcement-meta mt-3 pt-3 border-top">
                                    <small class="text-muted">
                                        <i class="far fa-calendar me-1"></i>
                                        <?= date('d M Y', strtotime($item['tgl_informasi'])) ?>
                                    </small>
                                    <small class="text-muted ms-3">
                                        <i class="far fa-eye me-1"></i>
                                        <?= number_format($item['hits']) ?> views
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada pengumuman tersedia</h5>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if (!empty($pager)): ?>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <?= $pager->links('hal', 'bootstrap_pagination') ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- ================> Announcement Section End Here <================== -->

<style>
    .hover-shadow-lg:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
        transform: translateY(-5px);
    }

    .hover-text-primary:hover {
        color: var(--primary-yellow, #ffc107) !important;
    }

    .transition {
        transition: all 0.3s ease;
    }

    .announcement-card {
        transition: all 0.3s ease;
    }

    .announcement-card:hover {
        border-color: var(--primary-yellow, #ffc107) !important;
    }

    .announcement-excerpt {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<?= $this->endSection() ?>