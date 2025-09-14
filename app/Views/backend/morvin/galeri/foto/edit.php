<link href="<?= base_url('/public/template/backend/morvin/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet">
<script src="<?= base_url('/public/template/backend/morvin/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>

<div class="modal fade" id="modaledit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title)  ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <?= form_open_multipart('', ['class' => 'formedit']) ?>

            <div class="modal-body">
                <input type="hidden" class="form-control" id="kategorifoto_id" value="<?= $kategorifoto_id ?>" name="kategorifoto_id" readonly>
                <div class="form-group mb-2">
                    <label>Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori_foto" value="<?= esc($nama_kategori_foto) ?>" name="nama_kategori_foto">
                    <div class="invalid-feedback errorNamakategori"></div>

                </div>
                <div class="form-group mb-2">
                    <label>
                        Deskripsi
                    </label>
                    <textarea type="text" rows="3" id="ket" name="ket" class="form-control"><?= esc($ket) ?></textarea>

                </div>

                <div class="form-group " id="tglalbum">
                    <label> Tanggal Album </label>
                    <input type="text" class="form-control" id="tgl_album" name="tgl_album" value="<?= shortdate_indo($tgl_album) ?>" data-date-format="dd M, yyyy" data-date-container='#tglalbum' data-provide="datepicker" data-date-autoclose="true">
                    <div class="invalid-feedback errortgl_album"></div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnupdate"><i class="mdi mdi-content-save-all"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i> Batal</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('.btnupdate').click(function(e) {
            e.preventDefault();
            let form = $('.formedit')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: '<?= site_url('foto/updatekategori') ?>',
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

                        if (response.error.nama_kategori_foto) {
                            $('#nama_kategori_foto').addClass('is-invalid');
                            $('.errorNamakategori').html(response.error.nama_kategori_foto);
                        } else {
                            $('#nama_kategori_foto').removeClass('is-invalid');
                            $('.errorNamakategori').html('');
                        }

                        if (response.error.tgl_album) {
                            $('#tgl_album').addClass('is-invalid');
                            $('.errortgl_album').html(response.error.tgl_album);
                        } else {
                            $('#tgl_album').removeClass('is-invalid');
                            $('.errortgl_album').html('');
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
                        listkategorifoto();
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