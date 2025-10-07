<?php
$db = \Config\Database::connect();

use App\Models\ModelBanner;

$this->banner = new ModelBanner();
$iklanatas      = $this->banner->listiklanatasran();
?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->section('v_menu') ?>

<script language="JavaScript">
    var tanggallengkap = new String();
    var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
    namahari = namahari.split(" ");
    var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
    namabulan = namabulan.split(" ");
    var tgl = new Date();
    var hari = tgl.getDay();
    var tanggal = tgl.getDate();
    var bulan = tgl.getMonth();
    var tahun = tgl.getFullYear();
    tanggallengkap = namahari[hari] + ", " + tanggal + " " + namabulan[bulan] + " " + tahun + ", ";
</script>

<!-- <section id="topbar" class="topbar d-flex align-items-center" style="padding:1px; border-top:3px solid #FFA500;background-image: url('<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/datagoe.jpg') ?>');"> -->
<section id="topbar" class="topbar d-flex align-items-center" style="padding:1px; border-top:3px solid #FFA500;background-color: #f1f1f1;">
    <div class="container d-flex justify-content-center justify-content-md-between">

        <div class="container align-items-center p-1">
            <div class="row">
                <div class="col-md-5">
                    <?php if (file_exists('public/img/konfigurasi/logo/' . esc($konfigurasi->logo))) {
                        $logo = esc($konfigurasi->logo);
                    } else {
                        $logo = 'default.png';
                    }
                    ?>
                    <a href="<?= base_url() ?>">
                        <img class="d-block img-fluid" src="<?= base_url('/public/img/konfigurasi/logo/' . $logo) ?>" alt="logo">
                    </a>
                </div>

                <div class="d-none d-sm-block col-lg-7 float-right" style="text-align: center;">
                    <!-- iklan -->
                    <?php if ($iklanatas) { ?>
                        <div class="col-md-12 text-center">
                            <?php
                            foreach ($iklanatas as $key => $value) {
                            ?>

                                <a href="<?= esc($value['link']) ?>" target="_blank">
                                    <img class="d-none d-md-none d-lg-block img-fluidx rounded" src="<?= base_url('public/img/banner/' . esc($value['banner_image'])) ?>" alt="<?= esc($value['ket']) ?>" height="90" width="620">
                                </a>

                            <?php } ?>

                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<header id="header" class="header d-flex align-items-center">
    <div class="container d-flex align-items-center float-right">

        <h1 class="logo me-auto d-none d-md-none d-lg-block"><a href="<?= base_url('') ?>"><span class=" text-light"><?= strtoupper(esc($konfigurasi->namasingkat)) ?></span></a></h1>
        <!-- <a href="<?= base_url() ?>" class="logo me-auto me-lg-0"><img src="<?= base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)) ?>" alt="" class="img-fluid"></a> -->
        <h6 class="d-block d-sm-none logo me-auto text-light">
            <span><?= strtoupper(esc($konfigurasi->namasingkat)) ?>
            </span>
        </h6>
        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <?php foreach ($mainmenu as $utama) {
                    $menu_id = $utama['menu_id'];
                    if ($utama['parent'] == 'N') {

                        if ($utama['linkexternal'] == 'N') {
                            $linkutm = base_url(esc($utama['menu_link']));
                        } else {
                            $linkutm = esc($utama['menu_link']);
                        }
                ?>
                        <li class="list-unstyled ml-0"><a target="<?= $utama['target'] ?>" href="<?= $linkutm ?>" class=""> <?= esc($utama['nama_menu']) ?> </a></li>
                    <?php
                    }

                    $set = $db->table('submenu')->where('menu_id', $menu_id)->where('stssubmenu', 1)->orderBy('urutansm', 'ASC')->get()->getResultArray();
                    if ($utama['parent'] == 'Y') { ?>
                        <li class="list-unstyled ml-0 dropdown"><a href="#"><?= esc($utama['nama_menu']) ?> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <!-- loop sub -->
                                <?php foreach ($set as $submenu) {
                                    if ($submenu['linkexternalsm'] == 'N') {
                                        $linksm = base_url($submenu['link_submenu']);
                                    } else {
                                        $linksm = esc($submenu['link_submenu']);
                                    }

                                    if ($submenu['parentsm'] == 'Y') {
                                        $setsubsub = $db->table('subsubmenu')->where('submenu_id', $submenu['submenu_id'])->where('stsssm', 1)
                                            ->orderBy('urutanssm', 'ASC')->get()->getResultArray();
                                ?>
                                        <!-- jika subsub -->
                                        <li class="list-unstyled ml-0 dropdown"><a target="<?= $submenu['targetsm'] ?>" href="<?= ($linksm) ?>"><?= esc($submenu['nama_submenu']) ?> <i class="bi bi-chevron-right"></i></a>
                                            <ul>

                                                <!-- loop subsub -->
                                                <?php foreach ($setsubsub as $subsubmenu) {
                                                    if ($subsubmenu['linkexternalssm'] == 'N') {
                                                        $linkssm = base_url(esc($subsubmenu['link_subsubmenu']));
                                                    } else {
                                                        $linkssm = esc($subsubmenu['link_subsubmenu']);
                                                    }
                                                ?>
                                                    <li class="list-unstyled ml-0"><a target="<?= $subsubmenu['targetssm'] ?>" href="<?= ($linkssm) ?>"> <?= esc($subsubmenu['nama_subsubmenu']) ?> </a> </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <!-- else -->
                                    <?php } else { ?>
                                        <li class="list-unstyled ml-0"><a target="<?= $submenu['targetsm'] ?>" href="<?= ($linksm) ?>"><?= esc($submenu['nama_submenu']) ?></a></li>
                                <?php }
                                    // end loop sub
                                } ?>
                            </ul>
                        </li>

                        <!-- end sub -->
                    <?php
                    } ?>


                    <!-- end loop utm -->
                <?php

                } ?>
            </ul>
            <i class="bi bi-list mobile-nav-toggle float-right"></i>
        </nav><!-- .navbar -->



        <div class="header-social-links d-flex">

            <a data-toggle="modal" data-target="#modalcari" class="twitter pointer"><i class="bu bi-search"></i></a>
            <a href="<?= esc($konfigurasi->sosmed_twiter) ?>" class="twitter"><i class="bu bi-twitter"></i></a>
            <a href="<?= esc($konfigurasi->sosmed_fb) ?>" class="facebook"><i class="bu bi-facebook"></i></a>
            <a href="<?= esc($konfigurasi->sosmed_instagram) ?>" class="instagram"><i class="bu bi-instagram"></i></a>
            <a href="<?= esc($konfigurasi->sosmed_youtube) ?>" class="linkedin"><i class="bu bi-youtube"></i></i></a>
        </div>

    </div>
</header>


<script type='text/javascript'>
    function jam() {
        var waktu = new Date();
        var jam = waktu.getHours();
        var menit = waktu.getMinutes();
        var detik = waktu.getSeconds();

        if (jam < 10) {
            jam = "0" + jam;
        }
        if (menit < 10) {
            menit = "0" + menit;
        }
        if (detik < 10) {
            detik = "0" + detik;
        }
        var jam_div = document.getElementById('jam');
        jam_div.innerHTML = jam + ":" + menit + ":" + detik;
        setTimeout("jam()", 1000);
    }
    jam();
</script>

<script type='text/javascript'>
    $(document).ready(function() {
        var touch = $('#resp-menudge');
        var menudge = $('.menudge');

        $(touch).on('click', function(e) {
            e.preventDefault();
            menudge.slideToggle();
        });

        $(window).resize(function() {
            var w = $(window).width();
            if (w > 767 && menudge.is(':hidden')) {
                menudge.removeAttr('style');
            }
        });

    });


    $(window).scroll(function() {
        console.log($(window).scrollTop());
        if ($(window).scrollTop() > 100) {
            $('#header').addClass('fixed-top');
        }
        if ($(window).scrollTop() < 100) {
            $('#header').removeClass('fixed-top');
        }
    });
</script>
<?= $this->endSection('v_menu') ?>