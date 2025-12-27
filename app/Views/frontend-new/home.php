<?= $this->extend('frontend-new/layouts/main') ?>

<?= $this->section('content') ?>

<section class="main-slider main-slider-one">
	<div class="main-slider-one__inner">
		<div class="owl-carousel owl-theme thm-owl__carousel testimonial-one__carousel nav-style1 dot-style1"
			data-owl-options='{"loop":true,"autoplay":true,"animateOut":"slideOutDown","animateIn":"fadeIn","margin":0,"nav":true,"dots":true,"smartSpeed":500,"autoplayTimeout":10000,"navText":["<span class=\"icon-arrow-right1\"></span>","<span class=\"icon-arrow-right\"></span>"],"responsive":{"0":{"items":1},"768":{"items":1},"992":{"items":1},"1200":{"items":1}}}'>
			<div class="main-slider-one__single">
				<div class="image-layer"
					style="background-image:url('<?= base_url('assets/images/slides/slider-v1-img1.jpg') ?>')"></div>
				<div class="shape1"><img src="<?= base_url('assets/images/shapes/main-slider-v1-shape1.png') ?>"
						alt="#"></div>
				<div class="shape2"><img src="<?= base_url('assets/images/shapes/main-slider-v1-shape2.png') ?>"
						alt="#"></div>
				<div class="container">
					<div class="main-slider-one__content">
						<div class="tagline"><span>Selamat Datang di Gereja Flobamora</span></div>
						<div class="title">
							<h2>Kabar Gembira <br> Bagi Anda!</h2>
						</div>
						<div class="text">
							<p>Kami mengundang Anda untuk menjadi bagian dari jemaat kami dan <br> merasakan kasih Tuhan
								bersama-sama!</p>
						</div>
						<div class="btn-box"><a class="thm-btn" href="<?= base_url('keuangan') ?>"><span
									class="txt">Berikan Persembahan</span></a></div>
					</div>
				</div>
			</div>
			<div class="main-slider-one__single">
				<div class="image-layer"
					style="background-image:url('<?= base_url('assets/images/slides/slider-v1-img2.jpg') ?>')"></div>
				<div class="shape1"><img src="<?= base_url('assets/images/shapes/main-slider-v1-shape1.png') ?>"
						alt="#"></div>
				<div class="shape2"><img src="<?= base_url('assets/images/shapes/main-slider-v1-shape2.png') ?>"
						alt="#"></div>
				<div class="container">
					<div class="main-slider-one__content">
						<div class="tagline"><span>Melayani dengan Hati</span></div>
						<div class="title">
							<h2>Bergabunglah Dengan <br> Kami Hari Ini</h2>
						</div>
						<div class="text">
							<p>Mari bersama-sama memperkuat iman dan membangun kehidupan <br> yang lebih bermakna di
								dalam Kristus!</p>
						</div>
						<div class="btn-box"><a class="thm-btn" href="<?= base_url('keuangan') ?>"><span
									class="txt">Berikan Persembahan</span></a></div>
					</div>
				</div>
			</div>
			<div class="main-slider-one__single">
				<div class="image-layer"
					style="background-image:url('<?= base_url('assets/images/slides/slider-v1-img3.jpg') ?>')"></div>
				<div class="shape1"><img src="<?= base_url('assets/images/shapes/main-slider-v1-shape1.png') ?>"
						alt="#"></div>
				<div class="shape2"><img src="<?= base_url('assets/images/shapes/main-slider-v1-shape2.png') ?>"
						alt="#"></div>
				<div class="container">
					<div class="main-slider-one__content">
						<div class="tagline"><span>Bersatu dalam Iman</span></div>
						<div class="title">
							<h2>Disini Saya <br> Menjadi Kuat</h2>
						</div>
						<div class="text">
							<p>Gereja Flobamora adalah tempat bagi seluruh keluarga untuk <br> menemukan inspirasi,
								dukungan, dan pengharapan sejati!</p>
						</div>
						<div class="btn-box"><a class="thm-btn" href="<?= base_url('keuangan') ?>"><span
									class="txt">Berikan Persembahan</span></a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="feature-one">
	<div class="container">
		<div class="row">
			<div class="col-xl-4 col-lg-4 wow animated fadeInUp" data-wow-delay="0.1s">
				<div class="feature-one__single text-center">
					<div class="shape2"><img src="<?= base_url('assets/images/shapes/feature-v1-shape1.png') ?>"
							alt="#"></div>
					<div class="shape3"><img src="<?= base_url('assets/images/shapes/feature-v1-shape2.png') ?>"
							alt="#"></div>
					<div class="feature-one__single-icon">
						<div class="shape1"></div>
						<span class="icon-donation-1"></span>
					</div>
					<div class="feature-one__single-content">
						<h2><a href="<?= base_url('about') ?>">Persembahan Jemaat</a></h2>
						<p>Memberikan persembahan dengan hati yang ikhlas <br> untuk melayani karya Tuhan</p>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 wow animated fadeInUp" data-wow-delay="0.2s">
				<div class="feature-one__single text-center">
					<div class="shape2"><img src="<?= base_url('assets/images/shapes/feature-v1-shape1.png') ?>"
							alt="#"></div>
					<div class="shape3"><img src="<?= base_url('assets/images/shapes/feature-v1-shape2.png') ?>"
							alt="#"></div>
					<div class="feature-one__single-icon">
						<div class="shape1 l12"></div>
						<span class="icon-donation-3"></span>
					</div>
					<div class="feature-one__single-content">
						<h2><a href="<?= base_url('about') ?>">Pelayanan Rohani</a></h2>
						<p>Memberikan bimbingan, pengajaran, dan dukungan <br> spiritual kepada seluruh jemaat</p>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 wow animated fadeInUp" data-wow-delay="0.3s">
				<div class="feature-one__single text-center">
					<div class="shape2"><img src="<?= base_url('assets/images/shapes/feature-v1-shape1.png') ?>"
							alt="#"></div>
					<div class="shape3"><img src="<?= base_url('assets/images/shapes/feature-v1-shape2.png') ?>"
							alt="#"></div>
					<div class="feature-one__single-icon">
						<div class="shape1 style3"></div>
						<span class="icon-charity-food"></span>
					</div>
					<div class="feature-one__single-content">
						<h2><a href="<?= base_url('about') ?>">Komunitas Kami</a></h2>
						<p>Membangun komunitas yang saling mendukung, <br> berbagi kasih dan pengalaman dalam iman</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="about-one">
	<div class="shape5 float-bob-y"><img src="<?= base_url('assets/images/shapes/about-v1-shape3.png') ?>" alt="#">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xl-7">
				<div class="about-one__content">
					<div class="sec-title">
						<div class="sec-title__tagline">
							<h6>Tentang Gereja Flobamora</h6>
						</div>
						<h2 class="sec-title__title">Visi & Misi <br> Gereja Kami</h2>
					</div>
					<div class="about-one__content-text">
						<p>Gereja Flobamora berkomitmen untuk melayani jemaat dengan sepenuh hati, <br> menyebarkan
							Injil Kristus, dan membangun iman yang kuat dalam komunitas kami</p>
					</div>
					<div class="about-one__content-bottom">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6">
								<div class="about-one__content-bottom-left">
									<div class="single-box">
										<div class="inner">
											<div class="icon-box">
												<div class="shape1"></div><span class="icon-donation-4"></span>
											</div>
											<div class="content-box">
												<h2>Fundrising</h2>
												<p>Lorem ipsum dolor sit amet tetur nod adipisicing elit sed</p>
											</div>
										</div>
									</div>
									<div class="single-box mb0">
										<div class="inner">
											<div class="icon-box">
												<div class="shape1"></div><span class="icon-donation-1"></span>
											</div>
											<div class="content-box">
												<h2>Make Donation</h2>
												<p>Lorem ipsum dolor sit amet tetur nod adipisicing elit sed</p>
											</div>
										</div>
									</div>
									<ul class="about-one__content-bottom-left-list">
										<li>
											<p>Jemaat Aktif</p>
										</li>
										<li>
											<p>Kegiatan Gereja</p>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6">
								<div class="about-one__content-bottom-right">
									<div class="about-one__helped-fund text-center">
										<div class="shape3 float-bob-y"></div>
										<div class="about-one__helped-fund-bg"
											style="background-image:url('<?= base_url('assets/images/backgrounds/about-v1-bg.png') ?>');">
										</div>
										<div class="img-box">
											<div class="inner"><img
													src="<?= base_url('assets/images/about/about-v1-img1.jpg') ?>"
													alt="#"></div>
											<div class="shape2 rotate-me"><img
													src="<?= base_url('assets/images/shapes/about-v1-shape1.png') ?>"
													alt="#"></div>
										</div>
										<div class="content-box">
											<h2>Seribu</h2>
											<h3>Jemaat </h3>
											<p>Bersama membangun gereja Kristus di Flobamora.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-5">
				<div class="about-one__img">
					<div class="about-one__img-inner">
						<div class="shape4"><img src="<?= base_url('assets/images/shapes/about-v1-shape2.png') ?>"
								alt="#"></div>
						<img src="<?= base_url('assets/images/about/about-v1-img2.jpg') ?>" alt="#">
					</div>
				</div>
			</div>
		</div>
		<div class="about-one__bottom">
			<div class="about-one__bottom-inner">
				<div class="about-one__bottom-content">
					<div class="icon-box"><span class="icon-donation-2"></span></div>
					<div class="text-box">
						<h2>Gereja Flobamora melayani dengan dedikasi penuh <br> untuk memberikan berkat kepada seluruh
							jemaat.</h2>
					</div>
				</div>
				<div class="about-one__bottom-btn"><a class="thm-btn" href="<?= base_url('about') ?>"><span
							class="txt">Pelajari Selengkapnya</span></a></div>
			</div>
		</div>
	</div>
</section>

<section class="case-one">
	<div class="case-one__bg"
		style="background-image:url('<?= base_url('assets/images/backgrounds/case-v1-bg.jpg') ?>');"></div>
	<div class="auto-container">
		<div class="sec-title text-center">
			<div class="sec-title__tagline">
				<h6>Fokus Pelayanan Kami</h6>
			</div>
			<h2 class="sec-title__title">Program & Kegiatan Gereja</h2>
		</div>
		<div class="row">
			<?php $cases = [
				['image' => 'case-v1-img1.jpg', 'label' => 'Ibadah', 'title' => 'Ibadah & Persekutuan <br> Jemaat', 'raised' => 'Aktif', 'percent' => '100%', 'goal' => 'Program Rutin'],
				['image' => 'case-v1-img2.jpg', 'label' => 'Pendidikan', 'title' => 'Sekolah Minggu & <br> Pendidikan Kristen', 'raised' => 'Aktif', 'percent' => '100%', 'goal' => 'Program Mingguan'],
				['image' => 'case-v1-img3.jpg', 'label' => 'Diakonia', 'title' => 'Pelayanan Sosial & <br> Pemberdayaan Masyarakat', 'raised' => 'Aktif', 'percent' => '100%', 'goal' => 'Program Berkelanjutan'],
				['image' => 'case-v1-img4.jpg', 'label' => 'Misi', 'title' => 'Misi & Pemberitaan <br> Injil Kristus', 'raised' => 'Aktif', 'percent' => '100%', 'goal' => 'Komitmen Utama'],
			]; ?>
			<?php foreach ($cases as $index => $case): ?>
				<div class="col-xl-3 col-lg-6 col-md-6 wow <?= $index < 2 ? 'fadeInLeft' : 'fadeInRight' ?>"
					data-wow-delay="<?= $index % 2 === 0 ? '0ms' : '100ms' ?>" data-wow-duration="1000ms">
					<div class="case-one__single">
						<div class="case-one__single-img">
							<div class="inner"><img src="<?= base_url('assets/images/resources/' . $case['image']) ?>"
									alt="#"></div>
							<div class="text-box"><?= esc($case['label']) ?></div>
						</div>
						<div class="case-one__single-content">
							<div class="inner">
								<div class="case-one__single-content-bg"
									style="background-image:url('<?= base_url('assets/images/shapes/case-v1-shape1.png') ?>');">
								</div>
								<h2><a href="<?= base_url('news/category/agenda') ?>"><?= $case['title'] ?></a></h2>
								<p>Gereja Flobamora berkomitmen untuk memberikan pelayanan terbaik bagi semua jemaat</p>
							</div>
							<div class="case-one__progress">
								<div class="case-one__progress-box">
									<div class="bar">
										<div class="bar-inner count-bar" data-percent="<?= esc($case['percent']) ?>">
											<div class="count-text"><?= esc($case['percent']) ?></div>
										</div>
									</div>
								</div>
								<div class="bottom-text">
									<div class="left-text">
										<p><?= esc($case['raised']) ?> <span>Raised </span></p>
									</div>
									<div class="right-text">
										<p><?= esc($case['goal']) ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</section>

<section class="video-one">
	<div class="shape3 float-bob-x"><img src="<?= base_url('assets/images/shapes/video-v1-shape3.png') ?>" alt="#">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="video-one__inner">
					<div class="shape1"><img src="<?= base_url('assets/images/shapes/video-v1-shape1.png') ?>" alt="#">
					</div>
					<div class="shape2"><img src="<?= base_url('assets/images/shapes/video-v1-shape2.png') ?>" alt="#">
					</div>
					<div class="video-one__bg"
						style="background-image:url('<?= base_url('assets/images/backgrounds/video-v1-bg.jpg') ?>');">
					</div>
					<div class="video-one__icon"><a href="https://www.youtube.com/watch?v=pVE92TNDwUk"
							class="video-one__btn video-popup"><span class="icon-play"></span></a></div>
					<div class="title-box">
						<h2>Watch Video</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="counter-one">
	<div class="shape1 float-bob-y"><img src="<?= base_url('assets/images/shapes/counter-v1-shape4.png') ?>" alt="#">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xl-4 col-lg-4 wow animated fadeInUp" data-wow-delay="0.1s">
				<div class="counter-one__single">
					<div class="counter-one__single-top">
						<div class="img-box"><img src="<?= base_url('assets/images/shapes/counter-v1-shape1.png') ?>"
								alt="#"></div>
						<div class="text-box">
							<h2><span class="odometer" data-count="1000">00</span></h2>
						</div>
					</div>
					<div class="counter-one__single-bottom">
						<p>Jemaat Gereja Flobamora</p>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 wow animated fadeInUp" data-wow-delay="0.2s">
				<div class="counter-one__single">
					<div class="counter-one__single-top">
						<div class="img-box"><img src="<?= base_url('assets/images/shapes/counter-v1-shape2.png') ?>"
								alt="#"></div>
						<div class="text-box">
							<h2><span class="dollar">Rp</span> <span class="odometer" data-count="50">00</span> <span
									class="m">Juta</span></h2>
						</div>
					</div>
					<div class="counter-one__single-bottom">
						<p>Dana Persembahan Jemaat</p>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 wow animated fadeInUp" data-wow-delay="0.3s">
				<div class="counter-one__single">
					<div class="counter-one__single-top">
						<div class="img-box"><img src="<?= base_url('assets/images/shapes/counter-v1-shape3.png') ?>"
								alt="#"></div>
						<div class="text-box">
							<h2><span class="odometer" data-count="587">00</span> <span class="m">k</span></h2>
						</div>
					</div>
					<div class="counter-one__single-bottom">
						<p>Program & Pelayanan Aktif</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="feature-two">
	<div class="container">
		<div class="row">
			<div class="col-xl-6">
				<div class="feature-two__img">
					<div class="shape2 float-bob-y"><img
							src="<?= base_url('assets/images/shapes/feature-v2-shape2.png') ?>" alt="#"></div>
					<div class="feature-two__img1 clearfix">
						<div class="shape1"><img src="<?= base_url('assets/images/shapes/feature-v2-shape1.png') ?>"
								alt="#"></div>
						<img src="<?= base_url('assets/images/resources/feature-v2-img1.jpg') ?>" alt="#">
					</div>
					<div class="feature-two__img2 wow fadeInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
						<div class="inner"><img src="<?= base_url('assets/images/resources/feature-v2-img2.jpg') ?>"
								alt="#"></div>
					</div>
				</div>
			</div>
			<div class="col-xl-6">
				<div class="feature-two__content">
					<div class="sec-title">
						<div class="sec-title__tagline">
							<h6>Bersama Membangun</h6>
						</div>
						<h2 class="sec-title__title">Pelayanan Kami Untuk <br> Anda Semua</h2>
					</div>
					<div class="feature-two__content-text1">
						<p>Gereja Flobamora adalah rumah spiritual bagi seluruh keluarga, di mana kami bersama-sama
							belajar, tumbuh, dan melayani dalam kasih Kristus. Kami percaya bahwa setiap orang memiliki
							peran penting dalam misi Tuhan.</p>
					</div>
					<div class="feature-two__content-text2">
						<p>Mari bersama-sama menyebarkan berita gembira Injil, saling mendukung dalam kehidupan, dan
							membangun masa depan yang lebih cerah berdasarkan nilai-nilai Kristus.</p>
					</div>
					<div class="feature-two__content-bottom">
						<div class="feature-two__content-bottom-content">
							<div class="top-content">
								<div class="icon-box">
									<div class="shape3"></div><span class="icon-charity"></span>
								</div>
								<div class="text-box">
									<h2><span class="dollar">Rp</span> <span class="odometer"
											data-count="50000000">00</span> <span class="plus">+</span></h2>
									<p>Dana Pembangunan Gereja</p>
								</div>
							</div>
							<div class="btn-box"><a class="thm-btn" href="<?= base_url('keuangan') ?>"><span
										class="txt">Berikan Persembahan</span></a></div>
						</div>
						<div class="feature-two__content-bottom-img">
							<div class="feature-two__content-bottom-img-inner">
								<img src="<?= base_url('assets/images/resources/feature-v2-img3.jpg') ?>" alt="#">
								<div class="content-box">
									<p>Dana Digunakan </p>
									<h2>Rp 25 Juta </h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="shop-one py-20 bg-gray-50">
	<div class="auto-container">
		<div class="sec-title text-center">
			<div class="sec-title__tagline">
				<h6>UMKM Jemaat</h6>
			</div>
			<h2 class="sec-title__title">Produk Unggulan Jemaat</h2>
		</div>

		<?php if (!empty($latestProducts)): ?>
			<div class="row">
				<?php foreach ($latestProducts as $product): ?>
					<div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
						<div class="shop-card">
							<div class="shop-card__image">
								<?php $images = json_decode($product['images'] ?? '[]', true) ?: []; ?>
								<?php $cover = $images[0] ?? 'placeholder-product.jpg'; ?>
								<a href="<?= base_url('umkm/produk/' . $product['slug']) ?>">
									<img src="<?= base_url('uploads/umkm/products/' . $cover) ?>"
										alt="<?= esc($product['name']) ?>">
								</a>
								<?php if (!empty($product['discount_price'])): ?>
									<div class="shop-card__badge">Diskon</div>
								<?php endif ?>
							</div>
							<div class="shop-card__content">
								<div class="shop-card__seller">
									<a href="<?= base_url('umkm/pelapak/' . $product['seller_id']) ?>">
										<?= esc($product['seller_name']) ?>
									</a>
								</div>
								<h3>
									<a href="<?= base_url('umkm/produk/' . $product['slug']) ?>">
										<?= esc($product['name']) ?>
									</a>
								</h3>
								<p class="shop-card__category"><?= esc($product['category_name'] ?? 'Lainnya') ?></p>
								<div class="shop-card__price">
									<?php if (!empty($product['discount_price'])): ?>
										<span class="shop-card__price-new">Rp
											<?= number_format($product['discount_price'], 0, ',', '.') ?></span>
										<span class="shop-card__price-old">Rp
											<?= number_format($product['price'], 0, ',', '.') ?></span>
									<?php else: ?>
										<span class="shop-card__price-new">Rp
											<?= number_format($product['price'], 0, ',', '.') ?></span>
									<?php endif ?>
								</div>
								<div class="shop-card__bottom">
									<a class="thm-btn thm-btn--outline"
										href="<?= base_url('umkm/produk/' . $product['slug']) ?>">
										<span class="txt">Lihat Detail</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
			<div class="text-center mt-10">
				<a href="<?= base_url('umkm') ?>" class="thm-btn">
					<span class="txt">Lihat Semua Produk</span>
				</a>
			</div>
		<?php else: ?>
			<div class="text-center py-10">
				<p class="text-gray-500">Belum ada produk yang tersedia saat ini.</p>
			</div>
		<?php endif ?>
	</div>
</section>

<section class="gallery-one">
	<div class="gallery-one__top">
		<div class="shape1"><img src="<?= base_url('assets/images/shapes/gallery-v1-shape1.png') ?>" alt="#"></div>
		<div class="shape2"><img src="<?= base_url('assets/images/shapes/gallery-v1-shape2.png') ?>" alt="#"></div>
		<div class="gallery-one__top__bg"
			style="background-image:url('<?= base_url('assets/images/backgrounds/gallery-v1-bg.jpg') ?>');"></div>
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="gallery-one__top-inner text-center">
						<div class="text-box">
							<h2>Gereja Flobamora mengajak Anda untuk menjadi bagian dari misi pelayanan, berbagi kasih
								kepada sesama, dan membangun komunitas yang saling peduli dan mendukung.</h2>
						</div>
						<div class="btn-box"><a class="thm-btn" href="<?= base_url('become-volunteer.html') ?>"><span
									class="txt">Jadilah Sukarelawan</span></a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="gallery-one__bottom">
		<div class="auto-container">
			<div class="row">
				<?php $gallery = [
					['image' => 'gallery-v1-img1.jpg', 'title' => 'Ibadah'],
					['image' => 'gallery-v1-img2.jpg', 'title' => 'Pelayanan', 'class' => 'bg2'],
					['image' => 'gallery-v1-img3.jpg', 'title' => 'Pendidikan', 'class' => 'bg3'],
					['image' => 'gallery-v1-img4.jpg', 'title' => 'Misi', 'class' => 'bg4'],
				]; ?>
				<?php foreach ($gallery as $index => $item): ?>
					<div class="col-xl-3 col-lg-6 col-md-6 wow animated fadeInUp" data-wow-delay="0.<?= $index + 1 ?>s">
						<div class="gallery-one__single">
							<div class="gallery-one__single-img <?= $item['class'] ?? '' ?>">
								<img src="<?= base_url('assets/images/gallery/' . $item['image']) ?>" alt="#">
								<div class="text-box">
									<h2><a href="#"><?= esc($item['title']) ?></a></h2>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</section>

<section class="testimonial-one">
	<div class="auto-container">
		<div class="sec-title text-center">
			<div class="sec-title__tagline">
				<h6>Kesaksian</h6>
			</div>
			<h2 class="sec-title__title">Apa Kata Jemaat Kami</h2>
		</div>
		<div class="row">
			<div class="col-xl-12">
				<div class="testimonial-one__inner">
					<div class="owl-carousel owl-theme thm-owl__carousel testimonial-one__carousel"
						data-owl-options='{"loop":true,"autoplay":true,"margin":30,"nav":false,"dots":false,"smartSpeed":500,"autoplayTimeout":10000,"navText":["<span class=\"icon-left-arrow\"></span>","<span class=\"icon-next\"></span>"],"responsive":{"0":{"items":1},"768":{"items":1},"992":{"items":2},"1200":{"items":3}}}'>
						<?php $testimonials = [
							['image' => 'testimonial-v1-img1.jpg', 'name' => 'Pdt. Yohanes', 'location' => 'Ketua Gereja Flobamora'],
							['image' => 'testimonial-v1-img2.jpg', 'name' => 'Ibu Maria', 'location' => 'Anggota Jemaat'],
							['image' => 'testimonial-v1-img3.jpg', 'name' => 'Bpk. Sugianto', 'location' => 'Anggota Jemaat'],
						]; ?>
						<?php for ($i = 0; $i < 2; $i++): ?>
							<?php foreach ($testimonials as $item): ?>
								<div class="testimonial-one__single text-center">
									<div class="shape1"><img
											src="<?= base_url('assets/images/shapes/testimonial-v1-shape1.png') ?>" alt="#">
									</div>
									<div class="shape2"><img
											src="<?= base_url('assets/images/shapes/testimonial-v1-shape2.png') ?>" alt="#">
									</div>
									<div class="icon-box"><span class="icon-quote-right"></span></div>
									<div class="testimonial-one__single-img"><img
											src="<?= base_url('assets/images/testimonial/' . $item['image']) ?>" alt="#"></div>
									<div class="author-info">
										<h2><?= esc($item['name']) ?></h2>
										<p><?= esc($item['location']) ?></p>
									</div>
									<div class="text-box">
										<p>Pelayanan di Gereja Flobamora sangat bermakna bagi saya dan keluarga. Semua orang
											saling mencintai dan mendukung satu sama lain dengan tulus.</p>
									</div>
								</div>
							<?php endforeach ?>
						<?php endfor ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="team-one">
	<div class="auto-container">
		<div class="team-one__inner">
			<div class="team-one__bg"
				style="background-image:url('<?= base_url('assets/images/pattern/team-v1-bg.jpg') ?>');"></div>
			<div class="container">
				<div class="team-one__top">
					<div class="sec-title">
						<div class="sec-title__tagline">
							<h6>Pelayan Gereja</h6>
						</div>
						<h2 class="sec-title__title">Mejelis & Pelayan Gereja</h2>
					</div>
					<div class="btn-box"><a href="<?= base_url('majelis') ?>">Lihat Semua</a></div>
				</div>
				<?php if (!empty($majelis)): ?>
					<div class="team-one__carousel owl-carousel owl-theme thm-owl__carousel"
						data-owl-options='{"loop":true,"autoplay":true,"margin":30,"nav":false,"dots":true,"smartSpeed":600,"responsive":{"0":{"items":1},"576":{"items":2},"992":{"items":3}}}'>
						<?php foreach ($majelis as $member): ?>
							<div class="team-one__single">
								<div class="team-one__single-img">
									<div class="team-one__single-img-bg"
										style="background-image:url('<?= base_url('assets/images/shapes/team-v1-shape1.png') ?>');">
									</div>
									<div class="inner">
										<?php if (!empty($member['photo'])): ?>
											<img src="<?= base_url('uploads/majelis/' . $member['photo']) ?>"
												alt="<?= esc($member['name']) ?>">
										<?php else: ?>
											<img src="<?= base_url('assets/images/team/team-placeholder.jpg') ?>"
												alt="<?= esc($member['name']) ?>">
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
					<div class="news-block-one">
						<div class="inner-box text-center py-60">
							<p>Data majelis belum tersedia.</p>
						</div>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>


<section class="blog-one">
	<div class="auto-container">
		<div class="sec-title text-center">
			<div class="sec-title__tagline">
				<h6>Warta Terbaru</h6>
			</div>
			<h2 class="sec-title__title">Berita & Artikel Pilihan</h2>
		</div>
		<?php if (!empty($latestNews)): ?>
			<div class="row">
				<?php foreach ($latestNews as $index => $news): ?>
					<div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="<?= 0.2 + ($index * 0.1) ?>s"
						data-wow-duration="1500ms">
						<div class="blog-one__single">
							<div class="blog-one__single-img">
								<div class="inner">
									<?php if (!empty($news['featured_image'])): ?>
										<img src="<?= base_url('uploads/news/' . $news['featured_image']) ?>"
											alt="<?= esc($news['title']) ?>">
									<?php else: ?>
										<img src="<?= base_url('assets/images/blog/blog-v1-placeholder.jpg') ?>"
											alt="<?= esc($news['title']) ?>">
									<?php endif ?>
								</div>
								<ul class="overlay-text">
									<li>
										<p><?= esc($newsCategories[$news['category']] ?? ucfirst($news['category'])) ?></p>
									</li>
									<li class="style2">
										<p><?= date('d M', strtotime($news['published_at'])) ?></p>
									</li>
								</ul>
							</div>
							<div class="blog-one__single-content">
								<div class="white-bg"></div>
								<div class="left-bg"></div>
								<div class="right-bg"></div>
								<ul class="meta-box">
									<li>
										<div class="icon"><span class="icon-visibility"></span></div>
										<div class="text">
											<p><?= number_format((int) ($news['views'] ?? 0)) ?> kali dibaca</p>
										</div>
									</li>
								</ul>
								<h2><a href="<?= base_url('news/' . $news['slug']) ?>"><?= esc($news['title']) ?></a></h2>
								<div class="blog-one__single-content-bottom">
									<div class="btn-box"><a href="<?= base_url('news/' . $news['slug']) ?>">Baca Selengkapnya
											<span class="icon-right-arrow21"></span></a></div>
									<div class="icon-box"><span class="icon-bookmark"></span></div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
			<div class="text-center mt-40">
				<a href="<?= base_url('news') ?>" class="thm-btn"><span class="txt">Lihat Semua Berita</span></a>
			</div>
		<?php else: ?>
			<div class="news-block-one">
				<div class="inner-box text-center py-60">
					<div class="icon mb-3"><span class="icon-newspaper"></span></div>
					<p>Belum ada berita yang dipublikasikan.</p>
				</div>
			</div>
		<?php endif ?>
	</div>
</section>

<?= $this->endSection() ?>