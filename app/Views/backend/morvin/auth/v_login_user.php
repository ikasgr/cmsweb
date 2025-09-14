<!-- =======================================================
      * CMS ikasmedia
      * Content Management System.
      *
      * @author			Vian Taum <viantaum17@gmail.com>
      * @website		www.ikasmedia.net
      * @copyright		(c) 2023 - ikasmedia Software
 ======================================================== -->

<!DOCTYPE html>
<html lang="in">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>Login</title>
    <meta content="CMS ikasmedia" name="Vian Taum" />
    <link rel="shortcut icon" href="<?= base_url('/public/img/konfigurasi/icon/' . esc($konfigurasi->icon)) ?>">
    <?php if (esc($sitekey) != '') { ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php } ?>
    <link href="<?= base_url('/public/template/backend/' . esc($folder) . '/assets/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />

    <link href="<?= base_url('/public/template/backend/' . esc($folder) . '/assets/css/bootstrap.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('/public/template/backend/' . esc($folder) . '/assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('/public/template/backend/' . esc($folder) . '/assets/css/app.min.css?v1') ?>" id="app-style" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('/public/template/backend/' . esc($folder) . '/assets/css/page-auth.css') ?>" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg bg-infox">
    <style>
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }
    </style>

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
                                        <img src="<?= base_url('/public/img/konfigurasi/logo/' . $img) ?>" height="100%" alt="logo">
                                    </a>
                                </div>
                            </a>
                        </div>
                        <hr>
                        <!-- <p class="mb-4">Please sign-in to your account and start the adventure</p> -->
                        <?= form_open('login/validasi', ['class' => 'formlogin']) ?>
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsikasmedia" />

                        <form class="mb-1" autocomplete="off | unknown-autocomplete-value">
                            <div id="strlogin">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" value="<?= htmlentities(set_value('usernama'), ENT_QUOTES) ?>" placeholder="Enter username" autocomplete="off" autofocus required>
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label">Password</label>
                                        <a href="<?= base_url('lupapassword') ?>">
                                            <small>Forgot Password?</small>
                                        </a>
                                    </div>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control" id="password_hash" name="password_hash" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autocomplete="off" required>
                                        <a href="javascript:;" class="input-group-text bg-transparent"><i class="fas fa-eye-slash"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- OTP Section (Initially Hidden) -->
                            <div class="mb-3" id="otp-section" style="display: none;">
                                <label for="otp">Masukkan Kode OTP</label>
                                <input type="text" name="otp" id="otp" class="form-control" placeholder="Kode OTP">
                            </div>

                            <?php if (esc($sitekey) != '') { ?>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <div class="g-recaptcha" data-sitekey="<?= esc($sitekey) ?>"></div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100 btnlogin" type="submit">Sign in</button>
                            </div>
                        </form>
                        <?php echo form_close() ?>
                        <p class="text-center">
                            <?php if ($konfigurasi->sts_regis != 0) { ?>
                                <span>Belum Punya Akun?</span>
                                <a href="<?= base_url('registrasi') ?>">
                                    <span>Daftar disini</span>
                                </a>
                            <?php  } ?>
                        </p>
                    </div>
                </div>
                <div class="container border-top text-center pt-1">

                    © <script>
                        document.write(new Date().getFullYear())
                    </script> <?= esc($konfigurasi->nama) ?> <br> <small><i class="mdi mdi-console text-dark"></i> Versi <?= esc($konfigurasi->vercms) ?></small>

                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('/public/template/backend/' . esc($folder) . '/assets/libs/jquery/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('/public/template/backend/' . esc($folder) . '/assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('/public/template/backend/' . esc($folder) . '/assets/libs/node-waves/waves.min.js') ?>"></script>
    <script src="<?= base_url('/public/template/backend/' . esc($folder) . '/assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>

    <script>
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            var input = $('#show_hide_password input');
            var icon = $('#show_hide_password i');
            if (input.attr("type") == "text") {
                input.attr('type', 'password');
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else if (input.attr("type") == "password") {
                input.attr('type', 'text');
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        $(document).ready(function() {

            $('.formlogin').submit(function(e) {
                e.preventDefault();
                let otp = $('#otp').val(); // Ambil input OTP jika ada

                if ($('#otp-section').is(':visible') && otp === '') {
                    Swal.fire({
                        title: "OTP Wajib!",
                        text: "Silakan masukkan kode OTP yang telah dikirim ke email Anda.",
                        icon: "warning",
                    });
                    return false; // Hentikan proses jika OTP kosong
                }

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('.btnlogin').prop('disabled', true);
                        $('.btnlogin').html(`<i><span class="spinner-border text-light" style="width: 1rem; height: 1rem;" aria-hidden="true"></span> Loading...</i>`);
                    },
                    complete: function() {
                        $('.btnlogin').prop('disabled', false);
                        $('.btnlogin').html('Sign in');
                    },
                    success: function(response) {
                        if (response.error) {
                            if (response.error.username) {
                                Swal.fire({
                                    text: "User atau password salah!",
                                    icon: "error",
                                    width: "400px",
                                    showConfirmButton: false,
                                    timer: 3000
                                }).then(function() {
                                    // window.location = '<?= base_url('') ?>';
                                    window.location = '';
                                });
                            }

                            if (response.error.password_hash) {
                                Swal.fire({
                                    text: "User atau password salah!",
                                    icon: "error",
                                    width: "400px",
                                    showConfirmButton: false,
                                    timer: 3000
                                }).then(function() {
                                    // window.location = '<?= base_url('') ?>';
                                    window.location = '';
                                });
                            }
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        }
                        if (response.gagalcap) {
                            Swal.fire({
                                title: "Maaf...!",
                                text: response.gagalcap,
                                icon: "error",
                                // showConfirmButton: false,
                                timer: 3550
                            }).then(function() {
                                // window.location = '<?= base_url('') ?>';
                                window.location = '';
                            });
                        }
                        if (response.sumasuk) {
                            Swal.fire({
                                title: "Maaf...!",
                                text: response.sumasuk,
                                icon: "error",
                                // showConfirmButton: false,
                                timer: 3550
                            }).then(function() {
                                window.location = '<?= base_url('') ?>';
                                // window.location = '';
                            });
                        }
                        if (response.usahalebih) {
                            $('#overlay').show();
                            $('form :input').prop('disabled', true);
                            Swal.fire({
                                title: "Maaf...!",
                                text: response.usahalebih,
                                icon: "error",
                                showConfirmButton: false,
                                timer: 10550
                            }).then(function() {
                                window.location = '<?= base_url('') ?>';
                                // window.location = '';
                            });
                        }
                        if (response.nonactive) {
                            Swal.fire({
                                title: "Maaf Gagal Login..!",
                                text: "Anda tidak berhak mengakses Dashboard..!",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 3250
                            });
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        }

                        if (response.emailerr) {
                            Swal.fire({
                                title: "Maaf...!",
                                text: response.emailerr,
                                icon: "error",
                                // showConfirmButton: false,
                                timer: 3550
                            }).then(function() {
                                window.location = '';
                            });
                        }

                        if (response.otpsalah) {
                            Swal.fire({
                                title: "Maaf...!",
                                text: response.otpsalah,
                                icon: "error",
                                // showConfirmButton: false,
                                // timer: 3550
                            }).then(function() {
                                window.location = '';
                            });
                        }


                        if (response.otp_needed) {
                            Swal.fire({
                                title: "Perhatian!",
                                text: response.otp_needed,
                                icon: "info",
                                confirmButtonText: "Masukkan OTP",
                            }).then(function() {
                                // Menyembunyikan form login dan menampilkan form OTP
                                $('#strlogin').hide(); // Menyembunyikan form login
                                $('#otp-section').show(); // Menampilkan form OTP
                                $('#otp').focus(); // Fokus pada input OTP
                                $('.btnlogin').html('Verifikasi OTP');
                            });
                        }


                        if (response.sukses) {
                            window.location = '<?= base_url('dashboard') ?>';
                        }
                        // $('input[name="<?= csrf_token() ?>"]').val(response.csrf_tokencmsikasmedia);
                    },
                    error: function(xhr, ajaxOptions, thrownerror) {
                        Swal.fire({
                            title: "Maaf gagal Login!",
                            html: `Ada kesalahan pada server`,
                            icon: "error",
                            showConfirmButton: false,
                        });
                    }
                });
                // });
            });

        });
    </script>

</body>

</html>