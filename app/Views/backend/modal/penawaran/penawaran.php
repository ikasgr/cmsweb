<?= $this->section('content') ?>
<?= $this->extend('backend/' . 'script'); ?>

<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4 class="text-light"><i class="fas fa-edit"></i> <?= esc($subtitle) ?></h4>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="#">Kelola Konten</a></li>
                        <li class="breadcrumb-item active"> <?= esc($subtitle) ?></li>
                    </ol>
                    <!-- <a href="" class="btn btn-success">Add Widget</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">

                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"
                    id="csrf_tokencmsikasmedia" />
                <?= form_open_multipart('', ['class' => 'formedit']) ?>

                <div class='card-body'>
                    <input type="hidden" class="form-control" id="modalpopup_id" value="<?= $modalpopup_id ?>"
                        name="modalpopup_id" readonly>
                    <div class="form-group mb-2">
                        <label> <i class="mdi mdi-text-shadow"></i>
                            Judul Modal Popup
                        </label>
                        <input type="text" id="judultawaran" value="<?= esc($judultawaran) ?>" name="judultawaran"
                            class="form-control">
                        <div class="invalid-feedback errorjudultawaran"></div>
                    </div>


                    <div class="form-group">
                        <label> <i class="ion-ios7-settings-strong"></i>
                            Isi Modal Popup
                        </label>
                        <textarea type="text" class="form-control" id="isitawaran"
                            name="isitawaran"> <?= $isitawaran ?></textarea>
                        <div class="invalid-feedback errorisitawaran"></div>
                    </div>
                </div>

            </div><!-- Main Footer -->
        </div>
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <i class="mdi mdi-image-filter-hdr"></i> Gambar Modal Popup <br>
                    <small>*Klik foto untuk mengganti gambar.</small>
                    <hr>
                    <div class="form-group text-center">
                        <?php

                        if (file_exists('public/img/informasi/' . esc($gbrtawaran))) {
                            $gbr = base_url('public/img/informasi/' . esc($gbrtawaran));
                        } else {
                            $gbr = base_url('public/img/informasi/profil/default.png');
                        }
                        if ($akses == 1) {
                            ?>
                            <img class="img-thumbnail pointer" onclick="gantilogo('<?= $modalpopup_id ?>')"
                                src="<?= $gbr ?>" alt="Img Modal Popup">
                        <?php } else { ?>
                            <img class="img-thumbnail" src="<?= $gbr ?>" alt="Img Modal Popup">

                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label> <i class="mdi mdi-clipboard-check-outline"></i> Tampilkan Tombol </label>
                        <div class="form-control p-0">
                            &nbsp; <input type="radio" name="sts_tombol" id="sts_tombol1" value="1" <?= $sts_tombol == '1' ? 'checked' : '' ?>> <label for="sts_tombol1" class="pointer pt-2"> Ya &nbsp</label>
                            <input type="radio" name="sts_tombol" id="sts_tombol2" value="0" <?= $sts_tombol == '0' ? 'checked' : '' ?>> <label for="sts_tombol2" class="pointer pt-2"> Tidak &nbsp</label>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label> <i class="mdi mdi-text-shadow"></i>
                            Nama Tombol
                        </label>
                        <input type="text" id="namatombol" value="<?= esc($namatombol) ?>" name="namatombol"
                            class="form-control">
                        <div class="invalid-feedback errornamatombol"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label> <i class="mdi mdi-link-variant"></i>
                            Link Tombol
                        </label>
                        <input type="text" id="linktawaran" value="<?= esc($linktawaran) ?>" name="linktawaran"
                            class="form-control">
                        <div class="invalid-feedback errorlinktawaran"></div>
                        <small>*Untuk link tujuan dapat diambil pada link menu.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="modal-footer">
                    <div class="btn-group mr-2 float-right">
                        <?php if ($akses == 1) { ?>
                            <button type="button" class="btn btn-primary btnsimpan mr-1"><i
                                    class="mdi mdi-content-save-all"></i> Update Data</button>
                        <?php } ?>
                        <button type="button" class="btn btn-success" onclick="lihathasil('<?= $modalpopup_id ?>')"><i
                                class="mdi mdi-file-find"></i> Lihat Hasil</button>
                    </div>
                </div>

            </div>
        </div>

        <?= form_close() ?>
    </div>
</div>

<!-- <div class="viewmodal"></div>

<div class="modalview"></div> -->

<script>
    $(document).ready(function () {
        $('textarea#isitawaran').summernote({
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
        noteBar.find('[data-toggle]').each(function () {
            $(this).attr('data-bs-toggle', $(this).attr('data-toggle')).removeAttr('data-toggle');
        });

        $('.btnsimpan').click(function (e) {
            e.preventDefault();
            let form = $('.formedit')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: '<?= site_url('penawaran/submit') ?>',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,

                dataType: "json",
                beforeSend: function () {
                    $('.btnsimpan').attr('disable', 'disable');
                    $('.btnsimpan').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function () {
                    $('.btnsimpan').removeAttr('disable', 'disable');
                    $('.btnsimpan').html('<i class="mdi mdi-content-save-all"></i> Update Data');
                },

                success: function (response) {
                    if (response.error) {
                        // if (response.csrf_tokencmsikasmedia) {
                        //     //update hash untuk proses error validation 
                        //     $('#csrfToken, #csrfRandom').val(response.csrf_tokencmsikasmedia);
                        //     $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia); //dataSrc untuk random request token char (wajib)
                        // }


                        if (response.error.judultawaran) {
                            $('#judultawaran').addClass('is-invalid');
                            $('.errorjudultawaran').html(response.error.judultawaran);
                        } else {
                            $('#judultawaran').removeClass('is-invalid');
                            $('.errorjudultawaran').html('');
                        }

                        if (response.error.isitawaran) {
                            $('#isitawaran').addClass('is-invalid');
                            $('.errorisitawaran').html(response.error.isitawaran);
                        } else {
                            $('#isitawaran').removeClass('is-invalid');
                            $('.errorisitawaran').html('');
                        }

                        if (response.error.linktawaran) {
                            $('#linktawaran').addClass('is-invalid');
                            $('.errorlinktawaran').html(response.error.linktawaran);
                        } else {
                            $('#linktawaran').removeClass('is-invalid');
                            $('.errorlinktawaran').html('');
                        }

                        if (response.error.namatombol) {
                            $('#namatombol').addClass('is-invalid');
                            $('.errornamatombol').html(response.error.namatombol);
                        } else {
                            $('#namatombol').removeClass('is-invalid');
                            $('.errornamatombol').html('');
                        }
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia); //dataSrc untuk random request token char (wajib)

                    } else {

                        Swal.fire({
                            title: "Berhasil!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia); //dataSrc untuk random request token char (wajib)

                    }
                },
                error: function (xhr, ajaxOptions, thrownerror) {
                    Swal.fire({
                        title: "Maaf gagal update data!",
                        html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                        icon: "error",
                        // showConfirmButton: false,
                        // timer: 3100
                    }).then(function () {
                        window.location = '';
                    })

                }
            });
        })
    });

    function gantilogo(modalpopup_id) {

        $.ajax({
            type: "post",
            url: "<?= site_url('penawaran/formuploadtawaran') ?>",
            data: {
                // [csrfToken]: csrfHash,
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                modalpopup_id: modalpopup_id,
            },
            dataType: "json",
            success: function (response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalupload').modal('show');
                }
                $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                // $('.txt_csrfname').val(response.token);
            },
            error: function (xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal upload data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                }).then(function () {
                    window.location = '';
                })

            }
        });
    }
</script>

<script>
    function lihathasil() {
        $.ajax({
            url: "<?= site_url('penawaran/lihathasiladmin') ?>",
            dataType: "json",
            success: function (response) {
                $('.viewmodal').html(response.data).show();
                $('#modalview').modal({

                });
                // $('.modal-dialog').draggable({
                //     handle: ".modal-header"
                // });
                $('#modalview').modal('show');
            },
            error: function (xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                }).then(function () {
                    window.location = '';
                })
            }
        });
    }
</script>

<?= $this->endSection() ?>