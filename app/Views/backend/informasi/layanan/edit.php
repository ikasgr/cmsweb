<div class="modal fade" id="modaledit">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <?= form_open_multipart('', ['class' => 'formedit']) ?>

            <div class="modal-body">
                <input type="hidden" value="<?= $informasi_id ?>" name="informasi_id">
                <div class="form-group mb-2">
                    <label> <i class="mdi mdi-text-shadow"></i>
                        Layanan
                    </label>
                    <input type="text" id="nama" name="nama" value="<?= esc($nama) ?>" class="form-control">
                    <div class="invalid-feedback errornama"></div>
                </div>

                <div class="form-group">
                    <label> <i class="ion-ios7-settings-strong"></i>
                        Deskripsi
                    </label>
                    <textarea type="text" id="isi_informasi" name="isi_informasi"> <?= $isi_informasi ?></textarea>
                    <div class="invalid-feedback errorisi_informasi"></div>
                </div>
            </div>

            <div class="modal-footer">

                <button type="submit" class="btn btn-primary btnupdate"><i class="mdi mdi-content-save-all"></i>
                    Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i>
                    Batal</button>
            </div>
            <?php echo form_close() ?>

        </div>

    </div>

</div>

<script>
    $(document).ready(function () {

        $('textarea#isi_informasi').summernote({
            height: 350,
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
        noteBar.find('[data-toggle]').each(function () {
            $(this).attr('data-bs-toggle', $(this).attr('data-toggle')).removeAttr('data-toggle');
        });

        $('.btnupdate').click(function (e) {
            e.preventDefault();
            let form = $('.formedit')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: '<?= site_url('layanan/updatelayanan') ?>',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function () {
                    $('.btnupdate').attr('disable', 'disable');
                    $('.btnupdate').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function () {
                    $('.btnupdate').removeAttr('disable', 'disable');
                    $('.btnupdate').html('<i class="mdi mdi-content-save-all"></i> Simpan');
                },
                success: function (response) {
                    if (response.error) {

                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errornama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errornama').html('');
                        }

                        if (response.error.isi_informasi) {
                            $('#isi_informasi').addClass('is-invalid');
                            $('.errorisi_informasi').html(response.error.isi_informasi);
                        } else {
                            $('#isi_informasi').removeClass('is-invalid');
                            $('.errorisi_informasi').html('');
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
                        listlayanan();

                    }
                },
                error: function (xhr, ajaxOptions, thrownerror) {
                    toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"),);
                    $('#modaledit').modal('hide');
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);

                }
            });
        });
    });
</script>