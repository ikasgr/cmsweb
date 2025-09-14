<div class="modal fade" id="modalkomen">
    <div class="modal-dialog">
        <div class="modal-content">

            <?php
            $nm = htmlspecialchars($nama_komen, ENT_QUOTES);
            $isi = htmlspecialchars($isi_komen, ENT_QUOTES);
            ?>

            <div class="modal-header">
                <h5 class="modal-title mt-0">Komentar dari <?= esc($nm)  ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <?= form_open_multipart('', ['class' => 'formkomen']) ?>

            <div class="modal-body">
                <input type="hidden" value="<?= $beritakomen_id ?>" name="beritakomen_id">

                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-account"></i>
                            Nama Lengkap
                        </label>
                        <input type="text" id="nama_komen" name="nama_komen" value="<?= $nm ?>" class="form-control" readonly>

                    </div>
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="mdi mdi-email-variant"></i>
                            Email
                        </label>
                        <input type="text" id="email_komen" name="email_komen" value="<?= esc($email_komen) ?>" class=" form-control" readonly>

                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <?php
                        $blnk = date('m', strtotime($tanggal_komen));
                        $blnck = bulan($blnk);
                        $tglk = date('d', strtotime($tanggal_komen));
                        $thnk = date('Y', strtotime($tanggal_komen));
                        $jamk = date('H:i:s', strtotime($tanggal_komen));
                        ?>
                        <label> <i class="mdi mdi-account"></i>
                            Tanggal
                        </label>
                        <input type="text" id="tanggal_komen" name="tanggal_komen" value="<?= $tglk . ' ' . $blnck . ' ' . $thnk . ' ' . $jamk ?>" class="form-control" readonly>

                    </div>
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> <i class="fas fa-tty"></i>
                            No HP
                        </label>
                        <input type="text" id="hp_komen" name="hp_komen" value="<?= esc($hp_komen) ?>" class=" form-control" readonly>

                    </div>
                </div>

                <div class="form-group mb-2">
                    <label> <i class="mdi mdi-message-processing"></i>
                        Isi Komentar
                    </label>
                    <textarea type="text" class="form-control" id="isi_komen" name="isi_komen"><?= $isi ?></textarea>
                    <div class="invalid-feedback errorisi_komen"></div>
                </div>

                <div class="form-group mb-2">
                    <label class="text-primary"><i class="mdi mdi-clipboard-check-outline"></i> Aktifkan Komentar </label>
                    <div class="form-control p-0">
                        &nbsp; <input type="radio" name="sts_komen" value="1" id="sts_komen1" <?= $sts_komen == '1' ? 'checked' : '' ?>> <label for="sts_komen1" class="pointer pt-2"> Ya &nbsp</label>
                        <input type="radio" name="sts_komen" value="0" id="sts_komen2" <?= $sts_komen == '0' ? 'checked' : '' ?>> <label for="sts_komen2" class="pointer pt-2"> Tidak &nbsp</label>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label class="text-primary"> <i class="far fa-comments"></i>
                        Balas Komentar
                    </label>
                    <?php if (esc($balas_komen) != '') { ?>
                        <textarea type="text" class="form-control" id="balas_komen" name="balas_komen"><?= esc($balas_komen) ?></textarea>
                    <?php } else { ?>
                        <textarea type="text" class="form-control" id="balas_komen" name="balas_komen" autofocus>@<?= $nm ?>, </textarea>
                    <?php } ?>
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
            $('.btnupload').click(function(e) {
                e.preventDefault();
                let form = $('.formkomen')[0];
                let data = new FormData(form);
                $.ajax({
                    type: "post",
                    url: '<?= site_url('berita/updatekomentar') ?>',
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
                        if (response.error) {

                            if (response.error.isi_komen) {
                                $('#isi_komen').addClass('is-invalid');
                                $('.errorisi_komen').html(response.error.isi_komen);
                            } else {
                                $('#isi_komen').removeClass('is-invalid');
                                $('.errorisi_komen').html('');
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

                            $('#modalkomen').modal('hide');
                            listkomen();
                            listkomennew();
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        }

                    },
                    error: function(xhr, ajaxOptions, thrownerror) {
                        toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), );
                        $('#modalkomen').modal('hide');
                    }
                });
            });
        });
    </script>