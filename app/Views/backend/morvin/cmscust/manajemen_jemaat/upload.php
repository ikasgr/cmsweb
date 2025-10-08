<!-- Modal Upload Foto -->
<div class="modal fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <?= form_open_multipart('manajemen-jemaat/simpanupload', ['class' => 'formupload']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_jemaat" value="<?= $data['id_jemaat'] ?>">
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center">
                            <h6>Foto Saat Ini</h6>
                            <?php if ($data['foto']) : ?>
                                <img src="<?= base_url('public/file/foto/jemaat/' . $data['foto']) ?>" 
                                     class="rounded-circle mb-3" width="150" height="150" 
                                     style="object-fit: cover;" alt="Foto Jemaat">
                                <br>
                                <small class="text-muted">Foto: <?= esc($data['foto']) ?></small>
                            <?php else : ?>
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                     style="width: 150px; height: 150px;">
                                    <i class="fas fa-user text-muted" style="font-size: 60px;"></i>
                                </div>
                                <small class="text-muted">Belum ada foto</small>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-camera"></i> Upload Foto Baru
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6><?= esc($data['nama_lengkap']) ?></h6>
                                    <small class="text-muted">No. Anggota: <?= esc($data['no_anggota']) ?></small>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label>Pilih Foto <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="foto" accept="image/*">
                                    <div class="invalid-feedback errorfoto"></div>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle"></i> 
                                        Format: PNG, JPG, JPEG | Maksimal: 2MB
                                    </small>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Preview Foto</label>
                                    <div id="preview-container" style="display: none;">
                                        <img id="preview-image" class="rounded border" 
                                             style="max-width: 100%; max-height: 200px;" alt="Preview">
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <i class="fas fa-lightbulb"></i>
                                    <strong>Tips:</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Gunakan foto dengan kualitas baik dan pencahayaan cukup</li>
                                        <li>Pastikan wajah terlihat jelas</li>
                                        <li>Foto akan otomatis di-resize menjadi 150x150 pixel</li>
                                        <li>Foto lama akan terganti dengan foto baru</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="submit" class="btn btn-primary btnUpload">
                    <i class="fas fa-upload"></i> Upload Foto
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Preview foto sebelum upload
        $('input[name="foto"]').change(function() {
            const file = this.files[0];
            if (file) {
                // Validasi ukuran file (2MB = 2048KB)
                if (file.size > 2048 * 1024) {
                    toastr.error('Ukuran file terlalu besar! Maksimal 2MB');
                    $(this).val('');
                    $('#preview-container').hide();
                    return;
                }

                // Validasi tipe file
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    toastr.error('Format file tidak didukung! Gunakan JPG, JPEG, atau PNG');
                    $(this).val('');
                    $('#preview-container').hide();
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview-image').attr('src', e.target.result);
                    $('#preview-container').show();
                };
                reader.readAsDataURL(file);
            } else {
                $('#preview-container').hide();
            }
        });

        // Submit form upload
        $('.formupload').submit(function(e) {
            e.preventDefault();
            let form = this;
            let formData = new FormData(form);
            
            $.ajax({
                type: "post",
                url: $(form).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btnUpload').attr('disable', 'disabled');
                    $('.btnUpload').html('<i class="fa fa-spin fa-spinner"></i> Mengupload...');
                },
                complete: function() {
                    $('.btnUpload').removeAttr('disable');
                    $('.btnUpload').html('<i class="fas fa-upload"></i> Upload Foto');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.foto) {
                            $('#modalupload .errorfoto').html(response.error.foto);
                            $('#modalupload input[name=foto]').addClass('is-invalid');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modalupload').modal('hide');
                        listjemaat();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

        // Reset form ketika modal ditutup
        $('#modalupload').on('hidden.bs.modal', function() {
            $('.formupload')[0].reset();
            $('#preview-container').hide();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').html('');
        });
    });
</script>
