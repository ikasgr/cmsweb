<!-- Modal -->
<div class="modal fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <?= form_open_multipart('', ['class' => 'formupload']) ?>

            <input type="hidden" value="<?= $id ?>" name="berita_id">

            <div class="modal-body">
                <div class="col-lg-12">

                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                        <strong>Perhatian!</strong> <br>
                        <li> File yang diupload Maksimal <cite title="Source Title">5096 KB </cite></li>
                        <li> Format file: <small class="text-danger">.pdf</small> file ini akan disematkan ke halaman.</li>

                    </div>
                    <div class="form-group mb-2">
                        <label>Upload File PDF</label>

                        <input type="file" class="form-control" id="filepdf" name="filepdf">
                        <div class="invalid-feedback errorfilepdf"></div>

                    </div>

                    <?php if (esc($filepdf) != '') { ?>

                        <div class="form-group">
                            <label> <i class="mdi mdi-file-cloud"></i>
                                File saat ini :
                            </label>
                            <label><a target='_BLANK' href="<?= base_url('public/img/informasi/pdf/'  . esc($filepdf)) ?>"><?= esc($filepdf) ?></a></label>
                        </div>

                    <?php } ?>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnupload"><i class="mdi mdi-content-save-all"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <i class="mdi mdi-cancel"></i> Batal</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.btnupload').click(function(e) {
            e.preventDefault();
            let form = $('.formupload')[0];
            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: '<?= site_url('halaman/douploadpdf') ?>',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btnupload').attr('disable', 'disable');
                    $('.btnupload').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnupload').removeAttr('disable', 'disable');
                    $('.btnupload').html('<i class="mdi mdi-content-save-all"></i>  Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.filepdf) {
                            $('#filepdf').addClass('is-invalid');
                            $('.errorfilepdf').html(response.error.filepdf);
                        }
                        $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            $('#modalupload').modal('hide');
                            window.location = '';
                        })
                    }
                },
                error: function(xhr, ajaxOptions, thrownerror) {

                    Swal.fire({
                        title: "Maaf gagal update file PDF!",
                        html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function() {
                        $('#modalupload').modal('hide');
                        window.location = '';
                    })

                }
            });

        });
    });
</script>