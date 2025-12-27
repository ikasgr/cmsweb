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
                        <h6 class="text-primary"><i class="fas fa-user"></i> Data Pribadi</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><strong>Nama Lengkap</strong></td>
                                <td>: <?= esc($data['nama_lengkap']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tempat Lahir</strong></td>
                                <td>: <?= esc($data['tempat_lahir']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Lahir</strong></td>
                                <td>: <?= date_indo($data['tgl_lahir']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td>: <?= esc($data['jenis_kelamin']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>No HP</strong></td>
                                <td>: <?= esc($data['no_hp']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>: <?= esc($data['email']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>: <?= esc($data['alamat']) ?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h6 class="text-primary"><i class="fas fa-users"></i> Data Orang Tua</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><strong>Nama Ayah</strong></td>
                                <td>: <?= esc($data['nama_ayah']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Nama Ibu</strong></td>
                                <td>: <?= esc($data['nama_ibu']) ?></td>
                            </tr>
                        </table>

                        <h6 class="text-primary"><i class="fas fa-church"></i> Data Baptis</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td><strong>Jenis Baptis</strong></td>
                                <td>: <?= esc($data['jenis_baptis']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Baptis</strong></td>
                                <td>: <?= $data['tgl_baptis'] ? date_indo($data['tgl_baptis']) : '-' ?></td>
                            </tr>
                            <tr>
                                <td><strong>Nama Pendamping</strong></td>
                                <td>: <?= esc($data['nama_pendamping']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Hubungan Pendamping</strong></td>
                                <td>: <?= esc($data['hubungan_pendamping']) ?></td>
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

                <?php if (!empty($data['dok_ktp']) || !empty($data['dok_kk']) || !empty($data['dok_akta_lahir']) || !empty($data['dok_foto']) || !empty($data['dok_surat_nikah_ortu'])): ?>
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-primary"><i class="fas fa-file-alt"></i> Dokumen</h6>
                        <div class="row">
                            <?php if (!empty($data['dok_ktp'])): ?>
                            <div class="col-md-2 mb-2">
                                <a href="<?= base_url('public/file/dokumen/baptis/' . $data['dok_ktp']) ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-block">
                                    <i class="fas fa-id-card"></i><br>KTP
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($data['dok_kk'])): ?>
                            <div class="col-md-2 mb-2">
                                <a href="<?= base_url('public/file/dokumen/baptis/' . $data['dok_kk']) ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-block">
                                    <i class="fas fa-users"></i><br>KK
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($data['dok_akta_lahir'])): ?>
                            <div class="col-md-2 mb-2">
                                <a href="<?= base_url('public/file/dokumen/baptis/' . $data['dok_akta_lahir']) ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-block">
                                    <i class="fas fa-birthday-cake"></i><br>Akta Lahir
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($data['dok_foto'])): ?>
                            <div class="col-md-2 mb-2">
                                <a href="<?= base_url('public/file/dokumen/baptis/' . $data['dok_foto']) ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-block">
                                    <i class="fas fa-camera"></i><br>Foto
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($data['dok_surat_nikah_ortu'])): ?>
                            <div class="col-md-2 mb-2">
                                <a href="<?= base_url('public/file/dokumen/baptis/' . $data['dok_surat_nikah_ortu']) ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-block">
                                    <i class="fas fa-heart"></i><br>Surat Nikah Ortu
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
