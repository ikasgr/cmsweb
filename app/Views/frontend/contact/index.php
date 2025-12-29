<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>Hubungi Kami</h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Contact Section Start Here <================== -->
<div class="service padding--top padding--bottom bg-light">
    <div class="container">
        <!-- Section Header -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="fw-bold mb-3">Hubungi Kami</h2>
                <p class="text-muted">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <!-- Contact Info Cards -->
            <div class="col-lg-4 col-md-6">
                <div
                    class="contact-info-card h-100 border-0 shadow-sm rounded-3 p-4 text-center transition hover-shadow">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-map-marker-alt text-primary fa-3x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Alamat</h5>
                    <p class="text-muted mb-0">
                        <?= !empty($konfigurasi->alamat) ? nl2br(esc($konfigurasi->alamat)) : 'Alamat belum diatur' ?>
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div
                    class="contact-info-card h-100 border-0 shadow-sm rounded-3 p-4 text-center transition hover-shadow">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-phone-alt text-success fa-3x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Telepon</h5>
                    <p class="text-muted mb-2">
                        <a href="tel:<?= $konfigurasi->no_telp ?? '' ?>"
                            class="text-decoration-none text-muted hover-text-primary">
                            <?= $konfigurasi->no_telp ?? 'Telepon belum diatur' ?>
                        </a>
                    </p>
                    <?php if (!empty($konfigurasi->no_telp)): ?>
                        <a href="https://wa.me/<?= str_replace(['+', ' ', '-'], '', $konfigurasi->no_telp) ?>"
                            target="_blank" class="btn btn-sm btn-success mt-2">
                            <i class="fab fa-whatsapp me-2"></i> WhatsApp
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div
                    class="contact-info-card h-100 border-0 shadow-sm rounded-3 p-4 text-center transition hover-shadow">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-envelope text-warning fa-3x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Email</h5>
                    <p class="text-muted mb-0">
                        <a href="mailto:<?= $konfigurasi->email ?? '' ?>"
                            class="text-decoration-none text-muted hover-text-primary">
                            <?= $konfigurasi->email ?? 'Email belum diatur' ?>
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Contact Form & Map -->
        <div class="row g-4">
            <!-- Contact Form -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-5">
                        <h4 class="fw-bold mb-4">Kirim Pesan</h4>

                        <form id="contactForm" method="post">
                            <?= csrf_field() ?>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama" required
                                        placeholder="Nama Anda">
                                    <div class="invalid-feedback error-nama"></div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">No. HP <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="nohp" required
                                        placeholder="08xx xxxx xxxx">
                                    <div class="invalid-feedback error-nohp"></div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required
                                        placeholder="email@example.com">
                                    <div class="invalid-feedback error-email"></div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Subjek <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="subjek" required
                                        placeholder="Subjek pesan">
                                    <div class="invalid-feedback error-subjek"></div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Pesan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="pesan" rows="6" required
                                        placeholder="Tuliskan pesan Anda di sini..."></textarea>
                                    <div class="invalid-feedback error-pesan"></div>
                                </div>

                                <!-- ReCAPTCHA -->
                                <?php if (!empty($sitekey)): ?>
                                    <div class="col-md-12">
                                        <div class="g-recaptcha" data-sitekey="<?= $sitekey ?>"></div>
                                    </div>
                                <?php endif; ?>

                                <!-- Submit Button -->
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Map & Social Media -->
            <div class="col-lg-6">
                <!-- Google Maps -->
                <?php if (!empty($konfigurasi->google_map)): ?>
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-body p-0">
                            <div class="map-container" style="height: 400px; border-radius: 0.375rem; overflow: hidden;">
                                <?= $konfigurasi->google_map ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Social Media Links -->
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Ikuti Kami</h5>
                        <div class="social-links d-flex flex-wrap gap-2">
                            <?php if (!empty($konfigurasi->facebook)): ?>
                                <a href="<?= $konfigurasi->facebook ?>" target="_blank"
                                    class="btn btn-outline-primary flex-fill">
                                    <i class="fab fa-facebook-f me-2"></i> Facebook
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($konfigurasi->instagram)): ?>
                                <a href="<?= $konfigurasi->instagram ?>" target="_blank"
                                    class="btn btn-outline-danger flex-fill">
                                    <i class="fab fa-instagram me-2"></i> Instagram
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($konfigurasi->twitter)): ?>
                                <a href="<?= $konfigurasi->twitter ?>" target="_blank"
                                    class="btn btn-outline-info flex-fill">
                                    <i class="fab fa-twitter me-2"></i> Twitter
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($konfigurasi->youtube)): ?>
                                <a href="<?= $konfigurasi->youtube ?>" target="_blank"
                                    class="btn btn-outline-danger flex-fill">
                                    <i class="fab fa-youtube me-2"></i> YouTube
                                </a>
                            <?php endif; ?>
                        </div>

                        <!-- Office Hours (if you have it) -->
                        <hr class="my-4">
                        <h6 class="fw-bold mb-3">Jam Operasional</h6>
                        <div class="text-muted small">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Senin - Jumat</span>
                                <span class="fw-bold">08:00 - 16:00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Sabtu</span>
                                <span class="fw-bold">08:00 - 12:00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Minggu</span>
                                <span class="text-danger fw-bold">Tutup</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================> Contact Section End Here <================== -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php if (!empty($sitekey)): ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#contactForm').on('submit', function (e) {
            e.preventDefault();

            // Clear previous errors
            $('.form-control, .form-select').removeClass('is-invalid');
            $('.invalid-feedback').html('');

            const formData = $(this).serialize();

            $.ajax({
                url: '<?= base_url('contact/send') ?>',
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
                            $('#contactForm')[0].reset();
                            if (typeof grecaptcha !== 'undefined') {
                                grecaptcha.reset();
                            }
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
                    <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                `);
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim pesan'
                    });

                    $('button[type="submit"]').prop('disabled', false).html(`
                    <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                `);
                }
            });
        });
    });
</script>

<style>
    .contact-info-card {
        transition: all 0.3s ease;
    }

    .contact-info-card:hover {
        transform: translateY(-5px);
    }

    .hover-shadow:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }

    .hover-text-primary:hover {
        color: var(--primary-yellow, #ffc107) !important;
    }

    .transition {
        transition: all 0.3s ease;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }

    .social-links .btn {
        min-width: 120px;
    }
</style>

<?= $this->endSection() ?>