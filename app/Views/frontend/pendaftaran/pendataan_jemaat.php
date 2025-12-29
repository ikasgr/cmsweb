<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3><?= isset($title) ? $title : 'Pendataan Jemaat' ?></h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pendataan Jemaat</li>
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
                            <h2 class="fw-bold">Formulir Pendataan Jemaat</h2>
                            <p class="text-muted">Mohon lengkapi data diri Anda untuk database jemaat gereja.</p>
                        </div>

                        <form action="<?= base_url('pendataan-jemaat/simpan') ?>" method="post"
                            id="formPendataanJemaat">
                            <?= csrf_field() ?>

                            <h5 class="fw-bold text-primary mb-4 border-bottom pb-2">Informasi Pribadi</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">NIK / No. KTP <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="nik" required
                                        placeholder="16 digit NIK">
                                    <div class="form-text">Digunakan sebagai identifikasi unik (No Anggota).</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_lengkap" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Nama Panggilan</label>
                                    <input type="text" class="form-control" name="nama_panggilan">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tempat_lahir" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tgl_lahir" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-select" name="jenis_kelamin" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pendikikan Terakhir</label>
                                    <select class="form-select" name="pendidikan">
                                        <option value="">-- Pilih --</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA/SMK">SMA/SMK</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" name="pekerjaan">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Status Pernikahan</label>
                                    <select class="form-select" name="status_pernikahan">
                                        <option value="">-- Pilih --</option>
                                        <option value="Belum Menikah">Belum Menikah</option>
                                        <option value="Menikah">Menikah</option>
                                        <option value="Duda/Janda">Duda/Janda</option>
                                    </select>
                                </div>
                            </div>

                            <h5 class="fw-bold text-primary mb-4 border-bottom pb-2 mt-5">Kontak & Alamat</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Alamat Lengkap (Jalan/Gang/No.Rumah) <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="alamat_lengkap" rows="2" required></textarea>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">RT / RW</label>
                                    <input type="text" class="form-control" name="rt_rw" placeholder="Contoh: 001/002">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Kelurahan</label>
                                    <input type="text" class="form-control" name="kelurahan">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control" name="kecamatan">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Kota/Kabupaten</label>
                                    <input type="text" class="form-control" name="kota">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Kode Pos</label>
                                    <input type="text" class="form-control" name="kode_pos">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No. HP / WA <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="no_hp" required
                                        placeholder="08xxxxxxxxxx">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>

                            <h5 class="fw-bold text-primary mb-4 border-bottom pb-2 mt-5">Data Keluarga & Gerejawi</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Ayah</label>
                                    <input type="text" class="form-control" name="nama_ayah">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control" name="nama_ibu">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Pasangan (Suami/Istri)</label>
                                    <input type="text" class="form-control" name="nama_pasangan"
                                        placeholder="Jika sudah menikah">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Gereja Asal (Sebelumnya)</label>
                                    <input type="text" class="form-control" name="gereja_asal"
                                        placeholder="Isi jika pindahan">
                                </div>
                            </div>

                            <div class="mt-5 text-center">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">
                                    <i class="fas fa-save me-2"></i> Simpan Data Jemaat
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
        $('#formPendataanJemaat').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            var submitBtn = $(this).find('button[type="submit"]');
            var originalBtnText = submitBtn.html();

            submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i> Menyimpan...').prop('disabled', true);

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
                            title: 'Terima Kasih!',
                            text: response.sukses,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                        $('#formPendataanJemaat')[0].reset();
                    } else if (response.error) {
                        let errorMessage = 'Terjadi kesalahan validasi:<br><ul class="text-start mt-2">';
                        $.each(response.error, function (key, value) {
                            errorMessage += `<li>${value}</li>`;
                        });
                        errorMessage += '</ul>';

                        Swal.fire({
                            icon: 'warning',
                            title: 'Mohon Periksa Data Anda',
                            html: errorMessage
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Sistem',
                        text: 'Terjadi kesalahan saat memproses data. Silakan coba lagi.'
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