<?= $this->extend('frontend/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<style>
    ol {
        padding: 20px;
    }

    ul {

        list-style-type: square;
        margin-left: 15px;
    }

    ol li {

        list-style-type: number;
        margin-left: 15px;
    }

    ul li {
        list-style-type: square;
        margin-left: 15px;
    }
</style>
<section class="container mt-lg-0 mt-0 pb-1">
    <!-- <div class="d-none d-md-none d-lg-block" style="padding: 32px"></div>
    <div class="d-block d-md-none" style="padding: 28px"></div> -->
    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue"></h4>
        </div>
    </div>

    <!-- ======= Breadcrumbs ======= -->
</section>

<section class="container pb-0">
    <div class="card p-3">
        <div class="row pb-5">
            <div class="col-md-1">
                <div class="share-button d-none d-sm-block position-sticky sticky-top">
                    <h4 class="montserrat-700 f-20 text-blue mb-4"> Share</h4>
                    <ul>
                        <li class="mb-4 list-unstyled ml-0"><a target="_blank"
                                href="https://www.facebook.com/sharer/sharer.php?href=<?= site_url('') . $berita->slug_berita ?>"><img
                                    width="48"
                                    src="<?= base_url('/public/template/frontend/desktop/img/share-fb.png') ?>" /></a>
                        </li>
                        <li class="mb-4 list-unstyled ml-0"><a target="_blank"
                                href="https://twitter.com/intent/tweet?text=<?= site_url() . $berita->slug_berita ?>"><img
                                    width="48"
                                    src="<?= base_url('/public/template/frontend/desktop/img/share-tw.png') ?>" /></a>
                        </li>
                        <li class="mb-4 list-unstyled ml-0"><a target="_blank"
                                href="https://web.whatsapp.com/send?text=<?= site_url() . $berita->slug_berita ?>"><img
                                    width="48"
                                    src="<?= base_url('/public/template/frontend/desktop/img/wa.png') ?>" /></a>
                        </li>

                    </ul>
                </div>
                <div class="share-button d-sm-none">
                    <h4 class="montserrat-700 f-20 text-blue mb-4">Bagikan artikel</h4>
                    <ul>
                        <li class="mb-4 list-unstyled ml-0 mr-2 float-left"><a target="_blank"
                                href="https://www.facebook.com/sharer/sharer.php?href=<?= site_url() . $berita->slug_berita ?>"><img
                                    width="48"
                                    src="<?= base_url('/public/template/frontend/desktop/img/share-fb.png') ?>" /></a>
                        </li>
                        <li class="mb-4 list-unstyled ml-0 mr-2 float-left"><a target="_blank"
                                href="https://twitter.com/intent/tweet?text=<?= site_url() . $berita->slug_berita ?>"><img
                                    width="48"
                                    src="<?= base_url('/public/template/frontend/desktop/img/share-tw.png') ?>" /></a>
                        </li>
                        <li class="mb-4 list-unstyled ml-0 mr-2 float-left"><a target="_blank"
                                href="https://web.whatsapp.com/send?text=<?= site_url() . $berita->slug_berita ?>"><img
                                    width="48"
                                    src="<?= base_url('/public/template/frontend/desktop/img/wa.png') ?>" /></a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-md-11 px-md-5">
                <!-- <div class="card"> -->
                <div class="article-detail mb-0">
                    <h1 class="text-blue montserrat-700 f-30"><?= esc($berita->judul_berita) ?> </h1>
                    <div class="media mt-4 mb-4">
                        <img width="35" class="mr-3 rounded-circle"
                            src="<?= image_url('user/' . esc($berita->user_image)) ?>" />
                        <div class="media-body text-blue f-15">
                            <a href="<?= base_url('author/' . $berita->id . '/' . esc($berita->fullname)) ?>">
                                <h5 class="roboto-500 mt-0 mb-0 f-15"><?= esc($berita->fullname) ?></h5>
                            </a>
                            <span class="font-italic"><i class="bi bi-alarm"></i> <?= date_indo($berita->tgl_berita) ?>
                                <i class="bi bi-eye"> </i><?= $berita->hits ?> x <i class="bi bi-folder2"></i> <a
                                    href="<?= base_url('category/' . $berita->slug_kategori) ?>"><?= esc($berita->nama_kategori) ?>
                            </span>
                        </div>
                    </div>
                    <hr>
                    <img class="w-100 mb-1" src="<?= image_url('informasi/berita/' . esc($berita->gambar)) ?>" />
                    <span class="font-italic"> <?= esc($berita->ket_foto) ?></span>

                    <div class="roboto-400 f-20 mt-0">
                        <span
                            style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal; text-decoration:none;vertical-align:baseline;"
                            id="docs-internal-guid-a892404e-7fff-f643-f424-158863bfc0c2">
                            <p> <?= $berita->isi ?></p>
                        </span>
                    </div>
                </div>


                <?php if ($tag) { ?>

                    <?php foreach ($tag as $data) {
                        ?>

                        <!-- <div class="btn-group"> -->
                        <!-- <button type="button" class="btn-secondary btn-sm mb-0 text-blue"> -->

                        <a href="<?= base_url('tag/' . $data['tag_id'] . '/' . $data['slug_tag']) ?>"
                            class="btn-secondary btn-sm mb-0 mr-1 text-blue"><i class="fas fa-tags mr-1"></i>
                            <?= esc($data['nama_tag']) ?> </a>
                        <!-- </button> -->
                        <!-- </div> -->

                    <?php } ?>

                <?php } ?>

                <!-- </div> -->
                <br>
                <hr>

                <!-- Begin List Posts
    ================================================== -->
                <section class="recent-posts">
                    <div class="section-title">
                        <h2><span>Berita Terpopuler</span></h2>
                    </div>
                    <div class="card-columns listrecent">
                        <?php foreach ($beritapopuler6 as $data):
                            $pot = substr(esc($data['judul_berita']), 0, 30);
                            ?>

                            <!-- begin post -->
                            <div class="card bg-light">
                                <a href="<?= base_url($data['slug_berita']) ?>">
                                    <img class="img-fluidx rounded" title="<?= esc($data['judul_berita']) ?>" height="160"
                                        width="100%" src="<?= image_url('informasi/berita/' . esc($data['gambar'])) ?>"
                                        alt="">
                                </a>
                                <div class="card-block">
                                    <h2 class="card-title"><a title="<?= esc($data['judul_berita']) ?>"
                                            href="<?= base_url($data['slug_berita']) ?>"><?= $pot ?>..</a></h2>
                                    <div class="metafooter">
                                        <div class="wrapfooter">
                                            <span class="meta-footer-thumb">
                                                <a
                                                    href="<?= base_url('author/' . $data['id'] . '/' . esc($data['fullname'])) ?>"><img
                                                        class="author-thumb"
                                                        src="<?= image_url('user/' . esc($data['user_image'])) ?>"
                                                        alt="Sal"></a>
                                            </span>
                                            <span class="author-meta">
                                                <span class="post-name"><a
                                                        href="<?= base_url('author/' . $data['id'] . '/' . esc($data['fullname'])) ?>"><?= esc($data['fullname']) ?></a></span><br />
                                                <span class="post-date"><?= date_indo($data['tgl_berita']) ?></span><span
                                                    class="dot"></span>
                                                <span class="post-read"><a
                                                        href="<?= base_url('category/' . $data['slug_kategori']) ?>"><?= esc($data['nama_kategori']) ?></a></span>
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end post -->
                        <?php endforeach; ?>


                    </div>
                </section>

                <!-- End List Posts
    ================================================== -->
                <?php if ($berita->sts_komen != '0') { ?>
                    <div class="article-section accordion mb-5" id="section-article">
                        <div class="card mt-3">
                            <div class="card-header" id="section-header-1">
                                <h2 class="mb-0 roboto-700 text-blue f-25">
                                    Kolom Komentar
                                    <a href="#" class="float-right" data-toggle="collapse" data-target="#section-20"
                                        aria-expanded="true" aria-controls="section-20">
                                        <img src="<?= base_url('public/template/frontend/desktop/img/arrow-down.png') ?>" />
                                    </a>
                                </h2>
                            </div>
                            <div id="section-20" class="collapse show" aria-labelledby="section-header-20"
                                data-parent="#section-article">
                                <div class="card-body text-gray roboto-400 f-14">
                                    <p dir="ltr"
                                        style="line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;"
                                        id="docs-internal-guid-3e79c859-7fff-f60c-861a-2588e498a307">
                                        <span style="font-size:11pt;font-family:Arial;color:#000000;background-color:
transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">


                                            <br>
                                            <div class="blog-comments">
                                                <?php if ($komen) {

                                                    ?>
                                                    <!-- Single Comment -->


                                                    <div id="comment-1" class="comment">
                                                        <div class="item">
                                                            <?php foreach ($komen as $data) { ?>
                                                                <div class="comment-img">
                                                                    <img class="img-circle comment-img float-left"
                                                                        src="<?= base_url('public/template/backend/img/usr2.png') ?>"
                                                                        alt="<?= esc($data['nama_komen']) ?>">
                                                                </div>
                                                                <div>
                                                                    <div class="author"><?= esc($data['nama_komen']) ?></div>
                                                                    <?php
                                                                    $blnk = date('m', strtotime($data["tanggal_komen"]));
                                                                    $blnck = bulan($blnk);
                                                                    $tglk = date('d', strtotime($data["tanggal_komen"]));
                                                                    $thnk = date('Y', strtotime($data["tanggal_komen"]));
                                                                    $jamk = date('H:i:s', strtotime($data["tanggal_komen"]));
                                                                    ?>
                                                                    <div class="date">
                                                                        <?= $tglk . ' ' . $blnck . ' ' . $thnk . ' ' . $jamk ?>
                                                                    </div>
                                                                    <p><?= esc($data['isi_komen']) ?> </p>
                                                                </div>

                                                                <?php if ($data['balas_komen'] != '') { ?>
                                                                    <div class="alert alert-light"
                                                                        style='background-color:#f4f4f4; border-color:#e3e3e3;'>
                                                                        <div class="comment-img">
                                                                            <img class="img-circle comment-img float-left"
                                                                                src="<?= image_url('user/' . esc($data['user_image'])) ?>"
                                                                                alt="<?= esc($data['fullname']) ?>">
                                                                        </div>
                                                                        <div>

                                                                            <?php
                                                                            $bln = date('m', strtotime($data["tgl_balas"]));
                                                                            $blnc = bulan($bln);
                                                                            $tgl = date('d', strtotime($data["tgl_balas"]));
                                                                            $thn = date('Y', strtotime($data["tgl_balas"]));
                                                                            $jam = date('H:i:s', strtotime($data["tgl_balas"]));


                                                                            ?>
                                                                            <div class="author text-primary">
                                                                                <?= esc($data['fullname']) ?>
                                                                            </div>
                                                                            <div class="date text-danger">
                                                                                <?= $tgl . ' ' . $blnc . ' ' . $thn . ' ' . $jam ?>
                                                                            </div>
                                                                            <p><i><?= $data['balas_komen'] ?></i> </p>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>

                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>


                                                <div class="reply-form">

                                                    <h5><span>Berikan Komentar</span></h5>

                                                    <p>Alamat Email anda tidak akan ditampilkan. Wajib diisi untuk kolom *
                                                    </p>
                                                    <?= form_open('berita/simpankomen', ['class' => 'formkomen']) ?>

                                                    <div class="row">
                                                        <div class="col-md-4 form-group">
                                                            <input type="text" class="form-control" name="nama_komen"
                                                                value="" placeholder="Nama Lengkap*" required>
                                                            <div class="invalid-feedback errornama_komen"></div>
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <input type="text" class="form-control" name="hp_komen"
                                                                maxlength="20" value="" placeholder="Nomor Handphone*"
                                                                required>
                                                            <div class="invalid-feedback errorhp_komen"></div>
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <input type="email" class="form-control" name="email_komen"
                                                                value="" placeholder="Alamat Email*" required>
                                                            <div class="invalid-feedback erroremail_komen"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <textarea rows="4" name="isi_komen" class="form-control"
                                                                placeholder="Tulis komentar disini*" required=""></textarea>
                                                            <div class="invalid-feedback errorisi_komen"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer p-1">
                                                        <input type="hidden" id="berita_id" name="berita_id"
                                                            value="<?= $berita->berita_id ?>" class="form-control">
                                                        <div class="g-recaptcha" data-sitekey="<?= esc($sitekey) ?>"></div>
                                                        <button type="submit" class="btn btn-primary btnkomen"><i
                                                                class="fas fa-paper-plane"></i> Kirim Komentar</button>
                                                    </div>


                                                    <!-- </div> -->
                                                    <?= form_close() ?>

                                                </div>


                                            </div><!-- End blog comments -->

                                        </span>
                                    </p><br>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php } ?>
                <!-- end komen -->
            </div>
            <!-- end 10 -->
        </div>
    </div>
</section>




<script>
    $(document).ready(function () {

        $('.formkomen').submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function () {
                    $('.btnkomen').prop('disable', true);
                    $('.btnkomen').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> <i>Loading...')

                },
                complete: function () {
                    $('.btnkomen').prop('disable', false);
                    $('.btnkomen').html('Kirim Komentar')
                    $('.btnkomen').html('<i class="fas fa-paper-plane"></i>  Kirim Komentar');
                },
                success: function (response) {
                    if (response.error) {

                        if (response.error.nama_komen) {
                            $('#nama_komen').addClass('is-invalid');
                            $('.errornama_komen').html(response.error.nama_komen);
                        } else {
                            $('#nama_komen').removeClass('is-invalid');
                            $('.errornama_komen').html();
                            $('#nama_komen').addClass('is-valid');
                        }

                        if (response.error.hp_komen) {
                            $('#hp_komen').addClass('is-invalid');
                            $('.errorhp_komen').html(response.error.hp_komen);
                        } else {
                            $('#hp_komen').removeClass('is-invalid');
                            $('.errorhp_komen').html();
                            $('#hp_komen').addClass('is-valid');
                        }

                        if (response.error.isi_komen) {
                            $('#isi_komen').addClass('is-invalid');
                            $('.errorisi_komen').html(response.error.isi_komen);
                        } else {
                            $('#isi_komen').removeClass('is-invalid');
                            $('.errorisi_komen').html();
                            $('#isi_komen').addClass('is-valid');
                        }

                        if (response.error.email_komen) {
                            $('#email_komen').addClass('is-invalid');
                            $('.erroremail_komen').html(response.error.email_komen);
                        } else {
                            $('#email_komen').removeClass('is-invalid');
                            $('.erroremail_komen').html();
                            $('#email_komen').addClass('is-valid');
                        }


                    }

                    if (response.sukses) {
                        Swal.fire({
                            title: "Terima Kasih!",
                            text: response.sukses,
                            icon: "success",
                            // showConfirmButton: false,
                            // timer: 4550
                        }).then(function () {

                            window.location = '';
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownerror) {
                    Swal.fire({
                        title: "Maaf gagal kirim Komentar!",
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