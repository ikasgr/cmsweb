<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>

<?= $this->section('content');

$db = \Config\Database::connect();

use App\Models\ModelSection;

$this->section = new ModelSection();
$section1 = $this->section->tampil_section($template_id, 1);
$section2 = $this->section->tampil_section($template_id, 2);
$section3 = $this->section->tampil_section($template_id, 3);
$section4 = $this->section->tampil_section($template_id, 4);

if ($section1) {
    $judul1     = esc($section1->nama_section);
    $isi1       = $section1->isi_script;
    $gambar1    = esc($section1->gambar);
} else {
    $judul1     = '-';
    $isi1       = 'Data tidak ditemukan';
    $gambar1    = '';
}

if ($section2) {
    $judul2     = esc($section2->nama_section);
    $isi2       = $section2->isi_script;
    $gambar2    = esc($section2->gambar);
} else {
    $judul2     = '-';
    $isi2       = 'Data tidak ditemukan';
    $gambar2    = '';
}

if ($section3) {
    $judul3     = esc($section3->nama_section);
    $isi3       = $section3->isi_script;
    $gambar3    = esc($section3->gambar);
} else {
    $judul3     = '-';
    $isi3       = 'Data tidak ditemukan';
    $gambar3    = '';
}

if ($section4) {
    $judul4     = esc($section4->nama_section);
    $isi4       = $section4->isi_script;
    $gambar4    = esc($section4->gambar);
} else {
    $judul4     = '-';
    $isi4       = 'Data tidak ditemukan';
    $gambar4    = '';
}



?>
<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsikasmedia" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">

<section class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if ($banner) {
            ?>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="list-unstyled ml-0 carousel-indicators">
                        <?php $no = 0;
                        foreach ($banner as $key => $value) { ?>
                            <li class="list-unstyled ml-0" data-target="#carouselExampleIndicators" data-slide-to="<?= $no++ ?>" class="<?= ($no == 1) ? 'active' : '' ?>"></li>

                        <?php } ?>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php $no = 0;
                        foreach ($banner as $key => $value) {
                            $no++
                        ?>
                            <div class="<?= ($no == 1) ? 'carousel-item active' : 'carousel-item' ?>">
                                <img class="d-block img-fluid p-0" src="<?= base_url('/public/img/banner/' . esc($value['banner_image'])) ?>" width="100%" alt="First slide">
                            </div>
                        <?php } ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            <?php } ?>

            <?php if ($konfigurasi->sts_rt == '1') { ?>
                <div id="pengumuman" class="pengumuman">
                    <div class="info-dinas-header mr-auto">
                        <span class="re-info">Pengumuman <i class="fas fa-bullhorn text-light"></i></span>
                    </div>
                    <div class="dinas-info">
                        <?php if ($pengumuman) {
                        ?>
                            <marquee onMouseOver="this.stop()" onMouseOut="this.start()" class="item">
                                <?php
                                foreach ($pengumuman as $key => $data) { ?>
                                    <span style="color:#f5f5f5;background:orange;padding:3px 5px;"><?= date_indo($data['tgl_informasi']) ?></span>
                                    <span class="pointer" onclick="lihatpengumuman('<?= $data['informasi_id'] ?>')"><?= esc($data['nama']) ?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                <?php } ?>
                            </marquee>
                        <?php  } else { ?>
                            <a class="text-center">
                                <span style="color:#f5f5f5;background:orange;padding:3px 5px;">Belum ada Pengumuman..!</span>
                            </a>
                        <?php } ?>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- ================================================== -->
    <!-- Begin List Desa
	================================================== -->
    <div class="container-fluid ">
        <div class="row ">
            <!-- section 1 count -->
            <?= $isi1 ?>

            <!-- section 2 jadwal -->
            <div class="col-lg-4 col-12 p-1 mt-3">
                <div class="justify-content-center mt-2">
                    <div class="card p-2 bg-grey border">
                        <div class="d-flex ">
                            <div class="w-100">
                                <h1 class="f-18 montserrat-800 text-blue"> <?= $judul2 ?> </h1>

                                <div class="p-2 mt-3 bg-blue d-flex justify-content-between rounded text-white stats">
                                    <?= $isi2 ?>
                                </div>
                                <div class="button mt-2 d-flex flex-row align-items-center"> <button class="btn btn-outline-success w-100"><a href="https://api.whatsapp.com/send?phone=<?= $konfigurasi->no_telp ?>">Hubungi</a> </button> <button class="btn btn-dark w-100 ml-2"><a href="<?= $konfigurasi->sosmed_twiter ?>">Follow</a></button> <button data-toggle="modal" data-target="#modalViewsambutan" class="btn btn-info w-100 ml-2">Sambutan</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</section>
<!-- ================================================== -->
<!-- Begin Menu Desa
	================================================== -->
<section class="container">

    <?php if ($konfigurasi->sts_section == '1') { ?>
        <div class="row">
            <div class="col-md-12">
                <!-- <h5 class="text-center mb-3">
                    <span class="text-info mx-2">&mdash;&mdash;&mdash;</span>
                    <?= esc($konfigurasi->judul_section) ?>
                    <span class="text-info mx-2">&mdash;&mdash;&mdash;</span>
                </h5> -->
                <section class="home-services pt-4">
                    <div id="layanan" style="margin-top: -225px; margin-bottom: 225px"></div>
                    <div class="row row-eq-height justify-content-center">
                        <?php foreach ($section as $data) {
                            $sumber = esc($data['linksumber']);

                            if ($sumber == 'N') {
                                $link = base_url(esc($data['link']));
                            } else {
                                $link = esc($data['link']);
                            }

                        ?>

                            <div class="col-lg-3 col-6 pb-2">
                                <div class="card-inner p-2 d-flex flex-column align-items-center">
                                    <a href="<?= $link ?>">
                                        <img class="" src="<?= base_url('/public/img/section/' . esc($data['gambar'])) ?>" width="50">
                                        <div class="text-center mg-text"> <span class="mg-text"><?= esc($data['nama_section']) ?></span> </div>
                                    </a>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </section>
            </div>
        </div>
    <?php } ?>
</section>
</div>


<!-- Begin Monografi  Desa
	================================================== -->

<br>
<section class="container">
    <div class="carousel slide" id="info-slider" data-ride="carousel">
        <div class="carousel-inner">
            <?php $no = 0;
            foreach ($beritautama as $key => $data) {
                $no++
            ?>

                <div class="<?= ($no == 1) ? 'carousel-item active' : 'carousel-item' ?>">
                    <!--slide-2-dst-->
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-md-5 p-0 pr-sm-3">
                                <a href="<?= base_url($data['slug_berita']) ?>" class="d-block text-decoration-none" target="_blank">
                                    <h1 class="f-22 montserrat-800 text-blue mb-2"><a href="<?= base_url($data['slug_berita']) ?>"><?= esc($data['judul_berita']) ?></a></h1>
                                </a>

                                <div class="metafooter">
                                    <div class="wrapfooter">
                                        <span class="meta-footer-thumb">
                                            <a href="<?= base_url('author/' . $data['id'] . '/' . esc($data['fullname'])) ?>"><img class="author-thumb" src="<?= base_url('public/img/user/' . esc($data['user_image'])) ?>" alt="Sal"></a>
                                        </span>
                                        <span class="author-meta">
                                            <span class="post-name"><a href="<?= base_url('author/' . $data['id'] . '/' . esc($data['fullname'])) ?>"><?= esc($data['fullname']) ?></a></span><br />
                                            <span class="post-date"><?= date_indo($data['tgl_berita']) ?></span><span class="dot"></span><span class="post-read"><?= esc($data['nama_kategori']) ?></span>
                                        </span>
                                        <span class="post-read-more"><a href="<?= base_url($data['slug_berita']) ?>" title="Read Story"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25">
                                                    <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                                                </svg></a></span>
                                    </div>
                                </div>
                                <!-- <p class="f-18 roboto-400"> -->
                                <h4 class="card-text" style="line-height: 1.8;"><?= esc($data['ringkasan']) ?></h4>

                            </div>
                            <div class="col-md-7 banner-list p-0 d-flex flex-wrap align-items-center justify-content-center">
                                <a href="<?= base_url($data['slug_berita']) ?>" target="_blank">
                                    <img src="<?= base_url('/public/img/informasi/berita/' . esc($data['gambar'])) ?>" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="carousel-controls position-relative text-center text-md-left">
            <a class="carousel-control-prev-icon mr-3" href="#info-slider" role="button" data-slide="prev" aria-hidden="true"></a>
            <a class="carousel-control-next-icon" href="#info-slider" role="button" data-slide="next" aria-hidden="true"></a>
        </div>
    </div>
    <!--==================================================-->
    <!-- Begin Data Tab Desa
	================================================== -->
    <section class="container-fluid p-0">

        <div class="row">
            <div class="col-lg-8 col-12">

                <br>

                <?php if ($konfigurasi->sts_count == '1') { ?>
                    <section class="content">
                        <div class="box p-2  border">
                            <h1 class="f-16 montserrat-800 text-blue p-1 border-bottom">
                                e-counter Data </h1>
                            <!-- Small boxes (Stat box) -->

                            <div class="row ">
                                <?php if ($counter) {
                                    foreach ($counter as $key => $value) {
                                ?>
                                        <div class="col-md-3 col-sm-6 col-6">

                                            <div class="small-box mb-2" style="background-color:<?= esc($value['bgc']) ?>;">
                                                <div class="inner">
                                                    <h3><span data-purecounter-start="0" data-purecounter-end="<?= $value['jm'] ?>" data-purecounter-duration="1" class="purecounter"></span></h3>
                                                    <p><?= esc($value['nm']) ?> </p>
                                                </div>
                                                <div class="icon">
                                                    <i class="<?= esc($value['ic']) ?>"></i>
                                                </div>
                                                <a href="<?= esc($value['link']) ?>" class="small-box-footer"><small> <?= esc($value['sumber']) ?> </small></a>
                                            </div>

                                        </div>

                                <?php }
                                } ?>
                            </div>
                        <?php } ?>
                        </div>
                    </section>


                    <div class="box mt-2">
                        <h1 class="f-20 montserrat-800 text-blue p-2  border-bottom">
                            Data Pegawai </h1>

                        <ul class="users-list clearfix">
                            <?php if ($pegawai) {
                                foreach ($pegawai as $data) :
                            ?>
                                    <li class="list-unstyled ml-0">
                                        <img src="<?= base_url('/public/img/informasi/pegawai/' . esc($data['gambar'])) ?>" alt="<?= esc($data['nama']) ?>" />
                                        <a class="users-list-name pointer" onclick="lihatpegawaix('<?= $data['pegawai_id'] ?>')"><?= esc($data['nama']) ?></a>
                                        <!-- <span class="users-list-date"><?= esc($data['jabatan']) ?></span> -->
                                    </li>
                                <?php endforeach;
                                ?>
                        </ul><!-- /.users-list -->

                        <div class="box-footer text-center">
                            <a href="pegawai" class="uppercase">Lihat semuanya</a>
                        </div><!-- /.box-footer -->
                    <?php  } else { ?>
                        <div class="alert alert-danger">
                            Belum ada data..!
                        </div>
                    <?php } ?>
                    </div>

                    <?php if ($iklantengah) { ?>
                        <?php $no = 0;
                        foreach ($iklantengah as $key => $value) {

                            $linkbn2 = (esc($value['link']));

                        ?>
                            <img class="img-fluid pb-2" src="<?= base_url('public/img/banner/' . esc($value['banner_image'])) ?>" alt="Card image cap">
                        <?php } ?>
                        <br>
                    <?php } ?>

                    <div class="d-flex justify-content-between align-items-center breaking-news bg-white border p-2">

                        <!-- <div class="alert alert-info" style='background-color:#f4f4f4; border-color:#e3e3e3;'> -->
                        <?php if (file_exists('public/img/konfigurasi/icon/' . esc($konfigurasi->icon))) {
                            $icon = esc($konfigurasi->icon);
                        } else {
                            $icon = 'default.png';
                        }
                        ?>
                        <img style='float:left; padding: 4px; margin-top:-7px; margin-right:3px;' width="70" class="pull-left" src="<?= base_url('/public/img/konfigurasi/icon/' . $icon) ?>">
                        <b> "<?= preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $konfigurasi->katamutiara) ?>"</b>
                    </div>

            </div>

            <div class="col-lg-4 col-12">
                <br>
                <div class="widget widget-reminder border">
                    <h1 class="f-20 montserrat-800 text-blue p-2  border-bottom">
                        Agenda </h1>
                    <?php if ($agenda2) {

                        $nomor = 0;
                        foreach ($agenda2 as $data) :
                            $nomor++; ?>
                            <div class="widget-reminder-container">
                                <div class="widget-reminder-time">
                                    <h5 class="f-12 montserrat-600 text-blue m-t-15 pointer" onclick="lihatagenda('<?= $data['agenda_id'] ?>')"><?= date_indo($data['tgl_mulai']) ?></h5>

                                </div>
                                <div class="widget-reminder-divider bg-success"></div>
                                <div class="widget-reminder-content">
                                    <h4 class="widget-title pointer" title="Lihat Detail" onclick="lihatagenda('<?= $data['agenda_id'] ?>')"><?= esc($data['tema']) ?></h4>
                                    <div class="widget-desc"><i class="fa fa-map-pin"></i> <?= esc($data['jam']) ?></div>
                                </div>
                            </div>
                            <div class="widget-reminder-container">
                                <div class="widget-reminder-time">
                                    <h5 class="f-12 montserrat-600 text-blue m-t-15">Tempat</h5>

                                </div>
                                <div class="widget-reminder-divider bg-primary"></div>
                                <div class="widget-reminder-content">
                                    <h4 class="widget-title"><?= esc($data['tempat']) ?></h4>
                                    <div class="widget-desc"><i class="fa fa-map-pin"></i> Disampaikan oleh : <?= esc($data['pengirim']) ?></div>
                                </div>
                            </div>

                        <?php endforeach;
                    } else { ?>
                        <div class="alert alert-danger">
                            Belum ada data Jadwal & Agenda..!
                        </div>
                    <?php } ?>


                </div>
                <div class="widget widget-reminder border">
                    <!-- pol isi -->
                    <?php if (get_cookie("poling") != 'isipoling') { ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="title-konten text-uppercase font-size-18 mb-2">Jajak Pendapat </div>

                                <?php if ($polsts == "Y") { ?>

                                    <div class="text-left text-primary">
                                        <b><?= esc($poltanya) ?></b>

                                        <hr>
                                        <?= form_open_multipart('', ['class' => 'formtambah']) ?>
                                        <?php

                                        foreach ($poljawab as $p) :

                                            echo "<input type=radio name=poling_id id=poling_id value='$p[poling_id]' />
					                     <class style=\"color:#666;font-size:14px; padding:2px required\">&nbsp;&nbsp;$p[pilihan]<br />
                                         <div class='invalid-feedback errorpoling_id'></div>";

                                        endforeach;
                                        echo "<br><center><input style='width: 110px; padding:2px; font-size:12px;' type=submit class='btn btn-primary btnsimpan' value='PILIH' />
		                     </form>
		                     <a>
                                      
                             <input style='width: 110px; padding:2px; font-size:12px;'  type=button class='btn btn-info btnlihatpoling' value='LIHAT HASIL' /></a></center>";
                                        ?>
                                    </div>

                                <?php } else { ?>
                                    <div class="text-center text-danger">
                                        Jajak Pendapat telah ditutup..!
                                    </div>
                                <?php  } ?>

                            </div>
                        </div>
                    <?php } ?>
                    <!-- isi pol end -->
                    <!-- hasil pol -->
                    <?php if (get_cookie("poling") == 'isipoling') { ?>
                        <!-- <div class="col-xl-3"> -->
                        <div class="card">
                            <div class="card-body">
                                <!-- <div class="title-konten text-uppercase font-size-18 mb-2">Hasil Jajak Pendapat </div> -->

                                <?php if ($polsts == "Y") { ?>

                                    <div class="text-left text-primary">
                                        <b><?= esc($poltanya) ?></b>

                                        <hr>
                                        <?php foreach ($poljawab as $p) :
                                            $prosentase = sprintf("%.2f", (($p['rating'] / $jumpol) * 100));
                                        ?>
                                            <div class="text-muted mb-1"><?= esc($p['pilihan']) ?> <a class="text-danger" style="font-size: 12px;">(<?= $p['rating'] ?>)</a>
                                                <div class="progress mb-2" style="height: 21px" title="<?= $prosentase ?> %">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: <?= $prosentase ?>%" aria-valuenow="<?= $prosentase ?>" aria-valuemin="0" aria-valuemax="100"><a class="text-light" style="font-size: 12px;"><?= $prosentase ?> %</a></div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <label class="text-dark">TOTAL RESPONDEN : </label> <a class="text-danger"><?= $jumpol ?></a>

                                    </div>

                                <?php } else { ?>
                                    <div class="text-center text-danger">
                                        Jajak Pendapat telah ditutup..!
                                    </div>
                                <?php  } ?>

                            </div>
                        </div>

                    <?php } ?>
                    <!-- hasil pol end -->
                </div>
            </div>
        </div>


        <div class="container-fluid ">
        </div>
        <div class="card-columns listfeaturedtag">
            <?php if ($berita4) {
                foreach ($berita4 as $key => $data) {
                    $pot = substr(esc($data['ringkasan']), 0, 100);
            ?>
                    <!-- begin post -->
                    <div class="card">
                        <div class="row">
                            <div class="col-md-5 wrapthumbnail">
                                <a href="<?= base_url($data['slug_berita']) ?>">
                                    <div class="thumbnail" style="background-image:url(<?= base_url('/public/img/informasi/berita/' . esc($data['gambar'])) ?>);">
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-7">
                                <div class="card-block">
                                    <h2 class="card-title"><a href="<?= base_url($data['slug_berita']) ?>"><?= esc($data['judul_berita']) ?></a></h2>
                                    <h4 class="card-text"><?= $pot ?>...</h4>
                                    <div class="metafooter">
                                        <div class="wrapfooter">
                                            <span class="meta-footer-thumb">
                                                <a href="<?= base_url('author/' . $data['id'] . '/' . esc($data['fullname'])) ?>"><img class="author-thumb" src="<?= base_url('public/img/user/' . esc($data['user_image'])) ?>" alt="Sal"></a>
                                            </span>
                                            <span class="author-meta">
                                                <span class="post-name"><a href="<?= base_url('author/' . $data['id'] . '/' . esc($data['fullname'])) ?>"><?= esc($data['fullname']) ?></a></span><br />
                                                <span class="post-date"><?= date_indo($data['tgl_berita']) ?></span><span class="dot"></span><span class="post-read"><?= esc($data['nama_kategori']) ?></span>
                                            </span>
                                            <span class="post-read-more"><a href="<?= base_url($data['slug_berita']) ?>" title="Read Story"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25">
                                                        <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                                                    </svg></a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end post -->
                <?php }
            } else { ?>
                <div class="alert alert-danger text-center" style='background-color:#FAEBD7; border-color:#e3e3e3;'>
                    <a style='color:red'>Belum ada data..!</a>
                </div>
            <?php } ?>
            <!-- End Featured
 End List Posts
	================================================== -->
        </div>
        <div class="container bg-light-blue ">
            <div class="row infographic-text ">
                <div class="col-md-5 px-5">
                    <p>
                    <h1 class="montserrat-800 f-20 text-blue p-2">Infografis Terkini </h1>
                </div>
                <div class="col-md-2 mt-2 text-center">
                    <div class="carousel-controls">
                        <a class="infographic-slider-prev carousel-control-prev-icon mr-3" href="#infographic-slider" role="button" data-slide="prev" aria-hidden="true"></a>
                        <a class="infographic-slider-next carousel-control-next-icon" href="#infographic-slider" role="button" data-slide="next" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="col mt-3 text-center">
                    <a class="infographoc-see-all f-24 text-white montserrat-400" href="#infografis">Lihat Semua</a>
                </div>
            </div>
    </section>

    <section class="content bg-light-blue pr-0 pl-0 pt-0">
        <div id="infographic-slider">

            <?php if ($infografis) {

                foreach ($infografis as $key => $value) {
            ?>
                    <div class="slider-item">
                        <a onclick="lihatinfo('<?= $value['id_banner'] ?>')">
                            <img class="lazy pointer" height="300" data-src="<?= base_url('public/img/informasi/infografis/' .  esc($value['banner_image'])) ?>" />
                        </a>
                    </div>
            <?php }
            } ?>
        </div>
        </div>
    </section>


    <!-- <section class="ftco-section"> -->
    <br>

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="section-header">
                    <div class="section-title justify-content-center pb-3">
                        <h2>GALERI FOTO</h2>
                    </div>
                    <span class="section-divider"></span>
                </div>
                <div class="featured-carousel owl-carousel">
                    <?php if ($foto8) {
                        foreach ($foto8 as $key => $data) {
                    ?>
                            <div class="item">
                                <div class="work">
                                    <div class="img d-flex align-items-center justify-content-center rounded" style="background-image: url(<?= base_url('/public/img/galeri/foto/thumb/' . 'thumb_'  . esc($data['gambar'])) ?>);">
                                        <a onclick="lihatfoto('<?= $data['foto_id'] ?>','<?= esc($data['nama_kategori_foto']) ?>')" class="icon d-flex align-items-center justify-content-center pointer">
                                            <span class="ion-ios-search"></span>
                                        </a>
                                    </div>
                                    <div class="text pt-3 w-100 text-center">
                                        <h3><a onclick="lihatfoto('<?= $data['foto_id'] ?>','<?= esc($data['nama_kategori_foto']) ?>')"><?= esc($data['judul']) ?></a></h3>
                                        <span><?= esc($data['nama_kategori_foto']) ?></span>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>

                <div class="container">
                    <div class="pt-2 mb-4 ">
                        <a class="btn btn-success" href="<?= base_url('foto') ?>">Selengkapnya <i class=" mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- </section> -->
    <br>
    <div class="container-fluid ">
        <h1 class="f-20 montserrat-800 text-blue p-2  border-bottom text-center">#Berkolaborasi membangun wilayah</h1>
        <center>Sampaikan saran dan masukan guna kemajuan dalam pembangunan. Semua lebih mudah melalui fitur interaktif</center>

        <div class="row">
            <div class="col-lg-12 col-12 p-0">
                <div id="category-slider" class="text-center position-relative">
                    <div class="slider">

                        <a href="bankdata">
                            <div class="slider-item p-2">
                                <img src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/icon/report.png') ?>" width="">
                                <span>Persuratan</span>
                            </div>

                        </a>
                        <a href="masukansaran">
                            <div class="slider-item p-2">
                                <img src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/icon/saran.png') ?>" width="">
                                <span>Masukan</span>
                            </div>

                        </a>

                        <a href="pengumuman">
                            <div class="slider-item p-2">
                                <img src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/icon/pengumuman.png') ?>" width="">
                                <span>Pengumuman</span>
                            </div>

                        </a>
                        <a href="bukutamu">
                            <div class="slider-item p-2">
                                <img src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/icon/buku.png') ?>" width="">
                                <span>Buku Tamu</span>
                            </div>
                        </a>
                        <a href="survey">
                            <div class="slider-item p-2">
                                <img src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/img/wilayah.png') ?>" alt="slide 1">
                            </div>
                            <div class="text-light-blue montserrat-500 f-10">Survei</div>
                        </a>

                    </div>

                    <div class="carousel-controls p-0 mt-3">
                        <a class="category-slider-prev carousel-control-prev-icon d-block mb-3" href="#category-slider" role="button" data-slide="prev" aria-hidden="true"></a>
                        <a class="category-slider-next carousel-control-next-icon d-block" href="#category-slider" role="button" data-slide="next" aria-hidden="true"></a>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="section-header">
                    <div class="section-title justify-content-center pb-3">
                        <h2>VIDEO TERBARU</h2>
                    </div>
                    <span class="section-divider"></span>
                </div>

                <div class="row">
                    <?php if ($video3) { ?>

                        <?php foreach ($video3 as $data) { ?>

                            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                                <div class="member" data-aos="zoom-in" data-aos-delay="200">
                                    <div class="member-img">
                                        <img src="https://img.youtube.com/vi/<?php echo esc($data['video_link']) ?>/mqdefault.jpg" class="img-fluidx" width="100%" height="180">

                                    </div>
                                    <div class="member-info p-1">
                                        <a href="https://www.youtube.com/embed/<?= esc($data['video_link']) ?>" target="_blank">
                                            <?= esc($data['judul']) ?>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    <?php } ?>
                    <div class="container">
                        <div class="pt-2 mb-4 ">
                            <a class="btn btn-success" href="<?= base_url('video') ?>">Selengkapnya <i class=" mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="section-header">
                    <div class="section-title justify-content-center pb-3">
                        <h2>KANTOR KAMI</h2>
                    </div>
                    <span class="section-divider"></span>
                </div>
                <style type="text/css" media="screen">
                    iframe {
                        height: 200px;
                        width: 100%;
                    }
                </style>
                <?= preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $konfigurasi->google_map) ?>

            </div>
        </div>
    </div>


    <div class="modal fade in" tabindex="-1" role="dialog" id="modalViewsambutan">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card-body p-0">
                        <p style="text-align:justify; "><img src="<?= base_url('/public/img/konfigurasi/pimpinan/' . esc($konfigurasi->gbr_sambutan)) ?>" style="float:left; padding: 8px;" height="180" /> <?= $konfigurasi->sambutan ?></p>
                    </div>
                    <div class="modal-footer p-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
if ($konfigurasi->sts_modal == '1') { ?>

    <script>
        $(document).ready(function() {
            penawaran();
        });
    </script>

<?php } ?>


<script>
    $(document).ready(function() {

        $('.btnsimpan').click(function(e) {
            e.preventDefault();
            let form = $('.formtambah')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: '<?= site_url('poling/ubahpoling') ?>',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disable');
                    $('.btnsimpan').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable', 'disable');
                    $('.btnsimpan').html('<i class="mdi mdi-content-save-all"></i>  Simpan');
                },
                success: function(response) {
                    if (response.error) {

                        Swal.fire({
                            title: "Maaf..!",
                            html: `Silahkan pilih salah satu jawaban diatas. `,
                            icon: "error",
                            showConfirmButton: false,
                            timer: 3550
                        });

                    }
                    if (response.gagal) {

                        Swal.fire({
                            title: "Maaf..!",
                            text: response.gagal,
                            icon: "error",
                            showConfirmButton: false,
                            timer: 3550
                        });

                    }
                    if (response.sukses) {

                        Swal.fire({
                            title: "Sukses!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 3550
                        }).then(function() {

                            window.location = '<?= base_url('') ?>';
                        });
                    }

                },
                error: function(xhr, ajaxOptions, thrownerror) {
                    Swal.fire({
                        title: "Maaf gagal load data!",
                        html: `Ada kesalahan Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    });
                }
            });
        });

    });
</script>

<script>
    $(document).ready(function() {
        $('.counter-value').each(function() {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 3500,
                easing: 'swing',
                step: function(now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    });
</script>
<script>
    $(function() {
        $('a[title]').tooltip();
    });
</script>

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Slick JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/owl/jquery.min.js') ?>"></script>
<script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/owl/popper.js') ?>"></script>
<script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/owl/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('/public/template/frontend/' . esc($folder) . '/desktop/js/owl/main.js') ?>"></script>

<?= $this->endSection() ?>