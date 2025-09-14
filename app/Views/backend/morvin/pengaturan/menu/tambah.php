<div class="modal fade" id="modaltambah" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <?= form_open('menu/simpanmenu', ['class' => 'formtambah']) ?>

            <div class="modal-body">

                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label>Nama Menu</label>
                        <input type="text" id="nama_menu" name="nama_menu" class="form-control ">
                        <div class="invalid-feedback errornama_menu"></div>
                    </div>

                    <div class="form-group col-md-6 col-12 mb-2">
                        <label>Jenis Menu</label>
                        <select class="form-select pointer" name="parent" id="parent">
                            <option value="Y" data-menu_link="#">Menu Induk</option>
                            <option value="N">Single Menu</option>

                        </select>
                    </div>
                </div>

                <!-- Single menu start -->
                <div id="single">
                    <div class="form-group mb-2">
                        <label>Sumber Link</label>
                        <select class="form-select pointer" name="sumberlink" id="sumberlink">
                            <!-- <option value="1" selected='selected'>--Pilih Sumber--</option> -->
                            <option Disabled=true Selected=true>-- Pilih Sumber Link--</option>
                            <option value="1" data-linkexternal="N">Kategori Berita</option>
                            <option value="2" data-linkexternal="N">Halaman</option>
                            <option value="3" data-linkexternal="N">Modul CMS</option>
                            <option value="4" data-linkexternal="Y">Eksternal</option>
                        </select>
                        <div class="invalid-feedback errormenu_link"></div>
                    </div>

                    <div class="form-group mb-2" id="berita">
                        <label>Pilih Kategori Berita</label>
                        <select name="dberita" id="dberita" class="form-select pointer ">
                            <option Disabled=true Selected=true>--Pilih Kategori Berita--</option>
                            <?php foreach ($kategoriberita as $key => $data) { ?>
                                <option data-menu_link="category/<?= esc($data['slug_kategori']) ?>"><?= esc($data['nama_kategori']) ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorKategori"></div>
                    </div>

                    <div class="form-group mb-2" id="halaman">
                        <label>Pilih Halaman</label>
                        <select name="dhalaman" id="dhalaman" class="form-select ">
                            <option Disabled=true Selected=true>--Pilih Halaman--</option>
                            <?php foreach ($halaman as $key => $data) { ?>
                                <option data-menu_link="page/<?= esc($data['slug_berita']) ?>"><?= esc($data['judul_berita']) ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorKategori"></div>
                    </div>

                    <div class="form-group mb-2" id="modul">
                        <label>Pilih Modul CMS</label>
                        <select class="form-select pointer " name="modulcms" id="modulcms">
                            <option Disabled=true Selected=true>-- Pilih Modul CMS--</option>
                            <?php foreach ($modulpublic as $key => $data) { ?>
                                <option data-menu_link="<?= esc($data['link']) ?>"><?= esc($data['modpublic']) ?></option>
                            <?php } ?>

                        </select>
                        <div class="invalid-feedback errormenu_link"></div>
                    </div>

                    <div class="form-group mb-2" id="eksternal">
                        <label>
                            Link URL <small class="text-danger">(Misalnya: http://cms.ikasmedia.net/)</small>
                        </label>
                        <input type="text" id="menu_link" name="menu_link" class="form-control ">
                        <div class="invalid-feedback errorgm"></div>
                    </div>
                </div>
                <!-- end single -->

                <input type="hidden" id="linkexternal" name="linkexternal" class="form-control ">

                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label>Urutan Menu</label>
                        <input type="number" class="form-control " id="urutan" name="urutan">
                        <div class="invalid-feedback errorurutan"></div>
                    </div>
                    <!-- <div class="form-group col-md-6 col-12">
                        <label>Target</label>
                        <div class="form-control ">
                            <input type="radio" id="target1" name="target" value="_parent" checked><label for="target1" class="pointer">&nbsp_parent &nbsp</label>
                            <input type="radio" id="target2" name="target" value="_blank"><label for="target2" class="pointer">&nbsp_blank &nbsp</label>

                        </div>
                    </div> -->
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label> Target </label> <br>
                        <div class="form-control p-0">
                            &nbsp; <input type="radio" id="target1" name="target" value="0" checked> <label for="target1" class="pointer pt-2">_parent &nbsp</label>
                            <input type="radio" id="target2" name="target" value="1"> <label for="target2" class="pointer pt-2"> _blank &nbsp</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label>Icon</label>
                        <input type="text" class="form-control " id="icon" name="icon">
                    </div>

                    <div class="form-group col-md-6 col-12 mb-2 ">
                        <label>Lihat Icon</label>
                        <div class="btn-group mr-2">
                            <button type="button" onclick="openMyModal2()" class=" btn btn-outline-secondary waves-effect waves-light mr-1" data-bs-toggle="modal" data-bs-target=".fontawesome"> Awesome</button>
                            <button type="button" onclick="openMyModal2()" class=" btn btn-outline-secondary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".mdideril">Material Design</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary btnsimpan"><i class="mdi mdi-content-save-all"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i> Batal</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    function openMyModal2() {
        let myModal = new
        bootstrap.Modal(document.getElementById('modaltambah'), {});
        myModal.show();
    }
    $(document).ready(function() {
        // sembunyikan();
        $("#single").hide();
        $("#eksternal").hide();
        $("#berita").hide();
        $("#halaman").hide();
        $("#modul").hide();
        $('[name=menu_link]').val('#');
        $('[name=linkexternal]').val('N');

        $('#parent').on('change', function() {
            // ambil data dari elemen option yang dipilih
            const menu_link = $('#parent option:selected').data('menu_link');
            // tampilkan data ke element
            $('[name=menu_link]').val(menu_link);

            if ($('#parent').val() == 'Y') {
                $("#single").hide();
                $('[name=menu_link]').val('#');
                $('[name=linkexternal]').val('N');
            } else {
                $("#single").show();
                $('[name=menu_link]').val('');
                $('[name=sumberlink]').val('');
            }
        });

        // Pilihan Sumber Link 
        $('#sumberlink').on('change', function() {
            const linkexternal = $('#sumberlink option:selected').data('linkexternal');
            $('[name=linkexternal]').val(linkexternal);
        });

        // Pilihan Modul CMS
        $('#modulcms').on('change', function() {

            const menu_link = $('#modulcms option:selected').data('menu_link');
            $('[name=menu_link]').val(menu_link);
        });
        // Pilihan Kategori Berita
        $('#dberita').on('change', function() {

            const menu_link = $('#dberita option:selected').data('menu_link');
            $('[name=menu_link]').val(menu_link);
        });

        // Pilihan Halaman
        $('#dhalaman').on('change', function() {

            const menu_link = $('#dhalaman option:selected').data('menu_link');
            $('[name=menu_link]').val(menu_link);
        });

        $('#sumberlink').on('change', function() {
            $('[name=dberita]').val('');
            $('[name=dhalaman]').val('');
            $('[name=modulcms]').val('');

            if ($('#sumberlink').val() == '1') {
                $("#eksternal").hide();
                $("#berita").show();
                $("#halaman").hide();
                $("#modul").hide();
                $('[name=menu_link]').val('');
            } else if ($('#sumberlink').val() == '2') {
                $("#eksternal").hide();
                $("#berita").hide();
                $("#halaman").show();
                $("#modul").hide();
                $('[name=menu_link]').val('');
            } else if ($('#sumberlink').val() == '3') {
                $("#eksternal").hide();
                $("#berita").hide();
                $("#halaman").hide();
                $("#modul").show();
                $('[name=menu_link]').val('');
            } else {
                $("#eksternal").show();
                $("#berita").hide();
                $("#halaman").hide();
                $("#modul").hide();
                $('[name=menu_link]').val('');
            }
        });

    });
</script>

<script>
    $(document).ready(function() {

        $('.btnsimpan').click(function(e) {
            e.preventDefault();
            let form = $('.formtambah')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: '<?= site_url('menu/simpanmenu') ?>',
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

                        if (response.error.nama_menu) {
                            $('#nama_menu').addClass('is-invalid');
                            $('.errornama_menu').html(response.error.nama_menu);
                        } else {
                            $('#nama_menu').removeClass('is-invalid');
                            $('.errornama_menu').html('');
                        }

                        if (response.error.menu_link) {
                            $('#menu_link').addClass('is-invalid');
                            $('.errormenu_link').html(response.error.menu_link);
                        } else {
                            $('#menu_link').removeClass('is-invalid');
                            $('.errormenu_link').html('');
                        }

                        if (response.error.urutan) {
                            $('#urutan').addClass('is-invalid');
                            $('.errorurutan').html(response.error.urutan);
                        } else {
                            $('#urutan').removeClass('is-invalid');
                            $('.errorurutan').html('');
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
                        $('#modaltambah').modal('hide');
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        listmenu();
                    }
                },
                error: function(xhr, ajaxOptions, thrownerror) {
                    toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), );
                    $('#modaltambah').modal('hide');
                }
            });
        });
    });
</script>