<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>Layanan Kami</h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Layanan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Service Section Start Here <================== -->
<div class="service padding--top padding--bottom bg-light">
    <div class="container">
        <div class="section__header text-center mb-5">
            <h2 class="fw-bold">Layanan Kami</h2>
            <p class="text-muted">Beragam layanan yang kami sediakan untuk Anda</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($layanan)): ?>
                <?php foreach ($layanan as $item): ?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="service-card h-100 border-0 shadow-sm rounded-3 overflow-hidden hover-shadow-lg transition">
                            <?php if (!empty($item['gambar']) && $item['gambar'] != 'default.png'): ?>
                                <div class="service-card__image position-relative">
                                    <img src="<?= base_url('public/img/informasi/layanan/' . $item['gambar']) ?>"
                                        alt="<?= esc($item['nama']) ?>" class="w-100" style="height: 200px; object-fit: cover;">
                                </div>
                            <?php endif; ?>

                            <div class="service-card__content p-4">
                                <h5 class="fw-bold mb-3">
                                    <a href="#" class="text-dark text-decoration-none hover-text-primary"
                                        data-informasi-id="<?= $item['informasi_id'] ?>"
                                        onclick="lihatLayanan(event, <?= $item['informasi_id'] ?>)">
                                        <?= esc($item['nama']) ?>
                                    </a>
                                </h5>

                                <div class="service-excerpt text-muted mb-4" style="line-height: 1.7;">
                                    <?= character_limiter(strip_tags($item['isi_informasi']), 150) ?>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                        data-informasi-id="<?= $item['informasi_id'] ?>"
                                        onclick="lihatLayanan(event, <?= $item['informasi_id'] ?>)">
                                        <i class="fas fa-info-circle me-1"></i> Detail
                                    </button>

                                    <?php if (!empty($item['fileunduh'])): ?>
                                        <a href="<?= base_url('layanan/download_layananlocal/' . $item['fileunduh']) ?>"
                                            class="btn btn-sm btn-success" target="_blank">
                                            <i class="fas fa-download me-1"></i> Unduh
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="service-meta mt-3 pt-3 border-top">
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
                        <h5 class="text-muted">Belum ada layanan tersedia</h5>
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
<!-- ================> Service Section End Here <================== -->

<!-- Modal untuk Detail Layanan -->
<div class="modal fade" id="modalDetailLayanan" tabindex="-1" aria-labelledby="modalDetailLayananLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" id="modalDetailContent">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

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

    .service-card {
        transition: all 0.3s ease;
    }

    .service-card:hover {
        border-color: var(--primary-yellow, #ffc107) !important;
    }

    .service-excerpt {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function lihatLayanan(event, informasiId) {
        event.preventDefault();

        $.ajax({
            type: "post",
            url: "<?= base_url('layanan/formlihatlayanan') ?>",
            data: {
                informasi_id: informasiId,
                jns: 'fr',
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            dataType: "json",
            beforeSend: function () {
                $('#modalDetailContent').html(`
                <div class="modal-body text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted">Memuat detail layanan...</p>
                </div>
            `);
                $('#modalDetailLayanan').modal('show');
            },
            success: function (response) {
                if (response.sukses) {
                    $('#modalDetailContent').html(response.sukses);
                } else if (response.error) {
                    $('#modalDetailContent').html(`
                    <div class="modal-body text-center py-5">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <p class="text-muted">${response.error}</p>
                    </div>
                `);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.error(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                $('#modalDetailContent').html(`
                <div class="modal-body text-center py-5">
                    <i class="fas fa-times-circle fa-3x text-danger mb-3"></i>
                    <p class="text-muted">Terjadi kesalahan saat memuat data</p>
                </div>
            `);
            }
        });
    }
</script>

<?= $this->endSection() ?>