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

                    <h1 class="text-blue montserrat-700 f-30 text-center">Galeri Video </h1>
                    <hr>

                    <?php if ($video) { ?>

                        <div class="row">
                            <?php $nomor = 0;
                            foreach ($video as $data) {
                                $nomor++;
                                ?>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="single-blog-post style-4 mb-30">
                                        <div class="newsthumb videothumb mb-3">
                                            <div class="newsthumb__img">
                                                <a href="https://www.youtube.com/embed/<?= esc($data['video_link']) ?>"
                                                    target="_blank"><iframe width="100%" height="200"
                                                        class="embed-responsive-item"
                                                        src="https://www.youtube.com/embed/<?= esc($data['video_link']) ?>"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen alt="img"></iframe></a>
                                            </div>
                                            <div class="newsthumb__content">
                                                <div class="catedate">
                                                    <!-- <span class="date"><?= date_indo($data['tanggal']) ?></span> -->
                                                    <a class="newsthumb__title"><a
                                                            href="https://www.youtube.com/embed/<?= esc($data['video_link']) ?>"
                                                            target="_blank"><?= esc($data['judul']) ?></a></a>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                </div>

                            <?php } ?>
                        </div>

                        <?php if ($jum > 6) { ?>
                            <P>
                            <ul class="pagination justify-content-center">
                                <?= $pager->links('hal', 'datagoe'); ?>
                            </ul>
                            </P>
                        <?php } ?>


                    <?php } else { ?>
                        <div class="alert alert-danger text-center" style='background-color:#FAEBD7; border-color:#e3e3e3;'>
                            <a target='_BLANK' style='color:red'>Belum ada data Video..!</a><br> Punya pertanyaan, keluhan,
                            masukan atau saran, silahkan klik <b class="tambahkritik pointer">disini</b>, untuk sampaikan.
                        </div>
                    <?php } ?>

                </div>


            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>