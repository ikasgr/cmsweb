<?= $this->extend('frontend/' . $folder . '/template/v_wrapper') ?>
<?= $this->section('content') ?>

<!-- Page Header -->
<section class="page-header py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-white">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('majelis-gereja') ?>" class="text-white">Majelis Gereja</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page"><?= esc($majelis['nama']) ?></li>
            </ol>
        </nav>
    </div>
</section>

<!-- Majelis Detail -->
<section class="majelis-detail py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar - Photo & Quick Info -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body text-center">
                        <?php if ($majelis['gambar']) : ?>
                            <img src="<?= base_url('/public/img/informasi/majelis/' . esc($majelis['gambar'])) ?>" 
                                 class="img-fluid rounded mb-3" alt="<?= esc($majelis['nama']) ?>"
                                 style="max-height: 400px; object-fit: cover;">
                        <?php else : ?>
                            <img src="<?= base_url('/public/img/no-image.png') ?>" 
                                 class="img-fluid rounded mb-3" alt="No Image">
                        <?php endif; ?>
                        
                        <h4 class="mb-2"><?= esc($majelis['nama']) ?></h4>
                        <p class="text-primary mb-3">
                            <i class="fas fa-user-tie"></i> <?= esc($majelis['jenis_jabatan']) ?>
                        </p>
                        
                        <?php if ($majelis['status_jabatan'] == 'Aktif') : ?>
                            <span class="badge bg-success mb-3">
                                <i class="fas fa-check-circle"></i> Status Aktif
                            </span>
                        <?php else : ?>
                            <span class="badge bg-secondary mb-3">
                                <?= esc($majelis['status_jabatan']) ?>
                            </span>
                        <?php endif; ?>
                        
                        <hr>
                        
                        <!-- Contact Info -->
                        <?php if (!empty($majelis['no_hp'])) : ?>
                            <p class="mb-2">
                                <i class="fas fa-phone text-primary"></i> 
                                <a href="tel:<?= esc($majelis['no_hp']) ?>"><?= esc($majelis['no_hp']) ?></a>
                            </p>
                        <?php endif; ?>
                        
                        <?php if (!empty($majelis['email'])) : ?>
                            <p class="mb-2">
                                <i class="fas fa-envelope text-primary"></i> 
                                <a href="mailto:<?= esc($majelis['email']) ?>"><?= esc($majelis['email']) ?></a>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Personal Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-user"></i> Informasi Pribadi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-id-card text-primary"></i> NIP:</strong><br>
                                <?= esc($majelis['nip'] ?? '-') ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-venus-mars text-primary"></i> Jenis Kelamin:</strong><br>
                                <?= esc($majelis['jk'] ?? '-') ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-map-marker-alt text-primary"></i> Tempat Lahir:</strong><br>
                                <?= esc($majelis['tempat_lahir'] ?? '-') ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="fas fa-birthday-cake text-primary"></i> Tanggal Lahir:</strong><br>
                                <?= $majelis['tgl_lahir'] ? date('d F Y', strtotime($majelis['tgl_lahir'])) : '-' ?>
                            </div>
                            <div class="col-12 mb-3">
                                <strong><i class="fas fa-home text-primary"></i> Alamat:</strong><br>
                                <?= esc($majelis['alamat'] ?? '-') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Church Service Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-church"></i> Informasi Pelayanan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php if (!empty($majelis['gereja_asal'])) : ?>
                                <div class="col-md-6 mb-3">
                                    <strong><i class="fas fa-church text-success"></i> Gereja Asal:</strong><br>
                                    <?= esc($majelis['gereja_asal']) ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($majelis['tanggal_penahbisan'])) : ?>
                                <div class="col-md-6 mb-3">
                                    <strong><i class="fas fa-hands-praying text-success"></i> Tanggal Penahbisan:</strong><br>
                                    <?= date('d F Y', strtotime($majelis['tanggal_penahbisan'])) ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($majelis['tanggal_pelantikan'])) : ?>
                                <div class="col-md-6 mb-3">
                                    <strong><i class="fas fa-calendar-check text-success"></i> Tanggal Pelantikan:</strong><br>
                                    <?= date('d F Y', strtotime($majelis['tanggal_pelantikan'])) ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($majelis['tanggal_akhir_jabatan'])) : ?>
                                <div class="col-md-6 mb-3">
                                    <strong><i class="fas fa-calendar-times text-success"></i> Akhir Masa Jabatan:</strong><br>
                                    <?= date('d F Y', strtotime($majelis['tanggal_akhir_jabatan'])) ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($majelis['komisi'])) : ?>
                                <div class="col-12 mb-3">
                                    <strong><i class="fas fa-users text-success"></i> Komisi/Bidang:</strong><br>
                                    <?= esc($majelis['komisi']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Education & Certification -->
                <?php if (!empty($majelis['pendidikan_teologi']) || !empty($majelis['sertifikasi'])) : ?>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-graduation-cap"></i> Pendidikan & Sertifikasi</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($majelis['pendidikan_teologi'])) : ?>
                                <div class="mb-3">
                                    <strong><i class="fas fa-book text-info"></i> Pendidikan Teologi:</strong><br>
                                    <?= nl2br(esc($majelis['pendidikan_teologi'])) ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($majelis['sertifikasi'])) : ?>
                                <div class="mb-3">
                                    <strong><i class="fas fa-certificate text-info"></i> Sertifikasi:</strong><br>
                                    <?= nl2br(esc($majelis['sertifikasi'])) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Bio Singkat -->
                <?php if (!empty($majelis['bio_singkat'])) : ?>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Biografi Singkat</h5>
                        </div>
                        <div class="card-body">
                            <?= nl2br(esc($majelis['bio_singkat'])) ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Majelis Terkait -->
        <?php if ($terkait) : ?>
            <div class="row mt-5">
                <div class="col-12">
                    <h4 class="mb-4"><i class="fas fa-users"></i> Majelis Lainnya</h4>
                </div>
                <?php foreach ($terkait as $data) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm hover-card">
                            <?php if ($data['gambar']) : ?>
                                <img src="<?= base_url('/public/img/informasi/majelis/' . esc($data['gambar'])) ?>" 
                                     class="card-img-top" alt="<?= esc($data['nama']) ?>"
                                     style="height: 200px; object-fit: cover;">
                            <?php else : ?>
                                <img src="<?= base_url('/public/img/no-image.png') ?>" 
                                     class="card-img-top" alt="No Image"
                                     style="height: 200px; object-fit: cover;">
                            <?php endif; ?>
                            
                            <div class="card-body text-center">
                                <h6 class="card-title"><?= esc($data['nama']) ?></h6>
                                <p class="text-muted small mb-2"><?= esc($data['jenis_jabatan']) ?></p>
                                <a href="<?= base_url('majelis-gereja/detail/' . $data['majelis_id']) ?>" 
                                   class="btn btn-sm btn-outline-primary">
                                    Lihat Profil
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
}

.card-header {
    border-bottom: 3px solid rgba(0,0,0,0.1);
}
</style>

<?= $this->endSection() ?>
