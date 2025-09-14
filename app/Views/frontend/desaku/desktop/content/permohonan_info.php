<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>


<section class="container mt-lg-0 mt-0 pb-1">

    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue"></h4>
        </div>
    </div>

</section>

<section class="container pt-3 pb-0">
    <div class="card p-3">
        <div class="row article-container pb-5">

            <div class="col-md-12 px-md-5">
                <div class="article-detail mb-0">
                    <h1 class="text-blue montserrat-700 f-30 text-center">FORM PERMOHONAN INFORMASI </h1>
                    <hr>
                    <!-- isi -->
                    <div class="blog-comments mt-1">

                        <div class="alert" style='background-color:#f4f4f4; border-color:#e3e3e3;'>
                            <!-- <img style='float:left; padding: 8px; margin-top:-13px; margin-right:5px;' width="80" class="pull-left" src="<?= base_url('public/template/backend/standar/assets/images/icon_rules.png') ?>"> -->
                            Demi meningkatkan pelayanan bagi publik / masyarakat pada <?= $konfigurasi->nama ?>, maka kami membuka permohonan informasi online yang dapat diakses melalui website. Untuk melakukan permohonan informasi, mohon untuk mengisi formulir yang sudah disediakan. Setelah melakukan pengisian dengan sebenar-benarnya, dimohon untuk mengirimkan formulir tersebut, beserta dengan scan bukti diri, tanpa tanda bukti diri permohonan anda kami anggap tidak sah.
                        </div>
                        <?= form_open_multipart('', ['class' => 'formmohoninfo']) ?>

                        <!-- <div class="alert alert-light"> -->
                        <div class="row">
                            <div class="form-group col-md-4 col-12">
                                <label for="">Nama <a class="text-danger">*</a> </label>
                                <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" placeholder="Nama*">
                                <div class="invalid-feedback errornama_pemohon"></div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="">E-mail <a class="text-danger">*</a> </label>
                                <input type="email" class="form-control" id="email_pemohon" name="email_pemohon" placeholder="Email*">
                                <div class="invalid-feedback erroremail_pemohon"></div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="">Nomor HP (WA) <a class="text-danger">*</a> </label>
                                <input type="text" class="form-control" id="hp_pemohon" name="hp_pemohon" maxlength="20" placeholder="Nomor Handphone (WA)*">
                                <div class="invalid-feedback errorhp_pemohon"></div>
                            </div>
                            <div class="form-group col-12">
                                <label for="">Alamat <a class="text-danger">*</a> </label>
                                <textarea type="text" id="alamat_pemohon" name="alamat_pemohon" class="form-control" placeholder="Alamat*"></textarea>
                                <div class="invalid-feedback erroralamat_pemohon"></div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="">Pekerjaan <a class="text-danger">*</a> </label>
                                <select class="form-control" name="pek_pemohon" id="pek_pemohon">
                                    <?php foreach ($pekerjaan as $key => $data) { ?>
                                        <option value="<?= $data['id_masterdata'] ?>"><?= esc($data['nama_master']) ?></option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="">Unggah KTP <a class="text-danger">*</a> </label>
                                <input type="file" class="form-control" id="foto_ktp" name="foto_ktp">
                                <div class="invalid-feedback errorfoto_ktp"></div>
                                <div class="progress">
                                    <div id="file-progress-bar" class="progress-bar"></div>
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <textarea type="text" id="info_ygdibutuhkan" name="info_ygdibutuhkan" class="form-control" placeholder="Informasi yang dibutuhkan*"></textarea>
                                <div class="invalid-feedback errorinfo_ygdibutuhkan"></div>
                            </div>
                            <div class="form-group col-12">
                                <textarea type="text" id="tujuan_info" name="tujuan_info" class="form-control" placeholder="Tujuan Penggunaan Informasi*"></textarea>
                                <div class="invalid-feedback errortujuan_info"></div>
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="">Cara Memperoleh Informasi <a class="text-danger">*</a> </label>
                                <select class="form-control" name="cara_perolehinfo" id="cara_perolehinfo">
                                    <?php foreach ($caraperolehinfo as $key => $data) { ?>
                                        <option value="<?= $data['id_masterdata'] ?>"><?= esc($data['nama_master']) ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="">Cara Mendapatkan Informasi <a class="text-danger">*</a> </label>
                                <select class="form-control" name="cara_dapatkaninfo" id="cara_dapatkaninfo">
                                    <?php foreach ($caradapatinfo as $key => $data) { ?>
                                        <option value="<?= $data['id_masterdata'] ?>"><?= esc($data['nama_master']) ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="form-group col-4">
                                <div class="g-recaptcha" data-sitekey="<?= $sitekey ?>"></div>

                            </div>
                            <div class="form-group col-8">
                                <br>
                                <button type="button" class="btn btn-primary btnkirim"><i class="fas fa-paper-plane"></i> Kirim Permohonan</button>
                            </div>
                        </div>
                        <?= form_close() ?>

                    </div><!-- End  -->
                </div>
            </div>

        </div>
    </div>
</section>


<script>
    $(document).ready(function() {
        $(".progress").hide();

        $('.formmohoninfoxxx').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnkirim').prop('disable', true);
                    $('.btnkirim').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> <i>Loading...')

                },
                complete: function() {
                    $('.btnkirim').prop('disable', false);
                    $('.btnkirim').html('Kirim Permohonan')
                    $('.btnkirim').html('<i class="fas fa-paper-plane"></i>  Kirim Permohonan');
                },
                success: function(response) {
                    if (response.error) {

                        if (response.error.nama_pemohon) {
                            $('#nama_pemohon').addClass('is-invalid');
                            $('.errornama_pemohon').html(response.error.nama_pemohon);
                        } else {
                            $('#nama_pemohon').removeClass('is-invalid');
                            $('.errornama_pemohon').html();
                            $('#nama_pemohon').addClass('is-valid');
                        }

                        if (response.error.email_pemohon) {
                            $('#email_pemohon').addClass('is-invalid');
                            $('.erroremail_pemohon').html(response.error.email_pemohon);
                        } else {
                            $('#email_pemohon').removeClass('is-invalid');
                            $('.erroremail_pemohon').html();
                            $('#email_pemohon').addClass('is-valid');
                        }

                        if (response.error.hp_pemohon) {
                            $('#hp_pemohon').addClass('is-invalid');
                            $('.errorhp_pemohon').html(response.error.hp_pemohon);
                        } else {
                            $('#hp_pemohon').removeClass('is-invalid');
                            $('.errorhp_pemohon').html();
                            $('#hp_pemohon').addClass('is-valid');
                        }

                        if (response.error.alamat_pemohon) {
                            $('#alamat_pemohon').addClass('is-invalid');
                            $('.erroralamat_pemohon').html(response.error.alamat_pemohon);
                        } else {
                            $('#alamat_pemohon').removeClass('is-invalid');
                            $('.erroralamat_pemohon').html();
                            $('#alamat_pemohon').addClass('is-valid');
                        }

                        if (response.error.foto_ktp) {
                            $('#foto_ktp').addClass('is-invalid');
                            $('.errorfoto_ktp').html(response.error.foto_ktp);
                        } else {
                            $('#foto_ktp').removeClass('is-invalid');
                            $('.errorfoto_ktp').html();
                            $('#foto_ktp').addClass('is-valid');
                        }

                        if (response.error.info_ygdibutuhkan) {
                            $('#info_ygdibutuhkan').addClass('is-invalid');
                            $('.errorinfo_ygdibutuhkan').html(response.error.info_ygdibutuhkan);
                        } else {
                            $('#info_ygdibutuhkan').removeClass('is-invalid');
                            $('.errorinfo_ygdibutuhkan').html();
                            $('#info_ygdibutuhkan').addClass('is-valid');
                        }

                        if (response.error.tujuan_info) {
                            $('#tujuan_info').addClass('is-invalid');
                            $('.errortujuan_info').html(response.error.tujuan_info);
                        } else {
                            $('#tujuan_info').removeClass('is-invalid');
                            $('.errortujuan_info').html();
                            $('#tujuan_info').addClass('is-valid');
                        }

                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    }

                    if (response.sukses) {
                        Swal.fire({
                            title: "Terima Kasih!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 4550
                        }).then(function() {
                            window.location = '<?= base_url('') ?>';
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownerror) {
                    Swal.fire({
                        title: "Maaf gagal mengirim data!",
                        html: `Silahkan coba kembali Error Code: <strong>${(xhr.status + "\n")}</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function() {
                        window.location = '';
                    })
                }
            });
            return false;
        });

        $('.btnkirim').click(function(e) {
            e.preventDefault();
            let form = $('.formmohoninfo')[0];
            let data = new FormData(form);

            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(element) {
                        if (element.lengthComputable) {
                            $(".progress").show();
                            var percentComplete = ((element.loaded / element.total) * 100);
                            $("#file-progress-bar").width(percentComplete + '%');
                            // $("#file-progress-bar").html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                type: "post",
                url: '<?= site_url('kirimpermohonan') ?>',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",

                beforeSend: function() {
                    $('.btnkirim').attr('disable', 'disable');
                    $('.btnkirim').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                    $("#file-progress-bar").width('0%');
                },
                complete: function() {
                    $('.btnkirim').removeAttr('disable', 'disable');
                    $('.btnkirim').html('<i class="fas fa-paper-plane"></i>  Kirim Permohoman');
                },
                success: function(response) {
                    if (response.error) {

                        if (response.error.nama_pemohon) {
                            $('#nama_pemohon').addClass('is-invalid');
                            $('.errornama_pemohon').html(response.error.nama_pemohon);
                        } else {
                            $('#nama_pemohon').removeClass('is-invalid');
                            $('.errornama_pemohon').html();
                            $('#nama_pemohon').addClass('is-valid');
                        }

                        if (response.error.email_pemohon) {
                            $('#email_pemohon').addClass('is-invalid');
                            $('.erroremail_pemohon').html(response.error.email_pemohon);
                        } else {
                            $('#email_pemohon').removeClass('is-invalid');
                            $('.erroremail_pemohon').html();
                            $('#email_pemohon').addClass('is-valid');
                        }

                        if (response.error.hp_pemohon) {
                            $('#hp_pemohon').addClass('is-invalid');
                            $('.errorhp_pemohon').html(response.error.hp_pemohon);
                        } else {
                            $('#hp_pemohon').removeClass('is-invalid');
                            $('.errorhp_pemohon').html();
                            $('#hp_pemohon').addClass('is-valid');
                        }

                        if (response.error.alamat_pemohon) {
                            $('#alamat_pemohon').addClass('is-invalid');
                            $('.erroralamat_pemohon').html(response.error.alamat_pemohon);
                        } else {
                            $('#alamat_pemohon').removeClass('is-invalid');
                            $('.erroralamat_pemohon').html();
                            $('#alamat_pemohon').addClass('is-valid');
                        }

                        if (response.error.foto_ktp) {
                            $('#foto_ktp').addClass('is-invalid');
                            $('.errorfoto_ktp').html(response.error.foto_ktp);
                        } else {
                            $('#foto_ktp').removeClass('is-invalid');
                            $('.errorfoto_ktp').html();
                            $('#foto_ktp').addClass('is-valid');
                        }

                        if (response.error.info_ygdibutuhkan) {
                            $('#info_ygdibutuhkan').addClass('is-invalid');
                            $('.errorinfo_ygdibutuhkan').html(response.error.info_ygdibutuhkan);
                        } else {
                            $('#info_ygdibutuhkan').removeClass('is-invalid');
                            $('.errorinfo_ygdibutuhkan').html();
                            $('#info_ygdibutuhkan').addClass('is-valid');
                        }

                        if (response.error.tujuan_info) {
                            $('#tujuan_info').addClass('is-invalid');
                            $('.errortujuan_info').html(response.error.tujuan_info);
                        } else {
                            $('#tujuan_info').removeClass('is-invalid');
                            $('.errortujuan_info').html();
                            $('#tujuan_info').addClass('is-valid');
                        }

                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        $(".progress").hide();
                    } else {

                        // toastr["success"](response.sukses)
                        // if (response.sukses) {
                        Swal.fire({
                            title: "Terima Kasih!",
                            text: response.sukses,
                            icon: "success",
                            // showConfirmButton: false,
                            // timer: 4550
                        }).then(function() {
                            window.location = '<?= base_url('') ?>';
                        });
                        // }

                        $(".progress").hide();
                    }
                },

                error: function(xhr, ajaxOptions, thrownerror) {
                    // toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), );
                    // $('#modaltambah').modal('hide');
                    Swal.fire({
                        title: "Maaf gagal mengirim data!",
                        html: `Silahkan coba kembali Error Code: <strong>${(xhr.status + "\n")}</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function() {
                        window.location = '';
                    })
                }
            });
        });




    });
</script>


<?= $this->endSection() ?>