<?= $this->extend('backend/template-backend') ?>

<?= $this->section('menu') ?>
<?= $this->include('backend/menu') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4>Dashboard Pesanan UMKM</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('pesanan-umkm/list') ?>">Pesanan UMKM</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <a href="<?= base_url('pesanan-umkm/list') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-list"></i> Lihat Semua Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container-fluid">

        <!-- Statistik Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat bg-warning text-white">
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="float-start mini-stat-img me-4">
                                <i class="fas fa-clock fa-3x"></i>
                            </div>
                            <h5 class="font-size-16 text-uppercase text-white-50">Pending</h5>
                            <h4 class="fw-medium font-size-24"><?= $pending ?> <i
                                    class="mdi mdi-arrow-up text-white ms-2"></i></h4>
                        </div>
                        <div class="pt-2">
                            <div class="float-end">
                                <a href="<?= base_url('pesanan-umkm/list') ?>" class="text-white-50"><i
                                        class="mdi mdi-arrow-right h5"></i></a>
                            </div>
                            <p class="text-white-50 mb-0">Menunggu Proses</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat bg-info text-white">
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="float-start mini-stat-img me-4">
                                <i class="fas fa-cog fa-spin fa-3x"></i>
                            </div>
                            <h5 class="font-size-16 text-uppercase text-white-50">Diproses</h5>
                            <h4 class="fw-medium font-size-24"><?= $diproses ?></h4>
                        </div>
                        <div class="pt-2">
                            <div class="float-end">
                                <a href="<?= base_url('pesanan-umkm/list') ?>" class="text-white-50"><i
                                        class="mdi mdi-arrow-right h5"></i></a>
                            </div>
                            <p class="text-white-50 mb-0">Sedang Diproses</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat bg-primary text-white">
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="float-start mini-stat-img me-4">
                                <i class="fas fa-shipping-fast fa-3x"></i>
                            </div>
                            <h5 class="font-size-16 text-uppercase text-white-50">Dikirim</h5>
                            <h4 class="fw-medium font-size-24"><?= $dikirim ?></h4>
                        </div>
                        <div class="pt-2">
                            <div class="float-end">
                                <a href="<?= base_url('pesanan-umkm/list') ?>" class="text-white-50"><i
                                        class="mdi mdi-arrow-right h5"></i></a>
                            </div>
                            <p class="text-white-50 mb-0">Dalam Pengiriman</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat bg-success text-white">
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="float-start mini-stat-img me-4">
                                <i class="fas fa-check-circle fa-3x"></i>
                            </div>
                            <h5 class="font-size-16 text-uppercase text-white-50">Selesai</h5>
                            <h4 class="fw-medium font-size-24"><?= $selesai ?></h4>
                        </div>
                        <div class="pt-2">
                            <div class="float-end">
                                <a href="<?= base_url('pesanan-umkm/list') ?>" class="text-white-50"><i
                                        class="mdi mdi-arrow-right h5"></i></a>
                            </div>
                            <p class="text-white-50 mb-0">Pesanan Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendapatan & Dibatalkan -->
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Total Pendapatan</h4>
                        <div class="text-center">
                            <h2 class="text-success mb-3">
                                <i class="fas fa-money-bill-wave"></i>
                                Rp <?= number_format($pendapatan, 0, ',', '.') ?>
                            </h2>
                            <p class="text-muted">Dari <?= $selesai ?> pesanan selesai</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Pesanan Dibatalkan</h4>
                        <div class="text-center">
                            <h2 class="text-danger mb-3">
                                <i class="fas fa-times-circle"></i>
                                <?= $dibatalkan ?> Pesanan
                            </h2>
                            <p class="text-muted">Total pesanan yang dibatalkan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pesanan Terbaru -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pesanan Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kode Pesanan</th>
                                        <th>Tanggal</th>
                                        <th>Pembeli</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($terbaru): ?>
                                        <?php foreach ($terbaru as $pesanan): ?>
                                            <tr>
                                                <td><strong class="text-primary"><?= esc($pesanan['kode_pesanan']) ?></strong>
                                                </td>
                                                <td><?= date('d/m/Y H:i', strtotime($pesanan['tgl_pesanan'])) ?></td>
                                                <td>
                                                    <?= esc($pesanan['nama_pembeli']) ?><br>
                                                    <small class="text-muted"><?= esc($pesanan['no_hp']) ?></small>
                                                </td>
                                                <td><strong>Rp
                                                        <?= number_format($pesanan['total_bayar'], 0, ',', '.') ?></strong></td>
                                                <td>
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
                                                    <span
                                                        class="badge bg-<?= $class ?>"><?= esc($pesanan['status_pesanan']) ?></span>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('pesanan-umkm/print/' . $pesanan['pesanan_id']) ?>"
                                                        class="btn btn-sm btn-success" target="_blank" title="Print">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">Belum ada pesanan</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>