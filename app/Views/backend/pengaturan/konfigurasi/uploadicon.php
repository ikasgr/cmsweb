<!-- Modal -->
<div class="modal fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <?= form_open_multipart('', ['class' => 'formupload']) ?>
            <!-- <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsikasmedia" /> -->
            <br>
            <center>
                <img class="img-thumbnail" id="img_load"
                    src="<?= base_url('/public/img/konfigurasi/icon/' . esc($list['icon'])) ?>" alt="Icon Website">
            </center>

            <input type="hidden" value="<?= $id_setaplikasi ?>" name="id_setaplikasi">
            <div class="modal-body">

                <div class="form-group">
                    <label>Ganti Icon</label>
                    <input type="file" class="form-control" id="icon" name="icon">
                    <div class="invalid-feedback errorIcon"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnupload"><i class="fa fa-share-square"></i>
                    Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i>
                    Batal</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>


<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img_load').attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#icon').change(function () {
        bacaGambar(this);
    });
</script>

<script>
    $(document).ready(function () {
        $('.btnupload').click(function (e) {
            e.preventDefault();
            let form = $('.formupload')[0];
            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: '<?= site_url('konfigurasi/douploadicon') ?>',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function () {
                    $('.btnupload').attr('disable', 'disable');
                    $('.btnupload').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function () {
                    $('.btnupload').removeAttr('disable', 'disable');
                    $('.btnupload').html('<i class="fa fa-share-square"></i>  Simpan');
                },
                success: function (response) {
                    // if (response.csrf_tokencmsikasmedia) {
                    //     //update hash untuk proses error validation 
                    //     $('#csrfToken, #csrfRandom').val(response.csrf_tokencmsikasmedia);
                    //     $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia); //dataSrc untuk random request token char (wajib)
                    // }
                    if (response.error) {
                        if (response.error.icon) {
                            $('#icon').addClass('is-invalid');
                            $('.errorIcon').html(response.error.icon);
                        }
                    } else if (response.nofile) {

                        toastr["error"](response.nofile)
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function () {
                            $('#modalupload').modal('hide');
                            window.location = '';
                        })
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    }
                },
                error: function (xhr, ajaxOptions, thrownerror) {
                    Swal.fire({
                        title: "Maaf gagal update icon!",
                        html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2100
                    }).then(function () {
                        $('#modalupload').modal('hide');
                        window.location = '';
                    })
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
            });

        });
    });
</script>