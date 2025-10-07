<div class="modal fade" id="modaledit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open_multipart('', ['class' => 'formgambar']) ?>

            <div class="modal-body">
                <input type="hidden" value="<?= $section_id ?>" name="section_id">
                <input type="hidden" value="<?= $template_id ?>" name="template_idold">
                <input type="hidden" value="<?= $urutan ?>" name="urutanold">


                <div class="row">
                    <div class="form-group col-md-7 col-12 mb-2">
                        <label>Judul <b class="text-danger">*</b></label>

                        <input type="text" class="form-control" value="<?= esc($nama_section) ?>" id="nama_section" name="nama_section">
                        <div class="invalid-feedback errornama_section"></div>

                    </div>

                    <div class="form-group col-md-3 col-12 mb-2">
                        <label>Tautkan ke Template <b class="text-danger">*</b></label>
                        <select name="template_id" id="template_id" class="form-select pointer">
                            <option Disabled=true Selected=true>-- Pilih Template --</option>
                            <?php foreach ($template as $key => $data) { ?>

                                <option value="<?= $data['template_id'] ?>" <?= $template_id ==  $data['template_id'] ? 'selected' : '' ?>><?= esc($data['nama']) ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errortemplate_id"></div>
                    </div>
                    <div class="form-group col-md-2 col-12 mb-2">
                        <label>Urutan Section <b class="text-danger">*</b></label>
                        <select name="urutan" id="urutan" class="form-select pointer">
                            <option Disabled=true Selected=true>-- Urutan --</option>
                            <?php for ($x = 1; $x <= 10; $x++) { ?>
                                <option value="<?= $x ?>" <?= $x ==  $urutan ? 'selected' : '' ?>><?= $x ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorurutan"></div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <!-- <label>Isi Script <b class="text-danger">*</b></label> -->
                    <textarea type="text" class="form-control " id="isi_script" name="isi_script"><?= ($isi_script) ?></textarea>
                    <div class="invalid-feedback errorisi_script"></div>
                </div>
                <div class="row">
                    <div class="form-group col-md-9 col-12 mb-2">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= esc($deskripsi) ?>">
                    </div>
                    <div class="form-group col-md-3 col-12 mb-2">

                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary btnupload"><i class="mdi mdi-content-save-all"></i> Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i> Batal</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<script>
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

    $(document).ready(function() {
        // $("#single").hide();
        $('.btnupload').click(function(e) {
            e.preventDefault();
            let form = $('.formgambar')[0];
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
                    url: '<?= site_url('section-script/updatesection') ?>',
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
                        $('.btnupload').html('<i class="mdi mdi-content-save-all"></i> Simpan');
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

                            $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);

                        } else if (response.setganda) {
                            $('#template_id').addClass('is-invalid');
                            $('.errortemplate_id').html(response.setganda.template_id);

                            toastr["error"](response.setganda)
                            $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                        } else {

                            toastr["success"](response.sukses)
                            $('#modaledit').modal('hide');
                            $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                            listsection();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownerror) {
                        toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), );
                        $('#modaledit').modal('hide');
                        $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                    }
                });
        });
    });
</script>