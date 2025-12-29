<?= $this->extend('backend/' . 'template-backend');
$db = \Config\Database::connect();

$userid = session()->get('id');
$id_grup = session()->get('id_grup');

$list = $db->table('users')->where('id', $userid)->get()->getRowArray();

use App\Models\ModelBerita;
use App\Models\M_Ikasmedia_grupakses;
use App\Models\ModelKritikSaran;
use App\Models\ModelBeritaKomen;

$this->setnewdata = new ModelBerita();
$this->grupakses = new M_Ikasmedia_grupakses();
$this->komen = new ModelBeritaKomen();
$this->kritik = new ModelKritikSaran();
$jum = $this->setnewdata->totberitanew();
$totkritik = $this->kritik->totkritik();
$totkomen = $this->komen->totkomen();
$jnotif = $totkritik + $totkomen;

$gm = 'Pengaturan';
$listgrupakses = $this->grupakses->listgrupaksesmenu($id_grup);
$grupakses = $this->grupakses->grupaksessubmenu($id_grup, $gm);
$tadmin = ['sidebar_mode' => 0]; // Default static value


$urlkritik = 'kritiksaran/list';
$listgrupkritik = $this->grupakses->viewgrupakses($id_grup, $urlkritik);
$akseskritik = $listgrupkritik->akses;

$urlkomen = 'berita/all';
$listgrupkomen = $this->grupakses->viewgrupakses($id_grup, $urlkomen);
$akseskomen = $listgrupkomen->akses;


?>

<?= $this->section('nav') ?>

<!-- tombol -->
<div class="d-flex">
    <?php
    if ($totkomen == 1) {
        # code...
    } else {
    }
    ?>
    <!-- full screen -->
    <div class="dropdown d-none d-lg-inline-block ms-1">
        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
            <i class="mdi mdi-fullscreen"></i>
        </button>
    </div>
    <!-- shortcut -->
    <?php
    if ($grupakses) { ?>
        <div class="dropdown d-lg-inline-block">
            <button type="button" class="btn header-item noti-icon waves-effect" id="dge" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-widgets-outline font-size-20"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-2">
                <!-- <div class="row"> -->
                <div class="icon-demo-content row row-cols-5 p-1">

                    <div class="col text-center pt-0 pb-0 pointer">
                        <a href="<?= base_url('konfigurasi') ?>" data-bs-toggle="tooltip" data-placement="top"
                            title="Konfigurasi"> <i class="dripicons-gear"></i></a>
                    </div>
                    <div class="col text-center pt-0 pb-0 pointer">
                        <a href="<?= base_url('halaman') ?>" data-bs-toggle="tooltip" data-placement="top" title="Halaman">
                            <i class="dripicons-to-do"></i></a>
                    </div>
                    <div class="col text-center pt-0 pb-0 pointer">
                        <a href="<?= base_url('menu') ?>" data-bs-toggle="tooltip" data-placement="top" title="Menu"> <i
                                class="dripicons-network-3"></i></a>
                    </div>
                    <div class="col text-center pt-0 pb-0 pointer">
                        <a href="<?= base_url('banner') ?>" data-bs-toggle="tooltip" data-placement="top" title="Banner"> <i
                                class="dripicons-photo-group"></i></a>
                    </div>
                    <div class="col text-center pt-0 pb-0 pointer">
                        <a href="<?= base_url('sambutan') ?>" data-bs-toggle="tooltip" data-placement="top"
                            title="Sambutan"> <i class="dripicons-microphone"></i></a>
                    </div>
                    <div class="col text-center pt-0 pb-0 pointer">
                        <a href="<?= base_url('pegawai/all') ?>" data-bs-toggle="tooltip" data-placement="top"
                            title="Data Pegawai"> <i class="mdi mdi-account-box-multiple"></i></a>
                    </div>
                    <div class="col text-center pt-0 pb-0 pointer">
                        <a href="<?= base_url('infografis/all') ?>" data-bs-toggle="tooltip" data-placement="top"
                            title="Infografis"> <i class="fab fa-slideshare"></i></a>
                    </div>
                    <div class="col text-center pt-0 pb-0 pointer">
                        <a href="<?= base_url('linkterkait') ?>" data-bs-toggle="tooltip" data-placement="top"
                            title="Link terkait"> <i class="mdi mdi-link-variant-plus"></i></a>
                    </div>
                    <div class="col text-center pt-0 pb-0 pointer">
                        <a href="<?= base_url('video/all') ?>" data-bs-toggle="tooltip" data-placement="top"
                            title="Galeri Video"> <i class="mdi mdi-youtube-subscription"></i></a>
                    </div>
                    <div class="col text-center pt-0 pb-0 pointer">
                        <a href="<?= base_url('foto/all') ?>" data-bs-toggle="tooltip" data-placement="top"
                            title="Galeri Foto"> <i class="dripicons-camera"></i></a>
                    </div>
                </div>
                <!-- </div> -->

            </div>
        </div>
    <?php } ?>
    <!-- notifikasi -->
    <?php if ($akseskritik == 1 || $akseskomen == 1) { ?>
        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-bell-outline bx-tada"></i>
                <?php if ($jnotif != 0 && ($akseskritik == 1 || $akseskomen == 1)) { ?>
                    <span class="badge bg-danger rounded-pill"><?= $jnotif ?></span>
                <?php } ?>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                aria-labelledby="page-header-notifications-dropdown">
                <div class="p-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0"> Notifikasi </h6>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('berita/listkomen') ?>" data-bs-toggle="tooltip" data-placement="top"
                                title="Komentar Berita" class="btn btn-xs btn-light btn-sm"><i
                                    class="ti-comment-alt me-1 text-primary"></i></a>
                            <a href="<?= base_url('kritiksaran/list') ?>" data-bs-toggle="tooltip" data-placement="top"
                                title="Kritik dan Saran" class="btn btn-xs btn-light btn-sm"><i
                                    class="ti-comments me-1 text-danger"></i></a>
                            <!-- <a href="<?= base_url('berita/listkomen') ?>" class="small"> <i class="ti-comment-alt"></i> dan Kritik Saran</a> -->
                        </div>
                    </div>
                </div>
                <div data-simplebar style="max-height: 230px;">
                    <?php if ($totkomen != 0 && $akseskomen == 1) { ?>
                        <div class="viewdatakomen"></div>
                    <?php } ?>

                    <?php if ($totkritik != 0 && $akseskritik == 1) { ?>
                        <div class="viewdata2"></div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="p-2 border-top text-center">
                        <!-- <a class="btn btn-sm btn-link font-size-14 w-100 text-center" href="<?= base_url('berita/listkomen') ?>">
                        <i class="mdi mdi-arrow-right-circle me-1"></i> View More Komen..
                    </a> -->
                        <a data-bs-toggle="tooltip" data-placement="top" title="Lihat semua Komentar berita"
                            href="<?= base_url('berita/listkomen') ?>" class="btn btn-xs btn-light btn-sm"><i
                                class="mdi mdi-arrow-right-circle me-1 text-primary"></i> Lihat Komentar</a>
                        <a data-bs-toggle="tooltip" data-placement="top" title="Lihat semua Kritik dan Saran"
                            href="<?= base_url('kritiksaran/list') ?>" class="btn btn-xs btn-light btn-sm"><i
                                class="mdi mdi-arrow-right-circle me-1 text-primary"></i> Lihat Masukan Saran </a>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>
    <!-- user profile -->
    <?php
    if (esc($list['user_image']) != 'default.png' && file_exists('public/img/user/' . esc($list['user_image']))) {
        $profil = esc($list['user_image']);
    } else {
        $profil = 'default.png';
    }
    ?>
    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle header-profile-user" src="<?= base_url('/public/img/user/' . $profil) ?>"
                alt="Header Avatar">
            <span class="d-none d-xl-inline-block ms-1"><?= esc($list['fullname']) ?></span>
            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <a class="dropdown-item" href="<?= base_url('akun') ?>"><i
                    class="mdi mdi-account-circle-outline font-size-16 align-middle me-1"></i> Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger pointer" id="logout"><i
                    class="mdi mdi-power font-size-16 align-middle me-1 text-danger"></i> Logout</a>
        </div>
    </div>
    <!-- end user -->

</div>


<?= $this->endSection('nav') ?>

<?= $this->section('menu') ?>
<li>
    <a href="<?= base_url('dashboard') ?>" class="waves-effect">
        <i class="dripicons-home"></i><span class="badge rounded-pill bg-info float-end">Home</span>
        <span>DASHBOARD</span>
    </a>
</li>
<!-- <li class="menu-title"><b> Kelola Modul</b></li> -->

<?php
foreach ($listgrupakses as $data):

    $aksesmenu = $data['aksesmenu'];
    $namamenu = esc($data['modul']);
    $gm = esc($data['gm']);
    if ($aksesmenu = 1) {

        ?>
        <?php if ($gm == 'Pengaturan') {
            ?>
            <li class="menu-title"><b> Pengaturan Situs</b></li>
        <?php } ?>
        <li>
            <a href="javascript:void(0);" class="has-arrow waves-effect "><i class="<?= esc($data['ikonmn']) ?>"></i> <span>
                    <?= $namamenu ?> </span> </a>
            <ul class="sub-menu " aria-expanded="false">
                <?php
                $listgrupf = $this->grupakses->grupaksessubmenu($id_grup, $gm);
                foreach ($listgrupf as $datacek):
                    $akses = $datacek['akses'];
                    $linkurl = esc($datacek['urlmenu']);

                    if ($akses != 3) { ?>

                        <?php if ($linkurl == 'berita/all') { ?>
                            <li class="">
                                <a href="<?= base_url(esc($datacek['urlmenu'])) ?>">
                                    <?php if ($akses == 1) {
                                        if ($jum != '0') { ?>
                                            <span class="badge rounded-pill bg-danger float-end"
                                                title="Jumlah berita yang menunggu verifikasi"><?= $jum ?></span>
                                        <?php }
                                    }
                                    ?>                     <?= esc($datacek['modul']) ?>
                                </a>
                            </li>
                        <?php } else {
                            ?>
                            <li><a href="<?= base_url(esc($datacek['urlmenu'])) ?>" class=""> <?= esc($datacek['modul']) ?></a></li>
                        <?php } ?>
                    <?php }
                endforeach;
                ?>

            </ul>
        </li>
        <!--    end menu -->
        <?php
    }
endforeach; ?>

<li>
    <a class="pointer <?= $tadmin['sidebar_mode'] == 0 ? 'dropdown-item' : '' ?> " data-bs-toggle="modal"
        data-bs-target="#petunjuk" data-bs-backdrop="static"><i class="dripicons-headset"></i> <span>SUPPORT </span></a>
</li>

<li>
    <a class="<?= $tadmin['sidebar_mode'] == 0 ? 'dropdown-item' : '' ?> text-danger" href="#" id="logout"><i
            class="fas fa-power-off text-danger"></i> <span><b>KELUAR</b> </span></a>
</li>

<?= $this->endSection('menu') ?>