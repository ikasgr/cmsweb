<!-- <link href="<?= base_url() ?>/public/template/backend/standar/assets/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?= base_url() ?>/public/template/backend/standar/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/public/template/backend/standar/assets/js/date-picker.js"></script> -->
<link href="<?= base_url('/public/template/backend/morvin/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet">
<script src="<?= base_url('/public/template/backend/morvin/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>

<div class="modal fade" id="modaledit">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title)  ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <?= form_open_multipart('', ['class' => 'formedit']) ?>


            <div class="modal-body">
                <!-- Nav tabs -->
                <!-- <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#profil" role="tab">Profil</a>
                    </li>
                 
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="profil" role="tabpanel">
                        <p> -->
                <input type="hidden" value="<?= $pegawai_id ?>" name="pegawai_id">
                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-account"></i>
                            Nama
                        </label>
                        <input type="text" id="nama" name="nama" value="<?= esc($nama) ?>" class="form-control">
                        <div class="invalid-feedback errornama"></div>
                    </div>

                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-account-key"></i>
                            NIP/No Pegawai
                        </label>
                        <input type="text" id="nip" name="nip" value="<?= esc($nip) ?>" class="form-control">
                        <div class="invalid-feedback errornip"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-map-marker-multiple"></i>
                            Tempat Lahir
                        </label>
                        <input type=" text" id="tempat_lahir" name="tempat_lahir" value="<?= esc($tempat_lahir) ?>" class="form-control">
                        <div class="invalid-feedback errortempat_lahir"></div>
                    </div>

                    <div class="form-group col-md-6 col-12 mb-2" id="tgllahir">
                        <label> <i class="mdi mdi-calendar-range"></i>
                            Tanggal Lahir
                        </label>
                        <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= shortdate_indo($tgl_lahir) ?>" data-date-format="dd M, yyyy" data-date-container='#tgllahir' data-provide="datepicker" data-date-autoclose="true">
                        <!-- <input type="text" id="tgl_lahir" name="tgl_lahir" value=" <?= shortdate_indo($tgl_lahir) ?>" class=" form-control date-picker"> -->
                        <div class="invalid-feedback errortgl_lahir"></div>
                    </div>

                </div>


                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-gender-male-female"></i>
                            Jenis Kelamin
                        </label>

                        <select class="form-select pointer" name="jk" id="jk">
                            <option Disabled=true Selected=true>-- Jenis Kelamin --</option>
                            <?php
                            $lk = "L";
                            $pr = "P";
                            ?>
                            <option value="L" <?= $jk ==  $lk ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= $jk ==  $pr ? 'selected' : '' ?>>Perempuan</option>
                        </select>

                        <div class="invalid-feedback errorjk"></div>
                    </div>

                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-file-document-box"></i>
                            Agama
                        </label>

                        <select class="form-select pointer" name="agama" id="agama">
                            <option Disabled=true Selected=true>-- Pilih Agama --</option>

                            <option value="Islam" <?= $agama ==  "Islam" ? 'selected' : '' ?>>Islam</option>
                            <option value="Kristen" <?= $agama ==  "Kristen" ? 'selected' : '' ?>>Kristen</option>
                            <option value="Katolik" <?= $agama ==  "Katolik" ? 'selected' : '' ?>>Katolik</option>
                            <option value="Hindu" <?= $agama ==  "Hindu" ? 'selected' : '' ?>>Hindu</option>
                            <option value="Buddha" <?= $agama ==  "Buddha" ? 'selected' : '' ?>>Buddha</option>
                            <option value="Khonghucu" <?= $agama ==  "Khonghucu" ? 'selected' : '' ?>>Khonghucu</option>

                        </select>
                        <div class="invalid-feedback erroragama"></div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-certificate"></i>
                            Pangkat - Golongan
                        </label>
                        <input type=" text" id="pangkat" name="pangkat" value="<?= esc($pangkat) ?>" class="form-control">
                        <div class="invalid-feedback errorpangkat"></div>
                    </div>

                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-arrange-send-backward"></i>
                            Jabatan
                        </label>
                        <input type="text" id="jabatan" name="jabatan" value="<?= esc($jabatan) ?>" class=" form-control">
                        <div class="invalid-feedback errorjabatan"></div>
                    </div>
                </div>

            </div>
            <!-- TAB LAIN-lain -->

            <!-- </div> -->
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary btnupdate"><i class="mdi mdi-content-save-all"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i> Batal</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {


        $('textarea#publikasi').summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: false
        });

        $('textarea#penelitian').summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: false
        });

        $('textarea#pengabdian').summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: false
        });


        $('.btnupdate').click(function(e) {
            e.preventDefault();
            let form = $('.formedit')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: '<?= site_url('pegawai/updatepegawai') ?>',
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

                        if (response.error.nip) {
                            $('#nip').addClass('is-invalid');
                            $('.errornip').html(response.error.nip);
                        } else {
                            $('#nip').removeClass('is-invalid');
                            $('.errornip').html('');
                        }

                        if (response.error.tempat_lahir) {
                            $('#tempat_lahir').addClass('is-invalid');
                            $('.errortempat_lahir').html(response.error.tempat_lahir);
                        } else {
                            $('#tempat_lahir').removeClass('is-invalid');
                            $('.errortempat_lahir').html('');
                        }

                        if (response.error.tgl_lahir) {
                            $('#tgl_lahir').addClass('is-invalid');
                            $('.errortgl_lahir').html(response.error.tgl_lahir);
                        } else {
                            $('#tgl_lahir').removeClass('is-invalid');
                            $('.errortgl_lahir').html('');
                        }

                        if (response.error.jk) {
                            $('#jk').addClass('is-invalid');
                            $('.errorjk').html(response.error.jk);
                        } else {
                            $('#jk').removeClass('is-invalid');
                            $('.errorjk').html('');
                        }

                        if (response.error.agama) {
                            $('#agama').addClass('is-invalid');
                            $('.erroragama').html(response.error.agama);
                        } else {
                            $('#agama').removeClass('is-invalid');
                            $('.erroragama').html('');
                        }

                        if (response.error.pangkat) {
                            $('#pangkat').addClass('is-invalid');
                            $('.errorpangkat').html(response.error.pangkat);
                        } else {
                            $('#pangkat').removeClass('is-invalid');
                            $('.errorpangkat').html('');
                        }

                        if (response.error.jabatan) {
                            $('#jabatan').addClass('is-invalid');
                            $('.errorjabatan').html(response.error.jabatan);
                        } else {
                            $('#jabatan').removeClass('is-invalid');
                            $('.errorjabatan').html('');
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
                        listpegawai();
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    }
                },
                error: function(xhr, ajaxOptions, thrownerror) {
                    toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), );
                    $('#modaledit').modal('hide');
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
            });
        });
    });
</script>