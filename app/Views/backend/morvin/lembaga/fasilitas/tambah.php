<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= $title  ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <?= form_open_multipart('', ['class' => 'formtambah']) ?>

            <div class="modal-body">

                <div class="form-group mb-2">
                    <label>Fasilitas</label>
                    <input type="text" class="form-control" id="fasilitas" name="fasilitas">
                    <div class="invalid-feedback errorfasilitas"></div>
                </div>
                <div class="form-group mb-2">
                    <label> </i>
                        Keterangan
                    </label>
                    <textarea type="text" rows="3" id="ket" name="ket" class="form-control"></textarea>

                </div>

                <div class="form-group">
                    <label> </i>
                        Lokasi GMap
                    </label>
                    <textarea type="text" rows="3" id="lokasi" name="lokasi" class="form-control"></textarea>

                </div>
                <div class="form-group">
                    <label>Cover</label>
                    <input type="file" class="form-control" id="cover_foto" name="cover_foto">
                    <div class="invalid-feedback errorcover_foto"></div>
                </div>

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
    $(document).ready(function() {

        $('textarea#ket').summernote({
            height: 300,
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
                    url: '<?= site_url('fasilitas/simpanfasilitas') ?>',
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

                            if (response.error.fasilitas) {
                                $('#fasilitas').addClass('is-invalid');
                                $('.errorfasilitas').html(response.error.fasilitas);
                            } else {
                                $('#fasilitas').removeClass('is-invalid');
                                $('.errorfasilitas').html('');
                            }

                            if (response.error.cover_foto) {
                                $('#cover_foto').addClass('is-invalid');
                                $('.errorcover_foto').html(response.error.cover_foto);
                            } else {
                                $('#cover_foto').removeClass('is-invalid');
                                $('.errorcover_foto').html('');
                            }

                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        } else {

                            toastr["success"](response.sukses)
                            $('#modaltambah').modal('hide');
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                            listfasilitas();
                        }
                    },

                    error: function(xhr, ajaxOptions, thrownerror) {
                        toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), );
                        $('#modaltambah').modal('hide');
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);

                    }
                });
        });
    });
</script>