<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<style>
    .gradient-custom-2 {
        /* fallback for old browsers */
        background: #fbc2eb;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1))
    }

    .testimonial-card .card-up {
        height: 120px;
        overflow: hidden;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }

    .testimonial-card .avatar {
        /* width: 110px; */
        width: 128px;
        margin-top: -60px;
        overflow: hidden;
        border: 3px solid #fff;
        border-radius: 50%;
    }
</style>
<section class="container mt-lg-0 mt-0 pb-1">

    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue"></h4>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Beranda</a></li>
                    <li class="breadcrumb-item "><a href="#">Bank Data</a></li>

                </ol>
            </nav>
        </div>
    </div> -->
</section>

<section class="container pb-0">
    <div class="card p-3">
        <div class="row article-container pb-5">

            <div class="col-md-12 px-md-5">
                <div class="article-detail mb-0">
                    <h1 class="text-blue montserrat-700 f-30 text-center">Daftar Pegawai </h1>
                    <hr>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsikasmedia" />
                    <div class="gen-section">

                        <?php if ($pegawai) {
                        ?>

                            <div class="row text-center">
                                <?php
                                foreach ($pegawai as $data) :
                                    $pot    = substr(esc($data['nama']), 0, 22);
                                    $potjab = substr(esc($data['jabatan']), 0, 31);
                                ?>
                                    <div class="col-md-4 mb-3 mb-md-3">
                                        <div class="card testimonial-card shadow-lg" style="border-style: solid; border-color: #fbc2eb;">
                                            <div class="card-up gradient-custom-2"></div>
                                            <!-- <div class="card-up" style="background-color: #9d789b;"></div> -->
                                            <div class="avatar mx-auto bg-white">
                                                <img src="<?= base_url('/public/img/informasi/pegawai/' . esc($data['gambar'])) ?>" class="rounded-circle img-fluid" style="width: 180px;" />
                                            </div>
                                            <div class="card-body">
                                                <strong><a style="font-size: 20px;"><?= $pot ?></a></strong>
                                                <p class="mb-2 pb-1" style="color: #2b2a2a;"><?= $potjab ?></p>
                                                <hr />

                                                <button type="button" class="btn btn-primary btn-rounded btn-sm" onclick="lihatpegawai('<?= $data['pegawai_id'] ?>')">
                                                    Lihat Detail
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                            <?php if ($jum > 6) { ?>
                                <br>
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

            <!-- Team End -->

        </div>
    </div>

</section>

<?= $this->endSection() ?>