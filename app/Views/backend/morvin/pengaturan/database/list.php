<?php if ($dbnewonline != 'errkoneksi') { ?>
    <input type="hidden" class="form-control" id="id_setaplikasi" value="<?= $id_setaplikasi ?>" name="id_setaplikasi" readonly>
    <input type="hidden" id="verdb" value="<?= $verdb ?>">
    <input type="hidden" id="versinew" value="<?= $dbnewonline ?>">
    <input type="hidden" id="cmsnew_on" value="<?= $cmsnew_on ?>">

    <?php if ($verdb != $dbnewonline) { ?>

        <!-- <div class="container mt-4"> -->
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-start shadow-sm" role="alert">
            <i class="fa fa-exclamation-circle text-warning display-6 me-3"></i>
            <div>
                <strong class="fs-5 text-dark">Peringatan Penting!</strong>
                <p class="mb-2 text-dark">Sebelum memulai proses pembaruan, pastikan Anda telah melakukan <strong>backup data</strong> untuk menghindari kehilangan informasi.</p>
                <ul class="list-unstyled mb-2">
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-primary"></i>
                        <span class="text-dark"> Buat cadangan (backup) file CMS lama sebelum memulai proses pembaruan.</span>
                    </li>
                    <li>
                        <i class="fas fa-database text-success"></i>
                        <span class="text-dark"> Simpan konfigurasi database (nama database, username, dan password) di file <code>app\Config\Database.php</code>.</span>
                    </li>
                </ul>
                <small class="text-muted">
                    Pembaruan hanya dapat dilanjutkan setelah proses migrasi selesai dan database diperbarui ke versi <strong><?= $dbnewonline ?></strong>.
                </small>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <input type="hidden" id="urlupdatedb" value="<?= $cmsurldb_on ?>">
        <input type="hidden" id="urlupdate" value="<?= $cmsurlfile_on ?>">

        <!-- Peringatan Kesalahan -->
        <div class="alert alert-danger text-center mt-3 shadow-sm">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Segala risiko akibat kelalaian dalam proses ini menjadi tanggung jawab pengguna sepenuhnya.</strong>
        </div>

        <!-- Proses Upgrade -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body text-center">

                <div class="progress mb-3 d-none" id="progress-container">
                    <div id="progress-bar1" class="progress-bar bg-info" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <button type="button" id="runQueries" class="btn btn-lg btn-primary" style="width: 300px;">
                    <i class="fas fa-sync-alt"></i> Proses Pembaruan Sistem
                </button>
            </div>
        </div>
    <?php } ?>
    <?php if ($verdb === $dbnewonline) { ?>

        <div class="alert alert-info text-center" style="background-color: #f8f9fa; border-color: #e3e3e3; border-radius: 8px; padding: 20px;">
            <img src="<?= base_url('public/template/backend/morvin/assets/images/coming-soon.png') ?>"
                alt="Success" width="300" style="max-height: 100%; margin-bottom: 15px;">

            <div class="alert alert-primary alert-dismissible fade show mb-0" role="alert" style="border-radius: 6px;">
                <strong>Selamat!</strong> Anda sudah menggunakan <b>CMS DATAGOE</b> versi terbaru.
                <small>
                    <span class="d-block mt-1">Belum menjadi <b>member Pro</b>? <a href="https://datagoe.com/paketmember" class="alert-link">Aktifkan sekarang</a> sebagai bentuk dukungan untuk pengembangan CMS ini.</span>
                </small>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>

    <?php } ?>

<?php } else { ?>
    <center>
        <img class="" src="<?= base_url('public/template/backend/morvin/assets/images/err.png') ?>" alt="not found" width="200" height="100%">

        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
            Maaf, tidak dapat terhubung ke Server <a href="https://datagoe.com" class="alert-link">DATAGOE</a>.
        </div>
    </center>
<?php } ?>

<script>
    //*-----------------new konsep

    $('#runQueries').on('click', function() {
        const urlupdatedb = $('#urlupdatedb').val();

        if (!urlupdatedb) {
            Swal.fire({
                title: 'Error!',
                text: 'Please enter URL update.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return;
        }

        Swal.fire({
            // title: 'Konfirmasi',
            text: 'Apakah Anda yakin melanjutkan proses pembaruan?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lanjutkan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#status-message').html('Processing...');
                $('#progress-container').removeClass('d-none');
                $('#progress-bar1').css('width', '0%').attr('aria-valuenow', 0); // Reset progress bar
                $('#spinner').show(); // Tampilkan spinner

                $.ajax({
                    url: '<?= base_url('fileupdate/Startupdatedb') ?>',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        urlupdatedb: urlupdatedb
                    },
                    beforeSend: function() {
                        $('#runQueries').attr('disabled', true);
                    },
                    success: function(response) {
                        // $('#spinner').hide();
                        if (response.status === 'success') {
                            $('#spinner-text').text(response.message || 'Tahap (1) sukses!');
                            $('#progress-bar1').css('width', '50%').attr('aria-valuenow', 50);
                            setTimeout(() => {
                                $('#spinner').hide();
                                runDatabaseUpdate();
                            }, 2000);
                            //  Swal.fire({
                            //    title: 'Info!',
                            //     text: response.message,
                            //     icon: 'info',
                            //      confirmButtonText: 'Next'
                            //   }).then(() => {});

                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message || 'Unknown error occurred.',
                                icon: 'error',
                                confirmButtonText: 'Try Again'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#spinner').hide();
                        Swal.fire({
                            title: 'Error!',
                            text: `Request failed: ${xhr.status} - ${xhr.statusText}`,
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    }
                });
            }
        });
    });


    // **Step 2: Jalankan Query Database**
    function runDatabaseUpdate() {
        const verdb = $('#verdb').val();
        const id_setaplikasi = $('#id_setaplikasi').val();
        const versinew = $('#versinew').val();
        const cmsnew_on = $('#cmsnew_on').val();

        $('#spinner').show(); // ✅ Tampilkan spinner

        $.ajax({
            url: 'update-db',
            type: 'POST',
            dataType: 'json',
            data: {
                verdb,
                id_setaplikasi,
                versinew,
                cmsnew_on
            },
            success: function(runResponse) {

                if (runResponse.sukses) {
                    $('#progress-bar1').css('width', '75%').attr('aria-valuenow', 75); // 75 progress
                    $('#spinner-text').text(runResponse.sukses || 'Tahap (2) sukses!');
                    setTimeout(() => {
                        $('#spinner').hide();
                        startUpdateCMS();
                    }, 2000);
                    // Swal.fire({
                    //     title: runResponse.sukses,
                    //     icon: "info",
                    //     showConfirmButton: false,
                    //     timer: 1300
                    // }).then(() => {
                    //     if (runResponse.nextStep) {
                    //     }
                    // });

                } else if (runResponse.info) {
                    Swal.fire({
                        title: runResponse.info,
                        icon: "info",
                        showConfirmButton: false,
                        timer: 1300
                    });
                } else if (runResponse.error) {
                    Swal.fire({
                        title: 'Error!',
                        text: runResponse.error,
                        icon: "error",
                        showConfirmButton: true
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#spinner').hide();
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menghubungi server.',
                    icon: "error"
                });
            }
        });
    }

    // **Step 3: Jalankan Update File CMS**
    function startUpdateCMS() {
        var urlupdate = $('#urlupdate').val();

        if (!urlupdate) {
            Swal.fire({
                title: 'Error!',
                text: 'Please enter URL update.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return;
        }

        $('#status-message').html('Updating Files...');
        $('#progress-container').removeClass('d-none');
        $('#progress-bar1').css('width', '75%').attr('aria-valuenow', 75); // ✅ Pastikan mulai dari 75%
        $('#spinner').show();

        $.ajax({
            url: '<?= base_url('fileupdate/startUpdate') ?>',
            method: 'POST',
            dataType: 'json',
            data: {
                jnsup: 2,
                urlupdate: urlupdate
            },
            beforeSend: function() {
                $('#runQueries').attr('disabled', true);
            },
            success: function(response) {
                $('#spinner').hide();
                $('#runQueries').attr('disabled', false);

                if (response.status === 'success') {
                    $('#progress-bar1').css('width', '100%').attr('aria-valuenow', 100); // ✅ Full progress setelah sukses

                    Swal.fire({
                        title: 'Update Completed!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // setTimeout(() => {
                        // }, 2000);
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Unknown error occurred.',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                }
            },
            error: function(xhr, status, error) {
                $('#spinner').hide();
                $('#runQueries').attr('disabled', false);
                $('#progress-container').addClass('d-none');

                Swal.fire({
                    title: 'Error!',
                    text: `Request failed: ${xhr.status} - ${xhr.statusText}`,
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            }
        });
    }

    //*-----------------
</script>