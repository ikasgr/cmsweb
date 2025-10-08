<?php
/**
 * =====================================================
 * View: Inventaris Gereja - Detail Aset Lengkap
 * Church Management System - Fase 2
 * Created: 8 Oktober 2025
 * =====================================================
 */
?>

<div class="row">
    <!-- Informasi Utama Aset -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fe-info-circle mr-2"></i>Informasi Aset
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <td width="40%"><strong>Kode Aset</strong></td>
                                <td><?= esc($aset->kode_aset) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Nama Aset</strong></td>
                                <td><?= esc($aset->nama_aset) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Kategori</strong></td>
                                <td>
                                    <span class="badge badge-soft-primary" style="background-color: <?= esc($aset->warna) ?>20; color: <?= esc($aset->warna) ?>; border: 1px solid <?= esc($aset->warna) ?>30;">
                                        <i class="<?= esc($aset->icon) ?> mr-1"></i>
                                        <?= esc($aset->nama_kategori) ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi</strong></td>
                                <td><?= esc($aset->nama_lokasi) ?> (<?= esc($aset->jenis_lokasi) ?>)</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
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
                                        case 'Dijual':
                                            $status_class = 'badge-info';
                                            $status_icon = 'fe-dollar-sign';
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
                            </tr>
                            <tr>
                                <td><strong>Kondisi</strong></td>
                                <td>
                                    <?php
                                    $kondisi_class = '';
                                    switch ($aset->kondisi) {
                                        case 'Baik':
                                            $kondisi_class = 'badge-success';
                                            break;
                                        case 'Rusak Ringan':
                                            $kondisi_class = 'badge-warning';
                                            break;
                                        case 'Rusak Berat':
                                            $kondisi_class = 'badge-danger';
                                            break;
                                        case 'Tidak Berfungsi':
                                            $kondisi_class = 'badge-dark';
                                            break;
                                        default:
                                            $kondisi_class = 'badge-secondary';
                                    }
                                    ?>
                                    <span class="badge <?= $kondisi_class ?>">
                                        <?= esc($aset->kondisi) ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <td width="40%"><strong>Merk</strong></td>
                                <td><?= esc($aset->merk ?: '-') ?></td>
                            </tr>
                            <tr>
                                <td><strong>Model</strong></td>
                                <td><?= esc($aset->model ?: '-') ?></td>
                            </tr>
                            <tr>
                                <td><strong>Serial Number</strong></td>
                                <td><?= esc($aset->serial_number ?: '-') ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tahun Pembuatan</strong></td>
                                <td><?= esc($aset->tahun_pembuatan ?: '-') ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Pembelian</strong></td>
                                <td><?= date('d M Y', strtotime($aset->tanggal_pembelian)) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Supplier</strong></td>
                                <td><?= esc($aset->supplier ?: '-') ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php if ($aset->spesifikasi): ?>
                    <div class="mt-3">
                        <strong>Spesifikasi Teknis:</strong>
                        <p class="mt-2 text-muted" style="white-space: pre-line;"><?= esc($aset->spesifikasi) ?></p>
                    </div>
                <?php endif; ?>

                <?php if ($aset->keterangan): ?>
                    <div class="mt-3">
                        <strong>Keterangan:</strong>
                        <p class="mt-2 text-muted" style="white-space: pre-line;"><?= esc($aset->keterangan) ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Riwayat Maintenance -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fe-wrench mr-2"></i>Riwayat Maintenance
                </h5>
                <button type="button" class="btn btn-sm btn-primary" onclick="tambahMaintenance('<?= $aset->id_aset ?>')">
                    <i class="fe-plus mr-1"></i>Tambah Maintenance
                </button>
            </div>
            <div class="card-body">
                <?php if (!empty($riwayat_maintenance)): ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Vendor</th>
                                    <th>Biaya</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($riwayat_maintenance as $maintenance): ?>
                                    <tr>
                                        <td><?= date('d M Y', strtotime($maintenance->tanggal_jadwal)) ?></td>
                                        <td><?= esc($maintenance->jenis_maintenance) ?></td>
                                        <td>
                                            <?php
                                            $status_class = '';
                                            switch ($maintenance->status) {
                                                case 'Selesai':
                                                    $status_class = 'badge-success';
                                                    break;
                                                case 'Sedang Proses':
                                                    $status_class = 'badge-warning';
                                                    break;
                                                case 'Dijadwalkan':
                                                    $status_class = 'badge-info';
                                                    break;
                                                case 'Ditunda':
                                                    $status_class = 'badge-secondary';
                                                    break;
                                                case 'Dibatalkan':
                                                    $status_class = 'badge-danger';
                                                    break;
                                                default:
                                                    $status_class = 'badge-secondary';
                                            }
                                            ?>
                                            <span class="badge <?= $status_class ?>"><?= esc($maintenance->status) ?></span>
                                        </td>
                                        <td><?= esc($maintenance->nama_vendor ?: '-') ?></td>
                                        <td>Rp <?= number_format($maintenance->biaya_aktual, 0, ',', '.') ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-info" onclick="lihatMaintenance('<?= $maintenance->id_maintenance ?>')">
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
                        <i class="fe-wrench fa-3x text-muted mb-3"></i>
                        <h5>Belum ada maintenance</h5>
                        <p class="text-muted">Aset ini belum pernah menjalani maintenance</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Riwayat Perbaikan -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fe-alert-triangle mr-2"></i>Riwayat Perbaikan
                </h5>
                <button type="button" class="btn btn-sm btn-warning" onclick="tambahPerbaikan('<?= $aset->id_aset ?>')">
                    <i class="fe-plus mr-1"></i>Laporkan Kerusakan
                </button>
            </div>
            <div class="card-body">
                <?php if (!empty($riwayat_perbaikan)): ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Tanggal Laporan</th>
                                    <th>Jenis Kerusakan</th>
                                    <th>Status</th>
                                    <th>Vendor</th>
                                    <th>Biaya</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($riwayat_perbaikan as $perbaikan): ?>
                                    <tr>
                                        <td><?= date('d M Y', strtotime($perbaikan->tanggal_laporan)) ?></td>
                                        <td><?= esc($perbaikan->jenis_kerusakan) ?></td>
                                        <td>
                                            <?php
                                            $status_class = '';
                                            switch ($perbaikan->status) {
                                                case 'Selesai':
                                                    $status_class = 'badge-success';
                                                    break;
                                                case 'Sedang Diperbaiki':
                                                    $status_class = 'badge-warning';
                                                    break;
                                                case 'Dilaporkan':
                                                    $status_class = 'badge-info';
                                                    break;
                                                case 'Tidak Dapat Diperbaiki':
                                                    $status_class = 'badge-danger';
                                                    break;
                                                default:
                                                    $status_class = 'badge-secondary';
                                            }
                                            ?>
                                            <span class="badge <?= $status_class ?>"><?= esc($perbaikan->status) ?></span>
                                        </td>
                                        <td><?= esc($perbaikan->nama_vendor ?: '-') ?></td>
                                        <td>Rp <?= number_format($perbaikan->total_biaya, 0, ',', '.') ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-info" onclick="lihatPerbaikan('<?= $perbaikan->id_perbaikan ?>')">
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
                        <i class="fe-alert-triangle fa-3x text-muted mb-3"></i>
                        <h5>Tidak ada riwayat perbaikan</h5>
                        <p class="text-muted">Aset ini belum pernah mengalami kerusakan</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-md-4">
        <!-- QR Code -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fe-qr-code mr-2"></i>QR Code Aset
                </h5>
            </div>
            <div class="card-body text-center">
                <?php if ($aset->qr_code): ?>
                    <div style="width: 150px; height: 150px; background: #f8f9fa; border: 2px solid #dee2e6; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <div class="text-center">
                            <i class="fe-qr-code fa-3x text-muted"></i>
                            <small class="d-block text-muted mt-2">QR Generated</small>
                        </div>
                    </div>
                    <p class="mt-2 mb-0">
                        <strong>Kode QR:</strong><br>
                        <small class="text-muted font-monospace" style="word-break: break-all;">
                            <?= esc($aset->qr_code) ?>
                        </small>
                    </p>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="printQRCode('<?= $aset->id_aset ?>')">
                        <i class="fe-printer mr-1"></i>Cetak QR Code
                    </button>
                <?php else: ?>
                    <div style="width: 150px; height: 150px; background: #f8f9fa; border: 2px dashed #dee2e6; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <div class="text-center">
                            <i class="fe-qr-code fa-3x text-muted"></i>
                            <small class="d-block text-muted mt-2">No QR Code</small>
                        </div>
                    </div>
                    <p class="mt-2 mb-2 text-muted">QR Code belum di-generate</p>
                    <button type="button" class="btn btn-sm btn-primary" onclick="generateQRCode('<?= $aset->id_aset ?>')">
                        <i class="fe-plus mr-1"></i>Generate QR Code
                    </button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Informasi Finansial -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fe-dollar-sign mr-2"></i>Informasi Finansial
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Harga Perolehan</strong></td>
                        <td class="text-right"><strong>Rp <?= number_format($aset->harga_perolehan, 0, ',', '.') ?></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Nilai Buku</strong></td>
                        <td class="text-right">Rp <?= number_format($aset->nilai_buku, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td><strong>Akumulasi Depreciation</strong></td>
                        <td class="text-right">Rp <?= number_format($aset->akumulasi_depreciation, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td><strong>Metode Depreciation</strong></td>
                        <td><?= esc($aset->metode_depreciation) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Masa Pakai</strong></td>
                        <td><?= esc($aset->masa_pakai) ?> tahun</td>
                    </tr>
                    <tr>
                        <td><strong>Nilai Residu</strong></td>
                        <td class="text-right">Rp <?= number_format($aset->nilai_residu, 0, ',', '.') ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Warranty & Insurance -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fe-shield mr-2"></i>Garansi & Asuransi
                </h5>
            </div>
            <div class="card-body">
                <?php if ($aset->warranty_start && $aset->warranty_end): ?>
                    <div class="mb-3">
                        <strong>Garansi:</strong><br>
                        <small>
                            <?= date('d M Y', strtotime($aset->warranty_start)) ?> -
                            <?= date('d M Y', strtotime($aset->warranty_end)) ?>
                        </small>
                        <?php
                        $warranty_days = ceil((strtotime($aset->warranty_end) - time()) / (60 * 60 * 24));
                        if ($warranty_days > 0) {
                            echo '<br><span class="badge badge-success">Aktif (' . $warranty_days . ' hari lagi)</span>';
                        } else {
                            echo '<br><span class="badge badge-danger">Kadaluarsa</span>';
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <?php if ($aset->insurance_company && $aset->insurance_policy): ?>
                    <div class="mb-3">
                        <strong>Asuransi:</strong><br>
                        <small>
                            <?= esc($aset->insurance_company) ?><br>
                            Polis: <?= esc($aset->insurance_policy) ?><br>
                            Nilai: Rp <?= number_format($aset->insurance_value, 0, ',', '.') ?>
                        </small>
                    </div>
                <?php endif; ?>

                <?php if (!$aset->warranty_start && !$aset->insurance_company): ?>
                    <div class="text-center py-3">
                        <i class="fe-shield fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Tidak ada informasi garansi atau asuransi</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fe-settings mr-2"></i>Aksi Cepat
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="edit('<?= $aset->id_aset ?>')">
                        <i class="fe-edit mr-1"></i>Edit Aset
                    </button>
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="jadwalkanMaintenance('<?= $aset->id_aset ?>')">
                        <i class="fe-calendar-plus mr-1"></i>Jadwalkan Maintenance
                    </button>
                    <button type="button" class="btn btn-outline-warning btn-sm" onclick="laporKerusakan('<?= $aset->id_aset ?>')">
                        <i class="fe-alert-triangle mr-1"></i>Laporkan Kerusakan
                    </button>
                    <button type="button" class="btn btn-outline-info btn-sm" onclick="transferAset('<?= $aset->id_aset ?>')">
                        <i class="fe-truck mr-1"></i>Transfer Lokasi
                    </button>
                    <?php if ($aset->status == 'Aktif'): ?>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="toggleStatus('<?= $aset->id_aset ?>', 'Maintenance')">
                            <i class="fe-pause mr-1"></i>Set Maintenance
                        </button>
                    <?php elseif ($aset->status == 'Maintenance'): ?>
                        <button type="button" class="btn btn-outline-success btn-sm" onclick="toggleStatus('<?= $aset->id_aset ?>', 'Aktif')">
                            <i class="fe-play mr-1"></i>Set Aktif
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Print QR Code
function printQRCode(id_aset) {
    window.open('<?= site_url('inventaris-gereja/printqr') ?>/' + id_aset, '_blank');
}

// Generate QR Code
function generateQRCode(id_aset) {
    Swal.fire({
        title: 'Generate QR Code?',
        text: 'QR Code akan digunakan untuk tracking aset',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Generate!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= site_url('inventaris-gereja/generateqr') ?>',
                type: 'POST',
                data: { id_aset: id_aset },
                success: function(response) {
                    if (response.sukses) {
                        toastr.success('QR Code berhasil di-generate');
                        location.reload();
                    } else {
                        toastr.error(response.error);
                    }
                }
            });
        }
    });
}

// Tambah maintenance
function tambahMaintenance(id_aset) {
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

// Lihat detail maintenance
function lihatMaintenance(id_maintenance) {
    $.ajax({
        url: '<?= site_url('maintenance-aset/formlihat') ?>',
        type: 'POST',
        data: { id_maintenance: id_maintenance },
        success: function(response) {
            if (response.sukses) {
                $('.modal-title').html('Detail Maintenance');
                $('.modal-body').html(response.sukses);
                $('.modal-footer').html(`
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                `);
                $('#modal').modal('show');
            }
        }
    });
}

// Tambah perbaikan
function tambahPerbaikan(id_aset) {
    $.ajax({
        url: '<?= site_url('perbaikan-aset/formtambah') ?>',
        type: 'POST',
        data: { id_aset: id_aset },
        success: function(response) {
            if (response.data) {
                $('.modal-title').html('Laporkan Kerusakan');
                $('.modal-body').html(response.data);
                $('.modal-footer').html(`
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-warning" onclick="simpanPerbaikan()">Laporkan</button>
                `);
                $('#modal').modal('show');
            }
        }
    });
}

// Lihat detail perbaikan
function lihatPerbaikan(id_perbaikan) {
    $.ajax({
        url: '<?= site_url('perbaikan-aset/formlihat') ?>',
        type: 'POST',
        data: { id_perbaikan: id_perbaikan },
        success: function(response) {
            if (response.sukses) {
                $('.modal-title').html('Detail Perbaikan');
                $('.modal-body').html(response.sukses);
                $('.modal-footer').html(`
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                `);
                $('#modal').modal('show');
            }
        }
    });
}

// Jadwalkan maintenance
function jadwalkanMaintenance(id_aset) {
    tambahMaintenance(id_aset);
}

// Lapor kerusakan
function laporKerusakan(id_aset) {
    tambahPerbaikan(id_aset);
}

// Transfer aset
function transferAset(id_aset) {
    $.ajax({
        url: '<?= site_url('transfer-aset/formtambah') ?>',
        type: 'POST',
        data: { id_aset: id_aset },
        success: function(response) {
            if (response.data) {
                $('.modal-title').html('Transfer Aset');
                $('.modal-body').html(response.data);
                $('.modal-footer').html(`
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="simpanTransfer()">Transfer</button>
                `);
                $('#modal').modal('show');
            }
        }
    });
}

// Toggle status
function toggleStatus(id_aset, status) {
    $.ajax({
        url: '<?= site_url('inventaris-gereja/toggle') ?>',
        type: 'POST',
        data: { id_aset: id_aset, status: status },
        success: function(response) {
            toastr.success(response.sukses);
            location.reload();
        }
    });
}
</script>
