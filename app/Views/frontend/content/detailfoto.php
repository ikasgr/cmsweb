<?php
$db = \Config\Database::connect();
?>
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
                    <?php foreach ($foto as $data) {
                    } ?>
                    <h1 class="text-blue montserrat-700 f-30 text-center">Galeri <?= esc($data['nama_kategori_foto']) ?>
                    </h1>
                    <hr>

                    <?php if ($foto) { ?>

                        <div class="row">
                            <?php
                            foreach ($foto as $data) {
                                $pot = substr(esc($data['judul']), 0, 40);
                                ?>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="single-blog-post style-4 mb-30">
                                        <div class="newsthumb fotothumb mb-4">
                                            <!-- <div class="newsthumb__img pointer"> -->
                                            <a class="gallery-popup"
                                                href="<?= base_url('/public/img/galeri/foto/' . esc($data['gambar'])) ?>"
                                                title="<?= esc($data['judul']) ?>">
                                                <img class="embed-responsive embed-responsive-16by9 wrapper-img-new"
                                                    src="<?= base_url('/public/img/galeri/foto/thumb/' . 'thumb_' . esc($data['gambar'])) ?>"
                                                    alt="1" />
                                            </a>

                                            <div class="gallery-overlay">
                                                <div class="overlay-content">

                                                    <a class="cate"><?= $pot ?>...</a>
                                                </div>
                                            </div>

                                            <span class="date"><?= longdate_indo($data['tanggal']) ?></span>

                                        </div>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <P>
                        <ul class="pagination justify-content-center">
                            <a type="submit" href="<?= base_url('foto') ?>" class="btn btn-info text-light"><i
                                    class="fas fa-arrow-left"></i> <b class="text-light">Kembali ke Album Foto</b> </a>

                        </ul>
                        </P>

                    <?php } else { ?>
                        <div class="alert alert-danger text-center" style='background-color:#FAEBD7; border-color:#e3e3e3;'>
                            <a target='_BLANK' style='color:red'>Maaf tidak ditemukan Foto..!</a><br> Punya pertanyaan,
                            keluhan, masukan atau saran, silahkan klik <b class="tambahkritik pointer">disini</b>, untuk
                            sampaikan.
                        </div>
                    <?php } ?>

                </div>


            </div>
        </div>
    </div>
</section>

<script src="<?= base_url() ?>/public/template/backend/assets/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?= base_url() ?>/public/template/backend/assets/magnific-popup/gallery.init.js"></script>
<?= $this->endSection() ?>