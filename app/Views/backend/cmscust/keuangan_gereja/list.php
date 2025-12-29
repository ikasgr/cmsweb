<?= csrf_field(); ?>

<!-- Statistik Cards -->
<div class="row mb-3">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Pemasukan</p>
                        <h4 class="mb-2">Rp <?= number_format($statistik['pemasukan'], 0, ',', '.') ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-success rounded-3">
                            <i class="fas fa-arrow-up font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Pengeluaran</p>
                        <h4 class="mb-2">Rp <?= number_format($statistik['pengeluaran'], 0, ',', '.') ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-danger rounded-3">
                            <i class="fas fa-arrow-down font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Saldo Bersih</p>
                        <h4 class="mb-2">Rp <?= number_format($statistik['saldo'], 0, ',', '.') ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="fas fa-wallet font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Kas</p>
                        <h4 class="mb-2">Rp <?= number_format($total_saldo, 0, ',', '.') ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-info rounded-3">
                            <i class="fas fa-piggy-bank font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Statistics -->
<div class="row mb-3">
    <div class="col-xl-3 col-md-6">
        <div class="card border-left-warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="text-muted">Pending</span>
                        <h5 class="mb-0"><?= number_format($statistik_status['pending']) ?></h5>
                    </div>
                    <div class="text-warning">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-left-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="text-muted">Disetujui</span>
                        <h5 class="mb-0"><?= number_format($statistik_status['disetujui']) ?></h5>
                    </div>
                    <div class="text-success">
                        <i class="fas fa-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-left-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="text-muted">Ditolak</span>
                        <h5 class="mb-0"><?= number_format($statistik_status['ditolak']) ?></h5>
                    </div>
                    <div class="text-danger">
                        <i class="fas fa-times fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-left-secondary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="text-muted">Dibatalkan</span>
                        <h5 class="mb-0"><?= number_format($statistik_status['dibatalkan']) ?></h5>
                    </div>
                    <div class="text-secondary">
                        <i class="fas fa-ban fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search & Filter -->
<div class="row mb-3">
    <div class="col-md-4">
        <form class="formsearch">
            <?= csrf_field(); ?>
            <div class="input-group">
                <input type="text" class="form-control" id="keyword" name="keyword"
                    placeholder="Cari kode, keterangan...">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <form class="formfilter">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-6">
                    <input type="date" class="form-control" id="filterTanggalMulai" name="tanggal_mulai"
                        placeholder="Dari tanggal">
                </div>
                <div class="col-6">
                    <input type="date" class="form-control" id="filterTanggalSelesai" name="tanggal_selesai"
                        placeholder="Sampai tanggal">
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-4 text-end">
        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetFilter()">
            <i class="fas fa-refresh"></i> Reset
        </button>
        <?php if ($akses == '1' || $akses == '2') { ?>
            <button type="button" class="btn btn-success btn-sm tambah">
                <i class="fas fa-plus-circle"></i> Tambah Transaksi
            </button>
        <?php } ?>
    </div>
</div>

<!-- Data Table -->
<div class="table-responsive">
    <table class="table table-striped table-bordered dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabelKeuangan">
        <thead class="table-light">
            <tr>
                <th width="5">
                    <?php if ($akses == '1' || $akses == '2') { ?>
                        <input type="checkbox" id="centangSemua" class="form-check-input">
                    <?php } ?>
                </th>
                <th width="5">#</th>
                <th width="120">Kode Transaksi</th>
                <th width="100">Tanggal</th>
                <th width="80">Jenis</th>
                <th width="120">Kategori</th>
                <th>Keterangan</th>
                <th width="120">Jumlah</th>
                <th width="80">Status</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1; ?>
            <?php foreach ($list as $data): ?>
                <tr>
                    <td>
                        <?php if ($akses == '1' || $akses == '2') { ?>
                            <input type="checkbox" class="form-check-input centangid" name="id_transaksi[]"
                                value="<?= $data['id_transaksi'] ?>">
                        <?php } ?>
                    </td>
                    <td><?= $nomor++ ?></td>
                    <td><strong><?= esc($data['kode_transaksi']) ?></strong></td>
                    <td><?= date('d/m/Y', strtotime($data['tanggal_transaksi'])) ?></td>
                    <td class="text-center">
                        <?php if ($data['jenis_transaksi'] == 'Pemasukan'): ?>
                            <span class="badge bg-success">
                                <i class="fas fa-arrow-up"></i> Masuk
                            </span>
                        <?php else: ?>
                            <span class="badge bg-danger">
                                <i class="fas fa-arrow-down"></i> Keluar
                            </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge" style="background-color: <?= $data['warna'] ?>; color: white;">
                            <?= esc($data['nama_kategori']) ?>
                        </span>
                    </td>
                    <td>
                        <?= esc($data['keterangan']) ?>
                        <?php if ($data['sumber_dana']): ?>
                            <br><small class="text-muted">Sumber: <?= esc($data['sumber_dana']) ?></small>
                        <?php endif; ?>
                        <?php if ($data['penerima']): ?>
                            <br><small class="text-muted">Penerima: <?= esc($data['penerima']) ?></small>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <strong class="<?= $data['jenis_transaksi'] == 'Pemasukan' ? 'text-success' : 'text-danger' ?>">
                            <?= $data['jenis_transaksi'] == 'Pemasukan' ? '+' : '-' ?>
                            Rp <?= number_format($data['jumlah'], 0, ',', '.') ?>
                        </strong>
                        <?php if ($data['metode_pembayaran'] != 'Tunai'): ?>
                            <br><small class="text-info"><?= esc($data['metode_pembayaran']) ?></small>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php
                        $statusClass = [
                            'Pending' => 'bg-warning',
                            'Disetujui' => 'bg-success',
                            'Ditolak' => 'bg-danger',
                            'Dibatalkan' => 'bg-secondary'
                        ];
                        ?>
                        <span class="badge <?= $statusClass[$data['status']] ?>">
                            <?= esc($data['status']) ?>
                        </span>
                        <?php if ($data['bukti_transaksi']): ?>
                            <br><small class="text-primary"><i class="fas fa-paperclip"></i> Ada bukti</small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-info btn-sm"
                                onclick="lihat('<?= $data['id_transaksi'] ?>')" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>

                            <?php if ($akses == '1' || $akses == '2') { ?>
                                <?php if ($data['status'] == 'Pending') { ?>
                                    <button type="button" class="btn btn-warning btn-sm"
                                        onclick="approve('<?= $data['id_transaksi'] ?>')" title="Approve">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                <?php } ?>

                                <?php if ($data['status'] == 'Pending' || $data['status'] == 'Ditolak') { ?>
                                    <button type="button" class="btn btn-primary btn-sm"
                                        onclick="edit('<?= $data['id_transaksi'] ?>')" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                <?php } ?>

                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="hapus('<?= $data['id_transaksi'] ?>', '<?= esc($data['kode_transaksi']) ?>')"
                                    title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if ($akses == '1' || $akses == '2') { ?>
    <!-- Bulk Actions -->
    <div class="mt-2">
        <form class="formhapus">
            <?= csrf_field(); ?>
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="far fa-trash-alt"></i> Hapus Data Terpilih
            </button>
        </form>
    </div>
<?php } ?>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        $('#tabelKeuangan').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
            },
            "pageLength": 25,
            "responsive": true,
            "order": [[3, "desc"]], // Sort by tanggal
            "columnDefs": [
                { "orderable": false, "targets": [0, 9] } // Disable sorting for checkbox and aksi columns
            ]
        });

        // Select all checkbox
        $('#centangSemua').click(function () {
            if ($(this).is(':checked')) {
                $('.centangid').prop('checked', true);
            } else {
                $('.centangid').prop('checked', false);
            }
        });

        // Individual checkbox
        $('.centangid').click(function () {
            if ($('.centangid:checked').length == $('.centangid').length) {
                $('#centangSemua').prop('checked', true);
            } else {
                $('#centangSemua').prop('checked', false);
            }
        });

        // Auto submit filter when date changed
        $('#filterTanggalMulai, #filterTanggalSelesai').change(function () {
            let tanggal_mulai = $('#filterTanggalMulai').val();
            let tanggal_selesai = $('#filterTanggalSelesai').val();

            if (tanggal_mulai && tanggal_selesai) {
                $('.formfilter').submit();
            }
        });
    });
</script>