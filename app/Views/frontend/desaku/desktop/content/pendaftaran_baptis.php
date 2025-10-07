<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<section class="container mt-lg-0 mt-0 pb-1">
    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue">Pendaftaran Baptis</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active">Pendaftaran Baptis</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="container pb-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-water"></i> Form Pendaftaran Baptis</h5>
                </div>
                <div class="card-body">
                    <!-- Info -->
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Informasi:</strong> Silakan isi form di bawah ini dengan lengkap dan benar. 
                        Data yang Anda masukkan akan diverifikasi oleh admin.
                    </div>

                    <!-- Form -->
                    <form action="<?= base_url('pendaftaran-baptis/submit') ?>" method="post" enctype="multipart/form-data" id="form-baptis">
                        <?= csrf_field() ?>

                        <!-- Data Pribadi -->
                        <h6 class="text-primary mb-3"><i class="fas fa-user"></i> Data Pribadi</h6>

                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp">No. HP/WA <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="no_hp" name="no_hp" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Data Orang Tua -->
                        <h6 class="text-primary mb-3"><i class="fas fa-users"></i> Data Orang Tua</h6>

                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat_ortu">Alamat Orang Tua</label>
                            <textarea class="form-control" id="alamat_ortu" name="alamat_ortu" rows="2"></textarea>
                        </div>

                        <hr class="my-4">

                        <!-- Data Baptis -->
                        <h6 class="text-primary mb-3"><i class="fas fa-water"></i> Data Baptis</h6>

                        <div class="form-group">
                            <label for="jenis_baptis">Jenis Baptis <span class="text-danger">*</span></label>
                            <select class="form-control" id="jenis_baptis" name="jenis_baptis" required>
                                <option value="">-- Pilih --</option>
                                <option value="Baptis Anak">Baptis Anak</option>
                                <option value="Baptis Dewasa">Baptis Dewasa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_diinginkan">Tanggal yang Diinginkan</label>
                            <input type="date" class="form-control" id="tanggal_diinginkan" name="tanggal_diinginkan">
                            <small class="form-text text-muted">Tanggal ini bersifat usulan, akan dikonfirmasi oleh admin</small>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan Tambahan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" 
                                      placeholder="Informasi tambahan yang perlu disampaikan"></textarea>
                        </div>

                        <hr class="my-4">

                        <!-- Upload Dokumen -->
                        <h6 class="text-primary mb-3"><i class="fas fa-file-upload"></i> Upload Dokumen</h6>

                        <div class="alert alert-warning">
                            <small>
                                <i class="fas fa-exclamation-triangle"></i> 
                                <strong>Dokumen yang diperlukan:</strong>
                                <ul class="mb-0 pl-3">
                                    <li>Foto Copy KTP</li>
                                    <li>Foto Copy Kartu Keluarga</li>
                                    <li>Surat Keterangan Baptis (jika sudah pernah dibaptis)</li>
                                </ul>
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="dokumen_ktp">Upload KTP <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="dokumen_ktp" name="dokumen_ktp" 
                                       accept=".pdf,.jpg,.jpeg,.png" required>
                                <label class="custom-file-label" for="dokumen_ktp">Pilih file...</label>
                            </div>
                            <small class="form-text text-muted">Format: PDF, JPG, PNG (Max: 2MB)</small>
                        </div>

                        <div class="form-group">
                            <label for="dokumen_kk">Upload Kartu Keluarga <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="dokumen_kk" name="dokumen_kk" 
                                       accept=".pdf,.jpg,.jpeg,.png" required>
                                <label class="custom-file-label" for="dokumen_kk">Pilih file...</label>
                            </div>
                            <small class="form-text text-muted">Format: PDF, JPG, PNG (Max: 2MB)</small>
                        </div>

                        <div class="form-group">
                            <label for="dokumen_lainnya">Upload Dokumen Lainnya (Opsional)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="dokumen_lainnya" name="dokumen_lainnya" 
                                       accept=".pdf,.jpg,.jpeg,.png">
                                <label class="custom-file-label" for="dokumen_lainnya">Pilih file...</label>
                            </div>
                            <small class="form-text text-muted">Format: PDF, JPG, PNG (Max: 2MB)</small>
                        </div>

                        <hr class="my-4">

                        <!-- Pernyataan -->
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="pernyataan" name="pernyataan" required>
                                <label class="custom-control-label" for="pernyataan">
                                    Saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">
                                <i class="fas fa-paper-plane"></i> Kirim Pendaftaran
                            </button>
                            <a href="<?= base_url() ?>" class="btn btn-secondary btn-block">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    // Custom file input label
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName);
    });

    // Form validation
    $('#form-baptis').on('submit', function(e) {
        e.preventDefault();
        
        // Validate file size
        let valid = true;
        $('.custom-file-input').each(function() {
            if (this.files.length > 0) {
                let fileSize = this.files[0].size / 1024 / 1024; // MB
                if (fileSize > 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: 'Ukuran file ' + $(this).attr('id') + ' melebihi 2MB'
                    });
                    valid = false;
                    return false;
                }
            }
        });

        if (!valid) return false;

        // Show loading
        Swal.fire({
            title: 'Mengirim Data...',
            html: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Submit form
        let formData = new FormData(this);
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.sukses,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '<?= base_url() ?>';
                    });
                } else if (response.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.error
                    });
                }
            },
            error: function(xhr) {
                let errorMsg = 'Terjadi kesalahan. Silahkan coba lagi.';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMsg = xhr.responseJSON.error;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMsg
                });
            }
        });
    });

    // Auto calculate age
    $('#tanggal_lahir').on('change', function() {
        let birthDate = new Date($(this).val());
        let today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        let m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        
        // Auto select jenis baptis based on age
        if (age < 12) {
            $('#jenis_baptis').val('Baptis Anak');
        } else {
            $('#jenis_baptis').val('Baptis Dewasa');
        }
    });
});
</script>

<style>
.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.custom-file-label::after {
    content: "Browse";
}

.text-danger {
    color: #dc3545 !important;
}
</style>

<?= $this->endSection() ?>
