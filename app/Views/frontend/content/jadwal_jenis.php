<?= $this->extend('frontend/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<section class="container mt-lg-0 mt-0 pb-1">
    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue">
                Jadwal Pelayanan - <?= isset($jenis_nama) ? esc($jenis_nama) : 'Semua' ?>
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('jadwal') ?>">Jadwal</a></li>
                    <li class="breadcrumb-item active"><?= isset($jenis_nama) ? esc($jenis_nama) : 'Jenis' ?></li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="container pb-4">
    <div class="card p-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <!-- Jadwal Hari Ini -->
                <?php if (isset($hariini) && $hariini): ?>
                    <div class="card mb-3 border-primary">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-calendar-day"></i> Hari Ini</h5>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php foreach ($hariini as $item): ?>
                                <div class="list-group-item">
                                    <h6 class="mb-1"><?= esc($item['judul_jadwal']) ?></h6>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> <?= date('H:i', strtotime($item['waktu_mulai'])) ?>
                                    </small><br>
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt"></i> <?= esc($item['tempat']) ?>
                                    </small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Filter Jenis Pelayanan -->
                <div class="card mb-3">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-filter"></i> Jenis Pelayanan</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="<?= base_url('jadwal') ?>"
                            class="list-group-item list-group-item-action <?= !isset($jenis_nama) ? 'active' : '' ?>">
                            <i class="fas fa-calendar"></i> Semua Jadwal
                        </a>
                        <a href="<?= base_url('jadwal/jenis/Ibadah Minggu') ?>"
                            class="list-group-item list-group-item-action <?= (isset($jenis_nama) && $jenis_nama == 'Ibadah Minggu') ? 'active' : '' ?>">
                            <i class="fas fa-church"></i> Ibadah Minggu
                        </a>
                        <a href="<?= base_url('jadwal/jenis/Ibadah Pemuda') ?>"
                            class="list-group-item list-group-item-action <?= (isset($jenis_nama) && $jenis_nama == 'Ibadah Pemuda') ? 'active' : '' ?>">
                            <i class="fas fa-users"></i> Ibadah Pemuda
                        </a>
                        <a href="<?= base_url('jadwal/jenis/Doa Pagi') ?>"
                            class="list-group-item list-group-item-action <?= (isset($jenis_nama) && $jenis_nama == 'Doa Pagi') ? 'active' : '' ?>">
                            <i class="fas fa-pray"></i> Doa Pagi
                        </a>
                        <a href="<?= base_url('jadwal/jenis/Persekutuan') ?>"
                            class="list-group-item list-group-item-action <?= (isset($jenis_nama) && $jenis_nama == 'Persekutuan') ? 'active' : '' ?>">
                            <i class="fas fa-hands"></i> Persekutuan
                        </a>
                        <a href="<?= base_url('jadwal/jenis/Kegiatan Khusus') ?>"
                            class="list-group-item list-group-item-action <?= (isset($jenis_nama) && $jenis_nama == 'Kegiatan Khusus') ? 'active' : '' ?>">
                            <i class="fas fa-star"></i> Kegiatan Khusus
                        </a>
                    </div>
                </div>

                <!-- Bulan -->
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Filter Bulan</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="<?= base_url('jadwal/jenis/' . (isset($jenis_nama) ? urlencode($jenis_nama) : '')) ?>"
                            method="get">
                            <select name="bulan" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua Bulan</option>
                                <?php
                                $bulan_indo = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                for ($i = 1; $i <= 12; $i++):
                                    $selected = (isset($_GET['bulan']) && $_GET['bulan'] == $i) ? 'selected' : '';
                                    ?>
                                    <option value="<?= $i ?>" <?= $selected ?>><?= $bulan_indo[$i - 1] ?></option>
                                <?php endfor; ?>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <h1 class="text-blue montserrat-700 f-24 mb-3">
                    <i class="fas fa-list"></i> <?= isset($jenis_nama) ? esc($jenis_nama) : 'Semua Jadwal' ?>
                </h1>

                <?php if (isset($jadwal) && $jadwal): ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        Menampilkan <strong><?= count($jadwal) ?></strong> jadwal untuk
                        <strong><?= isset($jenis_nama) ? esc($jenis_nama) : 'semua jenis' ?></strong>
                    </div>

                    <div class="row">
                        <?php foreach ($jadwal as $item): ?>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 shadow-sm jadwal-card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3 text-center border-right">
                                                <div class="date-box">
                                                    <h2 class="text-primary mb-0"><?= date('d', strtotime($item['tanggal'])) ?>
                                                    </h2>
                                                    <small
                                                        class="text-muted"><?= strftime('%b', strtotime($item['tanggal'])) ?></small>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <span class="badge badge-primary mb-2">
                                                    <?= esc($item['jenis_pelayanan']) ?>
                                                </span>
                                                <h5 class="card-title mb-2"><?= esc($item['judul_jadwal']) ?></h5>
                                                <p class="card-text mb-2">
                                                    <i class="fas fa-clock text-primary"></i>
                                                    <?= date('H:i', strtotime($item['waktu_mulai'])) ?>
                                                    <?php if ($item['waktu_selesai']): ?>
                                                        - <?= date('H:i', strtotime($item['waktu_selesai'])) ?>
                                                    <?php endif; ?>
                                                </p>
                                                <p class="card-text mb-2">
                                                    <i class="fas fa-map-marker-alt text-danger"></i>
                                                    <?= esc($item['tempat']) ?>
                                                </p>
                                                <?php if ($item['pengkhotbah']): ?>
                                                    <p class="card-text mb-0">
                                                        <i class="fas fa-user-tie text-success"></i>
                                                        <?= esc($item['pengkhotbah']) ?>
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($item['keterangan']): ?>
                                        <div class="card-footer bg-light">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle"></i> <?= esc($item['keterangan']) ?>
                                            </small>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <?php if (isset($pager)): ?>
                        <div class="row mt-4">
                            <div class="col-12">
                                <?= $pager->links('jadwal', 'bootstrap_pagination') ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        Belum ada jadwal untuk <strong><?= isset($jenis_nama) ? esc($jenis_nama) : 'jenis ini' ?></strong>.
                    </div>
                    <div class="text-center mt-4">
                        <a href="<?= base_url('jadwal') ?>" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Semua Jadwal
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
    .jadwal-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .jadwal-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
    }

    .date-box h2 {
        font-size: 2.5rem;
        font-weight: bold;
    }
</style>

<?= $this->endSection() ?>