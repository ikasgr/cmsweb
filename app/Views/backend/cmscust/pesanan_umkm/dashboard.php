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

        <!-- Quick Access Menu -->
        <div class="row mb-4">
            <div class="col-12">
                <h5 class="mb-3 text-muted fw-bold font-size-14 text-uppercase">Menu Akses Cepat</h5>
            </div>

            <div class="col-md-4">
                <a href="<?= base_url('produk-umkm/list') ?>" class="card border-0 shadow-sm h-100 text-decoration-none"
                    style="transition: all 0.3s ease; overflow: hidden;"
                    onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.1)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)'">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle font-size-24 text-primary"
                                style="background-color: rgba(85, 110, 230, 0.15); width: 48px; height: 48px;">
                                <i class="fas fa-box"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="font-size-16 mb-1 text-dark">Produk UMKM</h5>
                            <p class="text-muted mb-0 font-size-13">Kelola katalog produk</p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-chevron-right text-muted"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="<?= base_url('pesanan-umkm/list') ?>"
                    class="card border-0 shadow-sm h-100 text-decoration-none"
                    style="transition: all 0.3s ease; overflow: hidden;"
                    onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.1)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)'">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle font-size-24 text-success"
                                style="background-color: rgba(52, 195, 143, 0.15); width: 48px; height: 48px;">
                                <i class="fas fa-shopping-cart"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="font-size-16 mb-1 text-dark">Pesanan UMKM</h5>
                            <p class="text-muted mb-0 font-size-13">Lihat & proses pesanan</p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-chevron-right text-muted"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="<?= base_url('kategori-produk/list') ?>"
                    class="card border-0 shadow-sm h-100 text-decoration-none"
                    style="transition: all 0.3s ease; overflow: hidden;"
                    onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.1)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)'">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle font-size-24 text-info"
                                style="background-color: rgba(80, 165, 241, 0.15); width: 48px; height: 48px;">
                                <i class="fas fa-tags"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="font-size-16 mb-1 text-dark">Kategori Produk</h5>
                            <p class="text-muted mb-0 font-size-13">Atur kategori produk</p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-chevron-right text-muted"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

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