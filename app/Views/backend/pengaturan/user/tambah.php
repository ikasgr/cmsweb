<div class="modal fade" id="modaltambah">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open_multipart('', ['class' => 'formtambah']) ?>

            <div class="modal-body">

                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">

                        <label class="">Nama User</label>
                        <div class="">
                            <input type=" text" class="form-control" name="username" id="username"
                                placeholder="Username" autofocus>
                            <div class="invalid-feedback errorusername"></div>
                        </div>
                    </div>

                    <div class="form-group col-md-6 col-12 mb-2">
                        <label class="">Password</label>
                        <div class="">
                            <input type="password" class="form-control" name="password" id="password"
                                autocomplete="new-password" onkeyup="checkPasswordStrength(this.value)" value=""
                                placeholder="Password" required>
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

                    </div>

                    <div class="form-group col-md-6 col-12 mb-2">
                        <label class="">Email</label>
                        <div class="">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                required>
                            <div class="invalid-feedback erroremail"></div>
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label class="">Grup User</label>
                        <div class="">
                            <select name="id_grup" id="id_grup" class="form-select pointer">
                                <option Disabled=true Selected=true>-- Pilih Grup User --</option>
                                <?php foreach ($listgrup as $key => $data) { ?>
                                    <option value="<?= $data['id_grup'] ?>"><?= esc($data['nama_grup']) ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback errorid_grup"></div>
                        </div>
                    </div>
                    <div class="form-group col-12 mb-2">
                        <label class="">Nama Lengkap</label>
                        <div class="">
                            <input type=" text" class="form-control" name="fullname" id="fullname"
                                placeholder="Nama Lengkap" required>
                            <div class="invalid-feedback errorFullname"></div>
                        </div>
                    </div>
                    <div class="form-group col-12 mb-2">
                        <label class="">Foto Profil</label>
                        <div class="">
                            <div class="input-group">
                                <input type="file" class="form-control" name="foto" id="foto" accept="image/*" required>
                                <div class="invalid-feedback errorFoto"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($opd != '') { ?>
                    <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <a href="konfigurasi">Nonaktifkan</a> Unit Kerja jika tdk ingin menghubungkannya.
                    </div>
                    <div class="row">
                        <div class="form-group col-12 mb-2">
                            <!-- <div class="form-group row mb-2"> -->
                            <label class="">Unit Kerja</label>
                            <div class="">
                                <select name="opd_id" id="opd_id" class="form-control select2">
                                    <option Disabled=true Selected=true>-- Pilih Unit Kerja --</option>
                                    <?php foreach ($opd as $key => $data) { ?>
                                        <option value="<?= $data['opd_id'] ?>"><?= esc($data['nama_opd']) ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback erroropd_id">Silahkan pilih unit kerja</div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>

            <div class="modal-footer p-1">
                <button type="submit" class="btn btn-primary btnupload"><i class="mdi mdi-content-save-all"></i>
                    Simpan</button>
                <button type="button" class="btn btn-secondary pull-left" data-bs-dismiss="modal"> <i
                        class="mdi mdi-cancel"></i> Batal</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>


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

    $(document).ready(function () {

        $('#opd_id').select2({
            dropdownParent: $('#modaltambah')

        })
        $('.btnupload').click(function (e) {
            e.preventDefault();
            let form = $('.formtambah')[0];
            let data = new FormData(form);
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
                $.ajax({
                    type: "post",
                    url: '<?= site_url('user/simpanUser') ?>',
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
                        $('.btnupload').html('<i class="mdi mdi-content-save-all"></i>  Simpan');
                    },
                    success: function (response) {
                        if (response.error) {

                            if (response.error.username) {
                                $('#username').addClass('is-invalid');
                                $('.errorusername').html(response.error.username);
                            } else {
                                $('#username').removeClass('is-invalid');
                                $('.errorusername').html('');
                                $('#username').addClass('is-valid');
                            }

                            if (response.error.password) {
                                $('#password').addClass('is-invalid');
                                $('.errorpassword').html(response.error.password);
                            } else {
                                $('#password').removeClass('is-invalid');
                                $('.errorpassword').html('');
                                $('#password').addClass('is-valid');
                            }

                            if (response.error.fullname) {
                                $('#fullname').addClass('is-invalid');
                                $('.errorFullname').html(response.error.fullname);
                            } else {
                                $('#fullname').removeClass('is-invalid');
                                $('.errorFullname').html('');
                                $('#fullname').addClass('is-valid');
                            }
                            if (response.error.id_grup) {
                                $('#id_grup').addClass('is-invalid');
                                $('.errorid_grup').html(response.error.id_grup);
                            } else {
                                $('#id_grup').removeClass('is-invalid');
                                $('.errorid_grup').html('');
                                $('#id_grup').addClass('is-valid');
                            }

                            if (response.error.email) {
                                $('#email').addClass('is-invalid');
                                $('.erroremail').html(response.error.email);
                            } else {
                                $('#email').removeClass('is-invalid');
                                $('.erroremail').html('');
                                $('#email').addClass('is-valid');
                            }

                            if (response.error.foto) {
                                $('#foto').addClass('is-invalid');
                                $('.errorFoto').html(response.error.foto);
                            } else {
                                $('#foto').removeClass('is-invalid');
                                $('.errorFoto').html('');
                                $('#foto').addClass('is-valid');
                            }
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        } else if (response.gopdid) {
                            $('#opd_id').addClass('is-invalid');
                            $('.erroropd_id').html(response.gopdid.opd_id);

                            toastr["error"](response.gopdid)
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        } else {
                            toastr["success"](response.sukses)
                            $('#modaltambah').modal('hide');
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                            listuser();
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownerror) {
                        toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"),);
                        $('#modaltambah').modal('hide');
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    }
                });
        });
    });
</script>