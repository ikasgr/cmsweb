<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <?= form_open_multipart('', ['class' => 'formedit']) ?>

            <div class="modal-body">

                <input type="hidden" class="form-control" id="id_modul" value="<?= $id_modul ?>" name="id_modul" readonly>

                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-text-shadow"></i>
                            Nama Modul
                        </label>
                        <input type="text" id="modul" name="modul" value="<?= esc($modul) ?>" class="form-control">
                        <div class="invalid-feedback errormodul"></div>
                    </div>

                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-text-shadow"></i>
                            Grup Menu
                        </label>
                        <select name="gm" id="gm" class="form-select pointer">
                            <option value="-" selected>--TIDAK DIJADIKAN MENU--</option>
                            <?php foreach ($modulmenu as $key => $data) { ?>
                                <option value="<?= esc($data['gm']) ?>" <?= esc($gm) ==  esc($data['gm']) ? 'selected' : '' ?>><?= esc($data['modul']) ?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-text-shadow"></i>
                            Urutan Modul
                        </label>
                        <input type="number" id="urut" name="urut" value="<?= $urut ?>" class="form-control">
                        <div class="invalid-feedback errorurut"></div>
                    </div>

                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-text-shadow"></i>
                            URL Menu
                        </label>

                        <?php if (esc($urlmenu) == 'modul' || esc($urlmenu) == 'template' || esc($urlmenu) == 'user' || esc($urlmenu) == 'konfigurasi' || esc($urlmenu) == 'menu') {
                            $ron = 'readonly';
                        } else {
                            $ron = '';
                        }
                        ?>
                        <input type="text" id="urlmenu" name="urlmenu" value="<?= esc($urlmenu) ?>" placeholder="Link Controler utk Akses Modul" class="form-control" <?= $ron ?>>
                        <div class="invalid-feedback errorurlmenu"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-text-shadow"></i>
                            Ikon
                        </label>
                        <input type="text" id="ikonmn" name="ikonmn" value="<?= esc($ikonmn) ?>" placeholder="Jika tdk dijadikan menu abaikan." class="form-control">
                    </div>

                    <div class="form-group col-md-6 col-12 mb-2">
                        <label>Lihat Icon</label>
                        <div class="btn-group mr-2">
                            <button type="button" onclick="openMyModal2()" class="btn btn-outline-secondary waves-effect waves-light mr-1" data-bs-toggle="modal" data-bs-target=".fontawesome">Awesome</button>
                            <button type="button" onclick="openMyModal2()" class="btn btn-outline-secondary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".mdideril">Material Design</button>
                        </div>
                    </div>
                </div>

                <!-- <small> <strong class="text-warning"><i> Pembuatan modul ini, hanya untuk mendaftarkan Modul baru ..!</i></strong></small> -->

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="mdi mdi-content-save-all"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i> Tutup</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>


<script>
    function openMyModal2() {
        let myModal = new
        bootstrap.Modal(document.getElementById('modaledit'), {});
        myModal.show();
    }
    $(document).ready(function() {

        $('.btnsimpan').click(function(e) {
            e.preventDefault();
            let form = $('.formedit')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: '<?= site_url('modul/updatemodul') ?>',
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

                        if (response.error.modul) {
                            $('#modul').addClass('is-invalid');
                            $('.errormodul').html(response.error.modul);
                        } else {
                            $('#modul').removeClass('is-invalid');
                            $('.errormodul').html('');
                        }

                        if (response.error.urlmenu) {
                            $('#urlmenu').addClass('is-invalid');
                            $('.errorurlmenu').html(response.error.urlmenu);
                        } else {
                            $('#urlmenu').removeClass('is-invalid');
                            $('.errorurlmenu').html('');
                        }

                        if (response.error.urut) {
                            $('#urut').addClass('is-invalid');
                            $('.errorurut').html(response.error.urut);
                        } else {
                            $('#urut').removeClass('is-invalid');
                            $('.errorurut').html('');
                        }
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);

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
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        listmodul();
                    }
                },
                error: function(xhr, ajaxOptions, thrownerror) {

                    toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), )
                    $('#modaledit').modal('hide');
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);

                }
            });
        });
    });
</script>