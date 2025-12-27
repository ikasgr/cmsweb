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

            <?= form_open_multipart('pendaftaran-nikah/simpanupload', ['class' => 'formupload']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_nikah" value="<?= $data['id_nikah'] ?>">

            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> <strong>Informasi:</strong><br>
                    - Format file: PNG, JPG, JPEG, PDF<br>
                    - Ukuran maksimal: 3 MB per file<br>
                    - Nama: <strong><?= esc($data['nama_lengkap_suami'] . ' & ' . $data['nama_lengkap_istri']) ?></strong>
                </div>

                <div class="row">
                    <?php
                    $dokumen = [
                        'dok_ktp_suami' => ['label' => 'KTP Suami', 'icon' => 'fa-id-card'],
                        'dok_ktp_istri' => ['label' => 'KTP Istri', 'icon' => 'fa-id-card'],
                        'dok_kk_suami' => ['label' => 'KK Suami', 'icon' => 'fa-users'],
                        'dok_kk_istri' => ['label' => 'KK Istri', 'icon' => 'fa-users'],
                        'dok_akte_lahir_suami' => ['label' => 'Akta Lahir Suami', 'icon' => 'fa-birthday-cake'],
                        'dok_akte_lahir_istri' => ['label' => 'Akta Lahir Istri', 'icon' => 'fa-birthday-cake']
                    ];

                    foreach ($dokumen as $key => $info) :
                        $file_exists = !empty($data[$key]);
                        $file_path = $file_exists ? base_url('public/file/dokumen/nikah/' . $data[$key]) : '';
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
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Pilih File</label>
                                        <input type="file" name="file_dokumen" class="form-control-file file-input" data-jenis-dokumen="<?= $key ?>">
                                        <small class="form-text text-muted">Format: PNG, JPG, JPEG, PDF. Max: 3MB</small>
                                        <div class="invalid-feedback error-file"></div>
                                    </div>

                                    <?php if ($file_exists) : ?>
                                        <div class="mt-2">
                                            <a href="<?= $file_path ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-block">
                                                <i class="fas fa-eye"></i> Lihat File
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-block mt-1 hapus-file" data-id="<?= $data['id_nikah'] ?>" data-jenis-dokumen="<?= $key ?>">
                                                <i class="fas fa-trash"></i> Hapus File
                                            </button>
                                        </div>
                                    <?php endif; ?>
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
                <button type="submit" class="btn btn-primary btnupload">
                    <i class="fas fa-upload"></i> Upload
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formupload').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var jenisDokumen = $('.file-input').data('jenis-dokumen');
            formData.append('jenis_dok', jenisDokumen);

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btnupload').attr('disable', 'disabled');
                    $('.btnupload').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnupload').removeAttr('disable');
                    $('.btnupload').html('<i class="fas fa-upload"></i> Upload');
                },
                success: function(response) {
                    if (response.error) {
                        $('.error-file').html(response.error.file_dokumen);
                    } else {
                        toastr.success(response.sukses);
                        $('#modalupload').modal('hide');
                        listnikah();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        // Handle file input change
        $('.file-input').change(function() {
            var jenisDokumen = $(this).data('jenis-dokumen');
            $('input[name=jenis_dok]').val(jenisDokumen);
        });

        // Handle delete file
        $('.hapus-file').click(function() {
            var id = $(this).data('id');
            var jenisDokumen = $(this).data('jenis-dokumen');

            if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
                $.ajax({
                    type: "post",
                    url: '<?= base_url('pendaftaran-nikah/hapusfile') ?>',
                    data: {
                        id_nikah: id,
                        jenis_dok: jenisDokumen,
                        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            $('#modalupload').modal('hide');
                            listnikah();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    });
</script>
