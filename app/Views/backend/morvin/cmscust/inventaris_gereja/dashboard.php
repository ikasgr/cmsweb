<?php
/**
 * =====================================================
 * View: Inventaris Gereja - Dashboard Analytics
 * Church Management System - Fase 2
 * Created: 8 Oktober 2025
 * =====================================================
 */

// Data dari controller
$statistik = $statistik ?? [];
$aset_per_kategori = $aset_per_kategori ?? [];
$aset_per_lokasi = $aset_per_lokasi ?? [];
$aset_perlu_maintenance = $aset_perlu_maintenance ?? [];
$warranty_expiring = $warranty_expiring ?? [];
$top_aset_by_value = $top_aset_by_value ?? [];
?>

<div class="row">
    <!-- Statistics Cards -->
    <div class="col-xl-3 col-md-6">
        <div class="card-box">
            <div class="media">
                <div class="avatar-md bg-primary rounded-circle mr-2">
                    <i class="fe-boxes avatar-title font-22 text-white"></i>
                </div>
                <div class="media-body align-self-center">
                    <h4 class="mt-0 mb-1 font-weight-bold" id="total-aset">
                        <?= number_format($statistik['total_aset'] ?? 0) ?>
                    </h4>
                    <p class="mb-0">Total Aset</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-box">
            <div class="media">
                <div class="avatar-md bg-success rounded-circle mr-2">
                    <i class="fe-check-circle avatar-title font-22 text-white"></i>
                </div>
                <div class="media-body align-self-center">
                    <h4 class="mt-0 mb-1 font-weight-bold" id="aset-aktif">
                        <?= number_format($statistik['aset_aktif'] ?? 0) ?>
                    </h4>
                    <p class="mb-0">Aset Aktif</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-box">
            <div class="media">
                <div class="avatar-md bg-warning rounded-circle mr-2">
                    <i class="fe-wrench avatar-title font-22 text-white"></i>
                </div>
                <div class="media-body align-self-center">
                    <h4 class="mt-0 mb-1 font-weight-bold" id="aset-maintenance">
                        <?= number_format($statistik['aset_maintenance'] ?? 0) ?>
                    </h4>
                    <p class="mb-0">Sedang Maintenance</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-box">
            <div class="media">
                <div class="avatar-md bg-danger rounded-circle mr-2">
                    <i class="fe-alert-triangle avatar-title font-22 text-white"></i>
                </div>
                <div class="media-body align-self-center">
                    <h4 class="mt-0 mb-1 font-weight-bold" id="aset-rusak">
                        <?= number_format($statistik['aset_rusak'] ?? 0) ?>
                    </h4>
                    <p class="mb-0">Aset Rusak</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Financial Overview -->
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fe-dollar-sign mr-2"></i>Nilai Aset Total
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-4">
                        <h3 class="text-primary">Rp <?= number_format($statistik['total_nilai_perolehan'] ?? 0, 0, ',', '.') ?></h3>
                        <p class="text-muted mb-0">Nilai Perolehan</p>
                    </div>
                    <div class="col-4">
                        <h3 class="text-warning">Rp <?= number_format($statistik['total_akumulasi_depreciation'] ?? 0, 0, ',', '.') ?></h3>
                        <p class="text-muted mb-0">Akumulasi Depreciation</p>
                    </div>
                    <div class="col-4">
                        <h3 class="text-success">Rp <?= number_format($statistik['total_nilai_buku'] ?? 0, 0, ',', '.') ?></h3>
                        <p class="text-muted mb-0">Nilai Buku Saat Ini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fe-bar-chart mr-2"></i>Maintenance & Perbaikan
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <h3 class="text-info" id="total-maintenance">
                            <?= number_format($statistik['total_maintenance'] ?? 0) ?>
                        </h3>
                        <p class="text-muted mb-0">Total Maintenance</p>
                    </div>
                    <div class="col-6">
                        <h3 class="text-danger" id="total-perbaikan">
                            <?= number_format($statistik['total_perbaikan'] ?? 0) ?>
                        </h3>
                        <p class="text-muted mb-0">Total Perbaikan</p>
                    </div>
                </div>
                <div class="row text-center mt-3">
                    <div class="col-12">
                        <h4 class="text-warning">Rp <?= number_format($statistik['total_biaya'] ?? 0, 0, ',', '.') ?></h4>
                        <p class="text-muted mb-0">Total Biaya Maintenance & Perbaikan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row">
    <!-- Aset per Kategori -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fe-pie-chart mr-2"></i>Distribusi Aset per Kategori
                </h5>
            </div>
            <div class="card-body">
                <canvas id="chartKategori" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Aset per Lokasi -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fe-bar-chart-2 mr-2"></i>Distribusi Aset per Lokasi
                </h5>
            </div>
            <div class="card-body">
                <canvas id="chartLokasi" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Alerts & Notifications -->
<div class="row">
    <!-- Aset Perlu Maintenance -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fe-alert-circle mr-2"></i>Aset Perlu Maintenance
                </h5>
            </div>
            <div class="card-body">
                <?php if (!empty($aset_perlu_maintenance)): ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Aset</th>
                                    <th>Kategori</th>
                                    <th>Next Maintenance</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($aset_perlu_maintenance as $aset): ?>
                                    <tr>
                                        <td>
                                            <strong><?= esc($aset['nama_aset']) ?></strong><br>
                                            <small class="text-muted">Kode: <?= esc($aset['kode_aset']) ?></small>
                                        </td>
                                        <td>
                                            <span class="badge badge-soft-primary" style="background-color: <?= esc($aset['warna']) ?>20; color: <?= esc($aset['warna']) ?>; border: 1px solid <?= esc($aset['warna']) ?>30;">
                                                <?= esc($aset['nama_kategori']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                            $days_until = ceil((strtotime($aset['next_maintenance_date']) - time()) / (60 * 60 * 24));
                                            if ($days_until > 0) {
                                                echo '<span class="badge badge-warning">' . $days_until . ' hari lagi</span>';
                                            } else {
                                                echo '<span class="badge badge-danger">Overdue</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="jadwalkanMaintenance('<?= $aset['id_aset'] ?>')">
                                                <i class="fe-calendar-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fe-check-circle fa-3x text-success mb-3"></i>
                        <h5>Semua aset dalam kondisi baik</h5>
                        <p class="text-muted">Tidak ada aset yang perlu maintenance dalam 30 hari ke depan</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Warranty Expiring Soon -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fe-clock mr-2"></i>Garansi Akan Habis
                </h5>
            </div>
            <div class="card-body">
                <?php if (!empty($warranty_expiring)): ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Aset</th>
                                    <th>Vendor</th>
                                    <th>Habis Garansi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($warranty_expiring as $aset): ?>
                                    <tr>
                                        <td>
                                            <strong><?= esc($aset->nama_aset) ?></strong><br>
                                            <small class="text-muted">Kode: <?= esc($aset->kode_aset) ?></small>
                                        </td>
                                        <td><?= esc($aset->nama_kategori) ?></td>
                                        <td>
                                            <?php
                                            $days_until = ceil((strtotime($aset->warranty_end) - time()) / (60 * 60 * 24));
                                            if ($days_until > 0) {
                                                echo '<span class="badge badge-warning">' . $days_until . ' hari lagi</span>';
                                            } else {
                                                echo '<span class="badge badge-danger">Kadaluarsa</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-info" onclick="lihat('<?= $aset->id_aset ?>')">
                                                <i class="fe-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fe-shield fa-3x text-success mb-3"></i>
                        <h5>Semua garansi aktif</h5>
                        <p class="text-muted">Tidak ada garansi yang akan habis dalam 60 hari ke depan</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Top Assets by Value -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fe-star mr-2"></i>Aset dengan Nilai Tertinggi
                </h5>
            </div>
            <div class="card-body">
                <?php if (!empty($top_aset_by_value)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Aset</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Harga Perolehan</th>
                                    <th>Nilai Buku</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($top_aset_by_value as $index => $aset): ?>
                                    <tr>
                                        <td><strong><?= $index + 1 ?></strong></td>
                                        <td>
                                            <strong><?= esc($aset->nama_aset) ?></strong><br>
                                            <small class="text-muted">Kode: <?= esc($aset->kode_aset) ?></small>
                                        </td>
                                        <td>
                                            <span class="badge badge-soft-primary" style="background-color: <?= esc($aset->warna) ?>20; color: <?= esc($aset->warna) ?>; border: 1px solid <?= esc($aset->warna) ?>30;">
                                                <i class="<?= esc($aset->icon) ?> mr-1"></i>
                                                <?= esc($aset->nama_kategori) ?>
                                            </span>
                                        </td>
                                        <td><?= esc($aset->nama_lokasi) ?></td>
                                        <td class="text-right">
                                            <strong>Rp <?= number_format($aset->harga_perolehan, 0, ',', '.') ?></strong>
                                        </td>
                                        <td class="text-right">
                                            Rp <?= number_format($aset->nilai_buku, 0, ',', '.') ?>
                                        </td>
                                        <td>
                                            <?php
                                            $status_class = '';
                                            $status_icon = '';
                                            switch ($aset->status) {
                                                case 'Aktif':
                                                    $status_class = 'badge-success';
                                                    $status_icon = 'fe-check-circle';
                                                    break;
                                                case 'Maintenance':
                                                    $status_class = 'badge-warning';
                                                    $status_icon = 'fe-wrench';
                                                    break;
                                                case 'Rusak':
                                                    $status_class = 'badge-danger';
                                                    $status_icon = 'fe-alert-triangle';
                                                    break;
                                                default:
                                                    $status_class = 'badge-secondary';
                                                    $status_icon = 'fe-circle';
                                            }
                                            ?>
                                            <span class="badge <?= $status_class ?>">
                                                <i class="fe <?= $status_icon ?> mr-1"></i>
                                                <?= esc($aset->status) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="lihat('<?= $aset->id_aset ?>')">
                                                <i class="fe-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fe-star fa-3x text-muted mb-3"></i>
                        <h5>Tidak ada data aset</h5>
                        <p class="text-muted">Tambahkan aset untuk melihat data ini</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
// Chart.js untuk visualisasi data
$(document).ready(function() {
    // Chart Aset per Kategori
    const kategoriData = <?= json_encode($aset_per_kategori) ?>;
    if (kategoriData.length > 0) {
        const ctxKategori = document.getElementById('chartKategori').getContext('2d');
        new Chart(ctxKategori, {
            type: 'doughnut',
            data: {
                labels: kategoriData.map(item => item.nama_kategori),
                datasets: [{
                    data: kategoriData.map(item => item.jumlah_aset),
                    backgroundColor: kategoriData.map(item => item.warna),
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom'
                }
            }
        });
    }

    // Chart Aset per Lokasi
    const lokasiData = <?= json_encode($aset_per_lokasi) ?>;
    if (lokasiData.length > 0) {
        const ctxLokasi = document.getElementById('chartLokasi').getContext('2d');
        new Chart(ctxLokasi, {
            type: 'bar',
            data: {
                labels: lokasiData.map(item => item.nama_lokasi),
                datasets: [{
                    label: 'Jumlah Aset',
                    data: lokasiData.map(item => item.jumlah_aset),
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });
    }
});

// Jadwalkan maintenance
function jadwalkanMaintenance(id_aset) {
    $.ajax({
        url: '<?= site_url('maintenance-aset/formtambah') ?>',
        type: 'POST',
        data: { id_aset: id_aset },
        success: function(response) {
            if (response.data) {
                $('.modal-title').html('Jadwalkan Maintenance');
                $('.modal-body').html(response.data);
                $('.modal-footer').html(`
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="simpanMaintenance()">Simpan</button>
                `);
                $('#modal').modal('show');
            }
        }
    });
}

// Lihat detail aset
function lihat(id_aset) {
    $.ajax({
        url: '<?= site_url('inventaris-gereja/formlihat') ?>',
        type: 'POST',
        data: { id_aset: id_aset },
        success: function(response) {
            if (response.sukses) {
                $('.modal-title').html('Detail Aset');
                $('.modal-body').html(response.sukses);
                $('.modal-footer').html(`
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                `);
                $('#modal').modal('show');
            }
        }
    });
}
</script>
