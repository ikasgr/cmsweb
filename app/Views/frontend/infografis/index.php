<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3><?= isset($title) ? $title : 'Infografis' ?></h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Infografis</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Infografis Section Start Here <================== -->
<div class="infografis-section padding--top padding--bottom bg-light">
    <div class="container">

        <?php if (isset($infografis) && count($infografis) > 0): ?>
            <div class="row g-4 justify-content-center">
                <?php foreach ($infografis as $row): ?>
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="card h-100 border-0 shadow-sm rounded-3 hover-up">

                            <a href="<?= base_url('public/img/informasi/infografis/' . $row['banner_image']) ?>"
                                data-rel="lightcase:myCollection" title="<?= esc($row['ket']) ?>"
                                class="d-block position-relative overflow-hidden rounded-top-3">

                                <img src="<?= base_url('public/img/informasi/infografis/thumb/thumb_' . $row['banner_image']) ?>"
                                    class="card-img-top w-100 object-fit-cover transition-scale" alt="<?= esc($row['ket']) ?>"
                                    style="height: 300px;" onerror="this.src='<?= base_url('public/img/no_image.png') ?>'">

                                <div class="card-overlay d-flex align-items-center justify-content-center">
                                    <i class="fas fa-search-plus fa-2x text-white"></i>
                                </div>
                            </a>

                            <div class="card-body p-4 text-center">
                                <h6 class="card-title fw-bold text-dark"><?= esc($row['ket']) ?></h6>
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
                    <i class="fas fa-images fa-4x text-muted opacity-50"></i>
                </div>
                <h4 class="text-muted fw-bold">Belum ada Infografis tersedia</h4>
                <a href="<?= base_url() ?>" class="btn btn-primary rounded-pill px-4 mt-3">Kembali ke Beranda</a>
            </div>
        <?php endif; ?>

    </div>
</div>
<!-- ================> Infografis Section End Here <================== -->

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

    .transition-scale {
        transition: transform 0.5s ease;
    }

    .card:hover .transition-scale {
        transform: scale(1.05);
    }

    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .card:hover .card-overlay {
        opacity: 1;
    }
</style>

<?= $this->endSection() ?>