<?php

$db = \Config\Database::connect();
$builder = $db->table('tbl_setaplikasi');
$konfigurasi = $builder->select('nama,vercms,kecamatan,icon,logo')->get()->getRow();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>Lupa Password</title>
    <meta content="CMS IKASMEDIA" name="IKASMEDIA SOFTWARE" />

    <link rel="shortcut icon" href="<?= base_url('/public/img/konfigurasi/icon/' . esc($konfigurasi->icon)) ?>">
    <link href="<?= base_url('/public/template/backend/assets/libs/sweetalert2/sweetalert2.min.css') ?>"
        rel="stylesheet" type="text/css" />

    <link href="<?= base_url('/public/template/backend/assets/css/bootstrap.min.css') ?>" id="bootstrap-style"
        rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('/public/template/backend/assets/css/icons.min.css') ?>" rel="stylesheet"
        type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('/public/template/backend/assets/css/app.min.css?v2') ?>" id="app-style" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url('/public/template/backend/assets/css/page-auth.css') ?>" id="app-style" rel="stylesheet"
        type="text/css" />

</head>

<body class="authentication-bg bg-infox">

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card shadow-lg">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brandx justify-content-center ">
                            <a href="<?= base_url('') ?>" class="x">

                                <?php if (file_exists('public/img/konfigurasi/logo/' . esc($konfigurasi->logo))) {
                                    $img = esc($konfigurasi->logo);
                                } else {
                                    $img = 'default.png';
                                }
                                ?>

                                <div class="text-center pb-0">
                                    <a href="<?= base_url() ?>">
                                        <img src="<?= base_url('/public/img/konfigurasi/logo/' . $img) ?>" height="100%"
                                            alt="logo">
                                    </a>
                                </div>
                            </a>
                        </div>
                        <hr>
                        <p class="mb-3 font-size-14 text-center">Masukkan email untuk menerima instruksi selanjutnya!
                        </p>
                        <!-- <p class="mb-4">Please sign-in to your account and start the adventure</p> -->
                        <?= form_open('login/proseslupa', ['class' => 'formlogin']) ?>
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"
                            id="csrf_tokencmsikasmedia" />

                        <form class="mb-1" autocomplete="off | unknown-autocomplete-value">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    value="<?= htmlentities(set_value('email'), ENT_QUOTES) ?>"
                                    placeholder="Enter your email" autofocus>
                                <div class="invalid-feedback erroremail"></div>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100 btnlogin" type="submit">Kirim
                                    Permintaan</button>
                            </div>
                        </form>
                        <?php echo form_close() ?>
                        <div class="text-center">
                            <a href="<?= base_url(esc($konfigurasi->kecamatan)) ?>"
                                class="d-flex align-items-center justify-content-center">
                                <i class="mdi mdi-chevron-left btn-sm font-size-16"></i>
                                Back to login
                            </a>
                        </div>

                    </div>
                </div>
                <div class="container border-top text-center pt-1">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> <?= esc($konfigurasi->nama) ?> <br> <small><i class="mdi mdi-console text-dark"></i>
                        Versi <?= esc($konfigurasi->vercms) ?></small>

                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('/public/template/backend/assets/libs/jquery/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('/public/template/backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('/public/template/backend/assets/libs/node-waves/waves.min.js') ?>"></script>
    <script src="<?= base_url('/public/template/backend/assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>
    <script src="<?= base_url('/public/template/backend/assets/js/app.js') ?>"></script>

</body>

</html>

<script>
    $(document).ready(function () {
        $('.formlogin').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function () {
                    $('.btnlogin').prop('disable', true);
                    $('.btnlogin').html(`<i><span class="spinner-border text-light" style="width: 1rem; height: 1rem;" aria-hidden="true"></span> Loading...</i>`);

                },
                complete: function () {
                    $('.btnlogin').prop('disable', false);
                    // $('.btnlogin').html('Set New Password')
                    $('.btnlogin').html('Kirim Permintaan');
                },
                success: function (response) {
                    if (response.error) {
                        if (response.error.email) {
                            $('#email').addClass('is-invalid');
                            $('.erroremail').html(response.error.email);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('.erroremail').html();
                        }
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    }

                    if (response.sukses) {

                        Swal.fire({
                            title: "Sukses kirim link aktivasi",
                            text: "Buka email anda dan silahkan Ikuti petunjuk ",
                            icon: "success",


                        }).then(function () {
                            window.location = '<?= base_url('login') ?>';
                        })
                    }

                    if (response.wrongemail) {
                        Swal.fire({
                            title: "Oooopss!",
                            text: "Email tidak ditemukan",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1250
                        });
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    }
                    if (response.resetexpair) {
                        Swal.fire({
                            title: "Sorry there was a problem!",
                            text: "Tidak dapat kirim email!",
                            icon: "error",
                            // showConfirmButton: false,
                            // timer: 1250
                        });
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    }

                },
                error: function (xhr, ajaxOptions, thrownerror) {
                    Swal.fire({
                        title: "Maaf gagal proses data!",
                        html: `Ada kesalahan..! `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    });
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
            });
            return false;
        });
    });
</script>