<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>


<section class="container mt-lg-0 mt-0 pb-1">
    <div class="d-none d-md-none d-lg-block" style="padding: 32px"></div>
    <div class="d-block d-md-none" style="padding: 28px"></div>
    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue"></h4>
        </div>
    </div>
    <div class="row">
        <div class="col">

        </div>
    </div>
</section>

<section class="container pb-0">
    <div class="card p-3">
        <div class="row article-container pb-5">

            <div class="col-md-1">
                <div class="share-button d-none d-sm-block position-sticky sticky-top">
                    <h4 class="montserrat-700 f-20 text-blue mb-4">Share</h4>
                    <ul>
                        <?php if ($berita) {
                            foreach ($berita as $data) {
                            }
                        }
                        ?>
                        <li class="mb-4"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?href=<?php echo site_url('berita/') ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/share-fb.png') ?>" /></a></li>
                        <li class="mb-4"><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo site_url('berita/') ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/share-tw.png') ?>" /></a></li>
                        <li class="mb-4"><a target="_blank" href="https://web.whatsapp.com/send?text=<?php echo site_url('berita/') ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/wa.png') ?>" /></a></li>
                    </ul>
                </div>
                <div class="share-button d-sm-none">
                    <h4 class="montserrat-700 f-20 text-blue mb-4">Bagikan artikel</h4>
                    <ul>
                        <li class="mb-4 mr-2 float-left"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?href=<?php echo site_url('berita/') ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/share-fb.png') ?>" /></a></li>
                        <li class="mb-4 mr-2 float-left"><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo site_url('berita/') ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/share-tw.png') ?>" /></a></li>
                        <li class="mb-4 mr-2 float-left"><a target="_blank" href="https://web.whatsapp.com/send?text=<?php echo site_url('berita/') ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/wa.png') ?>" /></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-11 px-md-5">
                <div class="article-detail mb-0">
                    <h1 class="text-blue montserrat-700 f-30 text-center">Tagar <?= esc($subtitle) ?> </h1>
                    <hr>

                    <div class=" stretch-card grid-margin">
                        <?php if ($berita) {
                            foreach ($berita as $data) {
                                $pot = substr(esc($data['ringkasan']), 0, 200);
                        ?>

                                <div class="row">
                                    <div class="col-sm-4 grid-margin">
                                        <div class="position-relative">
                                            <div class="rotate-img">
                                                <img src="<?= base_url('/public/img/informasi/berita/' . esc($data['gambar'])) ?>" alt="thumb" class="img-fluidx rounded" width="100%" height="150" />

                                            </div>
                                            <div class="badge-positioned">
                                                <a href="<?= base_url('category/' . $data['slug_kategori']) ?>">
                                                    <span class="badge badge-danger font-weight-bold"><?= esc($data['nama_kategori']) ?></span>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8  grid-margin">
                                        <h2 class="mb-0 roboto-700 text-blue f-20">
                                            <a class="text-secondary" href="<?= base_url($data['slug_berita']) ?>"><?= esc($data['judul_berita']) ?></a>
                                        </h2>
                                        <div class="fs-13 mb-2">
                                            <span class="mr-2"><?= date_indo($data['tgl_berita']) ?> </span>
                                        </div>
                                        <span style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;
					   font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;" id="docs-internal-guid-a892404e-7fff-f643-f424-158863bfc0c2">
                                            <?= $pot ?>..
                                        </span>
                                    </div>
                                </div>
                                <hr>
                            <?php } ?>

                            <div class="paging text-center">

                                <P>

                                <ul class="pagination justify-content-center">
                                    <?= $pager->links('hal', 'ikasmedia'); ?>
                                </ul>
                                </P>

                            </div>

                        <?php } else { ?>
                            <div class="alert alert-danger text-center" style='background-color:#FAEBD7; border-color:#e3e3e3;'>
                                <a style='color:red'>Belum ada data untuk kategori ini..!</a>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>