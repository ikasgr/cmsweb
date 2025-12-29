<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3><?= isset($title) ? $title : 'Bank Data' ?></h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bank Data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Bank Data Section Start Here <================== -->
<div class="bankdata-section padding--top padding--bottom bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">

                        <?php if (isset($bankdata) && count($bankdata) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" width="5%">No</th>
                                            <th scope="col" width="50%">Nama Dokumen</th>
                                            <th scope="col" width="15%" class="text-center">Tanggal</th>
                                            <th scope="col" width="15%" class="text-center">Diunduh</th>
                                            <th scope="col" width="15%" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1 + (6 * ($pager->getCurrentPage('hal') - 1));
                                        foreach ($bankdata as $row):
                                            // Determine icon based on file extension
                                            $ext = pathinfo($row['fileupload'], PATHINFO_EXTENSION);
                                            $iconKey = 'fa-file';
                                            $iconColor = 'text-secondary';

                                            switch (strtolower($ext)) {
                                                case 'pdf':
                                                    $iconKey = 'fa-file-pdf';
                                                    $iconColor = 'text-danger';
                                                    break;
                                                case 'doc':
                                                case 'docx':
                                                    $iconKey = 'fa-file-word';
                                                    $iconColor = 'text-primary';
                                                    break;
                                                case 'xls':
                                                case 'xlsx':
                                                    $iconKey = 'fa-file-excel';
                                                    $iconColor = 'text-success';
                                                    break;
                                                case 'ppt':
                                                case 'pptx':
                                                    $iconKey = 'fa-file-powerpoint';
                                                    $iconColor = 'text-warning';
                                                    break;
                                                case 'zip':
                                                case 'rar':
                                                    $iconKey = 'fa-file-archive';
                                                    $iconColor = 'text-dark';
                                                    break;
                                                case 'jpg':
                                                case 'jpeg':
                                                case 'png':
                                                    $iconKey = 'fa-file-image';
                                                    $iconColor = 'text-info';
                                                    break;
                                            }
                                            ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="far <?= $iconKey ?> <?= $iconColor ?> fa-2x me-3"></i>
                                                        <div>
                                                            <h6 class="mb-0 fw-bold text-dark"><?= esc($row['nama_bankdata']) ?>
                                                            </h6>
                                                            <small class="text-muted"><?= strtoupper($ext) ?> File</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center text-muted small">
                                                    <i class="far fa-calendar-alt me-1"></i>
                                                    <?= date_indo($row['tgl_upload']) ?>
                                                </td>
                                                <td class="text-center text-muted small">
                                                    <i class="fas fa-download me-1"></i>
                                                    <?= $row['hits'] ?> kali
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('bankdata/download/' . $row['fileupload']) ?>"
                                                        class="btn btn-primary btn-sm rounded-pill px-3">
                                                        <i class="fas fa-download me-1"></i> Unduh
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="mt-5 d-flex justify-content-center">
                                <?= $pager->links('hal', 'bootstrap_pagination') ?>
                            </div>

                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="far fa-folder-open fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada data dokumen yang tersedia.</h5>
                                <a href="<?= base_url() ?>" class="btn btn-outline-primary mt-3">Kembali ke Beranda</a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================> Bank Data Section End Here <================== -->

<style>
    .table> :not(caption)>*>* {
        padding: 1rem 0.75rem;
        border-bottom-color: #f0f0f0;
    }

    .table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .pageheader {
        background-color: var(--primary-color);
        /* Fallback if var not defined, but usually in style.css */
    }
</style>

<?= $this->endSection() ?>