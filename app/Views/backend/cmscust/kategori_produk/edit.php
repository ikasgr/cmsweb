<!-- Modal Edit Kategori -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <?= form_open('kategori-produk/update', ['class' => 'formupdate']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="kategori_id" value="<?= $data['kategori_id'] ?>">
            
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_kategori" value="<?= esc($data['nama_kategori']) ?>" placeholder="Masukkan nama kategori">
                    <div class="invalid-feedback errornamaKategori"></div>
                </div>

                <div class="form-group mb-3">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi kategori (opsional)"><?= esc($data['deskripsi']) ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Urutan</label>
                            <input type="number" class="form-control" name="urutan" value="<?= $data['urutan'] ?>" placeholder="0">
                            <small class="text-muted">Urutan tampilan kategori</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Status</label>
                            <select class="form-select" name="status">
                                <option value="1" <?= $data['status'] == '1' ? 'selected' : '' ?>>Aktif</option>
                                <option value="0" <?= $data['status'] == '0' ? 'selected' : '' ?>>Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btnupdate">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formupdate').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnupdate').attr('disabled', 'disabled');
                    $('.btnupdate').html('<i class="fas fa-spin fa-spinner"></i> Mengupdate...');
                },
                complete: function() {
                    $('.btnupdate').removeAttr('disabled');
                    $('.btnupdate').html('<i class="fas fa-save"></i> Update');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.nama_kategori) {
                            $('.errornamaKategori').html(response.error.nama_kategori);
                            $('input[name=nama_kategori]').addClass('is-invalid');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modaledit').modal('hide');
                        listkategori();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

        // Reset validation on input
        $('input, select, textarea').on('input change', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>
