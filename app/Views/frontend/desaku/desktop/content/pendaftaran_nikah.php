<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<section class="container mt-lg-0 mt-0 pb-1">
    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue">Pendaftaran Nikah</h4>
        </div>
    </div>
</section>

<section class="container pb-4">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-ring"></i> Form Pendaftaran Nikah</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('pendaftaran-nikah/submit') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <h6 class="text-primary mb-3">Data Calon Suami</h6>
                        <div class="form-group">
                            <label>Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_pria" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tempat_lahir_pria" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_lahir_pria" required>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h6 class="text-primary mb-3">Data Calon Istri</h6>
                        <div class="form-group">
                            <label>Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_wanita" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tempat_lahir_wanita" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_lahir_wanita" required>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="form-group">
                            <label>Tanggal Pernikahan yang Diinginkan</label>
                            <input type="date" class="form-control" name="tanggal_nikah">
                        </div>
                        
                        <div class="form-group">
                            <label>No. HP <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" name="no_hp" required>
                        </div>
                        
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-paper-plane"></i> Kirim Pendaftaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
