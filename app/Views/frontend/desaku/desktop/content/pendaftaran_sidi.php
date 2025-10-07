<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<section class="container mt-lg-0 mt-0 pb-1">
    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue">Pendaftaran Sidi</h4>
        </div>
    </div>
</section>

<section class="container pb-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-book-open"></i> Form Pendaftaran Sidi</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('pendaftaran-sidi/submit') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <div class="form-group">
                            <label>Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_lengkap" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tempat_lahir" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_lahir" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alamat" rows="3" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>No. HP <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" name="no_hp" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Upload KTP</label>
                            <input type="file" class="form-control" name="dokumen_ktp" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-paper-plane"></i> Kirim Pendaftaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
