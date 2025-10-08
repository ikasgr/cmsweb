<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('majelis-gereja') ?>">Majelis Gereja</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($majelis['nama']) ?></li>
            </ol>
        </nav>
    </div>
</section>

<!-- Majelis Detail -->
<section class="majelis-detail-section py-4">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <?php if ($majelis['gambar']) : ?>
                            <img src="<?= base_url('/public/img/informasi/majelis/' . esc($majelis['gambar'])) ?>" 
                                 class="img-fluid rounded mb-3" alt="<?= esc($majelis['nama'])?>">
                        <?php else : ?>
                            <img src="<?= base_url('/public/img/no-image.png') ?>" 
                                 class="img-fluid rounded mb-3" alt="No Image">
                        <?php endif; ?>
                        
                        <h4><?= esc($majelis['nama']) ?></h4>
                        <p class="text-primary">
                            <i class="fas fa-user-tie"></i> <?= esc($majelis['jenis_jabatan']) ?>
                        </p>
                        
                        <?php if ($majelis['status_jabatan'] == 'Aktif') : ?>
                            <span class="badge badge-success mb-3">
                                <i class="fas fa-check-circle"></i> Status Aktif
                            </span>
                        <?php else : ?>
                            <span class="badge badge-secondary mb-3">
                                <?= esc($majelis['status_jabatan']) ?>
                            </span>
                        <?php endif; ?>
                        
                        <hr>
                        
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
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-user"></i> Informasi Pribadi</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>NIP</strong></td>
                                <td><?= esc($majelis['nip'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td><?= esc($majelis['jk'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tempat, Tanggal Lahir</strong></td>
                                <td>
                                    <?= esc($majelis['tempat_lahir'] ?? '-') ?>, 
                                    <?= $majelis['tgl_lahir'] ? date('d F Y', strtotime($majelis['tgl_lahir'])) : '-' ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td><?= esc($majelis['alamat'] ?? '-') ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <!-- Church Service Information -->
                <div class="card mb-3">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-church"></i> Informasi Pelayanan</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <?php if (!empty($majelis['gereja_asal'])) : ?>
                                <tr>
                                    <td width="40%"><strong>Gereja Asal</strong></td>
                                    <td><?= esc($majelis['gereja_asal']) ?></td>
                                </tr>
                            <?php endif; ?>
                            
                            <?php if (!empty($majelis['tanggal_penahbisan'])) : ?>
                                <tr>
                                    <td><strong>Tanggal Penahbisan</strong></td>
                                    <td><?= date('d F Y', strtotime($majelis['tanggal_penahbisan'])) ?></td>
                                </tr>
                            <?php endif; ?>
                            
                            <?php if (!empty($majelis['tanggal_pelantikan'])) : ?>
                                <tr>
                                    <td><strong>Tanggal Pelantikan</strong></td>
                                    <td><?= date('d F Y', strtotime($majelis['tanggal_pelantikan'])) ?></td>
                                </tr>
                            <?php endif; ?>
                            
                            <?php if (!empty($majelis['tanggal_akhir_jabatan'])) : ?>
                                <tr>
                                    <td><strong>Akhir Masa Jabatan</strong></td>
                                    <td><?= date('d F Y', strtotime($majelis['tanggal_akhir_jabatan'])) ?></td>
                                </tr>
                            <?php endif; ?>
                            
                            <?php if (!empty($majelis['komisi'])) : ?>
                                <tr>
                                    <td><strong>Komisi/Bidang</strong></td>
                                    <td><?= esc($majelis['komisi']) ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
                
                <!-- Education & Certification -->
                <?php if (!empty($majelis['pendidikan_teologi']) || !empty($majelis['sertifikasi'])) : ?>
                    <div class="card mb-3">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-graduation-cap"></i> Pendidikan & Sertifikasi</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($majelis['pendidikan_teologi'])) : ?>
                                <div class="mb-3">
                                    <strong>Pendidikan Teologi:</strong><br>
                                    <?= nl2br(esc($majelis['pendidikan_teologi'])) ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($majelis['sertifikasi'])) : ?>
                                <div>
                                    <strong>Sertifikasi:</strong><br>
                                    <?= nl2br(esc($majelis['sertifikasi'])) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Bio -->
                <?php if (!empty($majelis['bio_singkat'])) : ?>
                    <div class="card mb-3">
                        <div class="card-header bg-warning">
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
            <div class="row mt-4">
                <div class="col-12">
                    <h4 class="mb-3"><i class="fas fa-users"></i> Majelis Lainnya</h4>
                </div>
                <?php foreach ($terkait as $data) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="card h-100">
                            <?php if ($data['gambar']) : ?>
                                <img src="<?= base_url('/public/img/informasi/majelis/' . esc($data['gambar'])) ?>" 
                                     class="card-img-top" alt="<?= esc($data['nama']) ?>" style="height: 200px; object-fit: cover;">
                            <?php else : ?>
                                <img src="<?= base_url('/public/img/no-image.png') ?>" 
                                     class="card-img-top" alt="No Image" style="height: 200px; object-fit: cover;">
                            <?php endif; ?>
                            
                            <div class="card-body text-center">
                                <h6><?= esc($data['nama']) ?></h6>
                                <p class="text-muted small"><?= esc($data['jenis_jabatan']) ?></p>
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

<?= $this->endSection() ?>
