<?php
$siteLogo = $siteLogo ?? app_setting_asset('site_logo', 'public/img/konfigurasi/logo/default.png');
$siteLogoAlt = $siteLogoAlt ?? app_setting('site_name', 'CMS Church by IKASMEDIA');
$siteDescription = app_setting('site_description', 'Gereja yang memberitakan kasih Kristus dan melayani jemaat dengan sepenuh hati.');
$footerText = app_setting('site_footer', '&copy; ' . date('Y') . ' CMS Church by IKASMEDIA. All rights reserved.');
$siteAddress = app_setting('site_office_address', 'Alamat gereja belum diatur.');
$siteCity = app_setting('site_city', 'Kota, Provinsi');
$siteProvince = app_setting('site_province', 'Provinsi');
$siteEmail = app_setting('site_email', 'info@example.com');
$sitePhone = app_setting('site_phone', '0000-0000');

$socialLinks = [
  'facebook' => app_setting('social_facebook'),
  'instagram' => app_setting('social_instagram'),
  'youtube' => app_setting('social_youtube'),
  'tiktok' => app_setting('social_tiktok'),
  'twitter' => app_setting('social_twitter'),
  'linkedin' => app_setting('social_linkedin'),
  'whatsapp' => app_setting('social_whatsapp'),
];

$menuModel = model(App\Models\ModelMenu::class);
// Use mainmenu() method from ModelMenu if getMenuTree doesn't exist
$quickLinksSource = !empty($footer) ? $footer : [
  [
    'label' => 'Tentang Kami',
    'url' => '/about'
  ],
  [
    'label' => 'Kontak',
    'url' => '/contact'
  ],
  [
    'label' => 'Pendaftaran',
    'url' => '/registration'
  ],
  [
    'label' => 'Jadwal Ibadah',
    'url' => '/ibadah'
  ],
  [
    'label' => 'Berita Gereja',
    'url' => '/news'
  ],
];

$quickLinks = [];
foreach ($quickLinksSource as $item) {
  $quickLinks[] = [
    'label' => $item['label'] ?? ($item['nama_menu'] ?? 'Menu'),
    'url' => $item['url'] ?? ($item['menu_link'] ?? '#')
  ];
}

// Use data passed from controller if available, fallback to model
// Normalisasi Berita Terbaru
$latestNewsRecordsRaw = $latestNews ?? model(App\Models\ModelBerita::class)
  ->where('status', '1')
  ->where('jenis_berita', 'Berita')
  ->orderBy('tgl_berita', 'DESC')
  ->limit(2)
  ->find();

$latestNewsRecords = [];
foreach ($latestNewsRecordsRaw as $news) {
  $latestNewsRecords[] = [
    'title' => $news['title'] ?? ($news['judul_berita'] ?? ''),
    'slug' => $news['slug'] ?? ($news['slug_berita'] ?? ''),
    'date' => $news['published_at'] ?? ($news['tgl_berita'] ?? date('Y-m-d')),
    'image' => $news['featured_image'] ?? ($news['gambar'] ?? ''),
  ];
}

?>

<!-- ================> Social section start here <================== -->
<div class="social">
  <div class="container">
    <div class="social__area">
      <ul class="social__list">
        <?php if ($konfigurasi->sosmed_fb): ?>
          <li class="social__list-facebook">
            <a href="<?= esc($konfigurasi->sosmed_fb) ?>">
              <i class="fab fa-facebook-f"></i>
              <span>facebook</span>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($konfigurasi->sosmed_twiter): ?>
          <li class="social__list-twitter">
            <a href="<?= esc($konfigurasi->sosmed_twiter) ?>">
              <i class="fab fa-twitter"></i>
              <span>twitter</span>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($konfigurasi->sosmed_instagram): ?>
          <li class="social__list-instagram">
            <a href="<?= esc($konfigurasi->sosmed_instagram) ?>">
              <i class="fab fa-instagram"></i>
              <span>instagram</span>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($konfigurasi->sosmed_youtube): ?>
          <li class="social__list-youtube">
            <a href="<?= esc($konfigurasi->sosmed_youtube) ?>">
              <i class="fab fa-youtube"></i>
              <span>youtube</span>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>
<!-- ================> Social section end here <================== -->



<!-- ================> Footer section start here <================== -->
<footer class="footer">
  <div class="footer__top padding--top padding--bottom">
    <div class="container">
      <div class="row g-4">
        <div class="col-xl-3 col-sm-6 col-12">
          <div class="footer__about">
            <div class="section__header">
              <h2>About <?= esc($konfigurasi->namasingkat ?: $konfigurasi->nama) ?></h2>
            </div>
            <div class="section__wrapper">
              <div class="footer__about-thumb">
                <img src="<?= $siteLogo ?>" alt="footer thumb" class="w-100" style="background: #fff; padding: 10px;">
              </div>
              <div class="footer__about-contet">
                <p><?= esc($konfigurasi->deskripsi) ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
          <div class="footer__tags">
            <div class="section__header">
              <h2>Post Tag</h2>
            </div>
            <div class="section__wrapper">
              <ul>
                <?php
                $tagModel = model(App\Models\ModelTag::class);
                $tags = $tagModel->orderBy('nama_tag', 'ASC')->limit(12)->findAll();
                ?>
                <?php foreach ($tags as $t): ?>
                  <li><a href="<?= base_url('news/tag/' . ($t['slug_tag'] ?? '')) ?>"><?= esc($t['nama_tag']) ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
          <div class="footer__post">
            <div class="section__header">
              <h2>Recent Post</h2>
            </div>
            <div class="section__wrapper">
              <?php foreach ($latestNewsRecords as $news): ?>
                <div class="footer__post-item">
                  <div class="footer__post-inner">
                    <div class="footer__post-thumb">
                      <a href="<?= base_url('news/' . $news['slug']) ?>">
                        <img
                          src="<?= image_url($news['image'], 'public/img/informasi/berita/', 'public/img/no_image.png') ?>"
                          alt="footer post" style="width: 70px; height: 70px; object-fit: cover;">
                      </a>
                    </div>
                    <div class="footer__post-content">
                      <a href="<?= base_url('news/' . $news['slug']) ?>">
                        <h6><?= esc(substr($news['title'], 0, 40)) ?>...</h6>
                      </a>
                      <p><i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($news['date'])) ?></p>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
          <div class="footer__links">
            <div class="section__header">
              <h2>Useful Links</h2>
            </div>
            <div class="section__wrapper">
              <ul>
                <?php foreach ($quickLinks as $link): ?>
                  <li><a href="<?= base_url(ltrim($link['url'], '/')) ?>"><?= esc($link['label']) ?></a></li>
                <?php endforeach; ?>
                <li><a href="<?= base_url('login') ?>">Admin Log in</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer__bottom">
    <div class="container">
      <div class="footer__bottom-area text-center">
        <div class="footer__bottom-logo">
          <a href="<?= base_url() ?>"><img src="<?= $siteLogo ?>" alt="footer logo" style="max-height: 50px;"></a>
        </div>
        <div class="footer__bottom-content">
          <p><?= $footerText ?></p>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- ================> Footer section end here <================== -->

<!-- scrollToTop start here -->
<a href="#" class="scrollToTop"><i class="fas fa-arrow-up"></i><span class="pluse_1"></span><span
    class="pluse_2"></span></a>
<!-- scrollToTop ending here -->

<!-- vendor plugins -->
<script src="<?= base_url('public/assets/js/jquery-3.6.0.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/waypoints.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/swiper.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/lightcase.js') ?>"></script>
<script src="<?= base_url('public/assets/js/isotope.pkgd.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/donate-range.js?v=' . time()) ?>"></script>
<script src="<?= base_url('public/assets/js/jquery.counterup.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/wow.js') ?>"></script>
<script src="<?= base_url('public/assets/js/custom.js') ?>"></script>

<?= $this->renderSection('scripts') ?>
</body>

</html>