<link href="<?= base_url('/public/template/backend/morvin/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet">
<script src="<?= base_url('/public/template/backend/morvin/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>

<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title)  ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <?= form_open_multipart('', ['class' => 'formtambah']) ?>
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsdatagoe" />


            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-8 col-12 mb-2">
                        <label> <i class="mdi mdi-text-shadow"></i>
                            Tema Agenda
                        </label>
                        <input type="text" id="tema" name="tema" class="form-control">
                        <div class="invalid-feedback errortema"></div>
                    </div>
                    <div class="form-group col-md-4 col-12 mb-2">
                        <label> <i class="mdi mdi-send"></i>
                            Penyelenggara / Pengirim
                        </label>
                        <input type="text" id="pengirim" name="pengirim" class="form-control">
                        <div class="invalid-feedback errorpengirim"></div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label> <i class="ion-ios7-settings-strong"></i>
                        Deskripsi
                    </label>
                    <textarea type="text" id="isi_agenda" name="isi_agenda" class="form-control"></textarea>
                    <div class="invalid-feedback errorisi_agenda"></div>
                </div>

                <div class="row">

                    <div class="form-group col-md-3 col-12 mb-2">
                        <label> <i class="mdi mdi-map-marker-multiple"></i>
                            Tempat
                        </label>
                        <input type="text" id="tempat" name="tempat" class=" form-control">
                        <div class="invalid-feedback errortempat"></div>
                    </div>

                    <div class="form-group col-md-3 col-12 mb-2" id="tgl_mulai">
                        <label> <i class="mdi mdi-calendar-range"></i>
                            Tanggal Mulai
                        </label>
                        <!-- <input type="text" class="form-control" name="tgl_mulai" placeholder="dd M, yyyy" 
       data-date-format="dd M, yyyy" data-date-container="#tgl_mulai" 
       data-provide="datepicker" data-date-autoclose="true" required> -->
       <!-- <input type="text" class="form-control" name="tgl_mulai" placeholder="dd M, yyyy" 
       data-date-format="dd M, yyyy" data-date-container="#tgl_mulai" 
       data-provide="datepicker" data-date-autoclose="true" 
       data-date-start-view="years" data-date-min-view-mode="days"> -->

                        <input type="text" class="form-control" name="tgl_mulai" placeholder="dd M, yyyy" data-date-format="dd M, yyyy" data-date-container='#tgl_mulai' data-provide="datepicker" data-date-autoclose="true">
                        <!-- <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->
                        <div class="invalid-feedback errortgl_mulai"></div>
                    </div>
                    <div class="form-group col-md-3 col-12 mb-2" id="tgl_selesai">
                        <label> <i class="mdi mdi-calendar-range"></i>
                            Tanggal Selesai
                        </label>
                        <input type="text" class="form-control" name="tgl_selesai" placeholder="dd M, yyyy" data-date-format="dd M, yyyy" data-date-container='#tgl_selesai' data-provide="datepicker" data-date-autoclose="true">
                        <!-- <input class="form-control date-picker" id="tgl_selesai" type="text" name="tgl_selesai" /> -->
                        <div class="invalid-feedback errortgl_selesai"></div>
                    </div>

                    <div class="form-group col-md-3 col-12">
                        <label> <i class="mdi mdi-update"></i>
                            Jam s/d Selesai
                        </label>
                        <input type="text" id="jam" name="jam" class=" form-control" placeholder="cth: 08 - Selesai">
                        <div class="invalid-feedback errorjam"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label> <i class="mdi mdi-image"></i>
                        Cover Agenda
                    </label>
                    <input type="file" id="gambar" name="gambar" class="form-control">
                    <div class="invalid-feedback errorgambar"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-share-square"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i> Batal</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('textarea#isi_agenda').summernote({
            height: 200,
            fontSizes: ['11', '12', '13', '14', '15', '16', '17', '18', '20', '24', '36', '40', '48'],
            toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['height', ['height']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['color', ['color']],
                ['insert', ['picture', 'link', 'video', 'table']],
                // ['view', ['fullscreen']],
            ],
        });
        var noteBar = $('.note-toolbar');
        noteBar.find('[data-toggle]').each(function() {
            $(this).attr('data-bs-toggle', $(this).attr('data-toggle')).removeAttr('data-toggle');
        });


        $('.btnsimpan').click(function(e) {
            e.preventDefault();
            let form = $('.formtambah')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: '<?= site_url('agenda/simpanAgenda') ?>',
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

                        if (response.error.tema) {
                            $('#tema').addClass('is-invalid');
                            $('.errortema').html(response.error.tema);
                        } else {
                            $('#tema').removeClass('is-invalid');
                            $('.errortema').html('');
                        }


                        if (response.error.isi_agenda) {
                            $('#isi_agenda').addClass('is-invalid');
                            $('.errorisi_agenda').html(response.error.isi_agenda);
                        } else {
                            $('#isi_agenda').removeClass('is-invalid');
                            $('.errorisi_agenda').html('');
                        }

                        if (response.error.gambar) {
                            $('#gambar').addClass('is-invalid');
                            $('.errorGambar').html(response.error.gambar);
                        } else {
                            $('#gambar').removeClass('is-invalid');
                            $('.errorGambar').html('');
                        }

                        if (response.error.tempat) {
                            $('#tempat').addClass('is-invalid');
                            $('.errortempat').html(response.error.tempat);
                        } else {
                            $('#tempat').removeClass('is-invalid');
                            $('.errortempat').html('');
                        }

                        if (response.error.tgl_mulai) {
                            $('#tgl_mulai').addClass('is-invalid');
                            $('.errortgl_mulai').html(response.error.tgl_mulai);
                        } else {
                            $('#tgl_mulai').removeClass('is-invalid');
                            $('.errortgl_mulai').html('');
                        }

                        if (response.error.tgl_selesai) {
                            $('#tgl_selesai').addClass('is-invalid');
                            $('.errortgl_selesai').html(response.error.tgl_selesai);
                        } else {
                            $('#tgl_selesai').removeClass('is-invalid');
                            $('.errortgl_selesai').html('');
                        }

                        if (response.error.jam) {
                            $('#jam').addClass('is-invalid');
                            $('.errorjam').html(response.error.jam);
                        } else {
                            $('#jam').removeClass('is-invalid');
                            $('.errorjam').html('');
                        }

                        if (response.error.pengirim) {
                            $('#pengirim').addClass('is-invalid');
                            $('.errorpengirim').html(response.error.pengirim);
                        } else {
                            $('#pengirim').removeClass('is-invalid');
                            $('.errorpengirim').html('');
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
                        listagenda();

                    }
                },
                error: function(xhr, ajaxOptions, thrownerror) {

                    toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), )
                    $('#modaltambah').modal('hide');
                    $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);

                }
            });
        });
    });
</script>