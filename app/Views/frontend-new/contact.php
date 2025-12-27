<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
  <div class="auto-container">
    <div class="page-header__inner">
      <h1><?= $title ?></h1>
      <p>Kami siap mendengar dan melayani Anda</p>
    </div>
  </div>
</section>

<section class="contact-page py-20">
  <div class="auto-container">
    <div class="row">
      <div class="col-xl-4 col-lg-5">
        <div class="contact-page__left">
          <div class="sec-title">
            <div class="sec-title__tagline">
              <h6>Informasi Kontak</h6>
            </div>
            <h2 class="sec-title__title">Terhubung Dengan <br> Kami</h2>
          </div>
          <p class="contact-page__text">Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan, permohonan
            doa, atau ingin mengetahui lebih lanjut tentang pelayanan gereja.</p>

          <ul class="list-unstyled contact-page__info-list mt-8 space-y-6">
            <li class="flex items-start gap-4">
              <div
                class="icon bg-emerald-50 text-emerald-600 w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0 text-xl">
                <span class="icon-pin"></span>
              </div>
              <div class="text">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Alamat Gereja</p>
                <h4 class="text-lg font-semibold text-gray-800">
                  <?= app_setting('site_office_address', 'Jl. Gereja No. 1, Kupang, NTT') ?></h4>
              </div>
            </li>
            <li class="flex items-start gap-4">
              <div
                class="icon bg-blue-50 text-blue-600 w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0 text-xl">
                <span class="icon-phone-call"></span>
              </div>
              <div class="text">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Telepon / WhatsApp</p>
                <h4 class="text-lg font-semibold text-gray-800"><a
                    href="tel:<?= preg_replace('/\D+/', '', app_setting('site_phone', '081234567890')) ?>"><?= app_setting('site_phone', '0812-3456-7890') ?></a>
                </h4>
              </div>
            </li>
            <li class="flex items-start gap-4">
              <div
                class="icon bg-yellow-50 text-yellow-600 w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0 text-xl">
                <span class="icon-email"></span>
              </div>
              <div class="text">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Email</p>
                <h4 class="text-lg font-semibold text-gray-800"><a
                    href="mailto:<?= app_setting('site_email', 'info@gerejaflobamora.org') ?>"><?= app_setting('site_email', 'info@gerejaflobamora.org') ?></a>
                </h4>
              </div>
            </li>
          </ul>

          <div class="mt-8">
            <h4 class="font-bold text-gray-800 mb-4">Ikuti Kami</h4>
            <div class="flex gap-3">
              <a href="<?= app_setting('social_facebook', '#') ?>"
                class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition"><i
                  class="fab fa-facebook-f"></i></a>
              <a href="<?= app_setting('social_instagram', '#') ?>"
                class="w-10 h-10 bg-pink-600 text-white rounded-full flex items-center justify-center hover:bg-pink-700 transition"><i
                  class="fab fa-instagram"></i></a>
              <a href="<?= app_setting('social_youtube', '#') ?>"
                class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition"><i
                  class="fab fa-youtube"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-8 col-lg-7">
        <div class="contact-page__right bg-white p-8 md:p-12 rounded-xl shadow-sm border border-gray-100">
          <h3 class="text-2xl font-bold text-gray-800 mb-6">Kirim Pesan</h3>

          <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
              <span class="block sm:inline"><?= session()->getFlashdata('success') ?></span>
            </div>
          <?php endif; ?>

          <?php if (session()->getFlashdata('errors')): ?>
            <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
              <ul class="list-disc list-inside">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                  <li><?= esc($error) ?></li>
                <?php endforeach ?>
              </ul>
            </div>
          <?php endif; ?>

          <form action="<?= base_url('contact') ?>" method="post" class="space-y-6">
            <?= csrf_field() ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="<?= old('name') ?>"
                  class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition background-white"
                  required placeholder="Nama Anda">
              </div>
              <div>
                <label class="block text-gray-700 font-semibold mb-2">Nomor Telepon / WA</label>
                <input type="text" name="phone" value="<?= old('phone') ?>"
                  class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition background-white"
                  required placeholder="08...">
              </div>
            </div>

            <div>
              <label class="block text-gray-700 font-semibold mb-2">Email</label>
              <input type="email" name="email" value="<?= old('email') ?>"
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition background-white"
                required placeholder="email@contoh.com">
            </div>

            <div>
              <label class="block text-gray-700 font-semibold mb-2">Subjek Pesan</label>
              <input type="text" name="subject" value="<?= old('subject') ?>"
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition background-white"
                required placeholder="Judul pesan Anda">
            </div>

            <div>
              <label class="block text-gray-700 font-semibold mb-2">Pesan</label>
              <textarea name="message" rows="5"
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition background-white"
                required placeholder="Tuliskan pesan Anda di sini..."><?= old('message') ?></textarea>
            </div>

            <button type="submit" class="thm-btn">
              <span class="txt">Kirim Pesan</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Map Section -->
<section class="contact-map py-0">
  <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126935.53697960356!2d123.51610471640624!3d-10.177268800000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c568341e2a0439f%3A0x6c6e7592cf35534!2sKupang%2C%20Kota%20Kupang%2C%20Nusa%20Tenggara%20Tim.!5e0!3m2!1sid!2sid!4v1646274382583!5m2!1sid!2sid"
    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</section>

<?= $this->endSection() ?>