<!-- Modal Lihat Produk -->
<div class="modal fade" id="modallihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5">
                        <?php if ($data['gambar']) : ?>
                            <img src="<?= base_url('public/img/produk/' . $data['gambar']) ?>" class="img-fluid rounded" alt="<?= esc($data['nama_produk']) ?>">
                        <?php else : ?>
                            <img src="<?= base_url('public/img/no-image.png') ?>" class="img-fluid rounded" alt="No Image">
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-7">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Nama Produk</strong></td>
                                <td><?= esc($data['nama_produk']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Kategori</strong></td>
                                <td><?= esc($data['nama_kategori'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <td><strong>Harga Normal</strong></td>
                                <td>Rp <?= number_format($data['harga'], 0, ',', '.') ?></td>
                            </tr>
                            <?php if (!empty($data['harga_promo'])) : ?>
                            <tr>
                                <td><strong>Harga Promo</strong></td>
                                <td><span class="text-success"><strong>Rp <?= number_format($data['harga_promo'], 0, ',', '.') ?></strong></span></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td><strong>Stok</strong></td>
                                <td>
                                    <?php if ($data['stok'] > 0) : ?>
                                        <span class="badge bg-success"><?= $data['stok'] ?> <?= $data['satuan'] ?? 'pcs' ?></span>
                                    <?php else : ?>
                                        <span class="badge bg-danger">Habis</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Berat</strong></td>
                                <td><?= $data['berat'] ? $data['berat'] . ' gram' : '-' ?></td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>
                                    <?php if ($data['status'] == 1) : ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else : ?>
                                        <span class="badge bg-secondary">Non-Aktif</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Featured</strong></td>
                                <td>
                                    <?php if ($data['featured'] == 1) : ?>
                                        <span class="badge bg-warning text-dark">Ya</span>
                                    <?php else : ?>
                                        <span class="badge bg-secondary">Tidak</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Input</strong></td>
                                <td><?= date('d/m/Y H:i', strtotime($data['tgl_input'])) ?></td>
                            </tr>
                        </table>

                        <?php if (!empty($data['deskripsi'])) : ?>
                            <div class="mt-3">
                                <strong>Deskripsi:</strong>
                                <p class="text-muted"><?= nl2br(esc($data['deskripsi'])) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <?php 
                // Ambil nomor WhatsApp (dari produk atau default)
                $whatsapp = $data['whatsapp_admin'] ?? '6281234567890';
                
                // Ambil template pesan
                $template = $data['whatsapp_template'] ?? 'Halo, saya tertarik dengan produk: *{nama_produk}* dengan harga Rp {harga}. Apakah produk ini masih tersedia?';
                
                // Replace placeholder
                $harga_tampil = !empty($data['harga_promo']) ? $data['harga_promo'] : $data['harga'];
                $pesan = str_replace(
                    ['{nama_produk}', '{harga}', '{kategori}'],
                    [$data['nama_produk'], number_format($harga_tampil, 0, ',', '.'), $data['nama_kategori'] ?? ''],
                    $template
                );
                
                // Encode untuk URL
                $pesan_encoded = urlencode($pesan);
                $wa_link = "https://wa.me/{$whatsapp}?text={$pesan_encoded}";
                ?>
                
                <a href="<?= $wa_link ?>" target="_blank" class="btn btn-success">
                    <i class="fab fa-whatsapp"></i> Beli via WhatsApp
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
