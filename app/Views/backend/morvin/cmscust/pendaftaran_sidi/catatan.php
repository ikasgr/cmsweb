<!-- Form Add Catatan -->
<div class="card mb-3">
    <div class="card-header bg-warning">
        <h5 class="mb-0"><i class="fas fa-plus"></i> Tambah Catatan</h5>
    </div>
    <div class="card-body">
        <?= form_open('', ['id' => 'formAddCatatan']) ?>
            <input type="hidden" name="id" value="<?= $id ?>">
            
            <div class="mb-3">
                <label class="form-label">Tipe Catatan <span class="text-danger">*</span></label>
                <select name="tipe" class="form-select" required>
                    <option value="internal">Internal (Hanya Admin)</option>
                    <option value="eksternal">Eksternal (Terlihat oleh User)</option>
                </select>
                <small class="text-muted">
                    <i class="fas fa-info-circle"></i> 
                    Internal: Hanya admin yang bisa melihat. 
                    Eksternal: User juga bisa melihat catatan ini.
                </small>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Catatan <span class="text-danger">*</span></label>
                <textarea name="catatan" class="form-control" rows="4" 
                          placeholder="Tulis catatan di sini..." required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary btnSimpanCatatan">
                <i class="fas fa-save"></i> Simpan Catatan
            </button>
        <?= form_close() ?>
    </div>
</div>

<!-- List Catatan -->
<div class="card">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Catatan</h5>
    </div>
    <div class="card-body">
        <?php if ($catatan) : ?>
            <?php foreach ($catatan as $c) : ?>
                <div class="card mb-3 catatan-item">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="badge bg-<?= $c['tipe'] == 'internal' ? 'danger' : 'success' ?>">
                                    <i class="fas fa-<?= $c['tipe'] == 'internal' ? 'lock' : 'eye' ?>"></i>
                                    <?= ucfirst($c['tipe']) ?>
                                </span>
                                <small class="text-muted ms-2">
                                    <i class="fas fa-user"></i> <?= esc($c['fullname']) ?>
                                </small>
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-clock"></i> 
                                <?= date('d/m/Y H:i', strtotime($c['tgl_catatan'])) ?>
                            </small>
                        </div>
                        <div class="catatan-content">
                            <?= nl2br(esc($c['catatan'])) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="text-center text-muted py-4">
                <i class="fas fa-sticky-note fa-3x mb-3"></i>
                <p>Belum ada catatan</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
$(document).ready(function() {
    // Submit form catatan
    $('#formAddCatatan').submit(function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '<?= base_url('pendaftaran-sidi/addcatatan') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('.btnSimpanCatatan').prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
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
                    $('#formAddCatatan')[0].reset();
                    loadCatatan(<?= $id ?>);
                } else if (response.error) {
                    Swal.fire('Gagal!', response.error, 'error');
                }
            },
            error: function() {
                Swal.fire('Error!', 'Terjadi kesalahan saat menyimpan', 'error');
            },
            complete: function() {
                $('.btnSimpanCatatan').prop('disabled', false)
                    .html('<i class="fas fa-save"></i> Simpan Catatan');
            }
        });
    });
});
</script>

<style>
.catatan-item {
    border-left: 3px solid #007bff;
    transition: all 0.3s ease;
}

.catatan-item:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transform: translateX(2px);
}

.catatan-content {
    padding: 10px;
    background: #f8f9fa;
    border-radius: 5px;
    line-height: 1.6;
}
</style>
