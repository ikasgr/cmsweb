<?php
$db = \Config\Database::connect();
?>
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
                    <h1 class="text-blue montserrat-700 f-30 text-center">Galeri Foto </h1>
                    <hr>
                    <div class="row">

                        <?php if ($album) {

                            foreach ($album as $key => $data) {
                                $idalbum = $data['kategorifoto_id'];
                                $jumfoto = $db->table('foto')->where('kategorifoto_id', $idalbum)->get()->getNumRows();
                        ?>

                                <!-- Gallery item -->
                                <div class="col-xl-4 col-lg-4 col-md-6 mb-4">

                                    <div class="bg-light rounded shadow-sm pointer">
                                        <a href="<?= base_url('foto/detail/' . $data['kategorifoto_id']) ?>"><img src="<?= base_url('/public/img/galeri/katfoto/' . esc($data['cover_foto'])) ?>" alt="" class="img-fluidx card-img-top" width="100%" height="200"></a>
                                        <div class="p-2">
                                            <span> <a href="<?= base_url('foto/detail/' . $data['kategorifoto_id']) ?>" class="text-dark"><?= esc($data['nama_kategori_foto']) ?></a></span>
                                            <div class="bg-white tipe rounded-pill">
                                                <div class="px-3 foldkategori bg-danger rounded ">
                                                    <div class="text-light">
                                                        <a class="text-light" href=""><?= $jumfoto ?> Foto
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-1">
                                            <p class="small mb-0"><i class="fa fa-picture-o mr-1"></i><span class="badge badge-primary px-3 rounded-pill font-weight-normal"></span> <?= longdate_indo($data['tgl_album']) ?></p>

                                        </div> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End -->
                            <?php } ?>

                    </div>

                    <?php if ($jumpg > 12) { ?>
                        <P>
                        <ul class="pagination justify-content-center">
                            <?= $pager->links('hal', 'ikasmedia'); ?>
                        </ul>
                        </P>
                    <?php } ?>
                <?php } ?>

                </div>


            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>