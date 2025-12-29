<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>Transparansi Keuangan</h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transparansi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Transparansi Section Start Here <================== -->
<div class="service padding--top padding--bottom bg-light">
    <div class="container">
        <div class="section__header text-center mb-5">
            <h2 class="fw-bold">Transparansi Keuangan</h2>
            <p class="text-muted">Informasi keuangan yang terbuka dan akuntabel</p>
        </div>

        <!-- Chart Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0 fw-bold">Grafik Keuangan</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <select class="form-select form-select-sm" id="tahunSelect">
                                            <option value="">Pilih Tahun</option>
                                            <?php if (!empty($listopsi)): ?>
                                                <?php foreach ($listopsi as $opsi): ?>
                                                    <option value="<?= $opsi['tahun'] ?>"><?= $opsi['tahun'] ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select form-select-sm" id="judulSelect">
                                            <option value="">Pilih Kategori</option>
                                            <?php if (!empty($listopsi)): ?>
                                                <?php foreach ($listopsi as $opsi): ?>
                                                    <option value="<?= esc($opsi['judul']) ?>"><?= esc($opsi['judul']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="grafikContainer" style="min-height: 400px;">
                            <div class="text-center py-5">
                                <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Silakan pilih tahun dan kategori untuk menampilkan grafik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data List Section -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">Data Keuangan</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($list)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Tahun</th>
                                            <th>Jenis</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($list as $item): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= esc($item['judul']) ?></td>
                                                <td><?= esc($item['tahun']) ?></td>
                                                <td>
                                                    <span class="badge bg-<?= $item['jenis'] == '1' ? 'success' : 'info' ?>">
                                                        <?= $item['jenis'] == '1' ? 'Pemasukan' : 'Pengeluaran' ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-primary"
                                                        onclick="lihatDetail(<?= $item['transparan_id'] ?>)">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada data transparansi</h5>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================> Transparansi Section End Here <================== -->

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content" id="modalContent">
            <!-- Content loaded via AJAX -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function () {
        let currentChart = null;

        // Load default chart
        loadChart('', '');

        // Event listeners
        $('#tahunSelect, #judulSelect').change(function () {
            const tahun = $('#tahunSelect').val();
            const judul = $('#judulSelect').val();
            loadChart(tahun, judul);
        });

        function loadChart(tahun, judul) {
            $.ajax({
                url: '<?= base_url('transparansi/TampilkanGrafik') ?>',
                type: 'POST',
                data: {
                    tahun: tahun,
                    judul: judul,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                success: function (response) {
                    if (response.data) {
                        $('#grafikContainer').html(response.data);
                    }
                },
                error: function () {
                    $('#grafikContainer').html(`
                    <div class="text-center py-5">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <p class="text-muted">Gagal memuat grafik</p>
                    </div>
                `);
                }
            });
        }
    });

    function lihatDetail(id) {
        $.ajax({
            url: '<?= base_url('transparansi/detailajx') ?>',
            type: 'POST',
            data: {
                transparansi: id,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            beforeSend: function () {
                $('#modalContent').html(`
                <div class="modal-body text-center py-5">
                    <div class="spinner-border text-primary"></div>
                    <p class="mt-3">Memuat detail...</p>
                </div>
            `);
                $('#modalDetail').modal('show');
            },
            success: function (response) {
                if (response.data) {
                    $('#modalContent').html(response.data);
                }
            }
        });
    }
</script>

<?= $this->endSection() ?>