<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3><?= esc($product['name']) ?></h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('umkm') ?>">Produk UMKM</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= esc($product['category_name'] ?? 'Detail') ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ===========Shop Single Section Starts Here========== -->
<div class="shop-single padding--top padding--bottom bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12">
                <article>
                    <div class="product-details">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-12">
                                <div class="product-thumb overflow-hidden">
                                    <div class="swiper-container pro-single-top">
                                        <div class="swiper-wrapper">
                                            <?php if (!empty($images)): ?>
                                                    <?php foreach ($images as $image): ?>
                                                            <div class="swiper-slide">
                                                                <div class="single-thumb">
                                                                    <img src="<?= base_url('public/img/produk/' . $image) ?>" 
                                                                         alt="<?= esc($product['name']) ?>" 
                                                                         class="w-100 rounded-3" 
                                                                         style="object-fit: cover; height: 450px;">
                                                                </div>
                                                            </div>
                                                    <?php endforeach; ?>
                                            <?php else: ?>
                                                    <div class="swiper-slide">
                                                        <div class="single-thumb">
                                                            <img src="<?= base_url('public/assets/images/shop/01.jpg') ?>" 
                                                                 alt="<?= esc($product['name']) ?>" 
                                                                 class="w-100 rounded-3"
                                                                 style="object-fit: cover; height: 450px;">
                                                        </div>
                                                    </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <?php if (count($images) > 1): ?>
                                            <div class="swiper-container pro-single-thumbs overflow-hidden mt-3">
                                                <div class="swiper-wrapper">
                                                    <?php foreach ($images as $image): ?>
                                                            <div class="swiper-slide">
                                                                <div class="single-thumb">
                                                                    <img src="<?= base_url('public/img/produk/' . $image) ?>" 
                                                                         alt="<?= esc($product['name']) ?>" 
                                                                         class="rounded-2"
                                                                         style="object-fit: cover; height: 80px;">
                                                                </div>
                                                            </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="pro-single-next"><i class="fas fa-chevron-left"></i></div>
                                            <div class="pro-single-prev"><i class="fas fa-chevron-right"></i></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="post-content">
                                    <h4 class="mb-3 fw-bold"><?= esc($product['name']) ?></h4>
                                    
                                    <p class="rating mb-3">
                                        <?php
                                        $rating = $product['rating'] ?? 0;
                                        for ($i = 1; $i <= 5; $i++):
                                            ?>
                                                <i class="fa<?= $i <= $rating ? 's' : 'r' ?> fa-star text-warning"></i>
                                        <?php endfor; ?>
                                        <span class="text-muted ms-2">(<?= number_format($product['rating'] ?? 0, 1) ?>/5)</span>
                                    </p>
                                    
                                    <div class="mb-4">
                                        <?php if (!empty($product['discount_price'])): ?>
                                                <h3 class="text-primary fw-bold mb-1">
                                                    Rp <?= number_format($product['discount_price'], 0, ',', '.') ?>
                                                </h3>
                                                <p class="text-muted mb-0">
                                                    <del>Rp <?= number_format($product['price'], 0, ',', '.') ?></del>
                                                    <span class="badge bg-danger ms-2">
                                                        <?= round((($product['price'] - $product['discount_price']) / $product['price']) * 100) ?>% OFF
                                                    </span>
                                                </p>
                                        <?php else: ?>
                                                <h3 class="text-primary fw-bold mb-0">
                                                    Rp <?= number_format($product['price'], 0, ',', '.') ?>
                                                </h3>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-4">
                                        <span class="badge bg-light text-dark border me-2">
                                            <i class="fas fa-box text-primary"></i> Stok: <?= number_format($product['stock'] ?? 0) ?>
                                        </span>
                                        <span class="badge bg-light text-dark border me-2">
                                            <i class="fas fa-shopping-cart text-success"></i> <?= number_format($product['sold_count'] ?? 0) ?> Terjual
                                        </span>
                                        <span class="badge bg-light text-dark border">
                                            <i class="fas fa-tag text-warning"></i> <?= esc($product['category_name'] ?? 'Lainnya') ?>
                                        </span>
                                    </div>

                                    <h6 class="fw-bold mb-2">Deskripsi Produk</h6>
                                    <p class="text-muted" style="font-size: 0.95rem; line-height: 1.7;">
                                        <?= nl2br(esc($product['description'] ?? 'Deskripsi belum tersedia.')) ?>
                                    </p>

                                    <form action="<?= base_url('toko/addtocart') ?>" method="post" class="mt-4">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                                        <div class="row g-3 mb-4">
                                            <div class="col-auto">
                                                <label class="form-label fw-bold small">Jumlah</label>
                                                <div class="cart-plus-minus d-flex align-items-center">
                                                    <div class="dec qtybutton btn btn-outline-secondary px-3">-</div>
                                                    <input class="cart-plus-minus-box form-control text-center mx-2" 
                                                           type="text" 
                                                           name="qty" 
                                                           value="1" 
                                                           min="1" 
                                                           max="<?= $product['stock'] ?>"
                                                           style="width: 80px;">
                                                    <div class="inc qtybutton btn btn-outline-secondary px-3">+</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 d-md-flex">
                                            <button type="submit" 
                                                    class="default-btn flex-grow-1" 
                                                    <?= $product['stock'] < 1 ? 'disabled' : '' ?>>
                                                <span>
                                                    <i class="fas fa-shopping-cart me-2"></i>
                                                    <?= $product['stock'] < 1 ? 'Stok Habis' : 'Tambah ke Keranjang' ?>
                                                </span>
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Seller Info -->
                                    <div class="border-top mt-4 pt-4">
                                        <h6 class="fw-bold mb-3">Informasi Penjual</h6>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 50px;">
                                                    <i class="fas fa-user fa-lg text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 fw-bold"><?= esc($product['seller_name']) ?></h6>
                                                <p class="text-muted small mb-0">
                                                    <i class="fas fa-map-marker-alt me-1"></i>
                                                    <?= esc($product['seller_address'] ?: 'Alamat tidak tersedia') ?>
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <?php if (!empty($product['seller_phone'])): ?>
                                                <a href="https://wa.me/<?= preg_replace('/\D+/', '', $product['seller_phone']) ?>?text=Halo, saya tertarik dengan produk <?= urlencode($product['name']) ?>" 
                                                   target="_blank" 
                                                   class="btn btn-success w-100 mb-2">
                                                    <i class="fab fa-whatsapp me-2"></i> Hubungi via WhatsApp
                                                </a>
                                        <?php endif; ?>
                                        
                                        <a href="<?= base_url('umkm/pelapak/' . $product['seller_id']) ?>" 
                                           class="btn btn-outline-primary w-100">
                                            <i class="fas fa-store me-2"></i> Lihat Toko
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Info Tabs -->
                    <div class="review mt-5">
                        <ul class="review-nav lab-ul">
                            <li class="desc active" data-target="description-show">Informasi Produk</li>
                            <li class="rev" data-target="review-content-show">Spesifikasi</li>
                        </ul>
                        
                        <div class="review-content description-show">
                            <div class="description active">
                                <div class="p-4 bg-white rounded-3 border">
                                    <h5 class="fw-bold mb-3">Detail Produk</h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="d-flex py-2 border-bottom">
                                                <span class="text-muted" style="min-width: 150px;">Kategori</span>
                                                <span class="fw-semibold"><?= esc($product['category_name'] ?? 'Lainnya') ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex py-2 border-bottom">
                                                <span class="text-muted" style="min-width: 150px;">Minimal Order</span>
                                                <span class="fw-semibold"><?= number_format($product['min_order'] ?? 1) ?> <?= esc($product['unit'] ?? 'pcs') ?></span>
                                            </div>
                                        </div>
                                        <?php if (!empty($product['sku'])): ?>
                                                <div class="col-md-6">
                                                    <div class="d-flex py-2 border-bottom">
                                                        <span class="text-muted" style="min-width: 150px;">SKU</span>
                                                        <span class="fw-semibold"><?= esc($product['sku']) ?></span>
                                                    </div>
                                                </div>
                                        <?php endif; ?>
                                        <?php if (!empty($product['weight'])): ?>
                                                <div class="col-md-6">
                                                    <div class="d-flex py-2 border-bottom">
                                                        <span class="text-muted" style="min-width: 150px;">Berat</span>
                                                        <span class="fw-semibold"><?= number_format($product['weight'], 2) ?> kg</span>
                                                    </div>
                                                </div>
                                        <?php endif; ?>
                                        <div class="col-md-6">
                                            <div class="d-flex py-2 border-bottom">
                                                <span class="text-muted" style="min-width: 150px;">Stok Tersedia</span>
                                                <span class="fw-semibold text-success"><?= number_format($product['stock'] ?? 0) ?> unit</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex py-2 border-bottom">
                                                <span class="text-muted" style="min-width: 150px;">Terjual</span>
                                                <span class="fw-semibold"><?= number_format($product['sold_count'] ?? 0) ?> produk</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <h6 class="fw-bold mb-2">Deskripsi Lengkap</h6>
                                        <p class="text-muted" style="line-height: 1.8;">
                                            <?= nl2br(esc($product['description'] ?? 'Deskripsi lengkap belum tersedia.')) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="review-showing">
                                <div class="p-4 bg-white rounded-3 border">
                                    <h5 class="fw-bold mb-3">Spesifikasi Teknis</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Produk Original & Terpercaya</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Kualitas Terjamin</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Bisa Dikembalikan Jika Ada Cacat</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Pengiriman Aman & Cepat</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Produk UMKM Lokal</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Products -->
                    <?php if (!empty($relatedProducts)): ?>
                            <div class="mt-5 pt-4 border-top">
                                <div class="section__header text-center mb-4">
                                    <h2 class="fw-bold">Produk Terkait</h2>
                                    <p class="text-muted">Produk serupa yang mungkin Anda suka</p>
                                </div>
                                <div class="row g-4">
                                    <?php foreach (array_slice($relatedProducts, 0, 4) as $related): ?>
                                            <?php 
                                            // Convert to array if it's an object
                                            $relatedArray = is_array($related) ? $related : (array) $related;
                                            $relImages = !empty($relatedArray['gambar']) ? json_decode($relatedArray['gambar'], true) : [];
                                            if (!is_array($relImages)) $relImages = [$relatedArray['gambar']];
                                            $relCover = $relImages[0] ?? 'default.jpg';
                                            ?>
                                            <div class="col-lg-3 col-md-6 col-sm-6">
                                                <div class="shop-card text-center border rounded-3 overflow-hidden h-100 shadow-sm hover-shadow-lg transition">
                                                    <div class="shop-card__image position-relative">
                                                        <a href="<?= base_url('umkm/produk/' . $relatedArray['slug_produk']) ?>">
                                                            <img src="<?= base_url('public/img/produk/' . $relCover) ?>" 
                                                                 alt="<?= esc($relatedArray['nama_produk']) ?>" 
                                                                 class="w-100" 
                                                                 style="height: 200px; object-fit: cover;">
                                                        </a>
                                                        <?php if (!empty($relatedArray['harga_diskon'])): ?>
                                                                <span class="position-absolute top-0 end-0 m-2 badge bg-danger">
                                                                    <?= round((($relatedArray['harga'] - $relatedArray['harga_diskon']) / $relatedArray['harga']) * 100) ?>% OFF
                                                                </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="shop-card__content p-3">
                                                        <p class="text-muted small mb-1"><?= esc($relatedArray['nama_kategori'] ?? 'Lainnya') ?></p>
                                                        <h6 class="mb-2">
                                                            <a href="<?= base_url('umkm/produk/' . $relatedArray['slug_produk']) ?>" 
                                                               class="text-dark text-decoration-none hover-text-primary">
                                                                <?= esc(strlen($relatedArray['nama_produk']) > 40 ? substr($relatedArray['nama_produk'], 0, 40) . '...' : $relatedArray['nama_produk']) ?>
                                                            </a>
                                                        </h6>
                                                        <div class="shop-card__price">
                                                            <?php if (!empty($relatedArray['harga_diskon'])): ?>
                                                                    <span class="shop-card__price-new text-primary fw-bold">
                                                                        Rp <?= number_format($relatedArray['harga_diskon'], 0, ',', '.') ?>
                                                                    </span>
                                                                    <br>
                                                                    <span class="shop-card__price-old text-muted small">
                                                                        <del>Rp <?= number_format($relatedArray['harga'], 0, ',', '.') ?></del>
                                                                    </span>
                                                            <?php else: ?>
                                                                    <span class="shop-card__price-new text-primary fw-bold">
                                                                        Rp <?= number_format($relatedArray['harga'], 0, ',', '.') ?>
                                                                    </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                    <?php endif; ?>
                </article>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-3 col-md-7 col-12">
                <div class="sidebar">
                    <div class="sidebar__search">
                        <div class="section__header">
                            <h2>Cari Produk</h2>
                        </div>
                        <div class="section__wrapper">
                            <form action="<?= base_url('umkm') ?>" method="get">
                                <input type="text" name="q" placeholder="Cari produk...">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="sidebar__catagory">
                        <div class="section__header">
                            <h2>Kategori</h2>
                        </div>
                        <div class="section__wrapper">
                            <ul>
                                <li><a href="<?= base_url('umkm') ?>"><i class="fas fa-chevron-right"></i> Semua Produk</a></li>
                                <!-- Add dynamic categories here -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ===========Shop Single Section Ends Here========== -->

<style>
    .hover-shadow-lg:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        transform: translateY(-5px);
        transition: all 0.3s ease;
    }

    .hover-text-primary:hover {
        color: var(--primary-yellow, #ffc107) !important;
    }

    .transition {
        transition: all 0.3s ease;
    }

    .cart-plus-minus .qtybutton {
        cursor: pointer;
        user-select: none;
    }

    .review-nav li {
        cursor: pointer;
        padding: 12px 24px;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .review-nav li:hover,
    .review-nav li.active {
        border-bottom-color: var(--primary-yellow, #ffc107);
        color: var(--primary-yellow, #ffc107);
    }

    .review-content > div {
        display: none;
    }

    .review-content > div.active {
        display: block;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity buttons
    const decrementBtn = document.querySelector('.dec.qtybutton');
    const incrementBtn = document.querySelector('.inc.qtybutton');
    const qtyInput = document.querySelector('.cart-plus-minus-box');
    
    if (decrementBtn && incrementBtn && qtyInput) {
        decrementBtn.addEventListener('click', function() {
            let value = parseInt(qtyInput.value) || 1;
            if (value > 1) {
                qtyInput.value = value - 1;
            }
        });
        
        incrementBtn.addEventListener('click', function() {
            let value = parseInt(qtyInput.value) || 1;
            let max = parseInt(qtyInput.getAttribute('max')) || 999;
            if (value < max) {
                qtyInput.value = value + 1;
            }
        });
    }

    // Tab switching
    document.querySelectorAll('.review-nav li').forEach(tab => {
        tab.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            
            // Remove active class from all tabs
            document.querySelectorAll('.review-nav li').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Hide all content
            document.querySelectorAll('.review-content > div').forEach(content => {
                content.classList.remove('active');
            });
            
            // Show target content
            if (target === 'description-show') {
                document.querySelector('.description').classList.add('active');
            } else {
                document.querySelector('.review-showing').classList.add('active');
            }
        });
    });

// Override default Swiper initialization for product detail
$(function() {
    // Only initialize if elements exist
    if ($('.pro-single-top').length && $('.pro-single-thumbs').length) {
        var galleryThumbs = new Swiper('.pro-single-thumbs', {
            spaceBetween: 10,
            slidesPerView: 3,
            loop: true,
            freeMode: true,
            loopedSlides: 2,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            navigation: {
                nextEl: '.pro-single-next',
                prevEl: '.pro-single-prev',
            },
        });
        
        var galleryTop = new Swiper('.pro-single-top', {
            spaceBetween: 10,
            loop: true,
            loopedSlides: 1,
            thumbs: {
                swiper: galleryThumbs,
            },
        });
    } else if ($('.pro-single-top').length) {
        // Single image, no thumbnails
        var galleryTop = new Swiper('.pro-single-top', {
            spaceBetween: 10,
            loop: false,
        });
    }
});
});
</script>

<?= $this->endSection() ?>
