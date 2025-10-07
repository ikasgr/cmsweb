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
                    <?php if ($hasil) { ?>
                        <h1 class="text-blue montserrat-700 f-30 text-center">Hasil Pencarian <b class="text-danger"><?= esc($keyword) ?></b> </h1>
                    <?php  } else { ?>
                        <h1 class="text-blue montserrat-700 f-30 text-center">Hasil Pencarian </h1>
                    <?php } ?>

                    <hr>

                    <div class=" stretch-card grid-margin">
                        <?php if ($hasil) {
                            foreach ($hasil as $data) {
                                // $pot = substr(esc($data['ringkasan']), 0, 200);
                                if ($data['jenis_berita'] == 'Berita') {
                                    $img        = base_url('/public/img/informasi/berita/' . esc($data['gambar']));
                                    $link       = base_url($data['slug_berita']);
                                    $pot        = substr(esc($data['ringkasan']), 0, 210);
                                    $linkkat    = base_url('category/' . $data['slug_kategori']);
                                    $namakat    = $data['slug_kategori'];
                                    $badge      = 'badge badge-danger font-weight-bold';
                                } else {
                                    $img        = base_url('/public/img/informasi/profil/' . esc($data['gambar']));
                                    $link       = base_url('page/' . $data['slug_berita']);
                                    $pot        = substr($data['isi'], 0, 200);
                                    $linkkat    = '#';
                                    $namakat    = '-';
                                    $badge      = '';
                                }
                        ?>

                                <div class="row">
                                    <div class="col-sm-4 grid-margin">
                                        <div class="position-relative">
                                            <div class="rotate-img">
                                                <img src="<?= $img ?>" alt="thumb" class="img-fluidx rounded" width="100%" height="150" />
                                            </div>
                                            <div class="badge-positioned">
                                                <a href="<?= $linkkat ?>">
                                                    <span class="<?= $badge ?>"><?= $namakat ?></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8  grid-margin">
                                        <h2 class="mb-0 roboto-700 text-blue f-20">
                                            <a class="text-secondary" href="<?= $link ?>"><?= esc($data['judul_berita']) ?></a>
                                        </h2>
                                        <div class="fs-13 mb-2">
                                            <span class="mr-2"><?= date_indo($data['tgl_berita']) ?> </span>
                                        </div>
                                        <span style="font-size:11pt;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;" id="docs-internal-guid-a892404e-7fff-f643-f424-158863bfc0c2">
                                            <?= $pot ?>...
                                        </span>
                                    </div>
                                </div>
                                <hr>
                            <?php } ?>

                            <div class="paging text-center">
                                <P>
                                <ul class="pagination justify-content-center">
                                    <?= $pager->links('hal', 'datagoe'); ?>
                                </ul>

                                </P>
                            </div>

                        <?php } else { ?>
                            <div class="alert alert-light text-center" style='background-color:#FAEBD7; border-color:#e3e3e3;'>
                                <span class="text-dark"> Maaf keyword <b class="text-danger"><?= esc($keyword) ?> </b> tidak ditemukan..!!</span>
                            </div>
                        <?php } ?>

                    </div>


                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>