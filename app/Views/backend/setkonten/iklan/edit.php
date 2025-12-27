<div class="modal fade" id="modaledit">

    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <?= form_open_multipart('', ['class' => 'formfoto']) ?>

            <div class="modal-body">

                <input type="hidden" value="<?= $id_banner ?>" name="id_banner">
                <div class="form-group mb-2">
                    <label> <i class="mdi mdi-text-shadow"></i>
                        Keterangan
                    </label>
                    <input type="text" id="ket" name="ket" value="<?= esc($ket) ?>" class="form-control">

                </div>
                <div class="form-group mb-2">
                    <label> <i class="mdi mdi-link-variant"></i>
                        Link Sebelumnya
                    </label>
                    <input type="text" id="linkold" name="linkold" title="<?= esc($link) ?>" readonly
                        value="<?= esc($link) ?>" class="form-control">

                </div>

                <!-- Single menu start -->
                <div id="single">
                    <div class="row">
                        <div class="form-group col-md-6 col-12 mb-2">
                            <label><i class="mdi mdi-clipboard-check-outline"></i> Posisi Iklan</label>
                            <select class="form-select pointer" name="posisi" id="posisi">
                                <option Disabled=true Selected=true>-- Pilih Posisi--</option>

                                <option value="1" <?= $posisi == '1' ? 'selected' : '' ?>>Beranda Tengah</option>
                                <option value="2" <?= $posisi == '2' ? 'selected' : '' ?>>Beranda Kiri</option>
                                <option value="3" <?= $posisi == '3' ? 'selected' : '' ?>>Atas</option>
                                <option value="4" <?= $posisi == '4' ? 'selected' : '' ?>>Kanan</option>

                            </select>
                        </div>
                        <div class="form-group col-md-6 col-12 mb-2">
                            <label><i class="mdi mdi-clipboard-check-outline"></i> Sumber Link</label> <small
                                class="text-secondary">(Pilih jika Link diganti)</small>
                            <select class="form-select pointer" name="sumberlink" id="sumberlink">

                                <option Disabled=true Selected=true>-- Pilih Sumber Link--</option>
                                <option value="1">Kategori Berita</option>
                                <option value="2">Halaman</option>
                                <option value="3">Modul CMS</option>
                                <option value="4">Eksternal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-2" id="berita">
                        <label><i class="mdi mdi-clipboard-check-outline"></i> Pilih Kategori Berita</label>
                        <select name="dberita" id="dberita" class="form-select pointer">
                            <option Disabled=true Selected=true>--Pilih Kategori Berita--</option>
                            <?php foreach ($kategori as $key => $data) { ?>
                                <option data-link="category/<?= esc($data['slug_kategori']) ?>">
                                    <?= esc($data['nama_kategori']) ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorKategori"></div>
                    </div>

                    <div class="form-group mb-2" id="halaman">
                        <label><i class="mdi mdi-clipboard-check-outline"></i> Pilih Halaman</label>
                        <select name="dhalaman" id="dhalaman" class="form-control select2" data-width="100%">
                            <option Disabled=true Selected=true>--Pilih Halaman--</option>
                            <?php foreach ($halaman as $key => $data) { ?>
                                <option data-link="page/<?= esc($data['slug_berita']) ?>"><?= esc($data['judul_berita']) ?>
                                </option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorKategori"></div>
                    </div>

                    <div class="form-group mb-2" id="modul">
                        <label> <i class="mdi mdi-clipboard-check-outline"></i> Pilih Modul CMS</label>
                        <select class="form-select pointer" name="modulcms" id="modulcms">
                            <option Disabled=true Selected=true>-- Pilih Modul CMS--</option>
                            <?php foreach ($modulpublic as $key => $data) { ?>
                                <option data-link="<?= esc($data['link']) ?>"><?= esc($data['modpublic']) ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorlink"></div>
                    </div>

                    <div class="form-group mb-2" id="eksternal">
                        <label> <i class="mdi mdi-text-shadow"></i>
                            Link URL <small class="text-danger">(Misalnya: http://cms.datagoe.com/)</small>
                        </label>
                        <input type="text" id="link" name="link" value="<?= esc($link) ?>" class="form-control">
                        <div class="invalid-feedback errorlink"></div>
                    </div>
                </div>
                <!-- end single -->

            </div>

            <div class="modal-footer">

                <button type="submit" class="btn btn-primary btnupload"><i class="mdi mdi-content-save-all"></i>
                    Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i>
                    Batal</button>
            </div>
        </div>
        <?php echo form_close() ?>

    </div>

</div>

</div>


<script>
    $(document).ready(function () {
        $('#dhalaman').select2({
            dropdownParent: $('#modaledit'),

        });
        $('#dtberita').select2({
            dropdownParent: $('#modaledit'),
        });

        $("#eksternal").hide();
        $("#berita").hide();
        $("#halaman").hide();
        $("#modul").hide();
        // $('[name=link]').val('#');
        // $('[name=linkexternal]').val('N');


        // Pilihan Sumber Link 
        $('#sumberlink').on('change', function () {
            const linkexternal = $('#sumberlink option:selected').data('linkexternal');
            $('[name=linkexternal]').val(linkexternal);
        });

        // Pilihan Modul CMS
        $('#modulcms').on('change', function () {

            const link = $('#modulcms option:selected').data('link');
            $('[name=link]').val(link);
        });
        // Pilihan Kategori Berita
        $('#dberita').on('change', function () {

            const link = $('#dberita option:selected').data('link');
            $('[name=link]').val(link);
        });

        // Pilihan Halaman
        $('#dhalaman').on('change', function () {

            const link = $('#dhalaman option:selected').data('link');
            $('[name=link]').val(link);
        });

        $('#sumberlink').on('change', function () {
            $('[name=dberita]').val('');
            $('[name=dhalaman]').val('');
            $('[name=modulcms]').val('');

            if ($('#sumberlink').val() == '1') {
                $("#eksternal").hide();
                $("#berita").show();
                $("#halaman").hide();
                $("#modul").hide();
                $('[name=link]').val('');
            } else if ($('#sumberlink').val() == '2') {
                $("#eksternal").hide();
                $("#berita").hide();
                $("#halaman").show();
                $("#modul").hide();
                $('[name=link]').val('');
            } else if ($('#sumberlink').val() == '3') {
                $("#eksternal").hide();
                $("#berita").hide();
                $("#halaman").hide();
                $("#modul").show();
                $('[name=link]').val('');
            } else {
                $("#eksternal").show();
                $("#berita").hide();
                $("#halaman").hide();
                $("#modul").hide();
                $('[name=link]').val('');
            }
        });


        $('.btnupload').click(function (e) {
            e.preventDefault();
            let form = $('.formfoto')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: '<?= site_url('iklan/updatebanner') ?>',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function () {
                    $('.btnupload').attr('disable', 'disable');
                    $('.btnupload').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function () {
                    $('.btnupload').removeAttr('disable', 'disable');
                    $('.btnupload').html('<i class="mdi mdi-content-save-all"></i> Simpan');
                },
                success: function (response) {

                    if (response.error) {

                        if (response.error.ket) {
                            $('#ket').addClass('is-invalid');
                            $('.errorket').html(response.error.ket);
                        } else {
                            $('#ket').removeClass('is-invalid');
                            $('.errorket').html('');
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
                        listiklan();
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