<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<section class="container mt-lg-0 mt-0 pb-1">
    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue">Keranjang Belanja</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('toko') ?>">Toko</a></li>
                    <li class="breadcrumb-item active">Keranjang</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="container pb-4">
    <?php if (isset($cart) && !empty($cart)) : ?>
        <div class="row">
            <!-- Daftar Produk di Keranjang -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Daftar Produk (<?= count($cart) ?> item)</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="100">Gambar</th>
                                        <th>Produk</th>
                                        <th width="150">Harga</th>
                                        <th width="120">Jumlah</th>
                                        <th width="150">Subtotal</th>
                                        <th width="80">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart as $item) : 
                                        $subtotal = $item['harga'] * $item['jumlah'];
                                    ?>
                                        <tr data-id="<?= $item['id_produk'] ?>">
                                            <td>
                                                <img src="<?= base_url('/public/img/produk/' . $item['gambar']) ?>" 
                                                     class="img-thumbnail" alt="<?= esc($item['nama_produk']) ?>"
                                                     style="width: 80px; height: 80px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <h6 class="mb-1">
                                                    <a href="<?= base_url('toko/' . $item['slug_produk']) ?>" class="text-dark">
                                                        <?= esc($item['nama_produk']) ?>
                                                    </a>
                                                </h6>
                                                <small class="text-muted">
                                                    <i class="fas fa-folder"></i> <?= esc($item['nama_kategori']) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <strong class="text-primary">
                                                    Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                                                </strong>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-secondary btn-minus" type="button" 
                                                                data-id="<?= $item['id_produk'] ?>">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="number" class="form-control text-center qty-input" 
                                                           value="<?= $item['jumlah'] ?>" min="1" max="<?= $item['stok'] ?>"
                                                           data-id="<?= $item['id_produk'] ?>" readonly>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary btn-plus" type="button"
                                                                data-id="<?= $item['id_produk'] ?>"
                                                                data-stok="<?= $item['stok'] ?>">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <small class="text-muted">Stok: <?= $item['stok'] ?></small>
                                            </td>
                                            <td>
                                                <strong class="text-success subtotal">
                                                    Rp <?= number_format($subtotal, 0, ',', '.') ?>
                                                </strong>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger btn-remove" 
                                                        data-id="<?= $item['id_produk'] ?>"
                                                        data-nama="<?= esc($item['nama_produk']) ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('toko') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Lanjut Belanja
                            </a>
                            <button class="btn btn-danger btn-clear-cart">
                                <i class="fas fa-trash-alt"></i> Kosongkan Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Belanja -->
            <div class="col-md-4">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-calculator"></i> Ringkasan Belanja</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Item:</span>
                            <strong id="total-items"><?= count($cart) ?></strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Produk:</span>
                            <strong id="total-qty">
                                <?php 
                                $total_qty = 0;
                                foreach ($cart as $item) {
                                    $total_qty += $item['jumlah'];
                                }
                                echo $total_qty;
                                ?>
                            </strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Total Harga:</h5>
                            <h5 class="text-success" id="total-price">
                                Rp <?= number_format($total, 0, ',', '.') ?>
                            </h5>
                        </div>
                        
                        <!-- Form Data Pembeli -->
                        <div class="mb-3">
                            <label class="form-label"><strong>Nama Anda:</strong></label>
                            <input type="text" class="form-control" id="nama-pembeli" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>No. HP/WhatsApp:</strong></label>
                            <input type="text" class="form-control" id="hp-pembeli" placeholder="08xxx" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Alamat Pengiriman:</strong></label>
                            <textarea class="form-control" id="alamat-pembeli" rows="2" placeholder="Alamat lengkap" required></textarea>
                        </div>
                        
                        <button class="btn btn-primary btn-block btn-lg btn-checkout">
                            <i class="fas fa-check-circle"></i> Proses Pesanan
                        </button>
                        <small class="text-muted text-center d-block mt-2">
                            <i class="fas fa-info-circle"></i> Pesanan akan disimpan dan invoice akan ditampilkan
                        </small>
                    </div>
                </div>

                <!-- Info Pengiriman -->
                <div class="card mt-3">
                    <div class="card-body">
                        <h6><i class="fas fa-info-circle text-info"></i> Informasi</h6>
                        <small class="text-muted">
                            <ul class="pl-3 mb-0">
                                <li>Pastikan jumlah produk sesuai</li>
                                <li>Cek ketersediaan stok</li>
                                <li>Harga dapat berubah sewaktu-waktu</li>
                            </ul>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <!-- Keranjang Kosong -->
        <div class="row">
            <div class="col-md-12">
                <div class="card text-center py-5">
                    <div class="card-body">
                        <i class="fas fa-shopping-cart fa-5x text-muted mb-3"></i>
                        <h3>Keranjang Belanja Kosong</h3>
                        <p class="text-muted">Anda belum menambahkan produk ke keranjang</p>
                        <a href="<?= base_url('toko') ?>" class="btn btn-primary btn-lg mt-3">
                            <i class="fas fa-shopping-bag"></i> Mulai Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<script>
$(document).ready(function() {
    // Update quantity
    function updateQuantity(id_produk, action) {
        let input = $('.qty-input[data-id="' + id_produk + '"]');
        let currentQty = parseInt(input.val());
        let stok = parseInt($('.btn-plus[data-id="' + id_produk + '"]').data('stok'));
        let newQty = currentQty;
        
        if (action === 'plus' && currentQty < stok) {
            newQty = currentQty + 1;
        } else if (action === 'minus' && currentQty > 1) {
            newQty = currentQty - 1;
        } else {
            if (action === 'plus') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Tidak Cukup',
                    text: 'Jumlah melebihi stok yang tersedia'
                });
            }
            return;
        }
        
        $.ajax({
            url: '<?= base_url('toko/updatecart') ?>',
            type: 'POST',
            data: {
                <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                id_produk: id_produk,
                jumlah: newQty
            },
            dataType: 'json',
            success: function(response) {
                if (response.sukses) {
                    location.reload();
                } else if (response.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.error
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan. Silahkan coba lagi.'
                });
            }
        });
    }
    
    // Button plus
    $('.btn-plus').click(function() {
        let id_produk = $(this).data('id');
        updateQuantity(id_produk, 'plus');
    });
    
    // Button minus
    $('.btn-minus').click(function() {
        let id_produk = $(this).data('id');
        updateQuantity(id_produk, 'minus');
    });
    
    // Remove item
    $('.btn-remove').click(function() {
        let id_produk = $(this).data('id');
        let nama_produk = $(this).data('nama');
        
        Swal.fire({
            title: 'Hapus Produk?',
            text: 'Apakah Anda yakin ingin menghapus "' + nama_produk + '" dari keranjang?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('toko/removecart') ?>',
                    type: 'POST',
                    data: {
                        <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                        id_produk: id_produk
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Produk berhasil dihapus dari keranjang',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        } else if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.error
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan. Silahkan coba lagi.'
                        });
                    }
                });
            }
        });
    });
    
    // Clear cart
    $('.btn-clear-cart').click(function() {
        Swal.fire({
            title: 'Kosongkan Keranjang?',
            text: 'Semua produk akan dihapus dari keranjang',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Kosongkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('toko/clearcart') ?>',
                    type: 'POST',
                    data: {
                        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Keranjang berhasil dikosongkan',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        } else if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.error
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan. Silahkan coba lagi.'
                        });
                    }
                });
            }
        });
    });
    
    // Proses Checkout
    $('.btn-checkout').click(function() {
        let nama = $('#nama-pembeli').val().trim();
        let hp = $('#hp-pembeli').val().trim();
        let alamat = $('#alamat-pembeli').val().trim();
        
        // Validasi
        if (!nama || !hp || !alamat) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Mohon lengkapi nama, no HP, dan alamat pengiriman'
            });
            return;
        }
        
        // Konfirmasi
        Swal.fire({
            title: 'Proses Pesanan?',
            text: 'Pesanan akan disimpan dan invoice akan ditampilkan',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Proses!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim data ke server
                $.ajax({
                    url: '<?= base_url('toko/checkout') ?>',
                    type: 'POST',
                    data: {
                        <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                        nama_pembeli: nama,
                        no_hp: hp,
                        alamat: alamat,
                        email: '',
                        catatan: ''
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Memproses...',
                            text: 'Mohon tunggu',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.sukses,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                // Redirect ke invoice
                                window.location.href = '<?= base_url('toko/invoice/') ?>' + response.kode_pesanan;
                            });
                        } else if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: typeof response.error === 'object' ? Object.values(response.error).join(', ') : response.error
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan. Silahkan coba lagi.'
                        });
                    }
                });
            }
        });
    });
});
</script>

<style>
.sticky-top {
    position: sticky;
    top: 80px;
    z-index: 100;
}

.qty-input {
    max-width: 60px;
}

.table td {
    vertical-align: middle;
}
</style>

<?= $this->endSection() ?>
