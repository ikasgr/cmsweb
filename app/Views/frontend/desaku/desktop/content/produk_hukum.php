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
            <div class="col-md-12" data-aos="fade-right" id="content">
                <h1 class="text-blue montserrat-700 f-30 text-center">Produk Hukum </h1>
                <hr>
                <!-- ISI -->

                <?php if ($produkhukum) { ?>

                    <div class="alert alert-info" style='background-color:#f4f4f4; border-color:#e3e3e3;'>
                        Informasi mengenai peraturan, keputusan, dan/atau kebijakan yang mengikat dan/atau berdampak bagi publik dapat diunduh pada list dibawah.
                        Jika data yang dicari tidak ditemukan, Silahkan klik <b class="pointer" onclick="window.location.href='<?= base_url('masukansaran') ?>'">disini</b>, untuk lakukan permintaan Informasi.
                    </div>

                    <div id="accordion">
                        <?php foreach ($produkhukum as $data) {
                            $produk_id = $data['produk_id'];
                        ?>
                            <div class="card p-1">
                                <div class="card-header p-3" id="heading<?= $data['produk_id'] ?>">
                                    <h6 class="m-0 font-14">
                                        <a href="#collapse<?= $data['produk_id'] ?>" class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="collapse<?= $data['produk_id'] ?>">
                                            <i class="fa fa-balance-scale"></i> <?= strtoupper(esc($data['nama_produk']))  ?>
                                        </a>
                                    </h6>
                                </div>

                                <div id="collapse<?= $data['produk_id'] ?>" class="collapse showx" aria-labelledby="heading<?= $data['produk_id'] ?>" data-parent="#accordion">
                                    <div class="card-body" style='background-color:#f4f4f4; border-color:#e3e3e3;'>
                                        <!-- Perulangan sub -->
                                        <?php
                                        $set = $db->table('produk_kathukum')->where('produk_id', $produk_id)->orderBy('kathukum_id', 'ASC')->get()->getResultArray();

                                        foreach ($set as $datasub) {
                                        ?>

                                            <ul style="list-style:none;">
                                                <?php if (esc($datasub['file_kathukum']) != '-' && (esc($datasub['file_kathukum']) != null)) { ?>
                                                    <li class="pb-0">
                                                        <a href="<?= base_url('public/unduh/produkhukum/'  . esc($datasub['file_kathukum'])) ?>" title="Download file" target="_blank"><i class="fas fa-file-alt text-primary pointer font-16"></i> <?= (esc($datasub['nama_kathukum'])) ?></a>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class=""><b><?= strtoupper(esc($datasub['nama_kathukum'])) ?></b></li>
                                                <?php } ?>

                                                <!-- Perulangan subsub -->

                                                <?php $set2 = $db->table('produk_subkathukum')->where('produk_subkathukum.kathukum_id', $datasub['kathukum_id'])->orderBy('produk_subkathukum.subkathukum_id', 'ASC')->get()->getResultArray();
                                                $no = 0;
                                                foreach ($set2 as $datasubsub) {
                                                    $no++;
                                                ?>
                                                    <li class="">
                                                        <a href="<?= base_url('public/unduh/produkhukum/'  . esc($datasubsub['file_subkathukum'])) ?>" title="Download file" target="_blank"> <?= $no ?>. <?= esc($datasubsub['nama_subkathukum']) ?></a>
                                                    </li>

                                                <?php } ?>

                                            </ul>

                                        <?php } ?>

                                    </div>
                                </div>
                            </div>

                        <?php } ?>


                        <?php if ($jum > 6) { ?>

                            <P>
                            <ul class="pagination justify-content-center">
                                <?= $pager->links('hal', 'datagoe'); ?>
                            </ul>
                            </P>

                        <?php } ?>

                    <?php } else { ?>
                        <div class="alert alert-danger text-center" style='background-color:#FAEBD7; border-color:#e3e3e3;'>
                            <a style='color:red'>Belum Ada data Produk Hukum.!</a><br> Punya pertanyaan, keluhan, masukan atau saran, silahkan klik <b class="pointer" onclick="window.location.href='<?= base_url('masukansaran') ?>'">disini</b>, untuk sampaikan.
                        </div>
                    <?php } ?>
                    </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>