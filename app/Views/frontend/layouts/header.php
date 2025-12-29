<?php
helper('dge');
$konfigurasi = (new \App\Models\ModelKonfigurasi())->vkonfig();
$siteLogo = image_url($konfigurasi->logo, 'public/img/konfigurasi/logo/', 'public/img/konfigurasi/logo/default.png');
$siteLogoAlt = $konfigurasi->nama;
$siteIcon = image_url($konfigurasi->icon, 'public/img/konfigurasi/icon/', 'public/assets/images/favicons/favicon-32x32.png');
if (!file_exists(ROOTPATH . 'public/img/konfigurasi/icon/' . $konfigurasi->icon)) {
	$siteIcon = base_url('public/img/konfigurasi/icon/icon.png');
}
$siteAddress = $konfigurasi->alamat;
$siteCity = $konfigurasi->kabupaten;
$siteEmail = $konfigurasi->email;
$sitePhone = $konfigurasi->no_telp;
$siteTicker = $konfigurasi->namasingkat ?: $siteLogoAlt;
$tickerLetters = preg_split('//u', trim($siteTicker), -1, PREG_SPLIT_NO_EMPTY);

// Menu Models
$menuModel = new \App\Models\ModelMenu();
$submenuModel = new \App\Models\ModelSubMenu();
$subsubmenuModel = new \App\Models\ModelSubsubMenu();
$mainmenus = $menuModel->mainmenu();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= esc($title ?? $konfigurasi->nama) ?></title>
	<link rel="shortcut icon" href="<?= $siteIcon ?>" type="image/x-icon">

	<link rel="stylesheet" href="<?= base_url('public/assets/css/animate.css') ?>">
	<link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('public/assets/css/all.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('public/assets/css/swiper.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('public/assets/css/lightcase.css') ?>">

	<!-- main css for template -->
	<link rel="stylesheet" href="<?= base_url('public/assets/css/style.min.css') ?>">

	<!-- Google Fonts -->
	<link
		href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Pacifico&display=swap"
		rel="stylesheet">

	<!-- Custom Homepage CSS -->
	<link rel="stylesheet" href="<?= base_url('public/assets/css/custom-home.css') ?>">

	<?= $this->renderSection('meta') ?>
</head>

<body>

	<!-- ================> preloader start here <================ -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- ================> preloader ending here <================ -->

	<!-- ================> Header Search <================ -->
	<div class="header-form">
		<div class="bg-lay">
			<div class="cross">
				<i class="fas fa-times"></i>
			</div>
		</div>
		<form class="form-container" action="<?= base_url('news') ?>" method="get">
			<input type="text" placeholder="Cari berita..." name="q">
			<button type="submit">Search</button>
		</form>
	</div>
	<!-- ================> Header Search <================ -->

	<!-- ================> Header Cart <================ -->
	<div class="overlay"></div>
	<div class="cart-sidebar-area">
		<div class="top-content">
			<img src="<?= $siteLogo ?>" alt="logo">
			<span class="side-sidebar-close-btn"><i class="fas fa-times"></i></span>
		</div>
		<div class="bottom-content">
			<div class="cart-products">
				<h4 class="title">Shopping cart</h4>
				<?php $cart = session('cart') ?? []; ?>
				<?php if (empty($cart)): ?>
					<p class="text-center">Keranjang masih kosong</p>
				<?php else: ?>
					<?php foreach ($cart as $id => $item): ?>
						<div class="single-product-item">
							<div class="thumb">
								<img src="<?= base_url('public/uploads/umkm/products/' . ($item['image'] ?? 'placeholder.jpg')) ?>"
									alt="product">
							</div>
							<div class="content">
								<h4 class="title"><?= esc($item['name']) ?></h4>
								<div class="price"><span class="pprice">Rp
										<?= number_format($item['price'], 0, ',', '.') ?></span></div>
								<a href="<?= base_url('cart/remove/' . $id) ?>" class="remove-cart">Remove</a>
							</div>
						</div>
					<?php endforeach; ?>
					<div class="btn-wrapper text-center">
						<a href="<?= base_url('cart') ?>" class="default-btn move-right"><span>Lihat Keranjang</span></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- ================> Header Cart <================ -->



	<!-- ================> header section start here <================== -->
	<header class="header">
		<div class="navbar-expand-xl">
			<div class="collapse navbar-collapse" id="menubar2">
				<div class="header__top w-100">
					<div class="container">
						<div class="header__top-area">
							<div class="header__top-left">
								<ul>
									<li>
										<i class="fas fa-phone-alt"></i>
										<?= esc($sitePhone) ?>
									</li>
									<li>
										<i class="fas fa-envelope"></i>
										<?= esc($siteEmail) ?>
									</li>
								</ul>
							</div>
							<div class="header__top-center">
								<div class="header__top-logo d-none d-md-block">
									<a href="<?= base_url() ?>">
										<img src="<?= $siteLogo ?>" alt="<?= esc($siteLogoAlt) ?>"
											style="max-height: 60px;">
									</a>
								</div>
							</div>
							<div class="header__top-right">
								<div class="header__top-socialsearch">
									<div class="header__top-social">
										<ul>
											<?php
											$socials = [
												'facebook' => $konfigurasi->sosmed_fb,
												'twitter' => $konfigurasi->sosmed_twiter,
												'instagram' => $konfigurasi->sosmed_instagram,
												'youtube' => $konfigurasi->sosmed_youtube,
											];
											?>
											<?php foreach ($socials as $key => $val): ?>
												<?php if ($val): ?>
													<li><a href="<?= esc($val) ?>"><i
																class="fab fa-<?= $key === 'youtube' ? 'youtube' : $key ?>"></i></a>
													</li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									</div>
									<div class="header__top-search">
										<ul>
											<li class="search__icon"><i class="fas fa-search"></i></li>
											<li class="cart__icon"><i
													class="fas fa-shopping-bag"></i><span><?= count($cart) ?></span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="header__bottom">
			<div class="container">
				<div class="header__mainmenu navbar navbar-expand-xl navbar-light">
					<div class="header__logo">
						<a href="<?= base_url() ?>" class="d-none d-xl-block">
							<img src="<?= $siteLogo ?>" alt="<?= esc($siteLogoAlt) ?>" style="max-height: 50px;">
						</a>
						<a href="<?= base_url() ?>" class="d-xl-none">
							<img src="<?= $siteLogo ?>" alt="<?= esc($siteLogoAlt) ?>" style="max-height: 40px;">
						</a>
					</div>
					<div class="header__bar">
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menubar"
							aria-controls="menubar" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<button class="navbar-toggler header__bar-info" type="button" data-bs-toggle="collapse"
							data-bs-target="#menubar2" aria-controls="menubar2" aria-expanded="false"
							aria-label="Toggle navigation">
							<span class="fas fa-info"></span>
						</button>
					</div>
					<div class="header__menu navbar-expand-xl">
						<div class="collapse navbar-collapse" id="menubar">
							<ul>
								<?php
								$uri = current_url(true);
								$current_path = $uri->getPath();
								?>
								<?php foreach ($mainmenus as $m):
									$submenus = $submenuModel->where('menu_id', $m['menu_id'])->where('stssubmenu', '1')->orderBy('urutansm', 'ASC')->findAll();
									$hasSub = !empty($submenus);

									$mLink = ($m['linkexternal'] == '1') ? $m['menu_link'] : base_url($m['menu_link']);
									$isCurrent = (trim($m['menu_link'], '/') == trim($current_path, '/')) || ($m['menu_link'] == '#' && $hasSub);
									if ($m['menu_link'] == '/' || empty($m['menu_link'])) {
										$isCurrent = ($current_path == '/' || empty($current_path));
									}
									?>
									<li
										class="<?= $isCurrent ? 'active' : '' ?> <?= $hasSub ? 'menu-item-has-children' : '' ?>">
										<a href="<?= $mLink ?>"><?= esc($m['nama_menu']) ?></a>
										<?php if ($hasSub): ?>
											<ul>
												<?php foreach ($submenus as $sm):
													$subsubmenus = $subsubmenuModel->where('submenu_id', $sm['submenu_id'])->where('stsssm', '1')->orderBy('urutanssm', 'ASC')->findAll();
													$hasSubSub = !empty($subsubmenus);
													$smLink = ($sm['linkexternalsm'] == '1') ? $sm['link_submenu'] : base_url($sm['link_submenu']);
													?>
													<li class="<?= $hasSubSub ? 'menu-item-has-children' : '' ?>">
														<a href="<?= $smLink ?>"><?= esc($sm['nama_submenu']) ?></a>
														<?php if ($hasSubSub): ?>
															<ul>
																<?php foreach ($subsubmenus as $ssm):
																	$ssmLink = ($ssm['linkexternalssm'] == '1') ? $ssm['link_subsubmenu'] : base_url($ssm['link_subsubmenu']);
																	?>
																	<li><a href="<?= $ssmLink ?>"><?= esc($ssm['nama_subsubmenu']) ?></a>
																	</li>
																<?php endforeach; ?>
															</ul>
														<?php endif; ?>
													</li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
								<li><a href="<?= base_url('contact') ?>">Contact Us</a></li>
							</ul>
							<a href="<?= base_url('pendaftaran') ?>" class="default-btn"><span>PENDAFTARAN <i
										class="fas fa-heart"></i></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- ================> header section end here <================== -->