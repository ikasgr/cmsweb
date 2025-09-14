<script src="<?= base_url() ?>/public/template/backend/morvin/assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?= base_url() ?>/public/template/backend/morvin/assets/libs/bootstrap-colorpicker/js/form-advanced.js"></script>
<link href="<?= base_url() ?>/public/template/backend/morvin/assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" /> -->

<div class="modal fade" id="modaledit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open_multipart('', ['class' => 'formedit']) ?>

            <div class='card-body pt-0'>
                <input type="hidden" class="form-control" id="template_id" value="<?= $template_id ?>" name="template_id" readonly>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Setting Umum Tema</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#cover" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Gambar Cover</span>
                        </a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content text-muted pt-3">
                    <div class="tab-pane active" id="home1" role="tabpanel">
                        <p class="mb-0">

                        <div class="row ">
                            <div class="form-group col-md-6 col-12">
                                <div class="mb-3">
                                    <label> <i class="mdi mdi-text-shadow"></i>
                                        Nama Template
                                    </label>
                                    <input type="text" class="form-control" id="nama" value="<?= esc($nama) ?>" name="nama">
                                    <div class="invalid-feedback errornama"></div>
                                </div>
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <div class="mb-3">
                                    <label> <i class="far fa-folder"></i>
                                        Nama Folder
                                    </label>
                                    <?php if (esc($folder) == 'standar' || esc($folder) == 'morvin') { ?>
                                        <input type="text" class="form-control" id="folder" value="<?= esc($folder) ?>" name="folder" readonly>
                                    <?php  } else { ?>
                                        <input type="text" class="form-control" id="folder" value="<?= esc($folder) ?>" name="folder">
                                    <?php } ?>

                                    <div class="invalid-feedback errorfolder"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <div class="mb-3">
                                    <label><i class="mdi mdi-format-color-fill"></i>Warna Topbar</label>
                                    <input type="text" class="colorpicker-default form-control form-control" id="warna_topbar" name="warna_topbar" value="<?= esc($warna_topbar) ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <div class="mb-3">
                                    <label> <i class="mdi mdi-page-layout-sidebar-left"></i> Mode Sidebar</label>
                                    <div class="form-control p-0">
                                        &nbsp;<input type="radio" name="sidebar_mode" id="sidebar_mode2" value="0" <?= $sidebar_mode == '0' ? 'checked' : '' ?>> <label for="sidebar_mode2" class="pointer pt-2"> Light &nbsp;</label>
                                        <input type="radio" name="sidebar_mode" id="sidebar_mode1" value="1" <?= $sidebar_mode == '1' ? 'checked' : '' ?>> <label for="sidebar_mode1" class="pointer pt-2"> Dark </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <!-- <div class="mb-3"> -->
                                <label> <i class="far fa-user"></i>
                                    Sumber Pembuat
                                </label>
                                <input type="text" class="form-control" id="pembuat" value="<?= esc($pembuat) ?>" name="pembuat">
                                <div class="invalid-feedback errorpembuat"></div>
                                <!-- </div> -->
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <!-- <div class="mb-3"> -->
                                <label> <i class="ion-ios7-settings-strong"></i>
                                    Keterangan
                                </label>
                                <input type="text" class="form-control" id="ket" name="ket" value="<?= esc($ket) ?>">
                                <div class="invalid-feedback errorket"></div>
                                <!-- </div> -->
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="tab-pane" id="cover" role="tabpanel">
                        <p class="mb-0">
                        <div class="form-group">
                            <label> <i class="mdi mdi-file-image"></i>
                                Upload Gambar
                            </label>
                            <input type="file" class="form-control" id="img" name="img">
                            <div class="invalid-feedback errorimg"></div>

                        </div>
                        <?php if (esc($img) != '' && esc($img) != 'default.png') { ?>
                            <div class="form-group">
                                <center>
                                    <img class="img-thumbnail " id='img_load' width='80%' src='<?= base_url('public/img/template/' . esc($img)) ?>'>
                                </center>
                            </div>
                        <?php } ?>
                        </p>
                    </div>

                </div>

                <div class="modal-footer pt-2">
                    <button type="submit" class="btn btn-primary btnupdate"><i class="mdi mdi-content-save-all"></i> Simpan</button>
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
        $('#img').change(function() {
            bacaGambar(this);
        });
        $(document).ready(function() {

            $('.btnupdate').click(function(e) {
                e.preventDefault();
                let form = $('.formedit')[0];
                let data = new FormData(form);

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

                    $.ajax({
                        type: "post",
                        url: '<?= site_url('template/updatetemplateback') ?>',
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",

                        beforeSend: function() {
                            $('.btnupdate').attr('disable', 'disable');
                            $('.btnupdate').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                        },
                        complete: function() {
                            $('.btnupdate').removeAttr('disable', 'disable');
                            $('.btnupdate').html('<i class="mdi mdi-content-save-all"></i> Simpan');
                        },
                        success: function(response) {
                            if (response.error) {

                                if (response.error.nama) {
                                    $('#nama').addClass('is-invalid');
                                    $('.errornama').html(response.error.nama);
                                } else {
                                    $('#nama').removeClass('is-invalid');
                                    $('.errornama').html('');
                                }

                                if (response.error.pembuat) {
                                    $('#pembuat').addClass('is-invalid');
                                    $('.errorpembuat').html(response.error.pembuat);
                                } else {
                                    $('#pembuat').removeClass('is-invalid');
                                    $('.errorpembuat').html('');
                                }

                                if (response.error.folder) {
                                    $('#folder').addClass('is-invalid');
                                    $('.errorfolder').html(response.error.folder);
                                } else {
                                    $('#folder').removeClass('is-invalid');
                                    $('.errorfolder').html('');
                                }
                                if (response.error.img) {
                                    $('#img').addClass('is-invalid');
                                    $('.errorimg').html(response.error.img);
                                } else {
                                    $('#img').removeClass('is-invalid');
                                    $('.errorimg').html('');
                                }
                                $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                            } else {

                                // toastr["success"]("Berhasil simpan")
                                // toastr.success["success"](response.sukses)
                                toastr.success(response.sukses);
                                $('#modaledit').modal('hide');
                                // $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                                // listtemplateback();
                                window.location = '';
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownerror) {

                            toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), )
                            $('#modaledit').modal('hide');
                            $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                        }
                    });
            });

        });
    </script>