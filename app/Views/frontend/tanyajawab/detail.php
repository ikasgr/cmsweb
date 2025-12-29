<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>Bantuan & Dukungan</h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('tanyajawab') ?>">FAQ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Help Section Start Here <================== -->
<div class="service padding--top padding--bottom bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <div class="mb-4">
                                <i class="fas fa-question-circle text-primary" style="font-size: 4rem;"></i>
                            </div>
                            <h2 class="fw-bold">Pusat Bantuan</h2>
                            <p class="text-muted">Temukan solusi untuk pertanyaan Anda</p>
                        </div>

                        <!-- FAQ List -->
                        <?php if (!empty($faq)): ?>
                            <div class="accordion" id="helpAccordion">
                                <?php foreach ($faq as $index => $item): ?>
                                    <div class="accordion-item border-0 shadow-sm mb-3">
                                        <h2 class="accordion-header" id="helpHeading<?= $index ?>">
                                            <button class="accordion-button <?= $index !== 0 ? 'collapsed' : '' ?>"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#helpCollapse<?= $index ?>"
                                                aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>">
                                                <div class="d-flex align-items-center w-100">
                                                    <i class="fas fa-question-circle text-primary me-3"></i>
                                                    <span class="fw-bold"><?= esc($item['faqtanya']) ?></span>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="helpCollapse<?= $index ?>"
                                            class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>"
                                            aria-labelledby="helpHeading<?= $index ?>">
                                            <div class="accordion-body bg-light">
                                                <div class="d-flex">
                                                    <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                                    <div>
                                                        <?php if (!empty($item['faq_jawaban'])): ?>
                                                            <?= $item['faq_jawaban'] ?>
                                                        <?php else: ?>
                                                            <p class="text-muted mb-0">Jawaban akan segera tersedia.</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada FAQ tersedia</h5>
                            </div>
                        <?php endif; ?>

                        <!-- Contact Section -->
                        <div class="mt-5 pt-4 border-top">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card border-0 bg-light h-100">
                                        <div class="card-body text-center p-4">
                                            <i class="fas fa-envelope text-primary fa-2x mb-3"></i>
                                            <h5 class="fw-bold mb-2">Email Kami</h5>
                                            <p class="text-muted small mb-3">
                                                Kirim pertanyaan Anda melalui email
                                            </p>
                                            <a href="mailto:<?= $konfigurasi->email ?? 'info@example.com' ?>"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-paper-plane me-2"></i> Kirim Email
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card border-0 bg-light h-100">
                                        <div class="card-body text-center p-4">
                                            <i class="fas fa-phone text-success fa-2x mb-3"></i>
                                            <h5 class="fw-bold mb-2">Hubungi Kami</h5>
                                            <p class="text-muted small mb-3">
                                                Dapatkan bantuan langsung via telepon
                                            </p>
                                            <a href="tel:<?= $konfigurasi->no_telp ?? '' ?>"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-phone-alt me-2"></i>
                                                <?= $konfigurasi->no_telp ?? 'Hubungi' ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Resources -->
                        <div class="mt-5 p-4 bg-primary bg-opacity-10 rounded-3">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5 class="fw-bold mb-2">Masih membutuhkan bantuan?</h5>
                                    <p class="text-muted mb-0">
                                        Tim kami siap membantu Anda 24/7. Jangan ragu untuk menghubungi kami.
                                    </p>
                                </div>
                                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                    <a href="<?= base_url('contact') ?>" class="btn btn-primary">
                                        <i class="fas fa-headset me-2"></i> Pusat Bantuan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================> Help Section End Here <================== -->

<style>
    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #212529;
        box-shadow: none;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0, 0, 0, .125);
    }

    .accordion-item {
        transition: all 0.3s ease;
    }

    .accordion-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
    }
</style>

<?= $this->endSection() ?>