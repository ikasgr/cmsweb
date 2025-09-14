<!-- Modal -->

<div class="modal fade" id="modalupload" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <?= form_open_multipart('', ['class' => 'formupload']) ?>

            <br>

            <?php
            if (file_exists('public/img/informasi/' . esc($list['gbrtawaran']))) {
                $gbr = base_url('public/img/informasi/' . esc($list['gbrtawaran']));
            } else {
                $gbr = base_url('public/img/informasi/profil/default.png');
            }

            ?>

            <center>
                <img class="img-thumbnail p-1" id="img_load" src="<?= $gbr ?>" alt="Foto" width="95%">
            </center>
            <input type="hidden" value="<?= $modalpopup_id ?>" name="modalpopup_id">
            <div class="modal-body">
                <div class="form-group">
                    <label>Ganti Foto</label>
                    <input type="file" class="form-control" id="gbrtawaran" name="gbrtawaran">
                    <div class="invalid-feedback errorgbrtawaran"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnupload"><i class="mdi mdi-content-save-all"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i> Batal</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img_load').attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#gbrtawaran').change(function() {
        bacaGambar(this);
    });
</script>

<script>
    $('.btnupload').click(function(e) {
        e.preventDefault();
        let form = $('.formupload')[0];
        let data = new FormData(form);

        $.ajax({
            type: "post",
            url: '<?= base_url('penawaran/douploadlogo') ?>',
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
                // $('.txt_csrfname').val(response.token);
                if (response.csrf_tokencmsdatagoe) {
                    //update hash untuk proses error validation 
                    $('#csrfToken, #csrfRandom').val(response.csrf_tokencmsdatagoe);
                    $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                }
                if (response.error) {
                    if (response.error.gbrtawaran) {
                        $('#gbrtawaran').addClass('is-invalid');
                        $('.errorgbrtawaran').html(response.error.gbrtawaran);
                    }
                } else if (response.nofile) {

                    toastr["error"](response.nofile)
                    $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);

                } else {
                    $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
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
                toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), )
                $('#modalupload').modal('hide');
                $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                // Swal.fire({
                //     title: "Maaf gagal update gambar!",
                //     html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                //     icon: "error",
                //     showConfirmButton: false,
                //     timer: 3100
                // }).then(function() {
                //     $('#modalupload').modal('hide');
                //     window.location = '';
                // })
            }
        });

    });
</script>