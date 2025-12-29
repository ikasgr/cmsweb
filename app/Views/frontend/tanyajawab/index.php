<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>Tanya Jawab (FAQ)</h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> FAQ Section Start Here <================== -->
<div class="service padding--top padding--bottom bg-light">
    <div class="container">
        <div class="row">
            <!-- FAQ Content -->
            <div class="col-lg-8">
                <div class="section__header mb-4">
                    <h2 class="fw-bold">Pertanyaan yang Sering Diajukan</h2>
                    <p class="text-muted">Temukan jawaban untuk pertanyaan umum Anda</p>
                </div>

                <!-- Category Filter -->
                <?php if (!empty($kategorifaq)): ?>
                    <div class="mb-4">
                        <div class="btn-group flex-wrap" role="group">
                            <button type="button" class="btn btn-outline-primary active" data-category="all">
                                Semua
                            </button>
                            <?php foreach ($kategorifaq as $kat): ?>
                                <button type="button" class="btn btn-outline-primary"
                                    data-category="<?= $kat['masterdata_id'] ?>">
                                    <?= esc($kat['nama_data']) ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- FAQ Accordion -->
                <?php if (!empty($faq)): ?>
                    <div class="accordion" id="faqAccordion">
                        <?php foreach ($faq as $index => $item): ?>
                            <div class="accordion-item border-0 shadow-sm mb-3 faq-item"
                                data-category="<?= $item['kat_faq'] ?>">
                                <h2 class="accordion-header" id="heading<?= $index ?>">
                                    <button class="accordion-button <?= $index !== 0 ? 'collapsed' : '' ?>" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>"
                                        aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>"
                                        aria-controls="collapse<?= $index ?>">
                                        <i class="fas fa-question-circle text-primary me-2"></i>
                                        <?= esc($item['faqtanya']) ?>
                                    </button>
                                </h2>
                                <div id="collapse<?= $index ?>"
                                    class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>"
                                    aria-labelledby="heading<?= $index ?>" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body bg-light">
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            <div>
                                                <?php if (!empty($item['faq_jawaban'])): ?>
                                                    <?= $item['faq_jawaban'] ?>
                                                <?php else: ?>
                                                    <p class="text-muted mb-0">Jawaban belum tersedia.</p>
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
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="fw-bold mb-2">Tidak menemukan jawaban yang Anda cari?</h5>
                                <p class="text-muted mb-0">Hubungi kami untuk mendapatkan bantuan lebih lanjut</p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <a href="<?= base_url('contact') ?>" class="btn btn-primary">
                                    <i class="fas fa-envelope me-2"></i> Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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
                                                <?= character_limiter(esc($berita['judul_berita']), 50) ?>
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

                <!-- Banner/Info -->
                <?php if (!empty($infografis1)): ?>
                    <?php foreach (array_slice($infografis1, 0, 2) as $info): ?>
                        <div class="mb-4">
                            <img src="<?= base_url('public/img/informasi/infografis/' . $info['gambar']) ?>"
                                alt="<?= esc($info['nama_infografis']) ?>" class="w-100 rounded-3 shadow-sm">
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- ================> FAQ Section End Here <================== -->

<style>
    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #212529;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0, 0, 0, .125);
    }

    .hover-text-primary:hover {
        color: var(--primary-yellow, #ffc107) !important;
    }

    .btn-group .btn {
        margin: 0.25rem;
    }

    .faq-item {
        transition: all 0.3s ease;
    }

    .faq-item:hover {
        transform: translateX(5px);
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Category filter
        $('.btn-group button').click(function () {
            const category = $(this).data('category');

            // Update active button
            $('.btn-group button').removeClass('active');
            $(this).addClass('active');

            // Filter FAQ items
            if (category === 'all') {
                $('.faq-item').show();
            } else {
                $('.faq-item').hide();
                $(`.faq-item[data-category="${category}"]`).show();
            }

            // Close all accordions
            $('.accordion-collapse').removeClass('show');
        });
    });
</script>

<?= $this->endSection() ?>