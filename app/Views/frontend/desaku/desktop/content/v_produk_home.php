<!-- ================================================== -->
<!-- Produk Grid Section - Include this in v_home.php -->
<!-- ================================================== -->
<?php 
use App\Models\M_ProdukUmkm;
$produk_model = new M_ProdukUmkm();
$produk_all = $produk_model->where('status', 'Publish')->orderBy('tgl_input', 'DESC')->limit(8)->get()->getResultArray();

if ($produk_all) : ?>
<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h2 class="montserrat-800 text-black">
                <i class="fas fa-store"></i> Produk Terbaru
            </h2>
            <p class="text-muted">Dukung UMKM Jemaat dengan berbelanja produk lokal</p>
        </div>
    </div>
    
    <div class="row">
        <?php foreach ($produk_all as $produk) : 
            $harga_tampil = !empty($produk['harga_promo']) ? $produk['harga_promo'] : $produk['harga'];
            $diskon = 0;
            if (!empty($produk['harga_promo'])) {
                $diskon = round((($produk['harga'] - $produk['harga_promo']) / $produk['harga']) * 100);
            }
        ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm product-card-home">
                    <div class="position-relative">
                        <a href="<?= base_url('toko/' . $produk['slug_produk']) ?>">
                            <img src="<?= base_url('/public/img/produk/' . $produk['gambar']) ?>" 
                                 class="card-img-top" alt="<?= esc($produk['nama_produk']) ?>"
                                 style="height: 200px; object-fit: cover; width: 100%;">
                        </a>
                        <?php if ($diskon > 0) : ?>
                            <span class="badge badge-danger position-absolute" style="top: 10px; right: 10px;">
                                -<?= $diskon ?>%
                            </span>
                        <?php endif; ?>
                        <?php if ($produk['stok'] <= 0) : ?>
                            <span class="badge badge-secondary position-absolute" style="top: 10px; left: 10px;">
                                Habis
                            </span>
                        <?php elseif ($produk['stok'] <= 5) : ?>
                            <span class="badge badge-warning position-absolute" style="top: 10px; left: 10px;">
                                Stok Terbatas
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title mb-2">
                            <a href="<?= base_url('toko/' . $produk['slug_produk']) ?>" class="text-dark text-decoration-none">
                                <?= esc($produk['nama_produk']) ?>
                            </a>
                        </h6>
                        <div class="mb-2">
                            <?php if (!empty($produk['harga_promo'])) : ?>
                                <small class="text-muted" style="text-decoration: line-through;">
                                    Rp <?= number_format($produk['harga'], 0, ',', '.') ?>
                                </small><br>
                            <?php endif; ?>
                            <span class="text-primary font-weight-bold h6">
                                Rp <?= number_format($harga_tampil, 0, ',', '.') ?>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-box"></i> Stok: <?= $produk['stok'] ?>
                            </small>
                            <a href="<?= base_url('toko/' . $produk['slug_produk']) ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="<?= base_url('toko') ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-shopping-bag"></i> Lihat Semua Produk
            </a>
        </div>
    </div>
</div>
<?php endif; ?>

<style>
.product-card-home {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #e0e0e0;
}

.product-card-home:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.product-card-home .card-img-top {
    transition: transform 0.3s ease;
}

.product-card-home:hover .card-img-top {
    transform: scale(1.05);
}

.product-card-home .card-title a {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    min-height: 2.5em;
}

.product-card-home .card-title a:hover {
    color: #007bff !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .product-card-home .card-img-top {
        height: 180px !important;
    }
    
    .product-card-home .card-title {
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .product-card-home .card-img-top {
        height: 160px !important;
    }
}
</style>
