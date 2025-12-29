<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr class="bg-light">
                <th colspan="2" class="text-center font-weight-bold">
                    Summary Laporan Periode <?= date('d/m/Y', strtotime($periode_mulai)) ?> - <?= date('d/m/Y', strtotime($periode_selesai)) ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Pemasukan</td>
                <td class="text-end text-success font-weight-bold">
                    Rp <?= number_format($laporan['summary']['pemasukan'], 0, ',', '.') ?>
                </td>
            </tr>
            <tr>
                <td>Total Pengeluaran</td>
                <td class="text-end text-danger font-weight-bold">
                    Rp <?= number_format($laporan['summary']['pengeluaran'], 0, ',', '.') ?>
                </td>
            </tr>
            <tr>
                <td>Surplus/Defisit</td>
                <td class="text-end font-weight-bold <?= $laporan['summary']['saldo'] >= 0 ? 'text-primary' : 'text-danger' ?>">
                    Rp <?= number_format($laporan['summary']['saldo'], 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <h5 class="mb-3"><i class="fas fa-arrow-up text-success"></i> Rincian Pemasukan</h5>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th class="text-center">Jml Transaksi</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($laporan['detail_pemasukan'])): ?>
                        <?php foreach ($laporan['detail_pemasukan'] as $row): ?>
                        <tr>
                            <td>
                                <span class="badge" style="background-color: <?= $row['warna'] ?>; color: #fff;">
                                    <?= esc($row['nama_kategori']) ?>
                                </span>
                            </td>
                            <td class="text-center"><?= $row['jumlah_transaksi'] ?></td>
                            <td class="text-end">Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="text-center text-muted">Tidak ada data</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="col-md-6">
        <h5 class="mb-3"><i class="fas fa-arrow-down text-danger"></i> Rincian Pengeluaran</h5>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th class="text-center">Jml Transaksi</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($laporan['detail_pengeluaran'])): ?>
                        <?php foreach ($laporan['detail_pengeluaran'] as $row): ?>
                        <tr>
                            <td>
                                <span class="badge" style="background-color: <?= $row['warna'] ?>; color: #fff;">
                                    <?= esc($row['nama_kategori']) ?>
                                </span>
                            </td>
                            <td class="text-center"><?= $row['jumlah_transaksi'] ?></td>
                            <td class="text-end">Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="text-center text-muted">Tidak ada data</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="text-center mt-3 d-print-none">
    <button type="button" class="btn btn-secondary" onclick="window.print()">
        <i class="fas fa-print"></i> Cetak Laporan
    </button>
</div>
