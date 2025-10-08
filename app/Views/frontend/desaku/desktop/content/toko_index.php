<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<section class="container mt-lg-0 mt-0 pb-1">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h4 class="f-20 montserrat-700 text-light-blue">Toko UMKM</h4>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?= base_url('toko/keranjang') ?>" class="btn btn-success btn-lg position-relative">
                <i class="fas fa-shopping-cart"></i> Keranjang Saya
                <span class="badge badge-danger position-absolute cart-badge" id="cart-count" style="top: -5px; right: -5px;">0</span>
            </a>
        </div>
    </div>
</section>

<section class="container pb-4">
    <div class="card p-3">
        <div class="row">
            <!-- Sidebar Kategori -->
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-tags"></i> Kategori Produk</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="<?= base_url('toko') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-th-large"></i> Semua Produk
                        </a>
                        <?php foreach ($kategori as $kat) : ?>
                            <a href="<?= base_url('toko/kategori/' . $kat['slug_kategori']) ?>" class="list-group-item list-group-item-action">
                                <i class="fas fa-folder"></i> <?= esc($kat['nama_kategori']) ?>
                                <span class="badge badge-primary badge-pill float-right"><?= $kat['jml_produk'] ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Produk Featured -->
                <?php if ($featured) : ?>
                    <div class="card mb-3">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-star"></i> Produk Unggulan</h5>
                        </div>
                        <div class="card-body p-2">
                            <?php foreach ($featured as $feat) : 
                                $harga_tampil = !empty($feat['harga_promo']) ? $feat['harga_promo'] : $feat['harga'];
                            ?>
                                <div class="media mb-3 border-bottom pb-2">
                                    <img src="<?= base_url('/public/img/produk/' . $feat['gambar']) ?>" 
                                         class="mr-2" width="60" height="60" style="object-fit: cover;">
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1">
                                            <a href="<?= base_url('toko/' . $feat['slug_produk']) ?>" class="text-dark">
                                                <?= esc($feat['nama_produk']) ?>
                                            </a>
                                        </h6>
                                        <p class="mb-0 text-primary font-weight-bold">
                                            Rp <?= number_format($harga_tampil, 0, ',', '.') ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Produk List -->
            <div class="col-md-9">
                <!-- Search Bar -->
                <div class="card mb-3">
                    <div class="card-body p-2">
                        <form action="<?= base_url('toko/search') ?>" method="get">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Cari produk..." required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <h1 class="text-blue montserrat-700 f-24 mb-3">
                    <i class="fas fa-shopping-bag"></i> Semua Produk
                </h1>

                <?php if ($produk) : ?>
                    <div class="row">
                        <?php foreach ($produk as $item) : 
                            $harga_tampil = !empty($item['harga_promo']) ? $item['harga_promo'] : $item['harga'];
                            $diskon = 0;
                            if (!empty($item['harga_promo'])) {
                                $diskon = round((($item['harga'] - $item['harga_promo']) / $item['harga']) * 100);
                            }
                        ?>
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="card h-100 shadow-sm product-card">
                                    <div class="position-relative">
                                        <a href="<?= base_url('toko/' . $item['slug_produk']) ?>">
                                            <img src="<?= base_url('/public/img/produk/' . $item['gambar']) ?>" 
                                                 class="card-img-top" alt="<?= esc($item['nama_produk']) ?>"
                                                 style="height: 200px; object-fit: cover;">
                                        </a>
                                        <?php if ($diskon > 0) : ?>
                                            <span class="badge badge-danger position-absolute" style="top: 10px; right: 10px;">
                                                -<?= $diskon ?>%
                                            </span>
                                        <?php endif; ?>
                                        <?php if ($item['featured'] == '1') : ?>
                                            <span class="badge badge-warning position-absolute" style="top: 10px; left: 10px;">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <small class="text-muted">
                                            <i class="fas fa-folder"></i> <?= esc($item['nama_kategori']) ?>
                                        </small>
                                        <h5 class="card-title mt-1">
                                            <a href="<?= base_url('toko/' . $item['slug_produk']) ?>" class="text-dark">
                                                <?= esc($item['nama_produk']) ?>
                                            </a>
                                        </h5>
                                        <div class="mb-2">
                                            <?php if (!empty($item['harga_promo'])) : ?>
                                                <span class="text-muted" style="text-decoration: line-through;">
                                                    Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                                                </span><br>
                                            <?php endif; ?>
                                            <span class="text-primary font-weight-bold h5">
                                                Rp <?= number_format($harga_tampil, 0, ',', '.') ?>
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="fas fa-box"></i> Stok: <?= $item['stok'] ?>
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-eye"></i> <?= $item['hits'] ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-white">
                                        <button class="btn btn-primary btn-block btn-add-cart" 
                                                data-id="<?= $item['id_produk'] ?>"
                                                data-nama="<?= esc($item['nama_produk']) ?>">
                                            <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <?= $pager->links('produk', 'bootstrap_pagination') ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Belum ada produk yang tersedia.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
.product-card {
    transition: transform 0.3s ease;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.product-card .card-title a:hover {
    color: #007bff !important;
}
</style>

<script>
$(document).ready(function() {
    // Add to cart
    $('.btn-add-cart').click(function() {
        let id_produk = $(this).data('id');
        let nama_produk = $(this).data('nama');
        let btn = $(this);
        
        $.ajax({
            url: '<?= base_url('toko/addtocart') ?>',
            type: 'POST',
            data: {
                <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                id_produk: id_produk,
                jumlah: 1
            },
            dataType: 'json',
            beforeSend: function() {
                btn.prop('disabled', true);
                btn.html('<i class="fas fa-spinner fa-spin"></i> Menambahkan...');
            },
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: nama_produk + ' ditambahkan ke keranjang',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    // Update cart count
                    updateCartCount();
                } else if (response.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.error
                    });
                }
            },
            complete: function() {
                btn.prop('disabled', false);
                btn.html('<i class="fas fa-shopping-cart"></i> Tambah ke Keranjang');
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan. Silahkan coba lagi.'
                });
                btn.prop('disabled', false);
                btn.html('<i class="fas fa-shopping-cart"></i> Tambah ke Keranjang');
            }
        });
    });
    
    // Update cart count
    function updateCartCount() {
        $.ajax({
            url: '<?= base_url('toko/cartcount') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.count > 0) {
                    $('#cart-count').text(response.count).show();
                } else {
                    $('#cart-count').text('0');
                }
            }
        });
    }
    
    // Load cart count on page load
    updateCartCount();
});
</script>

<style>
.btn.position-relative {
    overflow: visible;
}

.cart-badge {
    min-width: 20px;
    height: 20px;
    border-radius: 10px;
    font-size: 11px;
    line-height: 20px;
    padding: 0 6px;
}

@media (max-width: 768px) {
    .btn-success.btn-lg {
        font-size: 14px;
        padding: 8px 15px;
    }
}
</style>

<?= $this->endSection() ?>
