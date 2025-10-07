<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= $title  ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <?= form_open_multipart('', ['class' => 'formtambah']) ?>

            <div class="modal-body">

                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                    <strong>Perhatian!</strong> <br>
                    <li> File yang diupload Maksimal <cite title="Source Title">6096 KB </cite></li>
                    <li> Format file: <small>.jpg, .jpeg, .gif, .png, pdf,.doc,.docx,.xlsx,.ppt,.txt</small></li>

                </div>
                <div class="form-group mb-2">
                    <label> <i class="mdi mdi-text-shadow"></i>
                        Judul Detail Sub Produk Hukum
                    </label>
                    <input type="hidden" id="kathukum_id" name="kathukum_id" value="<?= $kathukum_id ?>" class="form-control">
                    <input type="text" id="nama_subkathukum" name="nama_subkathukum" class="form-control">
                    <div class="invalid-feedback errornama_subkathukum"></div>
                </div>

                <div class="form-group">
                    <label> <i class="mdi mdi-image"></i>
                        Upload File
                    </label>
                    <input type="file" id="file_subkathukum" name="file_subkathukum" class="form-control">
                    <div class="invalid-feedback errorfile_subkathukum"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-share-square"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Batal</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('.btnsimpan').click(function(e) {
            e.preventDefault();
            let form = $('.formtambah')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: '<?= site_url('produkhukum/simpanSubsubproduk') ?>',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disable');
                    $('.btnsimpan').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable', 'disable');
                    $('.btnsimpan').html('<i class="mdi mdi-content-save-all"></i>  Simpan');
                },
                success: function(response) {
                    if (response.error) {

                        if (response.error.nama_subkathukum) {
                            $('#nama_subkathukum').addClass('is-invalid');
                            $('.errornama_subkathukum').html(response.error.nama_subkathukum);
                        } else {
                            $('#nama_subkathukum').removeClass('is-invalid');
                            $('.errornama_subkathukum').html('');
                        }

                        if (response.error.file_subkathukum) {
                            $('#file_subkathukum').addClass('is-invalid');
                            $('.errorfile_subkathukum').html(response.error.file_subkathukum);
                        } else {
                            $('#file_subkathukum').removeClass('is-invalid');
                            $('.errorfile_subkathukum').html('');
                        }
                        $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);

                    } else {

                        toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            },
                            toastr["success"](response.sukses)
                        $('#modaltambah').modal('hide');
                        $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                        listsubsubproduk();
                    }
                },
                error: function(xhr, ajaxOptions, thrownerror) {
                    toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), );
                    $('#modaltambah').modal('hide');
                    $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                }
            });
        });
    });
</script>