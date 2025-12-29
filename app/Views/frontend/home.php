<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> Banner section start here <================== -->
<section class="banner">
	<div class="banner__slider overflow-hidden">
		<div class="swiper-wrapper">
			<?php if (!empty($banner)): ?>
				<?php foreach ($banner as $bn): ?>
					<div class="swiper-slide">
						<div class="banner__item"
							style="background-image: url('<?= image_url($bn['banner_image'], 'public/img/banner/', 'public/assets/images/banner/bg-1.jpg') ?>');">
							<div class="container">
								<div class="row">
									<div class="col-lg-6 offset-lg-6">
										<div class="banner__content">
											<h3>Welcome to <?= esc($konfigurasi->nama) ?></h3>
											<h2><?= esc($bn['ket']) ?></h2>
											<p>Mari bergabung bersama kami dalam persekutuan dan pelayanan kasih Kristus untuk
												membangun iman dan melayani sesama.</p>
											<a href="<?= esc($bn['link'] ?: base_url('donasi')) ?>"
												class="default-btn"><?= $bn['link'] ? 'See More' : 'Get Help Now' ?></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="swiper-slide">
					<div class="banner__item"
						style="background-image: url('<?= base_url('public/assets/images/banner/bg-1.jpg') ?>');">
						<div class="container">
							<div class="row">
								<div class="col-lg-6 offset-lg-6">
									<div class="banner__content">
										<h3>It'S Useless To Lecture</h3>
										<h2>Spread Love and Faith to Everyone</h2>
										<p>Enthusiastically Underwhelm Quality Benefits Rather Than Professional "Outside
											The Box" Thinking. Distinctively Network Highly Efficient Leadership Skills</p>
										<a href="<?= base_url('donasi') ?>" class="default-btn">Get Help Now</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="banner__pagination"></div>
	</div>
</section>
<!-- ================> Banner section end here <================== -->


<!-- ================> Event section start here <================== -->
<section class="event">
	<div class="container">
		<div class="event__area">
			<div class="row g-4 align-items-center">
				<div class="col-lg-3 col-sm-12 text-center text-lg-start">
					<h2 class="event__label">Upcoming Event</h2>
				</div>
				<div class="col-lg-6 col-sm-12">
					<div class="event__countdown">
						<?php
						$targetDate = !empty($jadwal_upcoming) ?
							($jadwal_upcoming[0]['tanggal'] . ' ' . ($jadwal_upcoming[0]['jam'] ?? '00:00')) :
							date('Y-m-d H:i:s', strtotime('+7 days'));
						?>
						<ul id="countdown" class="count-down"
							data-date="<?= date('M d, Y H:i:s', strtotime($targetDate)) ?>">
							<li>
								<span class="days">00</span>
								<p>Days</p>
							</li>
							<li>
								<span class="hours">00</span>
								<p>Hours</p>
							</li>
							<li>
								<span class="minutes">00</span>
								<p>Mins</p>
							</li>
							<li>
								<span class="seconds">00</span>
								<p>Secs</p>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-12 text-center text-lg-end">
					<div class="event__right">
						<a href="<?= base_url('jadwal') ?>" class="default-btn">ALL EVENTS</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ================> Event section end here <================== -->


<!-- ================> About section start here <================== -->
<section class="about padding--top padding--bottom">
	<div class="container">
		<div class="row g-4 justify-content-center">
			<div class="col-lg-6 col-12">
				<div class="about__thumb">
					<img src="<?= base_url('public/assets/images/about/01.jpg') ?>" alt="about thumb" class="w-100">
					<div class="about__thumb-content">
						<h2>10+</h2>
						<p>Years of Ministry</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-12">
				<div class="about__content">
					<div class="section__header">
						<h2>Visi & Misi <?= esc($konfigurasi->nama) ?></h2>
						<p><?= esc($konfigurasi->deskripsi) ?></p>
					</div>
					<div class="section__wrapper">
						<ul>
							<li>
								<div class="about__item-inner">
									<div class="about__item-thumb">
										<img src="<?= base_url('public/assets/images/logo/01.png') ?>" alt="about icon">
									</div>
									<div class="about__item-content">
										<h4>Faith & Worship</h4>
										<p>Membangun iman jemaat melalui persekutuan dan ibadah yang tulus kepada Tuhan.
										</p>
									</div>
								</div>
							</li>
							<li>
								<div class="about__item-inner">
									<div class="about__item-thumb">
										<img src="<?= base_url('public/assets/images/logo/02.png') ?>" alt="about icon">
									</div>
									<div class="about__item-content">
										<h4>Community Service</h4>
										<p>Melayani sesama dengan kasih Kristus melalui berbagai aksi sosial dan
											kemanusiaan.</p>
									</div>
								</div>
							</li>
							<li>
								<div class="about__item-inner">
									<div class="about__item-thumb">
										<img src="<?= base_url('public/assets/images/logo/01.png') ?>" alt="about icon">
									</div>
									<div class="about__item-content">
										<h4>Spiritual Growth</h4>
										<p>Memberikan pengajaran Alkitab yang mendalam untuk pertumbuhan rohani setiap
											jemaat.</p>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ================> About section end here <================== -->


<!-- ================> Gallery section start here <================== -->
<section class="gallery padding--top padding--bottom bg-img"
	style="background-image: url('<?= base_url('public/assets/images/bg-img/02.jpg') ?>');">
	<div class="container">
		<div class="section__header text-center">
			<h2>Our Church Gallery</h2>
			<p>Momen-momen pelayanan dan kebersamaan jemaat dalam balutan kasih Tuhan.</p>
		</div>
		<div class="section__wrapper">
			<div class="row g-4 justify-content-center">
				<?php if (!empty($photos)): ?>
					<?php foreach ($photos as $photo): ?>
						<div class="col-lg-4 col-sm-6 col-12">
							<div class="gallery__item">
								<div class="gallery__inner">
									<div class="gallery__thumb">
										<a href="<?= base_url('public/img/galeri/foto/' . $photo['gambar']) ?>"
											data-rel="lightcase">
											<img src="<?= base_url('public/img/galeri/foto/' . $photo['gambar']) ?>"
												alt="gallery" class="w-100" style="height: 250px; object-fit: cover;">
										</a>
									</div>
									<div class="gallery__content text-center">
										<a href="<?= base_url('public/img/galeri/foto/' . $photo['gambar']) ?>"
											data-rel="lightcase">
											<h5><?= esc($photo['judul']) ?></h5>
										</a>
										<p><?= date('d M Y', strtotime($photo['tanggal'])) ?></p>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="col-12 text-center text-white">
						<p>No photos available yet.</p>
					</div>
				<?php endif; ?>
			</div>
			<div class="text-center mt-5">
				<a href="<?= base_url('foto') ?>" class="default-btn"><span>View More <i
							class="fas fa-images"></i></span></a>
			</div>
		</div>
	</div>
</section>
<!-- ================> Gallery section end here <================== -->


<!-- ================> Feature section start here <================== -->
<section class="feature padding--top padding--bottom">
	<div class="container">
		<div class="section__header text-center">
			<h2>Recent Activities & Events</h2>
			<p>Ikuti berbagai kegiatan dan acara yang kami selenggarakan untuk kemuliaan nama Tuhan.</p>
		</div>
		<div class="section__wrapper">
			<div class="row g-4 justify-content-center">
				<?php if (!empty($jadwal_upcoming)): ?>
					<?php foreach (array_slice($jadwal_upcoming, 0, 3) as $event): ?>
						<div class="col-lg-4 col-sm-6 col-12">
							<div class="feature__item">
								<div class="feature__inner text-center">
									<div class="feature__thumb">
										<img src="<?= base_url('public/assets/images/event/01.jpg') ?>" alt="feature icon">
									</div>
									<div class="feature__content">
										<h4><?= esc($event['nama_kegiatan']) ?></h4>
										<p><i class="far fa-calendar-alt text-danger"></i>
											<?= date('d M Y', strtotime($event['tanggal'])) ?> | <i
												class="far fa-clock text-danger"></i> <?= substr($event['jam'], 0, 5) ?></p>
										<p><?= esc($event['keterangan'] ?? 'Pelayanan rutin jemaat.') ?></p>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<!-- ================> Feature section end here <================== -->


<!-- ================> Sermon section start here <================== -->
<section class="sermon padding--top padding--bottom bg-img"
	style="background-image: url('<?= base_url('public/assets/images/bg-img/03.jpg') ?>');">
	<div class="container">
		<div class="section__header text-center headline">
			<h2>Latest Announcements</h2>
			<p>Informasi penting dan warta gereja yang perlu diketahui oleh seluruh jemaat.</p>
		</div>
		<div class="section__wrapper">
			<div class="row g-4 justify-content-center">
				<?php if (!empty($pengumuman)): ?>
					<?php foreach (array_slice($pengumuman, 0, 3) as $p): ?>
						<div class="col-lg-4 col-sm-6 col-12">
							<div class="sermon__item">
								<div class="sermon__inner">
									<div class="sermon__thumb">
										<img src="<?= base_url('public/assets/images/sermon/01.jpg') ?>" alt="sermon thumb"
											class="w-100">
										<div class="sermon__date">
											<h6><?= date('d', strtotime($p['tgl_pengumuman'])) ?></h6>
											<p><?= date('M', strtotime($p['tgl_pengumuman'])) ?></p>
										</div>
									</div>
									<div class="sermon__content">
										<h4><a
												href="<?= base_url('pengumuman/' . $p['slug_pengumuman']) ?>"><?= esc($p['judul_pengumuman']) ?></a>
										</h4>
										<p><?= esc(substr(strip_tags($p['isi_pengumuman']), 0, 100)) ?>...</p>
										<div class="sermon__footer">
											<a href="<?= base_url('pengumuman/' . $p['slug_pengumuman']) ?>"
												class="text-btn">Read More</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<!-- ================> Sermon section end here <================== -->


<!-- ================> Cause section start here <================== -->
<section class="cause padding--top padding--bottom">
	<div class="container">
		<div class="section__header text-center">
			<h2>Our Primary Ministries</h2>
			<p>Dukung dan doakan berbagai bidang pelayanan kami untuk menjangkau jiwa-jiwa bagi Kristus.</p>
		</div>
		<div class="section__wrapper">
			<div class="row g-4 justify-content-center">
				<div class="col-lg-4 col-sm-6 col-12">
					<div class="cause__item">
						<div class="cause__inner">
							<div class="cause__thumb">
								<img src="<?= base_url('public/assets/images/blog/01.jpg') ?>" alt="cause thumb"
									class="w-100">
							</div>
							<div class="cause__content text-center">
								<h4>Misi Penginjilan</h4>
								<p>Memberitakan kabar baik ke seluruh pelosok dunia.</p>
								<a href="<?= base_url('donasi') ?>" class="default-btn"><span>Support Us <i
											class="fas fa-heart"></i></span></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6 col-12">
					<div class="cause__item">
						<div class="cause__inner">
							<div class="cause__thumb">
								<img src="<?= base_url('public/assets/images/blog/02.jpg') ?>" alt="cause thumb"
									class="w-100">
							</div>
							<div class="cause__content text-center">
								<h4>Pendidikan Kristen</h4>
								<p>Mendidik generasi muda dengan nilai-nilai Alkitabiah.</p>
								<a href="<?= base_url('donasi') ?>" class="default-btn"><span>Support Us <i
											class="fas fa-heart"></i></span></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6 col-12">
					<div class="cause__item">
						<div class="cause__inner">
							<div class="cause__thumb">
								<img src="<?= base_url('public/assets/images/blog/03.jpg') ?>" alt="cause thumb"
									class="w-100">
							</div>
							<div class="cause__content text-center">
								<h4>Aksi Sosial</h4>
								<p>Membantu sesama yang membutuhkan di sekitar kita.</p>
								<a href="<?= base_url('donasi') ?>" class="default-btn"><span>Support Us <i
											class="fas fa-heart"></i></span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ================> Cause section end here <================== -->


<!-- ================> Blog section start here <================== -->
<section class="blog padding--top padding--bottom bg-gray">
	<div class="container">
		<div class="section__header text-center">
			<h2>Latest Warta & Articles</h2>
			<p>Dapatkan inspirasi dan kabar terbaru melalui artikel dan warta jemaat kami.</p>
		</div>
		<div class="section__wrapper">
			<div class="row g-4 justify-content-center">
				<?php if (!empty($latestNews)): ?>
					<?php foreach ($latestNews as $news): ?>
						<div class="col-lg-4 col-md-6 col-12">
							<div class="blog__item">
								<div class="blog__inner">
									<div class="blog__thumb">
										<a href="<?= base_url('news/' . $news['slug']) ?>">
											<img src="<?= image_url($news['featured_image'], 'public/img/informasi/berita/', 'public/assets/images/blog/01.jpg') ?>"
												alt="blog thumb" class="w-100" style="height: 250px; object-fit: cover;">
										</a>
										<div class="blog__category">
											<?= esc($newsCategories[$news['category']] ?? 'Warta') ?>
										</div>
									</div>
									<div class="blog__content">
										<a href="<?= base_url('news/' . $news['slug']) ?>">
											<h4><?= esc($news['title']) ?></h4>
										</a>
										<ul class="blog__meta">
											<li><i class="far fa-calendar-alt"></i>
												<?= date('d M Y', strtotime($news['published_at'])) ?></li>
											<li><i class="far fa-eye"></i> <?= number_format($news['views']) ?></li>
										</ul>
										<p><?= esc(strip_tags($news['content'] ?? '')) ?></p>
										<a href="<?= base_url('news/' . $news['slug']) ?>" class="text-btn">Read More <i
												class="fas fa-long-arrow-alt-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<div class="text-center mt-5">
				<a href="<?= base_url('news') ?>" class="default-btn"><span>Check Latest News <i
							class="fas fa-newspaper"></i></span></a>
			</div>
		</div>
	</div>
</section>
<!-- ================> Blog section end here <================== -->


<!-- ================> Product section start here <================== -->
<section class="product padding--top padding--bottom">
	<div class="container">
		<div class="section__header text-center">
			<h2>UMKM Jemaat</h2>
			<p>Dukung perekonomian jemaat dengan membeli berbagai produk unggulan hasil karya jemaat kami.</p>
		</div>
		<div class="section__wrapper">
			<div class="product__slider overflow-hidden">
				<div class="swiper-wrapper">
					<?php if (!empty($latestProducts)): ?>
						<?php foreach ($latestProducts as $product): ?>
							<?php $images = json_decode($product['images'] ?? '[]', true) ?: []; ?>
							<?php $cover = $images[0] ?? 'no_image.png'; ?>
							<div class="swiper-slide">
								<div class="product__item">
									<div class="product__inner">
										<div class="product__thumb">
											<?php if (!empty($product['discount_price'])): ?>
												<div class="product__badge">Sale</div>
											<?php endif; ?>
											<img src="<?= image_url($cover, 'public/img/produk/', 'public/img/no_image.png') ?>"
												alt="product" class="w-100" style="height: 250px; object-fit: cover;">
											<div class="product__action">
												<a href="<?= base_url('umkm/produk/' . $product['slug']) ?>"
													title="View Product">
													<i class="far fa-eye"></i>
												</a>
												<a href="<?= base_url('cart/add/' . $product['id']) ?>" title="Add to Cart">
													<i class="fas fa-shopping-cart"></i>
												</a>
											</div>
										</div>
										<div class="product__content text-center">
											<a href="<?= base_url('umkm/produk/' . $product['slug']) ?>">
												<h5><?= esc($product['name']) ?></h5>
											</a>
											<p class="price">
												<?php if (!empty($product['discount_price'])): ?>
													<span>Rp <?= number_format($product['discount_price'], 0, ',', '.') ?></span>
													<del>Rp <?= number_format($product['price'], 0, ',', '.') ?></del>
												<?php else: ?>
													<span>Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
												<?php endif ?>
											</p>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div class="product__pagination"></div>
			</div>
			<div class="text-center mt-5">
				<a href="<?= base_url('umkm') ?>" class="default-btn"><span>Shop All Products <i
							class="fas fa-shopping-bag"></i></span></a>
			</div>
		</div>
	</div>
</section>
<!-- ================> Product section end here <================== -->


<!-- ================> Sponsor section start here <================== -->
<section class="sponsor padding--top padding--bottom bg-gray">
	<div class="container">
		<div class="section__header text-center d-none">
			<h2>Our Partners</h2>
		</div>
		<div class="section__wrapper">
			<div class="sponsor__slider overflow-hidden">
				<div class="swiper-wrapper">
					<?php if (!empty($linkterkaitall)): ?>
						<?php foreach ($linkterkaitall as $link): ?>
							<div class="swiper-slide">
								<div class="sponsor__item">
									<div class="sponsor__thumb">
										<a href="<?= esc($link['url']) ?>" target="_blank">
											<img src="<?= image_url($link['gambar'], 'public/img/linkterkait/', 'public/assets/images/sponsor/01.png') ?>"
												alt="sponsor" style="max-height: 80px; filter: grayscale(100%); opacity: 0.6;">
										</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ================> Sponsor section end here <================== -->

<?= $this->section('scripts') ?>
<script>
	$(document).ready(function () {
		var swiper = new Swiper('.product__slider', {
			slidesPerView: 1,
			spaceBetween: 20,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			},
			loop: true,
			pagination: {
				el: ".product__pagination",
				clickable: true,
			},
			breakpoints: {
				1200: {
					slidesPerView: 4,
				},
				992: {
					slidesPerView: 3,
				},
				576: {
					slidesPerView: 2,
				},
			},
		});
	});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>