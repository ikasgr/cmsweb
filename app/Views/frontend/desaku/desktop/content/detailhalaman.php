<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
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
        <div class="row article-container pb-5">

            <div class="col-md-1">
                <div class="share-button d-none d-sm-block position-sticky sticky-top">
                    <h4 class="montserrat-700 f-20 text-blue mb-4">Share</h4>
                    <ul>
                        <li class="mb-4 list-unstyled ml-0"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?href=<?= site_url('') . 'page/' . $berita->slug_berita ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/share-fb.png') ?>" /></a></li>
                        <li class="mb-4 list-unstyled ml-0"><a target="_blank" href="https://twitter.com/intent/tweet?text=<?= site_url() . 'page/' . $berita->slug_berita ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/share-tw.png') ?>" /></a></li>
                        <li class="mb-4 list-unstyled ml-0"><a target="_blank" href="https://web.whatsapp.com/send?text=<?= site_url() . 'page/' . $berita->slug_berita ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/wa.png') ?>" /></a></li>

                    </ul>
                </div>
                <div class="share-button d-sm-none">
                    <h4 class="montserrat-700 f-20 text-blue mb-4">Bagikan </h4>
                    <ul>
                        <li class="mb-4 list-unstyled ml-0 mr-2 float-left"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?href=<?= site_url() . 'page/' . $berita->slug_berita ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/share-fb.png') ?>" /></a></li>
                        <li class="mb-4 list-unstyled ml-0 mr-2 float-left"><a target="_blank" href="https://twitter.com/intent/tweet?text=<?= site_url() . 'page/' . $berita->slug_berita ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/share-tw.png') ?>" /></a></li>
                        <li class="mb-4 list-unstyled ml-0 mr-2 float-left"><a target="_blank" href="https://web.whatsapp.com/send?text=<?= site_url() . 'page/' . $berita->slug_berita ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/wa.png') ?>" /></a></li>

                    </ul>
                </div>
            </div>
            <div class="col-md-11 px-md-5">
                <div class="gen-section">
                    <div class="gen-content">
                        <div class="article-detail mb-0">
                            <h1 class="text-blue montserrat-700 f-30"><?= esc($berita->judul_berita) ?> </h1>
                            <div class="media mt-4 mb-4">
                                <img width="35" class="mr-3 rounded-circle" src="<?= base_url('public/img/user/' . esc($berita->user_image)) ?>" />
                                <div class="media-body text-blue f-15">
                                    <h5 class="roboto-500 mt-0 mb-0 f-15"><?= esc($berita->fullname) ?></h5>
                                    <span class="font-italic"><i class="bi bi-alarm"></i> <?= date_indo($berita->tgl_berita) ?> <i class="bi bi-eye"></i> <?= $berita->hits ?> x </span>
                                </div>
                            </div>
                            <hr>

                            <?php
                            if (esc($berita->gambar) != 'default.png') { ?>
                                <img class="w-100 mb-1" src="<?= base_url('/public/img/informasi/profil/' . esc($berita->gambar)) ?>" width="100%" alt="">
                                <span class="font-italic"> <?= esc($berita->ket_foto) ?></span>
                            <?php }
                            ?>
                            <div class="roboto-400 f-20">
                                <span style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;" id="docs-internal-guid-a892404e-7fff-f643-f424-158863bfc0c2">
                                </span>

                            </div>
                        </div>
                        <div class="detail__content ">
                            <div class="roboto-400 f-20 mt-0">
                                <span style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;" id="docs-internal-guid-a892404e-7fff-f643-f424-158863bfc0c2">
                                    <p class=""> <?= $berita->isi ?></p>
                                    <?php
                                    if (esc($berita->filepdf) != '') { ?>
                                        <iframe src="<?= base_url('/public/img/informasi/pdf/' . esc($berita->filepdf)) ?>" frameborder="0" width="100%" height="650px"></iframe>
                                    <?php } ?>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                <hr>

                <br>

                <!-- Begin List Posts
	================================================== -->
                <section class="recent-posts">
                    <div class="section-title">
                        <h2><span>Berita Terpopuler</span></h2>
                    </div>
                    <div class="card-columns listrecent">
                        <?php foreach ($populer3 as $data) :
                            $pot = substr(esc($data['judul_berita']), 0, 30);
                        ?>

                            <!-- begin post -->
                            <div class="card">
                                <a href="<?= base_url($data['slug_berita']) ?>">
                                    <img class="img-fluidx rounded" title="<?= esc($data['judul_berita']) ?>" height="160" width="100%" src="<?= base_url('/public/img/informasi/berita/' . esc($data['gambar'])) ?>" alt="">
                                </a>
                                <div class="card-block">
                                    <h2 class="card-title"><a title="<?= esc($data['judul_berita']) ?>" href="<?= base_url($data['slug_berita']) ?>"><?= $pot ?>..</a></h2>
                                    <div class="metafooter">
                                        <div class="wrapfooter">
                                            <span class="meta-footer-thumb">
                                                <a href="<?= base_url('author/' . $data['id'] . '/' . esc($data['fullname'])) ?>"><img class="author-thumb" src="<?= base_url('public/img/user/' . esc($data['user_image'])) ?>" alt="Sal"></a>
                                            </span>
                                            <span class="author-meta">
                                                <span class="post-name"><a href="<?= base_url('author/' . $data['id'] . '/' . esc($data['fullname'])) ?>"><?= esc($data['fullname']) ?></a></span><br />
                                                <span class="post-date"><?= date_indo($data['tgl_berita']) ?></span><span class="dot"></span>
                                                <span class="post-read"><a href="<?= base_url('category/' . $data['slug_kategori']) ?>"><?= esc($data['nama_kategori']) ?></a></span>
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

            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>