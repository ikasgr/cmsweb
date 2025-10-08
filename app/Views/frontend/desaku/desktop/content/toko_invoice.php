<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<section class="container mt-lg-0 mt-0 pb-1">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('toko') ?>">Toko</a></li>
                    <li class="breadcrumb-item active">Invoice</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="container pb-4">
    <div class="row">
        <div class="col-12">
            <!-- Invoice Card -->
            <div class="card" id="invoice-content">
                <div class="card-body">
                    <!-- Header Invoice -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <img src="<?= base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)) ?>" 
                                 alt="Logo" height="60">
                            <h4 class="mt-2"><?= esc($konfigurasi->nama) ?></h4>
                            <p class="mb-0"><?= esc($konfigurasi->alamat) ?></p>
                            <p class="mb-0">Telp: <?= esc($konfigurasi->no_telp) ?></p>
                        </div>
                        <div class="col-md-6 text-right">
                            <h2 class="text-primary">INVOICE</h2>
                            <h4><?= esc($pesanan['kode_pesanan']) ?></h4>
                            <p class="mb-0">Tanggal: <?= date('d/m/Y H:i', strtotime($pesanan['tgl_pesanan'])) ?></p>
                            <span class="badge badge-<?= $pesanan['status_pesanan'] == 'Pending' ? 'warning' : 'success' ?> badge-lg">
                                <?= esc($pesanan['status_pesanan']) ?>
                            </span>
                        </div>
                    </div>

                    <hr>

                    <!-- Data Pembeli -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5><i class="fas fa-user"></i> Data Pembeli</h5>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td width="100"><strong>Nama</strong></td>
                                    <td>: <?= esc($pesanan['nama_pembeli']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>No. HP</strong></td>
                                    <td>: <?= esc($pesanan['no_hp']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td>: <?= esc($pesanan['alamat']) ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-info-circle"></i> Informasi Pesanan</h5>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td width="120"><strong>Total Item</strong></td>
                                    <td>: <?= $pesanan['total_item'] ?> item</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Qty</strong></td>
                                    <td>: <?= $pesanan['total_qty'] ?> pcs</td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>: <span class="badge badge-warning"><?= esc($pesanan['status_pesanan']) ?></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Detail Produk -->
                    <h5><i class="fas fa-shopping-cart"></i> Detail Produk</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th width="50" class="text-center">No</th>
                                    <th>Nama Produk</th>
                                    <th width="150" class="text-right">Harga</th>
                                    <th width="100" class="text-center">Jumlah</th>
                                    <th width="150" class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach ($detail as $item) : 
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><?= esc($item['nama_produk']) ?></td>
                                        <td class="text-right">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                        <td class="text-center"><?= $item['jumlah'] ?></td>
                                        <td class="text-right">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                                    <td class="text-right"><strong>Rp <?= number_format($pesanan['subtotal'], 0, ',', '.') ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Ongkir:</strong></td>
                                    <td class="text-right"><strong>Rp <?= number_format($pesanan['ongkir'], 0, ',', '.') ?></strong></td>
                                </tr>
                                <tr class="table-success">
                                    <td colspan="4" class="text-right"><h5 class="mb-0">TOTAL BAYAR:</h5></td>
                                    <td class="text-right"><h5 class="mb-0 text-success">Rp <?= number_format($pesanan['total_bayar'], 0, ',', '.') ?></h5></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Catatan -->
                    <?php if (!empty($pesanan['catatan'])) : ?>
                        <div class="alert alert-info">
                            <strong><i class="fas fa-sticky-note"></i> Catatan:</strong><br>
                            <?= nl2br(esc($pesanan['catatan'])) ?>
                        </div>
                    <?php endif; ?>

                    <!-- Footer -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <p class="text-muted text-center">
                                <small>
                                    Invoice ini digenerate otomatis oleh sistem.<br>
                                    Untuk informasi lebih lanjut, hubungi kami di <?= esc($konfigurasi->no_telp) ?>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card mt-3 no-print">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <button class="btn btn-primary btn-block btn-lg" onclick="window.print()">
                                <i class="fas fa-print"></i> Print Invoice
                            </button>
                        </div>
                        <div class="col-md-4 mb-2">
                            <button class="btn btn-success btn-block btn-lg btn-whatsapp">
                                <i class="fab fa-whatsapp"></i> Kirim ke WhatsApp
                            </button>
                        </div>
                        <div class="col-md-4 mb-2">
                            <a href="<?= base_url('toko') ?>" class="btn btn-secondary btn-block btn-lg">
                                <i class="fas fa-shopping-bag"></i> Belanja Lagi
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Pembayaran -->
            <div class="card mt-3 no-print">
                <div class="card-body">
                    <h5><i class="fas fa-info-circle text-info"></i> Informasi Pembayaran</h5>
                    <p>Silahkan hubungi admin melalui WhatsApp untuk konfirmasi pembayaran dan pengiriman.</p>
                    <ul>
                        <li>Pesanan akan diproses setelah pembayaran dikonfirmasi</li>
                        <li>Simpan invoice ini sebagai bukti pesanan</li>
                        <li>Ongkir akan dikonfirmasi oleh admin</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    // Kirim ke WhatsApp
    $('.btn-whatsapp').click(function() {
        // Build pesan WhatsApp
        let pesan = '*INVOICE PESANAN UMKM*\n\n';
        pesan += '*Kode Pesanan:* <?= esc($pesanan['kode_pesanan']) ?>\n';
        pesan += '*Tanggal:* <?= date('d/m/Y H:i', strtotime($pesanan['tgl_pesanan'])) ?>\n\n';
        
        pesan += '*Data Pembeli:*\n';
        pesan += 'Nama: <?= esc($pesanan['nama_pembeli']) ?>\n';
        pesan += 'No. HP: <?= esc($pesanan['no_hp']) ?>\n';
        pesan += 'Alamat: <?= esc($pesanan['alamat']) ?>\n\n';
        
        pesan += '*Detail Pesanan:*\n';
        pesan += '─────────────────\n';
        
        <?php 
        $no = 1;
        foreach ($detail as $item) : 
        ?>
        pesan += '<?= $no++ ?>. *<?= esc($item['nama_produk']) ?>*\n';
        pesan += '   Harga: Rp <?= number_format($item['harga'], 0, ',', '.') ?>\n';
        pesan += '   Jumlah: <?= $item['jumlah'] ?> pcs\n';
        pesan += '   Subtotal: Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>\n\n';
        <?php endforeach; ?>
        
        pesan += '─────────────────\n';
        pesan += '*TOTAL: Rp <?= number_format($pesanan['total_bayar'], 0, ',', '.') ?>*\n\n';
        pesan += 'Mohon konfirmasi pembayaran dan ongkos kirim. Terima kasih!';
        
        // Encode pesan
        let pesanEncoded = encodeURIComponent(pesan);
        
        // Nomor WhatsApp admin
        let waNumber = '<?= $konfigurasi->whatsapp ?? '6281234567890' ?>';
        
        // Buka WhatsApp
        let waLink = 'https://wa.me/' + waNumber + '?text=' + pesanEncoded;
        window.open(waLink, '_blank');
        
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Anda akan diarahkan ke WhatsApp',
            showConfirmButton: false,
            timer: 1500
        });
    });
});
</script>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    
    body {
        background: white;
    }
    
    .card {
        border: none;
        box-shadow: none;
    }
}

.badge-lg {
    font-size: 14px;
    padding: 8px 12px;
}
</style>

<?= $this->endSection() ?>
