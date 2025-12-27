<div class="modal fade" id="modallihat" tabindex="-1" role="dialog" aria-labelledby="modallihatLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
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
                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-data-pribadi">
                            <i class="fas fa-user"></i> Data Pribadi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-dokumen" 
                           onclick="loadDokumen(<?= $data['id_sidi'] ?>)">
                            <i class="fas fa-file-alt"></i> Dokumen
                            <span class="badge badge-info" id="badge-dokumen">
                                <?= isset($data['kelengkapan_dokumen']) ? $data['kelengkapan_dokumen'] : 0 ?>%
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-timeline"
                           onclick="loadTimeline(<?= $data['id_sidi'] ?>)">
                            <i class="fas fa-history"></i> Timeline
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-catatan"
                           onclick="loadCatatan(<?= $data['id_sidi'] ?>)">
                            <i class="fas fa-sticky-note"></i> Catatan
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3">
                    <!-- Tab Data Pribadi -->
                    <div id="tab-data-pribadi" class="tab-pane active">
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
                        
                        <h6 class="text-primary mt-3"><i class="fas fa-church"></i> Data Baptis</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><strong>Tanggal Baptis</strong></td>
                                <td>: <?= date_indo($data['tgl_baptis']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Gereja Baptis</strong></td>
                                <td>: <?= esc($data['gereja_baptis']) ?></td>
                            </tr>
                        </table>
                        
                        <h6 class="text-primary mt-3"><i class="fas fa-calendar"></i> Data Pendaftaran</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><strong>Tanggal Daftar</strong></td>
                                <td>: <?= date_indo($data['tgl_daftar']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Sidi</strong></td>
                                <td>: <?= $data['tgl_sidi'] ? date_indo($data['tgl_sidi']) : '-' ?></td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>: 
                                    <?php
                                    if ($data['status'] == '0') {
                                        echo '<span class="badge badge-warning">Pending</span>';
                                    } elseif ($data['status'] == '1') {
                                        echo '<span class="badge badge-success">Disetujui</span>';
                                    } else {
                                        echo '<span class="badge badge-danger">Ditolak</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php if (!empty($data['keterangan'])) : ?>
                            <tr>
                                <td><strong>Keterangan</strong></td>
                                <td>: <?= esc($data['keterangan']) ?></td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
                
                <hr>
                <h6 class="text-primary"><i class="fas fa-file-alt"></i> Dokumen Persyaratan</h6>
                <div class="row">
                    <?php
                    $dokumen = [
                        'dok_ktp' => 'KTP',
                        'dok_kk' => 'Kartu Keluarga',
                        'dok_baptis' => 'Sertifikat Baptis',
                        'dok_foto' => 'Foto 3x4'
                    ];
                    
                    foreach ($dokumen as $key => $label) :
                        if (!empty($data[$key])) :
                            $file_path = base_url('public/file/dokumen/sidi/' . $data[$key]);
                            $ext = pathinfo($data[$key], PATHINFO_EXTENSION);
                    ?>
                        <div class="col-md-3 text-center mb-3">
                            <div class="card">
                                <div class="card-body p-2">
                                    <?php if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) : ?>
                                        <a href="<?= $file_path ?>" target="_blank">
                                            <img src="<?= $file_path ?>" class="img-fluid" style="max-height: 100px;">
                                        </a>
                                    <?php else : ?>
                                        <a href="<?= $file_path ?>" target="_blank" class="btn btn-outline-danger">
                                            <i class="fas fa-file-pdf fa-3x"></i>
                                        </a>
                                    <?php endif; ?>
                                    <p class="mb-0 mt-2"><small><strong><?= $label ?></strong></small></p>
                                    <a href="<?= $file_path ?>" target="_blank" class="btn btn-sm btn-primary btn-block">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php 
                        else : 
                    ?>
                        <div class="col-md-3 text-center mb-3">
                            <div class="card bg-light">
                                <div class="card-body p-2">
                                    <i class="fas fa-file-upload fa-3x text-muted"></i>
                                    <p class="mb-0 mt-2"><small><strong><?= $label ?></strong></small></p>
                                    <small class="text-muted">Belum diupload</small>
                                </div>
                            </div>
                        </div>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                </div>
                    </div>
                    <!-- End Tab Data Pribadi -->

                    <!-- Tab Dokumen -->
                    <div id="tab-dokumen" class="tab-pane">
                        <div class="viewdokumen">
                            <div class="text-center text-muted py-4">
                                <i class="fas fa-spinner fa-spin fa-2x"></i>
                                <p>Loading...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Timeline -->
                    <div id="tab-timeline" class="tab-pane">
                        <div class="viewtimeline">
                            <div class="text-center text-muted py-4">
                                <i class="fas fa-spinner fa-spin fa-2x"></i>
                                <p>Loading...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Catatan -->
                    <div id="tab-catatan" class="tab-pane">
                        <div class="viewcatatan">
                            <div class="text-center text-muted py-4">
                                <i class="fas fa-spinner fa-spin fa-2x"></i>
                                <p>Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Tab Content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Load dokumen tab
function loadDokumen(id) {
    if ($('.viewdokumen').data('loaded')) return;
    
    $.ajax({
        url: '<?= base_url('pendaftaran-sidi/getdokumen') ?>',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.sukses) {
                $('.viewdokumen').html(response.sukses).data('loaded', true);
            }
        },
        error: function() {
            $('.viewdokumen').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}

// Load timeline tab
function loadTimeline(id) {
    if ($('.viewtimeline').data('loaded')) return;
    
    $.ajax({
        url: '<?= base_url('pendaftaran-sidi/gettimeline') ?>',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.sukses) {
                $('.viewtimeline').html(response.sukses).data('loaded', true);
            }
        },
        error: function() {
            $('.viewtimeline').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}

// Load catatan tab
function loadCatatan(id) {
    if ($('.viewcatatan').data('loaded')) return;
    
    $.ajax({
        url: '<?= base_url('pendaftaran-sidi/getcatatan') ?>',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.sukses) {
                $('.viewcatatan').html(response.sukses).data('loaded', true);
            }
        },
        error: function() {
            $('.viewcatatan').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}

// Reset loaded state when modal closes
$('#modallihat').on('hidden.bs.modal', function () {
    $('.viewdokumen, .viewtimeline, .viewcatatan').removeData('loaded');
});
</script>
