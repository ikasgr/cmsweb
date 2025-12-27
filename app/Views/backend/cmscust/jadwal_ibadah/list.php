<?= csrf_field(); ?>

<!-- Statistik Cards -->
<div class="row mb-3">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Jadwal</p>
                        <h4 class="mb-2"><?= number_format($statistik['total']) ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="fas fa-calendar-alt font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Bulan Ini</p>
                        <h4 class="mb-2"><?= number_format($statistik['bulan_ini']) ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-success rounded-3">
                            <i class="fas fa-calendar-check font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Minggu Ini</p>
                        <h4 class="mb-2"><?= number_format($statistik['minggu_ini']) ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-warning rounded-3">
                            <i class="fas fa-calendar-week font-size-24"></i>
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
                        <p class="text-truncate font-size-14 mb-2">Hari Ini</p>
                        <h4 class="mb-2"><?= number_format($statistik['hari_ini']) ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-info rounded-3">
                            <i class="fas fa-calendar-day font-size-24"></i>
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
        <div class="card border-left-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="text-muted">Terjadwal</span>
                        <h5 class="mb-0"><?= number_format($statistik_status['terjadwal']) ?></h5>
                    </div>
                    <div class="text-primary">
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
                        <span class="text-muted">Berlangsung</span>
                        <h5 class="mb-0"><?= number_format($statistik_status['berlangsung']) ?></h5>
                    </div>
                    <div class="text-success">
                        <i class="fas fa-play fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-left-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="text-muted">Selesai</span>
                        <h5 class="mb-0"><?= number_format($statistik_status['selesai']) ?></h5>
                    </div>
                    <div class="text-info">
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
                        <span class="text-muted">Dibatalkan</span>
                        <h5 class="mb-0"><?= number_format($statistik_status['dibatalkan']) ?></h5>
                    </div>
                    <div class="text-danger">
                        <i class="fas fa-times fa-2x"></i>
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
                    placeholder="Cari jadwal, tema, tempat...">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-6">
                <select class="form-select" id="filterBulan">
                    <option value="">Pilih Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="col-6">
                <select class="form-select" id="filterTahun">
                    <option value="">Pilih Tahun</option>
                    <?php for ($i = date('Y') - 2; $i <= date('Y') + 2; $i++): ?>
                        <option value="<?= $i ?>" <?= $i == date('Y') ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4 text-end">
        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetFilter()">
            <i class="fas fa-refresh"></i> Reset
        </button>
        <?php if ($akses == '1' || $akses == '2') { ?>
            <button type="button" class="btn btn-success btn-sm tambah">
                <i class="fas fa-plus-circle"></i> Tambah Jadwal
            </button>
        <?php } ?>
    </div>
</div>

<!-- Data Table -->
<div class="table-responsive">
    <table class="table table-striped table-bordered dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabelJadwal">
        <thead class="table-light">
            <tr>
                <th width="5">
                    <?php if ($akses == '1' || $akses == '2') { ?>
                        <input type="checkbox" id="centangSemua" class="form-check-input">
                    <?php } ?>
                </th>
                <th width="5">#</th>
                <th width="100">Tanggal & Waktu</th>
                <th width="120">Jenis Ibadah</th>
                <th>Judul & Tema</th>
                <th width="100">Tempat</th>
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
                            <input type="checkbox" class="form-check-input centangid" name="id_jadwal[]"
                                value="<?= $data['id_jadwal'] ?>">
                        <?php } ?>
                    </td>
                    <td><?= $nomor++ ?></td>
                    <td>
                        <strong><?= date('d/m/Y', strtotime($data['tanggal'])) ?></strong><br>
                        <small class="text-muted">
                            <?= date('H:i', strtotime($data['jam_mulai'])) ?>
                            <?php if ($data['jam_selesai']): ?>
                                - <?= date('H:i', strtotime($data['jam_selesai'])) ?>
                            <?php endif; ?>
                        </small>
                    </td>
                    <td>
                        <span class="badge" style="background-color: <?= $data['warna'] ?>; color: white;">
                            <?= esc($data['nama_jenis']) ?>
                        </span>
                    </td>
                    <td>
                        <strong><?= esc($data['judul_ibadah']) ?></strong>
                        <?php if ($data['tema_ibadah']): ?>
                            <br><small class="text-muted"><?= esc($data['tema_ibadah']) ?></small>
                        <?php endif; ?>
                        <?php if ($data['ayat_tema']): ?>
                            <br><small class="text-primary"><i class="fas fa-book"></i> <?= esc($data['ayat_tema']) ?></small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <i class="fas fa-map-marker-alt text-danger"></i> <?= esc($data['tempat']) ?>
                    </td>
                    <td class="text-center">
                        <?php
                        $statusClass = [
                            'Terjadwal' => 'bg-primary',
                            'Berlangsung' => 'bg-success',
                            'Selesai' => 'bg-info',
                            'Dibatalkan' => 'bg-danger'
                        ];
                        ?>
                        <span class="badge <?= $statusClass[$data['status']] ?>">
                            <?= esc($data['status']) ?>
                        </span>
                        <?php if ($data['is_recurring']): ?>
                            <br><small class="text-warning"><i class="fas fa-repeat"></i> Recurring</small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-info btn-sm" onclick="lihat('<?= $data['id_jadwal'] ?>')"
                                title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>

                            <?php if ($akses == '1' || $akses == '2') { ?>
                                <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?= $data['id_jadwal'] ?>')"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button type="button" class="btn btn-secondary btn-sm"
                                    onclick="toggle('<?= $data['id_jadwal'] ?>', '<?= esc($data['judul_ibadah']) ?>')"
                                    title="Ubah Status">
                                    <i class="fas fa-exchange-alt"></i>
                                </button>

                                <button type="button" class="btn btn-primary btn-sm"
                                    onclick="copy('<?= $data['id_jadwal'] ?>', '<?= esc($data['judul_ibadah']) ?>')"
                                    title="Copy Jadwal">
                                    <i class="fas fa-copy"></i>
                                </button>

                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="hapus('<?= $data['id_jadwal'] ?>', '<?= esc($data['judul_ibadah']) ?>')"
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
        $('#tabelJadwal').DataTable({
            "language": {
                "url": "<?= base_url() ?>/public/template/backend/assets/js/datatables/Indonesian.json"
            },
            "pageLength": 25,
            "responsive": true,
            "order": [[2, "desc"]], // Sort by tanggal
            "columnDefs": [
                { "orderable": false, "targets": [0, 7] } // Disable sorting for checkbox and aksi columns
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
    });
</script>