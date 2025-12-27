<?= $this->extend('frontend/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>


<section class="container mt-lg-0 mt-0 pb-1">
    <!-- <div class="d-none d-md-none d-lg-block" style="padding: 32px"></div>
    <div class="d-block d-md-none" style="padding: 28px"></div> -->
    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue"></h4>
        </div>
    </div>

</section>

<section class="container pt-3 pb-0">

    <div class="row article-container pb-5">

        <div class="col-md-12 px-md-5">
            <div class="article-detail mb-0">
                <h1 class="text-blue montserrat-700 f-30 text-center">Masukan Saran </h1>

                <!-- isi -->
                <div class="blog-comments mt-1">
                    <!-- Single Comment -->
                    <?php if ($suaraanda) { ?>

                        <div id="comment-1" class="comment">

                            <div class="item mb-1">
                                <?php $nomor = 0;
                                foreach ($suaraanda as $data) {
                                    $nomor++;
                                    ?>
                                    <div class="alert" style='background-color:#f8f9f4; border-color:#e3e3e3;'>
                                        <div class="comment-img">
                                            <img class="img-circle comment-img float-left"
                                                src="<?= base_url('public/template/backend/img/usr2.png') ?>" width="60"
                                                alt="Nama">
                                        </div>
                                        <div>
                                            <div class="author"><?= esc($data['nama']) ?></div>

                                            <div class="date text-danger"><?= esc($data['judul']) ?> -
                                                <?= date_indo($data['tanggal']) ?></div>
                                            <p><?= esc($data['isi_kritik']) ?></p>
                                        </div>
                                        <div class="comment-img">
                                            <img class="comment-img float-left"
                                                src="<?= base_url('public/template/backend/img/adm.png') ?>" width="90"
                                                alt="Admin">
                                        </div>
                                        <!-- <div> -->
                                        <div class="author text-primary">Admin</div>
                                        <div class="date text-warning">Ditanggapi - <?= date_indo($data['tgl_bls']) ?></div>
                                        <p><i><?= ($data['balas']) ?></i> </p>
                                    </div>

                                <?php } ?>
                                <?php if ($jum > 4) { ?>
                                    <P>
                                    <ul class="pagination justify-content-center">
                                        <?= $pager->links('hal', 'datagoe'); ?>
                                    </ul>
                                    </P>
                                <?php } ?>
                            </div>

                        </div>


                    <?php } else { ?>
                        <div class="alert alert-danger text-center" style='background-color:#FAEBD7; border-color:#e3e3e3;'>
                            <a style='color:light'>Belum Ada data masukan saran.!</a><br> Punya pertanyaan, keluhan, masukan
                            atau saran, silahkan <b>isi form dibawah</b>, untuk sampaikan.
                        </div>
                    <?php } ?>

                    <!-- <div class="reply-form"> -->

                    <h4 class="widget-title">Berikan Masukan / Saran</h4>

                    <div class="alert" style='background-color:#f4f4f4; border-color:#e3e3e3;'>
                        <img style='float:left; padding: 8px; margin-top:-13px; margin-right:5px;' width="80"
                            class="pull-left" src="<?= base_url('public/template/backend/img/icon_rules.png') ?>">
                        Seluruh pesan yang masuk akan kami moderasi terlebih dahulu sebelum ditampilkan.
                        Pesan yang mengandung unsur <a target='_BLANK' style='color:red'>sara, hoax, pornografi, spam,
                            ujaran kebencian,
                            atau link tidak bermanfaat</a> akan kami hapus.
                    </div>
                    <?= form_open('kritiksaran/simpankritik', ['class' => 'formkritik']) ?>
                    <?= csrf_field() ?>
                    <!-- <div class="alert alert-light"> -->
                    <div class="row">
                        <div class="form-group col-md-3 col-12">
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="<?= htmlentities(set_value('nama'), ENT_QUOTES) ?>" placeholder="Nama Lengkap*"
                                required>
                            <div class="invalid-feedback errornama"></div>
                        </div>
                        <div class="form-group col-md-3 col-12">
                            <input type="text" class="form-control" id="no_hpusr" name="no_hpusr" maxlength="20"
                                value="<?= htmlentities(set_value('no_hpusr'), ENT_QUOTES) ?>"
                                placeholder="Nomor Handphone (WA)*" required>
                            <div class="invalid-feedback errorno_hpusr"></div>
                        </div>

                        <div class="form-group col-md-3 col-12">
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= htmlentities(set_value('email'), ENT_QUOTES) ?>" placeholder="Alamat Email*"
                                required>
                            <div class="invalid-feedback erroremail"></div>
                        </div>
                        <div class="form-group col-md-3 col-12">
                            <select class="form-control" name="judul" id="judul">
                                <option Disabled=true Selected=true>-- Pilih Topik --</option>
                                <option value="Pengaduan">Pengaduan</option>
                                <option value="Aspirasi">Aspirasi</option>
                                <option value="Permintaan Informasi">Permintaan Informasi</option>
                            </select>

                            <div class="invalid-feedback errorjudul"></div>
                        </div>
                    </div>
                    <p>
                    <div class="text-left ">

                        <textarea type="text" id="isi_kritik" name="isi_kritik" class="form-control"
                            placeholder="Tulis pertanyaan, keluhan, masukan atau saran anda disini*"
                            required=""><?= htmlentities(set_value('isi_kritik'), ENT_QUOTES) ?></textarea>
                        <div class="invalid-feedback errorisi_kritik"></div>

                    </div>

                    </p>
                    <div class="form-group text-right">
                        <input type="hidden" id="berita_id" name="berita_id" value="fd" class="form-control">
                        <div class="g-recaptcha" data-sitekey="<?= esc($sitekey) ?>"></div>
                        <button type="submit" class="btn btn-primary btnkritik"><i class="fas fa-paper-plane"></i> Kirim
                            Pesan</button>
                    </div>

                    <?= form_close() ?>

                </div><!-- End  -->
            </div>
        </div>

    </div>
    </div>

    </div>
</section>



<script>
    $(document).ready(function () {

        $('.formkritik').submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function () {
                    $('.btnkritik').prop('disable', true);
                    $('.btnkritik').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> <i>Loading...')

                },
                complete: function () {
                    $('.btnkritik').prop('disable', false);
                    $('.btnkritik').html('Kirim Pesan')
                    $('.btnkritik').html('<i class="fas fa-paper-plane"></i>  Kirim Pesan');
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

                        if (response.error.email) {
                            $('#email').addClass('is-invalid');
                            $('.erroremail').html(response.error.email);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('.erroremail').html();
                            $('#email').addClass('is-valid');
                        }

                        if (response.error.no_hpusr) {
                            $('#no_hpusr').addClass('is-invalid');
                            $('.errorno_hpusr').html(response.error.no_hpusr);
                        } else {
                            $('#no_hpusr').removeClass('is-invalid');
                            $('.errorno_hpusr').html();
                            $('#no_hpusr').addClass('is-valid');
                        }

                        if (response.error.judul) {
                            $('#judul').addClass('is-invalid');
                            $('.errorjudul').html(response.error.judul);
                        } else {
                            $('#judul').removeClass('is-invalid');
                            $('.errorjudul').html();
                            $('#judul').addClass('is-valid');
                        }

                        if (response.error.isi_kritik) {
                            $('#isi_kritik').addClass('is-invalid');
                            $('.errorisi_kritik').html(response.error.isi_kritik);
                        } else {
                            $('#isi_kritik').removeClass('is-invalid');
                            $('.errorisi_kritik').html();
                            $('#isi_kritik').addClass('is-valid');
                        }

                    }

                    if (response.sukses) {
                        Swal.fire({
                            title: "Terima Kasih!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 4550
                        }).then(function () {
                            window.location = '<?= base_url('') ?>';
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownerror) {
                    Swal.fire({
                        title: "Maaf gagal mengirim data!",
                        html: `Silahkan coba kembali Error Code: <strong>${(xhr.status + "\n")}</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
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