<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Majelis Gereja</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Page Title -->
<section class="page-title-section">
    <div class="container">
        <h1 class="page-title">Majelis Gereja</h1>
        <p class="page-subtitle">Daftar Majelis dan Pelayan Gereja</p>
    </div>
</section>

<!-- Filter Section -->
<section class="filter-section py-3 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mb-3"><i class="fas fa-filter"></i> Filter Berdasarkan Jabatan</h5>
                <div class="btn-group-wrapper">
                    <a href="<?= base_url('majelis-gereja') ?>" class="btn btn-sm btn-outline-primary mb-2">
                        <i class="fas fa-users"></i> Semua
                    </a>
                    <?php if ($jabatan) : ?>
                        <?php foreach ($jabatan as $jab) : ?>
                            <a href="<?= base_url('majelis-gereja?jabatan=' . $jab['jabatan_id']) ?>" 
                               class="btn btn-sm btn-outline-primary mb-2">
                                <?= esc($jab['nama_jabatan']) ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Majelis List -->
<section class="majelis-list-section py-4">
    <div class="container">
        <div class="row">
            <?php if ($majelis) : ?>
                <?php foreach ($majelis as $data) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card majelis-card h-100">
                            <div class="card-img-wrapper">
                                <?php if ($data['gambar']) : ?>
                                    <img src="<?= base_url('/public/img/informasi/majelis/' . esc($data['gambar'])) ?>" 
                                         class="card-img-top" alt="<?= esc($data['nama']) ?>">
                                <?php else : ?>
                                    <img src="<?= base_url('/public/img/no-image.png') ?>" 
                                         class="card-img-top" alt="No Image">
                                <?php endif; ?>
                                
                                <?php if ($data['status_jabatan'] == 'Aktif') : ?>
                                    <span class="badge badge-success status-badge">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= esc($data['nama']) ?></h5>
                                <p class="text-primary mb-2">
                                    <i class="fas fa-user-tie"></i> <strong><?= esc($data['jenis_jabatan']) ?></strong>
                                </p>
                                
                                <?php if (!empty($data['gereja_asal'])) : ?>
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-church"></i> <?= esc($data['gereja_asal']) ?>
                                    </p>
                                <?php endif; ?>
                                
                                <?php if (!empty($data['tanggal_pelantikan'])) : ?>
                                    <p class="text-muted small mb-3">
                                        <i class="fas fa-calendar"></i> 
                                        <?= date('d M Y', strtotime($data['tanggal_pelantikan'])) ?>
                                    </p>
                                <?php endif; ?>
                                
                                <a href="<?= base_url('majelis-gereja/detail/' . $data['majelis_id']) ?>" 
                                   class="btn btn-primary btn-sm btn-block">
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
.page-title-section {
    background: #f8f9fa;
    padding: 30px 0;
    border-bottom: 3px solid #007bff;
}

.page-title {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

.page-subtitle {
    color: #666;
    margin-bottom: 0;
}

.btn-group-wrapper .btn {
    margin-right: 5px;
}

.majelis-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.majelis-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.card-img-wrapper {
    position: relative;
    height: 300px;
    overflow: hidden;
}

.card-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.status-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 5px 10px;
    font-size: 0.75rem;
}

.majelis-card .card-title {
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

.majelis-card .btn-block {
    width: 100%;
}

@media (max-width: 768px) {
    .card-img-wrapper {
        height: 250px;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
}
</style>

<?= $this->endSection() ?>
