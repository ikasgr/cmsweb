<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title)  ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <?= form_open('masterdata/updatedata', ['class' => 'formedit']) ?>

            <div class="modal-body">
                <input type="hidden" class="form-control" id="id_masterdata" value="<?= $id_masterdata ?>" name="id_masterdata" readonly>
                <input type="hidden" class="form-control" id="req" value="<?= $req ?>" name="req" readonly>

                <div class="row">
                    <div class="form-group mb-2">
                        <label><?= esc($jdl) ?> </label>
                        <input type="text" class="form-control" id="nama_master" value="<?= esc($nama_master) ?>" name="nama_master">
                        <div class="invalid-feedback errornama_master"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="mdi mdi-content-save-all"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i> Batal</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formedit').submit(function(e) {
            e.preventDefault();
            let title = $('input#nama_master').val()
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                    id_masterdata: $('input#id_masterdata').val(),
                    req: $('input#req').val(),
                    nama_master: $('input#nama_master').val(),
                    // kd_kat: $('input#kd_kat').val(),

                },
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
                        if (response.error.nama_master) {
                            $('#nama_master').addClass('is-invalid');
                            $('.errornama_master').html(response.error.nama_master);
                        } else {
                            $('#nama_master').removeClass('is-invalid');
                            $('.errornama_master').html('');
                        }

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
                        $('#modaledit').modal('hide');
                        $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                        listmaster();
                    }
                },

                error: function(xhr, ajaxOptions, thrownerror) {
                    toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), );
                    $('#modaledit').modal('hide');
                    $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                }
            });
        })
    });
</script>