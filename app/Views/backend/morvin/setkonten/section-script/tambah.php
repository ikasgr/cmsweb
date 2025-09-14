<div class="modal fade" id="modaltambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open_multipart('', ['class' => 'formtambah']) ?>

            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-7 col-12 mb-2">
                        <label>Judul <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" id="nama_section" name="nama_section">
                        <div class="invalid-feedback errornama_section"></div>
                    </div>

                    <div class="form-group col-md-3 col-12 mb-2">
                        <label>Tautkan ke Template <b class="text-danger">*</b></label>
                        <select name="template_id" id="template_id" class="form-select pointer">
                            <option Disabled=true Selected=true>-- Pilih Template --</option>
                            <?php foreach ($template as $key => $data) { ?>
                                <option value="<?= $data['template_id'] ?>"><?= esc($data['nama']) ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errortemplate_id"></div>
                    </div>
                    <div class="form-group col-md-2 col-12 mb-2">
                        <label>Urutan Section <b class="text-danger">*</b></label>
                        <select name="urutan" id="urutan" class="form-select pointer">
                            <option Disabled=true Selected=true>-- Urutan --</option>
                            <?php for ($x = 1; $x <= 10; $x++) { ?>
                                <option value="<?= $x ?>"><?= $x ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorurutan"></div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- <label>Isi Script <b class="text-danger">*</b></label> -->
                    <textarea type="text" class="form-control " id="isi_script" name="isi_script"></textarea>
                    <div class="invalid-feedback errorisi_script"></div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3 col-12 mb-2">
                        <label>Upload Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar">
                        <div class="invalid-feedback errorgambar"></div>

                    </div>
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                    </div>
                    <div class="form-group col-md-3 col-12 mb-2">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btnupload"><i class="mdi mdi-content-save-all"></i> Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i> Batal</button>
                        </div>
                    </div>
                </div>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('textarea#isi_script').summernote({
            height: 300,
            fontSizes: ['11', '12', '13', '14', '15', '16', '17', '18', '20', '24', '36', '40', '48'],

            toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['height', ['height']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['color', ['color']],
                ['insert', ['picture', 'link', 'video', 'table', 'codeview']],
                ['view', ['fullscreen']],

            ],

        });
        var noteBar = $('.note-toolbar');
        noteBar.find('[data-toggle]').each(function() {
            $(this).attr('data-bs-toggle', $(this).attr('data-toggle')).removeAttr('data-toggle');
        });

        $('.btnupload').click(function(e) {
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
                    url: '<?= site_url('section-script/simpan') ?>',
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
                        if (response.error) {
                            if (response.error.nama_section) {
                                $('#nama_section').addClass('is-invalid');
                                $('.errornama_section').html(response.error.nama_section);
                            } else {
                                $('#nama_section').removeClass('is-invalid');
                                $('.errornama_section').html('');
                            }

                            if (response.error.template_id) {
                                $('#template_id').addClass('is-invalid');
                                $('.errortemplate_id').html(response.error.template_id);
                            } else {
                                $('#template_id').removeClass('is-invalid');
                                $('.errortemplate_id').html('');
                            }
                            if (response.error.urutan) {
                                $('#urutan').addClass('is-invalid');
                                $('.errorurutan').html(response.error.urutan);
                            } else {
                                $('#urutan').removeClass('is-invalid');
                                $('.errorurutan').html('');
                            }
                            if (response.error.isi_script) {
                                $('#isi_script').addClass('is-invalid');
                                $('.errorisi_script').html(response.error.isi_script);
                            } else {
                                $('#isi_script').removeClass('is-invalid');
                                $('.errorisi_script').html('');
                            }
                            if (response.error.gambar) {
                                $('#gambar').addClass('is-invalid');
                                $('.errorgambar').html(response.error.gambar);
                            } else {
                                $('#gambar').removeClass('is-invalid');
                                $('.errorgambar').html('');
                            }
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);

                        } else if (response.setganda) {
                            $('#template_id').addClass('is-invalid');
                            $('.errortemplate_id').html(response.setganda.template_id);

                            toastr["error"](response.setganda)
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        } else {

                            toastr["success"](response.sukses)
                            $('#modaltambah').modal('hide');
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                            listsection();
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