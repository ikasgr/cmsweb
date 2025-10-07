<div class="modal fade" id="modaledit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title mt-0">Pesan dari <?= esc($nama)  ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <?= form_open_multipart('', ['class' => 'formkritiksaran']) ?>
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsdatagoe" />

            <div class="modal-body">
                <input type="hidden" value="<?= $kritiksaran_id ?>" name="kritiksaran_id">
                <input type="hidden" value="<?= $status ?>" name="status">
                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-account"></i>
                            Nama
                        </label>
                        <input type="text" id="nama" name="nama" value="<?= esc($nama) ?>" class="form-control" readonly>

                    </div>
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-email-variant"></i>
                            Email
                        </label>
                        <input type="text" id="email" name="email" value="<?= esc($email) ?>" class=" form-control" readonly>

                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-calendar-text"></i>
                            Topik
                        </label>
                        <input type="text" id="judul" name="judul" value="<?= esc($judul) ?>" class="form-control" readonly>

                    </div>
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="fas fa-tty"></i>
                            No HP
                        </label>
                        <input type="text" id="nohp_usr" name="nohp_usr" value="<?= esc($no_hpusr) ?>" class=" form-control" readonly>

                    </div>
                </div>

                <div class="form-group mb-2">
                    <label> <i class="mdi mdi-message-processing"></i>Isi Kritik / Saran <small> (Anda dapat sensor pesan yang tidak pantas.) </small></label>
                    <textarea type="text" rows="1" class="form-control bg-light" id="isi_kritik" name="isi_kritik"><?= esc($isi_kritik) ?></textarea>

                </div>

                <div class="form-group mb-2">
                    <label> <i class="far fa-comments text-primary"></i>
                        Balas Kritik / Saran
                    </label>
                    <code><a class="text-secondary"> Pesan pembuka:</a><a class="text-danger"> <?= $pesanbalas ?> </a><a class="text-secondary">Selanjutnya isi balasan dibawah.</a></code>
                    <textarea type="text" class="form-control" id="balas" name="balas"><?= $balas ?></textarea>
                    <div class="invalid-feedback errorbalas"></div>
                </div>

                <div class="modal-footer p-0">
                    <?php if ($akses == 1) { ?>
                        <div class="float-right">
                            <button class="btn btn-primary btnupload"><i class="fas fa-paper-plane"></i> Kirim Balasan</button>
                        </div>
                    <?php } ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i> Tutup</button>

                </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('textarea#balas').summernote({
                height: 150,
                minHeight: null,
                maxHeight: null,
                focus: true
            });
            var noteBar = $('.note-toolbar');
            noteBar.find('[data-toggle]').each(function() {
                $(this).attr('data-bs-toggle', $(this).attr('data-toggle')).removeAttr('data-toggle');
            });


            $('.btnupload').click(function(e) {
                e.preventDefault();
                let form = $('.formkritiksaran')[0];
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
                        url: '<?= site_url('kritiksaran/updatestatus') ?>',
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
                            $('.btnupload').html('<i class="fas fa-paper-plane"></i> Kirim Balasan');
                        },
                        success: function(response) {

                            if (response.noakses) {
                                toastr["error"](response.noakses)
                                Swal.fire({
                                    title: "Gagal Akses!",
                                    html: `Anda tidak berhak mengakses <strong>Modul ini</strong> `,
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 3100
                                }).then(function() {
                                    window.location = '../';
                                })
                                $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                            }

                            if (response.blmakses) {

                                Swal.fire({
                                    title: "Maaf gagal load Modul!",
                                    html: `Modul ini belum atau tidak didaftarkan `,
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 3100
                                }).then(function() {
                                    window.location = '../admin';
                                })
                            }

                            if (response.error) {

                                if (response.error.balas) {
                                    $('#balas').addClass('is-invalid');
                                    $('.errorbalas').html(response.error.balas);
                                } else {
                                    $('#balas').removeClass('is-invalid');
                                    $('.errorbalas').html('');
                                }
                                $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                            } else {

                                toastr["success"](response.sukses)

                                $('#modaledit').modal('hide');
                                listkritiksaran();
                                listkritiksaran2();
                                $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownerror) {
                            toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), );
                            $('#modaledit').modal('hide');
                        }
                    });
            });
        });
    </script>