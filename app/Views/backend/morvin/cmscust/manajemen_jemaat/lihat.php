<!-- Modal Lihat Detail Jemaat -->
<div class="modal fade" id="modallihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <!-- Foto dan Info Utama -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <?php if ($data['foto']) : ?>
                                    <img src="<?= base_url('public/file/foto/jemaat/' . $data['foto']) ?>" 
                                         class="rounded-circle mb-3" width="150" height="150" 
                                         style="object-fit: cover;" alt="Foto Jemaat">
                                <?php else : ?>
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                         style="width: 150px; height: 150px;">
                                        <i class="fas fa-user text-muted" style="font-size: 60px;"></i>
                                    </div>
                                <?php endif; ?>
                                
                                <h4 class="mb-1"><?= esc($data['nama_lengkap']) ?></h4>
                                <?php if ($data['nama_panggilan']) : ?>
                                    <p class="text-muted mb-2">"<?= esc($data['nama_panggilan']) ?>"</p>
                                <?php endif; ?>
                                
                                <span class="badge bg-primary fs-6 mb-2"><?= esc($data['no_anggota']) ?></span>
                                
                                <?php
                                $statusClass = [
                                    'Aktif' => 'bg-success',
                                    'Pindah' => 'bg-warning',
                                    'Meninggal' => 'bg-secondary',
                                    'Non-Aktif' => 'bg-danger'
                                ];
                                ?>
                                <br>
                                <span class="badge <?= $statusClass[$data['status_keanggotaan']] ?> fs-6">
                                    <?= esc($data['status_keanggotaan']) ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Data Pribadi -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-user"></i> Data Pribadi</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="40%"><strong>Tempat Lahir</strong></td>
                                                <td>: <?= esc($data['tempat_lahir']) ?: '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Lahir</strong></td>
                                                <td>: <?= date('d F Y', strtotime($data['tgl_lahir'])) ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Umur</strong></td>
                                                <td>: <?= date_diff(date_create($data['tgl_lahir']), date_create('today'))->y ?> tahun</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jenis Kelamin</strong></td>
                                                <td>: <?= $data['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status Pernikahan</strong></td>
                                                <td>: <?= esc($data['status_pernikahan']) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="40%"><strong>Pekerjaan</strong></td>
                                                <td>: <?= esc($data['pekerjaan']) ?: '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Pendidikan</strong></td>
                                                <td>: <?= esc($data['pendidikan']) ?: '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>No. HP</strong></td>
                                                <td>: <?= esc($data['no_hp']) ?: '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email</strong></td>
                                                <td>: <?= esc($data['email']) ?: '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Nama Ayah</strong></td>
                                                <td>: <?= esc($data['nama_ayah']) ?: '-' ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-map-marker-alt"></i> Alamat</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="mb-2"><strong>Alamat Lengkap:</strong></p>
                                <p><?= nl2br(esc($data['alamat_lengkap'])) ?></p>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>RT/RW</strong></td>
                                        <td>: <?= esc($data['rt_rw']) ?: '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kelurahan</strong></td>
                                        <td>: <?= esc($data['kelurahan']) ?: '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kecamatan</strong></td>
                                        <td>: <?= esc($data['kecamatan']) ?: '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kota</strong></td>
                                        <td>: <?= esc($data['kota']) ?: '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kode Pos</strong></td>
                                        <td>: <?= esc($data['kode_pos']) ?: '-' ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Keluarga -->
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-users"></i> Data Keluarga</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Nama Ibu</strong></td>
                                        <td>: <?= esc($data['nama_ibu']) ?: '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama Pasangan</strong></td>
                                        <td>: <?= esc($data['nama_pasangan']) ?: '-' ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Rohani -->
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-cross"></i> Data Rohani</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="text-primary">Baptis</h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Tanggal</strong></td>
                                        <td>: <?= $data['tgl_baptis'] ? date('d F Y', strtotime($data['tgl_baptis'])) : '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tempat</strong></td>
                                        <td>: <?= esc($data['tempat_baptis']) ?: '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Pendeta</strong></td>
                                        <td>: <?= esc($data['pendeta_baptis']) ?: '-' ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-success">Sidi</h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Tanggal</strong></td>
                                        <td>: <?= $data['tgl_sidi'] ? date('d F Y', strtotime($data['tgl_sidi'])) : '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tempat</strong></td>
                                        <td>: <?= esc($data['tempat_sidi']) ?: '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Pendeta</strong></td>
                                        <td>: <?= esc($data['pendeta_sidi']) ?: '-' ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-warning">Pernikahan</h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Tanggal</strong></td>
                                        <td>: <?= $data['tgl_nikah'] ? date('d F Y', strtotime($data['tgl_nikah'])) : '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tempat</strong></td>
                                        <td>: <?= esc($data['tempat_nikah']) ?: '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Pendeta</strong></td>
                                        <td>: <?= esc($data['pendeta_nikah']) ?: '-' ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Keanggotaan -->
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-church"></i> Data Keanggotaan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%"><strong>Tanggal Bergabung</strong></td>
                                        <td>: <?= date('d F Y', strtotime($data['tgl_bergabung'])) ?></td>
                                    </tr>
                                    <?php if ($data['tgl_pindah']) : ?>
                                    <tr>
                                        <td><strong>Tanggal Pindah</strong></td>
                                        <td>: <?= date('d F Y', strtotime($data['tgl_pindah'])) ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if ($data['tgl_meninggal']) : ?>
                                    <tr>
                                        <td><strong>Tanggal Meninggal</strong></td>
                                        <td>: <?= date('d F Y', strtotime($data['tgl_meninggal'])) ?></td>
                                    </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%"><strong>Gereja Asal</strong></td>
                                        <td>: <?= esc($data['gereja_asal']) ?: '-' ?></td>
                                    </tr>
                                    <?php if ($data['gereja_tujuan']) : ?>
                                    <tr>
                                        <td><strong>Gereja Tujuan</strong></td>
                                        <td>: <?= esc($data['gereja_tujuan']) ?></td>
                                    </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                        
                        <?php if ($data['keterangan']) : ?>
                        <div class="row mt-3">
                            <div class="col-12">
                                <p class="mb-2"><strong>Keterangan:</strong></p>
                                <p class="text-muted"><?= nl2br(esc($data['keterangan'])) ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Informasi Sistem -->
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-info-circle"></i> Informasi Sistem</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <strong>Dibuat:</strong> <?= date('d F Y H:i', strtotime($data['created_at'])) ?>
                                </small>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <strong>Diupdate:</strong> <?= date('d F Y H:i', strtotime($data['updated_at'])) ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
