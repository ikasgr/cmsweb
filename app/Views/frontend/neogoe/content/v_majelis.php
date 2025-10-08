<?= $this->extend('frontend/' . $folder . '/template/v_wrapper') ?>
<?= $this->section('content') ?>

<!-- Page Header -->
<section class="page-header py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="text-white mb-2">Majelis Gereja</h1>
                <p class="text-white-50 mb-0">Daftar Majelis dan Pelayan Gereja</p>
            </div>
            <div class="col-md-4 text-md-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-md-end bg-transparent mb-0">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-white">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Majelis Gereja</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Majelis List -->
<section class="majelis-list py-5">
    <div class="container">
        <!-- Filter by Jabatan -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3"><i class="fas fa-filter"></i> Filter Berdasarkan Jabatan</h5>
                        <div class="btn-group flex-wrap" role="group">
                            <a href="<?= base_url('majelis-gereja') ?>" class="btn btn-outline-primary">
                                <i class="fas fa-users"></i> Semua
                            </a>
                            <?php if ($jabatan) : ?>
                                <?php foreach ($jabatan as $jab) : ?>
                                    <a href="<?= base_url('majelis-gereja?jabatan=' . $jab['jabatan_id']) ?>" 
                                       class="btn btn-outline-primary">
                                        <?= esc($jab['nama_jabatan']) ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Majelis Cards -->
        <div class="row">
            <?php if ($majelis) : ?>
                <?php foreach ($majelis as $data) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-aos="fade-up">
                        <div class="card h-100 shadow-sm hover-card">
                            <div class="position-relative">
                                <?php if ($data['gambar']) : ?>
                                    <img src="<?= base_url('/public/img/informasi/majelis/' . esc($data['gambar'])) ?>" 
                                         class="card-img-top" alt="<?= esc($data['nama']) ?>"
                                         style="height: 300px; object-fit: cover;">
                                <?php else : ?>
                                    <img src="<?= base_url('/public/img/no-image.png') ?>" 
                                         class="card-img-top" alt="No Image"
                                         style="height: 300px; object-fit: cover;">
                                <?php endif; ?>
                                
                                <?php if ($data['status_jabatan'] == 'Aktif') : ?>
                                    <span class="badge bg-success position-absolute top-0 end-0 m-2">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2"><?= esc($data['nama']) ?></h5>
                                <p class="text-primary mb-2">
                                    <i class="fas fa-user-tie"></i> <?= esc($data['jenis_jabatan']) ?>
                                </p>
                                
                                <?php if (!empty($data['gereja_asal'])) : ?>
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-church"></i> <?= esc($data['gereja_asal']) ?>
                                    </p>
                                <?php endif; ?>
                                
                                <?php if (!empty($data['tanggal_pelantikan'])) : ?>
                                    <p class="text-muted small mb-3">
                                        <i class="fas fa-calendar"></i> 
                                        Dilantik: <?= date('d M Y', strtotime($data['tanggal_pelantikan'])) ?>
                                    </p>
                                <?php endif; ?>
                                
                                <a href="<?= base_url('majelis-gereja/detail/' . $data['majelis_id']) ?>" 
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> Lihat Profil
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Belum ada data majelis gereja.
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if ($pager) : ?>
            <div class="row mt-4">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <?= $pager->links('majelis', 'bootstrap_pagination') ?>
                    </nav>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
}

.page-header {
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
    background-size: cover;
    opacity: 0.3;
}

.btn-group .btn {
    margin: 2px;
}
</style>

<?= $this->endSection() ?>
