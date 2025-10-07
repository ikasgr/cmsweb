<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
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
<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsdatagoe" />
<section class="container pb-0">
    <div class="card p-3">
        <div class="row article-container pb-5">
            <div class="col-md-1">
                <div class="share-button d-none d-sm-block position-sticky sticky-top">
                    <h4 class="montserrat-700 f-20 text-blue mb-4">Share</h4>
                    <ul>
                        <li class="mb-4"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?href=<?php echo site_url('pengumuman') ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/share-fb.png') ?>" /></a></li>
                        <li class="mb-4"><a target="_blank" href="https://web.whatsapp.com/send?text=<?= base_url('pengumuman/') ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/wa.png') ?>" /></a></li>
                        <!-- <li><a href="#"><img width="48" src="<?= base_url() ?>/public/template/frontend/' . esc($folder) . '/desktop/img/share-link.png" /></a></li> -->
                    </ul>

                </div>
                <div class="share-button d-sm-none">
                    <h4 class="montserrat-700 f-20 text-blue mb-4">Bagikan Informasi</h4>
                    <ul>
                        <li class="mb-4 mr-2 float-left"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?href=<?php echo site_url('pengumuman') ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/share-fb.png') ?>" /></a></li>
                        <li class="mb-4 mr-2 float-left"><a target="_blank" href="https://web.whatsapp.com/send?text=<?= base_url('pengumuman/') ?>"><img width="48" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/wa.png') ?>" /></a></li>

                    </ul>
                </div>
            </div>
            <div class="col-md-11 px-md-5">
                <div class="article-detail mb-0">
                    <h1 class="text-blue montserrat-700 f-30 text-center">Pengumuman </h1>


                    <!-- Portfolio Start -->
                    <div class="portfolio" id="portfolio">
                        <div class="row portfolio-container">
                            <?php if ($pengumuman) {
                                foreach ($pengumuman as $data) {
                            ?>

                                    <div class="col-lg-6 col-md-6 col-sm-12 portfolio-item filter-1 wow fadeInUp" data-wow-delay="0.0s">
                                        <div class="portfolio-wrap">
                                            <div class="portfolio-imgx">
                                                <img height="250" width="100%" src="<?= base_url('public/img/informasi/pengumuman/' . esc($data['gambar'])) ?>" alt="Image">
                                            </div>
                                            <div class="portfolio-text">
                                                <h3><?= esc($data['nama']) ?></h3>
                                                <a class="btn" onclick="lihatpengumuman('<?= $data['informasi_id'] ?>')" data-lightbox="portfolio">+</a>
                                            </div>
                                        </div>
                                    </div>

                                <?php }
                                if ($jum > 5) { ?>

                                    <P>
                                    <ul class="pagination justify-content-center">
                                        <?= $pager->links('hal', 'datagoe'); ?>
                                    </ul>
                                    </P>
                                <?php }
                            } else { ?>
                                <div class="alert alert-danger text-center" style='background-color:#FAEBD7; border-color:#e3e3e3;'>
                                    <a target='_BLANK' style='color:red'>Belum ada data Pengumuman..!</a><br> Punya pertanyaan, keluhan, masukan atau saran, silahkan klik <b class="pointer" onclick="window.location.href='<?= base_url('masukansaran') ?>'">disini</b>, untuk sampaikan.
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Portfolio End -->


        </div>
    </div>
</section>

<?= $this->endSection() ?>