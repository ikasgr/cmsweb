<?= csrf_field(); ?>

<!-- Dashboard Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="fas fa-chart-line text-primary"></i> Dashboard Keuangan
            </h4>
            <div>
                <button type="button" class="btn btn-outline-primary btn-sm" onclick="listkeuangan()">
                    <i class="fas fa-list"></i> Kembali ke List
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Main Statistics -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-gradient-success text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Pemasukan Bulan Ini</p>
                        <h3 class="mb-2">Rp <?= number_format($statistik['pemasukan'], 0, ',', '.') ?></h3>
                        <p class="mb-0 font-size-12">
                            <span class="badge bg-light text-success">
                                <i class="fas fa-arrow-up"></i> <?= $statistik['jumlah_transaksi'] ?> transaksi
                            </span>
                        </p>
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
        <div class="card bg-gradient-danger text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Pengeluaran Bulan Ini</p>
                        <h3 class="mb-2">Rp <?= number_format($statistik['pengeluaran'], 0, ',', '.') ?></h3>
                        <p class="mb-0 font-size-12">
                            <span class="badge bg-light text-danger">
                                <i class="fas fa-arrow-down"></i> Pengeluaran
                            </span>
                        </p>
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
        <div class="card bg-gradient-primary text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Saldo Bersih</p>
                        <h3 class="mb-2">Rp <?= number_format($statistik['saldo'], 0, ',', '.') ?></h3>
                        <p class="mb-0 font-size-12">
                            <span class="badge bg-light <?= $statistik['saldo'] >= 0 ? 'text-success' : 'text-danger' ?>">
                                <i class="fas fa-<?= $statistik['saldo'] >= 0 ? 'plus' : 'minus' ?>"></i> 
                                <?= $statistik['saldo'] >= 0 ? 'Surplus' : 'Defisit' ?>
                            </span>
                        </p>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="fas fa-calculator font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card bg-gradient-info text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Kas</p>
                        <h3 class="mb-2">Rp <?= number_format($total_saldo, 0, ',', '.') ?></h3>
                        <p class="mb-0 font-size-12">
                            <span class="badge bg-light text-info">
                                <i class="fas fa-piggy-bank"></i> Semua Kas
                            </span>
                        </p>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-info rounded-3">
                            <i class="fas fa-wallet font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
    <!-- Grafik Bulanan -->
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-line"></i> Grafik Pemasukan vs Pengeluaran (<?= date('Y') ?>)
                </h5>
            </div>
            <div class="card-body">
                <canvas id="grafikBulanan" height="100"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Saldo Per Jenis Kas -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-pie"></i> Saldo Per Jenis Kas
                </h5>
            </div>
            <div class="card-body">
                <canvas id="grafikKas" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Top Categories & Pending Approval -->
<div class="row mb-4">
    <!-- Top Kategori Pemasukan -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-arrow-up text-success"></i> Top Kategori Pemasukan
                </h5>
            </div>
            <div class="card-body">
                <?php if (!empty($top_pemasukan)): ?>
                    <?php foreach ($top_pemasukan as $index => $kategori): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm">
                                    <span class="avatar-title rounded-circle" style="background-color: <?= $kategori['warna'] ?>; color: white;">
                                        <?= $index + 1 ?>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1"><?= esc($kategori['nama_kategori']) ?></h6>
                                <p class="text-muted mb-0">Rp <?= number_format($kategori['total'], 0, ',', '.') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted text-center">Belum ada data pemasukan</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Top Kategori Pengeluaran -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-arrow-down text-danger"></i> Top Kategori Pengeluaran
                </h5>
            </div>
            <div class="card-body">
                <?php if (!empty($top_pengeluaran)): ?>
                    <?php foreach ($top_pengeluaran as $index => $kategori): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm">
                                    <span class="avatar-title rounded-circle" style="background-color: <?= $kategori['warna'] ?>; color: white;">
                                        <?= $index + 1 ?>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1"><?= esc($kategori['nama_kategori']) ?></h6>
                                <p class="text-muted mb-0">Rp <?= number_format($kategori['total'], 0, ',', '.') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted text-center">Belum ada data pengeluaran</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Pending Approval -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clock text-warning"></i> Menunggu Persetujuan
                    <span class="badge bg-warning ms-2"><?= count($pending_approval) ?></span>
                </h5>
            </div>
            <div class="card-body">
                <?php if (!empty($pending_approval)): ?>
                    <div style="max-height: 300px; overflow-y: auto;">
                        <?php foreach ($pending_approval as $transaksi): ?>
                            <div class="d-flex align-items-center mb-3 p-2 border rounded">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?= esc($transaksi['kode_transaksi']) ?></h6>
                                    <p class="text-muted mb-1 small"><?= esc($transaksi['nama_kategori']) ?></p>
                                    <p class="mb-0">
                                        <strong class="<?= $transaksi['jenis_transaksi'] == 'Pemasukan' ? 'text-success' : 'text-danger' ?>">
                                            Rp <?= number_format($transaksi['jumlah'], 0, ',', '.') ?>
                                        </strong>
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="approve('<?= $transaksi['id_transaksi'] ?>')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                        <p class="text-muted">Semua transaksi sudah diproses</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Status Statistics -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card border-left-warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="text-muted">Pending</span>
                        <h4 class="mb-0"><?= number_format($statistik_status['pending']) ?></h4>
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
                        <h4 class="mb-0"><?= number_format($statistik_status['disetujui']) ?></h4>
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
                        <h4 class="mb-0"><?= number_format($statistik_status['ditolak']) ?></h4>
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
                        <h4 class="mb-0"><?= number_format($statistik_status['dibatalkan']) ?></h4>
                    </div>
                    <div class="text-secondary">
                        <i class="fas fa-ban fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Grafik Bulanan
        const ctxBulanan = document.getElementById('grafikBulanan').getContext('2d');
        const grafikBulananData = <?= json_encode($grafik_bulanan) ?>;
        
        new Chart(ctxBulanan, {
            type: 'line',
            data: {
                labels: grafikBulananData.map(item => item.nama_bulan),
                datasets: [{
                    label: 'Pemasukan',
                    data: grafikBulananData.map(item => item.pemasukan),
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    tension: 0.4
                }, {
                    label: 'Pengeluaran',
                    data: grafikBulananData.map(item => item.pengeluaran),
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                }
            }
        });

        // Grafik Kas
        const ctxKas = document.getElementById('grafikKas').getContext('2d');
        const saldoPerJenis = <?= json_encode($saldo_per_jenis) ?>;
        
        if (saldoPerJenis.length > 0) {
            new Chart(ctxKas, {
                type: 'doughnut',
                data: {
                    labels: saldoPerJenis.map(item => item.jenis_kas),
                    datasets: [{
                        data: saldoPerJenis.map(item => item.total_saldo),
                        backgroundColor: [
                            '#007bff',
                            '#28a745',
                            '#ffc107',
                            '#17a2b8',
                            '#6f42c1'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });
        }
    });
</script>
