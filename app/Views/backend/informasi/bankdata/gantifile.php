<div class="modal fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <?= form_open_multipart('', ['class' => 'formupload']) ?>
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsikasmedia" />

            <input type="hidden" value="<?= $id ?>" name="bankdata_id">
            <div class="modal-body">
                <div class="col-lg-12">

                    <div class="form-group mb-2">
                        <?php if (esc($fileupload) != '') { ?>

                            <label> <i class="mdi mdi-cloud-upload"></i>
                                Ganti File
                            </label>
                        <?php } else { ?>
                            <label> <i class="mdi mdi-file"></i>
                                Upload File
                            </label>
                        <?php } ?>

                        <input type="file" id="fileupload" name="fileupload" class="form-control">
                        <div class="invalid-feedback errorfileupload"></div>
                        <div class="progress">
                            <div id="file-progress-bar" class="progress-bar"></div>
                        </div>
                    </div>
                    <?php if (esc($fileupload) != '') { ?>

                        <div class="form-group">
                            <label> <i class="mdi mdi-file-cloud"></i>
                                File saat ini :
                            </label>
                            <label><a target='_BLANK'
                                    href="<?= base_url('public/unduh/bankdata/' . esc($fileupload)) ?>"><?= esc($fileupload) ?></a></label>
                        </div>

                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnupload"><i class="mdi mdi-content-save-all"></i>
                    Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <i class="mdi mdi-cancel"></i>
                    Batal</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $(".progress").hide();
        $('.btnupload').click(function (e) {
            e.preventDefault();
            let form = $('.formupload')[0];
            let data = new FormData(form);

            $.ajax({
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (element) {
                        if (element.lengthComputable) {
                            $(".progress").show();
                            var percentComplete = ((element.loaded / element.total) * 100);
                            $("#file-progress-bar").width(percentComplete + '%');
                            // $("#file-progress-bar").html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                type: "post",
                url: '<?= site_url('bankdata/douploadbankdata') ?>',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function () {
                    $('.btnupload').attr('disable', 'disable');
                    $('.btnupload').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                    $("#file-progress-bar").width('0%');
                },
                complete: function () {
                    $('.btnupload').removeAttr('disable', 'disable');
                    $('.btnupload').html('<i class="mdi mdi-content-save-all"></i>  Simpan');
                },
                success: function (response) {
                    if (response.error) {
                        if (response.error.fileupload) {
                            $('#fileupload').addClass('is-invalid');
                            $('.errorfileupload').html(response.error.fileupload);
                            $(".progress").hide();
                        }
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    } else if (response.nofile) {

                        toastr["error"](response.nofile)
                        $("#file-progress-bar").width('0%');
                        $('#fileupload').addClass('is-invalid');
                        // $('.errornofile').html(response.error.nofile);
                        $(".progress").hide();
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    } else {
                        toastr["success"](response.sukses)
                        $('#modalupload').modal('hide');
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        listbankdata();

                    }
                },
                error: function (xhr, ajaxOptions, thrownerror) {
                    Swal.fire({
                        title: "Maaf gagal update file!",
                        html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function () {
                        $('#modalupload').modal('hide');
                        window.location = '';
                    })
                }
            });

        });
    });
</script>