<?php
/**
 * =====================================================
 * View: Inventaris Gereja - Form Edit Aset
 * Church Management System - Fase 2
 * Created: 8 Oktober 2025
 * =====================================================
 */
?>

<form id="form-aset">
    <input type="hidden" name="id_aset" value="<?= esc($aset->id_aset) ?>">

    <div class="row">
        <div class="col-md-8">
            <!-- Informasi Dasar -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fe-info-circle mr-2"></i>Informasi Dasar Aset
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_aset">Kode Aset</label>
                                <input type="text" class="form-control" id="kode_aset" name="kode_aset"
                                       value="<?= esc($aset->kode_aset) ?>" readonly>
                                <small class="form-text text-muted">Kode aset tidak dapat diubah</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_aset">Nama Aset <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_aset" name="nama_aset"
                                       value="<?= esc($aset->nama_aset) ?>" required>
                                <div class="invalid-feedback" id="nama_aset-error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_kategori">Kategori <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="id_kategori" name="id_kategori" required>
                                    <?php if (!empty($kategori_list)): ?>
                                        <?php foreach ($kategori_list as $kategori): ?>
                                            <option value="<?= $kategori->id_kategori ?>"
                                                <?= ($kategori->id_kategori == $aset->id_kategori) ? 'selected' : '' ?>>
                                                <?= esc($kategori->nama_kategori) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="invalid-feedback" id="id_kategori-error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_lokasi">Lokasi <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="id_lokasi" name="id_lokasi" required>
                                    <?php if (!empty($lokasi_list)): ?>
                                        <?php foreach ($lokasi_list as $lokasi): ?>
                                            <option value="<?= $lokasi->id_lokasi ?>"
                                                <?= ($lokasi->id_lokasi == $aset->id_lokasi) ? 'selected' : '' ?>>
                                                <?= esc($lokasi->nama_lokasi) ?> (<?= esc($lokasi->jenis_lokasi) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="invalid-feedback" id="id_lokasi-error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="merk">Merk</label>
                                <input type="text" class="form-control" id="merk" name="merk"
                                       value="<?= esc($aset->merk) ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model"
                                       value="<?= esc($aset->model) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="serial_number">Serial Number</label>
                                <input type="text" class="form-control" id="serial_number" name="serial_number"
                                       value="<?= esc($aset->serial_number) ?>">
                                <div class="invalid-feedback" id="serial_number-error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun_pembuatan">Tahun Pembuatan</label>
                                <select class="form-control" id="tahun_pembuatan" name="tahun_pembuatan">
                                    <option value="">Pilih Tahun</option>
                                    <?php
                                    $current_year = date('Y');
                                    $selected_year = $aset->tahun_pembuatan ?? '';
                                    for ($year = $current_year; $year >= $current_year - 50; $year--):
                                    ?>
                                        <option value="<?= $year ?>" <?= ($year == $selected_year) ? 'selected' : '' ?>>
                                            <?= $year ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Status dan Kondisi -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status Aset</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Aktif" <?= ($aset->status == 'Aktif') ? 'selected' : '' ?>>Aktif</option>
                                    <option value="Maintenance" <?= ($aset->status == 'Maintenance') ? 'selected' : '' ?>>Maintenance</option>
                                    <option value="Rusak" <?= ($aset->status == 'Rusak') ? 'selected' : '' ?>>Rusak</option>
                                    <option value="Dijual" <?= ($aset->status == 'Dijual') ? 'selected' : '' ?>>Dijual</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kondisi">Kondisi Aset</label>
                                <select class="form-control" id="kondisi" name="kondisi">
                                    <option value="Baik" <?= ($aset->kondisi == 'Baik') ? 'selected' : '' ?>>Baik</option>
                                    <option value="Rusak Ringan" <?= ($aset->kondisi == 'Rusak Ringan') ? 'selected' : '' ?>>Rusak Ringan</option>
                                    <option value="Rusak Berat" <?= ($aset->kondisi == 'Rusak Berat') ? 'selected' : '' ?>>Rusak Berat</option>
                                    <option value="Tidak Berfungsi" <?= ($aset->kondisi == 'Tidak Berfungsi') ? 'selected' : '' ?>>Tidak Berfungsi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Finansial (Read Only) -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fe-dollar-sign mr-2"></i>Informasi Finansial
                    </h5>
                    <small class="text-muted">Data finansial tidak dapat diubah setelah aset dibuat</small>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Pembelian</label>
                                <input type="date" class="form-control" value="<?= esc($aset->tanggal_pembelian) ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Harga Perolehan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" value="<?= number_format($aset->harga_perolehan, 0, ',', '.') ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nilai Buku Saat Ini</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" value="<?= number_format($aset->nilai_buku, 0, ',', '.') ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Akumulasi Depreciation</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" value="<?= number_format($aset->akumulasi_depreciation, 0, ',', '.') ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fe-file-text mr-2"></i>Informasi Tambahan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="warranty_start">Mulai Garansi</label>
                                <input type="date" class="form-control" id="warranty_start" name="warranty_start"
                                       value="<?= esc($aset->warranty_start) ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="warranty_end">Akhir Garansi</label>
                                <input type="date" class="form-control" id="warranty_end" name="warranty_end"
                                       value="<?= esc($aset->warranty_end) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="insurance_company">Perusahaan Asuransi</label>
                                <input type="text" class="form-control" id="insurance_company" name="insurance_company"
                                       value="<?= esc($aset->insurance_company) ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="insurance_policy">No. Polis Asuransi</label>
                                <input type="text" class="form-control" id="insurance_policy" name="insurance_policy"
                                       value="<?= esc($aset->insurance_policy) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="insurance_value">Nilai Pertanggungan Asuransi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" class="form-control" id="insurance_value" name="insurance_value"
                                   value="<?= esc($aset->insurance_value) ?>" min="0" step="1000">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="spesifikasi">Spesifikasi Teknis</label>
                        <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                                  placeholder="Spesifikasi teknis, fitur, kapasitas, dll"><?= esc($aset->spesifikasi) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                                  placeholder="Keterangan tambahan tentang aset"><?= esc($aset->keterangan) ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- QR Code Display -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fe-qr-code mr-2"></i>QR Code Aset
                    </h5>
                </div>
                <div class="card-body text-center">
                    <?php if ($aset->qr_code): ?>
                        <div style="width: 120px; height: 120px; background: #f8f9fa; border: 2px solid #dee2e6; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto;">
                            <div class="text-center">
                                <i class="fe-qr-code fa-2x text-muted"></i>
                                <small class="d-block text-muted mt-1">QR Generated</small>
                            </div>
                        </div>
                        <small class="form-text text-muted mt-2">QR Code: <?= substr($aset->qr_code, 0, 20) ?>...</small>
                    <?php else: ?>
                        <div style="width: 120px; height: 120px; background: #f8f9fa; border: 2px dashed #dee2e6; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto;">
                            <div class="text-center">
                                <i class="fe-qr-code fa-2x text-muted"></i>
                                <small class="d-block text-muted mt-1">No QR Code</small>
                            </div>
                        </div>
                        <small class="form-text text-muted mt-2">QR Code belum di-generate</small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Riwayat Singkat -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fe-clock mr-2"></i>Riwayat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <small class="text-muted">Dibuat</small>
                                <p class="mb-0">
                                    <?= date('d M Y H:i', strtotime($aset->created_at)) ?><br>
                                    <small>oleh <?= esc($aset->created_by_name ?? 'System') ?></small>
                                </p>
                            </div>
                        </div>

                        <?php if ($aset->updated_at != $aset->created_at): ?>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <small class="text-muted">Diperbarui</small>
                                    <p class="mb-0">
                                        <?= date('d M Y H:i', strtotime($aset->updated_at)) ?><br>
                                        <small>oleh <?= esc($aset->updated_by_name ?? 'System') ?></small>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
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
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="printQRCode('<?= $aset->id_aset ?>')">
                            <i class="fe-printer mr-1"></i>Cetak QR Code
                        </button>
                        <button type="button" class="btn btn-outline-info btn-sm" onclick="generateNewQR('<?= $aset->id_aset ?>')">
                            <i class="fe-refresh-ccw mr-1"></i>Generate QR Baru
                        </button>
                        <button type="button" class="btn btn-outline-success btn-sm" onclick="viewMaintenanceHistory('<?= $aset->id_aset ?>')">
                            <i class="fe-wrench mr-1"></i>Riwayat Maintenance
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
// Initialize Select2
$(document).ready(function() {
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });
});

// Print QR Code
function printQRCode(id_aset) {
    window.open('<?= site_url('inventaris-gereja/printqr') ?>/' + id_aset, '_blank');
}

// Generate new QR Code
function generateNewQR(id_aset) {
    Swal.fire({
        title: 'Generate QR Code Baru?',
        text: 'QR Code lama akan tidak berlaku lagi',
        icon: 'warning',
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
                        toastr.success('QR Code baru berhasil di-generate');
                        location.reload();
                    } else {
                        toastr.error(response.error);
                    }
                }
            });
        }
    });
}

// View maintenance history
function viewMaintenanceHistory(id_aset) {
    $.ajax({
        url: '<?= site_url('maintenance-aset/getbyaset') ?>/' + id_aset,
        type: 'GET',
        success: function(response) {
            $('.modal-title').html('Riwayat Maintenance');
            $('.modal-body').html(`
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${response.map(item => `
                                <tr>
                                    <td>${item.tanggal_jadwal}</td>
                                    <td>${item.jenis_maintenance}</td>
                                    <td><span class="badge badge-${getStatusBadgeClass(item.status)}">${item.status}</span></td>
                                    <td>Rp ${formatNumber(item.biaya_aktual)}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>
            `);
            $('.modal-footer').html(`
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            `);
            $('#modal').modal('show');
        }
    });
}

// Helper function untuk status badge class
function getStatusBadgeClass(status) {
    switch (status) {
        case 'Selesai': return 'success';
        case 'Sedang Proses': return 'warning';
        case 'Dijadwalkan': return 'info';
        case 'Ditunda': return 'secondary';
        case 'Dibatalkan': return 'danger';
        default: return 'secondary';
    }
}

// Format number
function formatNumber(num) {
    return new Intl.NumberFormat('id-ID').format(num);
}
</script>
