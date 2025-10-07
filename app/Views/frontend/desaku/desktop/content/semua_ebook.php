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

                    <h1 class="text-blue montserrat-700 f-30 text-center">Daftar E-Book </h1>
                    <hr>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsdatagoe" />
                    <div class="row container-grid projects-wrapper">
                        <?php foreach ($ebook as $data) {
                        ?>
                            <div class="col-lg-4 col-sm-6 photo-gallery mb-4">
                                <div class="card h-100">
                                    <a href="<?= base_url('bacabuku/' . esc($data['fileebook'])) ?>" title="Baca Buku" target="_blank" onclick="updatehit('<?= $data['ebook_id'] ?>')"><img class="card-img-top" src="<?= base_url('/public/img/ebook/thumb/' . 'thumb_'  . esc($data['gambar'])) ?>" alt=""></a>
                                    <div class="bg-white tipe rounded-pill">
                                        <div class="px-3 foldkategori rounded bg-primary ">
                                            <div class="text-light">
                                                <span class="text-light"><?= esc($data['kategoriebook_nama']) ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="card-body p-3"> -->
                                    <h5 class="card-title">
                                        <a href="<?= base_url('bacabuku/' . esc($data['fileebook'])) ?>" title="Baca Buku" target="_blank" onclick="updatehit('<?= $data['ebook_id'] ?>')">
                                            <?= esc($data['judul']) ?> </a>
                                    </h5>
                                    <div class="metadata">
                                        <span class="date small"><i class="fa fa-calendar"></i> <?= date_indo($data['tanggal']) ?></span>
                                        | <span class="date pointer" onclick="lihatbook('<?= $data['ebook_id'] ?>','<?= esc($data['kategoriebook_nama']) ?>')"><i class="fa fa-search"></i>View Detail</span>
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

                </div>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>