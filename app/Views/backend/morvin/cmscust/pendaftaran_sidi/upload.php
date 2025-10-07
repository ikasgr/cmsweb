<div class="modal fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="modaluploadLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaluploadLabel">
                    <i class="fas fa-upload"></i> <?= $title ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <?= form_open_multipart('pendaftaran-sidi/simpanupload', ['class' => 'formupload']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_sidi" value="<?= $data['id_sidi'] ?>">
            
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> <strong>Informasi:</strong><br>
                    - Format file: PNG, JPG, JPEG, PDF<br>
                    - Ukuran maksimal: 3 MB per file<br>
                    - Nama: <strong><?= esc($data['nama_lengkap']) ?></strong>
                </div>
                
                <div class="row">
                    <?php
                    $dokumen = [
                        'dok_ktp' => ['label' => 'KTP', 'icon' => 'fa-id-card'],
                        'dok_kk' => ['label' => 'Kartu Keluarga', 'icon' => 'fa-users'],
                        'dok_baptis' => ['label' => 'Sertifikat Baptis', 'icon' => 'fa-certificate'],
                        'dok_foto' => ['label' => 'Foto 3x4', 'icon' => 'fa-image']
                    ];
                    
                    foreach ($dokumen as $key => $info) :
                        $file_exists = !empty($data[$key]);
                        $file_path = $file_exists ? base_url('public/file/dokumen/sidi/' . $data[$key]) : '';
                        $ext = $file_exists ? pathinfo($data[$key], PATHINFO_EXTENSION) : '';
                    ?>
                        <div class="col-md-6 mb-4">
                            <div class="card <?= $file_exists ? 'border-success' : 'border-warning' ?>">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="fas <?= $info['icon'] ?>"></i> <?= $info['label'] ?>
                                        <?php if ($file_exists) : ?>
                                            <span class="badge badge-success float-right">
                                                <i class="fas fa-check"></i> Tersedia
                                            </span>
                                        <?php else : ?>
                                            <span class="badge badge-warning float-right">
                                                <i class="fas fa-exclamation"></i> Belum Upload
                                            </span>
                                        <?php endif; ?>
                                    </h6>
                                </div>
                                <div class="card-body text-center">
                                    <?php if ($file_exists) : ?>
                                        <!-- Preview File -->
                                        <?php if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) : ?>
                                            <a href="<?= $file_path ?>" target="_blank">
                                                <img src="<?= $file_path ?>" class="img-thumbnail mb-2" style="max-height: 150px;">
                                            </a>
                                        <?php else : ?>
                                            <a href="<?= $file_path ?>" target="_blank" class="btn btn-outline-danger mb-2">
                                                <i class="fas fa-file-pdf fa-4x"></i>
                                            </a>
                                        <?php endif; ?>
                                        
                                        <div class="btn-group btn-block" role="group">
                                            <a href="<?= $file_path ?>" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                            <a href="<?= $file_path ?>" download class="btn btn-sm btn-primary">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    onclick="hapusfile('<?= $data['id_sidi'] ?>','<?= $key ?>','<?= esc($data['nama_lengkap']) ?>')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    <?php else : ?>
                                        <i class="fas <?= $info['icon'] ?> fa-4x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada file</p>
                                    <?php endif; ?>
                                    
                                    <!-- Form Upload -->
                                    <hr>
                                    <form class="formuploadfile" data-jenis="<?= $key ?>">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="id_sidi" value="<?= $data['id_sidi'] ?>">
                                        <input type="hidden" name="jenis_dok" value="<?= $key ?>">
                                        
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="file_dokumen" 
                                                   id="file_<?= $key ?>" accept=".png,.jpg,.jpeg,.pdf">
                                            <label class="custom-file-label" for="file_<?= $key ?>">
                                                Pilih file...
                                            </label>
                                        </div>
                                        <div class="invalid-feedback errorfile_dokumen_<?= $key ?>"></div>
                                        
                                        <button type="submit" class="btn btn-success btn-sm btn-block btnuploadfile">
                                            <i class="fas fa-upload"></i> Upload <?= $info['label'] ?>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Custom file input label
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
        
        // Upload file per dokumen
        $('.formuploadfile').submit(function(e) {
            e.preventDefault();
            
            let formData = new FormData(this);
            let jenis = $(this).data('jenis');
            let btnUpload = $(this).find('.btnuploadfile');
            
            $.ajax({
                type: "post",
                url: "<?= site_url('pendaftaran-sidi/simpanupload') ?>",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    btnUpload.attr('disabled', 'disabled');
                    btnUpload.html('<i class="fa fa-spin fa-spinner"></i> Uploading...');
                },
                complete: function() {
                    btnUpload.removeAttr('disabled');
                    btnUpload.html('<i class="fas fa-upload"></i> Upload');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.file_dokumen) {
                            $('.errorfile_dokumen_' + jenis).html(response.error.file_dokumen);
                            $('.errorfile_dokumen_' + jenis).show();
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modalupload').modal('hide');
                        listsidi();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>
