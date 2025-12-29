<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3><?= isset($title) ? $title : 'Pendaftaran Baptis' ?></h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pendaftaran Baptis</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Registration Section Start <================== -->
<div class="registration-section padding--top padding--bottom bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold">Formulir Pendaftaran Baptis</h2>
                            <p class="text-muted">Silaka isi formulir di bawah ini dengan data yang benar dan valid.</p>
                        </div>

                        <form action="<?= base_url('pendaftaran-baptis/simpan') ?>" method="post"
                            enctype="multipart/form-data" id="formPendaftaran">
                            <?= csrf_field() ?>

                            <h5 class="fw-bold text-primary mb-4 border-bottom pb-2">Data Diri Calon Baptis</h5>

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

                            <h5 class="fw-bold text-primary mb-4 border-bottom pb-2 mt-5">Data Orang Tua</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah">
                                </div>
                                <div class="col-md-6">
                                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu">
                                </div>
                            </div>

                            <h5 class="fw-bold text-primary mb-4 border-bottom pb-2 mt-5">Keterangan Baptis</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="jenis_baptis" class="form-label">Jenis Baptis <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="jenis_baptis" name="jenis_baptis" required
                                        onchange="toggleSuratNikah()">
                                        <option value="">-- Pilih Jenis Baptis --</option>
                                        <option value="Baptis Anak">Baptis Anak</option>
                                        <option value="Baptis Dewasa">Baptis Dewasa</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="nama_pendamping" class="form-label">Nama Pendamping (Saksi)</label>
                                    <input type="text" class="form-control" id="nama_pendamping" name="nama_pendamping">
                                </div>
                                <div class="col-md-6">
                                    <label for="hubungan_pendamping" class="form-label">Hubungan Pendamping</label>
                                    <input type="text" class="form-control" id="hubungan_pendamping"
                                        name="hubungan_pendamping" placeholder="Contoh: Paman/Bibi">
                                </div>
                            </div>

                            <h5 class="fw-bold text-primary mb-4 border-bottom pb-2 mt-5">Dokumen Pendukung</h5>
                            <div class="alert alert-info small">
                                <i class="fas fa-info-circle me-1"></i> Format file yang diizinkan: JPG, PNG, PDF.
                                Ukuran maks: 2MB.
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="dok_ktp" class="form-label">Scan/Foto KTP <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="dok_ktp" name="dok_ktp"
                                        accept=".jpg,.jpeg,.png,.pdf" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="dok_kk" class="form-label">Scan/Foto KK <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="dok_kk" name="dok_kk"
                                        accept=".jpg,.jpeg,.png,.pdf" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="dok_akta_lahir" class="form-label">Scan/Foto Akta Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="dok_akta_lahir" name="dok_akta_lahir"
                                        accept=".jpg,.jpeg,.png,.pdf" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="dok_foto" class="form-label">Pas Foto (JPG/PNG) <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="dok_foto" name="dok_foto"
                                        accept=".jpg,.jpeg,.png" required>
                                </div>
                                <div class="col-md-6" id="suratNikahContainer" style="display:none;">
                                    <label for="dok_surat_nikah_ortu" class="form-label">Scan/Foto Surat Nikah Orang Tua
                                        <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="dok_surat_nikah_ortu"
                                        name="dok_surat_nikah_ortu" accept=".jpg,.jpeg,.png,.pdf">
                                    <div class="form-text">Wajib untuk Baptis Anak</div>
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
<!-- ================> Registration Section End <================== -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function toggleSuratNikah() {
        const jenis = document.getElementById('jenis_baptis').value;
        const container = document.getElementById('suratNikahContainer');
        const input = document.getElementById('dok_surat_nikah_ortu');

        if (jenis === 'Baptis Anak') {
            container.style.display = 'block';
            input.setAttribute('required', 'required');
        } else {
            container.style.display = 'none';
            input.removeAttribute('required');
        }
    }

    $(document).ready(function () {
        $('#formPendaftaran').on('submit', function (e) {
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
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                        $('#formPendaftaran')[0].reset();
                        $('#suratNikahContainer').hide();
                    } else {
                        // Handle validation errors or server errors
                        let errorMessage = response.message || 'Terjadi kesalahan.';
                        if (response.errors) {
                            errorMessage += '<br><ul class="text-start mt-2">';
                            $.each(response.errors, function (key, value) {
                                errorMessage += `<li>${value}</li>`;
                            });
                            errorMessage += '</ul>';
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            html: errorMessage
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan sistem: ' + error
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