<!-- Upload Section -->
<div class="card mb-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-upload"></i> Upload Dokumen</h5>
    </div>
    <div class="card-body">
        <?= form_open_multipart('', ['id' => 'formUploadDokumen']) ?>
            <input type="hidden" name="id" value="<?= $id ?>">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Jenis Dokumen <span class="text-danger">*</span></label>
                        <select name="jenis_dokumen" class="form-select" required>
                            <option value="">-- Pilih Jenis Dokumen --</option>
                            <?php foreach ($master as $m) : ?>
                                <option value="<?= esc($m['nama_dokumen']) ?>">
                                    <?= esc($m['nama_dokumen']) ?>
                                    <?= $m['wajib'] ? ' (Wajib)' : ' (Opsional)' ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">File Dokumen <span class="text-danger">*</span></label>
                        <input type="file" name="file_dokumen" class="form-control" 
                               accept=".jpg,.jpeg,.png,.pdf" required>
                        <small class="text-muted">Format: JPG, PNG, PDF. Max: 5MB</small>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary btnUpload">
                <i class="fas fa-upload"></i> Upload Dokumen
            </button>
        <?= form_close() ?>
    </div>
</div>

<!-- List Dokumen -->
<div class="card">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Dokumen</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Jenis Dokumen</th>
                        <th>File</th>
                        <th width="100" class="text-center">Status</th>
                        <th>Keterangan</th>
                        <th>Upload By</th>
                        <th width="180" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($dokumen) : ?>
                        <?php $no = 1; foreach ($dokumen as $dok) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><strong><?= esc($dok['jenis_dokumen']) ?></strong></td>
                                <td>
                                    <a href="<?= base_url($dok['file_path']) ?>" target="_blank" class="text-primary">
                                        <i class="fas fa-file"></i> <?= esc($dok['nama_file']) ?>
                                    </a>
                                    <br><small class="text-muted">
                                        <i class="fas fa-weight"></i> <?= number_format($dok['file_size']/1024, 2) ?> KB
                                    </small>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $badge = [
                                        'pending' => 'warning',
                                        'valid' => 'success',
                                        'invalid' => 'danger',
                                        'revisi' => 'info'
                                    ];
                                    ?>
                                    <span class="badge bg-<?= $badge[$dok['status_dokumen']] ?>">
                                        <?= ucfirst($dok['status_dokumen']) ?>
                                    </span>
                                </td>
                                <td><?= esc($dok['keterangan']) ?: '-' ?></td>
                                <td>
                                    <small>
                                        <i class="fas fa-user"></i> <?= esc($dok['uploaded_by_name']) ?><br>
                                        <i class="fas fa-clock"></i> <?= date('d/m/Y H:i', strtotime($dok['tgl_upload'])) ?>
                                    </small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-success" 
                                                onclick="verifyDokumen(<?= $dok['dokumen_id'] ?>, 'valid')"
                                                title="Setujui">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-warning" 
                                                onclick="verifyDokumen(<?= $dok['dokumen_id'] ?>, 'revisi')"
                                                title="Perlu Revisi">
                                            <i class="fas fa-redo"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                                onclick="verifyDokumen(<?= $dok['dokumen_id'] ?>, 'invalid')"
                                                title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                                onclick="hapusDokumen(<?= $dok['dokumen_id'] ?>)"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                <i class="fas fa-inbox"></i> Belum ada dokumen yang diupload
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Upload dokumen
    $('#formUploadDokumen').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        
        $.ajax({
            url: '<?= base_url('pendaftaran-sidi/uploaddokumen') ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function() {
                $('.btnUpload').prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin"></i> Uploading...');
            },
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.sukses,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#formUploadDokumen')[0].reset();
                    loadDokumen(<?= $id ?>);
                } else if (response.error) {
                    let errorMsg = typeof response.error === 'object' 
                        ? Object.values(response.error).join('<br>') 
                        : response.error;
                    Swal.fire('Gagal!', errorMsg, 'error');
                }
            },
            error: function() {
                Swal.fire('Error!', 'Terjadi kesalahan saat upload', 'error');
            },
            complete: function() {
                $('.btnUpload').prop('disabled', false)
                    .html('<i class="fas fa-upload"></i> Upload Dokumen');
            }
        });
    });
});

// Verify dokumen
function verifyDokumen(dokumen_id, status) {
    let statusText = {
        'valid': 'Setujui',
        'invalid': 'Tolak',
        'revisi': 'Minta Revisi'
    };
    
    Swal.fire({
        title: statusText[status] + ' Dokumen?',
        input: 'textarea',
        inputLabel: 'Keterangan',
        inputPlaceholder: 'Masukkan keterangan (opsional)...',
        showCancelButton: true,
        confirmButtonText: 'Ya, ' + statusText[status],
        cancelButtonText: 'Batal',
        confirmButtonColor: status === 'valid' ? '#28a745' : (status === 'revisi' ? '#ffc107' : '#dc3545')
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('pendaftaran-sidi/verifydokumen') ?>',
                type: 'POST',
                data: {
                    dokumen_id: dokumen_id,
                    status: status,
                    keterangan: result.value || ''
                },
                dataType: 'json',
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        loadDokumen(<?= $id ?>);
                    }
                }
            });
        }
    });
}

// Hapus dokumen
function hapusDokumen(dokumen_id) {
    Swal.fire({
        title: 'Hapus Dokumen?',
        text: 'File akan dihapus permanen dari server!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('pendaftaran-sidi/hapusdokumen') ?>',
                type: 'POST',
                data: { dokumen_id: dokumen_id },
                dataType: 'json',
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        loadDokumen(<?= $id ?>);
                    }
                }
            });
        }
    });
}
</script>
