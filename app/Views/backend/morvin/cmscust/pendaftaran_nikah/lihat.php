<div class="modal fade" id="modallihat" tabindex="-1" role="dialog" aria-labelledby="modallihatLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modallihatLabel">
                    <i class="fas fa-info-circle"></i> <?= $title ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary"><i class="fas fa-user-tie"></i> Data Calon Suami</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><strong>Nama Lengkap</strong></td>
                                <td>: <?= esc($data['nama_lengkap_suami']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tempat Lahir</strong></td>
                                <td>: <?= esc($data['tempat_lahir_suami']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Lahir</strong></td>
                                <td>: <?= date_indo($data['tgl_lahir_suami']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>No HP</strong></td>
                                <td>: <?= esc($data['no_hp_suami']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>: <?= esc($data['alamat_suami']) ?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h6 class="text-primary"><i class="fas fa-user"></i> Data Calon Istri</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><strong>Nama Lengkap</strong></td>
                                <td>: <?= esc($data['nama_lengkap_istri']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tempat Lahir</strong></td>
                                <td>: <?= esc($data['tempat_lahir_istri']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Lahir</strong></td>
                                <td>: <?= date_indo($data['tgl_lahir_istri']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>No HP</strong></td>
                                <td>: <?= esc($data['no_hp_istri']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>: <?= esc($data['alamat_istri']) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-primary"><i class="fas fa-heart"></i> Data Pernikahan</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><strong>Tanggal Pernikahan</strong></td>
                                <td>: <?= $data['tgl_nikah'] ? date_indo($data['tgl_nikah']) : '-' ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-primary"><i class="fas fa-info"></i> Informasi Pendaftaran</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><strong>No Pendaftaran</strong></td>
                                <td>: <?= esc($data['no_pendaftaran']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Daftar</strong></td>
                                <td>: <?= date_indo($data['tgl_daftar']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>:
                                    <?php
                                    $status_badge = [
                                        '0' => '<span class="badge badge-warning">Pending</span>',
                                        '1' => '<span class="badge badge-success">Disetujui</span>',
                                        '2' => '<span class="badge badge-danger">Ditolak</span>'
                                    ];
                                    echo $status_badge[$data['status']] ?? '<span class="badge badge-secondary">Unknown</span>';
                                    ?>
                                </td>
                            </tr>
                            <?php if (!empty($data['keterangan'])): ?>
                            <tr>
                                <td><strong>Keterangan</strong></td>
                                <td>: <?= esc($data['keterangan']) ?></td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>

                <?php if (!empty($data['dok_ktp_suami']) || !empty($data['dok_ktp_istri']) || !empty($data['dok_kk_suami']) || !empty($data['dok_kk_istri']) || !empty($data['dok_akte_lahir_suami']) || !empty($data['dok_akte_lahir_istri'])): ?>
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-primary"><i class="fas fa-file-alt"></i> Dokumen</h6>
                        <div class="row">
                            <?php if (!empty($data['dok_ktp_suami'])): ?>
                            <div class="col-md-2 mb-2">
                                <a href="<?= base_url('public/file/dokumen/nikah/' . $data['dok_ktp_suami']) ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-block">
                                    <i class="fas fa-id-card"></i><br>KTP Suami
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($data['dok_ktp_istri'])): ?>
                            <div class="col-md-2 mb-2">
                                <a href="<?= base_url('public/file/dokumen/nikah/' . $data['dok_ktp_istri']) ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-block">
                                    <i class="fas fa-id-card"></i><br>KTP Istri
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($data['dok_kk_suami'])): ?>
                            <div class="col-md-2 mb-2">
                                <a href="<?= base_url('public/file/dokumen/nikah/' . $data['dok_kk_suami']) ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-block">
                                    <i class="fas fa-users"></i><br>KK Suami
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($data['dok_kk_istri'])): ?>
                            <div class="col-md-2 mb-2">
                                <a href="<?= base_url('public/file/dokumen/nikah/' . $data['dok_kk_istri']) ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-block">
                                    <i class="fas fa-users"></i><br>KK Istri
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($data['dok_akte_lahir_suami'])): ?>
                            <div class="col-md-2 mb-2">
                                <a href="<?= base_url('public/file/dokumen/nikah/' . $data['dok_akte_lahir_suami']) ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-block">
                                    <i class="fas fa-birthday-cake"></i><br>Akta Lahir Suami
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($data['dok_akte_lahir_istri'])): ?>
                            <div class="col-md-2 mb-2">
                                <a href="<?= base_url('public/file/dokumen/nikah/' . $data['dok_akte_lahir_istri']) ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-block">
                                    <i class="fas fa-birthday-cake"></i><br>Akta Lahir Istri
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
