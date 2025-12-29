<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>Survei Kepuasan</h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Survei</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Survey Section Start Here <================== -->
<div class="service padding--top padding--bottom bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?php if (!empty($surveytopik)): ?>
                    <?php foreach ($surveytopik as $survey): ?>
                        <div class="card border-0 shadow-sm rounded-3 mb-5">
                            <div class="card-body p-5">
                                <!-- Survey Header -->
                                <div class="text-center mb-5">
                                    <div class="mb-3">
                                        <i class="fas fa-clipboard-list text-primary" style="font-size: 3rem;"></i>
                                    </div>
                                    <h2 class="fw-bold mb-3"><?= esc($survey['nama_survey']) ?></h2>
                                    <p class="text-muted">Masukan dan saran Anda sangat berharga bagi kami</p>
                                </div>

                                <!-- Survey Form -->
                                <form id="surveyForm" method="post" action="<?= base_url('survey/simpanResponden') ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="survey_id" value="<?= $survey['survey_id'] ?>">

                                    <!-- Personal Information -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Nama Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nama" required
                                                placeholder="Masukkan nama Anda">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Nomor HP <span
                                                    class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" name="nohp" required
                                                placeholder="08xx xxxx xxxx">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Email</label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="email@example.com">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Pendidikan</label>
                                            <select class="form-select" name="pendidikan">
                                                <option value="">Pilih Pendidikan</option>
                                                <?php if (!empty($pendidikan)): ?>
                                                    <?php foreach ($pendidikan as $pdk): ?>
                                                        <option value="<?= isset($pdk['masterdata_id']) ? $pdk['masterdata_id'] : '' ?>"><?= isset($pdk['nama_data']) ? esc($pdk['nama_data']) : '' ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Pekerjaan</label>
                                            <select class="form-select" name="pekerjaan">
                                                <option value="">Pilih Pekerjaan</option>
                                                <?php if (!empty($pekerjaan)): ?>
                                                    <?php foreach ($pekerjaan as $pkr): ?>
                                                        <option value="<?= isset($pkr['masterdata_id']) ? $pkr['masterdata_id'] : '' ?>"><?= isset($pkr['nama_data']) ? esc($pkr['nama_data']) : '' ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <hr class="my-5">

                                    <!-- Survey Questions -->
                                    <h5 class="fw-bold mb-4">Pertanyaan Survei</h5>

                                    <div id="surveyQuestions">
                                        <!-- Questions will be loaded here via AJAX -->
                                        <div class="text-center py-5">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <p class="mt-3 text-muted">Memuat pertanyaan...</p>
                                        </div>
                                    </div>

                                    <!-- Feedback Section -->
                                    <div class="mt-5">
                                        <label class="form-label fw-bold">Kritik & Saran</label>
                                        <textarea class="form-control" name="pesan" rows="5"
                                            placeholder="Tuliskan kritik dan saran Anda di sini..."></textarea>
                                    </div>

                                    <!-- ReCAPTCHA -->
                                    <?php if (!empty($sitekey)): ?>
                                        <div class="mt-4">
                                            <div class="g-recaptcha" data-sitekey="<?= $sitekey ?>"></div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Submit Button -->
                                    <div class="mt-5 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            <i class="fas fa-paper-plane me-2"></i> Kirim Survei
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-poll fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada survei aktif saat ini</h5>
                            <p class="text-muted">Terima kasih atas perhatian Anda</p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Pagination -->
                <?php if (!empty($pager)): ?>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center">
                            <?= $pager->links('hal', 'bootstrap_pagination') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- ================> Survey Section End Here <================== -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php if (!empty($sitekey)): ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

<script>
    $(document).ready(function () {
        // Load survey questions
        loadQuestions();

        function loadQuestions() {
            const surveyId = $('input[name="survey_id"]').val();

            $.ajax({
                url: '<?= base_url('survey/getQuestions') ?>',
                type: 'POST',
                data: {
                    survey_id: surveyId,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                success: function (response) {
                    if (response.data) {
                        $('#surveyQuestions').html(response.data);
                    } else {
                        $('#surveyQuestions').html(`
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Belum ada pertanyaan untuk survei ini
                        </div>
                    `);
                    }
                },
                error: function () {
                    $('#surveyQuestions').html(`
                    <div class="alert alert-danger">
                        <i class="fas fa-times-circle me-2"></i>
                        Gagal memuat pertanyaan
                    </div>
                `);
                }
            });
        }

        // Form submission
        $('#surveyForm').on('submit', function (e) {
            e.preventDefault();

            const formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
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
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Terima Kasih!',
                            text: response.sukses,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });
                    } else if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: Object.values(response.error).join('\n')
                        });
                        $('button[type="submit"]').prop('disabled', false).html(`
                        <i class="fas fa-paper-plane me-2"></i> Kirim Survei
                    `);
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim survei'
                    });
                    $('button[type="submit"]').prop('disabled', false).html(`
                    <i class="fas fa-paper-plane me-2"></i> Kirim Survei
                `);
                }
            });
        });
    });
</script>

<style>
    .form-check-input[type="radio"] {
        width: 1.25rem;
        height: 1.25rem;
        margin-top: 0.125rem;
    }

    .form-check-label {
        margin-left: 0.5rem;
        cursor: pointer;
    }

    .question-item {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .question-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .rating-group {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .rating-option {
        flex: 1;
        min-width: 150px;
    }
</style>

<?= $this->endSection() ?>