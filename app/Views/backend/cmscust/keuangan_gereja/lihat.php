<!-- Modal Lihat Detail Transaksi -->
<div class="modal fade" id="modallihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th width="30%">Kode Transaksi</th>
                        <td><?= $data['kode_transaksi'] ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?= date('d M Y', strtotime($data['tanggal_transaksi'])) ?></td>
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <td>
                            <?php if ($data['jenis_transaksi'] == 'Pemasukan'): ?>
                                <span class="badge bg-success">Pemasukan</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Pengeluaran</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>
                            <span class="badge" style="background-color: <?= $data['warna'] ?>; color: #fff;">
                                <?= $data['nama_kategori'] ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td><?= $data['metode_pembayaran'] ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td class="font-weight-bold">Rp <?= number_format($data['jumlah'], 0, ',', '.') ?></td>
                    </tr>

                    <?php if ($data['jenis_transaksi'] == 'Pemasukan' && !empty($data['sumber_dana'])): ?>
                        <tr>
                            <th>Sumber Dana</th>
                            <td><?= $data['sumber_dana'] ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php if ($data['jenis_transaksi'] == 'Pengeluaran' && !empty($data['penerima'])): ?>
                        <tr>
                            <th>Penerima</th>
                            <td><?= $data['penerima'] ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php if (!empty($data['no_referensi'])): ?>
                        <tr>
                            <th>No. Referensi</th>
                            <td><?= $data['no_referensi'] ?></td>
                        </tr>
                    <?php endif; ?>

                    <tr>
                        <th>Keterangan</th>
                        <td><?= nl2br(esc($data['keterangan'])) ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php
                            $statusClass = 'secondary';
                            if ($data['status'] == 'Selesai')
                                $statusClass = 'success';
                            elseif ($data['status'] == 'Pending')
                                $statusClass = 'warning';
                            elseif ($data['status'] == 'Ditolak')
                                $statusClass = 'danger';
                            ?>
                            <span class="badge bg-<?= $statusClass ?>"><?= $data['status'] ?></span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>