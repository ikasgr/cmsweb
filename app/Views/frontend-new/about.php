<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
  <div class="auto-container">
    <div class="page-header__inner">
      <h1><?= $title ?></h1>
      <p>Mengenal lebih dekat Gereja Flobamora</p>
    </div>
  </div>
</section>

<section class="about-page py-20">
  <div class="auto-container">
    <div class="row">
      <div class="col-xl-6 col-lg-6">
        <div class="about-page__left">
          <div class="about-page__img">
            <img src="<?= base_url('assets/images/about/about-v1-img2.jpg') ?>" alt="Tentang Kami">
            <div class="about-page__img-shape">
              <img src="<?= base_url('assets/images/shapes/about-page-shape.png') ?>" alt="">
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6">
        <div class="about-page__right">
          <div class="sec-title">
            <div class="sec-title__tagline">
              <h6>Selamat Datang</h6>
            </div>
            <h2 class="sec-title__title">Melayani dengan Kasih <br> dan Kebenaran</h2>
          </div>
          <div class="about-page__content">
            <p class="about-page__text-1">Gereja Flobamora hadir sebagai rumah rohani bagi setiap jiwa yang rindu akan
              kasih Tuhan. Kami berkomitmen untuk membangun komunitas yang kuat, saling mendukung, dan bertumbuh dalam
              iman Kristiani.</p>
            <p class="about-page__text-2 mt-4">Berdiri sejak tahun 1990, kami terus berupaya menjadi terang dan garam
              bagi lingkungan sekitar, membawa kabar baik Injil, dan memberikan dampak positif melalui berbagai
              pelayanan sosial dan kerohanian.</p>

            <div class="about-page__points mt-8">
              <ul class="list-unstyled space-y-4">
                <li class="flex items-start gap-4">
                  <div
                    class="icon bg-emerald-100 text-emerald-600 w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check"></i>
                  </div>
                  <div class="text">
                    <h4 class="font-bold text-lg mb-1">Persekutuan yang Hangat</h4>
                    <p class="text-sm text-gray-600">Menciptakan suasana kekeluargaan dimana setiap orang merasa
                      diterima dan dihargai.</p>
                  </div>
                </li>
                <li class="flex items-start gap-4">
                  <div
                    class="icon bg-emerald-100 text-emerald-600 w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-bible"></i>
                  </div>
                  <div class="text">
                    <h4 class="font-bold text-lg mb-1">Pengajaran Alkitabiah</h4>
                    <p class="text-sm text-gray-600">Dasar pengajaran yang kuat pada Firman Tuhan untuk pertumbuhan iman
                      jemaat.</p>
                  </div>
                </li>
                <li class="flex items-start gap-4">
                  <div
                    class="icon bg-emerald-100 text-emerald-600 w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-hands-helping"></i>
                  </div>
                  <div class="text">
                    <h4 class="font-bold text-lg mb-1">Pelayanan Holistik</h4>
                    <p class="text-sm text-gray-600">Melayani kebutuhan rohani, emosional, dan fisik jemaat serta
                      masyarakat.</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Vision & Mission -->
<section class="vision-mission-one py-20 bg-gray-50">
  <div class="auto-container">
    <div class="row">
      <div class="col-xl-6 col-lg-6 wow fadeInLeft">
        <div class="vision-box bg-white p-10 rounded-xl shadow-sm border border-gray-100 h-full">
          <div class="icon-box mb-6 text-emerald-600 text-5xl">
            <i class="fas fa-eye"></i>
          </div>
          <h3 class="text-2xl font-bold mb-4 text-slate-800">Visi Kami</h3>
          <p class="text-gray-600 leading-relaxed text-lg">
            "Menjadi gereja yang memuliakan Tuhan, mendewasakan jemaat, dan menjadi berkat bagi bangsa."
          </p>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 wow fadeInRight">
        <div class="mission-box bg-white p-10 rounded-xl shadow-sm border border-gray-100 h-full">
          <div class="icon-box mb-6 text-blue-600 text-5xl">
            <i class="fas fa-bullseye"></i>
          </div>
          <h3 class="text-2xl font-bold mb-4 text-slate-800">Misi Kami</h3>
          <ul class="space-y-3 text-gray-600">
            <li class="flex items-start gap-3">
              <i class="fas fa-caret-right mt-1.5 text-blue-500"></i>
              <span>Menyelenggarakan ibadah yang hidup dan inspiratif.</span>
            </li>
            <li class="flex items-start gap-3">
              <i class="fas fa-caret-right mt-1.5 text-blue-500"></i>
              <span>Melakukan pembinaan iman yang berkesinambungan.</span>
            </li>
            <li class="flex items-start gap-3">
              <i class="fas fa-caret-right mt-1.5 text-blue-500"></i>
              <span>Membangun persekutuan yang penuh kasih dan saling melayani.</span>
            </li>
            <li class="flex items-start gap-3">
              <i class="fas fa-caret-right mt-1.5 text-blue-500"></i>
              <span>Melaksanakan amanat agung melalui penginjilan dan misi.</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Team Section -->
<section class="team-one">
  <div class="auto-container">
    <div class="team-one__inner">
      <div class="team-one__bg"
        style="background-image:url('<?= base_url('assets/images/pattern/team-v1-bg.jpg') ?>');"></div>
      <div class="container">
        <div class="team-one__top">
          <div class="sec-title">
            <div class="sec-title__tagline">
              <h6>Kepemimpinan</h6>
            </div>
            <h2 class="sec-title__title">Majelis & Hamba Tuhan</h2>
          </div>
          <div class="btn-box"><a href="<?= base_url('majelis') ?>">Lihat Struktur Organisasi</a></div>
        </div>
        <?php if (!empty($majelis)): ?>
          <div class="team-one__carousel owl-carousel owl-theme thm-owl__carousel"
            data-owl-options='{"loop":true,"autoplay":true,"margin":30,"nav":false,"dots":true,"smartSpeed":600,"responsive":{"0":{"items":1},"576":{"items":2},"992":{"items":3}}}'>
            <?php foreach ($majelis as $member): ?>
              <div class="team-one__single">
                <div class="team-one__single-img">
                  <div class="team-one__single-img-bg"
                    style="background-image:url('<?= base_url('assets/images/shapes/team-v1-shape1.png') ?>');"></div>
                  <div class="inner">
                    <?php if (!empty($member['photo'])): ?>
                      <img src="<?= base_url('uploads/majelis/' . $member['photo']) ?>" alt="<?= esc($member['name']) ?>">
                    <?php else: ?>
                      <img src="<?= base_url('assets/images/team/team-placeholder.jpg') ?>" alt="<?= esc($member['name']) ?>">
                    <?php endif ?>
                  </div>
                </div>
                <div class="team-one__single-content text-center">
                  <h2><a
                      href="<?= base_url('majelis') ?>#<?= esc(url_title($member['name'], '-', true)) ?>"><?= esc($member['name']) ?></a>
                  </h2>
                  <p><?= esc($member['position']) ?></p>
                </div>
              </div>
            <?php endforeach ?>
          </div>
        <?php else: ?>
          <div class="text-center py-10 text-white">
            <p>Data majelis belum tersedia.</p>
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</section>

<!-- CTA / Call to Action -->
<section class="cta-one py-20 bg-slate-900 text-white">
  <div class="auto-container">
    <div class="row items-center">
      <div class="col-lg-8">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ingin Bergabung dengan Kami?</h2>
        <p class="text-slate-300 text-lg">Kami menyambut Anda dengan tangan terbuka. Mari bertumbuh bersama dalam iman
          dan pengharapan.</p>
      </div>
      <div class="col-lg-4 text-lg-right mt-8 lg:mt-0">
        <a href="<?= base_url('contact') ?>" class="thm-btn">
          <span class="txt">Hubungi Kami</span>
        </a>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>