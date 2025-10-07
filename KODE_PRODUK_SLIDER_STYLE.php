<!-- ================================================== -->
<!-- GANTI KODE SECTION PRODUK UMKM DI v_home.php -->
<!-- DENGAN KODE INI UNTUK STYLE SLIDER SEPERTI INFOGRAFIS -->
<!-- ================================================== -->

        <!-- ================================================== -->
        <!-- Begin Produk UMKM Section (Slider Style)
        ================================================== -->
        <?php 
        use App\Models\M_ProdukUmkm;
        $produk_model = new M_ProdukUmkm();
        $produk_featured = $produk_model->featured()->limit(8)->get()->getResultArray();
        
        if ($produk_featured) : ?>
        
        <div class="container bg-success ">
            <div class="row infographic-text ">
                <div class="col-md-5 px-5">
                    <p>
                    <h1 class="montserrat-800 f-20 text-white p-2">
                        <i class="fas fa-shopping-bag"></i> Produk UMKM Jemaat
                    </h1>
                </div>
                <div class="col-md-2 mt-2 text-center">
                    <div class="carousel-controls">
                        <a class="produk-slider-prev carousel-control-prev-icon mr-3" href="#produk-slider" role="button" data-slide="prev" aria-hidden="true"></a>
                        <a class="produk-slider-next carousel-control-next-icon" href="#produk-slider" role="button" data-slide="next" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="col mt-3 text-center">
                    <a class="infographoc-see-all f-24 text-white montserrat-400" href="<?= base_url('toko') ?>">Lihat Semua</a>
                </div>
            </div>
        </div>

        <section class="content bg-success pr-0 pl-0 pt-0 pb-4">
            <div id="produk-slider">
                <?php foreach ($produk_featured as $produk) : 
                    $harga_tampil = !empty($produk['harga_promo']) ? $produk['harga_promo'] : $produk['harga'];
                    $diskon = 0;
                    if (!empty($produk['harga_promo'])) {
                        $diskon = round((($produk['harga'] - $produk['harga_promo']) / $produk['harga']) * 100);
                    }
                ?>
                    <div class="slider-item">
                        <div class="card h-100 shadow-sm product-card-slider">
                            <div class="position-relative">
                                <a href="<?= base_url('toko/' . $produk['slug_produk']) ?>">
                                    <img src="<?= base_url('/public/img/produk/' . $produk['gambar']) ?>" 
                                         class="card-img-top" alt="<?= esc($produk['nama_produk']) ?>"
                                         style="height: 250px; object-fit: cover; width: 100%;">
                                </a>
                                <?php if ($diskon > 0) : ?>
                                    <span class="badge badge-danger position-absolute" style="top: 10px; right: 10px; font-size: 14px;">
                                        -<?= $diskon ?>%
                                    </span>
                                <?php endif; ?>
                                <span class="badge badge-warning position-absolute" style="top: 10px; left: 10px;">
                                    <i class="fas fa-star"></i> Featured
                                </span>
                            </div>
                            <div class="card-body text-center">
                                <h6 class="card-title mb-2">
                                    <a href="<?= base_url('toko/' . $produk['slug_produk']) ?>" class="text-dark">
                                        <?= esc($produk['nama_produk']) ?>
                                    </a>
                                </h6>
                                <div class="mb-3">
                                    <?php if (!empty($produk['harga_promo'])) : ?>
                                        <small class="text-muted" style="text-decoration: line-through;">
                                            Rp <?= number_format($produk['harga'], 0, ',', '.') ?>
                                        </small><br>
                                    <?php endif; ?>
                                    <span class="text-primary font-weight-bold h5">
                                        Rp <?= number_format($harga_tampil, 0, ',', '.') ?>
                                    </span>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-box"></i> Stok: <?= $produk['stok'] ?>
                                    </small>
                                </div>
                                <a href="<?= base_url('toko/' . $produk['slug_produk']) ?>" class="btn btn-primary btn-sm btn-block">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>
        <!-- End Produk UMKM Section -->

<!-- ================================================== -->
<!-- CSS UNTUK PRODUK SLIDER -->
<!-- Tambahkan di bagian <style> atau sebelum </head> -->
<!-- ================================================== -->
<style>
/* Produk Slider Styles */
.product-card-slider {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin: 10px;
    border-radius: 10px;
    overflow: hidden;
}

.product-card-slider:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2) !important;
}

.product-card-slider .card-title a {
    text-decoration: none;
    transition: color 0.3s ease;
}

.product-card-slider .card-title a:hover {
    color: #007bff !important;
}

#produk-slider .slick-slide {
    padding: 0 10px;
}

#produk-slider .slick-list {
    margin: 0 -10px;
}

/* Carousel Controls untuk Produk */
.produk-slider-prev,
.produk-slider-next {
    cursor: pointer;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.produk-slider-prev:hover,
.produk-slider-next:hover {
    opacity: 1;
}
</style>

<!-- ================================================== -->
<!-- JAVASCRIPT UNTUK PRODUK SLIDER -->
<!-- Tambahkan sebelum </body> atau di bagian script -->
<!-- ================================================== -->
<script>
$(document).ready(function() {
    // Initialize Produk Slider
    $('#produk-slider').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    // Custom navigation buttons
    $('.produk-slider-prev').on('click', function() {
        $('#produk-slider').slick('slickPrev');
    });

    $('.produk-slider-next').on('click', function() {
        $('#produk-slider').slick('slickNext');
    });
});
</script>
