<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>Buku Tamu</h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-it em"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Buku Tamu</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Guestbook Section Start Here <================== -->
<div class="service padding--top padding--bottom bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-5">
                        <!-- Header -->
                        <div class="text-center mb-5">
                            <div class="mb-3">
                                <i class="fas fa-book text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h2 class="fw-bold mb-3">Buku Tamu</h2>
                            <p class="text-muted">Silakan isi form di bawah ini untuk mencatat kunjungan Anda</p>
                        </div>

                        <!-- Form -->
                        <form id="guestbookForm" method="post">
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
                                    <label class="form-label fw-bold">No. Telepon <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="telp" required
                                        placeholder="08xx xxxx xxxx">
                                    <div class="invalid-feedback error-telp"></div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Instansi/Organisasi <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="instansi" required
                                        placeholder="Nama instansi atau organisasi">
                                    <div class="invalid-feedback error-instansi"></div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Bidang <span class="text-danger">*</span></label>
                                    <select class="form-select" name="bidang_id" required>
                                        <option value="">Pilih Bidang</option>
                                        <?php if (!empty($mbidang)): ?>
                                            <?php foreach ($mbidang as $bidang): ?>
                                                <option value="<?= isset($bidang['bidang_id']) ? $bidang['bidang_id'] : '' ?>">
                                                    <?= isset($bidang['nama_bidang']) ? esc($bidang['nama_bidang']) : '' ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <div class="invalid-feedback error-bidang_id"></div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Keperluan <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="keperluan" rows="5" required
                                        placeholder="Jelaskan keperluan kunjungan Anda..."></textarea>
                                    <div class="invalid-feedback error-keperluan"></div>
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
                                        <i class="fas fa-paper-plane me-2"></i> Kirim
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================> Guestbook Section End Here <================== -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php if (!empty($sitekey)): ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#guestbookForm').on('submit', function (e) {
            e.preventDefault();

            // Clear previous errors
            $('.form-control, .form-select').removeClass('is-invalid');
            $('.invalid-feedback').html('');

            const formData = $(this).serialize();

            $.ajax({
                url: '<?= base_url('bukutamu/simpanbukutamu') ?>',
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
                            title: 'Berhasil!',
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
                    <i class="fas fa-paper-plane me-2"></i> Kirim
                `);
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim data'
                    });

                    $('button[type="submit"]').prop('disabled', false).html(`
                    <i class="fas fa-paper-plane me-2"></i> Kirim
                `);
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>