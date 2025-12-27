<?= $this->extend('frontend/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>


<section class="container mt-lg-0 mt-0 pb-1">

    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue"></h4>
        </div>
    </div>

</section>

<section class="container pb-0">
    <div class="card p-3">
        <div class="row article-container pb-5">

            <div class="col-md-12 px-md-5">
                <div class="article-detail mb-0">
                    <h1 class="text-blue montserrat-700 f-30 text-center">BUKU TAMU</h1>
                    <hr>
                    <!-- Start content -->
                    <?= form_open('bukutamu/simpanbukutamu', ['class' => 'fbk']) ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"
                        id="csrf_tokencmsikasmedia" />
                    <div class="modal-body">
                        <div class="alert alert-info" style='background-color:#f4f4f4; border-color:#e3e3e3;'>Terima
                            Kasih, untuk kunjungan Anda.
                            Punya pertanyaan, masukan dan saran? Silahkan klik <b class="pointer"
                                onclick="window.location.href='<?= base_url('masukansaran') ?>'">disini</b>, untuk
                            Sampaikan.
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <tbody>

                                    <tr>
                                        <td>Nama</td>
                                        <td>
                                            <input type="text" id="nama" name="nama"
                                                value="<?= htmlentities(set_value('nama'), ENT_QUOTES) ?>"
                                                class="form-control" required>
                                            <div class="invalid-feedback errornama"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>No Hp</td>
                                        <td>
                                            <input type="text" id="telp" name="telp" class="form-control"
                                                value="<?= htmlentities(set_value('telp'), ENT_QUOTES) ?>" required>
                                            <div class="invalid-feedback errortelp"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Instansi</td>
                                        <td>
                                            <input type="text" id="instansi" name="instansi"
                                                value="<?= htmlentities(set_value('instansi'), ENT_QUOTES) ?>"
                                                class="form-control" required>
                                            <div class="invalid-feedback errorinstansi"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bidang</td>
                                        <td>

                                            <select class="form-control" name="bidang_id" id="bidang_id" required>
                                                <option value="" Disabled=true Selected=true>-- Pilih Bidang --</option>
                                                <?php foreach ($mbidang as $key => $data) { ?>
                                                    <option value="<?= $data['bidang_id'] ?>">
                                                        <?= esc($data['nama_bidang']) ?>
                                                    </option>
                                                <?php } ?>
                                            </select>

                                            <div class="invalid-feedback errorbidang_id"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keperluan</td>
                                        <td>
                                            <textarea type="text" id="keperluan" name="keperluan" class="form-control "
                                                required><?= htmlentities(set_value('keperluan'), ENT_QUOTES) ?></textarea>
                                            <div class="invalid-feedback errorkeperluan"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="modal-footer p-1">
                                <div class="g-recaptcha" data-sitekey="<?= $sitekey ?>"></div>
                                <button type="submit" class="btn btn-primary btnkirim"><i
                                        class="fas fa-paper-plane"></i> Kirim </button>
                            </div>

                        </div>

                    </div>

                    <?= form_close() ?>


                </div>
            </div>

        </div>
    </div>
</section>


<script>
    $(document).ready(function () {

        $('.fbk').submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function () {
                    $('.btnkirim').prop('disable', true);
                    $('.btnkirim').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> <i>Loading...')

                },
                complete: function () {
                    $('.btnkirim').prop('disable', false);
                    $('.btnkirim').html('Kirim Pesan')
                    $('.btnkirim').html('<i class="fas fa-paper-plane"></i>  Kirim Pesan');
                },
                success: function (response) {
                    if (response.error) {

                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errornama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errornama').html();
                            $('#nama').addClass('is-valid');
                        }

                        if (response.error.instansi) {
                            $('#instansi').addClass('is-invalid');
                            $('.errorinstansi').html(response.error.instansi);
                        } else {
                            $('#instansi').removeClass('is-invalid');
                            $('.errorinstansi').html();
                            $('#instansi').addClass('is-valid');
                        }

                        if (response.error.telp) {
                            $('#telp').addClass('is-invalid');
                            $('.errortelp').html(response.error.telp);
                        } else {
                            $('#telp').removeClass('is-invalid');
                            $('.errortelp').html();
                            $('#telp').addClass('is-valid');
                        }

                        if (response.error.bidang_id) {
                            $('#bidang_id').addClass('is-invalid');
                            $('.errorbidang_id').html(response.error.bidang_id);
                        } else {
                            $('#bidang_id').removeClass('is-invalid');
                            $('.errorbidang_id').html();
                            $('#bidang_id').addClass('is-valid');
                        }

                        if (response.error.keperluan) {
                            $('#keperluan').addClass('is-invalid');
                            $('.errorkeperluan').html(response.error.keperluan);
                        } else {
                            $('#keperluan').removeClass('is-invalid');
                            $('.errorkeperluan').html();
                            $('#keperluan').addClass('is-valid');
                        }
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    }

                    if (response.sukses) {
                        Swal.fire({
                            title: "Terima Kasih!",
                            text: response.sukses,
                            icon: "success",
                            // showConfirmButton: false,
                            // timer: 4550
                        }).then(function () {
                            window.location = '<?= base_url('') ?>';
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownerror) {
                    Swal.fire({
                        title: "Maaf gagal mengirim data!",
                        html: `Silahkan coba kembali`,
                        icon: "error",
                        // showConfirmButton: false,
                        // timer: 3100
                    }).then(function () {
                        window.location = '';
                    })
                }
            });
            return false;
        });
    });
</script>



<?= $this->endSection() ?>