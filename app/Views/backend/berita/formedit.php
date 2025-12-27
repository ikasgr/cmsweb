<?= $this->section('content') ?>
<?= $this->extend('backend/' . 'script'); ?>
<link
    href="<?= base_url('/public/template/backend/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>"
    rel="stylesheet">
<script
    src="<?= base_url('/public/template/backend/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('/public/template/backend/assets/libs/bootstrap-datepicker/js/date-picker.js') ?>"></script>

<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4 class="text-light">Edit Berita</h4>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('berita/all') ?>">Blog</a></li>
                        <li class="breadcrumb-item active"> <?= esc($subtitle) ?></li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper">

    <div class="card mb-2 p-2">

        <?= form_open_multipart('', ['class' => 'formedit']) ?>

        <div class='card-body'>

            <div class="row">

                <div class="col-lg-9">
                    <div class=" mb-0">
                        <input type="hidden" value="<?= $berita_id ?>" name="berita_id">

                        <div class="row">
                            <div class="form-group col-md-10 col-12 mb-3">
                                <label>
                                    Judul Berita
                                </label>
                                <input type="text" class="form-control" id="judul_berita" name="judul_berita"
                                    value="<?= esc($judul_berita) ?>">

                                <div class="invalid-feedback errorJudul">
                                </div>
                            </div>

                            <div class="form-group col-md-2 col-12 mb-3">
                                <label> </i>
                                    Berita Utama
                                </label>
                                <!-- <div class="form-control">
                                        <input type="radio" id="headline1" name="headline" value="0" <?= $headline == '0' ? 'checked' : '' ?>> <label for="headline1" class="pointer">Tidak &nbsp</label>
                                        <input type="radio" id="headline2" name="headline" value="1" <?= $headline == '1' ? 'checked' : '' ?>> <label for="headline2" class="pointer"> Ya &nbsp</label>
                                    </div> -->
                                <select class="form-select pointer" name="headline" id="headline">
                                    <option Disabled=true Selected=true>-- Pilih --</option>

                                    <option value="0" <?= $headline == 0 ? 'selected' : '' ?>>Tidak</option>
                                    <option value="1" <?= $headline == 1 ? 'selected' : '' ?>>Ya</option>

                                </select>
                            </div>

                        </div>

                        <div class="form-group p-0 ">
                            <!-- <label>Isi Berita</label> -->
                            <textarea type="text" id="isi" name="isi"> <?= esc($isi) ?></textarea>
                            <div class="invalid-feedback errorIsi"></div>
                        </div>

                        <!-- <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Keterangan Foto</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ket_foto" name="ket_foto" value="<?= $ket_foto ?>">
                                </div>
                            </div> -->
                    </div><!-- Main Footer -->
                </div>
                <div class="col-lg-3">

                    <div class="mb-0">
                        <div class="row">
                            <div class="form-group col-md-6 col-12 mb-2">
                                <label>Berita Pilihan</label>
                                <select class="form-select pointer" name="pilihan" id="pilihan">
                                    <option value="0" <?= $pilihan == 0 ? 'selected' : '' ?>>Tidak</option>
                                    <option value="1" <?= $pilihan == 1 ? 'selected' : '' ?>>Ya</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-12 mb-2 ">

                                <label> Tanggal Post </label>

                                <input type="text" id="tgl_berita" name="tgl_berita"
                                    value="<?= shortdate_indo($tgl_berita) ?>" class="form-control date-picker pointer">

                                <div class="invalid-feedback errortgl_berita"></div>

                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Ringkasan Berita</label>
                            <textarea type="text" rows="12" class="form-control " id="ringkasan"
                                name="ringkasan"> <?= esc($ringkasan) ?></textarea>
                            <div class="invalid-feedback errorringkasan"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Kategori Berita</label>
                            <select class="form-control" name="kategori_id" id="kategori_id">
                                <option Disabled=true Selected=true>-- Pilih Kategori --</option>
                                <?php foreach ($kategori as $key => $value) { ?>
                                    <option value="<?= $value['kategori_id'] ?>" <?= $kategori_id == $value['kategori_id'] ? 'selected' : '' ?>><?= esc($value['nama_kategori']) ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback errorKategori"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Tag Berita</label>

                            <select name="tag_id[]" id="tag_id" class="form-control" multiple="multiple">

                                <?php foreach ($tag as $key => $value) { ?>
                                    <option value="<?= $value['tag_id'] ?>" <?php foreach ($tag_id as $key => $val) { ?>
                                            <?= $val['tag_id'] == $value['tag_id'] ? 'selected' : '';
                                      } ?>>
                                        <?= esc($value['nama_tag']) ?>
                                    </option>
                                <?php } ?>

                            </select>
                            <div class="invalid-feedback errorTag"></div>
                        </div>

                        <!-- <div class="row"> -->


                        <div class="form-group mb-2">
                            <label>Komentar Berita</label>
                            <select class="form-select pointer" name="sts_komen" id="sts_komen">
                                <option value="0" <?= $sts_komen == 0 ? 'selected' : '' ?>>Tidak</option>
                                <option value="1" <?= $sts_komen == 1 ? 'selected' : '' ?>>Ya</option>
                            </select>
                        </div>
                        <?php if ($akses == '1') { ?>
                            <div class="form-group ">
                                <label> </i>
                                    Penulis
                                </label>
                                <select name="id" id="id" class="form-control ">
                                    <option Disabled=true Selected=true>-- Pilih Penulis--</option>
                                    <?php foreach ($user as $key => $data) { ?>

                                        <option value="<?= $data['id'] ?>" <?= $id == $data['id'] ? 'selected' : '' ?>>
                                            <?= esc($data['fullname']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>
                        <!-- </div> -->
                        <br>

                        <div class="modal-footer p-0">
                            <button type="submit" class="btn btn-primary btnupdate"><i
                                    class="mdi mdi-content-save-all"></i> Simpan</button>
                            <a href="<?= base_url('berita/all/') ?>" class="btn btn-warning"><i
                                    class="far fa-arrow-alt-circle-left font-14"></i> Kembali</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?= form_close() ?>
    </div>

</div>

<script>
    $(document).ready(function () {
        $('#id').select2({})
        $('#kategori_id').select2({})
        $('#tag_id').select2({
            placeholder: 'Silahkan Pilih tag'
        })
        //  height: 540,
        $('textarea#isi').summernote({
            height: 540,
            minHeight: null,
            maxHeight: null,
            tabsize: 2,
            followingToolbar: true,
            airMode: false,
            fontSizes: ['11', '12', '13', '14', '15', '16', '17', '18', '20', '24', '36', '40', '48'],

            toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['height', ['height']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['color', ['color']],
                ['insert', ['picture', 'link', 'video', 'table', 'codeview']],
                ['view', ['fullscreen']],
            ],

            callbacks: {
                onImageUpload: function (files) {
                    processImage(files[0], function (finalFile) {
                        let reader = new FileReader();
                        reader.onloadend = function () {
                            let imgNode = $('<img>').attr('src', reader.result);
                            $('textarea#isi').summernote('insertNode', imgNode[0]);
                        };
                        reader.readAsDataURL(finalFile);
                    });
                }
            }
        });


        function processImage(file, callback) {
            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (event) {
                let img = new Image();
                img.src = event.target.result;
                img.onload = function () {
                    let canvas = document.createElement("canvas");
                    let ctx = canvas.getContext("2d");

                    let maxWidth = 800; // Maksimum lebar
                    let maxHeight = 600; // Maksimum tinggi
                    let width = img.width;
                    let height = img.height;

                    if (width > maxWidth || height > maxHeight) {
                        let scale = Math.min(maxWidth / width, maxHeight / height);
                        width *= scale;
                        height *= scale;
                    }

                    canvas.width = width;
                    canvas.height = height;
                    ctx.drawImage(img, 0, 0, width, height);

                    ctx.font = "15px Arial";
                    ctx.fillStyle = "rgba(255, 255, 255, 0.6)"; // Warna putih transparan
                    // ctx.fillText("© <?= esc($namasingkat) ?>", width - 150, height - 20); // Posisi kanan
                    ctx.fillText("© <?= esc($namasingkat) ?>", 20, height - 20);

                    canvas.toBlob(function (blob) {
                        callback(new File([blob], file.name, {
                            type: "image/jpeg",
                            lastModified: Date.now()
                        }));
                    }, "image/jpeg", 0.7); // Kompres dengan kualitas 0.7
                };
            };
        }

        var noteBar = $('.note-toolbar');
        noteBar.find('[data-toggle]').each(function () {
            $(this).attr('data-bs-toggle', $(this).attr('data-toggle')).removeAttr('data-toggle');
        });


        $('.btnupdate').click(function (e) {
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



                e.preventDefault();
            let form = $('.formedit')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: '<?= site_url('berita/updateberita') ?>',
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

                        if (response.error.judul_berita) {
                            $('#judul_berita').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul_berita);
                        } else {
                            $('#judul_berita').removeClass('is-invalid');
                            $('.errorJudul').html('');
                        }

                        if (response.error.kategori_id) {
                            $('#kategori_id').addClass('is-invalid');
                            $('.errorKategori').html(response.error.kategori_id);
                        } else {
                            $('#kategori_id').removeClass('is-invalid');
                            $('.errorKategori').html('');
                        }

                        if (response.error.tag_id) {
                            $('#tag_id').addClass('is-invalid');
                            $('.errorTag').html(response.error.tag_id);
                        } else {
                            $('#tag_id').removeClass('is-invalid');
                            $('.errorTag').html('');
                        }

                        if (response.error.isi) {
                            $('#isi').addClass('is-invalid');
                            $('.errorIsi').html(response.error.isi);
                        } else {
                            $('#isi').removeClass('is-invalid');
                            $('.errorIsi').html('');
                        }

                        if (response.error.tgl_berita) {
                            $('#tgl_berita').addClass('is-invalid');
                            $('.errortgl_berita').html(response.error.tgl_berita);
                        } else {
                            $('#tgl_berita').removeClass('is-invalid');
                            $('.errortgl_berita').html('');
                        }
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    } else {


                        Swal.fire({
                            title: "Sukses!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1550
                        }).then(function () {
                            window.location = '../berita/all';
                        });


                        // toastr["success"](response.sukses)


                    }
                },
                error: function (xhr, ajaxOptions, thrownerror) {
                    toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"),);
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    // $('#modaledit').modal('hide');
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>