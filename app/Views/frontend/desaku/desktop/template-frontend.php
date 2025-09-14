<!-- =======================================================
      * CMS ikasmedia
      * Content Management System.
      *
      * @author			Vian Taum <viantaum17@gmail.com>
      * @website		www.ikasmedia.net
      * @copyright		(c) 2023 - ikasmedia Software
 ======================================================== -->

<?php

use App\Models\ModelTemplate;
use App\Models\ModelUser;

$this->user         = new ModelUser();
$this->template     = new ModelTemplate();
$pengunjungon       = $this->user->countOnlineVisitors();

$tadmin             = $this->template->tempadminaktif();
$uri                = service('uri');
$request            = $uri->getSegment(1);
?>
<!doctype html>
<html lang="in">

<head>
    <!-- SITE TITLE -->
    <meta name="description" content="<?= esc($konfigurasi->deskripsi) ?>">
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('/public/img/konfigurasi/icon/' . esc($konfigurasi->icon)) ?>">
    <title><?= esc($title) ?></title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="<?= esc($konfigurasi->nama) ?>" name="author">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="index,follow" name="googlebot">
    <meta name="robots" content="index,follow">
    <meta content="In-Id" http-equiv="content-language">
    <meta content="id" name="language">
    <meta content="id" name="geo.country">
    <meta content="Indonesia" name="geo.placename">
    <link rel="canonical" href="<?= base_url() ?>" />

    <!-- facebook META -->
    <meta property="fb:pages" content="140586622674265" />
    <meta property="fb:app_id" content="140586622674265" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?= esc($url) ?>">
    <meta property="og:title" content="<?= esc($title) ?>">
    <meta property="og:image" content="<?= esc($img) ?>">
    <meta property="og:site_name" content="<?= esc($konfigurasi->website) ?>">
    <meta property="og:description" content="<?= esc($deskripsi) ?>">
    <meta property="article:author" content="https://www.facebook.com/ikasmediasoftware/" />
    <meta property="article:publisher" content="https://www.facebook.com/ikasmediasoftware/" />
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">

    <!-- twitter card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@ikasmedia_wkc" />
    <meta name="twitter:creator" content="@ikasmedia_wkc">
    <meta name="twitter:title" content="<?= esc($title) ?>" />
    <meta name="twitter:description" content="<?= esc($deskripsi) ?>" />
    <meta name="twitter:image:src" content="<?= esc($img) ?>" />

    <!-- css_main -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/animate.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/library/slick-1.8.1/slick/slick.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/library/slick-1.8.1/slick/slick-theme.css') ?>">

    <style>
        /* HOMEPAGE - CATEGORY SLIDER */

        #category-slider {
            height: 180px;
            overflow: hidden;
        }

        #category-slider .slider-item:first-child {
            margin-left: 1px;
        }

        #category-slider .slick-list {
            margin-right: 60px;
        }

        #category-slider .slider-item {
            margin: 10px 10px;
            padding: 40px;
            box-shadow: 0px 1px 17px #DCDCDC;
            border-radius: 20px;
            display: flex;
            justify-content: center;
        }

        #category-slider .slider-item img {
            height: 90px;
        }

        #category-slider .slider-item span {
            position: absolute;
            bottom: 0;
        }

        #category-slider .slider-item:hover {
            border: 1px solid #ddd;
            padding: 34px;
        }

        #category-slider .carousel-controls {
            padding: 30px 0 90px 20px;
            background: #FFF;
            position: absolute;
            right: 0;
            top: 0;
        }
    </style>
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/fonts.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/small.layout.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/desa.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/menu.css?v1') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/mediumish.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/beranda.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/ikasmedia.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/dge.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/owl.theme.default.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/library/flaticon/font/flaticon.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/library/magnific-popup/magnific-popup.css') ?>">

    <link href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/vendors/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/vendors/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">

    <link href="<?= base_url('/public/template/backend/' . esc($tadmin['folder']) . '/assets/css/icons.css') ?>" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/css/dataTables.bootstrap4.min.css') ?>">
    <script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/sweetalert2.js') ?>"></script>
    <script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/jquery-3.7.1.min.js') ?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>
        .pointer {
            cursor: pointer;
        }

        .tipe {
            position: absolute;
            /* text-transform: uppercase; */
            font-weight: bold;
            font-size: 0.8rem;
            top: 3%;
            left: 5%;
            border-radius: 100px;
        }

        .tipe_inline {
            /* text-transform: uppercase; */
            font-weight: bold;
            font-size: 0.8rem;
            border-radius: 100px;
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.85);
            z-index: 99999;
            transition: all 500ms ease;
            -webkit-transition: all 500ms ease;
        }

        .preloader.out {
            opacity: 0;
            visibility: hidden;
            transition-delay: 1s;
        }

        .loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            transition: all 500ms ease;
            -webkit-transition: all 500ms ease;
            transition-delay: 0.8s;
        }

        .preloader.out .loader {
            transform: translate(-50%, -100%);
            -webkit-transform: translate(-50%, -100%);
            opacity: 0;
        }

        .preloader.out .loader:before {
            border-color: #fff;
            transition-delay: 0.2s;
        }

        .loader img {
            position: relative;
            transition: all 500ms ease;
            -webkit-transition: all 500ms ease;
        }

        .loader:before {
            content: "";
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            width: 150px;
            height: 150px;
            background: #222;
            border: 5px solid rgba(255, 255, 255, 0.1);
            border-top: 5px solid #fff;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            animation: preloaderAnimation 1s linear infinite;
            -webkit-animation: preloaderAnimation 1s linear infinite;
            transition: all 500ms ease;
            -webkit-transition: all 500ms ease;
        }

        @keyframes preloaderAnimation {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        @-webkit-keyframes preloaderAnimation {
            0% {
                -webkit-transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                -webkit-transform: translate(-50%, -50%) rotate(360deg);
            }
        }
    </style>

    <script>
        $(document).ready(function() {
            $(".preloader").fadeOut();
        })
    </script>
</head>

<body class="small-layoutx">
    <div class="preloader">
        <?php if (file_exists('public/img/konfigurasi/icon/' . esc($konfigurasi->icon))) {
            $logo = esc($konfigurasi->icon);
        } else {
            $logo = 'default.png';
        }
        ?>
        <div class="loader"><img src="<?= base_url('/public/img/konfigurasi/icon/' . $logo) ?>" alt=""></div>
    </div>
    <!-- main menu  -->
    <?= $this->renderSection('v_menu') ?>
    <main id="main">
        <div class="d-none d-md-none d-lg-block" style="padding: 2px"></div>
        <div class="d-block d-md-none" style="padding: 2px"></div>
        <?= $this->renderSection('content') ?>
    </main>
    <!-- footer  -->

    <section class="">
        <!-- Footer -->
        <footer class="text-center text-white" style="background-color: #ddd;">
            <!-- Grid container -->
            <div class="container p-2 pb-0">

                <!-- <div class="section-title justify-content-center">
                    <h2>LINK TERKAIT</h2>
                </div> -->

                <p class="d-flex justify-content-center align-items-center">
                    <span class="me-3"><?php if ($linkterkaitall) { ?>
                            <div class="text-center text-md-center">
                                <?php
                                            foreach ($linkterkaitall as $datai) {
                                ?>
                                    <a target="_blank" href="<?= esc($datai['url']) ?>"><img width="60" class="mb-2 ml-2 mr-2" src="<?= base_url('public/img/linkterkait/' . esc($datai['gambar'])) ?>" /></a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </span>
                    </button>
                </p>
    </section>
    </footer>


    <!-- Grid container -->


    <footer class="bg-dark">

        <div class="bg-darker py-3">
            <div class="container text-center text-light">
                <div style="color:#fff; text-indent: 0%; ">

                    <?php foreach ($footer as $menu) { ?>

                        <?php
                        if ($menu['linkexternal'] == 'N') { ?>
                            <a class="text-light mb-1" target="<?= $menu['target'] ?>" href="<?= base_url(esc($menu['menu_link'])) ?> " style="font-size: 14px;"> <i class="<?= esc($menu['icon']) ?>"></i> <?= esc($menu['nama_menu']) ?> | </a>

                        <?php } else { ?>
                            <a class="text-light mb-1" target="<?= $menu['target'] ?>" href="<?= esc($menu['menu_link']) ?>" style="font-size: 14px;"> <i class="<?= esc($menu['icon']) ?>"></i> <?= esc($menu['nama_menu']) ?> | </a>
                    <?php  }
                    } ?>
                    <a style="font-size: 14px;color:#fff;"> &copy; <?= date('Y') ?> - <?= esc($konfigurasi->nama) ?> </a>
                    <br>

                    <i> <a style="font-size: 14px;color:#fff;"> <?= preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $konfigurasi->footer_cms) ?> </a>
                    </i>
                    &nbsp;| <a class="pb-0" style="font-size: 14px;color:#fff; padding-bottom: 0pt;"><span class="mb-0">Online: <b><?= $pengunjungon ?> </b> Orang</span></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer -->
    </section>


    <div class="d-lg-none footer-navbardge mt-10">

        <div id="buttonGroup" class="btn-group selectorsdge ">
            <button type="button" class="btn btn-info ">
                <a href="<?= base_url() ?>" class=" button-activex shadow-lg">
                    <div class="selectordge-holder p-0">
                        <i class="mdi mdi-home" style="font-size:14pt;"></i>
                        <div class=""><span>Home</span></div>
                    </div>
                </a>
            </button>

            <button type="button" class="btn btn-light">
                <a href="<?= base_url('layanan') ?>" class="">
                    <div class="selectordge-holder">
                        <i class="mdi mdi-buffer" style="font-size:14pt;"></i>
                        <div class=""><span>Layanan</span></div>
                    </div>
                </a>
            </button>

            <button type="button" class="btn btn-light">
                <a href="<?= base_url('berita') ?>" class="">
                    <div class="selectordge-holder">
                        <i class="mdi mdi-newspaper" style="font-size:14pt;"></i>
                        <div class=""><span>Berita</span></div>
                    </div>
                </a>
            </button>

            <button type="button" class="btn btn-light">
                <a href="<?= base_url('masukansaran') ?>" class="">
                    <div class="selectordge-holder">
                        <i class="mdi mdi-comment-text-multiple" style="font-size:14pt;"></i>
                        <div class=""><span>Kontak</span></div>
                    </div>
                </a>
            </button>
        </div>
    </div>


    <div class="viewdata"></div>
    <div class="viewmodal"></div>

    <?= $this->include('/backend/' . esc($tadmin['folder']) . '/modal/getjs'); ?>

    <script>
        $(function() {

            var url = window.location.pathname,
                urlRegExp = new RegExp(url.replace(/\/$/) + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
            // now grab every link from the navigation
            $('.menu a').each(function() {
                // and test its normalized href against the url pathname regexp
                if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
                    $(this).addClass('active');
                }
            });

        });
    </script>

    <script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/library/wow/wow.min.js') ?>"></script>

    <script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/bootstrap.bundle.js') ?>"></script>
    <script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/main.js') ?>"></script>

    <script type="text/javascript" src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/jquery-lazy.min.js') ?>"></script>
    <!-- Datatable init js -->
    <script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/purecounter.js') ?>"></script>

    <script>
        $(window).on('load', function() {
            $('#loading').hide();
        });

        $(document).ready(function() {
            // Lazy load images
            $('.lazy').Lazy({
                placeholder: "/img/loader.gif"
            });


        });
    </script>

    <script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/library/slick-1.8.1/slick/slick.min.js') ?>"></script>

    <script>
        $(document).ready(function() {
            $('#big-slider').carousel();
            $('#jaki-slider').on('slide.bs.carousel', function onSlide(ev) {
                const id = $(ev.relatedTarget);
                $('[class*="captionidx-"]').addClass('d-none');
                $('.captionidx-' + id.data('captionidx')).removeClass('d-none');
            });

            $('#category-slider .slider').slick({
                centerPadding: '60px',
                slidesToShow: 4,
                infinite: false,
                prevArrow: $('.category-slider-prev'),
                nextArrow: $('.category-slider-next'),
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            centerMode: false,
                            centerPadding: '40px',
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            centerMode: false,
                            centerPadding: '0px',
                            slidesToShow: 2
                        }
                    }
                ]
            });

            $('#infographic-slider').slick({
                centerPadding: '60px',
                slidesToShow: 3,
                infinite: true,
                prevArrow: $('.infographic-slider-prev'),
                nextArrow: $('.infographic-slider-next'),
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            centerMode: false,
                            centerPadding: '40px',
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            centerMode: false,
                            centerPadding: '0px',
                            slidesToShow: 1
                        }
                    }
                ]
            });

            $('#foto-slider .slider').slick({
                centerPadding: '60px',
                slidesToShow: 4,
                infinite: false,
                prevArrow: $('.foto-slider-prev'),
                nextArrow: $('.foto-slider-next'),
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            centerMode: false,
                            centerPadding: '40px',
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            centerMode: false,
                            centerPadding: '0px',
                            slidesToShow: 2
                        }
                    }
                ]
            });
        });
    </script>
    <div class="modal fade" data-focus="true" id="modalcari" tabindex="-1" role="dialog" aria-labelledby="modalcari" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-search"></i> Pencarian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('cari') ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="jenis" value="berita">
                        <div class="input-group">
                            <input autofocus type="text" class="form-control" name="keyword" id="keyword" placeholder="Masukkan kata kunci..." required minlength="4" value="" />
                            <div class="input-group-append">
                                <button class="btn btn-primary">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if ($request == 'transparansi') {
    ?>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <?php } ?>
</body>


</html>