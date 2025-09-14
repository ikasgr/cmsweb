<?= $this->section('content') ?>
<?= $this->extend('backend/' . esc($folder) . '/' . 'script') ?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box ">
            <div class="state-information d-none d-sm-block">
            </div>
        </div>
    </div>
</div>
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <?php if (esc($user_image) != 'default.png' && file_exists('public/img/user/' . esc($user_image))) {
                        $profil = esc($user_image);
                    } else {
                        $profil = 'default.png';
                    } ?>
                    <i class="mdi mdi-image-filter-hdr"></i> Foto Profil
                    <small>*Klik di foto untuk ganti gambar.</small>
                    <hr>
                    <div class="form-group text-center mb-1">
                        <img class="img-thumbnail logoweb pointer" onclick="gantilogo('<?= $id ?>')" src="<?= base_url('public/img/user/'  . $profil) ?>" alt="Foto Profil" width="210px">
                    </div>
                    <?php if ($role) {
                        foreach ($role as $row) :
                        endforeach;
                    } ?>
                    <center>
                        <button type="button" class="btn btn-danger btn-block waves-effect waves-light">
                            Wewenang : <b><?= esc($row['nama_grup']) ?></b>
                        </button>
                    </center>
                    <!-- <div class="alert alert-secondary text-center p-2" role="alert">
                        <button type="button" class="btn btn-light btn-sm p-1" title="Lihat Statistik Postingan" onclick="lihat('<?= $id ?>')">
                            <i class="nav-icon fa fa-search text-info"></i>
                        </button>
                    </div> -->

                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card m-b-20">

                <div class="card-header font-16 bg-light">

                    <?= form_open_multipart('', ['class' => 'formprofil']) ?>

                    <h6 class="modal-title mt-0">
                        <i class="fas fa-edit"></i> Update Profile
                    </h6>
                </div>

                <div class='card-body'>

                    <input type="hidden" value="<?= $id ?>" name="id">
                    <input type="hidden" value="<?= esc($username) ?>" name="userold">
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">User Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="username" value="<?= esc($username) ?>">
                            <div class="invalid-feedback errorusername"></div>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">Password </small></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password" autocomplete="new-password" title="Kosongkan jika tidak diganti" onkeyup="if (this.value !== '') checkPasswordStrength(this.value)" placeholder="Kosongkan jika tidak diganti">
                            <div class="invalid-feedback errorpassword"></div>
                            <div id="progress-container" style="width: 100%; background: #e0e0e0; height: 12px; border-radius: 3px; display: none; position: relative;">
                                <div id="progress-bar" style="height: 100%; width: 0%; background: red; border-radius: 3px; position: relative;"></div>
                                <div id="progress-text" style="position: absolute; top: -2px; left: 0; width: 100%; text-align: center; font-size: 9px; color: black;"></div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">Email Aktif</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="email" value="<?= esc($email) ?>">
                            <div class="invalid-feedback erroremail"></div>
                            <small class="text-danger"><i>*Pastikan E-mail Anda Aktif.</i></small>
                        </div>
                    </div>


                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type=" text" class="form-control" name="fullname" id="fullname" value="<?= esc($fullname) ?>" required>
                            <div class="invalid-feedback errorfullname"></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer p-1">
                    <button type="button" onclick="lihat('<?= $id ?>')" class="btn btn-info"><i class="fa fa-search"></i> Lihat Statistik Postingan</button>
                    <button type="button" class="btn btn-primary btnupload"><i class="mdi mdi-content-save-all"></i> Update Data</button>
                </div>

                <?= form_close() ?>

            </div>
        </div>
    </div>
</div>

<div class="viewmodal">
</div>

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

    function checkPasswordStrengthX(password) {
        let progressContainer = document.getElementById('progress-container');
        let progressBar = document.getElementById('progress-bar');

        // Tampilkan progress bar saat input password dimulai
        if (password.length > 0) {
            progressContainer.style.display = 'block';
        } else {
            progressContainer.style.display = 'none';
            progressBar.style.width = '0%'; // Reset progress bar
            progressBar.textContent = ''; // Reset text
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
        let progressText = '';

        switch (passed) {
            case 0:
            case 1:
                progressColor = 'red';
                progressText = 'Sangat Lemah';
                break;
            case 2:
                progressColor = 'orange';
                progressText = 'Lemah';
                break;
            case 3:
                progressColor = 'yellow';
                progressText = 'Sedang';
                break;
            case 4:
                progressColor = 'green';
                progressText = 'Kuat';
                break;
        }

        // Update progress bar styles
        progressBar.style.width = progressWidth;
        progressBar.style.backgroundColor = progressColor;
        progressBar.style.color = 'white'; // Ensure text is white
        progressBar.textContent = progressText;
    }


    function checkPasswordStrengthx(password) {
        let strength = document.getElementById('strength');
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

        let strengthText = '';
        switch (passed) {
            case 0:
            case 1:
                strengthText = 'Sangat Lemah';
                strength.style.color = 'red';
                break;
            case 2:
                strengthText = 'Lemah';
                strength.style.color = 'orange';
                break;
            case 3:
                strengthText = 'Sedang';
                strength.style.color = 'yellow';
                break;
            case 4:
                strengthText = 'Kuat';
                strength.style.color = 'green';
                break;
        }

        strength.textContent = strengthText;
    }

    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img_load').attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#user_image').change(function() {
        bacaGambar(this);
    });

    $(document).ready(function() {
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
            $('.btnupload').click(function(e) {
                e.preventDefault();
                let form = $('.formprofil')[0];
                let data = new FormData(form);
                $.ajax({
                    type: "post",
                    url: '<?= site_url('akun/updateuser') ?>',
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
                        $('.btnupload').html('<i class="mdi mdi-content-save-all"></i> Simpan');
                    },
                    success: function(response) {

                        if (response.error) {

                            if (response.error.username) {
                                $('#username').addClass('is-invalid');
                                $('.errorusername').html(response.error.username);
                            } else {
                                $('#username').removeClass('is-invalid');
                                $('.errorusername').html('');
                                $('#username').addClass('is-valid');
                            }

                            if (response.error.fullname) {
                                $('#fullname').addClass('is-invalid');
                                $('.errorfullname').html(response.error.fullname);
                            } else {
                                $('#fullname').removeClass('is-invalid');
                                $('.errorfullname').html('');
                                $('#fullname').addClass('is-valid');
                            }

                            if (response.error.email) {
                                $('#email').addClass('is-invalid');
                                $('.erroremail').html(response.error.email);
                            } else {
                                $('#email').removeClass('is-invalid');
                                $('.erroremail').html('');
                                $('#email').addClass('is-valid');
                            }

                            // if (response.error.password) {
                            //     $('#password').addClass('is-invalid');
                            //     $('.errorpassword').html(response.error.password);
                            // } else {
                            //     $('#password').removeClass('is-invalid');
                            //     $('.errorpassword').html('');
                            //     $('#password').addClass('is-valid');
                            // }


                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);

                        }
                        if (response.namaganda) {
                            $('#username').addClass('is-invalid');
                            $('.errorusername').html(response.namaganda.username);
                            toastr["error"](response.namaganda)
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        }
                        if (response.errorpass) {
                            $('#password').addClass('is-invalid');
                            $('.errorpassword').html(response.errorpass.password);
                            toastr["error"](response.errorpass)
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);

                        }
                        if (response.sukses) {

                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                            toastr["success"](response.sukses)
                        }

                    },
                    error: function(xhr, ajaxOptions, thrownerror) {
                        toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"), );
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    }
                });
            });
    });

    function gantilogo(id) {

        $.ajax({
            type: "post",
            url: "<?= site_url('akun/formgantifoto') ?>",
            data: {
                id: id,
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalupload').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    // showConfirmButton: false,
                    // timer: 3100
                }).then(function() {
                    window.location = '';
                })
            }
        });
    }

    function lihat(id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('user/formlihat') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id: id,
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modallihat').modal('show');
                    $('#modallihat').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
            },
            error: function(xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    // showConfirmButton: false,
                    // timer: 3100
                }).then(function() {
                    window.location = '';
                })
            }
        });
    }
</script>

<?= $this->endSection() ?>