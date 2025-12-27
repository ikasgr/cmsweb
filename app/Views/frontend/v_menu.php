<?php
$db = \Config\Database::connect();

use App\Models\ModelBanner;

$this->banner = new ModelBanner();
$iklanatas = $this->banner->listiklanatasran();
?>
<?= $this->extend('frontend/desktop' . '/template-frontend') ?>
<?= $this->section('v_menu') ?>

<style>
    /* Modern Church UI Variables */
    :root {
        --church-primary: #101820;
        /* Deep Dark Blue/Black */
        --church-gold: #D4AF37;
        /* Gold accent */
        --church-light: #F9FAFB;
        --church-white: #FFFFFF;
        --church-text: #374151;
        --font-heading: 'Montserrat', sans-serif;
        --font-body: 'Open Sans', sans-serif;
    }

    body {
        font-family: var(--font-body);
        color: var(--church-text);
        background-color: var(--church-light);
    }

    /* Top Bar Styling */
    #topbar {
        background-color: var(--church-primary) !important;
        border-bottom: 2px solid var(--church-gold);
        border-top: none !important;
        color: var(--church-white) !important;
        font-size: 0.9rem;
        padding: 8px 0 !important;
    }

    #topbar a {
        color: var(--church-white);
        transition: 0.3s;
    }

    #topbar a:hover {
        color: var(--church-gold);
    }

    /* Header & Navbar */
    #header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        padding: 15px 0;
        transition: all 0.3s;
    }

    #header.fixed-top {
        padding: 10px 0;
    }

    .logo span {
        color: var(--church-primary) !important;
        font-family: var(--font-heading);
        font-weight: 700;
        letter-spacing: 1px;
    }

    /* Navbar Links */
    .navbar ul li a {
        color: var(--church-primary);
        font-family: var(--font-heading);
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        padding: 10px 15px;
        transition: 0.3s;
    }

    .navbar ul li a:hover,
    .navbar ul li.active>a {
        color: var(--church-gold) !important;
    }

    /* Dropdown */
    .navbar ul ul {
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        border: none;
        padding: 10px 0;
    }

    .navbar ul ul li a {
        text-transform: capitalize;
        font-weight: 500;
    }

    /* Social Icons */
    .header-social-links a {
        color: var(--church-primary);
        padding: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: 0.3s;
        margin-left: 5px;
    }

    .header-social-links a:hover {
        background-color: var(--church-primary);
        color: var(--church-gold);
        transform: translateY(-2px);
    }

    /* Mobile Toggle */
    .mobile-nav-toggle {
        color: var(--church-primary);
    }
</style>

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

<!-- Modern Topbar -->
<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-clock me-2 text-warning"></i> &nbsp;<span id="jam"></span> &nbsp;|&nbsp;
            <i class="bi bi-calendar-check me-2 text-warning"></i> &nbsp;
            <script>document.write(tanggallengkap);</script>
        </div>

        <div class="d-none d-md-flex align-items-center">
            <?php if ($iklanatas) {
                foreach ($iklanatas as $key => $value) { ?>
                    <a href="<?= esc($value['link']) ?>" target="_blank" class="ms-3">
                        <small><i class="bi bi-info-circle text-warning"></i> Info Gereja</small>
                    </a>
                <?php }
            } ?>
        </div>
    </div>
</section>
<header id="header" class="header d-flex align-items-center">
    <div class="container d-flex align-items-center float-right">

        <h1 class="logo me-auto d-none d-md-none d-lg-block"><a href="<?= base_url('') ?>"><span
                    class=" text-light"><?= strtoupper(esc($konfigurasi->namasingkat)) ?></span></a></h1>
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
                        <li class="list-unstyled ml-0"><a target="<?= $utama['target'] ?>" href="<?= $linkutm ?>" class="">
                                <?= esc($utama['nama_menu']) ?> </a></li>
                        <?php
                    }

                    $set = $db->table('submenu')->where('menu_id', $menu_id)->where('stssubmenu', 1)->orderBy('urutansm', 'ASC')->get()->getResultArray();
                    if ($utama['parent'] == 'Y') { ?>
                        <li class="list-unstyled ml-0 dropdown"><a href="#"><?= esc($utama['nama_menu']) ?> <i
                                    class="bi bi-chevron-down"></i></a>
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
                                        <li class="list-unstyled ml-0 dropdown"><a target="<?= $submenu['targetsm'] ?>"
                                                href="<?= ($linksm) ?>"><?= esc($submenu['nama_submenu']) ?> <i
                                                    class="bi bi-chevron-right"></i></a>
                                            <ul>

                                                <!-- loop subsub -->
                                                <?php foreach ($setsubsub as $subsubmenu) {
                                                    if ($subsubmenu['linkexternalssm'] == 'N') {
                                                        $linkssm = base_url(esc($subsubmenu['link_subsubmenu']));
                                                    } else {
                                                        $linkssm = esc($subsubmenu['link_subsubmenu']);
                                                    }
                                                    ?>
                                                    <li class="list-unstyled ml-0"><a target="<?= $subsubmenu['targetssm'] ?>"
                                                            href="<?= ($linkssm) ?>"> <?= esc($subsubmenu['nama_subsubmenu']) ?> </a> </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <!-- else -->
                                    <?php } else { ?>
                                        <li class="list-unstyled ml-0"><a target="<?= $submenu['targetsm'] ?>"
                                                href="<?= ($linksm) ?>"><?= esc($submenu['nama_submenu']) ?></a></li>
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

            <a href="<?= base_url('donasi') ?>" class="btn btn-warning btn-sm ml-3 d-none d-lg-block"
                style="color: #000; font-weight: 700;">
                <i class="bi bi-heart-fill"></i> PERSEMBAHAN
            </a>
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
        if (jam_div) {
            jam_div.innerHTML = jam + ":" + menit + ":" + detik;
        }
        setTimeout("jam()", 1000);
    }
    jam();
</script>

<script type='text/javascript'>
    $(document).ready(function () {
        var touch = $('#resp-menudge');
        var menudge = $('.menudge');

        $(touch).on('click', function (e) {
            e.preventDefault();
            menudge.slideToggle();
        });

        $(window).resize(function () {
            var w = $(window).width();
            if (w > 767 && menudge.is(':hidden')) {
                menudge.removeAttr('style');
            }
        });

    });


    $(window).scroll(function () {
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