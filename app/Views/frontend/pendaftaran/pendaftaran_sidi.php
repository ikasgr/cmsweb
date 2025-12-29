<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3><?= isset($title) ? $title : 'Pendaftaran Sidi' ?></h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pendaftaran Sidi</li>
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
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold">Formulir Pendaftaran Sidi</h2>
                            <p class="text-muted">Katekisasi Sidi / Peneguhan Sidi</p>
                        </div>

                        <form action="<?= base_url('pendaftaran-sidi/simpanpendaftaran') ?>" method="post"
                            id="formPendaftaranSidi">
                            <?= csrf_field() ?>

                            <h5 class="fw-bold text-primary mb-4 border-bottom pb-2">Data Diri Peserta</h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                                </div>
                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat Lengkap <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                        required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="no_hp" class="form-label">Nomor HP/WA <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="no_hp" name="no_hp" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>

                            <h5 class="fw-bold text-primary mb-4 border-bottom pb-2 mt-5">Data Keluarga & Gereja</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah">
                                </div>
                                <div class="col-md-6">
                                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu">
                                </div>
                                <div class="col-md-6">
                                    <label for="tgl_baptis" class="form-label">Tanggal Baptis Anak <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tgl_baptis" name="tgl_baptis" required>
                                    <div class="form-text">Tanggal saat Anda dibaptis waktu kecil.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="gereja_baptis" class="form-label">Asal Gereja Baptis</label>
                                    <input type="text" class="form-control" id="gereja_baptis" name="gereja_baptis"
                                        placeholder="Nama gereja tempat dibaptis">
                                </div>
                            </div>

                            <div class="mt-5 text-center">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Pendaftaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#formPendaftaranSidi').on('submit', function (e) {
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
                        $('#formPendaftaranSidi')[0].reset();
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
                    } else if (response.gagal) {
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