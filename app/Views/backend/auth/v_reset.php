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

    <title>Reset Password</title>
    <meta content="CMS DATAGOE" name="Datagoe Software" />
    <meta content="Themesbrand" name="Vian Taum" />
    <link rel="shortcut icon" href="<?= base_url('/public/img/konfigurasi/icon/' . esc($konfigurasi->icon)) ?>">
    <link href="<?= base_url('/public/template/backend/assets/libs/sweetalert2/sweetalert2.min.css') ?>"
        rel="stylesheet" type="text/css" />
    <link href="<?= base_url('/public/template/backend/assets/css/bootstrap.min.css') ?>" id="bootstrap-style"
        rel="stylesheet" type="text/css" />
    <link href="<?= base_url('/public/template/backend/assets/css/icons.min.css') ?>" rel="stylesheet"
        type="text/css" />
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
                        <!-- <p class="mb-3 font-size-14">Masukkan email untuk menerima instruksi selanjutnya!</p> -->
                        <?= form_open('login/prosesgantipass', ['class' => 'formlogin']) ?>

                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"
                            id="csrf_tokencmsikasmedia" />

                        <form class="mb-1" autocomplete="off | unknown-autocomplete-value">

                            <div class="form-group mb-3">
                                <label for="password">Masukan Password Baru</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    onkeyup="checkPasswordStrength(this.value)"
                                    value="<?= htmlentities(set_value('password'), ENT_QUOTES) ?>"
                                    placeholder="Enter password">
                                <div class="invalid-feedback errorpassword"></div>
                                <div id="progress-container"
                                    style="width: 100%; background: #e0e0e0; height: 12px; border-radius: 3px; display: none; position: relative;">
                                    <div id="progress-bar"
                                        style="height: 100%; width: 0%; background: red; border-radius: 3px; position: relative;">
                                    </div>
                                    <div id="progress-text"
                                        style="position: absolute; top: -2px; left: 0; width: 100%; text-align: center; font-size: 9px; color: black;">
                                    </div>
                                </div>
                                <!-- <span id="strength"></span> -->
                            </div>

                            <div class="form-group mb-3">
                                <label for="password_confirm">Ulangi Kembali</label>
                                <input type="password" class="form-control" name="password_confirm"
                                    id="password_confirm"
                                    value="<?= htmlentities(set_value('password_confirm'), ENT_QUOTES) ?>"
                                    placeholder="Enter password">

                                <div class="invalid-feedback errorpassword_confirm"></div>
                            </div>
                            <input type="hidden" name="token" value="<?= $token ?>" />

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100 btnlogin" type="submit">Set New
                                    Password</button>
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
    function checkPasswordStrength(password) {
        let progressContainer = document.getElementById('progress-container');
        let progressBar = document.getElementById('progress-bar');
        let progressText = document.getElementById('progress-text');

        // Tampilkan progress bar saat input password dimulai
        if (password.length > 0) {
            progressContainer.style.display = 'block';
        } else {
            progressContainer.style.display = 'none';
            progressBar.style.width = '0%'; // Reset progress bar
            progressText.textContent = ''; // Reset text
            return;
        }

        let regex = [
            "[A-Z]", // Uppercase
            "[a-z]", // Lowercase
            "[0-9]", // Numbers
            "[!@#$%^&*]" // Special characters
        ];

        let passed = 0;
        for (let i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(password)) {
                passed++;
            }
        }

        // Adjust progress bar width, color, and text based on strength
        let progressWidth = `${(passed / regex.length) * 100}%`;
        let progressColor = '';
        let progressTextContent = '';
        let textColor = 'white'; // Default color

        switch (passed) {
            case 0:
            case 1:
                progressColor = 'red';
                progressTextContent = 'Sangat Lemah';
                textColor = 'black'; // Text is black for "Sangat Lemah"
                break;
            case 2:
                progressColor = 'orange';
                progressTextContent = 'Lemah';
                textColor = 'black';
                break;
            case 3:
                progressColor = 'yellow';
                progressTextContent = 'Sedang';
                textColor = 'black';
                break;
            case 4:
                progressColor = 'green';
                progressTextContent = 'Sangat Kuat';
                break;
        }

        // Update progress bar and text
        progressBar.style.width = progressWidth;
        progressBar.style.backgroundColor = progressColor;
        progressText.style.color = textColor; // Update text color
        progressText.textContent = progressTextContent; // Set the text outside progress bar
    }

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
                $('.btnlogin').html('Set New Password')
                // $('.btnlogin').html('<i class="mdi mdi-content-save-settings"></i>  Set New Password');
            },
            success: function (response) {
                if (response.error) {

                    if (response.error.password) {
                        $('#password').addClass('is-invalid');
                        $('.errorpassword').html(response.error.password);
                    } else {
                        $('#password').removeClass('is-invalid');
                        $('.errorpassword').html();
                    }

                    if (response.error.password_confirm) {
                        $('#password_confirm').addClass('is-invalid');
                        $('.errorpassword_confirm').html(response.error.password_confirm);
                    } else {
                        $('#password_confirm').removeClass('is-invalid');
                        $('.errorpassword_confirm').html();
                    }
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }

                if (response.sukses) {
                    Swal.fire({
                        title: "Sukses Ganti Password",
                        text: "Password Anda telah berhasil diubah silahkan Login",
                        icon: "success",

                    }).then(function () {
                        window.location = '<?= base_url('login') ?>';
                    })
                }

            },
            error: function (xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal proses data!",
                    html: `Ada kesalahan silahkan coba lagi `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                });
                $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
            }
        });
        return false;
    });
</script>