<div class="row">
    <!-- Info Pesanan -->
    <div class="col-md-6">
        <div class="card border">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Pesanan</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="150"><strong>Kode Pesanan</strong></td>
                        <td>: <strong class="text-primary"><?= esc($pesanan['kode_pesanan']) ?></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Pesan</strong></td>
                        <td>: <?= date('d/m/Y H:i', strtotime($pesanan['tgl_pesanan'])) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>: 
                            <?php
                            $badge_class = [
                                'Pending' => 'warning',
                                'Diproses' => 'info',
                                'Dikirim' => 'primary',
                                'Selesai' => 'success',
                                'Dibatalkan' => 'danger'
                            ];
                            $class = $badge_class[$pesanan['status_pesanan']] ?? 'secondary';
                            ?>
                            <span class="badge bg-<?= $class ?>"><?= esc($pesanan['status_pesanan']) ?></span>
                        </td>
                    </tr>
                    <?php if ($pesanan['tgl_diproses']) : ?>
                        <tr>
                            <td><strong>Tgl Diproses</strong></td>
                            <td>: <?= date('d/m/Y H:i', strtotime($pesanan['tgl_diproses'])) ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($pesanan['tgl_dikirim']) : ?>
                        <tr>
                            <td><strong>Tgl Dikirim</strong></td>
                            <td>: <?= date('d/m/Y H:i', strtotime($pesanan['tgl_dikirim'])) ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($pesanan['tgl_selesai']) : ?>
                        <tr>
                            <td><strong>Tgl Selesai</strong></td>
                            <td>: <?= date('d/m/Y H:i', strtotime($pesanan['tgl_selesai'])) ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <!-- Data Pembeli -->
    <div class="col-md-6">
        <div class="card border">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-user"></i> Data Pembeli</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="150"><strong>Nama</strong></td>
                        <td>: <?= esc($pesanan['nama_pembeli']) ?></td>
                    </tr>
                    <tr>
                        <td><strong>No. HP</strong></td>
                        <td>: 
                            <a href="https://wa.me/<?= esc($pesanan['no_hp']) ?>" target="_blank" class="text-success">
                                <i class="fab fa-whatsapp"></i> <?= esc($pesanan['no_hp']) ?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>: <?= esc($pesanan['email']) ?: '-' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Alamat</strong></td>
                        <td>: <?= nl2br(esc($pesanan['alamat'])) ?></td>
                    </tr>
                    <?php if ($pesanan['catatan']) : ?>
                        <tr>
                            <td><strong>Catatan</strong></td>
                            <td>: <?= nl2br(esc($pesanan['catatan'])) ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Detail Produk -->
<div class="row mt-3">
    <div class="col-12">
        <div class="card border">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Detail Produk</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
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
            </div>
        </div>
    </div>
</div>

<!-- Tracking History -->
<?php if ($tracking) : ?>
<div class="row mt-3">
    <div class="col-12">
        <div class="card border">
            <div class="card-header bg-warning">
                <h5 class="mb-0"><i class="fas fa-history"></i> Riwayat Status</h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <?php foreach ($tracking as $track) : ?>
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1">
                                        <span class="badge bg-<?= $badge_class[$track['status']] ?? 'secondary' ?>">
                                            <?= esc($track['status']) ?>
                                        </span>
                                    </h6>
                                    <small class="text-muted">
                                        <?= date('d/m/Y H:i', strtotime($track['tgl_update'])) ?>
                                    </small>
                                </div>
                                <?php if ($track['keterangan']) : ?>
                                    <p class="mb-0 text-muted"><?= esc($track['keterangan']) ?></p>
                                <?php endif; ?>
                                <?php if ($track['fullname']) : ?>
                                    <small class="text-muted">
                                        <i class="fas fa-user"></i> <?= esc($track['fullname']) ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Action Buttons -->
<div class="row mt-3">
    <div class="col-12">
        <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-success" onclick="kirimWhatsApp('<?= esc($pesanan['kode_pesanan']) ?>', '<?= esc($pesanan['no_hp']) ?>')">
                <i class="fab fa-whatsapp"></i> Kirim ke WhatsApp
            </button>
            <button type="button" class="btn btn-primary" onclick="printInvoice('<?= $pesanan['pesanan_id'] ?>')">
                <i class="fas fa-print"></i> Print Invoice
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fas fa-times"></i> Tutup
            </button>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    padding-bottom: 20px;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -22px;
    top: 20px;
    height: calc(100% - 10px);
    width: 2px;
    background: #dee2e6;
}

.timeline-marker {
    position: absolute;
    left: -27px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #007bff;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #007bff;
}

.timeline-content {
    background: #f8f9fa;
    padding: 10px 15px;
    border-radius: 5px;
    border-left: 3px solid #007bff;
}

.gap-2 {
    gap: 0.5rem;
}
</style>

<script>
function kirimWhatsApp(kode, no_hp) {
    // Build pesan
    let pesan = '*NOTIFIKASI PESANAN*\n\n';
    pesan += 'Kode Pesanan: ' + kode + '\n';
    pesan += 'Status: <?= esc($pesanan['status_pesanan']) ?>\n\n';
    pesan += 'Terima kasih telah berbelanja di Toko UMKM kami.\n';
    pesan += 'Untuk informasi lebih lanjut, silahkan hubungi admin.';
    
    let pesanEncoded = encodeURIComponent(pesan);
    let waLink = 'https://wa.me/' + no_hp + '?text=' + pesanEncoded;
    window.open(waLink, '_blank');
}
</script>
