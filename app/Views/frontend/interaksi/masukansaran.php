<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>Masukan & Saran</h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Masukan & Saran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Feedback Section Start Here <================== -->
<div class="service padding--top padding--bottom bg-light">
    <div class="container">
        <div class="row">
            <!-- Form Section -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-body p-5">
                        <!-- Header -->
                        <div class="text-center mb-5">
                            <div class="mb-3">
                                <i class="fas fa-comments text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h2 class="fw-bold mb-3">Masukan & Saran</h2>
                            <p class="text-muted">Kritik dan saran Anda sangat berharga untuk perbaikan layanan kami</p>
                        </div>

                        <!-- Form -->
                        <form id="feedbackForm" method="post">
                            <?= csrf_field() ?>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama" required
                                        placeholder="Masukkan nama lengkap">
                                    <div class="invalid-feedback error-nama"></div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">No. HP <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="no_hpusr" required
                                        placeholder="08xx xxxx xxxx">
                                    <div class="invalid-feedback error-no_hpusr"></div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required
                                        placeholder="email@example.com">
                                    <div class="invalid-feedback error-email"></div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Topik/Judul <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="judul" required
                                        placeholder="Topik masukan atau saran">
                                    <div class="invalid-feedback error-judul"></div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Isi Masukan/Saran <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="isi_kritik" rows="6" required
                                        placeholder="Tuliskan masukan dan saran Anda di sini..."></textarea>
                                    <div class="invalid-feedback error-isi_kritik"></div>
                                </div>

                                <!-- ReCAPTCHA -->
                                <?php if (!empty($sitekey)): ?>
                                    <div class="col-md-12">
                                        <div class="g-recaptcha" data-sitekey="<?= $sitekey ?>"></div>
                                    </div>
                                <?php endif; ?>

                                <!-- Submit Button -->
                                <div class="col-md-12 text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-paper-plane me-2"></i> Kirim Masukan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Recent Feedback Sidebar -->
            <div class="col-lg-4">
                <?php if (!empty($suaraanda) && count($suaraanda) > 0): ?>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">Suara Anda</h5>
                        </div>
                        <div class="card-body">
                            <?php foreach ($suaraanda as $item): ?>
                                <div class="feedback-item mb-3 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="fw-bold mb-1"><?= esc($item['judul']) ?></h6>
                                        <?php if ($item['status'] == '1'): ?>
                                            <span class="badge bg-success">Ditanggapi</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">Menunggu</span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-muted small mb-2">
                                        <?= character_limiter(strip_tags($item['isi_kritik']), 80) ?>
                                    </p>
                                    <?php if (!empty($item['balas'])): ?>
                                        <div class="alert alert-success p-2 small mb-0">
                                            <strong>Tanggapan:</strong> <?= character_limiter(strip_tags($item['balas']), 60) ?>
                                        </div>
                                    <?php endif; ?>
                                    <small class="text-muted">
                                        <i class="far fa-clock me-1"></i>
                                        <?= date('d M Y', strtotime($item['tanggal'])) ?>
                                    </small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Info Card -->
                <div class="card border-0 bg-primary bg-opacity-10 mb-4">
                    <div class="card-body p-4 text-center">
                        <i class="fas fa-info-circle text-primary fa-2x mb-3"></i>
                        <h6 class="fw-bold mb-2">Informasi</h6>
                        <p class="small text-muted mb-0">
                            Setiap masukan dan saran akan kami review dan ditanggapi melalui email yang Anda daftarkan.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <?php if (!empty($pager)): ?>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <?= $pager->links('hal', 'bootstrap_pagination') ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- ================> Feedback Section End Here <================== -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php if (!empty($sitekey)): ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#feedbackForm').on('submit', function (e) {
            e.preventDefault();

            // Clear previous errors
            $('.form-control, .form-select').removeClass('is-invalid');
            $('.invalid-feedback').html('');

            const formData = $(this).serialize();

            $.ajax({
                url: '<?= base_url('kritiksaran/simpanKritik') ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function () {
                    $('button[type="submit"]').prop('disabled', true).html(`
                    <span class="spinner-border spinner-border-sm me-2"></span>
                    Mengirim...
                `);
                },
                success: function (response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terima Kasih!',
                            text: response.sukses,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });
                    } else if (response.gagal) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.gagal
                        });
                    } else if (response.error) {
                        // Display field errors
                        $.each(response.error, function (key, value) {
                            if (value) {
                                $('[name="' + key + '"]').addClass('is-invalid');
                                $('.error-' + key).html(value);
                            }
                        });
                    }

                    $('button[type="submit"]').prop('disabled', false).html(`
                    <i class="fas fa-paper-plane me-2"></i> Kirim Masukan
                `);
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim data'
                    });

                    $('button[type="submit"]').prop('disabled', false).html(`
                    <i class="fas fa-paper-plane me-2"></i> Kirim Masukan
                `);
                }
            });
        });
    });
</script>

<style>
    .feedback-item:last-child {
        border-bottom: none !important;
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
    }
</style>

<?= $this->endSection() ?>