<!-- Modal Lihat Detail Majelis -->
<div class="modal fade" id="modallihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fas fa-user-tie"></i> <?= $title ?>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <!-- Foto & Info Utama -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <?php if ($data['gambar']) : ?>
                                    <img src="<?= base_url('public/img/informasi/majelis/' . $data['gambar']) ?>" 
                                         class="rounded-circle img-thumbnail mb-3" 
                                         width="200" height="200" 
                                         style="object-fit: cover;" 
                                         alt="Foto">
                                <?php else : ?>
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                         style="width: 200px; height: 200px;">
                                        <i class="fas fa-user-tie fa-5x text-muted"></i>
                                    </div>
                                <?php endif; ?>
                                
                                <h4 class="mb-1"><?= esc($data['nama']) ?></h4>
                                
                                <?php
                                $badge_class = 'primary';
                                if ($data['jenis_jabatan'] == 'Pendeta') $badge_class = 'success';
                                elseif ($data['jenis_jabatan'] == 'Diakon') $badge_class = 'warning';
                                elseif ($data['jenis_jabatan'] == 'Ketua Majelis') $badge_class = 'danger';
                                ?>
                                <span class="badge bg-<?= $badge_class ?> mb-2"><?= esc($data['jenis_jabatan']) ?></span>
                                
                                <?php if ($data['nip']) : ?>
                                    <p class="text-muted mb-0">NIP: <?= esc($data['nip']) ?></p>
                                <?php endif; ?>
                                
                                <?php
                                $status_class = 'success';
                                if ($data['status_jabatan'] == 'Non-Aktif') $status_class = 'secondary';
                                elseif ($data['status_jabatan'] == 'Masa Percobaan') $status_class = 'warning';
                                elseif ($data['status_jabatan'] == 'Habis Masa Jabatan') $status_class = 'danger';
                                ?>
                                <span class="badge bg-<?= $status_class ?> mt-2"><?= esc($data['status_jabatan']) ?></span>
                            </div>
                        </div>

                        <!-- File Dokumen -->
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-file"></i> Dokumen</h6>
                            </div>
                            <div class="card-body">
                                <?php if ($data['file_sk_pengangkatan']) : ?>
                                    <div class="mb-2">
                                        <a href="<?= base_url('public/img/informasi/pegawai/' . $data['file_sk_pengangkatan']) ?>" 
                                           target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                            <i class="fas fa-file-pdf"></i> SK Pengangkatan
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($data['file_sertifikat']) : ?>
                                    <div class="mb-2">
                                        <a href="<?= base_url('public/img/informasi/pegawai/' . $data['file_sertifikat']) ?>" 
                                           target="_blank" class="btn btn-sm btn-outline-success w-100">
                                            <i class="fas fa-certificate"></i> Sertifikat Penahbisan
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!$data['file_sk_pengangkatan'] && !$data['file_sertifikat']) : ?>
                                    <p class="text-muted text-center mb-0">Tidak ada dokumen</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Informasi -->
                    <div class="col-lg-8">
                        <!-- Data Pribadi -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-user"></i> Data Pribadi</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td width="150"><strong>Tempat Lahir</strong></td>
                                                <td>: <?= esc($data['tempat_lahir']) ?: '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Lahir</strong></td>
                                                <td>: <?= $data['tgl_lahir'] ? date('d-m-Y', strtotime($data['tgl_lahir'])) : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jenis Kelamin</strong></td>
                                                <td>: <?= esc($data['jk']) ?: '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Agama</strong></td>
                                                <td>: <?= esc($data['agama']) ?: '-' ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td width="150"><strong>No. HP</strong></td>
                                                <td>: <?= esc($data['no_hp']) ?: '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email</strong></td>
                                                <td>: <?= esc($data['email']) ?: '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Alamat</strong></td>
                                                <td>: <?= esc($data['alamat']) ?: '-' ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Jabatan -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-briefcase"></i> Jabatan & Pelayanan</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td width="180"><strong>Jenis Jabatan</strong></td>
                                                <td>: <span class="badge bg-<?= $badge_class ?>"><?= esc($data['jenis_jabatan']) ?></span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jabatan Detail</strong></td>
                                                <td>: <?= esc($data['nama_jabatan']) ?: '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status Jabatan</strong></td>
                                                <td>: <span class="badge bg-<?= $status_class ?>"><?= esc($data['status_jabatan']) ?></span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Penahbisan</strong></td>
                                                <td>: <?= $data['tanggal_penahbisan'] ? date('d-m-Y', strtotime($data['tanggal_penahbisan'])) : '-' ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td width="180"><strong>Tanggal Pelantikan</strong></td>
                                                <td>: <?= $data['tanggal_pelantikan'] ? date('d-m-Y', strtotime($data['tanggal_pelantikan'])) : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Akhir Masa Jabatan</strong></td>
                                                <td>: <?= $data['tanggal_akhir_jabatan'] ? date('d-m-Y', strtotime($data['tanggal_akhir_jabatan'])) : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Gereja Asal</strong></td>
                                                <td>: <?= esc($data['gereja_asal']) ?: '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Komisi</strong></td>
                                                <td>: <?= esc($data['komisi']) ?: '-' ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pendidikan & Sertifikasi -->
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-graduation-cap"></i> Pendidikan & Sertifikasi</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>Pendidikan Teologi:</strong>
                                    <p class="mb-0"><?= esc($data['pendidikan_teologi']) ?: '-' ?></p>
                                </div>
                                <div>
                                    <strong>Sertifikasi/Kredensial:</strong>
                                    <p class="mb-0"><?= nl2br(esc($data['sertifikasi'])) ?: '-' ?></p>
                                </div>
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
