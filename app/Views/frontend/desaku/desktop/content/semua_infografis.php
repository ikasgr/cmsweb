<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>


<section class="container mt-lg-0 mt-0 pb-1">

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

            <div class="col-md-12 px-md-5">
                <div class="article-detail mb-0">

                    <h1 class="text-blue montserrat-700 f-30 text-center">Info Grafis </h1>
                    <hr>

                    <?php if ($infografis) { ?>
                        <div class="row container-grid projects-wrapper">

                            <?php
                            foreach ($infografis as $data) :
                            ?>

                                <div class="col-xl-4 col-md-4 col-sm-4 branding designing development">
                                    <div class="gallery-box mt-4">
                                        <a class="gallery-popup" href="<?= base_url('public/img/informasi/infografis/' .  esc($data['banner_image'])) ?>" title="<?= esc($data['ket']) ?>">

                                            <img class="embed-responsive embed-responsive-16by9 wrapper-img-new" src="<?= base_url('public/img/informasi/infografis/' .  esc($data['banner_image'])) ?>" alt="<?= esc($data['ket']) ?>" />

                                            <div class="gallery-overlay">
                                                <div class="overlay-content">
                                                    <h5 class="overlay-title"><?= esc($data['ket']) ?></h5>

                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- PAGINATION -->
                        <div class="col-md-12 pt-4">
                            <nav>
                                <?php if ($jum > 6) { ?>
                                    <P>
                                    <ul class="pagination justify-content-center">
                                        <?= $pager->links('hal', 'datagoe'); ?>
                                    </ul>
                                    </P>
                                <?php } ?>
                            </nav>

                        </div>

                    <?php } else { ?>
                        <div class="alert alert-danger text-center" style='background-color:#FAEBD7; border-color:#e3e3e3;'>
                            <a style='color:red'>Maaf belum ada data..!</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</section>

<script src="<?= base_url() ?>/public/template/backend/morvin/assets/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?= base_url() ?>/public/template/backend/morvin/assets/magnific-popup/gallery.init.js"></script>
<?= $this->endSection() ?>