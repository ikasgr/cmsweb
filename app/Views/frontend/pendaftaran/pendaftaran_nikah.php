<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3><?= isset($title) ? $title : 'Pendaftaran Pernikahan' ?></h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pendaftaran Pernikahan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<div class="registration-section padding--top padding--bottom bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold">Formulir Pendaftaran Pernikahan</h2>
                            <p class="text-muted">Mohon isi data kedua calon mempelai dengan lengkap dan benar.</p>
                        </div>

                        <form action="<?= base_url('pendaftaran-nikah/simpanpendaftaran') ?>" method="post"
                            id="formPendaftaranNikah">
                            <?= csrf_field() ?>

                            <div class="row">
                                <!-- KOLOM PRIA -->
                                <div class="col-lg-6 mb-4 mb-lg-0 border-end-lg">
                                    <h5 class="fw-bold text-primary mb-4 border-bottom pb-2">
                                        <i class="fas fa-male me-2"></i> Data Calon Suami
                                    </h5>

                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nama_pria" required>
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir_pria">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Tanggal Lahir <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="tgl_lahir_pria" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control" name="alamat_pria" rows="2"></textarea>
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <label class="form-label">No HP/WA <span
                                                    class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" name="no_hp_pria" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email_pria" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Pekerjaan</label>
                                        <input type="text" class="form-control" name="pekerjaan_pria">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status Baptis</label>
                                        <select class="form-select" name="status_baptis_pria">
                                            <option value="">-- Pilih --</option>
                                            <option value="Sudah">Sudah Baptis</option>
                                            <option value="Belum">Belum Baptis</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Asal Gereja</label>
                                        <input type="text" class="form-control" name="gereja_baptis_pria"
                                            placeholder="Jika sudah baptis">
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="form-label">Nama Ayah</label>
                                            <input type="text" class="form-control" name="nama_ayah_pria">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Nama Ibu</label>
                                            <input type="text" class="form-control" name="nama_ibu_pria">
                                        </div>
                                    </div>
                                </div>

                                <!-- KOLOM WANITA -->
                                <div class="col-lg-6 ps-lg-4">
                                    <h5 class="fw-bold text-danger mb-4 border-bottom pb-2">
                                        <i class="fas fa-female me-2"></i> Data Calon Istri
                                    </h5>

                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nama_wanita" required>
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir_wanita">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Tanggal Lahir <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="tgl_lahir_wanita" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control" name="alamat_wanita" rows="2"></textarea>
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <label class="form-label">No HP/WA <span
                                                    class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" name="no_hp_wanita" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email_wanita" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Pekerjaan</label>
                                        <input type="text" class="form-control" name="pekerjaan_wanita">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status Baptis</label>
                                        <select class="form-select" name="status_baptis_wanita">
                                            <option value="">-- Pilih --</option>
                                            <option value="Sudah">Sudah Baptis</option>
                                            <option value="Belum">Belum Baptis</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Asal Gereja</label>
                                        <input type="text" class="form-control" name="gereja_baptis_wanita"
                                            placeholder="Jika sudah baptis">
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="form-label">Nama Ayah</label>
                                            <input type="text" class="form-control" name="nama_ayah_wanita">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Nama Ibu</label>
                                            <input type="text" class="form-control" name="nama_ibu_wanita">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-12">
                                    <h5 class="fw-bold text-success mb-4 border-bottom pb-2">
                                        <i class="fas fa-calendar-alt me-2"></i> Rencana Pernikahan
                                    </h5>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Pernikahan Diinginkan <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tgl_nikah_diinginkan" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tempat Pernikahan</label>
                                    <input type="text" class="form-control" name="tempat_nikah"
                                        placeholder="Nama Gereja / Lokasi">
                                </div>
                            </div>

                            <!-- Google reCAPTCHA v2 (Invisible or Checkbox) - Using generic placeholder class if configured -->
                            <!-- <div class="g-recaptcha my-3" data-sitekey="YOUR_SITE_KEY"></div> -->

                            <div class="mt-5 text-center">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">
                                    <i class="fas fa-heart me-2"></i> Daftarkan Pernikahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (min-width: 992px) {
        .border-end-lg {
            border-right: 1px solid #dee2e6;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#formPendaftaranNikah').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            var submitBtn = $(this).find('button[type="submit"]');
            var originalBtnText = submitBtn.html();

            submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i> Mengirim...').prop('disabled', true);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Data Terkirim!',
                            text: response.sukses,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                        $('#formPendaftaranNikah')[0].reset();
                    } else if (response.error) {
                        let errorMessage = 'Terjadi kesalahan validasi:<br><ul class="text-start mt-2">';
                        $.each(response.error, function (key, value) {
                            errorMessage += `<li>${value}</li>`;
                        });
                        errorMessage += '</ul>';

                        Swal.fire({
                            icon: 'warning',
                            title: 'Periksa Kembali Form Anda',
                            html: errorMessage
                        });
                    } else if (response.gagal) { // Recaptcha fail
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.gagal
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan sistem.'
                    });
                },
                complete: function () {
                    submitBtn.html(originalBtnText).prop('disabled', false);
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>