<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<?php
$harga_tampil = !empty($produk->harga_promo) ? $produk->harga_promo : $produk->harga;
$diskon = 0;
if (!empty($produk->harga_promo)) {
    $diskon = round((($produk->harga - $produk->harga_promo) / $produk->harga) * 100);
}
?>

<section class="container mt-lg-0 mt-0 pb-1">
    <div class="row align-items-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('toko') ?>">Toko</a></li>
                    <?php if (isset($produk->nama_kategori)) : ?>
                        <?php if (isset($produk->slug_kategori)) : ?>
                            <li class="breadcrumb-item"><a href="<?= base_url('toko/kategori/' . $produk->slug_kategori) ?>"><?= esc($produk->nama_kategori) ?></a></li>
                        <?php else : ?>
                            <li class="breadcrumb-item"><?= esc($produk->nama_kategori) ?></li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <li class="breadcrumb-item active"><?= esc($produk->nama_produk) ?></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-4 text-right">
            <a href="<?= base_url('toko/keranjang') ?>" class="btn btn-success position-relative">
                <i class="fas fa-shopping-cart"></i> Keranjang
                <span class="badge badge-danger position-absolute" id="cart-count" style="top: -5px; right: -5px;">0</span>
            </a>
        </div>
    </div>
</section>

<section class="container pb-4">
    <div class="card p-4">
        <div class="row">
            <!-- Gambar Produk -->
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <img src="<?= base_url('/public/img/produk/' . $produk->gambar) ?>" 
                         class="card-img-top" alt="<?= esc($produk->nama_produk) ?>"
                         style="width: 100%; height: 400px; object-fit: contain; background: #f8f9fa;">
                    
                    <?php if ($diskon > 0) : ?>
                        <span class="badge badge-danger position-absolute" style="top: 20px; right: 20px; font-size: 16px;">
                            HEMAT <?= $diskon ?>%
                        </span>
                    <?php endif; ?>
                    
                    <?php if ($produk->featured == '1') : ?>
                        <span class="badge badge-warning position-absolute" style="top: 20px; left: 20px; font-size: 14px;">
                            <i class="fas fa-star"></i> FEATURED
                        </span>
                    <?php endif; ?>
                </div>
                
                <!-- Share Buttons -->
                <div class="mt-3 text-center">
                    <p class="mb-2"><strong>Bagikan Produk:</strong></p>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>" target="_blank" class="btn btn-primary btn-sm mr-2">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?= current_url() ?>&text=<?= esc($produk->nama_produk) ?>" target="_blank" class="btn btn-info btn-sm mr-2">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                    <a href="https://wa.me/?text=<?= esc($produk->nama_produk) ?> - <?= current_url() ?>" target="_blank" class="btn btn-success btn-sm">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>

            <!-- Detail Produk -->
            <div class="col-md-7">
                <h1 class="text-blue montserrat-700 f-28 mb-2"><?= esc($produk->nama_produk) ?></h1>
                
                <div class="mb-3">
                    <span class="badge badge-primary">
                        <i class="fas fa-folder"></i> <?= esc($produk->nama_kategori) ?>
                    </span>
                    <span class="badge badge-secondary ml-2">
                        <i class="fas fa-eye"></i> <?= $produk->hits ?> views
                    </span>
                </div>

                <hr>

                <!-- Harga -->
                <div class="mb-4">
                    <?php if (!empty($produk->harga_promo)) : ?>
                        <div class="mb-2">
                            <span class="text-muted h5" style="text-decoration: line-through;">
                                Rp <?= number_format($produk->harga, 0, ',', '.') ?>
                            </span>
                            <span class="badge badge-danger ml-2">DISKON <?= $diskon ?>%</span>
                        </div>
                    <?php endif; ?>
                    <h2 class="text-primary font-weight-bold mb-0">
                        Rp <?= number_format($harga_tampil, 0, ',', '.') ?>
                    </h2>
                    <small class="text-muted">per <?= esc($produk->satuan) ?></small>
                </div>

                <!-- Info Stok & Berat -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body p-3">
                                <i class="fas fa-box text-primary"></i>
                                <strong>Stok:</strong> 
                                <?php if ($produk->stok > 0) : ?>
                                    <span class="text-success"><?= $produk->stok ?> <?= esc($produk->satuan) ?></span>
                                <?php else : ?>
                                    <span class="text-danger">Habis</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($produk->berat) : ?>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body p-3">
                                    <i class="fas fa-weight text-primary"></i>
                                    <strong>Berat:</strong> <?= $produk->berat ?> gram
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Form Pembelian -->
                <?php if ($produk->stok > 0 && $produk->status == '1') : ?>
                    <div class="card border-primary mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Beli Produk</h5>
                            <form id="formAddToCart">
                                <div class="form-group">
                                    <label>Jumlah:</label>
                                    <div class="input-group" style="max-width: 200px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary btn-minus" type="button">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="number" class="form-control text-center" id="jumlah" name="jumlah" 
                                               value="1" min="1" max="<?= $produk->stok ?>" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary btn-plus" type="button">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="text-muted">Maksimal: <?= $produk->stok ?></small>
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                                </button>
                                <a href="<?= base_url('toko/keranjang') ?>" class="btn btn-outline-primary btn-block">
                                    <i class="fas fa-shopping-bag"></i> Lihat Keranjang
                                </a>
                            </form>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i> Produk sedang tidak tersedia
                    </div>
                <?php endif; ?>

                <!-- Info Penjual -->
                <div class="card bg-light">
                    <div class="card-body">
                        <h6><i class="fas fa-user"></i> Informasi Penjual</h6>
                        <p class="mb-0">
                            <strong>Dikelola oleh:</strong> <?= esc($produk->fullname ?? 'Admin') ?><br>
                            <strong>Ditambahkan:</strong> <?= date_indo($produk->tgl_input) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi Produk -->
        <div class="row mt-4">
            <div class="col-12">
                <hr>
                <h3 class="text-blue montserrat-700 f-24 mb-3">
                    <i class="fas fa-info-circle"></i> Deskripsi Produk
                </h3>
                <div class="product-description">
                    <?= $produk->deskripsi ?>
                </div>
            </div>
        </div>

        <!-- Produk Terkait -->
        <?php if ($terkait) : ?>
            <div class="row mt-5">
                <div class="col-12">
                    <hr>
                    <h3 class="text-blue montserrat-700 f-24 mb-4">
                        <i class="fas fa-boxes"></i> Produk Terkait
                    </h3>
                    <div class="row">
                        <?php foreach ($terkait as $item) : 
                            $harga_item = !empty($item['harga_promo']) ? $item['harga_promo'] : $item['harga'];
                        ?>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <a href="<?= base_url('toko/' . $item['slug_produk']) ?>">
                                        <img src="<?= base_url('/public/img/produk/' . $item['gambar']) ?>" 
                                             class="card-img-top" alt="<?= esc($item['nama_produk']) ?>"
                                             style="height: 150px; object-fit: cover;">
                                    </a>
                                    <div class="card-body p-2">
                                        <h6 class="card-title mb-1">
                                            <a href="<?= base_url('toko/' . $item['slug_produk']) ?>" class="text-dark">
                                                <?= esc($item['nama_produk']) ?>
                                            </a>
                                        </h6>
                                        <p class="text-primary font-weight-bold mb-0">
                                            Rp <?= number_format($harga_item, 0, ',', '.') ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
.product-description {
    font-size: 15px;
    line-height: 1.8;
}
.product-description img {
    max-width: 100%;
    height: auto;
}
</style>

<script>
$(document).ready(function() {
    // Plus minus quantity
    $('.btn-minus').click(function() {
        let input = $('#jumlah');
        let val = parseInt(input.val());
        if (val > 1) {
            input.val(val - 1);
        }
    });
    
    $('.btn-plus').click(function() {
        let input = $('#jumlah');
        let val = parseInt(input.val());
        let max = parseInt(input.attr('max'));
        if (val < max) {
            input.val(val + 1);
        }
    });
    
    // Add to cart
    $('#formAddToCart').submit(function(e) {
        e.preventDefault();
        
        let jumlah = $('#jumlah').val();
        let btn = $(this).find('button[type=submit]');
        
        $.ajax({
            url: '<?= base_url('toko/addtocart') ?>',
            type: 'POST',
            data: {
                <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                id_produk: <?= $produk->id_produk ?>,
                jumlah: jumlah
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
                        text: response.sukses,
                        confirmButtonText: 'Lanjut Belanja',
                        showCancelButton: true,
                        cancelButtonText: 'Lihat Keranjang'
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel) {
                            window.location.href = '<?= base_url('toko/keranjang') ?>';
                        }
                    });
                    
                    // Reset quantity
                    $('#jumlah').val(1);
                    
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
                btn.html('<i class="fas fa-cart-plus"></i> Tambah ke Keranjang');
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan. Silahkan coba lagi.'
                });
                btn.prop('disabled', false);
                btn.html('<i class="fas fa-cart-plus"></i> Tambah ke Keranjang');
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

<?= $this->endSection() ?>
