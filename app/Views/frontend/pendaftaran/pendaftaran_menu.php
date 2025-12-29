<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3><?= isset($title) ? $title : 'Menu Pendaftaran' ?></h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pendaftaran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Pendaftaran Menu Section Start <================== -->
<div class="pendaftaran-menu-section padding--top padding--bottom bg-light">
    <div class="container">
        <div class="section__header text-center mb-5">
            <h2>Pilih Layanan Pendaftaran</h2>
            <p>Silakan pilih jenis pendaftaran yang ingin Anda lakukan.</p>
        </div>

        <div class="row justify-content-center g-4">

            <!-- Card Pendaftaran Baptis -->
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 border-0 shadow-sm hover-up text-center p-4">
                    <div class="card-body">
                        <div class="icon-box mb-4 mx-auto bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Pendataan Jemaat</h4>
                        <p class="card-text text-muted mb-4">Formulir pendataan dan pemutakhiran data jemaat.</p>
                        <a href="<?= base_url('pendataan-jemaat') ?>"
                            class="btn btn-outline-info rounded-pill w-100 stretched-link">
                            Isi Formulir <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Pendaftaran Baptis -->
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 border-0 shadow-sm hover-up text-center p-4">
                    <div class="card-body">
                        <div class="icon-box mb-4 mx-auto bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-water fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Pendaftaran Baptis</h4>
                        <p class="card-text text-muted mb-4">Pendaftaran untuk Sakramen Baptisan Kudus (Anak & Dewasa).
                        </p>
                        <a href="<?= base_url('pendaftaran-baptis') ?>"
                            class="btn btn-primary rounded-pill w-100 stretched-link">
                            Daftar Sekarang <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Pendaftaran Sidi -->
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 border-0 shadow-sm hover-up text-center p-4">
                    <div class="card-body">
                        <div class="icon-box mb-4 mx-auto bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-bible fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Pendaftaran Sidi</h4>
                        <p class="card-text text-muted mb-4">Pendaftaran untuk Katekisasi dan Peneguhan Sidi.</p>
                        <a href="<?= base_url('pendaftaran-sidi') ?>"
                            class="btn btn-outline-success rounded-pill w-100 stretched-link">
                            Daftar Sekarang <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Pendaftaran Nikah -->
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 border-0 shadow-sm hover-up text-center p-4">
                    <div class="card-body">
                        <div class="icon-box mb-4 mx-auto bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-heart fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Pendaftaran Nikah</h4>
                        <p class="card-text text-muted mb-4">Pendaftaran untuk Pemberkatan Pernikahan Kudus.</p>
                        <a href="<?= base_url('pendaftaran-nikah') ?>"
                            class="btn btn-outline-danger rounded-pill w-100 stretched-link">
                            Daftar Sekarang <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- ================> Pendaftaran Menu Section End <================== -->

<style>
    .hover-up {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-up:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }

    .icon-box {
        transition: transform 0.3s ease;
    }

    .card:hover .icon-box {
        transform: scale(1.1);
    }
</style>

<?= $this->endSection() ?>