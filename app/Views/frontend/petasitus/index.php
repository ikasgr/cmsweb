<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>Peta Situs</h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Peta Situs</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Sitemap Section Start Here <================== -->
<div class="service padding--top padding--bottom bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <i class="fas fa-sitemap text-primary fa-3x mb-3"></i>
                            <h2 class="fw-bold mb-3">Peta Situs</h2>
                            <p class="text-muted">Temukan semua halaman dan konten di website kami dengan mudah</p>
                        </div>

                        <div class="row g-4">
                            <!-- Main Pages -->
                            <div class="col-lg-4 col-md-6">
                                <div class="sitemap-section">
                                    <h5 class="fw-bold mb-3 pb-2 border-bottom">
                                        <i class="fas fa-home me-2 text-primary"></i> Halaman Utama
                                    </h5>
                                    <ul class="list-unstyled ps-3">
                                        <li class="mb-2">
                                            <a href="<?= base_url() ?>"
                                                class="text-decoration-none text-dark hover-text-primary">
                                                <i class="fas fa-angle-right me-2"></i> Beranda
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="<?= base_url('news') ?>"
                                                class="text-decoration-none text-dark hover-text-primary">
                                                <i class="fas fa-angle-right me-2"></i> Berita
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="<?= base_url('pengumuman') ?>"
                                                class="text-decoration-none text-dark hover-text-primary">
                                                <i class="fas fa-angle-right me-2"></i> Pengumuman
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="<?= base_url('contact') ?>"
                                                class="text-decoration-none text-dark hover-text-primary">
                                                <i class="fas fa-angle-right me-2"></i> Hubungi Kami
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Categories -->
                            <?php if (!empty($kategori)): ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="sitemap-section">
                                        <h5 class="fw-bold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-folder me-2 text-success"></i> Kategori Berita
                                        </h5>
                                        <ul class="list-unstyled ps-3">
                                            <?php foreach ($kategori as $kat): ?>
                                                <li class="mb-2">
                                                    <a href="<?= base_url('news/category/' . (isset($kat['slug_kategori']) ? $kat['slug_kategori'] : '')) ?>"
                                                        class="text-decoration-none text-dark hover-text-primary">
                                                        <i class="fas fa-angle-right me-2"></i>
                                                        <?= isset($kat['nama_kategori']) ? esc($kat['nama_kategori']) : '' ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Static Pages -->
                            <?php if (!empty($halaman)): ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="sitemap-section">
                                        <h5 class="fw-bold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-file-alt me-2 text-info"></i> Halaman Statis
                                        </h5>
                                        <ul class="list-unstyled ps-3">
                                            <?php foreach ($halaman as $page): ?>
                                                <li class="mb-2">
                                                    <a href="<?= base_url('page/' . (isset($page['slug_berita']) ? $page['slug_berita'] : '')) ?>"
                                                        class="text-decoration-none text-dark hover-text-primary">
                                                        <i class="fas fa-angle-right me-2"></i>
                                                        <?= isset($page['judul_berita']) ? esc($page['judul_berita']) : '' ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Interaction -->
                            <div class="col-lg-4 col-md-6">
                                <div class="sitemap-section">
                                    <h5 class="fw-bold mb-3 pb-2 border-bottom">
                                        <i class="fas fa-comments me-2 text-warning"></i> Interaksi
                                    </h5>
                                    <ul class="list-unstyled ps-3">
                                        <li class="mb-2">
                                            <a href="<?= base_url('survey') ?>"
                                                class="text-decoration-none text-dark hover-text-primary">
                                                <i class="fas fa-angle-right me-2"></i> Survei
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="<?= base_url('bukutamu') ?>"
                                                class="text-decoration-none text-dark hover-text-primary">
                                                <i class="fas fa-angle-right me-2"></i> Buku Tamu
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="<?= base_url('kritiksaran/masukansaran') ?>"
                                                class="text-decoration-none text-dark hover-text-primary">
                                                <i class="fas fa-angle-right me-2"></i> Masukan & Saran
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Latest News -->
                            <?php if (!empty($beritautama) && count($beritautama) > 0): ?>
                                <div class="col-lg-8 col-md-12">
                                    <div class="sitemap-section">
                                        <h5 class="fw-bold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-newspaper me-2 text-danger"></i> Berita Terbaru
                                        </h5>
                                        <div class="row">
                                            <?php
                                            $count = 0;
                                            foreach ($beritautama as $berita):
                                                if ($count >= 12)
                                                    break;
                                                $count++;
                                                ?>
                                                <div class="col-md-6 mb-2">
                                                    <a href="<?= base_url('news/' . (isset($berita['slug_berita']) ? $berita['slug_berita'] : '')) ?>"
                                                        class="text-decoration-none text-dark hover-text-primary d-flex align-items-start">
                                                        <i class="fas fa-angle-right me-2 mt-1"></i>
                                                        <span><?= isset($berita['judul_berita']) ? character_limiter(esc($berita['judul_berita']), 60) : '' ?></span>
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Search Box -->
                        <div class="mt-5 pt-4 border-top">
                            <div class="text-center">
                                <h5 class="fw-bold mb-3">Cari Konten</h5>
                                <form action="<?= base_url('search') ?>" method="post"
                                    class="d-flex justify-content-center">
                                    <?= csrf_field() ?>
                                    <div class="input-group" style="max-width: 500px;">
                                        <input type="text" class="form-control" name="keyword"
                                            placeholder="Ketik kata kunci..." required>
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search me-2"></i> Cari
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================> Sitemap Section End Here <================== -->

<style>
    .sitemap-section {
        padding: 1rem;
        border-radius: 0.375rem;
        background: #f8f9fa;
        height: 100%;
    }

    .hover-text-primary:hover {
        color: var(--primary-yellow, #ffc107) !important;
        padding-left: 5px;
        transition: all 0.3s ease;
    }

    .list-unstyled li {
        transition: all 0.3s ease;
    }

    .list-unstyled li:hover {
        transform: translateX(5px);
    }
</style>

<?= $this->endSection() ?>