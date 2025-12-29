<?php
$db = \Config\Database::connect();

$userid = session()->get('id');
$id_grup = session()->get('id_grup');

$list = $db->table('users')->where('id', $userid)->get()->getRowArray();

use App\Models\ModelBeritaKomen;
use App\Models\ModelKritikSaran;
use App\Models\M_Ikasmedia_grupakses;
use App\Models\ModelKonfigurasi;

$this->konfigurasi = new ModelKonfigurasi();
$this->komen = new ModelBeritaKomen();
$this->kritik = new ModelKritikSaran();
$this->grupakses = new M_Ikasmedia_grupakses();

$totkritik = $this->kritik->totkritik();
$totkomen = $this->komen->totkomen();
$konfigurasi = $this->konfigurasi->vkonfig();

// Default values since template system is removed
$tadmin = [
    'warna_topbar' => '#ffffff',
    'sidebar_mode' => 0
];

$urlkritik = 'kritiksaran/list';
$listgrupkritik = $this->grupakses->viewgrupakses($id_grup, $urlkritik);
$akseskritik = $listgrupkritik->akses;

$urlkomen = 'berita/all';
$listgrupkomen = $this->grupakses->viewgrupakses($id_grup, $urlkomen);
$akseskomen = $listgrupkomen->akses;

// header("Content-Security-Policy: connect-src 'self'; media-src 'self'; form-action 'self'; worker-src 'self'");
if (esc($list['user_image']) != 'default.png' && file_exists('public/img/user/' . esc($list['user_image']))) {
    $profil = esc($list['user_image']);
} else {
    $profil = 'default.png';
}
?>
<!DOCTYPE html>
<html lang="in">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= esc($title) ?> | <?= esc($subtitle) ?></title>
    <meta content="Control Web Panel CMS IKASMEDIA" name="Control Web Panel CMS IKASMEDIA" />
    <link rel="shortcut icon" href="<?= base_url('/public/img/konfigurasi/icon/' . esc($konfigurasi->icon)) ?>">
    <!-- Google Fonts - Inter for Modern Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Toast -->
    <link href="<?= base_url('/public/template/backend/assets/libs/toastr/toastr.css') ?>" rel="stylesheet"
        type="text/css" />
    <!-- jQuery  -->
    <script src="<?= base_url('/public/template/backend/assets/libs/jquery/jquery-3.7.1.min.js') ?>"></script>
    <link href="<?= base_url('/public/template/backend/assets/libs/sweetalert2/sweetalert2.min.css') ?>"
        rel="stylesheet" type="text/css" />
    <link href="<?= base_url('/public/template/backend/assets/css/bootstrap.min.css') ?>" rel="stylesheet"
        type="text/css">
    <link href="<?= base_url('/public/template/backend/assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('/public/template/backend/assets/css/app.min.css?v2') ?>" rel="stylesheet" type="text/css">
    <!-- Summernote css -->
    <link href="<?= base_url('/public/template/backend/assets/libs/summernote/summernote-lite.min.css') ?>"
        rel="stylesheet" type="text/css" />
    <link href="<?= base_url('/public/template/backend/assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet"
        type="text/css" />

</head>

<style>
    .pointer {
        cursor: pointer;
    }

    /* Mengubah warna teks untuk toastr sukses */
    .toast-success {
        color: #73b573;
        /* background-color: #75ba50; */
        background: rgba(76, 175, 80, 0.8);
        /* Ganti dengan warna background yang Anda inginkan */
    }

    /* Mengubah warna teks untuk toastr error */
    .toast-error {
        color: #dc3545;
        /* background-color: #e84545; */
        background: rgba(255, 99, 71, 0.8);
    }

    /* Mengubah warna teks untuk toastr info */
    .toast-info {
        color: #17a2b8;
        /* background-color: #7f82ff; */
        background: rgba(106, 90, 205, 0.8);
    }

    /* Mengubah warna teks untuk toastr warning */
    .toast-warning {
        color: #ffc107;
        /* background-color: #f2ad24; */
        background: rgba(255, 165, 0, 0.8);
    }
</style>

<body <?= esc($tadmin['warna_topbar']) == '#ffffff' ? '' : 'data-topbar="colored"' ?> <?= $tadmin['sidebar_mode'] == 0 ? '' : 'data-sidebar="dark"' ?>>

    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsikasmedia" />
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>


    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header shadow-sm" style="background-color:<?= esc($tadmin['warna_topbar']) ?>">

                <div class="d-flex">
                    <!-- LOGO -->

                    <div class="navbar-brand-box shadow-lg">
                        <a href="<?= base_url('dashboard') ?>" class="logo logo-dark">

                            <span class="logo-sm">
                                <img class="mt-1 ml-3 img-thumbnailx"
                                    src="<?= base_url('/public/img/konfigurasi/icon/' . esc($konfigurasi->icon)) ?>"
                                    alt="" height="40">
                            </span>

                            <span class="logo-lg">
                                <img class="pt-3"
                                    src="<?= base_url('/public/template/backend/assets/images/cwpv11.png') ?>" alt=""
                                    height="65">
                            </span>
                        </a>

                        <a href="<?= base_url('dashboard') ?>" class="logo logo-light ">
                            <span class="logo-sm">
                                <img src="<?= base_url('/public/img/konfigurasi/icon/' . esc($konfigurasi->icon)) ?>"
                                    alt="" height="30">
                            </span>
                            <span class="logo-lg pt-2">
                                <img src="<?= base_url('/public/template/backend/assets/images/cwpv11.png') ?>" alt=""
                                    height="50">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 mt-2 font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="mdi mdi-menu"></i>
                    </button>


                    <div class="topbar-social-icon me-3 d-none d-md-block">
                        <ul class="list-inline title-tooltip m-0">
                            <li class="list-inline-item media-body overflow-hidden">

                                <a class="btn btn-light btn-rounded waves-effect p-0 text-primary mt-1"
                                    href="<?= base_url() ?>" target=_blank alt="Kunjungi Situs">
                                    <i class="mdi mdi-monitor-multiple text-primary"></i> &nbsp; Kunjungi Situs &nbsp;
                                </a>
                            </li>

                        </ul>
                    </div>

                </div>

                <?= $this->renderSection('nav') ?>

            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu shadow-sm">
            <div data-simplebar class="h-100">
                <?php if ($tadmin['sidebar_mode'] == 1) { ?>

                    <div class="user-sidebar text-center">
                        <div class="dropdown">
                            <div class="user-img">
                                <img src="<?= base_url('/public/img/user/' . $profil) ?>" alt="" class="rounded-circle">
                                <span class="avatar-online bg-success"></span>
                            </div>
                            <div class="user-info">
                                <h5 class="mt-3 font-size-16 text-white"><?= esc($list['fullname']) ?></h5>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- menu samping -->
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <?= $this->renderSection('menu') ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">

            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>

        </div> <!-- content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © <?= esc($konfigurasi->nama) ?>.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Page rendered in <a class="text-danger">{elapsed_time}</a> seconds.
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>

</body>

<?= $this->renderSection('script') ?>

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<script src="<?= base_url('/public/template/backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('/public/template/backend/assets/libs/metismenu/metisMenu.min.js') ?>"></script>
<script src="<?= base_url('/public/template/backend/assets/libs/simplebar/simplebar.min.js') ?>"></script>
<script src="<?= base_url('/public/template/backend/assets/libs/node-waves/waves.min.js') ?>"></script>
<!-- Sweet Alerts js -->
<script src="<?= base_url('/public/template/backend/assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>
<!-- toast -->

<script src="<?= base_url('/public/template/backend/assets/js/app.js') ?>"></script>
<!-- Summernote js -->
<script src="<?= base_url('/public/template/backend/assets/libs/summernote/summernote-lite.min.js') ?>"></script>
<script src="<?= base_url('/public/template/backend/assets/libs/select2/js/select2.min.js?v2') ?>"></script>
<script src="<?= base_url('/public/template/backend/assets/libs/toastr/toastr.js') ?>"></script>
<script src="<?= base_url('/public/template/backend/assets/libs/toastr/ui-toasts.js') ?>"></script>
<script src="<?= base_url('/public/template/backend/assets/libs/chart.js/Chart.bundle.min.js') ?>"></script>

<div class="viewmodal"></div>

</html>

<script>
    $(document).ready(function () {
        <?php if ($totkritik != '0' && $akseskritik == 1) { ?>
            listkritiksaran2();
        <?php } ?>

        <?php if ($totkomen != '0' && $akseskomen == 1) { ?>
            listkomennew();
        <?php } ?>
    });

    function listkritiksaran2() {
        $.ajax({
            url: "<?= base_url('kritiksaran/getdatanew') ?>",
            dataType: "json",
            success: function (response) {
                $('.viewdata2').html(response.data);
            },
            error: function (xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Ada kesalahan Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                });
            }
        });
    }

    function listkomennew() {
        $.ajax({
            url: "<?= base_url('berita/getkomennew') ?>",
            dataType: "json",
            success: function (response) {
                $('.viewdatakomen').html(response.data);
            },
            error: function (xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Ada kesalahan Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                });
            }
        });
    }

    /** add active class and stay opened when selected */
    var url = window.location;
    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function () {
        return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-item-submenu a').filter(function () {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-item-submenu").addClass('menu-open').prev('a').addClass('active');
</script>


<div class="modal fade" id="petunjuk">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Informasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <div class="media">
                    <i class="mdi mdi-comment-quote text-primary h1"></i>
                    <div class="media-body ps-1">
                        <p class="text-muted font-italic">Terima kasih atas kepercayaan Anda, yang telah menggunakan
                            layanan kami..!
                            Panduan Penggunaan silahkan kunjungi Channel Youtube <a
                                href="https://www.youtube.com/playlist?list=PLa11gJo4z4Q90r53PD_tCJOSUl0JHQsjl"
                                target="_blank" class="alert-link">IKASMEDIA SOFTWARE</a>.
                            <br> Informasi lain dapat kunjungi situs resmi kami <a href="https://ikasmedia.com/"
                                target="_blank">ikasmedia.com</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-0">
                <button type="button" class="btn btn-secondary pull-left" data-bs-dismiss="modal">OK</button>
            </div>
        </div>

    </div>

</div>

<!--  Modal Awesome -->
<div class="modal fade fontawesome p-1" id="fontawesome" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Font Awesome</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <div class="card-body"> -->
                <ul class="nav nav-tabs pt-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#Solid1" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Solid</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#Regular1" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Regular</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#Brands1" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">Brands</span>
                        </a>
                    </li>

                </ul>
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="Solid1" role="tabpanel">
                        <p class="mb-0">
                        <p class="card-title-desc">Use <code>&lt;i class="fas fa-ad"&gt;&lt;/i&gt;</code> <span
                                class="badge bg-success">v 5.13.0</span>.</p>
                        <div class="row icon-demo-content" id="solid"></div>
                        </p>
                    </div>
                    <div class="tab-pane" id="Regular1" role="tabpanel">
                        <p class="mb-0">
                        <p class="card-title-desc mb-2">Use <code>&lt;i class="far fa-address-book"&gt;&lt;/i&gt;</code>
                            <span class="badge bg-success">v 5.13.0</span>.
                        </p>
                        <div class="row icon-demo-content" id="regular">
                        </div>
                        </p>

                    </div>
                    <div class="tab-pane" id="Brands1" role="tabpanel">
                        <p class="mb-0">
                        <p class="card-title-desc mb-2">Use <code>&lt;i class="fab fa-500px"&gt;&lt;/i&gt;</code> <span
                                class="badge bg-success">v 5.13.0</span>.</p>
                        <div class="row icon-demo-content" id="brand"></div>
                        </p>
                    </div>

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--  Modal MDI -->
<div class="modal fade mdideril p-0" id="mdideril" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Material Design</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row icon-demo-content" id="icons"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->