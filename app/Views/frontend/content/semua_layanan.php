<?= $this->extend('frontend/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/desktop' . '/v_menu') ?>
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

<section class="container pb-0">
    <div class="card p-3">
        <div class="row article-container pb-5">

            <div class="col-md-12 px-md-5">
                <div class="article-detail mb-0">
                    <h1 class="text-blue montserrat-700 f-30 text-center">Daftar Layanan </h1>
                    <br>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"
                        id="csrf_tokencmsikasmedia" />
                    <?php if ($layanan) { ?>

                        <div class="alert alert-info" style='background-color:#f4f4f4; border-color:#e3e3e3;'>
                            Anda Punya pertanyaan, masukan atau saran, seputar layanan kami? Klik <b class="pointer"
                                onclick="window.location.href='<?= base_url('masukansaran') ?>'">disini</b>, untuk
                            sampaikan.
                        </div>

                        <?php $nomor = 0;
                        foreach ($layanan as $data) {
                            $nomor++;
                            ?>

                            <div class="list-group mt-2">
                                <div class="list-group-item list-group-item-action "
                                    onclick="lihatlayanan('<?= $data['informasi_id'] ?>')">
                                    <div class="row no-gutters pointer">
                                        <div class="media">
                                            <div class="media-body">
                                                <a
                                                    style="font-size: 20px;line-height: 19px; margin-bottom: 0px; color:#144874;"><?= esc($data['nama']) ?></a>
                                                <div class="infobar" style="font-size: .8em;">
                                                    <i class="fas fa-user-alt"></i> <?= esc($data['fullname']) ?> /
                                                    <i class="far fa-calendar-alt"></i> <?= date_indo($data['tgl_informasi']) ?>
                                                    /
                                                    <i class="far fa-eye"></i> <?= $data['hits'] ?> kali
                                                </div>
                                            </div>
                                        </div>
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
                            <a target='_BLANK' style='color:red'>Belum ada data Layanan..!</a><br> Punya pertanyaan,
                            keluhan, masukan atau saran, silahkan klik <b class="pointer"
                                onclick="window.location.href='<?= base_url('masukansaran') ?>'">disini</b>, untuk
                            sampaikan.
                        </div>
                    <?php } ?>

                </div>
            </div>
            <!-- Portfolio End -->

        </div>
    </div>

</section>

<?= $this->endSection() ?>