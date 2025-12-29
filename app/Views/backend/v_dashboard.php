<?= $this->section('content') ?>
<?= $this->extend('backend/script');
$db = \Config\Database::connect();
$userid = session()->get('id');
$list = $db->table('users')->where('id', $userid)->get()->getRowArray();

?>

<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsikasmedia" />
<!-- start page title -->
<div class="page-title-box pt-3">
    <div class="container-fluid">

    </div>
</div>

<div class="page-content-wrapper">

    <div class="row">

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-lg">
                <div class="card-body ">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-dark mb-1 fw-bold">BERITA</p>
                            <h3 class="font-22 fw-bold mb-0"><?= format_rupiah($beritaall['berita_id']) ?></h3>

                        </div>
                        <div class="mini-stat-icon mx-auto ">
                            <span class="avatar-title rounded-circle bg-soft-primary">
                                <i class="dripicons-article text-primary font-size-20"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top py-2">
                    <div class="text-truncate">
                        <span class="badge badge-soft-primary p-1 font-size-13">
                            <strong><?= format_rupiah($kategori['kategori_id']) ?></strong> </span>
                        <span class="text-muted ml-2"> Kategori</span>
                        &nbsp; <span class="dash-goal text-muted mr-8 font-size-13"> &nbsp; &nbsp;<span
                                class="badge badge-soft-primary p-1 font-size-13">
                                <strong><?= format_rupiah($tagar['tag_id']) ?> </strong> </span> Tagar </span>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-lg">
                <div class="card-body ">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-dark mb-1 fw-bold">LAYANAN</p>
                            <h3 class="font-22 fw-bold mb-0"><?= format_rupiah($totlayanan['informasi_id'] ?? 0) ?></h3>

                        </div>
                        <div class="mini-stat-icon mx-auto ">
                            <span class="avatar-title rounded-circle bg-soft-warning">
                                <i class="dripicons-to-do text-warning font-size-20"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top py-2">
                    <div class="text-truncate">
                        <a href="<?= base_url('layanan/all') ?>"> <span class="text-primary ml-2">Data Layanan <i
                                    class="mdi mdi-chevron-double-right text-primary font-size-13 py-21"></i></span></a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-lg">
                <div class="card-body ">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-dark mb-1 fw-bold">BANK DATA</p>

                            <h3 class="font-22 fw-bold mb-0"><?= format_rupiah($bankdata['bankdata_id'] ?? 0) ?></h3>

                        </div>
                        <div class="mini-stat-icon mx-auto ">
                            <span class="avatar-title rounded-circle bg-soft-secondary">
                                <i class="dripicons-wallet text-secondary font-size-20"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top py-2">
                    <div class="text-truncate">
                        <a href="<?= base_url('bankdata/all') ?>"> <span class="text-primary ml-2">Data Bank data <i
                                    class="mdi mdi-chevron-double-right text-primary font-size-13 py-21"></i></span></a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-lg">
                <div class="card-body ">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-dark mb-1 fw-bold">PENGUMUMAN</p>
                            <h3 class="font-22 fw-bold mb-0"><?= format_rupiah($totpengumuman['informasi_id'] ?? 0) ?>
                            </h3>

                        </div>
                        <div class="mini-stat-icon mx-auto ">
                            <span class="avatar-title rounded-circle bg-soft-success">
                                <i class="dripicons-broadcast text-success font-size-20"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top py-2">
                    <div class="text-truncate">
                        <a href="<?= base_url('pengumuman/all') ?>"> <span class="text-primary ml-2">Data Pengumuman <i
                                    class="mdi mdi-chevron-double-right text-primary font-size-13 py-21"></i></span></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-warning alert-dismissible fade show modern-alert" role="alert"
        style="border-radius: 12px; border-left: 4px solid #f39c12; background: linear-gradient(135deg, #fff9e6 0%, #fff5d6 100%); box-shadow: 0 2px 8px rgba(243, 156, 18, 0.1);">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="opacity: 0.6;">
        </button>
        <div class="d-flex align-items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-shield-alt" style="font-size: 24px; color: #f39c12; margin-right: 12px;"></i>
            </div>
            <div class="flex-grow-1">
                <h6 class="alert-heading mb-1" style="color: #d68910; font-weight: 600;">
                    <i class="fas fa-exclamation-circle"></i> Keamanan Penting!
                </h6>
                <p class="mb-0" style="color: #856404; font-size: 14px; line-height: 1.6;">
                    Jangan lupa untuk <strong>keluar (log out)</strong> dari aplikasi saat selesai menggunakan.
                    Ini untuk memastikan keamanan sistem tetap terjaga.
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8">

            <!-- grafik -->
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="viewtampilgrafik"></div>
                    </div>
                </div>
                <!-- bawah -->
            </div>
        </div>
        <!-- agenda -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="<?= base_url('agenda/all') ?>" class="dropdown-item">Lihat Semua</a>
                        </div>
                    </div>

                    <!-- <h5 class="card-title mb-1">Agenda Dinas</h5> -->
                    <h4 class="header-title mb-4">Agenda Dinas</h4>
                    <div data-simplebar style="max-height: 266px;">
                        <ul class="list-unstyled activity-wid mb-0 p-1 pb-0">
                            <?php
                            if ($agenda5) {
                                foreach ($agenda5 as $data): ?>
                                    <li class="activity-list activity-border">

                                        <div class="activity-icon avatar-sm">
                                                <img src="<?= image_url('informasi/agenda/' . esc($data['gambar']), 'public/img/', 'public/img/informasi/agenda/agenda128.png') ?>"
                                                    class="avatar-sm rounded-circle" alt="">
                                        </div>
                                        <div>
                                            <div>
                                                <h5 class="font-size-13"><?= date_indo($data['tgl_mulai']) ?> <small
                                                        class="text-muted"><?= esc($data['jam']) ?></small></h5>
                                            </div>

                                            <div>
                                                <p class="text-muted mb-0"><?= esc($data['tema']) ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach;
                            } else {
                                ?>
                                <div class="border-top text-center">
                                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                                        <strong>Opss..!</strong> Data Agenda tidak ditemukan..!
                                    </div>
                                    <img class="" src="<?= base_url('public/template/backend/assets/images/err.png') ?>"
                                        alt="not found" width="193" height="100%">
                                </div>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- </div> -->
    <div class="row">
        <div class="col-xl-8">
            <!-- berita populer -->
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="<?= base_url('berita/all') ?>" class="dropdown-item">Lihat Semua Berita</a>
                            <a href="<?= base_url('add-new') ?>" class="dropdown-item">Tambah Berita</a>
                        </div>
                    </div>
                    <h4 class="header-title mb-3">Berita terpopuler</h4>

                    <div data-simplebar style="max-height: 262px;">
                        <?php if ($beritapopuler) { ?>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 p-1">
                                    <tbody>
                                        <?php
                                        foreach ($beritapopuler as $data): ?>
                                            <tr>
                                                <td class="text-center"> <a href="<?= base_url(esc($data['slug_berita'])) ?>"
                                                        target="_blank"><img class="img-circle elevation-2"
                                                            src="<?= image_url('informasi/berita/' . esc($data['gambar'])) ?>"
                                                            width="50px"></td>
                                                <td>
                                                    <h8 class="mt-0"><a href="<?= base_url(esc($data['slug_berita'])) ?>"
                                                            target="_blank"><?= esc($data['judul_berita']) ?> <span
                                                                class="badge badge-pill badge-soft-danger font-size-12">(<?= $data['hits'] ?>)</span>
                                                            </h6>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="border-top text-center mt-3">
                                <img class="text-center"
                                    src="<?= base_url('public/template/backend/assets/images/err.png') ?>" alt="not found"
                                    width="200" height="100%">
                                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    Belum ada data berita populer..!
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- kritik saran -->
            <div class="card">

                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="<?= base_url('kritiksaran/list') ?>" class="dropdown-item">Lihat Semua</a>
                        </div>
                    </div>
                    <h4 class="header-title mb-3">Masukan dan Saran</h4>
                    <div class="mt-3 text-center">
                        <div class="row">
                            <div class="col-md-3">

                                <div class="mt-0 mt-sm-0">
                                    <!-- <div id="list-chart-1" class="apex-charts" dir="ltr"></div> -->
                                    <p class="text-muted mb-2 mt-0 pt-0"> <i
                                            class="mdi mdi-checkbox-multiple-blank-circle text-danger"></i> Pesan Baru:
                                    </p>
                                    <h5 class="font-size-18 mb-1"><?= format_rupiah($kritiknew['kritiksaran_id']) ?>
                                    </h5>
                                </div>
                            </div>

                            <div class="col-md-3 dash-goal">
                                <div class="mt-0 mt-sm-0">
                                    <p class="text-muted mb-2 mt-0 pt-0"><i
                                            class="mdi mdi-checkbox-multiple-blank-circle text-success"></i>
                                        Dipublikasi:</p>
                                    <h5 class="font-size-18 mb-1"><?= format_rupiah($kritikpublish['kritiksaran_id']) ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md-3 dash-goal">
                                <div class="mt-0 mt-sm-0">
                                    <p class="text-muted mb-2 mt-0 pt-0"><i
                                            class="mdi mdi-checkbox-multiple-blank-circle text-warning"></i> Tidak
                                        dipublish:</p>
                                    <h5 class="font-size-18  mb-1">
                                        <?= format_rupiah($kritikunpublish['kritiksaran_id']) ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md-3 dash-goal">

                                <div class="mt-0 mt-sm-0">
                                    <p class="text-muted mb-2 mt-0 pt-0"><i
                                            class="mdi mdi-checkbox-multiple-blank-circle text-primary"></i> Total
                                        pesan:</p>
                                    <h5 class="font-size-18 mb-1"><?= format_rupiah($kritikall['kritiksaran_id']) ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($grupakses) { ?>
                        <div data-simplebar style="max-height: 240px;">
                            <?php if ($suaraanda) { ?>
                                <div class="table-responsive mt-3 border-top">
                                    <table class="table table-striped text-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th class="text-right">Pengirim</th>
                                                <th class="text-right">Topik</th>
                                                <th class="text-right">Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 0;
                                            foreach ($suaraanda as $value):
                                                $nomor++;

                                                if ($value['status'] == '0') {
                                                    $sts = '<span class="text-danger"> <i class="far fa-circle"></i> Baru</span>';
                                                } else if ($value['status'] == '1') {
                                                    $sts = '<span class="text-info"> <i class="fas fa-check-circle"></i> Ditanggapi</span>';
                                                } else if ($value['status'] == '2') {
                                                    $sts = '<span class="text-success"> <i class="far fa-check-circle "></i> Dipublikasi</span>';
                                                } else {
                                                    $sts = '<span class="text-warning"> <i class="fas fa-arrow-circle-right"> Belum ditanggapi</span>';
                                                }
                                                ?>
                                                <tr>
                                                    <td> <?= date_indo($value['tanggal']) ?></td>
                                                    <td class="tx-medium"> <?= esc($value['nama']) ?></td>
                                                    <td class="text-cyan"><a class="text-primary pointer" data-bs-toggle="tooltip"
                                                            data-placement="top"
                                                            title="<?= esc($value['isi_kritik']) ?>"><?= esc($value['judul']) ?></a>
                                                    </td>
                                                    <td class="tx-medium text-right"><?= ($sts) ?> </span></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <div class="border-top text-center pt-3">
                                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                                        </button>
                                        <strong>Opss..!</strong> Data Kritik saran tidak ditemukan..!
                                    </div>
                                    <img class="" src="<?= base_url('public/template/backend/assets/images/err.png') ?>"
                                        alt="not found" width="180" height="100%">
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="border-top text-center mt-3">
                            <!-- <img class="" src="<?= base_url('public/template/backend/assets/images/coming-soon.png') ?>" alt="ikasmedia" width="20%" height="100%"> -->
                            <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                Dapatkan produk berkualitas IKASMEDIA SOFTWARE lainnya, <a target="_blank"
                                    href="https://ikasmedia.com/">disini</a>..!
                            </div>
                        </div>
                    <?php } ?>
                </div><!-- card-body -->
            </div>
        </div>

        <div class="col-xl-4">
            <!-- info berita  -->
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-body pointer">
                            <div class="text-center">
                                <p class="font-size-16">Unpublish</p>
                                <div class="mini-stat-icon mx-auto mb-2 mt-2" data-bs-toggle="tooltip"
                                    data-placement="top" title="Berita yang tidak dipublikasi">
                                    <span class="avatar-title rounded-circle bg-soft-warning">
                                        <i class="mdi mdi-eye-off text-warning font-size-20"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-22"><?= format_rupiah($beritaunpublish) ?></h5>
                                <p class="text-muted">News unpublish</p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar progress-bar bg-warning" role="progressbar"
                                        style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-body pointer">
                            <div class="text-center">
                                <p class="font-size-16">Comments</p>
                                <div class="mini-stat-icon mx-auto mb-2 mt-2" data-bs-toggle="tooltip"
                                    data-placement="top" title="Berita yang dikomentari">
                                    <span class="avatar-title rounded-circle bg-soft-info">
                                        <i class="mdi mdi-comment text-info font-size-20"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-22"><?= format_rupiah($komentarberita) ?></h5>
                                <p class="text-muted">Dikomentari</p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar progress-bar bg-info" role="progressbar"
                                        style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">

                    <div class="mt-2 text-center">
                        <div class="row">
                            <div class="col-md-6 pointer" data-bs-toggle="tooltip" data-placement="top"
                                title="Berita yang dipublikasi">

                                <div class="mt-0 mt-sm-0">
                                    <!-- <div id="list-chart-1" class="apex-charts" dir="ltr"></div> -->
                                    <p class="text-muted mb-2 mt-0 pt-0"><i
                                            class="mdi mdi-eye-check font-size-15 text-success"></i> News Publish:</p>
                                    <h5 class="font-size-18 mb-1"><?= format_rupiah($beritapublish) ?></h5>
                                </div>
                            </div>

                            <div class="col-md-6 dash-goal pointer" data-bs-toggle="tooltip" data-placement="top"
                                title="Total berita yang telah dilihat">

                                <div class="mt-0 mt-sm-0">
                                    <p class="text-muted mb-2 mt-0 pt-0"><i
                                            class="mdi mdi-eye-settings font-size-15 text-primary"></i> News View:</p>
                                    <h5 class="font-size-18 mb-1"><?= format_rupiah($hitsberita) ?></h5>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- info cms -->
            <div class="card">
                <div class="viewonline"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        TampilGrafik();
        uponline();

    });

    function TampilGrafik() {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/TampilkanGrafik') ?>",
            data: {
                // [csrfToken]: csrfHash,
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
            },
            dataType: "json",

            beforeSend: function () {
                $('.viewtampilgrafik').html('<center><span class="spinner-border spinner-grow-sm text-center" role="status" aria-hidden="true"></span> <i>Loading...</i></center>');
            },

            success: function (response) {
                if (response.data) {
                    $('.viewtampilgrafik').html(response.data);
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
                if (response.csrf_tokencmsikasmedia) {
                    //update hash untuk proses error validation 
                    $('#csrfToken, #csrfRandom').val(response.csrf_tokencmsikasmedia);
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia); //dataSrc untuk random request token char (wajib)
                }
            },
            error: function (xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode ErrorXC: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    // showConfirmButton: false,
                    // timer: 3100
                }).then(function () {
                    // window.location = '';
                })
            }
        });
    }

    function uponline() {
        $.ajax({
            url: "<?= site_url('admin/getonline') ?>",
            dataType: "json",
            beforeSend: function () {
                $('.viewonline').html('<center><span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i></center>');
            },
            success: function (response) {
                $('.viewonline').html(response.data);
                $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                if (response.csrf_tokencmsikasmedia) {
                    //update hash untuk proses error validation 
                    $('#csrfToken, #csrfRandom').val(response.csrf_tokencmsikasmedia);
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia); //dataSrc untuk random request token char (wajib)
                }
            },

            error: function (xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Ada kesalahan Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    // showConfirmButton: false,
                    // timer: 3100
                });
            }
        });
    }
</script>

<style>
    /* Modern Card Hover Effects */
    .card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 12px;
        border: none;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
    }

    /* Stat Card Enhancements */
    .col-sm-6.col-xl-3 .card {
        position: relative;
        overflow: hidden;
    }

    .col-sm-6.col-xl-3 .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .col-sm-6.col-xl-3 .card:hover::before {
        transform: scaleX(1);
    }

    /* Icon Animation */
    .mini-stat-icon {
        transition: transform 0.3s ease;
    }

    .card:hover .mini-stat-icon {
        transform: scale(1.1) rotate(5deg);
    }

    /* Badge Pulse Effect */
    .badge-soft-primary,
    .badge-soft-warning,
    .badge-soft-secondary,
    .badge-soft-success {
        transition: all 0.2s ease;
    }

    .card:hover .badge-soft-primary,
    .card:hover .badge-soft-warning,
    .card:hover .badge-soft-secondary,
    .card:hover .badge-soft-success {
        transform: scale(1.05);
    }

    /* Modern Alert Animation */
    .modern-alert {
        animation: slideInDown 0.5s ease-out;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Chart Card Enhancement */
    .card-body {
        border-radius: 12px;
    }

    /* Link Hover Effect */
    .card-body a {
        transition: all 0.2s ease;
        position: relative;
    }

    .card-body a:hover {
        transform: translateX(3px);
    }

    /* Number Counter Animation */
    .font-22 {
        transition: color 0.3s ease;
    }

    .card:hover .font-22 {
        color: #667eea;
    }

    /* Smooth Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #764ba2 0%, #667eea 100%);
    }

    /* Button Close Enhancement */
    .btn-close {
        transition: all 0.2s ease;
    }

    .btn-close:hover {
        transform: rotate(90deg);
        opacity: 1 !important;
    }

    /* Avatar Title Enhancement */
    .avatar-title {
        transition: all 0.3s ease;
    }

    .card:hover .avatar-title {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
</style>



<?= $this->endSection() ?>