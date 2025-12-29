<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3><?= isset($title) ? $title : 'E-Library' ?></h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">E-Book</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> E-Book Section Start Here <================== -->
<div class="ebook-section padding--top padding--bottom bg-light">
    <div class="container">

        <!-- Search / Filter Section could go here -->

        <?php if (isset($ebook) && count($ebook) > 0): ?>
            <div class="row g-4 justify-content-center">
                <?php foreach ($ebook as $row): ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <div class="card h-100 border-0 shadow-sm rounded-3 hover-up ebook-card">
                            <div class="position-relative overflow-hidden rounded-top-3" style="height: 300px;">
                                <!-- Badge Kategori if available, for now just Hits -->
                                <span class="badge bg-primary position-absolute top-0 end-0 m-3 shadow-sm rounded-pill">
                                    <i class="fas fa-eye me-1"></i> <?= $row['hits'] ?>
                                </span>

                                <img src="<?= base_url('public/img/ebook/thumb/thumb_' . ($row['gambar'] ? $row['gambar'] : 'default.png')) ?>"
                                    class="card-img-top w-100 h-100 object-fit-cover transition-scale"
                                    alt="<?= esc($row['judul']) ?>"
                                    onerror="this.src='<?= base_url('public/img/no_image.png') ?>'">

                                <!-- Overlay Actions -->
                                <div class="card-overlay d-flex align-items-center justify-content-center gap-2">
                                    <a href="<?= base_url('bacabuku/' . $row['fileebook']) ?>"
                                        class="btn btn-light rounded-circle shadow" title="Baca Buku" target="_blank">
                                        <i class="fas fa-book-open text-primary"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column text-center p-4">
                                <h5 class="card-title fw-bold text-dark mb-2 text-truncate-2"><?= esc($row['judul']) ?></h5>
                                <p class="card-text text-muted small mb-3">
                                    <i class="fas fa-user-edit me-1"></i> <?= esc($row['penulis'] ?: '-') ?>
                                </p>

                                <div class="mt-auto">
                                    <div
                                        class="d-flex justify-content-center align-items-center gap-3 text-secondary small mb-3">
                                        <span><i class="far fa-file-alt me-1"></i> <?= $row['j_hal'] ?> Hal</span>
                                        <span><i class="far fa-calendar me-1"></i>
                                            <?= date('Y', strtotime($row['tanggal'])) ?></span>
                                    </div>

                                    <a href="<?= base_url('bacabuku/' . $row['fileebook']) ?>"
                                        class="btn btn-outline-primary rounded-pill w-100 btn-sm" target="_blank">
                                        Baca Sekarang <i class="fas fa-angle-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                <?= $pager->links('hal', 'bootstrap_pagination') ?>
            </div>

        <?php else: ?>
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-book-reader fa-4x text-muted opacity-50"></i>
                </div>
                <h4 class="text-muted fw-bold">Belum ada E-Book tersedia</h4>
                <p class="text-muted mb-4">Silakan cek kembali nanti untuk koleksi buku terbaru kami.</p>
                <a href="<?= base_url() ?>" class="btn btn-primary rounded-pill px-4">Kembali ke Beranda</a>
            </div>
        <?php endif; ?>

    </div>
</div>
<!-- ================> E-Book Section End Here <================== -->

<style>
    .hover-up {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-up:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 3rem;
        /* approximate height for 2 lines */
    }

    /* Image Zoom Effect */
    .ebook-card:hover .transition-scale {
        transform: scale(1.05);
    }

    .transition-scale {
        transition: transform 0.5s ease;
    }

    /* Overlay */
    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .ebook-card:hover .card-overlay {
        opacity: 1;
    }
</style>

<?= $this->endSection() ?>